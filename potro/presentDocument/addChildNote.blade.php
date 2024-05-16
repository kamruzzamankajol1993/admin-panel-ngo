@extends('admin.master.master')

@section('title')
নোটাংশ
@endsection


@section('body')
  <style>

    .bactive{
        background: #24695c !important;
    color: white;
    }
        #container {
            width: 100%;
        }

        .ck-editor__editable[role="textbox"] {
            /* editing area */
            min-height: 10vh;
        }

        .ck-content .image {
            /* block images */
            max-width: 80%;
            margin: 20px auto;
        }
    </style>



<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <h3>নোটাংশ</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">নোটাংশ</a></li>
                    <li class="breadcrumb-item">নোটাংশ</li>
                </ol>
            </div>
        </div>
    </div>
</div>


   <!-- Container-fluid starts-->
   <div class="container-fluid list-products">
    <div class="row">
        <!-- Individual column searching (text inputs) Starts-->
        <div class="col-sm-12">
            <div class="card">
                        <div class="card-body">
                            <div class="row">

@include('flash_message')
                                <div class="col-lg-2 col-sm-12">
                                    <div style="border-right: 1px solid gray; height:100%">

                                        <!-- add note button -->
                                        <button class="btn btn-outline-success" data-bs-toggle="modal" data-original-title="" data-bs-target="#myModal3" data-bs-original-title="" title=""><i class="fa fa-calendar"></i> নতুন নোট</button>
<!-- end add note button -->






                                        @if(count($checkParent) == 0)

                                        @else
                                        <p class="mt-2">মোট নোট <span>({{ App\Http\Controllers\Admin\CommonController::englishToBangla(count($checkParent)) }})</span></p>
                                        <hr>

                                        @foreach($checkParent as $key=>$checkParents)

@if($activeCode == ($key+1))

<button class="btn btn-transparent mt-2 bactive"  onclick="location.href = '{{ route('addChildNote', ['status' => $status,'parentId'=>$parentId,'nothiId'=>$nothiId,'id' =>$checkParents->id,'activeCode' => ($key+1)]) }}';"><span class="me-2" style="padding:2px 5px; border-radius: 6px; border: 1px solid black">{{ App\Http\Controllers\Admin\CommonController::englishToBangla($key+1) }}</span>{{ $checkParents->name }}</button>
@else
<button class="btn btn-transparent mt-2"  onclick="location.href = '{{ route('addChildNote', ['status' => $status,'parentId'=>$parentId,'nothiId'=>$nothiId,'id' =>$checkParents->id,'activeCode' => ($key+1)]) }}';"><span class="me-2" style="padding:2px 5px; border-radius: 6px; border: 1px solid black">{{ App\Http\Controllers\Admin\CommonController::englishToBangla($key+1) }}</span>{{ $checkParents->name }}</button>
@endif

                                        @if(count($checkParent) == ($key+1))

                                        @else
                                        <hr>
                                        @endif
                                        @endforeach

                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-10 col-sm-12">
                            <ul class="nav nav-tabs" id="icon-tab" role="tablist">
                                <li class="nav-item"><a class="nav-link active" id="icon-home-tab"
                                                        data-bs-toggle="tab" href="#icon-home" role="tab"
                                                        aria-controls="icon-home" aria-selected="true"><i
                                                class="icofont icofont-ui-home"></i>নোটাংশ</a></li>
                                <li class="nav-item"><a class="nav-link" id="profile-icon-tab"
                                                        data-bs-toggle="tab" href="#profile-icon" role="tab"
                                                        aria-controls="profile-icon"
                                                        aria-selected="false"><i
                                                class="icofont icofont-man-in-glasses"></i>পত্রাংশ</a></li>
                            </ul>
                            <div class="tab-content mt-4" id="icon-tabContent">
                                <div class="tab-pane fade show active" id="icon-home" role="tabpanel"
                                     aria-labelledby="icon-home-tab">

                                     @if(count($checkParent) == 0)
                                     <h3>কোন নোট পাওয়া যায়নি</h3>
                                     @else


                                     <!--first note start-->

                                    <?php



