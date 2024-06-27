<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
Use DB;
use Mail;
use Carbon\Carbon;
use Mpdf\Mpdf;
use Response;
use App\Models\ProjectSubject;
class ReportController extends Controller
{
    public $user;


    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }


    public function prokolpoBeneficiariesReportSearch(Request $request){

        if (is_null($this->user) || !$this->user->can('prokolpoReportView')) {
            //abort(403, 'Sorry !! You are Unauthorized to view !');
            return redirect()->route('error_404');
        }
        $prokolpoYear = $request->prokolpo_year;
        $prokolpoType = $request->prokolpo_type;
        $distrcitName = $request->distric_name;
        $divisionName = $request->division_name;

        $projectSubjectList = ProjectSubject::orderBy('id','desc')->get();
        $prokolpoReport = DB::table('prokolpo_details')->latest()->get();

        $prokolpoReportFd6 = DB::table('prokolpo_details')->where('type','fd6')->count();
        $prokolpoReportFd7 = DB::table('prokolpo_details')->where('type','fd7')->count();
        $prokolpoReportFc1 = DB::table('prokolpo_details')->where('type','fc1')->count();
        $prokolpoReportFc2 = DB::table('prokolpo_details')->where('type','fc2')->count();


        $divisionList = DB::table('civilinfos')->groupBy('division_bn')->select('division_bn')->get();
        $districtList = DB::table('civilinfos')->groupBy('district_bn')->select('district_bn')->get();
        $cityCorporationList = DB::table('civilinfos')->whereNotNull('city_orporation')
        ->groupBy('city_orporation')->select('city_orporation')->get();


 // new code start

 if(empty($prokolpoType) && empty($divisionName) && empty($distrcitName)){

    $formYear = $request->prokolpo_year;
    $toYear =$request->prokolpo_year+1;

    $formDate = $formYear.'-07-01';
    $toDate = $toYear.'-06-30';

    $prokolpoReportFd6Main = DB::table('prokolpo_details')
    ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
    ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
    ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
    ->where('prokolpo_details.type','fd6')
    ->whereBetween('fd6_form_prokolpo_areas.created_at', [$formDate, $toDate])
    ->orderBy('prokolpo_details.id','desc')
    ->get();

    $prokolpoReportFd7Main = DB::table('prokolpo_details')
->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
->where('prokolpo_details.type','fd7')
->whereBetween('fd7_form_prokolpo_areas.created_at', [$formDate, $toDate])
->orderBy('prokolpo_details.id','desc')
->get();


    $prokolpoReportFc1Main = DB::table('prokolpo_details')
->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
->where('prokolpo_details.type','fc1')
->where('prokolpo_areas.type','fcOne')
->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
->orderBy('prokolpo_details.id','desc')
->get();


    $prokolpoReportFc2Main = DB::table('prokolpo_details')
->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
->where('prokolpo_details.type','fc2')
->where('prokolpo_areas.type','fcTwo')
->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
->orderBy('prokolpo_details.id','desc')
->get();

}elseif(empty($prokolpoYear) && empty($divisionName) && empty($distrcitName)){

    $prokolpoReportFd6Main = DB::table('prokolpo_details')
    ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
    ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
    ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
    ->where('prokolpo_details.type','fd6')
    ->whereBetween('fd6_form_prokolpo_areas.prokolpo_type',$prokolpoType)
    ->orderBy('prokolpo_details.id','desc')
    ->get();

    $prokolpoReportFd7Main = DB::table('prokolpo_details')
->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
->where('prokolpo_details.type','fd7')
->whereIn('fd7_form_prokolpo_areas.prokolpo_type',$prokolpoType)
->orderBy('prokolpo_details.id','desc')
->get();


    $prokolpoReportFc1Main = DB::table('prokolpo_details')
->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
->where('prokolpo_details.type','fc1')
->where('prokolpo_areas.type','fcOne')
->whereIn('prokolpo_areas.prokolpo_type',$prokolpoType)
->orderBy('prokolpo_details.id','desc')
->get();


    $prokolpoReportFc2Main = DB::table('prokolpo_details')
->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
->where('prokolpo_details.type','fc2')
->where('prokolpo_areas.type','fcTwo')
->whereIn('prokolpo_areas.prokolpo_type',$prokolpoType)
->orderBy('prokolpo_details.id','desc')
->get();

}elseif(empty($prokolpoYear) && empty($divisionName) && empty($prokolpoType)){

    $prokolpoReportFd6Main = DB::table('prokolpo_details')
    ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
    ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
    ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
    ->where('prokolpo_details.type','fd6')
    ->whereIn('fd6_form_prokolpo_areas.district_name',$request->distric_name)
    ->orderBy('prokolpo_details.id','desc')
    ->get();


    $prokolpoReportFd7Main = DB::table('prokolpo_details')
 ->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
 ->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
 ->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
 ->where('prokolpo_details.type','fd7')
 ->whereIn('fd7_form_prokolpo_areas.district_name',$request->distric_name)
 ->orderBy('prokolpo_details.id','desc')
 ->get();

    $prokolpoReportFc1Main = DB::table('prokolpo_details')
 ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
 ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
 ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
 ->where('prokolpo_details.type','fc1')
 ->where('prokolpo_areas.type','fcOne')
 ->whereIn('prokolpo_areas.district_name',$request->distric_name)
 ->orderBy('prokolpo_details.id','desc')
 ->get();

    $prokolpoReportFc2Main = DB::table('prokolpo_details')
 ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
 ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
 ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
 ->where('prokolpo_details.type','fc2')
 ->where('prokolpo_areas.type','fcTwo')
 ->whereIn('prokolpo_areas.district_name',$request->distric_name)
 ->orderBy('prokolpo_details.id','desc')
 ->get();

}elseif(empty($prokolpoYear) && empty($distrcitName) && empty($prokolpoType)){

    $prokolpoReportFd6Main = DB::table('prokolpo_details')
    ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
    ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
    ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
    ->where('prokolpo_details.type','fd6')
    ->whereIn('fd6_form_prokolpo_areas.division_name',$request->division_name)
    ->orderBy('prokolpo_details.id','desc')
    ->get();


    $prokolpoReportFd7Main = DB::table('prokolpo_details')
 ->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
 ->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
 ->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
 ->where('prokolpo_details.type','fd7')
 ->whereIn('fd7_form_prokolpo_areas.division_name',$request->division_name)
 ->orderBy('prokolpo_details.id','desc')
 ->get();

    $prokolpoReportFc1Main = DB::table('prokolpo_details')
 ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
 ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
 ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
 ->where('prokolpo_details.type','fc1')
 ->where('prokolpo_areas.type','fcOne')
 ->whereIn('prokolpo_areas.division_name',$request->division_name)
 ->orderBy('prokolpo_details.id','desc')
 ->get();

    $prokolpoReportFc2Main = DB::table('prokolpo_details')
 ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
 ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
 ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
 ->where('prokolpo_details.type','fc2')
 ->where('prokolpo_areas.type','fcTwo')
 ->whereIn('prokolpo_areas.division_name',$request->division_name)
 ->orderBy('prokolpo_details.id','desc')
 ->get();

}elseif(empty($prokolpoYear) && empty($divisionName)){

    $prokolpoReportFd6Main = DB::table('prokolpo_details')
    ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
    ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
    ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
    ->where('prokolpo_details.type','fd6')
    ->whereIn('fd6_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
    ->whereIn('fd6_form_prokolpo_areas.district_name',$request->distric_name)
    ->orderBy('prokolpo_details.id','desc')
    ->get();


    $prokolpoReportFd7Main = DB::table('prokolpo_details')
 ->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
 ->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
 ->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
 ->where('prokolpo_details.type','fd7')
 ->whereIn('fd7_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
 ->whereIn('fd7_form_prokolpo_areas.district_name',$request->distric_name)
 ->orderBy('prokolpo_details.id','desc')
 ->get();

    $prokolpoReportFc1Main = DB::table('prokolpo_details')
 ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
 ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
 ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
 ->where('prokolpo_details.type','fc1')
 ->where('prokolpo_areas.type','fcOne')
 ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
 ->whereIn('prokolpo_areas.district_name',$request->distric_name)
 ->orderBy('prokolpo_details.id','desc')
 ->get();

    $prokolpoReportFc2Main = DB::table('prokolpo_details')
 ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
 ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
 ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
 ->where('prokolpo_details.type','fc2')
 ->where('prokolpo_areas.type','fcTwo')
 ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
 ->whereIn('prokolpo_areas.district_name',$request->distric_name)
 ->orderBy('prokolpo_details.id','desc')
 ->get();

}elseif(empty($prokolpoYear) && empty($distrcitName)){

    $prokolpoReportFd6Main = DB::table('prokolpo_details')
    ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
    ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
    ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
    ->where('prokolpo_details.type','fd6')
    ->whereIn('fd6_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
    ->whereIn('fd6_form_prokolpo_areas.division_name',$request->division_name)
    ->orderBy('prokolpo_details.id','desc')
    ->get();


    $prokolpoReportFd7Main = DB::table('prokolpo_details')
 ->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
 ->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
 ->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
 ->where('prokolpo_details.type','fd7')
 ->whereIn('fd7_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
 ->whereIn('fd7_form_prokolpo_areas.division_name',$request->division_name)
 ->orderBy('prokolpo_details.id','desc')
 ->get();

    $prokolpoReportFc1Main = DB::table('prokolpo_details')
 ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
 ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
 ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
 ->where('prokolpo_details.type','fc1')
 ->where('prokolpo_areas.type','fcOne')
 ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
 ->whereIn('prokolpo_areas.division_name',$request->division_name)
 ->orderBy('prokolpo_details.id','desc')
 ->get();

    $prokolpoReportFc2Main = DB::table('prokolpo_details')
 ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
 ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
 ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
 ->where('prokolpo_details.type','fc2')
 ->where('prokolpo_areas.type','fcTwo')
 ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
 ->whereIn('prokolpo_areas.division_name',$request->division_name)
 ->orderBy('prokolpo_details.id','desc')
 ->get();

}elseif(empty($prokolpoYear) && empty($prokolpoType)){

    $prokolpoReportFd6Main = DB::table('prokolpo_details')
    ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
    ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
    ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
    ->where('prokolpo_details.type','fd6')
    ->whereIn('fd6_form_prokolpo_areas.division_name',$request->division_name)
    ->whereIn('fd6_form_prokolpo_areas.district_name',$request->distric_name)
    ->orderBy('prokolpo_details.id','desc')
    ->get();


    $prokolpoReportFd7Main = DB::table('prokolpo_details')
 ->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
 ->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
 ->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
 ->where('prokolpo_details.type','fd7')
 ->whereIn('fd7_form_prokolpo_areas.division_name',$request->division_name)
 ->whereIn('fd7_form_prokolpo_areas.district_name',$request->distric_name)
 ->orderBy('prokolpo_details.id','desc')
 ->get();

    $prokolpoReportFc1Main = DB::table('prokolpo_details')
 ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
 ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
 ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
 ->where('prokolpo_details.type','fc1')
 ->where('prokolpo_areas.type','fcOne')
 ->whereIn('prokolpo_areas.division_name',$request->division_name)
 ->whereIn('prokolpo_areas.district_name',$request->distric_name)
 ->orderBy('prokolpo_details.id','desc')
 ->get();

    $prokolpoReportFc2Main = DB::table('prokolpo_details')
 ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
 ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
 ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
 ->where('prokolpo_details.type','fc2')
 ->where('prokolpo_areas.type','fcTwo')
 ->whereIn('prokolpo_areas.division_name',$request->division_name)
 ->whereIn('prokolpo_areas.district_name',$request->distric_name)
 ->orderBy('prokolpo_details.id','desc')
 ->get();

}elseif(empty($divisionName) && empty($distrcitName)){

    $formYear = $request->prokolpo_year;
    $toYear =$request->prokolpo_year+1;

    $formDate = $formYear.'-07-01';
    $toDate = $toYear.'-06-30';

    $prokolpoReportFd6Main = DB::table('prokolpo_details')
    ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
    ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
    ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
    ->where('prokolpo_details.type','fd6')
    ->whereIn('fd6_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
    ->whereBetween('fd6_form_prokolpo_areas.created_at', [$formDate, $toDate])
    ->orderBy('prokolpo_details.id','desc')
    ->get();

    $prokolpoReportFd7Main = DB::table('prokolpo_details')
->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
->where('prokolpo_details.type','fd7')
->whereIn('fd7_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
->whereBetween('fd7_form_prokolpo_areas.created_at', [$formDate, $toDate])
->orderBy('prokolpo_details.id','desc')
->get();


    $prokolpoReportFc1Main = DB::table('prokolpo_details')
->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
->where('prokolpo_details.type','fc1')
->where('prokolpo_areas.type','fcOne')
->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
->orderBy('prokolpo_details.id','desc')
->get();


    $prokolpoReportFc2Main = DB::table('prokolpo_details')
->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
->where('prokolpo_details.type','fc2')
->where('prokolpo_areas.type','fcTwo')
->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
->orderBy('prokolpo_details.id','desc')
->get();

}elseif(empty($divisionName) && empty($prokolpoType)){

    $formYear = $request->prokolpo_year;
    $toYear =$request->prokolpo_year+1;

    $formDate = $formYear.'-07-01';
    $toDate = $toYear.'-06-30';

    $prokolpoReportFd6Main = DB::table('prokolpo_details')
    ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
    ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
    ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
    ->where('prokolpo_details.type','fd6')
    ->whereIn('fd6_form_prokolpo_areas.district_name',$request->distric_name)
    ->whereBetween('fd6_form_prokolpo_areas.created_at', [$formDate, $toDate])
    ->orderBy('prokolpo_details.id','desc')
    ->get();

    $prokolpoReportFd7Main = DB::table('prokolpo_details')
->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
->where('prokolpo_details.type','fd7')
->whereIn('fd7_form_prokolpo_areas.district_name',$request->distric_name)
->whereBetween('fd7_form_prokolpo_areas.created_at', [$formDate, $toDate])
->orderBy('prokolpo_details.id','desc')
->get();


    $prokolpoReportFc1Main = DB::table('prokolpo_details')
->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
->where('prokolpo_details.type','fc1')
->where('prokolpo_areas.type','fcOne')
->whereIn('prokolpo_areas.district_name',$request->distric_name)
->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
->orderBy('prokolpo_details.id','desc')
->get();


    $prokolpoReportFc2Main = DB::table('prokolpo_details')
->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
->where('prokolpo_details.type','fc2')
->where('prokolpo_areas.type','fcTwo')
->whereIn('prokolpo_areas.district_name',$request->distric_name)
->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
->orderBy('prokolpo_details.id','desc')
->get();

}elseif(empty($distrcitName) && empty($prokolpoType)){


    $formYear = $request->prokolpo_year;
    $toYear =$request->prokolpo_year+1;

    $formDate = $formYear.'-07-01';
    $toDate = $toYear.'-06-30';

    $prokolpoReportFd6Main = DB::table('prokolpo_details')
    ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
    ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
    ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
    ->where('prokolpo_details.type','fd6')
    ->whereIn('fd6_form_prokolpo_areas.division_name',$request->division_name)
    ->whereBetween('fd6_form_prokolpo_areas.created_at', [$formDate, $toDate])
    ->orderBy('prokolpo_details.id','desc')
    ->get();

    $prokolpoReportFd7Main = DB::table('prokolpo_details')
->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
->where('prokolpo_details.type','fd7')
->whereIn('fd7_form_prokolpo_areas.division_name',$request->division_name)
->whereBetween('fd7_form_prokolpo_areas.created_at', [$formDate, $toDate])
->orderBy('prokolpo_details.id','desc')
->get();


    $prokolpoReportFc1Main = DB::table('prokolpo_details')
->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
->where('prokolpo_details.type','fc1')
->where('prokolpo_areas.type','fcOne')
->whereIn('prokolpo_areas.division_name',$request->division_name)
->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
->orderBy('prokolpo_details.id','desc')
->get();


    $prokolpoReportFc2Main = DB::table('prokolpo_details')
->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
->where('prokolpo_details.type','fc2')
->where('prokolpo_areas.type','fcTwo')
->whereIn('prokolpo_areas.division_name',$request->division_name)
->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
->orderBy('prokolpo_details.id','desc')
->get();

}elseif(empty($prokolpoYear)){


    $prokolpoReportFd6Main = DB::table('prokolpo_details')
    ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
    ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
    ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
    ->where('prokolpo_details.type','fd6')
    ->whereIn('fd6_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
    ->whereIn('fd6_form_prokolpo_areas.division_name',$request->division_name)
    ->whereIn('fd6_form_prokolpo_areas.district_name',$request->distric_name)
    ->orderBy('prokolpo_details.id','desc')
    ->get();


    $prokolpoReportFd7Main = DB::table('prokolpo_details')
 ->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
 ->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
 ->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
 ->where('prokolpo_details.type','fd7')
 ->whereIn('fd7_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
 ->whereIn('fd7_form_prokolpo_areas.division_name',$request->division_name)
 ->whereIn('fd7_form_prokolpo_areas.district_name',$request->distric_name)
 ->orderBy('prokolpo_details.id','desc')
 ->get();

    $prokolpoReportFc1Main = DB::table('prokolpo_details')
 ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
 ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
 ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
 ->where('prokolpo_details.type','fc1')
 ->where('prokolpo_areas.type','fcOne')
 ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
 ->whereIn('prokolpo_areas.division_name',$request->division_name)
 ->whereIn('prokolpo_areas.district_name',$request->distric_name)
 ->orderBy('prokolpo_details.id','desc')
 ->get();

    $prokolpoReportFc2Main = DB::table('prokolpo_details')
 ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
 ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
 ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
 ->where('prokolpo_details.type','fc2')
 ->where('prokolpo_areas.type','fcTwo')
 ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
 ->whereIn('prokolpo_areas.division_name',$request->division_name)
 ->whereIn('prokolpo_areas.district_name',$request->distric_name)
 ->orderBy('prokolpo_details.id','desc')
 ->get();

}elseif(empty($divisionName)){

    $formYear = $request->prokolpo_year;
    $toYear =$request->prokolpo_year+1;

    $formDate = $formYear.'-07-01';
    $toDate = $toYear.'-06-30';

    $prokolpoReportFd6Main = DB::table('prokolpo_details')
    ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
    ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
    ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
    ->where('prokolpo_details.type','fd6')
    ->whereBetween('fd6_form_prokolpo_areas.created_at', [$formDate, $toDate])
    ->whereIn('fd6_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
    ->whereIn('fd6_form_prokolpo_areas.district_name',$request->distric_name)
    ->orderBy('prokolpo_details.id','desc')
    ->get();


    $prokolpoReportFd7Main = DB::table('prokolpo_details')
 ->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
 ->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
 ->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
 ->where('prokolpo_details.type','fd7')
 ->whereBetween('fd7_form_prokolpo_areas.created_at', [$formDate, $toDate])
 ->whereIn('fd7_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
 ->whereIn('fd7_form_prokolpo_areas.district_name',$request->distric_name)
 ->orderBy('prokolpo_details.id','desc')
 ->get();

    $prokolpoReportFc1Main = DB::table('prokolpo_details')
 ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
 ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
 ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
 ->where('prokolpo_details.type','fc1')
 ->where('prokolpo_areas.type','fcOne')
 ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
 ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
 ->whereIn('prokolpo_areas.district_name',$request->distric_name)
 ->orderBy('prokolpo_details.id','desc')
 ->get();

    $prokolpoReportFc2Main = DB::table('prokolpo_details')
 ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
 ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
 ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
 ->where('prokolpo_details.type','fc2')
 ->where('prokolpo_areas.type','fcTwo')
 ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
 ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
 ->whereIn('prokolpo_areas.district_name',$request->distric_name)
 ->orderBy('prokolpo_details.id','desc')
 ->get();

}elseif(empty($distrcitName)){

    $formYear = $request->prokolpo_year;
    $toYear =$request->prokolpo_year+1;

    $formDate = $formYear.'-07-01';
    $toDate = $toYear.'-06-30';


    $prokolpoReportFd6Main = DB::table('prokolpo_details')
    ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
    ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
    ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
    ->where('prokolpo_details.type','fd6')
    ->whereBetween('fd6_form_prokolpo_areas.created_at', [$formDate, $toDate])
    ->whereIn('fd6_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
    ->whereIn('fd6_form_prokolpo_areas.division_name',$request->division_name)
    ->orderBy('prokolpo_details.id','desc')
    ->get();


    $prokolpoReportFd7Main = DB::table('prokolpo_details')
 ->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
 ->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
 ->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
 ->where('prokolpo_details.type','fd7')
 ->whereBetween('fd7_form_prokolpo_areas.created_at', [$formDate, $toDate])
 ->whereIn('fd7_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
 ->whereIn('fd7_form_prokolpo_areas.division_name',$request->division_name)
 ->orderBy('prokolpo_details.id','desc')
 ->get();

    $prokolpoReportFc1Main = DB::table('prokolpo_details')
 ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
 ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
 ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
 ->where('prokolpo_details.type','fc1')
 ->where('prokolpo_areas.type','fcOne')
 ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
 ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
 ->whereIn('prokolpo_areas.division_name',$request->division_name)
 ->orderBy('prokolpo_details.id','desc')
 ->get();

    $prokolpoReportFc2Main = DB::table('prokolpo_details')
 ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
 ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
 ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
 ->where('prokolpo_details.type','fc2')
 ->where('prokolpo_areas.type','fcTwo')
 ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
 ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
 ->whereIn('prokolpo_areas.division_name',$request->division_name)
 ->orderBy('prokolpo_details.id','desc')
 ->get();

}elseif(empty($prokolpoType)){

    $formYear = $request->prokolpo_year;
    $toYear =$request->prokolpo_year+1;

    $formDate = $formYear.'-07-01';
    $toDate = $toYear.'-06-30';


    $prokolpoReportFd6Main = DB::table('prokolpo_details')
    ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
    ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
    ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
    ->where('prokolpo_details.type','fd6')
    ->whereBetween('fd6_form_prokolpo_areas.created_at', [$formDate, $toDate])

    ->whereIn('fd6_form_prokolpo_areas.division_name',$request->division_name)
    ->whereIn('fd6_form_prokolpo_areas.district_name',$request->distric_name)
    ->orderBy('prokolpo_details.id','desc')
    ->get();


    $prokolpoReportFd7Main = DB::table('prokolpo_details')
 ->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
 ->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
 ->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
 ->where('prokolpo_details.type','fd7')
 ->whereBetween('fd7_form_prokolpo_areas.created_at', [$formDate, $toDate])

 ->whereIn('fd7_form_prokolpo_areas.division_name',$request->division_name)
 ->whereIn('fd7_form_prokolpo_areas.district_name',$request->distric_name)
 ->orderBy('prokolpo_details.id','desc')
 ->get();

    $prokolpoReportFc1Main = DB::table('prokolpo_details')
 ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
 ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
 ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
 ->where('prokolpo_details.type','fc1')
 ->where('prokolpo_areas.type','fcOne')
 ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])

 ->whereIn('prokolpo_areas.division_name',$request->division_name)
 ->whereIn('prokolpo_areas.district_name',$request->distric_name)
 ->orderBy('prokolpo_details.id','desc')
 ->get();

    $prokolpoReportFc2Main = DB::table('prokolpo_details')
 ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
 ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
 ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
 ->where('prokolpo_details.type','fc2')
 ->where('prokolpo_areas.type','fcTwo')
 ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])

 ->whereIn('prokolpo_areas.division_name',$request->division_name)
 ->whereIn('prokolpo_areas.district_name',$request->distric_name)
 ->orderBy('prokolpo_details.id','desc')
 ->get();

}else{

    $formYear = $request->prokolpo_year;
    $toYear =$request->prokolpo_year+1;

    $formDate = $formYear.'-07-01';
    $toDate = $toYear.'-06-30';


    $prokolpoReportFd6Main = DB::table('prokolpo_details')
    ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
    ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
    ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
    ->where('prokolpo_details.type','fd6')
    ->whereBetween('fd6_form_prokolpo_areas.created_at', [$formDate, $toDate])
    ->whereIn('fd6_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
    ->whereIn('fd6_form_prokolpo_areas.division_name',$request->division_name)
    ->whereIn('fd6_form_prokolpo_areas.district_name',$request->distric_name)
    ->orderBy('prokolpo_details.id','desc')
    ->get();


    $prokolpoReportFd7Main = DB::table('prokolpo_details')
 ->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
 ->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
 ->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
 ->where('prokolpo_details.type','fd7')
 ->whereBetween('fd7_form_prokolpo_areas.created_at', [$formDate, $toDate])
 ->whereIn('fd7_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
 ->whereIn('fd7_form_prokolpo_areas.division_name',$request->division_name)
 ->whereIn('fd7_form_prokolpo_areas.district_name',$request->distric_name)
 ->orderBy('prokolpo_details.id','desc')
 ->get();

    $prokolpoReportFc1Main = DB::table('prokolpo_details')
 ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
 ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
 ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
 ->where('prokolpo_details.type','fc1')
 ->where('prokolpo_areas.type','fcOne')
 ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
 ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
 ->whereIn('prokolpo_areas.division_name',$request->division_name)
 ->whereIn('prokolpo_areas.district_name',$request->distric_name)
 ->orderBy('prokolpo_details.id','desc')
 ->get();

    $prokolpoReportFc2Main = DB::table('prokolpo_details')
 ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
 ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
 ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
 ->where('prokolpo_details.type','fc2')
 ->where('prokolpo_areas.type','fcTwo')
 ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
 ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
 ->whereIn('prokolpo_areas.division_name',$request->division_name)
 ->whereIn('prokolpo_areas.district_name',$request->distric_name)
 ->orderBy('prokolpo_details.id','desc')
 ->get();


}
//end new code start



            return view('admin.report.beneficiaries.prokolpoReportSearch',compact('prokolpoYear','divisionName','distrcitName','prokolpoType','cityCorporationList','districtList','divisionList','projectSubjectList','prokolpoReportFc2Main','prokolpoReportFc1Main','prokolpoReportFd7Main','prokolpoReportFd6Main','prokolpoReportFc2','prokolpoReportFc1','prokolpoReportFd7','prokolpoReport','prokolpoReportFd6'));
            //end for by form  form



    }


    public function prokolpoReportSearch(Request $request){



        if (is_null($this->user) || !$this->user->can('prokolpoReportView')) {
            //abort(403, 'Sorry !! You are Unauthorized to view !');
            return redirect()->route('error_404');
        }

       // dd($request->all());
        $prokolpoYear = $request->prokolpo_year;
        $prokolpoType = $request->prokolpo_type;
        $distrcitName = $request->distric_name;
        $divisionName = $request->division_name;

        $projectSubjectList = ProjectSubject::orderBy('id','desc')->get();
        $prokolpoReport = DB::table('prokolpo_details')->latest()->get();

        $prokolpoReportFd6 = DB::table('prokolpo_details')->where('type','fd6')->count();
        $prokolpoReportFd7 = DB::table('prokolpo_details')->where('type','fd7')->count();
        $prokolpoReportFc1 = DB::table('prokolpo_details')->where('type','fc1')->count();
        $prokolpoReportFc2 = DB::table('prokolpo_details')->where('type','fc2')->count();


        $divisionList = DB::table('civilinfos')->groupBy('division_bn')->select('division_bn')->get();
        $districtList = DB::table('civilinfos')->groupBy('district_bn')->select('district_bn')->get();
        $cityCorporationList = DB::table('civilinfos')->whereNotNull('city_orporation')
        ->groupBy('city_orporation')->select('city_orporation')->get();


        // new code start

        if(empty($prokolpoType) && empty($divisionName) && empty($distrcitName)){

            $formYear = $request->prokolpo_year;
            $toYear =$request->prokolpo_year+1;

            if($request->filter_type == 'yearly'){


            $formDate = $formYear.'-07-01';
            $toDate = $toYear.'-06-30';
        }else{


            $formDate = date('Y-m-d', strtotime($request->from));
            $toDate = date('Y-m-d', strtotime($request->to));


        }

            $prokolpoReportFd6Main = DB::table('prokolpo_details')
            ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
            ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
            ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
            ->where('prokolpo_details.type','fd6')
            ->whereBetween('fd6_form_prokolpo_areas.created_at', [$formDate, $toDate])
            ->orderBy('prokolpo_details.id','desc')
            ->get();

            $prokolpoReportFd7Main = DB::table('prokolpo_details')
    ->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
    ->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
    ->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
    ->where('prokolpo_details.type','fd7')
    ->whereBetween('fd7_form_prokolpo_areas.created_at', [$formDate, $toDate])
    ->orderBy('prokolpo_details.id','desc')
    ->get();


            $prokolpoReportFc1Main = DB::table('prokolpo_details')
    ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
    ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
    ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
    ->where('prokolpo_details.type','fc1')
    ->where('prokolpo_areas.type','fcOne')
    ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
    ->orderBy('prokolpo_details.id','desc')
    ->get();


            $prokolpoReportFc2Main = DB::table('prokolpo_details')
    ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
    ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
    ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
    ->where('prokolpo_details.type','fc2')
    ->where('prokolpo_areas.type','fcTwo')
    ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
    ->orderBy('prokolpo_details.id','desc')
    ->get();

        }elseif(empty($prokolpoYear) && empty($divisionName) && empty($distrcitName)){

            $prokolpoReportFd6Main = DB::table('prokolpo_details')
            ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
            ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
            ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
            ->where('prokolpo_details.type','fd6')
            ->whereBetween('fd6_form_prokolpo_areas.prokolpo_type',$prokolpoType)
            ->orderBy('prokolpo_details.id','desc')
            ->get();

            $prokolpoReportFd7Main = DB::table('prokolpo_details')
    ->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
    ->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
    ->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
    ->where('prokolpo_details.type','fd7')
    ->whereIn('fd7_form_prokolpo_areas.prokolpo_type',$prokolpoType)
    ->orderBy('prokolpo_details.id','desc')
    ->get();


            $prokolpoReportFc1Main = DB::table('prokolpo_details')
    ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
    ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
    ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
    ->where('prokolpo_details.type','fc1')
    ->where('prokolpo_areas.type','fcOne')
    ->whereIn('prokolpo_areas.prokolpo_type',$prokolpoType)
    ->orderBy('prokolpo_details.id','desc')
    ->get();


            $prokolpoReportFc2Main = DB::table('prokolpo_details')
    ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
    ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
    ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
    ->where('prokolpo_details.type','fc2')
    ->where('prokolpo_areas.type','fcTwo')
    ->whereIn('prokolpo_areas.prokolpo_type',$prokolpoType)
    ->orderBy('prokolpo_details.id','desc')
    ->get();

        }elseif(empty($prokolpoYear) && empty($divisionName) && empty($prokolpoType)){

            $prokolpoReportFd6Main = DB::table('prokolpo_details')
            ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
            ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
            ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
            ->where('prokolpo_details.type','fd6')
            ->whereIn('fd6_form_prokolpo_areas.district_name',$request->distric_name)
            ->orderBy('prokolpo_details.id','desc')
            ->get();


            $prokolpoReportFd7Main = DB::table('prokolpo_details')
         ->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
         ->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
         ->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
         ->where('prokolpo_details.type','fd7')
         ->whereIn('fd7_form_prokolpo_areas.district_name',$request->distric_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();

            $prokolpoReportFc1Main = DB::table('prokolpo_details')
         ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
         ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
         ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
         ->where('prokolpo_details.type','fc1')
         ->where('prokolpo_areas.type','fcOne')
         ->whereIn('prokolpo_areas.district_name',$request->distric_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();

            $prokolpoReportFc2Main = DB::table('prokolpo_details')
         ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
         ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
         ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
         ->where('prokolpo_details.type','fc2')
         ->where('prokolpo_areas.type','fcTwo')
         ->whereIn('prokolpo_areas.district_name',$request->distric_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();

        }elseif(empty($prokolpoYear) && empty($distrcitName) && empty($prokolpoType)){

            $prokolpoReportFd6Main = DB::table('prokolpo_details')
            ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
            ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
            ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
            ->where('prokolpo_details.type','fd6')
            ->whereIn('fd6_form_prokolpo_areas.division_name',$request->division_name)
            ->orderBy('prokolpo_details.id','desc')
            ->get();


            $prokolpoReportFd7Main = DB::table('prokolpo_details')
         ->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
         ->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
         ->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
         ->where('prokolpo_details.type','fd7')
         ->whereIn('fd7_form_prokolpo_areas.division_name',$request->division_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();

            $prokolpoReportFc1Main = DB::table('prokolpo_details')
         ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
         ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
         ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
         ->where('prokolpo_details.type','fc1')
         ->where('prokolpo_areas.type','fcOne')
         ->whereIn('prokolpo_areas.division_name',$request->division_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();

            $prokolpoReportFc2Main = DB::table('prokolpo_details')
         ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
         ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
         ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
         ->where('prokolpo_details.type','fc2')
         ->where('prokolpo_areas.type','fcTwo')
         ->whereIn('prokolpo_areas.division_name',$request->division_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();

        }elseif(empty($prokolpoYear) && empty($divisionName)){

            $prokolpoReportFd6Main = DB::table('prokolpo_details')
            ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
            ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
            ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
            ->where('prokolpo_details.type','fd6')
            ->whereIn('fd6_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
            ->whereIn('fd6_form_prokolpo_areas.district_name',$request->distric_name)
            ->orderBy('prokolpo_details.id','desc')
            ->get();


            $prokolpoReportFd7Main = DB::table('prokolpo_details')
         ->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
         ->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
         ->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
         ->where('prokolpo_details.type','fd7')
         ->whereIn('fd7_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
         ->whereIn('fd7_form_prokolpo_areas.district_name',$request->distric_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();

            $prokolpoReportFc1Main = DB::table('prokolpo_details')
         ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
         ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
         ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
         ->where('prokolpo_details.type','fc1')
         ->where('prokolpo_areas.type','fcOne')
         ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
         ->whereIn('prokolpo_areas.district_name',$request->distric_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();

            $prokolpoReportFc2Main = DB::table('prokolpo_details')
         ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
         ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
         ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
         ->where('prokolpo_details.type','fc2')
         ->where('prokolpo_areas.type','fcTwo')
         ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
         ->whereIn('prokolpo_areas.district_name',$request->distric_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();

        }elseif(empty($prokolpoYear) && empty($distrcitName)){

            $prokolpoReportFd6Main = DB::table('prokolpo_details')
            ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
            ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
            ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
            ->where('prokolpo_details.type','fd6')
            ->whereIn('fd6_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
            ->whereIn('fd6_form_prokolpo_areas.division_name',$request->division_name)
            ->orderBy('prokolpo_details.id','desc')
            ->get();


            $prokolpoReportFd7Main = DB::table('prokolpo_details')
         ->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
         ->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
         ->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
         ->where('prokolpo_details.type','fd7')
         ->whereIn('fd7_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
         ->whereIn('fd7_form_prokolpo_areas.division_name',$request->division_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();

            $prokolpoReportFc1Main = DB::table('prokolpo_details')
         ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
         ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
         ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
         ->where('prokolpo_details.type','fc1')
         ->where('prokolpo_areas.type','fcOne')
         ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
         ->whereIn('prokolpo_areas.division_name',$request->division_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();

            $prokolpoReportFc2Main = DB::table('prokolpo_details')
         ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
         ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
         ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
         ->where('prokolpo_details.type','fc2')
         ->where('prokolpo_areas.type','fcTwo')
         ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
         ->whereIn('prokolpo_areas.division_name',$request->division_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();

        }elseif(empty($prokolpoYear) && empty($prokolpoType)){

            $prokolpoReportFd6Main = DB::table('prokolpo_details')
            ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
            ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
            ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
            ->where('prokolpo_details.type','fd6')
            ->whereIn('fd6_form_prokolpo_areas.division_name',$request->division_name)
            ->whereIn('fd6_form_prokolpo_areas.district_name',$request->distric_name)
            ->orderBy('prokolpo_details.id','desc')
            ->get();


            $prokolpoReportFd7Main = DB::table('prokolpo_details')
         ->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
         ->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
         ->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
         ->where('prokolpo_details.type','fd7')
         ->whereIn('fd7_form_prokolpo_areas.division_name',$request->division_name)
         ->whereIn('fd7_form_prokolpo_areas.district_name',$request->distric_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();

            $prokolpoReportFc1Main = DB::table('prokolpo_details')
         ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
         ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
         ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
         ->where('prokolpo_details.type','fc1')
         ->where('prokolpo_areas.type','fcOne')
         ->whereIn('prokolpo_areas.division_name',$request->division_name)
         ->whereIn('prokolpo_areas.district_name',$request->distric_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();

            $prokolpoReportFc2Main = DB::table('prokolpo_details')
         ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
         ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
         ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
         ->where('prokolpo_details.type','fc2')
         ->where('prokolpo_areas.type','fcTwo')
         ->whereIn('prokolpo_areas.division_name',$request->division_name)
         ->whereIn('prokolpo_areas.district_name',$request->distric_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();

        }elseif(empty($divisionName) && empty($distrcitName)){

            $formYear = $request->prokolpo_year;
            $toYear =$request->prokolpo_year+1;

            if($request->filter_type == 'yearly'){


                $formDate = $formYear.'-07-01';
                $toDate = $toYear.'-06-30';
            }else{


                $formDate = date('Y-m-d', strtotime($request->from));
                $toDate = date('Y-m-d', strtotime($request->to));

            }

            $prokolpoReportFd6Main = DB::table('prokolpo_details')
            ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
            ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
            ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
            ->where('prokolpo_details.type','fd6')
            ->whereIn('fd6_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
            ->whereBetween('fd6_form_prokolpo_areas.created_at', [$formDate, $toDate])
            ->orderBy('prokolpo_details.id','desc')
            ->get();

            $prokolpoReportFd7Main = DB::table('prokolpo_details')
    ->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
    ->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
    ->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
    ->where('prokolpo_details.type','fd7')
    ->whereIn('fd7_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
    ->whereBetween('fd7_form_prokolpo_areas.created_at', [$formDate, $toDate])
    ->orderBy('prokolpo_details.id','desc')
    ->get();


            $prokolpoReportFc1Main = DB::table('prokolpo_details')
    ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
    ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
    ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
    ->where('prokolpo_details.type','fc1')
    ->where('prokolpo_areas.type','fcOne')
    ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
    ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
    ->orderBy('prokolpo_details.id','desc')
    ->get();


            $prokolpoReportFc2Main = DB::table('prokolpo_details')
    ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
    ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
    ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
    ->where('prokolpo_details.type','fc2')
    ->where('prokolpo_areas.type','fcTwo')
    ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
    ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
    ->orderBy('prokolpo_details.id','desc')
    ->get();

        }elseif(empty($divisionName) && empty($prokolpoType)){

            $formYear = $request->prokolpo_year;
            $toYear =$request->prokolpo_year+1;

            if($request->filter_type == 'yearly'){


                $formDate = $formYear.'-07-01';
                $toDate = $toYear.'-06-30';
            }else{


                $formDate = date('Y-m-d', strtotime($request->from));
                $toDate = date('Y-m-d', strtotime($request->to));

            }

            $prokolpoReportFd6Main = DB::table('prokolpo_details')
            ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
            ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
            ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
            ->where('prokolpo_details.type','fd6')
            ->whereIn('fd6_form_prokolpo_areas.district_name',$request->distric_name)
            ->whereBetween('fd6_form_prokolpo_areas.created_at', [$formDate, $toDate])
            ->orderBy('prokolpo_details.id','desc')
            ->get();

            $prokolpoReportFd7Main = DB::table('prokolpo_details')
    ->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
    ->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
    ->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
    ->where('prokolpo_details.type','fd7')
    ->whereIn('fd7_form_prokolpo_areas.district_name',$request->distric_name)
    ->whereBetween('fd7_form_prokolpo_areas.created_at', [$formDate, $toDate])
    ->orderBy('prokolpo_details.id','desc')
    ->get();


            $prokolpoReportFc1Main = DB::table('prokolpo_details')
    ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
    ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
    ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
    ->where('prokolpo_details.type','fc1')
    ->where('prokolpo_areas.type','fcOne')
    ->whereIn('prokolpo_areas.district_name',$request->distric_name)
    ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
    ->orderBy('prokolpo_details.id','desc')
    ->get();


            $prokolpoReportFc2Main = DB::table('prokolpo_details')
    ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
    ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
    ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
    ->where('prokolpo_details.type','fc2')
    ->where('prokolpo_areas.type','fcTwo')
    ->whereIn('prokolpo_areas.district_name',$request->distric_name)
    ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
    ->orderBy('prokolpo_details.id','desc')
    ->get();

        }elseif(empty($distrcitName) && empty($prokolpoType)){


            $formYear = $request->prokolpo_year;
            $toYear =$request->prokolpo_year+1;

            if($request->filter_type == 'yearly'){


                $formDate = $formYear.'-07-01';
                $toDate = $toYear.'-06-30';
            }else{


                $formDate = date('Y-m-d', strtotime($request->from));
                $toDate = date('Y-m-d', strtotime($request->to));

            }

            $prokolpoReportFd6Main = DB::table('prokolpo_details')
            ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
            ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
            ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
            ->where('prokolpo_details.type','fd6')
            ->whereIn('fd6_form_prokolpo_areas.division_name',$request->division_name)
            ->whereBetween('fd6_form_prokolpo_areas.created_at', [$formDate, $toDate])
            ->orderBy('prokolpo_details.id','desc')
            ->get();

            $prokolpoReportFd7Main = DB::table('prokolpo_details')
    ->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
    ->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
    ->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
    ->where('prokolpo_details.type','fd7')
    ->whereIn('fd7_form_prokolpo_areas.division_name',$request->division_name)
    ->whereBetween('fd7_form_prokolpo_areas.created_at', [$formDate, $toDate])
    ->orderBy('prokolpo_details.id','desc')
    ->get();


            $prokolpoReportFc1Main = DB::table('prokolpo_details')
    ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
    ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
    ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
    ->where('prokolpo_details.type','fc1')
    ->where('prokolpo_areas.type','fcOne')
    ->whereIn('prokolpo_areas.division_name',$request->division_name)
    ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
    ->orderBy('prokolpo_details.id','desc')
    ->get();


            $prokolpoReportFc2Main = DB::table('prokolpo_details')
    ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
    ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
    ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
    ->where('prokolpo_details.type','fc2')
    ->where('prokolpo_areas.type','fcTwo')
    ->whereIn('prokolpo_areas.division_name',$request->division_name)
    ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
    ->orderBy('prokolpo_details.id','desc')
    ->get();

        }elseif(empty($prokolpoYear)){


            $prokolpoReportFd6Main = DB::table('prokolpo_details')
            ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
            ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
            ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
            ->where('prokolpo_details.type','fd6')
            ->whereIn('fd6_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
            ->whereIn('fd6_form_prokolpo_areas.division_name',$request->division_name)
            ->whereIn('fd6_form_prokolpo_areas.district_name',$request->distric_name)
            ->orderBy('prokolpo_details.id','desc')
            ->get();


            $prokolpoReportFd7Main = DB::table('prokolpo_details')
         ->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
         ->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
         ->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
         ->where('prokolpo_details.type','fd7')
         ->whereIn('fd7_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
         ->whereIn('fd7_form_prokolpo_areas.division_name',$request->division_name)
         ->whereIn('fd7_form_prokolpo_areas.district_name',$request->distric_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();

            $prokolpoReportFc1Main = DB::table('prokolpo_details')
         ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
         ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
         ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
         ->where('prokolpo_details.type','fc1')
         ->where('prokolpo_areas.type','fcOne')
         ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
         ->whereIn('prokolpo_areas.division_name',$request->division_name)
         ->whereIn('prokolpo_areas.district_name',$request->distric_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();

            $prokolpoReportFc2Main = DB::table('prokolpo_details')
         ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
         ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
         ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
         ->where('prokolpo_details.type','fc2')
         ->where('prokolpo_areas.type','fcTwo')
         ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
         ->whereIn('prokolpo_areas.division_name',$request->division_name)
         ->whereIn('prokolpo_areas.district_name',$request->distric_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();

        }elseif(empty($divisionName)){

            $formYear = $request->prokolpo_year;
            $toYear =$request->prokolpo_year+1;

            if($request->filter_type == 'yearly'){


                $formDate = $formYear.'-07-01';
                $toDate = $toYear.'-06-30';
            }else{


                $formDate = date('Y-m-d', strtotime($request->from));
                $toDate = date('Y-m-d', strtotime($request->to));

            }

            $prokolpoReportFd6Main = DB::table('prokolpo_details')
            ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
            ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
            ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
            ->where('prokolpo_details.type','fd6')
            ->whereBetween('fd6_form_prokolpo_areas.created_at', [$formDate, $toDate])
            ->whereIn('fd6_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
            ->whereIn('fd6_form_prokolpo_areas.district_name',$request->distric_name)
            ->orderBy('prokolpo_details.id','desc')
            ->get();


            $prokolpoReportFd7Main = DB::table('prokolpo_details')
         ->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
         ->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
         ->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
         ->where('prokolpo_details.type','fd7')
         ->whereBetween('fd7_form_prokolpo_areas.created_at', [$formDate, $toDate])
         ->whereIn('fd7_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
         ->whereIn('fd7_form_prokolpo_areas.district_name',$request->distric_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();

            $prokolpoReportFc1Main = DB::table('prokolpo_details')
         ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
         ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
         ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
         ->where('prokolpo_details.type','fc1')
         ->where('prokolpo_areas.type','fcOne')
         ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
         ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
         ->whereIn('prokolpo_areas.district_name',$request->distric_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();

            $prokolpoReportFc2Main = DB::table('prokolpo_details')
         ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
         ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
         ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
         ->where('prokolpo_details.type','fc2')
         ->where('prokolpo_areas.type','fcTwo')
         ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
         ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
         ->whereIn('prokolpo_areas.district_name',$request->distric_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();

        }elseif(empty($distrcitName)){

            $formYear = $request->prokolpo_year;
            $toYear =$request->prokolpo_year+1;

            if($request->filter_type == 'yearly'){


                $formDate = $formYear.'-07-01';
                $toDate = $toYear.'-06-30';
            }else{


                $formDate = date('Y-m-d', strtotime($request->from));
                $toDate = date('Y-m-d', strtotime($request->to));

            }


            $prokolpoReportFd6Main = DB::table('prokolpo_details')
            ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
            ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
            ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
            ->where('prokolpo_details.type','fd6')
            ->whereBetween('fd6_form_prokolpo_areas.created_at', [$formDate, $toDate])
            ->whereIn('fd6_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
            ->whereIn('fd6_form_prokolpo_areas.division_name',$request->division_name)
            ->orderBy('prokolpo_details.id','desc')
            ->get();


            $prokolpoReportFd7Main = DB::table('prokolpo_details')
         ->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
         ->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
         ->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
         ->where('prokolpo_details.type','fd7')
         ->whereBetween('fd7_form_prokolpo_areas.created_at', [$formDate, $toDate])
         ->whereIn('fd7_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
         ->whereIn('fd7_form_prokolpo_areas.division_name',$request->division_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();

            $prokolpoReportFc1Main = DB::table('prokolpo_details')
         ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
         ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
         ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
         ->where('prokolpo_details.type','fc1')
         ->where('prokolpo_areas.type','fcOne')
         ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
         ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
         ->whereIn('prokolpo_areas.division_name',$request->division_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();

            $prokolpoReportFc2Main = DB::table('prokolpo_details')
         ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
         ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
         ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
         ->where('prokolpo_details.type','fc2')
         ->where('prokolpo_areas.type','fcTwo')
         ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
         ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
         ->whereIn('prokolpo_areas.division_name',$request->division_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();

        }elseif(empty($prokolpoType)){

            $formYear = $request->prokolpo_year;
            $toYear =$request->prokolpo_year+1;

            if($request->filter_type == 'yearly'){


                $formDate = $formYear.'-07-01';
                $toDate = $toYear.'-06-30';
            }else{


                $formDate = date('Y-m-d', strtotime($request->from));
                $toDate = date('Y-m-d', strtotime($request->to));

            }


            $prokolpoReportFd6Main = DB::table('prokolpo_details')
            ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
            ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
            ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
            ->where('prokolpo_details.type','fd6')
            ->whereBetween('fd6_form_prokolpo_areas.created_at', [$formDate, $toDate])

            ->whereIn('fd6_form_prokolpo_areas.division_name',$request->division_name)
            ->whereIn('fd6_form_prokolpo_areas.district_name',$request->distric_name)
            ->orderBy('prokolpo_details.id','desc')
            ->get();


            $prokolpoReportFd7Main = DB::table('prokolpo_details')
         ->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
         ->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
         ->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
         ->where('prokolpo_details.type','fd7')
         ->whereBetween('fd7_form_prokolpo_areas.created_at', [$formDate, $toDate])

         ->whereIn('fd7_form_prokolpo_areas.division_name',$request->division_name)
         ->whereIn('fd7_form_prokolpo_areas.district_name',$request->distric_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();

            $prokolpoReportFc1Main = DB::table('prokolpo_details')
         ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
         ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
         ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
         ->where('prokolpo_details.type','fc1')
         ->where('prokolpo_areas.type','fcOne')
         ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])

         ->whereIn('prokolpo_areas.division_name',$request->division_name)
         ->whereIn('prokolpo_areas.district_name',$request->distric_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();

            $prokolpoReportFc2Main = DB::table('prokolpo_details')
         ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
         ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
         ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
         ->where('prokolpo_details.type','fc2')
         ->where('prokolpo_areas.type','fcTwo')
         ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])

         ->whereIn('prokolpo_areas.division_name',$request->division_name)
         ->whereIn('prokolpo_areas.district_name',$request->distric_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();

        }else{

            $formYear = $request->prokolpo_year;
            $toYear =$request->prokolpo_year+1;

            if($request->filter_type == 'yearly'){


                $formDate = $formYear.'-07-01';
                $toDate = $toYear.'-06-30';
            }else{


                $formDate = date('Y-m-d', strtotime($request->from));
                $toDate = date('Y-m-d', strtotime($request->to));

            }


            $prokolpoReportFd6Main = DB::table('prokolpo_details')
            ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
            ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
            ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
            ->where('prokolpo_details.type','fd6')
            ->whereBetween('fd6_form_prokolpo_areas.created_at', [$formDate, $toDate])
            ->whereIn('fd6_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
            ->whereIn('fd6_form_prokolpo_areas.division_name',$request->division_name)
            ->whereIn('fd6_form_prokolpo_areas.district_name',$request->distric_name)
            ->orderBy('prokolpo_details.id','desc')
            ->get();


            $prokolpoReportFd7Main = DB::table('prokolpo_details')
         ->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
         ->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
         ->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
         ->where('prokolpo_details.type','fd7')
         ->whereBetween('fd7_form_prokolpo_areas.created_at', [$formDate, $toDate])
         ->whereIn('fd7_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
         ->whereIn('fd7_form_prokolpo_areas.division_name',$request->division_name)
         ->whereIn('fd7_form_prokolpo_areas.district_name',$request->distric_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();

            $prokolpoReportFc1Main = DB::table('prokolpo_details')
         ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
         ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
         ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
         ->where('prokolpo_details.type','fc1')
         ->where('prokolpo_areas.type','fcOne')
         ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
         ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
         ->whereIn('prokolpo_areas.division_name',$request->division_name)
         ->whereIn('prokolpo_areas.district_name',$request->distric_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();

            $prokolpoReportFc2Main = DB::table('prokolpo_details')
         ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
         ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
         ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
         ->where('prokolpo_details.type','fc2')
         ->where('prokolpo_areas.type','fcTwo')
         ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
         ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
         ->whereIn('prokolpo_areas.division_name',$request->division_name)
         ->whereIn('prokolpo_areas.district_name',$request->distric_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();


        }
        //end new code start




            $from = $request->from;
            $to = $request->to;
            $filterType = $request->filter_type;



     return view('admin.report.prokolpoReportSearch',compact('to','filterType','from','divisionName','distrcitName','prokolpoType','prokolpoYear','cityCorporationList','districtList','divisionList','projectSubjectList','prokolpoReportFc2Main','prokolpoReportFc1Main','prokolpoReportFd7Main','prokolpoReportFd6Main','prokolpoReportFc2','prokolpoReportFc1','prokolpoReportFd7','prokolpoReport','prokolpoReportFd6'));



    }


    public function prokolpoBeneficiariesReportPrintSearch(Request $request){


        $prokolpoYear = $request->prokolpo_year;
        $prokolpoType = $request->prokolpo_type;
        $distrcitName = $request->distric_name;
        $divisionName = $request->division_name;

        $projectSubjectList = ProjectSubject::orderBy('id','desc')->get();
        $prokolpoReport = DB::table('prokolpo_details')->latest()->get();

        $prokolpoReportFd6 = DB::table('prokolpo_details')->where('type','fd6')->count();
        $prokolpoReportFd7 = DB::table('prokolpo_details')->where('type','fd7')->count();
        $prokolpoReportFc1 = DB::table('prokolpo_details')->where('type','fc1')->count();
        $prokolpoReportFc2 = DB::table('prokolpo_details')->where('type','fc2')->count();


        $divisionList = DB::table('civilinfos')->groupBy('division_bn')->select('division_bn')->get();
        $districtList = DB::table('civilinfos')->groupBy('district_bn')->select('district_bn')->get();
        $cityCorporationList = DB::table('civilinfos')->whereNotNull('city_orporation')
        ->groupBy('city_orporation')->select('city_orporation')->get();

         // new code start

         if(empty($prokolpoType) && empty($divisionName) && empty($distrcitName)){

            $formYear = $request->prokolpo_year;
            $toYear =$request->prokolpo_year+1;

            $formDate = $formYear.'-07-01';
            $toDate = $toYear.'-06-30';

            $prokolpoReportFd6Main = DB::table('prokolpo_details')
            ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
            ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
            ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
            ->where('prokolpo_details.type','fd6')
            ->whereBetween('fd6_form_prokolpo_areas.created_at', [$formDate, $toDate])
            ->orderBy('prokolpo_details.id','desc')
            ->get();

            $prokolpoReportFd7Main = DB::table('prokolpo_details')
    ->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
    ->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
    ->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
    ->where('prokolpo_details.type','fd7')
    ->whereBetween('fd7_form_prokolpo_areas.created_at', [$formDate, $toDate])
    ->orderBy('prokolpo_details.id','desc')
    ->get();


            $prokolpoReportFc1Main = DB::table('prokolpo_details')
    ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
    ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
    ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
    ->where('prokolpo_details.type','fc1')
    ->where('prokolpo_areas.type','fcOne')
    ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
    ->orderBy('prokolpo_details.id','desc')
    ->get();


            $prokolpoReportFc2Main = DB::table('prokolpo_details')
    ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
    ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
    ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
    ->where('prokolpo_details.type','fc2')
    ->where('prokolpo_areas.type','fcTwo')
    ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
    ->orderBy('prokolpo_details.id','desc')
    ->get();

        }elseif(empty($prokolpoYear) && empty($divisionName) && empty($distrcitName)){

            $prokolpoReportFd6Main = DB::table('prokolpo_details')
            ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
            ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
            ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
            ->where('prokolpo_details.type','fd6')
            ->whereBetween('fd6_form_prokolpo_areas.prokolpo_type',$prokolpoType)
            ->orderBy('prokolpo_details.id','desc')
            ->get();

            $prokolpoReportFd7Main = DB::table('prokolpo_details')
    ->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
    ->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
    ->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
    ->where('prokolpo_details.type','fd7')
    ->whereIn('fd7_form_prokolpo_areas.prokolpo_type',$prokolpoType)
    ->orderBy('prokolpo_details.id','desc')
    ->get();


            $prokolpoReportFc1Main = DB::table('prokolpo_details')
    ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
    ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
    ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
    ->where('prokolpo_details.type','fc1')
    ->where('prokolpo_areas.type','fcOne')
    ->whereIn('prokolpo_areas.prokolpo_type',$prokolpoType)
    ->orderBy('prokolpo_details.id','desc')
    ->get();


            $prokolpoReportFc2Main = DB::table('prokolpo_details')
    ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
    ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
    ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
    ->where('prokolpo_details.type','fc2')
    ->where('prokolpo_areas.type','fcTwo')
    ->whereIn('prokolpo_areas.prokolpo_type',$prokolpoType)
    ->orderBy('prokolpo_details.id','desc')
    ->get();

        }elseif(empty($prokolpoYear) && empty($divisionName) && empty($prokolpoType)){

            $prokolpoReportFd6Main = DB::table('prokolpo_details')
            ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
            ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
            ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
            ->where('prokolpo_details.type','fd6')
            ->whereIn('fd6_form_prokolpo_areas.district_name',$request->distric_name)
            ->orderBy('prokolpo_details.id','desc')
            ->get();


            $prokolpoReportFd7Main = DB::table('prokolpo_details')
         ->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
         ->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
         ->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
         ->where('prokolpo_details.type','fd7')
         ->whereIn('fd7_form_prokolpo_areas.district_name',$request->distric_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();

            $prokolpoReportFc1Main = DB::table('prokolpo_details')
         ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
         ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
         ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
         ->where('prokolpo_details.type','fc1')
         ->where('prokolpo_areas.type','fcOne')
         ->whereIn('prokolpo_areas.district_name',$request->distric_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();

            $prokolpoReportFc2Main = DB::table('prokolpo_details')
         ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
         ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
         ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
         ->where('prokolpo_details.type','fc2')
         ->where('prokolpo_areas.type','fcTwo')
         ->whereIn('prokolpo_areas.district_name',$request->distric_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();

        }elseif(empty($prokolpoYear) && empty($distrcitName) && empty($prokolpoType)){

            $prokolpoReportFd6Main = DB::table('prokolpo_details')
            ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
            ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
            ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
            ->where('prokolpo_details.type','fd6')
            ->whereIn('fd6_form_prokolpo_areas.division_name',$request->division_name)
            ->orderBy('prokolpo_details.id','desc')
            ->get();


            $prokolpoReportFd7Main = DB::table('prokolpo_details')
         ->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
         ->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
         ->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
         ->where('prokolpo_details.type','fd7')
         ->whereIn('fd7_form_prokolpo_areas.division_name',$request->division_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();

            $prokolpoReportFc1Main = DB::table('prokolpo_details')
         ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
         ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
         ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
         ->where('prokolpo_details.type','fc1')
         ->where('prokolpo_areas.type','fcOne')
         ->whereIn('prokolpo_areas.division_name',$request->division_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();

            $prokolpoReportFc2Main = DB::table('prokolpo_details')
         ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
         ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
         ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
         ->where('prokolpo_details.type','fc2')
         ->where('prokolpo_areas.type','fcTwo')
         ->whereIn('prokolpo_areas.division_name',$request->division_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();

        }elseif(empty($prokolpoYear) && empty($divisionName)){

            $prokolpoReportFd6Main = DB::table('prokolpo_details')
            ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
            ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
            ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
            ->where('prokolpo_details.type','fd6')
            ->whereIn('fd6_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
            ->whereIn('fd6_form_prokolpo_areas.district_name',$request->distric_name)
            ->orderBy('prokolpo_details.id','desc')
            ->get();


            $prokolpoReportFd7Main = DB::table('prokolpo_details')
         ->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
         ->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
         ->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
         ->where('prokolpo_details.type','fd7')
         ->whereIn('fd7_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
         ->whereIn('fd7_form_prokolpo_areas.district_name',$request->distric_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();

            $prokolpoReportFc1Main = DB::table('prokolpo_details')
         ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
         ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
         ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
         ->where('prokolpo_details.type','fc1')
         ->where('prokolpo_areas.type','fcOne')
         ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
         ->whereIn('prokolpo_areas.district_name',$request->distric_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();

            $prokolpoReportFc2Main = DB::table('prokolpo_details')
         ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
         ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
         ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
         ->where('prokolpo_details.type','fc2')
         ->where('prokolpo_areas.type','fcTwo')
         ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
         ->whereIn('prokolpo_areas.district_name',$request->distric_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();

        }elseif(empty($prokolpoYear) && empty($distrcitName)){

            $prokolpoReportFd6Main = DB::table('prokolpo_details')
            ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
            ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
            ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
            ->where('prokolpo_details.type','fd6')
            ->whereIn('fd6_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
            ->whereIn('fd6_form_prokolpo_areas.division_name',$request->division_name)
            ->orderBy('prokolpo_details.id','desc')
            ->get();


            $prokolpoReportFd7Main = DB::table('prokolpo_details')
         ->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
         ->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
         ->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
         ->where('prokolpo_details.type','fd7')
         ->whereIn('fd7_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
         ->whereIn('fd7_form_prokolpo_areas.division_name',$request->division_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();

            $prokolpoReportFc1Main = DB::table('prokolpo_details')
         ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
         ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
         ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
         ->where('prokolpo_details.type','fc1')
         ->where('prokolpo_areas.type','fcOne')
         ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
         ->whereIn('prokolpo_areas.division_name',$request->division_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();

            $prokolpoReportFc2Main = DB::table('prokolpo_details')
         ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
         ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
         ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
         ->where('prokolpo_details.type','fc2')
         ->where('prokolpo_areas.type','fcTwo')
         ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
         ->whereIn('prokolpo_areas.division_name',$request->division_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();

        }elseif(empty($prokolpoYear) && empty($prokolpoType)){

            $prokolpoReportFd6Main = DB::table('prokolpo_details')
            ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
            ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
            ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
            ->where('prokolpo_details.type','fd6')
            ->whereIn('fd6_form_prokolpo_areas.division_name',$request->division_name)
            ->whereIn('fd6_form_prokolpo_areas.district_name',$request->distric_name)
            ->orderBy('prokolpo_details.id','desc')
            ->get();


            $prokolpoReportFd7Main = DB::table('prokolpo_details')
         ->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
         ->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
         ->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
         ->where('prokolpo_details.type','fd7')
         ->whereIn('fd7_form_prokolpo_areas.division_name',$request->division_name)
         ->whereIn('fd7_form_prokolpo_areas.district_name',$request->distric_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();

            $prokolpoReportFc1Main = DB::table('prokolpo_details')
         ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
         ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
         ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
         ->where('prokolpo_details.type','fc1')
         ->where('prokolpo_areas.type','fcOne')
         ->whereIn('prokolpo_areas.division_name',$request->division_name)
         ->whereIn('prokolpo_areas.district_name',$request->distric_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();

            $prokolpoReportFc2Main = DB::table('prokolpo_details')
         ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
         ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
         ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
         ->where('prokolpo_details.type','fc2')
         ->where('prokolpo_areas.type','fcTwo')
         ->whereIn('prokolpo_areas.division_name',$request->division_name)
         ->whereIn('prokolpo_areas.district_name',$request->distric_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();

        }elseif(empty($divisionName) && empty($distrcitName)){

            $formYear = $request->prokolpo_year;
            $toYear =$request->prokolpo_year+1;

            $formDate = $formYear.'-07-01';
            $toDate = $toYear.'-06-30';

            $prokolpoReportFd6Main = DB::table('prokolpo_details')
            ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
            ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
            ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
            ->where('prokolpo_details.type','fd6')
            ->whereIn('fd6_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
            ->whereBetween('fd6_form_prokolpo_areas.created_at', [$formDate, $toDate])
            ->orderBy('prokolpo_details.id','desc')
            ->get();

            $prokolpoReportFd7Main = DB::table('prokolpo_details')
    ->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
    ->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
    ->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
    ->where('prokolpo_details.type','fd7')
    ->whereIn('fd7_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
    ->whereBetween('fd7_form_prokolpo_areas.created_at', [$formDate, $toDate])
    ->orderBy('prokolpo_details.id','desc')
    ->get();


            $prokolpoReportFc1Main = DB::table('prokolpo_details')
    ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
    ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
    ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
    ->where('prokolpo_details.type','fc1')
    ->where('prokolpo_areas.type','fcOne')
    ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
    ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
    ->orderBy('prokolpo_details.id','desc')
    ->get();


            $prokolpoReportFc2Main = DB::table('prokolpo_details')
    ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
    ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
    ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
    ->where('prokolpo_details.type','fc2')
    ->where('prokolpo_areas.type','fcTwo')
    ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
    ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
    ->orderBy('prokolpo_details.id','desc')
    ->get();

        }elseif(empty($divisionName) && empty($prokolpoType)){

            $formYear = $request->prokolpo_year;
            $toYear =$request->prokolpo_year+1;

            $formDate = $formYear.'-07-01';
            $toDate = $toYear.'-06-30';

            $prokolpoReportFd6Main = DB::table('prokolpo_details')
            ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
            ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
            ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
            ->where('prokolpo_details.type','fd6')
            ->whereIn('fd6_form_prokolpo_areas.district_name',$request->distric_name)
            ->whereBetween('fd6_form_prokolpo_areas.created_at', [$formDate, $toDate])
            ->orderBy('prokolpo_details.id','desc')
            ->get();

            $prokolpoReportFd7Main = DB::table('prokolpo_details')
    ->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
    ->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
    ->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
    ->where('prokolpo_details.type','fd7')
    ->whereIn('fd7_form_prokolpo_areas.district_name',$request->distric_name)
    ->whereBetween('fd7_form_prokolpo_areas.created_at', [$formDate, $toDate])
    ->orderBy('prokolpo_details.id','desc')
    ->get();


            $prokolpoReportFc1Main = DB::table('prokolpo_details')
    ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
    ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
    ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
    ->where('prokolpo_details.type','fc1')
    ->where('prokolpo_areas.type','fcOne')
    ->whereIn('prokolpo_areas.district_name',$request->distric_name)
    ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
    ->orderBy('prokolpo_details.id','desc')
    ->get();


            $prokolpoReportFc2Main = DB::table('prokolpo_details')
    ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
    ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
    ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
    ->where('prokolpo_details.type','fc2')
    ->where('prokolpo_areas.type','fcTwo')
    ->whereIn('prokolpo_areas.district_name',$request->distric_name)
    ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
    ->orderBy('prokolpo_details.id','desc')
    ->get();

        }elseif(empty($distrcitName) && empty($prokolpoType)){


            $formYear = $request->prokolpo_year;
            $toYear =$request->prokolpo_year+1;

            $formDate = $formYear.'-07-01';
            $toDate = $toYear.'-06-30';

            $prokolpoReportFd6Main = DB::table('prokolpo_details')
            ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
            ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
            ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
            ->where('prokolpo_details.type','fd6')
            ->whereIn('fd6_form_prokolpo_areas.division_name',$request->division_name)
            ->whereBetween('fd6_form_prokolpo_areas.created_at', [$formDate, $toDate])
            ->orderBy('prokolpo_details.id','desc')
            ->get();

            $prokolpoReportFd7Main = DB::table('prokolpo_details')
    ->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
    ->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
    ->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
    ->where('prokolpo_details.type','fd7')
    ->whereIn('fd7_form_prokolpo_areas.division_name',$request->division_name)
    ->whereBetween('fd7_form_prokolpo_areas.created_at', [$formDate, $toDate])
    ->orderBy('prokolpo_details.id','desc')
    ->get();


            $prokolpoReportFc1Main = DB::table('prokolpo_details')
    ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
    ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
    ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
    ->where('prokolpo_details.type','fc1')
    ->where('prokolpo_areas.type','fcOne')
    ->whereIn('prokolpo_areas.division_name',$request->division_name)
    ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
    ->orderBy('prokolpo_details.id','desc')
    ->get();


            $prokolpoReportFc2Main = DB::table('prokolpo_details')
    ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
    ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
    ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
    ->where('prokolpo_details.type','fc2')
    ->where('prokolpo_areas.type','fcTwo')
    ->whereIn('prokolpo_areas.division_name',$request->division_name)
    ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
    ->orderBy('prokolpo_details.id','desc')
    ->get();

        }elseif(empty($prokolpoYear)){


            $prokolpoReportFd6Main = DB::table('prokolpo_details')
            ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
            ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
            ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
            ->where('prokolpo_details.type','fd6')
            ->whereIn('fd6_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
            ->whereIn('fd6_form_prokolpo_areas.division_name',$request->division_name)
            ->whereIn('fd6_form_prokolpo_areas.district_name',$request->distric_name)
            ->orderBy('prokolpo_details.id','desc')
            ->get();


            $prokolpoReportFd7Main = DB::table('prokolpo_details')
         ->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
         ->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
         ->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
         ->where('prokolpo_details.type','fd7')
         ->whereIn('fd7_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
         ->whereIn('fd7_form_prokolpo_areas.division_name',$request->division_name)
         ->whereIn('fd7_form_prokolpo_areas.district_name',$request->distric_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();

            $prokolpoReportFc1Main = DB::table('prokolpo_details')
         ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
         ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
         ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
         ->where('prokolpo_details.type','fc1')
         ->where('prokolpo_areas.type','fcOne')
         ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
         ->whereIn('prokolpo_areas.division_name',$request->division_name)
         ->whereIn('prokolpo_areas.district_name',$request->distric_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();

            $prokolpoReportFc2Main = DB::table('prokolpo_details')
         ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
         ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
         ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
         ->where('prokolpo_details.type','fc2')
         ->where('prokolpo_areas.type','fcTwo')
         ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
         ->whereIn('prokolpo_areas.division_name',$request->division_name)
         ->whereIn('prokolpo_areas.district_name',$request->distric_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();

        }elseif(empty($divisionName)){

            $formYear = $request->prokolpo_year;
            $toYear =$request->prokolpo_year+1;

            $formDate = $formYear.'-07-01';
            $toDate = $toYear.'-06-30';

            $prokolpoReportFd6Main = DB::table('prokolpo_details')
            ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
            ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
            ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
            ->where('prokolpo_details.type','fd6')
            ->whereBetween('fd6_form_prokolpo_areas.created_at', [$formDate, $toDate])
            ->whereIn('fd6_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
            ->whereIn('fd6_form_prokolpo_areas.district_name',$request->distric_name)
            ->orderBy('prokolpo_details.id','desc')
            ->get();


            $prokolpoReportFd7Main = DB::table('prokolpo_details')
         ->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
         ->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
         ->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
         ->where('prokolpo_details.type','fd7')
         ->whereBetween('fd7_form_prokolpo_areas.created_at', [$formDate, $toDate])
         ->whereIn('fd7_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
         ->whereIn('fd7_form_prokolpo_areas.district_name',$request->distric_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();

            $prokolpoReportFc1Main = DB::table('prokolpo_details')
         ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
         ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
         ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
         ->where('prokolpo_details.type','fc1')
         ->where('prokolpo_areas.type','fcOne')
         ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
         ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
         ->whereIn('prokolpo_areas.district_name',$request->distric_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();

            $prokolpoReportFc2Main = DB::table('prokolpo_details')
         ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
         ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
         ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
         ->where('prokolpo_details.type','fc2')
         ->where('prokolpo_areas.type','fcTwo')
         ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
         ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
         ->whereIn('prokolpo_areas.district_name',$request->distric_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();

        }elseif(empty($distrcitName)){

            $formYear = $request->prokolpo_year;
            $toYear =$request->prokolpo_year+1;

            $formDate = $formYear.'-07-01';
            $toDate = $toYear.'-06-30';


            $prokolpoReportFd6Main = DB::table('prokolpo_details')
            ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
            ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
            ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
            ->where('prokolpo_details.type','fd6')
            ->whereBetween('fd6_form_prokolpo_areas.created_at', [$formDate, $toDate])
            ->whereIn('fd6_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
            ->whereIn('fd6_form_prokolpo_areas.division_name',$request->division_name)
            ->orderBy('prokolpo_details.id','desc')
            ->get();


            $prokolpoReportFd7Main = DB::table('prokolpo_details')
         ->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
         ->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
         ->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
         ->where('prokolpo_details.type','fd7')
         ->whereBetween('fd7_form_prokolpo_areas.created_at', [$formDate, $toDate])
         ->whereIn('fd7_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
         ->whereIn('fd7_form_prokolpo_areas.division_name',$request->division_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();

            $prokolpoReportFc1Main = DB::table('prokolpo_details')
         ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
         ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
         ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
         ->where('prokolpo_details.type','fc1')
         ->where('prokolpo_areas.type','fcOne')
         ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
         ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
         ->whereIn('prokolpo_areas.division_name',$request->division_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();

            $prokolpoReportFc2Main = DB::table('prokolpo_details')
         ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
         ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
         ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
         ->where('prokolpo_details.type','fc2')
         ->where('prokolpo_areas.type','fcTwo')
         ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
         ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
         ->whereIn('prokolpo_areas.division_name',$request->division_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();

        }elseif(empty($prokolpoType)){

            $formYear = $request->prokolpo_year;
            $toYear =$request->prokolpo_year+1;

            $formDate = $formYear.'-07-01';
            $toDate = $toYear.'-06-30';


            $prokolpoReportFd6Main = DB::table('prokolpo_details')
            ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
            ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
            ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
            ->where('prokolpo_details.type','fd6')
            ->whereBetween('fd6_form_prokolpo_areas.created_at', [$formDate, $toDate])

            ->whereIn('fd6_form_prokolpo_areas.division_name',$request->division_name)
            ->whereIn('fd6_form_prokolpo_areas.district_name',$request->distric_name)
            ->orderBy('prokolpo_details.id','desc')
            ->get();


            $prokolpoReportFd7Main = DB::table('prokolpo_details')
         ->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
         ->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
         ->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
         ->where('prokolpo_details.type','fd7')
         ->whereBetween('fd7_form_prokolpo_areas.created_at', [$formDate, $toDate])

         ->whereIn('fd7_form_prokolpo_areas.division_name',$request->division_name)
         ->whereIn('fd7_form_prokolpo_areas.district_name',$request->distric_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();

            $prokolpoReportFc1Main = DB::table('prokolpo_details')
         ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
         ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
         ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
         ->where('prokolpo_details.type','fc1')
         ->where('prokolpo_areas.type','fcOne')
         ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])

         ->whereIn('prokolpo_areas.division_name',$request->division_name)
         ->whereIn('prokolpo_areas.district_name',$request->distric_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();

            $prokolpoReportFc2Main = DB::table('prokolpo_details')
         ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
         ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
         ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
         ->where('prokolpo_details.type','fc2')
         ->where('prokolpo_areas.type','fcTwo')
         ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])

         ->whereIn('prokolpo_areas.division_name',$request->division_name)
         ->whereIn('prokolpo_areas.district_name',$request->distric_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();

        }else{

            $formYear = $request->prokolpo_year;
            $toYear =$request->prokolpo_year+1;

            $formDate = $formYear.'-07-01';
            $toDate = $toYear.'-06-30';


            $prokolpoReportFd6Main = DB::table('prokolpo_details')
            ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
            ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
            ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
            ->where('prokolpo_details.type','fd6')
            ->whereBetween('fd6_form_prokolpo_areas.created_at', [$formDate, $toDate])
            ->whereIn('fd6_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
            ->whereIn('fd6_form_prokolpo_areas.division_name',$request->division_name)
            ->whereIn('fd6_form_prokolpo_areas.district_name',$request->distric_name)
            ->orderBy('prokolpo_details.id','desc')
            ->get();


            $prokolpoReportFd7Main = DB::table('prokolpo_details')
         ->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
         ->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
         ->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
         ->where('prokolpo_details.type','fd7')
         ->whereBetween('fd7_form_prokolpo_areas.created_at', [$formDate, $toDate])
         ->whereIn('fd7_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
         ->whereIn('fd7_form_prokolpo_areas.division_name',$request->division_name)
         ->whereIn('fd7_form_prokolpo_areas.district_name',$request->distric_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();

            $prokolpoReportFc1Main = DB::table('prokolpo_details')
         ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
         ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
         ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
         ->where('prokolpo_details.type','fc1')
         ->where('prokolpo_areas.type','fcOne')
         ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
         ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
         ->whereIn('prokolpo_areas.division_name',$request->division_name)
         ->whereIn('prokolpo_areas.district_name',$request->distric_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();

            $prokolpoReportFc2Main = DB::table('prokolpo_details')
         ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
         ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
         ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
         ->where('prokolpo_details.type','fc2')
         ->where('prokolpo_areas.type','fcTwo')
         ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
         ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
         ->whereIn('prokolpo_areas.division_name',$request->division_name)
         ->whereIn('prokolpo_areas.district_name',$request->distric_name)
         ->orderBy('prokolpo_details.id','desc')
         ->get();


        }
        //end new code start




            $data = view('admin.report.beneficiaries.prokolpoReportSearchPrint',compact('prokolpoYear','divisionName','distrcitName','prokolpoType','cityCorporationList','districtList','divisionList','projectSubjectList','prokolpoReportFc2Main','prokolpoReportFc1Main','prokolpoReportFd7Main','prokolpoReportFd6Main','prokolpoReportFc2','prokolpoReportFc1','prokolpoReportFd7','prokolpoReport','prokolpoReportFd6'));
            //end for by form  form



        $mpdf = new Mpdf([
            'default_font' => 'nikosh'
        ]);

        $mpdf->WriteHTML($data);
        $mpdf->Output();
        die();



    }



    public function prokolpoReportPrintSearch(Request $request){



        $filterType = $request->filter_type;
        $prokolpoType = $request->prokolpo_type;
        $distrcitName = $request->distric_name;
        $divisionName = $request->division_name;
        $prokolpoYear = $request->prokolpo_year;

        $projectSubjectList = ProjectSubject::orderBy('id','desc')->get();
        $prokolpoReport = DB::table('prokolpo_details')->latest()->get();

        $prokolpoReportFd6 = DB::table('prokolpo_details')->where('type','fd6')->count();
        $prokolpoReportFd7 = DB::table('prokolpo_details')->where('type','fd7')->count();
        $prokolpoReportFc1 = DB::table('prokolpo_details')->where('type','fc1')->count();
        $prokolpoReportFc2 = DB::table('prokolpo_details')->where('type','fc2')->count();


        $divisionList = DB::table('civilinfos')->groupBy('division_bn')->select('division_bn')->get();
        $districtList = DB::table('civilinfos')->groupBy('district_bn')->select('district_bn')->get();
        $cityCorporationList = DB::table('civilinfos')->whereNotNull('city_orporation')
        ->groupBy('city_orporation')->select('city_orporation')->get();


       // new code start

       if(empty($prokolpoType) && empty($divisionName) && empty($distrcitName)){

        $formYear = $request->prokolpo_year;
        $toYear =$request->prokolpo_year+1;

        if($request->filter_type == 'yearly'){


        $formDate = $formYear.'-07-01';
        $toDate = $toYear.'-06-30';
    }else{


        $formDate = date('Y-m-d', strtotime($request->from));
        $toDate = date('Y-m-d', strtotime($request->to));


    }

        $prokolpoReportFd6Main = DB::table('prokolpo_details')
        ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
        ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
        ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
        ->where('prokolpo_details.type','fd6')
        ->whereBetween('fd6_form_prokolpo_areas.created_at', [$formDate, $toDate])
        ->orderBy('prokolpo_details.id','desc')
        ->get();

        $prokolpoReportFd7Main = DB::table('prokolpo_details')
->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
->where('prokolpo_details.type','fd7')
->whereBetween('fd7_form_prokolpo_areas.created_at', [$formDate, $toDate])
->orderBy('prokolpo_details.id','desc')
->get();


        $prokolpoReportFc1Main = DB::table('prokolpo_details')
->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
->where('prokolpo_details.type','fc1')
->where('prokolpo_areas.type','fcOne')
->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
->orderBy('prokolpo_details.id','desc')
->get();


        $prokolpoReportFc2Main = DB::table('prokolpo_details')
->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
->where('prokolpo_details.type','fc2')
->where('prokolpo_areas.type','fcTwo')
->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
->orderBy('prokolpo_details.id','desc')
->get();

    }elseif(empty($prokolpoYear) && empty($divisionName) && empty($distrcitName)){

        $prokolpoReportFd6Main = DB::table('prokolpo_details')
        ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
        ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
        ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
        ->where('prokolpo_details.type','fd6')
        ->whereBetween('fd6_form_prokolpo_areas.prokolpo_type',$prokolpoType)
        ->orderBy('prokolpo_details.id','desc')
        ->get();

        $prokolpoReportFd7Main = DB::table('prokolpo_details')
->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
->where('prokolpo_details.type','fd7')
->whereIn('fd7_form_prokolpo_areas.prokolpo_type',$prokolpoType)
->orderBy('prokolpo_details.id','desc')
->get();


        $prokolpoReportFc1Main = DB::table('prokolpo_details')
->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
->where('prokolpo_details.type','fc1')
->where('prokolpo_areas.type','fcOne')
->whereIn('prokolpo_areas.prokolpo_type',$prokolpoType)
->orderBy('prokolpo_details.id','desc')
->get();


        $prokolpoReportFc2Main = DB::table('prokolpo_details')
->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
->where('prokolpo_details.type','fc2')
->where('prokolpo_areas.type','fcTwo')
->whereIn('prokolpo_areas.prokolpo_type',$prokolpoType)
->orderBy('prokolpo_details.id','desc')
->get();

    }elseif(empty($prokolpoYear) && empty($divisionName) && empty($prokolpoType)){

        $prokolpoReportFd6Main = DB::table('prokolpo_details')
        ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
        ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
        ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
        ->where('prokolpo_details.type','fd6')
        ->whereIn('fd6_form_prokolpo_areas.district_name',$request->distric_name)
        ->orderBy('prokolpo_details.id','desc')
        ->get();


        $prokolpoReportFd7Main = DB::table('prokolpo_details')
     ->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
     ->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
     ->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
     ->where('prokolpo_details.type','fd7')
     ->whereIn('fd7_form_prokolpo_areas.district_name',$request->distric_name)
     ->orderBy('prokolpo_details.id','desc')
     ->get();

        $prokolpoReportFc1Main = DB::table('prokolpo_details')
     ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
     ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
     ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
     ->where('prokolpo_details.type','fc1')
     ->where('prokolpo_areas.type','fcOne')
     ->whereIn('prokolpo_areas.district_name',$request->distric_name)
     ->orderBy('prokolpo_details.id','desc')
     ->get();

        $prokolpoReportFc2Main = DB::table('prokolpo_details')
     ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
     ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
     ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
     ->where('prokolpo_details.type','fc2')
     ->where('prokolpo_areas.type','fcTwo')
     ->whereIn('prokolpo_areas.district_name',$request->distric_name)
     ->orderBy('prokolpo_details.id','desc')
     ->get();

    }elseif(empty($prokolpoYear) && empty($distrcitName) && empty($prokolpoType)){

        $prokolpoReportFd6Main = DB::table('prokolpo_details')
        ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
        ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
        ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
        ->where('prokolpo_details.type','fd6')
        ->whereIn('fd6_form_prokolpo_areas.division_name',$request->division_name)
        ->orderBy('prokolpo_details.id','desc')
        ->get();


        $prokolpoReportFd7Main = DB::table('prokolpo_details')
     ->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
     ->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
     ->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
     ->where('prokolpo_details.type','fd7')
     ->whereIn('fd7_form_prokolpo_areas.division_name',$request->division_name)
     ->orderBy('prokolpo_details.id','desc')
     ->get();

        $prokolpoReportFc1Main = DB::table('prokolpo_details')
     ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
     ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
     ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
     ->where('prokolpo_details.type','fc1')
     ->where('prokolpo_areas.type','fcOne')
     ->whereIn('prokolpo_areas.division_name',$request->division_name)
     ->orderBy('prokolpo_details.id','desc')
     ->get();

        $prokolpoReportFc2Main = DB::table('prokolpo_details')
     ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
     ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
     ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
     ->where('prokolpo_details.type','fc2')
     ->where('prokolpo_areas.type','fcTwo')
     ->whereIn('prokolpo_areas.division_name',$request->division_name)
     ->orderBy('prokolpo_details.id','desc')
     ->get();

    }elseif(empty($prokolpoYear) && empty($divisionName)){

        $prokolpoReportFd6Main = DB::table('prokolpo_details')
        ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
        ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
        ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
        ->where('prokolpo_details.type','fd6')
        ->whereIn('fd6_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
        ->whereIn('fd6_form_prokolpo_areas.district_name',$request->distric_name)
        ->orderBy('prokolpo_details.id','desc')
        ->get();


        $prokolpoReportFd7Main = DB::table('prokolpo_details')
     ->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
     ->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
     ->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
     ->where('prokolpo_details.type','fd7')
     ->whereIn('fd7_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
     ->whereIn('fd7_form_prokolpo_areas.district_name',$request->distric_name)
     ->orderBy('prokolpo_details.id','desc')
     ->get();

        $prokolpoReportFc1Main = DB::table('prokolpo_details')
     ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
     ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
     ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
     ->where('prokolpo_details.type','fc1')
     ->where('prokolpo_areas.type','fcOne')
     ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
     ->whereIn('prokolpo_areas.district_name',$request->distric_name)
     ->orderBy('prokolpo_details.id','desc')
     ->get();

        $prokolpoReportFc2Main = DB::table('prokolpo_details')
     ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
     ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
     ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
     ->where('prokolpo_details.type','fc2')
     ->where('prokolpo_areas.type','fcTwo')
     ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
     ->whereIn('prokolpo_areas.district_name',$request->distric_name)
     ->orderBy('prokolpo_details.id','desc')
     ->get();

    }elseif(empty($prokolpoYear) && empty($distrcitName)){

        $prokolpoReportFd6Main = DB::table('prokolpo_details')
        ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
        ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
        ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
        ->where('prokolpo_details.type','fd6')
        ->whereIn('fd6_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
        ->whereIn('fd6_form_prokolpo_areas.division_name',$request->division_name)
        ->orderBy('prokolpo_details.id','desc')
        ->get();


        $prokolpoReportFd7Main = DB::table('prokolpo_details')
     ->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
     ->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
     ->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
     ->where('prokolpo_details.type','fd7')
     ->whereIn('fd7_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
     ->whereIn('fd7_form_prokolpo_areas.division_name',$request->division_name)
     ->orderBy('prokolpo_details.id','desc')
     ->get();

        $prokolpoReportFc1Main = DB::table('prokolpo_details')
     ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
     ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
     ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
     ->where('prokolpo_details.type','fc1')
     ->where('prokolpo_areas.type','fcOne')
     ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
     ->whereIn('prokolpo_areas.division_name',$request->division_name)
     ->orderBy('prokolpo_details.id','desc')
     ->get();

        $prokolpoReportFc2Main = DB::table('prokolpo_details')
     ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
     ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
     ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
     ->where('prokolpo_details.type','fc2')
     ->where('prokolpo_areas.type','fcTwo')
     ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
     ->whereIn('prokolpo_areas.division_name',$request->division_name)
     ->orderBy('prokolpo_details.id','desc')
     ->get();

    }elseif(empty($prokolpoYear) && empty($prokolpoType)){

        $prokolpoReportFd6Main = DB::table('prokolpo_details')
        ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
        ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
        ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
        ->where('prokolpo_details.type','fd6')
        ->whereIn('fd6_form_prokolpo_areas.division_name',$request->division_name)
        ->whereIn('fd6_form_prokolpo_areas.district_name',$request->distric_name)
        ->orderBy('prokolpo_details.id','desc')
        ->get();


        $prokolpoReportFd7Main = DB::table('prokolpo_details')
     ->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
     ->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
     ->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
     ->where('prokolpo_details.type','fd7')
     ->whereIn('fd7_form_prokolpo_areas.division_name',$request->division_name)
     ->whereIn('fd7_form_prokolpo_areas.district_name',$request->distric_name)
     ->orderBy('prokolpo_details.id','desc')
     ->get();

        $prokolpoReportFc1Main = DB::table('prokolpo_details')
     ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
     ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
     ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
     ->where('prokolpo_details.type','fc1')
     ->where('prokolpo_areas.type','fcOne')
     ->whereIn('prokolpo_areas.division_name',$request->division_name)
     ->whereIn('prokolpo_areas.district_name',$request->distric_name)
     ->orderBy('prokolpo_details.id','desc')
     ->get();

        $prokolpoReportFc2Main = DB::table('prokolpo_details')
     ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
     ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
     ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
     ->where('prokolpo_details.type','fc2')
     ->where('prokolpo_areas.type','fcTwo')
     ->whereIn('prokolpo_areas.division_name',$request->division_name)
     ->whereIn('prokolpo_areas.district_name',$request->distric_name)
     ->orderBy('prokolpo_details.id','desc')
     ->get();

    }elseif(empty($divisionName) && empty($distrcitName)){

        $formYear = $request->prokolpo_year;
        $toYear =$request->prokolpo_year+1;

        if($request->filter_type == 'yearly'){


            $formDate = $formYear.'-07-01';
            $toDate = $toYear.'-06-30';
        }else{


            $formDate = date('Y-m-d', strtotime($request->from));
            $toDate = date('Y-m-d', strtotime($request->to));

        }

        $prokolpoReportFd6Main = DB::table('prokolpo_details')
        ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
        ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
        ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
        ->where('prokolpo_details.type','fd6')
        ->whereIn('fd6_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
        ->whereBetween('fd6_form_prokolpo_areas.created_at', [$formDate, $toDate])
        ->orderBy('prokolpo_details.id','desc')
        ->get();

        $prokolpoReportFd7Main = DB::table('prokolpo_details')
->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
->where('prokolpo_details.type','fd7')
->whereIn('fd7_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
->whereBetween('fd7_form_prokolpo_areas.created_at', [$formDate, $toDate])
->orderBy('prokolpo_details.id','desc')
->get();


        $prokolpoReportFc1Main = DB::table('prokolpo_details')
->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
->where('prokolpo_details.type','fc1')
->where('prokolpo_areas.type','fcOne')
->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
->orderBy('prokolpo_details.id','desc')
->get();


        $prokolpoReportFc2Main = DB::table('prokolpo_details')
->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
->where('prokolpo_details.type','fc2')
->where('prokolpo_areas.type','fcTwo')
->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
->orderBy('prokolpo_details.id','desc')
->get();

    }elseif(empty($divisionName) && empty($prokolpoType)){

        $formYear = $request->prokolpo_year;
        $toYear =$request->prokolpo_year+1;

        if($request->filter_type == 'yearly'){


            $formDate = $formYear.'-07-01';
            $toDate = $toYear.'-06-30';
        }else{


            $formDate = date('Y-m-d', strtotime($request->from));
            $toDate = date('Y-m-d', strtotime($request->to));

        }

        $prokolpoReportFd6Main = DB::table('prokolpo_details')
        ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
        ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
        ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
        ->where('prokolpo_details.type','fd6')
        ->whereIn('fd6_form_prokolpo_areas.district_name',$request->distric_name)
        ->whereBetween('fd6_form_prokolpo_areas.created_at', [$formDate, $toDate])
        ->orderBy('prokolpo_details.id','desc')
        ->get();

        $prokolpoReportFd7Main = DB::table('prokolpo_details')
->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
->where('prokolpo_details.type','fd7')
->whereIn('fd7_form_prokolpo_areas.district_name',$request->distric_name)
->whereBetween('fd7_form_prokolpo_areas.created_at', [$formDate, $toDate])
->orderBy('prokolpo_details.id','desc')
->get();


        $prokolpoReportFc1Main = DB::table('prokolpo_details')
->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
->where('prokolpo_details.type','fc1')
->where('prokolpo_areas.type','fcOne')
->whereIn('prokolpo_areas.district_name',$request->distric_name)
->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
->orderBy('prokolpo_details.id','desc')
->get();


        $prokolpoReportFc2Main = DB::table('prokolpo_details')
->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
->where('prokolpo_details.type','fc2')
->where('prokolpo_areas.type','fcTwo')
->whereIn('prokolpo_areas.district_name',$request->distric_name)
->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
->orderBy('prokolpo_details.id','desc')
->get();

    }elseif(empty($distrcitName) && empty($prokolpoType)){


        $formYear = $request->prokolpo_year;
        $toYear =$request->prokolpo_year+1;

        if($request->filter_type == 'yearly'){


            $formDate = $formYear.'-07-01';
            $toDate = $toYear.'-06-30';
        }else{


            $formDate = date('Y-m-d', strtotime($request->from));
            $toDate = date('Y-m-d', strtotime($request->to));

        }

        $prokolpoReportFd6Main = DB::table('prokolpo_details')
        ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
        ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
        ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
        ->where('prokolpo_details.type','fd6')
        ->whereIn('fd6_form_prokolpo_areas.division_name',$request->division_name)
        ->whereBetween('fd6_form_prokolpo_areas.created_at', [$formDate, $toDate])
        ->orderBy('prokolpo_details.id','desc')
        ->get();

        $prokolpoReportFd7Main = DB::table('prokolpo_details')
->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
->where('prokolpo_details.type','fd7')
->whereIn('fd7_form_prokolpo_areas.division_name',$request->division_name)
->whereBetween('fd7_form_prokolpo_areas.created_at', [$formDate, $toDate])
->orderBy('prokolpo_details.id','desc')
->get();


        $prokolpoReportFc1Main = DB::table('prokolpo_details')
->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
->where('prokolpo_details.type','fc1')
->where('prokolpo_areas.type','fcOne')
->whereIn('prokolpo_areas.division_name',$request->division_name)
->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
->orderBy('prokolpo_details.id','desc')
->get();


        $prokolpoReportFc2Main = DB::table('prokolpo_details')
->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
->where('prokolpo_details.type','fc2')
->where('prokolpo_areas.type','fcTwo')
->whereIn('prokolpo_areas.division_name',$request->division_name)
->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
->orderBy('prokolpo_details.id','desc')
->get();

    }elseif(empty($prokolpoYear)){


        $prokolpoReportFd6Main = DB::table('prokolpo_details')
        ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
        ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
        ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
        ->where('prokolpo_details.type','fd6')
        ->whereIn('fd6_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
        ->whereIn('fd6_form_prokolpo_areas.division_name',$request->division_name)
        ->whereIn('fd6_form_prokolpo_areas.district_name',$request->distric_name)
        ->orderBy('prokolpo_details.id','desc')
        ->get();


        $prokolpoReportFd7Main = DB::table('prokolpo_details')
     ->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
     ->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
     ->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
     ->where('prokolpo_details.type','fd7')
     ->whereIn('fd7_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
     ->whereIn('fd7_form_prokolpo_areas.division_name',$request->division_name)
     ->whereIn('fd7_form_prokolpo_areas.district_name',$request->distric_name)
     ->orderBy('prokolpo_details.id','desc')
     ->get();

        $prokolpoReportFc1Main = DB::table('prokolpo_details')
     ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
     ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
     ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
     ->where('prokolpo_details.type','fc1')
     ->where('prokolpo_areas.type','fcOne')
     ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
     ->whereIn('prokolpo_areas.division_name',$request->division_name)
     ->whereIn('prokolpo_areas.district_name',$request->distric_name)
     ->orderBy('prokolpo_details.id','desc')
     ->get();

        $prokolpoReportFc2Main = DB::table('prokolpo_details')
     ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
     ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
     ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
     ->where('prokolpo_details.type','fc2')
     ->where('prokolpo_areas.type','fcTwo')
     ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
     ->whereIn('prokolpo_areas.division_name',$request->division_name)
     ->whereIn('prokolpo_areas.district_name',$request->distric_name)
     ->orderBy('prokolpo_details.id','desc')
     ->get();

    }elseif(empty($divisionName)){

        $formYear = $request->prokolpo_year;
        $toYear =$request->prokolpo_year+1;

        if($request->filter_type == 'yearly'){


            $formDate = $formYear.'-07-01';
            $toDate = $toYear.'-06-30';
        }else{


            $formDate = date('Y-m-d', strtotime($request->from));
            $toDate = date('Y-m-d', strtotime($request->to));

        }

        $prokolpoReportFd6Main = DB::table('prokolpo_details')
        ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
        ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
        ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
        ->where('prokolpo_details.type','fd6')
        ->whereBetween('fd6_form_prokolpo_areas.created_at', [$formDate, $toDate])
        ->whereIn('fd6_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
        ->whereIn('fd6_form_prokolpo_areas.district_name',$request->distric_name)
        ->orderBy('prokolpo_details.id','desc')
        ->get();


        $prokolpoReportFd7Main = DB::table('prokolpo_details')
     ->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
     ->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
     ->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
     ->where('prokolpo_details.type','fd7')
     ->whereBetween('fd7_form_prokolpo_areas.created_at', [$formDate, $toDate])
     ->whereIn('fd7_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
     ->whereIn('fd7_form_prokolpo_areas.district_name',$request->distric_name)
     ->orderBy('prokolpo_details.id','desc')
     ->get();

        $prokolpoReportFc1Main = DB::table('prokolpo_details')
     ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
     ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
     ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
     ->where('prokolpo_details.type','fc1')
     ->where('prokolpo_areas.type','fcOne')
     ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
     ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
     ->whereIn('prokolpo_areas.district_name',$request->distric_name)
     ->orderBy('prokolpo_details.id','desc')
     ->get();

        $prokolpoReportFc2Main = DB::table('prokolpo_details')
     ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
     ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
     ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
     ->where('prokolpo_details.type','fc2')
     ->where('prokolpo_areas.type','fcTwo')
     ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
     ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
     ->whereIn('prokolpo_areas.district_name',$request->distric_name)
     ->orderBy('prokolpo_details.id','desc')
     ->get();

    }elseif(empty($distrcitName)){

        $formYear = $request->prokolpo_year;
        $toYear =$request->prokolpo_year+1;

        if($request->filter_type == 'yearly'){


            $formDate = $formYear.'-07-01';
            $toDate = $toYear.'-06-30';
        }else{


            $formDate = date('Y-m-d', strtotime($request->from));
            $toDate = date('Y-m-d', strtotime($request->to));

        }


        $prokolpoReportFd6Main = DB::table('prokolpo_details')
        ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
        ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
        ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
        ->where('prokolpo_details.type','fd6')
        ->whereBetween('fd6_form_prokolpo_areas.created_at', [$formDate, $toDate])
        ->whereIn('fd6_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
        ->whereIn('fd6_form_prokolpo_areas.division_name',$request->division_name)
        ->orderBy('prokolpo_details.id','desc')
        ->get();


        $prokolpoReportFd7Main = DB::table('prokolpo_details')
     ->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
     ->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
     ->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
     ->where('prokolpo_details.type','fd7')
     ->whereBetween('fd7_form_prokolpo_areas.created_at', [$formDate, $toDate])
     ->whereIn('fd7_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
     ->whereIn('fd7_form_prokolpo_areas.division_name',$request->division_name)
     ->orderBy('prokolpo_details.id','desc')
     ->get();

        $prokolpoReportFc1Main = DB::table('prokolpo_details')
     ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
     ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
     ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
     ->where('prokolpo_details.type','fc1')
     ->where('prokolpo_areas.type','fcOne')
     ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
     ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
     ->whereIn('prokolpo_areas.division_name',$request->division_name)
     ->orderBy('prokolpo_details.id','desc')
     ->get();

        $prokolpoReportFc2Main = DB::table('prokolpo_details')
     ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
     ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
     ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
     ->where('prokolpo_details.type','fc2')
     ->where('prokolpo_areas.type','fcTwo')
     ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
     ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
     ->whereIn('prokolpo_areas.division_name',$request->division_name)
     ->orderBy('prokolpo_details.id','desc')
     ->get();

    }elseif(empty($prokolpoType)){

        $formYear = $request->prokolpo_year;
        $toYear =$request->prokolpo_year+1;

        if($request->filter_type == 'yearly'){


            $formDate = $formYear.'-07-01';
            $toDate = $toYear.'-06-30';
        }else{


            $formDate = date('Y-m-d', strtotime($request->from));
            $toDate = date('Y-m-d', strtotime($request->to));

        }


        $prokolpoReportFd6Main = DB::table('prokolpo_details')
        ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
        ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
        ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
        ->where('prokolpo_details.type','fd6')
        ->whereBetween('fd6_form_prokolpo_areas.created_at', [$formDate, $toDate])

        ->whereIn('fd6_form_prokolpo_areas.division_name',$request->division_name)
        ->whereIn('fd6_form_prokolpo_areas.district_name',$request->distric_name)
        ->orderBy('prokolpo_details.id','desc')
        ->get();


        $prokolpoReportFd7Main = DB::table('prokolpo_details')
     ->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
     ->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
     ->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
     ->where('prokolpo_details.type','fd7')
     ->whereBetween('fd7_form_prokolpo_areas.created_at', [$formDate, $toDate])

     ->whereIn('fd7_form_prokolpo_areas.division_name',$request->division_name)
     ->whereIn('fd7_form_prokolpo_areas.district_name',$request->distric_name)
     ->orderBy('prokolpo_details.id','desc')
     ->get();

        $prokolpoReportFc1Main = DB::table('prokolpo_details')
     ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
     ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
     ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
     ->where('prokolpo_details.type','fc1')
     ->where('prokolpo_areas.type','fcOne')
     ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])

     ->whereIn('prokolpo_areas.division_name',$request->division_name)
     ->whereIn('prokolpo_areas.district_name',$request->distric_name)
     ->orderBy('prokolpo_details.id','desc')
     ->get();

        $prokolpoReportFc2Main = DB::table('prokolpo_details')
     ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
     ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
     ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
     ->where('prokolpo_details.type','fc2')
     ->where('prokolpo_areas.type','fcTwo')
     ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])

     ->whereIn('prokolpo_areas.division_name',$request->division_name)
     ->whereIn('prokolpo_areas.district_name',$request->distric_name)
     ->orderBy('prokolpo_details.id','desc')
     ->get();

    }else{

        $formYear = $request->prokolpo_year;
        $toYear =$request->prokolpo_year+1;

        if($request->filter_type == 'yearly'){


            $formDate = $formYear.'-07-01';
            $toDate = $toYear.'-06-30';
        }else{


            $formDate = date('Y-m-d', strtotime($request->from));
            $toDate = date('Y-m-d', strtotime($request->to));

        }


        $prokolpoReportFd6Main = DB::table('prokolpo_details')
        ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
        ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
        ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
        ->where('prokolpo_details.type','fd6')
        ->whereBetween('fd6_form_prokolpo_areas.created_at', [$formDate, $toDate])
        ->whereIn('fd6_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
        ->whereIn('fd6_form_prokolpo_areas.division_name',$request->division_name)
        ->whereIn('fd6_form_prokolpo_areas.district_name',$request->distric_name)
        ->orderBy('prokolpo_details.id','desc')
        ->get();


        $prokolpoReportFd7Main = DB::table('prokolpo_details')
     ->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
     ->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
     ->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
     ->where('prokolpo_details.type','fd7')
     ->whereBetween('fd7_form_prokolpo_areas.created_at', [$formDate, $toDate])
     ->whereIn('fd7_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
     ->whereIn('fd7_form_prokolpo_areas.division_name',$request->division_name)
     ->whereIn('fd7_form_prokolpo_areas.district_name',$request->distric_name)
     ->orderBy('prokolpo_details.id','desc')
     ->get();

        $prokolpoReportFc1Main = DB::table('prokolpo_details')
     ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
     ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
     ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
     ->where('prokolpo_details.type','fc1')
     ->where('prokolpo_areas.type','fcOne')
     ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
     ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
     ->whereIn('prokolpo_areas.division_name',$request->division_name)
     ->whereIn('prokolpo_areas.district_name',$request->distric_name)
     ->orderBy('prokolpo_details.id','desc')
     ->get();

        $prokolpoReportFc2Main = DB::table('prokolpo_details')
     ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
     ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
     ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
     ->where('prokolpo_details.type','fc2')
     ->where('prokolpo_areas.type','fcTwo')
     ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
     ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
     ->whereIn('prokolpo_areas.division_name',$request->division_name)
     ->whereIn('prokolpo_areas.district_name',$request->distric_name)
     ->orderBy('prokolpo_details.id','desc')
     ->get();


    }
    //end new code start






            $data = view('admin.report.prokolpoReportSearchPrint',compact('prokolpoYear','divisionName','distrcitName','prokolpoType','cityCorporationList','districtList','divisionList','projectSubjectList','prokolpoReportFc2Main','prokolpoReportFc1Main','prokolpoReportFd7Main','prokolpoReportFd6Main','prokolpoReportFc2','prokolpoReportFc1','prokolpoReportFd7','prokolpoReport','prokolpoReportFd6'));
            //end for by form  form


        $mpdf = new Mpdf([
            'default_font' => 'nikosh'
        ]);

        $mpdf->WriteHTML($data);
        $mpdf->Output();
        die();



    }


    public function prokolpoBeneficiariesReportPrint(){

        if (is_null($this->user) || !$this->user->can('prokolpoReportView')) {
            //abort(403, 'Sorry !! You are Unauthorized to view !');
            return redirect()->route('error_404');
        }



            \LogActivity::addToLog('View prokolpoReport.');

            $projectSubjectList = ProjectSubject::orderBy('id','desc')->get();
            $prokolpoReport = DB::table('prokolpo_details')->latest()->get();

            $prokolpoReportFd6Main = DB::table('prokolpo_details')
            ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
            ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
            ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
            ->where('prokolpo_details.type','fd6')
            ->orderBy('prokolpo_details.id','desc')
            ->get();

            $prokolpoReportFd7Main = DB::table('prokolpo_details')
            ->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
            ->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
            ->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
            ->where('prokolpo_details.type','fd7')
            ->orderBy('prokolpo_details.id','desc')
            ->get();


            $prokolpoReportFc1Main = DB::table('prokolpo_details')
            ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
            ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
            ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
            ->where('prokolpo_details.type','fc1')
            ->where('prokolpo_areas.type','fcOne')
            ->orderBy('prokolpo_details.id','desc')
            ->get();

            $prokolpoReportFc2Main = DB::table('prokolpo_details')
            ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
            ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
            ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
            ->where('prokolpo_details.type','fc2')
            ->where('prokolpo_areas.type','fcTwo')
            ->orderBy('prokolpo_details.id','desc')
            ->get();


            $prokolpoReportFd6 = DB::table('prokolpo_details')->where('type','fd6')->count();
            $prokolpoReportFd7 = DB::table('prokolpo_details')->where('type','fd7')->count();
            $prokolpoReportFc1 = DB::table('prokolpo_details')->where('type','fc1')->count();
            $prokolpoReportFc2 = DB::table('prokolpo_details')->where('type','fc2')->count();


            $divisionList = DB::table('civilinfos')->groupBy('division_bn')->select('division_bn')->get();
        $districtList = DB::table('civilinfos')->groupBy('district_bn')->select('district_bn')->get();
        $cityCorporationList = DB::table('civilinfos')->whereNotNull('city_orporation')->groupBy('city_orporation')->select('city_orporation')->get();


        $data =  view('admin.report.beneficiaries.prokolpoReportPrint',compact('cityCorporationList','districtList','divisionList','projectSubjectList','prokolpoReportFc2Main','prokolpoReportFc1Main','prokolpoReportFd7Main','prokolpoReportFd6Main','prokolpoReportFc2','prokolpoReportFc1','prokolpoReportFd7','prokolpoReport','prokolpoReportFd6'));



        $mpdf = new Mpdf([
            'default_font' => 'nikosh'
        ]);

        $mpdf->WriteHTML($data);
        $mpdf->Output();
        die();

    }



    public function prokolpoReportPrint(){

        if (is_null($this->user) || !$this->user->can('prokolpoReportView')) {
            //abort(403, 'Sorry !! You are Unauthorized to view !');
            return redirect()->route('error_404');
        }



            \LogActivity::addToLog('View prokolpoReport.');

            $projectSubjectList = ProjectSubject::orderBy('id','desc')->get();
            $prokolpoReport = DB::table('prokolpo_details')->latest()->get();

            $prokolpoReportFd6Main = DB::table('prokolpo_details')
            ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
            ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
            ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
            ->where('prokolpo_details.type','fd6')
            ->orderBy('prokolpo_details.id','desc')
            ->get();

            $prokolpoReportFd7Main = DB::table('prokolpo_details')
            ->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
            ->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
            ->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
            ->where('prokolpo_details.type','fd7')
            ->orderBy('prokolpo_details.id','desc')
            ->get();


            $prokolpoReportFc1Main = DB::table('prokolpo_details')
            ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
            ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
            ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
            ->where('prokolpo_details.type','fc1')
            ->where('prokolpo_areas.type','fcOne')
            ->orderBy('prokolpo_details.id','desc')
            ->get();

            $prokolpoReportFc2Main = DB::table('prokolpo_details')
            ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
            ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
            ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
            ->where('prokolpo_details.type','fc2')
            ->where('prokolpo_areas.type','fcTwo')
            ->orderBy('prokolpo_details.id','desc')
            ->get();


            $prokolpoReportFd6 = DB::table('prokolpo_details')->where('type','fd6')->count();
            $prokolpoReportFd7 = DB::table('prokolpo_details')->where('type','fd7')->count();
            $prokolpoReportFc1 = DB::table('prokolpo_details')->where('type','fc1')->count();
            $prokolpoReportFc2 = DB::table('prokolpo_details')->where('type','fc2')->count();


            $divisionList = DB::table('civilinfos')->groupBy('division_bn')->select('division_bn')->get();
        $districtList = DB::table('civilinfos')->groupBy('district_bn')->select('district_bn')->get();
        $cityCorporationList = DB::table('civilinfos')->whereNotNull('city_orporation')->groupBy('city_orporation')->select('city_orporation')->get();


        $data =  view('admin.report.prokolpoReportPrint',compact('cityCorporationList','districtList','divisionList','projectSubjectList','prokolpoReportFc2Main','prokolpoReportFc1Main','prokolpoReportFd7Main','prokolpoReportFd6Main','prokolpoReportFc2','prokolpoReportFc1','prokolpoReportFd7','prokolpoReport','prokolpoReportFd6'));



        $mpdf = new Mpdf([
            'default_font' => 'nikosh'
        ]);

        $mpdf->WriteHTML($data);
        $mpdf->Output();
        die();

    }


    public function prokolpoReport(){


        if (is_null($this->user) || !$this->user->can('prokolpoReportView')) {
            //abort(403, 'Sorry !! You are Unauthorized to view !');
            return redirect()->route('error_404');
        }



            \LogActivity::addToLog('View prokolpoReport.');

            $projectSubjectList = ProjectSubject::orderBy('id','desc')->get();
            $prokolpoReport = DB::table('prokolpo_details')->latest()->get();

            $prokolpoReportFd6Main = DB::table('prokolpo_details')
            ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
            ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
            ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
            ->where('prokolpo_details.type','fd6')
            ->orderBy('prokolpo_details.id','desc')
            ->get();

            //dd($prokolpoReportFd6Main);

            $prokolpoReportFd7Main = DB::table('prokolpo_details')
            ->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
            ->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
            ->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
            ->where('prokolpo_details.type','fd7')
            ->orderBy('prokolpo_details.id','desc')
            ->get();


            $prokolpoReportFc1Main = DB::table('prokolpo_details')
            ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
            ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
            ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
            ->where('prokolpo_details.type','fc1')
            ->where('prokolpo_areas.type','fcOne')
            ->orderBy('prokolpo_details.id','desc')
            ->get();

            $prokolpoReportFc2Main = DB::table('prokolpo_details')
            ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
            ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
            ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
            ->where('prokolpo_details.type','fc2')
            ->where('prokolpo_areas.type','fcTwo')
            ->orderBy('prokolpo_details.id','desc')
            ->get();


            $prokolpoReportFd6 = DB::table('prokolpo_details')->where('type','fd6')->count();
            $prokolpoReportFd7 = DB::table('prokolpo_details')->where('type','fd7')->count();
            $prokolpoReportFc1 = DB::table('prokolpo_details')->where('type','fc1')->count();
            $prokolpoReportFc2 = DB::table('prokolpo_details')->where('type','fc2')->count();


            $divisionList = DB::table('civilinfos')->groupBy('division_bn')->select('division_bn')->get();
        $districtList = DB::table('civilinfos')->groupBy('district_bn')->select('district_bn')->get();
        $cityCorporationList = DB::table('civilinfos')->whereNotNull('city_orporation')->groupBy('city_orporation')->select('city_orporation')->get();


            return view('admin.report.prokolpoReport',compact('cityCorporationList','districtList','divisionList','projectSubjectList','prokolpoReportFc2Main','prokolpoReportFc1Main','prokolpoReportFd7Main','prokolpoReportFd6Main','prokolpoReportFc2','prokolpoReportFc1','prokolpoReportFd7','prokolpoReport','prokolpoReportFd6'));




    }


    public function prokolpoBeneficiariesReport(){


        if (is_null($this->user) || !$this->user->can('prokolpoReportView')) {
            //abort(403, 'Sorry !! You are Unauthorized to view !');
            return redirect()->route('error_404');
        }



            \LogActivity::addToLog('View prokolpoReport.');

            $projectSubjectList = ProjectSubject::orderBy('id','desc')->get();
            $prokolpoReport = DB::table('prokolpo_details')->latest()->get();

            $prokolpoReportFd6Main = DB::table('prokolpo_details')
            ->join('fd6_form_prokolpo_areas', 'fd6_form_prokolpo_areas.fd6_form_id', '=', 'prokolpo_details.formId')
            ->join('fd6_forms', 'fd6_forms.id', '=', 'prokolpo_details.formId')
            ->select('prokolpo_details.*','fd6_forms.*','fd6_forms.id as mainId','fd6_form_prokolpo_areas.*')
            ->where('prokolpo_details.type','fd6')
            ->orderBy('prokolpo_details.id','desc')
            ->get();

            $prokolpoReportFd7Main = DB::table('prokolpo_details')
            ->join('fd7_form_prokolpo_areas', 'fd7_form_prokolpo_areas.fd7_form_id', '=', 'prokolpo_details.formId')
            ->join('fd7_forms', 'fd7_forms.id', '=', 'prokolpo_details.formId')
            ->select('prokolpo_details.*','fd7_forms.*','fd7_forms.id as mainId','fd7_form_prokolpo_areas.*')
            ->where('prokolpo_details.type','fd7')
            ->orderBy('prokolpo_details.id','desc')
            ->get();


            $prokolpoReportFc1Main = DB::table('prokolpo_details')
            ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
            ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
            ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc1_forms.*','fc1_forms.id as mainId','prokolpo_areas.*')
            ->where('prokolpo_details.type','fc1')
            ->where('prokolpo_areas.type','fcOne')
            ->orderBy('prokolpo_details.id','desc')
            ->get();

            $prokolpoReportFc2Main = DB::table('prokolpo_details')
            ->join('prokolpo_areas', 'prokolpo_areas.formId', '=', 'prokolpo_details.formId')
            ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
            ->select('prokolpo_areas.formId as mainAreaId','prokolpo_details.*','fc2_forms.*','fc2_forms.id as mainId','prokolpo_areas.*')
            ->where('prokolpo_details.type','fc2')
            ->where('prokolpo_areas.type','fcTwo')
            ->orderBy('prokolpo_details.id','desc')
            ->get();


            $prokolpoReportFd6 = DB::table('prokolpo_details')->where('type','fd6')->count();
            $prokolpoReportFd7 = DB::table('prokolpo_details')->where('type','fd7')->count();
            $prokolpoReportFc1 = DB::table('prokolpo_details')->where('type','fc1')->count();
            $prokolpoReportFc2 = DB::table('prokolpo_details')->where('type','fc2')->count();


            $divisionList = DB::table('civilinfos')->groupBy('division_bn')->select('division_bn')->get();
        $districtList = DB::table('civilinfos')->groupBy('district_bn')->select('district_bn')->get();
        $cityCorporationList = DB::table('civilinfos')->whereNotNull('city_orporation')->groupBy('city_orporation')->select('city_orporation')->get();


            return view('admin.report.beneficiaries.prokolpoReport',compact('cityCorporationList','districtList','divisionList','projectSubjectList','prokolpoReportFc2Main','prokolpoReportFc1Main','prokolpoReportFd7Main','prokolpoReportFd6Main','prokolpoReportFc2','prokolpoReportFc1','prokolpoReportFd7','prokolpoReport','prokolpoReportFd6'));




    }


    public function districtWiseList(){

        if (is_null($this->user) || !$this->user->can('reportView')) {
            //abort(403, 'Sorry !! You are Unauthorized to view !');
            return redirect()->route('error_404');
        }

        try{
            \LogActivity::addToLog('View districtWiseList.');
            $allFdOneData = DB::table('fd_one_forms')->get();
            $allDistrictList = DB::table('districts')->get();

            return view('admin.report.districtWiseList',compact('allDistrictList','allFdOneData'));

        }catch (\Exception $e) {
            return redirect()->route('error_404')->with('error','some thing went wrong ');
        }
    }


    public function prokolpoReportDistrict(Request $request){

        $districtList = DB::table('civilinfos')->whereIn('division_bn',$request->divisionId)
        ->groupBy('district_bn')->select('district_bn')->get();

        return view('admin.report.prokolpoReportDistrict',compact('districtList'));

    }





    public function districtWiseListSearch(Request $request){


        if($request->district_id == 'all'){

            $allFdOneData = DB::table('fd_one_forms')->get();


        }else{

            $allFdOneData = DB::table('fd_one_forms')->where('district_id',$request->district_id)->get();
        }


        return view('admin.report.districtWiseListSearch',compact('allFdOneData'));

    }


    public function localNgoListSearch(Request $request){


        if($request->district_id == 'all'){

            $localNgoListReport = DB::table('fd_one_forms')

            ->join('ngo_type_and_languages','ngo_type_and_languages.user_id','=','fd_one_forms.user_id')

            ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*')

            ->where('ngo_type_and_languages.ngo_type','দেশিও')
            ->orderBy('fd_one_forms.id','desc')
            ->get();


        }else{

            $localNgoListReport =DB::table('fd_one_forms')

            ->join('ngo_type_and_languages','ngo_type_and_languages.user_id','=','fd_one_forms.user_id')

            ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*')

            ->where('ngo_type_and_languages.ngo_type','দেশিও')
            ->where('fd_one_forms.district_id',$request->district_id)

            ->orderBy('fd_one_forms.id','desc')
            ->get();
        }


        return view('admin.report.localNgoListSearch',compact('localNgoListReport'));

    }


    public function localNgoListReport(){


        if (is_null($this->user) || !$this->user->can('reportView')) {
            //abort(403, 'Sorry !! You are Unauthorized to view !');
            return redirect()->route('error_404');
        }

        try{
            \LogActivity::addToLog('View localNgoListReport.');

            $allDistrictList = DB::table('districts')->get();


            $localNgoListReport = DB::table('fd_one_forms')

            ->join('ngo_type_and_languages','ngo_type_and_languages.user_id','=','fd_one_forms.user_id')

            ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*')

            ->where('ngo_type_and_languages.ngo_type','দেশিও')
            ->orderBy('fd_one_forms.id','desc')
            ->get();




            return view('admin.report.localNgoListReport',compact('localNgoListReport','allDistrictList'));

        }catch (\Exception $e) {
            return redirect()->route('error_404')->with('error','some thing went wrong ');
        }


    }


    public function monthlyReportOfNgo(){
        if (is_null($this->user) || !$this->user->can('reportView')) {
            //abort(403, 'Sorry !! You are Unauthorized to view !');
            return redirect()->route('error_404');
        }


        try{
            \LogActivity::addToLog('View monthlyReportOfNgo.');


            $monthlyReportOfNgo = DB::table('fd_one_forms')

            ->join('ngo_statuses','ngo_statuses.fd_one_form_id','=','fd_one_forms.id')
            ->join('ngo_type_and_languages', 'ngo_type_and_languages.user_id', '=', 'fd_one_forms.user_id')
            ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*','ngo_statuses.*')
            ->where('ngo_statuses.status','Accepted')
            ->whereMonth('ngo_statuses.created_at',date('m'))
            ->whereYear('ngo_statuses.created_at',date('Y'))
            ->orderBy('fd_one_forms.id','desc')
            ->get();

            return view('admin.report.monthlyReportOfNgo',compact('monthlyReportOfNgo'));

        }catch (\Exception $e) {
            return redirect()->route('error_404')->with('error','some thing went wrong ');
        }


    }


    public function monthlyReportOfNgoRenew(){



        if (is_null($this->user) || !$this->user->can('reportView')) {
            //abort(403, 'Sorry !! You are Unauthorized to view !');
            return redirect()->route('error_404');
        }


        try{
            \LogActivity::addToLog('View monthlyReportOfNgo.');


            $monthlyReportOfNgo = DB::table('fd_one_forms')

            ->join('ngo_renews','ngo_renews.fd_one_form_id','=','fd_one_forms.id')
            ->join('ngo_type_and_languages', 'ngo_type_and_languages.user_id', '=', 'fd_one_forms.user_id')
            ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*','ngo_renews.*')
            ->where('ngo_renews.status','Accepted')
            ->whereMonth('ngo_renews.created_at',date('m'))
            ->whereYear('ngo_renews.created_at',date('Y'))
            ->orderBy('fd_one_forms.id','desc')
            ->get();

            return view('admin.report.monthlyReportOfNgoRenew',compact('monthlyReportOfNgo'));

        }catch (\Exception $e) {
            return redirect()->route('error_404')->with('error','some thing went wrong ');
        }



    }


    public function yearlyReportOfNgo(){



        if (is_null($this->user) || !$this->user->can('reportView')) {
            //abort(403, 'Sorry !! You are Unauthorized to view !');
            return redirect()->route('error_404');
        }


        try{
            \LogActivity::addToLog('View yearlyReportOfNgo.');


            $monthlyReportOfNgo = DB::table('fd_one_forms')

            ->join('ngo_statuses','ngo_statuses.fd_one_form_id','=','fd_one_forms.id')
            ->join('ngo_type_and_languages', 'ngo_type_and_languages.user_id', '=', 'fd_one_forms.user_id')
            ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*','ngo_statuses.*')
            ->where('ngo_statuses.status','Accepted')
            //->whereMonth('ngo_statuses.created_at',date('m'))
            ->whereYear('ngo_statuses.created_at',date('Y'))
            ->orderBy('fd_one_forms.id','desc')
            ->get();

            return view('admin.report.yearlyReportOfNgo',compact('monthlyReportOfNgo'));

        }catch (\Exception $e) {
            return redirect()->route('error_404')->with('error','some thing went wrong ');
        }



    }


    public function yearlyReportOfNgoRenew(){



        if (is_null($this->user) || !$this->user->can('reportView')) {
            //abort(403, 'Sorry !! You are Unauthorized to view !');
            return redirect()->route('error_404');
        }


        try{
            \LogActivity::addToLog('View yearlyReportOfNgoRenew.');


            $monthlyReportOfNgo = DB::table('fd_one_forms')

            ->join('ngo_renews','ngo_renews.fd_one_form_id','=','fd_one_forms.id')
            ->join('ngo_type_and_languages', 'ngo_type_and_languages.user_id', '=', 'fd_one_forms.user_id')
            ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*','ngo_renews.*')
            ->where('ngo_renews.status','Accepted')
            //->whereMonth('ngo_renews.created_at',date('m'))
            ->whereYear('ngo_renews.created_at',date('Y'))
            ->orderBy('fd_one_forms.id','desc')
            ->get();

            return view('admin.report.yearlyReportOfNgoRenew',compact('monthlyReportOfNgo'));

        }catch (\Exception $e) {
            return redirect()->route('error_404')->with('error','some thing went wrong ');
        }



    }


    public function monthlyReportOfNgoRenewSearch(Request $request){

//dd($request->all());

        if (is_null($this->user) || !$this->user->can('reportView')) {
            //abort(403, 'Sorry !! You are Unauthorized to view !');
            return redirect()->route('error_404');
        }


        try{
            \LogActivity::addToLog('View monthlyReportOfNgo.');


            // new code start



            $startDateConcate = date($request->year_name."-".$request->from_month_name."-"."01");


            if(!empty($request->from_month_name) && !empty($request->to_month_name)){

                //second condition start

            $endDateConcateString = date($request->year_name."-".$request->to_month_name."-"."14");
            $endDate = strtotime($endDateConcateString);
            $lastdate = strtotime(date("Y-m-t", $endDate));
            $finalDay = date("Y-m-d", $lastdate);


                if($request->ngo_type == 'সকল'){



            $monthlyReportOfNgo = DB::table('fd_one_forms')
            ->join('ngo_renews','ngo_renews.fd_one_form_id','=','fd_one_forms.id')
            ->join('ngo_type_and_languages', 'ngo_type_and_languages.user_id', '=', 'fd_one_forms.user_id')
            ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*','ngo_renews.*')
            ->where('ngo_renews.status','Accepted')
            ->whereBetween('ngo_renews.created_at', [$startDateConcate, $finalDay])
            ->orderBy('fd_one_forms.id','desc')
            ->get();



                }elseif($request->ngo_type == 'দেশি'){

                    $monthlyReportOfNgo = DB::table('fd_one_forms')
                    ->join('ngo_renews','ngo_renews.fd_one_form_id','=','fd_one_forms.id')
                    ->join('ngo_type_and_languages', 'ngo_type_and_languages.user_id', '=', 'fd_one_forms.user_id')
                    ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*','ngo_renews.*')
                    ->where('ngo_renews.status','Accepted')
                    ->where('ngo_type_and_languages.ngo_type','দেশিও')
                    ->whereBetween('ngo_renews.created_at', [$startDateConcate, $finalDay])
                    ->orderBy('fd_one_forms.id','desc')
                    ->get();


                }else{

                    $monthlyReportOfNgo = DB::table('fd_one_forms')
                    ->join('ngo_renews','ngo_renews.fd_one_form_id','=','fd_one_forms.id')
                    ->join('ngo_type_and_languages', 'ngo_type_and_languages.user_id', '=', 'fd_one_forms.user_id')
                    ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*','ngo_renews.*')
                    ->where('ngo_renews.status','Accepted')
                    ->where('ngo_type_and_languages.ngo_type','Foreign')
                    ->whereBetween('ngo_renews.created_at', [$startDateConcate, $finalDay])
                    ->orderBy('fd_one_forms.id','desc')
                    ->get();
                }


                //end second condition

            }elseif(empty($request->to_month_name)){

// dd(12);
                 //second condition start

                 if($request->ngo_type == 'সকল'){


                    $monthlyReportOfNgo = DB::table('fd_one_forms')
            ->join('ngo_renews','ngo_renews.fd_one_form_id','=','fd_one_forms.id')
            ->join('ngo_type_and_languages', 'ngo_type_and_languages.user_id', '=', 'fd_one_forms.user_id')
            ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*','ngo_renews.*')
            ->where('ngo_renews.status','Accepted')
            ->whereMonth('ngo_renews.created_at',$request->from_month_name)
            ->whereYear('ngo_renews.created_at',$request->year_name)
            ->orderBy('fd_one_forms.id','desc')
            ->get();



                 }elseif($request->ngo_type == 'দেশি'){


                    $monthlyReportOfNgo = DB::table('fd_one_forms')
                    ->join('ngo_renews','ngo_renews.fd_one_form_id','=','fd_one_forms.id')
                    ->join('ngo_type_and_languages', 'ngo_type_and_languages.user_id', '=', 'fd_one_forms.user_id')
                    ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*','ngo_renews.*')
                    ->where('ngo_renews.status','Accepted')
                    ->where('ngo_type_and_languages.ngo_type','দেশিও')
                    ->whereMonth('ngo_renews.created_at',$request->from_month_name)
                    ->whereYear('ngo_renews.created_at',$request->year_name)
                    ->orderBy('fd_one_forms.id','desc')
                    ->get();

                 }else{

                    $monthlyReportOfNgo = DB::table('fd_one_forms')
                    ->join('ngo_renews','ngo_renews.fd_one_form_id','=','fd_one_forms.id')
                    ->join('ngo_type_and_languages', 'ngo_type_and_languages.user_id', '=', 'fd_one_forms.user_id')
                    ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*','ngo_renews.*')
                    ->where('ngo_renews.status','Accepted')
                    ->where('ngo_type_and_languages.ngo_type','Foreign')
                    ->whereMonth('ngo_renews.created_at',$request->from_month_name)
                    ->whereYear('ngo_renews.created_at',$request->year_name)
                    ->orderBy('fd_one_forms.id','desc')
                    ->get();

                 }


                 //end second condition

            }


            // new code end

            $ngoType = $request->ngo_type;
            $monthName = $request->from_month_name;
            $toMonthName = $request->to_month_name;
            $yearName = $request->year_name;

            return view('admin.report.monthlyReportOfNgoRenewSearch',compact('toMonthName','monthName','ngoType','yearName','monthName','monthlyReportOfNgo'));

        }catch (\Exception $e) {
            return redirect()->route('error_404')->with('error','some thing went wrong ');
        }

    }




    public function monthlyReportOfNgoSearch(Request $request){



        if (is_null($this->user) || !$this->user->can('reportView')) {
            //abort(403, 'Sorry !! You are Unauthorized to view !');
            return redirect()->route('error_404');
        }


        try{

            // new code start

            $startDateConcate = date($request->year_name."-".$request->from_month_name."-"."01");


            if(!empty($request->from_month_name) && !empty($request->to_month_name)){

                //second condition start

            $endDateConcateString = date($request->year_name."-".$request->to_month_name."-"."14");
            $endDate = strtotime($endDateConcateString);
            $lastdate = strtotime(date("Y-m-t", $endDate));
            $finalDay = date("Y-m-d", $lastdate);


                if($request->ngo_type == 'সকল'){



            $monthlyReportOfNgo = DB::table('fd_one_forms')
            ->join('ngo_statuses','ngo_statuses.fd_one_form_id','=','fd_one_forms.id')
            ->join('ngo_type_and_languages', 'ngo_type_and_languages.user_id', '=', 'fd_one_forms.user_id')
            ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*','ngo_statuses.*')
            ->where('ngo_statuses.status','Accepted')
            ->whereBetween('ngo_statuses.created_at', [$startDateConcate, $finalDay])
            ->orderBy('fd_one_forms.id','desc')
            ->get();



                }elseif($request->ngo_type == 'দেশি'){

                    $monthlyReportOfNgo = DB::table('fd_one_forms')
                    ->join('ngo_statuses','ngo_statuses.fd_one_form_id','=','fd_one_forms.id')
                    ->join('ngo_type_and_languages', 'ngo_type_and_languages.user_id', '=', 'fd_one_forms.user_id')
                    ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*','ngo_statuses.*')
                    ->where('ngo_statuses.status','Accepted')
                    ->where('ngo_type_and_languages.ngo_type','দেশিও')
                    ->whereBetween('ngo_statuses.created_at', [$startDateConcate, $finalDay])
                    ->orderBy('fd_one_forms.id','desc')
                    ->get();


                }else{

                    $monthlyReportOfNgo = DB::table('fd_one_forms')
                    ->join('ngo_statuses','ngo_statuses.fd_one_form_id','=','fd_one_forms.id')
                    ->join('ngo_type_and_languages', 'ngo_type_and_languages.user_id', '=', 'fd_one_forms.user_id')
                    ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*','ngo_statuses.*')
                    ->where('ngo_statuses.status','Accepted')
                    ->where('ngo_type_and_languages.ngo_type','Foreign')
                    ->whereBetween('ngo_statuses.created_at', [$startDateConcate, $finalDay])
                    ->orderBy('fd_one_forms.id','desc')
                    ->get();
                }


                //end second condition

            }elseif(empty($request->to_month_name)){

// dd(12);
                 //second condition start

                 if($request->ngo_type == 'সকল'){


                    $monthlyReportOfNgo = DB::table('fd_one_forms')
            ->join('ngo_statuses','ngo_statuses.fd_one_form_id','=','fd_one_forms.id')
            ->join('ngo_type_and_languages', 'ngo_type_and_languages.user_id', '=', 'fd_one_forms.user_id')
            ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*','ngo_statuses.*')
            ->where('ngo_statuses.status','Accepted')
            ->whereMonth('ngo_statuses.created_at',$request->from_month_name)
            ->whereYear('ngo_statuses.created_at',$request->year_name)
            ->orderBy('fd_one_forms.id','desc')
            ->get();



                 }elseif($request->ngo_type == 'দেশি'){


                    $monthlyReportOfNgo = DB::table('fd_one_forms')
                    ->join('ngo_statuses','ngo_statuses.fd_one_form_id','=','fd_one_forms.id')
                    ->join('ngo_type_and_languages', 'ngo_type_and_languages.user_id', '=', 'fd_one_forms.user_id')
                    ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*','ngo_statuses.*')
                    ->where('ngo_statuses.status','Accepted')
                    ->where('ngo_type_and_languages.ngo_type','দেশিও')
                    ->whereMonth('ngo_statuses.created_at',$request->from_month_name)
                    ->whereYear('ngo_statuses.created_at',$request->year_name)
                    ->orderBy('fd_one_forms.id','desc')
                    ->get();

                 }else{

                    $monthlyReportOfNgo = DB::table('fd_one_forms')
                    ->join('ngo_statuses','ngo_statuses.fd_one_form_id','=','fd_one_forms.id')
                    ->join('ngo_type_and_languages', 'ngo_type_and_languages.user_id', '=', 'fd_one_forms.user_id')
                    ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*','ngo_statuses.*')
                    ->where('ngo_statuses.status','Accepted')
                    ->where('ngo_type_and_languages.ngo_type','Foreign')
                    ->whereMonth('ngo_statuses.created_at',$request->from_month_name)
                    ->whereYear('ngo_statuses.created_at',$request->year_name)
                    ->orderBy('fd_one_forms.id','desc')
                    ->get();

                 }


                 //end second condition

            }


            // new code end

            $ngoType = $request->ngo_type;
            $monthName = $request->from_month_name;
            $toMonthName = $request->to_month_name;
            $yearName = $request->year_name;

            return view('admin.report.monthlyReportOfNgoSearch',compact('toMonthName','monthName','ngoType','yearName','monthName','monthlyReportOfNgo'));


        }catch (\Exception $e) {
            return redirect()->route('error_404')->with('error','some thing went wrong ');
        }

    }

    public function yearlyReportOfNgoSearch(Request $request){



        if (is_null($this->user) || !$this->user->can('reportView')) {
            //abort(403, 'Sorry !! You are Unauthorized to view !');
            return redirect()->route('error_404');
        }


        try{
            \LogActivity::addToLog('View yearly Report Of Ngo.');

 // new code start



 $startDateConcate = date($request->from_year_name."-"."01"."-"."01");


 if(!empty($request->from_year_name) && !empty($request->to_year_name)){

     //second condition start

 $endDateConcateString = date($request->to_year_name."-"."12"."-"."14");
 $endDate = strtotime($endDateConcateString);
 $lastdate = strtotime(date("Y-m-t", $endDate));
 $finalDay = date("Y-m-d", $lastdate);


     if($request->ngo_type == 'সকল'){



 $monthlyReportOfNgo = DB::table('fd_one_forms')
 ->join('ngo_statuses','ngo_statuses.fd_one_form_id','=','fd_one_forms.id')
 ->join('ngo_type_and_languages', 'ngo_type_and_languages.user_id', '=', 'fd_one_forms.user_id')
 ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*','ngo_statuses.*')
 ->where('ngo_statuses.status','Accepted')
 ->whereBetween('ngo_statuses.created_at', [$startDateConcate, $finalDay])
 ->orderBy('fd_one_forms.id','desc')
 ->get();



     }elseif($request->ngo_type == 'দেশি'){

         $monthlyReportOfNgo = DB::table('fd_one_forms')
         ->join('ngo_statuses','ngo_statuses.fd_one_form_id','=','fd_one_forms.id')
         ->join('ngo_type_and_languages', 'ngo_type_and_languages.user_id', '=', 'fd_one_forms.user_id')
         ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*','ngo_statuses.*')
         ->where('ngo_statuses.status','Accepted')
         ->where('ngo_type_and_languages.ngo_type','দেশিও')
         ->whereBetween('ngo_statuses.created_at', [$startDateConcate, $finalDay])
         ->orderBy('fd_one_forms.id','desc')
         ->get();


     }else{

         $monthlyReportOfNgo = DB::table('fd_one_forms')
         ->join('ngo_statuses','ngo_statuses.fd_one_form_id','=','fd_one_forms.id')
         ->join('ngo_type_and_languages', 'ngo_type_and_languages.user_id', '=', 'fd_one_forms.user_id')
         ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*','ngo_statuses.*')
         ->where('ngo_statuses.status','Accepted')
         ->where('ngo_type_and_languages.ngo_type','Foreign')
         ->whereBetween('ngo_statuses.created_at', [$startDateConcate, $finalDay])
         ->orderBy('fd_one_forms.id','desc')
         ->get();
     }


     //end second condition

 }elseif(empty($request->to_year_name)){

// dd(12);
      //second condition start

      if($request->ngo_type == 'সকল'){


         $monthlyReportOfNgo = DB::table('fd_one_forms')
 ->join('ngo_statuses','ngo_statuses.fd_one_form_id','=','fd_one_forms.id')
 ->join('ngo_type_and_languages', 'ngo_type_and_languages.user_id', '=', 'fd_one_forms.user_id')
 ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*','ngo_statuses.*')
 ->where('ngo_statuses.status','Accepted')
 //->whereMonth('ngo_statuses.created_at',$request->from_month_name)
 ->whereYear('ngo_statuses.created_at',$request->from_year_name)
 ->orderBy('fd_one_forms.id','desc')
 ->get();



      }elseif($request->ngo_type == 'দেশি'){


         $monthlyReportOfNgo = DB::table('fd_one_forms')
         ->join('ngo_statuses','ngo_statuses.fd_one_form_id','=','fd_one_forms.id')
         ->join('ngo_type_and_languages', 'ngo_type_and_languages.user_id', '=', 'fd_one_forms.user_id')
         ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*','ngo_statuses.*')
         ->where('ngo_statuses.status','Accepted')
         ->where('ngo_type_and_languages.ngo_type','দেশিও')
         //->whereMonth('ngo_statuses.created_at',$request->from_month_name)
         ->whereYear('ngo_statuses.created_at',$request->from_year_name)
         ->orderBy('fd_one_forms.id','desc')
         ->get();

      }else{

         $monthlyReportOfNgo = DB::table('fd_one_forms')
         ->join('ngo_statuses','ngo_statuses.fd_one_form_id','=','fd_one_forms.id')
         ->join('ngo_type_and_languages', 'ngo_type_and_languages.user_id', '=', 'fd_one_forms.user_id')
         ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*','ngo_statuses.*')
         ->where('ngo_statuses.status','Accepted')
         ->where('ngo_type_and_languages.ngo_type','Foreign')
         //->whereMonth('ngo_statuses.created_at',$request->from_month_name)
         ->whereYear('ngo_statuses.created_at',$request->from_year_name)
         ->orderBy('fd_one_forms.id','desc')
         ->get();

      }


      //end second condition

 }


 // new code end

 $ngoType = $request->ngo_type;
 $from_year_name = $request->from_year_name;
 $to_year_name = $request->to_year_name;

 return view('admin.report.yearlyReportOfNgoSearch',compact('from_year_name','to_year_name','ngoType','monthlyReportOfNgo'));


        }catch (\Exception $e) {
            return redirect()->route('error_404')->with('error','some thing went wrong ');
        }

    }



    public function yearlyReportOfNgoRenewSearch(Request $request){



        if (is_null($this->user) || !$this->user->can('reportView')) {
            //abort(403, 'Sorry !! You are Unauthorized to view !');
            return redirect()->route('error_404');
        }

       // dd($request->all());

        try{
            \LogActivity::addToLog('View monthlyReportOfNgo.');


             // new code start



             $startDateConcate = date($request->from_year_name."-"."01"."-"."01");


             if(!empty($request->from_year_name) && !empty($request->to_year_name)){

                 //second condition start

             $endDateConcateString = date($request->to_year_name."-"."12"."-"."14");
             $endDate = strtotime($endDateConcateString);
             $lastdate = strtotime(date("Y-m-t", $endDate));
             $finalDay = date("Y-m-d", $lastdate);


                 if($request->ngo_type == 'সকল'){



             $monthlyReportOfNgo = DB::table('fd_one_forms')
             ->join('ngo_renews','ngo_renews.fd_one_form_id','=','fd_one_forms.id')
             ->join('ngo_type_and_languages', 'ngo_type_and_languages.user_id', '=', 'fd_one_forms.user_id')
             ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*','ngo_renews.*')
             ->where('ngo_renews.status','Accepted')
             ->whereBetween('ngo_renews.created_at', [$startDateConcate, $finalDay])
             ->orderBy('fd_one_forms.id','desc')
             ->get();



                 }elseif($request->ngo_type == 'দেশি'){

                     $monthlyReportOfNgo = DB::table('fd_one_forms')
                     ->join('ngo_renews','ngo_renews.fd_one_form_id','=','fd_one_forms.id')
                     ->join('ngo_type_and_languages', 'ngo_type_and_languages.user_id', '=', 'fd_one_forms.user_id')
                     ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*','ngo_renews.*')
                     ->where('ngo_renews.status','Accepted')
                     ->where('ngo_type_and_languages.ngo_type','দেশিও')
                     ->whereBetween('ngo_renews.created_at', [$startDateConcate, $finalDay])
                     ->orderBy('fd_one_forms.id','desc')
                     ->get();


                 }else{

                     $monthlyReportOfNgo = DB::table('fd_one_forms')
                     ->join('ngo_renews','ngo_renews.fd_one_form_id','=','fd_one_forms.id')
                     ->join('ngo_type_and_languages', 'ngo_type_and_languages.user_id', '=', 'fd_one_forms.user_id')
                     ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*','ngo_renews.*')
                     ->where('ngo_renews.status','Accepted')
                     ->where('ngo_type_and_languages.ngo_type','Foreign')
                     ->whereBetween('ngo_renews.created_at', [$startDateConcate, $finalDay])
                     ->orderBy('fd_one_forms.id','desc')
                     ->get();
                 }


                 //end second condition

             }elseif(empty($request->to_year_name)){

 // dd(12);
                  //second condition start

                  if($request->ngo_type == 'সকল'){


                     $monthlyReportOfNgo = DB::table('fd_one_forms')
             ->join('ngo_renews','ngo_renews.fd_one_form_id','=','fd_one_forms.id')
             ->join('ngo_type_and_languages', 'ngo_type_and_languages.user_id', '=', 'fd_one_forms.user_id')
             ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*','ngo_renews.*')
             ->where('ngo_renews.status','Accepted')
             //->whereMonth('ngo_renews.created_at',$request->from_month_name)
             ->whereYear('ngo_renews.created_at',$request->from_year_name)
             ->orderBy('fd_one_forms.id','desc')
             ->get();



                  }elseif($request->ngo_type == 'দেশি'){


                     $monthlyReportOfNgo = DB::table('fd_one_forms')
                     ->join('ngo_renews','ngo_renews.fd_one_form_id','=','fd_one_forms.id')
                     ->join('ngo_type_and_languages', 'ngo_type_and_languages.user_id', '=', 'fd_one_forms.user_id')
                     ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*','ngo_renews.*')
                     ->where('ngo_renews.status','Accepted')
                     ->where('ngo_type_and_languages.ngo_type','দেশিও')
                     //->whereMonth('ngo_renews.created_at',$request->from_month_name)
                     ->whereYear('ngo_renews.created_at',$request->from_year_name)
                     ->orderBy('fd_one_forms.id','desc')
                     ->get();

                  }else{

                     $monthlyReportOfNgo = DB::table('fd_one_forms')
                     ->join('ngo_renews','ngo_renews.fd_one_form_id','=','fd_one_forms.id')
                     ->join('ngo_type_and_languages', 'ngo_type_and_languages.user_id', '=', 'fd_one_forms.user_id')
                     ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*','ngo_renews.*')
                     ->where('ngo_renews.status','Accepted')
                     ->where('ngo_type_and_languages.ngo_type','Foreign')
                     //->whereMonth('ngo_renews.created_at',$request->from_month_name)
                     ->whereYear('ngo_renews.created_at',$request->from_year_name)
                     ->orderBy('fd_one_forms.id','desc')
                     ->get();

                  }


                  //end second condition

             }


             // new code end

             $ngoType = $request->ngo_type;
             $from_year_name = $request->from_year_name;
             $to_year_name = $request->to_year_name;

             return view('admin.report.yearlyReportOfNgoRenewSearch',compact('from_year_name','to_year_name','ngoType','monthlyReportOfNgo'));

         }catch (\Exception $e) {
             return redirect()->route('error_404')->with('error','some thing went wrong ');
         }




        //     $monthlyReportOfNgo = DB::table('fd_one_forms')

        //     ->join('ngo_renews','ngo_renews.fd_one_form_id','=','fd_one_forms.id')
        //     ->join('ngo_type_and_languages', 'ngo_type_and_languages.user_id', '=', 'fd_one_forms.user_id')
        //     ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*','ngo_renews.*')
        //     ->where('ngo_renews.status','Accepted')
        //     //->whereMonth('ngo_renews.created_at',$request->month_name)
        //     ->whereYear('ngo_renews.created_at',$request->year_name)
        //     ->orderBy('fd_one_forms.id','desc')
        //     ->get();


        //     $monthName = $request->month_name;
        //     $yearName = $request->year_name;

        //     return view('admin.report.yearlyReportOfNgoRenewSearch',compact('yearName','monthName','monthlyReportOfNgo'));

        // }catch (\Exception $e) {
        //     return redirect()->route('error_404')->with('error','some thing went wrong ');
        // }

    }



    public function monthlyReportOfNgoRenewPrint(){



        if (is_null($this->user) || !$this->user->can('reportView')) {
            //abort(403, 'Sorry !! You are Unauthorized to view !');
            return redirect()->route('error_404');
        }


        try{
            \LogActivity::addToLog('View monthlyReportOfNgo.');


            $monthlyReportOfNgo = DB::table('fd_one_forms')

            ->join('ngo_renews','ngo_renews.fd_one_form_id','=','fd_one_forms.id')
            ->join('ngo_type_and_languages', 'ngo_type_and_languages.user_id', '=', 'fd_one_forms.user_id')
            ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*','ngo_renews.*')
            ->where('ngo_renews.status','Accepted')
            ->whereMonth('ngo_renews.created_at',date('m'))
            ->whereYear('ngo_renews.created_at',date('Y'))
            ->orderBy('fd_one_forms.id','desc')
            ->get();

            $data = view('admin.report.monthlyReportOfNgoRenewPrint',['monthlyReportOfNgo'=>$monthlyReportOfNgo])->render();

        $mpdf = new Mpdf([
            'default_font' => 'nikosh'
        ]);

        $mpdf->WriteHTML($data);
        $mpdf->Output();
        die();

        }catch (\Exception $e) {
            return redirect()->route('error_404')->with('error','some thing went wrong ');
        }



    }


    public function yearlyReportOfNgoPrint(){

        try{

            $monthlyReportOfNgo = DB::table('fd_one_forms')

            ->join('ngo_statuses','ngo_statuses.fd_one_form_id','=','fd_one_forms.id')
            ->join('ngo_type_and_languages', 'ngo_type_and_languages.user_id', '=', 'fd_one_forms.user_id')
            ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*','ngo_statuses.*')
            ->where('ngo_statuses.status','Accepted')
            //->whereMonth('ngo_statuses.created_at',date('m'))
            ->whereYear('ngo_statuses.created_at',date('Y'))
            ->orderBy('fd_one_forms.id','desc')
            ->get();


        $data = view('admin.report.yearlyReportOfNgoPrint',['monthlyReportOfNgo'=>$monthlyReportOfNgo])->render();

        $mpdf = new Mpdf([
            'default_font' => 'nikosh'
        ]);

        $mpdf->WriteHTML($data);
        $mpdf->Output();
        die();

        } catch (\Exception $e) {
            return redirect()->route('error_404')->with('error','some thing went wrong ');
        }
    }


    public function monthlyReportOfNgoPrint(){

        try{

            $monthlyReportOfNgo = DB::table('fd_one_forms')

            ->join('ngo_statuses','ngo_statuses.fd_one_form_id','=','fd_one_forms.id')
            ->join('ngo_type_and_languages', 'ngo_type_and_languages.user_id', '=', 'fd_one_forms.user_id')
            ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*','ngo_statuses.*')
            ->where('ngo_statuses.status','Accepted')
            ->whereMonth('ngo_statuses.created_at',date('m'))
            ->whereYear('ngo_statuses.created_at',date('Y'))
            ->orderBy('fd_one_forms.id','desc')
            ->get();


        $data = view('admin.report.monthlyReportOfNgoPrint',['monthlyReportOfNgo'=>$monthlyReportOfNgo])->render();

        $mpdf = new Mpdf([
            'default_font' => 'nikosh'
        ]);

        $mpdf->WriteHTML($data);
        $mpdf->Output();
        die();

        } catch (\Exception $e) {
            return redirect()->route('error_404')->with('error','some thing went wrong ');
        }
    }


    public function monthlyReportOfNgoSearchPrint($month,$to,$year,$type){


         try{


            $startDateConcate = date($year."-".$month."-"."01");


            if(!empty($month) && !empty($to)){

                //dd(12);

                //second condition start

            $endDateConcateString = date($year."-".$to."-"."14");
            $endDate = strtotime($endDateConcateString);
            $lastdate = strtotime(date("Y-m-t", $endDate));
            $finalDay = date("Y-m-d", $lastdate);


            $toMonthName = date("F",strtotime($endDateConcateString));


                if($type == 'সকল'){



            $monthlyReportOfNgo = DB::table('fd_one_forms')
            ->join('ngo_statuses','ngo_statuses.fd_one_form_id','=','fd_one_forms.id')
            ->join('ngo_type_and_languages', 'ngo_type_and_languages.user_id', '=', 'fd_one_forms.user_id')
            ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*','ngo_statuses.*')
            ->where('ngo_statuses.status','Accepted')
            ->whereBetween('ngo_statuses.created_at', [$startDateConcate, $finalDay])
            ->orderBy('fd_one_forms.id','desc')
            ->get();



                }elseif($type == 'দেশি'){

                    $monthlyReportOfNgo = DB::table('fd_one_forms')
                    ->join('ngo_statuses','ngo_statuses.fd_one_form_id','=','fd_one_forms.id')
                    ->join('ngo_type_and_languages', 'ngo_type_and_languages.user_id', '=', 'fd_one_forms.user_id')
                    ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*','ngo_statuses.*')
                    ->where('ngo_statuses.status','Accepted')
                    ->where('ngo_type_and_languages.ngo_type','দেশিও')
                    ->whereBetween('ngo_statuses.created_at', [$startDateConcate, $finalDay])
                    ->orderBy('fd_one_forms.id','desc')
                    ->get();


                }else{

                    $monthlyReportOfNgo = DB::table('fd_one_forms')
                    ->join('ngo_statuses','ngo_statuses.fd_one_form_id','=','fd_one_forms.id')
                    ->join('ngo_type_and_languages', 'ngo_type_and_languages.user_id', '=', 'fd_one_forms.user_id')
                    ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*','ngo_statuses.*')
                    ->where('ngo_statuses.status','Accepted')
                    ->where('ngo_type_and_languages.ngo_type','Foreign')
                    ->whereBetween('ngo_statuses.created_at', [$startDateConcate, $finalDay])
                    ->orderBy('fd_one_forms.id','desc')
                    ->get();
                }


                //end second condition

            }elseif($to == 0){

 //dd(12);

$toMonthName =0;
                 //second condition start

                 if($type == 'সকল'){


                    $monthlyReportOfNgo = DB::table('fd_one_forms')
            ->join('ngo_statuses','ngo_statuses.fd_one_form_id','=','fd_one_forms.id')
            ->join('ngo_type_and_languages', 'ngo_type_and_languages.user_id', '=', 'fd_one_forms.user_id')
            ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*','ngo_statuses.*')
            ->where('ngo_statuses.status','Accepted')
            ->whereMonth('ngo_statuses.created_at',$month)
            ->whereYear('ngo_statuses.created_at',$year)
            ->orderBy('fd_one_forms.id','desc')
            ->get();



                 }elseif($type == 'দেশি'){


                    $monthlyReportOfNgo = DB::table('fd_one_forms')
                    ->join('ngo_statuses','ngo_statuses.fd_one_form_id','=','fd_one_forms.id')
                    ->join('ngo_type_and_languages', 'ngo_type_and_languages.user_id', '=', 'fd_one_forms.user_id')
                    ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*','ngo_statuses.*')
                    ->where('ngo_statuses.status','Accepted')
                    ->where('ngo_type_and_languages.ngo_type','দেশিও')
                    ->whereMonth('ngo_statuses.created_at',$month)
            ->whereYear('ngo_statuses.created_at',$year)
                    ->orderBy('fd_one_forms.id','desc')
                    ->get();

                 }else{

                    $monthlyReportOfNgo = DB::table('fd_one_forms')
                    ->join('ngo_statuses','ngo_statuses.fd_one_form_id','=','fd_one_forms.id')
                    ->join('ngo_type_and_languages', 'ngo_type_and_languages.user_id', '=', 'fd_one_forms.user_id')
                    ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*','ngo_statuses.*')
                    ->where('ngo_statuses.status','Accepted')
                    ->where('ngo_type_and_languages.ngo_type','Foreign')
                    ->whereMonth('ngo_statuses.created_at',$month)
            ->whereYear('ngo_statuses.created_at',$year)
                    ->orderBy('fd_one_forms.id','desc')
                    ->get();

                 }


                 //end second condition

            }


            // new code end


          $fromMonthName = date("F",strtotime($startDateConcate));


        $data = view('admin.report.monthlyReportOfNgoSearchPrint',[
            'monthlyReportOfNgo'=>$monthlyReportOfNgo,
            'month'=>$month,
            'to'=>$to,
            'type'=>$type,
            'year'=>$year,
            'toMonthName'=>$toMonthName,
            'fromMonthName'=>$fromMonthName
            ])->render();

        $mpdf = new Mpdf([
            'default_font' => 'nikosh'
        ]);

        $mpdf->WriteHTML($data);
        $mpdf->Output();
        die();

        } catch (\Exception $e) {
            return redirect()->route('error_404')->with('error','some thing went wrong ');
        }

    }


    public function yearlyReportOfNgoSearchPrint($fromYear,$toYear,$type){


        $startDateConcate = date($fromYear."-"."01"."-"."01");


            if(!empty($fromYear) && !empty($toYear)){

                //second condition start

            $endDateConcateString = date($toYear."-"."12"."-"."14");
            $endDate = strtotime($endDateConcateString);
            $lastdate = strtotime(date("Y-m-t", $endDate));
            $finalDay = date("Y-m-d", $lastdate);


                if($type == 'সকল'){



            $monthlyReportOfNgo = DB::table('fd_one_forms')
            ->join('ngo_statuses','ngo_statuses.fd_one_form_id','=','fd_one_forms.id')
            ->join('ngo_type_and_languages', 'ngo_type_and_languages.user_id', '=', 'fd_one_forms.user_id')
            ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*','ngo_statuses.*')
            ->where('ngo_statuses.status','Accepted')
            ->whereBetween('ngo_statuses.created_at', [$startDateConcate, $finalDay])
            ->orderBy('fd_one_forms.id','desc')
            ->get();



                }elseif($type == 'দেশি'){

                    $monthlyReportOfNgo = DB::table('fd_one_forms')
                    ->join('ngo_statuses','ngo_statuses.fd_one_form_id','=','fd_one_forms.id')
                    ->join('ngo_type_and_languages', 'ngo_type_and_languages.user_id', '=', 'fd_one_forms.user_id')
                    ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*','ngo_statuses.*')
                    ->where('ngo_statuses.status','Accepted')
                    ->where('ngo_type_and_languages.ngo_type','দেশিও')
                    ->whereBetween('ngo_statuses.created_at', [$startDateConcate, $finalDay])
                    ->orderBy('fd_one_forms.id','desc')
                    ->get();


                }else{

                    $monthlyReportOfNgo = DB::table('fd_one_forms')
                    ->join('ngo_statuses','ngo_statuses.fd_one_form_id','=','fd_one_forms.id')
                    ->join('ngo_type_and_languages', 'ngo_type_and_languages.user_id', '=', 'fd_one_forms.user_id')
                    ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*','ngo_statuses.*')
                    ->where('ngo_statuses.status','Accepted')
                    ->where('ngo_type_and_languages.ngo_type','Foreign')
                    ->whereBetween('ngo_statuses.created_at', [$startDateConcate, $finalDay])
                    ->orderBy('fd_one_forms.id','desc')
                    ->get();
                }


                //end second condition

            }elseif(empty($to_year_name)){

// dd(12);
                 //second condition start

                 if($type == 'সকল'){


                    $monthlyReportOfNgo = DB::table('fd_one_forms')
            ->join('ngo_statuses','ngo_statuses.fd_one_form_id','=','fd_one_forms.id')
            ->join('ngo_type_and_languages', 'ngo_type_and_languages.user_id', '=', 'fd_one_forms.user_id')
            ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*','ngo_statuses.*')
            ->where('ngo_statuses.status','Accepted')
            //->whereMonth('ngo_statuses.created_at',$from_month_name)
            ->whereYear('ngo_statuses.created_at',$fromYear)
            ->orderBy('fd_one_forms.id','desc')
            ->get();



                 }elseif($type == 'দেশি'){


                    $monthlyReportOfNgo = DB::table('fd_one_forms')
                    ->join('ngo_statuses','ngo_statuses.fd_one_form_id','=','fd_one_forms.id')
                    ->join('ngo_type_and_languages', 'ngo_type_and_languages.user_id', '=', 'fd_one_forms.user_id')
                    ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*','ngo_statuses.*')
                    ->where('ngo_statuses.status','Accepted')
                    ->where('ngo_type_and_languages.ngo_type','দেশিও')
                    //->whereMonth('ngo_statuses.created_at',$from_month_name)
                    ->whereYear('ngo_statuses.created_at',$fromYear)
                    ->orderBy('fd_one_forms.id','desc')
                    ->get();

                 }else{

                    $monthlyReportOfNgo = DB::table('fd_one_forms')
                    ->join('ngo_statuses','ngo_statuses.fd_one_form_id','=','fd_one_forms.id')
                    ->join('ngo_type_and_languages', 'ngo_type_and_languages.user_id', '=', 'fd_one_forms.user_id')
                    ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*','ngo_statuses.*')
                    ->where('ngo_statuses.status','Accepted')
                    ->where('ngo_type_and_languages.ngo_type','Foreign')
                    //->whereMonth('ngo_statuses.created_at',$from_month_name)
                    ->whereYear('ngo_statuses.created_at',$fromYear)
                    ->orderBy('fd_one_forms.id','desc')
                    ->get();

                 }


                 //end second condition

            }


            // new code end

         $data = view('admin.report.yearlyReportOfNgoSearchPrint',[
            'monthlyReportOfNgo'=>$monthlyReportOfNgo,
            'type'=>$type,
            'fromYear'=>$fromYear,
            'toYear'=>$toYear
            ])->render();

        $mpdf = new Mpdf([
            'default_font' => 'nikosh'
        ]);

        $mpdf->WriteHTML($data);
        $mpdf->Output();
        die();

    }




    public function yearlyReportOfNgoRenewPrint(){

        try{

            $monthlyReportOfNgo = DB::table('fd_one_forms')

            ->join('ngo_renews','ngo_renews.fd_one_form_id','=','fd_one_forms.id')
            ->join('ngo_type_and_languages', 'ngo_type_and_languages.user_id', '=', 'fd_one_forms.user_id')
            ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*','ngo_renews.*')
            ->where('ngo_renews.status','Accepted')
            //->whereMonth('ngo_renews.created_at',date('m'))
            ->whereYear('ngo_renews.created_at',date('Y'))
            ->orderBy('fd_one_forms.id','desc')
            ->get();


        $data = view('admin.report.yearlyReportOfNgoRenewPrint',['monthlyReportOfNgo'=>$monthlyReportOfNgo])->render();

        $mpdf = new Mpdf([
            'default_font' => 'nikosh'
        ]);

        $mpdf->WriteHTML($data);
        $mpdf->Output();
        die();

        } catch (\Exception $e) {
            return redirect()->route('error_404')->with('error','some thing went wrong ');
        }
    }



    public function yearlyReportOfNgoRenewSearchPrint($fromYear,$toYear,$type){






            $startDateConcate = date($fromYear."-"."01"."-"."01");


            if(!empty($fromYear) && !empty($toYear)){

                //second condition start

            $endDateConcateString = date($toYear."-"."12"."-"."14");
            $endDate = strtotime($endDateConcateString);
            $lastdate = strtotime(date("Y-m-t", $endDate));
            $finalDay = date("Y-m-d", $lastdate);


                if($type == 'সকল'){



            $monthlyReportOfNgo = DB::table('fd_one_forms')
            ->join('ngo_renews','ngo_renews.fd_one_form_id','=','fd_one_forms.id')
            ->join('ngo_type_and_languages', 'ngo_type_and_languages.user_id', '=', 'fd_one_forms.user_id')
            ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*','ngo_renews.*')
            ->where('ngo_renews.status','Accepted')
            ->whereBetween('ngo_renews.created_at', [$startDateConcate, $finalDay])
            ->orderBy('fd_one_forms.id','desc')
            ->get();



                }elseif($type == 'দেশি'){

                    $monthlyReportOfNgo = DB::table('fd_one_forms')
                    ->join('ngo_renews','ngo_renews.fd_one_form_id','=','fd_one_forms.id')
                    ->join('ngo_type_and_languages', 'ngo_type_and_languages.user_id', '=', 'fd_one_forms.user_id')
                    ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*','ngo_renews.*')
                    ->where('ngo_renews.status','Accepted')
                    ->where('ngo_type_and_languages.ngo_type','দেশিও')
                    ->whereBetween('ngo_renews.created_at', [$startDateConcate, $finalDay])
                    ->orderBy('fd_one_forms.id','desc')
                    ->get();


                }else{

                    $monthlyReportOfNgo = DB::table('fd_one_forms')
                    ->join('ngo_renews','ngo_renews.fd_one_form_id','=','fd_one_forms.id')
                    ->join('ngo_type_and_languages', 'ngo_type_and_languages.user_id', '=', 'fd_one_forms.user_id')
                    ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*','ngo_renews.*')
                    ->where('ngo_renews.status','Accepted')
                    ->where('ngo_type_and_languages.ngo_type','Foreign')
                    ->whereBetween('ngo_renews.created_at', [$startDateConcate, $finalDay])
                    ->orderBy('fd_one_forms.id','desc')
                    ->get();
                }


                //end second condition

            }elseif(empty($to_year_name)){

// dd(12);
                 //second condition start

                 if($type == 'সকল'){


                    $monthlyReportOfNgo = DB::table('fd_one_forms')
            ->join('ngo_renews','ngo_renews.fd_one_form_id','=','fd_one_forms.id')
            ->join('ngo_type_and_languages', 'ngo_type_and_languages.user_id', '=', 'fd_one_forms.user_id')
            ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*','ngo_renews.*')
            ->where('ngo_renews.status','Accepted')
            //->whereMonth('ngo_renews.created_at',$from_month_name)
            ->whereYear('ngo_renews.created_at',$fromYear)
            ->orderBy('fd_one_forms.id','desc')
            ->get();



                 }elseif($type == 'দেশি'){


                    $monthlyReportOfNgo = DB::table('fd_one_forms')
                    ->join('ngo_renews','ngo_renews.fd_one_form_id','=','fd_one_forms.id')
                    ->join('ngo_type_and_languages', 'ngo_type_and_languages.user_id', '=', 'fd_one_forms.user_id')
                    ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*','ngo_renews.*')
                    ->where('ngo_renews.status','Accepted')
                    ->where('ngo_type_and_languages.ngo_type','দেশিও')
                    //->whereMonth('ngo_renews.created_at',$from_month_name)
                    ->whereYear('ngo_renews.created_at',$fromYear)
                    ->orderBy('fd_one_forms.id','desc')
                    ->get();

                 }else{

                    $monthlyReportOfNgo = DB::table('fd_one_forms')
                    ->join('ngo_renews','ngo_renews.fd_one_form_id','=','fd_one_forms.id')
                    ->join('ngo_type_and_languages', 'ngo_type_and_languages.user_id', '=', 'fd_one_forms.user_id')
                    ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*','ngo_renews.*')
                    ->where('ngo_renews.status','Accepted')
                    ->where('ngo_type_and_languages.ngo_type','Foreign')
                    //->whereMonth('ngo_renews.created_at',$from_month_name)
                    ->whereYear('ngo_renews.created_at',$fromYear)
                    ->orderBy('fd_one_forms.id','desc')
                    ->get();

                 }


                 //end second condition

            }


            // new code end

         $data = view('admin.report.yearlyReportOfNgoRenewSearchPrint',[
            'monthlyReportOfNgo'=>$monthlyReportOfNgo,
            'type'=>$type,
            'fromYear'=>$fromYear,
            'toYear'=>$toYear
            ])->render();

        $mpdf = new Mpdf([
            'default_font' => 'nikosh'
        ]);

        $mpdf->WriteHTML($data);
        $mpdf->Output();
        die();





    }


    public function monthlyReportOfNgoRenewSearchPrint($month,$to,$year,$type){



        try{



            // new code start



            $startDateConcate = date($year."-".$month."-"."01");


            if(!empty($month) && !empty($to)){

                //dd(12);

                //second condition start

            $endDateConcateString = date($year."-".$to."-"."14");
            $endDate = strtotime($endDateConcateString);
            $lastdate = strtotime(date("Y-m-t", $endDate));
            $finalDay = date("Y-m-d", $lastdate);


            $toMonthName = date("F",strtotime($endDateConcateString));


                if($type == 'সকল'){



            $monthlyReportOfNgo = DB::table('fd_one_forms')
            ->join('ngo_renews','ngo_renews.fd_one_form_id','=','fd_one_forms.id')
            ->join('ngo_type_and_languages', 'ngo_type_and_languages.user_id', '=', 'fd_one_forms.user_id')
            ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*','ngo_renews.*')
            ->where('ngo_renews.status','Accepted')
            ->whereBetween('ngo_renews.created_at', [$startDateConcate, $finalDay])
            ->orderBy('fd_one_forms.id','desc')
            ->get();



                }elseif($type == 'দেশি'){

                    $monthlyReportOfNgo = DB::table('fd_one_forms')
                    ->join('ngo_renews','ngo_renews.fd_one_form_id','=','fd_one_forms.id')
                    ->join('ngo_type_and_languages', 'ngo_type_and_languages.user_id', '=', 'fd_one_forms.user_id')
                    ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*','ngo_renews.*')
                    ->where('ngo_renews.status','Accepted')
                    ->where('ngo_type_and_languages.ngo_type','দেশিও')
                    ->whereBetween('ngo_renews.created_at', [$startDateConcate, $finalDay])
                    ->orderBy('fd_one_forms.id','desc')
                    ->get();


                }else{

                    $monthlyReportOfNgo = DB::table('fd_one_forms')
                    ->join('ngo_renews','ngo_renews.fd_one_form_id','=','fd_one_forms.id')
                    ->join('ngo_type_and_languages', 'ngo_type_and_languages.user_id', '=', 'fd_one_forms.user_id')
                    ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*','ngo_renews.*')
                    ->where('ngo_renews.status','Accepted')
                    ->where('ngo_type_and_languages.ngo_type','Foreign')
                    ->whereBetween('ngo_renews.created_at', [$startDateConcate, $finalDay])
                    ->orderBy('fd_one_forms.id','desc')
                    ->get();
                }


                //end second condition

            }elseif($to == 0){

 //dd(12);

$toMonthName =0;
                 //second condition start

                 if($type == 'সকল'){


                    $monthlyReportOfNgo = DB::table('fd_one_forms')
            ->join('ngo_renews','ngo_renews.fd_one_form_id','=','fd_one_forms.id')
            ->join('ngo_type_and_languages', 'ngo_type_and_languages.user_id', '=', 'fd_one_forms.user_id')
            ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*','ngo_renews.*')
            ->where('ngo_renews.status','Accepted')
            ->whereMonth('ngo_renews.created_at',$month)
            ->whereYear('ngo_renews.created_at',$year)
            ->orderBy('fd_one_forms.id','desc')
            ->get();



                 }elseif($type == 'দেশি'){


                    $monthlyReportOfNgo = DB::table('fd_one_forms')
                    ->join('ngo_renews','ngo_renews.fd_one_form_id','=','fd_one_forms.id')
                    ->join('ngo_type_and_languages', 'ngo_type_and_languages.user_id', '=', 'fd_one_forms.user_id')
                    ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*','ngo_renews.*')
                    ->where('ngo_renews.status','Accepted')
                    ->where('ngo_type_and_languages.ngo_type','দেশিও')
                    ->whereMonth('ngo_renews.created_at',$month)
            ->whereYear('ngo_renews.created_at',$year)
                    ->orderBy('fd_one_forms.id','desc')
                    ->get();

                 }else{

                    $monthlyReportOfNgo = DB::table('fd_one_forms')
                    ->join('ngo_renews','ngo_renews.fd_one_form_id','=','fd_one_forms.id')
                    ->join('ngo_type_and_languages', 'ngo_type_and_languages.user_id', '=', 'fd_one_forms.user_id')
                    ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*','ngo_renews.*')
                    ->where('ngo_renews.status','Accepted')
                    ->where('ngo_type_and_languages.ngo_type','Foreign')
                    ->whereMonth('ngo_renews.created_at',$month)
            ->whereYear('ngo_renews.created_at',$year)
                    ->orderBy('fd_one_forms.id','desc')
                    ->get();

                 }


                 //end second condition

            }


            // new code end


          $fromMonthName = date("F",strtotime($startDateConcate));


        $data = view('admin.report.monthlyReportOfNgoRenewSearchPrint',[
            'monthlyReportOfNgo'=>$monthlyReportOfNgo,
            'month'=>$month,
            'to'=>$to,
            'type'=>$type,
            'year'=>$year,
            'toMonthName'=>$toMonthName,
            'fromMonthName'=>$fromMonthName
            ])->render();

        $mpdf = new Mpdf([
            'default_font' => 'nikosh'
        ]);

        $mpdf->WriteHTML($data);
        $mpdf->Output();
        die();

        } catch (\Exception $e) {
            return redirect()->route('error_404')->with('error','some thing went wrong ');
        }


    }





    public function foreignNgoListReport(){


        if (is_null($this->user) || !$this->user->can('reportView')) {
            //abort(403, 'Sorry !! You are Unauthorized to view !');
            return redirect()->route('error_404');
        }

        try{
            \LogActivity::addToLog('View foreignNgoListReport.');

            $allDistrictList = DB::table('districts')->get();


            $foreignNgoListReport = DB::table('fd_one_forms')

            ->join('ngo_type_and_languages','ngo_type_and_languages.user_id','=','fd_one_forms.user_id')

            ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*')

            ->where('ngo_type_and_languages.ngo_type','Foreign')
            ->orderBy('fd_one_forms.id','desc')
            ->get();

            return view('admin.report.foreignNgoListReport',compact('allDistrictList','foreignNgoListReport'));

        }catch (\Exception $e) {
            return redirect()->route('error_404')->with('error','some thing went wrong ');
        }


    }

    public function foreignNgoListSearch(Request $request){


        if($request->district_id == 'all'){

            $foreignNgoListReport = DB::table('fd_one_forms')

            ->join('ngo_type_and_languages','ngo_type_and_languages.user_id','=','fd_one_forms.user_id')

            ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*')

            ->where('ngo_type_and_languages.ngo_type','Foreign')
            ->orderBy('fd_one_forms.id','desc')
            ->get();


        }else{

            $foreignNgoListReport =DB::table('fd_one_forms')

            ->join('ngo_type_and_languages','ngo_type_and_languages.user_id','=','fd_one_forms.user_id')

            ->select('ngo_type_and_languages.id as lanId','ngo_type_and_languages.*','fd_one_forms.*')

            ->where('ngo_type_and_languages.ngo_type','Foreign')
            ->where('fd_one_forms.district_id',$request->district_id)

            ->orderBy('fd_one_forms.id','desc')
            ->get();
        }


        return view('admin.report.foreignNgoListSearch',compact('localNgoListReport'));

    }
}
