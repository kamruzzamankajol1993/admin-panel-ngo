<!--modal section for permission person list-->


<?php

$adminIdList = DB::table('nothi_permissions')
   ->where('nothId',$nothiLists->id)->select('adminId')->get();


$convert_name_title = $adminIdList->implode("adminId", " ");
$separated_data_title = explode(" ", $convert_name_title);

$branchList = DB::table('admins')->whereIn('id',$separated_data_title)

->select('branch_id')
->groupBy('branch_id')
->get();








$convert_name_title1 = $branchList->implode("branch_id", " ");
$separated_data_title1 = explode(" ", $convert_name_title1);


$getAllbranchName = DB::table('branches')
      ->whereIn('id',$separated_data_title1)->orderBy('branch_step','asc')->get();











?>

<div class="modal right fade bd-example-modal-lg" id="myModal{{ $nothiLists->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
    <div class="modal-dialog modal-lg-custom" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel2">
            অনুমতিপ্রাপ্ত ব্যাক্তি বাছাই করুন </h4>
    </div>

    <div class="modal-body">
        <div class="container-fluid list-products">
            <div class="row">
                <!-- Individual column searching (text inputs) Starts-->
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>পদবি নির্বাচন করুন</h5>
                                </div>
                                <div class="card-body">
                                    <div id="page-wrap">
                                        <h6>এনজিও বিষয়ক ব্যুরো শাখা {{ App\Http\Controllers\Admin\CommonController::englishToBangla($totalBranch) }} টি, পদ {{ App\Http\Controllers\Admin\CommonController::englishToBangla($totalDesignation) }} টি, শূন্যপদ {{ App\Http\Controllers\Admin\CommonController::englishToBangla($totalEmptyDesignation) }}টি,
                                            কর্মরত {{ App\Http\Controllers\Admin\CommonController::englishToBangla($totalDesignationWorking) }} জন</h6>
                                        <ul class="treeview">
                                            <input type="hidden" value="{{ $nothiLists->id }}" id="main_id" name="main_id"/>


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

                                                        <?php


                                                        $adminIdListCheckNew = DB::table('nothi_permissions')
                                                        ->where('nothId',$nothiLists->id)
                                                        ->where('adminId',$checkDesiId->admin_id)
                                                                                               ->where('branchId',$allTotalBranchList->id)
                                                                                               ->value('id');


                                                                                                                ?>

@if(empty($adminIdListCheckNew))

<input type="checkbox"  class="passBranch1" data-bId="{{ $allTotalBranchList->id }}" data-status="desi" value="{{ $allDesiList->id }}" name="designation[]" id="designation{{ $allDesiList->id }}">


                                                        @else
                                                        <input type="checkbox" disabled  class="passBranch1" data-bId="{{ $allTotalBranchList->id }}" data-status="desi" value="{{ $allDesiList->id }}" name="designation[]" id="designation{{ $allDesiList->id }}">
                                                        @endif
                                                        @endif
                                                        <!-- new code -->








                                                         <label for="designation{{ $allDesiList->id }}" class="custom-checked">

                                                            {{ $adminName }} ({{ $allDesiList->designation_name }})</label>


                                                         <!-- new code-->
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
                                                        class="icofont icofont-ui-home"></i>
                                                স্বাক্ষরকারী ব্যাক্তি সমূহ</a></li>
                                    </ul>
                                    <div class="tab-content" id="pills-darktabContent">
                                        <div class="tab-pane fade show active" id="pills-darkhome"
                                             role="tabpanel" aria-labelledby="pills-darkhome-tab">
                                            <div class="podobi_tab mt-4"  id="newCodeFromEditList">
                                                <table class="table table-bordered">



                                                    <tr>
                                                        <th>#</th>
                                                        <th>কর্মকর্তা</th>
                                                    </tr>

                                                    @foreach($getAllbranchName as $getAllbranchNames)

                                                    <?php

$designationList = DB::table('admins')
->whereIn('id',$separated_data_title)
->where('branch_id',$getAllbranchNames->id)
->select('designation_list_id')
->get();


$convert_name_title2 = $designationList->implode("designation_list_id", " ");
$separated_data_title2 = explode(" ", $convert_name_title2);


$getAlldesignationName = DB::table('designation_lists')
      ->whereIn('id',$separated_data_title2)->orderBy('designation_serial','asc')->get();






                                                    ?>




                                                    <tr>
                                                        <td>
                                                            <button id="branchDelete{{ $getAllbranchNames->id }}" data-branchId="{{ $getAllbranchNames->id }}" data-nothiId = "{{ $nothiLists->id }}" class="btn btn-outline-success"><i
                                                                        class="fa fa-trash"></i></button>
                                                        </td>
                                                        <td>
                                                            <b>শাখাঃ {{ $getAllbranchNames->branch_name }}</b>
                                                        </td>
                                                    </tr>
                                                    @foreach($getAlldesignationName as $getAlldesignationNames)

                                                    <?php

                                                    $mainAdmin = DB::table('admins')
->where('designation_list_id',$getAlldesignationNames->id)
->first();

                                                                                                        ?>




                                                    <tr>
                                                        <td>
                                                            @if(!$mainAdmin)
                                                            @else
                                                            <button id="memberDelete{{ $getAlldesignationNames->id }}" data-madminId="{{ $mainAdmin->id }}" data-nothiId = "{{ $nothiLists->id }}" class="btn btn-outline-success" data-bs-original-title="" title=""><i class="fa fa-trash"></i></button>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if(!$mainAdmin)
                                                            @else
                                                          {{ $mainAdmin->admin_name_ban }},
                                                            @endif

                                                            {{ $getAlldesignationNames->designation_name }}<span style="font-size:12px; color: #aeaeae;">{{ $getAllbranchNames->branch_name }}, এনজিও বিষয়ক ব্যুরো</span>
                                                        </td>
                                                    </tr>
                                                    @endforeach

                                                    @endforeach

                                                </table>





                                            </div>
                                        </div>
                                    </div>


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


                            <!--new code -->




                            <!-- new code -->
                        </div>
                    </div>
                </div>
                <!-- Individual column searching (text inputs) Ends-->
            </div>
        </div>
    </div><!-- modal-content -->
    </div><!-- modal-dialog -->
    </div><!-- modal -->
    </div>
