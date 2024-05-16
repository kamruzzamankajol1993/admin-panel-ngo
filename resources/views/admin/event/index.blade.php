@extends('admin.master.master')

@section('title')
ইভেন্ট ম্যানেজমেন্ট তালিকা | {{ $ins_name }}
@endsection


@section('css')
<style>
    .nav-tabs .nav-link.active {
    background-color: #24695c !important;
    border-color: #e6edef !important;
    color: #e6edef !important;
}
</style>
@endsection

@section('body')
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <h3>ইভেন্ট ম্যানেজমেন্ট তালিকা</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">হোম</a></li>
                    <li class="breadcrumb-item">ইভেন্ট ম্যানেজমেন্ট</li>
                    <li class="breadcrumb-item">ইভেন্ট ম্যানেজমেন্ট তালিকা</li>
                </ol>
            </div>
            <div class="col-sm-6 ">
                @if (Auth::guard('admin')->user()->can('eventAdd'))
                <div class="text-end">
                <a  href="{{ route('eventManager.create') }}" class="btn btn-primary add-btn" type="button">
                    <i class="ri-add-line align-bottom me-1"></i> ইভেন্ট ম্যানেজমেন্ট তথ্য যোগ করুন
                </a>
                </div>
                                                    @endif
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid starts-->
<div class="container-fluid list-products">
    <div class="row">
        <!-- Individual column searching (text inputs) Starts-->

        <div class="col-sm-12"  >
            <div class="card">

                <div class="card-body">


                    <!-- new update tab end -->


                    <ul class="nav nav-tabs" id="icon-tab" role="tablist">
                        <li class="nav-item"><a class="nav-link active" id="icon-home-tab23"
                                                data-bs-toggle="tab" href="#icon-home23" role="tab"
                                                aria-controls="icon-home23" aria-selected="true"><i
                                        class="icofont icofont-ui-home"></i>আজকের ইভেন্টের  তালিকা</a></li>



                        <li class="nav-item"><a class="nav-link" id="profile-icon-tab23"
                                                data-bs-toggle="tab" href="#profile-icon23" role="tab"
                                                aria-controls="profile-icon23"
                                                aria-selected="false"><i
                                        class="icofont icofont-files"></i>আগামীকালের ইভেন্টের  তালিকা</a></li>


                                        <li class="nav-item"><a class="nav-link" id="profile-icon-tab233"
                                            data-bs-toggle="tab" href="#profile-icon233" role="tab"
                                            aria-controls="profile-icon233"
                                            aria-selected="false"><i
                                    class="icofont icofont-files"></i>গতকালের ইভেন্টের  তালিকা</a></li>


                                    <li class="nav-item"><a class="nav-link" id="profile-icon-tab2333"
                                        data-bs-toggle="tab" href="#profile-icon2333" role="tab"
                                        aria-controls="profile-icon2333"
                                        aria-selected="false"><i
                                class="icofont icofont-files"></i>সমাপ্ত ইভেন্টের  তালিকা</a></li>




                                <li class="nav-item"><a class="nav-link" id="profile-icon-tab23333"
                                    data-bs-toggle="tab" href="#profile-icon23333" role="tab"
                                    aria-controls="profile-icon23333"
                                    aria-selected="false"><i
                            class="icofont icofont-files"></i>অসমাপ্ত ইভেন্টের  তালিকা</a></li>


                            <li class="nav-item"><a class="nav-link" id="profile-icon-tab233333"
                                data-bs-toggle="tab" href="#profile-icon233333" role="tab"
                                aria-controls="profile-icon233333"
                                aria-selected="false"><i
                        class="icofont icofont-files"></i>সকল ইভেন্টের  তালিকা</a></li>

                    </ul>


                    <div class="tab-content mt-4" id="icon-tabContent">
                        <div class="tab-pane fade show active" id="icon-home23" role="tabpanel"
                             aria-labelledby="icon-home-tab23">

                             <!--table start -->

                             <div class="table-responsive product-table" >


                                <table class="display" id="basic-7">
                                    <thead>
                                    <tr>
                                        <th>ক্র: নং:</th>
                                        <th>ইভেন্টের নাম</th>
                                        <th>ইভেন্টের তারিখ</th>
                                        <th>ইভেন্টের সময়</th>
                                        <th>ইভেন্টের অবস্থা</th>
                                        <th>কার্যকলাপ</th>

                                    </tr>
                                    </thead>
                                    <tbody id="searchTable">

                                        @foreach($allTaskList as $key=>$allPermissionGroup)


                                        <tr>
        <td>{{ $key+1 }}</td>
                                            <td>{{ $allPermissionGroup->name }}</td>

                                            <td>

        @if(empty($allPermissionGroup->date))


        @else

                                                {{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('Y-m-d', strtotime($allPermissionGroup->date))) }}
        @endif

                                            </td>
                                            <td>{{ $allPermissionGroup->time }}</td>
                                            <td>{{ $allPermissionGroup->status }}</td>
                                            <td>

                                                <div class="hstack gap-3 fs-15">


                                                    <a href="{{ route('eventManager.edit',$allPermissionGroup->id) }}" class="btn btn-info waves-light waves-effect  btn-sm"><i class="fa fa-edit"></i></a>

                                                <a data-bs-toggle="modal" data-bs-target="#exampleModal{{ $key+1 }}" class="btn btn-primary waves-light waves-effect  btn-sm"><i class="fa fa-eye"></i></a>


                                                <div class="modal fade" id="exampleModal{{ $key+1 }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl">
                                                      <div class="modal-content">
                                                        <div class="modal-header">
                                                          <h1 class="modal-title fs-5" id="exampleModalLabel">ইভেন্টের বিবরণ</h1>
                                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">



                                                            <h6 class="mt-3"><u>ইভেন্টের বিবরণ</u></h6>
                                                {!! $allPermissionGroup->detail !!}

                                                        </div>

                                                      </div>
                                                    </div>
                                                  </div>




                                                  <a onclick="deleteTag({{ $allPermissionGroup->id}})" class="btn btn-danger waves-light waves-effect  btn-sm"><i class="fa fa-trash-o"></i></a>

                                                  <form id="delete-form-{{ $allPermissionGroup->id }}" action="{{ route('eventManager.destroy',$allPermissionGroup->id) }}" method="POST" style="display: none;">
                                                    @method('DELETE')
                                                                                  @csrf

                                                                              </form>

                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>


                            </div>
                             <!-- table end -->

                        </div>
                        <div class="tab-pane fade" id="profile-icon23" role="tabpanel"
                                     aria-labelledby="profile-icon-tab23">
                           <!--table start -->

  <div class="table-responsive product-table" >


    <table class="display" id="basic-8">
        <thead>
        <tr>
            <th>ক্র: নং:</th>
            <th>ইভেন্টের নাম</th>
            <th>ইভেন্টের তারিখ</th>
            <th>ইভেন্টের সময়</th>
            <th>ইভেন্টের অবস্থা</th>
            <th>কার্যকলাপ</th>

        </tr>
        </thead>
        <tbody id="searchTable">

            @foreach($allTaskListTomorrow as $key=>$allPermissionGroup)


            <tr>
