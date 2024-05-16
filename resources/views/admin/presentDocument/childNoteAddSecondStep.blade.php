
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
            <!--update code-->    <a target="_blank" href ="{{ route('printAllParagraphFromSend', ['status' => $status,'parentId'=>$parentId,'nothiId'=>$nothiId,'id' =>$id]) }}" class="btn btn-primary btn-sm custom_tooltip"><i class="fa fa-print"></i>
            <span class="custom_tooltiptext">প্রিন্ট </span>
            </a>
            </div>
        </div>
    </div>
    <hr>



    <div class="default-according" id="accordion1">

@foreach($childNoteNewList as $key=>$childNoteNewLists)

<?php

$creatorNAme = DB::table('admins')
->where('id',$childNoteNewLists->admin_id)
->value('admin_name_ban');

            ?>

@if( $childNoteNewLists->admin_id == Auth::guard('admin')->user()->id || $childNoteNewLists->receiver_id == Auth::guard('admin')->user()->id )

     @include('admin.presentDocument.addChildNoteSecondStepFirstPart')

     @else

     @if(($childNoteNewLists->sent_status == 1) && ($childNoteNewLists->sender_id == Auth::guard('admin')->user()->id))


      @include('admin.presentDocument.addChildNoteSecondStepFirstPart')

     @else


     <?php
     $multipleCheck = DB::table('seal_statuses')
     ->where('noteId',$id)
     ->where('nothiId',$nothiId)
     ->where('status',$status)
     ->where('childId',$childNoteNewLists->id)
     ->where('receiver',Auth::guard('admin')->user()->id)
     ->value('seal_status');


     $multipleCheckDelete = DB::table('seal_statuses')
     ->where('noteId',$id)
     ->where('nothiId',$nothiId)
     ->where('status',$status)
     ->where('childId',$childNoteNewLists->id)
     //->where('seal_status',2)
     //->where('receiver',Auth::guard('admin')->user()->id)
     ->value('seal_status');
 //dd(Auth::guard('admin')->user()->id);
     ?>

    @if($multipleCheck == 1)

    @include('admin.presentDocument.addChildNoteSecondStepFirstPart')

    @else

    @endif
    <!-- new code when other send but have permission-->
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

    <?php
    $multipleCheck = DB::table('seal_statuses')
    ->where('noteId',$id)
    ->where('nothiId',$nothiId)
    ->where('status',$status)
    ->where('childId',$childNoteNewLists->id)
    ->where('receiver',Auth::guard('admin')->user()->id)
    ->value('seal_status');

    ?>

   @if($multipleCheck == 1)

   @else

    @include('admin.presentDocument.viewChildNoteSecondStepFirstPartOne')

    @endif
    @endif


    <!--  end new code -->
    <!-- new code when other send but have permission end -->
     @endif


      @endif


      @endforeach

      <div class="card" id="newParaDes" style="display: none;">
        <div class="card-header bg-primary" id="eheadingSix">
          <h5 class="mb-0">
            <button class="btn btn-link collapsed text-white" data-bs-toggle="collapse" data-bs-target="#ecollapseSix" aria-expanded="false" aria-controls="collapseSix">নতুন অনুচ্ছেদ</button>
          </h5>
        </div>
        <div class="collapse show" id="ecollapseSix" aria-labelledby="eheadingSix" data-bs-parent="#accordion1">
          <div class="card-body">


            <form id="form" class="custom-validation" action="{{ route('childNote.store') }}" method="post" enctype="multipart/form-data"  data-parsley-validate="">
                @csrf
                <input type="hidden" value="{{ $id }}" name="parentNoteId"/>
                <input type="hidden" value="{{ $status }}" name="status"/>

                <input type="hidden" value="{{ $id }}" name="noteId"/>
                <input type="hidden" value="{{ $activeCode }}" name="activeCode"/>
                <input type="hidden" value="{{ $nothiId }}" name="nothiId"/>
                <input type="hidden" value="{{ $parentId }}" name="dakId"/>

            <div id="container">
                <textarea class="maineditorForAdd" id="mainpeditor"  name="mainPartNote">
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

