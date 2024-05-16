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
use App\Models\NgoFdSevenDak;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use App\Http\Controllers\Admin\CommonController;
class FD7Controller extends Controller
{
    public function index(){
        try{
        \LogActivity::addToLog('view fdSeven List ');


        if(Auth::guard('admin')->user()->designation_list_id == 2 || Auth::guard('admin')->user()->designation_list_id == 1){

          $dataFromFd7Form = DB::table('fd7_forms')
          ->join('fd_one_forms', 'fd_one_forms.id', '=', 'fd7_forms.fd_one_form_id')
          ->select('fd_one_forms.*','fd7_forms.*','fd7_forms.id as mainId')
         ->orderBy('fd7_forms.id','desc')
         ->get();
        }else{

            $ngoStatusFdSevenDak = NgoFdSevenDak::where('status',1)
            ->where('receiver_admin_id',Auth::guard('admin')->user()->id)
            ->latest()->get();

            $convert_name_title = $ngoStatusFdSevenDak->implode("fd_seven_status_id", " ");
             $separated_data_title = explode(" ", $convert_name_title);



            $dataFromFd7Form = DB::table('fd7_forms')
              ->join('fd_one_forms', 'fd_one_forms.id', '=', 'fd7_forms.fd_one_form_id')
              ->select('fd_one_forms.*','fd7_forms.*','fd7_forms.id as mainId')
              ->whereIn('fd7_forms.id',$separated_data_title)
             ->orderBy('fd7_forms.id','desc')
             ->get();




        }



         //dd($dataFromNVisaFd9Fd1);
             return view('admin.fd7form.index',compact('dataFromFd7Form'));
            } catch (\Exception $e) {
                return redirect()->route('error_404')->with('error','some thing went wrong ');
            }
         }


         public function show($id){
            try{
            \LogActivity::addToLog('view fdSeven List Detail');

              $dataFromFd7Form = DB::table('fd7_forms')
              ->join('fd_one_forms', 'fd_one_forms.id', '=', 'fd7_forms.fd_one_form_id')
              ->select('fd_one_forms.*','fd7_forms.*','fd7_forms.id as mainId')
              ->where('fd7_forms.id',$id)
             ->orderBy('fd7_forms.id','desc')
             ->first();
             $get_email_from_user = DB::table('users')->where('id',$dataFromFd7Form->user_id)->value('email');

             $fd2FormList = DB::table('fd2_form_for_fd7_forms')->where('fd_one_form_id',$dataFromFd7Form->fd_one_form_id)
             ->where('fd7_form_id',$dataFromFd7Form->mainId)->latest()->first();

             $fd2OtherInfo = DB::table('fd2_fd7_other_infos')->where('fd2_form_for_fd7_form_id',$fd2FormList->id)->latest()->get();


             $prokolpoAreaList = DB::table('fd7_form_prokolpo_areas')->where('fd7_form_id',$dataFromFd7Form->mainId)->latest()->get();

             //dd($dataFromNVisaFd9Fd1);
                 return view('admin.fd7form.show',compact('get_email_from_user','dataFromFd7Form','fd2FormList','fd2OtherInfo','prokolpoAreaList'));
                } catch (\Exception $e) {
                    return redirect()->route('error_404')->with('error','some thing went wrong ');
                }
             }


             public function authorizationLetter($id){
                try{
                \LogActivity::addToLog('authorizationLetter pdf download.');

                $form_one_data = DB::table('fd7_forms')->where('id',$id)->value('bureau_approval_pdf');

                 return view('admin.fd7form.authorizationLetter',compact('form_one_data'));
                } catch (\Exception $e) {
                    return redirect()->route('error_404')->with('error','some thing went wrong ');
                }
             }


             public function reliefAssistanceProjectProposalPdf($id){
                try{
                \LogActivity::addToLog('reliefAssistanceProjectProposalPdf download.');

                $form_one_data = DB::table('fd7_forms')->where('id',$id)->value('relief_assistance_project_proposal_pdf');

                 return view('admin.fd7form.reliefAssistanceProjectProposalPdf',compact('form_one_data'));
                } catch (\Exception $e) {
                    return redirect()->route('error_404')->with('error','some thing went wrong ');
                }
             }

             public function letterFromDonorAgency($id){
                try{
                \LogActivity::addToLog('letterFromDonorAgency pdf download.');

                $form_one_data = DB::table('fd7_forms')->where('id',$id)->value('letter_from_donor_agency_pdf');

                 return view('admin.fd7form.letterFromDonorAgency',compact('form_one_data'));

                } catch (\Exception $e) {
                    return redirect()->route('error_404')->with('error','some thing went wrong ');
                }
             }


             public function fd7fd2PdfDownload($id){
                try{
                \LogActivity::addToLog('fd2 pdf download.');

                $form_one_data = DB::table('fd2_form_for_fd7_forms')->where('id',$id)->value('fd_2_form_pdf');

                 return view('admin.fd6form.fd2PdfDownload',compact('form_one_data'));

                } catch (\Exception $e) {
                    return redirect()->route('error_404')->with('error','some thing went wrong ');
                }

                }


             public function fd7fd2OtherPdfDownload($id){
                try{

                \LogActivity::addToLog('fd2 other pdf download.');

                $form_one_data = DB::table('fd2_fd7_other_infos')->where('id',$id)->value('file');

                 return view('admin.fd6form.fd2PdfDownload',compact('form_one_data'));
                } catch (\Exception $e) {
                    return redirect()->route('error_404')->with('error','some thing went wrong ');
                }

             }


             public function statusUpdateForFd7(Request $request){

                //dd($request->all());

                try{
                    DB::beginTransaction();
                \LogActivity::addToLog('update fdSeven Status ');


                DB::table('fd7_forms')->where('id',$request->id)
                ->update([
                    'status' => $request->status,
                    'comment' => $request->comment,
                ]);


                $get_user_id = DB::table('fd7_forms')->where('id',$request->id)->value('fd_one_form_id');


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
