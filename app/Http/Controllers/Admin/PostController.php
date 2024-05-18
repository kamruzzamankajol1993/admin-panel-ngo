<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;
use Illuminate\Support\Str;
use Mail;
use DB;
use DateTime;
use DateTimezone;
use PDF;
use Carbon\Carbon;
use Response;
use App\Models\Branch;
use App\Models\ForwardingLetterOnulipi;
use App\Models\Admin;
use App\Models\DakDetail;
use App\Models\NgoFDNineDak;
use App\Models\NgoFDNineOneDak;
use App\Models\NgoNameChangeDak;
use App\Models\NgoRenewDak;
use App\Models\NgoFdSixDak;
use App\Models\NgoFdSevenDak;
use App\Models\FcOneDak;
use App\Models\FdFiveDak;
use App\Models\FcTwoDak;
use App\Models\NgoRegistrationDak;
use App\Models\DesignationList;
use App\Models\DesignationStep;
use App\Models\AdminDesignationHistory;
use App\Models\FdThreeDak;
use App\Models\NothiList;
use Mpdf\Mpdf;
use App\Models\DuplicateCertificateDak;
use App\Models\ConstitutionDak;
use App\Models\ExecutiveCommitteeDak;


class PostController extends Controller
{

    public function all_dak_list(){
        try{

        if(Auth::guard('admin')->user()->designation_list_id == 2 || Auth::guard('admin')->user()->designation_list_id == 1){

            $all_data_for_new_list = DB::table('ngo_statuses')->latest()->get();
            $all_data_for_renew_list = DB::table('ngo_renews')->latest()->get();
            $all_data_for_name_changes_list = DB::table('ngo_name_changes')->latest()->get();



            $dataFdNineOne = DB::table('fd9_one_forms')
            ->join('n_visas', 'n_visas.fd9_one_form_id', '=', 'fd9_one_forms.id')
            ->join('fd_one_forms', 'fd_one_forms.id', '=', 'fd9_one_forms.fd_one_form_id')
            ->select('fd_one_forms.*','fd9_one_forms.*','n_visas.*','n_visas.id as nVisaId')
            ->orderBY('fd9_one_forms.id','desc')
            ->get();

            $dataFdNine = DB::table('fd9_forms')->latest()->get();

            $dataFromFd6Form = DB::table('fd6_forms')
            ->join('fd_one_forms', 'fd_one_forms.id', '=', 'fd6_forms.fd_one_form_id')
            ->select('fd_one_forms.*','fd6_forms.*','fd6_forms.id as mainId')
            ->orderBy('fd6_forms.id','desc')
            ->get();


           $dataFromFd7Form = DB::table('fd7_forms')
           ->join('fd_one_forms', 'fd_one_forms.id', '=', 'fd7_forms.fd_one_form_id')
           ->select('fd_one_forms.*','fd7_forms.*','fd7_forms.id as mainId')
           ->orderBy('fd7_forms.id','desc')
           ->get();


           $dataFromFc1Form = DB::table('fc1_forms')
           ->join('fd_one_forms', 'fd_one_forms.id', '=', 'fc1_forms.fd_one_form_id')
           ->select('fd_one_forms.*','fc1_forms.*','fc1_forms.id as mainId')
           ->orderBy('fc1_forms.id','desc')
           ->get();


           $dataFromFc2Form = DB::table('fc2_forms')
           ->join('fd_one_forms', 'fd_one_forms.id', '=', 'fc2_forms.fd_one_form_id')
           ->select('fd_one_forms.*','fc2_forms.*','fc2_forms.id as mainId')
           ->orderBy('fc2_forms.id','desc')
           ->get();


           $dataFromFd3Form = DB::table('fd3_forms')
           ->join('fd_one_forms', 'fd_one_forms.id', '=', 'fd3_forms.fd_one_form_id')
           ->select('fd_one_forms.*','fd3_forms.*','fd3_forms.id as mainId')
           ->orderBy('fd3_forms.id','desc')
           ->get();


           $ngoStatusConstitution = DB::table('document_for_amendment_or_approval_of_constitutions')->latest() ->get();
           $ngoStatusDuplicateCertificate = DB::table('document_for_duplicate_certificates')->latest() ->get();

           $ngoStatusExecutiveCommittee = DB::table('document_for_executive_committee_approvals')->latest() ->get();



           $ngoStatusFdFive = DB::table('fd_five_forms')->latest()->get();
          // dd($dataFromFd6Form);

            return view('admin.post.allDak.dakListForDg',compact('ngoStatusFdFive','ngoStatusExecutiveCommittee','ngoStatusDuplicateCertificate','ngoStatusConstitution','dataFromFd3Form','dataFromFc2Form','dataFromFc1Form','dataFromFd7Form','dataFromFd6Form','dataFdNineOne','dataFdNine','all_data_for_name_changes_list','all_data_for_renew_list','all_data_for_new_list'));
        }else{

        $nothiList = NothiList::latest()->get();


        $ngoStatusFdFive = FdFiveDak::where('status',1)
        ->orWhere('receiver_admin_id',Auth::guard('admin')->user()->id)
        ->orWhere('sender_admin_id',Auth::guard('admin')->user()->id)
        ->latest()->get()->unique('fd_five_status_id');


        //dd($ngoStatusFdFive);

        $ngoStatusRenew = NgoRenewDak::where('status',1)
        ->orWhere('receiver_admin_id',Auth::guard('admin')->user()->id)
        ->orWhere('sender_admin_id',Auth::guard('admin')->user()->id)
        ->latest()->get()->unique('renew_status_id');


        $ngoStatusNameChange = NgoNameChangeDak::where('status',1)
        ->orWhere('receiver_admin_id',Auth::guard('admin')->user()->id)
    ->orWhere('sender_admin_id',Auth::guard('admin')->user()->id)
        ->latest()->get()->unique('name_change_status_id');


        $ngoStatusFDNineDak = NgoFDNineDak::where('status',1)
        ->orWhere('receiver_admin_id',Auth::guard('admin')->user()->id)
        ->orWhere('sender_admin_id',Auth::guard('admin')->user()->id)
        ->latest()->get()->unique('f_d_nine_status_id');


        $ngoStatusFdSixDak = NgoFdSixDak::where('status',1)
        ->orWhere('receiver_admin_id',Auth::guard('admin')->user()->id)
        ->orWhere('sender_admin_id',Auth::guard('admin')->user()->id)
        ->latest()->get()->unique('fd_six_status_id');




        $ngoStatusFdSevenDak = NgoFdSevenDak::where('status',1)
        ->orWhere('receiver_admin_id',Auth::guard('admin')->user()->id)
    ->orWhere('sender_admin_id',Auth::guard('admin')->user()->id)
        ->latest()->get()->unique('fd_seven_status_id');


        $ngoStatusFcOneDak = FcOneDak::where('status',1)
        ->orWhere('receiver_admin_id',Auth::guard('admin')->user()->id)
    ->orWhere('sender_admin_id',Auth::guard('admin')->user()->id)
        ->latest()->get()->unique('fc_one_status_id');

        $ngoStatusFcTwoDak = FcTwoDak::where('status',1)
        ->orWhere('receiver_admin_id',Auth::guard('admin')->user()->id)
        ->orWhere('sender_admin_id',Auth::guard('admin')->user()->id)
        ->latest()->get()->unique('fc_two_status_id');

        $ngoStatusFdThreeDak = FdThreeDak::where('status',1)
        ->orWhere('receiver_admin_id',Auth::guard('admin')->user()->id)
        ->orWhere('sender_admin_id',Auth::guard('admin')->user()->id)
        ->latest()->get()->unique('fd_three_status_id');


        $ngoStatusFDNineOneDak = NgoFDNineOneDak::where('status',1)
        ->orWhere('receiver_admin_id',Auth::guard('admin')->user()->id)
    ->orWhere('sender_admin_id',Auth::guard('admin')->user()->id)
        ->latest()->get()->unique('f_d_nine_one_status_id');


    $ngoStatusReg = NgoRegistrationDak::where('status',1)
    ->orWhere('receiver_admin_id',Auth::guard('admin')->user()->id)
    ->orWhere('sender_admin_id',Auth::guard('admin')->user()->id)
    ->latest()->get()->unique('registration_status_id');



    $ngoStatusDuplicateCertificate = DB::table('duplicate_certificate_daks')
    ->where('status',1)
    ->orWhere('receiver_admin_id',Auth::guard('admin')->user()->id)
    ->orWhere('sender_admin_id',Auth::guard('admin')->user()->id)
    ->latest()->get()->unique('duplicate_certificate_id');


    $ngoStatusConstitution = DB::table('constitution_daks')->where('status',1)
    ->orWhere('receiver_admin_id',Auth::guard('admin')->user()->id)
    ->orWhere('sender_admin_id',Auth::guard('admin')->user()->id)
    ->latest()->get()->unique('constitution_id');

    $ngoStatusExecutiveCommittee = DB::table('executive_committee_daks')->
    where('status',1)
    ->orWhere('receiver_admin_id',Auth::guard('admin')->user()->id)
    ->orWhere('sender_admin_id',Auth::guard('admin')->user()->id)
    ->latest()->get()->unique('executive_committee_id');


    $all_data_for_new_list = DB::table('ngo_statuses')->whereIn('status',['Ongoing','Old Ngo Renew'])->latest()->get();

    return view('admin.post.allDak.all_dak_list',compact('ngoStatusFdFive','ngoStatusExecutiveCommittee','ngoStatusDuplicateCertificate','ngoStatusConstitution','nothiList','ngoStatusFdThreeDak','ngoStatusFcTwoDak','ngoStatusFcOneDak','ngoStatusFdSevenDak','ngoStatusFdSixDak','ngoStatusFDNineOneDak','ngoStatusFDNineDak','ngoStatusNameChange','ngoStatusRenew','ngoStatusReg'));
        }

} catch (\Exception $e) {
    return redirect()->route('error_404')->with('error','some thing went wrong ');
}

        //return view('admin.post.allDak.all_dak_list');

    }
    public function index(){

try{

        \LogActivity::addToLog('view dak list.');

        if(Auth::guard('admin')->user()->designation_list_id == 2 || Auth::guard('admin')->user()->designation_list_id == 1){

            $all_data_for_new_list = DB::table('ngo_statuses')->whereIn('status',['Ongoing','Old Ngo Renew'])->latest()->get();
            $all_data_for_renew_list = DB::table('ngo_renews')->where('status','Ongoing')->latest()->get();
            $all_data_for_name_changes_list = DB::table('ngo_name_changes')->where('status','Ongoing')->latest()->get();

            // $dataFdNine = DB::table('fd9_forms')->join('n_visas', 'n_visas.id', '=', 'fd9_forms.n_visa_id')
            // ->join('fd_one_forms', 'fd_one_forms.id', '=', 'n_visas.fd_one_form_id')
            // ->select('fd_one_forms.*','fd9_forms.*','fd9_forms.status as mainStatus','n_visas.*','n_visas.id as nVisaId')
            // ->whereNull('fd9_forms.status')->orderBy('fd9_forms.id','desc')->get();

            $dataFdNineOne = DB::table('fd9_one_forms')
            ->join('n_visas', 'n_visas.fd9_one_form_id', '=', 'fd9_one_forms.id')
            ->join('fd_one_forms', 'fd_one_forms.id', '=', 'fd9_one_forms.fd_one_form_id')
            ->select('fd_one_forms.*','fd9_one_forms.*','n_visas.*','n_visas.id as nVisaId')
            ->whereNull('fd9_one_forms.status')
            ->orderBY('fd9_one_forms.id','desc')
            ->get();


            //dd($dataFdNineOne);

            $dataFdNine = DB::table('fd9_forms')->where('status','Ongoing')->latest()->get();
            $dataFdFiveForm = DB::table('fd_five_forms')->where('status','Ongoing')->latest()->get();
            $dataFromFd6Form = DB::table('fd6_forms')
            ->join('fd_one_forms', 'fd_one_forms.id', '=', 'fd6_forms.fd_one_form_id')
            ->select('fd_one_forms.*','fd6_forms.*','fd6_forms.id as mainId')
           ->orderBy('fd6_forms.id','desc')
           ->get();


           $dataFromFd7Form = DB::table('fd7_forms')
           ->join('fd_one_forms', 'fd_one_forms.id', '=', 'fd7_forms.fd_one_form_id')
           ->select('fd_one_forms.*','fd7_forms.*','fd7_forms.id as mainId')
           ->orderBy('fd7_forms.id','desc')
           ->get();


           $dataFromFc1Form = DB::table('fc1_forms')
           ->join('fd_one_forms', 'fd_one_forms.id', '=', 'fc1_forms.fd_one_form_id')
           ->select('fd_one_forms.*','fc1_forms.*','fc1_forms.id as mainId')
           ->orderBy('fc1_forms.id','desc')
           ->get();


           $dataFromFc2Form = DB::table('fc2_forms')
           ->join('fd_one_forms', 'fd_one_forms.id', '=', 'fc2_forms.fd_one_form_id')
           ->select('fd_one_forms.*','fc2_forms.*','fc2_forms.id as mainId')
           ->orderBy('fc2_forms.id','desc')
           ->get();


           $dataFromFd3Form = DB::table('fd3_forms')
           ->join('fd_one_forms', 'fd_one_forms.id', '=', 'fd3_forms.fd_one_form_id')
           ->select('fd_one_forms.*','fd3_forms.*','fd3_forms.id as mainId')
           ->orderBy('fd3_forms.id','desc')
           ->get();


           $ngoStatusConstitution = DB::table('document_for_amendment_or_approval_of_constitutions')->where('status','Ongoing')->latest() ->get();
           $ngoStatusDuplicateCertificate = DB::table('document_for_duplicate_certificates')->where('status','Ongoing')->latest() ->get();

           $ngoStatusExecutiveCommittee = DB::table('document_for_executive_committee_approvals')->where('status','Ongoing')->latest() ->get();

          // dd($dataFromFd6Form);
          $ngoStatusFdFive = DB::table('fd_five_forms')->where('status','Ongoing')->latest()->get();
            return view('admin.post.index',compact( 'ngoStatusConstitution',
            'ngoStatusDuplicateCertificate','dataFdFiveForm','ngoStatusFdFive',
            'ngoStatusExecutiveCommittee','dataFromFd3Form','dataFromFc2Form','dataFromFc1Form','dataFromFd7Form','dataFromFd6Form','dataFdNineOne','dataFdNine','all_data_for_name_changes_list','all_data_for_renew_list','all_data_for_new_list'));
        }else{

            $nothiList = NothiList::latest()->get();

            $ngoStatusRenew = NgoRenewDak::where('status',1)->whereNull('sent_status')->where('receiver_admin_id',Auth::guard('admin')->user()->id)->latest()->get();
            $ngoStatusNameChange = NgoNameChangeDak::where('status',1)->whereNull('sent_status')->where('receiver_admin_id',Auth::guard('admin')->user()->id)->latest()->get();


            $ngoStatusFDNineDak = NgoFDNineDak::where('status',1)->whereNull('sent_status')->where('receiver_admin_id',Auth::guard('admin')->user()->id)->latest()->get();


            $ngoStatusFdSixDak = NgoFdSixDak::where('status',1)->whereNull('sent_status')->where('receiver_admin_id',Auth::guard('admin')->user()->id)->latest()->get();

            $ngoStatusFdSevenDak = NgoFdSevenDak::where('status',1)->whereNull('sent_status')->where('receiver_admin_id',Auth::guard('admin')->user()->id)->latest()->get();


            $ngoStatusFcOneDak = FcOneDak::where('status',1)->whereNull('sent_status')->where('receiver_admin_id',Auth::guard('admin')->user()->id)->latest()->get();

            $ngoStatusFcTwoDak = FcTwoDak::where('status',1)->whereNull('sent_status')->where('receiver_admin_id',Auth::guard('admin')->user()->id)->latest()->get();

            $ngoStatusFdThreeDak = FdThreeDak::where('status',1)
            ->whereNull('sent_status')
            ->where('receiver_admin_id',Auth::guard('admin')->user()->id)
            ->latest()->get();

            $ngoStatusFdFiveDak = FdFiveDak::where('status',1)
            ->whereNull('sent_status')
            ->where('receiver_admin_id',Auth::guard('admin')->user()->id)
            ->latest()->get();


            $ngoStatusFDNineOneDak = NgoFDNineOneDak::where('status',1)->whereNull('sent_status')->where('receiver_admin_id',Auth::guard('admin')->user()->id)->latest()->get();


        $ngoStatusReg = NgoRegistrationDak::where('status',1)->whereNull('sent_status')->where('receiver_admin_id',Auth::guard('admin')->user()->id)->latest()->get();


        $ngoStatusDuplicateCertificate = DB::table('duplicate_certificate_daks')
        ->where('status',1)->whereNull('sent_status')->where('receiver_admin_id',Auth::guard('admin')->user()->id)->latest() ->get();


        $ngoStatusConstitution = DB::table('constitution_daks')->where('status',1)->whereNull('sent_status')->where('receiver_admin_id',Auth::guard('admin')->user()->id)->latest()->get();

        $ngoStatusExecutiveCommittee = DB::table('executive_committee_daks')->where('status',1)->whereNull('sent_status')->where('receiver_admin_id',Auth::guard('admin')->user()->id)->latest()->get();


        $ngoStatusFdFive = DB::table('fd_five_daks')->where('status',1)->whereNull('sent_status')->where('receiver_admin_id',Auth::guard('admin')->user()->id)->latest()->get();

        $all_data_for_new_list = DB::table('ngo_statuses')->whereIn('status',['Ongoing','Old Ngo Renew'])->latest()->get();

        return view('admin.post.otherMemberIndex',compact( 'ngoStatusConstitution',
        'ngoStatusDuplicateCertificate','ngoStatusFdFiveDak','ngoStatusFdFive',
        'ngoStatusExecutiveCommittee','nothiList','ngoStatusFdThreeDak','ngoStatusFcTwoDak','ngoStatusFcOneDak','ngoStatusFdSevenDak','ngoStatusFdSixDak','ngoStatusFDNineOneDak','ngoStatusFDNineDak','ngoStatusNameChange','ngoStatusRenew','ngoStatusReg'));


        }

    } catch (\Exception $e) {
        return redirect()->route('error_404')->with('error','some thing went wrong ');
    }


    }


