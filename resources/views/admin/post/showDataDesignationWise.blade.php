

    <p id="sm"></p>
    <input type="hidden" value="{{ $mainStatusNew }}" name="mainStatusNew" id="mainStatusNew"/>
    <input type="hidden" value="{{ $newMainDakIdOne }}" name="main_id"  id="mainIdNewone"/>
    <table class="table table-bordered"  id="cleanData">
        <tr>
            <th>#</th>
            <th>কর্মকর্তা</th>
        </tr>

        @foreach($totalBranchList as $allTotalBranchList)

       <?php

          $getAllDesignationName = DB::table('designation_lists')
          ->where('branch_id',$allTotalBranchList->id)
          ->whereIn('id',$totalDesi)->orderBy('designation_serial','asc')->get();

        ?>
        <tr >
            <td>
                <button data-id="{{ $allTotalBranchList->id }}" class="btn btn-outline-success remove-input-field-new"><i class="fa fa-trash"></i></button>
            </td>
            <td>
                <b>শাখাঃ {{ $allTotalBranchList->branch_name }}</b>
                <table class="table table-bordered">
                @foreach($getAllDesignationName as $allGetAllDesignationName)

                <?php
                $adminId = DB::table('admin_designation_histories')->where('designation_list_id',$allGetAllDesignationName->id)->value('admin_id');
                $adminName = DB::table('admins')->where('id',$adminId)->value('admin_name_ban');
        ?>

                <tr id="brnachWiseDelete{{ $allGetAllDesignationName->id }}">

                    <td>
                        <a data-id="{{ $allTotalBranchList->id }}"  class="btn btn-outline-success remove-input-field"><i class="fa fa-trash"></i></a>
                    </td>
                    <td>

                        <input type="hidden" value="{{ $adminId }}" name="admin_id[]" id="adminIdNew"/>
                        {{ $adminName }},{{ $allGetAllDesignationName->designation_name }} <span style="font-size:12px; color: #aeaeae;">{{ $allTotalBranchList->branch_name }}</span>
                    </td>

                </tr>

                @endforeach
                </table>
            </td>
        </tr>

        @endforeach





    </table>


    <button id="finalMain" class="btn btn-success mt-5">দাখিল করুন </button>



    <script>
  //$(document).on('click', '#finalMain', function () {

    $("#finalMain").click(function(){




    var mainStatusNew = $('#mainStatusNew').val();
    var main_id = $('#mainIdNewone').val();
    var admin_id = $('input[name="admin_id[]"]').map(function (idx, ele) {
       return $(ele).val();
    }).get();

//alert(admin_id);
    //alert(secret_listNew +' '+mainStatusNew + main_id + admin_id);


    $.ajax({
            url: "{{ route('dakListFirstStep') }}",
            method: 'GET',
            data: {mainStatusNew:mainStatusNew,main_id:main_id,admin_id:admin_id},
            success: function(data) {


                //cleanData







                // $("#serial_part_one"+id_for_pass).val(data);
                 $("#sm").html('<div class="alert" style=" padding: 20px;background-color: #1b4c43 !important;color: white;"><strong>ডেটা সফলভাবে যোগ করা হয়েছে</strong></div>');
                 $("#icon-home1").html('');
                 $("#icon-home1").html(data);
                 $("#cleanData").html('');


                 $("#finalMain").remove();

                 $("#lastButton").html('<button class="btn btn-primary" type="submit" ><i class="fa fa-send"></i>প্রেরণ</button>');

$('#staticBackdrop').modal('hide');
            }
            });
});
        </script>

    <script>
    $(document).on('click', '.remove-input-field', function () {
        //$(this).parents('tr').remove();

           var deleteId = $(this).data('id');



         $('#brnachWiseDelete'+deleteId).remove();
    });


    $(document).on('click', '.remove-input-field-new', function () {

        // var deleteId = $(this).data('id');



        // $('#brnachWiseDelete'+deleteId).remove();

        $(this).parents('tr').remove();
    });



    </script>
