@extends('admin.master.master')

@section('title')
কর্মকর্তাদের কর্ম দিবসের তালিকা
@endsection


@section('css')

@endsection

@section('body')
<div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-sm-6">
          <h3>কর্মকর্তাদের কর্ম দিবসের তালিকা </h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">হোম</a></li>
            <li class="breadcrumb-item">কর্মকর্তাদের কর্ম দিবসের তালিকা </li>

          </ol>
        </div>

      </div>
    </div>
  </div>
        <!-- end page title -->
 <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">

                    <div class="card-body">


                        <!-- new code -->

                        <ul class="nav nav-tabs" id="icon-tab" role="tablist">
                            <li class="nav-item"><a class="nav-link active" id="icon-home-tab" data-bs-toggle="tab" href="#icon-home" role="tab" aria-controls="icon-home" aria-selected="true"><i class="icofont icofont-ui-home"></i>বর্তমানে কর্মরত</a></li>
                            <li class="nav-item"><a class="nav-link" id="profile-icon-tab" data-bs-toggle="tab" href="#profile-icon" role="tab" aria-controls="profile-icon" aria-selected="false"><i class="icofont icofont-man-in-glasses"></i>কার্যকাল শেষ করেছেন</a></li>

                          </ul>

                          <div class="tab-content" id="icon-tabContent">
                            <div class="tab-pane fade active show" id="icon-home" role="tabpanel" aria-labelledby="icon-home-tab">

                                <div class="table-responsive mt-4">
                                    <table id="basic-1" class="display table table-bordered" style="width:100%">
                                        <thead>
                                            <tr>

                                                <th>ক্র: নং:</th>

                                                <th>নাম</th>
                                                <th>পদবী</th>
                                                <th>শাখা</th>

                                                <th>ইমেইল</th>

                                                <th>শুরুর তারিখ</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach($adminDesignationHistory as $key=>$adminDesignationHistorys)

<?php
$getTheAdminValue = DB::table('admins')->where('id',$adminDesignationHistorys->admin_id)->first();


?>
@if(!$getTheAdminValue)

@else

<?php
 $branchName = DB::table('branches')->where('id',$getTheAdminValue->branch_id)
                      ->value('branch_name');


        $DesignationNAme = DB::table('designation_lists')->where('id',$getTheAdminValue->designation_list_id)
                      ->value('designation_name');


?>
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $getTheAdminValue->admin_name_ban }}</td>


                                                <td>{{ $DesignationNAme }}</td>
                                                <td>
                                                    @if($getTheAdminValue->designation_list_id == 2)

                                                    @else
                                                    {{ $branchName }}
@endif
                                                </td>


                                                <td>{{ $getTheAdminValue->email }}</td>
                                                <td>


                                                    {{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('d/m/y', strtotime($adminDesignationHistorys->admin_job_start_date)))}}
</td>
                                            </tr>
                                            @endif
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="profile-icon" role="tabpanel" aria-labelledby="profile-icon-tab">
                                <div class="table-responsive mt-4">
                                    <table id="basic-2" class="display table table-bordered" style="width:100%">
                                        <thead>
                                            <tr>

                                                <th>ক্র: নং:</th>

                                                <th>নাম</th>
                                                <th>পদবী</th>
                                                <th>শাখা</th>

                                                <th>ইমেইল</th>
                                                <th>শুরুর তারিখ</th>
                                                <th>শেষ তারিখ</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach($employeeJobHistory as $key=>$adminDesignationHistorys)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $adminDesignationHistorys->admin_name }}</td>

                                                <td>{{ $adminDesignationHistorys->admin_designation_name }}</td>
                                                <td>
                                                    @if($adminDesignationHistorys->designation_list_id == 2)


                                                    @else

                                                    {{ $adminDesignationHistorys->admin_branch_name }}
                                                   @endif

                                                </td>

                                                <td>{{ $adminDesignationHistorys->admin_email }}</td>
                                                <td>


                                                    {{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('d/m/y', strtotime($adminDesignationHistorys->start_date)))}}
                                                </td>

                                                <td>


                                                    {{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('d/m/y', strtotime($adminDesignationHistorys->end_date)))}}
                                                </td>

                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                          </div>
                        <!-- end new code -->



                  </div>

              </div>
               </div>
           </div>
    </div>
@endsection
@section('script')

@endsection