    public function sent_dak(){
        try{

           $nothiList = NothiList::latest()->get();

            $ngoStatusRenew = NgoRenewDak::where('status',1)
            ->where('sender_admin_id',Auth::guard('admin')->user()->id)
        ->get()->unique('renew_status_id');


            //dd($ngoStatusRenew);

            $ngoStatusNameChange = NgoNameChangeDak::where('status',1)
            ->where('sender_admin_id',Auth::guard('admin')->user()->id)
            ->get()->unique('name_change_status_id');


            $ngoStatusFDNineDak = NgoFDNineDak::where('status',1)
            ->where('sender_admin_id',Auth::guard('admin')->user()->id)
            ->get()->unique('f_d_nine_status_id');


            $ngoStatusFdSixDak = NgoFdSixDak::where('status',1)
            ->where('sender_admin_id',Auth::guard('admin')->user()->id)
            ->get()->unique('fd_six_status_id');




            $ngoStatusFdSevenDak = NgoFdSevenDak::where('status',1)
            ->where('sender_admin_id',Auth::guard('admin')->user()->id)
            ->get()->unique('fd_seven_status_id');


            $ngoStatusFcOneDak = FcOneDak::where('status',1)
            ->where('sender_admin_id',Auth::guard('admin')->user()->id)
            ->get()->unique('fc_one_status_id');

            $ngoStatusFcTwoDak = FcTwoDak::where('status',1)
            ->where('sender_admin_id',Auth::guard('admin')->user()->id)
            ->get()->unique('fc_two_status_id');

            $ngoStatusFdThreeDak = FdThreeDak::where('status',1)
            ->where('sender_admin_id',Auth::guard('admin')->user()->id)
            ->get()->unique('fd_three_status_id');


            $ngoStatusFdFiveDak = FdFiveDak::where('status',1)
            ->where('sender_admin_id',Auth::guard('admin')->user()->id)
            ->get()->unique('fd_five_status_id');


            $ngoStatusFDNineOneDak = NgoFDNineOneDak::where('status',1)
            ->where('sender_admin_id',Auth::guard('admin')->user()->id)
            ->get()->unique('f_d_nine_one_status_id');


        $ngoStatusReg = NgoRegistrationDak::where('status',1)
        ->where('sender_admin_id',Auth::guard('admin')->user()->id)
        ->get()->unique('registration_status_id');





        $ngoStatusDuplicateCertificate = DB::table('duplicate_certificate_daks')
        ->where('status',1)
        ->where('sender_admin_id',Auth::guard('admin')->user()->id)
        ->get()->unique('duplicate_certificate_id');


        $ngoStatusConstitution = DB::table('constitution_daks')->where('status',1)
        ->where('sender_admin_id',Auth::guard('admin')->user()->id)
        ->get()->unique('constitution_id');

        $ngoStatusExecutiveCommittee = DB::table('executive_committee_daks')->where('status',1)
        ->where('sender_admin_id',Auth::guard('admin')->user()->id)
        ->get()->unique('executive_committee_id');






        $all_data_for_new_list = DB::table('ngo_statuses')->whereIn('status',['Ongoing','Old Ngo Renew'])->latest()->get();

        return view('admin.post.sentDak.sentDakList',compact('ngoStatusFdFiveDak','ngoStatusDuplicateCertificate','ngoStatusConstitution','ngoStatusExecutiveCommittee','nothiList','ngoStatusFdThreeDak','ngoStatusFcTwoDak','ngoStatusFcOneDak','ngoStatusFdSevenDak','ngoStatusFdSixDak','ngoStatusFDNineOneDak','ngoStatusFDNineDak','ngoStatusNameChange','ngoStatusRenew','ngoStatusReg'));

    } catch (\Exception $e) {
        return redirect()->route('error_404')->with('error','some thing went wrong ');
    }

    }


