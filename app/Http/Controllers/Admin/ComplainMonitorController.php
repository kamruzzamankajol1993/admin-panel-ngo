<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class ComplainMonitorController extends Controller
{
    public function allComplain(){

           $allComplainList = DB::table('complain_monitors')->latest()->get();

           return view('admin.complain_monitor.allComplain',compact('allComplainList'));
    }


    public function ongoingComplain(){

        $allComplainList = DB::table('complain_monitors')
                           ->where('status','চলমান')->latest()->get();

        return view('admin.complain_monitor.allComplain',compact('allComplainList'));
    }


    public function completeComplain(){

        $allComplainList = DB::table('complain_monitors')
                        ->where('status','সম্পন্ন')->latest()->get();

        return view('admin.complain_monitor.allComplain',compact('allComplainList'));
    }


    public function rejectedComplain(){

        $allComplainList = DB::table('complain_monitors')
                        ->where('status','বাতিল')->latest()->get();

        return view('admin.complain_monitor.allComplain',compact('allComplainList'));
    }

    public function updateComplainStatus(Request $request){


        DB::table('complain_monitors')
        ->where('id', $request->attr)
        ->update(['status' => $request->value]);

        return 1;

    }

    public function show($id){

        $allComplainList = DB::table('complain_monitors')
                        ->where('id',$id)->latest()->first();

        return view('admin.complain_monitor.show',compact('allComplainList'));
    }



    public function destroy($id){

        try{
            DB::beginTransaction();
        \LogActivity::addToLog('complain delete');


        $admins = DB::table('complain_monitors')->where('id',$id)->delete();


        DB::commit();
        return back()->with('error','Deleted successfully!');

    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->route('error_404')->with('error','some thing went wrong ');
    }
    }
}
