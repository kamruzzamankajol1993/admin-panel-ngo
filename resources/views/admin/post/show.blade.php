@extends('admin.master.master')

@section('title')
ডাক প্রেরণ | {{ $ins_name }}
@endsection


@section('css')
<style>
    * { margin: 0; padding: 0; }

#page-wrap {
  margin: auto 0;
}

.treeview {
  margin: 10px 0 0 20px;
}

ul {
  list-style: none;
}

.treeview li {
  background: url(http://jquery.bassistance.de/treeview/images/treeview-default-line.gif) 0 0 no-repeat;
  padding: 2px 0 2px 16px;
}

.treeview > li:first-child > label {
  /* style for the root element - IE8 supports :first-child
  but not :last-child ..... */

}

.treeview li.last {
  background-position: 0 -1766px;
}

.treeview li > input {
  height: 16px;
  width: 16px;
  /* hide the inputs but keep them in the layout with events (use opacity) */
  opacity: 0;
  filter: alpha(opacity=0); /* internet explorer */
  -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(opacity=0)"; /*IE8*/
}

.treeview li > label {
  background: url(http://www.thecssninja.com/demo/css_custom-forms/gr_custom-inputs.png) 0 -1px no-repeat;
  /* move left to cover the original checkbox area */
  margin-left: -20px;
  /* pad the text to make room for image */
  padding-left: 20px;
}

/* Unchecked styles */

.treeview .custom-unchecked {
  background-position: 0 -1px;
}
.treeview .custom-unchecked:hover {
  background-position: 0 -21px;
}

/* Checked styles */

.treeview .custom-checked {
  background-position: 0 -81px;
}
.treeview .custom-checked:hover {
  background-position: 0 -101px;
}

/* Indeterminate styles */

.treeview .custom-indeterminate {
  background-position: 0 -141px;
}
.treeview .custom-indeterminate:hover {
  background-position: 0 -121px;
}
</style>
@endsection

@section('body')
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <h3>ডাক প্রেরণ </h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">হোম</a></li>
                    <li class="breadcrumb-item">ডাক </li>
                    <li class="breadcrumb-item">ডাক প্রেরণ করুন</li>
                </ol>
            </div>
            <div class="col-sm-6">
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid starts-->
<div class="container-fluid list-products">
    <div class="row">
        <!-- Individual column searching (text inputs) Starts-->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>ডাক প্রেরণ করুন</h5>
                    @include('flash_message')
                </div>
                <form  class="custom-validation" action="{{ route('dakListSecondStep') }}" method="post" enctype="multipart/form-data" id="form" data-parsley-validate="">
                    @csrf

                    <input type="hidden" name="access_id" value="{{ $newMainDaKId }}" />
                    <div class="card-body">
                        <h5>সিদ্ধান্ত: বিধি মোতাবেক ব্যবস্থা নিন।</h5>
                        <div class="nothi_header_box">
                            <span>সিদ্ধান্ত নিন <span style="color:red;">*</span></span>
                        </div>
                        <div class="form-group mt-3 m-checkbox-inline mb-0 custom-radio-ml">
                            <div class="radio radio-primary">
                                <input id="radioinline1" type="radio" class="decision_list" name="decision_list" value="বিধি মোতাবেক ব্যবস্থা নিন" required>
                                <label class="mb-0" for="radioinline1">বিধি মোতাবেক ব্যবস্থা নিন</label>
                            </div>
                            <div class="radio radio-primary">
                                <input id="radioinline2" type="radio" class="decision_list" name="decision_list" value="নথিতে উপস্থাপন করুন" required>
                                <label class="mb-0" for="radioinline2">নথিতে উপস্থাপন করুন</label>
                            </div>
                            <div class="radio radio-primary">
                                <input id="radioinline3" type="radio" class="decision_list" name="decision_list" value="নথিজাত করুন" required>
                                <label class="mb-0" for="radioinline3">নথিজাত করুন</label>
                            </div>
                            <div class="radio radio-primary">
                                <input id="own_decision" type="radio" class="decision_list" name="decision_list" value="সিদ্ধান্ত নিজে লিখুন" required>
                                <label class="mb-0" for="own_decision">সিদ্ধান্ত নিজে লিখুন </label>
                            </div>
                        </div>

                        <div id="decision_list_detail">

                        </div>

                        <!--<input type="text" placeholder="সিদ্ধান্ত নিজে লিখুন " class="form-control digits mt-3" style="display: none;" name="decision_list_detail" id="decision_list_detail"/>-->
                        {{-- <select class="form-select digits mt-3" style="display: none;" name="decision_list_detail" id="decision_list_detail" >
                            <option value="">-- অনুগ্রহ করে নির্বাচন করুন --</option>
                            <option value="দেখলাম কাজ শুরু হচ্ছে">দেখলাম কাজ শুরু হচ্ছে</option>
                            <option value="পেশ করুন">পেশ করুন</option>
                            <option value="তদন্ত পূর্বক প্রতিবেদন দিবেন">তদন্ত পূর্বক প্রতিবেদন দিবেন</option>
                            <option value="দেখলাম পেশ করুন">দেখলাম পেশ করুন</option>
                            <option value="নথিজাত করুন">নথিজাত করুন</option>
                        </select> --}}
                        <div class="nothi_header_box" id="mm2">
                            <span id="result_one">বিধি মোতাবেক ব্যবস্থা নিন</span><span style="color:red;">*</span>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-sm-12">
                                <div class="mb-3">
                                    <label class="form-label"
                                           for="exampleInputPassword21">অগ্রাধিকার <span style="color:red;">*</span></label>
                                    <select class="form-select digits" name="priority_list" id="exampleFormControlSelect9" required>
                                        <option value="">-- অনুগ্রহ করে নির্বাচন করুন --</option>
                                        <option value="সর্বোচ্চ  অগ্রাধিকার">সর্বোচ্চ অগ্রাধিকার</option>
                                        <option value="অবিলম্বে">অবিলম্বে</option>
                                        <option value="জরুরি">জরুরি</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleInputPassword21">গোপনীয়তা <span style="color:red;">*</span></label>
                                    <select class="form-select digits" name="secret_list" id="secret_listNew" required>

                                        <option value="">গোপনীয়তা বাছাই করুন</option>
                                        <option value="অতি গোপনীয়">অতি গোপনীয়</option>
                                        <option value="বিশেষ গোপনীয়">বিশেষ গোপনীয়</option>
                                        <option value="গোপনীয়">গোপনীয়</option>
                                        <option value="সীমিত">সীমিত</option>
                                    </select>
                                </div>
                                <input value="{{ $mainstatus}}" type="hidden" name="mainstatus"/>
                            </div>
                        </div>
                        <div class=" nothi_header_box">
                            <span >প্রাপক  <span style="color:red;">*</span></span>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row-reverse bd-highlight">
                                    {{-- <button  type="submit" class="btn btn-primary"><i class="fa fa-send"></i>
                                        প্রেরন
                                    </button> --}}


                                    <a class="btn btn-outline-success me-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa fa-plus"></i> নতুন
                                        সিল বানান
                                    </a>



                                </div>
                                <ul class="nav nav-tabs" id="icon-tab" role="tablist">
                                    <li class="nav-item"><a class="nav-link active" id="icon-home-tab"
                                                            data-bs-toggle="tab" href="#icon-home1"
                                                            role="tab" aria-controls="icon-home"
                                                            aria-selected="true"><i
                                                    class="icofont icofont-ui-home"></i>নিজ অফিস</a></li>
                                </ul>
                                <div class="tab-content" id="icon-tabContent">
                                    <div class="tab-pane fade show active" id="icon-home1" role="tabpanel"
                                         aria-labelledby="icon-home-tab">
                                         <p id="deleteStatuss"></p>
                                        <table class="table table-bordered mt-3">
                                            <tr>
                                                <th>
                                                    {{-- <button class="btn btn-outline-success">#</button> --}}
                                                </th>
                                                <th>পদবী</th>
                                                <th>নাম</th>
                                                <th>মূল-প্রাপক</th>
                                                <th>কার্যার্থে অনুলিপি</th>
                                                <th>জ্ঞাতার্থে অনুলিপি</th>
                                                <th>দৃষ্টি আকর্ষণ</th>
                                            </tr>
                                            @foreach($allRegistrationDak as $showAllRegistrationDak)

                                            <?php
                                            $adminName = DB::table('admins')
                                            ->where('id',$showAllRegistrationDak->receiver_admin_id)->value('admin_name_ban');

                                            $designationId = DB::table('admin_designation_histories')
                                            ->where('admin_id',$showAllRegistrationDak->receiver_admin_id)
                                            ->value('designation_list_id');

                                            $designationName = DB::table('designation_lists')
                                            ->where('id',$designationId)->value('designation_name');

                                            $branchId = DB::table('designation_lists')
                                            ->where('id',$designationId)->value('branch_id');

                                            $branchName = DB::table('branches')
                                            ->where('id',$branchId)->value('branch_name');
?>
                                            <tr>
                                                <td>
                                                    {{-- <div class="d-flex justify-content-center">
                                                        <button class="btn btn-outline-success"><i class="fa fa-trash"></i></button>
                                                    </div> --}}


                                                    <div class="d-flex justify-content-center">

                                                        <button data-id="{{ $showAllRegistrationDak->id }}" data-status="{{ $mainstatus }}" class="btn btn-outline-success remove-input-field-newmm"><i class="fa fa-trash"></i></button>
                                                    </div>


                                                </td>
                                                <td>{{ $branchName }}, {{ $designationName }}
                                                </td>
                                                <td>{{ $adminName }}</td>
                                                <td>

                                                    <input value="{{ $showAllRegistrationDak->id }}" type="hidden" name="receiverId[{{ $showAllRegistrationDak->id }}]"/>
                                                    <input value="{{ $showAllRegistrationDak->id }}" type="hidden" name="receiverIdAjax[]"/>

                                                    <div class="d-flex justify-content-center">


                                                        <div class="custom_checkbox">
                                                            <input id="mmcheck{{ $showAllRegistrationDak->id }}" class="custom_check main_prapok"
                                                                   type="checkbox" name="main_prapok{{ $showAllRegistrationDak->id }}[{{ $showAllRegistrationDak->id }}]" value="1" data-mid="{{ $showAllRegistrationDak->id }}" />
                                                            <label for="mmcheck{{ $showAllRegistrationDak->id }}" style="--d: 30px">
                                                                <svg viewBox="0,0,50,50">
                                                                    <path d="M5 30 L 20 45 L 45 5"></path>
                                                                </svg>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <div class="custom_checkbox">
                                                            <input id="check{{ $showAllRegistrationDak->id }}" class="custom_check karjo_onulipi"
                                                                   type="checkbox" name="karjo_onulipi{{ $showAllRegistrationDak->id }}[{{ $showAllRegistrationDak->id }}]" value="1" data-mid="{{ $showAllRegistrationDak->id }}" />
                                                            <label for="check{{ $showAllRegistrationDak->id }}" style="--d: 30px">
                                                                <svg viewBox="0,0,50,50">
                                                                    <path d="M5 30 L 20 45 L 45 5"></path>
                                                                </svg>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <div class="custom_checkbox">
                                                            <input id="icheck{{ $showAllRegistrationDak->id }}" class="custom_check info_onulipi"
                                                                   type="checkbox" name="info_onulipi{{ $showAllRegistrationDak->id }}[{{ $showAllRegistrationDak->id }}]" value="1" data-mid = "{{ $showAllRegistrationDak->id }}" />
                                                            <label for="icheck{{ $showAllRegistrationDak->id }}" style="--d: 30px">
                                                                <svg viewBox="0,0,50,50">
                                                                    <path d="M5 30 L 20 45 L 45 5"></path>
                                                                </svg>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <div class="custom_checkbox">
                                                            <input id="echeck{{ $showAllRegistrationDak->id }}" class="custom_check eye_onulipi"
                                                                   type="checkbox" data-mid = "{{ $showAllRegistrationDak->id }}" value="1"  name="eye_onulipi{{ $showAllRegistrationDak->id }}[{{ $showAllRegistrationDak->id }}]"/>
                                                            <label for="echeck{{ $showAllRegistrationDak->id }}" style="--d: 30px">
                                                                <svg viewBox="0,0,50,50">
                                                                    <path d="M5 30 L 20 45 L 45 5"></path>
                                                                </svg>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>





<div class="nothi_header_box">
    <span>মন্তব্য এবং ফাইল আপলোড করুন </span>
</div>


<div class="card">
                                        <div class="card-body">


                                            <div class="mt-2 mb-2">


                                                <div class="row mt-3">
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="">মন্তব্য</label>
                                                            <input name="comment" class="form-control" id=""
                                                                   type="text">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="">ফাইল
                                                                আপলোড</label>
                                                            <input name="main_file" accept="application/pdf" class="form-control" id=""
                                                                   type="file">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-flex flex-row-reverse" id="lastButton">


                                                @if(count($allRegistrationDak) == 0 )
                                                <a class="btn btn-danger"  >
                                                    <i class="fa fa-send"></i>
                                              প্রেরণ এর পূর্বে, দয়া করে সিল তৈরী  করুন
                                                </a>

                                                @else
                                                <button class="btn btn-primary" type="submit" >
                                                    <i class="fa fa-send"></i>
                                                    প্রেরন
                                                </button>
                                                @endif
                                            </div>

                                        </div>
                                    </div>








                    </div>




            </div>
        </div>
        <!-- Individual column searching (text inputs) Ends-->
    </div>
</div>
<!-- Container-fluid Ends-->

<!-- new modal start--->
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">সীল তৈরি করুন</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>পদবি নির্বাচন করুন</h5>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-dark" id="pills-darktab" role="tablist">
                                <li class="nav-item"><a class="nav-link active"
                                                        id="pills-darkhome-tab"
                                                        data-bs-toggle="pill" href="#pills-darkhome"
                                                        role="tab" aria-controls="pills-darkhome"
                                                        aria-selected="true"><i
                                                class="icofont icofont-ui-home"></i>নিজ অফিসের
                                        পদসমূহ</a></li>
                            </ul>
                            <div class="tab-content" id="pills-darktabContent">
                                <div class="tab-pane fade show active" id="pills-darkhome"
                                     role="tabpanel" aria-labelledby="pills-darkhome-tab">
                                    <div class="podobi_tab mt-4">


                                        <h6>এনজিও বিষয়ক ব্যুরো শাখা {{ App\Http\Controllers\Admin\CommonController::englishToBangla($totalBranch) }} টি, পদ {{ App\Http\Controllers\Admin\CommonController::englishToBangla($totalDesignation) }} টি, শূন্যপদ {{ App\Http\Controllers\Admin\CommonController::englishToBangla($totalEmptyDesignation) }}টি,
                                            কর্মরত {{ App\Http\Controllers\Admin\CommonController::englishToBangla($totalDesignationWorking) }} জন</h6>
                                        <ul class="treeview">
                                            <input type="hidden" value="{{ $newMainDaKId }}" id="newMainDaKId" name="main_id"/>
                                            <input type="hidden" value="{{ $mainstatus }}" id="mainstatus" name="mainstatus"/>

                                            @foreach($totalBranchList as $key=>$allTotalBranchList)

                                            <?php
                                            $desiList = DB::table('designation_lists')
                                            ->where('id','!=',1)
                                                  ->where('branch_id',$allTotalBranchList->id)
                                                  ->orderBy('designation_serial','asc')
                                                  ->get();
                                                   ?>


                                            <li>
                                                <input disabled type="checkbox" class="passBranch1" value="{{ $allTotalBranchList->id }}" data-status="branch" name="branch_name[]" id="branch_name{{ $allTotalBranchList->id }}">
                                                <label for="branch_name{{ $allTotalBranchList->id }}" class="custom-unchecked">   {{ $allTotalBranchList->branch_name }}</label>

                                                <ul>
                                                    @foreach($desiList as $key=>$allDesiList)
                                                    <?php

                                                    $checkDesiId = DB::table('admin_designation_histories')->where('designation_list_id',$allDesiList->id)->first();

?>
                                                   @if(!$checkDesiId)
                                                     <li>
                                                         <input disabled type="checkbox" value="{{ $allDesiList->id }}" name="designation[]" id="designation{{ $allDesiList->id }}">
                                                         <label for="designation{{ $allDesiList->id }}" class="custom-unchecked"> শূন্য পদ ({{ $allDesiList->designation_name }})</label>
                                                     </li>

                                                     @else
                                                     <li>

                                                        <input type="hidden" value="{{ $allTotalBranchList->id }}"  name="branchId[]" id="branchId{{ $allDesiList->id }}">


                                                        <?php
                                                        $adminName = DB::table('admins')->where('id',$checkDesiId->admin_id)->value('admin_name_ban');
?>
@if(Auth::guard('admin')->user()->id == $checkDesiId->admin_id)
                                                        <input type="checkbox" disabled class="passBranch1" data-bId="{{ $allTotalBranchList->id }}" data-status="desi" value="{{ $allDesiList->id }}" name="designation[]" id="designation{{ $allDesiList->id }}">
                                                        @else

                                                        <input type="checkbox" class="passBranch1" data-bId="{{ $allTotalBranchList->id }}" data-status="desi" value="{{ $allDesiList->id }}" name="designation[]" id="designation{{ $allDesiList->id }}">
                                                        @endif
                                                        <label for="designation{{ $allDesiList->id }}" class="custom-unchecked">

                                                         {{ $adminName }} ({{ $allDesiList->designation_name }})</label>
                                                    </li>
                                                     @endif
                                                     @endforeach

                                                     {{-- <li class="last">
                                                         <input type="checkbox" name="tall-3" id="tall-3">
                                                         <label for="tall-3" class="custom-unchecked">Two sandwiches</label>
                                                     </li> --}}
                                                </ul>
                                            </li>
                                            @endforeach
                                            {{-- <li class="last">
                                                <input type="checkbox" class="passBranch1" value="2" name="short" id="short">
                                                <label for="short" class="custom-unchecked">Short Things</label>

                                                <ul>
                                                     <li>
                                                         <input type="checkbox" name="short-1" id="short-1">
                                                         <label for="short-1" class="custom-unchecked">Smurfs</label>
                                                     </li>
                                                     <li>
                                                         <input type="checkbox" name="short-2" id="short-2">
                                                         <label for="short-2" class="custom-unchecked">Mushrooms</label>
                                                     </li>
                                                     <li class="last">
                                                         <input type="checkbox" name="short-3" id="short-3">
                                                         <label for="short-3" class="custom-unchecked">One Sandwich</label>
                                                     </li>
                                                </ul>
                                            </li> --}}
                                        </ul>



                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>নির্বাচিত পদসমূহ</h5>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-dark" id="pills-darktab" role="tablist">
                                <li class="nav-item"><a class="nav-link active"
                                                        id="pills-darkhome-tab"
                                                        data-bs-toggle="pill" href="#pills-darkhome"
                                                        role="tab" aria-controls="pills-darkhome"
                                                        aria-selected="true"><i
                                                class="icofont icofont-ui-home"></i>নিজ অফিসের
                                        পদসমূহ</a></li>
                            </ul>
                            <div class="tab-content" id="pills-darktabContent">
                                <div class="tab-pane fade show active" id="pills-darkhome"
                                     role="tabpanel" aria-labelledby="pills-darkhome-tab">
                                    <div class="podobi_tab mt-4" id="final_result">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            {{-- <button type="button" id="finalMainPage" class="btn btn-success">দাখিল করুন </button> --}}
          <!--<button type="button" class="btn btn-primary" data-bs-dismiss="modal">বন্ধ করুন</button>-->

        </div>
      </div>
    </div>
  </div>

<!-- end new modal --->
@endsection


@section('script')

<script>
    $(document).on('click', '.remove-input-field-newmm', function () {
        //$(this).parents('tr').remove();

           var id = $(this).data('id');
           var status = $(this).data('status');

           //deleteMemberListAjax

           $(this).parents('tr').remove();
           $.ajax({
            url: "{{ route('deleteMemberListAjax') }}",
            method: 'GET',
            data: {id:id,status:status},
            success: function(data) {

               // alert(data);

  if(data  >= 1){

                                     $("#lastButton").html('<button class="btn btn-primary" type="submit" ><i class="fa fa-send"></i>প্রেরণ</button>');

                }else{

                                     $("#lastButton").html('<a class="btn btn-danger"><i class="fa fa-send"></i>প্রেরণ এর পূর্বে, দয়া করে সিল তৈরী  করুন</a>');
                }

                // $("#serial_part_one"+id_for_pass).val(data);
                 $("#deleteStatuss").html('<div class="alert" style=" padding: 20px;background-color: #f44336 !important;color: white;"><strong>ডেটা সফলভাবে মুছে ফেলা হয়েছে</strong></div>');




            }
            });



    });


    setTimeout(function(){
  $('#deleteStatuss').remove();
}, 10000);
    </script>


<script>

    $(function() {

    $('input[type="checkbox"]').change(checkboxChanged);

    function checkboxChanged() {
      var $this = $(this),
          checked = $this.prop("checked"),
          container = $this.parent(),
          siblings = container.siblings();

      container.find('input[type="checkbox"]')
      .prop({
          indeterminate: false,
          checked: checked
      })
      .siblings('label')
      .removeClass('custom-checked custom-unchecked custom-indeterminate')
      .addClass(checked ? 'custom-checked' : 'custom-unchecked');

      checkSiblings(container, checked);
    }

    function checkSiblings($el, checked) {
      var parent = $el.parent().parent(),
          all = true,
          indeterminate = false;

      $el.siblings().each(function() {
        return all = ($(this).children('input[type="checkbox"]').prop("checked") === checked);
      });

      if (all && checked) {
        parent.children('input[type="checkbox"]')
        .prop({
            indeterminate: false,
            checked: checked
        })
        .siblings('label')
        .removeClass('custom-checked custom-unchecked custom-indeterminate')
        .addClass(checked ? 'custom-checked' : 'custom-unchecked');

        checkSiblings(parent, checked);
      }
      else if (all && !checked) {
        indeterminate = parent.find('input[type="checkbox"]:checked').length > 0;

        parent.children('input[type="checkbox"]')
        .prop("checked", checked)
        .prop("indeterminate", indeterminate)
        .siblings('label')
        .removeClass('custom-checked custom-unchecked custom-indeterminate')
        .addClass(indeterminate ? 'custom-indeterminate' : (checked ? 'custom-checked' : 'custom-unchecked'));

        checkSiblings(parent, checked);
      }
      else {
        $el.parents("li").children('input[type="checkbox"]')
        .prop({
            indeterminate: true,
            checked: false
        })
        .siblings('label')
        .removeClass('custom-checked custom-unchecked custom-indeterminate')
        .addClass('custom-indeterminate');
      }
    }
    });


    //new code
    $(document).on('click', '.passBranch1', function(){


        var mainId = $('#newMainDaKId').val();
        var mainstatus = $(this).data('status');


        var mainStatusNew = $('#mainstatus').val();




        var totalBranch = $('input[name="branch_name[]"]:checked').map(function (idx, ele) {
       return $(ele).val();
    }).get();


    var totalDesi = $('input[name="designation[]"]:checked').map(function (idx, ele) {
    return $(ele).val();
    }).get();




    console.log(mainstatus);
    console.log(totalBranch);
    console.log(totalDesi);




    $.ajax({
            url: "{{ route('showDataDesignationWise') }}",
            method: 'GET',
            data: {mainStatusNew:mainStatusNew,mainId:mainId,mainstatus:mainstatus,totalBranch:totalBranch,totalDesi:totalDesi},
            success: function(data) {



                // $("#serial_part_one"+id_for_pass).val(data);
                 $("#final_result").html(data);




            }
            });

    });

    //new branch all






    </script>

<script>

$(document).on('click', '.main_prapok', function(){

    var mainPrapokId = $(this).data('mid');

    $('input.main_prapok').not(this).prop('checked', false);



    if($(this).is(':checked')){


$("#check"+mainPrapokId).prop('checked', false);
$("#icheck"+mainPrapokId).prop('checked', false);
$("#echeck"+mainPrapokId).prop('checked', false);


}



// //     alert(mainPrapokId);


//     var receiver_id_ajax = $('input[name="receiverIdAjax[]"]').map(function (idx, ele) {
//    return $(ele).val();
// }).get();

// var receiver_id_ajax_new = $.grep(receiver_id_ajax, function(value) {
//   return value != mainPrapokId;
// });

// //alert(y);

// for (var i = 0; i < receiver_id_ajax_new.length; i++) {


//     $("#check"+receiver_id_ajax_new[i] << 0).removeAttr('disabled');
//     $("#icheck"+receiver_id_ajax_new[i] << 0).removeAttr('disabled');
//     $("#echeck"+receiver_id_ajax_new[i] << 0).removeAttr('disabled');

// }


//     if($(this).is(':checked')){

//     $("#check"+mainPrapokId).attr('disabled', 'disabled');
//     $("#icheck"+mainPrapokId).attr('disabled', 'disabled');
//     $("#echeck"+mainPrapokId).attr('disabled', 'disabled');
//     }else{

//     $("#check"+mainPrapokId).removeAttr('disabled');
//     $("#icheck"+mainPrapokId).removeAttr('disabled');
//     $("#echeck"+mainPrapokId).removeAttr('disabled');

//     }
});

/////
//karjo_onulipi
$(document).on('click', '.karjo_onulipi', function(){

    var mainPrapokId = $(this).data('mid');



    if($(this).is(':checked')){


$("#check"+mainPrapokId).prop('checked', true);
$("#mmcheck"+mainPrapokId).prop('checked', false);
$("#icheck"+mainPrapokId).prop('checked', false);
$("#echeck"+mainPrapokId).prop('checked', false);


}

});

//info_onulipi

$(document).on('click', '.info_onulipi', function(){

var mainPrapokId = $(this).data('mid');



if($(this).is(':checked')){


$("#check"+mainPrapokId).prop('checked', false);
$("#mmcheck"+mainPrapokId).prop('checked', false);
$("#icheck"+mainPrapokId).prop('checked', true);
$("#echeck"+mainPrapokId).prop('checked', false);


}

});


//eye_onulipi

$(document).on('click', '.eye_onulipi', function(){

var mainPrapokId = $(this).data('mid');

//alert(mainPrapokId);

if($(this).is(':checked')){


$("#check"+mainPrapokId).prop('checked', false);
$("#mmcheck"+mainPrapokId).prop('checked', false);
$("#icheck"+mainPrapokId).prop('checked', false);
$("#echeck"+mainPrapokId).prop('checked', true);


}

});

//decision list

$(document).on('click', '.decision_list', function(){

    var decisionVal = $(this).val();



    if(decisionVal == 'সিদ্ধান্ত নিজে লিখুন'){

        $('#decision_list_detail').html('<input type="text" placeholder="সিদ্ধান্ত নিজে লিখুন " class="form-control digits mt-3" required name="decision_list_detail" />');

    $('#mm2').hide();


    }else{
        $('#mm2').show();
        $('#decision_list_detail').html('');
 $('#result_one').html(decisionVal);
    $('#result_two').html(decisionVal);
    }


});

</script>

@endsection
