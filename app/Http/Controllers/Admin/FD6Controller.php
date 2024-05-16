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
use Carbon\Carbon;
use Response;
use App\Models\Fd9ForwardingLetterEdit;
use App\Models\ForwardingLetter;
use App\Models\ForwardingLetterOnulipi;
use App\Models\SecruityCheck;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use App\Http\Controllers\Admin\CommonController;
class FD6Controller extends Controller
{
    public function index(){

        try{

   \LogActivity::addToLog('view fdSix List ');

   if(Auth::guard('admin')->user()->designation_list_id == 2 || Auth::guard('admin')->user()->designation_list_id == 1){

     $dataFromFd6Form = DB::table('fd6_forms')
     ->join('fd_one_forms', 'fd_one_forms.id', '=', 'fd6_forms.fd_one_form_id')
     ->select('fd_one_forms.*','fd6_forms.*','fd6_forms.id as mainId')
    ->orderBy('fd6_forms.id','desc')
    ->get();


   }else{

    $ngoStatusFdSixDak = NgoFdSixDak::where('status',1)
    ->where('receiver_admin_id',Auth::guard('admin')->user()->id)
    ->latest()->get();

    $convert_name_title = $ngoStatusFdSixDak->implode("fd_six_status_id", " ");
     $separated_data_title = explode(" ", $convert_name_title);

    $dataFromFd6Form = DB::table('fd6_forms')
    ->join('fd_one_forms', 'fd_one_forms.id', '=', 'fd6_forms.fd_one_form_id')
    ->select('fd_one_forms.*','fd6_forms.*','fd6_forms.id as mainId')
    ->whereIn('fd6_forms.id',$separated_data_title)
   ->orderBy('fd6_forms.id','desc')
   ->get();


   }
    //dd($dataFromNVisaFd9Fd1);
        return view('admin.fd6form.index',compact('dataFromFd6Form'));
    } catch (\Exception $e) {
        return redirect()->route('error_404')->with('error','some thing went wrong ');
    }
    }



    public function show($id){
        try{
        \LogActivity::addToLog('view fdSix List Detail');

          $dataFromFd6Form = DB::table('fd6_forms')
          ->join('fd_one_forms', 'fd_one_forms.id', '=', 'fd6_forms.fd_one_form_id')
          ->select('fd_one_forms.*','fd6_forms.*','fd6_forms.id as mainId')
          ->where('fd6_forms.id',$id)
         ->orderBy('fd6_forms.id','desc')
         ->first();
         $get_email_from_user = DB::table('users')->where('id',$dataFromFd6Form->user_id)->value('email');

         $fd2FormList = DB::table('fd2_forms')->where('fd_one_form_id',$dataFromFd6Form->fd_one_form_id)
         ->where('fd_six_form_id',base64_encode($dataFromFd6Form->mainId))->latest()->first();

         $fd2OtherInfo = DB::table('fd2_form_other_infos')->where('fd2_form_id',$fd2FormList->id)->latest()->get();


         $prokolpoAreaList = DB::table('fd6_form_prokolpo_areas')->where('fd6_form_id',$dataFromFd6Form->mainId)->latest()->get();

         //dd($dataFromNVisaFd9Fd1);
             return view('admin.fd6form.show',compact('get_email_from_user','dataFromFd6Form','fd2FormList','fd2OtherInfo','prokolpoAreaList'));
            } catch (\Exception $e) {
                return redirect()->route('error_404')->with('error','some thing went wrong ');
            }
         }


         public function fd6PdfDownload($id){
            try{
            \LogActivity::addToLog('fd6 pdf download.');

            $form_one_data = DB::table('fd6_forms')->where('id',$id)->value('project_proposal_form');

             return view('admin.fd6form.fd6PdfDownload',compact('form_one_data'));
            } catch (\Exception $e) {
                return redirect()->route('error_404')->with('error','some thing went wrong ');
            }
         }


         public function fd2PdfDownload($id){
            try{
            \LogActivity::addToLog('fd2 pdf download.');

            $form_one_data = DB::table('fd2_forms')->where('id',$id)->value('fd_2_form_pdf');

             return view('admin.fd6form.fd2PdfDownload',compact('form_one_data'));

            } catch (\Exception $e) {
                return redirect()->route('error_404')->with('error','some thing went wrong ');
            }

            }


         public function fd2OtherPdfDownload($id){

            try{
            \LogActivity::addToLog('fd2 other pdf download.');

            $form_one_data = DB::table('fd2_form_other_infos')->where('id',$id)->value('file');

             return view('admin.fd6form.fd2PdfDownload',compact('form_one_data'));

            } catch (\Exception $e) {
                return redirect()->route('error_404')->with('error','some thing went wrong ');
            }
         }


         public function statusUpdateForFd6(Request $request){

            //dd($request->all());
            try{
                DB::beginTransaction();

            \LogActivity::addToLog('update fdSix Status ');


            DB::table('fd6_forms')->where('id',$request->id)
            ->update([
                'status' => $request->status,
                'comment' => $request->comment,
            ]);


            $get_user_id = DB::table('fd6_forms')->where('id',$request->id)->value('fd_one_form_id');


                Mail::send('emails.projectProposal', ['comment' => $request->comment,'id' => $request->status,'ngoId'=>$get_user_id], function($message) use($request){
                    $message->to($request->email);
                    $message->subject('Project proposal Service');
                });





                DB::commit();
            return redirect()->back()->with('success','Updated successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('error_404')->with('error','some thing went wrong ');
        }
         }
}
