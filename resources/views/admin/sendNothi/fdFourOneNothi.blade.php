<!-- fd four form -->


@foreach ($senderNothiListfdFourOne->unique('receiver') as $key=>$nothiLists1)

<?php

$nothiLists = DB::table('nothi_lists')->where('id',$nothiLists1->nothId)->first();
?>

@if(!$nothiLists)

@else

<?php
$getLastId = DB::table('parent_note_for_fd_four_one_forms')
->where('nothi_detail_id',$nothiLists1->dakId)
->where('serial_number',$nothiLists1->nothId)
->orderBy('id','desc')
->value('id');



$getLastIdDate = DB::table('child_note_for_fd_four_one_forms')
->where('pnote_fd_four_one_form',$getLastId)
//->where('serial_number',$nothiLists1->nothId)
->orderBy('id','desc')
->first();

if(!$getLastIdDate){

$mainCodeDate ='';

}else{


$mainCodeDate =App\Http\Controllers\Admin\CommonController::englishToBangla(date('d/m/y h:i:s', strtotime($getLastIdDate->created_at))).' '.$getLastIdDate->amPmValue;

}


?>
<tr>
<td>
    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-headingTwo">
            <div class="accordion-button collapsed"
                 data-bs-toggle="collapse"
                 data-bs-target="#flush-collapseccc{{ $key+1 }}">

                         <!-- new code for movement button --->


                              <span>
                                  <span style="line-height:3">
<span style="padding:5px; background-color:#879dd9; border-radius: 10px;">নথিঃ</span>  {{ $nothiLists->document_subject }}</span>
<br>
<span style="text-align:left;"> <span
style="padding:5px; background-color:#879dd9; border-radius: 10px;">নথি নম্বরঃ</span> {{ $nothiLists->main_sarok_number }}
<span style="padding:5px; background-color:#879dd9; border-radius: 10px;">শাখাঃ</span> {{ $nothiLists->document_branch }}</span><span class="movement">


    @if (Route::is('admin.dashboard'))

    @else
<button type="button" class="btn btn-primary btn-xs"
data-bs-toggle="modal"
data-original-title="" data-bs-target="#myModalfdFourOne{{ $key+1 }}">
নথি গতিবিধি
</button>
@endif

</span>
<br><br><span style="padding:5px; background-color:#879dd9; border-radius: 10px;">নোটের সর্বশেষ তারিখ: {{ $mainCodeDate }}</span>
</span>
                          </div>


@include('admin.documentMovementModal.fdFourOneModal')

                         <!-- end new code for movement button -->
            </div>
        </h2>
        <div id="flush-collapseccc{{ $key+1 }}"
             class="accordion-collapse collapse">
            <div class="accordion-body">
                <div class="d-flex mt-3">
                    <button onclick="location.href = '{{ route('addParentNote',['status'=>$nothiLists1->dakType,'dakId'=>$nothiLists1->dakId,'nothiId'=>$nothiLists->id]) }}';" class="btn btn-transparent ms-3" type="button">
                        <i class="fa fa-plus"></i>
                        নতুন নোট
                    </button>
                    <button class="btn btn-transparent ms-3" type="button">
                        <i class="fa fa-envelope"></i>
                        সকল নোট
                    </button>
                </div>
                <div class="card-body">

<?php

if($nothiLists1->dakType == 'fdFourOneForm'){






$allNoteListNew = DB::table('parent_note_for_fd_four_one_forms')->where('nothi_detail_id',$nothiLists1->dakId)
->where('serial_number',$nothiLists1->nothId)
// ->where('id',$nothiLists1->noteId)
->get();





}



?>
@if(count($allNoteListNew) > 0)
<ul>
@foreach($allNoteListNew as $key=>$allNoteListNews)
                  <li>  {{ App\Http\Controllers\Admin\CommonController::englishToBangla(($key+1)) }} .   <a href="{{ route('addChildNote', ['status' =>$nothiLists1->dakType,'parentId'=>$nothiLists1->dakId,'nothiId'=>$nothiLists1->nothId,'id' =>$allNoteListNews->id,'activeCode' => ($key+1)]) }}">{{ $allNoteListNews->subject }}</a> </li>
                        @endforeach
                    </ul>

                    @else


                    <p>কোন নোট পাওয়া যায়নি</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</td>
</tr>
@endif
@endforeach

<!-- end fd four form -->
