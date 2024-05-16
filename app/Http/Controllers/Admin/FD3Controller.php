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
use App\Models\FdThreeDak;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use App\Http\Controllers\Admin\CommonController;
class FD3Controller extends Controller
{
    public function index(){

        try{

        \LogActivity::addToLog('view fdThree List ');


        if(Auth::guard('admin')->user()->designation_list_id == 2 || Auth::guard('admin')->user()->designation_list_id == 1){

          $dataFromFd3Form = DB::table('fd3_forms')
          ->join('fd_one_forms', 'fd_one_forms.id', '=', 'fd3_forms.fd_one_form_id')
          ->select('fd_one_forms.*','fd3_forms.*','fd3_forms.id as mainId')
         ->orderBy('fd3_forms.id','desc')
         ->get();
        }else{

            $ngoStatusFdSevenDak = FdThreeDak::where('status',1)
            ->where('receiver_admin_id',Auth::guard('admin')->user()->id)
            ->latest()->get();

            $convert_name_title = $ngoStatusFdSevenDak->implode("fd_three_status_id", " ");
             $separated_data_title = explode(" ", $convert_name_title);



            $dataFromFd3Form = DB::table('fd3_forms')
              ->join('fd_one_forms', 'fd_one_forms.id', '=', 'fd3_forms.fd_one_form_id')
              ->select('fd_one_forms.*','fd3_forms.*','fd3_forms.id as mainId')
              ->whereIn('fd3_forms.id',$separated_data_title)
             ->orderBy('fd3_forms.id','desc')
             ->get();




        }



         //dd($dataFromNVisaFd9Fd1);
             return view('admin.fd3form.index',compact('dataFromFd3Form'));
            } catch (\Exception $e) {
                return redirect()->route('error_404')->with('error','some thing went wrong ');
            }
         }


         public function show($id){
            try{
            \LogActivity::addToLog('view fdThree List Detail');

              $dataFromFd3Form = DB::table('fd3_forms')
              ->join('fd_one_forms', 'fd_one_forms.id', '=', 'fd3_forms.fd_one_form_id')
              ->select('fd_one_forms.*','fd3_forms.*','fd3_forms.id as mainId')
              ->where('fd3_forms.id',$id)
             ->orderBy('fd3_forms.id','desc')
             ->first();

//dd($dataFromFd3Form);




             $get_email_from_user = DB::table('users')->where('id',$dataFromFd3Form->user_id)->value('email');

             $fd2FormList = DB::table('fd2_form_for_fd3_forms')->where('fd_one_form_id',$dataFromFd3Form->fd_one_form_id)
             ->where('fd3_form_id',$dataFromFd3Form->mainId)->latest()->first();

             $fd2OtherInfo = DB::table('fd2_fd3_other_infos')->where('fd2_form_for_fd3_form_id',$fd2FormList->id)->latest()->get();




             //dd($dataFromNVisaFd9Fd1);
                 return view('admin.fd3form.show',compact('get_email_from_user','dataFromFd3Form','fd2FormList','fd2OtherInfo'));


                } catch (\Exception $e) {
                    return redirect()->route('error_404')->with('error','some thing went wrong ');
                }
             }



             public function verified_fd_three_form($id){
                try{
                \LogActivity::addToLog('verified_fd_three_form pdf');

                $form_one_data = DB::table('fd3_forms')->where('id',$id)->value('verified_fd_three_form');

                //dd($form_one_data);

                 return view('admin.fd3form.verified_fd_three_form',compact('form_one_data'));

                } catch (\Exception $e) {
                    return redirect()->route('error_404')->with('error','some thing went wrong ');
                }
                }


             public function fd3fd2PdfDownload($id){
                try{
                \LogActivity::addToLog('fd2 pdf download.');

                $form_one_data = DB::table('fd2_form_for_fd3_forms')->where('id',$id)->value('fd_2_form_pdf');

                 return view('admin.fd6form.fd2PdfDownload',compact('form_one_data'));
                } catch (\Exception $e) {
                    return redirect()->route('error_404')->with('error','some thing went wrong ');
                }


                }


             public function fd3fd2OtherPdfDownload($id){

                try{
                \LogActivity::addToLog('fd2 other pdf download.');

                $form_one_data = DB::table('fd2_fd3_other_infos')->where('id',$id)->value('file');

                 return view('admin.fd6form.fd2PdfDownload',compact('form_one_data'));


                } catch (\Exception $e) {
                    return redirect()->route('error_404')->with('error','some thing went wrong ');
                }
             }



             public function statusUpdateForFd3(Request $request){

                //dd($request->all());

                try{
                    DB::beginTransaction();
                \LogActivity::addToLog('update fdSeven Status ');


                DB::table('fd3_forms')->where('id',$request->id)
                ->update([
                    'status' => $request->status,
                    'comment' => $request->comment,
                ]);


                $get_user_id = DB::table('fd3_forms')->where('id',$request->id)->value('fd_one_form_id');


                    Mail::send('emails.previousYearIncome', ['comment' => $request->comment,'id' => $request->status,'ngoId'=>$get_user_id], function($message) use($request){
                        $message->to($request->email);
                        $message->subject('Previous year income statement form');
                    });





                    DB::commit();
                return redirect()->back()->with('success','Updated successfully!');

            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->route('error_404')->with('error','some thing went wrong ');
            }
             }
}
