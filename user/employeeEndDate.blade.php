@extends('admin.master.master')

@section('title')
কর্মকর্তাদের শেষ কর্মদিবসের তালিকা
@endsection


@section('css')
<link href="{{ asset('/') }}public/admin/assets/jquery-editable-select.min.css" rel="stylesheet" />
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
@endsection

@section('body')
<div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-sm-6">
          <h3>কর্মকর্তাদের শেষ কর্মদিবসের তালিকা </h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">হোম</a></li>
            <li class="breadcrumb-item">কর্মকর্তাদের শেষ কর্মদিবসের তালিকা </li>

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
                      <form class="custom-validation" action="{{ route('employeeEndDatePost') }}" method="post" enctype="multipart/form-data" id="form" data-parsley-validate="">
                                @csrf

                          <div class="mb-3">
                                        <label class="form-label" for="">কর্মকর্তার নাম </label>
                            <div class="span7">
                                        <select class="form-control" required name="admin_id" id="fade" type="text" placeholder="">
                                            <option value="">--অনুগ্রহ করে নির্বাচন করুন--</option>
                                            @foreach($users as $AllBranchLists)
                                            <option value="{{ $AllBranchLists->id }}" >{{ $AllBranchLists->admin_name_ban }}</option>
                                            @endforeach
                                        </select>
                            </div>
                                        @if ($errors->has('admin_id'))
                                        <span class="text-danger">{{ $errors->first('admin_id') }}</span>
                                    @endif
                                    </div>

                                    <div class="mb-3" id="designation_list_id">

                                    </div>

                      </form>

                  </div>

              </div>
               </div>
           </div>
    </div>
@endsection
@section('script')
 <script src="{{ asset('/') }}public/admin/assets/jquery-editable-select.js"></script>

 <script>
        $(document).ready(function () {
            $("#fade").change(function () {
                var mainId = $(this).val();
                //alert(mainId);

                $.ajax({
            url: "{{ route('getAdminDetail') }}",
            method: 'GET',
            data: {mainId:mainId},
            success: function(data) {

              $("#designation_list_id").html('');
              $("#designation_list_id").html(data);
            }
        });
            });
        });
    </script>


    {{-- <script>
      window.onload = function () {
        $('#basic').editableSelect();
        $('#default').editableSelect({ effects: 'default' });
        $('#slide').editableSelect({ effects: 'slide' });
        $('#fade').editableSelect({ effects: 'fade' });
        $('#filter').editableSelect({ filter: false });
        $('#html').editableSelect();
        $('#onselect').editableSelect({
          onSelect: function (element) {
            $('#afterSelect').html($(this).val());
          }
        });
      }
    </script> --}}
@endsection