if($status == 'registration'){


$checkParentFirst = DB::table('parent_note_for_registrations')->where('nothi_detail_id',$parentId)
->where('serial_number',$nothiId)
->where('id',$id)
   ->first();


   $childNoteNewList = DB::table('child_note_for_registrations')
           ->where('parent_note_regid',$id)->get();


           $childNoteNewListValue = DB::table('child_note_for_registrations')
           ->where('parent_note_regid',$id)->orderBy('id','desc')->value('id');


}elseif($status == 'renew'){




$checkParentFirst = DB::table('parent_note_for_renews')->where('nothi_detail_id',$parentId)
->where('serial_number',$nothiId)
->where('id',$id)
->first();


$childNoteNewList = DB::table('child_note_for_renews')
           ->where('parent_note_for_renew_id',$id)->get();


           $childNoteNewListValue = DB::table('child_note_for_renews')
           ->where('parent_note_for_renew_id',$id)->orderBy('id','desc')->value('id');



}elseif($status == 'nameChange'){






$checkParentFirst = DB::table('parent_note_for_name_changes')->where('nothi_detail_id',$parentId)
->where('serial_number',$nothiId)
->where('id',$id)
->first();


$childNoteNewList = DB::table('child_note_for_name_changes')
           ->where('parentnote_name_change_id',$id)->get();


           $childNoteNewListValue = DB::table('child_note_for_name_changes')
           ->where('parentnote_name_change_id',$id)->orderBy('id','desc')->value('id');



}elseif($status == 'fdNine'){






$checkParentFirst = DB::table('parent_note_for_fd_nines')->where('nothi_detail_id',$parentId)
->where('serial_number',$nothiId)
->where('id',$id)
->first();


$childNoteNewList = DB::table('child_note_for_fd_nines')
           ->where('p_note_for_fd_nine_id',$id)->get();

           $childNoteNewListValue = DB::table('child_note_for_fd_nines')
           ->where('p_note_for_fd_nine_id',$id)->orderBy('id','desc')->value('id');

//dd($checkParent);


}elseif($status == 'fdNineOne'){





$checkParentFirst = DB::table('parent_note_for_fd_nine_ones')->where('nothi_detail_id',$parentId)
->where('serial_number',$nothiId)
->where('id',$id)
->first();

$childNoteNewList = DB::table('child_note_for_fd_nine_ones')
           ->where('p_note_for_fd_nine_one_id',$id)->get();


           $childNoteNewListValue = DB::table('child_note_for_fd_nine_ones')
           ->where('p_note_for_fd_nine_one_id',$id)->orderBy('id','desc')->value('id');




}elseif($status == 'fdSix'){




$checkParentFirst = DB::table('parent_note_for_fdsixes')->where('nothi_detail_id',$parentId)
->where('serial_number',$nothiId)
->where('id',$id)
->first();

$childNoteNewList = DB::table('child_note_for_fd_sixes')
           ->where('parent_note_for_fdsix_id',$id)->get();


           $childNoteNewListValue = DB::table('child_note_for_fd_sixes')
           ->where('parent_note_for_fdsix_id',$id)->orderBy('id','desc')->value('id');



}elseif($status == 'fdSeven'){





$checkParentFirst = DB::table('parent_note_for_fd_sevens')->where('nothi_detail_id',$parentId)
->where('serial_number',$nothiId)
->where('id',$id)
->first();

$childNoteNewList = DB::table('child_note_for_fd_sevens')
           ->where('parent_note_for_fd_seven_id',$id)->get();


           $childNoteNewListValue = DB::table('child_note_for_fd_sevens')
           ->where('parent_note_for_fd_seven_id',$id)->orderBy('id','desc')->value('id');



}elseif($status == 'fcOne'){



$checkParentFirst = DB::table('parent_note_for_fc_ones')->where('nothi_detail_id',$parentId)
->where('serial_number',$nothiId)
->where('id',$id)
->first();


$childNoteNewList = DB::table('child_note_for_fc_ones')
           ->where('parent_note_for_fc_one_id',$id)->get();

           $childNoteNewListValue = DB::table('child_note_for_fc_ones')
           ->where('parent_note_for_fc_one_id',$id)->orderBy('id','desc')->value('id');




}elseif($status == 'fcTwo'){




$checkParentFirst = DB::table('parent_note_for_fc_twos')->where('nothi_detail_id',$parentId)
->where('serial_number',$nothiId)
->where('id',$id)
->first();

$childNoteNewList = DB::table('child_note_for_fc_twos')
           ->where('parent_note_for_fc_two_id',$id)->get();


           $childNoteNewListValue = DB::table('child_note_for_fc_twos')
           ->where('parent_note_for_fc_two_id',$id)->orderBy('id','desc')->value('id');





}elseif($status == 'fdThree'){






$checkParentFirst = DB::table('parent_note_for_fd_threes')->where('nothi_detail_id',$parentId)
->where('serial_number',$nothiId)
->where('id',$id)
->first();


$childNoteNewList = DB::table('child_note_for_fd_threes')
           ->where('parent_note_for_fd_three_id',$id)->get();

           $childNoteNewListValue = DB::table('child_note_for_fd_threes')
           ->where('parent_note_for_fd_three_id',$id)->orderBy('id','desc')->value('id');


}





                                    ?>

                                     <!--end first note-->

                                 @if(count($childNoteNewList) > 0)

                                 {{-- <h3>কোন নোট পাওয়া যায়নি</h3> --}}


                                 <div class="card-body">
                                    <div class="default-according" id="accordion1">

@foreach($childNoteNewList as $key=>$childNoteNewLists)

                                      <div class="card">
                                        <div class="card-header bg-primary" id="heading{{ $key+1 }}">
                                          <h5 class="mb-0">
                                            <button class="btn btn-link text-white" data-bs-toggle="collapse" data-bs-target="#collapse{{ $key+1 }}" aria-expanded="true" aria-controls="collapseFour">অনুচ্ছেদ#<span>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($key+1) }}</span> <span style="padding-right:40px;">{{ App\Http\Controllers\Admin\CommonController::englishToBangla($childNoteNewLists->created_at) }}</span>
                                          </h5>
                                        </div>
                                        <div class="collapse" id="collapse{{ $key+1 }}" aria-labelledby="heading{{ $key+1 }}" data-bs-parent="#accordion1">
                                          <div class="card-body">
                                            <form class="custom-validation" action="{{ route('childNote.update',$childNoteNewLists->id) }}" method="post" enctype="multipart/form-data" id="form" data-parsley-validate="">
                                                @csrf
                                                @method('PUT')

                                                <input type="hidden" value="{{ $status }}" name="status"/>

                                                <input type="hidden" value="{{ $id }}" name="noteId"/>
                                                <input type="hidden" value="{{ $activeCode }}" name="activeCode"/>
                                                <input type="hidden" value="{{ $nothiId }}" name="nothiId"/>
                                                <input type="hidden" value="{{ $parentId }}" name="dakId"/>
                                                {{-- <input type="hidden" value="{{ $status }}" name="status"/> --}}
                                                 <div id="container">
                                            <textarea class="maineditor" name="mainPartNote" id="editor{{ $key+1 }}">

                                                {!! $childNoteNewLists->description !!}
                                            </textarea>
                                        </div>


                                        <div class="d-flex flex-row-reverse mt-3">

                                            {{-- <button class="btn btn-danger ms-3" type="button">
                                                <i class="fa fa-send"></i>
                                                বাতিল করুন
                                            </button> --}}
                                            <div class="dropdown">
                                                <?php

                                                $senderIdNew1 = DB::table('nothi_details')
                                                ->where('noteId',$id)
                                                ->where('nothId',$nothiId)
                                                ->where('dakId',$parentId)
                                                ->where('dakType',$status)
                                                ->whereNull('back_status')
                                                //->where('sender',Auth::guard('admin')->user()->id)
                                                ->value('permission_status');

                                                            ?>


                                                @if($senderIdNew1 == 1)
                                                <button class="btn btn-primary" disabled>
                                                    সংশোধন করুন
                                                 </button>
                                                @else
                                                <button class="btn btn-primary" value="সংশোধন" name="final_button" type="submit"

                                                        aria-expanded="false">
                                                        সংশোধন করুন
                                                </button>

                                                @endif

                                                <button class="btn btn-secondary" value="সংশোধন ও খসড়া" name="final_button" type="submit"

                                                aria-expanded="false">
                                                সংশোধন ও খসড়া
                                        </button>

                                            </div>
                                        </div>


                                            </form>

