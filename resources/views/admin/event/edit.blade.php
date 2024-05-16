@extends('admin.master.master')

@section('title')
ইভেন্টের মানাজেমেন্টের হালনাগাদ করুন
@endsection


@section('css')

@endsection

@section('body')
<div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-sm-6">
          <h3>ইভেন্টের মানাজেমেন্টের  তথ্য</h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">হোম</a></li>
            <li class="breadcrumb-item">ইভেন্টের মানাজেমেন্টের হালনাগাদ করুন</li>

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


                        <form class="custom-validation" action="{{ route('eventManager.update',$allTaskList->id ) }}" method="post" enctype="multipart/form-data" id="form" data-parsley-validate="">
                            @csrf
                            @method('PUT')
                                  <div class="row">



                                    <div class="mb-3">

                                            <label for="email">ইভেন্টের  নাম <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control"  id="task_name" value="{{ $allTaskList->name }}" name="name" placeholder="ইভেন্টের নাম" required>

                                    </div>

                                    <div class="mb-3">

                                        <label for="last_date">ইভেন্টের তারিখ</label>
                                        <input type="text" class="form-control datepicker233"  id="date" value="{{ $allTaskList->date }}" name="date" placeholder="ইভেন্টের তারিখ" >

                                </div>


                                <div class="mb-3">

                                    <label for="last_date">ইভেন্টের সময়</label>
                                    <input input type="text" class="form-control timepicker" id="last_date" value="{{ $allTaskList->time }}" name="time" placeholder="ইভেন্টের সময়" >

                            </div>

                                <div class="mb-3">
                                    <label for="peditor">ইভেন্টের বিবরণ<span class="text-danger">*</span></label>
                                    <textarea class="maineditor" id="peditor"  name="detail" required>
                                        {{ $allTaskList->detail }}
                                    </textarea>
                                </div>


                                <div class="mb-3">

                                    <label for="status">স্টেটাস<span class="text-danger">*</span></label>
                                    <select class="form-control" required name="status" id="status">
                                        <option value="">--অনুগ্রহ করে নির্বাচন করুন--</option>

                                        <option value="শীঘ্রই আসছে" {{ 'শীঘ্রই আসছে' == $allTaskList->status ? 'selected':'' }}>শীঘ্রই আসছে</option>
                                        <option value="বাতিল" {{ 'বাতিল' == $allTaskList->status ? 'selected':'' }}>বাতিল</option>
                                        <option value="সম্পন্ন" {{'সম্পন্ন' == $allTaskList->status ? 'selected':'' }}>সম্পন্ন </option>
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
