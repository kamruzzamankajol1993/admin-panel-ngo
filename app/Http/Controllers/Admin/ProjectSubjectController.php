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
use App\Models\LeaveManagement;
use App\Models\ProjectSubject;
class ProjectSubjectController extends Controller
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


        if (is_null($this->user) || !$this->user->can('subjectView')) {
            return redirect()->route('error_404');
        }

        try{

        \LogActivity::addToLog('ProjectSubject list ');


        $projectSubjectList = ProjectSubject::orderBy('id','desc')->get();

        return view('admin.projectSubject.index',compact('projectSubjectList'));
    } catch (\Exception $e) {
        return redirect()->route('error_404')->with('error','some thing went wrong ');
    }

    }


    public function store(Request $request){

        if (is_null($this->user) || !$this->user->can('subjectAdd')) {
            return redirect()->route('error_404');
        }
        try{
            DB::beginTransaction();
        \LogActivity::addToLog('ProjectSubject store ');

        ProjectSubject::insert(
            ['name' =>$request->name]
            );


            DB::commit();
            return redirect()->back()->with('success','Created Successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('error_404')->with('error','some thing went wrong ');
        }


    }


    public function update(Request $request,$id){
        if (is_null($this->user) || !$this->user->can('subjectUpdate')) {
           return redirect()->route('error_404');
        }
        try{
            DB::beginTransaction();
        \LogActivity::addToLog('update ProjectSubject ');


        ProjectSubject::where('id', $id)
            ->update(['name' =>$request->name]);
            DB::commit();
            return redirect()->back()->with('info','Updated Successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('error_404')->with('error','some thing went wrong ');
        }
    }


    public function destroy($id)
    {

        if (is_null($this->user) || !$this->user->can('subjectDelete')) {
            return redirect()->route('error_404');
        }

        try{
            DB::beginTransaction();
        \LogActivity::addToLog('Subject delete');


        $admins = ProjectSubject::where('id',$id)->delete();


        DB::commit();
        return back()->with('error','Deleted successfully!');

    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->route('error_404')->with('error','some thing went wrong ');
    }
    }
}
