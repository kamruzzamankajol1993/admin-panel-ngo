<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Image;
use Auth;
use Hash;
use PDF;
use File;
use Mail;
use App\Models\ParentNoteForFcOne;
use App\Models\ParentNoteForFcTwo;
use App\Models\ParentNoteForFdNine;
use App\Models\ParentNoteForFdNineOne;
use App\Models\ParentNoteForFdSeven;
use App\Models\ParentNoteForFdsix;
use App\Models\ParentNoteForFdThree;
use App\Models\ParentNoteForNameChange;
use App\Models\ParentNoteForRegistration;
use App\Models\ParentNoteForRenew;
use App\Models\ChildNoteForFcOne;
use App\Models\ChildNoteForFcTwo;
use App\Models\ChildNoteForFdNine;
use App\Models\ChildNoteForFdNineOne;
use App\Models\ChildNoteForFdSeven;
use App\Models\ChildNoteForFdSix;
use App\Models\ChildNoteForFdThree;
use App\Models\ChildNoteForNameChange;
use App\Models\ChildNoteForRegistration;
use App\Models\ChildNoteForRenew;
use App\Models\NothiList;
use App\Models\NothiPrapok;
use App\Models\NothiCopy;
use App\Models\NoteAttachment;
use App\Models\NothiFirstSenderList;
use DB;
use DateTime;
use DateTimezone;
use App\Models\DuplicateCertificateDak;
use App\Models\ConstitutionDak;
use App\Models\ExecutiveCommitteeDak;
use App\Models\RegistrationOfficeSarok;
use App\Models\RenewOfficeSarok;
use App\Models\NameChangeOfficeSarok;
use App\Models\FdNineOfficeSarok;
use App\Models\FdNineOneOfficeSarok;
use App\Models\FdSixOfficeSarok;
use App\Models\FdSevenOfficeSarok;
use App\Models\FcOneOfficeSarok;
use App\Models\FcTwoOfficeSarok;
use App\Models\FdThreeOfficeSarok;
use App\Models\NothiAttarct;
use App\Models\NothiPermission;
use App\Models\Branch;
use App\Models\NothiDetail;
use App\Models\ArticleSign;
use Mpdf\Mpdf;
use App\Models\PotrangshoDraft;
use App\Models\NgoFDNineDak;
use App\Models\NgoFDNineOneDak;
use App\Models\NgoNameChangeDak;
use App\Models\NgoRenewDak;
use App\Models\NgoFdSixDak;
use App\Models\NgoFdSevenDak;
use App\Models\FcOneDak;
use App\Models\FcTwoDak;
use App\Models\NgoRegistrationDak;
use App\Models\FdThreeDak;
use App\Models\FdFiveDak;
class NothiJatController extends Controller
{

