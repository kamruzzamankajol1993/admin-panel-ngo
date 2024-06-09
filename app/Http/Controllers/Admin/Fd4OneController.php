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
use App\Models\Fd4OneFormDak;
use App\Models\FormNoFourDak;
use Carbon\Carbon;
use Response;
use App\Models\Fd9ForwardingLetterEdit;
use App\Models\ForwardingLetter;
use App\Models\ForwardingLetterOnulipi;
use App\Models\SecruityCheck;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use App\Http\Controllers\Admin\CommonController;
class Fd4OneController extends Controller
{
    public function index(){

        try{

   \LogActivity::addToLog('view fd four one List ');

   if(Auth::guard('admin')->user()->designation_list_id == 2 || Auth::guard('admin')->user()->designation_list_id == 1){

     $dataFromNoFdFourOneForm = DB::table('fd_four_one_forms')
     ->join('fd_one_forms', 'fd_one_forms.id', '=', 'fd_four_one_forms.fd_one_form_id')
     ->select('fd_one_forms.*','fd_four_one_forms.*','fd_four_one_forms.id as mainId')
     ->where('fd_four_one_forms.status','!=','Review')
    ->orderBy('fd_four_one_forms.id','desc')
    ->get();


   }else{

    $ngoStatusFormFourDak = Fd4OneFormDak::where('status',1)
    ->where('receiver_admin_id',Auth::guard('admin')->user()->id)
    ->latest()->get();

    $convert_name_title = $ngoStatusFormFourDak->implode("fd4_one_form_status_id", " ");
     $separated_data_title = explode(" ", $convert_name_title);

    $dataFromNoFdFourOneForm = DB::table('fd_four_one_forms')
    ->join('fd_one_forms', 'fd_one_forms.id', '=', 'fd_four_one_forms.fd_one_form_id')
    ->select('fd_one_forms.*','fd_four_one_forms.*','fd_four_one_forms.id as mainId')
    ->whereIn('fd_four_one_forms.id',$separated_data_title)
   ->orderBy('fd_four_one_forms.id','desc')
   ->get();


   }
    //dd($dataFromNVisaFd9Fd1);
        return view('admin.fd_four_one_form.index',compact('dataFromNoFdFourOneForm'));
    } catch (\Exception $e) {
        return redirect()->route('error_404')->with('error','some thing went wrong ');
    }
    }


    public function show($id){

        \LogActivity::addToLog('view fd four one List Detail');

          $dataFdFourOneForm = DB::table('fd_four_one_forms')
          ->join('fd_one_forms', 'fd_one_forms.id', '=', 'fd_four_one_forms.fd_one_form_id')
          ->select('fd_one_forms.*','fd_four_one_forms.*','fd_four_one_forms.id as mainId')
          ->where('fd_four_one_forms.id',$id)
         ->orderBy('fd_four_one_forms.id','desc')
         ->first();
         $get_email_from_user = DB::table('users')->where('id',$dataFdFourOneForm->user_id)->value('email');



         $fdFourFormList = DB::table('fd_four_forms')
        ->where('fd_four_one_form_id',$id)
                                 ->latest()->first();

        $fdFourOneFormExpenditorSector =DB::table('fd_four_one_expenditure_sectors')->where('fd_four_one_id',$id)->latest()->get();

        return view('admin.fd_four_one_form.show',compact(
        'get_email_from_user',
        'dataFdFourOneForm',
        'fdFourFormList',
        'fdFourOneFormExpenditorSector'
    ));


    }


    public function statusUpdateForfd4OneForm(Request $request){


        try{
            DB::beginTransaction();

        \LogActivity::addToLog('update form_no_four Status ');


        DB::table('fd_four_one_forms')->where('id',$request->id)
        ->update([
            'status' => $request->status,
            'comment' => $request->comment,
        ]);


        $get_user_id = DB::table('fd_four_one_forms')->where('id',$request->id)->value('fd_one_form_id');


            Mail::send('emails.caFarmReport', ['comment' => $request->comment,'id' => $request->status,'ngoId'=>$get_user_id], function($message) use($request){
                $message->to($request->email);
                $message->subject('CA Farm Report Service');
            });





            DB::commit();
        return redirect()->back()->with('success','Updated successfully!');

    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->route('error_404')->with('error','some thing went wrong ');
    }



    }
}
