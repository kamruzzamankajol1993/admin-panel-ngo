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

        if(empty($request->prokolpo_type) || empty($request->distric_name)){

            $prokolpoAreaListFd6 = DB::table('fd6_form_prokolpo_areas')
            ->join('fd6_forms', 'fd6_forms.id', '=', 'fd6_form_prokolpo_areas.fd6_form_id')
            ->select('fd6_form_prokolpo_areas.*','fd6_forms.*','fd6_forms.id as mainId')
            ->where('fd6_form_prokolpo_areas.created_at',$request->prokolpo_year)
          
            ->orderBy('fd6_forms.id','desc')

            ->get();

            $prokolpoAreaListFd7 = DB::table('fd7_form_prokolpo_areas')
            ->join('fd7_forms', 'fd7_forms.id', '=', 'fd7_form_prokolpo_areas.fd7_form_id')
            ->select('fd7_form_prokolpo_areas.*','fd7_forms.*','fd7_forms.id as mainId')
            ->where('fd7_form_prokolpo_areas.created_at',$request->prokolpo_year)

            ->orderBy('fd7_forms.id','desc')
            ->get();


            $prokolpoAreaListFc1 = DB::table('prokolpo_areas')->where('type','fcOne')
            ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
            ->select('prokolpo_areas.*','fc1_forms.*','fc1_forms.id as mainId')
            ->where('prokolpo_areas.created_at',$request->prokolpo_year)

            ->orderBy('fc1_forms.id','desc')
            ->get();


            $prokolpoAreaListFc2 = DB::table('prokolpo_areas')->where('type','fcTwo')
            ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
            ->select('prokolpo_areas.*','fc2_forms.*','fc2_forms.id as mainId')
            ->where('prokolpo_areas.created_at',$request->prokolpo_year)

            ->orderBy('fc2_forms.id','desc')
            ->get();

        }elseif(empty($request->prokolpo_type) || empty($request->prokolpo_year)){

            $prokolpoAreaListFd6 = DB::table('fd6_form_prokolpo_areas')
            ->join('fd6_forms', 'fd6_forms.id', '=', 'fd6_form_prokolpo_areas.fd6_form_id')
            ->select('fd6_form_prokolpo_areas.*','fd6_forms.*','fd6_forms.id as mainId')

            ->whereIn('fd6_form_prokolpo_areas.distric_name',$request->distric_name)
            ->orderBy('fd6_forms.id','desc')

            ->get();

            $prokolpoAreaListFd7 = DB::table('fd7_form_prokolpo_areas')
            ->join('fd7_forms', 'fd7_forms.id', '=', 'fd7_form_prokolpo_areas.fd7_form_id')
            ->select('fd7_form_prokolpo_areas.*','fd7_forms.*','fd7_forms.id as mainId')

            ->whereIn('fd7_form_prokolpo_areas.distric_name',$request->distric_name)
            ->orderBy('fd7_forms.id','desc')
            ->get();


            $prokolpoAreaListFc1 = DB::table('prokolpo_areas')->where('type','fcOne')
            ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
            ->select('prokolpo_areas.*','fc1_forms.*','fc1_forms.id as mainId')

            ->whereIn('prokolpo_areas.distric_name',$request->distric_name)
            ->orderBy('fc1_forms.id','desc')
            ->get();


            $prokolpoAreaListFc2 = DB::table('prokolpo_areas')->where('type','fcTwo')
            ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
            ->select('prokolpo_areas.*','fc2_forms.*','fc2_forms.id as mainId')

            ->whereIn('prokolpo_areas.distric_name',$request->distric_name)
            ->orderBy('fc2_forms.id','desc')
            ->get();

        }elseif(empty($request->distric_name) || empty($request->prokolpo_year)){

            $prokolpoAreaListFd6 = DB::table('fd6_form_prokolpo_areas')
            ->join('fd6_forms', 'fd6_forms.id', '=', 'fd6_form_prokolpo_areas.fd6_form_id')
            ->select('fd6_form_prokolpo_areas.*','fd6_forms.*','fd6_forms.id as mainId')

            ->whereIn('fd6_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
            ->orderBy('fd6_forms.id','desc')

            ->get();

            $prokolpoAreaListFd7 = DB::table('fd7_form_prokolpo_areas')
            ->join('fd7_forms', 'fd7_forms.id', '=', 'fd7_form_prokolpo_areas.fd7_form_id')
            ->select('fd7_form_prokolpo_areas.*','fd7_forms.*','fd7_forms.id as mainId')

            ->whereIn('fd7_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
            ->orderBy('fd7_forms.id','desc')
            ->get();


            $prokolpoAreaListFc1 = DB::table('prokolpo_areas')->where('type','fcOne')
            ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
            ->select('prokolpo_areas.*','fc1_forms.*','fc1_forms.id as mainId')

            ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
            ->orderBy('fc1_forms.id','desc')
            ->get();


            $prokolpoAreaListFc2 = DB::table('prokolpo_areas')->where('type','fcTwo')
            ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
            ->select('prokolpo_areas.*','fc2_forms.*','fc2_forms.id as mainId')

            ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
            ->orderBy('fc2_forms.id','desc')
            ->get();

        }elseif(empty($request->prokolpo_type)){

            $prokolpoAreaListFd6 = DB::table('fd6_form_prokolpo_areas')
         ->join('fd6_forms', 'fd6_forms.id', '=', 'fd6_form_prokolpo_areas.fd6_form_id')
         ->select('fd6_form_prokolpo_areas.*','fd6_forms.*','fd6_forms.id as mainId')
         ->where('fd6_form_prokolpo_areas.created_at',$request->prokolpo_year)
         ->whereIn('fd6_form_prokolpo_areas.distric_name',$request->distric_name)
         ->orderBy('fd6_forms.id','desc')

         ->get();

         $prokolpoAreaListFd7 = DB::table('fd7_form_prokolpo_areas')
         ->join('fd7_forms', 'fd7_forms.id', '=', 'fd7_form_prokolpo_areas.fd7_form_id')
         ->select('fd7_form_prokolpo_areas.*','fd7_forms.*','fd7_forms.id as mainId')
         ->where('fd7_form_prokolpo_areas.created_at',$request->prokolpo_year)
         ->whereIn('fd7_form_prokolpo_areas.distric_name',$request->distric_name)
         ->orderBy('fd7_forms.id','desc')
         ->get();


         $prokolpoAreaListFc1 = DB::table('prokolpo_areas')->where('type','fcOne')
         ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
         ->select('prokolpo_areas.*','fc1_forms.*','fc1_forms.id as mainId')
         ->where('prokolpo_areas.created_at',$request->prokolpo_year)
         ->whereIn('prokolpo_areas.distric_name',$request->distric_name)
         ->orderBy('fc1_forms.id','desc')
         ->get();


         $prokolpoAreaListFc2 = DB::table('prokolpo_areas')->where('type','fcTwo')
         ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
         ->select('prokolpo_areas.*','fc2_forms.*','fc2_forms.id as mainId')
         ->where('prokolpo_areas.created_at',$request->prokolpo_year)
         ->whereIn('prokolpo_areas.distric_name',$request->distric_name)
         ->orderBy('fc2_forms.id','desc')
         ->get();

        }elseif(empty($request->distric_name)){

            $prokolpoAreaListFd6 = DB::table('fd6_form_prokolpo_areas')
         ->join('fd6_forms', 'fd6_forms.id', '=', 'fd6_form_prokolpo_areas.fd6_form_id')
         ->select('fd6_form_prokolpo_areas.*','fd6_forms.*','fd6_forms.id as mainId')
         ->where('fd6_form_prokolpo_areas.created_at',$request->prokolpo_year)
         ->whereIn('fd6_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
         ->orderBy('fd6_forms.id','desc')

         ->get();

         $prokolpoAreaListFd7 = DB::table('fd7_form_prokolpo_areas')
         ->join('fd7_forms', 'fd7_forms.id', '=', 'fd7_form_prokolpo_areas.fd7_form_id')
         ->select('fd7_form_prokolpo_areas.*','fd7_forms.*','fd7_forms.id as mainId')
         ->where('fd7_form_prokolpo_areas.created_at',$request->prokolpo_year)
         ->whereIn('fd7_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
         ->orderBy('fd7_forms.id','desc')
         ->get();


         $prokolpoAreaListFc1 = DB::table('prokolpo_areas')->where('type','fcOne')
         ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
         ->select('prokolpo_areas.*','fc1_forms.*','fc1_forms.id as mainId')
         ->where('prokolpo_areas.created_at',$request->prokolpo_year)
         ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
         ->orderBy('fc1_forms.id','desc')
         ->get();


         $prokolpoAreaListFc2 = DB::table('prokolpo_areas')->where('type','fcTwo')
         ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
         ->select('prokolpo_areas.*','fc2_forms.*','fc2_forms.id as mainId')
         ->where('prokolpo_areas.created_at',$request->prokolpo_year)
         ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
         ->orderBy('fc2_forms.id','desc')
         ->get();

        }elseif(empty($request->prokolpo_year)){

            $prokolpoAreaListFd6 = DB::table('fd6_form_prokolpo_areas')
         ->join('fd6_forms', 'fd6_forms.id', '=', 'fd6_form_prokolpo_areas.fd6_form_id')
        ->select('fd6_form_prokolpo_areas.*','fd6_forms.*','fd6_forms.id as mainId')
         ->whereIn('fd6_form_prokolpo_areas.district_name',$request->distric_name)
         ->whereIn('fd6_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
         ->orderBy('fd6_forms.id','desc')

         ->get();

         $prokolpoAreaListFd7 = DB::table('fd7_form_prokolpo_areas')
         ->join('fd7_forms', 'fd7_forms.id', '=', 'fd7_form_prokolpo_areas.fd7_form_id')
         ->select('fd7_form_prokolpo_areas.*','fd7_forms.*','fd7_forms.id as mainId')
         ->whereIn('fd7_form_prokolpo_areas.district_name',$request->distric_name)
         ->whereIn('fd7_form_prokolpo_areas.prokolpo_type',$request->prokolpo_type)
         ->orderBy('fd7_forms.id','desc')
         ->get();


         $prokolpoAreaListFc1 = DB::table('prokolpo_areas')->where('type','fcOne')
         ->join('fc1_forms', 'fc1_forms.id', '=', 'prokolpo_areas.formId')
         ->select('prokolpo_areas.*','fc1_forms.*','fc1_forms.id as mainId')
         ->whereIn('prokolpo_areas.district_name',$request->distric_name)
         ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
         ->orderBy('fc1_forms.id','desc')
         ->get();


         $prokolpoAreaListFc2 = DB::table('prokolpo_areas')->where('type','fcTwo')
         ->join('fc2_forms', 'fc2_forms.id', '=', 'prokolpo_areas.formId')
         ->select('prokolpo_areas.*','fc2_forms.*','fc2_forms.id as mainId')
         ->whereIn('prokolpo_areas.district_name',$request->distric_name)
         ->whereIn('prokolpo_areas.prokolpo_type',$request->prokolpo_type)
         ->orderBy('fc2_forms.id','desc')
         ->get();

        }
    }
}
