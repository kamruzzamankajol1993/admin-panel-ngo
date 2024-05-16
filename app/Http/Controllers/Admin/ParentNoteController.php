<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
use Auth;
use Hash;
use DB;
use App\Models\ParentNoteForFcOne;
use App\Models\ParentNoteForFcTwo;
use App\Models\ParentNoteForFdNine;
use App\Models\ParentNoteForFdNineOne;
use App\Models\ParentNoteForFdSeven;
use App\Models\ParentNoteForFdsix;
use App\Models\ParentNoteForFdThree;
use App\Models\ParentNoteForFdFive;
use App\Models\ParentNoteForNameChange;
use App\Models\ParentNoteForRegistration;
use App\Models\ParentNoteForRenew;
use App\Models\ParentNotForExecutiveCommittee;
use App\Models\ParentNoteForConstitution;
use App\Models\ParentNoteForDuplicateCertificate;
use DateTime;
use DateTimezone;
use App\Models\NoteAttachment;
class ParentNoteController extends Controller
{


    public function addParentAttachment(Request $request){


//dd($request->all());


$insertData = new NoteAttachment();
$insertData->noteId = $request->snoteId;
$insertData->status = $request->sstatus;
$insertData->nothiId = $request->snothiId;
$insertData->title = $request->name;
$insertData->link = $request->value;
$insertData->child_id = $request->lastChild;
$insertData->admin_id =Auth::guard('admin')->user()->id;
$insertData->save();

return 1;
    }



    public function addParentNote($status,$dakId,$nothiId){

        try{
        if($status == 'registration'){


            $checkParent = ParentNoteForRegistration::where('nothi_detail_id',$dakId)
            ->where('serial_number',$nothiId)
                           ->get();



        }elseif($status == 'renew'){




            $checkParent = ParentNoteForRenew::where('nothi_detail_id',$dakId)
            ->where('serial_number',$nothiId)
            ->get();



        }elseif($status == 'nameChange'){






            $checkParent = ParentNoteForNameChange::where('nothi_detail_id',$dakId)
            ->where('serial_number',$nothiId)
            ->get();



        }elseif($status == 'fdNine'){






            $checkParent = ParentNoteForFdNine::where('nothi_detail_id',$dakId)
            ->where('serial_number',$nothiId)
            ->get();

//dd($checkParent);


        }elseif($status == 'fdNineOne'){





            $checkParent = ParentNoteForFdNineOne::where('nothi_detail_id',$dakId)
            ->where('serial_number',$nothiId)
            ->get();




        }elseif($status == 'fdSix'){




            $checkParent = ParentNoteForFdsix::where('nothi_detail_id',$dakId)
            ->where('serial_number',$nothiId)
            ->get();



        }elseif($status == 'fdSeven'){





            $checkParent = ParentNoteForFdSeven::where('nothi_detail_id',$dakId)
            ->where('serial_number',$nothiId)
            ->get();



        }elseif($status == 'fcOne'){



            $checkParent = ParentNoteForFcOne::where('nothi_detail_id',$dakId)
            ->where('serial_number',$nothiId)
            ->get();




        }elseif($status == 'fcTwo'){




            $checkParent = ParentNoteForFcTwo::where('nothi_detail_id',$dakId)
            ->where('serial_number',$nothiId)
            ->get();





        }elseif($status == 'fdThree'){






            $checkParent = ParentNoteForFdThree::where('nothi_detail_id',$dakId)
            ->where('serial_number',$nothiId)
            ->get();


        }elseif($status == 'fdFive'){






            $checkParent = ParentNoteForFdFive::where('nothi_detail_id',$dakId)
            ->where('serial_number',$nothiId)
            ->get();


        }elseif($status == 'duplicate'){






            $checkParent = ParentNoteForDuplicateCertificate::where('nothi_detail_id',$dakId)
            ->where('serial_number',$nothiId)
            ->get();


        }elseif($status == 'constitution'){






            $checkParent = ParentNoteForConstitution::where('nothi_detail_id',$dakId)
            ->where('serial_number',$nothiId)
            ->get();


        }elseif($status == 'committee'){






            $checkParent = ParentNotForExecutiveCommittee::where('nothi_detail_id',$dakId)
            ->where('serial_number',$nothiId)
            ->get();


        }

        return view('admin.presentDocument.sheetAndNotes',compact('checkParent','nothiId','status','dakId'));

    } catch (\Exception $e) {
        return redirect()->route('error_404')->with('error','some thing went wrong ');
    }
    }




