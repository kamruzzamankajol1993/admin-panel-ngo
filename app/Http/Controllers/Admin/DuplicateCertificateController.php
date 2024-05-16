<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
Use DB;
use Mail;
use Carbon\Carbon;
use App\Models\NgoFDNineDak;
use App\Models\NgoFDNineOneDak;
use App\Models\NgoNameChangeDak;
use App\Models\NgoRenewDak;
use App\Models\NgoFdSixDak;
use App\Models\NgoFdSevenDak;
use App\Models\NgoRegistrationDak;
use App\Models\DuplicateCertificateDak;
class DuplicateCertificateController extends Controller
{   public $user;


    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }
    public function index(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('duplicateCertificateView')) {
           // abort(403, 'Sorry !! You are Unauthorized to view !');
           return redirect()->route('error_404');
        }

        try{

        \LogActivity::addToLog('duplicateCertificateView');


        if(Auth::guard('admin')->user()->designation_list_id == 2 || Auth::guard('admin')->user()->designation_list_id == 1){


        $all_data_for_new_list = DB::table('document_for_duplicate_certificates')->latest()->get();

        }else{


            $ngoStatusNameChange = DuplicateCertificateDak::where('status',1)
            ->where('receiver_admin_id',Auth::guard('admin')->user()->id)->latest()->get();

            $convert_name_title = $ngoStatusNameChange->implode("duplicate_certificate_id", " ");
            $separated_data_title = explode(" ", $convert_name_title);

            $all_data_for_new_list = DB::table('document_for_duplicate_certificates')
            ->whereIn('id',$separated_data_title)
           ->latest()->get();

        }





      return view('admin.duplicateCertificate.index',compact('all_data_for_new_list'));

    } catch (\Exception $e) {
        return redirect()->route('error_404')->with('error','some thing went wrong ');
    }

    }



    public function show($id){


        \LogActivity::addToLog('view name change detail ');


             try {



                $getformOneId = DB::table('document_for_duplicate_certificates')->where('id',$id)->first();

                $form_one_data = DB::table('fd_one_forms')->where('id',$getformOneId->fd_one_form_id)->first();



                $r_status = DB::table('ngo_statuses')->where('fd_one_form_id',$form_one_data->id)->value('status');
                $name_change_status = DB::table('document_for_duplicate_certificates')->where('id',$id)->value('status');
                $renew_status = DB::table('ngo_renews')->where('fd_one_form_id',$form_one_data->id)->value('status');


                //new code for old  and new

      $checkOldorNew = DB::table('ngo_type_and_languages')
      ->where('user_id',$form_one_data->user_id)->value('ngo_type_new_old');

 //end new code for old and new

 if($checkOldorNew == 'Old'){

     $all_data_for_new_list_all = DB::table('ngo_renews')
     ->where('fd_one_form_id',$form_one_data->id)->first();
 }else{

     $all_data_for_new_list_all = DB::table('ngo_statuses')
     ->where('fd_one_form_id',$form_one_data->id)->first();
 }




     $duration_list_all1 = DB::table('ngo_durations')->where('fd_one_form_id',$form_one_data->id)->value('ngo_duration_end_date');
                $duration_list_all = DB::table('ngo_durations')->where('fd_one_form_id',$form_one_data->id)->value('ngo_duration_start_date');



                $users_info = DB::table('users')->where('id',$form_one_data->user_id)->first();








        return view('admin.duplicateCertificate.view',compact('getformOneId',
        'duration_list_all1','duration_list_all',
        'renew_status','name_change_status','r_status',
       'users_info','all_data_for_new_list_all','form_one_data'));
    } catch (\Exception $e) {
        return redirect()->route('error_404')->with('error','some thing went wrong ');
    }

    }



    public function duplicateCertificatePdf($id,$title){

        \LogActivity::addToLog('download name change pdf ');

            $form_one_data = DB::table('document_for_duplicate_certificates')->where('id',$id)->value($title);



        return view('admin.duplicateCertificate.duplicateCertificatePdf',compact('form_one_data'));

    }


    public function updateStatusDuplicateCertificate(Request $request){

        \LogActivity::addToLog('update name change status');

        //dd($request->status);

        $data_save = DB::table('document_for_duplicate_certificates')->where('id',$request->id)
        ->update([
            'status' => $request->status,
            //'comment' => $request->comment,
         ]);


        $get_user_id = DB::table('document_for_duplicate_certificates')->where('id',$request->id)->value('fd_one_form_id');



        $form_one_data = DB::table('fd_one_forms')->where('id',$get_user_id)->first();



        Mail::send('emails.duplicateCertificate', ['comment'=>$request->comment,'id' => $request->status,'ngoId'=>$form_one_data->id], function($message) use($request){
            $message->to($request->email);
            $message->subject('Duplicate Certificate Status');
        });

        return redirect()->back()->with('success','Updated Successfully');
    }
}
