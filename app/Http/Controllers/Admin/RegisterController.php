<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;
use Illuminate\Support\Str;
use Mpdf\Mpdf;
use DateTime;
use Mail;
use DB;
use PDF;
use Carbon\Carbon;
use App\Models\NgoFDNineDak;
use App\Models\NgoFDNineOneDak;
use App\Models\NgoNameChangeDak;
use App\Models\NgoRenewDak;
use App\Models\NgoFdSixDak;
use App\Models\NgoFdSevenDak;
use App\Models\NgoRegistrationDak;
class RegisterController extends Controller
{
    public $user;


    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }







    public function newRegistrationList(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('register_list_view')) {
            //abort(403, 'Sorry !! You are Unauthorized to view !');
            return redirect()->route('error_404');
        }

        try{

        \LogActivity::addToLog('view new ngo registration list.');


        if(Auth::guard('admin')->user()->designation_list_id == 2 || Auth::guard('admin')->user()->designation_list_id == 1){


        $all_data_for_new_list = DB::table('ngo_statuses')
        ->where('status','Ongoing')->orWhere('status','Old Ngo Renew')->latest()->get();

        }else{

            $ngoStatusReg = NgoRegistrationDak::where('status',1)->where('receiver_admin_id',Auth::guard('admin')->user()->id)->latest()->get();


            $convert_name_title = $ngoStatusReg->implode("registration_status_id", " ");
            $separated_data_title = explode(" ", $convert_name_title);



            $all_data_for_new_list = DB::table('ngo_statuses')
            ->whereIn('id',$separated_data_title)
        ->where('status','Ongoing')->orWhere('status','Old Ngo Renew')->latest()->get();


        }


      return view('admin.registration_list.new_registration_list',compact('all_data_for_new_list'));
    } catch (\Exception $e) {
        return redirect()->route('error_404')->with('error','some thing went wrong ');
    }


    }


    public function revisionRegistrationList(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('register_list_view')) {
            //abort(403, 'Sorry !! You are Unauthorized to view !');
            return redirect()->route('error_404');
        }
        try{
        \LogActivity::addToLog('view revision ngo registration list.');


        if(Auth::guard('admin')->user()->designation_list_id == 2 || Auth::guard('admin')->user()->designation_list_id == 1){


            $all_data_for_new_list = DB::table('ngo_statuses')
            ->whereIn('status',['Rejected','Correct'])->latest()->get();

            }else{

                $ngoStatusReg = NgoRegistrationDak::where('status',1)->where('receiver_admin_id',Auth::guard('admin')->user()->id)->latest()->get();


                $convert_name_title = $ngoStatusReg->implode("registration_status_id", " ");
                $separated_data_title = explode(" ", $convert_name_title);



                $all_data_for_new_list = DB::table('ngo_statuses')
                ->whereIn('id',$separated_data_title)
            ->whereIn('status',['Rejected','Correct'])->latest()->get();


            }





        // $all_data_for_new_list = DB::table('ngo_statuses')
        // ->whereIn('status',['Rejected','Correct'])->latest()->get();


      return view('admin.registration_list.revision_registration_list',compact('all_data_for_new_list'));

    } catch (\Exception $e) {
        return redirect()->route('error_404')->with('error','some thing went wrong ');
    }


    }


    public function alreadyRegistrationList(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('register_list_view')) {
            //abort(403, 'Sorry !! You are Unauthorized to view !');
            return redirect()->route('error_404');
        }
        try{
        \LogActivity::addToLog('view already ngo registration list.');


        if(Auth::guard('admin')->user()->designation_list_id == 2 || Auth::guard('admin')->user()->designation_list_id == 1){


            $all_data_for_new_list = DB::table('ngo_statuses')
            ->where('status','Accepted')->latest()->get();

            }else{

                $ngoStatusReg = NgoRegistrationDak::where('status',1)->where('receiver_admin_id',Auth::guard('admin')->user()->id)->latest()->get();


                $convert_name_title = $ngoStatusReg->implode("registration_status_id", " ");
                $separated_data_title = explode(" ", $convert_name_title);



                $all_data_for_new_list = DB::table('ngo_statuses')
                ->whereIn('id',$separated_data_title)
                ->where('status','Accepted')->latest()->get();


            }





        $all_data_for_new_list = DB::table('ngo_statuses')->where('status','Accepted')->latest()->get();


      return view('admin.registration_list.already_registration_list',compact('all_data_for_new_list'));

    } catch (\Exception $e) {
        return redirect()->route('error_404')->with('error','some thing went wrong ');
    }

    }


    public function registrationView($id){



        \LogActivity::addToLog('view  ngo registration detail.');

        try {

            $r_status = DB::table('ngo_statuses')->where('fd_one_form_id',$id)->value('status');
            $name_change_status = DB::table('ngo_name_changes')->where('fd_one_form_id',$id)->value('status');
            $renew_status = DB::table('ngo_renews')->where('fd_one_form_id',$id)->value('status');


            $all_data_for_new_list_all = DB::table('ngo_statuses')->where('fd_one_form_id',$id)->first();
            $form_one_data = DB::table('fd_one_forms')->where('id',$id)->first();


            $ngoTypeData = DB::table('ngo_type_and_languages')
            ->where('user_id',$form_one_data->user_id)->first();


            $signDataNew = DB::table('form_eights')->where('fd_one_form_id',$id)->first();


            $form_eight_data = DB::table('form_eights')->where('fd_one_form_id',$id)->get();
            $form_member_data = DB::table('ngo_member_lists')->where('fd_one_form_id',$id)->get();


            $form_member_data_doc_renew = DB::table('ngo_renew_infos')->where('fd_one_form_id',$id)->get();


 $duration_list_all1 = DB::table('ngo_durations')->where('fd_one_form_id',$id)->value('ngo_duration_end_date');
            $duration_list_all = DB::table('ngo_durations')->where('fd_one_form_id',$id)->value('ngo_duration_start_date');

            $form_member_data_doc = DB::table('ngo_member_nid_photos')->where('fd_one_form_id',$id)->get();
            $form_ngo_data_doc = DB::table('ngo_other_docs')->where('fd_one_form_id',$id)->get();

            $users_info = DB::table('users')->where('id',$form_one_data->user_id)->first();

            $all_source_of_fund = DB::table('fd_one_source_of_funds')->where('fd_one_form_id',$form_one_data->id)->get();

            $all_partiw = DB::table('fd_one_member_lists')->where('fd_one_form_id',$form_one_data->id)->get();


            $get_all_data_adviser_bank = DB::table('fd_one_bank_accounts')->where('fd_one_form_id',$form_one_data->id)
            ->first();


            $get_all_data_other= DB::table('fd_one_other_pdf_lists')->where('fd_one_form_id',$form_one_data->id)
            ->get();

            $get_all_data_adviser = DB::table('fd_one_adviser_lists')->where('fd_one_form_id',$form_one_data->id)
    ->get();





        if($ngoTypeData->ngo_type == 'দেশিও'){
 return view('admin.registration_list.registration_view',compact('signDataNew','ngoTypeData','duration_list_all1','duration_list_all','renew_status','name_change_status','r_status','form_member_data_doc_renew','get_all_data_adviser','get_all_data_other','get_all_data_adviser_bank','all_partiw','all_source_of_fund','users_info','form_ngo_data_doc','form_member_data_doc','form_member_data','form_eight_data','all_data_for_new_list_all','form_one_data'));
    }else{
        return view('admin.registration_list.foreign.registration_view',compact('signDataNew','ngoTypeData','duration_list_all1','duration_list_all','renew_status','name_change_status','r_status','form_member_data_doc_renew','get_all_data_adviser','get_all_data_other','get_all_data_adviser_bank','all_partiw','all_source_of_fund','users_info','form_ngo_data_doc','form_member_data_doc','form_member_data','form_eight_data','all_data_for_new_list_all','form_one_data'));
    }


} catch (\Exception $e) {
    return redirect()->route('error_404')->with('error','some thing went wrong ');
}


    }


    public function numberToWord($num = '')
    {
        $num    = ( string ) ( ( int ) $num );

        if( ( int ) ( $num ) && ctype_digit( $num ) )
        {
            $words  = array( );

            $num    = str_replace( array( ',' , ' ' ) , '' , trim( $num ) );

            $list1  = array('','one','two','three','four','five','six','seven',
                'eight','nine','ten','eleven','twelve','thirteen','fourteen',
                'fifteen','sixteen','seventeen','eighteen','nineteen');

            $list2  = array('','ten','twenty','thirty','forty','fifty','sixty',
                'seventy','eighty','ninety','hundred');

            $list3  = array('','thousand','million','billion','trillion',
                'quadrillion','quintillion','sextillion','septillion',
                'octillion','nonillion','decillion','undecillion',
                'duodecillion','tredecillion','quattuordecillion',
                'quindecillion','sexdecillion','septendecillion',
                'octodecillion','novemdecillion','vigintillion');

            $num_length = strlen( $num );
            $levels = ( int ) ( ( $num_length + 2 ) / 3 );
            $max_length = $levels * 3;
            $num    = substr( '00'.$num , -$max_length );
            $num_levels = str_split( $num , 3 );

            foreach( $num_levels as $num_part )
            {
                $levels--;
                $hundreds   = ( int ) ( $num_part / 100 );
                $hundreds   = ( $hundreds ? ' ' . $list1[$hundreds] . ' Hundred' . ( $hundreds == 1 ? '' : 's' ) . ' ' : '' );
                $tens       = ( int ) ( $num_part % 100 );
                $singles    = '';

                if( $tens < 20 ) { $tens = ( $tens ? ' ' . $list1[$tens] . ' ' : '' ); } else { $tens = ( int ) ( $tens / 10 ); $tens = ' ' . $list2[$tens] . ' '; $singles = ( int ) ( $num_part % 10 ); $singles = ' ' . $list1[$singles] . ' '; } $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_part ) ) ? ' ' . $list3[$levels] . ' ' : '' ); } $commas = count( $words ); if( $commas > 1 )
            {
                $commas = $commas - 1;
            }

            $words  = implode( ', ' , $words );

            $words  = trim( str_replace( ' ,' , ',' , ucwords( $words ) )  , ', ' );
            if( $commas )
            {
                $words  = str_replace( ',' , ' and' , $words );
            }

            return $words;
        }
        else if( ! ( ( int ) $num ) )
        {
            return 'Zero';
        }
        return '';
    }





    public function printCertificateView(Request $request){
        try{

        \LogActivity::addToLog('print ngo certificate.');

        //dd(11);

           $user_id = $request->user_id;

           $form_one_data = DB::table('fd_one_forms')->where('user_id',$user_id)->first();
           $ngoTypeData = DB::table('ngo_type_and_languages')
           ->where('user_id',$form_one_data->user_id)->first();
           $duration_list_all = DB::table('ngo_durations')->where('fd_one_form_id',$form_one_data->id)->latest()->first();

           //dd($user_id);

           $newyear = date('y', strtotime($request->main_date));

           $newmonth = date('F', strtotime($request->main_date));


           $newdate = date('d', strtotime($request->main_date));

           $word = $this->numberToWord($newyear);
           $word1 = $this->numberToWord($newdate);
           //dd($word1);

           //dd($newdate);
$mainDate = $request->main_date;
           $file_Name_Custome = 'certificate';
           $pdf=PDF::loadView('admin.registration_list.print_certificate_view',['newyear'=>$newyear,'ngoTypeData'=>$ngoTypeData,
'newmonth'=>$newmonth,'newdate'=>$newdate,'word'=>$word,'word1'=>$word1,'mainDate'=>$mainDate,
'form_one_data'=>$form_one_data,'duration_list_all'=>$duration_list_all],[],['orientation' => 'L'],['format' => [279.4,215.9]]);
return $pdf->stream($file_Name_Custome.''.'.pdf');


} catch (\Exception $e) {
    return redirect()->route('error_404')->with('error','some thing went wrong ');
}
    }


    public function printCertificateViewDemo(Request $request){
//dd(11);
try{
\LogActivity::addToLog('view certificate demo.');


        $user_id = $request->user_id;

        $form_one_data = DB::table('fd_one_forms')->where('user_id',$user_id)->first();
        $ngoTypeData = DB::table('ngo_type_and_languages')
        ->where('user_id',$form_one_data->user_id)->first();
        $duration_list_all = DB::table('ngo_durations')->where('fd_one_form_id',$form_one_data->id)->latest()->first();

        //dd($user_id);

        $newyear = date('y', strtotime($request->main_date));

        $newmonth = date('F', strtotime($request->main_date));


        $newdate = date('d', strtotime($request->main_date));

        $word = $this->numberToWord($newyear);
        $word1 = $this->numberToWord($newdate);
        //dd($word1);

        //dd($newdate);
$mainDate = $request->main_date;
        $file_Name_Custome = 'certificate';
        $pdf=PDF::loadView('admin.registration_list.printCertificateViewDemo',['newyear'=>$newyear,'ngoTypeData'=>$ngoTypeData,
'newmonth'=>$newmonth,'newdate'=>$newdate,'word'=>$word,'word1'=>$word1,'mainDate'=>$mainDate,
'form_one_data'=>$form_one_data,'duration_list_all'=>$duration_list_all],[],['orientation' => 'L'],['format' => [279.4,215.9]]);
return $pdf->stream($file_Name_Custome.''.'.pdf');


} catch (\Exception $e) {
    return redirect()->route('error_404')->with('error','some thing went wrong ');
}
 }



 public function printCertificateViewDemoRenew(Request $request){
    //dd(11);
    try{
    \LogActivity::addToLog('view certificate demo.');


            $user_id = $request->user_id;

            $form_one_data = DB::table('fd_one_forms')->where('user_id',$user_id)->first();
            $ngoTypeData = DB::table('ngo_type_and_languages')
            ->where('user_id',$form_one_data->user_id)->first();
            $duration_list_all = DB::table('ngo_durations')->where('fd_one_form_id',$form_one_data->id)->latest()->first();
            $lastDate1 = date('Y-m-d', strtotime($ngoTypeData->last_renew_date ));
            $newdateR = date("Y-m-d",strtotime ( '-10 year' , strtotime ( $lastDate1 ) )) ;





            $newyear = date('y', strtotime($request->main_date));

            //dd($newyear);

            $newmonth = date('F', strtotime($request->main_date));


            $newdate = date('d', strtotime($request->main_date));

            $word = $this->numberToWord($newyear);
            $word1 = $this->numberToWord($newdate);
            //dd($word1);

            //dd($newdate);
    $mainDate = $request->main_date;
            $file_Name_Custome = 'certificate';
            $pdf=PDF::loadView('admin.renew_list.printCertificateViewDemoRenew',['newyear'=>$newyear,'ngoTypeData'=>$ngoTypeData,
    'newmonth'=>$newmonth,'newdate'=>$newdate,'word'=>$word,'word1'=>$word1,'mainDate'=>$mainDate,
    'form_one_data'=>$form_one_data,'duration_list_all'=>$duration_list_all],[],['orientation' => 'L'],['format' => [279.4,215.9]]);
    return $pdf->stream($file_Name_Custome.''.'.pdf');


} catch (\Exception $e) {
    return redirect()->route('error_404')->with('error','some thing went wrong ');
}
     }


     public function printCertificateViewRenew(Request $request){
        //dd(11);
        try{
        \LogActivity::addToLog('view certificate demo.');


                $user_id = $request->user_id;

                $form_one_data = DB::table('fd_one_forms')->where('user_id',$user_id)->first();
                $ngoTypeData = DB::table('ngo_type_and_languages')
                ->where('user_id',$form_one_data->user_id)->first();
                $duration_list_all = DB::table('ngo_durations')->where('fd_one_form_id',$form_one_data->id)->latest()->first();

                //dd($user_id);

                $newyear = date('y', strtotime($request->main_date));

                $newmonth = date('F', strtotime($request->main_date));


                $newdate = date('d', strtotime($request->main_date));

                $word = $this->numberToWord($newyear);
                $word1 = $this->numberToWord($newdate);
                //dd($word1);

                //dd($newdate);
        $mainDate = $request->main_date;
                $file_Name_Custome = 'certificate';
                $pdf=PDF::loadView('admin.renew_list.printCertificateViewRenew',['newyear'=>$newyear,'ngoTypeData'=>$ngoTypeData,
        'newmonth'=>$newmonth,'newdate'=>$newdate,'word'=>$word,'word1'=>$word1,'mainDate'=>$mainDate,
        'form_one_data'=>$form_one_data,'duration_list_all'=>$duration_list_all],[],['orientation' => 'L'],['format' => [279.4,215.9]]);
        return $pdf->stream($file_Name_Custome.''.'.pdf');


    } catch (\Exception $e) {
        return redirect()->route('error_404')->with('error','some thing went wrong ');
    }
         }


    public function updateStatusRegForm(Request $request){

//dd($request->all());
try{
    DB::beginTransaction();

if(empty($request->comment)){

    $comment ='0';

}else{
    $comment =  $request->comment;

}
        \LogActivity::addToLog('update registration status.');
      //dd($request->all());

        DB::table('ngo_statuses')->where('id',$request->id)
->update([
    'status' => $request->status,
    'comment' => $comment ,
]);

$get_user_id = DB::table('ngo_statuses')->where('id',$request->id)->value('fd_one_form_id');





//DB::table('DB::table('fd_one_forms')->')->where('user_id',$get_user_id)->first();


if($request->ngotype == 'old'){

    Mail::send('emails.oldRenew', ['comment' =>$comment,'id' => $request->status,'ngoId'=>$get_user_id], function($message) use($request){
        $message->to($request->email);
        $message->subject('NGOAB Registration Service || Old Ngo Approved Status');
    });


}else{




        if($request->status == 'Accepted'){

            $date = date('Y-m-d');
    $newDate = date('Y-m-d', strtotime($date. ' + 10 years'));

    DB::table('fd_one_forms')->where('id',$get_user_id)
    ->update([
        'registration_number' => $request->reg_no_get_from_admin
    ]);


    DB::table('ngo_durations')->insert(
        [
        'fd_one_form_id' =>$get_user_id,
        'ngo_status' =>$request->status,
        'ngo_duration_end_date' =>$newDate,
        'ngo_duration_start_date' =>date('Y-m-d'),
        'created_at' =>Carbon::now(),
        'updated_at' =>Carbon::now(),
    ]);



        // $data_save = new Duration();
        // $data_save->user_id = $get_user_id;
        // $data_save->status = $request->status;
        // $data_save->end_date = $newDate;
        // $data_save->start_date =date('Y-m-d');
        // $data_save->save();
        }



        Mail::send('emails.passwordResetEmail', ['comment' => $comment ,'id' => $request->status,'ngoId'=>$get_user_id], function($message) use($request){
            $message->to($request->email);
            $message->subject('NGOAB Registration Service || Ngo Approved Status');
        });


    }



    DB::commit();
        return redirect()->back()->with('success','Updated Successfully');

    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->route('error_404')->with('error','some thing went wrong ');
    }

    }


    public function formOnePdfMainForeign($id){


        $allformOneData = DB::table('fd_one_forms')->where('id',$id)->first();
        $getNgoTypeForPdf = DB::table('ngo_type_and_languages')->where('user_id',$allformOneData->user_id)->value('ngo_type');
        $get_all_data_adviser_bank = DB::table('fd_one_bank_accounts')->where('fd_one_form_id',$allformOneData->id)->first();

        $get_all_data_other= DB::table('fd_one_other_pdf_lists')->where('fd_one_form_id',$allformOneData->id)->get();

//dd($get_all_data_other);

        $get_all_data_adviser = DB::table('fd_one_adviser_lists')->where('fd_one_form_id',$allformOneData->id)->get();
        $formOneMemberList = DB::table('fd_one_member_lists')->where('fd_one_form_id',$allformOneData->id)->get();
        $get_all_source_of_fund_data = DB::table('fd_one_source_of_funds')->where('fd_one_form_id',$allformOneData->id)->get();


        $file_Name_Custome = '(এফডি-১ ফরম)';








    $data =view('admin.registration_list.foreign.fdFormOneInfoPdf',[
        'getNgoTypeForPdf'=>$getNgoTypeForPdf,

        'get_all_source_of_fund_data'=>$get_all_source_of_fund_data,
        'formOneMemberList'=>$formOneMemberList,
        'get_all_data_adviser'=>$get_all_data_adviser,
        'get_all_data_other'=>$get_all_data_other,
        'get_all_data_adviser_bank'=>$get_all_data_adviser_bank,
        'allformOneData'=>$allformOneData

    ])->render();


    $pdfFilePath =$file_Name_Custome.'.pdf';


                     $mpdf = new Mpdf([
                        //'default_font_size' => 14,
                        'default_font' => 'nikosh'
                    ]);

                    //$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);

                    $mpdf->WriteHTML($data);



                    $mpdf->Output($pdfFilePath, "I");
                    die();

    }


    public function formOnePdfMain($id){

        try{

        $allformOneData = DB::table('fd_one_forms')->where('id',$id)->first();
        $getNgoTypeForPdf = DB::table('ngo_type_and_languages')->where('user_id',$allformOneData->user_id)->value('ngo_type');
        $get_all_data_adviser_bank = DB::table('fd_one_bank_accounts')->where('fd_one_form_id',$allformOneData->id)->first();

        $get_all_data_other= DB::table('fd_one_other_pdf_lists')->where('fd_one_form_id',$allformOneData->id)->get();

//dd($get_all_data_other);

        $get_all_data_adviser = DB::table('fd_one_adviser_lists')->where('fd_one_form_id',$allformOneData->id)->get();
        $formOneMemberList = DB::table('fd_one_member_lists')->where('fd_one_form_id',$allformOneData->id)->get();
        $get_all_source_of_fund_data = DB::table('fd_one_source_of_funds')->where('fd_one_form_id',$allformOneData->id)->get();


        $file_Name_Custome = '(এফডি-১ ফরম)';








    $data =view('admin.registration_list.fdFormOneInfoPdf',[
        'getNgoTypeForPdf'=>$getNgoTypeForPdf,

        'get_all_source_of_fund_data'=>$get_all_source_of_fund_data,
        'formOneMemberList'=>$formOneMemberList,
        'get_all_data_adviser'=>$get_all_data_adviser,
        'get_all_data_other'=>$get_all_data_other,
        'get_all_data_adviser_bank'=>$get_all_data_adviser_bank,
        'allformOneData'=>$allformOneData

    ])->render();


    $pdfFilePath =$file_Name_Custome.'.pdf';


                     $mpdf = new Mpdf([
                        //'default_font_size' => 14,
                        'default_font' => 'nikosh'
                    ]);

                    //$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);

                    $mpdf->WriteHTML($data);



                    $mpdf->Output($pdfFilePath, "I");
                    die();



                } catch (\Exception $e) {
                    return redirect()->route('error_404')->with('error','some thing went wrong ');
                }


    }


    public function formOnePdf($main_id,$id){

        try{
        \LogActivity::addToLog('registration pdf download.');


        if($id == 'plan'){

            $form_one_data = DB::table('fd_one_forms')->where('id',$main_id)->value('plan_of_operation');

        }elseif($id == 'invoice'){

          //dd($id);

            $form_one_data1 = DB::table('fd_one_forms')->where('id',$main_id)->first();

        $form_one_data = $form_one_data1->attach_the__supporting_paper;

        }elseif($id == 'treasury_bill'){

            $form_one_data = DB::table('fd_one_forms')->where('id',$main_id)->value('board_of_revenue_on_fees');

        }elseif($id == 'final_pdf'){
            $form_one_data = DB::table('fd_one_forms')->where('id',$main_id)->value('verified_fd_one_form');
        }elseif($id == 'final_pdf_eight'){
            $form_one_data = DB::table('fd_one_forms')->where('id',$main_id)->value('verified_fd_eight_form_old');
        }

        return view('admin.registration_list.form_one_pdf',compact('form_one_data'));

    } catch (\Exception $e) {
        return redirect()->route('error_404')->with('error','some thing went wrong ');
    }

    }


    public function formEightPdf($main_id){
        try{
        \LogActivity::addToLog('registration pdf download.');

        $form_one_data = DB::table('form_eights')->where('fd_one_form_id',$main_id)->value('verified_form_eight');

        return view('admin.registration_list.form_eight_pdf',compact('form_one_data'));

    } catch (\Exception $e) {
        return redirect()->route('error_404')->with('error','some thing went wrong ');
    }

    }

    public function sourceOfFund($id){
        try{
        \LogActivity::addToLog('registration pdf download.');

        $form_one_data = DB::table('fd_one_source_of_funds')->where('id',$id)->value('letter_file');
         return view('admin.registration_list.source_of_fund',compact('form_one_data'));

        } catch (\Exception $e) {
            return redirect()->route('error_404')->with('error','some thing went wrong ');
        }

        }

    public function otherPdfView($id){
        try{
        \LogActivity::addToLog('registration pdf download.');

        $form_one_data = DB::table('fd_one_other_pdf_lists')->where('id',$id)->value('information_pdf');
         return view('admin.registration_list.other_pdf_view',compact('form_one_data'));

        } catch (\Exception $e) {
            return redirect()->route('error_404')->with('error','some thing went wrong ');
        }

        }


    public function ngoMemberDocPdfView($id){
        try{
        \LogActivity::addToLog('registration pdf download.');

        $form_one_data = DB::table('ngo_member_nid_photos')->where('id',$id)->value('member_nid_copy');

         return view('admin.registration_list.ngo_member_doc__pdf_view',compact('form_one_data'));


        } catch (\Exception $e) {
            return redirect()->route('error_404')->with('error','some thing went wrong ');
        }
    }


    public function ngoDocPdfView($id){
        try{
        \LogActivity::addToLog('registration pdf download.');

        $form_one_data = DB::table('ngo_other_docs')->where('id',$id)->value('pdf_file_list');
         return view('admin.registration_list.ngo_doc__pdf_view',compact('form_one_data'));

        } catch (\Exception $e) {
            return redirect()->route('error_404')->with('error','some thing went wrong ');
        }


        }


    public function renewPdfList($main_id,$id){
        try{
        \LogActivity::addToLog('registration pdf download.');

        if($id = 'f'){

            $form_one_data = DB::table('ngo_renew_infos')->where('user_id',$main_id)->value('foregin_pdf');

        }elseif($id = 'y'){

            $form_one_data = DB::table('ngo_renew_infos')->where('user_id',$main_id)->value('yearly_budget');

        }elseif($id = 'c'){

            $form_one_data = DB::table('ngo_renew_infos')->where('user_id',$main_id)->value('copy_of_chalan');

        }elseif($id = 'd'){

            $form_one_data = DB::table('ngo_renew_infos')->where('user_id',$main_id)->value('due_vat_pdf');

        }elseif($id = 'ch'){
            $form_one_data = DB::table('ngo_renew_infos')->where('user_id',$main_id)->value('change_ac_number');
        }

        return view('admin.registration_list.renew_pdf_list',compact('form_one_data'));

    } catch (\Exception $e) {
        return redirect()->route('error_404')->with('error','some thing went wrong ');
    }

    }
}
