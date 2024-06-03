<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NothiAttarct;
use App\Models\Admin;
use DB;
use Validator;
class NothiAttractController extends Controller
{
    public function attractSelfOfficerAdd(Request $request){


        $selfOfficerList = $request->selfOfficerList;
        $snothiId = $request->snothiId;
        $sstatus = $request->sstatus;


        $adminIdList = Admin::where('id',$selfOfficerList)->first();


        if(!$adminIdList){

             return $data =  0;

        }else{


           $designationName = DB::table('designation_lists')
                ->where('id',$adminIdList->designation_list_id)
                ->value('designation_name');

                $branchName = DB::table('branches')
                ->where('id',$adminIdList->branch_id)
                ->value('branch_name');



                //snoteId

               $nothiPrapok = new NothiAttarct();
               $nothiPrapok->adminId = $selfOfficerList;
               $nothiPrapok->nothiId = $snothiId;
               $nothiPrapok->nijOfficeId =  $sstatus;
               $nothiPrapok->noteId =  $request->snoteId;
               $nothiPrapok->otherOfficerName = $adminIdList->admin_name_ban;
               $nothiPrapok->otherOfficerDesignation = $designationName;
               $nothiPrapok->otherOfficerBranch =  $branchName;
               $nothiPrapok->otherOfficerEmail = $adminIdList->email;
               $nothiPrapok->otherOfficerPhone = $adminIdList->admin_mobile;
               $nothiPrapok->save();



               $nothiAttractList = NothiAttarct::where('nothiId',$request->snothiId)
               ->where('nijOfficeId',$request->sstatus)
               ->where('noteId',$request->snoteId)
               ->get();


               $data = view('admin.presentDocument.attractSelfOfficerAdd',compact('nothiAttractList'))->render();
              // return response()->json($data);

              return response()->json(['totalAttract'=>count($nothiAttractList),'data'=>$data]);


        }

   }


   public function attractSelfOfficerAjaxDelete($id)
   {
       NothiAttarct::find($id)->delete();

       return response()->json(['success'=>'User Deleted Successfully!']);
   }


   public function attractOtherOfficerAdd(Request $request){

       //dd($request->all());

       $validator = Validator::make($request->all(), [
        'organizationName' => 'required',
        'otherOfficerDesignation' => 'required',
        'otherOfficerAddress' => 'required',
    ]);
    if ($validator->passes()) {

       $nothiPrapok = new NothiAttarct();
       $nothiPrapok->organization_name = $request->organizationName;
       $nothiPrapok->nothiId = $request->snothiId;
       $nothiPrapok->nijOfficeId =  $request->sstatus;
       $nothiPrapok->noteId =  $request->snoteId;
       $nothiPrapok->otherOfficerName = $request->otherOfficerName;
       $nothiPrapok->otherOfficerDesignation = $request->otherOfficerDesignation;
       $nothiPrapok->otherOfficerBranch =  $request->otherOfficerBranch;
       $nothiPrapok->otherOfficerEmail = $request->otherOfficerEmail;
       $nothiPrapok->otherOfficerPhone = $request->otherOfficerPhone;
       $nothiPrapok->otherOfficerAddress = $request->otherOfficerAddress;
       $nothiPrapok->save();



       $nothiAttractList = NothiAttarct::where('nothiId',$request->snothiId)
       ->where('nijOfficeId',$request->sstatus)
       ->where('noteId',$request->snoteId)
       ->get();


       $data = view('admin.presentDocument.attractSelfOfficerAdd',compact('nothiAttractList'))->render();
           return response()->json(['totalAttract'=>count($nothiAttractList),'data'=>$data]);
    }

    return response()->json(['error'=>$validator->errors()]);
   }


   public function attractStatusUpdate(Request $request){

    try{
        


       NothiAttarct::where('nothiId', $request->fnothiId)
       ->where('noteId', $request->fnoteId)
       ->where('nijOfficeId', $request->fstatus)
      ->update([
          'status' => 1
       ]);

       return redirect()->back()->with('success','সফলভাবে  বাাই সম্পন্ন য়েছে');
    } catch (\Exception $e) {
       
        return redirect()->route('error_404')->with('error','some thing went wrong ');
    }

   }
}
