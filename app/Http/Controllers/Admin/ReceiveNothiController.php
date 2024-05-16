<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NothiDetail;
use Auth;
class ReceiveNothiController extends Controller
{
    public function index(){

        try{

        $senderNothiList = NothiDetail::where('receiver',Auth::guard('admin')->user()->id)->whereNull('sent_status')
        ->whereNull('list_status')->where('dakType','renew')->latest()->get();


        $senderNothiListRegistration = NothiDetail::where('receiver',Auth::guard('admin')->user()->id)
        ->whereNull('sent_status')
        ->whereNull('list_status')
        ->where('dakType','registration')->latest()->get();



        $senderNothiListfdNine = NothiDetail::where('receiver',Auth::guard('admin')->user()->id)
        ->whereNull('sent_status')
        ->whereNull('list_status')
        ->where('dakType','fdNine')->latest()->get();


         $senderNothiListnameChange = NothiDetail::where('receiver',Auth::guard('admin')->user()->id)
         ->whereNull('sent_status')
         ->whereNull('list_status')
        ->where('dakType','nameChange')->latest()->get();


         $senderNothiListfdNineOne = NothiDetail::where('receiver',Auth::guard('admin')->user()->id)
         ->whereNull('sent_status')
         ->whereNull('list_status')
        ->where('dakType','fdNineOne')->latest()->get();




         $senderNothiListfdSix= NothiDetail::where('receiver',Auth::guard('admin')->user()->id)
         ->whereNull('sent_status')
         ->whereNull('list_status')
        ->where('dakType','fdSix')->latest()->get();

         $senderNothiListfdSeven = NothiDetail::where('receiver',Auth::guard('admin')->user()->id)
         ->whereNull('sent_status')
         ->whereNull('list_status')
        ->where('dakType','fdSeven')->latest()->get();


         $senderNothiListfcOne = NothiDetail::where('receiver',Auth::guard('admin')->user()->id)
         ->whereNull('sent_status')
         ->whereNull('list_status')
        ->where('dakType','fcOne')->latest()->get();


         $senderNothiListfctwo = NothiDetail::where('receiver',Auth::guard('admin')->user()->id)
         ->whereNull('sent_status')
         ->whereNull('list_status')
        ->where('dakType','fcTwo')->latest()->get();


         $senderNothiListfdThree = NothiDetail::where('receiver',Auth::guard('admin')->user()->id)
         ->whereNull('sent_status')
         ->whereNull('list_status')
        ->where('dakType','fdThree')->latest()->get();


        $senderNothiListfdFive = NothiDetail::where('receiver',Auth::guard('admin')->user()->id)
        ->whereNull('sent_status')
        ->whereNull('list_status')
       ->where('dakType','fdFive')->latest()->get();


         $senderNothiListduplicate = NothiDetail::where('receiver',Auth::guard('admin')->user()->id)
         ->whereNull('sent_status')
         ->whereNull('list_status')
        ->where('dakType','duplicate')->latest()->get();


         $senderNothiListconstitution = NothiDetail::where('receiver',Auth::guard('admin')->user()->id)
         ->whereNull('sent_status')
         ->whereNull('list_status')
        ->where('dakType','constitution')->latest()->get();


         $senderNothiListcommittee = NothiDetail::where('receiver',Auth::guard('admin')->user()->id)
         ->whereNull('sent_status')
         ->whereNull('list_status')
        ->where('dakType','committee')->latest()->get();


            return view('admin.receiveNothi.index',compact('senderNothiListfdNine',
            'senderNothiListfdFive',
            'senderNothiListnameChange',
            'senderNothiListfdNineOne',
            'senderNothiListfdSix',

            'senderNothiListfdSeven',

            'senderNothiListfcOne',
            'senderNothiListfctwo',
            'senderNothiListfdThree',
            'senderNothiListduplicate',
            'senderNothiListconstitution',
            'senderNothiListcommittee',
            'senderNothiListRegistration',
            'senderNothiList'));

        } catch (\Exception $e) {
            return redirect()->route('error_404')->with('error','some thing went wrong ');
        }

    }
}