    public function dakListSecondStep(Request $request){
        try{
            DB::beginTransaction();
        //dd($request->all());

        \LogActivity::addToLog('add dak detail.');

        //dd($request->karjo_onulipi2);

        $inputAllData=$request->all();

        // if(empty($request->karjo_onulipi2)){

        //     //dd(22);

       // }

        ///dd($inputAllData);


             $dakDetail = new DakDetail();
             $dakDetail->sender_id =Auth::guard('admin')->user()->id;
             $dakDetail->decision_list = $request->decision_list;
             $dakDetail->decision_list_detail =$request->decision_list_detail;
             $dakDetail->priority_list =$request->priority_list;
             $dakDetail->secret_list =$request->secret_list;
             $dakDetail->status =$request->mainstatus;
             $dakDetail->access_id =$request->access_id;
             $dakDetail->comment =$request->comment;
             $filePath = 'DakDocument';
        if ($request->hasfile('main_file')) {


            $file = $request->file('main_file');
            $dakDetail->main_file =  CommonController::pdfUpload($request,$file,$filePath);

        }



             $dakDetail->save();


             $dakDetailId = $dakDetail->id;



        $receiverId = $inputAllData['receiverId'];

        //dd($inputAllData);

        if($request->mainstatus == 'registration'){

            ////

            if(count($receiverId) >0){

                foreach($receiverId as $key => $allReceiverId){

                    if (array_key_exists('karjo_onulipi'.$key, $inputAllData)){


                        $karjoOnulipi = $inputAllData['karjo_onulipi'.$key][$key];
                    }else{

                        $karjoOnulipi = '';
                    }


                    if (array_key_exists('main_prapok'.$key, $inputAllData)){


                        $mainPrapok = $inputAllData['main_prapok'.$key][$key];
                    }else{

                        $mainPrapok = '';
                    }


                    if (array_key_exists('info_onulipi'.$key, $inputAllData)){


                        $infoOnulipi = $inputAllData['info_onulipi'.$key][$key];
                    }else{

                        $infoOnulipi = '';
                    }


                    if (array_key_exists('eye_onulipi'.$key, $inputAllData)){


                        $eyeOnulipi = $inputAllData['eye_onulipi'.$key][$key];
                    }else{

                        $eyeOnulipi = '';
                    }





                    // $regDakData = NgoRegistrationDak::find($inputAllData['receiverId'][$key]);
                    // $regDakData->original_recipient =$mainPrapok;
                    // $regDakData->copy_of_work =$karjoOnulipi;
                    // $regDakData->informational_purposes =$infoOnulipi;
                    // $regDakData->attraction_attention =$eyeOnulipi;
                    // $regDakData->dak_detail_id = $dakDetailId;
                    // $regDakData->status = 1;
                    // $regDakData->save();


                    if(empty($karjoOnulipi) && empty($infoOnulipi) && empty($eyeOnulipi) ){

                        //dd(22);

                        if($mainPrapok == 1){

                            //dd(1);

                            $regDakData = NgoRegistrationDak::find($inputAllData['receiverId'][$key]);
                            $regDakData->original_recipient =$mainPrapok;
                            $regDakData->copy_of_work =$karjoOnulipi;
                            $regDakData->informational_purposes =$infoOnulipi;
                            $regDakData->attraction_attention =$eyeOnulipi;
                            $regDakData->dak_detail_id = $dakDetailId;

                            $regDakData->status = 1;
                            $regDakData->save();

                        }else{

                            //dd(2);

                            return redirect()->back()->with('error','মূল-প্রাপক/কার্যার্থে অনুলিপি/জ্ঞাতার্থে অনুলিপি/দৃষ্টি আকর্ষণ নির্বাচনে ভুল ছিল   !');
                        }

                    }else{

                       // dd(3);

                        $regDakData = NgoRegistrationDak::find($inputAllData['receiverId'][$key]);
                        $regDakData->original_recipient =$mainPrapok;
                        $regDakData->copy_of_work =$karjoOnulipi;
                        $regDakData->informational_purposes =$infoOnulipi;
                        $regDakData->attraction_attention =$eyeOnulipi;
                        $regDakData->dak_detail_id = $dakDetailId;
                        $regDakData->status = 1;
                        $regDakData->save();

                    }



                    //dd($main_prapok);
                }






            }
            ////

        }elseif($request->mainstatus == 'renew'){

            ////


            if(count($receiverId) >0){

                foreach($receiverId as $key => $allReceiverId){

                    if (array_key_exists('karjo_onulipi'.$key, $inputAllData)){


                        $karjoOnulipi = $inputAllData['karjo_onulipi'.$key][$key];
                    }else{

                        $karjoOnulipi = '';
                    }


                    if (array_key_exists('main_prapok'.$key, $inputAllData)){


                        $mainPrapok = $inputAllData['main_prapok'.$key][$key];
                    }else{

                        $mainPrapok = '';
                    }


                    if (array_key_exists('info_onulipi'.$key, $inputAllData)){


                        $infoOnulipi = $inputAllData['info_onulipi'.$key][$key];
                    }else{

                        $infoOnulipi = '';
                    }


                    if (array_key_exists('eye_onulipi'.$key, $inputAllData)){


                        $eyeOnulipi = $inputAllData['eye_onulipi'.$key][$key];
                    }else{

                        $eyeOnulipi = '';
                    }


                    // $regDakData = NgoRenewDak::find($inputAllData['receiverId'][$key]);
                    // $regDakData->original_recipient =$mainPrapok;
                    // $regDakData->copy_of_work =$karjoOnulipi;
                    // $regDakData->informational_purposes =$infoOnulipi;
                    // $regDakData->attraction_attention =$eyeOnulipi;
                    // $regDakData->dak_detail_id = $dakDetailId;
                    // $regDakData->status = 1;
                    // $regDakData->save();


                    if(empty($karjoOnulipi) && empty($infoOnulipi) && empty($eyeOnulipi) ){

                        //dd(22);

                        if($mainPrapok == 1){

                            //dd(1);

                            $regDakData = NgoRenewDak::find($inputAllData['receiverId'][$key]);
                            $regDakData->original_recipient =$mainPrapok;
                            $regDakData->copy_of_work =$karjoOnulipi;
                            $regDakData->informational_purposes =$infoOnulipi;
                            $regDakData->attraction_attention =$eyeOnulipi;
                            $regDakData->dak_detail_id = $dakDetailId;
                            $regDakData->status = 1;
                            $regDakData->save();

                        }else{

                            //dd(2);

                            return redirect()->back()->with('error','মূল-প্রাপক/কার্যার্থে অনুলিপি/জ্ঞাতার্থে অনুলিপি/দৃষ্টি আকর্ষণ নির্বাচনে ভুল ছিল   !');
                        }

                    }else{

                       // dd(3);

                        $regDakData = NgoRenewDak::find($inputAllData['receiverId'][$key]);
                        $regDakData->original_recipient =$mainPrapok;
                        $regDakData->copy_of_work =$karjoOnulipi;
                        $regDakData->informational_purposes =$infoOnulipi;
                        $regDakData->attraction_attention =$eyeOnulipi;
                        $regDakData->dak_detail_id = $dakDetailId;
                        $regDakData->status = 1;
                        $regDakData->save();

                    }



                    //dd($main_prapok);
                }






            }


            ///

        }elseif($request->mainstatus == 'nameChange'){





            if(count($receiverId) >0){

                foreach($receiverId as $key => $allReceiverId){

                    if (array_key_exists('karjo_onulipi'.$key, $inputAllData)){


                        $karjoOnulipi = $inputAllData['karjo_onulipi'.$key][$key];
                    }else{

                        $karjoOnulipi = '';
                    }


                    if (array_key_exists('main_prapok'.$key, $inputAllData)){


                        $mainPrapok = $inputAllData['main_prapok'.$key][$key];
                    }else{

                        $mainPrapok = '';
                    }


                    if (array_key_exists('info_onulipi'.$key, $inputAllData)){


                        $infoOnulipi = $inputAllData['info_onulipi'.$key][$key];
                    }else{

                        $infoOnulipi = '';
                    }


                    if (array_key_exists('eye_onulipi'.$key, $inputAllData)){


                        $eyeOnulipi = $inputAllData['eye_onulipi'.$key][$key];
                    }else{

                        $eyeOnulipi = '';
                    }


//dd($mainPrapok);

                    if(empty($karjoOnulipi) && empty($infoOnulipi) && empty($eyeOnulipi) ){

                        //dd(22);

                        if($mainPrapok == 1){

                            //dd(1);

                            $regDakData = NgoNameChangeDak::find($inputAllData['receiverId'][$key]);
                            $regDakData->original_recipient =$mainPrapok;
                            $regDakData->copy_of_work =$karjoOnulipi;
                            $regDakData->informational_purposes =$infoOnulipi;
                            $regDakData->attraction_attention =$eyeOnulipi;
                            $regDakData->dak_detail_id = $dakDetailId;
                            $regDakData->status = 1;
                            $regDakData->save();

                        }else{

                            //dd(2);

                            return redirect()->back()->with('error','মূল-প্রাপক/কার্যার্থে অনুলিপি/জ্ঞাতার্থে অনুলিপি/দৃষ্টি আকর্ষণ নির্বাচনে ভুল ছিল   !');
                        }

                    }else{

                       // dd(3);

                        $regDakData = NgoNameChangeDak::find($inputAllData['receiverId'][$key]);
                        $regDakData->original_recipient =$mainPrapok;
                        $regDakData->copy_of_work =$karjoOnulipi;
                        $regDakData->informational_purposes =$infoOnulipi;
                        $regDakData->attraction_attention =$eyeOnulipi;
                        $regDakData->dak_detail_id = $dakDetailId;
                        $regDakData->status = 1;
                        $regDakData->save();




                    }




                    //dd($main_prapok);
                }






            }
            ////

        }elseif($request->mainstatus == 'fdNine'){
            /////
            if(count($receiverId) >0){

                foreach($receiverId as $key => $allReceiverId){

                    if (array_key_exists('karjo_onulipi'.$key, $inputAllData)){


                        $karjoOnulipi = $inputAllData['karjo_onulipi'.$key][$key];
                    }else{

                        $karjoOnulipi = '';
                    }


                    if (array_key_exists('main_prapok'.$key, $inputAllData)){


                        $mainPrapok = $inputAllData['main_prapok'.$key][$key];
                    }else{

                        $mainPrapok = '';
                    }


                    if (array_key_exists('info_onulipi'.$key, $inputAllData)){


                        $infoOnulipi = $inputAllData['info_onulipi'.$key][$key];
                    }else{

                        $infoOnulipi = '';
                    }


                    if (array_key_exists('eye_onulipi'.$key, $inputAllData)){


                        $eyeOnulipi = $inputAllData['eye_onulipi'.$key][$key];
                    }else{

                        $eyeOnulipi = '';
                    }





                    if(empty($karjoOnulipi) && empty($infoOnulipi) && empty($eyeOnulipi) ){

                        //dd(22);

                        if($mainPrapok == 1){

                            //dd(1);

                            $regDakData = NgoFDNineDak::find($inputAllData['receiverId'][$key]);
                            $regDakData->original_recipient =$mainPrapok;
                            $regDakData->copy_of_work =$karjoOnulipi;
                            $regDakData->informational_purposes =$infoOnulipi;
                            $regDakData->attraction_attention =$eyeOnulipi;
                            $regDakData->dak_detail_id = $dakDetailId;
                            $regDakData->status = 1;
                            $regDakData->save();

                        }else{

                            //dd(2);

                            return redirect()->back()->with('error','মূল-প্রাপক/কার্যার্থে অনুলিপি/জ্ঞাতার্থে অনুলিপি/দৃষ্টি আকর্ষণ নির্বাচনে ভুল ছিল   !');
                        }

                    }else{

                       // dd(3);

                        $regDakData = NgoFDNineDak::find($inputAllData['receiverId'][$key]);
                        $regDakData->original_recipient =$mainPrapok;
                        $regDakData->copy_of_work =$karjoOnulipi;
                        $regDakData->informational_purposes =$infoOnulipi;
                        $regDakData->attraction_attention =$eyeOnulipi;
                        $regDakData->dak_detail_id = $dakDetailId;
                        $regDakData->status = 1;
                        $regDakData->save();

                    }






                    //dd($main_prapok);
                }






            }

            ////

        }elseif($request->mainstatus == 'fdNineOne'){

            /////

            if(count($receiverId) >0){

                foreach($receiverId as $key => $allReceiverId){

                    if (array_key_exists('karjo_onulipi'.$key, $inputAllData)){


                        $karjoOnulipi = $inputAllData['karjo_onulipi'.$key][$key];
                    }else{

                        $karjoOnulipi = '';
                    }


                    if (array_key_exists('main_prapok'.$key, $inputAllData)){


                        $mainPrapok = $inputAllData['main_prapok'.$key][$key];
                    }else{

                        $mainPrapok = '';
                    }


                    if (array_key_exists('info_onulipi'.$key, $inputAllData)){


                        $infoOnulipi = $inputAllData['info_onulipi'.$key][$key];
                    }else{

                        $infoOnulipi = '';
                    }


                    if (array_key_exists('eye_onulipi'.$key, $inputAllData)){


                        $eyeOnulipi = $inputAllData['eye_onulipi'.$key][$key];
                    }else{

                        $eyeOnulipi = '';
                    }





                    if(empty($karjoOnulipi) && empty($infoOnulipi) && empty($eyeOnulipi) ){

                        //dd(22);

                        if($mainPrapok == 1){

                            //dd(1);

                            $regDakData = NgoFDNineOneDak::find($inputAllData['receiverId'][$key]);
                            $regDakData->original_recipient =$mainPrapok;
                            $regDakData->copy_of_work =$karjoOnulipi;
                            $regDakData->informational_purposes =$infoOnulipi;
                            $regDakData->attraction_attention =$eyeOnulipi;
                            $regDakData->dak_detail_id = $dakDetailId;
                            $regDakData->status = 1;
                            $regDakData->save();

                        }else{

                            //dd(2);

                            return redirect()->back()->with('error','মূল-প্রাপক/কার্যার্থে অনুলিপি/জ্ঞাতার্থে অনুলিপি/দৃষ্টি আকর্ষণ নির্বাচনে ভুল ছিল   !');
                        }

                    }else{

                       // dd(3);

                        $regDakData = NgoFDNineOneDak::find($inputAllData['receiverId'][$key]);
                        $regDakData->original_recipient =$mainPrapok;
                        $regDakData->copy_of_work =$karjoOnulipi;
                        $regDakData->informational_purposes =$infoOnulipi;
                        $regDakData->attraction_attention =$eyeOnulipi;
                        $regDakData->dak_detail_id = $dakDetailId;
                        $regDakData->status = 1;
                        $regDakData->save();

                    }



                    //dd($main_prapok);
                }






            }
            //////
        }elseif($request->mainstatus == 'fdSix'){

            ////new code


            if(count($receiverId) >0){

                foreach($receiverId as $key => $allReceiverId){

                    if (array_key_exists('karjo_onulipi'.$key, $inputAllData)){


                        $karjoOnulipi = $inputAllData['karjo_onulipi'.$key][$key];
                    }else{

                        $karjoOnulipi = '';
                    }


                    if (array_key_exists('main_prapok'.$key, $inputAllData)){


                        $mainPrapok = $inputAllData['main_prapok'.$key][$key];
                    }else{

                        $mainPrapok = '';
                    }


                    if (array_key_exists('info_onulipi'.$key, $inputAllData)){


                        $infoOnulipi = $inputAllData['info_onulipi'.$key][$key];
                    }else{

                        $infoOnulipi = '';
                    }


                    if (array_key_exists('eye_onulipi'.$key, $inputAllData)){


                        $eyeOnulipi = $inputAllData['eye_onulipi'.$key][$key];
                    }else{

                        $eyeOnulipi = '';
                    }


                    // $regDakData = NgoFDNineOneDak::find($inputAllData['receiverId'][$key]);
                    // $regDakData->original_recipient =$mainPrapok;
                    // $regDakData->copy_of_work =$karjoOnulipi;
                    // $regDakData->informational_purposes =$infoOnulipi;
                    // $regDakData->attraction_attention =$eyeOnulipi;
                    // $regDakData->dak_detail_id = $dakDetailId;
                    // $regDakData->status = 1;
                    // $regDakData->save();


                    if(empty($karjoOnulipi) && empty($infoOnulipi) && empty($eyeOnulipi) ){

                        //dd(22);

                        if($mainPrapok == 1){

                            //dd(1);

                            $regDakData = NgoFdSixDak::find($inputAllData['receiverId'][$key]);
                            $regDakData->original_recipient =$mainPrapok;
                            $regDakData->copy_of_work =$karjoOnulipi;
                            $regDakData->informational_purposes =$infoOnulipi;
                            $regDakData->attraction_attention =$eyeOnulipi;
                            $regDakData->dak_detail_id = $dakDetailId;
                            $regDakData->status = 1;
                            $regDakData->save();

                        }else{

                            //dd(2);

                            return redirect()->back()->with('error','মূল-প্রাপক/কার্যার্থে অনুলিপি/জ্ঞাতার্থে অনুলিপি/দৃষ্টি আকর্ষণ নির্বাচনে ভুল ছিল   !');
                        }

                    }else{

                       // dd(3);

                        $regDakData = NgoFdSixDak::find($inputAllData['receiverId'][$key]);
                        $regDakData->original_recipient =$mainPrapok;
                        $regDakData->copy_of_work =$karjoOnulipi;
                        $regDakData->informational_purposes =$infoOnulipi;
                        $regDakData->attraction_attention =$eyeOnulipi;
                        $regDakData->dak_detail_id = $dakDetailId;
                        $regDakData->status = 1;
                        $regDakData->save();

                    }



                    //dd($main_prapok);
                }






            }


            ///new code

        }elseif($request->mainstatus == 'fdSeven'){

            ////new code


            if(count($receiverId) >0){

                foreach($receiverId as $key => $allReceiverId){

                    if (array_key_exists('karjo_onulipi'.$key, $inputAllData)){


                        $karjoOnulipi = $inputAllData['karjo_onulipi'.$key][$key];
                    }else{

                        $karjoOnulipi = '';
                    }


                    if (array_key_exists('main_prapok'.$key, $inputAllData)){


                        $mainPrapok = $inputAllData['main_prapok'.$key][$key];
                    }else{

                        $mainPrapok = '';
                    }


                    if (array_key_exists('info_onulipi'.$key, $inputAllData)){


                        $infoOnulipi = $inputAllData['info_onulipi'.$key][$key];
                    }else{

                        $infoOnulipi = '';
                    }


                    if (array_key_exists('eye_onulipi'.$key, $inputAllData)){


                        $eyeOnulipi = $inputAllData['eye_onulipi'.$key][$key];
                    }else{

                        $eyeOnulipi = '';
                    }


                    // $regDakData = NgoFDNineOneDak::find($inputAllData['receiverId'][$key]);
                    // $regDakData->original_recipient =$mainPrapok;
                    // $regDakData->copy_of_work =$karjoOnulipi;
                    // $regDakData->informational_purposes =$infoOnulipi;
                    // $regDakData->attraction_attention =$eyeOnulipi;
                    // $regDakData->dak_detail_id = $dakDetailId;
                    // $regDakData->status = 1;
                    // $regDakData->save();


                    if(empty($karjoOnulipi) && empty($infoOnulipi) && empty($eyeOnulipi) ){

                        //dd(22);

                        if($mainPrapok == 1){

                            //dd(1);

                            $regDakData = NgoFdSevenDak::find($inputAllData['receiverId'][$key]);
                            $regDakData->original_recipient =$mainPrapok;
                            $regDakData->copy_of_work =$karjoOnulipi;
                            $regDakData->informational_purposes =$infoOnulipi;
                            $regDakData->attraction_attention =$eyeOnulipi;
                            $regDakData->dak_detail_id = $dakDetailId;
                            $regDakData->status = 1;
                            $regDakData->save();

                        }else{

                            //dd(2);

                            return redirect()->back()->with('error','মূল-প্রাপক/কার্যার্থে অনুলিপি/জ্ঞাতার্থে অনুলিপি/দৃষ্টি আকর্ষণ নির্বাচনে ভুল ছিল   !');
                        }

                    }else{

                       // dd(3);

                        $regDakData = NgoFdSevenDak::find($inputAllData['receiverId'][$key]);
                        $regDakData->original_recipient =$mainPrapok;
                        $regDakData->copy_of_work =$karjoOnulipi;
                        $regDakData->informational_purposes =$infoOnulipi;
                        $regDakData->attraction_attention =$eyeOnulipi;
                        $regDakData->dak_detail_id = $dakDetailId;
                        $regDakData->status = 1;
                        $regDakData->save();

                    }



                    //dd($main_prapok);
                }






            }


            ///new code

        }elseif($request->mainstatus == 'fcOne'){

            ////new code


            if(count($receiverId) >0){

                foreach($receiverId as $key => $allReceiverId){

                    if (array_key_exists('karjo_onulipi'.$key, $inputAllData)){


                        $karjoOnulipi = $inputAllData['karjo_onulipi'.$key][$key];
                    }else{

                        $karjoOnulipi = '';
                    }


                    if (array_key_exists('main_prapok'.$key, $inputAllData)){


                        $mainPrapok = $inputAllData['main_prapok'.$key][$key];
                    }else{

                        $mainPrapok = '';
                    }


                    if (array_key_exists('info_onulipi'.$key, $inputAllData)){


                        $infoOnulipi = $inputAllData['info_onulipi'.$key][$key];
                    }else{

                        $infoOnulipi = '';
                    }


                    if (array_key_exists('eye_onulipi'.$key, $inputAllData)){


                        $eyeOnulipi = $inputAllData['eye_onulipi'.$key][$key];
                    }else{

                        $eyeOnulipi = '';
                    }


                    // $regDakData = NgoFDNineOneDak::find($inputAllData['receiverId'][$key]);
                    // $regDakData->original_recipient =$mainPrapok;
                    // $regDakData->copy_of_work =$karjoOnulipi;
                    // $regDakData->informational_purposes =$infoOnulipi;
                    // $regDakData->attraction_attention =$eyeOnulipi;
                    // $regDakData->dak_detail_id = $dakDetailId;
                    // $regDakData->status = 1;
                    // $regDakData->save();


                    if(empty($karjoOnulipi) && empty($infoOnulipi) && empty($eyeOnulipi) ){

                        //dd(22);

                        if($mainPrapok == 1){

                            //dd(1);

                            $regDakData = FcOneDak::find($inputAllData['receiverId'][$key]);
                            $regDakData->original_recipient =$mainPrapok;
                            $regDakData->copy_of_work =$karjoOnulipi;
                            $regDakData->informational_purposes =$infoOnulipi;
                            $regDakData->attraction_attention =$eyeOnulipi;
                            $regDakData->dak_detail_id = $dakDetailId;
                            $regDakData->status = 1;
                            $regDakData->save();

                        }else{

                            //dd(2);

                            return redirect()->back()->with('error','মূল-প্রাপক/কার্যার্থে অনুলিপি/জ্ঞাতার্থে অনুলিপি/দৃষ্টি আকর্ষণ নির্বাচনে ভুল ছিল   !');
                        }

                    }else{

                       // dd(3);

                        $regDakData = FcOneDak::find($inputAllData['receiverId'][$key]);
                        $regDakData->original_recipient =$mainPrapok;
                        $regDakData->copy_of_work =$karjoOnulipi;
                        $regDakData->informational_purposes =$infoOnulipi;
                        $regDakData->attraction_attention =$eyeOnulipi;
                        $regDakData->dak_detail_id = $dakDetailId;
                        $regDakData->status = 1;
                        $regDakData->save();

                    }



                    //dd($main_prapok);
                }






            }


            ///new code

        }elseif($request->mainstatus == 'fcTwo'){

            ////new code


            if(count($receiverId) >0){

                foreach($receiverId as $key => $allReceiverId){

                    if (array_key_exists('karjo_onulipi'.$key, $inputAllData)){


                        $karjoOnulipi = $inputAllData['karjo_onulipi'.$key][$key];
                    }else{

                        $karjoOnulipi = '';
                    }


                    if (array_key_exists('main_prapok'.$key, $inputAllData)){


                        $mainPrapok = $inputAllData['main_prapok'.$key][$key];
                    }else{

                        $mainPrapok = '';
                    }


                    if (array_key_exists('info_onulipi'.$key, $inputAllData)){


                        $infoOnulipi = $inputAllData['info_onulipi'.$key][$key];
                    }else{

                        $infoOnulipi = '';
                    }


                    if (array_key_exists('eye_onulipi'.$key, $inputAllData)){


                        $eyeOnulipi = $inputAllData['eye_onulipi'.$key][$key];
                    }else{

                        $eyeOnulipi = '';
                    }


                    // $regDakData = NgoFDNineOneDak::find($inputAllData['receiverId'][$key]);
                    // $regDakData->original_recipient =$mainPrapok;
                    // $regDakData->copy_of_work =$karjoOnulipi;
                    // $regDakData->informational_purposes =$infoOnulipi;
                    // $regDakData->attraction_attention =$eyeOnulipi;
                    // $regDakData->dak_detail_id = $dakDetailId;
                    // $regDakData->status = 1;
                    // $regDakData->save();


                    if(empty($karjoOnulipi) && empty($infoOnulipi) && empty($eyeOnulipi) ){

                        //dd(22);

                        if($mainPrapok == 1){

                            //dd(1);

                            $regDakData = FcTwoDak::find($inputAllData['receiverId'][$key]);
                            $regDakData->original_recipient =$mainPrapok;
                            $regDakData->copy_of_work =$karjoOnulipi;
                            $regDakData->informational_purposes =$infoOnulipi;
                            $regDakData->attraction_attention =$eyeOnulipi;
                            $regDakData->dak_detail_id = $dakDetailId;
                            $regDakData->status = 1;
                            $regDakData->save();

                        }else{

                            //dd(2);

                            return redirect()->back()->with('error','মূল-প্রাপক/কার্যার্থে অনুলিপি/জ্ঞাতার্থে অনুলিপি/দৃষ্টি আকর্ষণ নির্বাচনে ভুল ছিল   !');
                        }

                    }else{

                       // dd(3);

                        $regDakData = FcTwoDak::find($inputAllData['receiverId'][$key]);
                        $regDakData->original_recipient =$mainPrapok;
                        $regDakData->copy_of_work =$karjoOnulipi;
                        $regDakData->informational_purposes =$infoOnulipi;
                        $regDakData->attraction_attention =$eyeOnulipi;
                        $regDakData->dak_detail_id = $dakDetailId;
                        $regDakData->status = 1;
                        $regDakData->save();

                    }



                    //dd($main_prapok);
                }






            }


            ///new code

        }elseif($request->mainstatus == 'fdThree'){

            ////new code


            if(count($receiverId) >0){

                foreach($receiverId as $key => $allReceiverId){

                    if (array_key_exists('karjo_onulipi'.$key, $inputAllData)){


                        $karjoOnulipi = $inputAllData['karjo_onulipi'.$key][$key];
                    }else{

                        $karjoOnulipi = '';
                    }


                    if (array_key_exists('main_prapok'.$key, $inputAllData)){


                        $mainPrapok = $inputAllData['main_prapok'.$key][$key];
                    }else{

                        $mainPrapok = '';
                    }


                    if (array_key_exists('info_onulipi'.$key, $inputAllData)){


                        $infoOnulipi = $inputAllData['info_onulipi'.$key][$key];
                    }else{

                        $infoOnulipi = '';
                    }


                    if (array_key_exists('eye_onulipi'.$key, $inputAllData)){


                        $eyeOnulipi = $inputAllData['eye_onulipi'.$key][$key];
                    }else{

                        $eyeOnulipi = '';
                    }


                    if(empty($karjoOnulipi) && empty($infoOnulipi) && empty($eyeOnulipi) ){

                        //dd(22);

                        if($mainPrapok == 1){

                            //dd(1);

                            $regDakData = FdThreeDak::find($inputAllData['receiverId'][$key]);
                            $regDakData->original_recipient =$mainPrapok;
                            $regDakData->copy_of_work =$karjoOnulipi;
                            $regDakData->informational_purposes =$infoOnulipi;
                            $regDakData->attraction_attention =$eyeOnulipi;
                            $regDakData->dak_detail_id = $dakDetailId;
                            $regDakData->status = 1;
                            $regDakData->save();

                        }else{

                            //dd(2);

                            return redirect()->back()->with('error','মূল-প্রাপক/কার্যার্থে অনুলিপি/জ্ঞাতার্থে অনুলিপি/দৃষ্টি আকর্ষণ নির্বাচনে ভুল ছিল   !');
                        }

                    }else{

                       // dd(3);

                        $regDakData = FdThreeDak::find($inputAllData['receiverId'][$key]);
                        $regDakData->original_recipient =$mainPrapok;
                        $regDakData->copy_of_work =$karjoOnulipi;
                        $regDakData->informational_purposes =$infoOnulipi;
                        $regDakData->attraction_attention =$eyeOnulipi;
                        $regDakData->dak_detail_id = $dakDetailId;
                        $regDakData->status = 1;
                        $regDakData->save();

                    }



                    //dd($main_prapok);
                }






            }


            ///new code

        }elseif($request->mainstatus == 'fdFive'){

            ////new code


            if(count($receiverId) >0){

                foreach($receiverId as $key => $allReceiverId){

                    if (array_key_exists('karjo_onulipi'.$key, $inputAllData)){


                        $karjoOnulipi = $inputAllData['karjo_onulipi'.$key][$key];
                    }else{

                        $karjoOnulipi = '';
                    }


                    if (array_key_exists('main_prapok'.$key, $inputAllData)){


                        $mainPrapok = $inputAllData['main_prapok'.$key][$key];
                    }else{

                        $mainPrapok = '';
                    }


                    if (array_key_exists('info_onulipi'.$key, $inputAllData)){


                        $infoOnulipi = $inputAllData['info_onulipi'.$key][$key];
                    }else{

                        $infoOnulipi = '';
                    }


                    if (array_key_exists('eye_onulipi'.$key, $inputAllData)){


                        $eyeOnulipi = $inputAllData['eye_onulipi'.$key][$key];
                    }else{

                        $eyeOnulipi = '';
                    }


                    if(empty($karjoOnulipi) && empty($infoOnulipi) && empty($eyeOnulipi) ){

                        //dd(22);

                        if($mainPrapok == 1){

                            //dd(1);

                            $regDakData = FdFiveDak::find($inputAllData['receiverId'][$key]);
                            $regDakData->original_recipient =$mainPrapok;
                            $regDakData->copy_of_work =$karjoOnulipi;
                            $regDakData->informational_purposes =$infoOnulipi;
                            $regDakData->attraction_attention =$eyeOnulipi;
                            $regDakData->dak_detail_id = $dakDetailId;
                            $regDakData->status = 1;
                            $regDakData->save();

                        }else{

                            //dd(2);

                            return redirect()->back()->with('error','মূল-প্রাপক/কার্যার্থে অনুলিপি/জ্ঞাতার্থে অনুলিপি/দৃষ্টি আকর্ষণ নির্বাচনে ভুল ছিল   !');
                        }

                    }else{

                       // dd(3);

                        $regDakData = FdFiveDak::find($inputAllData['receiverId'][$key]);
                        $regDakData->original_recipient =$mainPrapok;
                        $regDakData->copy_of_work =$karjoOnulipi;
                        $regDakData->informational_purposes =$infoOnulipi;
                        $regDakData->attraction_attention =$eyeOnulipi;
                        $regDakData->dak_detail_id = $dakDetailId;
                        $regDakData->status = 1;
                        $regDakData->save();

                    }



                    //dd($main_prapok);
                }






            }


            ///new code

        }elseif($request->mainstatus == 'duplicate'){

            ////new code


            if(count($receiverId) >0){

                foreach($receiverId as $key => $allReceiverId){

                    if (array_key_exists('karjo_onulipi'.$key, $inputAllData)){


                        $karjoOnulipi = $inputAllData['karjo_onulipi'.$key][$key];
                    }else{

                        $karjoOnulipi = '';
                    }


                    if (array_key_exists('main_prapok'.$key, $inputAllData)){


                        $mainPrapok = $inputAllData['main_prapok'.$key][$key];
                    }else{

                        $mainPrapok = '';
                    }


                    if (array_key_exists('info_onulipi'.$key, $inputAllData)){


                        $infoOnulipi = $inputAllData['info_onulipi'.$key][$key];
                    }else{

                        $infoOnulipi = '';
                    }


                    if (array_key_exists('eye_onulipi'.$key, $inputAllData)){


                        $eyeOnulipi = $inputAllData['eye_onulipi'.$key][$key];
                    }else{

                        $eyeOnulipi = '';
                    }


                    // $regDakData = NgoFDNineOneDak::find($inputAllData['receiverId'][$key]);
                    // $regDakData->original_recipient =$mainPrapok;
                    // $regDakData->copy_of_work =$karjoOnulipi;
                    // $regDakData->informational_purposes =$infoOnulipi;
                    // $regDakData->attraction_attention =$eyeOnulipi;
                    // $regDakData->dak_detail_id = $dakDetailId;
                    // $regDakData->status = 1;
                    // $regDakData->save();


                    if(empty($karjoOnulipi) && empty($infoOnulipi) && empty($eyeOnulipi) ){

                        //dd(22);

                        if($mainPrapok == 1){

                            //dd(1);

                            $regDakData = DuplicateCertificateDak::find($inputAllData['receiverId'][$key]);
                            $regDakData->original_recipient =$mainPrapok;
                            $regDakData->copy_of_work =$karjoOnulipi;
                            $regDakData->informational_purposes =$infoOnulipi;
                            $regDakData->attraction_attention =$eyeOnulipi;
                            $regDakData->dak_detail_id = $dakDetailId;
                            $regDakData->status = 1;
                            $regDakData->save();

                        }else{

                            //dd(2);

                            return redirect()->back()->with('error','মূল-প্রাপক/কার্যার্থে অনুলিপি/জ্ঞাতার্থে অনুলিপি/দৃষ্টি আকর্ষণ নির্বাচনে ভুল ছিল   !');
                        }

                    }else{

                       // dd(3);

                        $regDakData = DuplicateCertificateDak::find($inputAllData['receiverId'][$key]);
                        $regDakData->original_recipient =$mainPrapok;
                        $regDakData->copy_of_work =$karjoOnulipi;
                        $regDakData->informational_purposes =$infoOnulipi;
                        $regDakData->attraction_attention =$eyeOnulipi;
                        $regDakData->dak_detail_id = $dakDetailId;
                        $regDakData->status = 1;
                        $regDakData->save();

                    }



                    //dd($main_prapok);
                }






            }


            ///new code

        }elseif($request->mainstatus == 'constitution'){

            ////new code


            if(count($receiverId) >0){

                foreach($receiverId as $key => $allReceiverId){

                    if (array_key_exists('karjo_onulipi'.$key, $inputAllData)){


                        $karjoOnulipi = $inputAllData['karjo_onulipi'.$key][$key];
                    }else{

                        $karjoOnulipi = '';
                    }


                    if (array_key_exists('main_prapok'.$key, $inputAllData)){


                        $mainPrapok = $inputAllData['main_prapok'.$key][$key];
                    }else{

                        $mainPrapok = '';
                    }


                    if (array_key_exists('info_onulipi'.$key, $inputAllData)){


                        $infoOnulipi = $inputAllData['info_onulipi'.$key][$key];
                    }else{

                        $infoOnulipi = '';
                    }


                    if (array_key_exists('eye_onulipi'.$key, $inputAllData)){


                        $eyeOnulipi = $inputAllData['eye_onulipi'.$key][$key];
                    }else{

                        $eyeOnulipi = '';
                    }


                    // $regDakData = NgoFDNineOneDak::find($inputAllData['receiverId'][$key]);
                    // $regDakData->original_recipient =$mainPrapok;
                    // $regDakData->copy_of_work =$karjoOnulipi;
                    // $regDakData->informational_purposes =$infoOnulipi;
                    // $regDakData->attraction_attention =$eyeOnulipi;
                    // $regDakData->dak_detail_id = $dakDetailId;
                    // $regDakData->status = 1;
                    // $regDakData->save();


                    if(empty($karjoOnulipi) && empty($infoOnulipi) && empty($eyeOnulipi) ){

                        //dd(22);

                        if($mainPrapok == 1){

                            //dd(1);

                            $regDakData = ConstitutionDak::find($inputAllData['receiverId'][$key]);
                            $regDakData->original_recipient =$mainPrapok;
                            $regDakData->copy_of_work =$karjoOnulipi;
                            $regDakData->informational_purposes =$infoOnulipi;
                            $regDakData->attraction_attention =$eyeOnulipi;
                            $regDakData->dak_detail_id = $dakDetailId;
                            $regDakData->status = 1;
                            $regDakData->save();

                        }else{

                            //dd(2);

                            return redirect()->back()->with('error','মূল-প্রাপক/কার্যার্থে অনুলিপি/জ্ঞাতার্থে অনুলিপি/দৃষ্টি আকর্ষণ নির্বাচনে ভুল ছিল   !');
                        }

                    }else{

                       // dd(3);

                        $regDakData = ConstitutionDak::find($inputAllData['receiverId'][$key]);
                        $regDakData->original_recipient =$mainPrapok;
                        $regDakData->copy_of_work =$karjoOnulipi;
                        $regDakData->informational_purposes =$infoOnulipi;
                        $regDakData->attraction_attention =$eyeOnulipi;
                        $regDakData->dak_detail_id = $dakDetailId;
                        $regDakData->status = 1;
                        $regDakData->save();

                    }



                    //dd($main_prapok);
                }






            }


            ///new code

        }elseif($request->mainstatus == 'committee'){

            ////new code


            if(count($receiverId) >0){

                foreach($receiverId as $key => $allReceiverId){

                    if (array_key_exists('karjo_onulipi'.$key, $inputAllData)){


                        $karjoOnulipi = $inputAllData['karjo_onulipi'.$key][$key];
                    }else{

                        $karjoOnulipi = '';
                    }


                    if (array_key_exists('main_prapok'.$key, $inputAllData)){


                        $mainPrapok = $inputAllData['main_prapok'.$key][$key];
                    }else{

                        $mainPrapok = '';
                    }


                    if (array_key_exists('info_onulipi'.$key, $inputAllData)){


                        $infoOnulipi = $inputAllData['info_onulipi'.$key][$key];
                    }else{

                        $infoOnulipi = '';
                    }


                    if (array_key_exists('eye_onulipi'.$key, $inputAllData)){


                        $eyeOnulipi = $inputAllData['eye_onulipi'.$key][$key];
                    }else{

                        $eyeOnulipi = '';
                    }


                    // $regDakData = NgoFDNineOneDak::find($inputAllData['receiverId'][$key]);
                    // $regDakData->original_recipient =$mainPrapok;
                    // $regDakData->copy_of_work =$karjoOnulipi;
                    // $regDakData->informational_purposes =$infoOnulipi;
                    // $regDakData->attraction_attention =$eyeOnulipi;
                    // $regDakData->dak_detail_id = $dakDetailId;
                    // $regDakData->status = 1;
                    // $regDakData->save();


                    if(empty($karjoOnulipi) && empty($infoOnulipi) && empty($eyeOnulipi) ){

                        //dd(22);

                        if($mainPrapok == 1){

                            //dd(1);

                            $regDakData = ExecutiveCommitteeDak::find($inputAllData['receiverId'][$key]);
                            $regDakData->original_recipient =$mainPrapok;
                            $regDakData->copy_of_work =$karjoOnulipi;
                            $regDakData->informational_purposes =$infoOnulipi;
                            $regDakData->attraction_attention =$eyeOnulipi;
                            $regDakData->dak_detail_id = $dakDetailId;
                            $regDakData->status = 1;
                            $regDakData->save();

                        }else{

                            //dd(2);

                            return redirect()->back()->with('error','মূল-প্রাপক/কার্যার্থে অনুলিপি/জ্ঞাতার্থে অনুলিপি/দৃষ্টি আকর্ষণ নির্বাচনে ভুল ছিল   !');
                        }

                    }else{

                       // dd(3);

                        $regDakData = ExecutiveCommitteeDak::find($inputAllData['receiverId'][$key]);
                        $regDakData->original_recipient =$mainPrapok;
                        $regDakData->copy_of_work =$karjoOnulipi;
                        $regDakData->informational_purposes =$infoOnulipi;
                        $regDakData->attraction_attention =$eyeOnulipi;
                        $regDakData->dak_detail_id = $dakDetailId;
                        $regDakData->status = 1;
                        $regDakData->save();

                    }



                    //dd($main_prapok);
                }






            }


            ///new code

        }

        //end seven code end
        DB::commit();
        return redirect()->route('dakBranchList.index')->with('success','Send Successfully!');


    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->route('error_404')->with('error','some thing went wrong ');
    }

    }

