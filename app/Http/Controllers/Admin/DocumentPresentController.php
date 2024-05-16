<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Image;
use Auth;
use Hash;
use Illuminate\Support\Str;
use Mail;
use DB;
use PDF;
use Carbon\Carbon;
use Response;
use App\Models\Branch;
use App\Models\ForwardingLetterOnulipi;
use App\Models\NothiPermission;
use App\Models\DakDetail;
use App\Models\NgoFDNineDak;
use App\Models\NgoFDNineOneDak;
use App\Models\NgoNameChangeDak;
use App\Models\NgoRenewDak;
use App\Models\NgoFdSixDak;
use App\Models\NgoFdSevenDak;
use App\Models\FcOneDak;
use App\Models\FcTwoDak;
use App\Models\NgoRegistrationDak;
use App\Models\DesignationList;
use App\Models\DesignationStep;
use App\Models\AdminDesignationHistory;
use App\Models\FdThreeDak;
use App\Models\DocumentType;
use App\Models\NothiList;


use App\Models\ChildNoteForFcOne;
use App\Models\ChildNoteForFcTwo;
use App\Models\ChildNoteForFdNine;
use App\Models\ChildNoteForFdNineOne;
use App\Models\ChildNoteForFdSeven;
use App\Models\ChildNoteForFdSix;
use App\Models\ChildNoteForFdThree;
use App\Models\ChildNoteForNameChange;
use App\Models\ChildNoteForRegistration;
use App\Models\ChildNoteForRenew;

use App\Models\ParentNoteForFcOne;
use App\Models\ParentNoteForFcTwo;
use App\Models\ParentNoteForFdNine;
use App\Models\ParentNoteForFdNineOne;
use App\Models\ParentNoteForFdSeven;
use App\Models\ParentNoteForFdsix;
use App\Models\ParentNoteForFdThree;
use App\Models\ParentNoteForNameChange;
use App\Models\ParentNoteForRegistration;
use App\Models\ParentNoteForRenew;

use App\Models\ParentNotForExecutiveCommittee;
use App\Models\ParentNoteForConstitution;
use App\Models\ParentNoteForDuplicateCertificate;
use App\Http\Controllers\Admin\CommonController;

class DocumentPresentController extends Controller
{


    public function searchResultForDak(Request $request){


        $dakId = $request->result;
        $status = $request->status;

//dd($request->main_value);

        $searchResult = NothiList::where('document_branch', 'LIKE', '%'.$request->main_value.'%')
        ->orWhere('document_type_id', 'LIKE', '%'.$request->main_value.'%')
        ->orWhere('document_number', 'LIKE',  '%'.$request->main_value.'%')
        ->orWhere('document_year', 'LIKE',  '%'.$request->main_value.'%')
        ->orWhere('document_class', 'LIKE',  '%'.$request->main_value.'%')
        ->orWhere('document_subject', 'LIKE',  '%'.$request->main_value.'%')->get();


        //dd($searchResult);

        $data = view('admin.presentDocument.searchResultForDak',compact('searchResult','dakId','status'))->render();


        return response()->json($data);



    }


    public function create(){
try{
        $documentTypeList = DocumentType::latest()->get();

    } catch (\Exception $e) {
        return redirect()->route('error_404')->with('error','some thing went wrong ');
    }
         return view('admin.presentDocument.create',compact('documentTypeList'));

     }



    public function presentDocument($status, $id){
try{
       $documentTypeList = DocumentType::latest()->get();

    } catch (\Exception $e) {
        return redirect()->route('error_404')->with('error','some thing went wrong ');
    }
        return view('admin.presentDocument.index',compact('status','id','documentTypeList'));

    }


