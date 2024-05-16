<div class="modal right fade bd-example-modal-lg"
id="myModal223" role="dialog"
aria-labelledby="myModalLabel22">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
<button id="pp" class="btn btn-outline-danger btn-sm"><i class="fa fa-times" aria-hidden="true"></i></button>
    <h4 class="modal-title" id="myModalLabel2">
        অনুলিপি  </h4>
</div>
<?php

$nothiCopyList = DB::table('nothi_copies')->where('nothiId',$nothiId)
       ->where('nijOfficeId',$status)
       ->where('noteId',$id)->get();

    ?>
<div class="modal-body">
    <div class="card">

        <div class="card-body">
          <ul class="nav nav-tabs" id="icon-tab" role="tablist">
            <li class="nav-item"><a class="nav-link active" id="icon-home-tab" data-bs-toggle="tab" href="#icon-home133" role="tab" aria-controls="icon-home" aria-selected="true"><i class="icofont icofont-ui-home"></i>অফিসার খুজুন</a></li>
            <li class="nav-item"><a class="nav-link" id="profile-icon-tab" data-bs-toggle="tab" href="#profile-icon133" role="tab" aria-controls="profile-icon" aria-selected="false"><i class="icofont icofont-man-in-glasses"></i>অফিসার তথ্য নিজে লিখুন</a></li>
            <li class="nav-item"><a class="nav-link" id="contact-icon-tab" data-bs-toggle="tab" href="#contact-icon133" role="tab" aria-controls="contact-icon" aria-selected="false"><i class="icofont icofont-contacts"></i>বাছাইকৃত অফিসারগণ <span id="totalCopy">({{ count($nothiCopyList) }})</span></a></li>
          </ul>
          <div class="tab-content" id="icon-tabContent">
            <div class="tab-pane fade show active" id="icon-home133" role="tabpanel" aria-labelledby="icon-home-tab">


                <div id="sms2c"></div>
                    <div class="mb-3 mt-4">
                        <label class="form-label" for="">অফিসার খুজুন</label> <br>
                        <select class="form-control js-example-basic-single" style="width: 100%" name="" id="copyselfOfficerList">

                            @foreach($user as $users)
                            <option value="{{ $users->id }}">{{ $users->admin_name_ban }}</option>
                            @endforeach

                        </select>


                        <input type="hidden" id="snothiId3" value="{{ $nothiId }}"/>
                        <input type="hidden" id="sstatus3" value="{{ $status }}"/>


                        <input type="hidden" id="snoteId3" value="{{ $id }}"/>




                    </div>
                    <div class="mt-3">
                        <button class="btn btn-info-gradien"  id="copySelfOfficerAdd">সংরক্ষণ করুন</button>
                    </div>

            </div>
            <div class="tab-pane fade" id="profile-icon133" role="tabpanel" aria-labelledby="profile-icon-tab">
                <div id="sms22c"></div>
                <form action="" class="mt-4" id="registerSubmit3">
                    <div class="mb-3">
                        <label class="form-label" for="">অফিসার</label>
                         <input type="text" name="otherOfficerName" id="otherOfficerName3" class="form-control"/>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="">পদবি</label>
                         <input type="text" name="otherOfficerDesignation" id="otherOfficerDesignation3" class="form-control"/>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="">সংস্থার নাম</label>
                         <input type="text" name="organizationName" id="organizationName3" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="">কার্যালয়/ঠিকানা</label>
                         <input type="text" name="otherOfficerAddress" id="otherOfficerAddress3" class="form-control"/>
                    </div>


                    <div class="mb-3">
                        <label class="form-label" for="">দপ্তর/শাখা </label>
                         <input type="text" name="otherOfficerBranch" id="otherOfficerBranch3" class="form-control"/>
                    </div>


                    <div class="mb-3">
                        <label class="form-label" for="">ইমেইল </label>
                         <input type="text" name="otherOfficerEmail" id="otherOfficerEmail3" class="form-control"/>
                    </div>


                    <div class="mb-3">
                        <label class="form-label" for="">মোবাইল</label>
                         <input type="text" name="otherOfficerPhone" id="otherOfficerPhone3" class="form-control"/>
                    </div>

                    <div class="mt-3">
                        <a href="javascript:void(0)" class="btn btn-info-gradien" id="copyOtherOfficerAdd">সংরক্ষণ করুন</a>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="contact-icon133" role="tabpanel" aria-labelledby="contact-icon-tab">

<?php

$nothiCopyList = DB::table('nothi_copies')->where('nothiId',$nothiId)
       ->where('nijOfficeId',$status)
       ->where('noteId',$id)->get();

    ?>



                <table class="table table-borderless" id="tableListN3">

                    @if(count($nothiCopyList) == 0)
                    <tr>
                        <td>কোন ডাটা নাই </td>
</tr>
    @else

                    @foreach($nothiCopyList as $nothiPrapokLists)
                    <tr>
                        <td><span class="text-bold"><b>{{ $nothiPrapokLists->otherOfficerName }}</b></span> {{ $nothiPrapokLists->otherOfficerDesignation }}</td>
                        <td>

                            <a
                            href="javascript:void(0)"
                            id="delete-user13"
                            data-url="{{ route('copySelfOfficerAjaxDelete', $nothiPrapokLists->id) }}"
                            class="btn btn-danger"
                            ><i class="fa fa-trash delete-user1"></i></a>

                        </td>
                    </tr>
                    @endforeach
                    @endif
                  </table>
                  <form id="form" action="{{ route('copyStatusUpdate') }}" method="post" class="mt-4" >
@csrf
                    <input type="hidden" name="fnothiId" value="{{ $nothiId }}"/>
                    <input type="hidden" name="fnoteId" value="{{ $id }}"/>
                    <input type="hidden" name="fstatus" value="{{ $status }}"/>

                    <div class="d-flex flex-row-reverse mt-3">
                  <button class="btn btn-primary" type="submit">বাছাই সম্পন্ন করুন</button>
                    </div>
                  </form>
            </div>
          </div>
        </div>
      </div>
</div><!-- modal-content -->
</div><!-- modal-dialog -->
</div><!-- modal -->
</div>