    public function dakListFirstStep(Request $request){

       // dd($request->all());
        \LogActivity::addToLog('add dak detail.');


        $dt = new DateTime();
        $dt->setTimezone(new DateTimezone('Asia/Dhaka'));
        $created_at = $dt->format('Y-m-d h:i:s ');

        $amPmValue = $dt->format('a');
       // $amPmValueFinal = 0;
        if($amPmValue == 'pm'){

            $amPmValueFinal = 'অপরাহ্ন';
        }else{
            $amPmValueFinal = 'পূর্বাহ্ন';

        }


         $number=count($request->admin_id);

         if($request->mainStatusNew == 'registration'){

               $deleteData = NgoRegistrationDak::where('sender_admin_id',Auth::guard('admin')->user()->id)

                       ->where('registration_status_id',$request->main_id)
                       ->where('status',0)
                       ->delete();

  $previousReceiver = NgoRegistrationDak::where('receiver_admin_id',Auth::guard('admin')->user()->id)
                       ->where('registration_status_id',$request->main_id)
                       ->value('id');

                       if(empty($previousReceiver)){


                           $sentStatus = 0;

                       }else{
                           $sentStatus = 1;

                       }

                       NgoRegistrationDak::where('receiver_admin_id',Auth::guard('admin')->user()->id)
                       ->where('registration_status_id',$request->main_id)
       ->update([
           'sent_status' => 1,
           'check_status'=>1
        ]);

                // new code for red mark start

                if(Auth::guard('admin')->user()->id ==1 || Auth::guard('admin')->user()->id ==2){

                DB::table('ngo_statuses')->where('id',$request->main_id)
                         ->update([
                            'check_status'=>1
                         ]);

                        }
                // new code for red mark end


            if($number >0){
                for($i=0;$i<$number;$i++){


                 $regDakData = new NgoRegistrationDak();
                 $regDakData->sender_admin_id =Auth::guard('admin')->user()->id;
                 $regDakData->receiver_admin_id = $request->admin_id[$i];
                 $regDakData->registration_status_id =$request->main_id;
                 $regDakData->status = 0;
                 $regDakData->nothi_jat_status = 0;
                 $regDakData->amPmValue = $amPmValueFinal;
                 $regDakData->file_last_check_date = Date('Y-m-d', strtotime('+3 days'));
                 $regDakData->save();

                }


            }

         }elseif($request->mainStatusNew == 'renew'){

                 $deleteData = NgoRenewDak::where('sender_admin_id',Auth::guard('admin')->user()->id)

                       ->where('renew_status_id',$request->main_id)
                       ->where('status',0)
                       ->delete();
 $previousReceiver = NgoRenewDak::where('receiver_admin_id',Auth::guard('admin')->user()->id)
                       ->where('renew_status_id',$request->main_id)
                       ->value('id');

                       if(empty($previousReceiver)){


                           $sentStatus = 0;

                       }else{
                           $sentStatus = 1;

                       }

                       NgoRenewDak::where('receiver_admin_id',Auth::guard('admin')->user()->id)
                       ->where('renew_status_id',$request->main_id)
       ->update([
           'sent_status' => 1,
           'check_status'=>1
        ]);

          // new code for red mark start
          if(Auth::guard('admin')->user()->id ==1 || Auth::guard('admin')->user()->id ==2){
          DB::table('ngo_renews')->where('id',$request->main_id)
          ->update([
             'check_status'=>1
          ]);
        }

 // new code for red mark end


            if($number >0){
                for($i=0;$i<$number;$i++){

                 $regDakData = new NgoRenewDak();
                 $regDakData->sender_admin_id =Auth::guard('admin')->user()->id;
                 $regDakData->receiver_admin_id = $request->admin_id[$i];
                 $regDakData->renew_status_id =$request->main_id;
                 $regDakData->status = 0;
                 $regDakData->nothi_jat_status = 0;
                 $regDakData->amPmValue = $amPmValueFinal;
                 $regDakData->file_last_check_date = Date('Y-m-d', strtotime('+3 days'));
                 $regDakData->save();

                }


            }

         }elseif($request->mainStatusNew == 'nameChange'){
                 $deleteData = NgoNameChangeDak::where('sender_admin_id',Auth::guard('admin')->user()->id)

                       ->where('name_change_status_id',$request->main_id)
                       ->where('status',0)
                       ->delete();

                       //<--- 13 february code -->


                       $previousReceiver = NgoNameChangeDak::where('receiver_admin_id',Auth::guard('admin')->user()->id)
                       ->where('name_change_status_id',$request->main_id)
                       ->value('id');

                       if(empty($previousReceiver)){


                           $sentStatus = 0;

                       }else{
                           $sentStatus = 1;

                       }

                       NgoNameChangeDak::where('receiver_admin_id',Auth::guard('admin')->user()->id)
                       ->where('name_change_status_id',$request->main_id)
       ->update([
           'sent_status' => 1,
           'check_status'=>1
        ]);

         // new code for red mark start
         if(Auth::guard('admin')->user()->id ==1 || Auth::guard('admin')->user()->id ==2){
            DB::table('ngo_name_changes')->where('id',$request->main_id)
            ->update([
               'check_status'=>1
            ]);
          }

   // new code for red mark end


                       //13 february code end

            if($number >0){
                for($i=0;$i<$number;$i++){

                 $regDakData = new NgoNameChangeDak();
                 $regDakData->sender_admin_id =Auth::guard('admin')->user()->id;
                 $regDakData->receiver_admin_id = $request->admin_id[$i];
                 $regDakData->name_change_status_id =$request->main_id;
                 $regDakData->status = 0;
                 $regDakData->nothi_jat_status = 0;
                 $regDakData->amPmValue = $amPmValueFinal;
                 $regDakData->file_last_check_date = Date('Y-m-d', strtotime('+3 days'));
                 $regDakData->save();

                }


            }

         }elseif($request->mainStatusNew == 'fdNine'){



                           $deleteData = NgoFDNineDak::where('sender_admin_id',Auth::guard('admin')->user()->id)

                       ->where('f_d_nine_status_id',$request->main_id)
                       ->where('status',0)
                       ->delete();



                           //<--- 13 february code -->


                           $previousReceiver = NgoFDNineDak::where('receiver_admin_id',Auth::guard('admin')->user()->id)
                           ->where('f_d_nine_status_id',$request->main_id)
                           ->value('id');

                           if(empty($previousReceiver)){


                               $sentStatus = 0;

                           }else{
                               $sentStatus = 1;

                           }

                           NgoFDNineDak::where('receiver_admin_id',Auth::guard('admin')->user()->id)
                           ->where('f_d_nine_status_id',$request->main_id)
           ->update([
               'sent_status' => 1,
               'check_status'=>1
            ]);
// new code for red mark start
if(Auth::guard('admin')->user()->id ==1 || Auth::guard('admin')->user()->id ==2){
    DB::table('fd9_forms')->where('id',$request->main_id)
    ->update([
       'check_status'=>1
    ]);
  }

// new code for red mark end

                           //13 february code end

            if($number >0){
                for($i=0;$i<$number;$i++){

                 $regDakData = new NgoFDNineDak();
                 $regDakData->sender_admin_id =Auth::guard('admin')->user()->id;
                 $regDakData->receiver_admin_id = $request->admin_id[$i];
                 $regDakData->f_d_nine_status_id =$request->main_id;
                 $regDakData->status = 0;
                 $regDakData->nothi_jat_status = 0;
                 $regDakData->amPmValue = $amPmValueFinal;
                 $regDakData->file_last_check_date = Date('Y-m-d', strtotime('+3 days'));
                 $regDakData->save();

                }


            }

         }elseif($request->mainStatusNew == 'fdNineOne'){

                 $deleteData = NgoFDNineOneDak::where('sender_admin_id',Auth::guard('admin')->user()->id)

                       ->where('f_d_nine_one_status_id',$request->main_id)
                       ->where('status',0)
                       ->delete();


                         //<--- 13 february code -->


                         $previousReceiver = NgoFDNineOneDak::where('receiver_admin_id',Auth::guard('admin')->user()->id)
                         ->where('f_d_nine_one_status_id',$request->main_id)
                         ->value('id');

                         if(empty($previousReceiver)){


                             $sentStatus = 0;

                         }else{
                             $sentStatus = 1;

                         }

                         NgoFDNineOneDak::where('receiver_admin_id',Auth::guard('admin')->user()->id)
                         ->where('f_d_nine_one_status_id',$request->main_id)
         ->update([
             'sent_status' => 1,
             'check_status'=>1
          ]);


          // new code for red mark start
if(Auth::guard('admin')->user()->id ==1 || Auth::guard('admin')->user()->id ==2){
    DB::table('fd9_one_forms')->where('id',$request->main_id)
    ->update([
       'check_status'=>1
    ]);
  }

// new code for red mark end


                         //13 february code end


            if($number >0){
                for($i=0;$i<$number;$i++){

                 $regDakData = new NgoFDNineOneDak();
                 $regDakData->sender_admin_id =Auth::guard('admin')->user()->id;
                 $regDakData->receiver_admin_id = $request->admin_id[$i];
                 $regDakData->f_d_nine_one_status_id =$request->main_id;
                 $regDakData->status = 0;
                 $regDakData->nothi_jat_status = 0;
                 $regDakData->amPmValue = $amPmValueFinal;
                 $regDakData->file_last_check_date = Date('Y-m-d', strtotime('+3 days'));
                 $regDakData->save();

                }


            }

         }elseif($request->mainStatusNew == 'fdSix'){


                           $deleteData = NgoFdSixDak::where('sender_admin_id',Auth::guard('admin')->user()->id)

                       ->where('fd_six_status_id',$request->main_id)
                       ->where('status',0)
                       ->delete();


                         //<--- 13 february code -->


                         $previousReceiver = NgoFdSixDak::where('receiver_admin_id',Auth::guard('admin')->user()->id)
                         ->where('fd_six_status_id',$request->main_id)
                         ->value('id');

                         if(empty($previousReceiver)){


                             $sentStatus = 0;

                         }else{
                             $sentStatus = 1;

                         }

                         NgoFdSixDak::where('receiver_admin_id',Auth::guard('admin')->user()->id)
                         ->where('fd_six_status_id',$request->main_id)
         ->update([
             'sent_status' => 1,
             'check_status'=>1
          ]);


          // new code for red mark start
if(Auth::guard('admin')->user()->id ==1 || Auth::guard('admin')->user()->id ==2){
    DB::table('fd6_forms')->where('id',$request->main_id)
    ->update([
       'check_status'=>1
    ]);
  }

// new code for red mark end


                         //13 february code end


            if($number >0){
                for($i=0;$i<$number;$i++){

                 $regDakData = new NgoFdSixDak();
                 $regDakData->sender_admin_id =Auth::guard('admin')->user()->id;
                 $regDakData->receiver_admin_id = $request->admin_id[$i];
                 $regDakData->fd_six_status_id =$request->main_id;
                 $regDakData->status = 0;
                 $regDakData->nothi_jat_status = 0;
                 $regDakData->amPmValue = $amPmValueFinal;
                 $regDakData->file_last_check_date = Date('Y-m-d', strtotime('+3 days'));
                 $regDakData->save();

                }


            }

         }elseif($request->mainStatusNew == 'fdSeven'){

                $deleteData = NgoFdSevenDak::where('sender_admin_id',Auth::guard('admin')->user()->id)

                       ->where('fd_seven_status_id',$request->main_id)
                       ->where('status',0)
                       ->delete();

                         //<--- 13 february code -->


                         $previousReceiver = NgoFdSevenDak::where('receiver_admin_id',Auth::guard('admin')->user()->id)
                         ->where('fd_seven_status_id',$request->main_id)
                         ->value('id');

                         if(empty($previousReceiver)){


                             $sentStatus = 0;

                         }else{
                             $sentStatus = 1;

                         }

                         NgoFdSevenDak::where('receiver_admin_id',Auth::guard('admin')->user()->id)
                         ->where('fd_seven_status_id',$request->main_id)
         ->update([
             'sent_status' => 1,
             'check_status'=>1
          ]);


           // new code for red mark start
if(Auth::guard('admin')->user()->id ==1 || Auth::guard('admin')->user()->id ==2){
    DB::table('fd7_forms')->where('id',$request->main_id)
    ->update([
       'check_status'=>1
    ]);
  }

// new code for red mark end


                         //13 february code end


            if($number >0){
                for($i=0;$i<$number;$i++){

                 $regDakData = new NgoFdSevenDak();
                 $regDakData->sender_admin_id =Auth::guard('admin')->user()->id;
                 $regDakData->receiver_admin_id = $request->admin_id[$i];
                 $regDakData->fd_seven_status_id =$request->main_id;
                 $regDakData->status = 0;
                 $regDakData->nothi_jat_status = 0;
                 $regDakData->amPmValue = $amPmValueFinal;
                 $regDakData->file_last_check_date = Date('Y-m-d', strtotime('+3 days'));
                 $regDakData->save();

                }


            }

         }elseif($request->mainStatusNew == 'fcOne'){

               $deleteData = FcOneDak::where('sender_admin_id',Auth::guard('admin')->user()->id)

                       ->where('fc_one_status_id',$request->main_id)
                       ->where('status',0)
                       ->delete();

     //<--- 13 february code -->


     $previousReceiver = FcOneDak::where('receiver_admin_id',Auth::guard('admin')->user()->id)
     ->where('fc_one_status_id',$request->main_id)
     ->value('id');

     if(empty($previousReceiver)){


         $sentStatus = 0;

     }else{
         $sentStatus = 1;

     }

     FcOneDak::where('receiver_admin_id',Auth::guard('admin')->user()->id)
     ->where('fc_one_status_id',$request->main_id)
->update([
'sent_status' => 1,
'check_status'=>1
]);

 // new code for red mark start
 if(Auth::guard('admin')->user()->id ==1 || Auth::guard('admin')->user()->id ==2){
    DB::table('fc1_forms')->where('id',$request->main_id)
    ->update([
       'check_status'=>1
    ]);
  }

// new code for red mark end


     //13 february code end
            if($number >0){
                for($i=0;$i<$number;$i++){

                 $regDakData = new FcOneDak();
                 $regDakData->sender_admin_id =Auth::guard('admin')->user()->id;
                 $regDakData->receiver_admin_id = $request->admin_id[$i];
                 $regDakData->fc_one_status_id =$request->main_id;
                 $regDakData->status = 0;
                 $regDakData->nothi_jat_status = 0;
                 $regDakData->amPmValue = $amPmValueFinal;
                 $regDakData->file_last_check_date = Date('Y-m-d', strtotime('+3 days'));
                 $regDakData->save();

                }


            }

         }elseif($request->mainStatusNew == 'fcTwo'){

                $deleteData = FcTwoDak::where('sender_admin_id',Auth::guard('admin')->user()->id)

                       ->where('fc_two_status_id',$request->main_id)
                       ->where('status',0)
                       ->delete();

   //<--- 13 february code -->


   $previousReceiver = FcTwoDak::where('receiver_admin_id',Auth::guard('admin')->user()->id)
   ->where('fc_two_status_id',$request->main_id)
   ->value('id');

   if(empty($previousReceiver)){


       $sentStatus = 0;

   }else{
       $sentStatus = 1;

   }

   FcTwoDak::where('receiver_admin_id',Auth::guard('admin')->user()->id)
   ->where('fc_two_status_id',$request->main_id)
->update([
'sent_status' => 1,
'check_status'=>1
]);


// new code for red mark start
if(Auth::guard('admin')->user()->id ==1 || Auth::guard('admin')->user()->id ==2){
    DB::table('fc2_forms')->where('id',$request->main_id)
    ->update([
       'check_status'=>1
    ]);
  }

// new code for red mark end


   //13 february code end

            if($number >0){
                for($i=0;$i<$number;$i++){

                 $regDakData = new FcTwoDak();
                 $regDakData->sender_admin_id =Auth::guard('admin')->user()->id;
                 $regDakData->receiver_admin_id = $request->admin_id[$i];
                 $regDakData->fc_two_status_id =$request->main_id;
                 $regDakData->status = 0;
                 $regDakData->nothi_jat_status = 0;
                 $regDakData->amPmValue = $amPmValueFinal;
                 $regDakData->file_last_check_date = Date('Y-m-d', strtotime('+3 days'));
                 $regDakData->save();

                }


            }

         }elseif($request->mainStatusNew == 'fdThree'){

                  $deleteData = FdThreeDak::where('sender_admin_id',Auth::guard('admin')->user()->id)

                       ->where('fd_three_status_id',$request->main_id)
                       ->where('status',0)
                       ->delete();


                       //<--- 13 february code -->


   $previousReceiver = FdThreeDak::where('receiver_admin_id',Auth::guard('admin')->user()->id)
   ->where('fd_three_status_id',$request->main_id)
   ->value('id');

   if(empty($previousReceiver)){


       $sentStatus = 0;

   }else{
       $sentStatus = 1;

   }

   FdThreeDak::where('receiver_admin_id',Auth::guard('admin')->user()->id)
   ->where('fd_three_status_id',$request->main_id)
->update([
'sent_status' => 1,
'check_status'=>1
]);


// new code for red mark start
if(Auth::guard('admin')->user()->id ==1 || Auth::guard('admin')->user()->id ==2){
    DB::table('fd3_forms')->where('id',$request->main_id)
    ->update([
       'check_status'=>1
    ]);
  }

// new code for red mark end


   //13 february code end


            if($number >0){
                for($i=0;$i<$number;$i++){

                 $regDakData = new FdThreeDak();
                 $regDakData->sender_admin_id =Auth::guard('admin')->user()->id;
                 $regDakData->receiver_admin_id = $request->admin_id[$i];
                 $regDakData->fd_three_status_id =$request->main_id;
                 $regDakData->status = 0;
                 $regDakData->nothi_jat_status = 0;
                 $regDakData->amPmValue = $amPmValueFinal;
                 $regDakData->file_last_check_date = Date('Y-m-d', strtotime('+3 days'));
                 $regDakData->save();

                }


            }

         }elseif($request->mainStatusNew == 'fdFive'){

            $deleteData = FdFiveDak::where('sender_admin_id',Auth::guard('admin')->user()->id)

                 ->where('fd_five_status_id',$request->main_id)
                 ->where('status',0)
                 ->delete();


                 //<--- 13 february code -->


$previousReceiver = FdFiveDak::where('receiver_admin_id',Auth::guard('admin')->user()->id)
->where('fd_five_status_id',$request->main_id)
->value('id');

if(empty($previousReceiver)){


 $sentStatus = 0;

}else{
 $sentStatus = 1;

}

FdFiveDak::where('receiver_admin_id',Auth::guard('admin')->user()->id)
->where('fd_five_status_id',$request->main_id)
->update([
'sent_status' => 1,
'check_status'=>1
]);


 // new code for red mark start
if(Auth::guard('admin')->user()->id ==1 || Auth::guard('admin')->user()->id ==2){
    DB::table('fd_five_forms')->where('id',$request->main_id)
    ->update([
       'check_status'=>1
    ]);
  }

// new code for red mark end


//13 february code end


      if($number >0){
          for($i=0;$i<$number;$i++){

           $regDakData = new FdFiveDak();
           $regDakData->sender_admin_id =Auth::guard('admin')->user()->id;
           $regDakData->receiver_admin_id = $request->admin_id[$i];
           $regDakData->fd_five_status_id =$request->main_id;
           $regDakData->status = 0;
           $regDakData->nothi_jat_status = 0;
           $regDakData->amPmValue = $amPmValueFinal;
           $regDakData->file_last_check_date = Date('Y-m-d', strtotime('+3 days'));
           $regDakData->save();

          }


      }

   }elseif($request->mainStatusNew == 'duplicate'){




            $deleteData = DuplicateCertificateDak::where('sender_admin_id',Auth::guard('admin')->user()->id)

                 ->where('duplicate_certificate_id',$request->main_id)
                 ->where('status',0)
                 ->delete();


                 //<--- 13 february code -->


$previousReceiver = DuplicateCertificateDak::where('receiver_admin_id',Auth::guard('admin')->user()->id)
->where('duplicate_certificate_id',$request->main_id)
->value('id');

if(empty($previousReceiver)){


 $sentStatus = 0;

}else{
 $sentStatus = 1;

}

DuplicateCertificateDak::where('receiver_admin_id',Auth::guard('admin')->user()->id)
->where('duplicate_certificate_id',$request->main_id)
->update([
'sent_status' => 1,
]);


//13 february code end


      if($number >0){
          for($i=0;$i<$number;$i++){

           $regDakData = new DuplicateCertificateDak();
           $regDakData->sender_admin_id =Auth::guard('admin')->user()->id;
           $regDakData->receiver_admin_id = $request->admin_id[$i];
           $regDakData->duplicate_certificate_id =$request->main_id;
           $regDakData->status = 0;
           $regDakData->nothi_jat_status = 0;
           $regDakData->amPmValue = $amPmValueFinal;
           $regDakData->save();

          }


      }

   }elseif($request->mainStatusNew == 'constitution'){

    $deleteData = ConstitutionDak::where('sender_admin_id',Auth::guard('admin')->user()->id)

         ->where('constitution_id',$request->main_id)
         ->where('status',0)
         ->delete();


         //<--- 13 february code -->

$previousReceiver = ConstitutionDak::where('receiver_admin_id',Auth::guard('admin')->user()->id)
->where('constitution_id',$request->main_id)
->value('id');

if(empty($previousReceiver)){


$sentStatus = 0;

}else{
$sentStatus = 1;

}

ConstitutionDak::where('receiver_admin_id',Auth::guard('admin')->user()->id)
->where('constitution_id',$request->main_id)
->update([
'sent_status' => 1,
]);


//13 february code end


if($number >0){
  for($i=0;$i<$number;$i++){

   $regDakData = new ConstitutionDak();
   $regDakData->sender_admin_id =Auth::guard('admin')->user()->id;
   $regDakData->receiver_admin_id = $request->admin_id[$i];
   $regDakData->constitution_id =$request->main_id;
   $regDakData->status = 0;
   $regDakData->nothi_jat_status = 0;
   $regDakData->amPmValue = $amPmValueFinal;
   $regDakData->save();

  }


}

}elseif($request->mainStatusNew == 'committee'){




    $deleteData = ExecutiveCommitteeDak::where('sender_admin_id',Auth::guard('admin')->user()->id)

         ->where('executive_committee_id',$request->main_id)
         ->where('status',0)
         ->delete();


         //<--- 13 february code -->


$previousReceiver = ExecutiveCommitteeDak::where('receiver_admin_id',Auth::guard('admin')->user()->id)
->where('executive_committee_id',$request->main_id)
->value('id');

if(empty($previousReceiver)){


$sentStatus = 0;

}else{
$sentStatus = 1;

}

ExecutiveCommitteeDak::where('receiver_admin_id',Auth::guard('admin')->user()->id)
->where('executive_committee_id',$request->main_id)
->update([
'sent_status' => 1,
]);


//13 february code end


if($number >0){
  for($i=0;$i<$number;$i++){

   $regDakData = new ExecutiveCommitteeDak();
   $regDakData->sender_admin_id =Auth::guard('admin')->user()->id;
   $regDakData->receiver_admin_id = $request->admin_id[$i];
   $regDakData->executive_committee_id =$request->main_id;
   $regDakData->status = 0;
   $regDakData->nothi_jat_status = 0;
   $regDakData->amPmValue = $amPmValueFinal;
   $regDakData->save();

  }


}

}

          $mainDataStatus = $request->mainStatusNew;
          $mainIdNewStatus = $request->main_id;




//new code for ajax call

if($mainDataStatus == 'registration'){


    $allRegistrationDak = NgoRegistrationDak::where('status',0)
    ->where('sender_admin_id',Auth::guard('admin')->user()->id)
    ->where('registration_status_id',$mainIdNewStatus)->get();
//dd($allRegistrationDak);
}elseif($mainDataStatus == 'renew'){

    $allRegistrationDak = NgoRenewDak::where('status',0)
    ->where('sender_admin_id',Auth::guard('admin')->user()->id)
    ->where('renew_status_id',$mainIdNewStatus)->get();


}elseif($mainDataStatus == 'nameChange'){

    $allRegistrationDak = NgoNameChangeDak::where('status',0)
    ->where('sender_admin_id',Auth::guard('admin')->user()->id)
    ->where('name_change_status_id',$mainIdNewStatus)->get();


}elseif($mainDataStatus == 'fdNine'){

    $allRegistrationDak = NgoFDNineDak::where('status',0)
    ->where('sender_admin_id',Auth::guard('admin')->user()->id)
    ->where('f_d_nine_status_id',$mainIdNewStatus)->get();


}elseif($mainDataStatus == 'fdNineOne'){

    $allRegistrationDak = NgoFDNineOneDak::where('status',0)
    ->where('sender_admin_id',Auth::guard('admin')->user()->id)
    ->where('f_d_nine_one_status_id',$mainIdNewStatus)->get();


}elseif($mainDataStatus == 'fdSix'){

    $allRegistrationDak = NgoFdSixDak::where('status',0)
    ->where('sender_admin_id',Auth::guard('admin')->user()->id)
    ->where('fd_six_status_id',$mainIdNewStatus)->get();


}elseif($mainDataStatus == 'fdSeven'){

    $allRegistrationDak = NgoFdSevenDak::where('status',0)
    ->where('sender_admin_id',Auth::guard('admin')->user()->id)
    ->where('fd_seven_status_id',$mainIdNewStatus)->get();


}elseif($mainDataStatus == 'fcOne'){

    $allRegistrationDak = FcOneDak::where('status',0)
    ->where('sender_admin_id',Auth::guard('admin')->user()->id)
    ->where('fc_one_status_id',$mainIdNewStatus)->get();


}elseif($mainDataStatus == 'fcTwo'){

    $allRegistrationDak = FcTwoDak::where('status',0)
    ->where('sender_admin_id',Auth::guard('admin')->user()->id)
    ->where('fc_two_status_id',$mainIdNewStatus)->get();


}elseif($mainDataStatus == 'fdThree'){

    $allRegistrationDak = FdThreeDak::where('status',0)
    ->where('sender_admin_id',Auth::guard('admin')->user()->id)
    ->where('fd_three_status_id',$mainIdNewStatus)->get();


}elseif($mainDataStatus == 'fdFive'){

    $allRegistrationDak = FdFiveDak::where('status',0)
    ->where('sender_admin_id',Auth::guard('admin')->user()->id)
    ->where('fd_five_status_id',$mainIdNewStatus)->get();


}elseif($mainDataStatus == 'duplicate'){

    $allRegistrationDak = DuplicateCertificateDak::where('status',0)
    ->where('sender_admin_id',Auth::guard('admin')->user()->id)
    ->where('duplicate_certificate_id',$mainIdNewStatus)->get();


}elseif($mainDataStatus == 'constitution'){

    $allRegistrationDak = ConstitutionDak::where('status',0)
    ->where('sender_admin_id',Auth::guard('admin')->user()->id)
    ->where('constitution_id',$mainIdNewStatus)->get();


}elseif($mainDataStatus == 'committee'){

    $allRegistrationDak = ExecutiveCommitteeDak::where('status',0)
    ->where('sender_admin_id',Auth::guard('admin')->user()->id)
    ->where('executive_committee_id',$mainIdNewStatus)->get();


}


//end new code for ajax call
    $data = view('admin.post.newDataForFirstStepAjax',compact('allRegistrationDak','mainDataStatus'))->render();
    return response()->json($data);

        //  return redirect('admin/showDataAll/'.$request->mainStatusNew.'/'.$request->main_id);



    }

