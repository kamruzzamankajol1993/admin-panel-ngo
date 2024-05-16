@extends('admin.master.master')

@section('title')
সকল ডাক তালিকা | {{ $ins_name }}
@endsection


@section('css')

@endsection

@section('body')
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <h3>সকল ডাক তালিকা</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">হোম</a></li>
                    <li class="breadcrumb-item">ডাক </li>
                    <li class="breadcrumb-item">সকল ডাক তালিকা</li>
                </ol>
            </div>
            <div class="col-sm-6">
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
                    <ul class="nav nav-dark" id="pills-darktab" role="tablist">
                        <li class="nav-item"><a class="nav-link active" id="pills-darkhome-tab" data-bs-toggle="pill" href="#pills-darkhome" role="tab" aria-controls="pills-darkhome" aria-selected="true"><i class="icofont icofont-ui-home"></i>ডাক</a></li>
                    </ul>
                    <div class="tab-content" id="pills-darktabContent">
                        <div class="tab-pane fade show active" id="pills-darkhome" role="tabpanel" aria-labelledby="pills-darkhome-tab">
                            <div class="table-responsive product-table mb-0 m-t-30">
                                <table class="display" id="basic-1">
                                    <tbody>

                                        @foreach($all_data_for_new_list as $i=>$allStatusData)

                                        <?php

                                        //new code
$orginalReceverId= DB::table('ngo_registration_daks')
                ->where('registration_status_id',$allStatusData->id)
                ->where('original_recipient',1)
                ->value('receiver_admin_id');

                $orginalReceverName= DB::table('admins')
                ->where('id',$orginalReceverId)
                ->value('admin_name_ban');

