<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Mpdf\Mpdf;
use DB;
use DateTime;
use DateTimezone;
use Image;
use Auth;
use Hash;
use PDF;
use File;
use Mail;
use App\Models\FormNoSevenDak;
use App\Models\ParentNoteForFormNoSeven;
use App\Models\FormNoSevenOfficeSarok;
use App\Models\ChildNoteForFormNoSeven;

use App\Models\FormNoFourDak;
use App\Models\ParentNoteForFormNoFour;
use App\Models\FormNoFourOfficeSarok;
use App\Models\ChildNoteForFormNoFour;

use App\Models\Fd4OneFormDak;
use App\Models\ParentNoteForFdFourOneForm;
use App\Models\FdFourOneFormOfficeSarok;
use App\Models\ChildNoteForFdFourOneForm;

use App\Models\FormNoFiveDak;
use App\Models\ParentNoteForFormNoFiveDak;
use App\Models\FormNoFiveOfficeSarok;
use App\Models\ChildNoteForFormNoFive;
use App\Models\ParentNoteForFcOne;
use App\Models\ParentNoteForFcTwo;
use App\Models\ParentNoteForFdNine;
use App\Models\ParentNoteForFdNineOne;
use App\Models\ParentNoteForFdSeven;
use App\Models\ParentNoteForFdsix;
use App\Models\ParentNoteForFdThree;
use App\Models\ParentNoteForFdFive;
use App\Models\FdFiveOfficeSarok;
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
use App\Models\ChildNoteForFdFive;
use App\Models\NothiList;
use App\Models\NothiPrapok;
use App\Models\NothiCopy;
use App\Models\NoteAttachment;
use App\Models\NothiFirstSenderList;
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
use App\Models\PotrangshoDraft;
use App\Models\DesignationList;
use App\Models\SealStatus;
use App\Models\DuplicateCertificateOfficeSarok;
use App\Models\ExecutiveCommitteeOfficeSarok;
use App\Models\ConstitutionOfficeSarok;
use App\Models\DuplicateCertificateDak;
use App\Models\ConstitutionDak;
use App\Models\ExecutiveCommitteeDak;
use App\Models\ParentNotForExecutiveCommittee;
use App\Models\ParentNoteForConstitution;
use App\Models\ParentNoteForDuplicateCertificate;
use App\Models\ChildNoteForConstitution;
use App\Models\ChildNoteForDuplicateCertificate;
use App\Models\ChildNoteForExecutiveCommittee;

class ChildNoteController extends Controller
{
	public function getdataforNothiList(Request $request){


        $nothiCopyListId=$request->getFinalValue;
        $eid=$request->eid;

        if($request->mmStatus == 'registration'){

            $childNoteNewList = DB::table('child_note_for_registrations')->where('id',$request->getFinalValue)->first();

        }elseif($request->mmStatus == 'renew'){

            $childNoteNewList = DB::table('child_note_for_renews')->where('id',$request->getFinalValue)->first();

        }elseif($request->mmStatus == 'nameChange'){

            $childNoteNewList = DB::table('child_note_for_name_changes')->where('id',$request->getFinalValue)->first();

        }elseif($request->mmStatus == 'fdNine'){

            $childNoteNewList = DB::table('child_note_for_fd_nines')->where('id',$request->getFinalValue)->first();

        }elseif($request->mmStatus == 'fdNineOne'){

            $childNoteNewList = DB::table('child_note_for_fd_nine_ones')->where('id',$request->getFinalValue)->first();

        }elseif($request->mmStatus == 'fdSix'){

            $childNoteNewList = DB::table('child_note_for_fd_sixes')->where('id',$request->getFinalValue)->first();

        }elseif($request->mmStatus == 'fdSeven'){

            $childNoteNewList = DB::table('child_note_for_fd_sevens')->where('id',$request->getFinalValue)->first();

        }elseif($request->mmStatus == 'fcOne'){

            $childNoteNewList = DB::table('child_note_for_fc_ones')->where('id',$request->getFinalValue)->first();

        }elseif($request->mmStatus == 'fcTwo'){

            $childNoteNewList = DB::table('child_note_for_fc_twos')->where('id',$request->getFinalValue)->first();

        }elseif($request->mmStatus == 'fdThree'){

            $childNoteNewList = DB::table('child_note_for_fd_threes')->where('id',$request->getFinalValue)->first();

        }elseif($request->mmStatus == 'fdFive'){

            $childNoteNewList = DB::table('child_note_for_fd_fives')->where('id',$request->getFinalValue)->first();

        }elseif($request->mmStatus == 'formNoFive'){

            $childNoteNewList = DB::table('child_note_for_form_no_fives')->where('id',$request->getFinalValue)->first();

        }elseif($request->mmStatus == 'formNoSeven'){

            $childNoteNewList = DB::table('child_note_for_form_no_sevens')->where('id',$request->getFinalValue)->first();

        }elseif($request->mmStatus == 'formNoFour'){

            $childNoteNewList = DB::table('child_note_for_form_no_fours')->where('id',$request->getFinalValue)->first();

        }elseif($request->mmStatus == 'fdFourOneForm'){

            $childNoteNewList = DB::table('child_note_for_fd_four_one_forms')->where('id',$request->getFinalValue)->first();

        }elseif($request->mmStatus == 'duplicate'){

            $childNoteNewList = DB::table('child_note_for_duplicate_certificates')->where('id',$request->getFinalValue)->first();

        }elseif($request->mmStatus == 'constitution'){

            $childNoteNewList = DB::table('child_note_for_constitutions') ->where('id',$request->getFinalValue)->first();

        }elseif($request->mmStatus == 'committee'){

            $childNoteNewList = DB::table('child_note_for_executive_committees')->where('id',$request->getFinalValue)->first();

        }

        $data = view('admin.presentDocument.getdataforTest',compact('eid','nothiCopyListId','childNoteNewList'))->render();
            return response()->json(['data'=>$data]);

    }


    public function deleteAttachment($id){

        try{

            $dataDelete = NoteAttachment::where('id',$id)->delete();

            return redirect()->back()->with('error','সফলভে মুছে ফেল হয়েছে ');

        } catch (\Exception $e) {

             return redirect()->route('error_404')->with('error','some thing went wrong ');
        }

    }


    public function deleteAllParagraph($id,$status){

        try{

        if($status == 'registration'){

            $childNoteNewList = DB::table('child_note_for_registrations')->where('id',$id)->delete();

        }elseif($status == 'renew'){

            $childNoteNewList = DB::table('child_note_for_renews')->where('id',$id)->delete();

        }elseif($status == 'nameChange'){

            $childNoteNewList = DB::table('child_note_for_name_changes')->where('id',$id)->delete();

        }elseif($status == 'fdNine'){

            $childNoteNewList = DB::table('child_note_for_fd_nines')->where('id',$id)->delete();

        }elseif($status == 'fdNineOne'){

            $childNoteNewList = DB::table('child_note_for_fd_nine_ones')->where('id',$id)->delete();

        }elseif($status == 'fdSix'){

            $childNoteNewList = DB::table('child_note_for_fd_sixes')->where('id',$id)->delete();

        }elseif($status == 'fdSeven'){

            $childNoteNewList = DB::table('child_note_for_fd_sevens')->where('id',$id)->delete();

        }elseif($status == 'fcOne'){

            $childNoteNewList = DB::table('child_note_for_fc_ones')->where('id',$id)->delete();

        }elseif($status == 'fcTwo'){

            $childNoteNewList = DB::table('child_note_for_fc_twos') ->where('id',$id)->delete();

        }elseif($status == 'fdThree'){

            $childNoteNewList = DB::table('child_note_for_fd_threes')->where('id',$id)->delete();

        }elseif($status == 'fdFive'){

            $childNoteNewList = DB::table('child_note_for_fd_fives')->where('id',$id)->delete();

        }elseif($status == 'formNoFive'){

            $childNoteNewList = DB::table('child_note_for_form_no_fives')->where('id',$id)->delete();

        }elseif($status == 'formNoSeven'){

            $childNoteNewList = DB::table('child_note_for_form_no_sevens')->where('id',$id)->delete();

        }elseif($status == 'formNoFour'){

            $childNoteNewList = DB::table('child_note_for_form_no_fours')->where('id',$id)->delete();

        }elseif($status == 'fdFourOneForm'){

            $childNoteNewList = DB::table('child_note_for_fd_four_one_forms')->where('id',$id)->delete();

        }elseif($status == 'duplicate'){

            $childNoteNewList = DB::table('child_note_for_duplicate_certificates')->where('id',$id)->delete();

        }elseif($status == 'constitution'){

            $childNoteNewList = DB::table('child_note_for_constitutions')->where('id',$id)->delete();

        }elseif($status == 'committee'){

            $childNoteNewList = DB::table('child_note_for_executive_committees')->where('id',$id)->delete();

        }

            return redirect()->back()->with('error','সফলভাবে ুছ ফেলা হয়ছে');

        } catch (\Exception $e) {
             return redirect()->route('error_404')->with('error','some thing went wrong ');
        }
    }


    public function printPotrangsoPdfForEmail($status,$parentId,$nothiId,$id){

        try{
        if($status == 'registration'){

            $officeDetail = RegistrationOfficeSarok::where('parent_note_regid',$id)->get();
            $checkParent = ParentNoteForRegistration::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

        }elseif($status == 'renew'){

            $officeDetail = RenewOfficeSarok::where('parent_note_for_renew_id',$id)->get();
            $checkParent = ParentNoteForRenew::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

        }elseif($status == 'nameChange'){

            $officeDetail = NameChangeOfficeSarok::where('parentnote_name_change_id',$id)->get();
            $checkParent = ParentNoteForNameChange::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

        }elseif($status == 'fdNine'){

            $officeDetail = FdNineOfficeSarok::where('p_note_for_fd_nine_id',$id)->get();
            $checkParent = ParentNoteForFdNine::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

        }elseif($status == 'fdNineOne'){

            $officeDetail = FdNineOneOfficeSarok::where('p_note_for_fd_nine_one_id',$id)->get();
            $checkParent = ParentNoteForFdNineOne::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

        }elseif($status == 'fdSix'){

            $officeDetail = FdSixOfficeSarok::where('parent_note_for_fdsix_id',$id)->get();
            $checkParent = ParentNoteForFdsix::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

        }elseif($status == 'fdSeven'){

            $officeDetail = FdSevenOfficeSarok::where('parent_note_for_fd_seven_id',$id)->get();
            $checkParent = ParentNoteForFdSeven::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

        }elseif($status == 'fcOne'){

            $officeDetail = FcOneOfficeSarok::where('parent_note_for_fc_one_id',$id)->get();
            $checkParent = ParentNoteForFcOne::where('nothi_detail_id',$parentId)->get();

        }elseif($status == 'fcTwo'){

            $officeDetail = FcTwoOfficeSarok::where('parent_note_for_fc_two_id',$id)->get();
            $checkParent = ParentNoteForFcTwo::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

        }elseif($status == 'fdThree'){

            $officeDetail = FdThreeOfficeSarok::where('parent_note_for_fd_three_id',$id)->get();
            $checkParent = ParentNoteForFdThree::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

        }elseif($status == 'fdFive'){

            $officeDetail = FdFiveOfficeSarok::where('pnote_fd_five',$id)->get();
            $checkParent = ParentNoteForFdFive::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

        }elseif($status == 'formNoFive'){

            $officeDetail = FormNoFiveOfficeSarok::where('pnote_form_no_five',$id)->get();
            $checkParent = ParentNoteForFormNoFiveDak::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

        }elseif($status == 'formNoSeven'){

            $officeDetail = FormNoSevenOfficeSarok::where('pnote_form_no_seven',$id)->get();
            $checkParent = ParentNoteForFormNoSeven::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

        }elseif($status == 'formNoFour'){

                $officeDetail = FormNoFourOfficeSarok::where('pnote_form_no_four',$id)->get();
                $checkParent = ParentNoteForFormNoFour::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

        }elseif($status == 'fdFourOneForm'){

            $officeDetail = FdFourOneFormOfficeSarok::where('pnote_fd_four_one_form',$id)->get();
            $checkParent = ParentNoteForFdFourOneForm::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

        }elseif($status == 'duplicate'){

            $officeDetail = DuplicateCertificateOfficeSarok::where('pnote_dupid',$id)->get();
            $checkParent = ParentNoteForDuplicateCertificate::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

        }elseif($status == 'constitution'){

            $officeDetail = ConstitutionOfficeSarok::where('pnote_conid',$id)->get();
            $checkParent = ParentNoteForConstitution::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

        }elseif($status == 'committee'){

            $officeDetail = ExecutiveCommitteeOfficeSarok::where('pnote_exeid',$id)->get();
            $checkParent = ParentNotForExecutiveCommittee::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

        }


        $nothiNumber = NothiList::where('id',$nothiId)->value('main_sarok_number');
        $nothiYear = NothiList::where('id',$nothiId)->value('document_year');
        $user = Admin::where('id','!=',1)->get();

        $nothiPropokListUpdate = NothiPrapok::
        where('nothiId',$nothiId)
        ->where('noteId',$id)->where('status',1)->get();
        $nothiAttractListUpdate = NothiAttarct::where('nothiId',$nothiId)
        ->where('noteId',$id)->where('status',1)->get();
        $nothiCopyListUpdate = NothiCopy::where('nothiId',$nothiId)
        ->where('noteId',$id)->where('status',1)->get();

        $permissionNothiList = NothiPermission::where('nothId',$nothiId)->get();

        $convert_name_title = $permissionNothiList->implode("branchId", " ");
        $separated_data_title = explode(" ", $convert_name_title);

        $branchListForSerial = Branch::whereIn('id',$separated_data_title)
        ->orderBy('branch_step','asc')->get();

        $sarokCode = 1;


        $data = view('admin.presentDocument.printPotrangso',['nothiYear'=>$nothiYear,'sarokCode'=>$sarokCode,'parentId'=>$parentId,'id'=>$id,'status'=>$status,'checkParent'=>$checkParent,'officeDetail'=>$officeDetail,'nothiNumber'=>$nothiNumber,'nothiId'=>$nothiId,'user'=>$user,'nothiPropokListUpdate'=>$nothiPropokListUpdate,'nothiAttractListUpdate'=>$nothiAttractListUpdate,'branchListForSerial'=>$branchListForSerial,'permissionNothiList'=>$permissionNothiList,'nothiCopyListUpdate'=>$nothiCopyListUpdate])->render();

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


    public function printPotrangso($status,$parentId,$nothiId,$id,$sarokCode){

        try{
            if($status == 'registration'){

                $officeDetail = RegistrationOfficeSarok::where('parent_note_regid',$id)->get();
                $checkParent = ParentNoteForRegistration::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

            }elseif($status == 'renew'){

                $officeDetail = RenewOfficeSarok::where('parent_note_for_renew_id',$id)->get();
                $checkParent = ParentNoteForRenew::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

            }elseif($status == 'nameChange'){

                $officeDetail = NameChangeOfficeSarok::where('parentnote_name_change_id',$id)->get();
                $checkParent = ParentNoteForNameChange::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

            }elseif($status == 'fdNine'){

                $officeDetail = FdNineOfficeSarok::where('p_note_for_fd_nine_id',$id)->get();
                $checkParent = ParentNoteForFdNine::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

            }elseif($status == 'fdNineOne'){

                $officeDetail = FdNineOneOfficeSarok::where('p_note_for_fd_nine_one_id',$id)->get();
                $checkParent = ParentNoteForFdNineOne::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

            }elseif($status == 'fdSix'){

                $officeDetail = FdSixOfficeSarok::where('parent_note_for_fdsix_id',$id)->get();
                $checkParent = ParentNoteForFdsix::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

            }elseif($status == 'fdSeven'){

                $officeDetail = FdSevenOfficeSarok::where('parent_note_for_fd_seven_id',$id)->get();
                $checkParent = ParentNoteForFdSeven::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

            }elseif($status == 'fcOne'){

                $officeDetail = FcOneOfficeSarok::where('parent_note_for_fc_one_id',$id)->get();
                $checkParent = ParentNoteForFcOne::where('nothi_detail_id',$parentId)->get();

            }elseif($status == 'fcTwo'){

                $officeDetail = FcTwoOfficeSarok::where('parent_note_for_fc_two_id',$id)->get();
                $checkParent = ParentNoteForFcTwo::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

            }elseif($status == 'fdThree'){

                $officeDetail = FdThreeOfficeSarok::where('parent_note_for_fd_three_id',$id)->get();
                $checkParent = ParentNoteForFdThree::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

            }elseif($status == 'fdFive'){

                $officeDetail = FdFiveOfficeSarok::where('pnote_fd_five',$id)->get();
                $checkParent = ParentNoteForFdFive::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

            }elseif($status == 'formNoFive'){

                $officeDetail = FormNoFiveOfficeSarok::where('pnote_form_no_five',$id)->get();
                $checkParent = ParentNoteForFormNoFiveDak::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

            }elseif($status == 'formNoSeven'){

                $officeDetail = FormNoSevenOfficeSarok::where('pnote_form_no_seven',$id)->get();
                $checkParent = ParentNoteForFormNoSeven::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

            }elseif($status == 'formNoFour'){

                $officeDetail = FormNoFourOfficeSarok::where('pnote_form_no_four',$id)->get();
                $checkParent = ParentNoteForFormNoFour::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

        }elseif($status == 'fdFourOneForm'){

            $officeDetail = FdFourOneFormOfficeSarok::where('pnote_fd_four_one_form',$id)->get();
            $checkParent = ParentNoteForFdFourOneForm::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

        }elseif($status == 'duplicate'){

                $officeDetail = DuplicateCertificateOfficeSarok::where('pnote_dupid',$id)->get();
                $checkParent = ParentNoteForDuplicateCertificate::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

            }elseif($status == 'constitution'){

                $officeDetail = ConstitutionOfficeSarok::where('pnote_conid',$id)->get();
                $checkParent = ParentNoteForConstitution::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

            }elseif($status == 'committee'){

                $officeDetail = ExecutiveCommitteeOfficeSarok::where('pnote_exeid',$id)->get();
                $checkParent = ParentNotForExecutiveCommittee::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

            }


        $nothiNumber = NothiList::where('id',$nothiId)->value('main_sarok_number');
        $nothiYear = NothiList::where('id',$nothiId)->value('document_year');
        $user = Admin::where('id','!=',1)->get();

        $nothiPropokListUpdate = NothiPrapok::
        where('nothiId',$nothiId)
        ->where('noteId',$id)->where('status',1)->get();
        $nothiAttractListUpdate = NothiAttarct::where('nothiId',$nothiId)
        ->where('noteId',$id)->where('status',1)->get();
        $nothiCopyListUpdate = NothiCopy::where('nothiId',$nothiId)
        ->where('noteId',$id)->where('status',1)->get();

        $permissionNothiList = NothiPermission::where('nothId',$nothiId)->get();

        $convert_name_title = $permissionNothiList->implode("branchId", " ");
        $separated_data_title = explode(" ", $convert_name_title);

        $branchListForSerial = Branch::whereIn('id',$separated_data_title)->orderBy('branch_step','asc')->get();

        $data = view('admin.presentDocument.printPotrangso',['nothiYear'=>$nothiYear,'sarokCode'=>$sarokCode,'parentId'=>$parentId,'id'=>$id,'status'=>$status,'checkParent'=>$checkParent,'officeDetail'=>$officeDetail,'nothiNumber'=>$nothiNumber,'nothiId'=>$nothiId,'user'=>$user,'nothiPropokListUpdate'=>$nothiPropokListUpdate,'nothiAttractListUpdate'=>$nothiAttractListUpdate,'branchListForSerial'=>$branchListForSerial,'permissionNothiList'=>$permissionNothiList,'nothiCopyListUpdate'=>$nothiCopyListUpdate])->render();

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


    public function addChildNoteFromView($status,$parentId,$nothiId,$id,$activeCode){

        try{

            if($status == 'registration'){

                $officeDetail = RegistrationOfficeSarok::where('parent_note_regid',$id)->get();
                $checkParent = ParentNoteForRegistration::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

            }elseif($status == 'renew'){

                $officeDetail = RenewOfficeSarok::where('parent_note_for_renew_id',$id)->get();
                $checkParent = ParentNoteForRenew::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

            }elseif($status == 'nameChange'){

                $officeDetail = NameChangeOfficeSarok::where('parentnote_name_change_id',$id)->get();
                $checkParent = ParentNoteForNameChange::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

            }elseif($status == 'fdNine'){

                $officeDetail = FdNineOfficeSarok::where('p_note_for_fd_nine_id',$id)->get();
                $checkParent = ParentNoteForFdNine::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

            }elseif($status == 'fdNineOne'){

                $officeDetail = FdNineOneOfficeSarok::where('p_note_for_fd_nine_one_id',$id)->get();
                $checkParent = ParentNoteForFdNineOne::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

            }elseif($status == 'fdSix'){

                $officeDetail = FdSixOfficeSarok::where('parent_note_for_fdsix_id',$id)->get();
                $checkParent = ParentNoteForFdsix::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

            }elseif($status == 'fdSeven'){

                $officeDetail = FdSevenOfficeSarok::where('parent_note_for_fd_seven_id',$id)->get();
                $checkParent = ParentNoteForFdSeven::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

            }elseif($status == 'fcOne'){

                $officeDetail = FcOneOfficeSarok::where('parent_note_for_fc_one_id',$id)->get();
                $checkParent = ParentNoteForFcOne::where('nothi_detail_id',$parentId)>get();

            }elseif($status == 'fcTwo'){

                $officeDetail = FcTwoOfficeSarok::where('parent_note_for_fc_two_id',$id)->get();
                $checkParent = ParentNoteForFcTwo::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

            }elseif($status == 'fdThree'){

                $officeDetail = FdThreeOfficeSarok::where('parent_note_for_fd_three_id',$id)->get();
                $checkParent = ParentNoteForFdThree::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

            }elseif($status == 'fdFive'){

                $officeDetail = FdFiveOfficeSarok::where('pnote_fd_five',$id)->get();
                $checkParent = ParentNoteForFdFive::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

            }elseif($status == 'formNoFive'){

                $officeDetail = FormNoFiveOfficeSarok::where('pnote_form_no_five',$id)->get();
                $checkParent = ParentNoteForFormNoFiveDak::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

            }elseif($status == 'formNoSeven'){

                $officeDetail = FormNoSevenOfficeSarok::where('pnote_form_no_seven',$id)->get();
                $checkParent = ParentNoteForFormNoSeven::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

            }elseif($status == 'formNoFour'){

                $officeDetail = FormNoFourOfficeSarok::where('pnote_form_no_four',$id)->get();
                $checkParent = ParentNoteForFormNoFour::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

        }elseif($status == 'fdFourOneForm'){

            $officeDetail = FdFourOneFormOfficeSarok::where('pnote_fd_four_one_form',$id)->get();
            $checkParent = ParentNoteForFdFourOneForm::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

        }elseif($status == 'duplicate'){

                $officeDetail = DuplicateCertificateOfficeSarok::where('pnote_dupid',$id)->get();
                $checkParent = ParentNoteForDuplicateCertificate::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId) ->get();

            }elseif($status == 'constitution'){

                $officeDetail = ConstitutionOfficeSarok::where('pnote_conid',$id)->get();
                $checkParent = ParentNoteForConstitution::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

            }elseif($status == 'committee'){

                $officeDetail = ExecutiveCommitteeOfficeSarok::where('pnote_exeid',$id)->get();
                $checkParent = ParentNotForExecutiveCommittee::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

            }


        $nothiNumber = NothiList::where('id',$nothiId)->value('main_sarok_number');
        $nothiYear = NothiList::where('id',$nothiId)->value('document_year');
        $user = Admin::where('id','!=',1)->get();


        $nothiPropokListUpdate = NothiPrapok::where('nothiId',$nothiId)
        ->where('noteId',$id)->where('status',1)->get();
        $nothiAttractListUpdate = NothiAttarct::where('nothiId',$nothiId)
        ->where('noteId',$id)->where('status',1)->get();
        $nothiCopyListUpdate = NothiCopy::where('nothiId',$nothiId)
        ->where('noteId',$id)->where('status',1)->get();

        $permissionNothiList = NothiPermission::where('nothId',$nothiId)->get();

        $convert_name_title = $permissionNothiList->implode("branchId", " ");
        $separated_data_title = explode(" ", $convert_name_title);

        $branchListForSerial = Branch::whereIn('id',$separated_data_title)->orderBy('branch_step','asc')->get();

        return view('admin.presentDocument.addParentNoteFromView',compact('nothiYear','branchListForSerial','permissionNothiList','nothiCopyListUpdate','nothiAttractListUpdate','nothiPropokListUpdate','user','nothiId','nothiNumber','officeDetail','checkParent','status','id','parentId','activeCode'));

        } catch (\Exception $e) {
             return redirect()->route('error_404')->with('error','some thing went wrong ');
        }
    }




    public function printAllParagraph($status,$parentId,$nothiId,$id){

        try{


        if($status == 'registration'){

                $checkParentFirst = DB::table('parent_note_for_registrations')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
                $childNoteNewList = DB::table('child_note_for_registrations')->where('parent_note_regid',$id)->get();
                $childNoteNewListValue = DB::table('child_note_for_registrations')->where('parent_note_regid',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }elseif($status == 'renew'){

                $checkParentFirst = DB::table('parent_note_for_renews')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
                $childNoteNewList = DB::table('child_note_for_renews')->where('parent_note_for_renew_id',$id)->get();
                $childNoteNewListValue = DB::table('child_note_for_renews')->where('parent_note_for_renew_id',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }elseif($status == 'nameChange'){

                $checkParentFirst = DB::table('parent_note_for_name_changes')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
                $childNoteNewList = DB::table('child_note_for_name_changes')->where('parentnote_name_change_id',$id)->get();
                $childNoteNewListValue = DB::table('child_note_for_name_changes')->where('parentnote_name_change_id',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }elseif($status == 'fdNine'){

                $checkParentFirst = DB::table('parent_note_for_fd_nines')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
                $childNoteNewList = DB::table('child_note_for_fd_nines')->where('p_note_for_fd_nine_id',$id)->get();
                $childNoteNewListValue = DB::table('child_note_for_fd_nines')->where('p_note_for_fd_nine_id',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }elseif($status == 'fdNineOne'){

                $checkParentFirst = DB::table('parent_note_for_fd_nine_ones')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
                $childNoteNewList = DB::table('child_note_for_fd_nine_ones')->where('p_note_for_fd_nine_one_id',$id)->get();
                $childNoteNewListValue = DB::table('child_note_for_fd_nine_ones')->where('p_note_for_fd_nine_one_id',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }elseif($status == 'fdSix'){

                $checkParentFirst = DB::table('parent_note_for_fdsixes')->where('nothi_detail_id',$parentId) ->where('serial_number',$nothiId)->where('id',$id)->first();
                $childNoteNewList = DB::table('child_note_for_fd_sixes')->where('parent_note_for_fdsix_id',$id)->get();
                $childNoteNewListValue = DB::table('child_note_for_fd_sixes')->where('parent_note_for_fdsix_id',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }elseif($status == 'fdSeven'){

                $checkParentFirst = DB::table('parent_note_for_fd_sevens')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
                $childNoteNewList = DB::table('child_note_for_fd_sevens')->where('parent_note_for_fd_seven_id',$id)->get();
                $childNoteNewListValue = DB::table('child_note_for_fd_sevens')->where('parent_note_for_fd_seven_id',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }elseif($status == 'fcOne'){

                $checkParentFirst = DB::table('parent_note_for_fc_ones')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
                $childNoteNewList = DB::table('child_note_for_fc_ones')->where('parent_note_for_fc_one_id',$id)->get();
                $childNoteNewListValue = DB::table('child_note_for_fc_ones')->where('parent_note_for_fc_one_id',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }elseif($status == 'fcTwo'){

                $checkParentFirst = DB::table('parent_note_for_fc_twos')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
                $childNoteNewList = DB::table('child_note_for_fc_twos')->where('parent_note_for_fc_two_id',$id)->get();
                $childNoteNewListValue = DB::table('child_note_for_fc_twos')->where('parent_note_for_fc_two_id',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }elseif($status == 'fdThree'){

                $checkParentFirst = DB::table('parent_note_for_fd_threes')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
                $childNoteNewList = DB::table('child_note_for_fd_threes')->where('parent_note_for_fd_three_id',$id)->get();
                $childNoteNewListValue = DB::table('child_note_for_fd_threes')->where('parent_note_for_fd_three_id',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }elseif($status == 'fdFive'){

                $checkParentFirst = DB::table('parent_note_for_fd_fives')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
                $childNoteNewList = DB::table('child_note_for_fd_fives')->where('pnote_fd_five',$id)->get();
                $childNoteNewListValue = DB::table('child_note_for_fd_fives')->where('pnote_fd_five',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }elseif($status == 'formNoFive'){

            $checkParentFirst = DB::table('parent_note_for_form_no_five_daks')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
            $childNoteNewList = DB::table('child_note_for_form_no_fives')->where('pnote_form_no_five',$id)->get();
            $childNoteNewListValue = DB::table('child_note_for_form_no_fives')->where('pnote_form_no_five',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

    }elseif($status == 'formNoSeven'){

        $checkParentFirst = DB::table('parent_note_for_form_no_sevens')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
        $childNoteNewList = DB::table('child_note_for_form_no_sevens')->where('pnote_form_no_seven',$id)->get();
        $childNoteNewListValue = DB::table('child_note_for_form_no_sevens')->where('pnote_form_no_seven',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

}elseif($status == 'formNoFour'){

    $checkParentFirst = DB::table('parent_note_for_form_no_fours')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
    $childNoteNewList = DB::table('child_note_for_form_no_fours')->where('pnote_form_no_four',$id)->get();
    $childNoteNewListValue = DB::table('child_note_for_form_no_fours')->where('pnote_form_no_four',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

}elseif($status == 'fdFourOneForm'){

    $checkParentFirst = DB::table('parent_note_for_fd_four_one_forms')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
    $childNoteNewList = DB::table('child_note_for_fd_four_one_forms')->where('pnote_fd_four_one_form',$id)->get();
    $childNoteNewListValue = DB::table('child_note_for_fd_four_one_forms')->where('pnote_fd_four_one_form',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

}elseif($status == 'duplicate'){

                $checkParentFirst = DB::table('parent_note_for_duplicate_certificates')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
                $childNoteNewList = DB::table('child_note_for_duplicate_certificates')->where('pnote_dupid',$id)->get();
                $childNoteNewListValue = DB::table('child_note_for_duplicate_certificates')->where('pnote_dupid',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }elseif($status == 'constitution'){

                $checkParentFirst = DB::table('parent_note_for_constitutions')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
                $childNoteNewList = DB::table('child_note_for_constitutions')->where('pnote_conid',$id)->get();
                $childNoteNewListValue = DB::table('child_note_for_constitutions')->where('pnote_conid',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }elseif($status == 'committee'){

                $checkParentFirst = DB::table('parent_not_for_executive_committees')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
                $childNoteNewList = DB::table('child_note_for_executive_committees')->where('pnote_exeid',$id)->get();
                $childNoteNewListValue = DB::table('child_note_for_executive_committees')->where('pnote_exeid',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }

        $sarokCode = 1;
        $data = view('admin.presentDocument.printAllParagraph',compact(
            'childNoteNewListValue',
            'childNoteNewList',
            'checkParentFirst',
            'nothiId',
            'status',
            'id',
            'parentId',

        ));

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


    public function printAllParagraphFromSend($status,$parentId,$nothiId,$id){


    try{


        if($status == 'registration'){

            $checkParentFirst = DB::table('parent_note_for_registrations')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
            $childNoteNewList = DB::table('child_note_for_registrations')->where('parent_note_regid',$id)->get();
            $childNoteNewListValue = DB::table('child_note_for_registrations')->where('parent_note_regid',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }elseif($status == 'renew'){

            $checkParentFirst = DB::table('parent_note_for_renews')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
            $childNoteNewList = DB::table('child_note_for_renews')->where('parent_note_for_renew_id',$id)->get();
            $childNoteNewListValue = DB::table('child_note_for_renews')->where('parent_note_for_renew_id',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }elseif($status == 'nameChange'){

            $checkParentFirst = DB::table('parent_note_for_name_changes')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
            $childNoteNewList = DB::table('child_note_for_name_changes')->where('parentnote_name_change_id',$id)->get();
            $childNoteNewListValue = DB::table('child_note_for_name_changes')->where('parentnote_name_change_id',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }elseif($status == 'fdNine'){

            $checkParentFirst = DB::table('parent_note_for_fd_nines')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)>where('id',$id)->first();
            $childNoteNewList = DB::table('child_note_for_fd_nines')->where('p_note_for_fd_nine_id',$id)->get();
            $childNoteNewListValue = DB::table('child_note_for_fd_nines')->where('p_note_for_fd_nine_id',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }elseif($status == 'fdNineOne'){

            $checkParentFirst = DB::table('parent_note_for_fd_nine_ones')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
            $childNoteNewList = DB::table('child_note_for_fd_nine_ones')->where('p_note_for_fd_nine_one_id',$id)->get();
            $childNoteNewListValue = DB::table('child_note_for_fd_nine_ones')->where('p_note_for_fd_nine_one_id',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }elseif($status == 'fdSix'){

            $checkParentFirst = DB::table('parent_note_for_fdsixes')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
            $childNoteNewList = DB::table('child_note_for_fd_sixes')->where('parent_note_for_fdsix_id',$id)->get();
            $childNoteNewListValue = DB::table('child_note_for_fd_sixes')->where('parent_note_for_fdsix_id',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }elseif($status == 'fdSeven'){

            $checkParentFirst = DB::table('parent_note_for_fd_sevens')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
            $childNoteNewList = DB::table('child_note_for_fd_sevens') ->where('parent_note_for_fd_seven_id',$id)->get();
            $childNoteNewListValue = DB::table('child_note_for_fd_sevens') ->where('parent_note_for_fd_seven_id',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }elseif($status == 'fcOne'){

            $checkParentFirst = DB::table('parent_note_for_fc_ones')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
            $childNoteNewList = DB::table('child_note_for_fc_ones')->where('parent_note_for_fc_one_id',$id)->get();
            $childNoteNewListValue = DB::table('child_note_for_fc_ones')->where('parent_note_for_fc_one_id',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');


        }elseif($status == 'fcTwo'){

            $checkParentFirst = DB::table('parent_note_for_fc_twos')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
            $childNoteNewList = DB::table('child_note_for_fc_twos')->where('parent_note_for_fc_two_id',$id)->get();
            $childNoteNewListValue = DB::table('child_note_for_fc_twos') ->where('parent_note_for_fc_two_id',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }elseif($status == 'fdThree'){

            $checkParentFirst = DB::table('parent_note_for_fd_threes')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
            $childNoteNewList = DB::table('child_note_for_fd_threes')->where('parent_note_for_fd_three_id',$id)->get();
            $childNoteNewListValue = DB::table('child_note_for_fd_threes')->where('parent_note_for_fd_three_id',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }elseif($status == 'fdFive'){

            $checkParentFirst = DB::table('parent_note_for_fd_fives')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
            $childNoteNewList = DB::table('child_note_for_fd_fives')->where('pnote_fd_five',$id)->get();
            $childNoteNewListValue = DB::table('child_note_for_fd_fives')->where('pnote_fd_five',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        } elseif($status == 'formNoFive'){

            $checkParentFirst = DB::table('parent_note_for_form_no_five_daks')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
            $childNoteNewList = DB::table('child_note_for_form_no_fives')->where('pnote_form_no_five',$id)->get();
            $childNoteNewListValue = DB::table('child_note_for_form_no_fives')->where('pnote_form_no_five',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

    }elseif($status == 'formNoSeven'){

        $checkParentFirst = DB::table('parent_note_for_form_no_sevens')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
        $childNoteNewList = DB::table('child_note_for_form_no_sevens')->where('pnote_form_no_seven',$id)->get();
        $childNoteNewListValue = DB::table('child_note_for_form_no_sevens')->where('pnote_form_no_seven',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

}elseif($status == 'formNoFour'){

    $checkParentFirst = DB::table('parent_note_for_form_no_fours')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
    $childNoteNewList = DB::table('child_note_for_form_no_fours')->where('pnote_form_no_four',$id)->get();
    $childNoteNewListValue = DB::table('child_note_for_form_no_fours')->where('pnote_form_no_four',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

}elseif($status == 'fdFourOneForm'){

    $checkParentFirst = DB::table('parent_note_for_fd_four_one_forms')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
    $childNoteNewList = DB::table('child_note_for_fd_four_one_forms')->where('pnote_fd_four_one_form',$id)->get();
    $childNoteNewListValue = DB::table('child_note_for_fd_four_one_forms')->where('pnote_fd_four_one_form',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

}elseif($status == 'duplicate'){

            $checkParentFirst = DB::table('parent_note_for_duplicate_certificates')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
            $childNoteNewList = DB::table('child_note_for_duplicate_certificates') ->where('pnote_dupid',$id)->get();
            $childNoteNewListValue = DB::table('child_note_for_duplicate_certificates')->where('pnote_dupid',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }elseif($status == 'constitution'){

            $checkParentFirst = DB::table('parent_note_for_constitutions')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id) ->first();
            $childNoteNewList = DB::table('child_note_for_constitutions')->where('pnote_conid',$id)->get();
            $childNoteNewListValue = DB::table('child_note_for_constitutions') ->where('pnote_conid',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }elseif($status == 'committee'){

            $checkParentFirst = DB::table('parent_not_for_executive_committees')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
            $childNoteNewList = DB::table('child_note_for_executive_committees')->where('pnote_exeid',$id)->get();
            $childNoteNewListValue = DB::table('child_note_for_executive_committees')->where('pnote_exeid',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }

        $data = view('admin.presentDocument.printAllParagraphSend',compact(
            'childNoteNewListValue',
            'childNoteNewList',
            'checkParentFirst',
            'nothiId',
            'status',
            'id',
            'parentId',

        ));

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



    public function printParagraphViewSingle($status,$parentId,$nothiId,$id,$childIdNew){

        try{

            $nothiNumber = NothiList::where('id',$nothiId)->value('main_sarok_number');
            $nothiYear = NothiList::where('id',$nothiId)->value('document_year');
            $user = Admin::where('id','!=',1)->get();

            $nothiPropokListUpdate = NothiPrapok::where('nothiId',$nothiId)
            ->where('noteId',$id)->where('status',1)->get();
            $nothiAttractListUpdate = NothiAttarct::where('nothiId',$nothiId)
            ->where('noteId',$id)->where('status',1)->get();
            $nothiCopyListUpdate = NothiCopy::where('nothiId',$nothiId)
            ->where('noteId',$id)->where('status',1)->get();

            $permissionNothiList = NothiPermission::where('nothId',$nothiId)->get();

            $convert_name_title = $permissionNothiList->implode("designationId", " ");
            $separated_data_title = explode(" ", $convert_name_title);

            $branchListForSerial = DesignationList::whereIn('id',$separated_data_title)->orderBy('designation_serial','asc')->get();

            if($status == 'registration'){

                $checkParentFirst = DB::table('parent_note_for_registrations')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
                $childNoteNewList = DB::table('child_note_for_registrations')->where('id',$childIdNew)->where('parent_note_regid',$id)->get();
                $childNoteNewListValue = DB::table('child_note_for_registrations')->where('parent_note_regid',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

            }elseif($status == 'renew'){

                $checkParentFirst = DB::table('parent_note_for_renews')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId) ->where('id',$id)->first();
                $childNoteNewList = DB::table('child_note_for_renews')->where('id',$childIdNew)->where('parent_note_for_renew_id',$id)->get();
                $childNoteNewListValue = DB::table('child_note_for_renews')->where('parent_note_for_renew_id',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

            }elseif($status == 'nameChange'){

                $checkParentFirst = DB::table('parent_note_for_name_changes')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$childIdNew)->where('id',$id)->first();
                $childNoteNewList = DB::table('child_note_for_name_changes')->where('id',$childIdNew)->where('parentnote_name_change_id',$id)->get();
                $childNoteNewListValue = DB::table('child_note_for_name_changes')->where('parentnote_name_change_id',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

            }elseif($status == 'fdNine'){

                $checkParentFirst = DB::table('parent_note_for_fd_nines')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
                $childNoteNewList = DB::table('child_note_for_fd_nines')->where('id',$childIdNew)->where('p_note_for_fd_nine_id',$id)->get();
                $childNoteNewListValue = DB::table('child_note_for_fd_nines')->where('p_note_for_fd_nine_id',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

            }elseif($status == 'fdNineOne'){

                $checkParentFirst = DB::table('parent_note_for_fd_nine_ones')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
                $childNoteNewList = DB::table('child_note_for_fd_nine_ones')->where('id',$childIdNew)->where('p_note_for_fd_nine_one_id',$id)->get();
                $childNoteNewListValue = DB::table('child_note_for_fd_nine_ones')->where('p_note_for_fd_nine_one_id',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

            }elseif($status == 'fdSix'){

                $checkParentFirst = DB::table('parent_note_for_fdsixes')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
                $childNoteNewList = DB::table('child_note_for_fd_sixes')->where('id',$childIdNew)->where('parent_note_for_fdsix_id',$id)->get();
                $childNoteNewListValue = DB::table('child_note_for_fd_sixes')->where('parent_note_for_fdsix_id',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

            }elseif($status == 'fdSeven'){

                $checkParentFirst = DB::table('parent_note_for_fd_sevens')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
                $childNoteNewList = DB::table('child_note_for_fd_sevens')->where('id',$childIdNew)->where('parent_note_for_fd_seven_id',$id)->get();
                $childNoteNewListValue = DB::table('child_note_for_fd_sevens') ->where('parent_note_for_fd_seven_id',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

            }elseif($status == 'fcOne'){

                $checkParentFirst = DB::table('parent_note_for_fc_ones')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
                $childNoteNewList = DB::table('child_note_for_fc_ones')->where('id',$childIdNew)->where('parent_note_for_fc_one_id',$id)->get();
                $childNoteNewListValue = DB::table('child_note_for_fc_ones')->where('parent_note_for_fc_one_id',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

            }elseif($status == 'fcTwo'){

                $checkParentFirst = DB::table('parent_note_for_fc_twos')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
                $childNoteNewList = DB::table('child_note_for_fc_twos')->where('id',$childIdNew)->where('parent_note_for_fc_two_id',$id)->get();
                $childNoteNewListValue = DB::table('child_note_for_fc_twos')->where('parent_note_for_fc_two_id',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

            }elseif($status == 'fdThree'){

                $checkParentFirst = DB::table('parent_note_for_fd_threes')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
                $childNoteNewList = DB::table('child_note_for_fd_threes')->where('id',$childIdNew)->where('parent_note_for_fd_three_id',$id)->get();
                $childNoteNewListValue = DB::table('child_note_for_fd_threes')->where('parent_note_for_fd_three_id',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

            }elseif($status == 'fdFive'){

                $checkParentFirst = DB::table('parent_note_for_fd_fives')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
                $childNoteNewList = DB::table('child_note_for_fd_fives')->where('id',$childIdNew)->where('pnote_fd_five',$id)->get();
                $childNoteNewListValue = DB::table('child_note_for_fd_fives')->where('pnote_fd_five',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

            }elseif($status == 'formNoFive'){

                $checkParentFirst = DB::table('parent_note_for_form_no_five_daks')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
                $childNoteNewList = DB::table('child_note_for_form_no_fives')->where('id',$childIdNew)->where('pnote_form_no_five',$id)->get();
                $childNoteNewListValue = DB::table('child_note_for_form_no_fives')->where('pnote_form_no_five',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }elseif($status == 'formNoSeven'){

            $checkParentFirst = DB::table('parent_note_for_form_no_sevens')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
            $childNoteNewList = DB::table('child_note_for_form_no_sevens')->where('id',$childIdNew)->where('pnote_form_no_seven',$id)->get();
            $childNoteNewListValue = DB::table('child_note_for_form_no_sevens')->where('pnote_form_no_seven',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

    }elseif($status == 'formNoFour'){

        $checkParentFirst = DB::table('parent_note_for_form_no_fours')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
        $childNoteNewList = DB::table('child_note_for_form_no_fours')->where('id',$childIdNew)->where('pnote_form_no_four',$id)->get();
        $childNoteNewListValue = DB::table('child_note_for_form_no_fours')->where('pnote_form_no_four',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

    }elseif($status == 'fdFourOneForm'){

        $checkParentFirst = DB::table('parent_note_for_fd_four_one_forms')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
        $childNoteNewList = DB::table('child_note_for_fd_four_one_forms')->where('id',$childIdNew)->where('pnote_fd_four_one_form',$id)->get();
        $childNoteNewListValue = DB::table('child_note_for_fd_four_one_forms')->where('pnote_fd_four_one_form',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

    }elseif($status == 'duplicate'){

                $checkParentFirst = DB::table('parent_note_for_duplicate_certificates')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
                $childNoteNewList = DB::table('child_note_for_duplicate_certificates')->where('id',$childIdNew)->where('pnote_dupid',$id)->get();
                $childNoteNewListValue = DB::table('child_note_for_duplicate_certificates')->where('pnote_dupid',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

            }elseif($status == 'constitution'){

                $checkParentFirst = DB::table('parent_note_for_constitutions')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
                $childNoteNewList = DB::table('child_note_for_constitutions')->where('id',$childIdNew) ->where('pnote_conid',$id)->get();
                $childNoteNewListValue = DB::table('child_note_for_constitutions')->where('pnote_conid',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

            }elseif($status == 'committee'){

                $checkParentFirst = DB::table('parent_not_for_executive_committees')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
                $childNoteNewList = DB::table('child_note_for_executive_committees')->where('id',$childIdNew)->where('pnote_exeid',$id)->get();
                $childNoteNewListValue = DB::table('child_note_for_executive_committees')->where('pnote_exeid',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

            }


       $data = view('admin.presentDocument.printParagraphViewSingle',compact('status','parentId','nothiId','id','childIdNew',
            'childNoteNewListValue',
            'childNoteNewList',
            'checkParentFirst',

        ));

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


    public function printParagraphAddSingle($status,$parentId,$nothiId,$id,$childIdNew){


        try{

        $nothiNumber = NothiList::where('id',$nothiId)->value('main_sarok_number');
        $nothiYear = NothiList::where('id',$nothiId)->value('document_year');
        $user = Admin::where('id','!=',1)->get();

        $nothiPropokListUpdate = NothiPrapok::where('nothiId',$nothiId)
        ->where('noteId',$id)->where('status',1)->get();
        $nothiAttractListUpdate = NothiAttarct::where('nothiId',$nothiId)
        ->where('noteId',$id)->where('status',1)->get();
        $nothiCopyListUpdate = NothiCopy::where('nothiId',$nothiId)
        ->where('noteId',$id)->where('status',1)->get();

        $permissionNothiList = NothiPermission::where('nothId',$nothiId)->get();

        $convert_name_title = $permissionNothiList->implode("designationId", " ");
        $separated_data_title = explode(" ", $convert_name_title);

        $branchListForSerial = DesignationList::whereIn('id',$separated_data_title)->orderBy('designation_serial','asc')->get();

        if($status == 'registration'){

            $checkParentFirst = DB::table('parent_note_for_registrations')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
            $childNoteNewList = DB::table('child_note_for_registrations')->where('id',$childIdNew)->where('parent_note_regid',$id)->get();
            $childNoteNewListValue = DB::table('child_note_for_registrations')->where('parent_note_regid',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }elseif($status == 'renew'){

            $checkParentFirst = DB::table('parent_note_for_renews')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
            $childNoteNewList = DB::table('child_note_for_renews')->where('id',$childIdNew)->where('parent_note_for_renew_id',$id)->get();
            $childNoteNewListValue = DB::table('child_note_for_renews')->where('parent_note_for_renew_id',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }elseif($status == 'nameChange'){

            $checkParentFirst = DB::table('parent_note_for_name_changes')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$childIdNew)->where('id',$id)->first();
            $childNoteNewList = DB::table('child_note_for_name_changes')->where('id',$childIdNew)->where('parentnote_name_change_id',$id)->get();
            $childNoteNewListValue = DB::table('child_note_for_name_changes')->where('parentnote_name_change_id',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }elseif($status == 'fdNine'){

            $checkParentFirst = DB::table('parent_note_for_fd_nines')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
            $childNoteNewList = DB::table('child_note_for_fd_nines')->where('id',$childIdNew)->where('p_note_for_fd_nine_id',$id)->get();
            $childNoteNewListValue = DB::table('child_note_for_fd_nines')->where('p_note_for_fd_nine_id',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }elseif($status == 'fdNineOne'){

            $checkParentFirst = DB::table('parent_note_for_fd_nine_ones')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
            $childNoteNewList = DB::table('child_note_for_fd_nine_ones')->where('id',$childIdNew)->where('p_note_for_fd_nine_one_id',$id)->get();
            $childNoteNewListValue = DB::table('child_note_for_fd_nine_ones')->where('p_note_for_fd_nine_one_id',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }elseif($status == 'fdSix'){

            $checkParentFirst = DB::table('parent_note_for_fdsixes')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
            $childNoteNewList = DB::table('child_note_for_fd_sixes')->where('id',$childIdNew)->where('parent_note_for_fdsix_id',$id)->get();
            $childNoteNewListValue = DB::table('child_note_for_fd_sixes')->where('parent_note_for_fdsix_id',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }elseif($status == 'fdSeven'){

            $checkParentFirst = DB::table('parent_note_for_fd_sevens')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
            $childNoteNewList = DB::table('child_note_for_fd_sevens')->where('id',$childIdNew)->where('parent_note_for_fd_seven_id',$id)->get();
            $childNoteNewListValue = DB::table('child_note_for_fd_sevens')->where('parent_note_for_fd_seven_id',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }elseif($status == 'fcOne'){

            $checkParentFirst = DB::table('parent_note_for_fc_ones')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
            $childNoteNewList = DB::table('child_note_for_fc_ones') ->where('id',$childIdNew)->where('parent_note_for_fc_one_id',$id)->get();
            $childNoteNewListValue = DB::table('child_note_for_fc_ones')->where('parent_note_for_fc_one_id',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }elseif($status == 'fcTwo'){

            $checkParentFirst = DB::table('parent_note_for_fc_twos')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
            $childNoteNewList = DB::table('child_note_for_fc_twos')->where('id',$childIdNew)->where('parent_note_for_fc_two_id',$id)->get();
            $childNoteNewListValue = DB::table('child_note_for_fc_twos')->where('parent_note_for_fc_two_id',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }elseif($status == 'fdThree'){

            $checkParentFirst = DB::table('parent_note_for_fd_threes')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
            $childNoteNewList = DB::table('child_note_for_fd_threes')->where('id',$childIdNew)->where('parent_note_for_fd_three_id',$id)->get();
            $childNoteNewListValue = DB::table('child_note_for_fd_threes')->where('parent_note_for_fd_three_id',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }elseif($status == 'fdFive'){

            $checkParentFirst = DB::table('parent_note_for_fd_fives')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
            $childNoteNewList = DB::table('child_note_for_fd_fives')->where('id',$childIdNew)->where('pnote_fd_five',$id)->get();
            $childNoteNewListValue = DB::table('child_note_for_fd_fives')->where('pnote_fd_five',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }elseif($status == 'formNoFive'){

            $checkParentFirst = DB::table('parent_note_for_form_no_five_daks')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
            $childNoteNewList = DB::table('child_note_for_form_no_fives')->where('id',$childIdNew)->where('pnote_form_no_five',$id)->get();
            $childNoteNewListValue = DB::table('child_note_for_form_no_fives')->where('pnote_form_no_five',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

    }elseif($status == 'formNoSeven'){

        $checkParentFirst = DB::table('parent_note_for_form_no_sevens')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
        $childNoteNewList = DB::table('child_note_for_form_no_sevens')->where('id',$childIdNew)->where('pnote_form_no_seven',$id)->get();
        $childNoteNewListValue = DB::table('child_note_for_form_no_sevens')->where('pnote_form_no_seven',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

}elseif($status == 'formNoFour'){

    $checkParentFirst = DB::table('parent_note_for_form_no_fours')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
    $childNoteNewList = DB::table('child_note_for_form_no_fours')->where('id',$childIdNew)->where('pnote_form_no_four',$id)->get();
    $childNoteNewListValue = DB::table('child_note_for_form_no_fours')->where('pnote_form_no_four',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

}elseif($status == 'fdFourOneForm'){

    $checkParentFirst = DB::table('parent_note_for_fd_four_one_forms')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
    $childNoteNewList = DB::table('child_note_for_fd_four_one_forms')->where('id',$childIdNew)->where('pnote_fd_four_one_form',$id)->get();
    $childNoteNewListValue = DB::table('child_note_for_fd_four_one_forms')->where('pnote_fd_four_one_form',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

}elseif($status == 'duplicate'){

            $checkParentFirst = DB::table('parent_note_for_duplicate_certificates')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
            $childNoteNewList = DB::table('child_note_for_duplicate_certificates')->where('id',$childIdNew)->where('pnote_dupid',$id)->get();
            $childNoteNewListValue = DB::table('child_note_for_duplicate_certificates')->where('pnote_dupid',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }elseif($status == 'constitution'){

            $checkParentFirst = DB::table('parent_note_for_constitutions')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
            $childNoteNewList = DB::table('child_note_for_constitutions')->where('id',$childIdNew)->where('pnote_conid',$id)->get();
            $childNoteNewListValue = DB::table('child_note_for_constitutions')->where('pnote_conid',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }elseif($status == 'committee'){

            $checkParentFirst = DB::table('parent_not_for_executive_committees')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
            $childNoteNewList = DB::table('child_note_for_executive_committees')->where('id',$childIdNew)->where('pnote_exeid',$id)->get();
            $childNoteNewListValue = DB::table('child_note_for_executive_committees')->where('pnote_exeid',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }


       $data = view('admin.presentDocument.printParagraphAddSingle',compact('status','parentId','nothiId','id','childIdNew',
            'childNoteNewListValue',
            'childNoteNewList',
            'checkParentFirst',

        ));

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

    public function addChildNote($status,$parentId,$nothiId,$id,$activeCode){

        try{
        if($status == 'registration'){
            $fdFourOneFormStatusId=0;
            $dataFdFourOneForm=0;
            $formNoFourStatusId=0;
                    $dataFromNoFourForm=0;
            $formNoSevenStatusId=0;
            $dataFromNoSevenForm=0;

            $formNoFiveStepThreeData=0;$formNoFiveStepTwoData=0;
            $formNoFiveStepFourData=0;
            $formNoFiveStepFiveOther=0;
           $formNoFiveStepFiveData=0;
           $formNoFiveStepFiveArea=0;

            $formNoFiveStatusId = 0;
            $dataFromNoFiveForm =0;
            $fdNineOtherFileList =0;$committeeStatusId=0;$dataFromCommittee=0;$constitutionStatusId = 0;$dataFromConstitution = 0;
            $duplicateCertificateStatusId = 0;$dataFromDuplicateCertificate = 0;
            $mainIdR = '';$fdOneFormId = '';$renewInfoData = '';$dataFromFd3Form = 0;$dataFromNVisaFd9Fd1='';
            $allNameChangeDoc = '';$getformOneId='';$nVisaDocs='';$ngoStatus='';$get_email_from_user=0;
            $mainIdFdNineOne=0;$nVisabasicInfo=0;$forwardingLetterOnulipi=0;$editCheck1=0;
            $editCheck=0;$statusData=0;$nVisaWorkPlace=0;$nVisaSponSor=0;$nVisaForeignerInfo=0;
            $nVisaManPower=0;$nVisaEmploye=0;$nVisaCompensationAndBenifits=0;$nVisaAuthPerson=0;
            $dataFromFc1Form=0;$dataFromFd6Form =0;$fd2FormList=0;$fd2OtherInfo=0;$prokolpoAreaList=0;
            $dataFromFd7Form=0;$dataFromFc2Form=0;$dataFromFdFive = 0;$fdFiveStatusId = 0;


            $officeDetail = RegistrationOfficeSarok::where('parent_note_regid',$id)->get();
            $checkParent = ParentNoteForRegistration::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

            $registration_status_id = DB::table('ngo_registration_daks')->where('id',$parentId)->value('registration_status_id');
            $fdOneIdForNothi = DB::table('ngo_statuses')->where('id',$registration_status_id)->value('fd_one_form_id');
            $r_status = DB::table('ngo_statuses')->where('fd_one_form_id',$fdOneIdForNothi)->value('status');
            $name_change_status = DB::table('ngo_name_changes')->where('fd_one_form_id',$fdOneIdForNothi)->value('status');
            $renew_status = DB::table('ngo_renews')->where('fd_one_form_id',$fdOneIdForNothi)->value('status');
            $all_data_for_new_list_all = DB::table('ngo_statuses')->where('fd_one_form_id',$fdOneIdForNothi)->first();
            $form_one_data = DB::table('fd_one_forms')->where('id',$fdOneIdForNothi)->first();
            $ngoTypeData = DB::table('ngo_type_and_languages')->where('user_id',$form_one_data->user_id)->first();
            $signDataNew = DB::table('form_eights')->where('fd_one_form_id',$fdOneIdForNothi)->first();
            $form_eight_data = DB::table('form_eights')->where('fd_one_form_id',$fdOneIdForNothi)->get();
            $form_member_data = DB::table('ngo_member_lists')->where('fd_one_form_id',$fdOneIdForNothi)->get();
            $form_member_data_doc_renew = DB::table('ngo_renew_infos')->where('fd_one_form_id',$fdOneIdForNothi)->get();
            $duration_list_all1 = DB::table('ngo_durations')->where('fd_one_form_id',$fdOneIdForNothi)->value('ngo_duration_end_date');
            $duration_list_all = DB::table('ngo_durations')->where('fd_one_form_id',$fdOneIdForNothi)->value('ngo_duration_start_date');
            $form_member_data_doc = DB::table('ngo_member_nid_photos')->where('fd_one_form_id',$fdOneIdForNothi)->get();
            $form_ngo_data_doc = DB::table('ngo_other_docs')->where('fd_one_form_id',$fdOneIdForNothi)->get();
            $users_info = DB::table('users')->where('id',$form_one_data->user_id)->first();
            $all_source_of_fund = DB::table('fd_one_source_of_funds')->where('fd_one_form_id',$form_one_data->id)->get();
            $all_partiw = DB::table('fd_one_member_lists')->where('fd_one_form_id',$form_one_data->id)->get();
            $get_all_data_adviser_bank = DB::table('fd_one_bank_accounts')->where('fd_one_form_id',$form_one_data->id)->first();
            $get_all_data_other= DB::table('fd_one_other_pdf_lists')->where('fd_one_form_id',$form_one_data->id)->get();
            $get_all_data_adviser = DB::table('fd_one_adviser_lists')->where('fd_one_form_id',$form_one_data->id)->get();
                             //new code

        }elseif($status == 'renew'){
            $fdFourOneFormStatusId=0;
            $dataFdFourOneForm=0;
            $formNoFourStatusId=0;
                    $dataFromNoFourForm=0;
            $formNoSevenStatusId=0;
            $dataFromNoSevenForm=0;

            $formNoFiveStepThreeData=0;$formNoFiveStepTwoData=0;
            $formNoFiveStepFourData=0;
            $formNoFiveStepFiveOther=0;
           $formNoFiveStepFiveData=0;
           $formNoFiveStepFiveArea=0;

            $formNoFiveStatusId = 0;
            $dataFromNoFiveForm =0;
            $fdNineOtherFileList =0;$committeeStatusId=0;$dataFromCommittee=0;$constitutionStatusId = 0;$dataFromConstitution = 0;
            $duplicateCertificateStatusId = 0;$dataFromDuplicateCertificate = 0;$dataFromFd3Form = 0;
            $allNameChangeDoc = '';$getformOneId='';$dataFromFdFive = 0;$fdFiveStatusId = 0;
            $ngoTypeData = '';$dataFromNVisaFd9Fd1='';$nVisaDocs='';$ngoStatus='';$get_email_from_user=0;
            $mainIdFdNineOne=0;$nVisabasicInfo=0;$forwardingLetterOnulipi=0;$editCheck1=0;$editCheck=0;$statusData=0;$nVisaWorkPlace=0;
            $nVisaSponSor=0;$nVisaForeignerInfo=0;$nVisaManPower=0;$nVisaEmploye=0;$nVisaCompensationAndBenifits=0;
            $nVisaAuthPerson=0; $dataFromFc1Form=0;$dataFromFd6Form =0;$fd2FormList=0;$fd2OtherInfo=0;$prokolpoAreaList=0;$dataFromFd7Form=0;$dataFromFc2Form=0;

            $officeDetail = RenewOfficeSarok::where('parent_note_for_renew_id',$id)->get();
            $checkParent = ParentNoteForRenew::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

              //new code  start
            $renew_status_id = DB::table('ngo_renew_daks')->where('id',$parentId)->value('renew_status_id');
            $mainIdR = DB::table('ngo_renews')->where('id',$renew_status_id)->first();
            $fdOneFormId = DB::table('ngo_renews')->where('id',$renew_status_id)->first();
            $form_one_data = DB::table('fd_one_forms')->where('id',$fdOneFormId->fd_one_form_id)->first();
            $r_status = DB::table('ngo_renews')->where('fd_one_form_id',$form_one_data->id)->value('status');
            $name_change_status = DB::table('ngo_name_changes')->where('fd_one_form_id',$form_one_data->id)->value('status');
            $renew_status = DB::table('ngo_renews')->where('id',$id)->value('status');
            $all_data_for_new_list_all = DB::table('ngo_renews')->where('fd_one_form_id',$form_one_data->id)->first();
            $form_eight_data = DB::table('form_eights')->where('fd_one_form_id',$form_one_data->id)->get();
            $form_member_data = DB::table('ngo_member_lists')->where('fd_one_form_id',$form_one_data->id)->get();
            $renewInfoData = DB::table('ngo_renew_infos')->where('fd_one_form_id',$fdOneFormId->fd_one_form_id)->first();
            $form_member_data_doc_renew = DB::table('ngo_renew_infos')->where('fd_one_form_id',$fdOneFormId->fd_one_form_id)->get();
            $duration_list_all1 = DB::table('ngo_durations')->where('fd_one_form_id',$fdOneFormId->fd_one_form_id)->value('ngo_duration_end_date');
            $duration_list_all = DB::table('ngo_durations')->where('fd_one_form_id',$fdOneFormId->fd_one_form_id)->value('ngo_duration_start_date');
            $form_member_data_doc = DB::table('ngo_member_nid_photos')->where('fd_one_form_id',$fdOneFormId->fd_one_form_id)->get();
            $form_ngo_data_doc = DB::table('ngo_other_docs')->where('fd_one_form_id',$fdOneFormId->fd_one_form_id)->get();
            $users_info = DB::table('users')->where('id',$form_one_data->user_id)->first();
            $all_source_of_fund = DB::table('fd_one_source_of_funds')->where('fd_one_form_id',$form_one_data->id)->get();
            $all_partiw = DB::table('fd_one_member_lists')->where('fd_one_form_id',$form_one_data->id)->get();
            $get_all_data_adviser_bank = DB::table('fd_one_bank_accounts')->where('fd_one_form_id',$form_one_data->id)->first();
            $get_all_data_other= DB::table('fd_one_other_pdf_lists')->where('fd_one_form_id',$form_one_data->id)->get();
            $get_all_data_adviser = DB::table('fd_one_adviser_lists')->where('fd_one_form_id',$form_one_data->id)->get();


        }elseif($status == 'nameChange'){
            $fdFourOneFormStatusId=0;
            $dataFdFourOneForm=0;
            $formNoFourStatusId=0;
                    $dataFromNoFourForm=0;
            $formNoSevenStatusId=0;
            $dataFromNoSevenForm=0;

            $formNoFiveStepThreeData=0;$formNoFiveStepTwoData=0;
            $formNoFiveStepFourData=0;
            $formNoFiveStepFiveOther=0;
           $formNoFiveStepFiveData=0;
           $formNoFiveStepFiveArea=0;

            $formNoFiveStatusId = 0;
            $dataFromNoFiveForm =0;
            $fdNineOtherFileList =0;$committeeStatusId=0;$dataFromCommittee=0;$constitutionStatusId = 0;$dataFromConstitution = 0;$duplicateCertificateStatusId = 0;
            $dataFromDuplicateCertificate = 0;$dataFromFd3Form = 0;$renewInfoData='';$ngoTypeData = '';
            $mainIdR ='';$dataFromNVisaFd9Fd1='';$nVisaDocs='';$ngoStatus='';$dataFromFdFive = 0;
            $fdFiveStatusId = 0;$get_email_from_user=0;$mainIdFdNineOne=0;$nVisabasicInfo=0;$forwardingLetterOnulipi=0;$editCheck1=0;$editCheck=0;$statusData=0;
            $nVisaWorkPlace=0;$nVisaSponSor=0;$nVisaForeignerInfo=0;$nVisaManPower=0;$nVisaEmploye=0;
            $nVisaCompensationAndBenifits=0;$nVisaAuthPerson=0;$dataFromFd6Form =0;$fd2FormList=0;
            $fd2OtherInfo=0;$prokolpoAreaList=0;$dataFromFc1Form=0;$dataFromFc2Form=0;$dataFromFd7Form=0;

            $officeDetail = NameChangeOfficeSarok::where('parentnote_name_change_id',$id)->get();
            $checkParent = ParentNoteForNameChange::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();


            ///name change ciew

            $name_change_status_id = DB::table('ngo_name_change_daks')->where('id',$parentId)->value('name_change_status_id');
            $allNameChangeDoc = DB::table('name_change_docs')->where('ngo_name_change_id',$name_change_status_id)->get();
            $getformOneId = DB::table('ngo_name_changes')->where('id',$name_change_status_id)->first();
            $form_one_data = DB::table('fd_one_forms')->where('id',$getformOneId->fd_one_form_id)->first();
            $r_status = DB::table('ngo_statuses')->where('fd_one_form_id',$form_one_data->id)->value('status');
            $name_change_status = DB::table('ngo_name_changes')->where('id',$name_change_status_id)->value('status');
            $renew_status = DB::table('ngo_renews')->where('fd_one_form_id',$form_one_data->id)->value('status');
            $checkOldorNew = DB::table('ngo_type_and_languages')->where('user_id',$form_one_data->user_id)->value('ngo_type_new_old');

            if($checkOldorNew == 'Old'){

                $all_data_for_new_list_all = DB::table('ngo_renews')
                ->where('fd_one_form_id',$form_one_data->id)->first();
            }else{

                $all_data_for_new_list_all = DB::table('ngo_statuses')
                ->where('fd_one_form_id',$form_one_data->id)->first();
            }

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
            $get_all_data_adviser_bank = DB::table('fd_one_bank_accounts')->where('fd_one_form_id',$form_one_data->id)->first();
            $get_all_data_other= DB::table('fd_one_other_pdf_lists')->where('fd_one_form_id',$form_one_data->id)->get();
            $get_all_data_adviser = DB::table('fd_one_adviser_lists')->where('fd_one_form_id',$form_one_data->id)->get();


        }elseif($status == 'fdNine'){
            $fdFourOneFormStatusId=0;
            $dataFdFourOneForm=0;
            $formNoFourStatusId=0;
                    $dataFromNoFourForm=0;
            $formNoSevenStatusId=0;
            $dataFromNoSevenForm=0;

            $formNoFiveStepThreeData=0;$formNoFiveStepTwoData=0;
            $formNoFiveStepFourData=0;
            $formNoFiveStepFiveOther=0;
           $formNoFiveStepFiveData=0;
           $formNoFiveStepFiveArea=0;

            $formNoFiveStatusId = 0;
            $dataFromNoFiveForm =0;
            $committeeStatusId=0;$dataFromCommittee=0;$constitutionStatusId = 0;$dataFromConstitution = 0;$duplicateCertificateStatusId = 0;$dataFromDuplicateCertificate = 0;
            $dataFromFdFive = 0;$fdFiveStatusId = 0;$dataFromFd3Form = 0;$get_email_from_user=0;
            $mainIdFdNineOne=0;$nVisabasicInfo=0;$forwardingLetterOnulipi=0;$editCheck1=0;$editCheck=0;
            $statusData=0;$nVisaWorkPlace=0;$nVisaSponSor=0;$nVisaForeignerInfo=0;$nVisaManPower=0;
            $nVisaEmploye=0;$nVisaCompensationAndBenifits=0;$nVisaAuthPerson=0;$mainIdR=0;$renewInfoData=0;
            $form_one_data=0;$all_data_for_new_list_all=0;$form_eight_data=0;$form_member_data=0;
            $form_member_data_doc=0;$form_ngo_data_doc=0;$users_info=0;$all_source_of_fund=0;
            $all_partiw=0;$allNameChangeDoc = 0;$getformOneId= 0;$duration_list_all1 =0;$duration_list_all = 0;
            $renew_status = 0;$name_change_status = 0;$r_status = 0;$form_member_data_doc_renew =0;
            $get_all_data_adviser=0;$get_all_data_other=0;$get_all_data_adviser_bank=0;$dataFromFd6Form =0;
            $fd2FormList=0;$fd2OtherInfo=0;$prokolpoAreaList=0;$dataFromFd7Form=0;$dataFromFc1Form=0;$dataFromFc2Form=0;

            $officeDetail = FdNineOfficeSarok::where('p_note_for_fd_nine_id',$id)->get();
            $checkParent = ParentNoteForFdNine::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

            $fd_nine_status_id = DB::table('ngo_f_d_nine_daks')->where('id',$parentId)->value('f_d_nine_status_id');

            $dataFromNVisaFd9Fd1 = DB::table('fd9_forms')
            ->join('fd_one_forms', 'fd_one_forms.id', '=', 'fd9_forms.fd_one_form_id')
            ->select('fd_one_forms.*','fd9_forms.*')
            ->where('fd9_forms.id',$fd_nine_status_id)
            ->first();

            $fdNineOtherFileList = DB::table('fd_nine_other_files')->where('fd9_form_id',$fd_nine_status_id)->get();

            $ngoTypeData = DB::table('ngo_type_and_languages')->where('user_id',$dataFromNVisaFd9Fd1->user_id)->first();
            $checkOldorNew = DB::table('ngo_type_and_languages')->where('user_id',$dataFromNVisaFd9Fd1->user_id)->value('ngo_type_new_old');


            if($checkOldorNew == 'Old'){

                $ngoStatus = DB::table('ngo_renews')
                ->where('fd_one_form_id',$dataFromNVisaFd9Fd1->fd_one_form_id)->first();
            }else{

                $ngoStatus = DB::table('ngo_statuses')
                ->where('fd_one_form_id',$dataFromNVisaFd9Fd1->fd_one_form_id)->first();
            }

            $nVisaDocs = DB::table('n_visa_necessary_document_for_work_permits')->where('n_visa_id',$dataFromNVisaFd9Fd1->id)->first();


        }elseif($status == 'fdNineOne'){

            $fdFourOneFormStatusId=0;
            $dataFdFourOneForm=0;
            $formNoFourStatusId=0;
                    $dataFromNoFourForm=0;
            $formNoSevenStatusId=0;
            $dataFromNoSevenForm=0;

            $formNoFiveStepThreeData=0;$formNoFiveStepTwoData=0;
            $formNoFiveStepFourData=0;
            $formNoFiveStepFiveOther=0;
           $formNoFiveStepFiveData=0;
           $formNoFiveStepFiveArea=0;

            $formNoFiveStatusId = 0;
            $dataFromNoFiveForm =0;
            $fdNineOtherFileList =0;$dataFromFdFive = 0;$fdFiveStatusId = 0;$committeeStatusId=0;
            $dataFromCommittee=0;$constitutionStatusId = 0;$dataFromConstitution = 0;$duplicateCertificateStatusId = 0;
            $dataFromDuplicateCertificate = 0;$dataFromFd3Form = 0;$dataFromFd6Form =0;$fd2FormList=0;
            $fd2OtherInfo=0;$prokolpoAreaList=0;$mainIdR=0;$renewInfoData=0;$dataFromFd7Form=0;$form_one_data=0;
            $all_data_for_new_list_all=0;$form_eight_data=0;$form_member_data=0;$form_member_data_doc=0;$form_ngo_data_doc=0;$users_info=0;
            $all_source_of_fund=0;$all_partiw=0;$allNameChangeDoc = 0;$getformOneId= 0;$duration_list_all1 =0;
            $duration_list_all = 0; $renew_status = 0;$name_change_status = 0;$r_status = 0;
            $form_member_data_doc_renew =0;$get_all_data_adviser=0;$get_all_data_other=0;
            $get_all_data_adviser_bank=0;$dataFromFc1Form=0;$dataFromFc2Form=0;

            $officeDetail = FdNineOneOfficeSarok::where('p_note_for_fd_nine_one_id',$id)->get();
            $checkParent = ParentNoteForFdNineOne::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

            $fd_nine_one_status_id = DB::table('ngo_f_d_nine_one_daks')->where('id',$parentId)->value('f_d_nine_one_status_id');
            $mainIdFdNineOne = $fd_nine_one_status_id;

            $dataFromNVisaFd9Fd1 = DB::table('fd9_one_forms')
            ->join('fd_one_forms', 'fd9_one_forms.fd_one_form_id', '=', 'fd_one_forms.id')
            ->select('fd_one_forms.*','fd9_one_forms.*','fd9_one_forms.id as mainId','fd9_one_forms.chief_name as chiefName','fd9_one_forms.chief_desi as chiefDesi','fd9_one_forms.digital_signature as chiefSign','fd9_one_forms.digital_seal as chiefSeal','fd9_one_forms.created_at as chiefDate')
            ->orderBy('fd9_one_forms.id','desc')
            ->where('fd9_one_forms.id',$fd_nine_one_status_id)
            ->first();

            $get_email_from_user = DB::table('users')->where('id',$dataFromNVisaFd9Fd1->user_id)->value('email');
            $forwardId =  DB::table('forwarding_letters')->where('fd9_form_id',$dataFromNVisaFd9Fd1->mainId)->orderBy('id','desc')->value('id');
            $forwardingLetterOnulipi = DB::table('forwarding_letter_onulipis')->where('forwarding_letter_id',$forwardId)->get();
            $editCheck = DB::table('fd9_forwarding_letter_edits')->where('forwarding_letter_id',$forwardId)->orderBy('id','desc')->value('pdf_part_one');
            $editCheck1 = DB::table('fd9_forwarding_letter_edits')->where('forwarding_letter_id',$forwardId)->orderBy('id','desc')->value('pdf_part_two');
            $ngoTypeData = DB::table('ngo_type_and_languages')->where('user_id',$dataFromNVisaFd9Fd1->user_id)->first();


            if($ngoTypeData->ngo_type_new_old == 'Old'){

            $ngoStatus = DB::table('ngo_renews')
            ->where('fd_one_form_id',$dataFromNVisaFd9Fd1->fd_one_form_id)->first();

            }else{

            $ngoStatus = DB::table('ngo_statuses')
            ->where('fd_one_form_id',$dataFromNVisaFd9Fd1->fd_one_form_id)->first();
            }

            $nVisabasicInfo = DB::table('n_visas')->where('fd9_one_form_id',$dataFromNVisaFd9Fd1->mainId)->first();
            $statusData = DB::table('secruity_checks')->where('n_visa_id',$nVisabasicInfo->id)->value('created_at');

            $nVisaAuthPerson = DB::table('n_visa_authorized_personal_of_the_orgs')->where('n_visa_id',$nVisabasicInfo->id)->first();
            $nVisaCompensationAndBenifits = DB::table('n_visa_compensation_and_benifits')->where('n_visa_id',$nVisabasicInfo->id)->get();
            $nVisaEmploye = DB::table('n_visa_employment_information')->where('n_visa_id',$nVisabasicInfo->id)->first();
            $nVisaManPower = DB::table('n_visa_manpower_of_the_offices')->where('n_visa_id',$nVisabasicInfo->id)->first();
            $nVisaDocs = DB::table('n_visa_necessary_document_for_work_permits')->where('n_visa_id',$nVisabasicInfo->id)->first();
            $nVisaForeignerInfo = DB::table('n_visa_particulars_of_foreign_incumbnets')->where('n_visa_id',$nVisabasicInfo->id)->first();
            $nVisaSponSor = DB::table('n_visa_particular_of_sponsor_or_employers')->where('n_visa_id',$nVisabasicInfo->id)->first();
            $nVisaWorkPlace = DB::table('n_visa_work_place_addresses')->where('n_visa_id',$nVisabasicInfo->id)->first();


        }elseif($status == 'fdSix'){

            $fdFourOneFormStatusId=0;
            $dataFdFourOneForm=0;
            $formNoFourStatusId=0;
                    $dataFromNoFourForm=0;

            $formNoSevenStatusId=0;
            $dataFromNoSevenForm=0;

            $formNoFiveStepThreeData=0;$formNoFiveStepTwoData=0;
            $formNoFiveStepFourData=0;
            $formNoFiveStepFiveOther=0;
           $formNoFiveStepFiveData=0;
           $formNoFiveStepFiveArea=0;

            $formNoFiveStatusId = 0;
            $dataFromNoFiveForm =0;
            $fdNineOtherFileList =0;$dataFromFdFive = 0;$fdFiveStatusId = 0;$committeeStatusId=0;
            $dataFromCommittee=0;$constitutionStatusId = 0;$dataFromConstitution = 0;$duplicateCertificateStatusId = 0;
            $dataFromDuplicateCertificate = 0;$dataFromFd3Form = 0;$dataFromFd7Form=0;
            $ngoStatus=0;$ngoTypeData=0;$nVisaDocs=0;$dataFromNVisaFd9Fd1=0;$nVisabasicInfo=0;
            $forwardingLetterOnulipi=0;$editCheck1=0;$editCheck=0;$statusData=0;$nVisaWorkPlace=0;
            $nVisaSponSor=0;$nVisaForeignerInfo=0;$nVisaManPower=0;$nVisaEmploye=0;$nVisaCompensationAndBenifits=0;
            $nVisaAuthPerson=0;$mainIdR=0;$renewInfoData=0;$mainIdFdNineOne =0;$form_one_data=0;
            $all_data_for_new_list_all=0;$form_eight_data=0;$form_member_data=0;$form_member_data_doc=0;
            $form_ngo_data_doc=0;$users_info=0;$all_source_of_fund=0;$all_partiw=0;$allNameChangeDoc = 0;
            $getformOneId= 0;$duration_list_all1 =0;$duration_list_all = 0;$renew_status = 0;
            $name_change_status = 0;$r_status = 0;$form_member_data_doc_renew =0;$get_all_data_adviser=0;
            $get_all_data_other=0;$get_all_data_adviser_bank=0;$dataFromFc1Form=0;$dataFromFc2Form=0;

            $officeDetail = FdSixOfficeSarok::where('parent_note_for_fdsix_id',$id)->get();
            $checkParent = ParentNoteForFdsix::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

            $fd_six_status_id = DB::table('ngo_fd_six_daks')->where('id',$parentId)->value('fd_six_status_id');

            $dataFromFd6Form = DB::table('fd6_forms')
            ->join('fd_one_forms', 'fd_one_forms.id', '=', 'fd6_forms.fd_one_form_id')
            ->select('fd_one_forms.*','fd6_forms.*','fd6_forms.id as mainId')
            ->where('fd6_forms.id',$fd_six_status_id)
            ->orderBy('fd6_forms.id','desc')
            ->first();

            $get_email_from_user = DB::table('users')->where('id',$dataFromFd6Form->user_id)->value('email');
            $fd2FormList = DB::table('fd2_forms')
            ->where('fd_one_form_id',$dataFromFd6Form->fd_one_form_id)
            ->where('fd_six_form_id',$dataFromFd6Form->mainId)->latest()->first();
            $fd2OtherInfo = DB::table('fd2_form_other_infos')
            ->where('fd2_form_id',$fd2FormList->id)->latest()->get();
            $prokolpoAreaList = DB::table('fd6_form_prokolpo_areas')->where('fd6_form_id',$dataFromFd6Form->mainId)->latest()->get();


        }elseif($status == 'fdSeven'){

            $fdFourOneFormStatusId=0;
            $dataFdFourOneForm=0;
            $formNoFourStatusId=0;
                    $dataFromNoFourForm=0;

            $formNoSevenStatusId=0;
            $dataFromNoSevenForm=0;

            $formNoFiveStepThreeData=0;$formNoFiveStepTwoData=0;
            $formNoFiveStepFourData=0;
            $formNoFiveStepFiveOther=0;
           $formNoFiveStepFiveData=0;
           $formNoFiveStepFiveArea=0;

            $formNoFiveStatusId = 0;
            $dataFromNoFiveForm =0;
            $fdNineOtherFileList =0;$dataFromFdFive = 0;$fdFiveStatusId = 0;$committeeStatusId=0;
            $dataFromCommittee=0;$constitutionStatusId = 0;$dataFromConstitution = 0;
            $duplicateCertificateStatusId = 0;$dataFromDuplicateCertificate = 0;$dataFromFd3Form = 0;
            $dataFromFd6Form = 0;$ngoStatus=0;$ngoTypeData=0;$nVisaDocs=0;$dataFromNVisaFd9Fd1=0;
            $nVisabasicInfo=0;$forwardingLetterOnulipi=0;$editCheck1=0;$editCheck=0;
            $statusData=0;$nVisaWorkPlace=0;$nVisaSponSor=0;$nVisaForeignerInfo=0; $nVisaManPower=0;
            $nVisaEmploye=0; $nVisaCompensationAndBenifits=0;$nVisaAuthPerson=0;$mainIdR=0;
            $renewInfoData=0;$mainIdFdNineOne =0;$form_one_data=0;$all_data_for_new_list_all=0;
            $form_eight_data=0;$form_member_data=0;$form_member_data_doc=0;$form_ngo_data_doc=0;
            $users_info=0;$all_source_of_fund=0; $all_partiw=0;$allNameChangeDoc = 0;$getformOneId= 0;
            $duration_list_all1 =0;$duration_list_all = 0;$renew_status = 0;$name_change_status = 0;
            $r_status = 0;$form_member_data_doc_renew =0;$get_all_data_adviser=0;$get_all_data_other=0;
            $get_all_data_adviser_bank=0;$dataFromFc2Form=0;$dataFromFc1Form=0;

            $officeDetail = FdSevenOfficeSarok::where('parent_note_for_fd_seven_id',$id)->get();
            $checkParent = ParentNoteForFdSeven::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

            $fd_seven_status_id = DB::table('ngo_fd_seven_daks')->where('id',$parentId)->value('fd_seven_status_id');

            $dataFromFd7Form = DB::table('fd7_forms')
            ->join('fd_one_forms', 'fd_one_forms.id', '=', 'fd7_forms.fd_one_form_id')
            ->select('fd_one_forms.*','fd7_forms.*','fd7_forms.id as mainId')
            ->where('fd7_forms.id',$fd_seven_status_id)
            ->orderBy('fd7_forms.id','desc')
            ->first();

           $get_email_from_user = DB::table('users')->where('id',$dataFromFd7Form->user_id)->value('email');
           $fd2FormList = DB::table('fd2_form_for_fd7_forms')->where('fd_one_form_id',$dataFromFd7Form->fd_one_form_id)->where('fd7_form_id',$dataFromFd7Form->mainId)->latest()->first();
           $fd2OtherInfo = DB::table('fd2_fd7_other_infos')->where('fd2_form_for_fd7_form_id',$fd2FormList->id)->latest()->get();
           $prokolpoAreaList = DB::table('fd7_form_prokolpo_areas')->where('fd7_form_id',$dataFromFd7Form->mainId)->latest()->get();

        }elseif($status == 'fcOne'){

            $fdFourOneFormStatusId=0;
            $dataFdFourOneForm=0;
            $formNoFourStatusId=0;
                    $dataFromNoFourForm=0;

            $formNoSevenStatusId=0;
            $dataFromNoSevenForm=0;

            $formNoFiveStepThreeData=0;$formNoFiveStepTwoData=0;
            $formNoFiveStepFourData=0;
            $formNoFiveStepFiveOther=0;
           $formNoFiveStepFiveData=0;
           $formNoFiveStepFiveArea=0;

            $formNoFiveStatusId = 0;
            $dataFromNoFiveForm =0;
            $fdNineOtherFileList =0;$dataFromFdFive = 0;$fdFiveStatusId = 0;$committeeStatusId=0;
            $dataFromCommittee=0;$constitutionStatusId = 0;$dataFromConstitution = 0;$duplicateCertificateStatusId = 0;
            $dataFromDuplicateCertificate = 0;$dataFromFd3Form = 0;$dataFromFc2Form=0;$prokolpoAreaList=0;
            $dataFromFd6Form = 0;$dataFromFd7Form = 0;$ngoStatus=0;$ngoTypeData=0;$nVisaDocs=0;$dataFromNVisaFd9Fd1=0;$nVisabasicInfo=0;
            $forwardingLetterOnulipi=0;$editCheck1=0;$editCheck=0;$statusData=0;$nVisaWorkPlace=0;
            $nVisaSponSor=0;$nVisaForeignerInfo=0; $nVisaManPower=0;$nVisaEmploye=0;$nVisaCompensationAndBenifits=0;
            $nVisaAuthPerson=0;$mainIdR=0;$renewInfoData=0;$mainIdFdNineOne =0;$form_one_data=0;
            $all_data_for_new_list_all=0;$form_eight_data=0;$form_member_data=0;$form_member_data_doc=0;
            $form_ngo_data_doc=0;$users_info=0;$all_source_of_fund=0;$all_partiw=0;$allNameChangeDoc = 0;
            $getformOneId= 0;$duration_list_all1 =0;$duration_list_all = 0;$renew_status = 0;
            $name_change_status = 0;$r_status = 0;$form_member_data_doc_renew =0;$get_all_data_adviser=0;$get_all_data_other=0;$get_all_data_adviser_bank=0;


            $officeDetail = FcOneOfficeSarok::where('parent_note_for_fc_one_id',$id)->get();
            $fc_one_status_id = DB::table('fc_one_daks')->where('id',$parentId)->value('fc_one_status_id');

            $dataFromFc1Form = DB::table('fc1_forms')
            ->join('fd_one_forms', 'fd_one_forms.id', '=', 'fc1_forms.fd_one_form_id')
            ->select('fd_one_forms.*','fc1_forms.*','fc1_forms.id as mainId')
            ->where('fc1_forms.id',$fc_one_status_id)
            ->orderBy('fc1_forms.id','desc')
            ->first();

           $get_email_from_user = DB::table('users')->where('id',$dataFromFc1Form->user_id)->value('email');
           $fd2FormList = DB::table('fd2_form_for_fc1_forms')->where('fd_one_form_id',$dataFromFc1Form->fd_one_form_id)->where('fc1_form_id',$dataFromFc1Form->mainId)->latest()->first();
           $fd2OtherInfo = DB::table('fd2_fc1_other_infos')->where('fd2_form_for_fc1_form_id',$fd2FormList->id)->latest()->get();

            $checkParent = ParentNoteForFcOne::where('nothi_detail_id',$parentId)->get();

        }elseif($status == 'fcTwo'){

            $fdFourOneFormStatusId=0;
            $dataFdFourOneForm=0;
            $formNoFourStatusId=0;
                    $dataFromNoFourForm=0;

            $formNoSevenStatusId=0;
            $dataFromNoSevenForm=0;
            $formNoFiveStepThreeData=0;$formNoFiveStepTwoData=0;
            $formNoFiveStepFourData=0;
            $formNoFiveStepFiveOther=0;
           $formNoFiveStepFiveData=0;
           $formNoFiveStepFiveArea=0;

            $formNoFiveStatusId = 0;
            $dataFromNoFiveForm =0;
            $fdNineOtherFileList =0;$dataFromFdFive = 0;$fdFiveStatusId = 0;$committeeStatusId=0;
            $dataFromCommittee=0;$constitutionStatusId = 0;$dataFromConstitution = 0;$duplicateCertificateStatusId = 0;
            $dataFromDuplicateCertificate = 0;$dataFromFd3Form = 0;$dataFromFc1Form =0;$prokolpoAreaList=0;
            $dataFromFd6Form = 0;$dataFromFd7Form = 0;$ngoStatus=0;$ngoTypeData=0;$nVisaDocs=0;
            $dataFromNVisaFd9Fd1=0;$nVisabasicInfo=0;$forwardingLetterOnulipi=0;$editCheck1=0;$editCheck=0;
            $statusData=0;$nVisaWorkPlace=0;$nVisaSponSor=0;$nVisaForeignerInfo=0;$nVisaManPower=0;
            $nVisaEmploye=0;$nVisaCompensationAndBenifits=0;$nVisaAuthPerson=0;$mainIdR=0;$renewInfoData=0;
            $mainIdFdNineOne =0;$form_one_data=0;$all_data_for_new_list_all=0;$form_eight_data=0;
            $form_member_data=0;$form_member_data_doc=0;$form_ngo_data_doc=0;$users_info=0;
            $all_source_of_fund=0;$all_partiw=0;$allNameChangeDoc = 0;$getformOneId= 0;$duration_list_all1 =0;$duration_list_all = 0;
            $renew_status = 0;$name_change_status = 0;$r_status = 0;$form_member_data_doc_renew =0;
            $get_all_data_adviser=0;$get_all_data_other=0;$get_all_data_adviser_bank=0;


            $officeDetail = FcTwoOfficeSarok::where('parent_note_for_fc_two_id',$id)->get();


            $fc_two_status_id = DB::table('fc_two_daks')
            ->where('id',$parentId)
            ->value('fc_two_status_id');


            $dataFromFc2Form = DB::table('fc2_forms')
            ->join('fd_one_forms', 'fd_one_forms.id', '=', 'fc2_forms.fd_one_form_id')
            ->select('fd_one_forms.*','fc2_forms.*','fc2_forms.id as mainId')
            ->where('fc2_forms.id',$fc_two_status_id)
           ->orderBy('fc2_forms.id','desc')
           ->first();
           $get_email_from_user = DB::table('users')->where('id',$dataFromFc2Form->user_id)->value('email');

           $fd2FormList = DB::table('fd2_form_for_fc2_forms')->where('fd_one_form_id',$dataFromFc2Form->fd_one_form_id)
           ->where('fc2_form_id',$dataFromFc2Form->mainId)->latest()->first();

           $fd2OtherInfo = DB::table('fd2_fc2_other_infos')->where('fd2_form_for_fc2_form_id',$fd2FormList->id)->latest()->get();

            $checkParent = ParentNoteForFcTwo::where('nothi_detail_id',$parentId)
            ->where('serial_number',$nothiId)
            ->get();





        }elseif($status == 'fdThree'){

            $fdFourOneFormStatusId=0;
            $dataFdFourOneForm=0;
            $formNoFourStatusId=0;
                    $dataFromNoFourForm=0;

            $formNoSevenStatusId=0;
            $dataFromNoSevenForm=0;

            $formNoFiveStepThreeData=0;$formNoFiveStepTwoData=0;
            $formNoFiveStepFourData=0;
            $formNoFiveStepFiveOther=0;
           $formNoFiveStepFiveData=0;
           $formNoFiveStepFiveArea=0;

            $fdNineOtherFileList =0;$dataFromFdFive = 0;$fdFiveStatusId = 0;$committeeStatusId=0;
            $dataFromCommittee=0;$constitutionStatusId = 0;$dataFromConstitution = 0;
            $duplicateCertificateStatusId = 0; $dataFromDuplicateCertificate = 0;$dataFromFc2Form =0;
            $dataFromFc1Form =0;$prokolpoAreaList=0; $dataFromFd6Form = 0;$dataFromFd7Form = 0;
            $ngoStatus=0;$ngoTypeData=0;$nVisaDocs=0;$dataFromNVisaFd9Fd1=0;$nVisabasicInfo=0;
            $forwardingLetterOnulipi=0;$editCheck1=0;$editCheck=0;$statusData=0;$nVisaWorkPlace=0;
            $nVisaSponSor=0;$nVisaForeignerInfo=0;$nVisaManPower=0;$nVisaEmploye=0;$nVisaCompensationAndBenifits=0;
            $nVisaAuthPerson=0;$mainIdR=0;$renewInfoData=0;$mainIdFdNineOne =0;$form_one_data=0;
            $all_data_for_new_list_all=0;$form_eight_data=0; $form_member_data=0;$form_member_data_doc=0;
            $form_ngo_data_doc=0;$users_info=0;$all_source_of_fund=0;$all_partiw=0;$allNameChangeDoc = 0;
            $getformOneId= 0;$duration_list_all1 =0;$duration_list_all = 0;$renew_status = 0;
            $name_change_status = 0;$r_status = 0;$form_member_data_doc_renew =0;$formNoFiveStatusId = 0;
            $dataFromNoFiveForm =0;
            $get_all_data_adviser=0;$get_all_data_other=0; $get_all_data_adviser_bank=0;

            $officeDetail = FdThreeOfficeSarok::where('parent_note_for_fd_three_id',$id)->get();
            $fd_three_status_id = DB::table('fd_three_daks')->where('id',$parentId)->value('fd_three_status_id');

            $dataFromFd3Form = DB::table('fd3_forms')
            ->join('fd_one_forms', 'fd_one_forms.id', '=', 'fd3_forms.fd_one_form_id')
            ->select('fd_one_forms.*','fd3_forms.*','fd3_forms.id as mainId')
            ->where('fd3_forms.id',$fd_three_status_id)
            ->orderBy('fd3_forms.id','desc')
            ->first();

           $get_email_from_user = DB::table('users')->where('id',$dataFromFd3Form->user_id)->value('email');
           $fd2FormList = DB::table('fd2_form_for_fd3_forms')->where('fd_one_form_id',$dataFromFd3Form->fd_one_form_id)->where('fd3_form_id',$dataFromFd3Form->mainId)->latest()->first();
           $fd2OtherInfo = DB::table('fd2_fd3_other_infos')->where('fd2_form_for_fd3_form_id',$fd2FormList->id)->latest()->get();
           $checkParent = ParentNoteForFdThree::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();


        }elseif($status == 'duplicate'){

            $fdFourOneFormStatusId=0;
            $dataFdFourOneForm=0;
            $formNoFourStatusId=0;
                    $dataFromNoFourForm=0;

            $formNoSevenStatusId=0;
            $dataFromNoSevenForm=0;

            $formNoFiveStepThreeData=0;$formNoFiveStepTwoData=0;
            $formNoFiveStepFourData=0;
            $formNoFiveStepFiveOther=0;
           $formNoFiveStepFiveData=0;
           $formNoFiveStepFiveArea=0;

            $fdNineOtherFileList =0;$dataFromFdFive = 0;$fdFiveStatusId = 0;$fd_three_status_id =0;
            $dataFromFc2Form =0;$dataFromFc1Form =0; $prokolpoAreaList=0;$dataFromFd6Form = 0;
            $dataFromFd7Form = 0;$ngoStatus=0;$ngoTypeData=0;$nVisaDocs=0;
            $dataFromNVisaFd9Fd1=0;$nVisabasicInfo=0;$forwardingLetterOnulipi=0;$editCheck1=0;
            $editCheck=0;$statusData=0;$nVisaWorkPlace=0;$nVisaSponSor=0;$nVisaForeignerInfo=0;
            $nVisaManPower=0;$nVisaEmploye=0;$nVisaCompensationAndBenifits=0;$nVisaAuthPerson=0;
            $mainIdR=0;$renewInfoData=0;$mainIdFdNineOne =0;$form_one_data=0;
            $all_data_for_new_list_all=0;$form_eight_data=0;$form_member_data=0;$form_member_data_doc=0;
            $form_ngo_data_doc=0;$users_info=0;$all_source_of_fund=0;$all_partiw=0;
            $allNameChangeDoc = 0;$getformOneId= 0;$duration_list_all1 =0;$duration_list_all = 0;
            $renew_status = 0;$name_change_status = 0;$r_status = 0;$form_member_data_doc_renew =0;
            $get_all_data_adviser=0; $get_all_data_other=0;$get_all_data_adviser_bank=0;$dataFromFd3Form = 0;
            $fd2FormList = 0;$fd2OtherInfo = 0;$committeeStatusId=0;$dataFromCommittee=0;
            $constitutionStatusId = 0;$dataFromConstitution = 0;

            $officeDetail = DuplicateCertificateOfficeSarok::where('pnote_dupid',$id)->get();

            $duplicateCertificateStatusId = DB::table('duplicate_certificate_daks')->where('id',$parentId)->value('duplicate_certificate_id');

            $dataFromDuplicateCertificate = DB::table('document_for_duplicate_certificates')
            ->join('fd_one_forms', 'fd_one_forms.id', '=', 'document_for_duplicate_certificates.fd_one_form_id')
            ->select('fd_one_forms.*','document_for_duplicate_certificates.*','document_for_duplicate_certificates.id as mainId')
            ->where('document_for_duplicate_certificates.id',$duplicateCertificateStatusId)
            ->orderBy('document_for_duplicate_certificates.id','desc')
            ->first();

           $get_email_from_user = DB::table('users')->where('id',$dataFromDuplicateCertificate->user_id)->value('email');

           $checkParent = ParentNoteForDuplicateCertificate::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

           $formNoFiveStatusId = 0;
            $dataFromNoFiveForm =0;

        }elseif($status == 'constitution'){
            $fdFourOneFormStatusId=0;
            $dataFdFourOneForm=0;
            $formNoFourStatusId=0;
                    $dataFromNoFourForm=0;

            $formNoSevenStatusId=0;
            $dataFromNoSevenForm=0;

            $formNoFiveStepThreeData=0;$formNoFiveStepTwoData=0;
            $formNoFiveStepFourData=0;
            $formNoFiveStepFiveOther=0;
           $formNoFiveStepFiveData=0;
           $formNoFiveStepFiveArea=0;

            $fdNineOtherFileList =0;$dataFromFdFive = 0;$fdFiveStatusId = 0;
            $dataFromFc2Form =0;$dataFromFc1Form =0; $prokolpoAreaList=0;$dataFromFd6Form = 0;
            $dataFromFd7Form = 0;$ngoStatus=0;$ngoTypeData=0;$nVisaDocs=0;
            $dataFromNVisaFd9Fd1=0;$nVisabasicInfo=0;$forwardingLetterOnulipi=0;$editCheck1=0;
            $editCheck=0;$statusData=0;$nVisaWorkPlace=0;$nVisaSponSor=0;$nVisaForeignerInfo=0;
            $nVisaManPower=0;$nVisaEmploye=0;$nVisaCompensationAndBenifits=0;$nVisaAuthPerson=0;
            $mainIdR=0;$renewInfoData=0;$mainIdFdNineOne =0;$form_one_data=0;
            $all_data_for_new_list_all=0;$form_eight_data=0;$form_member_data=0;$form_member_data_doc=0;
            $form_ngo_data_doc=0;$users_info=0;$all_source_of_fund=0;$all_partiw=0;
            $allNameChangeDoc = 0;$getformOneId= 0;$duration_list_all1 =0;$duration_list_all = 0;
            $renew_status = 0;$name_change_status = 0;$r_status = 0;$form_member_data_doc_renew =0;
            $get_all_data_adviser=0; $get_all_data_other=0;$get_all_data_adviser_bank=0;
            $fd_three_status_id =0;$dataFromFd3Form = 0;$fd2FormList = 0;$committeeStatusId=0;
            $dataFromCommittee=0;$fd2OtherInfo = 0;$dataFromDuplicateCertificate = 0;$duplicateCertificateStatusId = 0;

            $officeDetail = ConstitutionOfficeSarok::where('pnote_conid',$id)->get();
            $constitutionStatusId = DB::table('constitution_daks')->where('id',$parentId)->value('constitution_id');

            $dataFromConstitution = DB::table('document_for_amendment_or_approval_of_constitutions')
            ->join('fd_one_forms', 'fd_one_forms.id', '=', 'document_for_amendment_or_approval_of_constitutions.fdId')
            ->select('fd_one_forms.*','document_for_amendment_or_approval_of_constitutions.*','document_for_amendment_or_approval_of_constitutions.id as mainId')
            ->where('document_for_amendment_or_approval_of_constitutions.id',$constitutionStatusId)
            ->orderBy('document_for_amendment_or_approval_of_constitutions.id','desc')
            ->first();

           $get_email_from_user = DB::table('users')->where('id',$dataFromConstitution->user_id)->value('email');

            $checkParent = ParentNoteForConstitution::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

            $formNoFiveStatusId = 0;
            $dataFromNoFiveForm =0;

        }elseif($status == 'committee'){
            $fdFourOneFormStatusId=0;
            $dataFdFourOneForm=0;
            $formNoFourStatusId=0;
                    $dataFromNoFourForm=0;

            $formNoSevenStatusId=0;
            $dataFromNoSevenForm=0;
            $formNoFiveStepThreeData=0;$formNoFiveStepTwoData=0;
            $formNoFiveStepFourData=0;
            $formNoFiveStepFiveOther=0;
           $formNoFiveStepFiveData=0;
           $formNoFiveStepFiveArea=0;

            $dataFromFd3Form = 0;$dataFromDuplicateCertificate = 0;$dataFromConstitution = 0;
            $fd_three_status_id =0;$duplicateCertificateStatusId = 0;$constitutionStatusId = 0;
            $fdNineOtherFileList =0;$dataFromFdFive = 0;$fdFiveStatusId = 0;
            $dataFromFc2Form =0;$dataFromFc1Form =0; $prokolpoAreaList=0;$dataFromFd6Form = 0;
            $dataFromFd7Form = 0;$ngoStatus=0;$ngoTypeData=0;$nVisaDocs=0;
            $dataFromNVisaFd9Fd1=0;$nVisabasicInfo=0;$forwardingLetterOnulipi=0;$editCheck1=0;
            $editCheck=0;$statusData=0;$nVisaWorkPlace=0;$nVisaSponSor=0;$nVisaForeignerInfo=0;
            $nVisaManPower=0;$nVisaEmploye=0;$nVisaCompensationAndBenifits=0;$nVisaAuthPerson=0;
            $mainIdR=0;$renewInfoData=0;$mainIdFdNineOne =0;$form_one_data=0;
            $all_data_for_new_list_all=0;$form_eight_data=0;$form_member_data=0;$form_member_data_doc=0;
            $form_ngo_data_doc=0;$users_info=0;$all_source_of_fund=0;$all_partiw=0;
            $allNameChangeDoc = 0;$getformOneId= 0;$duration_list_all1 =0;$duration_list_all = 0;
            $renew_status = 0;$name_change_status = 0;$r_status = 0;$form_member_data_doc_renew =0;
            $get_all_data_adviser=0; $get_all_data_other=0;$get_all_data_adviser_bank=0;
            $fd2FormList = 0; $fd2OtherInfo = 0;

            $officeDetail = ExecutiveCommitteeOfficeSarok::where('pnote_exeid',$id)->get();

            $committeeStatusId = DB::table('executive_committee_daks')->where('id',$parentId)->value('executive_committee_id');

            $dataFromCommittee = DB::table('document_for_executive_committee_approvals')
            ->join('fd_one_forms', 'fd_one_forms.id', '=', 'document_for_executive_committee_approvals.fdId')
            ->select('fd_one_forms.*','document_for_executive_committee_approvals.*','document_for_executive_committee_approvals.id as mainId')
            ->where('document_for_executive_committee_approvals.id',$committeeStatusId)
            ->orderBy('document_for_executive_committee_approvals.id','desc')
            ->first();

            $get_email_from_user = DB::table('users')->where('id',$dataFromCommittee->user_id)->value('email');

            $checkParent = ParentNotForExecutiveCommittee::where('nothi_detail_id',$parentId)
            ->where('serial_number',$nothiId)->get();

            $formNoFiveStatusId = 0;
            $dataFromNoFiveForm =0;


        }elseif($status == 'fdFive'){

            $fdFourOneFormStatusId=0;
            $dataFdFourOneForm=0;
            $formNoFourStatusId=0;
                    $dataFromNoFourForm=0;

            $formNoSevenStatusId=0;
            $dataFromNoSevenForm=0;

            $formNoFiveStepThreeData=0;$formNoFiveStepTwoData=0;
            $formNoFiveStepFourData=0;
            $formNoFiveStepFiveOther=0;
           $formNoFiveStepFiveData=0;
           $formNoFiveStepFiveArea=0;

            $fdNineOtherFileList =0;$dataFromFc2Form =0;$dataFromFc1Form =0; $prokolpoAreaList=0;$dataFromFd6Form = 0;
            $dataFromFd7Form = 0;$ngoStatus=0;$ngoTypeData=0;$nVisaDocs=0;
            $dataFromNVisaFd9Fd1=0;$nVisabasicInfo=0;$forwardingLetterOnulipi=0;$editCheck1=0;
            $editCheck=0;$statusData=0;$nVisaWorkPlace=0;$nVisaSponSor=0;$nVisaForeignerInfo=0;
            $nVisaManPower=0;$nVisaEmploye=0;$nVisaCompensationAndBenifits=0;$nVisaAuthPerson=0;
            $mainIdR=0;$renewInfoData=0;$mainIdFdNineOne =0;$form_one_data=0;
            $all_data_for_new_list_all=0;$form_eight_data=0;$form_member_data=0;$form_member_data_doc=0;
            $form_ngo_data_doc=0;$users_info=0;$all_source_of_fund=0;$all_partiw=0;
            $allNameChangeDoc = 0;$getformOneId= 0;$duration_list_all1 =0;$duration_list_all = 0;
            $renew_status = 0;$name_change_status = 0;$r_status = 0;$form_member_data_doc_renew =0;
            $get_all_data_adviser=0; $get_all_data_other=0;$get_all_data_adviser_bank=0;
            $fd_three_status_id =0;$duplicateCertificateStatusId = 0;$constitutionStatusId = 0;
            $committeeStatusId = 0;$dataFromFd3Form = 0;$dataFromDuplicateCertificate = 0;
            $dataFromCommittee =0;$dataFromConstitution = 0; $dataFromCommittee =0;
            $fd2FormList = 0;$fd2OtherInfo = 0;

            $formNoFiveStatusId = 0;
            $dataFromNoFiveForm =0;

            $officeDetail = FdFiveOfficeSarok::where('pnote_fd_five',$id)->get();

            $fdFiveStatusId = DB::table('fd_five_daks')->where('id',$parentId)->value('fd_five_status_id');

            $dataFromFdFive = DB::table('fd_five_forms')
            ->join('fd_one_forms', 'fd_one_forms.id', '=', 'fd_five_forms.fdId')
            ->select('fd_one_forms.*','fd_five_forms.*','fd_five_forms.id as mainId')
            ->where('fd_five_forms.id',$fdFiveStatusId)
            ->orderBy('fd_five_forms.id','desc')
            ->first();

           $get_email_from_user = DB::table('users')->where('id',$dataFromFdFive->user_id)->value('email');

           $checkParent = ParentNoteForFdFive::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();


        }elseif($status == 'formNoFive'){

            $fdFourOneFormStatusId=0;
            $dataFdFourOneForm=0;
            $formNoFourStatusId=0;
                    $dataFromNoFourForm=0;

            $formNoSevenStatusId=0;
            $dataFromNoSevenForm=0;

            $fdFiveStatusId=0;
                    $dataFromFdFive=0;

            $fdNineOtherFileList =0;$dataFromFc2Form =0;$dataFromFc1Form =0; $prokolpoAreaList=0;$dataFromFd6Form = 0;
            $dataFromFd7Form = 0;$ngoStatus=0;$ngoTypeData=0;$nVisaDocs=0;
            $dataFromNVisaFd9Fd1=0;$nVisabasicInfo=0;$forwardingLetterOnulipi=0;$editCheck1=0;
            $editCheck=0;$statusData=0;$nVisaWorkPlace=0;$nVisaSponSor=0;$nVisaForeignerInfo=0;
            $nVisaManPower=0;$nVisaEmploye=0;$nVisaCompensationAndBenifits=0;$nVisaAuthPerson=0;
            $mainIdR=0;$renewInfoData=0;$mainIdFdNineOne =0;$form_one_data=0;
            $all_data_for_new_list_all=0;$form_eight_data=0;$form_member_data=0;$form_member_data_doc=0;
            $form_ngo_data_doc=0;$users_info=0;$all_source_of_fund=0;$all_partiw=0;
            $allNameChangeDoc = 0;$getformOneId= 0;$duration_list_all1 =0;$duration_list_all = 0;
            $renew_status = 0;$name_change_status = 0;$r_status = 0;$form_member_data_doc_renew =0;
            $get_all_data_adviser=0; $get_all_data_other=0;$get_all_data_adviser_bank=0;
            $fd_three_status_id =0;$duplicateCertificateStatusId = 0;$constitutionStatusId = 0;
            $committeeStatusId = 0;$dataFromFd3Form = 0;$dataFromDuplicateCertificate = 0;
            $dataFromCommittee =0;$dataFromConstitution = 0; $dataFromCommittee =0;
            $fd2FormList = 0;$fd2OtherInfo = 0;

            $officeDetail = FormNoFiveOfficeSarok::where('pnote_form_no_five',$id)->get();

            $formNoFiveStatusId = DB::table('form_no_five_daks')->where('id',$parentId)->value('form_no_five_status_id');

            $dataFromNoFiveForm = DB::table('form_no_fives')
            ->join('fd_one_forms', 'fd_one_forms.id', '=', 'form_no_fives.fd_one_form_id')
            ->select('fd_one_forms.*','form_no_fives.*','form_no_fives.id as mainId')
            ->where('form_no_fives.id',$formNoFiveStatusId)
            ->orderBy('form_no_fives.id','desc')
            ->first();

            $formNoFiveStepTwoData = DB::table('form_no_five_step_twos')->where('form_no_fives_id',$dataFromNoFiveForm->mainId)->get();
        $formNoFiveStepThreeData =DB::table('form_no_five_step_threes')->where('form_no_fives_id',$dataFromNoFiveForm->mainId)->get();
        $formNoFiveStepFourData = DB::table('form_no_five_step_fours')->where('form_no_fives_id',$dataFromNoFiveForm->mainId)->get();
        $formNoFiveStepFiveOther= DB::table('form_no_five_others')->where('form_no_fives_id',$dataFromNoFiveForm->mainId)->get();
        $formNoFiveStepFiveData = DB::table('form_no_five_step_fives')->where('form_no_fives_id',$dataFromNoFiveForm->mainId)->get();
        $formNoFiveStepFiveArea = DB::table('form_no_five_area_details')->where('form_no_fives_id',$dataFromNoFiveForm->mainId)->get();


           $get_email_from_user = DB::table('users')->where('id',$dataFromNoFiveForm->user_id)->value('email');

           $checkParent = ParentNoteForFormNoFiveDak::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();


        }elseif($status == 'formNoSeven'){

            $fdFourOneFormStatusId=0;
            $dataFdFourOneForm=0;
            $formNoFourStatusId=0;
                    $dataFromNoFourForm=0;

            $fdFiveStatusId=0;
                    $dataFromFdFive=0;
                    $formNoFourStatusId=0;
                    $dataFromNoFourForm=0;
            $fdNineOtherFileList =0;$dataFromFc2Form =0;$dataFromFc1Form =0; $prokolpoAreaList=0;$dataFromFd6Form = 0;
            $dataFromFd7Form = 0;$ngoStatus=0;$ngoTypeData=0;$nVisaDocs=0;
            $dataFromNVisaFd9Fd1=0;$nVisabasicInfo=0;$forwardingLetterOnulipi=0;$editCheck1=0;
            $editCheck=0;$statusData=0;$nVisaWorkPlace=0;$nVisaSponSor=0;$nVisaForeignerInfo=0;
            $nVisaManPower=0;$nVisaEmploye=0;$nVisaCompensationAndBenifits=0;$nVisaAuthPerson=0;
            $mainIdR=0;$renewInfoData=0;$mainIdFdNineOne =0;$form_one_data=0;
            $all_data_for_new_list_all=0;$form_eight_data=0;$form_member_data=0;$form_member_data_doc=0;
            $form_ngo_data_doc=0;$users_info=0;$all_source_of_fund=0;$all_partiw=0;
            $allNameChangeDoc = 0;$getformOneId= 0;$duration_list_all1 =0;$duration_list_all = 0;
            $renew_status = 0;$name_change_status = 0;$r_status = 0;$form_member_data_doc_renew =0;
            $get_all_data_adviser=0; $get_all_data_other=0;$get_all_data_adviser_bank=0;
            $fd_three_status_id =0;$duplicateCertificateStatusId = 0;$constitutionStatusId = 0;
            $committeeStatusId = 0;$dataFromFd3Form = 0;$dataFromDuplicateCertificate = 0;
            $dataFromCommittee =0;$dataFromConstitution = 0; $dataFromCommittee =0;
            $fd2FormList = 0;$fd2OtherInfo = 0;

            $officeDetail = FormNoSevenOfficeSarok::where('pnote_form_no_seven',$id)->get();

            $formNoSevenStatusId = DB::table('form_no_seven_daks')
            ->where('id',$parentId)->value('form_no_seven_status_id');

            $dataFromNoSevenForm = DB::table('form_no_sevens')
            ->join('fd_one_forms', 'fd_one_forms.id', '=', 'form_no_sevens.fd_one_form_id')
            ->select('fd_one_forms.*','form_no_sevens.*','form_no_sevens.id as mainId')
            ->where('form_no_sevens.id',$formNoSevenStatusId)
            ->orderBy('form_no_sevens.id','desc')
            ->first();

            $formNoFiveStatusId=0;
            $dataFromNoFiveForm=0;

        $formNoFiveStepTwoData = 0;
        $formNoFiveStepThreeData =0;
        $formNoFiveStepFourData = 0;
        $formNoFiveStepFiveOther= 0;
        $formNoFiveStepFiveData = 0;
        $formNoFiveStepFiveArea = 0;


           $get_email_from_user = DB::table('users')->where('id',$dataFromNoSevenForm->user_id)->value('email');

           $checkParent = ParentNoteForFormNoSeven::where('nothi_detail_id',$parentId)
           ->where('serial_number',$nothiId)->get();


        }elseif($status == 'formNoFour'){
            $formNoSevenStatusId=0;
            $fdFiveStatusId=0;
            $dataFromFdFive=0;
            $dataFromNoSevenForm=0;

            $fdNineOtherFileList =0;$dataFromFc2Form =0;$dataFromFc1Form =0; $prokolpoAreaList=0;$dataFromFd6Form = 0;
            $dataFromFd7Form = 0;$ngoStatus=0;$ngoTypeData=0;$nVisaDocs=0;
            $dataFromNVisaFd9Fd1=0;$nVisabasicInfo=0;$forwardingLetterOnulipi=0;$editCheck1=0;
            $editCheck=0;$statusData=0;$nVisaWorkPlace=0;$nVisaSponSor=0;$nVisaForeignerInfo=0;
            $nVisaManPower=0;$nVisaEmploye=0;$nVisaCompensationAndBenifits=0;$nVisaAuthPerson=0;
            $mainIdR=0;$renewInfoData=0;$mainIdFdNineOne =0;$form_one_data=0;
            $all_data_for_new_list_all=0;$form_eight_data=0;$form_member_data=0;$form_member_data_doc=0;
            $form_ngo_data_doc=0;$users_info=0;$all_source_of_fund=0;$all_partiw=0;
            $allNameChangeDoc = 0;$getformOneId= 0;$duration_list_all1 =0;$duration_list_all = 0;
            $renew_status = 0;$name_change_status = 0;$r_status = 0;$form_member_data_doc_renew =0;
            $get_all_data_adviser=0; $get_all_data_other=0;$get_all_data_adviser_bank=0;
            $fd_three_status_id =0;$duplicateCertificateStatusId = 0;$constitutionStatusId = 0;
            $committeeStatusId = 0;$dataFromFd3Form = 0;$dataFromDuplicateCertificate = 0;
            $dataFromCommittee =0;$dataFromConstitution = 0; $dataFromCommittee =0;
            $fd2FormList = 0;$fd2OtherInfo = 0;

            $officeDetail = FormNoFourOfficeSarok::where('pnote_form_no_four',$id)->get();

            $formNoFourStatusId = DB::table('form_no_four_daks')
            ->where('id',$parentId)->value('form_no_four_status_id');

            $dataFromNoFourForm = DB::table('form_no_fours')
            ->join('fd_one_forms', 'fd_one_forms.id', '=', 'form_no_fours.fd_one_form_id')
            ->select('fd_one_forms.*','form_no_fours.*','form_no_fours.id as mainId')
            ->where('form_no_fours.id',$formNoFourStatusId)
            ->orderBy('form_no_fours.id','desc')
            ->first();

            $formNoFiveStatusId=0;
            $dataFromNoFiveForm=0;

        $formNoFiveStepTwoData = 0;
        $formNoFiveStepThreeData =0;
        $formNoFiveStepFourData = 0;
        $formNoFiveStepFiveOther= 0;
        $formNoFiveStepFiveData = 0;
        $formNoFiveStepFiveArea = 0;

        $fdFourOneFormStatusId=0;
        $dataFdFourOneForm=0;

           $get_email_from_user = DB::table('users')
           ->where('id',$dataFromNoFourForm->user_id)->value('email');

           $checkParent = ParentNoteForFormNoFour::where('nothi_detail_id',$parentId)
           ->where('serial_number',$nothiId)->get();


        }elseif($status == 'fdFourOneForm'){
            $formNoSevenStatusId=0;
            $fdFiveStatusId=0;
            $dataFromFdFive=0;
            $dataFromNoSevenForm=0;

            $formNoFourStatusId=0;
            $dataFromNoFourForm=0;

            $fdNineOtherFileList =0;$dataFromFc2Form =0;$dataFromFc1Form =0; $prokolpoAreaList=0;$dataFromFd6Form = 0;
            $dataFromFd7Form = 0;$ngoStatus=0;$ngoTypeData=0;$nVisaDocs=0;
            $dataFromNVisaFd9Fd1=0;$nVisabasicInfo=0;$forwardingLetterOnulipi=0;$editCheck1=0;
            $editCheck=0;$statusData=0;$nVisaWorkPlace=0;$nVisaSponSor=0;$nVisaForeignerInfo=0;
            $nVisaManPower=0;$nVisaEmploye=0;$nVisaCompensationAndBenifits=0;$nVisaAuthPerson=0;
            $mainIdR=0;$renewInfoData=0;$mainIdFdNineOne =0;$form_one_data=0;
            $all_data_for_new_list_all=0;$form_eight_data=0;$form_member_data=0;$form_member_data_doc=0;
            $form_ngo_data_doc=0;$users_info=0;$all_source_of_fund=0;$all_partiw=0;
            $allNameChangeDoc = 0;$getformOneId= 0;$duration_list_all1 =0;$duration_list_all = 0;
            $renew_status = 0;$name_change_status = 0;$r_status = 0;$form_member_data_doc_renew =0;
            $get_all_data_adviser=0; $get_all_data_other=0;$get_all_data_adviser_bank=0;
            $fd_three_status_id =0;$duplicateCertificateStatusId = 0;$constitutionStatusId = 0;
            $committeeStatusId = 0;$dataFromFd3Form = 0;$dataFromDuplicateCertificate = 0;
            $dataFromCommittee =0;$dataFromConstitution = 0; $dataFromCommittee =0;
            $fd2FormList = 0;$fd2OtherInfo = 0;

            $officeDetail = FdFourOneFormOfficeSarok::where('pnote_fd_four_one_form',$id)->get();

            $fdFourOneFormStatusId = DB::table('fd4_one_form_daks')
            ->where('id',$parentId)->value('fd4_one_form_status_id');

            $dataFdFourOneForm = DB::table('fd_four_one_forms')
            ->join('fd_one_forms', 'fd_one_forms.id', '=', 'fd_four_one_forms.fd_one_form_id')
            ->select('fd_one_forms.*','fd_four_one_forms.*','fd_four_one_forms.id as mainId')
            ->where('fd_four_one_forms.id',$fdFourOneFormStatusId)
            ->orderBy('fd_four_one_forms.id','desc')
            ->first();

            $formNoFiveStatusId=0;
            $dataFromNoFiveForm=0;

        $formNoFiveStepTwoData = 0;
        $formNoFiveStepThreeData =0;
        $formNoFiveStepFourData = 0;
        $formNoFiveStepFiveOther= 0;
        $formNoFiveStepFiveData = 0;
        $formNoFiveStepFiveArea = 0;


           $get_email_from_user = DB::table('users')
           ->where('id',$dataFdFourOneForm->user_id)->value('email');

           $checkParent = ParentNoteForFdFourOneForm::
           where('nothi_detail_id',$parentId)
           ->where('serial_number',$nothiId)->get();


        }


        $nothiNumber = NothiList::where('id',$nothiId)->value('main_sarok_number');
        $nothiYear = NothiList::where('id',$nothiId)->value('document_year');
        $user = Admin::where('id','!=',1)->get();


        $nothiPropokListUpdate = NothiPrapok::where('nothiId',$nothiId)
        ->where('noteId',$id)->where('status',1)->get();
        $nothiAttractListUpdate = NothiAttarct::where('nothiId',$nothiId)
        ->where('noteId',$id)->where('status',1)->get();
        $nothiCopyListUpdate = NothiCopy::where('nothiId',$nothiId)
        ->where('noteId',$id)->where('status',1)->get();

        $permissionNothiList = NothiPermission::where('nothId',$nothiId)->get();

        $convert_name_title = $permissionNothiList->implode("designationId", " ");
        $separated_data_title = explode(" ", $convert_name_title);

        $branchListForSerial = DesignationList::whereIn('id',$separated_data_title) ->orderBy('designation_serial','asc')->get();


        //new code december 23

        if($status == 'registration'){

            $checkParentFirst = DB::table('parent_note_for_registrations')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
            $childNoteNewList = DB::table('child_note_for_registrations')->where('parent_note_regid',$id)->get();
            $childNoteNewListValue = DB::table('child_note_for_registrations')->where('parent_note_regid',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }elseif($status == 'renew'){

            $checkParentFirst = DB::table('parent_note_for_renews')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
            $childNoteNewList = DB::table('child_note_for_renews')->where('parent_note_for_renew_id',$id)->get();
            $childNoteNewListValue = DB::table('child_note_for_renews')->where('parent_note_for_renew_id',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }elseif($status == 'nameChange'){

            $checkParentFirst = DB::table('parent_note_for_name_changes')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
            $childNoteNewList = DB::table('child_note_for_name_changes')->where('parentnote_name_change_id',$id)->get();
            $childNoteNewListValue = DB::table('child_note_for_name_changes')->where('parentnote_name_change_id',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }elseif($status == 'fdNine'){

            $checkParentFirst = DB::table('parent_note_for_fd_nines')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
            $childNoteNewList = DB::table('child_note_for_fd_nines')->where('p_note_for_fd_nine_id',$id)->get();
            $childNoteNewListValue = DB::table('child_note_for_fd_nines')->where('p_note_for_fd_nine_id',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }elseif($status == 'fdNineOne'){

            $checkParentFirst = DB::table('parent_note_for_fd_nine_ones')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
            $childNoteNewList = DB::table('child_note_for_fd_nine_ones')->where('p_note_for_fd_nine_one_id',$id)->get();
            $childNoteNewListValue = DB::table('child_note_for_fd_nine_ones')->where('p_note_for_fd_nine_one_id',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }elseif($status == 'fdSix'){

            $checkParentFirst = DB::table('parent_note_for_fdsixes')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
            $childNoteNewList = DB::table('child_note_for_fd_sixes')->where('parent_note_for_fdsix_id',$id)->get();
            $childNoteNewListValue = DB::table('child_note_for_fd_sixes')->where('parent_note_for_fdsix_id',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }elseif($status == 'fdSeven'){

            $checkParentFirst = DB::table('parent_note_for_fd_sevens')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
            $childNoteNewList = DB::table('child_note_for_fd_sevens')->where('parent_note_for_fd_seven_id',$id)->get();
            $childNoteNewListValue = DB::table('child_note_for_fd_sevens')->where('parent_note_for_fd_seven_id',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }elseif($status == 'fcOne'){

            $checkParentFirst = DB::table('parent_note_for_fc_ones')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
            $childNoteNewList = DB::table('child_note_for_fc_ones')->where('parent_note_for_fc_one_id',$id)->get();
            $childNoteNewListValue = DB::table('child_note_for_fc_ones')->where('parent_note_for_fc_one_id',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }elseif($status == 'fcTwo'){

            $checkParentFirst = DB::table('parent_note_for_fc_twos')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
            $childNoteNewList = DB::table('child_note_for_fc_twos')->where('parent_note_for_fc_two_id',$id)->get();
            $childNoteNewListValue = DB::table('child_note_for_fc_twos') ->where('parent_note_for_fc_two_id',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }elseif($status == 'fdThree'){

            $checkParentFirst = DB::table('parent_note_for_fd_threes')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
            $childNoteNewList = DB::table('child_note_for_fd_threes')->where('parent_note_for_fd_three_id',$id)->get();
            $childNoteNewListValue = DB::table('child_note_for_fd_threes')->where('parent_note_for_fd_three_id',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }elseif($status == 'fdFive'){

            $checkParentFirst = DB::table('parent_note_for_fd_fives')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
            $childNoteNewList = DB::table('child_note_for_fd_fives')->where('pnote_fd_five',$id)->get();
            $childNoteNewListValue = DB::table('child_note_for_fd_fives')->where('pnote_fd_five',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }elseif($status == 'formNoFive'){

            $checkParentFirst = DB::table('parent_note_for_form_no_five_daks')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
            $childNoteNewList = DB::table('child_note_for_form_no_fives')->where('pnote_form_no_five',$id)->get();
            $childNoteNewListValue = DB::table('child_note_for_form_no_fives')->where('pnote_form_no_five',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }elseif($status == 'formNoSeven'){

            $checkParentFirst = DB::table('parent_note_for_form_no_sevens')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
            $childNoteNewList = DB::table('child_note_for_form_no_sevens')->where('pnote_form_no_seven',$id)->get();
            $childNoteNewListValue = DB::table('child_note_for_form_no_sevens')->where('pnote_form_no_seven',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }elseif($status == 'formNoFour'){

            $checkParentFirst = DB::table('parent_note_for_form_no_fours')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
            $childNoteNewList = DB::table('child_note_for_form_no_fours')->where('pnote_form_no_four',$id)->get();
            $childNoteNewListValue = DB::table('child_note_for_form_no_fours')->where('pnote_form_no_four',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }elseif($status == 'fdFourOneForm'){

            $checkParentFirst = DB::table('parent_note_for_fd_four_one_forms')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
            $childNoteNewList = DB::table('child_note_for_fd_four_one_forms')->where('pnote_fd_four_one_form',$id)->get();
            $childNoteNewListValue = DB::table('child_note_for_fd_four_one_forms')->where('pnote_fd_four_one_form',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }elseif($status == 'duplicate'){

            $checkParentFirst = DB::table('parent_note_for_duplicate_certificates')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
            $childNoteNewList = DB::table('child_note_for_duplicate_certificates')->where('pnote_dupid',$id)->get();
            $childNoteNewListValue = DB::table('child_note_for_duplicate_certificates')->where('pnote_dupid',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }elseif($status == 'constitution'){

            $checkParentFirst = DB::table('parent_note_for_constitutions')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
            $childNoteNewList = DB::table('child_note_for_constitutions')->where('pnote_conid',$id)->get();
            $childNoteNewListValue = DB::table('child_note_for_constitutions')->where('pnote_conid',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }elseif($status == 'committee'){

            $checkParentFirst = DB::table('parent_not_for_executive_committees')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
            $childNoteNewList = DB::table('child_note_for_executive_committees')->where('pnote_exeid',$id)->get();
            $childNoteNewListValue = DB::table('child_note_for_executive_committees')->where('pnote_exeid',$id)->whereNull('sent_status')->orwhere('sent_status',1)->value('id');

        }

        return view('admin.presentDocument.addChildNote',compact(
            'fdFourOneFormStatusId',
            'dataFdFourOneForm',
            'formNoFourStatusId',
            'dataFromNoFourForm',
            'formNoSevenStatusId',
            'dataFromNoSevenForm',
            'formNoFiveStepTwoData',
            'formNoFiveStepThreeData',
            'formNoFiveStepFourData',
            'formNoFiveStepFiveOther',
            'formNoFiveStepFiveData',
            'formNoFiveStepFiveArea',
            'formNoFiveStatusId',
            'dataFromNoFiveForm',
            'fdNineOtherFileList',
            'dataFromFdFive',
            'fdFiveStatusId',
            'committeeStatusId',
            'dataFromCommittee',
            'constitutionStatusId',
            'dataFromConstitution',
            'duplicateCertificateStatusId',
            'dataFromDuplicateCertificate',
            'get_email_from_user',
            'dataFromFd6Form',
            'fd2FormList',
            'fd2OtherInfo',
            'prokolpoAreaList',
            'dataFromFd7Form',
            'dataFromFc1Form',
            'dataFromFc2Form',
            'dataFromFd3Form',
            'mainIdFdNineOne',
            'nVisabasicInfo',
            'forwardingLetterOnulipi',
            'editCheck1',
            'editCheck',
            'statusData',
            'ngoStatus',
            'nVisaWorkPlace',
            'nVisaSponSor',
            'nVisaForeignerInfo',
            'nVisaManPower',
            'nVisaEmploye',
            'nVisaCompensationAndBenifits',
            'nVisaAuthPerson',
            'nVisaDocs',
            'dataFromNVisaFd9Fd1',
            'allNameChangeDoc',
            'getformOneId',
            'duration_list_all1',
            'duration_list_all',
            'r_status',
            'ngoTypeData',
            'renewInfoData',
            'mainIdR',
            'renew_status',
            'name_change_status',
            'form_member_data_doc_renew',
            'get_all_data_adviser',
            'get_all_data_other',
            'get_all_data_adviser_bank',
            'all_partiw',
            'all_source_of_fund',
            'users_info',
            'form_ngo_data_doc',
            'form_member_data_doc',
            'form_member_data',
            'form_eight_data',
            'all_data_for_new_list_all',
            'form_one_data',
            'childNoteNewListValue',
            'childNoteNewList',
            'checkParentFirst',
            'nothiYear',
            'branchListForSerial',
            'permissionNothiList',
            'nothiCopyListUpdate',
            'nothiAttractListUpdate',
            'nothiPropokListUpdate',
            'user',
            'nothiId',
            'nothiNumber',
            'officeDetail',
            'checkParent',
            'status',
            'id',
            'parentId',
            'activeCode'
        ));

    } catch (\Exception $e) {
         return redirect()->route('error_404')->with('error','some thing went wrong ');
    }
    }


    public function viewChildNote($status,$parentId,$nothiId,$id,$activeCode){

        //dd($status. $parentId. $id);
        try{
            if($status == 'registration'){

                $fdFourOneFormStatusId=0;
                $dataFdFourOneForm=0;
                $formNoFourStatusId=0;
                        $dataFromNoFourForm=0;

                $formNoSevenStatusId=0;
            $dataFromNoSevenForm=0;

                $formNoFiveStepThreeData=0;$formNoFiveStepTwoData=0;
            $formNoFiveStepFourData=0;
            $formNoFiveStepFiveOther=0;
           $formNoFiveStepFiveData=0;
           $formNoFiveStepFiveArea=0;

                $formNoFiveStatusId = 0;
                $dataFromNoFiveForm =0;
                $fdNineOtherFileList =0;$dataFromFdFive = 0;$fdFiveStatusId = 0;$committeeStatusId=0;
                $dataFromCommittee=0;$constitutionStatusId = 0;$dataFromConstitution = 0;$duplicateCertificateStatusId = 0;
                $dataFromDuplicateCertificate = 0;$mainIdR = '';$fdOneFormId = '';$renewInfoData = '';
                $dataFromFd3Form = 0;$dataFromNVisaFd9Fd1='';$allNameChangeDoc = '';$getformOneId='';
                $nVisaDocs='';$ngoStatus='';$get_email_from_user=0;$mainIdFdNineOne=0;$nVisabasicInfo=0;
                $forwardingLetterOnulipi=0;$editCheck1=0;$editCheck=0;$statusData=0;$nVisaWorkPlace=0;
                $nVisaSponSor=0;$nVisaForeignerInfo=0;$nVisaManPower=0;$nVisaEmploye=0; $nVisaCompensationAndBenifits=0;
                $nVisaAuthPerson=0;$dataFromFc1Form=0;$dataFromFd6Form =0;$fd2FormList=0;$fd2OtherInfo=0;
                $prokolpoAreaList=0;$dataFromFd7Form=0;$dataFromFc2Form=0;


                $officeDetail = RegistrationOfficeSarok::where('parent_note_regid',$id)->get();
                $checkParent = ParentNoteForRegistration::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

                $registration_status_id = DB::table('ngo_registration_daks')->where('id',$parentId)->value('registration_status_id');
                $fdOneIdForNothi = DB::table('ngo_statuses')->where('id',$registration_status_id)->value('fd_one_form_id');
                $r_status = DB::table('ngo_statuses')->where('fd_one_form_id',$fdOneIdForNothi)->value('status');
                $name_change_status = DB::table('ngo_name_changes')->where('fd_one_form_id',$fdOneIdForNothi)->value('status');
                $renew_status = DB::table('ngo_renews')->where('fd_one_form_id',$fdOneIdForNothi)->value('status');
                $all_data_for_new_list_all = DB::table('ngo_statuses')->where('fd_one_form_id',$fdOneIdForNothi)->first();
                $form_one_data = DB::table('fd_one_forms')->where('id',$fdOneIdForNothi)->first();
                $ngoTypeData = DB::table('ngo_type_and_languages')->where('user_id',$form_one_data->user_id)->first();
                $signDataNew = DB::table('form_eights')->where('fd_one_form_id',$fdOneIdForNothi)->first();
                $form_eight_data = DB::table('form_eights')->where('fd_one_form_id',$fdOneIdForNothi)->get();
                $form_member_data = DB::table('ngo_member_lists')->where('fd_one_form_id',$fdOneIdForNothi)->get();
                $form_member_data_doc_renew = DB::table('ngo_renew_infos')->where('fd_one_form_id',$fdOneIdForNothi)->get();
                $duration_list_all1 = DB::table('ngo_durations')->where('fd_one_form_id',$fdOneIdForNothi)->value('ngo_duration_end_date');
                $duration_list_all = DB::table('ngo_durations')->where('fd_one_form_id',$fdOneIdForNothi)->value('ngo_duration_start_date');
                $form_member_data_doc = DB::table('ngo_member_nid_photos')->where('fd_one_form_id',$fdOneIdForNothi)->get();
                $form_ngo_data_doc = DB::table('ngo_other_docs')->where('fd_one_form_id',$fdOneIdForNothi)->get();
                $users_info = DB::table('users')->where('id',$form_one_data->user_id)->first();
                $all_source_of_fund = DB::table('fd_one_source_of_funds')->where('fd_one_form_id',$form_one_data->id)->get();
                $all_partiw = DB::table('fd_one_member_lists')->where('fd_one_form_id',$form_one_data->id)->get();
                $get_all_data_adviser_bank = DB::table('fd_one_bank_accounts')->where('fd_one_form_id',$form_one_data->id)->first();
                $get_all_data_other= DB::table('fd_one_other_pdf_lists')->where('fd_one_form_id',$form_one_data->id)->get();
                $get_all_data_adviser = DB::table('fd_one_adviser_lists')->where('fd_one_form_id',$form_one_data->id)->get();


                }elseif($status == 'renew'){

                    $fdFourOneFormStatusId=0;
                    $dataFdFourOneForm=0;
                    $formNoFourStatusId=0;
                            $dataFromNoFourForm=0;

                    $formNoSevenStatusId=0;
            $dataFromNoSevenForm=0;

                    $formNoFiveStepThreeData=0;$formNoFiveStepTwoData=0;
            $formNoFiveStepFourData=0;
            $formNoFiveStepFiveOther=0;
           $formNoFiveStepFiveData=0;
           $formNoFiveStepFiveArea=0;


                    $formNoFiveStatusId = 0;
                    $dataFromNoFiveForm =0;
                    $fdNineOtherFileList =0;$dataFromFdFive = 0;$fdFiveStatusId = 0;$committeeStatusId=0;
                    $dataFromCommittee=0;$constitutionStatusId = 0;$dataFromConstitution = 0;$duplicateCertificateStatusId = 0;
                    $dataFromDuplicateCertificate = 0;$dataFromFd3Form = 0;$allNameChangeDoc = '';
                    $getformOneId='';$ngoTypeData = '';$dataFromNVisaFd9Fd1=''; $nVisaDocs='';
                    $ngoStatus='';$get_email_from_user=0;$mainIdFdNineOne=0;$nVisabasicInfo=0;$forwardingLetterOnulipi=0;
                    $editCheck1=0;$editCheck=0;$statusData=0;$nVisaWorkPlace=0;$nVisaSponSor=0;
                    $nVisaForeignerInfo=0;$nVisaManPower=0;$nVisaEmploye=0;$nVisaCompensationAndBenifits=0;
                    $nVisaAuthPerson=0;$dataFromFc1Form=0;$dataFromFd6Form =0;$fd2FormList=0;
                    $fd2OtherInfo=0;$prokolpoAreaList=0;$dataFromFd7Form=0;$dataFromFc2Form=0;
                    $ngoTypeData = '';


                    $officeDetail = RenewOfficeSarok::where('parent_note_for_renew_id',$id)->get();
                    $checkParent = ParentNoteForRenew::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

                    $renew_status_id = DB::table('ngo_renew_daks')->where('id',$parentId)->value('renew_status_id');
                    $mainIdR = DB::table('ngo_renews')->where('id',$renew_status_id)->first();
                    $fdOneFormId = DB::table('ngo_renews')->where('id',$renew_status_id)->first();
                    $form_one_data = DB::table('fd_one_forms')->where('id',$fdOneFormId->fd_one_form_id)->first();
                    $r_status = DB::table('ngo_renews')->where('fd_one_form_id',$form_one_data->id)->value('status');
                    $name_change_status = DB::table('ngo_name_changes')->where('fd_one_form_id',$form_one_data->id)->value('status');
                    $renew_status = DB::table('ngo_renews')->where('id',$id)->value('status');
                    $all_data_for_new_list_all = DB::table('ngo_renews')->where('fd_one_form_id',$form_one_data->id)->first();
                    $form_eight_data = DB::table('form_eights')->where('fd_one_form_id',$form_one_data->id)->get();
                    $form_member_data = DB::table('ngo_member_lists')->where('fd_one_form_id',$form_one_data->id)->get();
                    $renewInfoData = DB::table('ngo_renew_infos')->where('fd_one_form_id',$fdOneFormId->fd_one_form_id)->first();
                    $form_member_data_doc_renew = DB::table('ngo_renew_infos')->where('fd_one_form_id',$fdOneFormId->fd_one_form_id)->get();
                    $duration_list_all1 = DB::table('ngo_durations')->where('fd_one_form_id',$fdOneFormId->fd_one_form_id)->value('ngo_duration_end_date');
                    $duration_list_all = DB::table('ngo_durations')->where('fd_one_form_id',$fdOneFormId->fd_one_form_id)->value('ngo_duration_start_date');
                    $form_member_data_doc = DB::table('ngo_member_nid_photos')->where('fd_one_form_id',$fdOneFormId->fd_one_form_id)->get();
                    $form_ngo_data_doc = DB::table('ngo_other_docs')->where('fd_one_form_id',$fdOneFormId->fd_one_form_id)->get();
                    $users_info = DB::table('users')->where('id',$form_one_data->user_id)->first();
                    $all_source_of_fund = DB::table('fd_one_source_of_funds')->where('fd_one_form_id',$form_one_data->id)->get();
                    $all_partiw = DB::table('fd_one_member_lists')->where('fd_one_form_id',$form_one_data->id)->get();
                    $get_all_data_adviser_bank = DB::table('fd_one_bank_accounts')->where('fd_one_form_id',$form_one_data->id)->first();
                    $get_all_data_other= DB::table('fd_one_other_pdf_lists')->where('fd_one_form_id',$form_one_data->id)->get();
                    $get_all_data_adviser = DB::table('fd_one_adviser_lists')->where('fd_one_form_id',$form_one_data->id)->get();

                }elseif($status == 'nameChange'){

                    $fdFourOneFormStatusId=0;
                    $dataFdFourOneForm=0;
                    $formNoFourStatusId=0;
                            $dataFromNoFourForm=0;

                    $formNoSevenStatusId=0;
            $dataFromNoSevenForm=0;

                    $formNoFiveStepThreeData=0;$formNoFiveStepTwoData=0;
            $formNoFiveStepFourData=0;
            $formNoFiveStepFiveOther=0;
           $formNoFiveStepFiveData=0;
           $formNoFiveStepFiveArea=0;

                    $formNoFiveStatusId = 0;
                    $dataFromNoFiveForm =0;
                    $fdNineOtherFileList =0;$committeeStatusId=0;$dataFromCommittee=0;$constitutionStatusId = 0;
                    $dataFromConstitution = 0;$duplicateCertificateStatusId = 0;$dataFromDuplicateCertificate = 0;
                    $dataFromFd3Form = 0;$renewInfoData='';$ngoTypeData = '';$mainIdR ='';
                    $dataFromNVisaFd9Fd1='';$nVisaDocs='';$ngoStatus='';$get_email_from_user=0;
                    $mainIdFdNineOne=0;$nVisabasicInfo=0;$forwardingLetterOnulipi=0; $editCheck1=0;
                    $editCheck=0;$statusData=0;$nVisaWorkPlace=0;$nVisaSponSor=0;$nVisaForeignerInfo=0;
                    $nVisaManPower=0;$nVisaEmploye=0;$nVisaCompensationAndBenifits=0;$nVisaAuthPerson=0;
                    $dataFromFdFive = 0;$fdFiveStatusId = 0;$dataFromFd6Form =0;$fd2FormList=0;
                    $fd2OtherInfo=0;$prokolpoAreaList=0;$dataFromFc1Form=0;$dataFromFc2Form=0;$dataFromFd7Form=0;

                    $name_change_status_id = DB::table('ngo_name_change_daks')->where('id',$parentId)->value('name_change_status_id');

                    $allNameChangeDoc = DB::table('name_change_docs')->where('ngo_name_change_id',$name_change_status_id)->get();
                    $getformOneId = DB::table('ngo_name_changes')->where('id',$name_change_status_id)->first();
                    $form_one_data = DB::table('fd_one_forms')->where('id',$getformOneId->fd_one_form_id)->first();
                    $r_status = DB::table('ngo_statuses')->where('fd_one_form_id',$form_one_data->id)->value('status');
                    $name_change_status = DB::table('ngo_name_changes')->where('id',$name_change_status_id)->value('status');
                    $renew_status = DB::table('ngo_renews')->where('fd_one_form_id',$form_one_data->id)->value('status');

                    $checkOldorNew = DB::table('ngo_type_and_languages')->where('user_id',$form_one_data->user_id)->value('ngo_type_new_old');

                    //end new code for old and new

                    if($checkOldorNew == 'Old'){

                    $all_data_for_new_list_all = DB::table('ngo_renews')
                    ->where('fd_one_form_id',$form_one_data->id)->first();
                    }else{

                    $all_data_for_new_list_all = DB::table('ngo_statuses')
                    ->where('fd_one_form_id',$form_one_data->id)->first();
                    }

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
                    $get_all_data_adviser_bank = DB::table('fd_one_bank_accounts')->where('fd_one_form_id',$form_one_data->id)->first();
                    $get_all_data_other= DB::table('fd_one_other_pdf_lists')->where('fd_one_form_id',$form_one_data->id)->get();
                    $get_all_data_adviser = DB::table('fd_one_adviser_lists')->where('fd_one_form_id',$form_one_data->id)->get();

                    $officeDetail = NameChangeOfficeSarok::where('parentnote_name_change_id',$id)->get();
                    $checkParent = ParentNoteForNameChange::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();



                }elseif($status == 'fdNine'){

                    $fdFourOneFormStatusId=0;
                    $dataFdFourOneForm=0;
                    $formNoFourStatusId=0;
                            $dataFromNoFourForm=0;

                    $formNoSevenStatusId=0;
            $dataFromNoSevenForm=0;

                    $formNoFiveStepThreeData=0;$formNoFiveStepTwoData=0;
            $formNoFiveStepFourData=0;
            $formNoFiveStepFiveOther=0;
           $formNoFiveStepFiveData=0;
           $formNoFiveStepFiveArea=0;
                    $formNoFiveStatusId = 0;
                    $dataFromNoFiveForm =0;
                    $dataFromFdFive = 0;$fdFiveStatusId = 0;$committeeStatusId=0;$dataFromCommittee=0;
                    $constitutionStatusId = 0;$dataFromConstitution = 0;$duplicateCertificateStatusId = 0;
                    $dataFromDuplicateCertificate = 0;$dataFromFd3Form = 0;$get_email_from_user=0;
                    $mainIdFdNineOne=0;$nVisabasicInfo=0;$forwardingLetterOnulipi=0;$editCheck1=0;
                    $editCheck=0;$statusData=0;$nVisaWorkPlace=0;$nVisaSponSor=0;$nVisaForeignerInfo=0;
                    $nVisaManPower=0;$nVisaEmploye=0;$nVisaCompensationAndBenifits=0;$nVisaAuthPerson=0;
                    $mainIdR=0;$renewInfoData=0;$form_one_data=0;$all_data_for_new_list_all=0;
                    $form_eight_data=0;$form_member_data=0;$form_member_data_doc=0;$form_ngo_data_doc=0;
                    $users_info=0;$all_source_of_fund=0;$all_partiw=0;$allNameChangeDoc = 0;
                    $getformOneId= 0;$duration_list_all1 =0;$duration_list_all = 0;$renew_status = 0;
                    $name_change_status = 0;$r_status = 0;$form_member_data_doc_renew =0;$get_all_data_adviser=0;
                    $get_all_data_other=0;$get_all_data_adviser_bank=0;$dataFromFd6Form =0;
                    $fd2FormList=0;$fd2OtherInfo=0;$prokolpoAreaList=0;$dataFromFd7Form=0;
                    $dataFromFc1Form=0;$dataFromFc2Form=0;

                    $fd_nine_status_id = DB::table('ngo_f_d_nine_daks')->where('id',$parentId)->value('f_d_nine_status_id');

                    $dataFromNVisaFd9Fd1 = DB::table('fd9_forms')
                    ->join('fd_one_forms', 'fd_one_forms.id', '=', 'fd9_forms.fd_one_form_id')
                    ->select('fd_one_forms.*','fd9_forms.*')
                    ->where('fd9_forms.id',$fd_nine_status_id)
                    ->first();

                   $fdNineOtherFileList = DB::table('fd_nine_other_files')->where('fd9_form_id',$fd_nine_status_id)->get();

                    //new code for old  and new
                    $ngoTypeData = DB::table('ngo_type_and_languages')
                    ->where('user_id',$dataFromNVisaFd9Fd1->user_id)->first();
                    $checkOldorNew = DB::table('ngo_type_and_languages')
                    ->where('user_id',$dataFromNVisaFd9Fd1->user_id)->value('ngo_type_new_old');
                    //end new code for old and new

                    if($checkOldorNew == 'Old'){

                        $ngoStatus = DB::table('ngo_renews')
                        ->where('fd_one_form_id',$dataFromNVisaFd9Fd1->fd_one_form_id)->first();
                    }else{

                        $ngoStatus = DB::table('ngo_statuses')
                        ->where('fd_one_form_id',$dataFromNVisaFd9Fd1->fd_one_form_id)->first();
                    }

                    $nVisaDocs = DB::table('n_visa_necessary_document_for_work_permits')->where('n_visa_id',$dataFromNVisaFd9Fd1->id)->first();
                    $officeDetail = FdNineOfficeSarok::where('p_note_for_fd_nine_id',$id)->get();
                    $checkParent = ParentNoteForFdNine::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

                }elseif($status == 'fdNineOne'){

                    $fdFourOneFormStatusId=0;
                    $dataFdFourOneForm=0;
                    $formNoFourStatusId=0;
                            $dataFromNoFourForm=0;

                    $formNoSevenStatusId=0;
            $dataFromNoSevenForm=0;

                    $formNoFiveStepThreeData=0;$formNoFiveStepTwoData=0;
            $formNoFiveStepFourData=0;
            $formNoFiveStepFiveOther=0;
           $formNoFiveStepFiveData=0;
           $formNoFiveStepFiveArea=0;

                    $formNoFiveStatusId = 0;
                    $dataFromNoFiveForm =0;
                    $fdNineOtherFileList =0;$committeeStatusId=0;$dataFromCommittee=0;
                    $constitutionStatusId = 0;$dataFromConstitution = 0;$duplicateCertificateStatusId = 0;
                    $dataFromDuplicateCertificate = 0;$dataFromFdFive = 0;$fdFiveStatusId = 0;
                    $dataFromFd3Form = 0;$dataFromFd6Form =0;$fd2FormList=0;$fd2OtherInfo=0;
                    $prokolpoAreaList=0;$mainIdR=0;$renewInfoData=0;$dataFromFd7Form=0;$form_one_data=0;
                    $all_data_for_new_list_all=0;$form_eight_data=0;$form_member_data=0;$form_member_data_doc=0;
                    $form_ngo_data_doc=0;$users_info=0;$all_source_of_fund=0;$all_partiw=0;$allNameChangeDoc = 0;
                    $getformOneId= 0;$duration_list_all1 =0;$duration_list_all = 0;$renew_status = 0;
                    $name_change_status = 0;$r_status = 0;$form_member_data_doc_renew =0;
                    $get_all_data_adviser=0;$get_all_data_other=0;$get_all_data_adviser_bank=0;
                    $dataFromFc1Form=0;$dataFromFc2Form=0;

                    $fd_nine_one_status_id = DB::table('ngo_f_d_nine_one_daks')->where('id',$parentId)->value('f_d_nine_one_status_id');

                    $mainIdFdNineOne = $fd_nine_one_status_id;

                    $dataFromNVisaFd9Fd1 = DB::table('fd9_one_forms')
                            ->join('fd_one_forms', 'fd9_one_forms.fd_one_form_id', '=', 'fd_one_forms.id')
                            ->select('fd_one_forms.*','fd9_one_forms.*','fd9_one_forms.id as mainId','fd9_one_forms.chief_name as chiefName','fd9_one_forms.chief_desi as chiefDesi','fd9_one_forms.digital_signature as chiefSign','fd9_one_forms.digital_seal as chiefSeal','fd9_one_forms.created_at as chiefDate')
                            ->orderBy('fd9_one_forms.id','desc')
                            ->where('fd9_one_forms.id',$fd_nine_one_status_id)
                            ->first();

                    $get_email_from_user = DB::table('users')->where('id',$dataFromNVisaFd9Fd1->user_id)->value('email');
                    $forwardId =  DB::table('forwarding_letters')->where('fd9_form_id',$dataFromNVisaFd9Fd1->mainId)->orderBy('id','desc')->value('id');
                    $forwardingLetterOnulipi = DB::table('forwarding_letter_onulipis')->where('forwarding_letter_id',$forwardId)->get();
                    $editCheck = DB::table('fd9_forwarding_letter_edits')->where('forwarding_letter_id',$forwardId)->orderBy('id','desc')->value('pdf_part_one');
                    $editCheck1 = DB::table('fd9_forwarding_letter_edits')->where('forwarding_letter_id',$forwardId)->orderBy('id','desc')->value('pdf_part_two');
                    $ngoTypeData = DB::table('ngo_type_and_languages')->where('user_id',$dataFromNVisaFd9Fd1->user_id)->first();

                        if($ngoTypeData->ngo_type_new_old == 'Old'){

                        $ngoStatus = DB::table('ngo_renews')
                        ->where('fd_one_form_id',$dataFromNVisaFd9Fd1->fd_one_form_id)->first();

                        }else{

                        $ngoStatus = DB::table('ngo_statuses')
                        ->where('fd_one_form_id',$dataFromNVisaFd9Fd1->fd_one_form_id)->first();
                        }

                    $nVisabasicInfo = DB::table('n_visas')->where('fd9_one_form_id',$dataFromNVisaFd9Fd1->mainId)->first();
                    $statusData = DB::table('secruity_checks')->where('n_visa_id',$nVisabasicInfo->id)->value('created_at');
                    $nVisaAuthPerson = DB::table('n_visa_authorized_personal_of_the_orgs')->where('n_visa_id',$nVisabasicInfo->id)->first();
                    $nVisaCompensationAndBenifits = DB::table('n_visa_compensation_and_benifits')->where('n_visa_id',$nVisabasicInfo->id)->get();
                    $nVisaEmploye = DB::table('n_visa_employment_information')->where('n_visa_id',$nVisabasicInfo->id)->first();
                    $nVisaManPower = DB::table('n_visa_manpower_of_the_offices')->where('n_visa_id',$nVisabasicInfo->id)->first();
                    $nVisaDocs = DB::table('n_visa_necessary_document_for_work_permits')->where('n_visa_id',$nVisabasicInfo->id)->first();
                    $nVisaForeignerInfo = DB::table('n_visa_particulars_of_foreign_incumbnets')->where('n_visa_id',$nVisabasicInfo->id)->first();
                    $nVisaSponSor = DB::table('n_visa_particular_of_sponsor_or_employers')->where('n_visa_id',$nVisabasicInfo->id)->first();
                    $nVisaWorkPlace = DB::table('n_visa_work_place_addresses')->where('n_visa_id',$nVisabasicInfo->id)->first();

                    $officeDetail = FdNineOneOfficeSarok::where('p_note_for_fd_nine_one_id',$id)->get();
                    $checkParent = ParentNoteForFdNineOne::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();


                }elseif($status == 'fdSix'){


                    $fdFourOneFormStatusId=0;
                    $dataFdFourOneForm=0;
                    $formNoFourStatusId=0;
                            $dataFromNoFourForm=0;
                    $formNoSevenStatusId=0;
            $dataFromNoSevenForm=0;

                    $formNoFiveStepThreeData=0;$formNoFiveStepTwoData=0;
            $formNoFiveStepFourData=0;
            $formNoFiveStepFiveOther=0;
           $formNoFiveStepFiveData=0;
           $formNoFiveStepFiveArea=0;

                    $formNoFiveStatusId = 0;
                    $dataFromNoFiveForm =0;
                    $fdNineOtherFileList =0;$dataFromFdFive = 0;$fdFiveStatusId = 0;$committeeStatusId=0;
                    $dataFromCommittee=0;$constitutionStatusId = 0;$dataFromConstitution = 0;$duplicateCertificateStatusId = 0;$dataFromDuplicateCertificate = 0;
                    $dataFromFd3Form = 0; $dataFromFd7Form=0;$ngoStatus=0;$ngoTypeData=0;$nVisaDocs=0;
                    $dataFromNVisaFd9Fd1=0;$nVisabasicInfo=0;$forwardingLetterOnulipi=0;$editCheck1=0;
                    $editCheck=0;$statusData=0;$nVisaWorkPlace=0;$nVisaSponSor=0;$nVisaForeignerInfo=0;$nVisaManPower=0;$nVisaEmploye=0;
                    $nVisaCompensationAndBenifits=0;$nVisaAuthPerson=0;$mainIdR=0;$renewInfoData=0;
                    $mainIdFdNineOne =0;$form_one_data=0;$all_data_for_new_list_all=0;$form_eight_data=0;
                    $form_member_data=0;$form_member_data_doc=0;$form_ngo_data_doc=0;$users_info=0;
                    $all_source_of_fund=0;$all_partiw=0;$allNameChangeDoc = 0;$getformOneId= 0;
                    $duration_list_all1 =0;$duration_list_all = 0;$renew_status = 0;$name_change_status = 0;
                    $r_status = 0;$form_member_data_doc_renew =0;$get_all_data_adviser=0;$get_all_data_other=0;
                    $get_all_data_adviser_bank=0;$dataFromFc1Form=0;$dataFromFc2Form=0;

                    $fd_six_status_id = DB::table('ngo_fd_six_daks')->where('id',$parentId)->value('fd_six_status_id');

                    $dataFromFd6Form = DB::table('fd6_forms')
                    ->join('fd_one_forms', 'fd_one_forms.id', '=', 'fd6_forms.fd_one_form_id')
                    ->select('fd_one_forms.*','fd6_forms.*','fd6_forms.id as mainId')
                    ->where('fd6_forms.id',$fd_six_status_id)
                    ->orderBy('fd6_forms.id','desc')
                    ->first();
                    $get_email_from_user = DB::table('users')->where('id',$dataFromFd6Form->user_id)->value('email');
                    $fd2FormList = DB::table('fd2_forms')->where('fd_one_form_id',$dataFromFd6Form->fd_one_form_id)->where('fd_six_form_id',$dataFromFd6Form->mainId)->latest()->first();
                    $fd2OtherInfo = DB::table('fd2_form_other_infos')->where('fd2_form_id',$fd2FormList->id)->latest()->get();
                    $prokolpoAreaList = DB::table('fd6_form_prokolpo_areas')->where('fd6_form_id',$dataFromFd6Form->mainId)->latest()->get();

                    $officeDetail = FdSixOfficeSarok::where('parent_note_for_fdsix_id',$id)->get();
                    $checkParent = ParentNoteForFdsix::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

                }elseif($status == 'fdSeven'){

                    $fdFourOneFormStatusId=0;
                    $dataFdFourOneForm=0;
                    $formNoFourStatusId=0;
                            $dataFromNoFourForm=0;

                    $formNoSevenStatusId=0;
            $dataFromNoSevenForm=0;

                    $formNoFiveStepThreeData=0;$formNoFiveStepTwoData=0;
            $formNoFiveStepFourData=0;
            $formNoFiveStepFiveOther=0;
           $formNoFiveStepFiveData=0;
           $formNoFiveStepFiveArea=0;


                    $formNoFiveStatusId = 0;
                    $dataFromNoFiveForm =0;
                    $fdNineOtherFileList =0;$dataFromFdFive = 0;$fdFiveStatusId = 0;$committeeStatusId=0;
                    $dataFromCommittee=0;$constitutionStatusId = 0;$dataFromConstitution = 0;
                    $duplicateCertificateStatusId = 0;$dataFromDuplicateCertificate = 0;$dataFromFd3Form = 0;
                    $dataFromFd6Form = 0;$ngoStatus=0;$ngoTypeData=0;$nVisaDocs=0;$dataFromNVisaFd9Fd1=0;
                    $nVisabasicInfo=0;$forwardingLetterOnulipi=0;$editCheck1=0;$editCheck=0;
                    $statusData=0;$nVisaWorkPlace=0;$nVisaSponSor=0;$nVisaForeignerInfo=0;$nVisaManPower=0;
                    $nVisaEmploye=0;$nVisaCompensationAndBenifits=0;$nVisaAuthPerson=0;$mainIdR=0;
                    $renewInfoData=0;$mainIdFdNineOne =0;$form_one_data=0;$all_data_for_new_list_all=0;
                    $form_eight_data=0;$form_member_data=0;$form_member_data_doc=0;$form_ngo_data_doc=0;
                    $users_info=0; $all_source_of_fund=0;$all_partiw=0;$allNameChangeDoc = 0;
                    $getformOneId= 0;$duration_list_all1 =0;$duration_list_all = 0; $renew_status = 0;
                    $name_change_status = 0; $r_status = 0;$form_member_data_doc_renew =0;
                    $get_all_data_adviser=0;$get_all_data_other=0;$get_all_data_adviser_bank=0;
                    $dataFromFc2Form=0;$dataFromFc1Form=0;

                    $fd_seven_status_id = DB::table('ngo_fd_seven_daks')->where('id',$parentId)->value('fd_seven_status_id');

                    $dataFromFd7Form = DB::table('fd7_forms')
                    ->join('fd_one_forms', 'fd_one_forms.id', '=', 'fd7_forms.fd_one_form_id')
                    ->select('fd_one_forms.*','fd7_forms.*','fd7_forms.id as mainId')
                    ->where('fd7_forms.id',$fd_seven_status_id)
                    ->orderBy('fd7_forms.id','desc')
                    ->first();

                    $get_email_from_user = DB::table('users')->where('id',$dataFromFd7Form->user_id)->value('email');
                    $fd2FormList = DB::table('fd2_form_for_fd7_forms')->where('fd_one_form_id',$dataFromFd7Form->fd_one_form_id)->where('fd7_form_id',$dataFromFd7Form->mainId)->latest()->first();
                    $fd2OtherInfo = DB::table('fd2_fd7_other_infos')->where('fd2_form_for_fd7_form_id',$fd2FormList->id)->latest()->get();
                    $prokolpoAreaList = DB::table('fd7_form_prokolpo_areas')->where('fd7_form_id',$dataFromFd7Form->mainId)->latest()->get();

                    $officeDetail = FdSevenOfficeSarok::where('parent_note_for_fd_seven_id',$id)->get();
                    $checkParent = ParentNoteForFdSeven::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();



                }elseif($status == 'fcOne'){

                    $fdFourOneFormStatusId=0;
                    $dataFdFourOneForm=0;
                    $formNoFourStatusId=0;
                            $dataFromNoFourForm=0;

                    $formNoSevenStatusId=0;
            $dataFromNoSevenForm=0;

                    $formNoFiveStepThreeData=0;$formNoFiveStepTwoData=0;
            $formNoFiveStepFourData=0;
            $formNoFiveStepFiveOther=0;
           $formNoFiveStepFiveData=0;
           $formNoFiveStepFiveArea=0;


                    $formNoFiveStatusId = 0;
                    $dataFromNoFiveForm =0;
                    $fdNineOtherFileList =0;$dataFromFdFive = 0;$fdFiveStatusId = 0;$committeeStatusId=0;
                    $dataFromCommittee=0;$constitutionStatusId = 0;$dataFromConstitution = 0;
                    $duplicateCertificateStatusId = 0;$dataFromDuplicateCertificate = 0;
                    $dataFromFd3Form = 0;$dataFromFc2Form=0;$prokolpoAreaList=0;$dataFromFd6Form = 0;
                    $dataFromFd7Form = 0;$ngoStatus=0;$ngoTypeData=0;$nVisaDocs=0;$dataFromNVisaFd9Fd1=0;
                    $nVisabasicInfo=0;$forwardingLetterOnulipi=0;$editCheck1=0;$editCheck=0;
                    $statusData=0;$nVisaWorkPlace=0;$nVisaSponSor=0;$nVisaForeignerInfo=0;
                    $nVisaManPower=0;$nVisaEmploye=0;$nVisaCompensationAndBenifits=0;$nVisaAuthPerson=0;
                    $mainIdR=0;$renewInfoData=0;$mainIdFdNineOne =0;$form_one_data=0;$all_data_for_new_list_all=0;
                    $form_eight_data=0;$form_member_data=0;$form_member_data_doc=0;$form_ngo_data_doc=0;
                    $users_info=0;$all_source_of_fund=0;$all_partiw=0;
                    $allNameChangeDoc = 0;$getformOneId= 0; $duration_list_all1 =0;
                    $duration_list_all = 0;$renew_status = 0;$name_change_status = 0;$r_status = 0;
                    $form_member_data_doc_renew =0;$get_all_data_adviser=0;$get_all_data_other=0;
                    $get_all_data_adviser_bank=0; $dataFromFdFive = 0;$fdFiveStatusId = 0;


                    $fc_one_status_id = DB::table('fc_one_daks')->where('id',$parentId)->value('fc_one_status_id');

                    $dataFromFc1Form = DB::table('fc1_forms')
                    ->join('fd_one_forms', 'fd_one_forms.id', '=', 'fc1_forms.fd_one_form_id')
                    ->select('fd_one_forms.*','fc1_forms.*','fc1_forms.id as mainId')
                    ->where('fc1_forms.id',$fc_one_status_id)
                    ->orderBy('fc1_forms.id','desc')
                    ->first();

                    $get_email_from_user = DB::table('users')->where('id',$dataFromFc1Form->user_id)->value('email');
                    $fd2FormList = DB::table('fd2_form_for_fc1_forms')->where('fd_one_form_id',$dataFromFc1Form->fd_one_form_id)->where('fc1_form_id',$dataFromFc1Form->mainId)->latest()->first();
                    $fd2OtherInfo = DB::table('fd2_fc1_other_infos')->where('fd2_form_for_fc1_form_id',$fd2FormList->id)->latest()->get();
                    $officeDetail = FcOneOfficeSarok::where('parent_note_for_fc_one_id',$id)->get();
                    $checkParent = ParentNoteForFcOne::where('nothi_detail_id',$parentId)->get();

                }elseif($status == 'fcTwo'){

                    $fdFourOneFormStatusId=0;
                    $dataFdFourOneForm=0;
                    $formNoFourStatusId=0;
                            $dataFromNoFourForm=0;

                    $formNoSevenStatusId=0;
            $dataFromNoSevenForm=0;


                    $formNoFiveStepThreeData=0;$formNoFiveStepTwoData=0;
            $formNoFiveStepFourData=0;
            $formNoFiveStepFiveOther=0;
           $formNoFiveStepFiveData=0;
           $formNoFiveStepFiveArea=0;


                    $formNoFiveStatusId = 0;
                    $dataFromNoFiveForm =0;
                    $fdNineOtherFileList =0;$committeeStatusId=0;$dataFromCommittee=0;$constitutionStatusId = 0;
                    $dataFromConstitution = 0;$duplicateCertificateStatusId = 0;$dataFromDuplicateCertificate = 0;
                    $dataFromFd3Form = 0;$dataFromFc1Form =0;$prokolpoAreaList=0;$dataFromFd6Form = 0;
                    $dataFromFd7Form = 0;$ngoStatus=0;$ngoTypeData=0;$nVisaDocs=0;$dataFromNVisaFd9Fd1=0;
                    $nVisabasicInfo=0;$forwardingLetterOnulipi=0;$editCheck1=0;$editCheck=0;$statusData=0;
                    $nVisaWorkPlace=0;$nVisaSponSor=0;$nVisaForeignerInfo=0;$nVisaManPower=0;
                    $nVisaEmploye=0;$nVisaCompensationAndBenifits=0;$nVisaAuthPerson=0;$mainIdR=0;
                    $renewInfoData=0;$mainIdFdNineOne =0;$form_one_data=0;$all_data_for_new_list_all=0;
                    $form_eight_data=0;$form_member_data=0;$form_member_data_doc=0;$form_ngo_data_doc=0;
                    $users_info=0;$all_source_of_fund=0;$all_partiw=0;$allNameChangeDoc = 0;
                    $getformOneId= 0;$duration_list_all1 =0;$duration_list_all = 0;$renew_status = 0;
                    $name_change_status = 0;$r_status = 0;$form_member_data_doc_renew =0;
                    $get_all_data_adviser=0;$get_all_data_other=0;$get_all_data_adviser_bank=0; $dataFromFdFive = 0;
                    $fdFiveStatusId = 0;

                    $fc_two_status_id = DB::table('fc_two_daks')->where('id',$parentId)->value('fc_two_status_id');

                    $dataFromFc2Form = DB::table('fc2_forms')
                    ->join('fd_one_forms', 'fd_one_forms.id', '=', 'fc2_forms.fd_one_form_id')
                    ->select('fd_one_forms.*','fc2_forms.*','fc2_forms.id as mainId')
                    ->where('fc2_forms.id',$fc_two_status_id)
                    ->orderBy('fc2_forms.id','desc')
                    ->first();

                    $get_email_from_user = DB::table('users')->where('id',$dataFromFc2Form->user_id)->value('email');
                    $fd2FormList = DB::table('fd2_form_for_fc2_forms')->where('fd_one_form_id',$dataFromFc2Form->fd_one_form_id)->where('fc2_form_id',$dataFromFc2Form->mainId)->latest()->first();
                    $fd2OtherInfo = DB::table('fd2_fc2_other_infos')->where('fd2_form_for_fc2_form_id',$fd2FormList->id)->latest()->get();
                    $officeDetail = FcTwoOfficeSarok::where('parent_note_for_fc_two_id',$id)->get();
                    $checkParent = ParentNoteForFcTwo::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();


                }elseif($status == 'fdThree'){

                    $fdFourOneFormStatusId=0;
                    $dataFdFourOneForm=0;
                    $formNoFourStatusId=0;
                            $dataFromNoFourForm=0;

                    $formNoSevenStatusId=0;
            $dataFromNoSevenForm=0;

                    $formNoFiveStepThreeData=0;$formNoFiveStepTwoData=0;
            $formNoFiveStepFourData=0;
            $formNoFiveStepFiveOther=0;
           $formNoFiveStepFiveData=0;
           $formNoFiveStepFiveArea=0;

                    $formNoFiveStatusId = 0;
                    $dataFromNoFiveForm =0;
                    $fdNineOtherFileList =0;$committeeStatusId=0;$dataFromCommittee=0;$constitutionStatusId = 0;
                    $dataFromConstitution = 0;$duplicateCertificateStatusId = 0;$dataFromDuplicateCertificate = 0;
                    $dataFromFc2Form =0;$dataFromFc1Form =0;$prokolpoAreaList=0;$dataFromFd6Form = 0;
                    $dataFromFd7Form = 0;$ngoStatus=0;$ngoTypeData=0;$nVisaDocs=0;$dataFromNVisaFd9Fd1=0;
                    $nVisabasicInfo=0;$forwardingLetterOnulipi=0;$editCheck1=0;$editCheck=0;$statusData=0;
                    $nVisaWorkPlace=0;$nVisaSponSor=0;$nVisaForeignerInfo=0;$nVisaManPower=0;
                    $nVisaEmploye=0;$nVisaCompensationAndBenifits=0;$nVisaAuthPerson=0;$mainIdR=0;
                    $renewInfoData=0;$mainIdFdNineOne =0;$form_one_data=0;$all_data_for_new_list_all=0;
                    $form_eight_data=0;$form_member_data=0;$form_member_data_doc=0;$form_ngo_data_doc=0;
                    $users_info=0;$all_source_of_fund=0;$all_partiw=0;$allNameChangeDoc = 0;$getformOneId= 0;
                    $duration_list_all1 =0;$duration_list_all = 0;$renew_status = 0;$name_change_status = 0;
                    $r_status = 0;$form_member_data_doc_renew =0;$get_all_data_adviser=0;$get_all_data_other=0;
                    $get_all_data_adviser_bank=0;$dataFromFdFive = 0;$fdFiveStatusId = 0;

                    $fd_three_status_id = DB::table('fd_three_daks')->where('id',$parentId)->value('fd_three_status_id');

                    $dataFromFd3Form = DB::table('fd3_forms')
                    ->join('fd_one_forms', 'fd_one_forms.id', '=', 'fd3_forms.fd_one_form_id')
                    ->select('fd_one_forms.*','fd3_forms.*','fd3_forms.id as mainId')
                    ->where('fd3_forms.id',$fd_three_status_id)
                    ->orderBy('fd3_forms.id','desc')
                    ->first();

                    $get_email_from_user = DB::table('users')->where('id',$dataFromFd3Form->user_id)->value('email');
                    $fd2FormList = DB::table('fd2_form_for_fd3_forms')->where('fd_one_form_id',$dataFromFd3Form->fd_one_form_id)->where('fd3_form_id',$dataFromFd3Form->mainId)->latest()->first();
                    $fd2OtherInfo = DB::table('fd2_fd3_other_infos')->where('fd2_form_for_fd3_form_id',$fd2FormList->id)->latest()->get();
                    $officeDetail = FdThreeOfficeSarok::where('parent_note_for_fd_three_id',$id)->get();
                    $checkParent = ParentNoteForFdThree::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();


                }elseif($status == 'duplicate'){

                    $fdFourOneFormStatusId=0;
                    $dataFdFourOneForm=0;
                    $formNoFourStatusId=0;
                            $dataFromNoFourForm=0;

                    $formNoSevenStatusId=0;
            $dataFromNoSevenForm=0;

                    $formNoFiveStepThreeData=0;$formNoFiveStepTwoData=0;
            $formNoFiveStepFourData=0;
            $formNoFiveStepFiveOther=0;
           $formNoFiveStepFiveData=0;
           $formNoFiveStepFiveArea=0;


                    $formNoFiveStatusId = 0;
                    $dataFromNoFiveForm =0;
                    $fdNineOtherFileList =0;$dataFromFc2Form =0;$dataFromFc1Form =0; $prokolpoAreaList=0;$dataFromFd6Form = 0;
                    $dataFromFd7Form = 0;$ngoStatus=0;$ngoTypeData=0;$nVisaDocs=0;
                    $dataFromNVisaFd9Fd1=0;$nVisabasicInfo=0;$forwardingLetterOnulipi=0;$editCheck1=0;
                    $editCheck=0;$statusData=0;$nVisaWorkPlace=0;$nVisaSponSor=0;$nVisaForeignerInfo=0;
                    $nVisaManPower=0;$nVisaEmploye=0;$nVisaCompensationAndBenifits=0;$nVisaAuthPerson=0;
                    $mainIdR=0;$renewInfoData=0;$mainIdFdNineOne =0;$form_one_data=0;
                    $all_data_for_new_list_all=0;$form_eight_data=0;$form_member_data=0;$form_member_data_doc=0;
                    $form_ngo_data_doc=0;$users_info=0;$all_source_of_fund=0;$all_partiw=0;
                    $allNameChangeDoc = 0;$getformOneId= 0;$duration_list_all1 =0;$duration_list_all = 0;
                    $renew_status = 0;$name_change_status = 0;$r_status = 0;$form_member_data_doc_renew =0;
                    $get_all_data_adviser=0; $get_all_data_other=0;$get_all_data_adviser_bank=0;
                    $fd_three_status_id =0; $dataFromFd3Form = 0;$fd2FormList = 0;$fd2OtherInfo = 0;
                    $committeeStatusId=0;$dataFromCommittee=0;$constitutionStatusId = 0; $dataFromConstitution = 0;
                    $dataFromFdFive = 0;$fdFiveStatusId = 0;

                    $officeDetail = DuplicateCertificateOfficeSarok::where('pnote_dupid',$id)->get();
                    $duplicateCertificateStatusId = DB::table('duplicate_certificate_daks')->where('id',$parentId)->value('duplicate_certificate_id');
                    $dataFromDuplicateCertificate = DB::table('document_for_duplicate_certificates')
                   ->join('fd_one_forms', 'fd_one_forms.id', '=', 'document_for_duplicate_certificates.fd_one_form_id')
                   ->select('fd_one_forms.*','document_for_duplicate_certificates.*','document_for_duplicate_certificates.id as mainId')
                   ->where('document_for_duplicate_certificates.id',$duplicateCertificateStatusId)
                   ->orderBy('document_for_duplicate_certificates.id','desc')
                   ->first();

                   $get_email_from_user = DB::table('users')->where('id',$dataFromDuplicateCertificate->user_id)->value('email');
                   $checkParent = ParentNoteForDuplicateCertificate::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

                }elseif($status == 'constitution'){

                    $fdFourOneFormStatusId=0;
                    $dataFdFourOneForm=0;
                    $formNoFourStatusId=0;
                            $dataFromNoFourForm=0;

                    $formNoSevenStatusId=0;
            $dataFromNoSevenForm=0;

                    $formNoFiveStepThreeData=0;$formNoFiveStepTwoData=0;
            $formNoFiveStepFourData=0;
            $formNoFiveStepFiveOther=0;
           $formNoFiveStepFiveData=0;
           $formNoFiveStepFiveArea=0;
                    $formNoFiveStatusId = 0;
            $dataFromNoFiveForm =0;

                    $fdNineOtherFileList =0;$dataFromFc2Form =0;$dataFromFc1Form =0; $prokolpoAreaList=0;$dataFromFd6Form = 0;
                    $dataFromFd7Form = 0;$ngoStatus=0;$ngoTypeData=0;$nVisaDocs=0;
                    $dataFromNVisaFd9Fd1=0;$nVisabasicInfo=0;$forwardingLetterOnulipi=0;$editCheck1=0;
                    $editCheck=0;$statusData=0;$nVisaWorkPlace=0;$nVisaSponSor=0;$nVisaForeignerInfo=0;
                    $nVisaManPower=0;$nVisaEmploye=0;$nVisaCompensationAndBenifits=0;$nVisaAuthPerson=0;
                    $mainIdR=0;$renewInfoData=0;$mainIdFdNineOne =0;$form_one_data=0;
                    $all_data_for_new_list_all=0;$form_eight_data=0;$form_member_data=0;$form_member_data_doc=0;
                    $form_ngo_data_doc=0;$users_info=0;$all_source_of_fund=0;$all_partiw=0;
                    $allNameChangeDoc = 0;$getformOneId= 0;$duration_list_all1 =0;$duration_list_all = 0;
                    $renew_status = 0;$name_change_status = 0;$r_status = 0;$form_member_data_doc_renew =0;
                    $get_all_data_adviser=0; $get_all_data_other=0;$get_all_data_adviser_bank=0;
                    $fd_three_status_id =0;$dataFromFd3Form = 0;$dataFromDuplicateCertificate = 0;
                    $duplicateCertificateStatusId = 0;$fd2FormList = 0;$fd2OtherInfo = 0;$dataFromFdFive = 0;
                    $fdFiveStatusId = 0;$committeeStatusId=0;$dataFromCommittee=0;

                    $officeDetail = ConstitutionOfficeSarok::where('pnote_conid',$id)->get();
                    $constitutionStatusId = DB::table('constitution_daks')->where('id',$parentId)->value('constitution_id');

                    $dataFromConstitution = DB::table('document_for_amendment_or_approval_of_constitutions')
                    ->join('fd_one_forms', 'fd_one_forms.id', '=', 'document_for_amendment_or_approval_of_constitutions.fdId')
                    ->select('fd_one_forms.*','document_for_amendment_or_approval_of_constitutions.*','document_for_amendment_or_approval_of_constitutions.id as mainId')
                    ->where('document_for_amendment_or_approval_of_constitutions.id',$constitutionStatusId)
                    ->orderBy('document_for_amendment_or_approval_of_constitutions.id','desc')
                    ->first();

                    $get_email_from_user = DB::table('users')->where('id',$dataFromConstitution->user_id)->value('email');

                    $checkParent = ParentNoteForConstitution::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

                }elseif($status == 'committee'){

                    $fdFourOneFormStatusId=0;
                    $dataFdFourOneForm=0;
                    $formNoFourStatusId=0;
                            $dataFromNoFourForm=0;

                    $formNoSevenStatusId=0;
            $dataFromNoSevenForm=0;

                    $formNoFiveStepThreeData=0;$formNoFiveStepTwoData=0;
            $formNoFiveStepFourData=0;
            $formNoFiveStepFiveOther=0;
           $formNoFiveStepFiveData=0;
           $formNoFiveStepFiveArea=0;

                    $formNoFiveStatusId = 0;
            $dataFromNoFiveForm =0;

                    $fdNineOtherFileList =0;$dataFromFc2Form =0;$dataFromFc1Form =0; $prokolpoAreaList=0;$dataFromFd6Form = 0;
                    $dataFromFd7Form = 0;$ngoStatus=0;$ngoTypeData=0;$nVisaDocs=0;
                    $dataFromNVisaFd9Fd1=0;$nVisabasicInfo=0;$forwardingLetterOnulipi=0;$editCheck1=0;
                    $editCheck=0;$statusData=0;$nVisaWorkPlace=0;$nVisaSponSor=0;$nVisaForeignerInfo=0;
                    $nVisaManPower=0;$nVisaEmploye=0;$nVisaCompensationAndBenifits=0;$nVisaAuthPerson=0;
                    $mainIdR=0;$renewInfoData=0;$mainIdFdNineOne =0;$form_one_data=0;
                    $all_data_for_new_list_all=0;$form_eight_data=0;$form_member_data=0;$form_member_data_doc=0;
                    $form_ngo_data_doc=0;$users_info=0;$all_source_of_fund=0;$all_partiw=0;
                    $allNameChangeDoc = 0;$getformOneId= 0;$duration_list_all1 =0;$duration_list_all = 0;
                    $renew_status = 0;$name_change_status = 0;$r_status = 0;$form_member_data_doc_renew =0;
                    $get_all_data_adviser=0; $get_all_data_other=0;$get_all_data_adviser_bank=0;
                    $fd_three_status_id =0;$duplicateCertificateStatusId = 0;$constitutionStatusId = 0;
                    $dataFromFd3Form = 0;$dataFromDuplicateCertificate = 0;$dataFromConstitution = 0;
                    $fd2FormList = 0;$fd2OtherInfo = 0;$dataFromFdFive = 0;$fdFiveStatusId = 0;

                    $officeDetail = ExecutiveCommitteeOfficeSarok::where('pnote_exeid',$id)->get();
                    $committeeStatusId = DB::table('executive_committee_daks')->where('id',$parentId)->value('executive_committee_id');

                    $dataFromCommittee = DB::table('document_for_executive_committee_approvals')
                    ->join('fd_one_forms', 'fd_one_forms.id', '=', 'document_for_executive_committee_approvals.fdId')
                    ->select('fd_one_forms.*','document_for_executive_committee_approvals.*','document_for_executive_committee_approvals.id as mainId')
                    ->where('document_for_executive_committee_approvals.id',$committeeStatusId)
                    ->orderBy('document_for_executive_committee_approvals.id','desc')
                    ->first();

                    $get_email_from_user = DB::table('users')->where('id',$dataFromCommittee->user_id)->value('email');
                    $checkParent = ParentNotForExecutiveCommittee::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

                }elseif($status == 'fdFive'){

                    $fdFourOneFormStatusId=0;
                    $dataFdFourOneForm=0;
                    $formNoFourStatusId=0;
                            $dataFromNoFourForm=0;

                    $formNoSevenStatusId=0;
            $dataFromNoSevenForm=0;

                    $formNoFiveStepThreeData=0;$formNoFiveStepTwoData=0;
            $formNoFiveStepFourData=0;
            $formNoFiveStepFiveOther=0;
           $formNoFiveStepFiveData=0;
           $formNoFiveStepFiveArea=0;

                    $formNoFiveStatusId = 0;
            $dataFromNoFiveForm =0;

                    $fdNineOtherFileList =0;$dataFromFc2Form =0;$dataFromFc1Form =0; $prokolpoAreaList=0;$dataFromFd6Form = 0;
                    $dataFromFd7Form = 0;$ngoStatus=0;$ngoTypeData=0;$nVisaDocs=0;
                    $dataFromNVisaFd9Fd1=0;$nVisabasicInfo=0;$forwardingLetterOnulipi=0;$editCheck1=0;
                    $editCheck=0;$statusData=0;$nVisaWorkPlace=0;$nVisaSponSor=0;$nVisaForeignerInfo=0;
                    $nVisaManPower=0;$nVisaEmploye=0;$nVisaCompensationAndBenifits=0;$nVisaAuthPerson=0;
                    $mainIdR=0;$renewInfoData=0;$mainIdFdNineOne =0;$form_one_data=0;
                    $all_data_for_new_list_all=0;$form_eight_data=0;$form_member_data=0;$form_member_data_doc=0;
                    $form_ngo_data_doc=0;$users_info=0;$all_source_of_fund=0;$all_partiw=0;
                    $allNameChangeDoc = 0;$getformOneId= 0;$duration_list_all1 =0;$duration_list_all = 0;
                    $renew_status = 0;$name_change_status = 0;$r_status = 0;$form_member_data_doc_renew =0;
                    $get_all_data_adviser=0; $get_all_data_other=0;$get_all_data_adviser_bank=0;
                    $fd_three_status_id =0;$duplicateCertificateStatusId = 0;$constitutionStatusId = 0;
                    $committeeStatusId = 0;$dataFromFd3Form = 0;$dataFromDuplicateCertificate = 0;
                    $dataFromCommittee =0;  $dataFromConstitution = 0;$fd2FormList = 0;$fd2OtherInfo = 0;

                    $officeDetail = FdFiveOfficeSarok::where('pnote_fd_five',$id)->get();

                    $fdFiveStatusId = DB::table('fd_five_daks')->where('id',$parentId)->value('fd_five_status_id');

                    $dataFromFdFive = DB::table('fd_five_forms')
                    ->join('fd_one_forms', 'fd_one_forms.id', '=', 'fd_five_forms.fdId')
                    ->select('fd_one_forms.*','fd_five_forms.*','fd_five_forms.id as mainId')
                    ->where('fd_five_forms.id',$fdFiveStatusId)
                    ->orderBy('fd_five_forms.id','desc')
                    ->first();

                   $get_email_from_user = DB::table('users')->where('id',$dataFromFdFive->user_id)->value('email');

                    $checkParent = ParentNoteForFdFive::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

                }elseif($status == 'formNoFive'){
                    $fdFourOneFormStatusId=0;
                    $dataFdFourOneForm=0;
                    $formNoFourStatusId=0;
                            $dataFromNoFourForm=0;
                    $formNoSevenStatusId=0;
            $dataFromNoSevenForm=0;


                    $fdFiveStatusId=0;
                    $dataFromFdFive=0;
                    $fdNineOtherFileList =0;$dataFromFc2Form =0;$dataFromFc1Form =0; $prokolpoAreaList=0;$dataFromFd6Form = 0;
                    $dataFromFd7Form = 0;$ngoStatus=0;$ngoTypeData=0;$nVisaDocs=0;
                    $dataFromNVisaFd9Fd1=0;$nVisabasicInfo=0;$forwardingLetterOnulipi=0;$editCheck1=0;
                    $editCheck=0;$statusData=0;$nVisaWorkPlace=0;$nVisaSponSor=0;$nVisaForeignerInfo=0;
                    $nVisaManPower=0;$nVisaEmploye=0;$nVisaCompensationAndBenifits=0;$nVisaAuthPerson=0;
                    $mainIdR=0;$renewInfoData=0;$mainIdFdNineOne =0;$form_one_data=0;
                    $all_data_for_new_list_all=0;$form_eight_data=0;$form_member_data=0;$form_member_data_doc=0;
                    $form_ngo_data_doc=0;$users_info=0;$all_source_of_fund=0;$all_partiw=0;
                    $allNameChangeDoc = 0;$getformOneId= 0;$duration_list_all1 =0;$duration_list_all = 0;
                    $renew_status = 0;$name_change_status = 0;$r_status = 0;$form_member_data_doc_renew =0;
                    $get_all_data_adviser=0; $get_all_data_other=0;$get_all_data_adviser_bank=0;
                    $fd_three_status_id =0;$duplicateCertificateStatusId = 0;$constitutionStatusId = 0;
                    $committeeStatusId = 0;$dataFromFd3Form = 0;$dataFromDuplicateCertificate = 0;
                    $dataFromCommittee =0;$dataFromConstitution = 0; $dataFromCommittee =0;
                    $fd2FormList = 0;$fd2OtherInfo = 0;

                    $officeDetail = FormNoFiveOfficeSarok::where('pnote_form_no_five',$id)->get();

                    $formNoFiveStatusId = DB::table('form_no_five_daks')->where('id',$parentId)->value('form_no_five_status_id');

                    $dataFromNoFiveForm = DB::table('form_no_fives')
                    ->join('fd_one_forms', 'fd_one_forms.id', '=', 'form_no_fives.fd_one_form_id')
                    ->select('fd_one_forms.*','form_no_fives.*','form_no_fives.id as mainId')
                    ->where('form_no_fives.id',$formNoFiveStatusId)
                    ->orderBy('form_no_fives.id','desc')
                    ->first();

                    $formNoFiveStepTwoData = DB::table('form_no_five_step_twos')->where('form_no_fives_id',$dataFromNoFiveForm->mainId)->get();
                    $formNoFiveStepThreeData =DB::table('form_no_five_step_threes')->where('form_no_fives_id',$dataFromNoFiveForm->mainId)->get();
                    $formNoFiveStepFourData = DB::table('form_no_five_step_fours')->where('form_no_fives_id',$dataFromNoFiveForm->mainId)->get();
                    $formNoFiveStepFiveOther= DB::table('form_no_five_others')->where('form_no_fives_id',$dataFromNoFiveForm->mainId)->get();
                    $formNoFiveStepFiveData = DB::table('form_no_five_step_fives')->where('form_no_fives_id',$dataFromNoFiveForm->mainId)->get();
                    $formNoFiveStepFiveArea = DB::table('form_no_five_area_details')->where('form_no_fives_id',$dataFromNoFiveForm->mainId)->get();

                   $get_email_from_user = DB::table('users')->where('id',$dataFromNoFiveForm->user_id)->value('email');

                   $checkParent = ParentNoteForFormNoFiveDak::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();


                }elseif($status == 'formNoSeven'){
                    $fdFourOneFormStatusId=0;
                    $dataFdFourOneForm=0;
                    $formNoFourStatusId=0;
                            $dataFromNoFourForm=0;
            $fdFiveStatusId=0;
                    $dataFromFdFive=0;

            $fdNineOtherFileList =0;$dataFromFc2Form =0;$dataFromFc1Form =0; $prokolpoAreaList=0;$dataFromFd6Form = 0;
            $dataFromFd7Form = 0;$ngoStatus=0;$ngoTypeData=0;$nVisaDocs=0;
            $dataFromNVisaFd9Fd1=0;$nVisabasicInfo=0;$forwardingLetterOnulipi=0;$editCheck1=0;
            $editCheck=0;$statusData=0;$nVisaWorkPlace=0;$nVisaSponSor=0;$nVisaForeignerInfo=0;
            $nVisaManPower=0;$nVisaEmploye=0;$nVisaCompensationAndBenifits=0;$nVisaAuthPerson=0;
            $mainIdR=0;$renewInfoData=0;$mainIdFdNineOne =0;$form_one_data=0;
            $all_data_for_new_list_all=0;$form_eight_data=0;$form_member_data=0;$form_member_data_doc=0;
            $form_ngo_data_doc=0;$users_info=0;$all_source_of_fund=0;$all_partiw=0;
            $allNameChangeDoc = 0;$getformOneId= 0;$duration_list_all1 =0;$duration_list_all = 0;
            $renew_status = 0;$name_change_status = 0;$r_status = 0;$form_member_data_doc_renew =0;
            $get_all_data_adviser=0; $get_all_data_other=0;$get_all_data_adviser_bank=0;
            $fd_three_status_id =0;$duplicateCertificateStatusId = 0;$constitutionStatusId = 0;
            $committeeStatusId = 0;$dataFromFd3Form = 0;$dataFromDuplicateCertificate = 0;
            $dataFromCommittee =0;$dataFromConstitution = 0; $dataFromCommittee =0;
            $fd2FormList = 0;$fd2OtherInfo = 0;

            $officeDetail = FormNoSevenOfficeSarok::where('pnote_form_no_seven',$id)->get();

            $formNoSevenStatusId = DB::table('form_no_seven_daks')
            ->where('id',$parentId)->value('form_no_seven_status_id');

            $dataFromNoSevenForm = DB::table('form_no_sevens')
            ->join('fd_one_forms', 'fd_one_forms.id', '=', 'form_no_sevens.fd_one_form_id')
            ->select('fd_one_forms.*','form_no_sevens.*','form_no_sevens.id as mainId')
            ->where('form_no_sevens.id',$formNoSevenStatusId)
            ->orderBy('form_no_sevens.id','desc')
            ->first();

            $formNoFiveStatusId=0;
            $dataFromNoFiveForm=0;

        $formNoFiveStepTwoData = 0;
        $formNoFiveStepThreeData =0;
        $formNoFiveStepFourData = 0;
        $formNoFiveStepFiveOther= 0;
        $formNoFiveStepFiveData = 0;
        $formNoFiveStepFiveArea = 0;


           $get_email_from_user = DB::table('users')->where('id',$dataFromNoSevenForm->user_id)->value('email');

           $checkParent = ParentNoteForFormNoSeven::where('nothi_detail_id',$parentId)
           ->where('serial_number',$nothiId)->get();


        }elseif($status == 'formNoFour'){
            $formNoSevenStatusId=0;
            $fdFiveStatusId=0;
            $dataFromFdFive=0;
            $dataFromNoSevenForm=0;

            $fdNineOtherFileList =0;$dataFromFc2Form =0;$dataFromFc1Form =0; $prokolpoAreaList=0;$dataFromFd6Form = 0;
            $dataFromFd7Form = 0;$ngoStatus=0;$ngoTypeData=0;$nVisaDocs=0;
            $dataFromNVisaFd9Fd1=0;$nVisabasicInfo=0;$forwardingLetterOnulipi=0;$editCheck1=0;
            $editCheck=0;$statusData=0;$nVisaWorkPlace=0;$nVisaSponSor=0;$nVisaForeignerInfo=0;
            $nVisaManPower=0;$nVisaEmploye=0;$nVisaCompensationAndBenifits=0;$nVisaAuthPerson=0;
            $mainIdR=0;$renewInfoData=0;$mainIdFdNineOne =0;$form_one_data=0;
            $all_data_for_new_list_all=0;$form_eight_data=0;$form_member_data=0;$form_member_data_doc=0;
            $form_ngo_data_doc=0;$users_info=0;$all_source_of_fund=0;$all_partiw=0;
            $allNameChangeDoc = 0;$getformOneId= 0;$duration_list_all1 =0;$duration_list_all = 0;
            $renew_status = 0;$name_change_status = 0;$r_status = 0;$form_member_data_doc_renew =0;
            $get_all_data_adviser=0; $get_all_data_other=0;$get_all_data_adviser_bank=0;
            $fd_three_status_id =0;$duplicateCertificateStatusId = 0;$constitutionStatusId = 0;
            $committeeStatusId = 0;$dataFromFd3Form = 0;$dataFromDuplicateCertificate = 0;
            $dataFromCommittee =0;$dataFromConstitution = 0; $dataFromCommittee =0;
            $fd2FormList = 0;$fd2OtherInfo = 0;

            $officeDetail = FormNoFourOfficeSarok::where('pnote_form_no_four',$id)->get();

            $formNoFourStatusId = DB::table('form_no_four_daks')
            ->where('id',$parentId)->value('form_no_four_status_id');

            $dataFromNoFourForm = DB::table('form_no_fours')
            ->join('fd_one_forms', 'fd_one_forms.id', '=', 'form_no_fours.fd_one_form_id')
            ->select('fd_one_forms.*','form_no_fours.*','form_no_fours.id as mainId')
            ->where('form_no_fours.id',$formNoFourStatusId)
            ->orderBy('form_no_fours.id','desc')
            ->first();

            $formNoFiveStatusId=0;
            $dataFromNoFiveForm=0;

        $formNoFiveStepTwoData = 0;
        $formNoFiveStepThreeData =0;
        $formNoFiveStepFourData = 0;
        $formNoFiveStepFiveOther= 0;
        $formNoFiveStepFiveData = 0;
        $formNoFiveStepFiveArea = 0;

        $fdFourOneFormStatusId=0;
        $dataFdFourOneForm=0;

           $get_email_from_user = DB::table('users')
           ->where('id',$dataFromNoFourForm->user_id)->value('email');

           $checkParent = ParentNoteForFormNoFour::where('nothi_detail_id',$parentId)
           ->where('serial_number',$nothiId)->get();


        }elseif($status == 'fdFourOneForm'){
            $formNoSevenStatusId=0;
            $fdFiveStatusId=0;
            $dataFromFdFive=0;
            $dataFromNoSevenForm=0;

            $formNoFourStatusId=0;
            $dataFromNoFourForm=0;

            $fdNineOtherFileList =0;$dataFromFc2Form =0;$dataFromFc1Form =0; $prokolpoAreaList=0;$dataFromFd6Form = 0;
            $dataFromFd7Form = 0;$ngoStatus=0;$ngoTypeData=0;$nVisaDocs=0;
            $dataFromNVisaFd9Fd1=0;$nVisabasicInfo=0;$forwardingLetterOnulipi=0;$editCheck1=0;
            $editCheck=0;$statusData=0;$nVisaWorkPlace=0;$nVisaSponSor=0;$nVisaForeignerInfo=0;
            $nVisaManPower=0;$nVisaEmploye=0;$nVisaCompensationAndBenifits=0;$nVisaAuthPerson=0;
            $mainIdR=0;$renewInfoData=0;$mainIdFdNineOne =0;$form_one_data=0;
            $all_data_for_new_list_all=0;$form_eight_data=0;$form_member_data=0;$form_member_data_doc=0;
            $form_ngo_data_doc=0;$users_info=0;$all_source_of_fund=0;$all_partiw=0;
            $allNameChangeDoc = 0;$getformOneId= 0;$duration_list_all1 =0;$duration_list_all = 0;
            $renew_status = 0;$name_change_status = 0;$r_status = 0;$form_member_data_doc_renew =0;
            $get_all_data_adviser=0; $get_all_data_other=0;$get_all_data_adviser_bank=0;
            $fd_three_status_id =0;$duplicateCertificateStatusId = 0;$constitutionStatusId = 0;
            $committeeStatusId = 0;$dataFromFd3Form = 0;$dataFromDuplicateCertificate = 0;
            $dataFromCommittee =0;$dataFromConstitution = 0; $dataFromCommittee =0;
            $fd2FormList = 0;$fd2OtherInfo = 0;

            $officeDetail = FdFourOneFormOfficeSarok::where('pnote_fd_four_one_form',$id)->get();

            $fdFourOneFormStatusId = DB::table('fd4_one_form_daks')
            ->where('id',$parentId)->value('fd4_one_form_status_id');

            $dataFdFourOneForm = DB::table('fd_four_one_forms')
            ->join('fd_one_forms', 'fd_one_forms.id', '=', 'fd_four_one_forms.fd_one_form_id')
            ->select('fd_one_forms.*','fd_four_one_forms.*','fd_four_one_forms.id as mainId')
            ->where('fd_four_one_forms.id',$fdFourOneFormStatusId)
            ->orderBy('fd_four_one_forms.id','desc')
            ->first();

            $formNoFiveStatusId=0;
            $dataFromNoFiveForm=0;

        $formNoFiveStepTwoData = 0;
        $formNoFiveStepThreeData =0;
        $formNoFiveStepFourData = 0;
        $formNoFiveStepFiveOther= 0;
        $formNoFiveStepFiveData = 0;
        $formNoFiveStepFiveArea = 0;


           $get_email_from_user = DB::table('users')
           ->where('id',$dataFdFourOneForm->user_id)->value('email');

           $checkParent = ParentNoteForFdFourOneForm::
           where('nothi_detail_id',$parentId)
           ->where('serial_number',$nothiId)->get();


        }


                $nothiNumber = NothiList::where('id',$nothiId)->value('main_sarok_number');
                $nothiYear = NothiList::where('id',$nothiId)->value('document_year');

                $user = Admin::where('id','!=',1)->get();

                $nothiPropokListUpdate = NothiPrapok::
                where('nothiId',$nothiId)
                ->where('noteId',$id)->where('status',1)->get();
                $nothiAttractListUpdate = NothiAttarct::where('nothiId',$nothiId)
                ->where('noteId',$id)->where('status',1)->get();
                $nothiCopyListUpdate = NothiCopy::where('nothiId',$nothiId)
                ->where('noteId',$id)->where('status',1)->get();


                $permissionNothiList = NothiPermission::where('nothId',$nothiId)->get();

                $convert_name_title = $permissionNothiList->implode("designationId", " ");
                $separated_data_title = explode(" ", $convert_name_title);

                $branchListForSerial = DesignationList::whereIn('id',$separated_data_title)->orderBy('designation_serial','asc')->get();


            if($status == 'registration'){

                $checkParentFirst = DB::table('parent_note_for_registrations')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
                $childNoteNewList = DB::table('child_note_for_registrations') ->where('parent_note_regid',$id)->get();
                $childNoteNewListValue = DB::table('child_note_for_registrations')->where('parent_note_regid',$id)->orderBy('id','desc')->value('id');

                $childNoteNewListUpdate = DB::table('child_note_for_registrations')
                ->where('parent_note_regid',$id)
                ->where('receiver_id',Auth::guard('admin')->user()->id)
                ->update(array('view_status' => 1));

            }elseif($status == 'renew'){

                $checkParentFirst = DB::table('parent_note_for_renews')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
                $childNoteNewList = DB::table('child_note_for_renews')->where('parent_note_for_renew_id',$id)->get();
                $childNoteNewListValue = DB::table('child_note_for_renews')->where('parent_note_for_renew_id',$id)->orderBy('id','desc')->value('id');

                $childNoteNewListUpdate = DB::table('child_note_for_renews')
                ->where('parent_note_for_renew_id',$id)
                ->where('receiver_id',Auth::guard('admin')->user()->id)
                ->update(array('view_status' => 1));

            }elseif($status == 'nameChange'){

                $checkParentFirst = DB::table('parent_note_for_name_changes')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
                $childNoteNewList = DB::table('child_note_for_name_changes')->where('parentnote_name_change_id',$id)->get();
                $childNoteNewListValue = DB::table('child_note_for_name_changes')->where('parentnote_name_change_id',$id)->orderBy('id','desc')->value('id');

                $childNoteNewListUpdate = DB::table('child_note_for_name_changes')
                ->where('parentnote_name_change_id',$id)
                ->where('receiver_id',Auth::guard('admin')->user()->id)
                ->update(array('view_status' => 1));

            }elseif($status == 'fdNine'){

                $checkParentFirst = DB::table('parent_note_for_fd_nines')->where('nothi_detail_id',$parentId) ->where('serial_number',$nothiId)->where('id',$id)->first();
                $childNoteNewList = DB::table('child_note_for_fd_nines')->where('p_note_for_fd_nine_id',$id)->get();
                $childNoteNewListValue = DB::table('child_note_for_fd_nines')->where('p_note_for_fd_nine_id',$id)->orderBy('id','desc')->value('id');

                $childNoteNewListUpdate = DB::table('child_note_for_fd_nines')
                ->where('p_note_for_fd_nine_id',$id)
                ->where('receiver_id',Auth::guard('admin')->user()->id)
                ->update(array('view_status' => 1));

            }elseif($status == 'fdNineOne'){

                $checkParentFirst = DB::table('parent_note_for_fd_nine_ones')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
                $childNoteNewList = DB::table('child_note_for_fd_nine_ones')->where('p_note_for_fd_nine_one_id',$id)->get();
                $childNoteNewListValue = DB::table('child_note_for_fd_nine_ones')->where('p_note_for_fd_nine_one_id',$id)->orderBy('id','desc')->value('id');

                $childNoteNewListUpdate = DB::table('child_note_for_fd_nine_ones')
                ->where('p_note_for_fd_nine_one_id',$id)
                ->where('receiver_id',Auth::guard('admin')->user()->id)
                ->update(array('view_status' => 1));

            }elseif($status == 'fdSix'){

                $checkParentFirst = DB::table('parent_note_for_fdsixes')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
                $childNoteNewList = DB::table('child_note_for_fd_sixes')->where('parent_note_for_fdsix_id',$id)->get();
                $childNoteNewListValue = DB::table('child_note_for_fd_sixes')->where('parent_note_for_fdsix_id',$id)->orderBy('id','desc')->value('id');

                $childNoteNewListUpdate = DB::table('child_note_for_fd_sixes')
                ->where('parent_note_for_fdsix_id',$id)
                ->where('receiver_id',Auth::guard('admin')->user()->id)
                ->update(array('view_status' => 1));

            }elseif($status == 'fdSeven'){

                $checkParentFirst = DB::table('parent_note_for_fd_sevens')->where('nothi_detail_id',$parentId) ->where('serial_number',$nothiId)->where('id',$id)->first();
                $childNoteNewList = DB::table('child_note_for_fd_sevens')->where('parent_note_for_fd_seven_id',$id)->get();
                $childNoteNewListValue = DB::table('child_note_for_fd_sevens')->where('parent_note_for_fd_seven_id',$id)->orderBy('id','desc')->value('id');

                $childNoteNewListUpdate = DB::table('child_note_for_fd_sevens')
                ->where('parent_note_for_fd_seven_id',$id)
                ->where('receiver_id',Auth::guard('admin')->user()->id)
                ->update(array('view_status' => 1));

            }elseif($status == 'fcOne'){

                $checkParentFirst = DB::table('parent_note_for_fc_ones')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
                $childNoteNewList = DB::table('child_note_for_fc_ones')->where('parent_note_for_fc_one_id',$id)->get();
                $childNoteNewListValue = DB::table('child_note_for_fc_ones')->where('parent_note_for_fc_one_id',$id)->orderBy('id','desc')->value('id');

                $childNoteNewListUpdate = DB::table('child_note_for_fc_ones')
                ->where('parent_note_for_fc_one_id',$id)
                ->where('receiver_id',Auth::guard('admin')->user()->id)
                ->update(array('view_status' => 1));

            }elseif($status == 'fcTwo'){

                $checkParentFirst = DB::table('parent_note_for_fc_twos')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
                $childNoteNewList = DB::table('child_note_for_fc_twos')->where('parent_note_for_fc_two_id',$id)->get();
                $childNoteNewListValue = DB::table('child_note_for_fc_twos')->where('parent_note_for_fc_two_id',$id)->orderBy('id','desc')->value('id');

                $childNoteNewListUpdate = DB::table('child_note_for_fc_twos')
                ->where('parent_note_for_fc_two_id',$id)
                ->where('receiver_id',Auth::guard('admin')->user()->id)
                ->update(array('view_status' => 1));

            }elseif($status == 'fdThree'){

                $checkParentFirst = DB::table('parent_note_for_fd_threes')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
                $childNoteNewList = DB::table('child_note_for_fd_threes')->where('parent_note_for_fd_three_id',$id)->get();
                $childNoteNewListValue = DB::table('child_note_for_fd_threes')->where('parent_note_for_fd_three_id',$id)->orderBy('id','desc')->value('id');

                $childNoteNewListUpdate = DB::table('child_note_for_fd_threes')
                ->where('parent_note_for_fd_three_id',$id)
                ->where('receiver_id',Auth::guard('admin')->user()->id)
                ->update(array('view_status' => 1));

            }elseif($status == 'fdFive'){

                $checkParentFirst = DB::table('parent_note_for_fd_fives')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
                $childNoteNewList = DB::table('child_note_for_fd_fives')->where('pnote_fd_five',$id)->get();
                $childNoteNewListValue = DB::table('child_note_for_fd_fives')->where('pnote_fd_five',$id)->orderBy('id','desc')->value('id');

                $childNoteNewListUpdate = DB::table('child_note_for_fd_fives')
                ->where('pnote_fd_five',$id)
                ->where('receiver_id',Auth::guard('admin')->user()->id)
                ->update(array('view_status' => 1));

            }elseif($status == 'formNoFive'){

                $checkParentFirst = DB::table('parent_note_for_form_no_five_daks')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
                $childNoteNewList = DB::table('child_note_for_form_no_fives')->where('pnote_form_no_five',$id)->get();
                $childNoteNewListValue = DB::table('child_note_for_form_no_fives')->where('pnote_form_no_five',$id)->orderBy('id','desc')->value('id');

                $childNoteNewListUpdate = DB::table('child_note_for_form_no_fives')
                ->where('pnote_form_no_five',$id)
                ->where('receiver_id',Auth::guard('admin')->user()->id)
                ->update(array('view_status' => 1));

            }elseif($status == 'formNoSeven'){

                $checkParentFirst = DB::table('parent_note_for_form_no_sevens')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
                $childNoteNewList = DB::table('child_note_for_form_no_sevens')->where('pnote_form_no_seven',$id)->get();
                $childNoteNewListValue = DB::table('child_note_for_form_no_sevens')->where('pnote_form_no_seven',$id)->orderBy('id','desc')->value('id');

                $childNoteNewListUpdate = DB::table('child_note_for_form_no_sevens')
                ->where('pnote_form_no_seven',$id)
                ->where('receiver_id',Auth::guard('admin')->user()->id)
                ->update(array('view_status' => 1));

            }elseif($status == 'formNoFour'){

                $checkParentFirst = DB::table('parent_note_for_form_no_fours')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
                $childNoteNewList = DB::table('child_note_for_form_no_fours')->where('pnote_form_no_four',$id)->get();
                $childNoteNewListValue = DB::table('child_note_for_form_no_fours')->where('pnote_form_no_four',$id)->orderBy('id','desc')->value('id');

                $childNoteNewListUpdate = DB::table('child_note_for_form_no_fours')
                ->where('pnote_form_no_four',$id)
                ->where('receiver_id',Auth::guard('admin')->user()->id)
                ->update(array('view_status' => 1));

            }elseif($status == 'fdFourOneForm'){

                $checkParentFirst = DB::table('parent_note_for_fd_four_one_forms')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
                $childNoteNewList = DB::table('child_note_for_fd_four_one_forms')->where('pnote_fd_four_one_form',$id)->get();
                $childNoteNewListValue = DB::table('child_note_for_fd_four_one_forms')->where('pnote_fd_four_one_form',$id)->orderBy('id','desc')->value('id');

                $childNoteNewListUpdate = DB::table('child_note_for_fd_four_one_forms')
                ->where('pnote_fd_four_one_form',$id)
                ->where('receiver_id',Auth::guard('admin')->user()->id)
                ->update(array('view_status' => 1));

            }elseif($status == 'duplicate'){

                $checkParentFirst = DB::table('parent_note_for_duplicate_certificates')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
                $childNoteNewList = DB::table('child_note_for_duplicate_certificates')->where('pnote_dupid',$id)->get();
                $childNoteNewListValue = DB::table('child_note_for_duplicate_certificates')->where('pnote_dupid',$id)->orderBy('id','desc')->value('id');

                $childNoteNewListUpdate = DB::table('child_note_for_duplicate_certificates')
                ->where('pnote_dupid',$id)
                ->where('receiver_id',Auth::guard('admin')->user()->id)
                ->update(array('view_status' => 1));

            }elseif($status == 'constitution'){

                $checkParentFirst = DB::table('parent_note_for_constitutions')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
                $childNoteNewList = DB::table('child_note_for_constitutions')->where('pnote_conid',$id)->get();
                $childNoteNewListValue = DB::table('child_note_for_constitutions')->where('pnote_conid',$id)->orderBy('id','desc')->value('id');

                $childNoteNewListUpdate = DB::table('child_note_for_constitutions')
                ->where('pnote_conid',$id)
                ->where('receiver_id',Auth::guard('admin')->user()->id)
                ->update(array('view_status' => 1));

            }elseif($status == 'committee'){

                $checkParentFirst = DB::table('parent_not_for_executive_committees')->where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->where('id',$id)->first();
                $childNoteNewList = DB::table('child_note_for_executive_committees')->where('pnote_exeid',$id)->get();
                $childNoteNewListValue = DB::table('child_note_for_executive_committees')->where('pnote_exeid',$id)->orderBy('id','desc')->value('id');

                $childNoteNewListUpdate = DB::table('child_note_for_executive_committees')
                ->where('pnote_exeid',$id)
                ->where('receiver_id',Auth::guard('admin')->user()->id)
                ->update(array('view_status' => 1));


            }

            return view('admin.presentDocument.viewChildNote',
            compact(
                'fdFourOneFormStatusId',
            'dataFdFourOneForm',
            'formNoFourStatusId',
            'dataFromNoFourForm',
                'formNoFiveStepTwoData',
                'formNoFiveStepThreeData',
                'formNoFiveStepFourData',
                'formNoFiveStepFiveOther',
                'formNoFiveStepFiveData',
                'formNoFiveStepFiveArea',
                'formNoFiveStatusId',
                'dataFromNoFiveForm',
                'formNoSevenStatusId',
                'dataFromNoSevenForm',
                'fdNineOtherFileList',
                'dataFromFdFive',
                'fdFiveStatusId',
                'committeeStatusId',
                'dataFromCommittee',
                'constitutionStatusId',
                'dataFromConstitution',
                'duplicateCertificateStatusId',
                'dataFromDuplicateCertificate',
                'get_email_from_user',
                'dataFromFd6Form',
                'fd2FormList',
                'fd2OtherInfo',
                'prokolpoAreaList',
                'dataFromFd7Form',
                'dataFromFc1Form',
                'dataFromFc2Form',
                'dataFromFd3Form',
                'mainIdFdNineOne',
                'nVisabasicInfo',
                'forwardingLetterOnulipi',
                'editCheck1',
                'editCheck',
                'statusData',
                'ngoStatus',
                'nVisaWorkPlace',
                'nVisaSponSor',
                'nVisaForeignerInfo',
                'nVisaManPower',
                'nVisaEmploye',
                'nVisaCompensationAndBenifits',
                'nVisaAuthPerson',
                'nVisaDocs',
                'dataFromNVisaFd9Fd1',
                'allNameChangeDoc',
                'getformOneId',
                'duration_list_all1',
                'duration_list_all',
                'r_status',
                'ngoTypeData',
                'renewInfoData',
                'mainIdR',
                'renew_status',
                'name_change_status',
                'form_member_data_doc_renew',
                'get_all_data_adviser',
                'get_all_data_other',
                'get_all_data_adviser_bank',
                'all_partiw',
                'all_source_of_fund',
                'users_info',
                'form_ngo_data_doc',
                'form_member_data_doc',
                'form_member_data',
                'form_eight_data',
                'all_data_for_new_list_all',
                'form_one_data',
                'childNoteNewListValue',
                'childNoteNewList',
                'checkParentFirst',
                'nothiYear',
                'branchListForSerial',
                'permissionNothiList',
                'nothiCopyListUpdate',
                'nothiAttractListUpdate',
                'nothiPropokListUpdate',
                'user',
                'nothiId',
                'nothiNumber',
                'officeDetail',
                'checkParent',
                'status',
                'id',
                'parentId',
                'activeCode'
        ));

        } catch (\Exception $e) {
             return redirect()->route('error_404')->with('error','some thing went wrong ');
        }

    }


    public function givePermissionToNote($status,$parentId,$nothiId,$id,$childnote){


        try {
            //start the transaction


            //new code 24 february


            $senderIdNews = DB::table('seal_statuses')
            ->where('noteId',$id)
            ->where('nothiId',$nothiId)
            ->where('receiver',Auth::guard('admin')->user()->id)
            ->where('status',$status)
            ->where('seal_status',2)
            ->where('childId',$childnote)
            ->update([

                'seal_status' =>1
            ]);


            // end new code 24 february

            DB::table('nothi_details')
            ->where('noteId',$id)
            ->where('nothId',$nothiId)
            ->where('dakId',$parentId)
            ->where('dakType',$status)
            ->update([

                'permission_status' =>1
             ]);



                 return redirect()->back()->with('success','ফলভাবে নুতি দেওয়া য়ছে');

            }catch (\Exception $e) {


                 return redirect()->route('error_404')->with('error','some thing went wrong ');
            }


    }

    public function givePermissionForPotroZari($status,$parentId,$nothiId,$id,$childnote){

        try{
                $getPrapokLIst = DB::table('nothi_prapoks')
                ->where('nothiId',$nothiId)
                ->where('noteId',$id)
                ->where('nijOfficeId',$status)
                ->whereNotNull('otherOfficerEmail')
                ->get();

                $getAttlIst = DB::table('nothi_attarcts')
                ->where('nothiId',$nothiId)
                ->where('noteId',$id)
                ->where('nijOfficeId',$status)
                ->whereNotNull('otherOfficerEmail')
                ->get();

                $getCopylIst = DB::table('nothi_copies')
                ->where('nothiId',$nothiId)
                ->where('noteId',$id)
                ->where('nijOfficeId',$status)
                ->whereNotNull('otherOfficerEmail')
                ->get();


                if(count($getPrapokLIst) == 0){


                }else{

                   $mainUrl = url('printPotrangsoPdfForEmail/'.$status.'/'.$parentId.'/'.$nothiId.'/'.$id);

                    foreach($getPrapokLIst as $getPrapokLIsts){


                    Mail::send('emails.pdf', ['mainUrl' =>$mainUrl], function($message) use($getPrapokLIsts){
                        $message->to($getPrapokLIsts->otherOfficerEmail);
                        $message->subject('Issued Letter');
                    });

                }

                }


                if(count($getAttlIst) == 0){


                }else{

                    $mainUrl = url('printPotrangsoPdfForEmail/'.$status.'/'.$parentId.'/'.$nothiId.'/'.$id);

                    foreach($getAttlIst as $getPrapokLIsts){


                    Mail::send('emails.pdf', ['mainUrl' =>$mainUrl], function($message) use($getPrapokLIsts){
                        $message->to($getPrapokLIsts->otherOfficerEmail);
                        $message->subject('Issued Letter');
                    });

                }

                }

                if(count($getCopylIst) == 0){


                }else{

                    $mainUrl = url('printPotrangsoPdfForEmail/'.$status.'/'.$parentId.'/'.$nothiId.'/'.$id);

                    foreach($getPrapokLIst as $getPrapokLIsts){


                    Mail::send('emails.pdf', ['mainUrl' =>$mainUrl], function($message) use($getPrapokLIsts){
                        $message->to($getCopylIst->otherOfficerEmail);
                        $message->subject('Issued Letter');
                    });

                }

                }

                if($status == 'registration'){

                    $officeDetail = RegistrationOfficeSarok::where('parent_note_regid',$id)->get();
                    $checkParent = ParentNoteForRegistration::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

                }elseif($status == 'renew'){

                    $officeDetail = RenewOfficeSarok::where('parent_note_for_renew_id',$id)->get();
                    $checkParent = ParentNoteForRenew::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

                }elseif($status == 'nameChange'){

                    $officeDetail = NameChangeOfficeSarok::where('parentnote_name_change_id',$id)->get();
                    $checkParent = ParentNoteForNameChange::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

                }elseif($status == 'fdNine'){

                    $officeDetail = FdNineOfficeSarok::where('p_note_for_fd_nine_id',$id)->get();
                    $checkParent = ParentNoteForFdNine::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

                }elseif($status == 'fdNineOne'){

                    $officeDetail = FdNineOneOfficeSarok::where('p_note_for_fd_nine_one_id',$id)->get();
                    $checkParent = ParentNoteForFdNineOne::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

                }elseif($status == 'fdSix'){

                    $officeDetail = FdSixOfficeSarok::where('parent_note_for_fdsix_id',$id)->get();
                    $checkParent = ParentNoteForFdsix::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

                }elseif($status == 'fdSeven'){

                    $officeDetail = FdSevenOfficeSarok::where('parent_note_for_fd_seven_id',$id)->get();
                    $checkParent = ParentNoteForFdSeven::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

                }elseif($status == 'fcOne'){

                    $officeDetail = FcOneOfficeSarok::where('parent_note_for_fc_one_id',$id)->get();
                    $checkParent = ParentNoteForFcOne::where('nothi_detail_id',$parentId)->get();

                }elseif($status == 'fcTwo'){

                    $officeDetail = FcTwoOfficeSarok::where('parent_note_for_fc_two_id',$id)->get();
                    $checkParent = ParentNoteForFcTwo::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

                }elseif($status == 'fdThree'){

                    $officeDetail = FdThreeOfficeSarok::where('parent_note_for_fd_three_id',$id)->get();
                    $checkParent = ParentNoteForFdThree::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

                }elseif($status == 'fdFive'){

                    $officeDetail = FdFiveOfficeSarok::where('pnote_fd_five',$id)->get();
                    $checkParent = ParentNoteForFdFive::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

                }elseif($status == 'formNoFive'){

                    $officeDetail = FormNoFiveOfficeSarok::where('pnote_form_no_five',$id)->get();
                    $checkParent = ParentNoteForFormNoFiveDak::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

                }elseif($status == 'formNoSeven'){

                    $officeDetail = FormNoSevenOfficeSarok::where('pnote_form_no_seven',$id)->get();
                    $checkParent = ParentNoteForFormNoSeven::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

                }elseif($status == 'formNoFour'){

                    $officeDetail = FormNoFourOfficeSarok::where('pnote_form_no_four',$id)->get();
                    $checkParent = ParentNoteForFormNoFourDak::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

                }elseif($status == 'fdFourOneForm'){

                    $officeDetail = FdFourOneFormOfficeSarok::where('pnote_fd_four_one_form',$id)->get();
                    $checkParent = ParentNoteForFdFourOneFormDak::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

                }elseif($status == 'duplicate'){

                    $officeDetail = DuplicateCertificateOfficeSarok::where('pnote_dupid',$id)->get();
                    $checkParent = ParentNoteForDuplicateCertificate::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

                }elseif($status == 'constitution'){

                    $officeDetail = ConstitutionOfficeSarok::where('pnote_conid',$id)->get();
                    $checkParent = ParentNoteForConstitution::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

                }elseif($status == 'committee'){

                    $officeDetail = ExecutiveCommitteeOfficeSarok::where('pnote_exeid',$id)->get();
                    $checkParent = ParentNotForExecutiveCommittee::where('nothi_detail_id',$parentId)->where('serial_number',$nothiId)->get();

                }


                $nothiNumber = NothiList::where('id',$nothiId)->value('main_sarok_number');
                $nothiYear = NothiList::where('id',$nothiId)->value('document_year');

                $user = Admin::where('id','!=',1)->get();


                $nothiPropokListUpdate = NothiPrapok::where('nothiId',$nothiId)
                ->where('noteId',$id)->where('status',1)->get();
                $nothiAttractListUpdate = NothiAttarct::where('nothiId',$nothiId)
                ->where('noteId',$id)->where('status',1)->get();
                $nothiCopyListUpdate = NothiCopy::where('nothiId',$nothiId)
                ->where('noteId',$id)->where('status',1)->get();

                $permissionNothiList = NothiPermission::where('nothId',$nothiId)->get();

                $convert_name_title = $permissionNothiList->implode("branchId", " ");
                $separated_data_title = explode(" ", $convert_name_title);

                $branchListForSerial = Branch::whereIn('id',$separated_data_title)->orderBy('branch_step','asc')->get();

                $file_Name_Custome ='IssuedPaper-'.date('d').date('F').date('Y').'-'.time().CommonController::generateRandomInteger();

                $url = public_path('uploads\IssuedPaper');

                File::makeDirectory($url, 0777, true, true);

                $data =view('admin.presentDocument.issuedPaper',[
                    'nothiYear'=>$nothiYear,
                    'childnote'=>$childnote,
                    'parentId'=>$parentId,
                    'id'=>$id,
                    'status'=>$status,
                    'checkParent'=>$checkParent,
                    'officeDetail'=>$officeDetail,
                    'nothiNumber'=>$nothiNumber,
                    'nothiId'=>$nothiId,
                    'user'=>$user,
                    'nothiPropokListUpdate'=>$nothiPropokListUpdate,
                    'nothiAttractListUpdate'=>$nothiAttractListUpdate,
                    'branchListForSerial'=>$branchListForSerial,
                    'permissionNothiList'=>$permissionNothiList,
                    'nothiCopyListUpdate'=>$nothiCopyListUpdate])->render();

                DB::table('nothi_details')
                ->where('noteId',$id)
                ->where('nothId',$nothiId)
                ->where('dakId',$parentId)
                ->where('dakType',$status)
                ->update([
                    'potroPdf'=>'uploads/IssuedPaper/'.$file_Name_Custome.'.pdf',
                    'zari_permission_status' =>1
                 ]);

                $pdfFilePath =$file_Name_Custome.'.pdf';

                     $mpdf = new Mpdf([
                        'default_font' => 'nikosh'
                    ]);

                    $mpdf->WriteHTML($data);
                    $mpdf->Output("./public/uploads/IssuedPaper/".$pdfFilePath, "F");

                return redirect()->back()->with('success','সফলভাবে অুমতি দেওয়া য়েছে');

                }catch (\Exception $e) {
                     return redirect()->route('error_404')->with('error','some thing went wrong ');
                }
    }


    public function saveNothiPermission($data){


        $dt = new DateTime();
        $dt->setTimezone(new DateTimezone('Asia/Dhaka'));
        $created_at = $dt->format('Y-m-d h:i:s ');

        $amPmValue = $dt->format('a');

        if($amPmValue == 'pm'){

            $amPmValueFinal = 'পরাহ্ন';
        }else{
            $amPmValueFinal = 'পূর্বহ্ন';

        }


        $lastSarokValue = PotrangshoDraft::where('nothiId',$data['nothiId'])
                                        ->where('noteId',$data['noteId'])
                                        ->where('status',$data['status'])
                                        ->where('adminId',Auth::guard('admin')->user()->id)
                                        ->where('SentStatus',0)
                                        ->orderBy('id','desc')
                                        ->first();

                if(!$lastSarokValue){


                }else{

                    $newCode =PotrangshoDraft::find($lastSarokValue->id);
                    $newCode->SentStatus = 1;
                    $newCode->receiverId = $data['nothiPermissionId'];
                    $newCode->save();

                if($data['status'] == 'registration'){

                    $saveNewData = RegistrationOfficeSarok::find($lastSarokValue->sarokId);
                    $saveNewData->office_subject = $lastSarokValue->office_subject;
                    $saveNewData->office_sutro = $lastSarokValue->office_sutro;
                    $saveNewData->description =$lastSarokValue->description;
                    $saveNewData->sarok_number =$lastSarokValue->sarok_number;
                    $saveNewData->extra_text =$lastSarokValue->extra_text;
                    $saveNewData->save();

                }elseif($data['status'] == 'renew'){

                    $saveNewData = RenewOfficeSarok::find($lastSarokValue->sarokId);
                    $saveNewData->office_subject = $lastSarokValue->office_subject;
                    $saveNewData->office_sutro = $lastSarokValue->office_sutro;
                    $saveNewData->description =$lastSarokValue->description;
                    $saveNewData->sarok_number =$lastSarokValue->sarok_number;
                    $saveNewData->extra_text =$lastSarokValue->extra_text;
                    $saveNewData->save();

                }elseif($data['status'] == 'nameChange'){

                    $saveNewData = NameChangeOfficeSarok::find($lastSarokValue->sarokId);
                    $saveNewData->office_subject = $lastSarokValue->office_subject;
                    $saveNewData->office_sutro = $lastSarokValue->office_sutro;
                    $saveNewData->description =$lastSarokValue->description;
                    $saveNewData->sarok_number =$lastSarokValue->sarok_number;
                    $saveNewData->extra_text =$lastSarokValue->extra_text;
                    $saveNewData->save();

                }elseif($data['status'] == 'fdNine'){

                    $saveNewData = FdNineOfficeSarok::find($lastSarokValue->sarokId);
                    $saveNewData->office_subject = $lastSarokValue->office_subject;
                    $saveNewData->office_sutro = $lastSarokValue->office_sutro;
                    $saveNewData->description =$lastSarokValue->description;
                    $saveNewData->sarok_number =$lastSarokValue->sarok_number;
                    $saveNewData->extra_text =$lastSarokValue->extra_text;
                    $saveNewData->save();


                 }elseif($data['status'] == 'fdNineOne'){

                    $saveNewData = FdNineOneOfficeSarok::find($lastSarokValue->sarokId);
                    $saveNewData->office_subject = $lastSarokValue->office_subject;
                    $saveNewData->office_sutro = $lastSarokValue->office_sutro;
                    $saveNewData->description =$lastSarokValue->description;
                    $saveNewData->sarok_number =$lastSarokValue->sarok_number;
                    $saveNewData->extra_text =$lastSarokValue->extra_text;
                    $saveNewData->save();

                 }elseif($data['status'] == 'fdSix'){

                    $saveNewData = FdSixOfficeSarok::find($lastSarokValue->sarokId);
                    $saveNewData->office_subject = $lastSarokValue->office_subject;
                    $saveNewData->office_sutro = $lastSarokValue->office_sutro;
                    $saveNewData->description =$lastSarokValue->description;
                    $saveNewData->sarok_number =$lastSarokValue->sarok_number;
                    $saveNewData->extra_text =$lastSarokValue->extra_text;
                    $saveNewData->save();

                 }elseif($data['status'] == 'fdSeven'){

                    $saveNewData = FdSevenOfficeSarok::find($lastSarokValue->sarokId);
                    $saveNewData->office_subject = $lastSarokValue->office_subject;
                    $saveNewData->office_sutro = $lastSarokValue->office_sutro;
                    $saveNewData->description =$lastSarokValue->description;
                    $saveNewData->sarok_number =$lastSarokValue->sarok_number;
                    $saveNewData->extra_text =$lastSarokValue->extra_text;
                    $saveNewData->save();


                 }elseif($data['status'] == 'fcOne'){

                    $saveNewData = FcOneOfficeSarok::find($lastSarokValue->sarokId);
                    $saveNewData->office_subject = $lastSarokValue->office_subject;
                    $saveNewData->office_sutro = $lastSarokValue->office_sutro;
                    $saveNewData->description =$lastSarokValue->description;
                    $saveNewData->sarok_number =$lastSarokValue->sarok_number;
                    $saveNewData->extra_text =$lastSarokValue->extra_text;
                    $saveNewData->save();

                 }elseif($data['status'] == 'fcTwo'){


                    $saveNewData = FcTwoOfficeSarok::find($lastSarokValue->sarokId);
                    $saveNewData->office_subject = $lastSarokValue->office_subject;
                    $saveNewData->office_sutro = $lastSarokValue->office_sutro;
                    $saveNewData->description =$lastSarokValue->description;
                    $saveNewData->sarok_number =$lastSarokValue->sarok_number;
                    $saveNewData->extra_text =$lastSarokValue->extra_text;
                    $saveNewData->save();


                 }elseif($data['status'] == 'fdThree'){

                    $saveNewData = FdThreeOfficeSarok::find($lastSarokValue->sarokId);
                    $saveNewData->office_subject = $lastSarokValue->office_subject;
                    $saveNewData->office_sutro = $lastSarokValue->office_sutro;
                    $saveNewData->description =$lastSarokValue->description;
                    $saveNewData->sarok_number =$lastSarokValue->sarok_number;
                    $saveNewData->extra_text =$lastSarokValue->extra_text;
                    $saveNewData->save();


                 }elseif($data['status'] == 'fdFive'){

                    $saveNewData = FdFiveOfficeSarok::find($lastSarokValue->sarokId);
                    $saveNewData->office_subject = $lastSarokValue->office_subject;
                    $saveNewData->office_sutro = $lastSarokValue->office_sutro;
                    $saveNewData->description =$lastSarokValue->description;
                    $saveNewData->sarok_number =$lastSarokValue->sarok_number;
                    $saveNewData->extra_text =$lastSarokValue->extra_text;
                    $saveNewData->save();


                 }elseif($data['status'] == 'formNoFive'){

                    $saveNewData = FormNoFiveOfficeSarok::find($lastSarokValue->sarokId);
                    $saveNewData->office_subject = $lastSarokValue->office_subject;
                    $saveNewData->office_sutro = $lastSarokValue->office_sutro;
                    $saveNewData->description =$lastSarokValue->description;
                    $saveNewData->sarok_number =$lastSarokValue->sarok_number;
                    $saveNewData->extra_text =$lastSarokValue->extra_text;
                    $saveNewData->save();


                 }elseif($data['status'] == 'formNoSeven'){

                    $saveNewData = FormNoSevenOfficeSarok::find($lastSarokValue->sarokId);
                    $saveNewData->office_subject = $lastSarokValue->office_subject;
                    $saveNewData->office_sutro = $lastSarokValue->office_sutro;
                    $saveNewData->description =$lastSarokValue->description;
                    $saveNewData->sarok_number =$lastSarokValue->sarok_number;
                    $saveNewData->extra_text =$lastSarokValue->extra_text;
                    $saveNewData->save();


                 }elseif($data['status'] == 'formNoFour'){

                    $saveNewData = FormNoFourOfficeSarok::find($lastSarokValue->sarokId);
                    $saveNewData->office_subject = $lastSarokValue->office_subject;
                    $saveNewData->office_sutro = $lastSarokValue->office_sutro;
                    $saveNewData->description =$lastSarokValue->description;
                    $saveNewData->sarok_number =$lastSarokValue->sarok_number;
                    $saveNewData->extra_text =$lastSarokValue->extra_text;
                    $saveNewData->save();


                 }elseif($data['status'] == 'fdFourOneForm'){

                    $saveNewData = FdFourOneFormOfficeSarok::find($lastSarokValue->sarokId);
                    $saveNewData->office_subject = $lastSarokValue->office_subject;
                    $saveNewData->office_sutro = $lastSarokValue->office_sutro;
                    $saveNewData->description =$lastSarokValue->description;
                    $saveNewData->sarok_number =$lastSarokValue->sarok_number;
                    $saveNewData->extra_text =$lastSarokValue->extra_text;
                    $saveNewData->save();


                 }elseif($data['status'] == 'duplicate'){

                    $saveNewData = DuplicateCertificateOfficeSarok::find($lastSarokValue->sarokId);
                    $saveNewData->office_subject = $lastSarokValue->office_subject;
                    $saveNewData->office_sutro = $lastSarokValue->office_sutro;
                    $saveNewData->description =$lastSarokValue->description;
                    $saveNewData->sarok_number =$lastSarokValue->sarok_number;
                    $saveNewData->extra_text =$lastSarokValue->extra_text;
                    $saveNewData->save();


                 }elseif($data['status'] == 'constitution'){

                    $saveNewData = ConstitutionOfficeSarok::find($lastSarokValue->sarokId);
                    $saveNewData->office_subject = $lastSarokValue->office_subject;
                    $saveNewData->office_sutro = $lastSarokValue->office_sutro;
                    $saveNewData->description =$lastSarokValue->description;
                    $saveNewData->sarok_number =$lastSarokValue->sarok_number;
                    $saveNewData->extra_text =$lastSarokValue->extra_text;
                    $saveNewData->save();


                 }elseif($data['status'] == 'committee'){

                    $saveNewData = ExecutiveCommitteeOfficeSarok::find($lastSarokValue->sarokId);
                    $saveNewData->office_subject = $lastSarokValue->office_subject;
                    $saveNewData->office_sutro = $lastSarokValue->office_sutro;
                    $saveNewData->description =$lastSarokValue->description;
                    $saveNewData->sarok_number =$lastSarokValue->sarok_number;
                    $saveNewData->extra_text =$lastSarokValue->extra_text;
                    $saveNewData->save();


                 }



                }

                if($data['first_sender'] == 'first_sender'){
                    //dd(13);
                        $mainSaveData = new NothiFirstSenderList();
                        $mainSaveData ->noteId = $data['noteId'];
                        $mainSaveData ->nothId = $data['nothiId'];
                        $mainSaveData ->childId = $data['child_note_id'];
                        $mainSaveData ->dakId = $data['dakId'];
                        $mainSaveData ->dakType = $data['status'];
                        $mainSaveData ->sender = Auth::guard('admin')->user()->id;
                        $mainSaveData ->receiver = $data['nothiPermissionId'];
                        $mainSaveData->save();


                        }

if($data['button_value'] == 'return'){

    try{



            $mainId = DB::table('nothi_details')
            ->where('childId',$data['child_note_id'])
            ->where('noteId',$data['noteId'])
            ->where('nothId',$data['nothiId'])
            ->where('dakId',$data['dakId'])
            ->where('dakType',$data['status'])
            ->where('sender',Auth::guard('admin')->user()->id)
            ->value('id');



            $deleteDatatwo = SealStatus::where('nothiId',$data['nothiId'])
            ->where('childId',$data['child_note_id'])->where('status',$data['status'])->delete();

            $deleteData = NothiDetail::where('nothId',$data['nothiId'])
            ->where('childId',$data['child_note_id'])->delete();


            $deleteDataOneTwo = DB::table('nothi_first_sender_lists')
            ->where('childId',$data['child_note_id'])->delete();

            if($data['status'] == 'renew'){

                DB::table('child_note_for_renews')->where('id',$data['child_note_id'])
                ->update([
                    'sender_id'=> DB::raw('NULL'),
                  //  'receiver_id'=> DB::raw('NULL'),
                    'sent_status'=> DB::raw('NULL'),
                    'view_status'=> DB::raw('NULL'),
                    'back_sign_status' => 1
                 ]);

            }elseif($data['status'] == 'registration'){


                DB::table('child_note_for_registrations')->where('id',$data['child_note_id'])
                ->update([
                    'sender_id'=> DB::raw('NULL'),
                  //  'receiver_id'=> DB::raw('NULL'),
                    'sent_status'=> DB::raw('NULL'),
                    'view_status'=> DB::raw('NULL'),
                    'back_sign_status' => 1
                 ]);


            }elseif($data['status'] == 'nameChange'){

                DB::table('child_note_for_name_changes')->where('id',$data['child_note_id'])
                ->update([
                    'sender_id'=> DB::raw('NULL'),
                  //  'receiver_id'=> DB::raw('NULL'),
                    'sent_status'=> DB::raw('NULL'),
                    'view_status'=> DB::raw('NULL'),
                    'back_sign_status' => 1
                 ]);

            }elseif($data['status'] == 'fdNine'){

                DB::table('child_note_for_fd_nines')->where('id',$data['child_note_id'])
                ->update([
                    'sender_id'=> DB::raw('NULL'),
                  //  'receiver_id'=> DB::raw('NULL'),
                    'sent_status'=> DB::raw('NULL'),
                    'view_status'=> DB::raw('NULL'),
                    'back_sign_status' => 1
                 ]);


            }elseif($data['status'] == 'fdNineOne'){

                DB::table('child_note_for_fd_nine_ones')->where('id',$data['child_note_id'])
                ->update([
                    'sender_id'=> DB::raw('NULL'),
                  //  'receiver_id'=> DB::raw('NULL'),
                    'sent_status'=> DB::raw('NULL'),
                    'view_status'=> DB::raw('NULL'),
                    'back_sign_status' => 1
                 ]);

            }elseif($data['status'] == 'fdSix'){

                DB::table('child_note_for_fd_sixes')->where('id',$data['child_note_id'])
                ->update([
                    'sender_id'=> DB::raw('NULL'),
                  //  'receiver_id'=> DB::raw('NULL'),
                    'sent_status'=> DB::raw('NULL'),
                    'view_status'=> DB::raw('NULL'),
                    'back_sign_status' => 1
                 ]);

            }elseif($data['status'] == 'fdSeven'){

                DB::table('child_note_for_fd_sevens')->where('id',$data['child_note_id'])
                ->update([
                    'sender_id'=> DB::raw('NULL'),
                  //  'receiver_id'=> DB::raw('NULL'),
                    'sent_status'=> DB::raw('NULL'),
                    'view_status'=> DB::raw('NULL'),
                    'back_sign_status' => 1
                 ]);

            }elseif($data['status'] == 'fcOne'){

                DB::table('child_note_for_fc_ones')->where('id',$data['child_note_id'])
                ->update([
                    'sender_id'=> DB::raw('NULL'),
                  //  'receiver_id'=> DB::raw('NULL'),
                    'sent_status'=> DB::raw('NULL'),
                    'view_status'=> DB::raw('NULL'),
                    'back_sign_status' => 1
                 ]);

            }elseif($data['status'] == 'fcTwo'){

                DB::table('child_note_for_fc_twos')->where('id',$data['child_note_id'])
                ->update([
                    'sender_id'=> DB::raw('NULL'),
                  //  'receiver_id'=> DB::raw('NULL'),
                    'sent_status'=> DB::raw('NULL'),
                    'view_status'=> DB::raw('NULL'),
                    'back_sign_status' => 1
                 ]);


            }elseif($data['status'] == 'fdThree'){

                DB::table('child_note_for_fd_threes')->where('id',$data['child_note_id'])
                ->update([
                    'sender_id'=> DB::raw('NULL'),
                  //  'receiver_id'=> DB::raw('NULL'),
                    'sent_status'=> DB::raw('NULL'),
                    'view_status'=> DB::raw('NULL'),
                    'back_sign_status' => 1
                 ]);

            }elseif($data['status'] == 'fdFive'){

                DB::table('child_note_for_fd_fives')->where('id',$data['child_note_id'])
                ->update([
                    'sender_id'=> DB::raw('NULL'),
                  //  'receiver_id'=> DB::raw('NULL'),
                    'sent_status'=> DB::raw('NULL'),
                    'view_status'=> DB::raw('NULL'),
                    'back_sign_status' => 1
                 ]);

            }elseif($data['status'] == 'formNoFive'){

                DB::table('child_note_for_form_no_fives')->where('id',$data['child_note_id'])
                ->update([
                    'sender_id'=> DB::raw('NULL'),
                  //  'receiver_id'=> DB::raw('NULL'),
                    'sent_status'=> DB::raw('NULL'),
                    'view_status'=> DB::raw('NULL'),
                    'back_sign_status' => 1
                 ]);

            }elseif($data['status'] == 'formNoSeven'){

                DB::table('child_note_for_form_no_sevens')->where('id',$data['child_note_id'])
                ->update([
                    'sender_id'=> DB::raw('NULL'),
                  //  'receiver_id'=> DB::raw('NULL'),
                    'sent_status'=> DB::raw('NULL'),
                    'view_status'=> DB::raw('NULL'),
                    'back_sign_status' => 1
                 ]);

            }elseif($data['status'] == 'formNoFour'){

                DB::table('child_note_for_form_no_fours')->where('id',$data['child_note_id'])
                ->update([
                    'sender_id'=> DB::raw('NULL'),
                  //  'receiver_id'=> DB::raw('NULL'),
                    'sent_status'=> DB::raw('NULL'),
                    'view_status'=> DB::raw('NULL'),
                    'back_sign_status' => 1
                 ]);

            }elseif($data['status'] == 'fdFourOneForm'){

                DB::table('child_note_for_fd_four_one_forms')->where('id',$data['child_note_id'])
                ->update([
                    'sender_id'=> DB::raw('NULL'),
                  //  'receiver_id'=> DB::raw('NULL'),
                    'sent_status'=> DB::raw('NULL'),
                    'view_status'=> DB::raw('NULL'),
                    'back_sign_status' => 1
                 ]);

            }elseif($data['status'] == 'duplicate'){

                DB::table('child_note_for_duplicate_certificates')->where('id',$data['child_note_id'])
                ->update([
                    'sender_id'=> DB::raw('NULL'),
                    //  'receiver_id'=> DB::raw('NULL'),
                      'sent_status'=> DB::raw('NULL'),
                      'view_status'=> DB::raw('NULL'),
                      'back_sign_status' => 1
                 ]);

            }elseif($data['status'] == 'constitution'){

                DB::table('child_note_for_constitutions')->where('id',$data['child_note_id'])
                ->update([
                    'sender_id'=> DB::raw('NULL'),
                    //  'receiver_id'=> DB::raw('NULL'),
                      'sent_status'=> DB::raw('NULL'),
                      'view_status'=> DB::raw('NULL'),
                      'back_sign_status' => 1
                 ]);

            }elseif($data['status'] == 'committee'){

                DB::table('child_note_for_executive_committees')->where('id',$data['child_note_id'])
                ->update([
                    'sender_id'=> DB::raw('NULL'),
                    //  'receiver_id'=> DB::raw('NULL'),
                      'sent_status'=> DB::raw('NULL'),
                      'view_status'=> DB::raw('NULL'),
                      'back_sign_status' => 1
                 ]);

            }

            return redirect()->back()->with('error','সফলাবে ফেরত আন হয়ছে');
        } catch (\Exception $e) {

             return redirect()->route('error_404')->with('error','some thing went wrong ');
        }
        }elseif($data['button_value'] == 'returnOther'){


            try{



            $mainId = DB::table('nothi_details')
            ->where('childId',$data['child_note_id'])
            ->where('noteId',$data['noteId'])
            ->where('nothId',$data['nothiId'])
            ->where('dakId',$data['dakId'])
            ->where('dakType',$data['status'])
            ->where('sender',Auth::guard('admin')->user()->id)
            ->value('id');



            $mainIdSender = DB::table('nothi_details')
            ->where('childId',$data['child_note_id'])
            ->where('noteId',$data['noteId'])
            ->where('nothId',$data['nothiId'])
            ->where('dakId',$data['dakId'])
            ->where('dakType',$data['status'])
            ->where('receiver',Auth::guard('admin')->user()->id)
            ->orderBy('id','desc')
            ->value('sender');


            $mainIdReceIver = DB::table('nothi_details')
            ->where('childId',$data['child_note_id'])
            ->where('noteId',$data['noteId'])
            ->where('nothId',$data['nothiId'])
            ->where('dakId',$data['dakId'])
            ->where('dakType',$data['status'])
            ->where('sender',Auth::guard('admin')->user()->id)
            ->orderBy('id','desc')
            ->value('receiver');


            if($data['status'] == 'renew'){

               $getCreatorValue =  DB::table('child_note_for_renews')
               ->where('id',$data['child_note_id'])->value('admin_id');
            }elseif($data['status'] == 'registration'){

                $getCreatorValue =  DB::table('child_note_for_registrations')
                ->where('id',$data['child_note_id'])->value('admin_id');

            }elseif($data['status'] == 'nameChange'){

                $getCreatorValue =  DB::table('child_note_for_name_changes')  ->where('id',$data['child_note_id'])->value('admin_id');

            }elseif($data['status'] == 'fdNine'){

                $getCreatorValue =  DB::table('child_note_for_fd_nines')  ->where('id',$data['child_note_id'])->value('admin_id');

            }elseif($data['status'] == 'fdNineOne'){

                $getCreatorValue = DB::table('child_note_for_fd_nine_ones')  ->where('id',$data['child_note_id'])->value('admin_id');

            }elseif($data['status'] == 'fdSix'){

                $getCreatorValue = DB::table('child_note_for_fd_sixes')  ->where('id',$data['child_note_id'])->value('admin_id');

            }elseif($data['status'] == 'fdSeven'){

                $getCreatorValue =  DB::table('child_note_for_fd_sevens')  ->where('id',$data['child_note_id'])->value('admin_id');

            }elseif($data['status'] == 'fcOne'){

                $getCreatorValue =  DB::table('child_note_for_fc_ones')  ->where('id',$data['child_note_id'])->value('admin_id');

            }elseif($data['status'] == 'fcTwo'){

                $getCreatorValue = DB::table('child_note_for_fc_twos')  ->where('id',$data['child_note_id'])->value('admin_id');


            }elseif($data['status'] == 'fdThree'){

                $getCreatorValue =  DB::table('child_note_for_fd_threes')
                ->where('id',$data['child_note_id'])->value('admin_id');

            }elseif($data['status'] == 'fdFive'){

                $getCreatorValue =  DB::table('child_note_for_fd_fives')
                ->where('id',$data['child_note_id'])->value('admin_id');

            }elseif($data['status'] == 'formNoFive'){

                $getCreatorValue =  DB::table('child_note_for_form_no_fives')
                ->where('id',$data['child_note_id'])->value('admin_id');

            }elseif($data['status'] == 'formNoSeven'){

                $getCreatorValue =  DB::table('child_note_for_form_no_sevens')
                ->where('id',$data['child_note_id'])->value('admin_id');

            }elseif($data['status'] == 'formNoFour'){

                $getCreatorValue =  DB::table('child_note_for_form_no_fours')
                ->where('id',$data['child_note_id'])->value('admin_id');

            }elseif($data['status'] == 'fdFourOneForm'){

                $getCreatorValue =  DB::table('child_note_for_fd_four_one_forms')
                ->where('id',$data['child_note_id'])->value('admin_id');

            }elseif($data['status'] == 'duplicate'){

                DB::table('child_note_for_duplicate_certificates')->where('id',$data['child_note_id'])
                ->value('admin_id');

            }elseif($data['status'] == 'constitution'){

                DB::table('child_note_for_constitutions')->where('id',$data['child_note_id'])
                ->value('admin_id');

            }elseif($data['status'] == 'committee'){

                DB::table('child_note_for_executive_committees')->where('id',$data['child_note_id'])
                ->value('admin_id');

            }


            if($getCreatorValue == $mainIdReceIver){

                $deleteDatatwoOne = SealStatus::where('nothiId',$data['nothiId'])
                ->where('childId',$data['child_note_id'])->where('status',$data['status'])
                ->where('receiver',Auth::guard('admin')->user()->id)
                ->update([
                    'seal_status'=> 2,
                 ]);

            }else{





            $deleteDatatwo = SealStatus::where('nothiId',$data['nothiId'])
            ->where('childId',$data['child_note_id'])->where('status',$data['status'])
            ->where('receiver',$mainIdReceIver)
            ->delete();



            $deleteDatatwoOne = SealStatus::where('nothiId',$data['nothiId'])
            ->where('childId',$data['child_note_id'])->where('status',$data['status'])
            ->where('receiver',Auth::guard('admin')->user()->id)
            ->update([
                'seal_status'=> 2,
             ]);

            }


            if($data['status'] == 'renew'){

                DB::table('child_note_for_renews')->where('id',$data['child_note_id'])
                ->update([
                    'sender_id'=> $mainIdSender,
                    'receiver_id'=>Auth::guard('admin')->user()->id,
                    // 'sent_status'=> DB::raw('NULL'),
                    // 'view_status'=> DB::raw('NULL'),
                    // 'back_sign_status' => 1
                 ]);

            }elseif($data['status'] == 'registration'){


                DB::table('child_note_for_registrations')->where('id',$data['child_note_id'])
                ->update([
                    'sender_id'=> $mainIdSender,
                    'receiver_id'=>Auth::guard('admin')->user()->id,
                    // 'sent_status'=> DB::raw('NULL'),
                    // 'view_status'=> DB::raw('NULL'),
                    // 'back_sign_status' => 1
                 ]);

            }elseif($data['status'] == 'nameChange'){

                DB::table('child_note_for_name_changes')->where('id',$data['child_note_id'])
                ->update([
                    'sender_id'=> $mainIdSender,
                    'receiver_id'=>Auth::guard('admin')->user()->id,
                 ]);

            }elseif($data['status'] == 'fdNine'){

                DB::table('child_note_for_fd_nines')->where('id',$data['child_note_id'])
                ->update([
                    'sender_id'=> $mainIdSender,
                    'receiver_id'=>Auth::guard('admin')->user()->id,
                 ]);


            }elseif($data['status'] == 'fdNineOne'){

                DB::table('child_note_for_fd_nine_ones')->where('id',$data['child_note_id'])
                ->update([
                    'sender_id'=> $mainIdSender,
                    'receiver_id'=>Auth::guard('admin')->user()->id,
                 ]);

            }elseif($data['status'] == 'fdSix'){

                DB::table('child_note_for_fd_sixes')->where('id',$data['child_note_id'])
                ->update([
                    'sender_id'=> $mainIdSender,
                    'receiver_id'=>Auth::guard('admin')->user()->id,
                 ]);

            }elseif($data['status'] == 'fdSeven'){

                DB::table('child_note_for_fd_sevens')->where('id',$data['child_note_id'])
                ->update([
                    'sender_id'=> $mainIdSender,
                    'receiver_id'=>Auth::guard('admin')->user()->id,
                 ]);

            }elseif($data['status'] == 'fcOne'){

                DB::table('child_note_for_fc_ones')->where('id',$data['child_note_id'])
                ->update([
                    'sender_id'=> $mainIdSender,
                    'receiver_id'=>Auth::guard('admin')->user()->id,
                 ]);

            }elseif($data['status'] == 'fcTwo'){

                DB::table('child_note_for_fc_twos')->where('id',$data['child_note_id'])
                ->update([
                    'sender_id'=> $mainIdSender,
                    'receiver_id'=>Auth::guard('admin')->user()->id,
                 ]);


            }elseif($data['status'] == 'fdThree'){

                DB::table('child_note_for_fd_threes')->where('id',$data['child_note_id'])
                ->update([
                    'sender_id'=> $mainIdSender,
                    'receiver_id'=>Auth::guard('admin')->user()->id,
                 ]);

            }elseif($data['status'] == 'fdFive'){

                DB::table('child_note_for_fd_fives')->where('id',$data['child_note_id'])
                ->update([
                    'sender_id'=> $mainIdSender,
                    'receiver_id'=>Auth::guard('admin')->user()->id,
                 ]);

            }elseif($data['status'] == 'formNoFive'){

                DB::table('child_note_for_form_no_fives')->where('id',$data['child_note_id'])
                ->update([
                    'sender_id'=> $mainIdSender,
                    'receiver_id'=>Auth::guard('admin')->user()->id,
                 ]);

            }elseif($data['status'] == 'formNoSeven'){

                DB::table('child_note_for_form_no_sevens')->where('id',$data['child_note_id'])
                ->update([
                    'sender_id'=> $mainIdSender,
                    'receiver_id'=>Auth::guard('admin')->user()->id,
                 ]);

            }elseif($data['status'] == 'formNoFour'){

                DB::table('child_note_for_form_no_fours')->where('id',$data['child_note_id'])
                ->update([
                    'sender_id'=> $mainIdSender,
                    'receiver_id'=>Auth::guard('admin')->user()->id,
                 ]);

            }elseif($data['status'] == 'fdFourOneForm'){

                DB::table('child_note_for_fd_four_one_forms')->where('id',$data['child_note_id'])
                ->update([
                    'sender_id'=> $mainIdSender,
                    'receiver_id'=>Auth::guard('admin')->user()->id,
                 ]);

            }elseif($data['status'] == 'duplicate'){

                DB::table('child_note_for_duplicate_certificates')->where('id',$data['child_note_id'])
                ->update([
                    'sender_id'=> $mainIdSender,
                    'receiver_id'=>Auth::guard('admin')->user()->id,
                 ]);

            }elseif($data['status'] == 'constitution'){

                DB::table('child_note_for_constitutions')->where('id',$data['child_note_id'])
                ->update([
                    'sender_id'=> $mainIdSender,
                    'receiver_id'=>Auth::guard('admin')->user()->id,
                 ]);

            }elseif($data['status'] == 'committee'){

                DB::table('child_note_for_executive_committees')->where('id',$data['child_note_id'])
                ->update([
                    'sender_id'=> $mainIdSender,
                    'receiver_id'=>Auth::guard('admin')->user()->id,
                 ]);

            }


            $deleteData = NothiDetail::where('childId',$data['child_note_id'])
     ->where('noteId',$data['noteId'])
     ->where('nothId',$data['nothiId'])
     ->where('dakId',$data['dakId'])
     ->where('dakType',$data['status'])->where('sender',$mainIdSender)
     ->where('receiver',Auth::guard('admin')->user()->id)
     ->update([

         'sent_status'=> DB::raw('NULL'),

     ]);


     $deleteData = NothiDetail::where('childId',$data['child_note_id'])
     ->where('noteId',$data['noteId'])
     ->where('nothId',$data['nothiId'])
     ->where('dakId',$data['dakId'])
     ->where('dakType',$data['status'])->where('receiver',$mainIdReceIver)
     ->where('sender',Auth::guard('admin')->user()->id)->delete();



     return redirect()->route('receiveNothi.index')->with('error','সফলভাবে ফেত আনা হয়েে');
    } catch (\Exception $e) {

         return redirect()->route('error_404')->with('error','some thing went wrong ');
    }
        }else{

            try{

            ///start new code

      $firstNothiSenderNew = NothiDetail::where('childId',$data['child_note_id'])
     ->where('noteId',$data['noteId'])
     ->where('nothId',$data['nothiId'])
     ->where('dakId',$data['dakId'])
     ->where('dakType',$data['status'])
     ->whereNull('back_nothi')
     ->where('sender',$data['nothiPermissionId'])->value('id');


     $deleteData1 = NothiDetail::where('id',$firstNothiSenderNew)
     ->update([

         'back_nothi'=> 1,

     ]);





            //end new code

        $mainSaveData = new NothiDetail();
        $mainSaveData ->noteId = $data['noteId'];
        $mainSaveData ->nothId = $data['nothiId'];
        $mainSaveData ->childId = $data['child_note_id'];
        $mainSaveData ->dakId = $data['dakId'];
        $mainSaveData ->dakType = $data['status'];
        $mainSaveData ->sent_status_other = 1;
        $mainSaveData ->sender = Auth::guard('admin')->user()->id;
        $mainSaveData ->receiver = $data['nothiPermissionId'];
        $mainSaveData ->created_at= $created_at;
        $mainSaveData ->amPmValue = $amPmValueFinal;
        $mainSaveData->save();

        $mainId = $mainSaveData->id;


      // new code-->


      $checkPreviousCode = SealStatus::where('noteId',$data['noteId'])
      ->where('nothiId',$data['nothiId'])->where('childId',$data['child_note_id'])
      ->where('receiver',Auth::guard('admin')->user()->id)->where('status',$data['status'])
      ->orderBy('id','desc')
      ->value('seal_status');

      if(empty($checkPreviousCode)){



        $adminName = DB::table('admins')->where('id',$data['nothiPermissionId'])
        ->value('admin_name_ban');


        $adminNameDesi = DB::table('admins')->where('id',$data['nothiPermissionId'])
        ->value('designation_list_id');


        $adminNamebran = DB::table('admins')->where('id',$data['nothiPermissionId'])
        ->value('branch_id');


        $adminNameSign = DB::table('admins')->where('id',$data['nothiPermissionId'])
        ->value('admin_sign');



      $mainSaveData = new SealStatus();
      $mainSaveData ->noteId = $data['noteId'];
      $mainSaveData ->nothiId = $data['nothiId'];
      $mainSaveData ->childId = $data['child_note_id'];
      $mainSaveData ->status = $data['status'];
      $mainSaveData ->seal_status = 2;
      $mainSaveData ->receiver = $data['nothiPermissionId'];
      $mainSaveData ->created_at= $created_at;
      $mainSaveData ->amPmValue = $amPmValueFinal;
      $mainSaveData ->e_name= $adminName;
      $mainSaveData ->e_designation= $adminNameDesi;
      $mainSaveData ->e_branch= $adminNamebran;
      $mainSaveData ->e_sign= $adminNameSign;


      $mainSaveData->save();


      }else{

      if($checkPreviousCode == 2){


          $checkPreviousCode = SealStatus::where('noteId',$data['noteId'])
      ->where('nothiId',$data['nothiId'])->where('childId',$data['child_note_id'])
      ->where('receiver',Auth::guard('admin')->user()->id)->where('status',$data['status'])
      ->orderBy('id','desc')
      ->update(array('seal_status' => 1,'updated_at'=>$created_at,'amPmValueUpdate'=>$amPmValueFinal));



       //more code start




//more code end



$adminName = DB::table('admins')->where('id',$data['nothiPermissionId'])
->value('admin_name_ban');


$adminNameDesi = DB::table('admins')->where('id',$data['nothiPermissionId'])
->value('designation_list_id');


$adminNamebran = DB::table('admins')->where('id',$data['nothiPermissionId'])
->value('branch_id');


$adminNameSign = DB::table('admins')->where('id',$data['nothiPermissionId'])
->value('admin_sign');


    $mainSaveData = new SealStatus();
    $mainSaveData ->noteId = $data['noteId'];
    $mainSaveData ->nothiId = $data['nothiId'];
    $mainSaveData ->childId = $data['child_note_id'];
    $mainSaveData ->status = $data['status'];
    $mainSaveData ->seal_status = 2;
    $mainSaveData ->created_at= $created_at;
    $mainSaveData ->receiver = $data['nothiPermissionId'];
    $mainSaveData ->amPmValue = $amPmValueFinal;
    $mainSaveData ->e_name= $adminName;
      $mainSaveData ->e_designation= $adminNameDesi;
      $mainSaveData ->e_branch= $adminNamebran;
      $mainSaveData ->e_sign= $adminNameSign;

    $mainSaveData->save();


      }




      }



      //end new code -->

        if($data['status'] == 'renew'){

            DB::table('child_note_for_renews')->where('id',$data['child_note_id'])
            ->update([

                'back_sign_status' => DB::raw('NULL')
             ]);

        }elseif($data['status'] == 'registration'){

            DB::table('child_note_for_registrations')->where('id',$data['child_note_id'])
            ->update([

                'back_sign_status' => DB::raw('NULL')
             ]);

        }elseif($data['status'] == 'nameChange'){

            DB::table('child_note_for_name_changes')->where('id',$data['child_note_id'])
            ->update([
                'back_sign_status' => DB::raw('NULL')
             ]);

        }elseif($data['status'] == 'fdNine'){

            DB::table('child_note_for_fd_nines')->where('id',$data['child_note_id'])
            ->update([
                'back_sign_status' => DB::raw('NULL')
             ]);


        }elseif($data['status'] == 'fdNineOne'){

            DB::table('child_note_for_fd_nine_ones')->where('id',$data['child_note_id'])
            ->update([
                'back_sign_status' => DB::raw('NULL')
             ]);

        }elseif($data['status'] == 'fdSix'){

            DB::table('child_note_for_fd_sixes')->where('id',$data['child_note_id'])
            ->update([
                'back_sign_status' => DB::raw('NULL')
             ]);

        }elseif($data['status'] == 'fdSeven'){

            DB::table('child_note_for_fd_sevens')->where('id',$data['child_note_id'])
            ->update([
                'back_sign_status' => DB::raw('NULL')
             ]);

        }elseif($data['status'] == 'fcOne'){

            DB::table('child_note_for_fc_ones')->where('id',$data['child_note_id'])
            ->update([
                'back_sign_status' => DB::raw('NULL')
             ]);

        }elseif($data['status'] == 'fcTwo'){

            DB::table('child_note_for_fc_twos')->where('id',$data['child_note_id'])
            ->update([
                'back_sign_status' => DB::raw('NULL')
             ]);


        }elseif($data['status'] == 'fdThree'){

            DB::table('child_note_for_fd_threes')->where('id',$data['child_note_id'])
            ->update([
                'back_sign_status' => DB::raw('NULL')
             ]);

        }elseif($data['status'] == 'fdFive'){

            DB::table('child_note_for_fd_fives')->where('id',$data['child_note_id'])
            ->update([
                'back_sign_status' => DB::raw('NULL')
             ]);

        }elseif($data['status'] == 'formNoFive'){

            DB::table('child_note_for_form_no_fives')->where('id',$data['child_note_id'])
            ->update([
                'back_sign_status' => DB::raw('NULL')
             ]);

        }elseif($data['status'] == 'formNoSeven'){

            DB::table('child_note_for_form_no_sevens')->where('id',$data['child_note_id'])
            ->update([
                'back_sign_status' => DB::raw('NULL')
             ]);

        }elseif($data['status'] == 'formNoFour'){

            DB::table('child_note_for_form_no_fours')->where('id',$data['child_note_id'])
            ->update([
                'back_sign_status' => DB::raw('NULL')
             ]);

        }elseif($data['status'] == 'fdFourOneForm'){

            DB::table('child_note_for_fd_four_one_forms')->where('id',$data['child_note_id'])
            ->update([
                'back_sign_status' => DB::raw('NULL')
             ]);

        }elseif($data['status'] == 'duplicate'){

            DB::table('child_note_for_duplicate_certificates')->where('id',$data['child_note_id'])
            ->update([
                'back_sign_status' => DB::raw('NULL')
             ]);

        }elseif($data['status'] == 'constitution'){

            DB::table('child_note_for_constitutions')->where('id',$data['child_note_id'])
            ->update([
                'back_sign_status' => DB::raw('NULL')
             ]);

        }elseif($data['status'] == 'committee'){

            DB::table('child_note_for_executive_committees')->where('id',$data['child_note_id'])
            ->update([
                'back_sign_status' => DB::raw('NULL')
             ]);

        }

        //new code 12 february  start
        if($data['status'] == 'renew'){

            DB::table('ngo_renew_daks')->where('id',$data['dakId'])
            ->where('receiver_admin_id',Auth::guard('admin')->user()->id)
            ->update([

                'present_status' => 1
             ]);


        }elseif($data['status'] == 'registration'){


            DB::table('ngo_registration_daks')->where('id',$data['dakId'])
            ->where('receiver_admin_id',Auth::guard('admin')->user()->id)
            ->update([

                'present_status' => 1
             ]);


        }elseif($data['status'] == 'nameChange'){

            DB::table('ngo_name_change_daks')->where('id',$data['dakId'])
            ->where('receiver_admin_id',Auth::guard('admin')->user()->id)
            ->update([

                'present_status' => 1
             ]);

        }elseif($data['status'] == 'fdNine'){

            DB::table('ngo_f_d_nine_daks')->where('id',$data['dakId'])
            ->where('receiver_admin_id',Auth::guard('admin')->user()->id)
            ->update([

                'present_status' => 1
             ]);

        }elseif($data['status'] == 'fdNineOne'){

            DB::table('ngo_f_d_nine_one_daks')->where('id',$data['dakId'])
            ->where('receiver_admin_id',Auth::guard('admin')->user()->id)
            ->update([

                'present_status' => 1
             ]);

        }elseif($data['status'] == 'fdSix'){

            DB::table('ngo_fd_six_daks')->where('id',$data['dakId'])
            ->where('receiver_admin_id',Auth::guard('admin')->user()->id)
            ->update([

                'present_status' => 1
             ]);

        }elseif($data['status'] == 'fdSeven'){

            DB::table('ngo_fd_seven_daks')->where('id',$data['dakId'])
            ->where('receiver_admin_id',Auth::guard('admin')->user()->id)
            ->update([

                'present_status' => 1
             ]);

        }elseif($data['status'] == 'fcOne'){

            DB::table('fc_one_daks')->where('id',$data['dakId'])
            ->where('receiver_admin_id',Auth::guard('admin')->user()->id)
            ->update([

                'present_status' => 1
             ]);
        }elseif($data['status'] == 'fcTwo'){

            DB::table('fc_two_daks')->where('id',$data['dakId'])
            ->where('receiver_admin_id',Auth::guard('admin')->user()->id)
            ->update([

                'present_status' => 1
             ]);


        }elseif($data['status'] == 'fdThree'){

            DB::table('fd_three_daks')->where('id',$data['dakId'])
            ->where('receiver_admin_id',Auth::guard('admin')->user()->id)
            ->update([

                'present_status' => 1
             ]);

        }elseif($data['status'] == 'fdFive'){

            DB::table('fd_five_daks')->where('id',$data['dakId'])
            ->where('receiver_admin_id',Auth::guard('admin')->user()->id)
            ->update([

                'present_status' => 1
             ]);

        }elseif($data['status'] == 'formNoFive'){

            DB::table('form_no_five_daks')->where('id',$data['dakId'])
            ->where('receiver_admin_id',Auth::guard('admin')->user()->id)
            ->update([

                'present_status' => 1
             ]);

        }elseif($data['status'] == 'formNoSeven'){

            DB::table('form_no_seven_daks')->where('id',$data['dakId'])
            ->where('receiver_admin_id',Auth::guard('admin')->user()->id)
            ->update([

                'present_status' => 1
             ]);

        }elseif($data['status'] == 'formNoFour'){

            DB::table('form_no_four_daks')->where('id',$data['dakId'])
            ->where('receiver_admin_id',Auth::guard('admin')->user()->id)
            ->update([

                'present_status' => 1
             ]);

        }elseif($data['status'] == 'fdFourOneForm'){

            DB::table('fd4_one_form_daks')->where('id',$data['dakId'])
            ->where('receiver_admin_id',Auth::guard('admin')->user()->id)
            ->update([

                'present_status' => 1
             ]);

        }elseif($data['status'] == 'duplicate'){

            DB::table('duplicate_certificate_daks')->where('id',$data['dakId'])
            ->where('receiver_admin_id',Auth::guard('admin')->user()->id)
            ->update([

                'present_status' => 1
             ]);

        }elseif($data['status'] == 'constitution'){

            DB::table('constitution_daks')->where('id',$data['dakId'])
            ->where('receiver_admin_id',Auth::guard('admin')->user()->id)
            ->update([

                'present_status' => 1
             ]);

        }elseif($data['status'] == 'committee'){

            DB::table('executive_committee_daks')->where('id',$data['dakId'])
            ->where('receiver_admin_id',Auth::guard('admin')->user()->id)
            ->update([

                'present_status' => 1
             ]);

        }
        //new code 12 february end


        if($data['status'] == 'registration'){

            $saveNewData = ChildNoteForRegistration::find($data['child_note_id']);
            $saveNewData->sent_status = 1;
            $saveNewData ->updated_at= $created_at;
            $saveNewData ->amPmValueUpdate=$amPmValueFinal;
            $saveNewData->sender_id = Auth::guard('admin')->user()->id;
            $saveNewData->receiver_id = $data['nothiPermissionId'];
            $saveNewData->save();


     }elseif($data['status'] == 'renew'){


        $saveNewData = ChildNoteForRenew::find($data['child_note_id']);
         $saveNewData->sent_status = 1;
         $saveNewData ->updated_at= $created_at;
         $saveNewData ->amPmValueUpdate=$amPmValueFinal;
         $saveNewData->sender_id = Auth::guard('admin')->user()->id;
         $saveNewData->receiver_id = $data['nothiPermissionId'];
         $saveNewData->save();

    }elseif($data['status'] == 'nameChange'){

         $saveNewData = ChildNoteForNameChange::find($data['child_note_id']);
         $saveNewData->sent_status = 1;
         $saveNewData ->updated_at= $created_at;
         $saveNewData ->amPmValueUpdate=$amPmValueFinal;
         $saveNewData->sender_id = Auth::guard('admin')->user()->id;
         $saveNewData->receiver_id = $data['nothiPermissionId'];
         $saveNewData->save();

    }elseif($data['status'] == 'fdNine'){

         $saveNewData = ChildNoteForFdNine::find($data['child_note_id']);
         $saveNewData->sent_status = 1;
         $saveNewData ->updated_at= $created_at;
         $saveNewData ->amPmValueUpdate=$amPmValueFinal;
         $saveNewData->sender_id = Auth::guard('admin')->user()->id;
         $saveNewData->receiver_id = $data['nothiPermissionId'];
         $saveNewData->save();

    }elseif($data['status'] == 'fdNineOne'){

         $saveNewData = ChildNoteForFdNineOne::find($data['child_note_id']);
         $saveNewData->sent_status = 1;
         $saveNewData ->updated_at= $created_at;
         $saveNewData ->amPmValueUpdate=$amPmValueFinal;
         $saveNewData->sender_id = Auth::guard('admin')->user()->id;
         $saveNewData->receiver_id = $data['nothiPermissionId'];
         $saveNewData->save();

    }elseif($data['status'] == 'fdSix'){

         $saveNewData = ChildNoteForFdSix::find($data['child_note_id']);
         $saveNewData->sent_status = 1;
         $saveNewData ->updated_at= $created_at;
         $saveNewData ->amPmValueUpdate=$amPmValueFinal;
         $saveNewData->sender_id = Auth::guard('admin')->user()->id;
         $saveNewData->receiver_id = $data['nothiPermissionId'];
         $saveNewData->save();

    }elseif($data['status'] == 'fdSeven'){

         $saveNewData = ChildNoteForFdSeven::find($data['child_note_id']);
         $saveNewData->sent_status = 1;
         $saveNewData ->updated_at= $created_at;
         $saveNewData ->amPmValueUpdate=$amPmValueFinal;
         $saveNewData->sender_id = Auth::guard('admin')->user()->id;
         $saveNewData->receiver_id = $data['nothiPermissionId'];
         $saveNewData->save();

    }elseif($data['status'] == 'fcOne'){

         $saveNewData = ChildNoteForFcOne::find($data['child_note_id']);
         $saveNewData->sent_status = 1;
         $saveNewData ->updated_at= $created_at;
         $saveNewData ->amPmValueUpdate=$amPmValueFinal;
         $saveNewData->sender_id = Auth::guard('admin')->user()->id;
         $saveNewData->receiver_id = $data['nothiPermissionId'];
         $saveNewData->save();

    }elseif($data['status'] == 'fcTwo'){

         $saveNewData = ChildNoteForFcTwo::find($data['child_note_id']);
         $saveNewData->sent_status = 1;
         $saveNewData ->updated_at= $created_at;
         $saveNewData ->amPmValueUpdate=$amPmValueFinal;
         $saveNewData->sender_id = Auth::guard('admin')->user()->id;
         $saveNewData->receiver_id = $data['nothiPermissionId'];
         $saveNewData->save();

    }elseif($data['status'] == 'fdThree'){

         $saveNewData = ChildNoteForFdThree::find($data['child_note_id']);
         $saveNewData->sent_status = 1;
         $saveNewData ->updated_at= $created_at;
         $saveNewData ->amPmValueUpdate=$amPmValueFinal;
         $saveNewData->sender_id = Auth::guard('admin')->user()->id;
         $saveNewData->receiver_id = $data['nothiPermissionId'];
         $saveNewData->save();
    }elseif($data['status'] == 'fdFive'){

        $saveNewData = ChildNoteForFdFive::find($data['child_note_id']);
        $saveNewData->sent_status = 1;
        $saveNewData ->updated_at= $created_at;
        $saveNewData ->amPmValueUpdate=$amPmValueFinal;
        $saveNewData->sender_id = Auth::guard('admin')->user()->id;
        $saveNewData->receiver_id = $data['nothiPermissionId'];
        $saveNewData->save();
   }elseif($data['status'] == 'formNoFive'){

    $saveNewData = ChildNoteForFormNoFive::find($data['child_note_id']);
    $saveNewData->sent_status = 1;
    $saveNewData ->updated_at= $created_at;
    $saveNewData ->amPmValueUpdate=$amPmValueFinal;
    $saveNewData->sender_id = Auth::guard('admin')->user()->id;
    $saveNewData->receiver_id = $data['nothiPermissionId'];
    $saveNewData->save();
}elseif($data['status'] == 'formNoSeven'){

    $saveNewData = ChildNoteForFormNoSeven::find($data['child_note_id']);
    $saveNewData->sent_status = 1;
    $saveNewData ->updated_at= $created_at;
    $saveNewData ->amPmValueUpdate=$amPmValueFinal;
    $saveNewData->sender_id = Auth::guard('admin')->user()->id;
    $saveNewData->receiver_id = $data['nothiPermissionId'];
    $saveNewData->save();
}elseif($data['status'] == 'formNoFour'){

    $saveNewData = ChildNoteForFormNoFour::find($data['child_note_id']);
    $saveNewData->sent_status = 1;
    $saveNewData ->updated_at= $created_at;
    $saveNewData ->amPmValueUpdate=$amPmValueFinal;
    $saveNewData->sender_id = Auth::guard('admin')->user()->id;
    $saveNewData->receiver_id = $data['nothiPermissionId'];
    $saveNewData->save();
}elseif($data['status'] == 'fdFourOneForm'){

    $saveNewData = ChildNoteForFdFourOneForm::find($data['child_note_id']);
    $saveNewData->sent_status = 1;
    $saveNewData ->updated_at= $created_at;
    $saveNewData ->amPmValueUpdate=$amPmValueFinal;
    $saveNewData->sender_id = Auth::guard('admin')->user()->id;
    $saveNewData->receiver_id = $data['nothiPermissionId'];
    $saveNewData->save();
}elseif($data['status'] == 'duplicate'){

        $saveNewData = ChildNoteForDuplicateCertificate::find($data['child_note_id']);
        $saveNewData->sent_status = 1;
        $saveNewData ->updated_at= $created_at;
        $saveNewData ->amPmValueUpdate=$amPmValueFinal;
        $saveNewData->sender_id = Auth::guard('admin')->user()->id;
        $saveNewData->receiver_id = $data['nothiPermissionId'];

        $saveNewData->save();


    }elseif($data['status'] == 'constitution'){

        $saveNewData = ChildNoteForConstitution::find($data['child_note_id']);
        $saveNewData->sent_status = 1;
     $saveNewData ->updated_at= $created_at;
     $saveNewData ->amPmValueUpdate=$amPmValueFinal;
     $saveNewData->sender_id = Auth::guard('admin')->user()->id;
     $saveNewData->receiver_id = $data['nothiPermissionId'];

        $saveNewData->save();


    }elseif($data['status'] == 'committee'){

        $saveNewData = ChildNoteForExecutiveCommittee::find($data['child_note_id']);
        $saveNewData->sent_status = 1;
        $saveNewData ->updated_at= $created_at;
        $saveNewData ->amPmValueUpdate=$amPmValueFinal;
        $saveNewData->sender_id = Auth::guard('admin')->user()->id;
        $saveNewData->receiver_id = $data['nothiPermissionId'];


        $saveNewData->save();


    }

        return redirect()->route('sendNothi.index')->with('success','সফলভাবে পঠানো হয়েছে');

    } catch (\Exception $e) {

        //return $e->getMessage();
         return redirect()->route('error_404')->with('error','some thing went wrong ');
    }

    }

        return redirect()->route('sendNothi.index')->with('success','সফলভাে পাঠানো হয়ছে');
    }


    public function saveNothiPermissionReturn($data){

        try{

                $dt = new DateTime();
                $dt->setTimezone(new DateTimezone('Asia/Dhaka'));
                $created_at = $dt->format('Y-m-d h:i:s ');

                $amPmValue = $dt->format('a');

                if($amPmValue == 'pm'){

                    $amPmValueFinal = 'অরহ্ন';
                }else{
                    $amPmValueFinal = 'পূর্াহ্ন';

                }


                $getPreviusIdForDelete = DB::table('nothi_details')->where('noteId',$data['noteId'])
                ->where('nothId',$data['nothiId'])->where('dakId',$data['dakId'])
                ->where('dakType',$data['status'])->whereNull('sent_status')
                ->where('view_status',1)->where('sender',$data['nothiPermissionId'])
                ->where('receiver',Auth::guard('admin')->user()->id)->orderBy('id','desc')
                ->value('childId');

                $getPreviusIdForDeleteForNew = DB::table('nothi_details')->where('noteId',$data['noteId'])
                ->where('nothId',$data['nothiId'])->where('dakId',$data['dakId'])
                ->where('dakType',$data['status'])->whereNull('sent_status')->where('view_status',1)
                ->where('receiver',Auth::guard('admin')->user()->id)->orderBy('id','desc')
                ->value('childId');

            if(empty($getPreviusIdForDelete)){


                $getPreviusIdForDeleteUpdate = DB::table('nothi_details')->where('noteId',$data['noteId'])
                ->where('nothId',$data['nothiId'])->where('dakId',$data['dakId'])
                ->where('dakType',$data['status'])->whereNull('sent_status')
                ->where('view_status',1)->where('receiver',Auth::guard('admin')->user()->id)
                ->update(['list_status' =>1]);


                if($data['child_note_id'] == $getPreviusIdForDeleteForNew ){

                }else{

                $checkPreviousCodeDupdate = SealStatus::where('noteId',$data['noteId'])->where('nothiId',$data['nothiId'])
                ->where('receiver',Auth::guard('admin')->user()->id)->where('status',$data['status'])
                ->orderBy('id','desc')->where('seal_status',2) ->update(['delete_status' =>1]);

                }


            }else{

                $getPreviusIdForDeleteUpdate = DB::table('nothi_details')->where('childId',$getPreviusIdForDelete)
                ->where('noteId',$data['noteId'])->where('nothId',$data['nothiId'])
                ->where('dakId',$data['dakId'])->where('dakType',$data['status'])
                ->whereNull('sent_status')->where('view_status',1)
                ->where('sender',$data['nothiPermissionId'])->where('receiver',Auth::guard('admin')->user()->id)
                ->update([
                    'sent_status' =>1
                ]);
            }

                $checkPreviousCodeDupdate = SealStatus::where('noteId',$data['noteId'])
                ->where('nothiId',$data['nothiId'])->where('childId',$getPreviusIdForDelete)
                ->where('receiver',Auth::guard('admin')->user()->id)->where('status',$data['status'])
                ->orderBy('id','desc')->where('seal_status',2) ->update(['delete_status' =>1]);


                $senderIdNew = DB::table('nothi_details')->where('childId',$data['child_note_id'])
                ->where('noteId',$data['noteId'])->where('nothId',$data['nothiId'])
                ->where('dakId',$data['dakId'])->where('dakType',$data['status'])
                ->where('receiver',Auth::guard('admin')->user()->id)->value('sender');


                $senderIdNewPre = DB::table('nothi_details')->where('childId',$data['child_note_id'])
                ->where('noteId',$data['noteId'])->where('nothId',$data['nothiId'])
                ->where('dakId',$data['dakId'])->where('receiver',Auth::guard('admin')->user()->id )
                ->where('dakType',$data['status'])->orderBy('id','desc')->value('receiver');


            if(Auth::guard('admin')->user()->id == $senderIdNewPre){

                DB::table('nothi_details')->where('childId',$data['child_note_id'])->where('noteId',$data['noteId'])
                ->where('nothId',$data['nothiId'])->where('dakId',$data['dakId'])
                ->where('dakType',$data['status'])->where('receiver',Auth::guard('admin')->user()->id )
                ->update(['sent_status' =>1]);

            }else{

            }

                $checkPreviousCode = SealStatus::where('noteId',$data['noteId'])
                ->where('nothiId',$data['nothiId'])->where('childId',$data['child_note_id'])
                ->where('receiver',Auth::guard('admin')->user()->id)->where('status',$data['status'])
                ->orderBy('id','desc')
                ->value('seal_status');




            if(empty($checkPreviousCode)){

            $adminName = DB::table('admins')->where('id',$data['nothiPermissionId'])->value('admin_name_ban');

            $adminNameDesi = DB::table('admins')->where('id',$data['nothiPermissionId'])->value('designation_list_id');

            $adminNamebran = DB::table('admins')->where('id',$data['nothiPermissionId'])->value('branch_id');

            $adminNameSign = DB::table('admins')->where('id',$data['nothiPermissionId'])->value('admin_sign');

            $mainSaveData = new SealStatus();
            $mainSaveData ->noteId = $data['noteId'];
            $mainSaveData ->nothiId = $data['nothiId'];
            $mainSaveData ->childId = $data['child_note_id'];
            $mainSaveData ->status = $data['status'];
            $mainSaveData ->seal_status = 2;
            $mainSaveData ->created_at= $created_at;
            $mainSaveData ->receiver = $data['nothiPermissionId'];
            $mainSaveData ->amPmValue = $amPmValueFinal;
            $mainSaveData ->e_name= $adminName;
            $mainSaveData ->e_designation= $adminNameDesi;
            $mainSaveData ->e_branch= $adminNamebran;
            $mainSaveData ->e_sign= $adminNameSign;
            $mainSaveData->save();


            }else{

            if($checkPreviousCode == 2){

            $checkPreviousCode = SealStatus::where('noteId',$data['noteId'])
            ->where('nothiId',$data['nothiId'])->where('childId',$data['child_note_id'])
            ->where('receiver',Auth::guard('admin')->user()->id)->where('status',$data['status'])
            ->orderBy('id','desc')->update(array('seal_status' => 1,'updated_at'=>$created_at,'amPmValueUpdate' => $amPmValueFinal));


            $adminName = DB::table('admins')->where('id',$data['nothiPermissionId'])->value('admin_name_ban');

            $adminNameDesi = DB::table('admins')->where('id',$data['nothiPermissionId'])->value('designation_list_id');

            $adminNamebran = DB::table('admins')->where('id',$data['nothiPermissionId'])->value('branch_id');

            $adminNameSign = DB::table('admins')->where('id',$data['nothiPermissionId'])->value('admin_sign');

                $mainSaveData = new SealStatus();
                $mainSaveData ->noteId = $data['noteId'];
                $mainSaveData ->nothiId = $data['nothiId'];
                $mainSaveData ->childId = $data['child_note_id'];
                $mainSaveData ->status = $data['status'];
                $mainSaveData ->seal_status = 2;
                $mainSaveData ->created_at= $created_at;
                $mainSaveData ->receiver = $data['nothiPermissionId'];
                $mainSaveData ->amPmValue = $amPmValueFinal;
                $mainSaveData ->e_name= $adminName;
                $mainSaveData ->e_designation= $adminNameDesi;
                $mainSaveData ->e_branch= $adminNamebran;
                $mainSaveData ->e_sign= $adminNameSign;
                $mainSaveData->save();

            }else{

            }

            }


            if($data['status'] == 'renew'){

                DB::table('child_note_for_renews')->where('id',$data['child_note_id'])->update(['back_sign_status' => DB::raw('NULL')]);

            }elseif($data['status'] == 'registration'){

                DB::table('child_note_for_registrations')->where('id',$data['child_note_id'])->update(['back_sign_status' => DB::raw('NULL')]);

            }elseif($data['status'] == 'nameChange'){

                DB::table('child_note_for_name_changes')->where('id',$data['child_note_id'])->update(['back_sign_status' => DB::raw('NULL')]);

            }elseif($data['status'] == 'fdNine'){

                DB::table('child_note_for_fd_nines')->where('id',$data['child_note_id'])->update(['back_sign_status' => DB::raw('NULL')]);

            }elseif($data['status'] == 'fdNineOne'){

                DB::table('child_note_for_fd_nine_ones')->where('id',$data['child_note_id'])->update(['back_sign_status' => DB::raw('NULL')]);

            }elseif($data['status'] == 'fdSix'){

                DB::table('child_note_for_fd_sixes')->where('id',$data['child_note_id'])->update(['back_sign_status' => DB::raw('NULL')]);

            }elseif($data['status'] == 'fdSeven'){

                DB::table('child_note_for_fd_sevens')->where('id',$data['child_note_id'])->update(['back_sign_status' => DB::raw('NULL')]);

            }elseif($data['status'] == 'fcOne'){

                DB::table('child_note_for_fc_ones')->where('id',$data['child_note_id'])->update(['back_sign_status' => DB::raw('NULL')]);

            }elseif($data['status'] == 'fcTwo'){

                DB::table('child_note_for_fc_twos')->where('id',$data['child_note_id'])->update(['back_sign_status' => DB::raw('NULL')]);

            }elseif($data['status'] == 'fdThree'){

                DB::table('child_note_for_fd_threes')->where('id',$data['child_note_id'])->update(['back_sign_status' => DB::raw('NULL')]);

            }elseif($data['status'] == 'fdFive'){

                DB::table('child_note_for_fd_fives')->where('id',$data['child_note_id'])->update(['back_sign_status' => DB::raw('NULL')]);

            }elseif($data['status'] == 'formNoFive'){

                DB::table('child_note_for_form_no_fives')->where('id',$data['child_note_id'])->update(['back_sign_status' => DB::raw('NULL')]);

            }elseif($data['status'] == 'formNoSeven'){

                DB::table('child_note_for_form_no_sevens')->where('id',$data['child_note_id'])->update(['back_sign_status' => DB::raw('NULL')]);

            }elseif($data['status'] == 'formNoFour'){

                DB::table('child_note_for_form_no_fours')->where('id',$data['child_note_id'])->update(['back_sign_status' => DB::raw('NULL')]);

            }elseif($data['status'] == 'fdFourOneForm'){

                DB::table('child_note_for_fd_four_one_forms')->where('id',$data['child_note_id'])->update(['back_sign_status' => DB::raw('NULL')]);

            }elseif($data['status'] == 'duplicate'){

                DB::table('child_note_for_duplicate_certificates')->where('id',$data['child_note_id'])->update(['back_sign_status' => DB::raw('NULL')]);

            }elseif($data['status'] == 'constitution'){

                DB::table('child_note_for_constitutions')->where('id',$data['child_note_id'])->update(['back_sign_status' => DB::raw('NULL')]);

            }elseif($data['status'] == 'committee'){

                DB::table('child_note_for_executive_committees')->where('id',$data['child_note_id'])->update(['back_sign_status' => DB::raw('NULL')]);

            }


            $firstNothiSenderNew = NothiDetail::where('childId',$data['child_note_id'])
            ->where('noteId',$data['noteId'])->where('nothId',$data['nothiId'])
            ->where('dakId',$data['dakId'])->where('dakType',$data['status'])
            ->whereNull('back_nothi')->where('sender',$data['nothiPermissionId'])->value('id');

            $deleteData1 = NothiDetail::where('id',$firstNothiSenderNew)->update(['back_nothi'=> 1]);

            $mainSaveData = new NothiDetail();
            $mainSaveData ->noteId = $data['noteId'];
            $mainSaveData ->nothId = $data['nothiId'];
            $mainSaveData ->childId = $data['child_note_id'];
            $mainSaveData ->dakId = $data['dakId'];
            $mainSaveData ->dakType = $data['status'];
            $mainSaveData ->sent_status_other = 1;
            $mainSaveData ->created_at= $created_at;
            $mainSaveData ->sender = Auth::guard('admin')->user()->id;
            $mainSaveData ->receiver = $data['nothiPermissionId'];
            $mainSaveData ->amPmValue = $amPmValueFinal;
            $mainSaveData->save();

            $mainId = $mainSaveData ->id;

            $lastSarokValue = PotrangshoDraft::where('nothiId',$data['nothiId'])
            ->where('noteId',$data['noteId'])->where('status',$data['status'])
            ->where('adminId',Auth::guard('admin')->user()->id)->where('SentStatus',0)
            ->orderBy('id','desc')->first();

        if(!$lastSarokValue){

        }else{

            $newCode =PotrangshoDraft::find($lastSarokValue->id);
            $newCode->SentStatus = 1;
            $newCode->receiverId = $data['nothiPermissionId'];
            $newCode->save();

        if($data['status'] == 'registration'){

            $saveNewData = RegistrationOfficeSarok::find($lastSarokValue->sarokId);
            $saveNewData->office_subject = $lastSarokValue->office_subject;
            $saveNewData->office_sutro = $lastSarokValue->office_sutro;
            $saveNewData->description =$lastSarokValue->description;
            $saveNewData->save();

        }elseif($data['status'] == 'renew'){

            $saveNewData = RenewOfficeSarok::find($lastSarokValue->sarokId);
            $saveNewData->office_subject = $lastSarokValue->office_subject;
            $saveNewData->office_sutro = $lastSarokValue->office_sutro;
            $saveNewData->description =$lastSarokValue->description;
            $saveNewData->save();

        }elseif($data['status'] == 'nameChange'){

            $saveNewData = NameChangeOfficeSarok::find($lastSarokValue->sarokId);
            $saveNewData->office_subject = $lastSarokValue->office_subject;
            $saveNewData->office_sutro = $lastSarokValue->office_sutro;
            $saveNewData->description =$lastSarokValue->description;
            $saveNewData->save();

        }elseif($data['status'] == 'fdNine'){

            $saveNewData = FdNineOfficeSarok::find($lastSarokValue->sarokId);
            $saveNewData->office_subject = $lastSarokValue->office_subject;
            $saveNewData->office_sutro = $lastSarokValue->office_sutro;
            $saveNewData->description =$lastSarokValue->description;
            $saveNewData->save();


        }elseif($data['status'] == 'fdNineOne'){

            $saveNewData = FdNineOneOfficeSarok::find($lastSarokValue->sarokId);
            $saveNewData->office_subject = $lastSarokValue->office_subject;
            $saveNewData->office_sutro = $lastSarokValue->office_sutro;
            $saveNewData->description =$lastSarokValue->description;
            $saveNewData->save();

        }elseif($data['status'] == 'fdSix'){

            $saveNewData = FdSixOfficeSarok::find($lastSarokValue->sarokId);
            $saveNewData->office_subject = $lastSarokValue->office_subject;
            $saveNewData->office_sutro = $lastSarokValue->office_sutro;
            $saveNewData->description =$lastSarokValue->description;
            $saveNewData->save();

        }elseif($data['status'] == 'fdSeven'){

            $saveNewData = FdSevenOfficeSarok::find($lastSarokValue->sarokId);
            $saveNewData->office_subject = $lastSarokValue->office_subject;
            $saveNewData->office_sutro = $lastSarokValue->office_sutro;
            $saveNewData->description =$lastSarokValue->description;
            $saveNewData->save();

        }elseif($data['status'] == 'fcOne'){

            $saveNewData = FcOneOfficeSarok::find($lastSarokValue->sarokId);
            $saveNewData->office_subject = $lastSarokValue->office_subject;
            $saveNewData->office_sutro = $lastSarokValue->office_sutro;
            $saveNewData->description =$lastSarokValue->description;
            $saveNewData->save();

        }elseif($data['status'] == 'fcTwo'){


            $saveNewData = FcTwoOfficeSarok::find($lastSarokValue->sarokId);
            $saveNewData->office_subject = $lastSarokValue->office_subject;
            $saveNewData->office_sutro = $lastSarokValue->office_sutro;
            $saveNewData->description =$lastSarokValue->description;
            $saveNewData->save();

        }elseif($data['status'] == 'fdThree'){

            $saveNewData = FdThreeOfficeSarok::find($lastSarokValue->sarokId);
            $saveNewData->office_subject = $lastSarokValue->office_subject;
            $saveNewData->office_sutro = $lastSarokValue->office_sutro;
            $saveNewData->description =$lastSarokValue->description;
            $saveNewData->save();

        }elseif($data['status'] == 'fdFive'){

            $saveNewData = FdFiveOfficeSarok::find($lastSarokValue->sarokId);
            $saveNewData->office_subject = $lastSarokValue->office_subject;
            $saveNewData->office_sutro = $lastSarokValue->office_sutro;
            $saveNewData->description =$lastSarokValue->description;
            $saveNewData->save();

        }elseif($data['status'] == 'formNoFive'){

            $saveNewData = FormNoFiveOfficeSarok::find($lastSarokValue->sarokId);
            $saveNewData->office_subject = $lastSarokValue->office_subject;
            $saveNewData->office_sutro = $lastSarokValue->office_sutro;
            $saveNewData->description =$lastSarokValue->description;
            $saveNewData->save();

        }elseif($data['status'] == 'formNoSeven'){

            $saveNewData = FormNoSevenOfficeSarok::find($lastSarokValue->sarokId);
            $saveNewData->office_subject = $lastSarokValue->office_subject;
            $saveNewData->office_sutro = $lastSarokValue->office_sutro;
            $saveNewData->description =$lastSarokValue->description;
            $saveNewData->save();

        }elseif($data['status'] == 'formNoFour'){

            $saveNewData = FormNoFourOfficeSarok::find($lastSarokValue->sarokId);
            $saveNewData->office_subject = $lastSarokValue->office_subject;
            $saveNewData->office_sutro = $lastSarokValue->office_sutro;
            $saveNewData->description =$lastSarokValue->description;
            $saveNewData->save();

        }elseif($data['status'] == 'fdFourOneForm'){

            $saveNewData = FdFourOneFormOfficeSarok::find($lastSarokValue->sarokId);
            $saveNewData->office_subject = $lastSarokValue->office_subject;
            $saveNewData->office_sutro = $lastSarokValue->office_sutro;
            $saveNewData->description =$lastSarokValue->description;
            $saveNewData->save();

        }elseif($data['status'] == 'duplicate'){

            $saveNewData = DuplicateCertificateOfficeSarok::find($lastSarokValue->sarokId);
            $saveNewData->office_subject = $lastSarokValue->office_subject;
            $saveNewData->office_sutro = $lastSarokValue->office_sutro;
            $saveNewData->description =$lastSarokValue->description;
            $saveNewData->save();

        }elseif($data['status'] == 'constitution'){

            $saveNewData = ConstitutionOfficeSarok::find($lastSarokValue->sarokId);
            $saveNewData->office_subject = $lastSarokValue->office_subject;
            $saveNewData->office_sutro = $lastSarokValue->office_sutro;
            $saveNewData->description =$lastSarokValue->description;
            $saveNewData->save();

        }elseif($data['status'] == 'committee'){

            $saveNewData = ExecutiveCommitteeOfficeSarok::find($lastSarokValue->sarokId);
            $saveNewData->office_subject = $lastSarokValue->office_subject;
            $saveNewData->office_sutro = $lastSarokValue->office_sutro;
            $saveNewData->description =$lastSarokValue->description;
            $saveNewData->save();

        }

    }



        if($data['status'] == 'registration'){

            $saveNewData = ChildNoteForRegistration::find($data['child_note_id']);
            $saveNewData->sent_status = 1;
            $saveNewData ->updated_at= $created_at;
            $saveNewData ->amPmValueUpdate=$amPmValueFinal;
            $saveNewData->sender_id = Auth::guard('admin')->user()->id;
            $saveNewData->receiver_id = $data['nothiPermissionId'];
            $saveNewData->save();

        }elseif($data['status'] == 'renew'){

            $saveNewData = ChildNoteForRenew::find($data['child_note_id']);

            $saveNewData->sent_status = 1;
            $saveNewData ->updated_at= $created_at;
            $saveNewData ->amPmValueUpdate=$amPmValueFinal;
            $saveNewData->sender_id = Auth::guard('admin')->user()->id;
         $saveNewData->receiver_id = $data['nothiPermissionId'];
            $saveNewData->save();

        }elseif($data['status'] == 'nameChange'){

            $saveNewData = ChildNoteForNameChange::find($data['child_note_id']);
            $saveNewData->sent_status = 1;
            $saveNewData ->updated_at= $created_at;
            $saveNewData->sender_id = Auth::guard('admin')->user()->id;
            $saveNewData->receiver_id = $data['nothiPermissionId'];;
            $saveNewData->save();

        }elseif($data['status'] == 'fdNine'){

            $saveNewData = ChildNoteForFdNine::find($data['child_note_id']);
            $saveNewData->sent_status = 1;
            $saveNewData ->updated_at= $created_at;
            $saveNewData ->amPmValueUpdate=$amPmValueFinal;
            $saveNewData->sender_id = Auth::guard('admin')->user()->id;
            $saveNewData->receiver_id = $data['nothiPermissionId'];;
            $saveNewData->save();

        }elseif($data['status'] == 'fdNineOne'){

            $saveNewData = ChildNoteForFdNineOne::find($data['child_note_id']);
            $saveNewData->sent_status = 1;
            $saveNewData ->updated_at= $created_at;
            $saveNewData ->amPmValueUpdate=$amPmValueFinal;
            $saveNewData->sender_id = Auth::guard('admin')->user()->id;
            $saveNewData->receiver_id = $data['nothiPermissionId'];;
            $saveNewData->save();

        }elseif($data['status'] == 'fdSix'){

            $saveNewData = ChildNoteForFdSix::find($data['child_note_id']);
            $saveNewData->sent_status = 1;
            $saveNewData ->updated_at= $created_at;
            $saveNewData ->amPmValueUpdate=$amPmValueFinal;
            $saveNewData->sender_id = Auth::guard('admin')->user()->id;
            $saveNewData->receiver_id = $data['nothiPermissionId'];;
            $saveNewData->save();

        }elseif($data['status'] == 'fdSeven'){

            $saveNewData = ChildNoteForFdSeven::find($data['child_note_id']);
            $saveNewData->sent_status = 1;
            $saveNewData ->updated_at= $created_at;
            $saveNewData ->amPmValueUpdate=$amPmValueFinal;
            $saveNewData->sender_id = Auth::guard('admin')->user()->id;
            $saveNewData->receiver_id = $data['nothiPermissionId'];;
            $saveNewData->save();

        }elseif($data['status'] == 'fcOne'){

            $saveNewData = ChildNoteForFcOne::find($data['child_note_id']);
            $saveNewData->sent_status = 1;
            $saveNewData ->updated_at= $created_at;
            $saveNewData ->amPmValueUpdate=$amPmValueFinal;
            $saveNewData->sender_id = Auth::guard('admin')->user()->id;
            $saveNewData->receiver_id = $data['nothiPermissionId'];;
            $saveNewData->save();

        }elseif($data['status'] == 'fcTwo'){

            $saveNewData = ChildNoteForFcTwo::find($data['child_note_id']);
            $saveNewData->sent_status = 1;
            $saveNewData ->updated_at= $created_at;
            $saveNewData ->amPmValueUpdate=$amPmValueFinal;
            $saveNewData->sender_id = Auth::guard('admin')->user()->id;
            $saveNewData->receiver_id = $data['nothiPermissionId'];
            $saveNewData->save();

        }elseif($data['status'] == 'fdThree'){

         $saveNewData = ChildNoteForFdThree::find($data['child_note_id']);
         $saveNewData->sent_status = 1;
         $saveNewData ->updated_at= $created_at;
         $saveNewData ->amPmValueUpdate=$amPmValueFinal;
         $saveNewData->sender_id = Auth::guard('admin')->user()->id;
         $saveNewData->receiver_id = $data['nothiPermissionId'];
         $saveNewData->save();

        }elseif($data['status'] == 'fdFive'){

            $saveNewData = ChildNoteForFdFive::find($data['child_note_id']);
            $saveNewData->sent_status = 1;
            $saveNewData ->updated_at= $created_at;
            $saveNewData ->amPmValueUpdate=$amPmValueFinal;
            $saveNewData->sender_id = Auth::guard('admin')->user()->id;
            $saveNewData->receiver_id = $data['nothiPermissionId'];
            $saveNewData->save();

           }elseif($data['status'] == 'formNoFive'){

            $saveNewData = ChildNoteForFormNoFive::find($data['child_note_id']);
            $saveNewData->sent_status = 1;
            $saveNewData ->updated_at= $created_at;
            $saveNewData ->amPmValueUpdate=$amPmValueFinal;
            $saveNewData->sender_id = Auth::guard('admin')->user()->id;
            $saveNewData->receiver_id = $data['nothiPermissionId'];
            $saveNewData->save();

           }elseif($data['status'] == 'formNoSeven'){

            $saveNewData = ChildNoteForFormNoSeven::find($data['child_note_id']);
            $saveNewData->sent_status = 1;
            $saveNewData ->updated_at= $created_at;
            $saveNewData ->amPmValueUpdate=$amPmValueFinal;
            $saveNewData->sender_id = Auth::guard('admin')->user()->id;
            $saveNewData->receiver_id = $data['nothiPermissionId'];
            $saveNewData->save();

           }elseif($data['status'] == 'formNoFour'){

            $saveNewData = ChildNoteForFormNoFour::find($data['child_note_id']);
            $saveNewData->sent_status = 1;
            $saveNewData ->updated_at= $created_at;
            $saveNewData ->amPmValueUpdate=$amPmValueFinal;
            $saveNewData->sender_id = Auth::guard('admin')->user()->id;
            $saveNewData->receiver_id = $data['nothiPermissionId'];
            $saveNewData->save();

           }elseif($data['status'] == 'fdFourOneForm'){

            $saveNewData = ChildNoteForFdFourOneForm::find($data['child_note_id']);
            $saveNewData->sent_status = 1;
            $saveNewData ->updated_at= $created_at;
            $saveNewData ->amPmValueUpdate=$amPmValueFinal;
            $saveNewData->sender_id = Auth::guard('admin')->user()->id;
            $saveNewData->receiver_id = $data['nothiPermissionId'];
            $saveNewData->save();

           }elseif($data['status'] == 'duplicate'){

            $saveNewData = ChildNoteForDuplicateCertificate::find($data['child_note_id']);
            $saveNewData->sent_status = 1;
            $saveNewData ->updated_at= $created_at;
            $saveNewData ->amPmValueUpdate=$amPmValueFinal;
            $saveNewData->sender_id = Auth::guard('admin')->user()->id;
            $saveNewData->receiver_id = $data['nothiPermissionId'];

            $saveNewData->save();


        }elseif($data['status'] == 'constitution'){

            $saveNewData = ChildNoteForConstitution::find($data['child_note_id']);
            $saveNewData->sent_status = 1;
         $saveNewData ->updated_at= $created_at;
         $saveNewData ->amPmValueUpdate=$amPmValueFinal;
         $saveNewData->sender_id = Auth::guard('admin')->user()->id;
         $saveNewData->receiver_id = $data['nothiPermissionId'];

            $saveNewData->save();


        }elseif($data['status'] == 'committee'){

            $saveNewData = ChildNoteForExecutiveCommittee::find($data['child_note_id']);
            $saveNewData->sent_status = 1;
            $saveNewData ->updated_at= $created_at;
            $saveNewData ->amPmValueUpdate=$amPmValueFinal;
            $saveNewData->sender_id = Auth::guard('admin')->user()->id;
            $saveNewData->receiver_id = $data['nothiPermissionId'];


            $saveNewData->save();


        }


    return redirect()->route('sendNothi.index')->with('success','সফলভাে পাানো হয়ছে');
} catch (\Exception $e) {

     return redirect()->route('error_404')->with('error','some thing went wrong ');
}
    }




    public function store(Request $request){

        //dd($request->all());
        try{

        $dt = new DateTime();
        $dt->setTimezone(new DateTimezone('Asia/Dhaka'));
        $created_at = $dt->format('Y-m-d h:i:s');

        //$amPmValueFinal = 0;
        $amPmValue = $dt->format('a');

        if($amPmValue == 'pm'){

            $amPmValueFinal = 'অপরহ্ন';
        }else{
            $amPmValueFinal = 'পর্বাহ্ন';

        }
//dd($amPmValueFinal);

        if($request->status == 'registration'){


            $saveNewData = new ChildNoteForRegistration();
            $saveNewData->parent_note_regid = $request->parentNoteId;
            $saveNewData->serial_number = 0;
            $saveNewData->description = $request->mainPartNote;
            $saveNewData->created_at = $created_at;
            $saveNewData->amPmValue = $amPmValueFinal;
            $saveNewData->admin_id =Auth::guard('admin')->user()->id;
            $saveNewData->save();


     }elseif($request->status == 'renew'){


         $saveNewData = new ChildNoteForRenew();
         $saveNewData->parent_note_for_renew_id = $request->parentNoteId;
         $saveNewData->serial_number = 0;
         $saveNewData->description = $request->mainPartNote;
         $saveNewData->created_at =$created_at;
         $saveNewData->amPmValue = $amPmValueFinal;
         $saveNewData->admin_id =Auth::guard('admin')->user()->id;
         $saveNewData->save();



     }elseif($request->status == 'nameChange'){

         $saveNewData = new ChildNoteForNameChange();
         $saveNewData->parentnote_name_change_id = $request->parentNoteId;
         $saveNewData->serial_number = 0;
         $saveNewData->description = $request->mainPartNote;
         $saveNewData->created_at =$created_at;
         $saveNewData->amPmValue = $amPmValueFinal;
         $saveNewData->admin_id =Auth::guard('admin')->user()->id;
         $saveNewData->save();



     }elseif($request->status == 'fdNine'){

         $saveNewData = new ChildNoteForFdNine();
         $saveNewData->p_note_for_fd_nine_id = $request->parentNoteId;
         $saveNewData->serial_number = 0;
         $saveNewData->description = $request->mainPartNote;
         $saveNewData->created_at =$created_at;
         $saveNewData->amPmValue = $amPmValueFinal;
         $saveNewData->admin_id =Auth::guard('admin')->user()->id;
         $saveNewData->save();


     }elseif($request->status == 'fdNineOne'){

         $saveNewData = new ChildNoteForFdNineOne();
         $saveNewData->p_note_for_fd_nine_one_id = $request->parentNoteId;
         $saveNewData->serial_number = 0;
         $saveNewData->description = $request->mainPartNote;
         $saveNewData->created_at =$created_at;
         $saveNewData->amPmValue = $amPmValueFinal;
         $saveNewData->admin_id =Auth::guard('admin')->user()->id;
         $saveNewData->save();

     }elseif($request->status == 'fdSix'){

         $saveNewData = new ChildNoteForFdSix();
         $saveNewData->parent_note_for_fdsix_id = $request->parentNoteId;
         $saveNewData->serial_number = 0;
         $saveNewData->description = $request->mainPartNote;
         $saveNewData->created_at =$created_at;
         $saveNewData->amPmValue = $amPmValueFinal;
         $saveNewData->admin_id =Auth::guard('admin')->user()->id;
         $saveNewData->save();

     }elseif($request->status == 'fdSeven'){

  $saveNewData = new ChildNoteForFdSeven();
  $saveNewData->parent_note_for_fd_seven_id = $request->parentNoteId;
  $saveNewData->serial_number = 0;
  $saveNewData->description = $request->mainPartNote;
  $saveNewData->created_at =$created_at;
  $saveNewData->amPmValue = $amPmValueFinal;
  $saveNewData->admin_id =Auth::guard('admin')->user()->id;
  $saveNewData->save();


     }elseif($request->status == 'fcOne'){

         $saveNewData = new ChildNoteForFcOne();
         $saveNewData->parent_note_for_fc_one_id = $request->parentNoteId;
         $saveNewData->serial_number = 0;
         $saveNewData->description = $request->mainPartNote;
         $saveNewData->created_at =$created_at;
         $saveNewData->amPmValue = $amPmValueFinal;
         $saveNewData->admin_id =Auth::guard('admin')->user()->id;
         $saveNewData->save();

     }elseif($request->status == 'fcTwo'){


         $saveNewData = new ChildNoteForFcTwo();
         $saveNewData->parent_note_for_fc_two_id = $request->parentNoteId;
         $saveNewData->serial_number = 0;
         $saveNewData->description = $request->mainPartNote;
         $saveNewData->created_at =$created_at;
         $saveNewData->amPmValue = $amPmValueFinal;
         $saveNewData->admin_id =Auth::guard('admin')->user()->id;
         $saveNewData->save();


     }elseif($request->status == 'fdThree'){

         $saveNewData = new ChildNoteForFdThree();
         $saveNewData->parent_note_for_fd_three_id = $request->parentNoteId;
         $saveNewData->serial_number = 0;
         $saveNewData->description = $request->mainPartNote;
         $saveNewData->created_at =$created_at;
         $saveNewData->amPmValue = $amPmValueFinal;
         $saveNewData->admin_id =Auth::guard('admin')->user()->id;

         $saveNewData->save();





     }elseif($request->status == 'fdFive'){

        $saveNewData = new ChildNoteForFdFive();
        $saveNewData->pnote_fd_five = $request->parentNoteId;
        $saveNewData->serial_number = 0;
        $saveNewData->description = $request->mainPartNote;
        $saveNewData->created_at =$created_at;
        $saveNewData->amPmValue = $amPmValueFinal;
        $saveNewData->admin_id =Auth::guard('admin')->user()->id;

        $saveNewData->save();





    }elseif($request->status == 'formNoFive'){

        $saveNewData = new ChildNoteForFormNoFive();
        $saveNewData->pnote_form_no_five = $request->parentNoteId;
        $saveNewData->serial_number = 0;
        $saveNewData->description = $request->mainPartNote;
        $saveNewData->created_at =$created_at;
        $saveNewData->amPmValue = $amPmValueFinal;
        $saveNewData->admin_id =Auth::guard('admin')->user()->id;

        $saveNewData->save();


    }elseif($request->status == 'formNoSeven'){

        $saveNewData = new ChildNoteForFormNoSeven();
        $saveNewData->pnote_form_no_seven = $request->parentNoteId;
        $saveNewData->serial_number = 0;
        $saveNewData->description = $request->mainPartNote;
        $saveNewData->created_at =$created_at;
        $saveNewData->amPmValue = $amPmValueFinal;
        $saveNewData->admin_id =Auth::guard('admin')->user()->id;

        $saveNewData->save();


    }elseif($request->status == 'formNoFour'){

        $saveNewData = new ChildNoteForFormNoFour();
        $saveNewData->pnote_form_no_four = $request->parentNoteId;
        $saveNewData->serial_number = 0;
        $saveNewData->description = $request->mainPartNote;
        $saveNewData->created_at =$created_at;
        $saveNewData->amPmValue = $amPmValueFinal;
        $saveNewData->admin_id =Auth::guard('admin')->user()->id;

        $saveNewData->save();


    }elseif($request->status == 'fdFourOneForm'){

        $saveNewData = new ChildNoteForFdFourOneForm();
        $saveNewData->pnote_fd_four_one_form = $request->parentNoteId;
        $saveNewData->serial_number = 0;
        $saveNewData->description = $request->mainPartNote;
        $saveNewData->created_at =$created_at;
        $saveNewData->amPmValue = $amPmValueFinal;
        $saveNewData->admin_id =Auth::guard('admin')->user()->id;

        $saveNewData->save();


    }elseif($request->status == 'duplicate'){

        $saveNewData = new ChildNoteForDuplicateCertificate();
        $saveNewData->pnote_dupid = $request->parentNoteId;
        $saveNewData->serial_number = 0;
        $saveNewData->description = $request->mainPartNote;
        $saveNewData->created_at =$created_at;
        $saveNewData->amPmValue = $amPmValueFinal;
        $saveNewData->admin_id =Auth::guard('admin')->user()->id;

        $saveNewData->save();


    }elseif($request->status == 'constitution'){

        $saveNewData = new ChildNoteForConstitution();
        $saveNewData->pnote_conid  = $request->parentNoteId;
        $saveNewData->serial_number = 0;
        $saveNewData->description = $request->mainPartNote;
        $saveNewData->created_at =$created_at;
        $saveNewData->amPmValue = $amPmValueFinal;
        $saveNewData->admin_id =Auth::guard('admin')->user()->id;

        $saveNewData->save();


    }elseif($request->status == 'committee'){

        $saveNewData = new ChildNoteForExecutiveCommittee();
        $saveNewData->pnote_exeid = $request->parentNoteId;
        $saveNewData->serial_number = 0;
        $saveNewData->description = $request->mainPartNote;
        $saveNewData->created_at =$created_at;
        $saveNewData->amPmValue = $amPmValueFinal;
        $saveNewData->admin_id =Auth::guard('admin')->user()->id;

        $saveNewData->save();


    }

$childDataId = $saveNewData->id;

 $unsentAtt = DB::table('note_attachments')
->where('noteId',$request->noteId)
->where('nothiId',$request->nothiId)
->where('status',$request->status)
->where('admin_id',Auth::guard('admin')->user()->id)
->whereNull('child_id')
->update(array('child_id' => $childDataId));



     if($request->final_button == 'সংশোধন ও খসড়া'){

        return redirect('admin/createPotro/'.$request->status.'/'.$request->dakId.'/'.$request->nothiId.'/'.$request->noteId.'/'.$request->activeCode)->with('success','সফলভাবে রক্ষণ করা হছে');

     }else{
        return redirect()->back()->with('success','সফলভাে ংরক্ষণ কা হেছে');
     }

    } catch (\Exception $e) {

         return redirect()->route('error_404')->with('error','some thing went wrong ');
    }

    }


    public function update(Request $request,$id){
//dd(34);
try{

        $data = $request->all();

    //dd($data);

        if($request->final_button == 'সংশোধন'  ||$request->final_button == 'সংশোধন ও খসড়া' ){


        if($request->status == 'registration'){


            $saveNewData = ChildNoteForRegistration::find($id);

            $saveNewData->description = $request->mainPartNote;
            $saveNewData->save();


     }elseif($request->status == 'renew'){


         $saveNewData = ChildNoteForRenew::find($id);

         $saveNewData->description = $request->mainPartNote;
         $saveNewData->save();



     }elseif($request->status == 'nameChange'){

         $saveNewData = ChildNoteForNameChange::find($id);

         $saveNewData->description = $request->mainPartNote;
         $saveNewData->save();



     }elseif($request->status == 'fdNine'){

         $saveNewData = ChildNoteForFdNine::find($id);

         $saveNewData->description = $request->mainPartNote;
         $saveNewData->save();
     }elseif($request->status == 'fdNineOne'){

         $saveNewData = ChildNoteForFdNineOne::find($id);

         $saveNewData->description = $request->mainPartNote;
         $saveNewData->save();

     }elseif($request->status == 'fdSix'){

         $saveNewData = ChildNoteForFdSix::find($id);

         $saveNewData->description = $request->mainPartNote;
         $saveNewData->save();

     }elseif($request->status == 'fdSeven'){

  $saveNewData = ChildNoteForFdSeven::find($id);

  $saveNewData->description = $request->mainPartNote;
            $saveNewData->save();
     }elseif($request->status == 'fcOne'){

         $saveNewData = ChildNoteForFcOne::find($id);

         $saveNewData->description = $request->mainPartNote;
         $saveNewData->save();

     }elseif($request->status == 'fcTwo'){


         $saveNewData = ChildNoteForFcTwo::find($id);

         $saveNewData->description = $request->mainPartNote;
         $saveNewData->save();


     }elseif($request->status == 'fdThree'){

         $saveNewData = ChildNoteForFdThree::find($id);

         $saveNewData->description = $request->mainPartNote;
         $saveNewData->save();


     }elseif($request->status == 'fdFive'){

        $saveNewData = ChildNoteForFdFive::find($id);

        $saveNewData->description = $request->mainPartNote;
        $saveNewData->save();


    }elseif($request->status == 'formNoFive'){

        $saveNewData = ChildNoteForFormNoFive::find($id);

        $saveNewData->description = $request->mainPartNote;
        $saveNewData->save();


    }elseif($request->status == 'formNoSeven'){

        $saveNewData = ChildNoteForFormNoSeven::find($id);

        $saveNewData->description = $request->mainPartNote;
        $saveNewData->save();


    }elseif($request->status == 'formNoFour'){

        $saveNewData = ChildNoteForFormNoFour::find($id);

        $saveNewData->description = $request->mainPartNote;
        $saveNewData->save();


    }elseif($request->status == 'fdFourOneForm'){

        $saveNewData = ChildNoteForFdFourOneForm::find($id);

        $saveNewData->description = $request->mainPartNote;
        $saveNewData->save();


    }elseif($request->status == 'duplicate'){

        $saveNewData = ChildNoteForDuplicateCertificate::find($id);

        $saveNewData->description = $request->mainPartNote;
        $saveNewData->save();


    }elseif($request->status == 'constitution'){

        $saveNewData = ChildNoteForConstitution::find($id);

        $saveNewData->description = $request->mainPartNote;
        $saveNewData->save();


    }elseif($request->status == 'committee'){

        $saveNewData = ChildNoteForExecutiveCommittee::find($id);

        $saveNewData->description = $request->mainPartNote;
        $saveNewData->save();


    }

     $childDataId = $saveNewData->id;

     $unsentAtt = DB::table('note_attachments')
    ->where('noteId',$request->noteId)
    ->where('nothiId',$request->nothiId)
    ->where('status',$request->status)
    ->where('admin_id',Auth::guard('admin')->user()->id)
    ->whereNull('child_id')
    ->update(array('child_id' => $childDataId));

     if($request->final_button == 'সংশোধন ও খসড়া'){

        return redirect('admin/createPotro/'.$request->status.'/'.$request->dakId.'/'.$request->nothiId.'/'.$request->noteId.'/'.$request->activeCode)->with('success','ফলভাবে সংশোধ করা হয়েছে');

     }else{
        return redirect()->back()->with('success','সফলভাবে সংশধন করা হয়েছ');
     }



        }else{

//dd($request->button_value);
            if($request->button_value  == 'send' || $request->button_value  == 'return' || $request->button_value  == 'returnOther'){

                return $this->saveNothiPermission($data);

            }else{









        if( $data['nothiSend']== 1){

            return $this->saveNothiPermissionReturn($data);
        }else{




        if($request->status == 'registration'){


            $saveNewData = ChildNoteForRegistration::find($id);

            $saveNewData->description = $request->mainPartNote;
            $saveNewData->save();


     }elseif($request->status == 'renew'){


         $saveNewData = ChildNoteForRenew::find($id);

         $saveNewData->description = $request->mainPartNote;
         $saveNewData->save();



     }elseif($request->status == 'nameChange'){

         $saveNewData = ChildNoteForNameChange::find($id);

         $saveNewData->description = $request->mainPartNote;
         $saveNewData->save();



     }elseif($request->status == 'fdNine'){

         $saveNewData = ChildNoteForFdNine::find($id);

         $saveNewData->description = $request->mainPartNote;
         $saveNewData->save();
     }elseif($request->status == 'fdNineOne'){

         $saveNewData = ChildNoteForFdNineOne::find($id);

         $saveNewData->description = $request->mainPartNote;
         $saveNewData->save();

     }elseif($request->status == 'fdSix'){

         $saveNewData = ChildNoteForFdSix::find($id);

         $saveNewData->description = $request->mainPartNote;
         $saveNewData->save();

     }elseif($request->status == 'fdSeven'){

  $saveNewData = ChildNoteForFdSeven::find($id);

  $saveNewData->description = $request->mainPartNote;
            $saveNewData->save();
     }elseif($request->status == 'fcOne'){

         $saveNewData = ChildNoteForFcOne::find($id);

         $saveNewData->description = $request->mainPartNote;
         $saveNewData->save();

     }elseif($request->status == 'fcTwo'){


         $saveNewData = ChildNoteForFcTwo::find($id);

         $saveNewData->description = $request->mainPartNote;
         $saveNewData->save();


     }elseif($request->status == 'fdThree'){

         $saveNewData = ChildNoteForFdThree::find($id);

         $saveNewData->description = $request->mainPartNote;
         $saveNewData->save();


     }elseif($request->status == 'fdFive'){

        $saveNewData = ChildNoteForFdFive::find($id);

        $saveNewData->description = $request->mainPartNote;
        $saveNewData->save();


    }elseif($request->status == 'formNoFive'){

        $saveNewData = ChildNoteForFormNoFive::find($id);

        $saveNewData->description = $request->mainPartNote;
        $saveNewData->save();


    }elseif($request->status == 'formNoSeven'){

            $saveNewData = ChildNoteForFormNoSeven::find($id);

            $saveNewData->description = $request->mainPartNote;
            $saveNewData->save();


        }elseif($request->status == 'formNoFour'){

            $saveNewData = ChildNoteForFormNoFour::find($id);

            $saveNewData->description = $request->mainPartNote;
            $saveNewData->save();


        }elseif($request->status == 'fdFourOneForm'){

            $saveNewData = ChildNoteForFdFourOneForm::find($id);

            $saveNewData->description = $request->mainPartNote;
            $saveNewData->save();


        }elseif($request->status == 'duplicate'){

        $saveNewData = ChildNoteForDuplicateCertificate::find($id);

        $saveNewData->description = $request->mainPartNote;
        $saveNewData->save();


    }elseif($request->status == 'constitution'){

        $saveNewData = ChildNoteForConstitution::find($id);

        $saveNewData->description = $request->mainPartNote;
        $saveNewData->save();


    }elseif($request->status == 'committee'){

        $saveNewData = ChildNoteForExecutiveCommittee::find($id);

        $saveNewData->description = $request->mainPartNote;
        $saveNewData->save();


    }

     $childDataId = $saveNewData->id;

     $unsentAtt = DB::table('note_attachments')
    ->where('noteId',$request->noteId)
    ->where('nothiId',$request->nothiId)
    ->where('status',$request->status)
    ->where('admin_id',Auth::guard('admin')->user()->id)
    ->whereNull('child_id')
    ->update(array('child_id' => $childDataId));

     if($request->final_button == 'সংশোধন ও খসড়া'){

        return redirect('admin/createPotro/'.$request->status.'/'.$request->dakId.'/'.$request->nothiId.'/'.$request->noteId.'/'.$request->activeCode)->with('success','সফলভাে সংশোধন কর হয়েছে');

     }else{
        return redirect()->back()->with('success','সফলাবে সংশোন কা হয়েছে');
     }
    }
    }
    }

} catch (\Exception $e) {

     return redirect()->route('error_404')->with('error','some thing went wrong ');
}


}
}
