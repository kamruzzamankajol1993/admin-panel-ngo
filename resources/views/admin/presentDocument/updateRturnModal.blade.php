<div class="modal fade" id="exampleModalr4r{{ $childNoteNewLists->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header flex-column">
                <div class="icon-box">
                    <i class="fa fa-close"></i>
                </div>
                <h4 class="modal-title w-100">আপনি কি নিশ্চিত?</h4>
        <a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>

            </div>
            <div class="modal-body">
                <p>আপনি কি সত্যিই এই রেকর্ড ফেরত আনতে চান? এই প্রক্রিয়া পূর্বাবস্থায় ফেরানো যাবে না.</p>
            </div>
            <div class="modal-footer justify-content-center">
                <a type="button" class="btn btn-secondary" data-bs-dismiss="modal">বাতিল করুন </a>

                <form action="{{ route('saveNothiPermission') }}" method="post" id="form">

                    @csrf


                    <?php
                    $receiverId = DB::table('nothi_details')
                                                ->where('noteId',$id)
                                                ->where('nothId',$nothiId)
                                                ->where('dakId',$parentId)
                                                ->where('dakType',$status)
                                                ->where('childId',$childNoteNewLists->id)
                                                ->where('sender',Auth::guard('admin')->user()->id)
                                                ->value('receiver');
                    ?>

                    <input type="hidden" value="{{ $childNoteNewLists->id }}" placeholder="নোট এর বিষয়" class="form-control" name="child_note_id" id=""/>


                    <input type="hidden" value="0" placeholder="নোট এর বিষয়" class="form-control" name="first_sender" id=""/>


                    <input type="hidden" value="{{ $status }}" placeholder="নোট এর বিষয়" class="form-control" name="status" id=""/>
                    <input type="hidden" value="{{ $parentId }}" placeholder="নোট এর বিষয়" class="form-control" name="dakId" id=""/>
                    <input type="hidden" value="{{ $nothiId }}" placeholder="নোট এর বিষয়" class="form-control" name="nothiId" id=""/>

                    <input type="hidden" value="{{ $id }}" placeholder="নোট এর বিষয়" class="form-control" name="noteId" id=""/>
                <button type="submit" name="button_value" value="return" class="btn btn-danger">ফেরত আনুন</button>
                </form>
            </div>
        </div>
    </div>
</div>
