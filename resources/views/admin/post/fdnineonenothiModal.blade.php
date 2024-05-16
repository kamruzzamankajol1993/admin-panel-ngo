<!-- Modal -->
<div class="modal right fade bd-example-modal-lg"
     id="fdnineonemyModal{{ $allStatusData->id }}" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel2">
    <div class="modal-dialog modal-lg-custom"
         role="document">
        <div class="modal-content">
            <div class="modal-header">
			<button id="pp" class="btn btn-outline-danger btn-sm"><i class="fa fa-times" aria-hidden="true"></i></button>
                <h4 class="modal-title" id="myModalLabel2">
                    নথিসমূহ</h4>
            </div>

            <div class="modal-body">
                <h5>একশনঃ নথিতে উপস্থাপনঃ এফডি৯.১ (ওয়ার্ক পারমিট) </h5>
                <div class="row">
                    <div class="col-lg-6">
                        <h5>সকল নথি</h5>
                    </div>
                    <div class="col-lg-6" style="text-align: right;">
                        <button onclick="location.href = '{{ route('documentPresent.create') }}';" type="button"
                        class="btn btn-primary">
                    <i class="fa fa-plus"></i> নতুন
                    নথি তৈরি করুন
                </button>
                    </div>
                    <div class="col-lg-12 mt-3">
                        <div class="input-group">
                            <input class="form-control"  id="nothiSearchFdno{{ $allStatusData->id }}" type="text" placeholder="নথি খুজুন"><span
                                    class="input-group-text" ><i class="fa fa-search"> </i></span>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-3">
                        <div class="table-responsive">
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <table class="table table-striped" id="nothiSearchResultFdno{{ $allStatusData->id }}">
                                    <tbody>

                                        @foreach ($nothiList as $key=>$nothiLists)
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
                                                                                        style="padding:5px; background-color:#879dd9; border-radius: 10px;">নথি নম্বরঃ</span> {{ $nothiLists->main_sarok_number }}
                                                                            <span style="padding:5px; background-color:#879dd9; border-radius: 10px;">শাখাঃ</span> {{ $nothiLists->document_branch }}</span>
                                                                            </span>
                                                    </div>
                                                </h2>
                                                <div id="flush-collapse{{ $key+1 }}"
                                                     class="accordion-collapse collapse">
                                                    <div class="accordion-body">
                                                        <div class="d-flex mt-3">
                                                            <button onclick="location.href = '{{ route('addParentNote',['status'=>'fdNineOne','dakId'=>$allStatusData->id,'nothiId'=>$nothiLists->id]) }}';" class="btn btn-transparent ms-3" type="button">
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


  $allNoteListNew = DB::table('parent_note_for_fd_nine_ones')
  ->where('serial_number',$nothiLists->id)
  ->where('nothi_detail_id',$allStatusData->id)->get();



    ?>
    @if(count($allNoteListNew) > 0)
    <ul>
        @foreach($allNoteListNew as $key=>$allNoteListNews)
                                                          <li>  {{ App\Http\Controllers\Admin\CommonController::englishToBangla(($key+1)) }} .   <a href="{{ route('addChildNote', ['status' =>'fdNineOne','parentId'=>$allStatusData->id,'nothiId'=>$nothiLists->id,'id' =>$allNoteListNews->id,'activeCode' => ($key+1)]) }}">{{ $allNoteListNews->subject }}</a> </li>
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
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div><!-- modal -->
</div>