<td>{{ $key+1 }}</td>
                <td>{{ $allPermissionGroup->name }}</td>

                <td>

@if(empty($allPermissionGroup->date))


@else

                    {{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('Y-m-d', strtotime($allPermissionGroup->date))) }}
@endif

                </td>
                <td>{{ $allPermissionGroup->time }}</td>
                <td>{{ $allPermissionGroup->status }}</td>
                <td>

                    <div class="hstack gap-3 fs-15">


                        <a href="{{ route('eventManager.edit',$allPermissionGroup->id) }}" class="btn btn-info waves-light waves-effect  btn-sm"><i class="fa fa-edit"></i></a>

                    <a data-bs-toggle="modal" data-bs-target="#exampleModal{{ $key+1 }}" class="btn btn-primary waves-light waves-effect  btn-sm"><i class="fa fa-eye"></i></a>


                    <div class="modal fade" id="exampleModal{{ $key+1 }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">ইভেন্টের বিবরণ</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">



                                <h6 class="mt-3"><u>ইভেন্টের বিবরণ</u></h6>
                    {!! $allPermissionGroup->detail !!}

                            </div>

                          </div>
                        </div>
                      </div>




                      <a onclick="deleteTag({{ $allPermissionGroup->id}})" class="btn btn-danger waves-light waves-effect  btn-sm"><i class="fa fa-trash-o"></i></a>

                      <form id="delete-form-{{ $allPermissionGroup->id }}" action="{{ route('eventManager.destroy',$allPermissionGroup->id) }}" method="POST" style="display: none;">
                        @method('DELETE')
                                                      @csrf

                                                  </form>

                    </div>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>


</div>
 <!-- table end -->
                        </div>
                        <div class="tab-pane fade" id="profile-icon233" role="tabpanel"
                                     aria-labelledby="profile-icon-tab233">
  <!--table start -->

  <div class="table-responsive product-table" >


    <table class="display" id="basic-6">
        <thead>
        <tr>
            <th>ক্র: নং:</th>
            <th>ইভেন্টের নাম</th>
            <th>ইভেন্টের তারিখ</th>
            <th>ইভেন্টের সময়</th>
            <th>ইভেন্টের অবস্থা</th>
            <th>কার্যকলাপ</th>

        </tr>
        </thead>
        <tbody id="searchTable">

            @foreach($allTaskListPrevious as $key=>$allPermissionGroup)


            <tr>
