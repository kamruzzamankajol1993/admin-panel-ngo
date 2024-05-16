@extends('admin.master.master')

@section('title')
আবেদনপত্র হালনাগাদ করুন করুন | {{ $ins_name }}
@endsection


@section('css')

@endsection

@section('body')
<style>


        .ck-editor__editable[role="textbox"] {
            /* editing area */
            min-height: 10vh;
        }

        .ck-content .image {
            /* block images */
            max-width: 80%;
            margin: 20px auto;
        }


    </style>
<div class="container-fluid">
    <div class="page-header">
      <div class="row mt-5">
        <div class="col-sm-6">


            <h3>আবেদন পত্রের তালিকা </h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">হোম</a></li>
              <li class="breadcrumb-item">আবেদনপত্র হালনাগাদ করুন করুন</li>

            </ol>


        </div>



      </div>
    </div>
  </div>


  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header pb-0">
            <h5>আবেদনপত্র হালনাগাদ করুন করুন </h5>
          </div>
          <div class="card-body">
            @include('flash_message')
            <form id="form" class="custom-validation" action="{{ route('leaveManagement.update',$leavedetail->id) }}" method="post" enctype="multipart/form-data">
                @csrf



                @if(Route::is('sentApplicationEdit'))
                <input type="hidden"  value="1"  name="route_id">
                @elseIf(Route::is('receivedApplicationEdit'))
                <input type="hidden"  value="2"  name="route_id">
                @else
                <input type="hidden"  value="3"  name="route_id">
                @endif

@method('PUT')
                @if(Route::is('sentApplicationEdit'))

                <div class="row">

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">


                                <div class="row">
            <div class="form-group col-md-6 col-sm-6">
                <label for="name">প্রাপকের নাম</label>
                <select class="form-control js-example-basic-single"  name="to_admin" placeholder="চাকরির শেষ তারিখ" required>
                  <option value="">-- একটা নির্বাচন করুন --</option>
                  @foreach($adminList as $adminLists)

                  <option value="{{ $adminLists->id }}" {{ $leavedetail->to_admin == $adminLists->id  ? 'selected':''  }}>{{ $adminLists->admin_name_ban }}</option>


                  @endforeach
                </select>
            </div>

            <div class="form-group col-md-6 col-sm-6">
              <label for="position">বিষয়</label>
              <input type="text" class="form-control" id="position" value="{{ $leavedetail->subject  }}"  name="subject" placeholder="বিষয়">
          </div>

          <div class="form-group col-md-12 col-sm-12">
              <label for="mainpeditor">বিস্তারিত</label>
              <textarea class="form-control" class="maineditorForAdd" id="mainpeditor" name="body" placeholder="বিস্তারিত">
                {!! $leavedetail->body !!}
              </textarea>
          </div>

          <div class="form-group col-md-12 col-sm-12">
              <label for="date">আবেদনের তারিখ</label>
              <input type="text" class="form-control datepicker233" id="date" value="{{ $leavedetail->applicate_date  }}"  name="applicate_date" placeholder="আবেদনের তারিখ">
          </div>




        </div>




                            </div>

                        </div>
                    </div>



                    <div class="col-lg-12">
                        <div class="text-end">
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


                @else
                  <div class="row">

                      <div class="col-lg-12">
                          <div class="card">
                              <div class="card-body">


                                  <div class="row">
              <div class="form-group col-md-6 col-sm-6">
                  <label for="name">প্রাপকের নাম</label>
                  <select disabled class="form-control js-example-basic-single"  name="to_admin" placeholder="চাকরির শেষ তারিখ" required>
                    <option value="">-- একটা নির্বাচন করুন --</option>
                    @foreach($adminList as $adminLists)

                    <option value="{{ $adminLists->id }}" {{ $leavedetail->to_admin == $adminLists->id  ? 'selected':''  }}>{{ $adminLists->admin_name_ban }}</option>


                    @endforeach
                  </select>
              </div>

              <div class="form-group col-md-6 col-sm-6">
                <label for="position">বিষয়</label>
                <input type="text" readonly class="form-control" id="position" value="{{ $leavedetail->subject  }}" name="subject" placeholder="বিষয়">
            </div>

            <div class="form-group col-md-12 col-sm-12">
                <label for="mainpeditor">বিস্তারিত</label>
                <textarea class="form-control" readonly class="maineditorForAdd" id="mainpeditor" name="body" placeholder="বিস্তারিত">
                    {!! $leavedetail->body !!}
                </textarea>
            </div>

            <div class="form-group col-md-6 col-sm-6">
                <label for="date">আবেদনের তারিখ</label>
                <input type="text" disabled class="form-control" id="date" value="{{ $leavedetail->applicate_date  }}"  name="applicate_date" placeholder="আবেদনের তারিখ">
            </div>

            <div class="form-group col-md-6 col-sm-6">
                <label for="date">আবেদনের অবস্থা</label>
                <select class="form-control" id="date" name="status">
                    <option value="">-- একটা নির্বাচন করুন --</option>
                    <option value="Pending" {{ $leavedetail->status == 'Pending'  ? 'selected':'' }}>Pending</option>
                    <option value="Accepted" {{ $leavedetail->status == 'Accepted'  ? 'selected':'' }}>Accepted</option>
                    <option value="Rejected" {{ $leavedetail->status == 'Rejected'  ? 'selected':'' }}>Rejected</option>
                </select>
            </div>


          </div>




                              </div>

                          </div>
                      </div>



                      <div class="col-lg-12">
                          <div class="text-end">
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
                  @endif
              </form>

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

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
    </div>
</div>

@endsection

@section('script')

<script src="https://cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script>
<script>

   CKEDITOR.replace('mainpeditor');

 </script>
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