<?php

$senderIdNew = DB::table('nothi_details')
                                                ->where('noteId',$id)
                                                ->where('nothId',$nothiId)
                                                ->where('dakId',$parentId)
                                                ->where('dakType',$status)
                                                ->whereNull('back_status')
                                                //->where('sender',Auth::guard('admin')->user()->id)
                                                ->first();

?>


@if(!$senderIdNew)

@else

<?php

$mainSenderIdNew =DB::table('article_signs')
->where('dakDetailId',$senderIdNew->id)
->where('childId',$childNoteNewLists->id)->get();

//dd($mainSenderIdNew);
?>

@if(count($mainSenderIdNew) == 0)

@else

<div class="row">
    @foreach($mainSenderIdNew as $key=>$mainSenderIdNews)

    <?php
$adminId = DB::table('admins')->where('id',$mainSenderIdNews->sender)->first();
$adminId2 = DB::table('admins')->where('id',$mainSenderIdNews->permissionId)->first();
?>

@if(!$adminId)

@else

<?php
$desiName = DB::table('designation_lists')
                                        ->where('id',$adminId->designation_list_id)
                                        ->value('designation_name');
$branchName = DB::table('branches')->where('id',$adminId->branch_id)->value('branch_name');

?>
<div class="col-lg-3 col-md-3 col-sm-6 mb-2" >
    <div class="text-center">
        <img src="{{ asset('/') }}{{ $adminId->admin_sign }}" alt="" height="50" width="180">

    <div style="height:1px; width:100%; background-color: #BC1133"></div>

    <p style="line-height:1.4; color: #BC1133; font-size: 14px;">
        {{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('d/m/y H:i:s', strtotime($mainSenderIdNews->created_at))) }}<br>
        {{ $adminId->admin_name_ban }}<br>
        {{ $desiName }}<br>
        {{ $branchName }}
    </p>

</div>

</div>
@endif

@if($senderIdNew->permission_status == 1)

<?php
$desiName1 = DB::table('designation_lists')
                                        ->where('id',$adminId2->designation_list_id)
                                        ->value('designation_name');
$branchName1 = DB::table('branches')->where('id',$adminId2->branch_id)->value('branch_name');

?>
<div class="col-lg-3 col-md-3 col-sm-6 mb-2" >

    <div class="text-center">
        @if($senderIdNew->permission_status == 1)
        <img src="{{ asset('/') }}{{ $adminId2->admin_sign }}" alt="" height="50" width="180">
        @else

        @endif
        <div style="height:1px; width:100%; background-color: #BC1133"></div>
        <p style="line-height:1.4; color: #BC1133; font-size: 14px;">


            @if($senderIdNew->permission_status == 1)
        {{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('d/m/y H:i:s', strtotime($senderIdNew->created_at))) }}<br>
            @else

            @endif
            {{ $adminId2->admin_name_ban }} <br>
            {{ $desiName1 }} <br>
            {{ $branchName1 }}</p>
    </div>

</div>
@else

@endif

    @endforeach
</div>

@endif

@endif

                  <!-- nothi sender list -->
                  @include('admin.presentDocument.nothiSendToUserModal')
                  <!-- end nothi sender list -->

                                        </div>
                                        </div>
                                      </div>
                                      @endforeach

                                      <div class="card">
                                        <div class="card-header bg-primary" id="headingSix">
                                          <h5 class="mb-0">
                                            <button class="btn btn-link collapsed text-white" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">নতুন অনুচ্ছেদ</button>
                                          </h5>
                                        </div>
                                        <div class="collapse show" id="collapseSix" aria-labelledby="headingSix" data-bs-parent="#accordion1">
                                          <div class="card-body">


                                            <form class="custom-validation" action="{{ route('childNote.store') }}" method="post" enctype="multipart/form-data" id="form" data-parsley-validate="">
                                                @csrf
                                                <input type="hidden" value="{{ $id }}" name="parentNoteId"/>
                                                <input type="hidden" value="{{ $status }}" name="status"/>

                                                <input type="hidden" value="{{ $id }}" name="noteId"/>
                                                <input type="hidden" value="{{ $activeCode }}" name="activeCode"/>
                                                <input type="hidden" value="{{ $nothiId }}" name="nothiId"/>
                                                <input type="hidden" value="{{ $parentId }}" name="dakId"/>

                                            <div id="container">
                                                <textarea class="maineditor" id="mainpeditor"  name="mainPartNote">
                                                    <p>লিখুন</p>
                                                </textarea>
                                            </div>
                                            <div class="d-flex flex-row-reverse mt-3">

                                                <?php

 $senderIdNew12 = DB::table('nothi_details')
 ->where('noteId',$id)
 ->where('nothId',$nothiId)
 ->where('dakId',$parentId)
 ->where('dakType',$status)
 ->whereNull('back_status')
 //->where('sender',Auth::guard('admin')->user()->id)
 ->value('permission_status');

             ?>

            @if($senderIdNew12 == 1)


            @else


                                                @if(count($checkParent) == 0)

                                                @else

                                                <?php

