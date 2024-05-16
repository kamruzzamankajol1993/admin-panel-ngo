<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
use Auth;
use Hash;
use DateTime;
use DateTimezone;
use DB;
use App\Models\RegistrationOfficeSarok;
use App\Models\RenewOfficeSarok;
use App\Models\NameChangeOfficeSarok;
use App\Models\FdNineOfficeSarok;
use App\Models\FdNineOneOfficeSarok;
use App\Models\FdSixOfficeSarok;
use App\Models\FdSevenOfficeSarok;
use App\Models\FcOneOfficeSarok;
use App\Models\FcTwoOfficeSarok;
use App\Models\FdThreeOfficeSarok;
use App\Models\FdFiveOfficeSarok;
use App\Models\PotrangshoDraft;


use App\Models\DuplicateCertificateOfficeSarok;
use App\Models\ExecutiveCommitteeOfficeSarok;
use App\Models\ConstitutionOfficeSarok;


class OfficeSarokController extends Controller
{
    public function store(Request $request){


        try{
            DB::beginTransaction();

       //dd($request->all());


        $request->validate([
            'subject' => 'required',
            'maindes' => 'required',

        ]);


        if($request->updateOrSubmit == 1){
            $dt = new DateTime();
            $dt->setTimezone(new DateTimezone('Asia/Dhaka'));
            $created_at = $dt->format('Y-m-d h:i:s');

            //new code during update
            $getAllData = new PotrangshoDraft();
            $getAllData->adminId = Auth::guard('admin')->user()->id;
            $getAllData->nothiId = $request->nothiId;
            $getAllData->sarokId = $request->sorkariUpdateId;
            $getAllData->noteId = $request->noteId;
            $getAllData->status = $request->status;
            $getAllData->sarok_number = $request->sarok_number;
            $getAllData->extra_text = $request->extra_text;
            $getAllData->SentStatus = 0;
            $getAllData->office_subject= $request->subject;
            $getAllData->office_sutro = $request->sutro;
            $getAllData->description =$request->maindes;
            $getAllData->created_at =$created_at;
            $getAllData->save();
            //end new code during update




        }else{



        //dd($request->all());

        $dt = new DateTime();
        $dt->setTimezone(new DateTimezone('Asia/Dhaka'));
        $created_at = $dt->format('Y-m-d h:i:s');






        if($request->statusForPotrangso == 'registration'){


            $saveNewData = new RegistrationOfficeSarok();
            $saveNewData->parent_note_regid = $request->parentIdForPotrangso;
            // $saveNewData->office_subject = $request->subject;
            // $saveNewData->office_sutro = $request->sutro;
            // $saveNewData->description =$request->maindes;
            $saveNewData->created_at =$created_at;
            $saveNewData->save();


     }elseif($request->statusForPotrangso == 'renew'){


         $saveNewData = new RenewOfficeSarok();
         $saveNewData->parent_note_for_renew_id = $request->parentIdForPotrangso;
        //  $saveNewData->office_subject = $request->subject;
        //  $saveNewData->office_sutro = $request->sutro;
        //  $saveNewData->description =$request->maindes;
         $saveNewData->created_at =$created_at;
         $saveNewData->save();



     }elseif($request->statusForPotrangso == 'nameChange'){

         $saveNewData = new NameChangeOfficeSarok();
         $saveNewData->parentnote_name_change_id = $request->parentIdForPotrangso;
        //  $saveNewData->office_subject = $request->subject;
        //  $saveNewData->office_sutro = $request->sutro;
        //  $saveNewData->description =$request->maindes;
         $saveNewData->created_at =$created_at;
         $saveNewData->save();



     }elseif($request->statusForPotrangso == 'fdNine'){

         $saveNewData = new FdNineOfficeSarok();
         $saveNewData->p_note_for_fd_nine_id = $request->parentIdForPotrangso;
        //  $saveNewData->office_subject = $request->subject;
        //  $saveNewData->office_sutro = $request->sutro;
        //  $saveNewData->description =$request->maindes;
         $saveNewData->created_at =$created_at;
         $saveNewData->save();


     }elseif($request->statusForPotrangso == 'fdNineOne'){

         $saveNewData = new FdNineOneOfficeSarok();
         $saveNewData->p_note_for_fd_nine_one_id = $request->parentIdForPotrangso;
        //  $saveNewData->office_subject = $request->subject;
        //  $saveNewData->office_sutro = $request->sutro;
        //  $saveNewData->description =$request->maindes;
         $saveNewData->created_at =$created_at;
         $saveNewData->save();

     }elseif($request->statusForPotrangso == 'fdSix'){

         $saveNewData = new FdSixOfficeSarok();
         $saveNewData->parent_note_for_fdsix_id = $request->parentIdForPotrangso;
        //  $saveNewData->office_subject = $request->subject;
        //  $saveNewData->office_sutro = $request->sutro;
        //  $saveNewData->description =$request->maindes;
         $saveNewData->created_at =$created_at;
         $saveNewData->save();

     }elseif($request->statusForPotrangso == 'fdSeven'){

            $saveNewData = new FdSevenOfficeSarok();
            $saveNewData->parent_note_for_fd_seven_id = $request->parentIdForPotrangso;
            // $saveNewData->office_subject = $request->subject;
            // $saveNewData->office_sutro = $request->sutro;
            // $saveNewData->description =$request->maindes;
            $saveNewData->created_at =$created_at;
            $saveNewData->save();


     }elseif($request->statusForPotrangso == 'fcOne'){

         $saveNewData = new FcOneOfficeSarok();
         $saveNewData->parent_note_for_fc_one_id = $request->parentIdForPotrangso;
        //  $saveNewData->office_subject = $request->subject;
        //  $saveNewData->office_sutro = $request->sutro;
        //  $saveNewData->description =$request->maindes;
         $saveNewData->created_at =$created_at;
         $saveNewData->save();

     }elseif($request->statusForPotrangso == 'fcTwo'){


         $saveNewData = new FcTwoOfficeSarok();
         $saveNewData->parent_note_for_fc_two_id = $request->parentIdForPotrangso;
            // $saveNewData->office_subject = $request->subject;
            // $saveNewData->office_sutro = $request->sutro;
            // $saveNewData->description =$request->maindes;
            $saveNewData->created_at =$created_at;
         $saveNewData->save();


     }elseif($request->statusForPotrangso == 'fdThree'){

         $saveNewData = new FdThreeOfficeSarok();
         $saveNewData->parent_note_for_fd_three_id = $request->parentIdForPotrangso;
        //  $saveNewData->office_subject = $request->subject;
        //  $saveNewData->office_sutro = $request->sutro;
        //  $saveNewData->description =$request->maindes;
         $saveNewData->created_at =$created_at;
         $saveNewData->save();




     }elseif($request->statusForPotrangso == 'fdFive'){

        $saveNewData = new FdFiveOfficeSarok();
        $saveNewData->pnote_fd_five = $request->parentIdForPotrangso;
       //  $saveNewData->office_subject = $request->subject;
       //  $saveNewData->office_sutro = $request->sutro;
       //  $saveNewData->description =$request->maindes;
        $saveNewData->created_at =$created_at;
        $saveNewData->save();




    }elseif($request->statusForPotrangso == 'duplicate'){

        $saveNewData = new DuplicateCertificateOfficeSarok();
        $saveNewData->parent_note_for_fd_three_id = $request->parentIdForPotrangso;
       //  $saveNewData->office_subject = $request->subject;
       //  $saveNewData->office_sutro = $request->sutro;
       //  $saveNewData->description =$request->maindes;
        $saveNewData->created_at =$created_at;
        $saveNewData->save();


    }elseif($request->statusForPotrangso == 'constitution'){

        $saveNewData = new ConstitutionOfficeSarok();
        $saveNewData->parent_note_for_fd_three_id = $request->parentIdForPotrangso;
       //  $saveNewData->office_subject = $request->subject;
       //  $saveNewData->office_sutro = $request->sutro;
       //  $saveNewData->description =$request->maindes;
        $saveNewData->created_at =$created_at;
        $saveNewData->save();


    }elseif($request->statusForPotrangso == 'committee'){

        $saveNewData = new ExecutiveCommitteeOfficeSarok();
        $saveNewData->parent_note_for_fd_three_id = $request->parentIdForPotrangso;
       //  $saveNewData->office_subject = $request->subject;
       //  $saveNewData->office_sutro = $request->sutro;
       //  $saveNewData->description =$request->maindes;
        $saveNewData->created_at =$created_at;
        $saveNewData->save();


    }

     $sarokId = $saveNewData->id;

     $getAllData = new PotrangshoDraft();
     $getAllData->adminId = Auth::guard('admin')->user()->id;
     $getAllData->nothiId = $request->nothiId;
     $getAllData->sarokId = $sarokId;
     $getAllData->noteId = $request->noteId;
     $getAllData->status = $request->status;
     $getAllData->sarok_number = $request->sarok_number;
     $getAllData->extra_text = $request->extra_text;
     $getAllData->SentStatus = 0;
     $getAllData->office_subject= $request->subject;
     $getAllData->office_sutro = $request->sutro;
     $getAllData->description =$request->maindes;
     $getAllData->created_at =$created_at;
     $getAllData->save();


    }
    DB::commit();
    if($request->updateOrSubmit == 1){




        if($request->receiveEnd == 1){

            return redirect()->back()->with('success','সফলভাবে সংশোধন করা হয়েছে');
        }else{
            return redirect()->back()->with('success','সফলভাবে সংশোধন করা হয়েছে');
        }







        // return redirect()->back()->with('success','সফলভাবে সংশোধন করা হয়েছে');
    }else{



        if($request->receiveEnd == 1){

            return redirect()->back()->with('success','সফলভাবে সংশোধন করা হয়েছে');
        }else{
            return redirect()->back()->with('success','সফলভাবে সংশোধন করা হয়েছে');
        }


        // if($request->receiveEnd == 1){
        //     return redirect('admin/viewChildNote/'.$request->status.'/'.$request->dakId.'/'.$request->nothiId.'/'.$request->noteId.'/'.$request->activeCode)->with('success','সফলভাবে সংরক্ষণ করা হয়েছে');
        // }else{
        // return redirect('admin/addChildNote/'.$request->status.'/'.$request->dakId.'/'.$request->nothiId.'/'.$request->noteId.'/'.$request->activeCode)->with('success','সফলভাবে সংরক্ষণ করা হয়েছে');
        // }
   // return redirect()->back()->with('success','সফলভাবে সংরক্ষণ করা হয়েছে');
    }


} catch (\Exception $e) {
    DB::rollBack();
    return redirect()->route('error_404')->with('error','some thing went wrong ');
}

    }
}
