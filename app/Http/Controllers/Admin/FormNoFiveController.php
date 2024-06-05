<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;
use Illuminate\Support\Str;
use Mail;
use DB;
use Session;
use PDF;
use File;
use App\Models\NgoFDNineDak;
use App\Models\NgoFDNineOneDak;
use App\Models\NgoNameChangeDak;
use App\Models\NgoRenewDak;
use App\Models\NgoFdSixDak;
use App\Models\NgoFdSevenDak;
use App\Models\NgoRegistrationDak;
use App\Models\FormNoFiveDak;
use Carbon\Carbon;
use Response;
use App\Models\Fd9ForwardingLetterEdit;
use App\Models\ForwardingLetter;
use App\Models\ForwardingLetterOnulipi;
use App\Models\SecruityCheck;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use App\Http\Controllers\Admin\CommonController;
class FormNoFiveController extends Controller
{
    public function index(){

        try{

   \LogActivity::addToLog('view fdSix List ');

   if(Auth::guard('admin')->user()->designation_list_id == 2 || Auth::guard('admin')->user()->designation_list_id == 1){

     $dataFromNoFiveForm = DB::table('form_no_fives')
     ->join('fd_one_forms', 'fd_one_forms.id', '=', 'form_no_fives.fd_one_form_id')
     ->select('fd_one_forms.*','form_no_fives.*','form_no_fives.id as mainId')
     ->where('form_no_fives.status','!=','Review')
    ->orderBy('form_no_fives.id','desc')
    ->get();


   }else{

    $ngoStatusFormFiveDak = FormNoFiveDak::where('status',1)
    ->where('receiver_admin_id',Auth::guard('admin')->user()->id)
    ->latest()->get();

    $convert_name_title = $ngoStatusFormFiveDak->implode("form_no_five_status_id", " ");
     $separated_data_title = explode(" ", $convert_name_title);

    $dataFromNoFiveForm = DB::table('form_no_fives')
    ->join('fd_one_forms', 'fd_one_forms.id', '=', 'form_no_fives.fd_one_form_id')
    ->select('fd_one_forms.*','form_no_fives.*','form_no_fives.id as mainId')
    ->whereIn('form_no_fives.id',$separated_data_title)
   ->orderBy('form_no_fives.id','desc')
   ->get();


   }
    //dd($dataFromNVisaFd9Fd1);
        return view('admin.form_no_five.index',compact('dataFromNoFiveForm'));
    } catch (\Exception $e) {
        return redirect()->route('error_404')->with('error','some thing went wrong ');
    }
    }


    public function show($id){
        try{
        \LogActivity::addToLog('view form no five List Detail');

          $dataFromNoFiveForm = DB::table('form_no_fives')
          ->join('fd_one_forms', 'fd_one_forms.id', '=', 'form_no_fives.fd_one_form_id')
          ->select('fd_one_forms.*','form_no_fives.*','form_no_fives.id as mainId')
          ->where('form_no_fives.id',$id)
         ->orderBy('form_no_fives.id','desc')
         ->first();
         $get_email_from_user = DB::table('users')->where('id',$dataFromNoFiveForm->user_id)->value('email');

        $formNoFiveStepTwoData = DB::table('form_no_five_step_twos')->where('form_no_fives_id',$id)->get();
        $formNoFiveStepThreeData =DB::table('form_no_five_step_threes')->where('form_no_fives_id',$id)->get();
        $formNoFiveStepFourData = DB::table('form_no_five_step_fours')->where('form_no_fives_id',$id)->get();
        $formNoFiveStepFiveOther= DB::table('form_no_five_others')->where('form_no_fives_id',$id)->get();
        $formNoFiveStepFiveData = DB::table('form_no_five_step_fives')->where('form_no_fives_id',$id)->get();
        $formNoFiveStepFiveArea = DB::table('form_no_five_area_details')->where('form_no_fives_id',$id)->get();

        return view('admin.form_no_five.show',compact(
        'get_email_from_user',
        'dataFromNoFiveForm',
        'formNoFiveStepTwoData',
        'formNoFiveStepThreeData',
        'formNoFiveStepFourData',
        'formNoFiveStepFiveOther',
        'formNoFiveStepFiveData',
        'formNoFiveStepFiveArea'
    ));

            } catch (\Exception $e) {
                return redirect()->route('error_404')->with('error','some thing went wrong ');
            }
    }


    public function formNoFiveRetaltedPdf($title,$id){


        $get_file_data = DB::table('form_no_fives')->where('id',base64_decode($id))->value($title);

        return view('admin.form_no_five.extraPdf',compact('get_file_data'));


    }


    public function statusUpdateForformNoFive(Request $request){


        try{
            DB::beginTransaction();

        \LogActivity::addToLog('update form_no_five Status ');


        DB::table('form_no_fives')->where('id',$request->id)
        ->update([
            'status' => $request->status,
            'comment' => $request->comment,
        ]);


        $get_user_id = DB::table('form_no_fives')->where('id',$request->id)->value('fd_one_form_id');


            Mail::send('emails.annualReport', ['comment' => $request->comment,'id' => $request->status,'ngoId'=>$get_user_id], function($message) use($request){
                $message->to($request->email);
                $message->subject('Annual Report Service');
            });





            DB::commit();
        return redirect()->back()->with('success','Updated successfully!');

    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->route('error_404')->with('error','some thing went wrong ');
    }



    }
}