$receiverId = DB::table('nothi_details')
                            ->where('noteId',$id)
                            ->where('nothId',$nothiId)
                            ->where('dakId',$parentId)
                            ->where('dakType',$status)
                            ->where('sender',Auth::guard('admin')->user()->id)
                            ->value('receiver');

?>


 @if(empty($receiverId))




                                                <button data-bs-toggle="modal"
                                                data-original-title="" data-bs-target="#modalforsender1" class="btn btn-secondary ms-3" type="button">
                                                    <i class="fa fa-send"></i>
                                                    প্রেরণ করুন
                                                </button>

                                                @else

                                                <button data-bs-toggle="modal"
                                                data-original-title="" data-bs-target="#modalforsenderreturn1" class="btn btn-danger ms-3" type="button">
                                                    <i class="fa fa-arrow-circle-left"></i>
                                                    ফেরত আনুন
                                                </button>
                                                @endif



                                                @endif


                                                <div class="dropdown">

                                                    <button class="btn btn-success" value="সংরক্ষন ও খসড়া" name="final_button" type="submit"

                                                    aria-expanded="false">
                                                    সংরক্ষন ও খসড়া
                                            </button>


                                                    <button class="btn btn-primary" value="সংরক্ষন করুন" type="submit" name="final_button"

                                                            aria-expanded="false">
                                                        সংরক্ষন করুন
                                                    </button>

                                                </div>
                                                @endif
                                            </div>
                                             </form>



                                        </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>





                                 @else
                                     <form class="custom-validation" action="{{ route('childNote.store') }}" method="post" enctype="multipart/form-data" id="form" data-parsley-validate="">
                                        @csrf


                                        <input type="hidden" value="{{ $id }}" name="noteId"/>
                                        <input type="hidden" value="{{ $activeCode }}" name="activeCode"/>
                                        <input type="hidden" value="{{ $nothiId }}" name="nothiId"/>
                                        <input type="hidden" value="{{ $parentId }}" name="dakId"/>
                                        <input type="hidden" value="{{ $id }}" name="parentNoteId"/>
                                        <input type="hidden" value="{{ $status }}" name="status"/>
                                    <div id="container">
                                        <textarea id="peditor"  name="mainPartNote">
                                            <p>লিখুন</p>
                                        </textarea>
                                    </div>
                                    <div class="d-flex flex-row-reverse mt-3">

                                        {{-- <button class="btn btn-danger ms-3" type="button">
                                            <i class="fa fa-send"></i>
                                            বাতিল করুন
                                        </button> --}}
                                        <div class="dropdown">
                                            <button class="btn btn-success" value="সংরক্ষন ও খসড়া" name="final_button" type="submit"

                                            aria-expanded="false">
                                            সংরক্ষন ও খসড়া
                                    </button>


                                            <button class="btn btn-primary" value="সংরক্ষন করুন" type="submit" name="final_button"

                                                    aria-expanded="false">
                                                সংরক্ষন করুন
                                            </button>

                                        </div>
                                    </div>
                                     </form>
                                    @endif
                                    @endif


                                </div>
                                <div class="tab-pane fade" id="profile-icon" role="tabpanel"
                                     aria-labelledby="profile-icon-tab">

                                     @if(count($officeDetail) == 0 )

                                     <h5 style="color:red;"><span><i class="fa fa-exclamation-triangle"></i></span>কোনো পত্র পাওয়া যায়নি </h5>

                                     @else
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="card-body">
                                                <div class="row">

                                                    <div class="col-sm-12 col-xs-12">
                                                        <div class="tab-content"
                                                             id="v-pills-tabContent">
                                                            <div class="tab-pane fade show active"
                                                                 id="v-pills-home" role="tabpanel"
                                                                 aria-labelledby="v-pills-home-tab">
                                                                <div class="card">
                                                                    <div class="card-body">

                                                                        <?php
                                                                        $nothiApproverList = DB::table('nothi_approvers')->where('nothiId',$nothiId)
                                                                               ->where('status',$status)
                                                                               ->where('noteId',$id)->first();


                                                                        if(!$nothiApproverList){

                                                                                $appName = '';
                                                                                $desiName = '';
                                                                                $dateApp = '';
                                                                                $dateAppBan='';
                                                                                $appSignature ='';
                                                                        }else{





                                                                               $nothiApproverLista = DB::table('admins')->where('id',$nothiApproverList->adminId)
                                                                               ->first();

                                                                               if(!$nothiApproverLista){


                                                                                $appName = '';
                                                                                $desiName = '';
                                                                                $appSignature ='';

                                                                               }else{

                                                                                $designationName = DB::table('designation_lists')
                                                                                        ->where('id',$nothiApproverLista->designation_list_id)
                                                                                        ->value('designation_name');


                                                                                $appName = $nothiApproverLista->admin_name_ban;
                                                                                $desiName = $designationName;
                                                                                $appSignature =$nothiApproverLista->admin_sign;
                                                                               }


                                                                               $dateApp =  App\Http\Controllers\Admin\CommonController::englishToBangla(date('d F Y', strtotime($nothiApproverList->created_at)));
                                                                               $dateAppBan =  $nothiApproverList->bangla_date;

                                                                            }



 ?>


 @foreach($officeDetail as $officeDetails)

 <!-- new code potrangso -->
 <?php
