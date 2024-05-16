@extends('admin.master.master')

@section('title')
কার্য ব্যাবস্থাপনার তালিকা | {{ $ins_name }}
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
                <h3>কার্য ব্যাবস্থাপনার তালিকা</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">হোম</a></li>
                    <li class="breadcrumb-item">কার্য ব্যবস্থাপনা</li>
                    <li class="breadcrumb-item">কার্য ব্যাবস্থাপনার তালিকা</li>
                </ol>
            </div>
            <div class="col-sm-6 ">
                @if (Auth::guard('admin')->user()->can('taskManagerAdd'))
                <div class="text-end">
                <a  href="{{ route('taskManager.create') }}" class="btn btn-primary add-btn" type="button">
                    <i class="ri-add-line align-bottom me-1"></i> কার্য ব্যাবস্থাপনার তথ্য যোগ করুন
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


                    <!-- new update code start  -->

                    <ul class="nav nav-tabs" id="icon-tab" role="tablist">
                        <li class="nav-item"><a class="nav-link active" id="icon-home-tab23"
                                                data-bs-toggle="tab" href="#icon-home23" role="tab"
                                                aria-controls="icon-home23" aria-selected="true"><i
                                        class="icofont icofont-ui-home"></i>আজকের কাজের  তালিকা</a></li>



                        <li class="nav-item"><a class="nav-link" id="profile-icon-tab23"
                                                data-bs-toggle="tab" href="#profile-icon23" role="tab"
                                                aria-controls="profile-icon23"
                                                aria-selected="false"><i
                                        class="icofont icofont-files"></i>আগামীকালের কাজের  তালিকা</a></li>


                                        <li class="nav-item"><a class="nav-link" id="profile-icon-tab233"
                                            data-bs-toggle="tab" href="#profile-icon233" role="tab"
                                            aria-controls="profile-icon233"
                                            aria-selected="false"><i
                                    class="icofont icofont-files"></i>গতকালের কাজের  তালিকা</a></li>


                                    <li class="nav-item"><a class="nav-link" id="profile-icon-tab2333"
                                        data-bs-toggle="tab" href="#profile-icon2333" role="tab"
                                        aria-controls="profile-icon2333"
                                        aria-selected="false"><i
                                class="icofont icofont-files"></i>সমাপ্ত কাজের  তালিকা</a></li>




                                <li class="nav-item"><a class="nav-link" id="profile-icon-tab23333"
                                    data-bs-toggle="tab" href="#profile-icon23333" role="tab"
                                    aria-controls="profile-icon23333"
                                    aria-selected="false"><i
                            class="icofont icofont-files"></i>অসমাপ্ত কাজের  তালিকা</a></li>


                            <li class="nav-item"><a class="nav-link" id="profile-icon-tab233333"
                                data-bs-toggle="tab" href="#profile-icon233333" role="tab"
                                aria-controls="profile-icon233333"
                                aria-selected="false"><i
                        class="icofont icofont-files"></i>সকল কাজের  তালিকা</a></li>

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
                                        <th>কাজের ধরন</th>
                                        <th>কাজের নাম</th>
                                        <th>কাজ শেষ করার তারিখ</th>
                                        <th>কাজের অবস্থা</th>
                                        <th>কার্যকলাপ</th>

                                    </tr>
                                    </thead>
                                    <tbody id="searchTable">

                                        @foreach($allTaskList as $key=>$allPermissionGroup)


                                        <tr>
        <td>{{ $key+1 }}</td>
                                            <td>{{ $allPermissionGroup->task_type }}</td>
                                            <td>{{ $allPermissionGroup->task_name }}</td>
                                            <td>

        @if(empty($allPermissionGroup->end_date))


        @else

                                                {{ App\Http\Controllers\Admin\CommonController::englishToBangla($allPermissionGroup->end_date) }}
        @endif

                                            </td>
                                            <td>


                                                @if(($allPermissionGroup->end_date_formate < date('Y-m-d')) && ($allPermissionGroup->status == 'চলমান'))

                                                অসম্পূর্ণ
                                                @else



                                                {{ $allPermissionGroup->status }}

                                                @endif



                                            </td>
                                            <td>

                                                <div class="hstack gap-3 fs-15">


                                                    <a href="{{ route('taskManager.edit',$allPermissionGroup->id) }}" class="btn btn-info waves-light waves-effect  btn-sm"><i class="fa fa-edit"></i></a>

                                                <a data-bs-toggle="modal" data-bs-target="#exampleModal{{ $key+1 }}" class="btn btn-primary waves-light waves-effect  btn-sm"><i class="fa fa-eye"></i></a>


                                                <div class="modal fade" id="exampleModal{{ $key+1 }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl">
                                                      <div class="modal-content">
                                                        <div class="modal-header">
                                                          <h1 class="modal-title fs-5" id="exampleModalLabel">কাজের বিবরণ</h1>
                                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">

                                                            <?php

                                                $adminIdList = DB::table('assaign_tasks')
                                                ->where('task_id',$allPermissionGroup->id)
                                                ->get();


                                                    ?>


                                                            <h6><u>কর্মকর্তাদের তালিকা</u></h6>

                                                            <ul>
                                                                @foreach($adminIdList as $key=>$adminIdLists)
                                                                <?php

        $adminNameList = DB::table('admins')
                                                ->where('id',$adminIdLists->admin_id)
                                                ->first();


                                                                ?>
                                                                @if(!$adminNameList)

                                                                @else
                                                                <?php

        $desiName = DB::table('designation_lists')
                                                ->where('id',$adminNameList->designation_list_id)
                                                ->value('designation_name');

                                                $branchName = DB::table('branches')->where('id',$adminNameList->branch_id)->value('branch_name');

                                                                ?>

                                                                @if(count($adminIdList)== ($key+1))

                                                                <li>{{ $adminNameList->admin_name_ban }}, {{ $desiName }}, {{ $branchName }} <span style="font-weight:bold;color:green;">( {{ $adminIdLists->status }})</span> |</li>
        @else
        <li>{{ $adminNameList->admin_name_ban }}, {{ $desiName }}, {{ $branchName }} <span style="font-weight:bold;color:green;">( {{ $adminIdLists->status }})</span>;</li>
        @endif

                                                                @endif
                                                                @endforeach
                                                            </ul>

                                                            <h6 class="mt-3"><u>কাজের বিবরণ</u></h6>
        {!! $allPermissionGroup->description !!}

                                                        </div>

                                                      </div>
                                                    </div>
                                                  </div>




                                                  <a onclick="deleteTag({{ $allPermissionGroup->id}})" class="btn btn-danger waves-light waves-effect  btn-sm"><i class="fa fa-trash-o"></i></a>

                                                  <form id="delete-form-{{ $allPermissionGroup->id }}" action="{{ route('taskManager.destroy',$allPermissionGroup->id) }}" method="POST" style="display: none;">
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
                             <!-- table end-->

                        </div>
                        <div class="tab-pane fade" id="profile-icon23" role="tabpanel"
                        aria-labelledby="profile-icon-tab23">

                         <!--table start -->
                         <div class="table-responsive product-table" >

                            <table class="display" id="basic-2">
                                <thead>
                                <tr>
                                    <th>ক্র: নং:</th>
                                    <th>কাজের ধরন</th>
                                    <th>কাজের নাম</th>
                                    <th>কাজ শেষ করার তারিখ</th>
                                    <th>কাজের অবস্থা</th>
                                    <th>কার্যকলাপ</th>

                                </tr>
                                </thead>
                                <tbody id="searchTable">

                                    @foreach($allTaskListTomorrow as $key=>$allPermissionGroup)


                                    <tr>
    <td>{{ $key+1 }}</td>
                                        <td>{{ $allPermissionGroup->task_type }}</td>
                                        <td>{{ $allPermissionGroup->task_name }}</td>
                                        <td>

    @if(empty($allPermissionGroup->end_date))


    @else

                                            {{ App\Http\Controllers\Admin\CommonController::englishToBangla($allPermissionGroup->end_date) }}
    @endif

                                        </td>
                                        <td>


                                            @if(($allPermissionGroup->end_date_formate < date('Y-m-d')) && ($allPermissionGroup->status == 'চলমান'))

                                            অসম্পূর্ণ
                                            @else



                                            {{ $allPermissionGroup->status }}

                                            @endif



                                        </td>
                                        <td>

                                            <div class="hstack gap-3 fs-15">


                                                <a href="{{ route('taskManager.edit',$allPermissionGroup->id) }}" class="btn btn-info waves-light waves-effect  btn-sm"><i class="fa fa-edit"></i></a>

                                            <a data-bs-toggle="modal" data-bs-target="#exampleModal{{ $key+1 }}" class="btn btn-primary waves-light waves-effect  btn-sm"><i class="fa fa-eye"></i></a>


                                            <div class="modal fade" id="exampleModal{{ $key+1 }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <h1 class="modal-title fs-5" id="exampleModalLabel">কাজের বিবরণ</h1>
                                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <?php

                                            $adminIdList = DB::table('assaign_tasks')
                                            ->where('task_id',$allPermissionGroup->id)
                                            ->get();


                                                ?>


                                                        <h6><u>কর্মকর্তাদের তালিকা</u></h6>

                                                        <ul>
                                                            @foreach($adminIdList as $key=>$adminIdLists)
                                                            <?php

    $adminNameList = DB::table('admins')
                                            ->where('id',$adminIdLists->admin_id)
                                            ->first();


                                                            ?>
                                                            @if(!$adminNameList)

                                                            @else
                                                            <?php

    $desiName = DB::table('designation_lists')
                                            ->where('id',$adminNameList->designation_list_id)
                                            ->value('designation_name');

                                            $branchName = DB::table('branches')->where('id',$adminNameList->branch_id)->value('branch_name');

                                                            ?>

                                                            @if(count($adminIdList)== ($key+1))

                                                            <li>{{ $adminNameList->admin_name_ban }}, {{ $desiName }}, {{ $branchName }} <span style="font-weight:bold;color:green;">( {{ $adminIdLists->status }})</span> |</li>
    @else
    <li>{{ $adminNameList->admin_name_ban }}, {{ $desiName }}, {{ $branchName }} <span style="font-weight:bold;color:green;">( {{ $adminIdLists->status }})</span>;</li>
    @endif

                                                            @endif
                                                            @endforeach
                                                        </ul>

                                                        <h6 class="mt-3"><u>কাজের বিবরণ</u></h6>
    {!! $allPermissionGroup->description !!}

                                                    </div>

                                                  </div>
                                                </div>
                                              </div>




                                              <a onclick="deleteTag({{ $allPermissionGroup->id}})" class="btn btn-danger waves-light waves-effect  btn-sm"><i class="fa fa-trash-o"></i></a>

                                              <form id="delete-form-{{ $allPermissionGroup->id }}" action="{{ route('taskManager.destroy',$allPermissionGroup->id) }}" method="POST" style="display: none;">
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
                             <!-- table end-->

                        </div>
                        <div class="tab-pane fade" id="profile-icon233" role="tabpanel"
                        aria-labelledby="profile-icon-tab233">

                         <!--table start -->

                         <div class="table-responsive product-table" >

                            <table class="display" id="basic-3">
                                <thead>
                                <tr>
                                    <th>ক্র: নং:</th>
                                    <th>কাজের ধরন</th>
                                    <th>কাজের নাম</th>
                                    <th>কাজ শেষ করার তারিখ</th>
                                    <th>কাজের অবস্থা</th>
                                    <th>কার্যকলাপ</th>

                                </tr>
                                </thead>
                                <tbody id="searchTable">

                                    @foreach($allTaskListPrevious as $key=>$allPermissionGroup)


                                    <tr>
    <td>{{ $key+1 }}</td>
                                        <td>{{ $allPermissionGroup->task_type }}</td>
                                        <td>{{ $allPermissionGroup->task_name }}</td>
                                        <td>

    @if(empty($allPermissionGroup->end_date))


    @else

                                            {{ App\Http\Controllers\Admin\CommonController::englishToBangla($allPermissionGroup->end_date) }}
    @endif

                                        </td>
                                        <td>


                                            @if(($allPermissionGroup->end_date_formate < date('Y-m-d')) && ($allPermissionGroup->status == 'চলমান'))

                                            অসম্পূর্ণ
                                            @else



                                            {{ $allPermissionGroup->status }}

                                            @endif



                                        </td>
                                        <td>

                                            <div class="hstack gap-3 fs-15">


                                                <a href="{{ route('taskManager.edit',$allPermissionGroup->id) }}" class="btn btn-info waves-light waves-effect  btn-sm"><i class="fa fa-edit"></i></a>

                                            <a data-bs-toggle="modal" data-bs-target="#exampleModal{{ $key+1 }}" class="btn btn-primary waves-light waves-effect  btn-sm"><i class="fa fa-eye"></i></a>


                                            <div class="modal fade" id="exampleModal{{ $key+1 }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <h1 class="modal-title fs-5" id="exampleModalLabel">কাজের বিবরণ</h1>
                                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <?php

                                            $adminIdList = DB::table('assaign_tasks')
                                            ->where('task_id',$allPermissionGroup->id)
                                            ->get();


                                                ?>


                                                        <h6><u>কর্মকর্তাদের তালিকা</u></h6>

                                                        <ul>
                                                            @foreach($adminIdList as $key=>$adminIdLists)
                                                            <?php

    $adminNameList = DB::table('admins')
                                            ->where('id',$adminIdLists->admin_id)
                                            ->first();


                                                            ?>
                                                            @if(!$adminNameList)

                                                            @else
                                                            <?php

    $desiName = DB::table('designation_lists')
                                            ->where('id',$adminNameList->designation_list_id)
                                            ->value('designation_name');

                                            $branchName = DB::table('branches')->where('id',$adminNameList->branch_id)->value('branch_name');

                                                            ?>

                                                            @if(count($adminIdList)== ($key+1))

                                                            <li>{{ $adminNameList->admin_name_ban }}, {{ $desiName }}, {{ $branchName }} <span style="font-weight:bold;color:green;">( {{ $adminIdLists->status }})</span> |</li>
    @else
    <li>{{ $adminNameList->admin_name_ban }}, {{ $desiName }}, {{ $branchName }} <span style="font-weight:bold;color:green;">( {{ $adminIdLists->status }})</span>;</li>
    @endif

                                                            @endif
                                                            @endforeach
                                                        </ul>

                                                        <h6 class="mt-3"><u>কাজের বিবরণ</u></h6>
    {!! $allPermissionGroup->description !!}

                                                    </div>

                                                  </div>
                                                </div>
                                              </div>




                                              <a onclick="deleteTag({{ $allPermissionGroup->id}})" class="btn btn-danger waves-light waves-effect  btn-sm"><i class="fa fa-trash-o"></i></a>

                                              <form id="delete-form-{{ $allPermissionGroup->id }}" action="{{ route('taskManager.destroy',$allPermissionGroup->id) }}" method="POST" style="display: none;">
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

                        <!-- table end-->

                        </div>
                        <div class="tab-pane fade" id="profile-icon2333" role="tabpanel"
                        aria-labelledby="profile-icon-tab2333">

                        <!--table start -->

                        <div class="table-responsive product-table" >

                            <table class="display" id="basic-4">
                                <thead>
                                <tr>
                                    <th>ক্র: নং:</th>
                                    <th>কাজের ধরন</th>
                                    <th>কাজের নাম</th>
                                    <th>কাজ শেষ করার তারিখ</th>
                                    <th>কাজের অবস্থা</th>
                                    <th>কার্যকলাপ</th>

                                </tr>
                                </thead>
                                <tbody id="searchTable">

                                    @foreach($allTaskListAllComplete as $key=>$allPermissionGroup)


                                    <tr>
    <td>{{ $key+1 }}</td>
                                        <td>{{ $allPermissionGroup->task_type }}</td>
                                        <td>{{ $allPermissionGroup->task_name }}</td>
                                        <td>

    @if(empty($allPermissionGroup->end_date))


    @else

                                            {{ App\Http\Controllers\Admin\CommonController::englishToBangla($allPermissionGroup->end_date) }}
    @endif

                                        </td>
                                        <td>


                                            @if(($allPermissionGroup->end_date_formate < date('Y-m-d')) && ($allPermissionGroup->status == 'চলমান'))

                                            অসম্পূর্ণ
                                            @else



                                            {{ $allPermissionGroup->status }}

                                            @endif



                                        </td>
                                        <td>

                                            <div class="hstack gap-3 fs-15">


                                                <a href="{{ route('taskManager.edit',$allPermissionGroup->id) }}" class="btn btn-info waves-light waves-effect  btn-sm"><i class="fa fa-edit"></i></a>

                                            <a data-bs-toggle="modal" data-bs-target="#exampleModal{{ $key+1 }}" class="btn btn-primary waves-light waves-effect  btn-sm"><i class="fa fa-eye"></i></a>


                                            <div class="modal fade" id="exampleModal{{ $key+1 }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <h1 class="modal-title fs-5" id="exampleModalLabel">কাজের বিবরণ</h1>
                                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <?php

                                            $adminIdList = DB::table('assaign_tasks')
                                            ->where('task_id',$allPermissionGroup->id)
                                            ->get();


                                                ?>


                                                        <h6><u>কর্মকর্তাদের তালিকা</u></h6>

                                                        <ul>
                                                            @foreach($adminIdList as $key=>$adminIdLists)
                                                            <?php

    $adminNameList = DB::table('admins')
                                            ->where('id',$adminIdLists->admin_id)
                                            ->first();


                                                            ?>
                                                            @if(!$adminNameList)

                                                            @else
                                                            <?php

    $desiName = DB::table('designation_lists')
                                            ->where('id',$adminNameList->designation_list_id)
                                            ->value('designation_name');

                                            $branchName = DB::table('branches')->where('id',$adminNameList->branch_id)->value('branch_name');

                                                            ?>

                                                            @if(count($adminIdList)== ($key+1))

                                                            <li>{{ $adminNameList->admin_name_ban }}, {{ $desiName }}, {{ $branchName }} <span style="font-weight:bold;color:green;">( {{ $adminIdLists->status }})</span> |</li>
    @else
    <li>{{ $adminNameList->admin_name_ban }}, {{ $desiName }}, {{ $branchName }} <span style="font-weight:bold;color:green;">( {{ $adminIdLists->status }})</span>;</li>
    @endif

                                                            @endif
                                                            @endforeach
                                                        </ul>

                                                        <h6 class="mt-3"><u>কাজের বিবরণ</u></h6>
    {!! $allPermissionGroup->description !!}

                                                    </div>

                                                  </div>
                                                </div>
                                              </div>




                                              <a onclick="deleteTag({{ $allPermissionGroup->id}})" class="btn btn-danger waves-light waves-effect  btn-sm"><i class="fa fa-trash-o"></i></a>

                                              <form id="delete-form-{{ $allPermissionGroup->id }}" action="{{ route('taskManager.destroy',$allPermissionGroup->id) }}" method="POST" style="display: none;">
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

                        <!-- table end-->

                        </div>
                        <div class="tab-pane fade" id="profile-icon23333" role="tabpanel"
                        aria-labelledby="profile-icon-tab23333">

                        <!--table start -->

                        <div class="table-responsive product-table" >

                            <table class="display" id="basic-6">
                                <thead>
                                <tr>
                                    <th>ক্র: নং:</th>
                                    <th>কাজের ধরন</th>
                                    <th>কাজের নাম</th>
                                    <th>কাজ শেষ করার তারিখ</th>
                                    <th>কাজের অবস্থা</th>
                                    <th>কার্যকলাপ</th>

                                </tr>
                                </thead>
                                <tbody id="searchTable">

                                    @foreach($allTaskListAllOngoing as $key=>$allPermissionGroup)


                                    <tr>
    <td>{{ $key+1 }}</td>
                                        <td>{{ $allPermissionGroup->task_type }}</td>
                                        <td>{{ $allPermissionGroup->task_name }}</td>
                                        <td>

    @if(empty($allPermissionGroup->end_date))


    @else

                                            {{ App\Http\Controllers\Admin\CommonController::englishToBangla($allPermissionGroup->end_date) }}
    @endif

                                        </td>
                                        <td>


                                            @if(($allPermissionGroup->end_date_formate < date('Y-m-d')) && ($allPermissionGroup->status == 'চলমান'))

                                            অসম্পূর্ণ
                                            @else



                                            {{ $allPermissionGroup->status }}

                                            @endif



                                        </td>
                                        <td>

                                            <div class="hstack gap-3 fs-15">


                                                <a href="{{ route('taskManager.edit',$allPermissionGroup->id) }}" class="btn btn-info waves-light waves-effect  btn-sm"><i class="fa fa-edit"></i></a>

                                            <a data-bs-toggle="modal" data-bs-target="#exampleModal{{ $key+1 }}" class="btn btn-primary waves-light waves-effect  btn-sm"><i class="fa fa-eye"></i></a>


                                            <div class="modal fade" id="exampleModal{{ $key+1 }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <h1 class="modal-title fs-5" id="exampleModalLabel">কাজের বিবরণ</h1>
                                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <?php

                                            $adminIdList = DB::table('assaign_tasks')
                                            ->where('task_id',$allPermissionGroup->id)
                                            ->get();


                                                ?>


                                                        <h6><u>কর্মকর্তাদের তালিকা</u></h6>

                                                        <ul>
                                                            @foreach($adminIdList as $key=>$adminIdLists)
                                                            <?php

    $adminNameList = DB::table('admins')
                                            ->where('id',$adminIdLists->admin_id)
                                            ->first();


                                                            ?>
                                                            @if(!$adminNameList)

                                                            @else
                                                            <?php

    $desiName = DB::table('designation_lists')
                                            ->where('id',$adminNameList->designation_list_id)
                                            ->value('designation_name');

                                            $branchName = DB::table('branches')->where('id',$adminNameList->branch_id)->value('branch_name');

                                                            ?>

                                                            @if(count($adminIdList)== ($key+1))

                                                            <li>{{ $adminNameList->admin_name_ban }}, {{ $desiName }}, {{ $branchName }} <span style="font-weight:bold;color:green;">( {{ $adminIdLists->status }})</span> |</li>
    @else
    <li>{{ $adminNameList->admin_name_ban }}, {{ $desiName }}, {{ $branchName }} <span style="font-weight:bold;color:green;">( {{ $adminIdLists->status }})</span>;</li>
    @endif

                                                            @endif
                                                            @endforeach
                                                        </ul>

                                                        <h6 class="mt-3"><u>কাজের বিবরণ</u></h6>
    {!! $allPermissionGroup->description !!}

                                                    </div>

                                                  </div>
                                                </div>
                                              </div>




                                              <a onclick="deleteTag({{ $allPermissionGroup->id}})" class="btn btn-danger waves-light waves-effect  btn-sm"><i class="fa fa-trash-o"></i></a>

                                              <form id="delete-form-{{ $allPermissionGroup->id }}" action="{{ route('taskManager.destroy',$allPermissionGroup->id) }}" method="POST" style="display: none;">
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

                        <!-- table end-->

                        </div>
                        <div class="tab-pane fade" id="profile-icon233333" role="tabpanel"
                        aria-labelledby="profile-icon-tab233333">

                        <!--table start -->

                        <div class="table-responsive product-table" >

                            <table class="display" id="basic-1">
                                <thead>
                                <tr>
                                    <th>ক্র: নং:</th>
                                    <th>কাজের ধরন</th>
                                    <th>কাজের নাম</th>
                                    <th>কাজ শেষ করার তারিখ</th>
                                    <th>কাজের অবস্থা</th>
                                    <th>কার্যকলাপ</th>

                                </tr>
                                </thead>
                                <tbody id="searchTable">
