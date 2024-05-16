@extends('admin.master.master')

@section('title')
কার্য ব্যাবস্থাপনার তথ্য হালনাগাদ করুন
@endsection


@section('css')

@endsection

@section('body')
<div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-sm-6">
          <h3>কার্য ব্যাবস্থাপনার তথ্য</h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">হোম</a></li>
            <li class="breadcrumb-item">কার্য ব্যাবস্থাপনার তথ্য হালনাগাদ করুন</li>

          </ol>
        </div>
        <div class="col-sm-6">

        </div>
        <div class="col-sm-6 mt-3">

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


                            <form class="custom-validation" action="{{ route('taskManager.update',$allTaskList->id ) }}" method="post" enctype="multipart/form-data" id="form" data-parsley-validate="">
                                @csrf
                                @method('PUT')
                                  <div class="row">

                                    <div class="mb-3">

                                        <label for="task_type">কাজের ধরন <span class="text-danger">*</span></label>
                                        <select class="form-control" required name="task_type" id="task_type">
                                            <option value="">--অনুগ্রহ করে নির্বাচন করুন--</option>

                                            <option value="গ্রুপ" {{ 'গ্রুপ' == $allTaskList->task_type ? 'selected':'' }}>গ্রুপ</option>
                                            <option value="সিঙ্গেল" {{'সিঙ্গেল' == $allTaskList->task_type ? 'selected':'' }}>সিঙ্গেল </option>
                                        </select>

                                    </div>

                                    <div class="mb-3" id="result">

                                        @if($allTaskList->task_type == 'গ্রুপ')
<?php
$adminIdList = DB::table('assaign_tasks')
                                        ->where('task_id',$allTaskList->id)
                                        ->get();

                                        $convert_name_title = $adminIdList->implode("admin_id", " ");


$separated_data_title = explode(" ", $convert_name_title);
?>

<label  for="admin_id">কর্মকর্তার নাম </label>

            <select multiple="multiple"  class="form-control form-control-sm js-example-basic-multiple" required name="admin_id[]" id="admin_id">
                <option value="">--অনুগ্রহ করে নির্বাচন করুন--</option>
                @foreach($users as $AllBranchLists)
                <option value="{{ $AllBranchLists->id }}" {{ (in_array($AllBranchLists->id,$separated_data_title)) ? 'selected' : '' }}>{{ $AllBranchLists->admin_name_ban }}</option>
                @endforeach
            </select>
                                        @else

                                        <?php

$adminIdList = DB::table('assaign_tasks')
                                        ->where('task_id',$allTaskList->id)
                                        ->get();


                                        $convert_name_title = $adminIdList->implode("admin_id", " ");


$separated_data_title = explode(" ", $convert_name_title);

//dd($separated_data_title);

                                        ?>

                                        <label  for="admin_id">কর্মকর্তার নাম </label>

                                        <select class="form-control js-example-basic-single" required name="admin_id" id="admin_id">
                                            <option value="">--অনুগ্রহ করে নির্বাচন করুন--</option>
                                            @foreach($users as $AllBranchLists)
                                            <option value="{{ $AllBranchLists->id }}" {{ (in_array($AllBranchLists->id,$separated_data_title)) ? 'selected' : '' }}>{{ $AllBranchLists->admin_name_ban }}</option>
                                            @endforeach
                                        </select>
                                        @endif

                                    </div>

                                    <div class="mb-3">

                                            <label for="email">কাজের নাম <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control"  id="task_name" value="{{$allTaskList->task_name }}" name="task_name" placeholder="কাজের নাম" required>

                                    </div>

                                    <div class="mb-3">

                                        <label for="last_date">কাজ শেষ করার তারিখ</label>
                                        <input type="text" class="form-control datepicker233" value="{{$allTaskList->end_date }}"  id="last_date" name="last_date" placeholder="কাজ শেষ করার তারিখ" >

                                </div>

                                <div class="mb-3">
                                    <label for="peditor">কাজের বিবরণ<span class="text-danger">*</span></label>
                                    <textarea class="maineditor" id="peditor"  name="mainPartNote" required>
                                        {!! $allTaskList->description !!}
                                    </textarea>
                                </div>


                                <div class="mb-3">

                                    <label for="status">স্টেটাস<span class="text-danger">*</span></label>
                                    <select class="form-control" required name="status" id="status">
                                        <option value="">--অনুগ্রহ করে নির্বাচন করুন--</option>

                                        <option value="চলমান" {{ 'চলমান' == $allTaskList->status ? 'selected':'' }}>চলমান</option>
                                        {{-- <option value="সম্পন্ন" {{'সম্পন্ন' == $allTaskList->status ? 'selected':'' }}>সম্পন্ন </option> --}}
                                    </select>

                                </div>

                                      <div class="col-lg-12">
                                          <div class="float-right d-none d-md-block">
                                              <div class="form-group mb-4">
                                                  <div>
                                                      <button type="submit" class="btn btn-primary btn-lg  waves-effect  btn-sm waves-light mr-1">
                                                        হালনাগাদ করুন
                                                      </button>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div> <!-- end col -->
                              </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')



<script>
    $("#task_type").change(function(){


var task_type = $(this).val();


//alert(dakId+nothiId+status);


$.ajax({
    url: "{{ route('taskManagerType') }}",
    method: 'GET',
    data: {task_type:task_type},
    success: function(data) {
$("#result").html('');
         $("#result").html(data);
    }
    });


});
</script>


<script src="https://cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script>
<script>
    CKEDITOR.replace('peditor');
</script>
@endsection
