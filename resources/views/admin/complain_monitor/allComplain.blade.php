@extends('admin.master.master')

@section('title')
অভিযোগের  তালিকা | {{ $ins_name }}
@endsection


@section('css')

@endsection

@section('body')

<div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-sm-6">

            @if (Route::is('allComplain'))
            <h3>অভিযোগের  তালিকা</h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">হোম</a></li>
              <li class="breadcrumb-item">অভিযোগের  তালিকা</li>

            </ol>
            @elseif(Route::is('ongoingComplain'))

            <h3>চলমান অভিযোগের  তালিকা</h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">হোম</a></li>
              <li class="breadcrumb-item">চলমান অভিযোগের  তালিকা</li>

            </ol>


            @elseif(Route::is('completeComplain'))

            <h3>সম্পন্ন করা অভিযোগের  তালিকা</h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">হোম</a></li>
            <li class="breadcrumb-item">সম্পন্ন করা অভিযোগের  তালিকা</li>

          </ol>


            @elseif(Route::is('rejectedComplain'))

          <h3>বাতিল অভিযোগের  তালিকা</h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">হোম</a></li>
            <li class="breadcrumb-item">বাতিল অভিযোগের  তালিকা</li>

          </ol>
            @endif

        </div>
      </div>
    </div>
  </div>


  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header pb-0">

            @if (Route::is('allComplain'))
            <h5>অভিযোগের  তালিকা</h5>
            @elseif(Route::is('ongoingComplain'))
            <h5>চলমান অভিযোগের  তালিকা</h5>

            @elseif(Route::is('completeComplain'))
            <h5>সম্পন্ন করা অভিযোগের  তালিকা</h5>
            @elseif(Route::is('rejectedComplain'))

            <h5>বাতিল অভিযোগের  তালিকা</h5>
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
                                                <th>এনজিও'র  নাম</th>
                                                <th>বিষয়</th>
                                                <th>অভিযোগের অবস্থা</th>
                                                <th>তারিখ</th>
                                                <th>কার্যকলাপ</th>
                                                        </tr>
                                                    </thead>


                                                    <tbody>
                                                        @foreach ($allComplainList as $user)


                                            <tr>
                                               <td>


                                                {{ $loop->index+1 }}




                                            </td>
                                            <td>

                                                <?php

$organizationName = DB::table('fd_one_forms')->where('user_id',$user->user_id)->value('organization_name_ban');
$organizationAddress = DB::table('fd_one_forms')->where('user_id',$user->user_id)->value('organization_address');
                                                ?>
                                   <b>{{ $organizationName }}</b><br>

{{ $organizationAddress }}

                                            </td>

                                                <td>{{ $user->subject }}</td>
                                                <td>




                                                <select class="form-control mainStatusUpdate" id="">
                                                    <option data-mainId = '{{ $user->id }}' value="চলমান" {{ 'চলমান' == $user->status ? 'selected':''  }}>চলমান</option>
                                                    <option data-mainId = '{{ $user->id }}' value="বাতিল" {{ 'বাতিল' == $user->status ? 'selected':''   }}>বাতিল</option>
                                                    <option data-mainId = '{{ $user->id }}' value="সম্পন্ন" {{ 'সম্পন্ন' == $user->status ? 'selected':''  }}>সম্পন্ন</option>
                                                </select>




                                                </td>

                                                <td>
                                                    {{App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-m-Y', strtotime($user->created_at)))}}


                                                </td>
                                                <td>
                                                  @if (Auth::guard('admin')->user()->can('complainUpdate'))
                                                      <a type="button" href="{{ route('complainManager.show',$user->id) }}""
                                                      class="btn btn-primary waves-light waves-effect  btn-sm" >
                                                      <i class="fa fa-eye"></i></a>




                                                        <!--  Large modal example -->
                                                        <div class="modal fade bs-example-modal-lg{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-xl">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="myLargeModalLabel">বিস্তারিত বিবরণ</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
{!! $user->description  !!}
                                                                    </div>
                                                                </div><!-- /.modal-content -->
                                                            </div><!-- /.modal-dialog -->
                                                        </div><!-- /.modal -->


            @endif

            {{-- <button type="button" class="btn btn-primary waves-light waves-effect  btn-sm" onclick="window.location.href='{{ route('admin.users.view',$user->id) }}'"><i class="fa fa-eye"></i></button> --}}

                                              @if (Auth::guard('admin')->user()->can('complainDelete'))

            {{-- <button   type="button" class="btn btn-danger waves-light waves-effect  btn-sm" onclick="deleteTag({{ $user->id}})" data-toggle="tooltip" title="Delete"><i class="fa fa-trash-o"></i></button> --}}
                                <form id="delete-form-{{ $user->id }}" action="{{ route('complainManager.destroy',$user->id) }}" method="POST" style="display: none;">
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