<?php $i=1; ?>
                                    @foreach($allTaskListAll as $key=>$allPermissionGroup)


                                    <tr>
    <td>{{ ($i++)}}</td>
                                        <td>{{ $allPermissionGroup->task_type }}</td>
                                        <td>{{ $allPermissionGroup->task_name }}</td>
                                        <td>

    @if(empty($allPermissionGroup->end_date))


    @else

                                            {{ App\Http\Controllers\Admin\CommonController::englishToBangla($allPermissionGroup->end_date) }}
    @endif

                                        </td>
                                        <td>


                                            @if(($allPermissionGroup->end_date_formate < date('Y-m-d')) && ($allPermissionGroup->status == 'চলমান'))

                                            অসম্পূর্ণ
                                            @else



                                            {{ $allPermissionGroup->status }}

                                            @endif



                                        </td>
                                        <td>

                                            <div class="hstack gap-3 fs-15">


                                                <a href="{{ route('taskManager.edit',$allPermissionGroup->id) }}" class="btn btn-info waves-light waves-effect  btn-sm"><i class="fa fa-edit"></i></a>

                                            <a data-bs-toggle="modal" data-bs-target="#exampleModal{{ $key+1 }}" class="btn btn-primary waves-light waves-effect  btn-sm"><i class="fa fa-eye"></i></a>


                                            <div class="modal fade" id="exampleModal{{ $key+1 }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <h1 class="modal-title fs-5" id="exampleModalLabel">কাজের বিবরণ</h1>
                                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <?php

                                            $adminIdList = DB::table('assaign_tasks')
                                            ->where('task_id',$allPermissionGroup->id)
                                            ->get();


                                                ?>


                                                        <h6><u>কর্মকর্তাদের তালিকা</u></h6>

                                                        <ul>
                                                            @foreach($adminIdList as $key=>$adminIdLists)
                                                            <?php

    $adminNameList = DB::table('admins')
                                            ->where('id',$adminIdLists->admin_id)
                                            ->first();


                                                            ?>
                                                            @if(!$adminNameList)

                                                            @else
                                                            <?php

    $desiName = DB::table('designation_lists')
                                            ->where('id',$adminNameList->designation_list_id)
                                            ->value('designation_name');

                                            $branchName = DB::table('branches')->where('id',$adminNameList->branch_id)->value('branch_name');

                                                            ?>

                                                            @if(count($adminIdList)== ($key+1))

                                                            <li>{{ $adminNameList->admin_name_ban }}, {{ $desiName }}, {{ $branchName }} <span style="font-weight:bold;color:green;">( {{ $adminIdLists->status }})</span> |</li>
    @else
    <li>{{ $adminNameList->admin_name_ban }}, {{ $desiName }}, {{ $branchName }} <span style="font-weight:bold;color:green;">( {{ $adminIdLists->status }})</span>;</li>
    @endif

                                                            @endif
                                                            @endforeach
                                                        </ul>

                                                        <h6 class="mt-3"><u>কাজের বিবরণ</u></h6>
    {!! $allPermissionGroup->description !!}

                                                    </div>

                                                  </div>
                                                </div>
                                              </div>




                                              <a onclick="deleteTag({{ $allPermissionGroup->id}})" class="btn btn-danger waves-light waves-effect  btn-sm"><i class="fa fa-trash-o"></i></a>

                                              <form id="delete-form-{{ $allPermissionGroup->id }}" action="{{ route('taskManager.destroy',$allPermissionGroup->id) }}" method="POST" style="display: none;">
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

                        <!-- table end-->

                        </div>
                    </div>
                    <!-- new update code end -->


    

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
