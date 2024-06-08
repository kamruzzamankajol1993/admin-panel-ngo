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

   \LogActivity::addToLog('view form no four List ');

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
}
