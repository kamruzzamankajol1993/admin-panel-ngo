<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NothiDetail;
use Auth;
class SendNothiController extends Controller
{
    public function index(){

//dd()
try{
        $senderNothiList = NothiDetail::where('sender',Auth::guard('admin')->user()->id)
        ->whereNull('back_nothi')
        ->where('dakType','renew')
        ->latest()->get();


        $senderNothiListRegistration = NothiDetail::where('sender',Auth::guard('admin')->user()->id)
        ->whereNull('back_nothi')
        ->where('dakType','registration')
        ->latest()->get();


        $senderNothiListfdNine = NothiDetail::where('sender',Auth::guard('admin')->user()->id)
        ->whereNull('back_nothi')

        ->where('dakType','fdNine')->latest()->get();


         $senderNothiListnameChange = NothiDetail::where('sender',Auth::guard('admin')->user()->id)
         ->whereNull('back_nothi')

        ->where('dakType','nameChange')->latest()->get();


         $senderNothiListfdNineOne = NothiDetail::where('sender',Auth::guard('admin')->user()->id)
         ->whereNull('back_nothi')

        ->where('dakType','fdNineOne')->latest()->get();




         $senderNothiListfdSix= NothiDetail::where('sender',Auth::guard('admin')->user()->id)
         ->whereNull('back_nothi')

        ->where('dakType','fdSix')->latest()->get();

         $senderNothiListfdSeven = NothiDetail::where('sender',Auth::guard('admin')->user()->id)
         ->whereNull('back_nothi')

        ->where('dakType','fdSeven')->latest()->get();


         $senderNothiListfcOne = NothiDetail::where('sender',Auth::guard('admin')->user()->id)
         ->whereNull('back_nothi')

        ->where('dakType','fcOne')->latest()->get();


         $senderNothiListfctwo = NothiDetail::where('sender',Auth::guard('admin')->user()->id)
         ->whereNull('back_nothi')

        ->where('dakType','fcTwo')->latest()->get();


         $senderNothiListfdThree = NothiDetail::where('sender',Auth::guard('admin')->user()->id)
         ->whereNull('back_nothi')

        ->where('dakType','fdThree')->latest()->get();

        $senderNothiListfdFive = NothiDetail::where('sender',Auth::guard('admin')->user()->id)
        ->whereNull('back_nothi')

       ->where('dakType','fdFive')->latest()->get();


         $senderNothiListduplicate = NothiDetail::where('sender',Auth::guard('admin')->user()->id)
         ->whereNull('back_nothi')

        ->where('dakType','duplicate')->latest()->get();


         $senderNothiListconstitution = NothiDetail::where('sender',Auth::guard('admin')->user()->id)
         ->whereNull('back_nothi')

        ->where('dakType','constitution')->latest()->get();


         $senderNothiListcommittee = NothiDetail::where('sender',Auth::guard('admin')->user()->id)
         ->whereNull('back_nothi')

        ->where('dakType','committee')->latest()->get();


            return view('admin.sendNothi.index',compact('senderNothiListfdNine',
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
            'senderNothiList',));

        } catch (\Exception $e) {
            return redirect()->route('error_404')->with('error','some thing went wrong ');
        }

    }
}