    public function returnToAgotoDak($id, $status){

        try{


        if($status == 'registration'){

            $updateDataInsert = NgoRegistrationDak::find($id);

            $updateDataInsert->nothi_jat_id = 0;
            $updateDataInsert->nothi_jat_status =0;
            $updateDataInsert->save();

          }elseif($status == 'renew'){

              $updateDataInsert = NgoRenewDak::find($id);
              $updateDataInsert->nothi_jat_id = 0;
              $updateDataInsert->nothi_jat_status = 0;
              $updateDataInsert->save();

          }elseif($status == 'nameChange'){


            $updateDataInsert = NgoNameChangeDak::find($id);
            $updateDataInsert->nothi_jat_id = 0;
            $updateDataInsert->nothi_jat_status = 0;
            $updateDataInsert->save();


          }elseif($status == 'fdNine'){


            $updateDataInsert = NgoFDNineDak::find($id);
            $updateDataInsert->nothi_jat_id = 0;
            $updateDataInsert->nothi_jat_status = 0;
            $updateDataInsert->save();


          }elseif($status == 'fdNineOne'){


            $updateDataInsert = NgoFDNineOneDak::find($id);
            $updateDataInsert->nothi_jat_id = 0;
            $updateDataInsert->nothi_jat_status = 0;
            $updateDataInsert->save();



          }elseif($status == 'fdSix'){

            $updateDataInsert = NgoFdSixDak::find($id);
            $updateDataInsert->nothi_jat_id = 0;
            $updateDataInsert->nothi_jat_status = 0;
            $updateDataInsert->save();



          }elseif($status == 'fdSeven'){

            $updateDataInsert = NgoFdSevenDak::find($id);
            $updateDataInsert->nothi_jat_id = 0;
            $updateDataInsert->nothi_jat_status = 0;
            $updateDataInsert->save();


          }elseif($status == 'fcOne'){



            $updateDataInsert = FcOneDak::find($id);
            $updateDataInsert->nothi_jat_id = 0;
            $updateDataInsert->nothi_jat_status = 0;
            $updateDataInsert->save();


          }elseif($status == 'fcTwo'){



            $updateDataInsert = FcTwoDak::find($id);
            $updateDataInsert->nothi_jat_id = 0;
            $updateDataInsert->nothi_jat_status = 0;
            $updateDataInsert->save();



          }elseif($status == 'fdThree'){

            $updateDataInsert = FdThreeDak::find($id);
            $updateDataInsert->nothi_jat_id = 0;
            $updateDataInsert->nothi_jat_status = 0;
            $updateDataInsert->save();




          }elseif($status == 'fdFive'){

            $updateDataInsert = FdFiveDak::find($id);
            $updateDataInsert->nothi_jat_id = 0;
            $updateDataInsert->nothi_jat_status = 0;
            $updateDataInsert->save();




          }elseif($status == 'duplicate'){

            $updateDataInsert = DuplicateCertificateDak::find($id);
            $updateDataInsert->nothi_jat_id = 0;
            $updateDataInsert->nothi_jat_status = 0;
            $updateDataInsert->save();




          }elseif($status == 'constitution'){

            $updateDataInsert = ConstitutionDak::find($id);
            $updateDataInsert->nothi_jat_id = 0;
            $updateDataInsert->nothi_jat_status = 0;
            $updateDataInsert->save();




          }elseif($status == 'committee'){

            $updateDataInsert = ExecutiveCommitteeDak::find($id);
            $updateDataInsert->nothi_jat_id = 0;
            $updateDataInsert->nothi_jat_status = 0;
            $updateDataInsert->save();




          }

          return redirect()->back()->with('success','সফলভাবে ফেরত আনা দেওয়া হয়েছে');
        } catch (\Exception $e) {
            return redirect()->route('error_404')->with('error','some thing went wrong ');
        }
    }
    public function updateNothiJat(Request $request){



        if($request->status == 'registration'){

              $updateDataInsert = NgoRegistrationDak::find($request->dakId);

              $updateDataInsert->nothi_jat_id = $request->nothiId;
              $updateDataInsert->nothi_jat_status = 1;
              $updateDataInsert->save();

            }elseif($request->status == 'renew'){

                $updateDataInsert = NgoRenewDak::find($request->dakId);
                $updateDataInsert->nothi_jat_id = $request->nothiId;
                $updateDataInsert->nothi_jat_status = 1;
                $updateDataInsert->save();

            }elseif($request->status == 'nameChange'){


                $updateDataInsert = NgoNameChangeDak::find($request->dakId);
                $updateDataInsert->nothi_jat_id = $request->nothiId;
                $updateDataInsert->nothi_jat_status = 1;
                $updateDataInsert->save();


            }elseif($request->status == 'fdNine'){


                $updateDataInsert = NgoFDNineDak::find($request->dakId);
                $updateDataInsert->nothi_jat_id = $request->nothiId;
                $updateDataInsert->nothi_jat_status = 1;
                $updateDataInsert->save();


            }elseif($request->status == 'fdNineOne'){


                $updateDataInsert = NgoFDNineOneDak::find($request->dakId);
                $updateDataInsert->nothi_jat_id = $request->nothiId;
                $updateDataInsert->nothi_jat_status = 1;
                $updateDataInsert->save();



            }elseif($request->status == 'fdSix'){


                $updateDataInsert = NgoFdSixDak::find($request->dakId);
                $updateDataInsert->nothi_jat_id = $request->nothiId;
                $updateDataInsert->nothi_jat_status = 1;
                $updateDataInsert->save();


            }elseif($request->status == 'fdSeven'){

                $updateDataInsert = NgoFdSevenDak::find($request->dakId);
                $updateDataInsert->nothi_jat_id = $request->nothiId;
                $updateDataInsert->nothi_jat_status = 1;
                $updateDataInsert->save();


            }elseif($request->status == 'fcOne'){



                $updateDataInsert = FcOneDak::find($request->dakId);
                $updateDataInsert->nothi_jat_id = $request->nothiId;
                $updateDataInsert->nothi_jat_status = 1;
                $updateDataInsert->save();


            }elseif($request->status == 'fcTwo'){



                $updateDataInsert = FcTwoDak::find($request->dakId);
                $updateDataInsert->nothi_jat_id = $request->nothiId;
                $updateDataInsert->nothi_jat_status = 1;
                $updateDataInsert->save();



            }elseif($request->status == 'fdThree'){



                $updateDataInsert = FdThreeDak::find($request->dakId);
                $updateDataInsert->nothi_jat_id = $request->nothiId;
                $updateDataInsert->nothi_jat_status = 1;
                $updateDataInsert->save();


            }elseif($request->status == 'fdFive'){



                $updateDataInsert = FdFiveDak::find($request->dakId);
                $updateDataInsert->nothi_jat_id = $request->nothiId;
                $updateDataInsert->nothi_jat_status = 1;
                $updateDataInsert->save();


            }elseif($request->status == 'duplicate'){

                $updateDataInsert = DuplicateCertificateDak::find($request->dakId);
                $updateDataInsert->nothi_jat_id = $request->nothiId;
                $updateDataInsert->nothi_jat_status = 1;

                $updateDataInsert->save();




              }elseif($request->status == 'constitution'){

                $updateDataInsert = ConstitutionDak::find($request->dakId);
                $updateDataInsert->nothi_jat_id = $request->nothiId;
                $updateDataInsert->nothi_jat_status = 1;

                $updateDataInsert->save();




              }elseif($request->status == 'committee'){

                $updateDataInsert = ExecutiveCommitteeDak::find($request->dakId);
                $updateDataInsert->nothi_jat_id = $request->nothiId;
                $updateDataInsert->nothi_jat_status = 1;

                $updateDataInsert->save();




              }

  return 1;
    }



