@extends('admin.master.master')

@section('title')
কর্মকর্তাদের নিয়োগের তালিকা  | {{ $ins_name }}
@endsection


@section('css')

@endsection

@section('body')
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <h3>কর্মকর্তা</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">হোম</a></li>
                    <li class="breadcrumb-item">কর্মকর্তাদের নিয়োগের তালিকা </li>
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
        @include('flash_message')
        <div class="col-sm-12">
            <div class="card">

                <div class="card-body">

                    @foreach($branchLists as $key=>$AllBranchLists)

                    <input type="hidden" name="branchId[]" value="{{ $AllBranchLists->id }}"/>

                    <?php

$designationList = DB::table('designation_lists')->where('branch_id',$AllBranchLists->id)
                ->orderBy('designation_serial','asc')->get();
                     ?>
                    <div class="card">

                        <div class="card-header">
                          <span style="font-weight:900;font-size:15px;">{{ $AllBranchLists->branch_name }}</span>
                        </div>

                        <div class="card-body">

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                      <th scope="col">পদবী</th>
                                      <th scope="col">কর্মকর্তার নাম</th>
                                      <th scope="col">শুরুর তারিখ</th>
                                      <th scope="col">কার্যকলাপ</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach($designationList as $j=>$AllDesignationList)
                                    <form class="custom-validation" id="form" action="{{ route('assignedEmployee.store') }}" method="post"  data-parsley-validate="" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="branchId" value="{{ $AllBranchLists->id }}"/>
                                    <?php

                                   $adminId =  DB::table('admin_designation_histories')->where('designation_list_id',$AllDesignationList->id)
                                               ->orderBy('id','desc')->value('admin_id');

                                               $adminDate =  DB::table('admin_designation_histories')->where('designation_list_id',$AllDesignationList->id)
                                               ->orderBy('id','desc')->value('admin_job_start_date');
                                    ?>
                                    <input type="hidden" name="designation_list_id" value="{{ $AllDesignationList->id }}" />
                                    <tr>
                                        <td>

                                            @if(empty($adminDate))

                                            <input type="checkbox" id="checkMain{{ $AllDesignationList->id }}" class=""/>

                                            @else

                                            <input type="checkbox" id="checkMain{{ $AllDesignationList->id }}" class="" checked disabled/>
                                            @endif


                                        </td>

                                      <td>{{ $AllDesignationList->designation_name }}</td>
                                      <td>

                                        @if(empty($adminDate))

                                        <select class="form-control" style="display: none;" name="adminId"  id="adminId{{ $AllDesignationList->id }}">
                                            <option value="">--অনুগ্রহ করে নির্বাচন করুন--</option>
                                            @foreach($users_as as $allusers)


                                            <option value="{{ $allusers->id }}">{{ $allusers->admin_name_ban.', '.$allusers->email }}</option>

                                            @endforeach
                                            </select>
@else

<select class="form-control" name="adminId" disabled id="adminId{{ $AllDesignationList->id }}">
    <option value="">--অনুগ্রহ করে নির্বাচন করুন--</option>
    @foreach($users as $allusers)


    <option value="{{ $allusers->id }}" {{ $allusers->id == $adminId ? 'selected':'' }}>{{ $allusers->admin_name_ban.', '.$allusers->email }}</option>

    @endforeach
    </select>
@endif






                                    </td>
                                      <td>

                                        @if(empty($adminDate))
                                        <input type="text" style="display: none;" class="form-control datepicker233" value="{{ $adminDate }}" id="admin_job_start_date{{ $AllDesignationList->id }}"  name="admin_job_start_date" placeholder="Enter Date" >
                                        @else
                                        <input type="text" class="form-control datepicker233" value="{{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-m-Y', strtotime($adminDate))) }}" id="admin_job_start_date{{ $AllDesignationList->id }}"   name="admin_job_start_date" placeholder="Enter Date" disabled>
                                        @endif
                                      </td>

                                      <td>
                                        @if(empty($adminDate))
                                        <button type="submit"  class="btn btn-primary btn-sm" id="bMain{{ $AllDesignationList->id }}" style="display: none;"><i class="fa fa-hand-o-right"></i></button>
                                        @else
                                        <button type="submit"  class="btn btn-primary btn-sm" id="bMain{{ $AllDesignationList->id }}" disabled><i class="fa fa-hand-o-right"></i></button>
                                        @endif

                                    </td>

                                    </tr>
                                </form>
@endforeach

                                  </tbody>
                            </table>

                        </div>
                    </div>

                    @endforeach

                </div>
            </div>
        </div>
        <!-- Individual column searching (text inputs) Ends-->
    </div>



</div>
<!-- Container-fluid Ends-->
@endsection


@section('script')

<!-- designation -->
<script>
    $("[id^=checkMain]").click(function(){
         var main_id = $(this).attr('id');
         var id_for_pass = main_id.slice(9);

         $("#bMain"+id_for_pass).hide();
         $("#adminId"+id_for_pass).hide();
         $("#admin_job_start_date"+id_for_pass).hide();




        if($(this).is(":checked")){
                //alert(id_for_pass);
                $("#bMain"+id_for_pass).show();
         $("#adminId"+id_for_pass).show();
         $("#admin_job_start_date"+id_for_pass).show();


            }
            else if($(this).is(":not(:checked)")){
                //alert(id_for_pass);
                $("#bMain"+id_for_pass).hide();
         $("#adminId"+id_for_pass).hide();
         $("#admin_job_start_date"+id_for_pass).hide();
            }





        //alert(id_for_pass);
    });
    </script>
<!-- end designation -->

@endsection