$potroZariListValueZari =  DB::table('nothi_details')
                    ->where('noteId',$id)
                    ->where('nothId',$nothiId)
                    ->where('dakId',$parentId)
                    ->where('dakType',$status)
                    ->value('zari_permission_status');

                    $potroZariListValueZariPdf =  DB::table('nothi_details')
                    ->where('noteId',$id)
                    ->where('nothId',$nothiId)
                    ->where('dakId',$parentId)
                    ->where('dakType',$status)
                    ->value('potroPdf');
 ?>
 <!-- end new code potrangso -->


 <!-- new button code start -->

 @if($potroZariListValueZari == 1)

 <button class="btn btn-primary me-2" onclick="location.href = '{{ route('printPotrangso', ['status' => $status,'parentId'=>$parentId,'nothiId'=>$nothiId,'id' =>$id,'sarokCode'=>$officeDetails->id]) }}';"><i class="fa fa-print"></i> প্রিন্ট করুন</button>

 <div class="row mt-3">
    <div class="col-xl-2 ">পত্রের বিষয়:</div>
    <div class="col-xl-10">{!! $officeDetails->office_subject !!}</div>
</div>

 <div class="row mt-3">

    <object
    data='{{ asset('/') }}{{ 'public/'.$potroZariListValueZariPdf }}'
    type="application/pdf"
    width="500"
    height="900"
  >

    <iframe
      src='{{ asset('/')}}{{ 'public/'.$potroZariListValueZariPdf }}'
      width="500"
      height="900"
    >
    <p>This browser does not support PDF!</p>
    </iframe>
  </object>

</div>

 @else

 <div class="d-flex flex-wrap mb-4">
    <div class="dropdown me-2">
        <button class="btn btn-primary dropdown-toggle"
                type="button"
                id="dropdownMenuButton1"
                data-bs-toggle="dropdown"
                aria-expanded="false">
            পত্র অনুমোদন করুন
        </button>
        <div class="dropdown-menu"
             aria-labelledby="dropdownMenuButton1">
            <div>
                <h3 class="popover-header">পত্র অনুমোদন </h3>
                <div class="popover-body">আপনি কি পত্র অনুমোদন করতে চান</div>
                <div class="d-flex justify-content-center p-2">
                    <button  onclick="location.href = '{{ route('givePermissionToNote', ['status' => $status,'parentId'=>$parentId,'nothiId'=>$nothiId,'id' =>$id,'childnote'=>$childNoteNewListValue]) }}';" class="btn btn-primary me-2">হ্যাঁ</button>
                    <button class="btn btn-danger">না</button>
                </div>
            </div>
        </div>
    </div>
    <button class="btn btn-primary me-2" onclick="location.href = '{{ route('createPotro', ['status' => $status,'parentId'=>$parentId,'nothiId'=>$nothiId,'id' =>$id,'activeCode' =>$activeCode]) }}';"><i class="fa fa-pencil"></i> সংশোধন করুন</button>
    <a target="_blank"    class="btn btn-primary me-2" href = '{{ route('printPotrangso', ['status' => $status,'parentId'=>$parentId,'nothiId'=>$nothiId,'id' =>$id,'sarokCode'=>$officeDetails->id]) }}'><i class="fa fa-print"></i> প্রিন্ট করুন</a>

    <?php
    $potroZariListValue =  DB::table('nothi_details')
                    ->where('noteId',$id)
                    ->where('nothId',$nothiId)
                    ->where('dakId',$parentId)
                    ->where('dakType',$status)
                    ->value('permission_status');



        ?>

        @if($potroZariListValue == 1)
        <button class="btn btn-primary me-2" data-bs-toggle="modal"
        data-original-title="" data-bs-target="#potroZariModal"><i class="fa fa-print"></i>পত্র জারি করুন </button>
        @else


        @endif
