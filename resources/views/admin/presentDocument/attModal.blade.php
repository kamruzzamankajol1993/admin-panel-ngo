<div class="modal fade" id="myModalatt" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">সংযুক্তি
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">


            <form id="form" method="post" action="{{ route('addParentAttachmentNew') }}" enctype="multipart/form-data">
                @csrf
 <input type="hidden" name="lastChild"  id="newlastv" value=""/>
                <input type="hidden" name="snothiId" value="{{ $nothiId }}"/>
                <input type="hidden" name="sstatus" value="{{ $status }}"/>
                <input type="hidden" name="snoteId" value="{{ $id }}"/>
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-4">
                            <label for="formrow-email-input" class="form-label">ফাইলের নাম </label>
                            <input type="text" name="name"  class="form-control" placeholder="ফাইলের নাম" required>
                            <small></small>
                        </div>
                    </div>

                     <div class="col-md-12">
                        <div class="mb-4">
                            <label for="formrow-email-input" class="form-label">ফাইল</label>
                            <input type="file" accept=".pdf" name="file"  class="form-control" placeholder="ফাইল" required>
                            <small></small>
                        </div>
                    </div>




</div>






                <div>
                    <button type="submit" class="btn btn-primary w-md mt-4">জমা দিন  </button>
                </div>


            </form>
        </div>

      </div>
    </div>
  </div>