    public function addParentNoteFromView($status,$dakId,$nothiId){

        try{
        if($status == 'registration'){


            $checkParent = ParentNoteForRegistration::where('nothi_detail_id',$dakId)
            ->where('serial_number',$nothiId)
                           ->get();



        }elseif($status == 'renew'){




            $checkParent = ParentNoteForRenew::where('nothi_detail_id',$dakId)
            ->where('serial_number',$nothiId)
            ->get();



        }elseif($status == 'nameChange'){






            $checkParent = ParentNoteForNameChange::where('nothi_detail_id',$dakId)
            ->where('serial_number',$nothiId)
            ->get();



        }elseif($status == 'fdNine'){






            $checkParent = ParentNoteForFdNine::where('nothi_detail_id',$dakId)
            ->where('serial_number',$nothiId)
            ->get();

//dd($checkParent);


        }elseif($status == 'fdNineOne'){





            $checkParent = ParentNoteForFdNineOne::where('nothi_detail_id',$dakId)
            ->where('serial_number',$nothiId)
            ->get();




        }elseif($status == 'fdSix'){




            $checkParent = ParentNoteForFdsix::where('nothi_detail_id',$dakId)
            ->where('serial_number',$nothiId)
            ->get();



        }elseif($status == 'fdSeven'){





            $checkParent = ParentNoteForFdSeven::where('nothi_detail_id',$dakId)
            ->where('serial_number',$nothiId)
            ->get();



        }elseif($status == 'fcOne'){



            $checkParent = ParentNoteForFcOne::where('nothi_detail_id',$dakId)
            ->where('serial_number',$nothiId)
            ->get();




        }elseif($status == 'fcTwo'){




            $checkParent = ParentNoteForFcTwo::where('nothi_detail_id',$dakId)
            ->where('serial_number',$nothiId)
            ->get();





        }elseif($status == 'fdThree'){






            $checkParent = ParentNoteForFdThree::where('nothi_detail_id',$dakId)
            ->where('serial_number',$nothiId)
            ->get();


        }elseif($status == 'fdFive'){






            $checkParent = ParentNoteForFdFive::where('nothi_detail_id',$dakId)
            ->where('serial_number',$nothiId)
            ->get();


        }elseif($status == 'duplicate'){






            $checkParent = ParentNoteForDuplicateCertificate::where('nothi_detail_id',$dakId)
            ->where('serial_number',$nothiId)
            ->get();


        }elseif($status == 'constitution'){






            $checkParent = ParentNoteForConstitution::where('nothi_detail_id',$dakId)
            ->where('serial_number',$nothiId)
            ->get();


        }elseif($status == 'committee'){






            $checkParent = ParentNotForExecutiveCommittee::where('nothi_detail_id',$dakId)
            ->where('serial_number',$nothiId)
            ->get();


        }

        return view('admin.presentDocument.addParentNoteFromView',compact('checkParent','nothiId','status','dakId'));
    } catch (\Exception $e) {
        return redirect()->route('error_404')->with('error','some thing went wrong ');
    }

    }


