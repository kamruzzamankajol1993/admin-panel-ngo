<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
Use DB;
use Mail;
use App\Models\Ngostatus;
use App\Models\Namechange;
use App\Models\Renew;
use App\Models\Duration;
use Carbon\Carbon;
use Mpdf\Mpdf;
use Response;
use App\Models\NgoFDNineDak;
use App\Models\NgoFDNineOneDak;
use App\Models\NgoNameChangeDak;
use App\Models\NgoRenewDak;
use App\Models\NgoFdSixDak;
use App\Models\NgoFdSevenDak;
use App\Models\NgoRegistrationDak;
class NgoProfileController extends Controller
{
    public function index(){

        $registrationList = DB::table('fd_one_forms')
         ->join('ngo_statuses', 'ngo_statuses.fd_one_form_id', '=', 'fd_one_forms.id')

         ->select('ngo_statuses.*','fd_one_forms.*','fd_one_forms.id as fdOneFormId')
         ->where('ngo_statuses.status','Accepted')
         ->get();


         $renewList = DB::table('fd_one_forms')
         ->join('ngo_renews', 'ngo_renews.fd_one_form_id', '=', 'fd_one_forms.id')
         ->select('ngo_renews.*','fd_one_forms.*','fd_one_forms.id as fdOneFormId')
         ->where('ngo_renews.status','Accepted')
         ->get();

        return view('admin.ngoProfile.index',compact('registrationList','renewList'));
    }


    public function show($id){

        $decodeId = base64_decode($id);

        $registrationList = DB::table('fd_one_forms')
         ->where('id',$decodeId)
         ->first();


         $dataFromFd6FormId = DB::table('fd6_forms')
         ->where('fd_one_form_id', '=',$decodeId)
         ->get();

         $convert_name_titlefd6 = $dataFromFd6FormId->implode("id", " ");
         $separated_data_titlefd6 = explode(" ", $convert_name_titlefd6);

         $prokolpoAreaListFd6 = DB::table('fd6_form_prokolpo_areas')
         ->whereIn('fd6_form_id',$separated_data_titlefd6)->latest()->get();


         $dataFromFd7FormId = DB::table('fd7_forms')
         ->where('fd_one_form_id', '=',$decodeId)
         ->get();

         $convert_name_titlefd7 = $dataFromFd7FormId->implode("id", " ");
         $separated_data_titlefd7 = explode(" ", $convert_name_titlefd7);

         $prokolpoAreaListFd7 = DB::table('fd7_form_prokolpo_areas')
         ->whereIn('fd7_form_id',$separated_data_titlefd7)->latest()->get();


         $dataFromFc1FormId = DB::table('fc1_forms')
         ->where('fd_one_form_id', '=',$decodeId)
         ->get();

         $convert_name_titlefc1 = $dataFromFc1FormId->implode("id", " ");
         $separated_data_titlefc1 = explode(" ", $convert_name_titlefc1);

         $dataFromFc2FormId = DB::table('fc2_forms')
         ->where('fd_one_form_id', '=',$decodeId)
         ->get();

         $convert_name_titlefc2 = $dataFromFc2FormId->implode("id", " ");
         $separated_data_titlefc2 = explode(" ", $convert_name_titlefc2);


         $prokolpoAreaListFc1 = DB::table('prokolpo_areas')->where('type','fcOne')
         ->whereIn('formId',$separated_data_titlefc1)->latest()->get();


         $prokolpoAreaListFc2 = DB::table('prokolpo_areas')->where('type','fcTwo')
         ->whereIn('formId',$separated_data_titlefc2)->latest()->get();


         return view('admin.ngoProfile.show',compact(
            'registrationList',
            'decodeId',
            'dataFromFd6FormId',
            'prokolpoAreaListFd6',
            'dataFromFd7FormId',
            'prokolpoAreaListFd7',
            'dataFromFc1FormId',
            'dataFromFc2FormId',
            'prokolpoAreaListFc1',
            'prokolpoAreaListFc2'
        ));
    }
}