    public function sheetAndNotes($status,$nothiId,$id){

try{
        if($status == 'registration'){


            $checkParent = ParentNoteForRegistration::where('registration_doc_id',$id)
                           ->get();



        }elseif($status == 'renew'){




            $checkParent = ParentNoteForRenew::where('renew_doc_present_id',$id)
            ->get();



        }elseif($status == 'nameChange'){






            $checkParent = ParentNoteForNameChange::where('name_chane_doc_present_id',$id)
            ->get();



        }elseif($status == 'fdNine'){






            $checkParent = ParentNoteForFdNine::where('fd_nine_doc_present_id',$id)
            ->get();

//dd($checkParent);


        }elseif($status == 'fdNineOne'){





            $checkParent = ParentNoteForFdNineOne::where('fd_nine_one_doc_present_id',$id)
            ->get();




        }elseif($status == 'fdSix'){




            $checkParent = ParentNoteForFdsix::where('fd_six_doc_present_id',$id)
            ->get();



        }elseif($status == 'fdSeven'){





            $checkParent = ParentNoteForFdSeven::where('fd_seven_doc_present_id',$id)
            ->get();



        }elseif($status == 'fcOne'){



            $checkParent = ParentNoteForFcOne::where('fc_one_doc_present_id',$id)
            ->get();




        }elseif($status == 'fcTwo'){




            $checkParent = ParentNoteForFcTwo::where('fc_two_doc_present_id',$id)
            ->get();





        }elseif($status == 'fdThree'){






            $checkParent = ParentNoteForFdThree::where('fd_three_doc_present_id',$id)
            ->get();


        }

        return view('admin.presentDocument.sheetAndNotes',compact('checkParent','nothiId','status','id'));

    } catch (\Exception $e) {
        return redirect()->route('error_404')->with('error','some thing went wrong ');
    }
    }


    public function docTypeCode(Request $request){

        $documentTypeList = DocumentType::where('id',$request->docId)->value('code_type');

        return $documentTypeList;

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        try{
        $nothiList = NothiList::latest()->get();


        //for designation

        $totalBranch = Branch::where('id','!=',1)->count();
        $totalDesignation = DesignationList::where('id','!=',1)->count();
        $totaluser = Admin::where('id','!=',1)->count();


         $totalDesignationWorking = AdminDesignationHistory::count();

        $totalDesignationId = AdminDesignationHistory::select('designation_list_id')->get();


        $convert_name_title = $totalDesignationId->implode("designation_list_id", " ");
        $separated_data_title = explode(" ", $convert_name_title);


      $totalEmptyDesignation = DesignationList::where('id','!=',1)->whereNotIn('id', $separated_data_title )->count();

        //dd($totalEmptyDesignation);

        $totalBranchList = Branch::where('id','!=',1)->orderBy('branch_step','asc')->get();

        //for designation



        return view('admin.presentDocument.index',compact('nothiList','totalBranchList','totalEmptyDesignation','totalBranch','totalDesignation','totaluser','totalDesignationWorking'));

    } catch (\Exception $e) {
        return redirect()->route('error_404')->with('error','some thing went wrong ');
    }
    }

    /**
     * Show the form for creating a new resource.
     */


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


//dd($request->all());

        $this->validate($request,[
            'document_branch' => 'required',
            'document_type_id' => 'required',
            'document_number' => 'required',
            'document_year' => 'required',
            'document_class' => 'required',
            'document_subject' => 'required'
        ]);


        try{
            DB::beginTransaction();

        $branchCode = DB::table('branches')
        ->where('id',Auth::guard('admin')->user()->branch_id)
        ->value('branch_code');


$lastNothiSerialNumber = DB::table('nothi_lists')
                ->orderBy('id','desc')->value('document_serial_number');
$convertNumber = intval($lastNothiSerialNumber)+1;
$finalSerialNumber = CommonController::englishToBangla(str_pad($convertNumber, 3, '0', STR_PAD_LEFT));

$main_sarok_number = '০৩.০৭.২৬৬৬.'.$branchCode.'.'.$request->document_number.$finalSerialNumber.'.'.$request->document_year;


$finalSarokNumber = CommonController::englishToBangla($main_sarok_number);

//dd($finalSarokNumber);

                $documentType = new NothiList();
                $documentType->document_branch =$request->document_branch;
                $documentType->document_type_id =$request->document_type_id;
                $documentType->document_number =$request->document_number;
                $documentType->document_year =$request->document_year;
                $documentType->document_class =$request->document_class;
                $documentType->document_subject =$request->document_subject;
                $documentType->document_serial_number =$request->document_serial_number;
                $documentType->main_sarok_number =$finalSarokNumber;
                $documentType->save();


                $mainId = $documentType->id;

                DB::commit();
        if($request->buttonValue == 'নথি অনুমতি'){


            return redirect()->route('givePermissionToNothi',$mainId)->with('success','সফলভাবে সংরক্ষণ করা হয়েছে');

        }else{

        return redirect()->route('documentPresent.index')->with('success','সফলভাবে সংরক্ষণ করা হয়েছে');
    }

} catch (\Exception $e) {
    DB::rollBack();
    return redirect()->route('error_404')->with('error','some thing went wrong ');
}
}