//end new code

                                     $form_one_data = DB::table('fd_one_forms')->where('id',$allStatusData->fd_one_form_id)->first();

                                     $decesionNameId = DB::table('ngo_registration_daks')
                        ->where('registration_status_id',$allStatusData->id)->value('dak_detail_id');

                                     $decesionName = DB::table('dak_details')
                        ->where('id',$decesionNameId)->where('status','registration')->value('decision_list');

                                        ?>
                                    <tr>
                                        <td style="text-align:left;">
                                            উৎসঃ {{ $form_one_data->organization_name_ban }} <br>
                                            প্রেরকঃ {{ $form_one_data->organization_name_ban }}<span class="p-4"><i class="fa fa-user"></i>
                                            মূল-প্রাপক : {{ $orginalReceverName }}</span>  <br>
                                            বিষয়ঃ <b> এনজিও নিবন্ধন</b><br>
                                            @if(empty($decesionName))

                                            @else
                                            সিদ্ধান্ত: <span style="color:blue;">{{ $decesionName }}। </span><br>
                                            @endif
                                            তারিখ:<b>{{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-F-y', strtotime($allStatusData->created_at))) }} </b>
                                        </td>
                                        <td style="text-align:right;">

                                            <button class="btn btn-primary btn-xs" type="button" data-original-title="btn btn-danger btn-xs" title="" onclick="location.href = '{{ route('registrationView',$allStatusData->fd_one_form_id) }}';">দেখুন</button>


                                                         <!--new code-->
                             <button type="button" class="btn btn-primary btn-xs"
                             data-bs-toggle="modal"
                             data-original-title="" data-bs-target="#myModalreg{{ $i }}">
                             ডাক গতিবিধি
                     </button>


                     <!-- Modal -->
                     <div class="modal right fade bd-example-modal-lg"
                     id="myModalreg{{ $i }}" tabindex="-1" role="dialog"
                     aria-labelledby="myModalLabel2">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel2">
                                    ডাক গতিবিধি</h4>
                            </div>

                            <div class="modal-body">

                                <?php

$dakDetail = DB::table('dak_details')
->where('access_id',$allStatusData->id)->orderBy('id','desc')->first();







                                    ?>

                                    @if(!$dakDetail)

                                    @else

                                    <?php

$mainDetail = DB::table('ngo_registration_daks')->where('registration_status_id',$allStatusData->id)
->orderBy('id','asc')->get();

                                    ?>

@foreach($mainDetail as  $key=>$allMainDetail)


<?php



$senderName = DB::table('admins')
->where('id',$allMainDetail->sender_admin_id)
->orderBy('id','desc')->value('admin_name_ban');


$senderImage = DB::table('admins')
->where('id',$allMainDetail->sender_admin_id)
->orderBy('id','desc')->value('admin_image');


$desiId = DB::table('admins')
->where('id',$allMainDetail->sender_admin_id)
->orderBy('id','desc')->value('designation_list_id');


$branchId = DB::table('admins')
->where('id',$allMainDetail->sender_admin_id)
->orderBy('id','desc')->value('branch_id');


$desiName = DB::table('designation_lists')
       ->where('id',$desiId)->value('designation_name');


       $branchName = DB::table('branches')
       ->where('id',$branchId)->value('branch_name');


       //receiver

       $receiverName = DB::table('admins')
->where('id',$allMainDetail->receiver_admin_id)
->orderBy('id','desc')->value('admin_name_ban');


$receiverImage = DB::table('admins')
->where('id',$allMainDetail->receiver_admin_id)
->orderBy('id','desc')->value('admin_image');


$desiIds = DB::table('admins')
->where('id',$allMainDetail->receiver_admin_id)
->orderBy('id','desc')->value('designation_list_id');


$branchIds = DB::table('admins')
->where('id',$allMainDetail->receiver_admin_id)
->orderBy('id','desc')->value('branch_id');


$desiNames = DB::table('designation_lists')
       ->where('id',$desiIds)->value('designation_name');


       $branchNames = DB::table('branches')
       ->where('id',$branchIds)->value('branch_name');



?>

                                <div class="d-flex mb-2">
                                    <div class="flex-shrink-0 tracking_img">

                                        @if($key == 0)

                                        @if(empty($senderImage))

                                        <img src="{{ asset('/') }}public/admin/user.png" class="rounded-circle" alt="Sample Image">
                                        @else

                                        <img src="{{ asset('/') }}{{ $senderImage }}" class="rounded-circle" alt="Sample Image">
@endif
                                        @else

                                        @if(empty($receiverImage))
                                        <img src="{{ asset('/') }}public/admin/user.png" class="rounded-circle" alt="Sample Image">

                                        @else

                                        <img src="{{ asset('/') }}{{ $receiverImage }}" class="rounded-circle" alt="Sample Image">
@endif

                                        @endif
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="card" style="border:2px solid #979797">
                                            <div class="card-body">
                                                <div class="tracking_box">
                                                    <h5>বিষয়ঃ এনজিও নিবন্ধন</h5>
                                                    @if(!$dakDetail->main_file)

                                                    @else


                                                    <a target="_blank" href="{{ route('main_doc_download',['id'=>$dakDetail->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন  </a>
                                                     @endif





                                                    <hr>
                                                    <ul>
                                                        <li>প্রেরক : {{ $senderName }}</li>
                                                        <li>প্রাপক : {{ $receiverName }}</li>
                                                    </ul>
                                                    <hr>
                            <p>তারিখ : {{  App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-m-Y h:i:s', strtotime(\Carbon\Carbon::parse($allMainDetail->created_at)))).' '.$allMainDetail->amPmValue }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @endforeach

                                @endif



                            </div><!-- modal-content -->
                        </div><!-- modal-dialog -->
                    </div><!-- modal -->
                             <!--end new code -->







                                        </td>
                                    </tr>
                                    @endforeach

                                    @foreach($all_data_for_renew_list as $r=>$allStatusData)

                                    <?php

                         //new code
$orginalReceverId= DB::table('ngo_renew_daks')
                ->where('renew_status_id',$allStatusData->id)
                ->where('original_recipient',1)
                ->value('receiver_admin_id');

                $orginalReceverName= DB::table('admins')
                ->where('id',$orginalReceverId)
                ->value('admin_name_ban');

//end new code

                                 $form_one_data = DB::table('fd_one_forms')->where('id',$allStatusData->fd_one_form_id)->first();

                                 $decesionNameId = DB::table('ngo_renew_daks')
                    ->where('renew_status_id',$allStatusData->id)->value('dak_detail_id');

                                 $decesionName = DB::table('dak_details')
                    ->where('id',$decesionNameId)->where('status','renew')->value('decision_list');

                                    ?>
                                <tr>
                                    <td style="text-align:left;">
                                        উৎসঃ {{ $form_one_data->organization_name_ban }} <br>
                                        প্রেরকঃ {{ $form_one_data->organization_name_ban }}<span class="p-4"><i class="fa fa-user"></i>
                                        মূল-প্রাপক : {{ $orginalReceverName }}</span>  <br>
                                        বিষয়ঃ <b> এনজিও নবায়ন</b><br>
                                        @if(empty($decesionName))

    @else
    সিদ্ধান্ত: <span style="color:blue;">{{ $decesionName }}। </span><br>
    @endif
                                        তারিখ:<b>{{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-F-y', strtotime($allStatusData->created_at))) }} </b>
                                    </td>
                                    <td style="text-align:right;">

                                        <button class="btn btn-primary btn-xs" type="button" data-original-title="btn btn-danger btn-xs" title="" onclick="location.href = '{{ route('renewView',$allStatusData->id) }}';">দেখুন</button>




                                       <!--new code-->
                             <button type="button" class="btn btn-primary btn-xs"
                             data-bs-toggle="modal"
                             data-original-title="" data-bs-target="#myModalrenew{{ $r }}">
                             ডাক গতিবিধি
                     </button>


                     <!-- Modal -->
                     <div class="modal right fade bd-example-modal-lg"
                     id="myModalrenew{{ $r }}" tabindex="-1" role="dialog"
                     aria-labelledby="myModalLabel2">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel2">
                                    ডাক গতিবিধি</h4>
                            </div>

                            <div class="modal-body">

                                <?php

$dakDetail = DB::table('dak_details')
->where('access_id',$allStatusData->id)->orderBy('id','desc')->first();







                                    ?>

                                    @if(!$dakDetail)

                                    @else

                                    <?php

$mainDetail = DB::table('ngo_renew_daks')
->where('renew_status_id',$allStatusData->id)->orderBy('id','asc')->get();
//dd($mainDetail);
                                    ?>

@foreach($mainDetail as  $key=>$allMainDetail)


<?php



$senderName = DB::table('admins')
->where('id',$allMainDetail->sender_admin_id)
->orderBy('id','desc')->value('admin_name_ban');


$senderImage = DB::table('admins')
->where('id',$allMainDetail->sender_admin_id)
->orderBy('id','desc')->value('admin_image');


$desiId = DB::table('admins')
->where('id',$allMainDetail->sender_admin_id)
->orderBy('id','desc')->value('designation_list_id');


$branchId = DB::table('admins')
->where('id',$allMainDetail->sender_admin_id)
->orderBy('id','desc')->value('branch_id');


$desiName = DB::table('designation_lists')
       ->where('id',$desiId)->value('designation_name');


       $branchName = DB::table('branches')
       ->where('id',$branchId)->value('branch_name');


       //receiver

       $receiverName = DB::table('admins')
->where('id',$allMainDetail->receiver_admin_id)
->orderBy('id','desc')->value('admin_name_ban');


$receiverImage = DB::table('admins')
->where('id',$allMainDetail->receiver_admin_id)
->orderBy('id','desc')->value('admin_image');


$desiIds = DB::table('admins')
->where('id',$allMainDetail->receiver_admin_id)
->orderBy('id','desc')->value('designation_list_id');


$branchIds = DB::table('admins')
->where('id',$allMainDetail->receiver_admin_id)
->orderBy('id','desc')->value('branch_id');


$desiNames = DB::table('designation_lists')
       ->where('id',$desiIds)->value('designation_name');


       $branchNames = DB::table('branches')
       ->where('id',$branchIds)->value('branch_name');



?>

                                <div class="d-flex mb-2">
                                    <div class="flex-shrink-0 tracking_img">

                                        @if($key == 0)

                                        @if(empty($senderImage))

                                        <img src="{{ asset('/') }}public/admin/user.png" class="rounded-circle" alt="Sample Image">
                                        @else

                                        <img src="{{ asset('/') }}{{ $senderImage }}" class="rounded-circle" alt="Sample Image">
@endif
                                        @else

                                        @if(empty($receiverImage))
                                        <img src="{{ asset('/') }}public/admin/user.png" class="rounded-circle" alt="Sample Image">

                                        @else

                                        <img src="{{ asset('/') }}{{ $receiverImage }}" class="rounded-circle" alt="Sample Image">
@endif

                                        @endif
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="card" style="border:2px solid #979797">
                                            <div class="card-body">
                                                <div class="tracking_box">
                                                    <h5>বিষয়ঃ এনজিও নবায়ন</h5>
                                                    @if(!$dakDetail->main_file)

                                                    @else


                                                    <a target="_blank" href="{{ route('main_doc_download',['id'=>$dakDetail->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন  </a>
                                                     @endif





                                                    <hr>
                                                    <ul>
                                                        <li>প্রেরক : {{ $senderName }}</li>
                                                        <li>প্রাপক : {{ $receiverName }}</li>
                                                    </ul>
                                                    <hr>
                                                                                                       <p>তারিখ : {{  App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-m-Y h:i:s', strtotime(\Carbon\Carbon::parse($allMainDetail->created_at)))).' '.$allMainDetail->amPmValue }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @endforeach

                                @endif



                            </div><!-- modal-content -->
                        </div><!-- modal-dialog -->
                    </div><!-- modal -->
                             <!--end new code -->

                                    </td>
                                </tr>
                                @endforeach


                                @foreach($all_data_for_name_changes_list as $k=>$allStatusData)

                                <?php

                                                                     //new code
$orginalReceverId= DB::table('ngo_name_change_daks')
                ->where('name_change_status_id',$allStatusData->id)
                ->where('original_recipient',1)
                ->value('receiver_admin_id');

                $orginalReceverName= DB::table('admins')
                ->where('id',$orginalReceverId)
                ->value('admin_name_ban');

//end new code

                             $form_one_data = DB::table('fd_one_forms')->where('id',$allStatusData->fd_one_form_id)->first();

                             $decesionNameId = DB::table('ngo_name_change_daks')
                ->where('name_change_status_id',$allStatusData->id)->value('dak_detail_id');

                             $decesionName = DB::table('dak_details')
                ->where('id',$decesionNameId)->where('status','nameChange')->value('decision_list');

                                ?>
                            <tr>
                                <td style="text-align:left;">
                                    উৎসঃ {{ $form_one_data->organization_name_ban }} <br>
                                    প্রেরকঃ {{ $form_one_data->organization_name_ban }}<span class="p-4"><i class="fa fa-user"></i>
                                    মূল-প্রাপক : {{ $orginalReceverName }}</span>  <br>
                                    বিষয়ঃ <b> এনজিও'র নাম পরিবর্তনের   </b><br>
                                    @if(empty($decesionName))

                                    @else
                                    সিদ্ধান্ত: <span style="color:blue;">{{ $decesionName }}। </span><br>
                                    @endif
                                    তারিখ:<b>{{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-F-y', strtotime($allStatusData->created_at))) }} </b>
                                </td>
                                <td style="text-align:right;">

                                    <button class="btn btn-primary btn-xs" type="button" data-original-title="btn btn-danger btn-xs" title="" onclick="location.href = '{{ route('nameChangeView',$allStatusData->id) }}';">দেখুন</button>



                                       <!--new code-->
                             <button type="button" class="btn btn-primary btn-xs"
                             data-bs-toggle="modal"
                             data-original-title="" data-bs-target="#myModalnameChange{{ $k }}">
                             ডাক গতিবিধি
                     </button>


                     <!-- Modal -->
                     <div class="modal right fade bd-example-modal-lg"
                     id="myModalnameChange{{ $k }}" tabindex="-1" role="dialog"
                     aria-labelledby="myModalLabel2">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel2">
                                    ডাক গতিবিধি</h4>
                            </div>

                            <div class="modal-body">

                                <?php

$dakDetail = DB::table('dak_details')
->where('access_id',$allStatusData->id)->orderBy('id','desc')->first();







                                    ?>

                                    @if(!$dakDetail)

                                    @else

                                    <?php

$mainDetail = DB::table('ngo_name_change_daks')
->where('name_change_status_id',$allStatusData->id)->orderBy('id','asc')->get();

                                    ?>

@foreach($mainDetail as  $key=>$allMainDetail)


<?php



$senderName = DB::table('admins')
->where('id',$allMainDetail->sender_admin_id)
->orderBy('id','desc')->value('admin_name_ban');


$senderImage = DB::table('admins')
->where('id',$allMainDetail->sender_admin_id)
->orderBy('id','desc')->value('admin_image');


$desiId = DB::table('admins')
->where('id',$allMainDetail->sender_admin_id)
->orderBy('id','desc')->value('designation_list_id');


$branchId = DB::table('admins')
->where('id',$allMainDetail->sender_admin_id)
->orderBy('id','desc')->value('branch_id');


$desiName = DB::table('designation_lists')
       ->where('id',$desiId)->value('designation_name');


       $branchName = DB::table('branches')
       ->where('id',$branchId)->value('branch_name');


       //receiver

       $receiverName = DB::table('admins')
->where('id',$allMainDetail->receiver_admin_id)
->orderBy('id','desc')->value('admin_name_ban');


$receiverImage = DB::table('admins')
->where('id',$allMainDetail->receiver_admin_id)
->orderBy('id','desc')->value('admin_image');


$desiIds = DB::table('admins')
->where('id',$allMainDetail->receiver_admin_id)
->orderBy('id','desc')->value('designation_list_id');


$branchIds = DB::table('admins')
->where('id',$allMainDetail->receiver_admin_id)
->orderBy('id','desc')->value('branch_id');


$desiNames = DB::table('designation_lists')
       ->where('id',$desiIds)->value('designation_name');


       $branchNames = DB::table('branches')
       ->where('id',$branchIds)->value('branch_name');



?>

                                <div class="d-flex mb-2">
                                    <div class="flex-shrink-0 tracking_img">

                                        @if($key == 0)

                                        @if(empty($senderImage))

                                        <img src="{{ asset('/') }}public/admin/user.png" class="rounded-circle" alt="Sample Image">
                                        @else

                                        <img src="{{ asset('/') }}{{ $senderImage }}" class="rounded-circle" alt="Sample Image">
@endif
                                        @else

                                        @if(empty($receiverImage))
                                        <img src="{{ asset('/') }}public/admin/user.png" class="rounded-circle" alt="Sample Image">

                                        @else

                                        <img src="{{ asset('/') }}{{ $receiverImage }}" class="rounded-circle" alt="Sample Image">
@endif

                                        @endif
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="card" style="border:2px solid #979797">
                                            <div class="card-body">
                                                <div class="tracking_box">
                                                    <h5>বিষয়ঃ এনজিও'র নাম পরিবর্তনের    </h5>
                                                    @if(!$dakDetail->main_file)

                                                    @else


                                                    <a target="_blank" href="{{ route('main_doc_download',['id'=>$dakDetail->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন  </a>
                                                     @endif





                                                    <hr>
                                                    <ul>
                                                        <li>প্রেরক : {{ $senderName }}</li>
                                                        <li>প্রাপক : {{ $receiverName }}</li>
                                                    </ul>
                                                    <hr>
                                                                                                       <p>তারিখ : {{  App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-m-Y h:i:s', strtotime(\Carbon\Carbon::parse($allMainDetail->created_at)))).' '.$allMainDetail->amPmValue }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @endforeach

                                @endif



                            </div><!-- modal-content -->
                        </div><!-- modal-dialog -->
                    </div><!-- modal -->
                             <!--end new code -->


                                </td>
                            </tr>
                            @endforeach


                            @foreach($dataFdNine as $m=>$allStatusData)

                            <?php
                                                                                       //new code
$orginalReceverId= DB::table('ngo_f_d_nine_daks')
                ->where('f_d_nine_status_id',$allStatusData->id)
                ->where('original_recipient',1)
                ->value('receiver_admin_id');

                $orginalReceverName= DB::table('admins')
                ->where('id',$orginalReceverId)
                ->value('admin_name_ban');

//end new code

                         $form_one_data = DB::table('fd_one_forms')->where('id',$allStatusData->fd_one_form_id)->first();

                         $decesionNameId = DB::table('ngo_f_d_nine_daks')
            ->where('f_d_nine_status_id',$allStatusData->id)->value('dak_detail_id');

                         $decesionName = DB::table('dak_details')
            ->where('id',$decesionNameId)->where('status','fdNine')->value('decision_list');

                            ?>
                        <tr>
                            <td style="text-align:left;">
                                উৎসঃ {{ $form_one_data->organization_name_ban }} <br>
                                প্রেরকঃ {{ $form_one_data->organization_name_ban }}<span class="p-4"><i class="fa fa-user"></i>
                                মূল-প্রাপক : {{ $orginalReceverName }}</span>  <br>
                                বিষয়ঃ <b> এফডি৯ (এন-ভিসা)   </b><br>
                                @if(empty($decesionName))

                                @else
                                সিদ্ধান্ত: <span style="color:blue;">{{ $decesionName }}। </span><br>
                                @endif
                                তারিখ:<b>{{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-F-y', strtotime($allStatusData->created_at))) }} </b>
                            </td>
                            <td style="text-align:right;">

                                <button class="btn btn-primary btn-xs" type="button" data-original-title="btn btn-danger btn-xs" title="" onclick="location.href = '{{ route('fd9Form.show',$allStatusData->id) }}';">দেখুন</button>


                                 <!--new code-->
                             <button type="button" class="btn btn-primary btn-xs"
                             data-bs-toggle="modal"
                             data-original-title="" data-bs-target="#myModalfd9{{ $m }}">
                             ডাক গতিবিধি
                     </button>


                     <!-- Modal -->
                     <div class="modal right fade bd-example-modal-lg"
                     id="myModalfd9{{ $m }}" tabindex="-1" role="dialog"
                     aria-labelledby="myModalLabel2">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel2">
                                    ডাক গতিবিধি</h4>
                            </div>

                            <div class="modal-body">

                                <?php

$dakDetail = DB::table('dak_details')
->where('access_id',$allStatusData->id)->orderBy('id','desc')->first();







                                    ?>

                                    @if(!$dakDetail)

                                    @else

                                    <?php

$mainDetail = DB::table('ngo_f_d_nine_daks')
->where('f_d_nine_status_id',$allStatusData->id)->orderBy('id','asc')->get();

                                    ?>

@foreach($mainDetail as  $key=>$allMainDetail)


<?php



$senderName = DB::table('admins')
->where('id',$allMainDetail->sender_admin_id)
->orderBy('id','desc')->value('admin_name_ban');


$senderImage = DB::table('admins')
->where('id',$allMainDetail->sender_admin_id)
->orderBy('id','desc')->value('admin_image');


$desiId = DB::table('admins')
->where('id',$allMainDetail->sender_admin_id)
->orderBy('id','desc')->value('designation_list_id');


$branchId = DB::table('admins')
->where('id',$allMainDetail->sender_admin_id)
->orderBy('id','desc')->value('branch_id');


$desiName = DB::table('designation_lists')
       ->where('id',$desiId)->value('designation_name');


       $branchName = DB::table('branches')
       ->where('id',$branchId)->value('branch_name');


       //receiver

       $receiverName = DB::table('admins')
->where('id',$allMainDetail->receiver_admin_id)
->orderBy('id','desc')->value('admin_name_ban');


$receiverImage = DB::table('admins')
->where('id',$allMainDetail->receiver_admin_id)
->orderBy('id','desc')->value('admin_image');


$desiIds = DB::table('admins')
->where('id',$allMainDetail->receiver_admin_id)
->orderBy('id','desc')->value('designation_list_id');


$branchIds = DB::table('admins')
->where('id',$allMainDetail->receiver_admin_id)
->orderBy('id','desc')->value('branch_id');


$desiNames = DB::table('designation_lists')
       ->where('id',$desiIds)->value('designation_name');


       $branchNames = DB::table('branches')
       ->where('id',$branchIds)->value('branch_name');



?>

                                <div class="d-flex mb-2">
                                    <div class="flex-shrink-0 tracking_img">

                                        @if($key == 0)

                                        @if(empty($senderImage))

                                        <img src="{{ asset('/') }}public/admin/user.png" class="rounded-circle" alt="Sample Image">
                                        @else

                                        <img src="{{ asset('/') }}{{ $senderImage }}" class="rounded-circle" alt="Sample Image">
@endif
                                        @else

                                        @if(empty($receiverImage))
                                        <img src="{{ asset('/') }}public/admin/user.png" class="rounded-circle" alt="Sample Image">

                                        @else

                                        <img src="{{ asset('/') }}{{ $receiverImage }}" class="rounded-circle" alt="Sample Image">
@endif

                                        @endif
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="card" style="border:2px solid #979797">
                                            <div class="card-body">
                                                <div class="tracking_box">
                                                    <h5>বিষয়ঃ এফডি৯ (এন-ভিসা)   </h5>
                                                    @if(!$dakDetail->main_file)

                                                    @else


                                                    <a target="_blank" href="{{ route('main_doc_download',['id'=>$dakDetail->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন  </a>
                                                     @endif





                                                    <hr>
                                                    <ul>
                                                        <li>প্রেরক : {{ $senderName }}</li>
                                                        <li>প্রাপক : {{ $receiverName }}</li>
                                                    </ul>
                                                    <hr>
                                                                                                       <p>তারিখ : {{  App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-m-Y h:i:s', strtotime(\Carbon\Carbon::parse($allMainDetail->created_at)))).' '.$allMainDetail->amPmValue }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @endforeach

                                @endif



                            </div><!-- modal-content -->
                        </div><!-- modal-dialog -->
                    </div><!-- modal -->
                             <!--end new code -->
                            </td>
                        </tr>
                        @endforeach


                        @foreach($dataFdNineOne as $f=>$allStatusData)

                        <?php


                                                                                           //new code
$orginalReceverId= DB::table('ngo_f_d_nine_one_daks')
                ->where('f_d_nine_one_status_id',$allStatusData->fd9_one_form_id)
                ->where('original_recipient',1)
                ->value('receiver_admin_id');

                $orginalReceverName= DB::table('admins')
                ->where('id',$orginalReceverId)
                ->value('admin_name_ban');

//end new code

                     $form_one_data = DB::table('fd_one_forms')
                     ->where('id',$allStatusData->fd_one_form_id)->first();

                     $decesionNameId = DB::table('ngo_f_d_nine_one_daks')
        ->where('f_d_nine_one_status_id',$allStatusData->fd9_one_form_id)->value('dak_detail_id');

                     $decesionName = DB::table('dak_details')
        ->where('id',$decesionNameId)
        ->where('status','fdNineOne')->value('decision_list');

                        ?>
                    <tr>
                        <td style="text-align:left;">
                            উৎসঃ {{ $form_one_data->organization_name_ban }} <br>
                            প্রেরকঃ {{ $form_one_data->organization_name_ban }}<span class="p-4"><i class="fa fa-user"></i>
                            মূল-প্রাপক : {{ $orginalReceverName }}</span>  <br>
                            বিষয়ঃ <b> এফডি৯.১ (ওয়ার্ক পারমিট)   </b><br>
                            @if(empty($decesionName))

                            @else
                            সিদ্ধান্ত: <span style="color:blue;">{{ $decesionName }}। </span><br>
                            @endif
                            তারিখ:<b>{{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-F-y', strtotime($allStatusData->created_at))) }} </b>
                        </td>
                        <td style="text-align:right;">

                            <button class="btn btn-primary btn-xs" type="button" data-original-title="btn btn-danger btn-xs" title="" onclick="location.href = '{{ route('fd9OneForm.show',$allStatusData->fd9_one_form_id) }}';">দেখুন</button>



                             <!--new code-->
                             <button type="button" class="btn btn-primary btn-xs"
                             data-bs-toggle="modal"
                             data-original-title="" data-bs-target="#myModalfd9one{{ $f }}">
                             ডাক গতিবিধি
                     </button>


                     <!-- Modal -->
                     <div class="modal right fade bd-example-modal-lg"
                     id="myModalfd9one{{ $f }}" tabindex="-1" role="dialog"
                     aria-labelledby="myModalLabel2">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel2">
                                    ডাক গতিবিধি</h4>
                            </div>

                            <div class="modal-body">

                                <?php

$dakDetail = DB::table('dak_details')
->where('access_id',$allStatusData->fd9_one_form_id)->orderBy('id','desc')->first();







                                    ?>

                                    @if(!$dakDetail)

                                    @else

                                    <?php

$mainDetail = DB::table('ngo_f_d_nine_one_daks')
->where('f_d_nine_one_status_id',$allStatusData->fd9_one_form_id)->orderBy('id','asc')->get();


//dd($allStatusData->id);

                                    ?>

@foreach($mainDetail as  $key=>$allMainDetail)


<?php



$senderName = DB::table('admins')
->where('id',$allMainDetail->sender_admin_id)
->orderBy('id','desc')->value('admin_name_ban');


$senderImage = DB::table('admins')
->where('id',$allMainDetail->sender_admin_id)
->orderBy('id','desc')->value('admin_image');


$desiId = DB::table('admins')
->where('id',$allMainDetail->sender_admin_id)
->orderBy('id','desc')->value('designation_list_id');


$branchId = DB::table('admins')
->where('id',$allMainDetail->sender_admin_id)
->orderBy('id','desc')->value('branch_id');


$desiName = DB::table('designation_lists')
       ->where('id',$desiId)->value('designation_name');


       $branchName = DB::table('branches')
       ->where('id',$branchId)->value('branch_name');


       //receiver

       $receiverName = DB::table('admins')
->where('id',$allMainDetail->receiver_admin_id)
->orderBy('id','desc')->value('admin_name_ban');


$receiverImage = DB::table('admins')
->where('id',$allMainDetail->receiver_admin_id)
->orderBy('id','desc')->value('admin_image');


$desiIds = DB::table('admins')
->where('id',$allMainDetail->receiver_admin_id)
->orderBy('id','desc')->value('designation_list_id');


$branchIds = DB::table('admins')
->where('id',$allMainDetail->receiver_admin_id)
->orderBy('id','desc')->value('branch_id');


$desiNames = DB::table('designation_lists')
       ->where('id',$desiIds)->value('designation_name');


       $branchNames = DB::table('branches')
       ->where('id',$branchIds)->value('branch_name');



?>

                                <div class="d-flex mb-2">
                                    <div class="flex-shrink-0 tracking_img">

                                        @if($key == 0)

                                        @if(empty($senderImage))

                                        <img src="{{ asset('/') }}public/admin/user.png" class="rounded-circle" alt="Sample Image">
                                        @else

                                        <img src="{{ asset('/') }}{{ $senderImage }}" class="rounded-circle" alt="Sample Image">
@endif
                                        @else

                                        @if(empty($receiverImage))
                                        <img src="{{ asset('/') }}public/admin/user.png" class="rounded-circle" alt="Sample Image">

                                        @else

                                        <img src="{{ asset('/') }}{{ $receiverImage }}" class="rounded-circle" alt="Sample Image">
@endif

                                        @endif
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="card" style="border:2px solid #979797">
                                            <div class="card-body">
                                                <div class="tracking_box">
                                                    <h5>বিষয়ঃ এফডি৯.১ (ওয়ার্ক পারমিট)   </h5>
                                                    @if(!$dakDetail->main_file)

                                                    @else


                                                    <a target="_blank" href="{{ route('main_doc_download',['id'=>$dakDetail->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন  </a>
                                                     @endif





                                                    <hr>
                                                    <ul>
                                                        <li>প্রেরক : {{ $senderName }}</li>
                                                        <li>প্রাপক : {{ $receiverName }}</li>
                                                    </ul>
                                                    <hr>
                                                                                                       <p>তারিখ : {{  App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-m-Y h:i:s', strtotime(\Carbon\Carbon::parse($allMainDetail->created_at)))).' '.$allMainDetail->amPmValue }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @endforeach

                                @endif



                            </div><!-- modal-content -->
                        </div><!-- modal-dialog -->
                    </div><!-- modal -->
                             <!--end new code -->
                        </td>
                    </tr>
                    @endforeach




                    <!--fd six form start--->


                    @foreach($dataFromFd6Form as $p=>$allStatusData)

                    <?php

                                                                                         //new code
$orginalReceverId= DB::table('ngo_fd_six_daks')
                ->where('fd_six_status_id',$allStatusData->id)
                ->where('original_recipient',1)
                ->value('receiver_admin_id');

                $orginalReceverName= DB::table('admins')
                ->where('id',$orginalReceverId)
                ->value('admin_name_ban');

//end new code

                 $form_one_data = DB::table('fd_one_forms')->where('id',$allStatusData->fd_one_form_id)->first();

                 $decesionNameId = DB::table('ngo_fd_six_daks')
    ->where('fd_six_status_id',$allStatusData->id)->value('dak_detail_id');

                 $decesionName = DB::table('dak_details')
    ->where('id',$decesionNameId)->where('status','fdSix')->value('decision_list');

                    ?>
                <tr>
                    <td style="text-align:left;">
                        উৎসঃ {{ $form_one_data->organization_name_ban }} <br>
                        প্রেরকঃ {{ $form_one_data->organization_name_ban }}<span class="p-4"><i class="fa fa-user"></i>
                        মূল-প্রাপক : {{ $orginalReceverName }}</span>  <br>
                        বিষয়ঃ <b> এফডি - ৬   </b><br>
                        @if(empty($decesionName))

                        @else
                        সিদ্ধান্ত: <span style="color:blue;">{{ $decesionName }}। </span><br>
                        @endif
                        তারিখ:<b>{{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-F-y', strtotime($allStatusData->created_at))) }} </b>
                    </td>
                    <td style="text-align:right;">

                        <button class="btn btn-primary btn-xs" type="button" data-original-title="btn btn-danger btn-xs" title="" onclick="location.href = '{{ route('fd6Form.show',$allStatusData->mainId) }}';">দেখুন</button>


                         <!--new code-->
                     <button type="button" class="btn btn-primary btn-xs"
                     data-bs-toggle="modal"
                     data-original-title="" data-bs-target="#myModalfd6{{ $p }}">
                     ডাক গতিবিধি
             </button>


             <!-- Modal -->
             <div class="modal right fade bd-example-modal-lg"
             id="myModalfd6{{ $p }}" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel2">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel2">
                            ডাক গতিবিধি</h4>
                    </div>

                    <div class="modal-body">

                        <?php

$dakDetail = DB::table('dak_details')
->where('access_id',$allStatusData->mainId)->orderBy('id','desc')->first();







                            ?>

                            @if(!$dakDetail)

                            @else

                            <?php

$mainDetail = DB::table('ngo_fd_six_daks')
->where('fd_six_status_id',$allStatusData->mainId)->orderBy('id','asc')->get();

                            ?>

@foreach($mainDetail as  $key=>$allMainDetail)


<?php



$senderName = DB::table('admins')
->where('id',$allMainDetail->sender_admin_id)
->orderBy('id','desc')->value('admin_name_ban');


$senderImage = DB::table('admins')
->where('id',$allMainDetail->sender_admin_id)
->orderBy('id','desc')->value('admin_image');


$desiId = DB::table('admins')
->where('id',$allMainDetail->sender_admin_id)
->orderBy('id','desc')->value('designation_list_id');


$branchId = DB::table('admins')
->where('id',$allMainDetail->sender_admin_id)
->orderBy('id','desc')->value('branch_id');


$desiName = DB::table('designation_lists')
->where('id',$desiId)->value('designation_name');


$branchName = DB::table('branches')
->where('id',$branchId)->value('branch_name');


//receiver

$receiverName = DB::table('admins')
->where('id',$allMainDetail->receiver_admin_id)
->orderBy('id','desc')->value('admin_name_ban');


$receiverImage = DB::table('admins')
->where('id',$allMainDetail->receiver_admin_id)
->orderBy('id','desc')->value('admin_image');


$desiIds = DB::table('admins')
->where('id',$allMainDetail->receiver_admin_id)
->orderBy('id','desc')->value('designation_list_id');


$branchIds = DB::table('admins')
->where('id',$allMainDetail->receiver_admin_id)
->orderBy('id','desc')->value('branch_id');


$desiNames = DB::table('designation_lists')
->where('id',$desiIds)->value('designation_name');


$branchNames = DB::table('branches')
->where('id',$branchIds)->value('branch_name');



?>

                        <div class="d-flex mb-2">
                            <div class="flex-shrink-0 tracking_img">

                                @if($key == 0)

                                @if(empty($senderImage))

                                <img src="{{ asset('/') }}public/admin/user.png" class="rounded-circle" alt="Sample Image">
                                @else

                                <img src="{{ asset('/') }}{{ $senderImage }}" class="rounded-circle" alt="Sample Image">
@endif
                                @else

                                @if(empty($receiverImage))
                                <img src="{{ asset('/') }}public/admin/user.png" class="rounded-circle" alt="Sample Image">

                                @else

                                <img src="{{ asset('/') }}{{ $receiverImage }}" class="rounded-circle" alt="Sample Image">
@endif

                                @endif
                            </div>
                            <div class="flex-grow-1">
                                <div class="card" style="border:2px solid #979797">
                                    <div class="card-body">
                                        <div class="tracking_box">
                                            <h5>বিষয়ঃ এফডি - ৬   </h5>
                                            @if(!$dakDetail->main_file)

                                            @else


                                            <a target="_blank" href="{{ route('main_doc_download',['id'=>$dakDetail->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন  </a>
                                             @endif





                                            <hr>
                                            <ul>
                                                <li>প্রেরক : {{ $senderName }}</li>
                                                <li>প্রাপক : {{ $receiverName }}</li>
                                            </ul>
                                            <hr>
                                                                                               <p>তারিখ : {{  App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-m-Y h:i:s', strtotime(\Carbon\Carbon::parse($allMainDetail->created_at)))).' '.$allMainDetail->amPmValue }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @endforeach

                        @endif



                    </div><!-- modal-content -->
                </div><!-- modal-dialog -->
            </div><!-- modal -->
                     <!--end new code -->
                    </td>
                </tr>
                @endforeach


                    <!-- fd six form end-->

                    <!--fd seven form start--->


                    @foreach($dataFromFd7Form as $ps=>$allStatusData)

                    <?php

                                                                                           //new code
$orginalReceverId= DB::table('ngo_fd_seven_daks')
                ->where('fd_seven_status_id',$allStatusData->id)
                ->where('original_recipient',1)
                ->value('receiver_admin_id');

                $orginalReceverName= DB::table('admins')
                ->where('id',$orginalReceverId)
                ->value('admin_name_ban');

//end new code

                 $form_one_data = DB::table('fd_one_forms')->where('id',$allStatusData->fd_one_form_id)->first();

                 $decesionNameId = DB::table('ngo_fd_seven_daks')
    ->where('fd_seven_status_id',$allStatusData->id)->value('dak_detail_id');

                 $decesionName = DB::table('dak_details')
    ->where('id',$decesionNameId)->where('status','fdSeven')->value('decision_list');

                    ?>
                <tr>
                    <td style="text-align:left;">
                        উৎসঃ {{ $form_one_data->organization_name_ban }} <br>
                        প্রেরকঃ {{ $form_one_data->organization_name_ban }}<span class="p-4"><i class="fa fa-user"></i>
                        মূল-প্রাপক : {{ $orginalReceverName }}</span>  <br>
                        বিষয়ঃ <b> এফডি - ৭   </b><br>
                        @if(empty($decesionName))

                        @else
                        সিদ্ধান্ত: <span style="color:blue;">{{ $decesionName }}। </span><br>
                        @endif
                        তারিখ:<b>{{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-F-y', strtotime($allStatusData->created_at))) }} </b>
                    </td>
                    <td style="text-align:right;">

                        <button class="btn btn-primary btn-xs" type="button" data-original-title="btn btn-danger btn-xs" title="" onclick="location.href = '{{ route('fd7Form.show',$allStatusData->mainId) }}';">দেখুন</button>


                         <!--new code-->
                     <button type="button" class="btn btn-primary btn-xs"
                     data-bs-toggle="modal"
                     data-original-title="" data-bs-target="#myModalfd7{{ $ps }}">
                     ডাক গতিবিধি
             </button>


             <!-- Modal -->
             <div class="modal right fade bd-example-modal-lg"
             id="myModalfd7{{ $ps }}" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel2">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel2">
                            ডাক গতিবিধি</h4>
                    </div>

                    <div class="modal-body">

                        <?php

$dakDetail = DB::table('dak_details')
->where('access_id',$allStatusData->mainId)->orderBy('id','desc')->first();







                            ?>

                            @if(!$dakDetail)

                            @else

                            <?php

$mainDetail = DB::table('ngo_fd_seven_daks')
->where('fd_seven_status_id',$allStatusData->mainId)->orderBy('id','asc')->get();

                            ?>

@foreach($mainDetail as  $key=>$allMainDetail)


<?php



$senderName = DB::table('admins')
->where('id',$allMainDetail->sender_admin_id)
->orderBy('id','desc')->value('admin_name_ban');


$senderImage = DB::table('admins')
->where('id',$allMainDetail->sender_admin_id)
->orderBy('id','desc')->value('admin_image');


$desiId = DB::table('admins')
->where('id',$allMainDetail->sender_admin_id)
->orderBy('id','desc')->value('designation_list_id');


$branchId = DB::table('admins')
->where('id',$allMainDetail->sender_admin_id)
->orderBy('id','desc')->value('branch_id');


$desiName = DB::table('designation_lists')
->where('id',$desiId)->value('designation_name');


$branchName = DB::table('branches')
->where('id',$branchId)->value('branch_name');


//receiver

$receiverName = DB::table('admins')
->where('id',$allMainDetail->receiver_admin_id)
->orderBy('id','desc')->value('admin_name_ban');


$receiverImage = DB::table('admins')
->where('id',$allMainDetail->receiver_admin_id)
->orderBy('id','desc')->value('admin_image');


$desiIds = DB::table('admins')
->where('id',$allMainDetail->receiver_admin_id)
->orderBy('id','desc')->value('designation_list_id');


$branchIds = DB::table('admins')
->where('id',$allMainDetail->receiver_admin_id)
->orderBy('id','desc')->value('branch_id');


$desiNames = DB::table('designation_lists')
->where('id',$desiIds)->value('designation_name');


$branchNames = DB::table('branches')
->where('id',$branchIds)->value('branch_name');



?>

                        <div class="d-flex mb-2">
                            <div class="flex-shrink-0 tracking_img">

                                @if($key == 0)

                                @if(empty($senderImage))

                                <img src="{{ asset('/') }}public/admin/user.png" class="rounded-circle" alt="Sample Image">
                                @else

                                <img src="{{ asset('/') }}{{ $senderImage }}" class="rounded-circle" alt="Sample Image">
@endif
                                @else

                                @if(empty($receiverImage))
                                <img src="{{ asset('/') }}public/admin/user.png" class="rounded-circle" alt="Sample Image">

                                @else

                                <img src="{{ asset('/') }}{{ $receiverImage }}" class="rounded-circle" alt="Sample Image">
@endif

                                @endif
                            </div>
                            <div class="flex-grow-1">
                                <div class="card" style="border:2px solid #979797">
                                    <div class="card-body">
                                        <div class="tracking_box">
                                            <h5>বিষয়ঃ এফডি - ৭   </h5>
                                            @if(!$dakDetail->main_file)

                                            @else


                                            <a target="_blank" href="{{ route('main_doc_download',['id'=>$dakDetail->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন  </a>
                                             @endif





                                            <hr>
                                            <ul>
                                                <li>প্রেরক : {{ $senderName }}</li>
                                                <li>প্রাপক : {{ $receiverName }}</li>
                                            </ul>
                                            <hr>
                                                                                               <p>তারিখ : {{  App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-m-Y h:i:s', strtotime(\Carbon\Carbon::parse($allMainDetail->created_at)))).' '.$allMainDetail->amPmValue }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @endforeach

                        @endif



                    </div><!-- modal-content -->
                </div><!-- modal-dialog -->
            </div><!-- modal -->
                     <!--end new code -->
                    </td>
                </tr>
                @endforeach


                    <!--fd seven form end--->


                    <!-- fc one form start -->
                    @foreach($dataFromFc1Form as $ps=>$allStatusData)

                    <?php


                                                                                 //new code
                                                                                 $orginalReceverId= DB::table('fc_one_daks')
                ->where('fc_one_status_id',$allStatusData->id)
                ->where('original_recipient',1)
                ->value('receiver_admin_id');

                $orginalReceverName= DB::table('admins')
                ->where('id',$orginalReceverId)
                ->value('admin_name_ban');

//end new code

                 $form_one_data = DB::table('fd_one_forms')->where('id',$allStatusData->fd_one_form_id)->first();

                 $decesionNameId = DB::table('fc_one_daks')
    ->where('fc_one_status_id',$allStatusData->id)->value('dak_detail_id');

                 $decesionName = DB::table('dak_details')
    ->where('id',$decesionNameId)->where('status','fcOne')->value('decision_list');

                    ?>
                <tr>
                    <td style="text-align:left;">
                        উৎসঃ {{ $form_one_data->organization_name_ban }} <br>
                        প্রেরকঃ {{ $form_one_data->organization_name_ban }}<span class="p-4"><i class="fa fa-user"></i>
                        মূল-প্রাপক : {{ $orginalReceverName }}</span>  <br>
                        বিষয়ঃ <b> এফসি-১   </b><br>
                        @if(empty($decesionName))

                        @else
                        সিদ্ধান্ত: <span style="color:blue;">{{ $decesionName }}। </span><br>
                        @endif
                        তারিখ:<b>{{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-F-y', strtotime($allStatusData->created_at))) }} </b>
                    </td>
                    <td style="text-align:right;">

                        <button class="btn btn-primary btn-xs" type="button" data-original-title="btn btn-danger btn-xs" title="" onclick="location.href = '{{ route('fc1Form.show',$allStatusData->mainId) }}';">দেখুন</button>


                         <!--new code-->
                     <button type="button" class="btn btn-primary btn-xs"
                     data-bs-toggle="modal"
                     data-original-title="" data-bs-target="#myModalfc1{{ $ps }}">
                     ডাক গতিবিধি
             </button>


             <!-- Modal -->
             <div class="modal right fade bd-example-modal-lg"
             id="myModalfc1{{ $ps }}" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel2">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel2">
                            ডাক গতিবিধি</h4>
                    </div>

                    <div class="modal-body">

                        <?php

$dakDetail = DB::table('dak_details')
->where('access_id',$allStatusData->mainId)->orderBy('id','desc')->first();







                            ?>

                            @if(!$dakDetail)

                            @else

                            <?php

$mainDetail = DB::table('fc_one_daks')
->where('fc_one_status_id',$allStatusData->mainId)->orderBy('id','asc')->get();

                            ?>

@foreach($mainDetail as  $key=>$allMainDetail)


<?php



$senderName = DB::table('admins')
->where('id',$allMainDetail->sender_admin_id)
->orderBy('id','desc')->value('admin_name_ban');


$senderImage = DB::table('admins')
->where('id',$allMainDetail->sender_admin_id)
->orderBy('id','desc')->value('admin_image');


$desiId = DB::table('admins')
->where('id',$allMainDetail->sender_admin_id)
->orderBy('id','desc')->value('designation_list_id');


$branchId = DB::table('admins')
->where('id',$allMainDetail->sender_admin_id)
->orderBy('id','desc')->value('branch_id');


$desiName = DB::table('designation_lists')
->where('id',$desiId)->value('designation_name');


$branchName = DB::table('branches')
->where('id',$branchId)->value('branch_name');


//receiver

$receiverName = DB::table('admins')
->where('id',$allMainDetail->receiver_admin_id)
->orderBy('id','desc')->value('admin_name_ban');


$receiverImage = DB::table('admins')
->where('id',$allMainDetail->receiver_admin_id)
->orderBy('id','desc')->value('admin_image');


$desiIds = DB::table('admins')
->where('id',$allMainDetail->receiver_admin_id)
->orderBy('id','desc')->value('designation_list_id');


$branchIds = DB::table('admins')
->where('id',$allMainDetail->receiver_admin_id)
->orderBy('id','desc')->value('branch_id');


$desiNames = DB::table('designation_lists')
->where('id',$desiIds)->value('designation_name');


$branchNames = DB::table('branches')
->where('id',$branchIds)->value('branch_name');



?>

                        <div class="d-flex mb-2">
                            <div class="flex-shrink-0 tracking_img">

                                @if($key == 0)

                                @if(empty($senderImage))

                                <img src="{{ asset('/') }}public/admin/user.png" class="rounded-circle" alt="Sample Image">
                                @else

                                <img src="{{ asset('/') }}{{ $senderImage }}" class="rounded-circle" alt="Sample Image">
@endif
                                @else

                                @if(empty($receiverImage))
                                <img src="{{ asset('/') }}public/admin/user.png" class="rounded-circle" alt="Sample Image">

                                @else

                                <img src="{{ asset('/') }}{{ $receiverImage }}" class="rounded-circle" alt="Sample Image">
@endif

                                @endif
                            </div>
                            <div class="flex-grow-1">
                                <div class="card" style="border:2px solid #979797">
                                    <div class="card-body">
                                        <div class="tracking_box">
                                            <h5>বিষয়ঃ এফসি-১   </h5>
                                            @if(!$dakDetail->main_file)

                                            @else


                                            <a target="_blank" href="{{ route('main_doc_download',['id'=>$dakDetail->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন  </a>
                                             @endif





                                            <hr>
                                            <ul>
                                                <li>প্রেরক : {{ $senderName }}</li>
                                                <li>প্রাপক : {{ $receiverName }}</li>
                                            </ul>
                                            <hr>
                                                                                               <p>তারিখ : {{  App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-m-Y h:i:s', strtotime(\Carbon\Carbon::parse($allMainDetail->created_at)))).' '.$allMainDetail->amPmValue }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @endforeach

                        @endif



                    </div><!-- modal-content -->
                </div><!-- modal-dialog -->
            </div><!-- modal -->
                     <!--end new code -->
                    </td>
                </tr>
                @endforeach
                    <!-- fc one form end -->


                    <!-- fc two form start -->

                    @foreach($dataFromFc2Form as $ps=>$allStatusData)

                    <?php

                                                                                            //new code
$orginalReceverId= DB::table('fc_two_daks')
                ->where('fc_two_status_id',$allStatusData->id)
                ->where('original_recipient',1)
                ->value('receiver_admin_id');

                $orginalReceverName= DB::table('admins')
                ->where('id',$orginalReceverId)
                ->value('admin_name_ban');

//end new code

                 $form_one_data = DB::table('fd_one_forms')->where('id',$allStatusData->fd_one_form_id)->first();

                 $decesionNameId = DB::table('fc_two_daks')
    ->where('fc_two_status_id',$allStatusData->id)->value('dak_detail_id');

                 $decesionName = DB::table('dak_details')
    ->where('id',$decesionNameId)->where('status','fcTwo')->value('decision_list');

                    ?>
                <tr>
                    <td style="text-align:left;">
                        উৎসঃ {{ $form_one_data->organization_name_ban }} <br>
                        প্রেরকঃ {{ $form_one_data->organization_name_ban }}<span class="p-4"><i class="fa fa-user"></i>
                        মূল-প্রাপক : {{ $orginalReceverName }}</span>  <br>
                        বিষয়ঃ <b> এফসি-২   </b><br>
                        @if(empty($decesionName))

                        @else
                        সিদ্ধান্ত: <span style="color:blue;">{{ $decesionName }}। </span><br>
                        @endif
                        তারিখ:<b>{{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-F-y', strtotime($allStatusData->created_at))) }} </b>
                    </td>
                    <td style="text-align:right;">

                        <button class="btn btn-primary btn-xs" type="button" data-original-title="btn btn-danger btn-xs" title="" onclick="location.href = '{{ route('fc2Form.show',$allStatusData->mainId) }}';">দেখুন</button>


                         <!--new code-->
                     <button type="button" class="btn btn-primary btn-xs"
                     data-bs-toggle="modal"
                     data-original-title="" data-bs-target="#myModalfc2{{ $ps }}">
                     ডাক গতিবিধি
             </button>


             <!-- Modal -->
             <div class="modal right fade bd-example-modal-lg"
             id="myModalfc2{{ $ps }}" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel2">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel2">
                            ডাক গতিবিধি</h4>
                    </div>

                    <div class="modal-body">

                        <?php

$dakDetail = DB::table('dak_details')
->where('access_id',$allStatusData->mainId)->orderBy('id','desc')->first();







                            ?>

                            @if(!$dakDetail)

                            @else

                            <?php

$mainDetail = DB::table('fc_two_daks')
->where('fc_two_status_id',$allStatusData->mainId)->orderBy('id','asc')->get();

                            ?>

@foreach($mainDetail as  $key=>$allMainDetail)


<?php



$senderName = DB::table('admins')
->where('id',$allMainDetail->sender_admin_id)
->orderBy('id','desc')->value('admin_name_ban');


$senderImage = DB::table('admins')
->where('id',$allMainDetail->sender_admin_id)
->orderBy('id','desc')->value('admin_image');


$desiId = DB::table('admins')
->where('id',$allMainDetail->sender_admin_id)
->orderBy('id','desc')->value('designation_list_id');


$branchId = DB::table('admins')
->where('id',$allMainDetail->sender_admin_id)
->orderBy('id','desc')->value('branch_id');


$desiName = DB::table('designation_lists')
->where('id',$desiId)->value('designation_name');


$branchName = DB::table('branches')
->where('id',$branchId)->value('branch_name');


//receiver

$receiverName = DB::table('admins')
->where('id',$allMainDetail->receiver_admin_id)
->orderBy('id','desc')->value('admin_name_ban');


$receiverImage = DB::table('admins')
->where('id',$allMainDetail->receiver_admin_id)
->orderBy('id','desc')->value('admin_image');


$desiIds = DB::table('admins')
->where('id',$allMainDetail->receiver_admin_id)
->orderBy('id','desc')->value('designation_list_id');


$branchIds = DB::table('admins')
->where('id',$allMainDetail->receiver_admin_id)
->orderBy('id','desc')->value('branch_id');


$desiNames = DB::table('designation_lists')
->where('id',$desiIds)->value('designation_name');


$branchNames = DB::table('branches')
->where('id',$branchIds)->value('branch_name');



?>

                        <div class="d-flex mb-2">
                            <div class="flex-shrink-0 tracking_img">

                                @if($key == 0)

                                @if(empty($senderImage))

                                <img src="{{ asset('/') }}public/admin/user.png" class="rounded-circle" alt="Sample Image">
                                @else

                                <img src="{{ asset('/') }}{{ $senderImage }}" class="rounded-circle" alt="Sample Image">
@endif
                                @else

                                @if(empty($receiverImage))
                                <img src="{{ asset('/') }}public/admin/user.png" class="rounded-circle" alt="Sample Image">

                                @else

                                <img src="{{ asset('/') }}{{ $receiverImage }}" class="rounded-circle" alt="Sample Image">
@endif

                                @endif
                            </div>
                            <div class="flex-grow-1">
                                <div class="card" style="border:2px solid #979797">
                                    <div class="card-body">
                                        <div class="tracking_box">
                                            <h5>বিষয়ঃ এফসি-২   </h5>
                                            @if(!$dakDetail->main_file)

                                            @else


                                            <a target="_blank" href="{{ route('main_doc_download',['id'=>$dakDetail->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন  </a>
                                             @endif





                                            <hr>
                                            <ul>
                                                <li>প্রেরক : {{ $senderName }}</li>
                                                <li>প্রাপক : {{ $receiverName }}</li>
                                            </ul>
                                            <hr>
                                                                                               <p>তারিখ : {{  App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-m-Y h:i:s', strtotime(\Carbon\Carbon::parse($allMainDetail->created_at)))).' '.$allMainDetail->amPmValue }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @endforeach

                        @endif



                    </div><!-- modal-content -->
                </div><!-- modal-dialog -->
            </div><!-- modal -->
                     <!--end new code -->
                    </td>
                </tr>
                @endforeach
                    <!-- fc two form end -->

                    <!-- fd three form start -->


                    @foreach($dataFromFd3Form as $ps=>$allStatusData)

                    <?php

                                                                                                                    //new code
$orginalReceverId= DB::table('fd_three_daks')
                ->where('fd_three_status_id',$allStatusData->id)
                ->where('original_recipient',1)
                ->value('receiver_admin_id');

                $orginalReceverName= DB::table('admins')
                ->where('id',$orginalReceverId)
                ->value('admin_name_ban');

//end new code

                 $form_one_data = DB::table('fd_one_forms')->where('id',$allStatusData->fd_one_form_id)->first();

                 $decesionNameId = DB::table('fd_three_daks')
    ->where('fd_three_status_id',$allStatusData->id)->value('dak_detail_id');

                 $decesionName = DB::table('dak_details')
    ->where('id',$decesionNameId)->where('status','fdThree')->value('decision_list');

                    ?>
                <tr>
                    <td style="text-align:left;">
                        উৎসঃ {{ $form_one_data->organization_name_ban }} <br>
                        প্রেরকঃ {{ $form_one_data->organization_name_ban }}<span class="p-4"><i class="fa fa-user"></i>
                        মূল-প্রাপক : {{ $orginalReceverName }}</span>  <br>
                        বিষয়ঃ <b> এফডি - ৩    </b><br>
                        @if(empty($decesionName))

    @else
    সিদ্ধান্ত: <span style="color:blue;">{{ $decesionName }}। </span><br>
    @endif
                        তারিখ:<b>{{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-F-y', strtotime($allStatusData->created_at))) }} </b>
                    </td>
                    <td style="text-align:right;">

                        <button class="btn btn-primary btn-xs" type="button" data-original-title="btn btn-danger btn-xs" title="" onclick="location.href = '{{ route('fd3Form.show',$allStatusData->mainId) }}';">দেখুন</button>


                         <!--new code-->
                     <button type="button" class="btn btn-primary btn-xs"
                     data-bs-toggle="modal"
                     data-original-title="" data-bs-target="#myModalfd3{{ $ps }}">
                     ডাক গতিবিধি
             </button>


             <!-- Modal -->
             <div class="modal right fade bd-example-modal-lg"
             id="myModalfd3{{ $ps }}" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel2">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel2">
                            ডাক গতিবিধি</h4>
                    </div>

                    <div class="modal-body">

                        <?php

$dakDetail = DB::table('dak_details')
->where('access_id',$allStatusData->mainId)->orderBy('id','desc')->first();







                            ?>

                            @if(!$dakDetail)

                            @else

                            <?php

$mainDetail = DB::table('fd_three_daks')
->where('fd_three_status_id',$allStatusData->mainId)->orderBy('id','asc')->get();

                            ?>

@foreach($mainDetail as  $key=>$allMainDetail)


<?php



$senderName = DB::table('admins')
->where('id',$allMainDetail->sender_admin_id)
->orderBy('id','desc')->value('admin_name_ban');


$senderImage = DB::table('admins')
->where('id',$allMainDetail->sender_admin_id)
->orderBy('id','desc')->value('admin_image');


$desiId = DB::table('admins')
->where('id',$allMainDetail->sender_admin_id)
->orderBy('id','desc')->value('designation_list_id');


$branchId = DB::table('admins')
->where('id',$allMainDetail->sender_admin_id)
->orderBy('id','desc')->value('branch_id');


$desiName = DB::table('designation_lists')
->where('id',$desiId)->value('designation_name');


$branchName = DB::table('branches')
->where('id',$branchId)->value('branch_name');


//receiver

$receiverName = DB::table('admins')
->where('id',$allMainDetail->receiver_admin_id)
->orderBy('id','desc')->value('admin_name_ban');


$receiverImage = DB::table('admins')
->where('id',$allMainDetail->receiver_admin_id)
->orderBy('id','desc')->value('admin_image');


$desiIds = DB::table('admins')
->where('id',$allMainDetail->receiver_admin_id)
->orderBy('id','desc')->value('designation_list_id');


$branchIds = DB::table('admins')
->where('id',$allMainDetail->receiver_admin_id)
->orderBy('id','desc')->value('branch_id');


$desiNames = DB::table('designation_lists')
->where('id',$desiIds)->value('designation_name');


$branchNames = DB::table('branches')
->where('id',$branchIds)->value('branch_name');



?>

                        <div class="d-flex mb-2">
                            <div class="flex-shrink-0 tracking_img">

                                @if($key == 0)

                                @if(empty($senderImage))

                                <img src="{{ asset('/') }}public/admin/user.png" class="rounded-circle" alt="Sample Image">
                                @else

                                <img src="{{ asset('/') }}{{ $senderImage }}" class="rounded-circle" alt="Sample Image">
@endif
                                @else

                                @if(empty($receiverImage))
                                <img src="{{ asset('/') }}public/admin/user.png" class="rounded-circle" alt="Sample Image">

                                @else

                                <img src="{{ asset('/') }}{{ $receiverImage }}" class="rounded-circle" alt="Sample Image">
@endif

                                @endif
                            </div>
                            <div class="flex-grow-1">
                                <div class="card" style="border:2px solid #979797">
                                    <div class="card-body">
                                        <div class="tracking_box">
                                            <h5>বিষয়ঃ এফডি - ৩   </h5>
                                            @if(!$dakDetail->main_file)

                                            @else


                                            <a target="_blank" href="{{ route('main_doc_download',['id'=>$dakDetail->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন  </a>
                                             @endif





                                            <hr>
                                            <ul>
                                                <li>প্রেরক : {{ $senderName }}</li>
                                                <li>প্রাপক : {{ $receiverName }}</li>
                                            </ul>
                                            <hr>
                                                                                               <p>তারিখ : {{  App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-m-Y h:i:s', strtotime(\Carbon\Carbon::parse($allMainDetail->created_at)))).' '.$allMainDetail->amPmValue }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @endforeach

                        @endif



                    </div><!-- modal-content -->
                </div><!-- modal-dialog -->
            </div><!-- modal -->
                     <!--end new code -->
                    </td>
                </tr>
                @endforeach


                    <!-- fd three form end -->





                    <!-- fd three form start -->


                    @foreach($ngoStatusDuplicateCertificate as $ps=>$allStatusData)

                    <?php


                      $checkDataAvailableOrNot = DB::table('duplicate_certificate_daks')
                                                        ->where('duplicate_certificate_id',$allStatusData->id)
                                                        ->where('sender_admin_id',Auth::guard('admin')->user()->id)
                                                        ->where('status',1)
                                                        ->value('id');


                                                                                                //new code
$orginalReceverId= DB::table('duplicate_certificate_daks')
                ->where('duplicate_certificate_id',$allStatusData->id)
                ->where('original_recipient',1)
                ->value('receiver_admin_id');

                $orginalReceverName= DB::table('admins')
                ->where('id',$orginalReceverId)
                ->value('admin_name_ban');

//end new code


                 $form_one_data = DB::table('fd_one_forms')->where('id',$allStatusData->fd_one_form_id)->first();

                 $decesionNameId = DB::table('duplicate_certificate_daks')
    ->where('duplicate_certificate_id',$allStatusData->id)->value('dak_detail_id');

                 $decesionName = DB::table('dak_details')
    ->where('id',$decesionNameId)->where('status','duplicate')->value('decision_list');

                    ?>


                <tr>
                    <td style="text-align:left;">
                        উৎসঃ {{ $form_one_data->organization_name_ban }} <br>
                        প্রেরকঃ {{ $form_one_data->organization_name_ban }}<span class="p-4"><i class="fa fa-user"></i>
                        মূল-প্রাপক : {{ $orginalReceverName }}</span>  <br>
                        বিষয়ঃ <b> ডুপ্লিকেট সনদপত্রের আবেদন   </b><br>
                        @if(empty($decesionName))

                        @else
                        সিদ্ধান্ত: <span style="color:blue;">{{ $decesionName }}। </span><br>
                        @endif
                        তারিখ:<b>{{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-F-y', strtotime($allStatusData->created_at))) }} </b>
                    </td>
                    <td style="text-align:right;">

                        <button class="btn btn-primary btn-xs" type="button" data-original-title="btn btn-danger btn-xs" title="" onclick="location.href = '{{ route('duplicateCertificate.show',$allStatusData->id) }}';">দেখুন</button>


                         <!--new code-->
                     <button type="button" class="btn btn-primary btn-xs"
                     data-bs-toggle="modal"
                     data-original-title="" data-bs-target="#myModalfd3dup{{ $ps }}">
                     ডাক গতিবিধি
             </button>


             <!-- Modal -->
             <div class="modal right fade bd-example-modal-lg"
             id="myModalfd3dup{{ $ps }}" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel2">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel2">
                            ডাক গতিবিধি</h4>
                    </div>

                    <div class="modal-body">

                        <?php

$dakDetail = DB::table('dak_details')
->where('access_id',$allStatusData->id)->orderBy('id','desc')->first();







                            ?>

                            @if(!$dakDetail)

                            @else

                            <?php

$mainDetail = DB::table('duplicate_certificate_daks')
->where('duplicate_certificate_id',$allStatusData->id)->orderBy('id','asc')->get();

                            ?>

@foreach($mainDetail as  $key=>$allMainDetail)


<?php



$senderName = DB::table('admins')
->where('id',$allMainDetail->sender_admin_id)
->orderBy('id','desc')->value('admin_name_ban');


$senderImage = DB::table('admins')
->where('id',$allMainDetail->sender_admin_id)
->orderBy('id','desc')->value('admin_image');


$desiId = DB::table('admins')
->where('id',$allMainDetail->sender_admin_id)
->orderBy('id','desc')->value('designation_list_id');


$branchId = DB::table('admins')
->where('id',$allMainDetail->sender_admin_id)
->orderBy('id','desc')->value('branch_id');


$desiName = DB::table('designation_lists')
->where('id',$desiId)->value('designation_name');


$branchName = DB::table('branches')
->where('id',$branchId)->value('branch_name');


//receiver

$receiverName = DB::table('admins')
->where('id',$allMainDetail->receiver_admin_id)
->orderBy('id','desc')->value('admin_name_ban');


$receiverImage = DB::table('admins')
->where('id',$allMainDetail->receiver_admin_id)
->orderBy('id','desc')->value('admin_image');


$desiIds = DB::table('admins')
->where('id',$allMainDetail->receiver_admin_id)
->orderBy('id','desc')->value('designation_list_id');


$branchIds = DB::table('admins')
->where('id',$allMainDetail->receiver_admin_id)
->orderBy('id','desc')->value('branch_id');


$desiNames = DB::table('designation_lists')
->where('id',$desiIds)->value('designation_name');


$branchNames = DB::table('branches')
->where('id',$branchIds)->value('branch_name');



?>

                        <div class="d-flex mb-2">
                            <div class="flex-shrink-0 tracking_img">

                                @if($key == 0)

                                @if(empty($senderImage))

                                <img src="{{ asset('/') }}public/admin/user.png" class="rounded-circle" alt="Sample Image">
                                @else

                                <img src="{{ asset('/') }}{{ $senderImage }}" class="rounded-circle" alt="Sample Image">
@endif
                                @else

                                @if(empty($receiverImage))
                                <img src="{{ asset('/') }}public/admin/user.png" class="rounded-circle" alt="Sample Image">

                                @else

                                <img src="{{ asset('/') }}{{ $receiverImage }}" class="rounded-circle" alt="Sample Image">
@endif

                                @endif
                            </div>
                            <div class="flex-grow-1">
                                <div class="card" style="border:2px solid #979797">
                                    <div class="card-body">
                                        <div class="tracking_box">
                                            <h5>বিষয়ঃ ডুপ্লিকেট সনদপত্রের আবেদন  </h5>
                                            @if(!$dakDetail->main_file)

                                            @else


                                            <a target="_blank" href="{{ route('main_doc_download',['id'=>$dakDetail->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন  </a>
                                             @endif





                                            <hr>
                                            <ul>
                                                <li>প্রেরক : {{ $senderName }}</li>
                                                <li>প্রাপক : {{ $receiverName }}</li>
                                            </ul>
                                            <hr>
                                                                                               <p>তারিখ : {{  App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-m-Y h:i:s', strtotime(\Carbon\Carbon::parse($allMainDetail->created_at)))).' '.$allMainDetail->amPmValue }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @endforeach

                        @endif



                    </div><!-- modal-content -->
                </div><!-- modal-dialog -->
            </div><!-- modal -->
                     <!--end new code -->
                    </td>
                </tr>

                @endforeach


                    <!-- fd three form end -->






                    <!-- fd three form start -->


                    @foreach($ngoStatusConstitution as $ps=>$allStatusData)

                    <?php


                      $checkDataAvailableOrNot = DB::table('constitution_daks')
                                                        ->where('constitution_id',$allStatusData->id)
                                                        ->where('sender_admin_id',Auth::guard('admin')->user()->id)
                                                        ->where('status',1)
                                                        ->value('id');


                                                                                                //new code
$orginalReceverId= DB::table('constitution_daks')
                ->where('constitution_id',$allStatusData->id)
                ->where('original_recipient',1)
                ->value('receiver_admin_id');

                $orginalReceverName= DB::table('admins')
                ->where('id',$orginalReceverId)
                ->value('admin_name_ban');

//end new code


                 $form_one_data = DB::table('fd_one_forms')->where('id',$allStatusData->fdId)->first();

                 $decesionNameId = DB::table('constitution_daks')
    ->where('constitution_id',$allStatusData->id)->value('dak_detail_id');

                 $decesionName = DB::table('dak_details')
    ->where('id',$decesionNameId)->where('status','constitution')->value('decision_list');

                    ?>


                <tr>
                    <td style="text-align:left;">
                        উৎসঃ {{ $form_one_data->organization_name_ban }} <br>
                        প্রেরকঃ {{ $form_one_data->organization_name_ban }}<span class="p-4"><i class="fa fa-user"></i>
                        মূল-প্রাপক : {{ $orginalReceverName }}</span>  <br>
                        বিষয়ঃ <b> গঠনতন্ত্র পরিবর্তন/অনুমোদনের জন্য আবেদন   </b><br>
                        @if(empty($decesionName))

                        @else
                        সিদ্ধান্ত: <span style="color:blue;">{{ $decesionName }}। </span><br>
                        @endif
                        তারিখ:<b>{{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-F-y', strtotime($allStatusData->created_at))) }} </b>
                    </td>
                    <td style="text-align:right;">

                        <button class="btn btn-primary btn-xs" type="button" data-original-title="btn btn-danger btn-xs" title="" onclick="location.href = '{{ route('constitutionInfo.show',$allStatusData->id) }}';">দেখুন</button>


                         <!--new code-->
                     <button type="button" class="btn btn-primary btn-xs"
                     data-bs-toggle="modal"
                     data-original-title="" data-bs-target="#myModalfd3dupcons{{ $ps }}">
                     ডাক গতিবিধি
             </button>


             <!-- Modal -->
             <div class="modal right fade bd-example-modal-lg"
             id="myModalfd3dupcons{{ $ps }}" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel2">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel2">
                            ডাক গতিবিধি</h4>
                    </div>

                    <div class="modal-body">

                        <?php

$dakDetail = DB::table('dak_details')
->where('access_id',$allStatusData->id)->orderBy('id','desc')->first();







                            ?>

                            @if(!$dakDetail)

                            @else

                            <?php

$mainDetail = DB::table('constitution_daks')
->where('constitution_id',$allStatusData->id)->orderBy('id','asc')->get();

                            ?>

@foreach($mainDetail as  $key=>$allMainDetail)


<?php



$senderName = DB::table('admins')
->where('id',$allMainDetail->sender_admin_id)
->orderBy('id','desc')->value('admin_name_ban');


$senderImage = DB::table('admins')
->where('id',$allMainDetail->sender_admin_id)
->orderBy('id','desc')->value('admin_image');


$desiId = DB::table('admins')
->where('id',$allMainDetail->sender_admin_id)
->orderBy('id','desc')->value('designation_list_id');


$branchId = DB::table('admins')
->where('id',$allMainDetail->sender_admin_id)
->orderBy('id','desc')->value('branch_id');


$desiName = DB::table('designation_lists')
->where('id',$desiId)->value('designation_name');


$branchName = DB::table('branches')
->where('id',$branchId)->value('branch_name');


//receiver

$receiverName = DB::table('admins')
->where('id',$allMainDetail->receiver_admin_id)
->orderBy('id','desc')->value('admin_name_ban');


$receiverImage = DB::table('admins')
->where('id',$allMainDetail->receiver_admin_id)
->orderBy('id','desc')->value('admin_image');


$desiIds = DB::table('admins')
->where('id',$allMainDetail->receiver_admin_id)
->orderBy('id','desc')->value('designation_list_id');


$branchIds = DB::table('admins')
->where('id',$allMainDetail->receiver_admin_id)
->orderBy('id','desc')->value('branch_id');


$desiNames = DB::table('designation_lists')
->where('id',$desiIds)->value('designation_name');


$branchNames = DB::table('branches')
->where('id',$branchIds)->value('branch_name');



?>

                        <div class="d-flex mb-2">
                            <div class="flex-shrink-0 tracking_img">

                                @if($key == 0)

                                @if(empty($senderImage))

                                <img src="{{ asset('/') }}public/admin/user.png" class="rounded-circle" alt="Sample Image">
                                @else

                                <img src="{{ asset('/') }}{{ $senderImage }}" class="rounded-circle" alt="Sample Image">
@endif
                                @else

                                @if(empty($receiverImage))
                                <img src="{{ asset('/') }}public/admin/user.png" class="rounded-circle" alt="Sample Image">

                                @else

                                <img src="{{ asset('/') }}{{ $receiverImage }}" class="rounded-circle" alt="Sample Image">
@endif

                                @endif
                            </div>
                            <div class="flex-grow-1">
                                <div class="card" style="border:2px solid #979797">
                                    <div class="card-body">
                                        <div class="tracking_box">
                                            <h5>বিষয়ঃ গঠনতন্ত্র পরিবর্তন/অনুমোদনের জন্য আবেদন  </h5>
                                            @if(!$dakDetail->main_file)

                                            @else


                                            <a target="_blank" href="{{ route('main_doc_download',['id'=>$dakDetail->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন  </a>
                                             @endif





                                            <hr>
                                            <ul>
                                                <li>প্রেরক : {{ $senderName }}</li>
                                                <li>প্রাপক : {{ $receiverName }}</li>
                                            </ul>
                                            <hr>
                                                                                               <p>তারিখ : {{  App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-m-Y h:i:s', strtotime(\Carbon\Carbon::parse($allMainDetail->created_at)))).' '.$allMainDetail->amPmValue }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @endforeach

                        @endif



                    </div><!-- modal-content -->
                </div><!-- modal-dialog -->
            </div><!-- modal -->
                     <!--end new code -->
                    </td>
                </tr>

                @endforeach


                    <!-- fd three form end -->




                    <!-- fd three form start -->


                    @foreach($ngoStatusExecutiveCommittee as $ps=>$allStatusData)

                    <?php


                      $checkDataAvailableOrNot = DB::table('executive_committee_daks')
                                                        ->where('executive_committee_id',$allStatusData->id)
                                                        ->where('sender_admin_id',Auth::guard('admin')->user()->id)
                                                        ->where('status',1)
                                                        ->value('id');


                                                                                                //new code
$orginalReceverId= DB::table('executive_committee_daks')
                ->where('executive_committee_id',$allStatusData->id)
                ->where('original_recipient',1)
                ->value('receiver_admin_id');

                $orginalReceverName= DB::table('admins')
                ->where('id',$orginalReceverId)
                ->value('admin_name_ban');

//end new code


                 $form_one_data = DB::table('fd_one_forms')->where('id',$allStatusData->fdId)->first();

                 $decesionNameId = DB::table('executive_committee_daks')
    ->where('executive_committee_id',$allStatusData->id)->value('dak_detail_id');

                 $decesionName = DB::table('dak_details')
    ->where('id',$decesionNameId)->where('status','committee')->value('decision_list');

                    ?>


                <tr>
                    <td style="text-align:left;">
                        উৎসঃ {{ $form_one_data->organization_name_ban }} <br>
                        প্রেরকঃ {{ $form_one_data->organization_name_ban }}<span class="p-4"><i class="fa fa-user"></i>
                        মূল-প্রাপক : {{ $orginalReceverName }}</span>  <br>
                        বিষয়ঃ <b> নির্বাহী কমিটি অনুমোদনের জন্য আবেদন    </b><br>
                        @if(empty($decesionName))

                        @else
                        সিদ্ধান্ত: <span style="color:blue;">{{ $decesionName }}। </span><br>
                        @endif
                        তারিখ:<b>{{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-F-y', strtotime($allStatusData->created_at))) }} </b>
                    </td>
                    <td style="text-align:right;">

                        <button class="btn btn-primary btn-xs" type="button" data-original-title="btn btn-danger btn-xs" title="" onclick="location.href = '{{ route('executiveCommitteeInfo.show',$allStatusData->id) }}';">দেখুন</button>


                         <!--new code-->
                     <button type="button" class="btn btn-primary btn-xs"
                     data-bs-toggle="modal"
                     data-original-title="" data-bs-target="#myModalfd3dupconsexe{{ $ps }}">
                     ডাক গতিবিধি
             </button>


             <!-- Modal -->
             <div class="modal right fade bd-example-modal-lg"
             id="myModalfd3dupconsexe{{ $ps }}" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel2">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel2">
                            ডাক গতিবিধি</h4>
                    </div>

                    <div class="modal-body">

                        <?php

$dakDetail = DB::table('dak_details')
->where('access_id',$allStatusData->id)->orderBy('id','desc')->first();







                            ?>

                            @if(!$dakDetail)

                            @else

                            <?php

$mainDetail = DB::table('executive_committee_daks')
->where('executive_committee_id',$allStatusData->id)->orderBy('id','asc')->get();

                            ?>

@foreach($mainDetail as  $key=>$allMainDetail)


<?php



$senderName = DB::table('admins')
->where('id',$allMainDetail->sender_admin_id)
->orderBy('id','desc')->value('admin_name_ban');


$senderImage = DB::table('admins')
->where('id',$allMainDetail->sender_admin_id)
->orderBy('id','desc')->value('admin_image');


$desiId = DB::table('admins')
->where('id',$allMainDetail->sender_admin_id)
->orderBy('id','desc')->value('designation_list_id');


$branchId = DB::table('admins')
->where('id',$allMainDetail->sender_admin_id)
->orderBy('id','desc')->value('branch_id');


$desiName = DB::table('designation_lists')
->where('id',$desiId)->value('designation_name');


$branchName = DB::table('branches')
->where('id',$branchId)->value('branch_name');


//receiver

$receiverName = DB::table('admins')
->where('id',$allMainDetail->receiver_admin_id)
->orderBy('id','desc')->value('admin_name_ban');


$receiverImage = DB::table('admins')
->where('id',$allMainDetail->receiver_admin_id)
->orderBy('id','desc')->value('admin_image');


$desiIds = DB::table('admins')
->where('id',$allMainDetail->receiver_admin_id)
->orderBy('id','desc')->value('designation_list_id');


$branchIds = DB::table('admins')
->where('id',$allMainDetail->receiver_admin_id)
->orderBy('id','desc')->value('branch_id');


$desiNames = DB::table('designation_lists')
->where('id',$desiIds)->value('designation_name');


$branchNames = DB::table('branches')
->where('id',$branchIds)->value('branch_name');



?>

                        <div class="d-flex mb-2">
                            <div class="flex-shrink-0 tracking_img">

                                @if($key == 0)

                                @if(empty($senderImage))

                                <img src="{{ asset('/') }}public/admin/user.png" class="rounded-circle" alt="Sample Image">
                                @else

                                <img src="{{ asset('/') }}{{ $senderImage }}" class="rounded-circle" alt="Sample Image">
@endif
                                @else

                                @if(empty($receiverImage))
                                <img src="{{ asset('/') }}public/admin/user.png" class="rounded-circle" alt="Sample Image">

                                @else

                                <img src="{{ asset('/') }}{{ $receiverImage }}" class="rounded-circle" alt="Sample Image">
@endif

                                @endif
                            </div>
                            <div class="flex-grow-1">
                                <div class="card" style="border:2px solid #979797">
                                    <div class="card-body">
                                        <div class="tracking_box">
                                            <h5>বিষয়ঃ নির্বাহী কমিটি অনুমোদনের জন্য আবেদন   </h5>
                                            @if(!$dakDetail->main_file)

                                            @else


                                            <a target="_blank" href="{{ route('main_doc_download',['id'=>$dakDetail->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন  </a>
                                             @endif





                                            <hr>
                                            <ul>
                                                <li>প্রেরক : {{ $senderName }}</li>
                                                <li>প্রাপক : {{ $receiverName }}</li>
                                            </ul>
                                            <hr>
                                                                                               <p>তারিখ : {{  App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-m-Y h:i:s', strtotime(\Carbon\Carbon::parse($allMainDetail->created_at)))).' '.$allMainDetail->amPmValue }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @endforeach

                        @endif



                    </div><!-- modal-content -->
                </div><!-- modal-dialog -->
            </div><!-- modal -->
                     <!--end new code -->
                    </td>
                </tr>

                @endforeach


                    <!-- fd three form end -->

                    <!-- fd five form start -->


                    @foreach($ngoStatusFdFive as $ps=>$allStatusData)

                    <?php


                      $checkDataAvailableOrNot = DB::table('fd_five_daks')
                                                        ->where('fd_five_status_id',$allStatusData->id)
                                                        ->where('sender_admin_id',Auth::guard('admin')->user()->id)
                                                        ->where('status',1)
                                                        ->value('id');


                                                                                                //new code
$orginalReceverId= DB::table('fd_five_daks')
                ->where('fd_five_status_id',$allStatusData->id)
                ->where('original_recipient',1)
                ->value('receiver_admin_id');

                $orginalReceverName= DB::table('admins')
                ->where('id',$orginalReceverId)
                ->value('admin_name_ban');

//end new code


                 $form_one_data = DB::table('fd_one_forms')->where('id',$allStatusData->fdId)->first();

                 $decesionNameId = DB::table('fd_five_daks')
    ->where('fd_five_status_id',$allStatusData->id)->value('dak_detail_id');

                 $decesionName = DB::table('dak_details')
    ->where('id',$decesionNameId)->where('status','fdFive')->value('decision_list');

                    ?>


                <tr>
                    <td style="text-align:left;">
                        উৎসঃ {{ $form_one_data->organization_name_ban }} <br>
                        প্রেরকঃ {{ $form_one_data->organization_name_ban }}<span class="p-4"><i class="fa fa-user"></i>
                        মূল-প্রাপক : {{ $orginalReceverName }}</span>  <br>
                        বিষয়ঃ <b> বিদেশ থেকে প্রাপ্ত জিনিসপত্র /দ্রব্যসামগ্র্রীর সংরক্ষণ সংক্রান্ত আবেদন    </b><br>
                        @if(empty($decesionName))

                        @else
                        সিদ্ধান্ত: <span style="color:blue;">{{ $decesionName }}। </span><br>
                        @endif
                        তারিখ:<b>{{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-F-y', strtotime($allStatusData->created_at))) }} </b>
                    </td>
                    <td style="text-align:right;">

                        <button class="btn btn-primary btn-xs" type="button" data-original-title="btn btn-danger btn-xs" title="" onclick="location.href = '{{ route('fd5Form.show',$allStatusData->id) }}';">দেখুন</button>


                         <!--new code-->
                     <button type="button" class="btn btn-primary btn-xs"
                     data-bs-toggle="modal"
                     data-original-title="" data-bs-target="#myModalfd5form{{ $ps }}">
                     ডাক গতিবিধি
             </button>


             <!-- Modal -->
             <div class="modal right fade bd-example-modal-lg"
             id="myModalfd5form{{ $ps }}" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel2">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel2">
                            ডাক গতিবিধি</h4>
                    </div>

                    <div class="modal-body">

                        <?php

$dakDetail = DB::table('dak_details')
->where('access_id',$allStatusData->id)->orderBy('id','desc')->first();







                            ?>

                            @if(!$dakDetail)

                            @else

                            <?php

$mainDetail = DB::table('fd_five_daks')
->where('fd_five_status_id',$allStatusData->id)->orderBy('id','asc')->get();

                            ?>

@foreach($mainDetail as  $key=>$allMainDetail)


<?php



$senderName = DB::table('admins')
->where('id',$allMainDetail->sender_admin_id)
->orderBy('id','desc')->value('admin_name_ban');


$senderImage = DB::table('admins')
->where('id',$allMainDetail->sender_admin_id)
->orderBy('id','desc')->value('admin_image');


$desiId = DB::table('admins')
->where('id',$allMainDetail->sender_admin_id)
->orderBy('id','desc')->value('designation_list_id');


$branchId = DB::table('admins')
->where('id',$allMainDetail->sender_admin_id)
->orderBy('id','desc')->value('branch_id');


$desiName = DB::table('designation_lists')
->where('id',$desiId)->value('designation_name');


$branchName = DB::table('branches')
->where('id',$branchId)->value('branch_name');


//receiver

$receiverName = DB::table('admins')
->where('id',$allMainDetail->receiver_admin_id)
->orderBy('id','desc')->value('admin_name_ban');


$receiverImage = DB::table('admins')
->where('id',$allMainDetail->receiver_admin_id)
->orderBy('id','desc')->value('admin_image');


$desiIds = DB::table('admins')
->where('id',$allMainDetail->receiver_admin_id)
->orderBy('id','desc')->value('designation_list_id');


$branchIds = DB::table('admins')
->where('id',$allMainDetail->receiver_admin_id)
->orderBy('id','desc')->value('branch_id');


$desiNames = DB::table('designation_lists')
->where('id',$desiIds)->value('designation_name');


$branchNames = DB::table('branches')
->where('id',$branchIds)->value('branch_name');



?>

                        <div class="d-flex mb-2">
                            <div class="flex-shrink-0 tracking_img">

                                @if($key == 0)

                                @if(empty($senderImage))

                                <img src="{{ asset('/') }}public/admin/user.png" class="rounded-circle" alt="Sample Image">
                                @else

                                <img src="{{ asset('/') }}{{ $senderImage }}" class="rounded-circle" alt="Sample Image">
@endif
                                @else

                                @if(empty($receiverImage))
                                <img src="{{ asset('/') }}public/admin/user.png" class="rounded-circle" alt="Sample Image">

                                @else

                                <img src="{{ asset('/') }}{{ $receiverImage }}" class="rounded-circle" alt="Sample Image">
@endif

                                @endif
                            </div>
                            <div class="flex-grow-1">
                                <div class="card" style="border:2px solid #979797">
                                    <div class="card-body">
                                        <div class="tracking_box">
                                            <h5>বিষয়ঃ বিদেশ থেকে প্রাপ্ত জিনিসপত্র /দ্রব্যসামগ্র্রীর সংরক্ষণ সংক্রান্ত </h5>
                                            @if(!$dakDetail->main_file)

                                            @else


                                            <a target="_blank" href="{{ route('main_doc_download',['id'=>$dakDetail->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন  </a>
                                             @endif





                                            <hr>
                                            <ul>
                                                <li>প্রেরক : {{ $senderName }}</li>
                                                <li>প্রাপক : {{ $receiverName }}</li>
                                            </ul>
                                            <hr>
                                                                                               <p>তারিখ : {{  App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-m-Y h:i:s', strtotime(\Carbon\Carbon::parse($allMainDetail->created_at)))).' '.$allMainDetail->amPmValue }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @endforeach

                        @endif



                    </div><!-- modal-content -->
                </div><!-- modal-dialog -->
            </div><!-- modal -->
                     <!--end new code -->
                    </td>
                </tr>

                @endforeach

    <!-- fd five form end -->



                                    </tbody>
                                </table>
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
@endsection


@section('script')

@endsection
