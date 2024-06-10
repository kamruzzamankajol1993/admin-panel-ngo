<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NothiDetail;
use Auth;
use App\Models\FormNoFourDak;
use App\Models\ParentNoteForFormNoFour;
use App\Models\FormNoFourOfficeSarok;
use App\Models\ChildNoteForFormNoFour;

use App\Models\Fd4OneFormDak;
use App\Models\ParentNoteForFdFourOneForm;
use App\Models\FdFourOneFormOfficeSarok;
use App\Models\ChildNoteForFdFourOneForm;
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

       $senderNothiListformNoFive = NothiDetail::where('sender',Auth::guard('admin')->user()->id)
        ->whereNull('back_nothi')

       ->where('dakType','formNoFive')->latest()->get();



       $senderNothiListformNoSeven = NothiDetail::where('sender',Auth::guard('admin')->user()->id)
        ->whereNull('back_nothi')->where('dakType','formNoSeven')
        ->latest()->get();

        $senderNothiListformNoFour = NothiDetail::where('sender',Auth::guard('admin')->user()->id)
        ->whereNull('back_nothi')->where('dakType','formNoFour')
        ->latest()->get();


        $senderNothiListfdFourOne = NothiDetail::where('sender',Auth::guard('admin')->user()->id)
        ->whereNull('back_nothi')->where('dakType','fdFourOneForm')
        ->latest()->get();


         $senderNothiListduplicate = NothiDetail::where('sender',Auth::guard('admin')->user()->id)
         ->whereNull('back_nothi')

        ->where('dakType','duplicate')->latest()->get();


         $senderNothiListconstitution = NothiDetail::where('sender',Auth::guard('admin')->user()->id)
         ->whereNull('back_nothi')

        ->where('dakType','constitution')->latest()->get();


         $senderNothiListcommittee = NothiDetail::where('sender',Auth::guard('admin')->user()->id)
         ->whereNull('back_nothi')

        ->where('dakType','committee')->latest()->get();


            return view('admin.sendNothi.index',compact(
                'senderNothiListformNoFour',
                'senderNothiListfdFourOne',
                'senderNothiListfdNine',
            'senderNothiListformNoSeven',
            'senderNothiListformNoFive',
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
