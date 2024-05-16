<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Admin;
use App\Models\Task;
use DB;
use Carbon\Carbon;
use App\Models\SystemInformation;
use Hash;
use Illuminate\Support\Str;
use Mail;
use PDF;
use Response;
use App\Models\Branch;
use App\Models\ForwardingLetterOnulipi;
use App\Models\DakDetail;
use App\Models\NgoFDNineDak;
use App\Models\NgoFDNineOneDak;
use App\Models\NgoNameChangeDak;
use App\Models\NgoRenewDak;
use App\Models\NgoFdSixDak;
use App\Models\NgoFdSevenDak;
use App\Models\FcOneDak;
use App\Models\FcTwoDak;
use App\Models\NgoRegistrationDak;
use App\Models\DesignationList;
use App\Models\DesignationStep;
use App\Models\AdminDesignationHistory;
use App\Models\FdThreeDak;
use App\Models\FdFiveDak;
use App\Models\NothiList;
use Mpdf\Mpdf;
use App\Models\NothiDetail;
class DashBoardController extends Controller
{

    public $user;


    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }

    public function index(){

        if (is_null($this->user) || !$this->user->can('dashboard.view')) {
            //abort(403, 'Sorry !! You are Unauthorized to View !');
            return redirect()->route('error_404');
        }

        \LogActivity::addToLog('view dashboard');
        $users = Admin::where('id','!=',1)->orderBy('id','asc')->get();
        $adminTaskList = DB::table('assaign_tasks')
            ->where('admin_id',Auth::guard('admin')->user()->id)
            ->latest()
            ->get();

            $convert_name_title = $adminTaskList->implode("task_id", " ");
            $separated_data_title = explode(" ", $convert_name_title);

            $allTaskList = Task::whereIn('id',$separated_data_title)
            ->latest()->get();

        $senderNothiList = NothiDetail::where('receiver',Auth::guard('admin')->user()->id)
        ->whereNull('sent_status')
        ->whereNull('list_status')
        ->limit(5)
        ->where('dakType','renew')->latest()->get();

        $senderNothiListRegistration = NothiDetail::where('receiver',Auth::guard('admin')->user()->id)
        ->whereNull('sent_status')
        ->whereNull('list_status')
        ->limit(5)
        ->where('dakType','registration')->latest()->get();


        $senderNothiListfdNine = NothiDetail::where('receiver',Auth::guard('admin')->user()->id)
        ->whereNull('sent_status')
        ->whereNull('list_status')
        ->limit(5)
        ->where('dakType','fdNine')->latest()->get();


         $senderNothiListnameChange = NothiDetail::where('receiver',Auth::guard('admin')->user()->id)
         ->whereNull('sent_status')
         ->whereNull('list_status')
         ->limit(5)
        ->where('dakType','nameChange')->latest()->get();


         $senderNothiListfdNineOne = NothiDetail::where('receiver',Auth::guard('admin')->user()->id)
         ->whereNull('sent_status')
         ->whereNull('list_status')
         ->limit(5)
        ->where('dakType','fdNineOne')->latest()->get();




         $senderNothiListfdSix= NothiDetail::where('receiver',Auth::guard('admin')->user()->id)
         ->whereNull('sent_status')
         ->whereNull('list_status')
         ->limit(5)
        ->where('dakType','fdSix')->latest()->get();

         $senderNothiListfdSeven = NothiDetail::where('receiver',Auth::guard('admin')->user()->id)
         ->whereNull('sent_status')
         ->whereNull('list_status')
         ->limit(5)
        ->where('dakType','fdSeven')->latest()->get();


         $senderNothiListfcOne = NothiDetail::where('receiver',Auth::guard('admin')->user()->id)
         ->whereNull('sent_status')
         ->whereNull('list_status')
         ->limit(5)
        ->where('dakType','fcOne')->latest()->get();


         $senderNothiListfctwo = NothiDetail::where('receiver',Auth::guard('admin')->user()->id)
         ->whereNull('sent_status')
         ->whereNull('list_status')
         ->limit(5)
        ->where('dakType','fcTwo')->latest()->get();


         $senderNothiListfdThree = NothiDetail::where('receiver',Auth::guard('admin')->user()->id)
         ->whereNull('sent_status')
         ->whereNull('list_status')
         ->limit(5)
        ->where('dakType','fdThree')->latest()->get();


        $senderNothiListfdFive = NothiDetail::where('receiver',Auth::guard('admin')->user()->id)
        ->whereNull('sent_status')
        ->whereNull('list_status')
        ->limit(5)
       ->where('dakType','fdFive')->latest()->get();


         $senderNothiListduplicate = NothiDetail::where('receiver',Auth::guard('admin')->user()->id)
         ->whereNull('sent_status')
         ->whereNull('list_status')
         ->limit(5)
        ->where('dakType','duplicate')->latest()->get();


         $senderNothiListconstitution = NothiDetail::where('receiver',Auth::guard('admin')->user()->id)
         ->whereNull('sent_status')
         ->whereNull('list_status')
         ->limit(5)
        ->where('dakType','constitution')->latest()->get();


         $senderNothiListcommittee = NothiDetail::where('receiver',Auth::guard('admin')->user()->id)
         ->whereNull('sent_status')
         ->whereNull('list_status')
         ->limit(5)
        ->where('dakType','committee')->latest()->get();



        $count_admin = Admin::where('id','!=',1)->count();

        $totalRegisteredNgo = DB::table('ngo_statuses')->count();
        $totalRejectedNgo = DB::table('fd9_forms')->count();



        $totalRenewNgoRequest = DB::table('ngo_renews')->count();
        $totalRejectedRenewNgoRequest = DB::table('ngo_renews')->where('status','Rejected')->count();

        $totalNameChangeNgoRequest = DB::table('ngo_name_changes')->count();
        $totalRejectedNameChangeNgoRequest = DB::table('fd9_one_forms')->count();

        if(Auth::guard('admin')->user()->designation_list_id == 2 || Auth::guard('admin')->user()->designation_list_id == 1){


            // $adminTaskList = DB::table('assaign_tasks')
            // ->latest()
            // ->get();

            // $convert_name_title = $adminTaskList->implode("task_id", " ");
            // $separated_data_title = explode(" ", $convert_name_title);

            // $allTaskList = Task::whereIn('id',$separated_data_title)
            // ->latest()->get();

            $all_data_for_new_list = DB::table('ngo_statuses')->whereIn('status',['Ongoing','Old Ngo Renew'])->latest() ->limit(5)->get();
            $all_data_for_renew_list = DB::table('ngo_renews')->where('status','Ongoing')->latest() ->limit(5)->get();
            $all_data_for_name_changes_list = DB::table('ngo_name_changes')->where('status','Ongoing')->latest() ->limit(5)->get();


            $dataFdNineOne = DB::table('fd9_one_forms')
            ->join('n_visas', 'n_visas.fd9_one_form_id', '=', 'fd9_one_forms.id')
            ->join('fd_one_forms', 'fd_one_forms.id', '=', 'fd9_one_forms.fd_one_form_id')
            ->select('fd_one_forms.*','fd9_one_forms.*','n_visas.*','n_visas.id as nVisaId')
            ->whereNull('fd9_one_forms.status')
            ->orderBY('fd9_one_forms.id','desc')
            ->limit(5)
            ->get();


            //dd($dataFdNineOne);

            $dataFdNine = DB::table('fd9_forms')->where('status','Ongoing')->latest()->limit(5)->get();

            $dataFromFd6Form = DB::table('fd6_forms')
            ->join('fd_one_forms', 'fd_one_forms.id', '=', 'fd6_forms.fd_one_form_id')
            ->select('fd_one_forms.*','fd6_forms.*','fd6_forms.id as mainId')
           ->orderBy('fd6_forms.id','desc')
           ->limit(5)
           ->get();


           $dataFromFd7Form = DB::table('fd7_forms')
           ->join('fd_one_forms', 'fd_one_forms.id', '=', 'fd7_forms.fd_one_form_id')
           ->select('fd_one_forms.*','fd7_forms.*','fd7_forms.id as mainId')
           ->orderBy('fd7_forms.id','desc')
           ->limit(5)
           ->get();


           $dataFromFc1Form = DB::table('fc1_forms')
           ->join('fd_one_forms', 'fd_one_forms.id', '=', 'fc1_forms.fd_one_form_id')
           ->select('fd_one_forms.*','fc1_forms.*','fc1_forms.id as mainId')
           ->orderBy('fc1_forms.id','desc')
           ->limit(5)
           ->get();


           $dataFromFc2Form = DB::table('fc2_forms')
           ->join('fd_one_forms', 'fd_one_forms.id', '=', 'fc2_forms.fd_one_form_id')
           ->select('fd_one_forms.*','fc2_forms.*','fc2_forms.id as mainId')
           ->orderBy('fc2_forms.id','desc')
           ->limit(5)
           ->get();


           $dataFromFd3Form = DB::table('fd3_forms')
           ->join('fd_one_forms', 'fd_one_forms.id', '=', 'fd3_forms.fd_one_form_id')
           ->select('fd_one_forms.*','fd3_forms.*','fd3_forms.id as mainId')
           ->orderBy('fd3_forms.id','desc')
           ->limit(5)
           ->get();


           $ngoStatusConstitution = DB::table('document_for_amendment_or_approval_of_constitutions')->where('status','Ongoing')->latest()->limit(5)->get();
           $ngoStatusDuplicateCertificate = DB::table('document_for_duplicate_certificates')->where('status','Ongoing')->latest()->limit(5) ->get();

           $ngoStatusExecutiveCommittee = DB::table('document_for_executive_committee_approvals')->where('status','Ongoing')->latest()->limit(5) ->get();

           $ngoStatusFdFive = DB::table('fd_five_forms')->where('status','Ongoing')->latest()->limit(5)->get();
//dd($ngoStatusFdFive);
            return view('admin.dashboard.dashboard',compact(
                'users',
                'allTaskList',
                'ngoStatusFdFive',
                'senderNothiListfdFive',
                'ngoStatusConstitution',
                'ngoStatusDuplicateCertificate',
                'ngoStatusExecutiveCommittee',
                'senderNothiListfdNine',
                'senderNothiListnameChange',
                'senderNothiListfdNineOne',
                'senderNothiListfdSix',

                'senderNothiListfdSeven',

                'senderNothiListfcOne',
                'senderNothiListfctwo',
                'senderNothiListfdThree',
                'senderNothiListduplicate',
                'senderNothiListconstitution',
                'senderNothiListcommittee',
                'senderNothiListRegistration',
                'senderNothiList',
                'dataFromFd3Form',
                'dataFromFc2Form',
                'dataFromFc1Form',
                'dataFromFd7Form',
                'dataFromFd6Form',
                'dataFdNineOne',
                'dataFdNine',
                'all_data_for_name_changes_list',
                'all_data_for_renew_list',
                'all_data_for_new_list',
                'totalRegisteredNgo',
                'totalRejectedNgo',
                'totalRenewNgoRequest',
                'totalRejectedRenewNgoRequest',
                'totalNameChangeNgoRequest',
                'totalRejectedNameChangeNgoRequest',
                'adminTaskList',
                'count_admin'));

        }else{






            $nothiList = NothiList::latest()->get();

            $ngoStatusRenew = NgoRenewDak::where('status',1)->whereNull('sent_status')->where('receiver_admin_id',Auth::guard('admin')->user()->id)->latest() ->limit(5)->get();
            $ngoStatusNameChange = NgoNameChangeDak::where('status',1)->whereNull('sent_status')->where('receiver_admin_id',Auth::guard('admin')->user()->id)->latest() ->limit(5)->get();
            $ngoStatusFDNineDak = NgoFDNineDak::where('status',1)->whereNull('sent_status')->where('receiver_admin_id',Auth::guard('admin')->user()->id)->latest() ->limit(5)->get();
            $ngoStatusFdSixDak = NgoFdSixDak::where('status',1)->whereNull('sent_status')->where('receiver_admin_id',Auth::guard('admin')->user()->id)->latest() ->limit(5)->get();
            $ngoStatusFdSevenDak = NgoFdSevenDak::where('status',1)->whereNull('sent_status')->where('receiver_admin_id',Auth::guard('admin')->user()->id)->latest() ->limit(5)->get();
            $ngoStatusFcOneDak = FcOneDak::where('status',1)->whereNull('sent_status')->where('receiver_admin_id',Auth::guard('admin')->user()->id)->latest() ->limit(5)->get();
            $ngoStatusFcTwoDak = FcTwoDak::where('status',1)->whereNull('sent_status')->where('receiver_admin_id',Auth::guard('admin')->user()->id)->latest() ->limit(5)->get();
            $ngoStatusFdThreeDak = FdThreeDak::where('status',1)->whereNull('sent_status')->where('receiver_admin_id',Auth::guard('admin')->user()->id)->latest() ->limit(5)->get();
            $ngoStatusFDNineOneDak = NgoFDNineOneDak::where('status',1)->whereNull('sent_status')->where('receiver_admin_id',Auth::guard('admin')->user()->id)->latest() ->limit(5)->get();
            $ngoStatusReg = NgoRegistrationDak::where('status',1)->whereNull('sent_status')->where('receiver_admin_id',Auth::guard('admin')->user()->id)->latest() ->limit(5)->get();

            $ngoStatusDuplicateCertificate = DB::table('duplicate_certificate_daks')
            ->where('status',1)->whereNull('sent_status')->where('receiver_admin_id',Auth::guard('admin')->user()->id)->latest() ->limit(5)->get();


            $ngoStatusConstitution = DB::table('constitution_daks')->where('status',1)->whereNull('sent_status')->where('receiver_admin_id',Auth::guard('admin')->user()->id)->latest() ->limit(5)->get();

            $ngoStatusExecutiveCommittee = DB::table('executive_committee_daks')->where('status',1)->whereNull('sent_status')->where('receiver_admin_id',Auth::guard('admin')->user()->id)->latest() ->limit(5)->get();


            $ngoStatusFdFive = DB::table('fd_five_daks')->where('status',1)->whereNull('sent_status')->where('receiver_admin_id',Auth::guard('admin')->user()->id)->latest() ->limit(5)->get();


            $all_data_for_new_list = DB::table('ngo_statuses')->whereIn('status',['Ongoing','Old Ngo Renew'])->latest() ->limit(5)->get();


            return view('admin.dashboard.dashboardOne',compact(
                'users',
                'allTaskList',
                'adminTaskList',
                'ngoStatusFdFive',
                'ngoStatusConstitution',
                'ngoStatusDuplicateCertificate',
                'ngoStatusExecutiveCommittee',
                'senderNothiListfdNine',
                'senderNothiListnameChange',
                'senderNothiListfdNineOne',
                'senderNothiListfdSix',

                'senderNothiListfdSeven',

                'senderNothiListfcOne',
                'senderNothiListfctwo',
                'senderNothiListfdThree',
                'senderNothiListduplicate',
                'senderNothiListconstitution',
                'senderNothiListcommittee',
            'senderNothiListRegistration',
            'senderNothiList',
            'nothiList',
            'ngoStatusFdThreeDak',
            'ngoStatusFcTwoDak',
            'ngoStatusFcOneDak',
            'ngoStatusFdSevenDak',
            'ngoStatusFdSixDak',
            'ngoStatusFDNineOneDak',
            'ngoStatusFDNineDak',
            'ngoStatusNameChange',
            'ngoStatusRenew',
            'ngoStatusReg',
            'totalRegisteredNgo',
            'totalRejectedNgo',
            'totalRenewNgoRequest',
            'totalRejectedRenewNgoRequest',
            'totalNameChangeNgoRequest',
            'totalRejectedNameChangeNgoRequest',
            'count_admin'));


        }

    }
}
