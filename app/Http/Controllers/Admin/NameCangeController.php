<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
Use DB;
use PDF;
use Mail;
use Mpdf\Mpdf;
use Carbon\Carbon;
use App\Models\NgoFDNineDak;
use App\Models\NgoFDNineOneDak;
use App\Models\NgoNameChangeDak;
use App\Models\NgoRenewDak;
use App\Models\NgoFdSixDak;
use App\Models\NgoFdSevenDak;
use App\Models\NgoRegistrationDak;
class NameCangeController extends Controller
{
    public $user;


    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }



    public function newNameChangeList(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('name_change_view')) {
           // abort(403, 'Sorry !! You are Unauthorized to view !');
           return redirect()->route('error_404');
        }

        try{

        \LogActivity::addToLog('new name change list ');


        if(Auth::guard('admin')->user()->designation_list_id == 2 || Auth::guard('admin')->user()->designation_list_id == 1){


        $all_data_for_new_list = DB::table('ngo_name_changes')->where('status','Ongoing')->latest()->get();

        }else{


            $ngoStatusNameChange = NgoNameChangeDak::where('status',1)
            ->where('receiver_admin_id',Auth::guard('admin')->user()->id)->latest()->get();

            $convert_name_title = $ngoStatusNameChange->implode("name_change_status_id", " ");
            $separated_data_title = explode(" ", $convert_name_title);

            $all_data_for_new_list = DB::table('ngo_name_changes')
            ->whereIn('id',$separated_data_title)
            ->where('status','Ongoing')->latest()->get();

        }





      return view('admin.name_change_list.new_name_change_list',compact('all_data_for_new_list'));

    } catch (\Exception $e) {
        return redirect()->route('error_404')->with('error','some thing went wrong ');
    }

    }


    public function revisionNameChangeList(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('name_change_view')) {
            //abort(403, 'Sorry !! You are Unauthorized to view !');
            return redirect()->route('error_404');
        }

        try{

        \LogActivity::addToLog('revision name change list ');


        if(Auth::guard('admin')->user()->designation_list_id == 2 || Auth::guard('admin')->user()->designation_list_id == 1){


            $all_data_for_new_list = DB::table('ngo_name_changes')->whereIn('status',['Rejected','Correct'])->latest()->get();

            }else{


                $ngoStatusNameChange = NgoNameChangeDak::where('status',1)
                ->where('receiver_admin_id',Auth::guard('admin')->user()->id)->latest()->get();

                $convert_name_title = $ngoStatusRenew->implode("name_change_status_id", " ");
                $separated_data_title = explode(" ", $convert_name_title);

                $all_data_for_new_list = DB::table('ngo_name_changes')
                ->whereIn('id',$separated_data_title)
                ->whereIn('status',['Rejected','Correct'])->latest()->get();

            }




        //$all_data_for_new_list = DB::table('ngo_name_changes')->whereIn('status',['Rejected','Correct'])->latest()->get();


      return view('admin.name_change_list.revision_name_change_list',compact('all_data_for_new_list'));
    } catch (\Exception $e) {
        return redirect()->route('error_404')->with('error','some thing went wrong ');
    }


    }


    public function alreadNameChangeList(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('name_change_view')) {
            //abort(403, 'Sorry !! You are Unauthorized to view !');
            return redirect()->route('error_404');
        }
        try{
        \LogActivity::addToLog('already name changed list ');


        if(Auth::guard('admin')->user()->designation_list_id == 2 || Auth::guard('admin')->user()->designation_list_id == 1){


            $all_data_for_new_list = DB::table('ngo_name_changes')->where('status','Accepted')->latest()->get();

            }else{


                $ngoStatusNameChange = NgoNameChangeDak::where('status',1)
                ->where('receiver_admin_id',Auth::guard('admin')->user()->id)->latest()->get();

                $convert_name_title = $ngoStatusRenew->implode("name_change_status_id", " ");
                $separated_data_title = explode(" ", $convert_name_title);

                $all_data_for_new_list = DB::table('ngo_name_changes')
                ->whereIn('id',$separated_data_title)
                ->where('status','Accepted')->latest()->get();

            }


        //$all_data_for_new_list = DB::table('ngo_name_changes')->where('status','Accepted')->latest()->get();


      return view('admin.name_change_list.already_name_change_list',compact('all_data_for_new_list'));

    } catch (\Exception $e) {
        return redirect()->route('error_404')->with('error','some thing went wrong ');
    }

    }


    public function nameChangeView($id){


        \LogActivity::addToLog('view name change detail ');


             try {

                $allNameChangeDoc = DB::table('name_change_docs')->where('ngo_name_change_id',$id)->get();

                $getformOneId = DB::table('ngo_name_changes')->where('id',$id)->first();

                $form_one_data = DB::table('fd_one_forms')->where('id',$getformOneId->fd_one_form_id)->first();



                $r_status = DB::table('ngo_statuses')->where('fd_one_form_id',$form_one_data->id)->value('status');
                $name_change_status = DB::table('ngo_name_changes')->where('id',$id)->value('status');
                $renew_status = DB::table('ngo_renews')->where('fd_one_form_id',$form_one_data->id)->value('status');


                //new code for old  and new

      $checkOldorNew = DB::table('ngo_type_and_languages')
      ->where('user_id',$form_one_data->user_id)->value('ngo_type_new_old');

 //end new code for old and new

 if($checkOldorNew == 'Old'){

     $all_data_for_new_list_all = DB::table('ngo_renews')
     ->where('fd_one_form_id',$form_one_data->id)->first();
 }else{

     $all_data_for_new_list_all = DB::table('ngo_statuses')
     ->where('fd_one_form_id',$form_one_data->id)->first();
 }




                //$all_data_for_new_list_all = DB::table('ngo_statuses')->where('fd_one_form_id',$form_one_data->id)->first();

                $form_eight_data = DB::table('form_eights')->where('fd_one_form_id',$form_one_data->id)->get();
                $form_member_data = DB::table('ngo_member_lists')->where('fd_one_form_id',$form_one_data->id)->get();


                $form_member_data_doc_renew = DB::table('ngo_renew_infos')->where('fd_one_form_id',$form_one_data->id)->get();


     $duration_list_all1 = DB::table('ngo_durations')->where('fd_one_form_id',$form_one_data->id)->value('ngo_duration_end_date');
                $duration_list_all = DB::table('ngo_durations')->where('fd_one_form_id',$form_one_data->id)->value('ngo_duration_start_date');

                $form_member_data_doc = DB::table('ngo_member_nid_photos')->where('fd_one_form_id',$form_one_data->id)->get();
                $form_ngo_data_doc = DB::table('ngo_other_docs')->where('fd_one_form_id',$form_one_data->id)->get();

                $users_info = DB::table('users')->where('id',$form_one_data->user_id)->first();

                $all_source_of_fund = DB::table('fd_one_source_of_funds')->where('fd_one_form_id',$form_one_data->id)->get();

                $all_partiw = DB::table('fd_one_member_lists')->where('fd_one_form_id',$form_one_data->id)->get();


                $get_all_data_adviser_bank = DB::table('fd_one_bank_accounts')->where('fd_one_form_id',$form_one_data->id)
                ->first();


                $get_all_data_other= DB::table('fd_one_other_pdf_lists')->where('fd_one_form_id',$form_one_data->id)
                ->get();

                $get_all_data_adviser = DB::table('fd_one_adviser_lists')->where('fd_one_form_id',$form_one_data->id)
        ->get();






        return view('admin.name_change_list.name_change_view',compact('allNameChangeDoc','getformOneId','duration_list_all1','duration_list_all','renew_status','name_change_status','r_status','form_member_data_doc_renew','get_all_data_adviser','get_all_data_other','get_all_data_adviser_bank','all_partiw','all_source_of_fund','users_info','form_ngo_data_doc','form_member_data_doc','form_member_data','form_eight_data','all_data_for_new_list_all','form_one_data'));
    } catch (\Exception $e) {
        return redirect()->route('error_404')->with('error','some thing went wrong ');
    }

    }


    public function updateStatusNameChangeForm(Request $request){

        \LogActivity::addToLog('update name change status');

        //dd($request->status);

        $data_save = DB::table('ngo_name_changes')->where('id',$request->id)
        ->update([
            'status' => $request->status,
            'comment' => $request->comment,
         ]);


        $get_user_id = DB::table('ngo_name_changes')->where('id',$request->id)->value('fd_one_form_id');


        $present_name_eng = DB::table('ngo_name_changes')->where('id',$request->id)->value('present_name_eng');
        $present_name_ban = DB::table('ngo_name_changes')->where('id',$request->id)->value('present_name_ban');

        $form_one_data = DB::table('fd_one_forms')->where('id',$get_user_id)->first();


        if($request->status == 'Accepted'){

            DB::table('fd_one_forms')->where('id', $form_one_data->id)
            ->update([
                'organization_name' => $present_name_eng,
                'organization_name_ban' => $present_name_ban,
             ]);
        }
        Mail::send('emails.passwordResetEmailName', ['comment'=>$request->comment,'id' => $request->status,'ngoId'=>$form_one_data->id], function($message) use($request){
            $message->to($request->email);
            $message->subject('NGOAB Registration Service || Ngo Name Chnage Status');
        });

        return redirect()->back()->with('success','Updated Successfully');



    }


    public function nameChangeDoc($id){

        \LogActivity::addToLog('download name change pdf ');

            $form_one_data = DB::table('name_change_docs')->where('id',$id)->value('pdf_file_list');



        return view('admin.name_change_list.nameChangeDoc',compact('form_one_data'));

    }


    public function printCertificateViewName(Request $request){
        try{

        \LogActivity::addToLog('print ngo certificate.');

        //dd(11);

           $user_id = $request->user_id;

           $form_one_data = DB::table('fd_one_forms')->where('user_id',$user_id)->first();
           $ngoTypeData = DB::table('ngo_type_and_languages')
           ->where('user_id',$form_one_data->user_id)->first();
           $duration_list_all = DB::table('ngo_durations')->where('fd_one_form_id',$form_one_data->id)->latest()->first();


           ///////new code 19 february

$nameChangeDetail = DB::table('ngo_name_changes')
->where('fd_one_form_id',$form_one_data->id)->latest()->first();


///end new code 19 february
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


           $data=view('admin.name_change_list.print_certificate_view',['newyear'=>$newyear,'ngoTypeData'=>$ngoTypeData,
           'nameChangeDetail'=>$nameChangeDetail,'newmonth'=>$newmonth,'newdate'=>$newdate,'word'=>$word,'word1'=>$word1,'mainDate'=>$mainDate,
'form_one_data'=>$form_one_data,'duration_list_all'=>$duration_list_all]);



$mpdf = new Mpdf(
[
    'default_font' => 'nikosh',
    'mode' => 'utf-8',
    'format' => 'A4-L',
    'orientation' => 'L'
]
);

//$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);

$mpdf->WriteHTML($data);



$mpdf->Output();
die();




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
    public function printCertificateViewDemoName(Request $request){

try{
\LogActivity::addToLog('view certificate demo.');


        $user_id = $request->user_id;

        $form_one_data = DB::table('fd_one_forms')->where('user_id',$user_id)->first();
        $ngoTypeData = DB::table('ngo_type_and_languages')
        ->where('user_id',$form_one_data->user_id)->first();
        $duration_list_all = DB::table('ngo_durations')
        ->where('fd_one_form_id',$form_one_data->id)->latest()->first();



///////new code 19 february

$nameChangeDetail = DB::table('ngo_name_changes')
->where('fd_one_form_id',$form_one_data->id)->latest()->first();


///end new code 19 february



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

        $data =view('admin.name_change_list.printCertificateViewDemo',[
        'newyear'=>$newyear,
        'ngoTypeData'=>$ngoTypeData,
        'nameChangeDetail'=>$nameChangeDetail,
        'newmonth'=>$newmonth,
        'newdate'=>$newdate,
        'word'=>$word,
        'word1'=>$word1,
        'mainDate'=>$mainDate,
       'form_one_data'=>$form_one_data,
       'duration_list_all'=>$duration_list_all]);





$mpdf = new Mpdf(
[
    'default_font' => 'nikosh',
    'mode' => 'utf-8',
    'format' => 'A4-L',
    'orientation' => 'L'
]
);

//$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);

$mpdf->WriteHTML($data);



$mpdf->Output();
die();





} catch (\Exception $e) {
    return redirect()->route('error_404')->with('error','some thing went wrong ');
}
 }
}
