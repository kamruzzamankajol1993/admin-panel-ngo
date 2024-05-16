@extends('admin.master.master')

@section('title')
কর্মকর্তাদের তালিকা  | {{ $ins_name }}
@endsection


@section('css')

@endsection

@section('body')
<div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-sm-6">
          <h3>কর্মকর্তাদের তালিকা </h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">হোম</a></li>
            <li class="breadcrumb-item">কর্মকর্তাদের তালিকা </li>

          </ol>
        </div>

        <div class="col-sm-6 ">
            @if (Auth::guard('admin')->user()->can('userAdd'))
            <div class="text-end">
            <a  href="{{ route('user.create') }}" class="btn btn-primary add-btn" type="button">
                <i class="ri-add-line align-bottom me-1"></i> কর্মকর্তার তথ্য যোগ করুন
            </a>
            </div>
                                                @endif
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
                        @include('flash_message')
                        <div class="table-responsive">
                        <table id="basic-1" class="display table table-bordered" style="width:100%">
                            <thead>
                                <tr>

                                    <th>ক্র: নং:</th>
                                    <th>ছবি</th>
                                    {{-- <th>স্বাক্ষর</th> --}}
                                    <th>নাম</th>
                                    <th>পদবী</th>
                                    <th>শাখা</th>
                                   <th>মোবাইল নম্বর</th>
                                    <th>ইমেইল</th>
                                    <th>রোল</th>
                                    <th>শুরুর তারিখ</th>
                                    {{-- <th>End Date</th> --}}
                                    <th>কার্যকলাপ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)


                                <tr>
                                   <td>


                                    {{ $loop->index+1 }}




                                </td>

                                <td>

                                    @if(empty($user->admin_image))
                                    @else
<img src="{{ asset('/') }}{{ $user->admin_image }}" style="height:60px" />
@endif
                                </td>

                                {{-- <td>
                                    @if(empty($user->admin_sign))
                                    @else
                                    <img src="{{ asset('/') }}{{ $user->admin_sign }}" style="height:40px" />
                                    @endif

                                                                    </td> --}}

                                    <td>


                                        <?php

$mac = exec('getmac');


?>



                                        <br>{{ $user->admin_name_ban }}


                                    </td>

                                    <td>
@if($user->designation_list_id == 1)

@else

                                        <?php

                                        $desiName = DB::table('designation_lists')
                                        ->where('id',$user->designation_list_id)
                                        ->value('designation_name');


                                            ?>
                                            {{ $desiName }}
@endif

                                        </td>
                                    <td>
                                        @if($user->branch_id == 1)

                                        @else

                                        <?php

                                        $branchName = DB::table('branches')->where('id',$user->branch_id)->value('branch_name');


                                            ?>
                                            {{ $branchName }}
@endif

                                        </td>
                                    <td>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($user->admin_mobile) }}</td>

                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @foreach ($user->roles as $role)
                                        <span class="badge bg-success mt-1">
                                                {{ $role->name }}
                                        </span>
                                        @endforeach
                                    </td>
                                    <td>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($user->admin_job_start_date) }}</td>

                                    {{-- <td>{{ $user->admin_job_end_date }}</td> --}}



                                    <td>

                                          <button type="button"  onclick="location.href = '{{ route('user.edit',$user->id) }}';"
                                          class="btn btn-primary waves-light waves-effect  btn-sm mt-2" >
                                          <i class="fa fa-pencil"></i></button>










<button   type="button" class="btn btn-danger waves-light waves-effect  btn-sm mt-2" onclick="deleteTag({{ $user->id}})" data-toggle="tooltip" title="Delete"><i class="fa fa-trash-o"></i></button>
                    <form id="delete-form-{{ $user->id }}" action="{{ route('user.destroy',$user->id) }}" method="POST" style="display: none;">
                      @method('DELETE')
                                                    @csrf

                                                </form>

                                    </td>
                                </tr>
@endforeach

                        </table>
                    </div>
                    </div>
                </div>
            </div>
        </div><!--end row-->



    </div>
    <!-- container-fluid -->
</div>




@endsection

@section('script')

@endsection







