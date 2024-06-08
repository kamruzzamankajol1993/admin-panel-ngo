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
class FormNoFourController extends Controller
{
    public function index(){

        try{

   \LogActivity::addToLog('view form no four List ');

   if(Auth::guard('admin')->user()->designation_list_id == 2 || Auth::guard('admin')->user()->designation_list_id == 1){

     $dataFromNoFourForm = DB::table('form_no_fours')
     ->join('fd_one_forms', 'fd_one_forms.id', '=', 'form_no_fours.fd_one_form_id')
     ->select('fd_one_forms.*','form_no_fours.*','form_no_fours.id as mainId')
     ->where('form_no_fours.status','!=','Review')
    ->orderBy('form_no_fours.id','desc')
    ->get();


   }else{

    $ngoStatusFormFourDak = FormNoFourDak::where('status',1)
    ->where('receiver_admin_id',Auth::guard('admin')->user()->id)
    ->latest()->get();

    $convert_name_title = $ngoStatusFormFourDak->implode("form_no_four_status_id", " ");
     $separated_data_title = explode(" ", $convert_name_title);

    $dataFromNoFourForm = DB::table('form_no_fours')
    ->join('fd_one_forms', 'fd_one_forms.id', '=', 'form_no_fours.fd_one_form_id')
    ->select('fd_one_forms.*','form_no_fours.*','form_no_fours.id as mainId')
    ->whereIn('form_no_fours.id',$separated_data_title)
   ->orderBy('form_no_fours.id','desc')
   ->get();


   }
    //dd($dataFromNVisaFd9Fd1);
        return view('admin.form_no_four.index',compact('dataFromNoFourForm'));
    } catch (\Exception $e) {
        return redirect()->route('error_404')->with('error','some thing went wrong ');
    }
    }
}
