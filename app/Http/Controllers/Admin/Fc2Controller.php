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
use Carbon\Carbon;
use Response;
use App\Models\Fd9ForwardingLetterEdit;
use App\Models\ForwardingLetter;
use App\Models\ForwardingLetterOnulipi;
use App\Models\SecruityCheck;
use App\Models\FcTwoDak;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use App\Http\Controllers\Admin\CommonController;
class Fc2Controller extends Controller
{
    public function index(){

        try{

        \LogActivity::addToLog('view fcOne List ');


        if(Auth::guard('admin')->user()->designation_list_id == 2 || Auth::guard('admin')->user()->designation_list_id == 1){

          $dataFromFc2Form = DB::table('fc2_forms')
          ->join('fd_one_forms', 'fd_one_forms.id', '=', 'fc2_forms.fd_one_form_id')
          ->select('fd_one_forms.*','fc2_forms.*','fc2_forms.id as mainId')
         ->orderBy('fc2_forms.id','desc')
         ->get();
        }else{

            $ngoStatusFdSevenDak = FcTwoDak::where('status',1)
            ->where('receiver_admin_id',Auth::guard('admin')->user()->id)
            ->latest()->get();

            $convert_name_title = $ngoStatusFdSevenDak->implode("fc_two_status_id", " ");
             $separated_data_title = explode(" ", $convert_name_title);



            $dataFromFc2Form = DB::table('fc2_forms')
              ->join('fd_one_forms', 'fd_one_forms.id', '=', 'fc2_forms.fd_one_form_id')
              ->select('fd_one_forms.*','fc2_forms.*','fc2_forms.id as mainId')
              ->whereIn('fc2_forms.id',$separated_data_title)
             ->orderBy('fc2_forms.id','desc')
             ->get();




        }



         //dd($dataFromNVisaFd9Fd1);
             return view('admin.fc2form.index',compact('dataFromFc2Form'));
            } catch (\Exception $e) {
                return redirect()->route('error_404')->with('error','some thing went wrong ');
            }
         }


         public function show($id){

            try{

            \LogActivity::addToLog('view fdSeven List Detail');

              $dataFromFc2Form = DB::table('fc2_forms')
              ->join('fd_one_forms', 'fd_one_forms.id', '=', 'fc2_forms.fd_one_form_id')
              ->select('fd_one_forms.*','fc2_forms.*','fc2_forms.id as mainId')
              ->where('fc2_forms.id',$id)
             ->orderBy('fc2_forms.id','desc')
             ->first();
             $get_email_from_user = DB::table('users')->where('id',$dataFromFc2Form->user_id)->value('email');

             $fd2FormList = DB::table('fd2_form_for_fc2_forms')->where('fd_one_form_id',$dataFromFc2Form->fd_one_form_id)
             ->where('fc2_form_id',$dataFromFc2Form->mainId)->latest()->first();

             $fd2OtherInfo = DB::table('fd2_fc2_other_infos')->where('fd2_form_for_fc2_form_id',$fd2FormList->id)->latest()->get();




             //dd($dataFromNVisaFd9Fd1);
                 return view('admin.fc2form.show',compact('get_email_from_user','dataFromFc2Form','fd2FormList','fd2OtherInfo'));


                } catch (\Exception $e) {
                    return redirect()->route('error_404')->with('error','some thing went wrong ');
                }
             }


             public function fc2PdfDownload($id){

                try{

                \LogActivity::addToLog('organization name of the job amount of money and duration pdf');

                $form_one_data = DB::table('fc2_forms')->where('id',$id)->value('organization_name_of_the_job_amount_of_money_and_duration_pdf');

                 return view('admin.fc2form.fc2PdfDownload',compact('form_one_data'));

                } catch (\Exception $e) {
                    return redirect()->route('error_404')->with('error','some thing went wrong ');
                }
             }



             public function verified_fc_two_form($id){

                try{

                \LogActivity::addToLog('verified_fc_two_form pdf');

                $form_one_data = DB::table('fc2_forms')->where('id',$id)->value('verified_fc_two_form');

                //dd($form_one_data);

                 return view('admin.fc2form.fc2PdfDownload',compact('form_one_data'));
                } catch (\Exception $e) {
                    return redirect()->route('error_404')->with('error','some thing went wrong ');
                }
                }

             public function fc2fd2PdfDownload($id){

                try{

                \LogActivity::addToLog('fd2 pdf download.');

                $form_one_data = DB::table('fd2_form_for_fc2_forms')->where('id',$id)->value('fd_2_form_pdf');

                 return view('admin.fc2form.fc2fd2PdfDownload',compact('form_one_data'));
                } catch (\Exception $e) {
                    return redirect()->route('error_404')->with('error','some thing went wrong ');
                }

                }


             public function fc2fd2OtherPdfDownload($id){

try{
                \LogActivity::addToLog('fd2 other pdf download.');

                $form_one_data = DB::table('fd2_fc2_other_infos')->where('id',$id)->value('file');

                 return view('admin.fc2form.fc2fd2OtherPdfDownload',compact('form_one_data'));
                } catch (\Exception $e) {
                    return redirect()->route('error_404')->with('error','some thing went wrong ');
                }

             }


             public function statusUpdateForFc2(Request $request){

           // dd($request->all());
           try{
            DB::beginTransaction();

                \LogActivity::addToLog('update fcTwo Status ');


                DB::table('fc2_forms')->where('id',$request->id)
                ->update([
                    'status' => $request->status,
                    'comment' => $request->comment,
                ]);


                $get_user_id = DB::table('fc2_forms')->where('id',$request->id)->value('fd_one_form_id');


                    Mail::send('emails.grantApplicationTwo', ['comment' => $request->comment,'id' => $request->status,'ngoId'=>$get_user_id], function($message) use($request){
                        $message->to($request->email);
                        $message->subject('One time grant application form');
                    });





                    DB::commit();
                return redirect()->back()->with('success','Updated successfully!');

            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->route('error_404')->with('error','some thing went wrong ');
            }
             }
}