    public function showDataAll($status,$id){

        try{

        \LogActivity::addToLog('show dak detail.');
        $mainstatus = $status;
        $id = $id;


        if($mainstatus == 'registration'){


            $allRegistrationDak = NgoRegistrationDak::where('status',0)
            ->where('sender_admin_id',Auth::guard('admin')->user()->id)
            ->where('registration_status_id',$id)->get();
//dd($allRegistrationDak);
        }elseif($mainstatus == 'renew'){

            $allRegistrationDak = NgoRenewDak::where('status',0)
            ->where('sender_admin_id',Auth::guard('admin')->user()->id)
            ->where('renew_status_id',$id)->get();


        }elseif($mainstatus == 'nameChange'){

            $allRegistrationDak = NgoNameChangeDak::where('status',0)
            ->where('sender_admin_id',Auth::guard('admin')->user()->id)
            ->where('name_change_status_id',$id)->get();


        }elseif($mainstatus == 'fdNine'){

            $allRegistrationDak = NgoFDNineDak::where('status',0)
            ->where('sender_admin_id',Auth::guard('admin')->user()->id)
            ->where('f_d_nine_status_id',$id)->get();


        }elseif($mainstatus == 'fdNineOne'){

            $allRegistrationDak = NgoFDNineOneDak::where('status',0)
            ->where('sender_admin_id',Auth::guard('admin')->user()->id)
            ->where('f_d_nine_one_status_id',$id)->get();


        }elseif($mainstatus == 'fdSix'){

            $allRegistrationDak = NgoFdSixDak::where('status',0)
            ->where('sender_admin_id',Auth::guard('admin')->user()->id)
            ->where('fd_six_status_id',$id)->get();


        }elseif($mainstatus == 'fdSeven'){

            $allRegistrationDak = NgoFdSevenDak::where('status',0)
            ->where('sender_admin_id',Auth::guard('admin')->user()->id)
            ->where('fd_seven_status_id',$id)->get();


        }elseif($mainstatus == 'fcOne'){

            $allRegistrationDak = FcOneDak::where('status',0)
            ->where('sender_admin_id',Auth::guard('admin')->user()->id)
            ->where('fc_one_status_id',$id)->get();


        }elseif($mainstatus == 'fcTwo'){

            $allRegistrationDak = FcTwoDak::where('status',0)
            ->where('sender_admin_id',Auth::guard('admin')->user()->id)
            ->where('fc_two_status_id',$id)->get();


        }elseif($mainstatus == 'fdThree'){

            $allRegistrationDak = FdThreeDak::where('status',0)
            ->where('sender_admin_id',Auth::guard('admin')->user()->id)
            ->where('fd_three_status_id',$id)->get();


        }elseif($mainstatus == 'fdFive'){

            $allRegistrationDak = FdFiveDak::where('status',0)
            ->where('sender_admin_id',Auth::guard('admin')->user()->id)
            ->where('fd_five_status_id',$id)->get();


        }elseif($mainstatus == 'duplicate'){

            $allRegistrationDak = DB::table('duplicate_certificate_daks')->where('status',0)
            ->where('sender_admin_id',Auth::guard('admin')->user()->id)
            ->where('duplicate_certificate_id',$id)->get();


        }elseif($mainstatus == 'constitution'){

            $allRegistrationDak =DB::table('constitution_daks')->where('status',0)
            ->where('sender_admin_id',Auth::guard('admin')->user()->id)
            ->where('constitution_id',$id)->get();


        }elseif($mainstatus == 'committee'){

            $allRegistrationDak = DB::table('executive_committee_daks')->where('status',0)
            ->where('sender_admin_id',Auth::guard('admin')->user()->id)
            ->where('executive_committee_id',$id)->get();


        }


        //new code for seal


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


        //end new code for seal
        $newMainDaKId = $id;
//dd($id);
        return view('admin.post.show',compact('newMainDaKId','totalBranchList','totalEmptyDesignation','totalDesignationId','totalDesignationWorking','totaluser','totalDesignation','totalBranch','mainstatus','id','allRegistrationDak'));
    } catch (\Exception $e) {
        return redirect()->route('error_404')->with('error','some thing went wrong ');
    }
    }

