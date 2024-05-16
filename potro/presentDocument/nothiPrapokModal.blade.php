<!-- Modal -->
<div class="modal right fade bd-example-modal-lg"
id="myModal22" role="dialog"
aria-labelledby="myModalLabel22">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
    <h4 class="modal-title" id="myModalLabel2">
        প্রাপক </h4>
</div>

<div class="modal-body">
    <div class="card">

        <div class="card-body">
          <ul class="nav nav-tabs" id="icon-tab" role="tablist">
            <li class="nav-item"><a class="nav-link active" id="icon-home-tab" data-bs-toggle="tab" href="#icon-home1" role="tab" aria-controls="icon-home" aria-selected="true"><i class="icofont icofont-ui-home"></i>অফিসার খুজুন</a></li>
            <li class="nav-item"><a class="nav-link" id="profile-icon-tab" data-bs-toggle="tab" href="#profile-icon1" role="tab" aria-controls="profile-icon" aria-selected="false"><i class="icofont icofont-man-in-glasses"></i>অফিসার তথ্য নিজে লিখুন</a></li>
            <li class="nav-item"><a class="nav-link" id="contact-icon-tab" data-bs-toggle="tab" href="#contact-icon1" role="tab" aria-controls="contact-icon" aria-selected="false"><i class="icofont icofont-contacts"></i>বাছাইকৃত অফিসারগণ </a></li>
          </ul>
          <div class="tab-content" id="icon-tabContent">
            <div class="tab-pane fade show active" id="icon-home1" role="tabpanel" aria-labelledby="icon-home-tab">


                <div id="sms2"></div>
                    <div class="mb-3 mt-4">
                        <label class="form-label" for="">অফিসার খুজুন</label> <br>
                        <select class="form-control js-example-basic-single" style="width: 100%" name="" id="selfOfficerList">

                            @foreach($user as $users)
                            <option value="{{ $users->id }}">{{ $users->admin_name_ban }}</option>
                            @endforeach

                        </select>


                        <input type="hidden" id="snothiId" value="{{ $nothiId }}"/>
                        <input type="hidden" id="sstatus" value="{{ $status }}"/>


                        <input type="hidden" id="snoteId" value="{{ $id }}"/>




                    </div>
                    <div class="mt-3">
                        <button class="btn btn-info-gradien"  id="selfOfficerAdd">সংরক্ষণ করুন</button>
                    </div>

            </div>
            <div class="tab-pane fade" id="profile-icon1" role="tabpanel" aria-labelledby="profile-icon-tab">
                <div id="sms22"></div>
                <form action="" class="mt-4" id="registerSubmit">
                    <div class="mb-3">
                        <label class="form-label" for="">অফিসার</label>
                         <input type="text" name="otherOfficerName" id="otherOfficerName" class="form-control"/>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="">পদবি</label>
                         <input type="text" name="otherOfficerDesignation" id="otherOfficerDesignation" class="form-control"/>
                    </div>


                    <div class="mb-3">
                        <label class="form-label" for="">কার্যালয়/ঠিকানা</label>
                         <input type="text" name="otherOfficerAddress" id="otherOfficerAddress" class="form-control"/>
                    </div>


                    <div class="mb-3">
                        <label class="form-label" for="">দপ্তর/শাখা </label>
                         <input type="text" name="otherOfficerBranch" id="otherOfficerBranch" class="form-control"/>
                    </div>


                    <div class="mb-3">
                        <label class="form-label" for="">ইমেইল </label>
                         <input type="text" name="otherOfficerEmail" id="otherOfficerEmail" class="form-control"/>
                    </div>


                    <div class="mb-3">
                        <label class="form-label" for="">মোবাইল</label>
                         <input type="text" name="otherOfficerPhone" id="otherOfficerPhone" class="form-control"/>
                    </div>

                    <div class="mt-3">
                        <a href="javascript:void(0)" class="btn btn-info-gradien" id="otherOfficerAdd">সংরক্ষণ করুন</a>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="contact-icon1" role="tabpanel" aria-labelledby="contact-icon-tab">

<?php

$nothiPrapokList = DB::table('nothi_prapoks')
->where('nothiId',$nothiId)
       ->where('nijOfficeId',$status)
       ->where('noteId',$id)->get();

    ?>



                <table class="table table-borderless" id="tableListN">

                    @if(count($nothiPrapokList) == 0)
                    <tr>
                        <td>কোন ডাটা নাই </td>
</tr>
    @else

                    @foreach($nothiPrapokList as $nothiPrapokLists)
                    <tr>
                        <td><span class="text-bold"><b>{{ $nothiPrapokLists->otherOfficerName }}</b></span> {{ $nothiPrapokLists->otherOfficerDesignation }}</td>
                        <td>

                            <a
                            href="javascript:void(0)"
                            id="delete-user1"
                            data-url="{{ route('selfOfficerAjaxDelete', $nothiPrapokLists->id) }}"
                            class="btn btn-danger"
                            ><i class="fa fa-trash delete-user1"></i></a>

                        </td>
                    </tr>
                    @endforeach
                    @endif
                  </table>
                  <form action="{{ route('prapokStatusUpdate') }}" method="post" class="mt-4" >
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