<td>{{ $key+1 }}</td>
                <td>{{ $allPermissionGroup->name }}</td>

                <td>

@if(empty($allPermissionGroup->date))


@else

                    {{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('Y-m-d', strtotime($allPermissionGroup->date))) }}
@endif

                </td>
                <td>{{ $allPermissionGroup->time }}</td>
                <td>{{ $allPermissionGroup->status }}</td>
                <td>

                    <div class="hstack gap-3 fs-15">


                        <a href="{{ route('eventManager.edit',$allPermissionGroup->id) }}" class="btn btn-info waves-light waves-effect  btn-sm"><i class="fa fa-edit"></i></a>

                    <a data-bs-toggle="modal" data-bs-target="#exampleModal{{ $key+1 }}" class="btn btn-primary waves-light waves-effect  btn-sm"><i class="fa fa-eye"></i></a>


                    <div class="modal fade" id="exampleModal{{ $key+1 }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">ইভেন্টের বিবরণ</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">



                                <h6 class="mt-3"><u>ইভেন্টের বিবরণ</u></h6>
                    {!! $allPermissionGroup->detail !!}

                            </div>

                          </div>
                        </div>
                      </div>




                      <a onclick="deleteTag({{ $allPermissionGroup->id}})" class="btn btn-danger waves-light waves-effect  btn-sm"><i class="fa fa-trash-o"></i></a>

                      <form id="delete-form-{{ $allPermissionGroup->id }}" action="{{ route('eventManager.destroy',$allPermissionGroup->id) }}" method="POST" style="display: none;">
                        @method('DELETE')
                                                      @csrf

                                                  </form>

                    </div>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>


</div>
 <!-- table end -->
                        </div>
                        <div class="tab-pane fade" id="profile-icon2333" role="tabpanel"
                        aria-labelledby="profile-icon-tab2333">
  <!--table start -->

  <div class="table-responsive product-table" >


    <table class="display" id="basic-10">
        <thead>
        <tr>
            <th>ক্র: নং:</th>
            <th>ইভেন্টের নাম</th>
            <th>ইভেন্টের তারিখ</th>
            <th>ইভেন্টের সময়</th>
            <th>ইভেন্টের অবস্থা</th>
            <th>কার্যকলাপ</th>

        </tr>
        </thead>
        <tbody id="searchTable">

            @foreach($allTaskListAllOngoing as $key=>$allPermissionGroup)


            <tr>
<td>{{ $key+1 }}</td>
                <td>{{ $allPermissionGroup->name }}</td>

                <td>

@if(empty($allPermissionGroup->date))


@else

                    {{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('Y-m-d', strtotime($allPermissionGroup->date))) }}
@endif

                </td>
                <td>{{ $allPermissionGroup->time }}</td>
                <td>{{ $allPermissionGroup->status }}</td>
                <td>

                    <div class="hstack gap-3 fs-15">


                        <a href="{{ route('eventManager.edit',$allPermissionGroup->id) }}" class="btn btn-info waves-light waves-effect  btn-sm"><i class="fa fa-edit"></i></a>

                    <a data-bs-toggle="modal" data-bs-target="#exampleModal{{ $key+1 }}" class="btn btn-primary waves-light waves-effect  btn-sm"><i class="fa fa-eye"></i></a>


                    <div class="modal fade" id="exampleModal{{ $key+1 }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">ইভেন্টের বিবরণ</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">



                                <h6 class="mt-3"><u>ইভেন্টের বিবরণ</u></h6>
                    {!! $allPermissionGroup->detail !!}

                            </div>

                          </div>
                        </div>
                      </div>




                      <a onclick="deleteTag({{ $allPermissionGroup->id}})" class="btn btn-danger waves-light waves-effect  btn-sm"><i class="fa fa-trash-o"></i></a>

                      <form id="delete-form-{{ $allPermissionGroup->id }}" action="{{ route('eventManager.destroy',$allPermissionGroup->id) }}" method="POST" style="display: none;">
                        @method('DELETE')
                                                      @csrf

                                                  </form>

                    </div>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>


</div>
 <!-- table end -->
                        </div>
                        <div class="tab-pane fade" id="profile-icon23333" role="tabpanel"
                        aria-labelledby="profile-icon-tab23333">
                   <!--table start -->

  <div class="table-responsive product-table" >


    <table class="display" id="basic-9">
        <thead>
        <tr>
            <th>ক্র: নং:</th>
            <th>ইভেন্টের নাম</th>
            <th>ইভেন্টের তারিখ</th>
            <th>ইভেন্টের সময়</th>
            <th>ইভেন্টের অবস্থা</th>
            <th>কার্যকলাপ</th>

        </tr>
        </thead>
        <tbody id="searchTable">

            @foreach($allTaskListAllComplete as $key=>$allPermissionGroup)


            <tr>