    public function createSeal($status , $id){

        try{

        \LogActivity::addToLog('create seal.');

        $id = $id;
        $mainstatus = $status;

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

        return view('admin.post.createSeal',compact('mainstatus','id','totalBranchList','totalEmptyDesignation','totalBranch','totalDesignation','totaluser','totalDesignationWorking'));


    } catch (\Exception $e) {
        return redirect()->route('error_404')->with('error','some thing went wrong ');
    }
    }



    public function showDataDesignationWiseOne(Request $request){

        \LogActivity::addToLog('show Data Designation Wise.');

        $mainstatus = $request->mainstatus;
        $totalBranch = $request->totalBranch;
        $totalDesi= $request->totalDesi;
$mainStatusNew = $request->mainStatusNew;
      $id = $request->mainId;
        //dd($totalDesi);

    //     if(!empty($totalBranch) && !empty($totalDesi)){

    //      dd($totalBranch);

    //     }elseif(!empty($totalBranch)){

    // dd(2);

    //     }elseif(!empty($totalDesi)){

    //     dd(3);

    //     }

    if(empty($totalDesi)){

        $data = view('admin.post.showDataDesignationWiseEmpty')->render();
        return response()->json($data);
    }else{


    $totalBranchId = DesignationList::whereIn('id',$totalDesi)->select('branch_id')->get();

    $convert_name_title = $totalBranchId->implode("branch_id", " ");
    $separated_data_title = explode(" ", $convert_name_title);


    $totalBranchList = Branch::whereIn('id',$separated_data_title)->orderBy('branch_step','asc')->get();

    $adminDesignationHistory = AdminDesignationHistory::whereIn('designation_list_id',$totalDesi)->get();

        $data = view('admin.post.showDataDesignationWiseOne',compact('mainStatusNew','id','totalDesi','adminDesignationHistory','totalBranchList'))->render();
        return response()->json($data);
    }
    }




