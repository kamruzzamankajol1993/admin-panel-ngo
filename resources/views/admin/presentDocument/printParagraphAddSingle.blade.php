<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>pdf</title>
    <style>
        body
        {
            font-size:16px !important;
            width: 8.3in;
            height: 11.7in;
        }

        body
        {
           /* // font-family: 'banglaNikos', sans-serif; */
        /* font-size: 14px; */

        }
		table
		{
			width: 100%;
			border-collapse: collapse;
		}

    </style>
</head>
<body>

    @foreach($childNoteNewList as $key=>$childNoteNewLists)
    <div  style="margin-top:35px;">
    <?php

    $creatorNAme = DB::table('admins')
    ->where('id',$childNoteNewLists->admin_id)
    ->value('admin_name_ban');

                ?>
<!-- header  start -->
<p style="text-align: center;font-size:20px;">অনুচ্ছেদ# {{ App\Http\Controllers\Admin\CommonController::englishToBangla('1'.'.'.$key+1) }}</p>
<!-- header end -->


<!--body start --->

<div class="custom_table_accordion" id="descriptionFirst{{ $childNoteNewLists->id }}">

    {!! $childNoteNewLists->description !!}
    </div>
<!-- end body start -->
<!--start sign code -->

@if($childNoteNewLists->back_sign_status == 1)
<div class="row">
<!--back code -->

<?php
$backSignDetail=DB::table('admins')->where('id',$childNoteNewLists->admin_id)
->first();

$backSignDetailOne=DB::table('admins')->where('id',$childNoteNewLists->receiver_id)
->first();
?>

@if(!$backSignDetail)



@else
<?php
$desiName1 = DB::table('designation_lists')
->where('id',$backSignDetail->designation_list_id)
->value('designation_name');
$branchName1 = DB::table('branches')->where('id',$backSignDetail->branch_id)->value('branch_name');

?>
<div class="col-lg-3 col-md-3 col-sm-6 mb-2" style="float:left;width:160px;margin-left:7px;">
    <div class="text-center" style="text-align: center;">
    <img src="{{ asset('/') }}{{ $backSignDetail->admin_sign }}" alt="" height="50" width="180">
    <div style="height:1px; width:100%; background-color: #BC1133"></div>
    <p style="line-height:1.4; color: #BC1133; font-size: 14px;">
        <span style="font-size: 12px;">{{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('d/m/y h:i:s', strtotime($childNoteNewLists->updated_at))).' '.$childNoteNewLists->amPmValueUpdate }}</span><br>
    {{ $backSignDetail->admin_name_ban }} <br>
    {{ $desiName1 }} <br>
    {{ $branchName1 }}</p>
    </div>
    </div>

@endif
<!-- new code-->
@if(!$backSignDetailOne)



@else
<?php
$desiName1 = DB::table('designation_lists')
->where('id',$backSignDetailOne->designation_list_id)
->value('designation_name');
$branchName1 = DB::table('branches')->where('id',$backSignDetailOne->branch_id)->value('branch_name');

?>
{{-- <div class="col-lg-3 col-md-3 col-sm-6 mb-2" style="margin-top: 50px;">
    <div class="text-center">

    <div style="height:1px; width:100%; background-color: #BC1133"></div>
    <p style="line-height:1.4; color: #BC1133; font-size: 14px;">

    {{ $backSignDetailOne->admin_name_ban }} <br>
    {{ $desiName1 }} <br>
    {{ $branchName1 }}</p>
    </div>
    </div> --}}

@endif
</div>
<!-- end back code -->

@else

<?php

$senderIdNews = DB::table('seal_statuses')
->where('noteId',$id)
->where('nothiId',$nothiId)
//->where('dakId',$parentId)
->where('status',$status)
//->where('seal_status',1)
->where('childId',$childNoteNewLists->id)
->get();

    ?>