public function givePermissionToNothi($id){

    try{

    \LogActivity::addToLog('nothi permission.');

    $id = $id;

     $totalBranch = Branch::where('id','!=',1)->count();
     $totalDesignation = DesignationList::where('id','!=',1)->count();
     $totaluser = Admin::where('id','!=',1)->count();


      $totalDesignationWorking = AdminDesignationHistory::count();

     $totalDesignationId = AdminDesignationHistory::select('designation_list_id')->get();


     $convert_name_title = $totalDesignationId->implode("designation_list_id", " ");
     $separated_data_title = explode(" ", $convert_name_title);


   $totalEmptyDesignation = DesignationList::where('id','!=',1)->whereNotIn('id', $separated_data_title )->count();

     //dd($totalEmptyDesignation);

     $totalBranchList = Branch::where('id','!=',1)->orderBy('branch_step','asc')->get();

     return view('admin.presentDocument.givePermissionToNothi',compact('id','totalBranchList','totalEmptyDesignation','totalBranch','totalDesignation','totaluser','totalDesignationWorking'));

    } catch (\Exception $e) {
        return redirect()->route('error_404')->with('error','some thing went wrong ');
    }
}



public function savePermissionNothi(Request $request){

    //dd($request->all());

    \LogActivity::addToLog('add dak detail.');

         $number=count($request->admin_id);



            if($number >0){
                for($i=0;$i<$number;$i++){

                     $branchId = DB::table('admins')
                     ->where('id',$request->admin_id[$i])
                     ->value('branch_id');


                     $designationId= DB::table('admins')
                     ->where('id',$request->admin_id[$i])
                     ->value('designation_list_id');


                 $regDakData = new NothiPermission();
                 $regDakData->adminId = $request->admin_id[$i];
                 $regDakData->nothId =$request->main_id;
                 $regDakData->branchId =$branchId;
                 $regDakData->designationId =$designationId;
                 $regDakData->save();

                }


            }


            $data =route('documentPresent.index');


            return response()->json($data);


            //return redirect()->route('documentPresent.index')->with('success','সফলভাবে সংরক্ষণ করা হয়েছে');

}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }



    public function deleteBrachFromEdit(Request $request){


         $branchId = $request->branchId;
         $nothiId = $request->nothiId;



         $delete = NothiPermission::where('branchId',$branchId)->delete();

         $data = view('admin.presentDocument.deleteBrachFromEdit',compact('nothiId'))->render();


         return response()->json($data);

    }



    public function deleteAdminFromEdit(Request $request){
        $madminId = $request->madminId;
        $nothiId = $request->nothiId;


        $delete = NothiPermission::where('nothId',$nothiId)
         ->where('adminId',$madminId)->delete();


         $data = view('admin.presentDocument.deleteBrachFromEdit',compact('nothiId'))->render();


         return response()->json($data);


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        try{
        $documentTypeList = DocumentType::latest()->get();
        $nothiList = NothiList::find($id);
        return view('admin.presentDocument.edit',compact('nothiList','documentTypeList'));

    } catch (\Exception $e) {
        return redirect()->route('error_404')->with('error','some thing went wrong ');
    }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


        try{
            DB::beginTransaction();

$branchCode = DB::table('branches')
        ->where('id',Auth::guard('admin')->user()->branch_id)
        ->value('branch_code');


$lastNothiSerialNumber = DB::table('nothi_lists')
                ->orderBy('id','desc')->value('document_serial_number');


$main_sarok_number = '০৩.০৭.২৬৬৬.'.$branchCode.'.'.$request->document_number.$request->document_serial_number.'.'.$request->document_year;


$finalSarokNumber = CommonController::englishToBangla($main_sarok_number);


//dd($finalSarokNumber);



                $documentType = NothiList::find($id);
                $documentType->document_branch =$request->document_branch;
                $documentType->document_type_id =$request->document_type_id;
                $documentType->document_number =$request->document_number;
                $documentType->document_year =$request->document_year;
                $documentType->document_class =$request->document_class;
                $documentType->document_subject =$request->document_subject;
                $documentType->main_sarok_number =$finalSarokNumber;
                $documentType->save();

                DB::commit();
                return redirect()->route('documentPresent.index')->with('success','সফলভাবে সংশোধন করা হয়েছে');

            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->route('error_404')->with('error','some thing went wrong ');
            }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            DB::beginTransaction();
        $admins = NothiList::where('id',$id)->delete();
        DB::commit();
        return back()->with('error','সফলভাবে মুছে ফেলা হয়েছে!');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->route('error_404')->with('error','some thing went wrong ');
    }


    }
}
