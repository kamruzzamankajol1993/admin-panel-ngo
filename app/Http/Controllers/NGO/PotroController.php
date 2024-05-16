<?php

namespace App\Http\Controllers\NGO;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Image;
use Auth;
use Hash;
use PDF;
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
use DB;
use DateTime;
use DateTimezone;
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
class PotroController extends Controller
{
    public function createPotro($status,$parentId,$nothiId,$id,$activeCode){

        if($status == 'registration'){

            $getIdSarok = RegistrationOfficeSarok::where('parent_note_regid',$id)->value('id');

            $potrangshoDraftNew =  DB::table('potrangsho_drafts')->where('sarokId',$getIdSarok)
                                   ->where('status',$status)->orderBy('id','desc')
                                   ->first();

            $officeDetail = RegistrationOfficeSarok::where('parent_note_regid',$id)->get();
            $checkParent = ParentNoteForRegistration::where('nothi_detail_id',$parentId)
                           ->where('serial_number',$nothiId)->get();

        }elseif($status == 'renew'){

            $getIdSarok = RenewOfficeSarok::where('parent_note_for_renew_id',$id)->value('id');

            $potrangshoDraftNew =  DB::table('potrangsho_drafts')->where('sarokId',$getIdSarok)
                                   ->where('status',$status)->orderBy('id','desc')
                                   ->first();

            $officeDetail = RenewOfficeSarok::where('parent_note_for_renew_id',$id)->get();
            $checkParent = ParentNoteForRenew::where('nothi_detail_id',$parentId)
                           ->where('serial_number',$nothiId)->get();

        }elseif($status == 'nameChange'){

            $getIdSarok = NameChangeOfficeSarok::where('parentnote_name_change_id',$id)->value('id');

            $potrangshoDraftNew =  DB::table('potrangsho_drafts')->where('sarokId',$getIdSarok)
                                   ->where('status',$status)->orderBy('id','desc')
                                   ->first();

            $officeDetail = NameChangeOfficeSarok::where('parentnote_name_change_id',$id)->get();
            $checkParent = ParentNoteForNameChange::where('nothi_detail_id',$parentId)
                           ->where('serial_number',$nothiId)->get();

        }elseif($status == 'fdNine'){

            $getIdSarok = FdNineOfficeSarok::where('p_note_for_fd_nine_id',$id)->value('id');

            $potrangshoDraftNew =  DB::table('potrangsho_drafts')->where('sarokId',$getIdSarok)
                                  ->where('status',$status)->orderBy('id','desc')
                                  ->first();

            $officeDetail = FdNineOfficeSarok::where('p_note_for_fd_nine_id',$id)->get();
            $checkParent = ParentNoteForFdNine::where('nothi_detail_id',$parentId)
                           ->where('serial_number',$nothiId)->get();

        }elseif($status == 'fdNineOne'){

            $getIdSarok = FdNineOneOfficeSarok::where('p_note_for_fd_nine_one_id',$id)->value('id');

            $potrangshoDraftNew =  DB::table('potrangsho_drafts')->where('sarokId',$getIdSarok)
                                   ->where('status',$status)->orderBy('id','desc')
                                   ->first();

            $officeDetail = FdNineOneOfficeSarok::where('p_note_for_fd_nine_one_id',$id)->get();
            $checkParent = ParentNoteForFdNineOne::where('nothi_detail_id',$parentId)
                           ->where('serial_number',$nothiId)->get();

        }elseif($status == 'fdSix'){

            $getIdSarok = FdSixOfficeSarok::where('parent_note_for_fdsix_id',$id)->value('id');

            $potrangshoDraftNew =  DB::table('potrangsho_drafts')->where('sarokId',$getIdSarok)
                                   ->where('status',$status)->orderBy('id','desc')
                                   ->first();

            $officeDetail = FdSixOfficeSarok::where('parent_note_for_fdsix_id',$id)->get();
            $checkParent = ParentNoteForFdsix::where('nothi_detail_id',$parentId)
                           ->where('serial_number',$nothiId)->get();

        }elseif($status == 'fdSeven'){

            $getIdSarok = FdSevenOfficeSarok::where('parent_note_for_fd_seven_id',$id)->value('id');

            $potrangshoDraftNew =  DB::table('potrangsho_drafts')->where('sarokId',$getIdSarok)
                                   ->where('status',$status)->orderBy('id','desc')
                                   ->first();

            $officeDetail = FdSevenOfficeSarok::where('parent_note_for_fd_seven_id',$id)->get();
            $checkParent = ParentNoteForFdSeven::where('nothi_detail_id',$parentId)
                           ->where('serial_number',$nothiId)->get();

        }elseif($status == 'fcOne'){

            $getIdSarok = FcOneOfficeSarok::where('parent_note_for_fc_one_id',$id)->value('id');

            $potrangshoDraftNew =  DB::table('potrangsho_drafts')->where('sarokId',$getIdSarok)
                                   ->where('status',$status)->orderBy('id','desc')
                                   ->first();

            $officeDetail = FcOneOfficeSarok::where('parent_note_for_fc_one_id',$id)->get();
            $checkParent = ParentNoteForFcOne::where('nothi_detail_id',$parentId)->get();

        }elseif($status == 'fcTwo'){

            $getIdSarok = FcTwoOfficeSarok::where('parent_note_for_fc_two_id',$id)->value('id');

            $potrangshoDraftNew =  DB::table('potrangsho_drafts')->where('sarokId',$getIdSarok)
                                   ->where('status',$status)->orderBy('id','desc')
                                   ->first();

            $officeDetail = FcTwoOfficeSarok::where('parent_note_for_fc_two_id',$id)->get();
            $checkParent = ParentNoteForFcTwo::where('nothi_detail_id',$parentId)
                           ->where('serial_number',$nothiId)->get();

        }elseif($status == 'fdThree'){

            $getIdSarok = FdThreeOfficeSarok::where('parent_note_for_fd_three_id',$id)->value('id');

            $potrangshoDraftNew =  DB::table('potrangsho_drafts')->where('sarokId',$getIdSarok)
                                   ->where('status',$status)->orderBy('id','desc')
                                   ->first();

            $officeDetail = FdThreeOfficeSarok::where('parent_note_for_fd_three_id',$id)->get();
            $checkParent = ParentNoteForFdThree::where('nothi_detail_id',$parentId)
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

        $convert_name_title = $permissionNothiList->implode("branchId", " ");
        $separated_data_title = explode(" ", $convert_name_title);

        $branchListForSerial = Branch::whereIn('id',$separated_data_title)
        ->orderBy('branch_step','asc')->get();

        return view('admin.potro.createPotro',compact('potrangshoDraftNew','nothiYear','branchListForSerial','permissionNothiList','nothiCopyListUpdate','nothiAttractListUpdate','nothiPropokListUpdate','user','nothiId','nothiNumber','officeDetail','checkParent','status','id','parentId','activeCode'));

    }



    public function createPotroForReceiver($status,$parentId,$nothiId,$id,$activeCode){


        if($status == 'registration'){

            $getIdSarok = RegistrationOfficeSarok::where('parent_note_regid',$id)->value('id');

            $potrangshoDraftNew =  DB::table('potrangsho_drafts')->where('sarokId',$getIdSarok)
                                   ->where('status',$status)->orderBy('id','desc')
                                   ->first();

            $officeDetail = RegistrationOfficeSarok::where('parent_note_regid',$id)->get();
            $checkParent = ParentNoteForRegistration::where('nothi_detail_id',$parentId)
                           ->where('serial_number',$nothiId)->get();

          }elseif($status == 'renew'){

            $getIdSarok = RenewOfficeSarok::where('parent_note_for_renew_id',$id)->value('id');

            $potrangshoDraftNew =  DB::table('potrangsho_drafts')->where('sarokId',$getIdSarok)
                                   ->where('status',$status)->orderBy('id','desc')
                                   ->first();

            $officeDetail = RenewOfficeSarok::where('parent_note_for_renew_id',$id)->get();
            $checkParent = ParentNoteForRenew::where('nothi_detail_id',$parentId)
                           ->where('serial_number',$nothiId)->get();

          }elseif($status == 'nameChange'){

              $getIdSarok = NameChangeOfficeSarok::where('parentnote_name_change_id',$id)->value('id');

              $potrangshoDraftNew =  DB::table('potrangsho_drafts')->where('sarokId',$getIdSarok)
                                     ->where('status',$status)->orderBy('id','desc')
                                     ->first();

              $officeDetail = NameChangeOfficeSarok::where('parentnote_name_change_id',$id)->get();
              $checkParent = ParentNoteForNameChange::where('nothi_detail_id',$parentId)
                             ->where('serial_number',$nothiId)->get();

          }elseif($status == 'fdNine'){


              $getIdSarok = FdNineOfficeSarok::where('p_note_for_fd_nine_id',$id)
              ->value('id');


              $potrangshoDraftNew =  DB::table('potrangsho_drafts')
              ->where('sarokId',$getIdSarok)
              ->where('status',$status)
              ->orderBy('id','desc')
              ->first();

              $officeDetail = FdNineOfficeSarok::where('p_note_for_fd_nine_id',$id)->get();

              $checkParent = ParentNoteForFdNine::where('nothi_detail_id',$parentId)
              ->where('serial_number',$nothiId)
              ->get();

  //dd($checkParent);


          }elseif($status == 'fdNineOne'){

              $getIdSarok = FdNineOneOfficeSarok::where('p_note_for_fd_nine_one_id',$id)
              ->value('id');


              $potrangshoDraftNew =  DB::table('potrangsho_drafts')
              ->where('sarokId',$getIdSarok)
              ->where('status',$status)
              ->orderBy('id','desc')
              ->first();


              $officeDetail = FdNineOneOfficeSarok::where('p_note_for_fd_nine_one_id',$id)->get();


              $checkParent = ParentNoteForFdNineOne::where('nothi_detail_id',$parentId)
              ->where('serial_number',$nothiId)
              ->get();




          }elseif($status == 'fdSix'){


              $getIdSarok = FdSixOfficeSarok::where('parent_note_for_fdsix_id',$id)
              ->value('id');


              $potrangshoDraftNew =  DB::table('potrangsho_drafts')
              ->where('sarokId',$getIdSarok)
              ->where('status',$status)
              ->orderBy('id','desc')
              ->first();


              $officeDetail = FdSixOfficeSarok::where('parent_note_for_fdsix_id',$id)->get();

              $checkParent = ParentNoteForFdsix::where('nothi_detail_id',$parentId)
              ->where('serial_number',$nothiId)
              ->get();



          }elseif($status == 'fdSeven'){


              $getIdSarok = FdSevenOfficeSarok::where('parent_note_for_fd_seven_id',$id)
              ->value('id');


              $potrangshoDraftNew =  DB::table('potrangsho_drafts')
              ->where('sarokId',$getIdSarok)
              ->where('status',$status)
              ->orderBy('id','desc')
              ->first();



              $officeDetail = FdSevenOfficeSarok::where('parent_note_for_fd_seven_id',$id)->get();

              $checkParent = ParentNoteForFdSeven::where('nothi_detail_id',$parentId)
              ->where('serial_number',$nothiId)
              ->get();



          }elseif($status == 'fcOne'){


              $getIdSarok = FcOneOfficeSarok::where('parent_note_for_fc_one_id',$id)
              ->value('id');


              $potrangshoDraftNew =  DB::table('potrangsho_drafts')
              ->where('sarokId',$getIdSarok)
              ->where('status',$status)
              ->orderBy('id','desc')
              ->first();


              $officeDetail = FcOneOfficeSarok::where('parent_note_for_fc_one_id',$id)->get();
              $checkParent = ParentNoteForFcOne::where('nothi_detail_id',$parentId)
              ->get();




          }elseif($status == 'fcTwo'){

              $getIdSarok = FcTwoOfficeSarok::where('parent_note_for_fc_two_id',$id)
              ->value('id');


              $potrangshoDraftNew =  DB::table('potrangsho_drafts')
              ->where('sarokId',$getIdSarok)
              ->where('status',$status)
              ->orderBy('id','desc')
              ->first();


              $officeDetail = FcTwoOfficeSarok::where('parent_note_for_fc_two_id',$id)->get();

              $checkParent = ParentNoteForFcTwo::where('nothi_detail_id',$parentId)
              ->where('serial_number',$nothiId)
              ->get();





          }elseif($status == 'fdThree'){


              $getIdSarok = FdThreeOfficeSarok::where('parent_note_for_fd_three_id',$id)
              ->value('id');


              $potrangshoDraftNew =  DB::table('potrangsho_drafts')
              ->where('sarokId',$getIdSarok)
              ->where('status',$status)
              ->orderBy('id','desc')
              ->first();

              $officeDetail = FdThreeOfficeSarok::where('parent_note_for_fd_three_id',$id)->get();




              $checkParent = ParentNoteForFdThree::where('nothi_detail_id',$parentId)
              ->where('serial_number',$nothiId)
              ->get();


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




        return view('admin.potro.createPotroForReceiver',compact('potrangshoDraftNew','nothiYear','branchListForSerial','permissionNothiList','nothiCopyListUpdate','nothiAttractListUpdate','nothiPropokListUpdate','user','nothiId','nothiNumber','officeDetail','checkParent','status','id','parentId','activeCode'));


    }


}