</div>

 <!-- new button code end -->

                                                                        <div class="text-center mb-3 mt-2">
                                                                            <img src="{{ asset('/') }}public/pdfLogo.png" alt="" style="height: 80px;width:80px;">
                                                                            <h3>গণপ্রজাতন্ত্রী বাংলাদেশ
                                                                                সরকার</h3>
                                                                            <h5>এনজিও বিষয়ক ব্যুরো <br>
                                                                                প্রধানমন্ত্রীর কার্যালয় <br>
                                                                                প্লট-ই, ১৩/বি, আগারগাঁও <br>
                                                                                শেরেবাংলা নগর, ঢাকা-১২০৭
                                                                            </h5>
                                                                        </div>
                                                                        <div class="row" class="mt-4">
                                                                            <div class="col-md-6">
                                                                                <p ><span style="font-weight:900;">স্মারক নং:</span> {{ App\Http\Controllers\Admin\CommonController::englishToBangla('১১.২২.৩৩৩৩.৪৪৪.৫৫.'.$nothiNumber.$nothiYear) }}</p>
                                                                            </div>
                                                                            <div class="col-md-6" style="text-align: right;">
                                                                                <table class="table table-borderless">
                                                                                    <tr>
                                                                                        <td style="width: 60%;">তারিখ:</td>
                                                                                        <td style="text-align: left; padding-left: 10px;">
                                                                                            @if($potroZariListValue == 1)
                                                                                            {{ $dateAppBan }} বঙ্গাব্দ  <br> {{ $dateApp }} খ্রিস্টাব্দ
                                                                                            @else

                                                                                            @endif
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </div>
                                                                        </div>





                                                                      <input type="hidden" name="updateOrSubmit" id="updateOrSubmit" value="1"/>
                                                                      <input type="hidden" name="sorkariUpdateId" id="sorkariUpdateId" value="{{ $officeDetails->id }}"/>
                                                                      <div class="row mt-3">
                                                                        <div class="col-xl-2 ">বিষয় :
                                                                        </div>
                                                                        <div class="col-xl-10">



                                                                                {!! $officeDetails->office_subject !!}

                                                                    </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        @if($officeDetails->office_sutro == '<p>(যদি থাকে):...............................................</p>')

                                                                        @else
                                                                        <div class="col-xl-2">সুত্রঃ
                                                                            (যদি থাকে):
                                                                        </div>

                                                                        <div class="col-xl-10">{!! $officeDetails->office_sutro !!}</div>
                                                                        @endif
                                                                        <input type="hidden" name="parentIdForPotrangso" id="parentIdForPotrangso" value="{{ $id }}"/>
                                                                                             <input type="hidden" name="statusForPotrangso" id="statusForPotrangso" value="{{ $status }}"/>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-xl-12 mt-2">


                                                                                        {!! $officeDetails->description !!}



                                                                        </div>
                                                                    </div>











                                                                        <!-- approver start --->



                                                                        <div class="mt-4" style="text-align: right;">
                                                                            @if($potroZariListValue == 1)

                                                                            @if(!$nothiApproverLista)

                                                                            @else
                                                                            <img src="{{ asset('/') }}{{ $appSignature }}" style="height:30px;"/><br>
                                                                            @endif

                                                                            @else
                                                                            @endif
                                                                        <span>{{ $appName }}</span><br>
                                                                        <span>{{ $desiName }}</span>
                                                                        </div>

                                                                        <!-- approver end -->

                                                                   <!--prapok-->
                                                                    <div class="mt-4">
                                                                        @foreach($nothiPropokListUpdate as $nothiPropokLists)
                                                                        <span>{{ $nothiPropokLists->otherOfficerDesignation }},{{ $nothiPropokLists->otherOfficerBranch }}</span> ।<br>
                                                                        @endforeach
                                                                    </div>
                                                                    <!--end prapok  --->

                                                                    <!-- attraction -->

                                                                    @if(count($nothiAttractListUpdate) == 0)

                                                                    @else
                                                                    <h6 class="mt-4">দৃষ্টি আকর্ষণ</h6>
                                                                    @foreach($nothiAttractListUpdate as $nothiPropokLists)
                                                                    <span>{{ $nothiPropokLists->otherOfficerDesignation }},{{ $nothiPropokLists->otherOfficerBranch }}</span> ।<br>
                                                                    @endforeach
                                                                    @endif

                                                                    <!-- attracttion -->

                                                                    <!-- sarok number --->

                                                                    <div class="row" class="mt-4">
                                                                        <div class="col-md-6">
                                                                            <p ><span style="font-weight:900;">স্মারক নং:</span> {{ App\Http\Controllers\Admin\CommonController::englishToBangla('১১.২২.৩৩৩৩.৪৪৪.৫৫.'.$nothiNumber.$nothiYear) }}</p>
                                                                        </div>
                                                                        <div class="col-md-6" style="text-align: right;">
                                                                            <table class="table table-borderless">
                                                                                <tr>
                                                                                    <td style="width: 60%;">তারিখ:</td>
                                                                                    <td style="text-align: left; padding-left: 10px;">

                                                                                        @if($potroZariListValue == 1)
                                                                                        {{ $dateAppBan }} বঙ্গাব্দ  <br> {{ $dateApp }} খ্রিস্টাব্দ
                                                                                        @else

                                                                                        @endif

                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </div>
                                                                    </div>





                                                                    <!-- end sarok number -->

                                                                    <!--copy-->

                                                                    @if(count($nothiCopyListUpdate) == 0)

                                                                    @else
                                                                    <h6 class="mt-4">সদয় জ্ঞাতার্থে/জ্ঞাতার্থে (জ্যেষ্ঠতার ক্রমানুসারে নয় ):</h6>
                                                                    @foreach($nothiCopyListUpdate as $key=>$nothiPropokLists)
                                                                    <span>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($key+1) }} | {{ $nothiPropokLists->otherOfficerDesignation }},{{ $nothiPropokLists->otherOfficerBranch }}</span>;<br>
                                                                    @endforeach
                                                                    @endif

                                                                    <!--end copy list -->
<!--prapok-->
<div class="mt-4" style="text-align: right;">

    <span>{{ $appName }}</span><br>
    <span>{{ $desiName }}</span>
    </div>
    @endif
@endforeach



                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        </div>
                        </div>
                    </div>
        </div>
        <!-- Individual column searching (text inputs) Ends-->
    </div>
</div>
<!-- Container-fluid Ends-->


<!-- note add modal start -->


<div class="modal fade bd-example-modal-lg" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">নতুন নোট তৈরী করুন</h4>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="custom-validation" action="{{ route('parentNote.store') }}" method="post" enctype="multipart/form-data" id="form" data-parsley-validate="">
                    @csrf

                    <input type="hidden" value="{{ $status }}" placeholder="নোট এর বিষয়" class="form-control" name="status" id=""/>
                    <input type="hidden" value="{{ $parentId }}" placeholder="নোট এর বিষয়" class="form-control" name="dakId" id=""/>
                    <input type="hidden" value="{{ $nothiId }}" placeholder="নোট এর বিষয়" class="form-control" name="nothiId" id=""/>
                    <div class="mb-3">
                    <label class="form-label" for="">নোট এর বিষয় </label>
                    <input type="text" placeholder="নোট এর বিষয়" class="form-control" name="subject" id=""/>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary w-md mt-3">সংরক্ষণ করুন</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