    public function searchResultNothiJat(Request $request){


        $dakId = $request->result;


        $searchResult = NothiList::where('document_branch', 'LIKE', '%'.$request->main_value.'%')
        ->orWhere('document_type_id', 'LIKE', '%'.$request->main_value.'%')
        ->orWhere('document_number', 'LIKE',  '%'.$request->main_value.'%')
        ->orWhere('document_year', 'LIKE',  '%'.$request->main_value.'%')
        ->orWhere('document_class', 'LIKE',  '%'.$request->main_value.'%')
        ->orWhere('document_subject', 'LIKE',  '%'.$request->main_value.'%')->get();


        //dd($searchResult);

        $data = view('admin.post.searchResultNothiJat',compact('searchResult','dakId'))->render();


        return response()->json($data);


    }


    public function searchResultNothiJatRenew(Request $request){


        $dakId = $request->result;


        $searchResult = NothiList::where('document_branch', 'LIKE', '%'.$request->main_value.'%')
        ->orWhere('document_type_id', 'LIKE', '%'.$request->main_value.'%')
        ->orWhere('document_number', 'LIKE',  '%'.$request->main_value.'%')
        ->orWhere('document_year', 'LIKE',  '%'.$request->main_value.'%')
        ->orWhere('document_class', 'LIKE',  '%'.$request->main_value.'%')
        ->orWhere('document_subject', 'LIKE',  '%'.$request->main_value.'%')->get();


        //dd($searchResult);

        $data = view('admin.post.searchResultNothiJatRenew',compact('searchResult','dakId'))->render();


        return response()->json($data);


    }

