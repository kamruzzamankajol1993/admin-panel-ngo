<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Admin;
use App\Models\AssaignTask;
use Image;
use Auth;
use Illuminate\Support\Str;
use Mail;
use DB;
use PDF;
use Carbon\Carbon;
use Response;
use App\Models\LeaveManagement;
class LeaveManagementController extends Controller
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


        if (is_null($this->user) || !$this->user->can('leaveView')) {
            return redirect()->route('error_404');
        }

        try{
               \LogActivity::addToLog('All Leave list ');


          $leaveLists = LeaveManagement::orderBy('id','desc')->get();

          return view('admin.leaveList.index',compact('leaveLists'));

        } catch (\Exception $e) {

            return redirect()->route('error_404')->with('error','some thing went wrong ');
        }

    }


    public function sentApplication(){


        if (is_null($this->user) || !$this->user->can('sentApplication')) {
            return redirect()->route('error_404');
        }

        try{
               \LogActivity::addToLog('sentApplication list ');


          $leaveLists = LeaveManagement::where('created_by',Auth::guard('admin')->user()->id)
          ->orderBy('id','desc')->get();

          return view('admin.leaveList.index',compact('leaveLists'));

        } catch (\Exception $e) {

            return redirect()->route('error_404')->with('error','some thing went wrong ');
        }

    }


    public function receivedApplication(){


        if (is_null($this->user) || !$this->user->can('receivedApplication')) {
            return redirect()->route('error_404');
        }

        try{
               \LogActivity::addToLog('receivedApplication list ');


          $leaveLists = LeaveManagement::where('to_admin',Auth::guard('admin')->user()->id)
          ->orderBy('id','desc')->get();

          return view('admin.leaveList.index',compact('leaveLists'));

        } catch (\Exception $e) {

            return redirect()->route('error_404')->with('error','some thing went wrong ');
        }

    }


    public function create(){


        if (is_null($this->user) || !$this->user->can('leaveAdd')) {
            return redirect()->route('error_404');
        }

        try{
               \LogActivity::addToLog('create leave of apllication');


          $adminList = Admin::where('id','!=',1)->orderBy('id','asc')->get();

          return view('admin.leaveList.create',compact('adminList'));

        } catch (\Exception $e) {

            return redirect()->route('error_404')->with('error','some thing went wrong ');
        }

    }



    public function edit($id){


        if (is_null($this->user) || !$this->user->can('leaveUpdate')) {
            return redirect()->route('error_404');
        }

        try{
               \LogActivity::addToLog('Application Edit');


          $leavedetail = LeaveManagement::find($id);
          $adminList = Admin::where('id','!=',1)->orderBy('id','asc')->get();
          return view('admin.leaveList.edit',compact('leavedetail','adminList'));

        } catch (\Exception $e) {

            return redirect()->route('error_404')->with('error','some thing went wrong ');
        }

    }


    public function sentApplicationEdit($id){


        if (is_null($this->user) || !$this->user->can('leaveUpdate')) {
            return redirect()->route('error_404');
        }

        try{
               \LogActivity::addToLog('Application Edit');


          $leavedetail = LeaveManagement::find($id);
          $adminList = Admin::where('id','!=',1)->orderBy('id','asc')->get();
          return view('admin.leaveList.edit',compact('leavedetail','adminList'));

        } catch (\Exception $e) {

            return redirect()->route('error_404')->with('error','some thing went wrong ');
        }


    }


    public function receivedApplicationEdit($id){



        if (is_null($this->user) || !$this->user->can('leaveUpdate')) {
            return redirect()->route('error_404');
        }

        try{
               \LogActivity::addToLog('Application Edit');


          $leavedetail = LeaveManagement::find($id);
          $adminList = Admin::where('id','!=',1)->orderBy('id','asc')->get();
          return view('admin.leaveList.edit',compact('leavedetail','adminList'));

        } catch (\Exception $e) {

            return redirect()->route('error_404')->with('error','some thing went wrong ');
        }


    }


    public function show($id){


        if (is_null($this->user) || !$this->user->can('leaveUpdate')) {
            return redirect()->route('error_404');
        }

        try{
               \LogActivity::addToLog('Application Edit');


          $leavedetail = LeaveManagement::find($id);
          $adminLists = Admin::where('id','!=',1)->orderBy('id','asc')->get();
          return view('admin.leaveList.show',compact('leavedetail','adminLists'));

        } catch (\Exception $e) {

            return redirect()->route('error_404')->with('error','some thing went wrong ');
        }

    }


    public function store(Request $request){

        if (is_null($this->user) || !$this->user->can('leaveAdd')) {
            return redirect()->route('error_404');
        }

            $request->validate([
                'to_admin' => 'required',
                'applicate_date' => 'required',
                'subject' => 'required',
                'body' => 'required',
            ]);


              try{
                DB::beginTransaction();

              \LogActivity::addToLog('Leave Application store ');



                //LeaveManagement::create($data);


                $leaveManagement = new LeaveManagement();
                $leaveManagement->to_admin = $request->to_admin;
                $leaveManagement->applicate_date = $request->applicate_date;
                $leaveManagement->subject  = $request->subject;
                $leaveManagement->body  = $request->body;
                $leaveManagement->created_by  = Auth::guard('admin')->user()->id;
                $leaveManagement->status='Pending';
                $leaveManagement->save();

             DB::commit();

            return redirect()->route('sentApplication')->with('success','Added successfully!');

            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->route('error_404')->with('error','some thing went wrong ');
            }


    }



    public function update(Request $request,$id){

        if (is_null($this->user) || !$this->user->can('leaveUpdate')) {

                return redirect()->route('error_404');
        }
            try{
                DB::beginTransaction();
            \LogActivity::addToLog('leave Application update ');


            //dd($request->all());

            $leave = LeaveManagement::findOrFail($id);

            $input = $request->all();

            $leave->fill($input)->save();
            DB::commit();


            if($request->route_id == 1){

                return redirect()->route('sentApplication')->with('success','Updated successfully!');

            }elseif($request->route_id == 2){

                return redirect()->route('receivedApplication')->with('success','Updated successfully!');

            }else{

                return redirect()->route('leaveManagement.index')->with('success','Updated successfully!');

            }



            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->route('error_404')->with('error','some thing went wrong ');
            }

    }


    public function destroy($id){

        if (is_null($this->user) || !$this->user->can('leaveDelete')) {

           return redirect()->route('error_404');
        }
        try{
         DB::beginTransaction();
        \LogActivity::addToLog('leave delete ');


        LeaveManagement::destroy($id);
        DB::commit();
        return redirect()->back()->with('error','Deleted successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('error_404')->with('error','some thing went wrong ');
        }
    }
}
