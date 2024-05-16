<!-- Modal -->
<div class="modal right fade bd-example-modal-lg"
id="myModalrenew{{ $key+1 }}" tabindex="-1" role="dialog"
aria-labelledby="myModalLabel2">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
    <a id="pp" class="btn btn-outline-danger btn-sm"><i class="fa fa-times" aria-hidden="true"></i></a>
<h4 class="modal-title" id="myModalLabel2">
    নথি গতিবিধি</h4>
</div>

<div class="modal-body">
    <?php

    $mainDetail = DB::table('nothi_details')
    ->where('noteId',$nothiLists1->noteId)
        ->where('nothId',$nothiLists1->nothId)
        ->where('dakId',$nothiLists1->dakId)
        ->where('dakType',$nothiLists1->dakType)
    ->orderBy('id','asc')->get();

               ?>

@foreach($mainDetail as  $key=>$allMainDetail)


<?php



$senderName = DB::table('admins')
->where('id',$allMainDetail->sender)
->orderBy('id','desc')->value('admin_name_ban');


$senderImage = DB::table('admins')
->where('id',$allMainDetail->sender)
->orderBy('id','desc')->value('admin_image');


$desiId = DB::table('admins')
->where('id',$allMainDetail->sender)
->orderBy('id','desc')->value('designation_list_id');


$branchId = DB::table('admins')
->where('id',$allMainDetail->sender)
->orderBy('id','desc')->value('branch_id');


$desiName = DB::table('designation_lists')
->where('id',$desiId)->value('designation_name');


$branchName = DB::table('branches')
->where('id',$branchId)->value('branch_name');


//receiver

$receiverName = DB::table('admins')
->where('id',$allMainDetail->receiver)
->orderBy('id','desc')->value('admin_name_ban');


$receiverImage = DB::table('admins')
->where('id',$allMainDetail->receiver)
->orderBy('id','desc')->value('admin_image');


$desiIds = DB::table('admins')
->where('id',$allMainDetail->receiver)
->orderBy('id','desc')->value('designation_list_id');


$branchIds = DB::table('admins')
->where('id',$allMainDetail->receiver)
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

     <img src="{{ asset('/') }}public/admin/user.png" class="rounded-circle" >
     @else

     <img src="{{ asset('/') }}{{ $senderImage }}" class="rounded-circle" >
@endif
     @else

     @if(empty($receiverImage))
     <img src="{{ asset('/') }}public/admin/user.png" class="rounded-circle" >

     @else

     <img src="{{ asset('/') }}{{ $receiverImage }}" class="rounded-circle" >
@endif

     @endif
 </div>
 <div class="flex-grow-1">
     <div class="card" style="border:2px solid #979797">
         <div class="card-body">
             <div class="tracking_box">
                 <h5>বিষয়ঃ এনজিও নিবন্ধন নবায়ন</h5>

                 <hr>
                 <ul>
                     <li style="font-size:14px;">প্রেরক : {{ $senderName }}</li>
                     <li style="font-size:14px;">প্রাপক : {{ $receiverName }}</li>
                 </ul>
                 <hr>
                 <p>তারিখ : {{  App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-m-Y h:i:s', strtotime(\Carbon\Carbon::parse($allMainDetail->created_at)))).' '.$allMainDetail->amPmValue }}</p>
             </div>
         </div>
     </div>
 </div>
</div>

@endforeach
</div>

</div><!-- modal-content -->
</div><!-- modal-dialog -->
</div><!-- modal -->
<!--end new code -->