    public function searchResultNothiJatNameChange(Request $request){

        $dakId = $request->result;


        $searchResult = NothiList::where('document_branch', 'LIKE', '%'.$request->main_value.'%')
        ->orWhere('document_type_id', 'LIKE', '%'.$request->main_value.'%')
        ->orWhere('document_number', 'LIKE',  '%'.$request->main_value.'%')
        ->orWhere('document_year', 'LIKE',  '%'.$request->main_value.'%')
        ->orWhere('document_class', 'LIKE',  '%'.$request->main_value.'%')
        ->orWhere('document_subject', 'LIKE',  '%'.$request->main_value.'%')->get();


        //dd($searchResult);

        $data = view('admin.post.searchResultNothiJatNameChange',compact('searchResult','dakId'))->render();


        return response()->json($data);

    }


    public function searchResultNothiJatFdNine(Request $request){

        $dakId = $request->result;


        $searchResult = NothiList::where('document_branch', 'LIKE', '%'.$request->main_value.'%')
        ->orWhere('document_type_id', 'LIKE', '%'.$request->main_value.'%')
        ->orWhere('document_number', 'LIKE',  '%'.$request->main_value.'%')
        ->orWhere('document_year', 'LIKE',  '%'.$request->main_value.'%')
        ->orWhere('document_class', 'LIKE',  '%'.$request->main_value.'%')
        ->orWhere('document_subject', 'LIKE',  '%'.$request->main_value.'%')->get();


        //dd($searchResult);

        $data = view('admin.post.searchResultNothiJatFdNine',compact('searchResult','dakId'))->render();


        return response()->json($data);


    }


    public function searchResultNothiJatFdNineOne(Request $request){

        $dakId = $request->result;


        $searchResult = NothiList::where('document_branch', 'LIKE', '%'.$request->main_value.'%')
        ->orWhere('document_type_id', 'LIKE', '%'.$request->main_value.'%')
        ->orWhere('document_number', 'LIKE',  '%'.$request->main_value.'%')
        ->orWhere('document_year', 'LIKE',  '%'.$request->main_value.'%')
        ->orWhere('document_class', 'LIKE',  '%'.$request->main_value.'%')
        ->orWhere('document_subject', 'LIKE',  '%'.$request->main_value.'%')->get();


        //dd($searchResult);

        $data = view('admin.post.searchResultNothiJatFdNineOne',compact('searchResult','dakId'))->render();


        return response()->json($data);

    }


    public function searchResultNothiJatFdSix(Request $request){

        $dakId = $request->result;


        $searchResult = NothiList::where('document_branch', 'LIKE', '%'.$request->main_value.'%')
        ->orWhere('document_type_id', 'LIKE', '%'.$request->main_value.'%')
        ->orWhere('document_number', 'LIKE',  '%'.$request->main_value.'%')
        ->orWhere('document_year', 'LIKE',  '%'.$request->main_value.'%')
        ->orWhere('document_class', 'LIKE',  '%'.$request->main_value.'%')
        ->orWhere('document_subject', 'LIKE',  '%'.$request->main_value.'%')->get();


        //dd($searchResult);

        $data = view('admin.post.searchResultNothiJatFdSix',compact('searchResult','dakId'))->render();


        return response()->json($data);

    }


