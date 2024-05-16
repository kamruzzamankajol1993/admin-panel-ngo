<tbody>

    @foreach ($searchResult as $key=>$nothiLists)
<tr>
    <td>
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingTwo">
                <div class="accordion-button collapsed"
                     data-bs-toggle="collapse"
                     data-bs-target="#flush-collapse{{ $key+1 }}">
                                        <span>
                                                                                                                        <span style="line-height:3">
                            <span style="padding:5px; background-color:#879dd9; border-radius: 10px;">নথিঃ</span>  {{ $nothiLists->document_subject }}</span>
                                        <br>
                                        <span style="text-align:left;"> <span
                                                    style="padding:5px; background-color:#879dd9; border-radius: 10px;">নথি নম্বরঃ</span> {{ App\Http\Controllers\Admin\CommonController::englishToBangla('১১.২২.৩৩৩৩.৪৪৪.৫৫.'.$nothiLists->document_number) }}
                                        <span style="padding:5px; background-color:#879dd9; border-radius: 10px;">শাখাঃ</span> {{ $nothiLists->document_branch }}</span>
                                        </span>
                </div>
            </h2>
            <div id="flush-collapse{{ $key+1 }}"
                 class="accordion-collapse collapse">
                <div class="accordion-body">
                    <div class="d-flex mt-3">
                        <button onclick="location.href = '{{ route('addParentNote',['status'=>$status,'dakId'=>$dakId,'nothiId'=>$nothiLists->id]) }}';" class="btn btn-transparent ms-3" type="button">
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


  $allNoteListNew = DB::table('parent_note_for_name_changes')
  ->where('nothi_detail_id',$dakId)->get();



    ?>
    @if(count($allNoteListNew) > 0)
    @foreach($allNoteListNew as $key=>$allNoteListNews)
                                                        {{ App\Http\Controllers\Admin\CommonController::englishToBangla(($key+1)) }} .   <a href="{{ route('addChildNote', ['status' =>$status,'parentId'=>$dakId,'nothiId'=>$nothiLists->id,'id' =>$allNoteListNews->id,'activeCode' => ($key+1)]) }}">{{ $allNoteListNews->subject }}</a>
                                                            @endforeach

                                                            @else


                                                            <p>কোন নোট পাওয়া যায়নি</p>
                                                            @endif



                    </div>
                </div>
            </div>
        </div>
    </td>
</tr>
@endforeach
</tbody>