<td>{{ $key+1 }}</td>
                <td>{{ $allPermissionGroup->name }}</td>

                <td>

@if(empty($allPermissionGroup->date))


@else

                    {{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('Y-m-d', strtotime($allPermissionGroup->date))) }}
@endif

                </td>
                <td>{{ $allPermissionGroup->time }}</td>
                <td>{{ $allPermissionGroup->status }}</td>
                <td>

                    <div class="hstack gap-3 fs-15">


                        <a href="{{ route('eventManager.edit',$allPermissionGroup->id) }}" class="btn btn-info waves-light waves-effect  btn-sm"><i class="fa fa-edit"></i></a>

                    <a data-bs-toggle="modal" data-bs-target="#exampleModal{{ $key+1 }}" class="btn btn-primary waves-light waves-effect  btn-sm"><i class="fa fa-eye"></i></a>


                    <div class="modal fade" id="exampleModal{{ $key+1 }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">ইভেন্টের বিবরণ</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">



                                <h6 class="mt-3"><u>ইভেন্টের বিবরণ</u></h6>
                    {!! $allPermissionGroup->detail !!}

                            </div>

                          </div>
                        </div>
                      </div>




                      <a onclick="deleteTag({{ $allPermissionGroup->id}})" class="btn btn-danger waves-light waves-effect  btn-sm"><i class="fa fa-trash-o"></i></a>

                      <form id="delete-form-{{ $allPermissionGroup->id }}" action="{{ route('eventManager.destroy',$allPermissionGroup->id) }}" method="POST" style="display: none;">
                        @method('DELETE')
                                                      @csrf

                                                  </form>

                    </div>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>


</div>
 <!-- table end -->
                       </div>
                        <div class="tab-pane fade" id="profile-icon233333" role="tabpanel"
                        aria-labelledby="profile-icon-tab233333">
                          <!--table start -->

                          <div class="table-responsive product-table" >


                            <table class="display" id="basic-1">
                                <thead>
                                <tr>
                                    <th>ক্র: নং:</th>
                                    <th>ইভেন্টের নাম</th>
                                    <th>ইভেন্টের তারিখ</th>
                                    <th>ইভেন্টের সময়</th>
                                    <th>ইভেন্টের অবস্থা</th>
                                    <th>কার্যকলাপ</th>

                                </tr>
                                </thead>
                                <tbody id="searchTable">

                                    @foreach($allTaskListAll as $key=>$allPermissionGroup)


                                    <tr>
    <td>{{ $key+1 }}</td>
                                        <td>{{ $allPermissionGroup->name }}</td>

                                        <td>

    @if(empty($allPermissionGroup->date))


    @else

                                            {{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('Y-m-d', strtotime($allPermissionGroup->date))) }}
    @endif

                                        </td>
                                        <td>{{ $allPermissionGroup->time }}</td>
                                        <td>{{ $allPermissionGroup->status }}</td>
                                        <td>

                                            <div class="hstack gap-3 fs-15">


                                                <a href="{{ route('eventManager.edit',$allPermissionGroup->id) }}" class="btn btn-info waves-light waves-effect  btn-sm"><i class="fa fa-edit"></i></a>

                                            <a data-bs-toggle="modal" data-bs-target="#exampleModal{{ $key+1 }}" class="btn btn-primary waves-light waves-effect  btn-sm"><i class="fa fa-eye"></i></a>


                                            <div class="modal fade" id="exampleModal{{ $key+1 }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <h1 class="modal-title fs-5" id="exampleModalLabel">ইভেন্টের বিবরণ</h1>
                                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">



                                                        <h6 class="mt-3"><u>ইভেন্টের বিবরণ</u></h6>
                                            {!! $allPermissionGroup->detail !!}

                                                    </div>

                                                  </div>
                                                </div>
                                              </div>




                                              <a onclick="deleteTag({{ $allPermissionGroup->id}})" class="btn btn-danger waves-light waves-effect  btn-sm"><i class="fa fa-trash-o"></i></a>

                                              <form id="delete-form-{{ $allPermissionGroup->id }}" action="{{ route('eventManager.destroy',$allPermissionGroup->id) }}" method="POST" style="display: none;">
                                                @method('DELETE')
                                                                              @csrf

                                                                          </form>

                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>


                        </div>
                         <!-- table end -->
                        </div>
                    </div>

                    <!-- end new update tab -->




                </div>
            </div>
        </div>
        <!-- Individual column searching (text inputs) Ends-->
    </div>
</div>
<!-- Container-fluid Ends-->
@endsection


@section('script')

@endsection
