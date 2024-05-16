<?php
?>
<p id="deleteStatus"></p>
   <table class="table table-bordered mt-3">
    <tr>
        <th>
            {{-- <button class="btn btn-outline-success">#</button> --}}
        </th>
        <th>পদবী</th>
        <th>নাম</th>
        <th>মূল-প্রাপক</th>
        <th>কার্যার্থে অনুলিপি</th>
        <th>জ্ঞাতার্থে অনুলিপি</th>
        <th>দৃষ্টি আকর্ষণ</th>
    </tr>
    @foreach($allRegistrationDak as $showAllRegistrationDak)

    <?php
    $adminName = DB::table('admins')
    ->where('id',$showAllRegistrationDak->receiver_admin_id)->value('admin_name_ban');

    $designationId = DB::table('admin_designation_histories')
    ->where('admin_id',$showAllRegistrationDak->receiver_admin_id)
    ->value('designation_list_id');

    $designationName = DB::table('designation_lists')
    ->where('id',$designationId)->value('designation_name');

    $branchId = DB::table('designation_lists')
    ->where('id',$designationId)->value('branch_id');

    $branchName = DB::table('branches')
    ->where('id',$branchId)->value('branch_name');
?>
    <tr>
        <td>
            {{-- <div class="d-flex justify-content-center">
                <button class="btn btn-outline-success"><i class="fa fa-trash"></i></button>
            </div> --}}


            <div class="d-flex justify-content-center">
            {{-- <a   type="button" class="btn btn-outline-success"  ><i class="fa fa-trash"></i></a> --}}

            <button data-id="{{ $showAllRegistrationDak->id }}" data-status="{{ $mainDataStatus }}" class="btn btn-outline-success remove-input-field-newm"><i class="fa fa-trash"></i></button>

            </div>


        </td>
        <td>{{ $branchName }}, {{ $designationName }}
        </td>
        <td>{{ $adminName }}</td>
        <td>

            <input value="{{ $showAllRegistrationDak->id }}" type="hidden" name="receiverId[{{ $showAllRegistrationDak->id }}]"/>
            <input value="{{ $showAllRegistrationDak->id }}" type="hidden" name="receiverIdAjax[]"/>

            <div class="d-flex justify-content-center">


                <div class="custom_checkbox">
                    <input id="mmcheck{{ $showAllRegistrationDak->id }}" class="custom_check main_prapok"
                           type="checkbox" name="main_prapok{{ $showAllRegistrationDak->id }}[{{ $showAllRegistrationDak->id }}]" value="1" data-mid="{{ $showAllRegistrationDak->id }}" />
                    <label for="mmcheck{{ $showAllRegistrationDak->id }}" style="--d: 30px">
                        <svg viewBox="0,0,50,50">
                            <path d="M5 30 L 20 45 L 45 5"></path>
                        </svg>
                    </label>
                </div>
            </div>
        </td>
        <td>
            <div class="d-flex justify-content-center">
                <div class="custom_checkbox">
                    <input id="check{{ $showAllRegistrationDak->id }}" class="custom_check karjo_onulipi"
                           type="checkbox" name="karjo_onulipi{{ $showAllRegistrationDak->id }}[{{ $showAllRegistrationDak->id }}]" value="1" data-mid="{{ $showAllRegistrationDak->id }}" />
                    <label for="check{{ $showAllRegistrationDak->id }}" style="--d: 30px">
                        <svg viewBox="0,0,50,50">
                            <path d="M5 30 L 20 45 L 45 5"></path>
                        </svg>
                    </label>
                </div>
            </div>
        </td>
        <td>
            <div class="d-flex justify-content-center">
                <div class="custom_checkbox">
                    <input id="icheck{{ $showAllRegistrationDak->id }}" class="custom_check info_onulipi"
                           type="checkbox" name="info_onulipi{{ $showAllRegistrationDak->id }}[{{ $showAllRegistrationDak->id }}]" value="1" data-mid = "{{ $showAllRegistrationDak->id }}" />
                    <label for="icheck{{ $showAllRegistrationDak->id }}" style="--d: 30px">
                        <svg viewBox="0,0,50,50">
                            <path d="M5 30 L 20 45 L 45 5"></path>
                        </svg>
                    </label>
                </div>
            </div>
        </td>
        <td>
            <div class="d-flex justify-content-center">
                <div class="custom_checkbox">
                    <input id="echeck{{ $showAllRegistrationDak->id }}" class="custom_check eye_onulipi"
                           type="checkbox" data-mid = "{{ $showAllRegistrationDak->id }}" value="1"  name="eye_onulipi{{ $showAllRegistrationDak->id }}[{{ $showAllRegistrationDak->id }}]"/>
                    <label for="echeck{{ $showAllRegistrationDak->id }}" style="--d: 30px">
                        <svg viewBox="0,0,50,50">
                            <path d="M5 30 L 20 45 L 45 5"></path>
                        </svg>
                    </label>
                </div>
            </div>
        </td>
    </tr>
    @endforeach

</table>



<script>
    $(document).on('click', '.remove-input-field-newm', function () {
        //$(this).parents('tr').remove();

           var id = $(this).data('id');
           var status = $(this).data('status');

           //deleteMemberListAjax

           $(this).parents('tr').remove();
           $.ajax({
            url: "{{ route('deleteMemberListAjax') }}",
            method: 'GET',
            data: {id:id,status:status},
            success: function(data) {
                
          //alert(data);
                if(data  >= 1){
                    
                                     $("#lastButton").html('<button class="btn btn-primary" type="submit" ><i class="fa fa-send"></i>প্রেরণ</button>');
                    
                }else{
                    
                                     $("#lastButton").html('<a class="btn btn-danger"><i class="fa fa-send"></i>প্রেরণ এর পূর্বে, দয়া করে সিল তৈরী  করুন</a>');
                }



                // $("#serial_part_one"+id_for_pass).val(data);
                 $("#deleteStatus").html('<div class="alert" style=" padding: 20px;background-color: #f44336 !important;color: white;"><strong>ডেটা সফলভাবে মুছে ফেলা হয়েছে</strong></div>');




            }
            });



    });

    setTimeout(function(){
  $('#deleteStatus').remove();
}, 10000);

    </script>


<script>

$(document).on('click', '.main_prapok', function(){

    var mainPrapokId = $(this).data('mid');

    $('input.main_prapok').not(this).prop('checked', false);



    if($(this).is(':checked')){


$("#check"+mainPrapokId).prop('checked', false);
$("#icheck"+mainPrapokId).prop('checked', false);
$("#echeck"+mainPrapokId).prop('checked', false);


}



// //     alert(mainPrapokId);


//     var receiver_id_ajax = $('input[name="receiverIdAjax[]"]').map(function (idx, ele) {
//    return $(ele).val();
// }).get();

// var receiver_id_ajax_new = $.grep(receiver_id_ajax, function(value) {
//   return value != mainPrapokId;
// });

// //alert(y);

// for (var i = 0; i < receiver_id_ajax_new.length; i++) {


//     $("#check"+receiver_id_ajax_new[i] << 0).removeAttr('disabled');
//     $("#icheck"+receiver_id_ajax_new[i] << 0).removeAttr('disabled');
//     $("#echeck"+receiver_id_ajax_new[i] << 0).removeAttr('disabled');

// }


//     if($(this).is(':checked')){

//     $("#check"+mainPrapokId).attr('disabled', 'disabled');
//     $("#icheck"+mainPrapokId).attr('disabled', 'disabled');
//     $("#echeck"+mainPrapokId).attr('disabled', 'disabled');
//     }else{

//     $("#check"+mainPrapokId).removeAttr('disabled');
//     $("#icheck"+mainPrapokId).removeAttr('disabled');
//     $("#echeck"+mainPrapokId).removeAttr('disabled');

//     }
});

/////
//karjo_onulipi
$(document).on('click', '.karjo_onulipi', function(){

    var mainPrapokId = $(this).data('mid');



    if($(this).is(':checked')){


$("#check"+mainPrapokId).prop('checked', true);
$("#mmcheck"+mainPrapokId).prop('checked', false);
$("#icheck"+mainPrapokId).prop('checked', false);
$("#echeck"+mainPrapokId).prop('checked', false);


}

});

//info_onulipi

$(document).on('click', '.info_onulipi', function(){

var mainPrapokId = $(this).data('mid');



if($(this).is(':checked')){


$("#check"+mainPrapokId).prop('checked', false);
$("#mmcheck"+mainPrapokId).prop('checked', false);
$("#icheck"+mainPrapokId).prop('checked', true);
$("#echeck"+mainPrapokId).prop('checked', false);


}

});


//eye_onulipi

$(document).on('click', '.eye_onulipi', function(){

var mainPrapokId = $(this).data('mid');

//alert(mainPrapokId);

if($(this).is(':checked')){


$("#check"+mainPrapokId).prop('checked', false);
$("#mmcheck"+mainPrapokId).prop('checked', false);
$("#icheck"+mainPrapokId).prop('checked', false);
$("#echeck"+mainPrapokId).prop('checked', true);


}

});

//decision list



</script>