    public function searchResultNothiJatFdSeven(Request $request){

        $dakId = $request->result;


        $searchResult = NothiList::where('document_branch', 'LIKE', '%'.$request->main_value.'%')
        ->orWhere('document_type_id', 'LIKE', '%'.$request->main_value.'%')
        ->orWhere('document_number', 'LIKE',  '%'.$request->main_value.'%')
        ->orWhere('document_year', 'LIKE',  '%'.$request->main_value.'%')
        ->orWhere('document_class', 'LIKE',  '%'.$request->main_value.'%')
        ->orWhere('document_subject', 'LIKE',  '%'.$request->main_value.'%')->get();


        //dd($searchResult);

        $data = view('admin.post.searchResultNothiJatFdSeven',compact('searchResult','dakId'))->render();


        return response()->json($data);

    }


    public function searchResultNothiJatFcOne(Request $request){

        $dakId = $request->result;


        $searchResult = NothiList::where('document_branch', 'LIKE', '%'.$request->main_value.'%')
        ->orWhere('document_type_id', 'LIKE', '%'.$request->main_value.'%')
        ->orWhere('document_number', 'LIKE',  '%'.$request->main_value.'%')
        ->orWhere('document_year', 'LIKE',  '%'.$request->main_value.'%')
        ->orWhere('document_class', 'LIKE',  '%'.$request->main_value.'%')
        ->orWhere('document_subject', 'LIKE',  '%'.$request->main_value.'%')->get();


        //dd($searchResult);

        $data = view('admin.post.searchResultNothiJatFcOne',compact('searchResult','dakId'))->render();


        return response()->json($data);

    }


    public function searchResultNothiJatFcTwo(Request $request){

        $dakId = $request->result;


        $searchResult = NothiList::where('document_branch', 'LIKE', '%'.$request->main_value.'%')
        ->orWhere('document_type_id', 'LIKE', '%'.$request->main_value.'%')
        ->orWhere('document_number', 'LIKE',  '%'.$request->main_value.'%')
        ->orWhere('document_year', 'LIKE',  '%'.$request->main_value.'%')
        ->orWhere('document_class', 'LIKE',  '%'.$request->main_value.'%')
        ->orWhere('document_subject', 'LIKE',  '%'.$request->main_value.'%')->get();


        //dd($searchResult);

        $data = view('admin.post.searchResultNothiJatFcTwo',compact('searchResult','dakId'))->render();


        return response()->json($data);

    }


    public function searchResultNothiJatFdThree(Request $request){

        $dakId = $request->result;


        $searchResult = NothiList::where('document_branch', 'LIKE', '%'.$request->main_value.'%')
        ->orWhere('document_type_id', 'LIKE', '%'.$request->main_value.'%')
        ->orWhere('document_number', 'LIKE',  '%'.$request->main_value.'%')
        ->orWhere('document_year', 'LIKE',  '%'.$request->main_value.'%')
        ->orWhere('document_class', 'LIKE',  '%'.$request->main_value.'%')
        ->orWhere('document_subject', 'LIKE',  '%'.$request->main_value.'%')->get();


        //dd($searchResult);

        $data = view('admin.post.searchResultNothiJatFdThree',compact('searchResult','dakId'))->render();


        return response()->json($data);

    }

    public function searchResultNothiJatDuplicateCertificate(Request $request){

        $dakId = $request->result;


        $searchResult = NothiList::where('document_branch', 'LIKE', '%'.$request->main_value.'%')
        ->orWhere('document_type_id', 'LIKE', '%'.$request->main_value.'%')
        ->orWhere('document_number', 'LIKE',  '%'.$request->main_value.'%')
        ->orWhere('document_year', 'LIKE',  '%'.$request->main_value.'%')
        ->orWhere('document_class', 'LIKE',  '%'.$request->main_value.'%')
        ->orWhere('document_subject', 'LIKE',  '%'.$request->main_value.'%')->get();


        //dd($searchResult);

        $data = view('admin.post.searchResultNothiJatDuplicateCertificate',compact('searchResult','dakId'))->render();


        return response()->json($data);

    }


