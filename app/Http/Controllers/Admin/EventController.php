<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Admin;
use App\Models\AssaignTask;
use Image;
use Auth;
use DB;
use Carbon\Carbon;
class EventController extends Controller
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

        if (is_null($this->user) || !$this->user->can('eventView')) {

            return redirect()->route('error_404');
        }

        try{
            \LogActivity::addToLog('View Event.');


            $allTaskList = Event::where('admin_id',Auth::guard('admin')->user()->id)
            ->where('date', date('Y-m-d'))
            //->where('status','চলমান')
            ->orderBy('date','asc')
            ->latest()->get();


            $allTaskListAll = Event::where('admin_id',Auth::guard('admin')->user()->id)
            //->where('date', date('Y-m-d'))
            //->where('status','চলমান')
            ->orderBy('date','desc')
            ->latest()->get();


            $allTaskListAllOngoing = Event::where('admin_id',Auth::guard('admin')->user()->id)
           // ->where('date','<', date('Y-m-d'))
            ->where('status','বাতিল')
            ->orderBy('date','asc')
            ->latest()->get();



            $allTaskListAllComplete = Event::where('admin_id',Auth::guard('admin')->user()->id)
            //->where('date', date('Y-m-d'))
            ->where('status','সম্পন্ন')
            ->orderBy('date','asc')
            ->latest()->get();




            $allTaskListPrevious = Event::where('admin_id',Auth::guard('admin')->user()->id)
            ->where('date', date('Y-m-d',strtotime("-1 days")))
            //->where('status','চলমান')

            ->latest()->get();



            $allTaskListTomorrow = Event::where('admin_id',Auth::guard('admin')->user()->id)
            ->where('date', date('Y-m-d',strtotime("+1 days")))
            //->where('status','চলমান')
            ->latest()->get();


           // dd($allTaskListTomorrow);






            return view('admin.event.index',compact(
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

        if (is_null($this->user) || !$this->user->can('eventAdd')) {
            //abort(403, 'Sorry !! You are Unauthorized to view !');
            return redirect()->route('error_404');
        }

        try{
            \LogActivity::addToLog('Add event.');


        $users = Admin::where('id','!=',1)->orderBy('id','asc')->get();

        return view('admin.event.create',compact('users'));

    }catch (\Exception $e) {
        return redirect()->route('error_404')->with('error','some thing went wrong ');
    }
    }




    public function edit($id){

        if (is_null($this->user) || !$this->user->can('eventUpdate')) {
            //abort(403, 'Sorry !! You are Unauthorized to view !');
            return redirect()->route('error_404');
        }

        try{
            \LogActivity::addToLog('Update event.');

            $allTaskList = Event::where('admin_id',Auth::guard('admin')->user()->id)
            ->where('id',$id)
            ->first();
        $users = Admin::where('id','!=',1)->orderBy('id','asc')->get();

        return view('admin.event.edit',compact('users','allTaskList'));

    }catch (\Exception $e) {
        return redirect()->route('error_404')->with('error','some thing went wrong ');
    }


    }




    public function store(Request $request){


        if (is_null($this->user) || !$this->user->can('eventAdd')) {
            //abort(403, 'Sorry !! You are Unauthorized to View !');
            return redirect()->route('error_404');
               }

               try{
                DB::beginTransaction();
               \LogActivity::addToLog('System  Info Update.');

        $request->validate([
            'name' => 'required|string',
            'detail' => 'required|string',
            'time' => 'required',
            'date' => 'required'
        ]);





        $taskInfo =  new Event();
        $taskInfo->name = $request->name;
        $taskInfo->detail = $request->detail;
        $taskInfo->time = $request->time;
        $taskInfo->	date = date('Y-m-d', strtotime($request->date));
        $taskInfo->status = 'শীঘ্রই আসছে';
        $taskInfo->admin_id = Auth::guard('admin')->user()->id;
        $taskInfo->save();

        DB::commit();
    return redirect()->route('eventManager.index')->with('success','Added Succesfully');


} catch (\Exception $e) {
    DB::rollBack();
    return redirect()->route('error_404')->with('error','some thing went wrong ');
}
    }




    public function update(Request $request,$id){


        if (is_null($this->user) || !$this->user->can('eventAdd')) {
            //abort(403, 'Sorry !! You are Unauthorized to View !');
            return redirect()->route('error_404');
               }

               try{
                DB::beginTransaction();
               \LogActivity::addToLog('Event  Info Update.');


        $taskInfo =  Event::find($id);
        $taskInfo->name = $request->name;
        $taskInfo->detail = $request->detail;
        $taskInfo->time = $request->time;
        $taskInfo->	date = date('Y-m-d', strtotime($request->date));
        $taskInfo->status = $request->status;
        $taskInfo->save();

        DB::commit();
    return redirect()->route('eventManager.index')->with('success','Added Succesfully');


} catch (\Exception $e) {
    DB::rollBack();
    return redirect()->route('error_404')->with('error','some thing went wrong ');
}
    }



    public function destroy($id){

        if (is_null($this->user) || !$this->user->can('eventDelete')) {
            return redirect()->route('error_404');
               }

               \LogActivity::addToLog('Delete Event.');

        $role = Event::find($id);
        if (!is_null($role)) {
            $role->delete();
        }


        return redirect()->back()->with('error','Deleted successfully!');

    }

}
