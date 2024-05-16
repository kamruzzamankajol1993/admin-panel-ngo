@extends('admin.master.master')

@section('title')
অভিযোগ| {{ $ins_name }}
@endsection


@section('css')

@endsection

@section('body')
<div class="container-fluid">
    <div class="page-header">
      <div class="row mt-5">
        <div class="col-sm-6">


            <h3>অভিযোগ</h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">হোম</a></li>
              <li class="breadcrumb-item">{{ $allComplainList->subject }}</li>

            </ol>


        </div>



      </div>
    </div>
  </div>
  <?php

  $organizationName = DB::table('fd_one_forms')->where('user_id',$allComplainList->user_id)->value('organization_name_ban');
  $organizationAddress = DB::table('fd_one_forms')->where('user_id',$allComplainList->user_id)->value('organization_address');
                                                  ?>

  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
            <div class="card-header bg-primary" style="">

                 <div class="row">

                    <div class="col-md-6">
                        <span style="font-size: 20px;">এনজিও'র  নাম: {{ $organizationName }}</span><br>
                        <span style="font-size: 20px;">এনজিও'র ঠিকানা: {{ $organizationAddress  }}</span>
                    </div>

                    <div class="col-md-6">
                        <div class="text-end">
                            <span style="font-size: 20px;">অভিযোগের বিষয়: {{ $allComplainList->subject }}</span><br>
                            <span style="font-size: 20px;">অভিযোগের তারিখ: {{App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-m-Y', strtotime($allComplainList->created_at)))}} </span>
                        </div>

                    </div>

                </div>

            </div>
          <div class="card-body" style="">

            {!! $allComplainList->description  !!}


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







