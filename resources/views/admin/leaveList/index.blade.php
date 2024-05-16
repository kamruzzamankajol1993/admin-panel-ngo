@extends('admin.master.master')

@section('title')
আবেদন পত্রের তালিকা | {{ $ins_name }}
@endsection


@section('css')

@endsection

@section('body')

<div class="container-fluid">
    <div class="page-header">
      <div class="row mt-5">
        <div class="col-sm-6">

            @if (Route::is('leaveManagement.index'))
            <h3>আবেদন পত্রের তালিকা </h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">হোম</a></li>
              <li class="breadcrumb-item">সকল আবেদন পত্রের তালিকা </li>

            </ol>
            @elseif(Route::is('sentApplication'))

            <h3>আবেদন পত্রের তালিকা</h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">হোম</a></li>
              <li class="breadcrumb-item">প্রেরিত আবেদন পত্রের তালিকা</li>

            </ol>


            @elseif(Route::is('receivedApplication'))

            <h3>আবেদন পত্রের তালিকা</h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">হোম</a></li>
            <li class="breadcrumb-item">প্রাপ্ত আবেদন পত্রের তালিকা</li>

          </ol>
            @endif

        </div>

        <div class="col-sm-6">
            <div class="text-end">
            @if (Auth::guard('admin')->user()->can('leaveAdd'))
            <a href="{{ route('leaveManagement.create') }}" class="btn btn-primary  waves-effect  btn-sm waves-light " type="button" >
                                                    <i class="far fa-calendar-plus  mr-2"></i> নতুন আবেদনপত্র যোগ করুন
            </a>
                                                @endif
        </div>
        </div>

      </div>
    </div>
  </div>


  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header pb-0">

            @if (Route::is('leaveManagement.index'))
            <h5>সকল আবেদন পত্রের তালিকা</h5>
            @elseif(Route::is('receivedApplication'))
            <h5>প্রাপ্ত আবেদন পত্রের তালিকা</h5>
            @elseif(Route::is('sentApplication'))
            <h5>প্রেরিত আবেদন পত্রের তালিকা</h5>
            @endif


          </div>
          <div class="card-body">
            @include('flash_message')
            <div class="table-responsive">
                <table id="basic-1" class="table table-bordered dt-responsive nowrap"
                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                    <thead>
                                                        <tr>
                                                <th>ক্র: নং:</th>
                                                <th>আবেদনপত্রের তারিখ</th>
                                                <th>বিষয়</th>
                                                <th>প্রেরকের নাম</th>
                                                <th>আবেদন পত্রের অবস্থা</th>
                                                <th>কার্যকলাপ</th>
                                                        </tr>
                                                    </thead>


                                                    <tbody>
                                                        @foreach ($leaveLists as $user)
                                                        <?php

                                                        $senderName = DB::table('admins')->where('id',$user->created_by)->value('admin_name_ban');
                                                                                                        ?>

                                            <tr>
                                               <td>{{ $loop->index+1 }}</td>
                                               <td>{{App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-m-Y', strtotime(\Carbon\Carbon::parse($user->applicate_date)->toDateString())))}}</td>
                                               <td>{{ $user->subject }}</td>
                                               <td><b>{{ $senderName }}</b></td>
                                               <td>{{ $user->status }}</td>
                                                <td>




                                                    @if(Route::is('sentApplication'))
                                                    @if (Auth::guard('admin')->user()->can('leaveUpdate'))
                                                    <button class="btn btn-info btn-xs" type="button" data-original-title="btn btn-info btn-xs" title="" onclick="location.href = '{{ route('sentApplicationEdit',$user->id) }}';"><i class="fa fa-edit"></i></button>
                                                                                                      @endif

                                                    @elseif(Route::is('receivedApplication'))

                                                    @if (Auth::guard('admin')->user()->can('leaveUpdate'))
                                                    <button class="btn btn-info btn-xs" type="button" data-original-title="btn btn-info btn-xs" title="" onclick="location.href = '{{ route('receivedApplicationEdit',$user->id) }}';"><i class="fa fa-edit"></i></button>
                                                                                                      @endif

                                                    @else
                                                  @if (Auth::guard('admin')->user()->can('leaveUpdate'))
<button class="btn btn-info btn-xs" type="button" data-original-title="btn btn-info btn-xs" title="" onclick="location.href = '{{ route('leaveManagement.edit',$user->id) }}';"><i class="fa fa-edit"></i></button>
                                                  @endif
                                                  @endif

                                                  @if (Auth::guard('admin')->user()->can('leaveView'))
                                                  <button class="btn btn-primary btn-xs" type="button" data-original-title="btn btn-success btn-xs" title="" onclick="location.href = '{{ route('leaveManagement.show',$user->id) }}';"><i class="fa fa-eye"></i></button>
                                                                                                    @endif

            {{-- <button type="button" class="btn btn-primary waves-light waves-effect  btn-sm" onclick="window.location.href='{{ route('admin.users.view',$user->id) }}'"><i class="fa fa-eye"></i></button> --}}

                                              @if (Auth::guard('admin')->user()->can('leaveDelete'))

            <button   type="button" class="btn btn-danger waves-light waves-effect  btn-sm" onclick="deleteTag({{ $user->id}})" data-toggle="tooltip" title="Delete"><i class="fa fa-trash-o"></i></button>
                                <form id="delete-form-{{ $user->id }}" action="{{ route('leaveManagement.destroy',$user->id) }}" method="POST" style="display: none;">
                                  @method('DELETE')
                                                                @csrf

                                                            </form>
                                                            @endif
                                                </td>
                                            </tr>
            @endforeach


                                                    </tbody>
                                                </table>
            </div>

          </div>

        </div>

      </div>
    </div>
  </div>






  <!--  Large modal example -->
  <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">নতুন দেশ যোগ করুন</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form id="form" class="custom-validation" action="{{ route('country.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                      <div class="row">

                          <div class="col-lg-12">
                              <div class="card">
                                  <div class="card-body">


                                      <div class="row">
                  <div class="form-group col-md-12 col-sm-12">
                      <label for="name">নাম (ইংরেজি)</label>
                      <input type="text" class="form-control" id="name" name="name" placeholder="নাম (ইংরেজি)">
                  </div>

                  <div class="form-group col-md-12 col-sm-12">
                    <label for="position">নাম (বাংলা)</label>
                    <input type="text" class="form-control" id="position" name="name_bn" placeholder="নাম (বাংলা)">
                </div>

                <div class="form-group col-md-12 col-sm-12">
                    <label for="email">নাগরিকত্ব (ইংরেজি)</label>
                    <input type="text" class="form-control form-control-sm" id="email" name="city_eng" placeholder="নাগরিকত্ব (ইংরেজি)" >
                </div>

                <div class="form-group col-md-12 col-sm-12">
                    <label for="email">নাগরিকত্ব (বাংলা)</label>
                    <input type="text" class="form-control form-control-sm" id="email" name="city_bangla" placeholder="নাগরিকত্ব (বাংলা)">
                </div>


              </div>




                                  </div>

                              </div>
                          </div>



                          <div class="col-lg-12">
                              <div class="float-right d-none d-md-block">
                                  <div class="form-group mb-4">
                                      <div>
                                          <button type="submit" class="btn btn-primary btn-lg  waves-effect  btn-sm waves-light mr-1">
                                            জমা দিন
                                          </button>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div> <!-- end col -->
                  </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
    </div>
</div>

@endsection

@section('script')


<script>

$(document).on('change','.mainStatusUpdate',function(){
    var attr= $(this).find('option:selected').attr('data-mainId');
    var value=$(this).val();
    //alert(attr)



    $.ajax({
    url: "{{ route('updateComplainStatus') }}",
    method: 'get',
    data: {attr:attr,value:value},
    success: function(data) {



          alertify.set('notifier','position','top-center');
          alertify.success('Updated Successfully');

          location.reload(true);


    },
    beforeSend: function(){
        $('#pageloader').show()
    },
    complete: function(){
        $('#pageloader').hide()
    }
    });


});

</script>

     <script>
         /**
         * Check all the permissions
         */
         $("#checkPermissionAll").click(function(){
             if($(this).is(':checked')){
                 // check all the checkbox
                 $('input[type=checkbox]').prop('checked', true);
             }else{
                 // un check all the checkbox
                 $('input[type=checkbox]').prop('checked', false);
             }
         });
         function checkPermissionByGroup(className, checkThis){
            const groupIdName = $("#"+checkThis.id);
            const classCheckBox = $('.'+className+' input');
            if(groupIdName.is(':checked')){
                 classCheckBox.prop('checked', true);
             }else{
                 classCheckBox.prop('checked', false);
             }
         }
     </script>

<script type="text/javascript">
    function deleteTag(id) {
        swal({
            title: 'আপনি কি এ ব্যাপারে নিশ্চিত?',
            text: "আপনি এটি ফিরিয়ে আনতে পারবেন না!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'হ্যাঁ, এটি মুছুন!',
            cancelButtonText: 'না, বাতিল করুন!',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                event.preventDefault();
                document.getElementById('delete-form-'+id).submit();
            } else if (
                // Read more about handling dismissals
                result.dismiss === swal.DismissReason.cancel
            ) {
                swal(
                    'বাতিল করা হয়েছে',
                    'আপনার ডেটা নিরাপদ :)',
                    'error'
                )
            }
        })
    }
</script>
@endsection







