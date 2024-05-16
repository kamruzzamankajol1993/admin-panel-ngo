


<div class="modal right fade bd-example-modal-lg"
     id="modalforsender"  role="dialog"
     aria-labelledby="myModalLabel2">
    <div class="modal-dialog modal-lg-custom" role="document">
        <div class="modal-content">
            <div class="modal-header">
			<button id="pp" class="btn btn-outline-danger btn-sm"><i class="fa fa-times" aria-hidden="true"></i></button>
                <h4 class="modal-title">
                    পরবর্তী কার্যক্রমের জন্যে প্রেরণ করুন
                    <br>
                    <small> <span style="background: gray; border-radius: 5px; padding: 2px 5px;">

                        @foreach($checkParent as $key=>$checkParents)

                        @if($checkParents->id == $id)
                        নোট {{ App\Http\Controllers\Admin\CommonController::englishToBangla($key+1) }}:
                        @else

                        @endif
                        @endforeach


                    </span> {{$checkParentFirst->subject }}</small>
                </h4>
            </div>

            <div class="modal-body">
                <div class="card">
                    <div class="card-body">

                    </div>
                </div>
            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div><!-- modal -->
</div>