    public function storeDataFromSenderView(Request $request){


        $dt = new DateTime();
       $dt->setTimezone(new DateTimezone('Asia/Dhaka'));
       $created_at = $dt->format('Y-m-d h:i:s');
       try{
        DB::beginTransaction();

       if($request->status == 'registration'){


           $saveNewData = new ParentNoteForRegistration();
           $saveNewData->nothi_detail_id = $request->dakId;
           $saveNewData->serial_number = $request->nothiId;
           $saveNewData->subject = $request->subject;
           $saveNewData->name ='নোট';
           $saveNewData->created_at =$created_at;
           $saveNewData->save();


           $totalCount = ParentNoteForRegistration::count();
            $pId = $saveNewData->id;

    }elseif($request->status == 'renew'){


        $saveNewData = new ParentNoteForRenew();
        $saveNewData->nothi_detail_id  = $request->dakId;
        $saveNewData->serial_number = $request->nothiId;
        $saveNewData->subject = $request->subject;
        $saveNewData->name ='নোট';
        $saveNewData->created_at =$created_at;
        $saveNewData->save();


        $totalCount = ParentNoteForRenew::count();
            $pId = $saveNewData->id;



    }elseif($request->status == 'nameChange'){

        $saveNewData = new ParentNoteForNameChange();
        $saveNewData->nothi_detail_id = $request->dakId;
        $saveNewData->serial_number = $request->nothiId;
        $saveNewData->subject = $request->subject;
        $saveNewData->name ='নোট';
        $saveNewData->created_at =$created_at;
        $saveNewData->save();


        $totalCount = ParentNoteForNameChange::count();
            $pId = $saveNewData->id;



    }elseif($request->status == 'fdNine'){

        $saveNewData = new ParentNoteForFdNine();
        $saveNewData->nothi_detail_id = $request->dakId;
        $saveNewData->serial_number = $request->nothiId;
        $saveNewData->subject = $request->subject;
        $saveNewData->name ='নোট';
        $saveNewData->created_at =$created_at;
        $saveNewData->save();

        $totalCount = ParentNoteForFdNine::where('nothi_detail_id',$request->dakId)
        ->where('serial_number',$request->nothiId)->count();
            $pId = $saveNewData->id;


    }elseif($request->status == 'fdNineOne'){

        $saveNewData = new ParentNoteForFdNineOne();
        $saveNewData->nothi_detail_id = $request->dakId;
        $saveNewData->serial_number = $request->nothiId;
        $saveNewData->subject = $request->subject;
        $saveNewData->name ='নোট';
        $saveNewData->created_at =$created_at;
        $saveNewData->save();

        $totalCount = ParentNoteForFdNineOne::where('nothi_detail_id',$request->dakId)
        ->where('serial_number',$request->nothiId)->count();
            $pId = $saveNewData->id;

    }elseif($request->status == 'fdSix'){

        $saveNewData = new ParentNoteForFdsix();
        $saveNewData->nothi_detail_id = $request->dakId;
        $saveNewData->serial_number = $request->nothiId;
        $saveNewData->subject = $request->subject;
        $saveNewData->name ='নোট';
        $saveNewData->created_at =$created_at;
        $saveNewData->save();

        $totalCount = ParentNoteForFdsix::where('nothi_detail_id',$request->dakId)
        ->where('serial_number',$request->nothiId)->count();
            $pId = $saveNewData->id;

    }elseif($request->status == 'fdSeven'){

           $saveNewData = new ParentNoteForFdSeven();
           $saveNewData->nothi_detail_id = $request->dakId;
           $saveNewData->serial_number = $request->nothiId;
           $saveNewData->subject = $request->subject;
           $saveNewData->name ='নোট';
           $saveNewData->created_at =$created_at;
           $saveNewData->save();


           $totalCount = ParentNoteForFdSeven::where('nothi_detail_id',$request->dakId)
           ->where('serial_number',$request->nothiId)->count();
            $pId = $saveNewData->id;


    }elseif($request->status == 'fcOne'){

        $saveNewData = new ParentNoteForFcOne();
        $saveNewData->nothi_detail_id = $request->dakId;
        $saveNewData->serial_number = $request->nothiId;
        $saveNewData->subject = $request->subject;
        $saveNewData->name ='নোট';
        $saveNewData->created_at =$created_at;
        $saveNewData->save();

        $totalCount = ParentNoteForFcOne::where('nothi_detail_id',$request->dakId)
        ->where('serial_number',$request->nothiId)->count();
            $pId = $saveNewData->id;

    }elseif($request->status == 'fcTwo'){


        $saveNewData = new ParentNoteForFcTwo();
        $saveNewData->nothi_detail_id = $request->dakId;
        $saveNewData->serial_number = $request->nothiId;
        $saveNewData->subject = $request->subject;
        $saveNewData->name ='নোট';
        $saveNewData->created_at =$created_at;
        $saveNewData->save();


        $totalCount = ParentNoteForFcTwo::where('nothi_detail_id',$request->dakId)
        ->where('serial_number',$request->nothiId)->count();
            $pId = $saveNewData->id;


    }elseif($request->status == 'fdThree'){

        $saveNewData = new ParentNoteForFdThree();
        $saveNewData->nothi_detail_id = $request->dakId;
        $saveNewData->serial_number = $request->nothiId;
        $saveNewData->subject = $request->subject;
        $saveNewData->name ='নোট';
        $saveNewData->created_at =$created_at;
        $saveNewData->save();

        $totalCount = ParentNoteForFdThree::where('nothi_detail_id',$request->dakId)
        ->where('serial_number',$request->nothiId)->count();
            $pId = $saveNewData->id;


    }elseif($request->status == 'fdFive'){

        $saveNewData = new ParentNoteForFdFive();
        $saveNewData->nothi_detail_id = $request->dakId;
        $saveNewData->serial_number = $request->nothiId;
        $saveNewData->subject = $request->subject;
        $saveNewData->name ='নোট';
        $saveNewData->created_at =$created_at;
        $saveNewData->save();

        $totalCount = ParentNoteForFdFive::where('nothi_detail_id',$request->dakId)
        ->where('serial_number',$request->nothiId)->count();
            $pId = $saveNewData->id;


    }elseif($request->status == 'duplicate'){




        $saveNewData = new ParentNoteForDuplicateCertificate();
        $saveNewData->nothi_detail_id = $request->dakId;
        $saveNewData->serial_number = $request->nothiId;
        $saveNewData->subject = $request->subject;
        $saveNewData->name ='নোট';
        $saveNewData->created_at =$created_at;
        $saveNewData->save();

        $totalCount = ParentNoteForDuplicateCertificate::where('nothi_detail_id',$request->dakId)
        ->where('serial_number',$request->nothiId)->count();
            $pId = $saveNewData->id;


    }elseif($request->status == 'constitution'){

        $saveNewData = new ParentNoteForConstitution();
        $saveNewData->nothi_detail_id = $request->dakId;
        $saveNewData->serial_number = $request->nothiId;
        $saveNewData->subject = $request->subject;
        $saveNewData->name ='নোট';
        $saveNewData->created_at =$created_at;
        $saveNewData->save();

        $totalCount = ParentNoteForConstitution::where('nothi_detail_id',$request->dakId)
        ->where('serial_number',$request->nothiId)->count();
            $pId = $saveNewData->id;


    }elseif($request->status == 'committee'){

        $saveNewData = new ParentNotForExecutiveCommittee();
        $saveNewData->nothi_detail_id = $request->dakId;
        $saveNewData->serial_number = $request->nothiId;
        $saveNewData->subject = $request->subject;
        $saveNewData->name ='নোট';
        $saveNewData->created_at =$created_at;
        $saveNewData->save();

        $totalCount = ParentNotForExecutiveCommittee::where('nothi_detail_id',$request->dakId)
        ->where('serial_number',$request->nothiId)->count();
            $pId = $saveNewData->id;


    }



    //addChildNote/{status}/{parentId}/{id}/{activeCode}
    DB::commit();
    return redirect('admin/viewChildNote/'.$request->status.'/'.$request->dakId.'/'.$request->nothiId.'/'.$pId.'/'.$totalCount)->with('success','সফলভাবে সংরক্ষণ করা হয়েছে');
    // return redirect('admin/addParentNoteFromView/'.$request->status.'/'.$request->dakId.'/'.$request->nothiId)->with('success','সফলভাবে সংরক্ষণ করা হয়েছে');
} catch (\Exception $e) {
    DB::rollBack();
    return redirect()->route('error_404')->with('error','some thing went wrong ');
}


    }


