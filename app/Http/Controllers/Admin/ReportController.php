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