<?php
$paraSentStatus = DB::table('nothi_details')
                            ->where('noteId',$id)
                            ->where('nothId',$nothiId)
                            ->where('dakId',$parentId)
                            ->where('dakType',$status)
                            ->where('childId',$childNoteNewLists->id)
                            ->orderBy('id','desc')
                            ->where('sender',Auth::guard('admin')->user()->id)
                            ->value('sent_status_other');
?>



    <div class="row">
<!-- para owner sign  start-->

@if($childNoteNewLists->sent_status == 1)

<?php
$mainSenderIdNews212=DB::table('admins')->where('id',$childNoteNewLists->admin_id)
->get();

?>
@foreach($mainSenderIdNews212 as $mainSenderIdNews22 )
<?php
$desiName1 = DB::table('designation_lists')
    ->where('id',$mainSenderIdNews22->designation_list_id)
    ->value('designation_name');
$branchName1 = DB::table('branches')->where('id',$mainSenderIdNews22->branch_id)->value('branch_name');

?>
<div class="col-lg-3 col-md-3 col-sm-6 mb-2" style="float:left;width:160px;margin-left:7px;">
    <div class="text-center" style="text-align: center;">
    <img src="{{ asset('/') }}{{ $mainSenderIdNews22->admin_sign }}" alt="" height="50" width="180">
    <div style="height:1px; width:100%; background-color: #BC1133"></div>
    <p style="line-height:1.4; color: #BC1133; font-size: 14px;">
        <span style="font-size: 12px;">{{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('d/m/y h:i:s', strtotime($childNoteNewLists->updated_at))).' '.$childNoteNewLists->amPmValueUpdate }}</span><br>
    {{ $mainSenderIdNews22->admin_name_ban }} <br>
    {{ $desiName1 }} <br>
    {{ $branchName1 }}</p>
    </div>
    </div>

@endforeach


@endif


<!-- para owner sign end-->
@foreach($senderIdNews as $jt=>$mainSenderIdNewss44)


<?php
$mainSenderIdNews21=DB::table('admins')->where('id',$mainSenderIdNewss44->receiver)
->get();

?>



<?php
$desiName1 = DB::table('designation_lists')
    ->where('id',$mainSenderIdNewss44->e_designation)
    ->value('designation_name');
$branchName1 = DB::table('branches')->where('id',$mainSenderIdNewss44->e_branch)->value('branch_name');

?>


<!-- first condition-->

@if($mainSenderIdNewss44->seal_status == 1)

<div class="col-lg-3 col-md-3 col-sm-6 mb-2" style="float:left;width:160px;margin-left:7px;">

    @else
    <div class="col-lg-3 col-md-3 col-sm-6 mb-2" style="margin-top:43px;float:left;width:160px;margin-left:7px;">

    @endif


<div class="text-center" style="text-align: center;">
    @if($mainSenderIdNewss44->seal_status == 1)
<img src="{{ asset('/') }}{{ $mainSenderIdNewss44->e_sign }}" alt="" height="50" width="180">
@else

@endif
<div style="height:1px; width:100%; background-color: #BC1133"></div>
<p style="line-height:1.4; color: #BC1133; font-size: 14px;">

    @if($mainSenderIdNewss44->seal_status == 1)
    <span style="font-size: 12px;">{{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('d/m/y h:i:s', strtotime($mainSenderIdNewss44->updated_at))).' '.$mainSenderIdNewss44->amPmValueUpdate }}</span><br>

@else


@endif
<!-- code for delete status --->
@if($mainSenderIdNewss44->delete_status == 1)
<del>{{ $mainSenderIdNewss44->e_name }} <br>
{{ $desiName1 }} <br>
{{ $branchName1 }}</del></p>
@else
{{ $mainSenderIdNewss44->e_name }} <br>
{{ $desiName1 }} <br>
{{ $branchName1 }}</p>
@endif
<!-- code for delete status -->
</div>
</div>



        @endforeach

    </div>

@endif
<!-- end sign code -->

<!-- end sign code -->


    </div>

          @endforeach




</body>
</html>
