<style>
    .custom_tooltip {
  position: relative;
  display: inline-block;
  border-bottom: 1px dotted black;
}

.custom_tooltiptext {
  opacity: 0;
  width: 100%;
  background-color: black;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px;
  position: absolute;
  z-index: 1;
  top: -35px;
  left: 0;
}

.custom_tooltip:hover .custom_tooltiptext {
  opacity: 1;
}
</style>
<div class="row">

    <div class="col-sm-8 col-xs-8">

        <p style="font-size: 14px;"><b>{{$checkParentFirst->subject }}<span style="padding-left: 5px;color:#660080">{{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('d/m/y h:i:s', strtotime($checkParentFirst->created_at))) }}</span></b></p>

    </div>
    <div class="col-sm-4 col-xs-4">
        <div class="d-flex flex-row-reverse">
             <a target="_blank" href ="{{ route('printAllParagraph', ['status' => $status,'parentId'=>$parentId,'nothiId'=>$nothiId,'id' =>$id]) }}" class="btn btn-primary btn-sm"aria-expanded="false"><i class="fa fa-print"></i></a>
             <span class="custom_tooltiptext">প্রিন্ট </span>
        </div>
    </div>
</div>
<hr>
    <div class="default-according" id="accordion1">



@foreach($childNoteNewList as $key=>$childNoteNewLists)
<?php
 //dd($childNoteNewLists->receiver);
$creatorNAme = DB::table('admins')
->where('id',$childNoteNewLists->admin_id)
->value('admin_name_ban');

            ?>



@if($childNoteNewLists->admin_id == Auth::guard('admin')->user()->id)

@include('admin.presentDocument.viewChildNoteSecondStepFirstPart')

@else

@if(($childNoteNewLists->sent_status == 1) && ($childNoteNewLists->receiver_id == Auth::guard('admin')->user()->id))


<?php
$paraSentStatus = DB::table('nothi_details')
                            ->where('noteId',$id)
                            ->where('nothId',$nothiId)
                            ->where('dakId',$parentId)
                            ->where('dakType',$status)
                            ->where('childId',$childNoteNewLists->id)
                            ->where('receiver',Auth::guard('admin')->user()->id)
                            ->update(array('view_status' => 1));


?>
@include('admin.presentDocument.viewChildNoteSecondStepFirstPart')

@else

<?php
$paraSentStatusNewOneTwo = DB::table('seal_statuses')
                            ->where('nothiId',$nothiId)
                            ->where('status',$status)
                            ->where('receiver',Auth::guard('admin')->user()->id)
                            //->orderBy('id','asc')
                            //->where('seal_status',1)
                            ->value('nothiId');

                            $paraSentStatusNewOneTwoThree = DB::table('seal_statuses')
                            ->where('nothiId',$nothiId)
                            ->where('status',$status)
                          //  ->where('receiver',Auth::guard('admin')->user()->id)
                           // ->orderBy('id','asc')
                            //->where('seal_status',1)

                            ->where('childId',$childNoteNewLists->id)
                            ->value('nothiId');

?>

<!-- new code  start-->



@if($paraSentStatusNewOneTwo  == $paraSentStatusNewOneTwoThree)

@include('admin.presentDocument.viewChildNoteSecondStepFirstPartOne')
@endif


<!--  end new code -->




@endif


 @endif


      @endforeach


      <div class="card" id="newParaDes" style="display: none;">
        <div class="card-header bg-primary" id="eheadingSix">
          <h5 class="mb-0">
            <button class="btn btn-link collapsed text-white" data-bs-toggle="collapse" data-bs-target="#ecollapseSix" aria-expanded="false" aria-controls="ecollapseSix">নতুন অনুচ্ছেদ</button>
          </h5>
        </div>
        <div class="collapse mclose2 " id="ecollapseSix" aria-labelledby="eheadingSix" >
          <div class="card-body">


            <form class="custom-validation" action="{{ route('childNote.store') }}" method="post" enctype="multipart/form-data" id="form" data-parsley-validate="">
                @csrf
                <input type="hidden" value="{{ $id }}" name="parentNoteId"/>
                <input type="hidden" value="{{ $status }}" name="status"/>
            <div id="container">
                <textarea class="maineditor" id="mainpeditor"  name="mainPartNote">
                    <p>লিখুন</p>
                </textarea>
            </div>

            <?php

            $unsentAtt = DB::table('note_attachments')
            ->where('noteId',$id)
            ->where('nothiId',$nothiId)
            ->where('status',$status)
            ->where('admin_id',Auth::guard('admin')->user()->id)
            ->whereNull('child_id')
            ->get();

            ?>



             <p class="mt-4">সংযুক্তি({{ count($unsentAtt) }})</p>
             <ul>
                @foreach($unsentAtt as $unsentAtts )
                <li><a target="_blank" href="{{ $unsentAtts->title }}"><i class="fa fa-paperclip"></i></a> {{ $unsentAtts->title }}</li>
                @endforeach
             </ul>

            <div class="d-flex flex-row-reverse mt-3">

<?php


$senderIdNew122 = DB::table('nothi_details')
                ->where('noteId',$id)
                ->where('nothId',$nothiId)
                ->where('dakId',$parentId)
                ->where('dakType',$status)
                ->whereNull('back_status')
                //->where('sender',Auth::guard('admin')->user()->id)
                ->value('zari_permission_status');

?>

@if($senderIdNew122 == 1)

@else


<div class="d-flex flex-row-reverse mt-3">

    <div class="dropdown">



        <button class="btn btn-primary" value="সংরক্ষন করুন" type="submit" name="final_button"

                aria-expanded="false">
            সংরক্ষন করুন
        </button>




    </div>
</div>





                @endif


            </div>
             </form>



        </div>
        </div>
      </div>
    </div>