<!-- end note add modal start -->

<!-- nothi approval modal -->
@include('admin.presentDocument.nothiApproverModal')
<!-- end nothi approval modal -->


<!-- nothi sender modal -->
@include('admin.presentDocument.nothiSenderModal')
<!-- end nothi sender modal -->



<!--propok modal data -->
@include('admin.presentDocument.nothiPrapokModal')
<!-- end prapok modal -->


<!-- attract nothi-->
@include('admin.presentDocument.nothiAttractModal')
<!-- end attract nothi -->


<!-- copy nothi -->

@include('admin.presentDocument.nothiCopyModal')
<!-- end copy nothi -->


<!-- nothi sender list -->
@include('admin.presentDocument.mt2')
<!-- end nothi sender list -->


<!-- nothi sender list -->
@include('admin.presentDocument.mt3')
<!-- end nothi sender list -->


<!-- nothi sender list -->
@include('admin.presentDocument.potroZariModal')
<!-- end nothi sender list -->


<!--code for ajax -->


<!--end code for ajax-->
@endsection


@section('script')

<script>

$(".chb").change(function()
                                  {
                                      $(".chb").prop('checked',false);
                                      $(this).prop('checked',true);
                                  });
</script>


<!-- slef oficer add code -->




<script>



$("#otherOfficerAdd").click(function(){

   var otherOfficerName = $("#otherOfficerName").val();
   var otherOfficerDesignation = $("#otherOfficerDesignation").val();
   var otherOfficerAddress = $("#otherOfficerAddress").val();
   var otherOfficerBranch = $("#otherOfficerBranch").val();
   var otherOfficerEmail = $("#otherOfficerEmail").val();
   var otherOfficerPhone = $("#otherOfficerPhone").val();

   var snothiId =$('#snothiId').val();
var sstatus =$('#sstatus').val();

var snoteId =$('#snoteId').val();





   //alert(formData);


   $.ajax({
    url: "{{ route('otherOfficerAdd') }}",
    method: 'get',
    data: {snoteId:snoteId,sstatus:sstatus,snothiId:snothiId,otherOfficerName:otherOfficerName,otherOfficerDesignation:otherOfficerDesignation,otherOfficerAddress:otherOfficerAddress,otherOfficerBranch:otherOfficerBranch,otherOfficerEmail:otherOfficerEmail,otherOfficerPhone:otherOfficerPhone},
    success: function(data) {
      $("#otherOfficerName").val('');
   $("#otherOfficerDesignation").val('');
   $("#otherOfficerAddress").val('');
   $("#otherOfficerBranch").val('');
   $("#otherOfficerEmail").val('');
   $("#otherOfficerPhone").val('');

        $("#sms22").html('<div class="alert" style=" padding: 20px;background-color: #1b4c43 !important;color: white;"><strong>ডেটা সফলভাবে যোগ করা হয়েছে</strong></div>');
        $('#tableListN').html(data);
    }
    });



});


$("#attractOtherOfficerAdd").click(function(){

var otherOfficerName = $("#otherOfficerName2").val();
var otherOfficerDesignation = $("#otherOfficerDesignation2").val();
var otherOfficerAddress = $("#otherOfficerAddress2").val();
var otherOfficerBranch = $("#otherOfficerBranch2").val();
var otherOfficerEmail = $("#otherOfficerEmail2").val();
var otherOfficerPhone = $("#otherOfficerPhone2").val();

var snothiId =$('#snothiId2').val();
var sstatus =$('#sstatus2').val();

var snoteId =$('#snoteId2').val();





//alert(formData);


$.ajax({
 url: "{{ route('attractOtherOfficerAdd') }}",
 method: 'get',
 data: {snoteId:snoteId,sstatus:sstatus,snothiId:snothiId,otherOfficerName:otherOfficerName,otherOfficerDesignation:otherOfficerDesignation,otherOfficerAddress:otherOfficerAddress,otherOfficerBranch:otherOfficerBranch,otherOfficerEmail:otherOfficerEmail,otherOfficerPhone:otherOfficerPhone},
 success: function(data) {
   $("#otherOfficerName2").val('');
$("#otherOfficerDesignation2").val('');
$("#otherOfficerAddress2").val('');
$("#otherOfficerBranch2").val('');
$("#otherOfficerEmail2").val('');
$("#otherOfficerPhone2").val('');

     $("#sms22a").html('<div class="alert" style=" padding: 20px;background-color: #1b4c43 !important;color: white;"><strong>ডেটা সফলভাবে যোগ করা হয়েছে</strong></div>');
     $('#tableListN2').html(data);
 }
 });



});


$("#copyOtherOfficerAdd").click(function(){

var otherOfficerName = $("#otherOfficerName3").val();
var otherOfficerDesignation = $("#otherOfficerDesignation3").val();
var otherOfficerAddress = $("#otherOfficerAddress3").val();
var otherOfficerBranch = $("#otherOfficerBranch3").val();
var otherOfficerEmail = $("#otherOfficerEmail3").val();
var otherOfficerPhone = $("#otherOfficerPhone3").val();

var snothiId =$('#snothiId3').val();
var sstatus =$('#sstatus3').val();

var snoteId =$('#snoteId3').val();





//alert(formData);


$.ajax({
 url: "{{ route('copyOtherOfficerAdd') }}",
 method: 'get',
 data: {snoteId:snoteId,sstatus:sstatus,snothiId:snothiId,otherOfficerName:otherOfficerName,otherOfficerDesignation:otherOfficerDesignation,otherOfficerAddress:otherOfficerAddress,otherOfficerBranch:otherOfficerBranch,otherOfficerEmail:otherOfficerEmail,otherOfficerPhone:otherOfficerPhone},
 success: function(data) {
   $("#otherOfficerName3").val('');
$("#otherOfficerDesignation3").val('');
$("#otherOfficerAddress3").val('');
$("#otherOfficerBranch3").val('');
$("#otherOfficerEmail3").val('');
$("#otherOfficerPhone3").val('');

     $("#sms22c").html('<div class="alert" style=" padding: 20px;background-color: #1b4c43 !important;color: white;"><strong>ডেটা সফলভাবে যোগ করা হয়েছে</strong></div>');
     $('#tableListN3').html(data);
 }
 });



});