    public function searchResultNothiJatConstitution(Request $request){

        $dakId = $request->result;


        $searchResult = NothiList::where('document_branch', 'LIKE', '%'.$request->main_value.'%')
        ->orWhere('document_type_id', 'LIKE', '%'.$request->main_value.'%')
        ->orWhere('document_number', 'LIKE',  '%'.$request->main_value.'%')
        ->orWhere('document_year', 'LIKE',  '%'.$request->main_value.'%')
        ->orWhere('document_class', 'LIKE',  '%'.$request->main_value.'%')
        ->orWhere('document_subject', 'LIKE',  '%'.$request->main_value.'%')->get();


        //dd($searchResult);

        $data = view('admin.post.searchResultNothiJatConstitution',compact('searchResult','dakId'))->render();


        return response()->json($data);

    }


    public function searchResultNothiJatCommittee(Request $request){

        $dakId = $request->result;


        $searchResult = NothiList::where('document_branch', 'LIKE', '%'.$request->main_value.'%')
        ->orWhere('document_type_id', 'LIKE', '%'.$request->main_value.'%')
        ->orWhere('document_number', 'LIKE',  '%'.$request->main_value.'%')
        ->orWhere('document_year', 'LIKE',  '%'.$request->main_value.'%')
        ->orWhere('document_class', 'LIKE',  '%'.$request->main_value.'%')
        ->orWhere('document_subject', 'LIKE',  '%'.$request->main_value.'%')->get();


        //dd($searchResult);

        $data = view('admin.post.searchResultNothiJatCommittee',compact('searchResult','dakId'))->render();


        return response()->json($data);

    }


    public function searchResultNothiJatFdFive(Request $request){


        $dakId = $request->result;


        $searchResult = NothiList::where('document_branch', 'LIKE', '%'.$request->main_value.'%')
        ->orWhere('document_type_id', 'LIKE', '%'.$request->main_value.'%')
        ->orWhere('document_number', 'LIKE',  '%'.$request->main_value.'%')
        ->orWhere('document_year', 'LIKE',  '%'.$request->main_value.'%')
        ->orWhere('document_class', 'LIKE',  '%'.$request->main_value.'%')
        ->orWhere('document_subject', 'LIKE',  '%'.$request->main_value.'%')->get();


        //dd($searchResult);

        $data = view('admin.post.searchResultNothiJatFdFive',compact('searchResult','dakId'))->render();


        return response()->json($data);
    }



