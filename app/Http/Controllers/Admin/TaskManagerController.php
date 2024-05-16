<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Admin;
use App\Models\AssaignTask;
use Image;
use Auth;
use DB;
use Carbon\Carbon;
class TaskManagerController extends Controller
{
    public $user;


    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }


    public function index(){

        if (is_null($this->user) || !$this->user->can('taskManagerView')) {
            //abort(403, 'Sorry !! You are Unauthorized to view !');
            return redirect()->route('error_404');
        }

        try{
            \LogActivity::addToLog('View taskManager.');


            $allTaskList = Task::where('admin_id',Auth::guard('admin')->user()->id)
            ->where('end_date_formate', date('Y-m-d'))
            //->where('status','চলমান')
            ->orderBy('end_date_formate','asc')
            ->latest()->get();


            $allTaskListAll = Task::where('admin_id',Auth::guard('admin')->user()->id)
            //->where('end_date_formate', date('Y-m-d'))
            //->where('status','চলমান')
            ->orderBy('end_date_formate','desc')
            ->latest()->get();


            $allTaskListAllOngoing = Task::where('admin_id',Auth::guard('admin')->user()->id)
            ->where('end_date_formate','<', date('Y-m-d'))
            ->where('status','চলমান')
            ->orderBy('end_date_formate','asc')
            ->latest()->get();



            $allTaskListAllComplete = Task::where('admin_id',Auth::guard('admin')->user()->id)
            //->where('end_date_formate', date('Y-m-d'))
            ->where('status','সম্পন্ন')
            ->orderBy('end_date_formate','asc')
            ->latest()->get();




            $allTaskListPrevious = Task::where('admin_id',Auth::guard('admin')->user()->id)
            ->where('end_date_formate', date('Y-m-d',strtotime("-1 days")))
            //->where('status','চলমান')

            ->latest()->get();



            $allTaskListTomorrow = Task::where('admin_id',Auth::guard('admin')->user()->id)
            ->where('end_date_formate', date('Y-m-d',strtotime("+1 days")))
            //->where('status','চলমান')
            ->latest()->get();






            return view('admin.taskManager.index',compact(
                'allTaskList',
                'allTaskListPrevious',
                'allTaskListTomorrow',
                'allTaskListAll',
                'allTaskListAllOngoing',
                'allTaskListAllComplete'

            ));

        }catch (\Exception $e) {
            return redirect()->route('error_404')->with('error','some thing went wrong ');
        }
    }


    public function create(){

        if (is_null($this->user) || !$this->user->can('taskManagerAdd')) {
            //abort(403, 'Sorry !! You are Unauthorized to view !');
            return redirect()->route('error_404');
        }

        try{
            \LogActivity::addToLog('Add taskManager.');


        $users = Admin::where('id','!=',1)->orderBy('id','asc')->get();

        return view('admin.taskManager.create',compact('users'));

    }catch (\Exception $e) {
        return redirect()->route('error_404')->with('error','some thing went wrong ');
    }
    }




    public function edit($id){

        if (is_null($this->user) || !$this->user->can('taskManagerUpdate')) {
            //abort(403, 'Sorry !! You are Unauthorized to view !');
            return redirect()->route('error_404');
        }

        try{
            \LogActivity::addToLog('Update taskManager.');

            $allTaskList = Task::where('admin_id',Auth::guard('admin')->user()->id)
            ->where('id',$id)
            ->first();
        $users = Admin::where('id','!=',1)->orderBy('id','asc')->get();

        return view('admin.taskManager.edit',compact('users','allTaskList'));

    }catch (\Exception $e) {
        return redirect()->route('error_404')->with('error','some thing went wrong ');
    }


    }



    public function taskManagerType(Request $request){

        if($request->task_type == 'গ্রুপ'){
            $users = Admin::where('id','!=',1)->orderBy('id','asc')->get();
            return view('admin.taskManager.group',compact('users'));

        }else{
            $users = Admin::where('id','!=',1)->orderBy('id','asc')->get();
            return view('admin.taskManager.single',compact('users'));

        }



    }


    public function store(Request $request){


        if (is_null($this->user) || !$this->user->can('taskManagerAdd')) {
            //abort(403, 'Sorry !! You are Unauthorized to View !');
            return redirect()->route('error_404');
               }

               try{
                DB::beginTransaction();
               \LogActivity::addToLog('System  Info Update.');

        $request->validate([
            'task_type' => 'required|string',
            'task_name' => 'required|string',
            'last_date' => 'required',
            'mainPartNote' => 'required'
        ]);





        $taskInfo =  new Task();
        $taskInfo->task_type = $request->task_type;
        $taskInfo->task_name = $request->task_name;
        $taskInfo->end_date = $request->last_date;
        $taskInfo->end_date_formate = date('Y-m-d', strtotime($request->last_date));
        $taskInfo->status = 'চলমান';
        $taskInfo->admin_id = Auth::guard('admin')->user()->id;
        $taskInfo->description= $request->mainPartNote;
        $taskInfo->save();


        $taskId = $taskInfo->id;

        if($request->task_type == 'গ্রুপ'){

            $inputAllData=$request->all();
            $adminId = $inputAllData['admin_id'];

            foreach($adminId as $key => $allAdminId){

                $newAssaign = new AssaignTask();
                $newAssaign->task_id = $taskId;
                $newAssaign->status = 'চলমান';
                $newAssaign->admin_id = $inputAllData['admin_id'][$key];
                $newAssaign->save();

            }

        }else{

               $newAssaign =  new AssaignTask();
               $newAssaign->task_id = $taskId;
               $newAssaign->status = 'চলমান';
               $newAssaign->admin_id = $request->admin_id;
               $newAssaign->save();
        }

        DB::commit();
    return redirect()->route('taskManager.index')->with('success','Added Succesfully');


} catch (\Exception $e) {
    DB::rollBack();
    return redirect()->route('error_404')->with('error','some thing went wrong ');
}
    }







    public function update(Request $request,$id){


        if (is_null($this->user) || !$this->user->can('taskManagerUpdate')) {
            //abort(403, 'Sorry !! You are Unauthorized to View !');
            return redirect()->route('error_404');
               }

               try{
                DB::beginTransaction();
               \LogActivity::addToLog('System  Info Update.');


        $taskInfo =  Task::find($id);
        $taskInfo->task_type = $request->task_type;
        $taskInfo->task_name = $request->task_name;
        $taskInfo->end_date = $request->last_date;
        $taskInfo->end_date_formate = date('Y-m-d', strtotime($request->last_date));
        $taskInfo->status = $request->status;
        $taskInfo->admin_id = Auth::guard('admin')->user()->id;
        $taskInfo->description= $request->mainPartNote;
        $taskInfo->save();


        $taskId = $taskInfo->id;

        if($request->task_type == 'গ্রুপ'){


            $getPreviousTaskIdDelete = AssaignTask::where('task_id',$taskId)->delete();

            $inputAllData=$request->all();
            $adminId = $inputAllData['admin_id'];

            foreach($adminId as $key => $allAdminId){

                $newAssaign = new AssaignTask();
                $newAssaign->task_id = $taskId;
                $newAssaign->status = $request->status;
                $newAssaign->admin_id = $inputAllData['admin_id'][$key];
                $newAssaign->save();

            }

        }else{

            $getPreviousTaskId = AssaignTask::where('task_id',$taskId)
            ->where('admin_id',$request->admin_id)->value('admin_id');

            if($getPreviousTaskId == $request->admin_id){


            }else{

               $newAssaign =  new AssaignTask();
               $newAssaign->status = $request->status;
               $newAssaign->task_id = $taskId;
               $newAssaign->admin_id = $request->admin_id;
               $newAssaign->save();
            }
        }

        DB::commit();
    return redirect()->route('taskManager.index')->with('info','Updated Succesfully');


} catch (\Exception $e) {
    DB::rollBack();
    return redirect()->route('error_404')->with('error','some thing went wrong ');
}


    }


    public function taskManagerAssign(Request $request,$id){

        $newAssaign =  new AssaignTask();
        $newAssaign->task_id = $id;
        $newAssaign->status = 'চলমান';
        $newAssaign->admin_id = $request->admin_id;
        $newAssaign->save();
    }



    public function taskManagerTypeUpdate(Request $request,$id){


        try{
            DB::beginTransaction();
           \LogActivity::addToLog('Task Status Update.');


    $taskInfo =  Task::find($id);
    $taskInfo->status = $request->status;
    $taskInfo->save();




    AssaignTask::where('admin_id',Auth::guard('admin')->user()->id)
    ->where('task_id',$id)
       ->update([
           'status' => $request->status
        ]);


    DB::commit();
return redirect()->back()->with('info','Updated Succesfully');


} catch (\Exception $e) {
DB::rollBack();
return redirect()->route('error_404')->with('error','some thing went wrong ');
}


    }



    public function destroy($id){

        if (is_null($this->user) || !$this->user->can('taskManagerDelete')) {
            return redirect()->route('error_404');
               }

               \LogActivity::addToLog('Delete Task.');

        $role = Task::find($id);
        if (!is_null($role)) {
            $role->delete();
        }


        return redirect()->back()->with('error','Deleted successfully!');

    }



}