    public function store(Request $request){

       //dd($request->all());


       $dt = new DateTime();
       $dt->setTimezone(new DateTimezone('Asia/Dhaka'));
       $created_at = $dt->format('Y-m-d h:i:s');
       try{
        DB::beginTransaction();

       if($request->status == 'registration'){


           $saveNewData = new ParentNoteForRegistration();
           $saveNewData->nothi_detail_id = $request->dakId;
           $saveNewData->serial_number = $request->nothiId;
           $saveNewData->subject = $request->subject;
           $saveNewData->name ='নোট';
           $saveNewData->created_at =$created_at;
           $saveNewData->save();


           $totalCount = ParentNoteForRegistration::count();
            $pId = $saveNewData->id;

    }elseif($request->status == 'renew'){


        $saveNewData = new ParentNoteForRenew();
        $saveNewData->nothi_detail_id  = $request->dakId;
        $saveNewData->serial_number = $request->nothiId;
        $saveNewData->subject = $request->subject;
        $saveNewData->name ='নোট';
        $saveNewData->created_at =$created_at;
        $saveNewData->save();


        $totalCount = ParentNoteForRenew::count();
            $pId = $saveNewData->id;



    }elseif($request->status == 'nameChange'){

        $saveNewData = new ParentNoteForNameChange();
        $saveNewData->nothi_detail_id = $request->dakId;
        $saveNewData->serial_number = $request->nothiId;
        $saveNewData->subject = $request->subject;
        $saveNewData->name ='নোট';
        $saveNewData->created_at =$created_at;
        $saveNewData->save();


        $totalCount = ParentNoteForNameChange::count();
            $pId = $saveNewData->id;



    }elseif($request->status == 'fdNine'){

        $saveNewData = new ParentNoteForFdNine();
        $saveNewData->nothi_detail_id = $request->dakId;
        $saveNewData->serial_number = $request->nothiId;
        $saveNewData->subject = $request->subject;
        $saveNewData->name ='নোট';
        $saveNewData->created_at =$created_at;
        $saveNewData->save();

        $totalCount = ParentNoteForFdNine::where('nothi_detail_id',$request->dakId)
        ->where('serial_number',$request->nothiId)->count();
            $pId = $saveNewData->id;


    }elseif($request->status == 'fdNineOne'){

        $saveNewData = new ParentNoteForFdNineOne();
        $saveNewData->nothi_detail_id = $request->dakId;
        $saveNewData->serial_number = $request->nothiId;
        $saveNewData->subject = $request->subject;
        $saveNewData->name ='নোট';
        $saveNewData->created_at =$created_at;
        $saveNewData->save();

        $totalCount = ParentNoteForFdNineOne::where('nothi_detail_id',$request->dakId)
        ->where('serial_number',$request->nothiId)->count();
            $pId = $saveNewData->id;

    }elseif($request->status == 'fdSix'){

        $saveNewData = new ParentNoteForFdsix();
        $saveNewData->nothi_detail_id = $request->dakId;
        $saveNewData->serial_number = $request->nothiId;
        $saveNewData->subject = $request->subject;
        $saveNewData->name ='নোট';
        $saveNewData->created_at =$created_at;
        $saveNewData->save();

        $totalCount = ParentNoteForFdsix::where('nothi_detail_id',$request->dakId)
        ->where('serial_number',$request->nothiId)->count();
            $pId = $saveNewData->id;

    }elseif($request->status == 'fdSeven'){

           $saveNewData = new ParentNoteForFdSeven();
           $saveNewData->nothi_detail_id = $request->dakId;
           $saveNewData->serial_number = $request->nothiId;
           $saveNewData->subject = $request->subject;
           $saveNewData->name ='নোট';
           $saveNewData->created_at =$created_at;
           $saveNewData->save();


           $totalCount = ParentNoteForFdSeven::where('nothi_detail_id',$request->dakId)
           ->where('serial_number',$request->nothiId)->count();
            $pId = $saveNewData->id;


    }elseif($request->status == 'fcOne'){

        $saveNewData = new ParentNoteForFcOne();
        $saveNewData->nothi_detail_id = $request->dakId;
        $saveNewData->serial_number = $request->nothiId;
        $saveNewData->subject = $request->subject;
        $saveNewData->name ='নোট';
        $saveNewData->created_at =$created_at;
        $saveNewData->save();

        $totalCount = ParentNoteForFcOne::where('nothi_detail_id',$request->dakId)
        ->where('serial_number',$request->nothiId)->count();
            $pId = $saveNewData->id;

    }elseif($request->status == 'fcTwo'){


        $saveNewData = new ParentNoteForFcTwo();
        $saveNewData->nothi_detail_id = $request->dakId;
        $saveNewData->serial_number = $request->nothiId;
        $saveNewData->subject = $request->subject;
        $saveNewData->name ='নোট';
        $saveNewData->created_at =$created_at;
        $saveNewData->save();


        $totalCount = ParentNoteForFcTwo::where('nothi_detail_id',$request->dakId)
        ->where('serial_number',$request->nothiId)->count();
            $pId = $saveNewData->id;


    }elseif($request->status == 'fdThree'){

        $saveNewData = new ParentNoteForFdThree();
        $saveNewData->nothi_detail_id = $request->dakId;
        $saveNewData->serial_number = $request->nothiId;
        $saveNewData->subject = $request->subject;
        $saveNewData->name ='নোট';
        $saveNewData->created_at =$created_at;
        $saveNewData->save();

        $totalCount = ParentNoteForFdThree::where('nothi_detail_id',$request->dakId)
        ->where('serial_number',$request->nothiId)->count();
            $pId = $saveNewData->id;


    }elseif($request->status == 'fdFive'){

        $saveNewData = new ParentNoteForFdFive();
        $saveNewData->nothi_detail_id = $request->dakId;
        $saveNewData->serial_number = $request->nothiId;
        $saveNewData->subject = $request->subject;
        $saveNewData->name ='নোট';
        $saveNewData->created_at =$created_at;
        $saveNewData->save();

        $totalCount = ParentNoteForFdFive::where('nothi_detail_id',$request->dakId)
        ->where('serial_number',$request->nothiId)->count();
            $pId = $saveNewData->id;


    }elseif($request->status == 'duplicate'){



        $saveNewData = new ParentNoteForDuplicateCertificate();
        $saveNewData->nothi_detail_id = $request->dakId;
        $saveNewData->serial_number = $request->nothiId;
        $saveNewData->subject = $request->subject;
        $saveNewData->name ='নোট';
        $saveNewData->created_at =$created_at;
        $saveNewData->save();

        $totalCount = ParentNoteForDuplicateCertificate::where('nothi_detail_id',$request->dakId)
        ->where('serial_number',$request->nothiId)->count();
            $pId = $saveNewData->id;


    }elseif($request->status == 'constitution'){

        $saveNewData = new ParentNoteForConstitution();
        $saveNewData->nothi_detail_id = $request->dakId;
        $saveNewData->serial_number = $request->nothiId;
        $saveNewData->subject = $request->subject;
        $saveNewData->name ='নোট';
        $saveNewData->created_at =$created_at;
        $saveNewData->save();

        $totalCount = ParentNoteForConstitution::where('nothi_detail_id',$request->dakId)
        ->where('serial_number',$request->nothiId)->count();
            $pId = $saveNewData->id;


    }elseif($request->status == 'committee'){

        $saveNewData = new ParentNotForExecutiveCommittee();
        $saveNewData->nothi_detail_id = $request->dakId;
        $saveNewData->serial_number = $request->nothiId;
        $saveNewData->subject = $request->subject;
        $saveNewData->name ='নোট';
        $saveNewData->created_at =$created_at;
        $saveNewData->save();

        $totalCount = ParentNotForExecutiveCommittee::where('nothi_detail_id',$request->dakId)
        ->where('serial_number',$request->nothiId)->count();
            $pId = $saveNewData->id;


    }



    //addChildNote/{status}/{parentId}/{id}/{activeCode}

    DB::commit();
    return redirect('admin/addChildNote/'.$request->status.'/'.$request->dakId.'/'.$request->nothiId.'/'.$pId.'/'.$totalCount)->with('success','সফলভাবে সংরক্ষণ করা হয়েছে');
} catch (\Exception $e) {
    DB::rollBack();
    return redirect()->route('error_404')->with('error','some thing went wrong ');
}

    }
}
