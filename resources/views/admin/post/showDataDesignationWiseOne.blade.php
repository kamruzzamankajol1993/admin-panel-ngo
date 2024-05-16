<?php

$adminIdList = DB::table('nothi_permissions')
   ->where('nothId',$id)->select('adminId')->get();

$convert_name_title = $adminIdList->implode("adminId", " ");
$separated_data_title = explode(" ", $convert_name_title);

$branchList = DB::table('admins')->whereIn('id',$separated_data_title)

->select('branch_id')
->groupBy('branch_id')
->get();



$convert_name_title1 = $branchList->implode("branch_id", " ");
$separated_data_title1 = explode(" ", $convert_name_title1);


$getAllbranchName = DB::table('branches')
      ->whereIn('id',$separated_data_title1)->orderBy('branch_step','asc')->get();


?>
<ul class="nav nav-dark" id="pills-darktab" role="tablist">
    <li class="nav-item"><a class="nav-link active"
                            id="pills-darkhome-tab"
                            data-bs-toggle="pill" href="#pills-darkhome"
                            role="tab" aria-controls="pills-darkhome"
                            aria-selected="true"><i
                    class="icofont icofont-ui-home"></i>নিজ অফিসের
            পদসমূহ</a></li>
</ul>
<div class="tab-content" id="pills-darktabContent">
    <div class="tab-pane fade show active" id="pills-darkhome"
         role="tabpanel" aria-labelledby="pills-darkhome-tab">
        <div class="podobi_tab mt-4">
<p id="sm"></p>
<input type="hidden" value="{{ $mainStatusNew }}" name="mainStatusNew" id="mainStatusNew"/>
<input type="hidden" value="{{ $id }}" name="main_id"  id="mainIdNew"/>
<table class="table table-bordered"  id="cleanData">
    <tr>
        <th>#</th>
        <th>কর্মকর্তা</th>
    </tr>
@foreach($getAllbranchName as $getAllbranchNames)

    <?php

$designationList = DB::table('admins')
->whereIn('id',$separated_data_title)
->where('branch_id',$getAllbranchNames->id)
->select('designation_list_id')
->get();


$convert_name_title2 = $designationList->implode("designation_list_id", " ");
$separated_data_title2 = explode(" ", $convert_name_title2);


$getAlldesignationName = DB::table('designation_lists')
->whereIn('id',$separated_data_title2)->orderBy('designation_serial','asc')->get();






    ?>




    <tr>
        <td>
            <button id="branchDelete{{ $getAllbranchNames->id }}" data-branchId="{{ $getAllbranchNames->id }}" data-nothiId = "{{ $id }}" class="btn btn-outline-success"><i
                        class="fa fa-trash"></i></button>
        </td>
        <td>
            <b>শাখাঃ {{ $getAllbranchNames->branch_name }}</b>
        </td>
    </tr>
    @foreach($getAlldesignationName as $getAlldesignationNames)

    <?php

    $mainAdmin = DB::table('admins')
->where('designation_list_id',$getAlldesignationNames->id)
->first();

                                                        ?>




    <tr>
        <td>
            @if(!$mainAdmin)
            @else
            <button id="memberDelete{{ $getAlldesignationNames->id }}" data-madminId="{{ $mainAdmin->id }}" data-nothiId = "{{ $id }}" class="btn btn-outline-success" data-bs-original-title="" title=""><i class="fa fa-trash"></i></button>
            @endif
        </td>
        <td>
            @if(!$mainAdmin)
            @else
          {{ $mainAdmin->admin_name_ban }},
            @endif

            {{ $getAlldesignationNames->designation_name }}<span style="font-size:12px; color: #aeaeae;">{{ $getAllbranchNames->branch_name }}, এনজিও বিষয়ক ব্যুরো</span>
        </td>
    </tr>
    @endforeach

    @endforeach
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

</div>
</div>
</div>

<script>
//$(document).on('click', '#finalMain', function () {

$("#finalMain").click(function(){




var mainStatusNew = $('#mainStatusNew').val();
var main_id = $('#mainIdNew').val();
var admin_id = $('input[name="admin_id[]"]').map(function (idx, ele) {
   return $(ele).val();
}).get();

//alert(admin_id);
//alert(secret_listNew +' '+mainStatusNew + main_id + admin_id);


$.ajax({
        url: "{{ route('savePermissionNothi') }}",
        method: 'GET',
        data: {mainStatusNew:mainStatusNew,main_id:main_id,admin_id:admin_id},
        success: function(data) {


            //cleanData


            window.location.href = data;




            // $("#serial_part_one"+id_for_pass).val(data);
            //  $("#sm").html('<div class="alert" style=" padding: 20px;background-color: #1b4c43 !important;color: white;"><strong>ডেটা সফলভাবে যোগ করা হয়েছে</strong></div>');
            //  $("#icon-home1").html('');
            //  $("#icon-home1").html(data);
            //  $("#cleanData").html('');


            //  $("#finalMain").remove();


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