    public function showDataDesignationWise(Request $request){

        \LogActivity::addToLog('show Data Designation Wise.');

        $mainstatus = $request->mainstatus;
        $totalBranch = $request->totalBranch;
        $totalDesi= $request->totalDesi;
      $mainStatusNew = $request->mainStatusNew;
      $id = $request->mainId;
      $newMainDakIdOne = $request->mainId;


    if(empty($totalDesi)){

        $data = view('admin.post.showDataDesignationWiseEmpty')->render();
        return response()->json($data);
    }else{


    $totalBranchId = DesignationList::whereIn('id',$totalDesi)->select('branch_id')->get();

    $convert_name_title = $totalBranchId->implode("branch_id", " ");
    $separated_data_title = explode(" ", $convert_name_title);


    $totalBranchList = Branch::whereIn('id',$separated_data_title)->orderBy('branch_step','asc')->get();

    $adminDesignationHistory = AdminDesignationHistory::whereIn('designation_list_id',$totalDesi)->get();

        $data = view('admin.post.showDataDesignationWise',compact('newMainDakIdOne','mainStatusNew','id','totalDesi','adminDesignationHistory','totalBranchList'))->render();
        return response()->json($data);
    }
    }


    public function deleteMemberListAjax(Request $request){


        $status = $request->status;
        $id = $request->id;
//dd($id);

        \LogActivity::addToLog('delete memeber list.');

        // NgoRegistrationDak::where('id',$id)->delete();



         if($status == 'registration'){


             $allRegistrationDak = NgoRegistrationDak::where('id',$id)->delete();

             $data = NgoRegistrationDak::count();
 //dd($allRegistrationDak);
         }elseif($status == 'renew'){

             $allRegistrationDak = NgoRenewDak::where('id',$id)->delete();

             $data = NgoRenewDak::count();


         }elseif($status == 'nameChange'){

             $allRegistrationDak = NgoNameChangeDak::where('id',$id)->delete();


             $data = NgoNameChangeDak::count();


         }elseif($status == 'fdNine'){

             $allRegistrationDak = NgoFDNineDak::where('id',$id)->delete();

             $data = NgoFDNineDak::count();


         }elseif($mainstatus == 'fdNineOne'){

             $allRegistrationDak = NgoFDNineOneDak::where('id',$id)->delete();

              $data = NgoFDNineOneDak::count();


         }elseif($status == 'fdSix'){

             $allRegistrationDak = NgoFdSixDak::where('id',$id)->delete();

             $data = NgoFdSixDak::count();


         }elseif($status == 'fdSeven'){

             $allRegistrationDak = NgoFdSevenDak::where('id',$id)->delete();

             $data = NgoFdSevenDak::count();


         }elseif($status == 'fcOne'){

             $allRegistrationDak = FcOneDak::where('id',$id)->delete();

             $data = FcOneDak::count();


         }elseif($status == 'fcTwo'){

             $allRegistrationDak = FcTwoDak::where('id',$id)->delete();

             $data = FcTwoDak::count();


         }elseif($status == 'fdThree'){

             $allRegistrationDak = FdThreeDak::where('id',$id)->delete();

$data = FdThreeDak::count();
         }elseif($status == 'fdFive'){

            $allRegistrationDak = FdFiveDak::where('id',$id)->delete();

$data = FdFiveDak::count();
        }elseif($status == 'duplicate'){

            $allRegistrationDak = DuplicateCertificateDak::where('id',$id)->delete();

$data = DuplicateCertificateDak::count();
        }elseif($status == 'constitution'){

            $allRegistrationDak = ConstitutionDak::where('id',$id)->delete();

$data = ConstitutionDak::count();
        }elseif($status == 'committee'){

            $allRegistrationDak = ExecutiveCommitteeDak::where('id',$id)->delete();

$data = ExecutiveCommitteeDak::count();
        }



         return response()->json($data);
    }


