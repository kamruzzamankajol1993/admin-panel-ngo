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
use Carbon\Carbon;
use Response;
use App\Models\Fd9ForwardingLetterEdit;
use App\Models\ForwardingLetter;
use App\Models\ForwardingLetterOnulipi;
use App\Models\SecruityCheck;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use App\Http\Controllers\Admin\CommonController;
class FormNoSevenController extends Controller
{
    public function index(){

        try{

   \LogActivity::addToLog('view form seven  List ');

   if(Auth::guard('admin')->user()->designation_list_id == 2 || Auth::guard('admin')->user()->designation_list_id == 1){

     $dataFromNoSevenForm = DB::table('form_no_sevens')
     ->join('fd_one_forms', 'fd_one_forms.id', '=', 'form_no_sevens.fd_one_form_id')
     ->select('fd_one_forms.*','form_no_sevens.*','form_no_sevens.id as mainId')
     ->where('form_no_sevens.status','!=','Review')
    ->orderBy('form_no_sevens.id','desc')
    ->get();


   }else{

    $ngoStatusFormSevenDak = FormNoSevenDak::where('status',1)
    ->where('receiver_admin_id',Auth::guard('admin')->user()->id)
    ->latest()->get();

    $convert_name_title = $ngoStatusFormSevenDak->implode("form_no_seven_status_id", " ");
     $separated_data_title = explode(" ", $convert_name_title);

    $dataFromNoSevenForm = DB::table('form_no_sevens')
    ->join('fd_one_forms', 'fd_one_forms.id', '=', 'form_no_sevens.fd_one_form_id')
    ->select('fd_one_forms.*','form_no_sevens.*','form_no_sevens.id as mainId')
    ->whereIn('form_no_sevens.id',$separated_data_title)
   ->orderBy('form_no_sevens.id','desc')
   ->get();


   }
    //dd($dataFromNVisaFd9Fd1);
        return view('admin.form_no_seven.index',compact('dataFromNoSevenForm'));
    } catch (\Exception $e) {
        return redirect()->route('error_404')->with('error','some thing went wrong ');
    }
    }


    public function show($id){
        try{
        \LogActivity::addToLog('view form no Seven List Detail');

          $dataFromNoSevenForm = DB::table('form_no_sevens')
          ->join('fd_one_forms', 'fd_one_forms.id', '=', 'form_no_sevens.fd_one_form_id')
          ->select('fd_one_forms.*','form_no_sevens.*','form_no_sevens.id as mainId')
          ->where('form_no_sevens.id',$id)
         ->orderBy('form_no_sevens.id','desc')
         ->first();
         $get_email_from_user = DB::table('users')->where('id',$dataFromNoSevenForm->user_id)->value('email');



        return view('admin.form_no_seven.show',compact(
        'get_email_from_user',
        'dataFromNoSevenForm',
    ));

            } catch (\Exception $e) {
                return redirect()->route('error_404')->with('error','some thing went wrong ');
            }
    }





    public function statusUpdateForformNoSeven(Request $request){


        try{
            DB::beginTransaction();

        \LogActivity::addToLog('update form_no_seven Status ');


        DB::table('form_no_sevens')->where('id',$request->id)
        ->update([
            'status' => $request->status,
            'comment' => $request->comment,
        ]);


        $get_user_id = DB::table('form_no_sevens')->where('id',$request->id)->value('fd_one_form_id');


            Mail::send('emails.projectCertification', ['comment' => $request->comment,'id' => $request->status,'ngoId'=>$get_user_id], function($message) use($request){
                $message->to($request->email);
                $message->subject('Regarding project certification');
            });





            DB::commit();
        return redirect()->back()->with('success','Updated successfully!');

    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->route('error_404')->with('error','some thing went wrong ');
    }



    }
}