    public function nothiJatDakList(){

        $nothiList = NothiList::latest()->get();

        $ngoStatusRenew = NgoRenewDak::where('nothi_jat_status',1)
        ->orWhere('receiver_admin_id',Auth::guard('admin')->user()->id)
        ->orWhere('sender_admin_id',Auth::guard('admin')->user()->id)
        ->latest()->get()->unique('renew_status_id');

        //dd($ngoStatusRenew);


        $ngoStatusNameChange = NgoNameChangeDak::where('nothi_jat_status',1)
        ->orWhere('receiver_admin_id',Auth::guard('admin')->user()->id)
    ->orWhere('sender_admin_id',Auth::guard('admin')->user()->id)
        ->latest()->get()->unique('name_change_status_id');


        $ngoStatusFDNineDak = NgoFDNineDak::where('nothi_jat_status',1)
        ->orWhere('receiver_admin_id',Auth::guard('admin')->user()->id)
        ->orWhere('sender_admin_id',Auth::guard('admin')->user()->id)
        ->latest()->get()->unique('f_d_nine_status_id');


        $ngoStatusFdSixDak = NgoFdSixDak::where('nothi_jat_status',1)
        ->orWhere('receiver_admin_id',Auth::guard('admin')->user()->id)
        ->orWhere('sender_admin_id',Auth::guard('admin')->user()->id)
        ->latest()->get()->unique('fd_six_status_id');




        $ngoStatusFdSevenDak = NgoFdSevenDak::where('nothi_jat_status',1)
        ->orWhere('receiver_admin_id',Auth::guard('admin')->user()->id)
    ->orWhere('sender_admin_id',Auth::guard('admin')->user()->id)
        ->latest()->get()->unique('fd_seven_status_id');


        $ngoStatusFcOneDak = FcOneDak::where('nothi_jat_status',1)
        ->orWhere('receiver_admin_id',Auth::guard('admin')->user()->id)
    ->orWhere('sender_admin_id',Auth::guard('admin')->user()->id)
        ->latest()->get()->unique('fc_one_status_id');

        $ngoStatusFcTwoDak = FcTwoDak::where('nothi_jat_status',1)
        ->orWhere('receiver_admin_id',Auth::guard('admin')->user()->id)
        ->orWhere('sender_admin_id',Auth::guard('admin')->user()->id)
        ->latest()->get()->unique('fc_two_status_id');

        $ngoStatusFdThreeDak = FdThreeDak::where('nothi_jat_status',1)
        ->orWhere('receiver_admin_id',Auth::guard('admin')->user()->id)
        ->orWhere('sender_admin_id',Auth::guard('admin')->user()->id)
        ->latest()->get()->unique('fd_three_status_id');


        $ngoStatusFDNineOneDak = NgoFDNineOneDak::where('nothi_jat_status',1)
        ->orWhere('receiver_admin_id',Auth::guard('admin')->user()->id)
    ->orWhere('sender_admin_id',Auth::guard('admin')->user()->id)
        ->latest()->get()->unique('f_d_nine_one_status_id');


    $ngoStatusReg = NgoRegistrationDak::where('nothi_jat_status',1)
    ->orWhere('receiver_admin_id',Auth::guard('admin')->user()->id)
    ->orWhere('sender_admin_id',Auth::guard('admin')->user()->id)
    ->latest()->get()->unique('registration_status_id');



    $ngoStatusDuplicateCertificate = DB::table('duplicate_certificate_daks')
    ->where('nothi_jat_status',1)
    ->orWhere('receiver_admin_id',Auth::guard('admin')->user()->id)
    ->orWhere('sender_admin_id',Auth::guard('admin')->user()->id)
    ->latest()->get()->unique('duplicate_certificate_id');


    $ngoStatusConstitution = DB::table('constitution_daks')->where('nothi_jat_status',1)
    ->orWhere('receiver_admin_id',Auth::guard('admin')->user()->id)
    ->orWhere('sender_admin_id',Auth::guard('admin')->user()->id)
    ->latest()->get()->unique('constitution_id');

    $ngoStatusExecutiveCommittee = DB::table('executive_committee_daks')->where('nothi_jat_status',1)
    ->orWhere('receiver_admin_id',Auth::guard('admin')->user()->id)
    ->orWhere('sender_admin_id',Auth::guard('admin')->user()->id)
    ->latest()->get()->unique('executive_committee_id');




    $ngoStatusFdFive = DB::table('fd_five_daks')->where('nothi_jat_status',1)
    ->orWhere('receiver_admin_id',Auth::guard('admin')->user()->id)
    ->orWhere('sender_admin_id',Auth::guard('admin')->user()->id)
    ->latest()->get()->unique('fd_five_status_id');



    $all_data_for_new_list = DB::table('ngo_statuses')->whereIn('status',['Ongoing','Old Ngo Renew'])->latest()->get();

    return view('admin.post.allDak.nothiJatDakList',compact('ngoStatusFdFive','ngoStatusDuplicateCertificate','ngoStatusConstitution','ngoStatusExecutiveCommittee','nothiList','ngoStatusFdThreeDak','ngoStatusFcTwoDak','ngoStatusFcOneDak','ngoStatusFdSevenDak','ngoStatusFdSixDak','ngoStatusFDNineOneDak','ngoStatusFDNineDak','ngoStatusNameChange','ngoStatusRenew','ngoStatusReg'));

    }
}
