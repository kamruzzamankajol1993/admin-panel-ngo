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
class ProkolpoGraphicalReportController extends Controller
{
    public function index(){
        $projectSubjectList = ProjectSubject::orderBy('id','desc')->get();
        $divisionList = DB::table('civilinfos')->groupBy('division_bn')->select('division_bn')->get();
        $districtList = DB::table('civilinfos')->groupBy('district_bn')->select('district_bn')->get();
        $cityCorporationList = DB::table('civilinfos')->whereNotNull('city_orporation')->groupBy('city_orporation')->select('city_orporation')->get();
        return view('admin.prokolpoGraphicalReport.index',compact('divisionList','districtList','cityCorporationList','projectSubjectList'));
    }


    public function graphicReportFilterDistrict(Request $request){

        $districtName = $request->districtName;
        $prokolpoYear = $request->prokolpoYear;
        $prokolpoTypeId = $request->prokolpoTypeId;

        if(empty($prokolpoYear)){

            $prokolpoAreaListFd6 = DB::table('fd6_form_prokolpo_areas')
            ->join('fd6_forms', 'fd6_forms.id', '=', 'fd6_form_prokolpo_areas.fd6_form_id')
           ->select('fd6_form_prokolpo_areas.*','fd6_forms.*','fd6_forms.id as mainId')
            ->whereBetween('fd6_form_prokolpo_areas.created_at', [$formDate, $toDate])

            ->where('fd6_form_prokolpo_areas.district_name',$districtName)
            ->orderBy('fd6_forms.id','desc')

            ->get();

            $prokolpoAreaListFd7 = DB::table('fd7_form_prokolpo_areas')
            ->join('fd7_forms', 'fd7_forms.id', '=', 'fd7_form_prokolpo_areas.fd7_form_id')
            ->select('fd7_form_prokolpo_areas.*','fd7_forms.*','fd7_forms.id as mainId')
            ->where('fd7_form_prokolpo_areas.district_name',$districtName)

            ->whereIn('fd7_form_prokolpo_areas.prokolpo_type',$request->prokolpoTypeId)
            ->orderBy('fd7_forms.id','desc')
            ->get();


            $prokolpoAreaListFc1 = DB::table('prokolpo_areas')->where('type','fcOne')
            ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
            ->select('prokolpo_areas.*','fc1_forms.*','fc1_forms.id as mainId')

            ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpoTypeId)
            ->where('prokolpo_areas.district_name',$districtName)
            ->orderBy('fc1_forms.id','desc')
            ->get();


            $prokolpoAreaListFc2 = DB::table('prokolpo_areas')->where('type','fcTwo')
            ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
            ->select('prokolpo_areas.*','fc2_forms.*','fc2_forms.id as mainId')
            ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])

            ->where('prokolpo_areas.district_name',$districtName)
            ->orderBy('fc2_forms.id','desc')
            ->get();

        }elseif($prokolpoTypeId == []){

            $formYear = $request->prokolpoYear;
            $toYear =$request->prokolpoYear+1;

            $formDate = $formYear.'-07-01';
            $toDate = $toYear.'-06-30';

            $prokolpoAreaListFd6 = DB::table('fd6_form_prokolpo_areas')
            ->join('fd6_forms', 'fd6_forms.id', '=', 'fd6_form_prokolpo_areas.fd6_form_id')
           ->select('fd6_form_prokolpo_areas.*','fd6_forms.*','fd6_forms.id as mainId')
            ->whereBetween('fd6_form_prokolpo_areas.created_at', [$formDate, $toDate])
            ->where('fd6_form_prokolpo_areas.district_name',$districtName)

            ->orderBy('fd6_forms.id','desc')

            ->get();

            $prokolpoAreaListFd7 = DB::table('fd7_form_prokolpo_areas')
            ->join('fd7_forms', 'fd7_forms.id', '=', 'fd7_form_prokolpo_areas.fd7_form_id')
            ->select('fd7_form_prokolpo_areas.*','fd7_forms.*','fd7_forms.id as mainId')
            ->where('fd7_form_prokolpo_areas.district_name',$districtName)
            ->whereBetween('fd7_form_prokolpo_areas.created_at', [$formDate, $toDate])

            ->orderBy('fd7_forms.id','desc')
            ->get();


            $prokolpoAreaListFc1 = DB::table('prokolpo_areas')->where('type','fcOne')
            ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
            ->select('prokolpo_areas.*','fc1_forms.*','fc1_forms.id as mainId')
            ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])

            ->where('prokolpo_areas.district_name',$districtName)
            ->orderBy('fc1_forms.id','desc')
            ->get();


            $prokolpoAreaListFc2 = DB::table('prokolpo_areas')->where('type','fcTwo')
            ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
            ->select('prokolpo_areas.*','fc2_forms.*','fc2_forms.id as mainId')
            ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])

            ->where('prokolpo_areas.district_name',$districtName)
            ->orderBy('fc2_forms.id','desc')
            ->get();

        }else{

            $formYear = $request->prokolpoYear;
            $toYear =$request->prokolpoYear+1;

            $formDate = $formYear.'-07-01';
            $toDate = $toYear.'-06-30';

            $prokolpoAreaListFd6 = DB::table('fd6_form_prokolpo_areas')
         ->join('fd6_forms', 'fd6_forms.id', '=', 'fd6_form_prokolpo_areas.fd6_form_id')
        ->select('fd6_form_prokolpo_areas.*','fd6_forms.*','fd6_forms.id as mainId')
         ->whereBetween('fd6_form_prokolpo_areas.created_at', [$formDate, $toDate])
         ->whereIn('fd6_form_prokolpo_areas.prokolpo_type',$request->prokolpoTypeId)
         ->where('fd6_form_prokolpo_areas.district_name',$districtName)
         ->orderBy('fd6_forms.id','desc')

         ->get();

         $prokolpoAreaListFd7 = DB::table('fd7_form_prokolpo_areas')
         ->join('fd7_forms', 'fd7_forms.id', '=', 'fd7_form_prokolpo_areas.fd7_form_id')
         ->select('fd7_form_prokolpo_areas.*','fd7_forms.*','fd7_forms.id as mainId')
         ->where('fd7_form_prokolpo_areas.district_name',$districtName)
         ->whereBetween('fd7_form_prokolpo_areas.created_at', [$formDate, $toDate])
         ->whereIn('fd7_form_prokolpo_areas.prokolpo_type',$request->prokolpoTypeId)
         ->orderBy('fd7_forms.id','desc')
         ->get();


         $prokolpoAreaListFc1 = DB::table('prokolpo_areas')->where('type','fcOne')
         ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
         ->select('prokolpo_areas.*','fc1_forms.*','fc1_forms.id as mainId')
         ->whereBetween('fc1_form_prokolpo_areas.created_at', [$formDate, $toDate])
         ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpoTypeId)
         ->where('prokolpo_areas.district_name',$districtName)
         ->orderBy('fc1_forms.id','desc')
         ->get();


         $prokolpoAreaListFc2 = DB::table('prokolpo_areas')->where('type','fcTwo')
         ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
         ->select('prokolpo_areas.*','fc2_forms.*','fc2_forms.id as mainId')
         ->whereBetween('fc2_form_prokolpo_areas.created_at', [$formDate, $toDate])
         ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpoTypeId)
         ->where('prokolpo_areas.district_name',$districtName)
         ->orderBy('fc2_forms.id','desc')
         ->get();

        }

       

        return $data= view('admin.prokolpoGraphicalReport.graphicReportFilterDistrict',compact(
            'districtName',
            'prokolpoYear',
            'prokolpoTypeId',
            'prokolpoAreaListFd6',
            'prokolpoAreaListFd7',
            'prokolpoAreaListFc1',
            'prokolpoAreaListFc2',
        ));


    }


    public function create(Request $request){

        $districtName = $request->districtName;


         $prokolpoAreaListFd6 = DB::table('fd6_form_prokolpo_areas')
         ->join('fd6_forms', 'fd6_forms.id', '=', 'fd6_form_prokolpo_areas.fd6_form_id')
        ->select('fd6_form_prokolpo_areas.*','fd6_forms.*','fd6_forms.id as mainId')
         ->where('fd6_form_prokolpo_areas.district_name',$districtName)
         ->orderBy('fd6_forms.id','desc')

         ->get();

         $prokolpoAreaListFd7 = DB::table('fd7_form_prokolpo_areas')
         ->join('fd7_forms', 'fd7_forms.id', '=', 'fd7_form_prokolpo_areas.fd7_form_id')
         ->select('fd7_form_prokolpo_areas.*','fd7_forms.*','fd7_forms.id as mainId')
         ->where('fd7_form_prokolpo_areas.district_name',$districtName)
         ->orderBy('fd7_forms.id','desc')
         ->get();


         $prokolpoAreaListFc1 = DB::table('prokolpo_areas')->where('type','fcOne')
         ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
         ->select('prokolpo_areas.*','fc1_forms.*','fc1_forms.id as mainId')
         ->where('prokolpo_areas.district_name',$districtName)
         ->orderBy('fc1_forms.id','desc')
         ->get();


         $prokolpoAreaListFc2 = DB::table('prokolpo_areas')->where('type','fcTwo')
         ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
         ->select('prokolpo_areas.*','fc2_forms.*','fc2_forms.id as mainId')
         ->where('prokolpo_areas.district_name',$districtName)
         ->orderBy('fc2_forms.id','desc')
         ->get();

        return $data= view('admin.prokolpoGraphicalReport.prokolpoDetail',compact(
            'districtName',
            'prokolpoAreaListFd6',
            'prokolpoAreaListFd7',
            'prokolpoAreaListFc1',
            'prokolpoAreaListFc2',
        ));


    }


    public function graphicReportFilter(Request $request){

        $prokolpoType = $request->prokolpo_type;
        $distrcitName = $request->distric_name;
        $prokolpoYear = $request->prokolpo_year;

        //dd($request->prokolpo_type);

        $projectSubjectList = ProjectSubject::orderBy('id','desc')->get();
        $divisionList = DB::table('civilinfos')->groupBy('division_bn')->select('division_bn')->get();
        $districtList = DB::table('civilinfos')->groupBy('district_bn')->select('district_bn')->get();
        $cityCorporationList = DB::table('civilinfos')->whereNotNull('city_orporation')->groupBy('city_orporation')->select('city_orporation')->get();

        if(empty($request->prokolpo_type) && empty($request->distric_name)){

            $formYear = $request->prokolpo_year;
            $toYear =$request->prokolpo_year+1;

            $formDate = $formYear.'-07-01';
            $toDate = $toYear.'-06-30';

           // dd($toDate);

            $prokolpoAreaListFd6 = DB::table('fd6_form_prokolpo_areas')
            ->join('fd6_forms', 'fd6_forms.id', '=', 'fd6_form_prokolpo_areas.fd6_form_id')
            ->select('fd6_form_prokolpo_areas.*','fd6_forms.*','fd6_forms.id as mainId')
           ->whereBetween('fd6_form_prokolpo_areas.created_at', [$formDate, $toDate])
            ->orderBy('fd6_forms.id','desc')
            ->get();

            if(count($prokolpoAreaListFd6) == 0){

                $fd6SecondStepArray = [0];

            }else{

            $fd6FirstStep = $prokolpoAreaListFd6->implode("district_name", " ");
            $fd6SecondStepArray = explode(" ", $fd6FirstStep);
        }

            $prokolpoAreaListFd7 = DB::table('fd7_form_prokolpo_areas')
            ->join('fd7_forms', 'fd7_forms.id', '=', 'fd7_form_prokolpo_areas.fd7_form_id')
            ->select('fd7_form_prokolpo_areas.*','fd7_forms.*','fd7_forms.id as mainId')
            ->whereBetween('fd7_form_prokolpo_areas.created_at', [$formDate, $toDate])
            ->orderBy('fd7_forms.id','desc')
            ->get();

            if(count($prokolpoAreaListFd7) == 0){

                $fd7SecondStepArray = [0];

            }else{

            $fd7FirstStep = $prokolpoAreaListFd7->implode("district_name", " ");
            $fd7SecondStepArray = explode(" ", $fd7FirstStep);
            }

            $prokolpoAreaListFc1 = DB::table('prokolpo_areas')
            ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
            ->select('prokolpo_areas.*','fc1_forms.*','fc1_forms.id as mainId')
            ->where('prokolpo_areas.type','fcOne')
            ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
            ->orderBy('fc1_forms.id','desc')
            ->get();

            if(count($prokolpoAreaListFc1) == 0){

                $fc1SecondStepArray = [0];

            }else{

            $fc1FirstStep = $prokolpoAreaListFc1->implode("district_name", " ");
            $fc1SecondStepArray = explode(" ", $fc1FirstStep);
            }

            $prokolpoAreaListFc2 = DB::table('prokolpo_areas')
            ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
            ->select('prokolpo_areas.*','fc2_forms.*','fc2_forms.id as mainId')
            ->where('prokolpo_areas.type','fcTwo')
            ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
            ->orderBy('fc2_forms.id','desc')
            ->get();
            if(count($prokolpoAreaListFc2) == 0){

                $fc2SecondStepArray = [0];

            }else{
            $fc2FirstStep = $prokolpoAreaListFc2->implode("district_name", " ");
            $fc2SecondStepArray = explode(" ", $fc2FirstStep);
            }
        }elseif(empty($request->prokolpo_type) && empty($request->prokolpo_year)){

           // dd(2);

            $prokolpoAreaListFd6 = DB::table('fd6_form_prokolpo_areas')
            ->join('fd6_forms', 'fd6_forms.id', '=', 'fd6_form_prokolpo_areas.fd6_form_id')
            ->select('fd6_form_prokolpo_areas.*','fd6_forms.*','fd6_forms.id as mainId')
            ->whereIn('fd6_form_prokolpo_areas.district_name',$request->distric_name)
            ->orderBy('fd6_forms.id','desc')
            ->get();

            if(count($prokolpoAreaListFd6) == 0){

                $fd6SecondStepArray = [0];

            }else{

            $fd6SecondStepArray = $request->distric_name;

            }

            $prokolpoAreaListFd7 = DB::table('fd7_form_prokolpo_areas')
            ->join('fd7_forms', 'fd7_forms.id', '=', 'fd7_form_prokolpo_areas.fd7_form_id')
            ->select('fd7_form_prokolpo_areas.*','fd7_forms.*','fd7_forms.id as mainId')
            ->whereIn('fd7_form_prokolpo_areas.district_name',$request->distric_name)
            ->orderBy('fd7_forms.id','desc')
            ->get();

            if(count($prokolpoAreaListFd7) == 0){

                $fd7SecondStepArray = [0];

            }else{
            $fd7SecondStepArray = $request->distric_name;
            }

            $prokolpoAreaListFc1 = DB::table('prokolpo_areas')
            ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
            ->select('prokolpo_areas.*','fc1_forms.*','fc1_forms.id as mainId')
            ->where('prokolpo_areas.type','fcOne')
            ->whereIn('prokolpo_areas.district_name',$request->distric_name)
            ->orderBy('fc1_forms.id','desc')
            ->get();

            if(count($prokolpoAreaListFc1) == 0){

                $fc1SecondStepArray = [0];

            }else{


            $fc1SecondStepArray = $request->distric_name;
            }

            $prokolpoAreaListFc2 = DB::table('prokolpo_areas')->where('type','fcTwo')
            ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
            ->select('prokolpo_areas.*','fc2_forms.*','fc2_forms.id as mainId')
            ->where('prokolpo_areas.type','fcTwo')
            ->whereIn('prokolpo_areas.district_name',$request->distric_name)
            ->orderBy('fc2_forms.id','desc')
            ->get();

            if(count($prokolpoAreaListFc2) == 0){

                $fc2SecondStepArray = [0];

            }else{
            $fc2SecondStepArray = $request->distric_name;
            }
        }elseif(empty($request->distric_name) && empty($request->prokolpo_year)){

            //dd(3);

            $prokolpoAreaListFd6 = DB::table('fd6_form_prokolpo_areas')
            ->join('fd6_forms', 'fd6_forms.id', '=', 'fd6_form_prokolpo_areas.fd6_form_id')
            ->select('fd6_form_prokolpo_areas.*','fd6_forms.*','fd6_forms.id as mainId')
            ->whereIn('fd6_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
            ->orderBy('fd6_forms.id','desc')
            ->get();

            if(count($prokolpoAreaListFd6) == 0){

                $fd6SecondStepArray = [0];

            }else{

            $fd6FirstStep = $prokolpoAreaListFd6->implode("district_name", " ");
            $fd6SecondStepArray = explode(" ", $fd6FirstStep);
            }
            $prokolpoAreaListFd7 = DB::table('fd7_form_prokolpo_areas')
            ->join('fd7_forms', 'fd7_forms.id', '=', 'fd7_form_prokolpo_areas.fd7_form_id')
            ->select('fd7_form_prokolpo_areas.*','fd7_forms.*','fd7_forms.id as mainId')
            ->whereIn('fd7_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
            ->orderBy('fd7_forms.id','desc')
            ->get();

            if(count($prokolpoAreaListFd7) == 0){

                $fd7SecondStepArray = [0];

            }else{

            $fd7FirstStep = $prokolpoAreaListFd7->implode("district_name", " ");
            $fd7SecondStepArray = explode(" ", $fd7FirstStep);
            }

            $prokolpoAreaListFc1 = DB::table('prokolpo_areas')
            ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
            ->select('prokolpo_areas.*','fc1_forms.*','fc1_forms.id as mainId')
            ->where('prokolpo_areas.type','fcOne')
            ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
            ->orderBy('fc1_forms.id','desc')
            ->get();

            if(count($prokolpoAreaListFc1) == 0){

                $fc1SecondStepArray = [0];

            }else{

            $fc1FirstStep = $prokolpoAreaListFc1->implode("district_name", " ");
            $fc1SecondStepArray = explode(" ", $fc1FirstStep);
            }

            $prokolpoAreaListFc2 = DB::table('prokolpo_areas')
            ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
            ->select('prokolpo_areas.*','fc2_forms.*','fc2_forms.id as mainId')
            ->where('prokolpo_areas.type','fcTwo')
            ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
            ->orderBy('fc2_forms.id','desc')
            ->get();

            if(count($prokolpoAreaListFc2) == 0){

                $fc2SecondStepArray = [0];

            }else{

            $fc2FirstStep = $prokolpoAreaListFc2->implode("district_name", " ");
            $fc2SecondStepArray = explode(" ", $fc2FirstStep);
            }
        }elseif(empty($request->prokolpo_type)){

            //dd(4);

            $formYear = $request->prokolpo_year;
            $toYear =$request->prokolpo_year+1;

            $formDate = $formYear.'-07-01';
            $toDate = $toYear.'-06-30';

            $prokolpoAreaListFd6 = DB::table('fd6_form_prokolpo_areas')
         ->join('fd6_forms', 'fd6_forms.id', '=', 'fd6_form_prokolpo_areas.fd6_form_id')
         ->select('fd6_form_prokolpo_areas.*','fd6_forms.*','fd6_forms.id as mainId')
         ->whereBetween('fd6_form_prokolpo_areas.created_at', [$formDate, $toDate])
         ->whereIn('fd6_form_prokolpo_areas.district_name',$request->distric_name)
         ->orderBy('fd6_forms.id','desc')
         ->get();

         if(count($prokolpoAreaListFd6) == 0){

            $fd6SecondStepArray = [0];

        }else{
            $fd6SecondStepArray = $request->distric_name;
        }
         $prokolpoAreaListFd7 = DB::table('fd7_form_prokolpo_areas')
         ->join('fd7_forms', 'fd7_forms.id', '=', 'fd7_form_prokolpo_areas.fd7_form_id')
         ->select('fd7_form_prokolpo_areas.*','fd7_forms.*','fd7_forms.id as mainId')
         ->whereBetween('fd7_form_prokolpo_areas.created_at', [$formDate, $toDate])
         ->whereIn('fd7_form_prokolpo_areas.district_name',$request->distric_name)
         ->orderBy('fd7_forms.id','desc')
         ->get();

         if(count($prokolpoAreaListFd7) == 0){

            $fd7SecondStepArray = [0];

        }else{
            $fd7SecondStepArray = $request->distric_name;
        }
         $prokolpoAreaListFc1 = DB::table('prokolpo_areas')
         ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
         ->select('prokolpo_areas.*','fc1_forms.*','fc1_forms.id as mainId')
         ->where('prokolpo_areas.type','fcOne')
         ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
         ->whereIn('prokolpo_areas.district_name',$request->distric_name)
         ->orderBy('fc1_forms.id','desc')
         ->get();

         if(count($prokolpoAreaListFc1) == 0){

            $fc1SecondStepArray = [0];

        }else{

            $fc1SecondStepArray = $request->distric_name;
        }

         $prokolpoAreaListFc2 = DB::table('prokolpo_areas')
         ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
         ->select('prokolpo_areas.*','fc2_forms.*','fc2_forms.id as mainId')
         ->where('prokolpo_areas.type','fcTwo')
         ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
         ->whereIn('prokolpo_areas.district_name',$request->distric_name)
         ->orderBy('fc2_forms.id','desc')
         ->get();

         if(count($prokolpoAreaListFc2) == 0){

            $fc2SecondStepArray = [0];

        }else{
            $fc2SecondStepArray = $request->distric_name;
        }
        }elseif(empty($request->distric_name)){

            $formYear = $request->prokolpo_year;
            $toYear =$request->prokolpo_year+1;

            $formDate = $formYear.'-07-01';
            $toDate = $toYear.'-06-30';





            $prokolpoAreaListFd6 = DB::table('fd6_form_prokolpo_areas')
         ->join('fd6_forms', 'fd6_forms.id', '=', 'fd6_form_prokolpo_areas.fd6_form_id')
         ->select('fd6_form_prokolpo_areas.*','fd6_forms.*','fd6_forms.id as mainId')
         ->whereBetween('fd6_form_prokolpo_areas.created_at', [$formDate, $toDate])
         ->whereIn('fd6_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
         ->orderBy('fd6_forms.id','desc')
         ->get();

         if(count($prokolpoAreaListFd6) == 0){

            $fd6SecondStepArray = [0];

        }else{

         $fd6FirstStep = $prokolpoAreaListFd6->implode("district_name", " ");
            $fd6SecondStepArray = explode(" ", $fd6FirstStep);
        }
         $prokolpoAreaListFd7 = DB::table('fd7_form_prokolpo_areas')
         ->join('fd7_forms', 'fd7_forms.id', '=', 'fd7_form_prokolpo_areas.fd7_form_id')
         ->select('fd7_form_prokolpo_areas.*','fd7_forms.*','fd7_forms.id as mainId')
         ->whereBetween('fd7_form_prokolpo_areas.created_at', [$formDate, $toDate])
         ->whereIn('fd7_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
         ->orderBy('fd7_forms.id','desc')
         ->get();

         if(count($prokolpoAreaListFd7) == 0){

            $fd7SecondStepArray = [0];

        }else{

         $fd7FirstStep = $prokolpoAreaListFd7->implode("district_name", " ");
            $fd7SecondStepArray = explode(" ", $fd7FirstStep);
        }

         $prokolpoAreaListFc1 = DB::table('prokolpo_areas')
         ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
         ->select('prokolpo_areas.*','fc1_forms.*','fc1_forms.id as mainId')
         ->where('prokolpo_areas.type','fcOne')
         ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
         ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
         ->orderBy('fc1_forms.id','desc')
         ->get();

         if(count($prokolpoAreaListFc1) == 0){

            $fc1SecondStepArray = [0];

        }else{

         $fc1FirstStep = $prokolpoAreaListFc1->implode("district_name", " ");
            $fc1SecondStepArray = explode(" ", $fc1FirstStep);
        }

         $prokolpoAreaListFc2 = DB::table('prokolpo_areas')
         ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
         ->select('prokolpo_areas.*','fc2_forms.*','fc2_forms.id as mainId')
         ->where('prokolpo_areas.type','fcTwo')
         ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
         ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
         ->orderBy('fc2_forms.id','desc')
         ->get();

         if(count($prokolpoAreaListFc2) == 0){

            $fc2SecondStepArray = [0];

        }else{

         $fc2FirstStep = $prokolpoAreaListFc2->implode("district_name", " ");
            $fc2SecondStepArray = explode(" ", $fc2FirstStep);

        }

        }elseif(empty($request->prokolpo_year)){

            //dd(6);

            $prokolpoAreaListFd6 = DB::table('fd6_form_prokolpo_areas')
         ->join('fd6_forms', 'fd6_forms.id', '=', 'fd6_form_prokolpo_areas.fd6_form_id')
        ->select('fd6_form_prokolpo_areas.*','fd6_forms.*','fd6_forms.id as mainId')
         ->whereIn('fd6_form_prokolpo_areas.district_name',$request->distric_name)
         ->whereIn('fd6_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
         ->orderBy('fd6_forms.id','desc')
         ->get();

         if(count($prokolpoAreaListFd6) == 0){

            $fd6SecondStepArray = [0];

        }else{
            $fd6SecondStepArray = $request->distric_name;
        }
         $prokolpoAreaListFd7 = DB::table('fd7_form_prokolpo_areas')
         ->join('fd7_forms', 'fd7_forms.id', '=', 'fd7_form_prokolpo_areas.fd7_form_id')
         ->select('fd7_form_prokolpo_areas.*','fd7_forms.*','fd7_forms.id as mainId')
         ->whereIn('fd7_form_prokolpo_areas.district_name',$request->distric_name)
         ->whereIn('fd7_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
         ->orderBy('fd7_forms.id','desc')
         ->get();

         if(count($prokolpoAreaListFd7) == 0){

            $fd7SecondStepArray = [0];

        }else{
            $fd7SecondStepArray = $request->distric_name;
        }

         $prokolpoAreaListFc1 = DB::table('prokolpo_areas')
         ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
         ->select('prokolpo_areas.*','fc1_forms.*','fc1_forms.id as mainId')
         ->where('prokolpo_areas.type','fcOne')
         ->whereIn('prokolpo_areas.district_name',$request->distric_name)
         ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
         ->orderBy('fc1_forms.id','desc')
         ->get();

         if(count($prokolpoAreaListFc1) == 0){

            $fc1SecondStepArray = [0];

        }else{
            $fc1SecondStepArray = $request->distric_name;
        }

         $prokolpoAreaListFc2 = DB::table('prokolpo_areas')
         ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
         ->select('prokolpo_areas.*','fc2_forms.*','fc2_forms.id as mainId')
         ->where('prokolpo_areas.type','fcTwo')
         ->whereIn('prokolpo_areas.district_name',$request->distric_name)
         ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
         ->orderBy('fc2_forms.id','desc')
         ->get();

         if(count($prokolpoAreaListFc2) == 0){

            $fc2SecondStepArray = [0];

        }else{
            $fc2SecondStepArray = $request->distric_name;
        }
        }else{


            $formYear = $request->prokolpo_year;
            $toYear =$request->prokolpo_year+1;

            $formDate = $formYear.'-07-01';
            $toDate = $toYear.'-06-30';



            $prokolpoAreaListFd6 = DB::table('fd6_form_prokolpo_areas')
         ->join('fd6_forms', 'fd6_forms.id', '=', 'fd6_form_prokolpo_areas.fd6_form_id')
        ->select('fd6_form_prokolpo_areas.*','fd6_forms.*','fd6_forms.id as mainId')
        ->whereBetween('fd6_form_prokolpo_areas.created_at', [$formDate, $toDate])
         ->whereIn('fd6_form_prokolpo_areas.district_name',$request->distric_name)
         ->whereIn('fd6_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
         ->orderBy('fd6_forms.id','desc')
         ->get();

         if(count($prokolpoAreaListFd6) == 0){

            $fd6SecondStepArray = [0];

        }else{
            $fd6SecondStepArray = $request->distric_name;
        }
         $prokolpoAreaListFd7 = DB::table('fd7_form_prokolpo_areas')
         ->join('fd7_forms', 'fd7_forms.id', '=', 'fd7_form_prokolpo_areas.fd7_form_id')
         ->select('fd7_form_prokolpo_areas.*','fd7_forms.*','fd7_forms.id as mainId')
         ->whereBetween('fd7_form_prokolpo_areas.created_at', [$formDate, $toDate])
         ->whereIn('fd7_form_prokolpo_areas.district_name',$request->distric_name)
         ->whereIn('fd7_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
         ->orderBy('fd7_forms.id','desc')
         ->get();

         if(count($prokolpoAreaListFd7) == 0){

            $fd7SecondStepArray = [0];

        }else{
            $fd7SecondStepArray = $request->distric_name;
        }

         $prokolpoAreaListFc1 = DB::table('prokolpo_areas')
         ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
         ->select('prokolpo_areas.*','fc1_forms.*','fc1_forms.id as mainId')
         ->where('prokolpo_areas.type','fcOne')
         ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
         ->whereIn('prokolpo_areas.district_name',$request->distric_name)
         ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
         ->orderBy('fc1_forms.id','desc')
         ->get();

         if(count($prokolpoAreaListFc1) == 0){

            $fc1SecondStepArray = [0];

        }else{
            $fc1SecondStepArray = $request->distric_name;
        }

         $prokolpoAreaListFc2 = DB::table('prokolpo_areas')
         ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
         ->select('prokolpo_areas.*','fc2_forms.*','fc2_forms.id as mainId')
         ->where('prokolpo_areas.type','fcTwo')
         ->whereBetween('prokolpo_areas.created_at', [$formDate, $toDate])
         ->whereIn('prokolpo_areas.district_name',$request->distric_name)
         ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
         ->orderBy('fc2_forms.id','desc')
         ->get();

         if(count($prokolpoAreaListFc2) == 0){

            $fc2SecondStepArray = [0];

        }else{
            $fc2SecondStepArray = $request->distric_name;
        }


        }

        $mainDistrictArray  = array_merge($fd6SecondStepArray, $fd7SecondStepArray,$fc1SecondStepArray,$fc2SecondStepArray);
//dd($mainDistrictArray);
        return view('admin.prokolpoGraphicalReport.graphicReportFilter',compact(
            'mainDistrictArray',
            'distrcitName',
        'divisionList',
        'districtList',
        'cityCorporationList',
        'projectSubjectList',
        'prokolpoAreaListFd6',
        'prokolpoAreaListFd7',
        'prokolpoAreaListFc1',
        'prokolpoAreaListFc2',
        'fd6SecondStepArray',
        'fd7SecondStepArray',
        'fc1SecondStepArray',
        'fc2SecondStepArray',
        'prokolpoType',
        'prokolpoYear'
          ));
    }
}