    public function deleteMemberList($status, $id){

        try{

        \LogActivity::addToLog('delete memeber list.');

       // NgoRegistrationDak::where('id',$id)->delete();



        if($status == 'registration'){


            $allRegistrationDak = NgoRegistrationDak::where('id',$id)->delete();
//dd($allRegistrationDak);
        }elseif($status == 'renew'){

            $allRegistrationDak = NgoRenewDak::where('id',$id)->delete();


        }elseif($status == 'nameChange'){

            $allRegistrationDak = NgoNameChangeDak::where('id',$id)->delete();


        }elseif($status == 'fdNine'){

            $allRegistrationDak = NgoFDNineDak::where('id',$id)->delete();


        }elseif($mainstatus == 'fdNineOne'){

            $allRegistrationDak = NgoFDNineOneDak::where('id',$id)->delete();


        }elseif($status == 'fdSix'){

            $allRegistrationDak = NgoFdSixDak::where('id',$id)->delete();


        }elseif($status == 'fdSeven'){

            $allRegistrationDak = NgoFdSevenDak::where('id',$id)->delete();


        }elseif($status == 'fcOne'){

            $allRegistrationDak = FcOneDak::where('id',$id)->delete();


        }elseif($status == 'fcTwo'){

            $allRegistrationDak = FcTwoDak::where('id',$id)->delete();


        }elseif($status == 'fdThree'){

            $allRegistrationDak = FdThreeDak::where('id',$id)->delete();


        }elseif($status == 'fdFive'){

            $allRegistrationDak = FdFiveDak::where('id',$id)->delete();


        }elseif($status == 'duplicate'){

            $allRegistrationDak = DuplicateCertificateDak::where('id',$id)->delete();


        }elseif($status == 'constitution'){

            $allRegistrationDak = ConstitutionDak::where('id',$id)->delete();


        }elseif($status == 'committee'){

            $allRegistrationDak = ExecutiveCommitteeDak::where('id',$id)->delete();


        }




        return redirect()->back();


    } catch (\Exception $e) {
        return redirect()->route('error_404')->with('error','some thing went wrong ');
    }
    }




    public function main_doc_download($id){

        try{

        \LogActivity::addToLog('dak pdf download.');

        $data = DB::table('system_information')->first();

        $get_file_data = DB::table('dak_details')->where('id',$id)->value('main_file');

        $file_path = $data->system_admin_url.'public/'.$get_file_data;
        $filename  = pathinfo($file_path, PATHINFO_FILENAME);

$file=$data->system_admin_url.'public/'.$get_file_data;

        $headers = array(
                  'Content-Type: application/pdf',
                );

        // return Response::download($file,$filename.'.pdf', $headers);

        return Response::make(file_get_contents($file), 200, [
            'content-type'=>'application/pdf',
        ]);


    } catch (\Exception $e) {
        return redirect()->route('error_404')->with('error','some thing went wrong ');
    }
    }


}