$("#selfOfficerAdd").click(function(){



var selfOfficerList =$('#selfOfficerList').val();
var snothiId =$('#snothiId').val();
var sstatus =$('#sstatus').val();
var snoteId =$('#snoteId').val();
//alert(selfOfficerList);


$.ajax({
    url: "{{ route('selfOfficerAdd') }}",
    method: 'get',
    data: {snoteId:snoteId,snothiId:snothiId,sstatus:sstatus,selfOfficerList:selfOfficerList},
    success: function(data) {


        $("#sms2").html('<div class="alert" style=" padding: 20px;background-color: #1b4c43 !important;color: white;"><strong>ডেটা সফলভাবে যোগ করা হয়েছে</strong></div>');
        $('#tableListN').html(data);
    }
    });



});


$("#attractSelfOfficerAdd").click(function(){



var selfOfficerList =$('#attractselfOfficerList').val();
var snothiId =$('#snothiId2').val();
var sstatus =$('#sstatus2').val();
var snoteId =$('#snoteId2').val();
//alert(selfOfficerList);


$.ajax({
    url: "{{ route('attractSelfOfficerAdd') }}",
    method: 'get',
    data: {snoteId:snoteId,snothiId:snothiId,sstatus:sstatus,selfOfficerList:selfOfficerList},
    success: function(data) {


        $("#sms2a").html('<div class="alert" style=" padding: 20px;background-color: #1b4c43 !important;color: white;"><strong>ডেটা সফলভাবে যোগ করা হয়েছে</strong></div>');
        $('#tableListN2').html(data);
    }
    });



});


$("#copySelfOfficerAdd").click(function(){



var selfOfficerList =$('#copyselfOfficerList').val();
var snothiId =$('#snothiId3').val();
var sstatus =$('#sstatus3').val();
var snoteId =$('#snoteId3').val();
//alert(selfOfficerList);


$.ajax({
    url: "{{ route('copySelfOfficerAdd') }}",
    method: 'get',
    data: {snoteId:snoteId,snothiId:snothiId,sstatus:sstatus,selfOfficerList:selfOfficerList},
    success: function(data) {


        $("#sms2c").html('<div class="alert" style=" padding: 20px;background-color: #1b4c43 !important;color: white;"><strong>ডেটা সফলভাবে যোগ করা হয়েছে</strong></div>');
        $('#tableListN3').html(data);
    }
    });



});

    </script>




<!-- end self officer add code -->



<!-- Plugin used-->
<script src="https://cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script>
<script>
    $('.maineditor').each(function () {

    var ii = $(this).prop('id');
        CKEDITOR.replace(ii);
    });


    CKEDITOR.replace('editor1222');

    //CKEDITOR.replace('mainpeditor');




    </script>
<script>
    CKEDITOR.replace('peditor');
</script>
<script>
    // Turn off automatic editor creation first.
    CKEDITOR.disableAutoInline = true;
    //CKEDITOR.inline('ineditor2' );
    CKEDITOR.inline('ineditor1' );
</script>


<script>
    // Turn off automatic editor creation first.
    CKEDITOR.disableAutoInline = true;
    //CKEDITOR.inline('ineditor2' );
    CKEDITOR.inline('ineditor2' );
</script>


<!--script for  nottangoso start-->
<script type="text/javascript">

    $(document).ready(function () {


        $('body').on('click', '#delete-user1', function () {

            // $("#delete-user1").click(function(){

          var userURL = $(this).data('url');
          var trObj = $(this);

          //alert(22);

          if(confirm("Are you sure you want to remove this user?") == true){
                $.ajax({
                    url: userURL,
                    type: 'get',
                    dataType: 'json',
                    success: function(data) {
                        alert(data.success);
                        trObj.parents("tr").remove();
                    }
                });
          }

       });

    });

</script>


<script type="text/javascript">

    $(document).ready(function () {


        $('body').on('click', '#delete-user12', function () {

            // $("#delete-user1").click(function(){

          var userURL = $(this).data('url');
          var trObj = $(this);

          //alert(22);

          if(confirm("Are you sure you want to remove this user?") == true){
                $.ajax({
                    url: userURL,
                    type: 'get',
                    dataType: 'json',
                    success: function(data) {
                        alert(data.success);
                        trObj.parents("tr").remove();
                    }
                });
          }

       });

    });

</script>


<script type="text/javascript">

    $(document).ready(function () {


        $('body').on('click', '#delete-user13', function () {

            // $("#delete-user1").click(function(){

          var userURL = $(this).data('url');
          var trObj = $(this);

          //alert(22);

          if(confirm("Are you sure you want to remove this user?") == true){
                $.ajax({
                    url: userURL,
                    type: 'get',
                    dataType: 'json',
                    success: function(data) {
                        alert(data.success);
                        trObj.parents("tr").remove();
                    }
                });
          }

       });

    });

</script>


<script>
    $.ajaxSetup({

    headers: {

        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

    }

    });

    </script>
@endsection
