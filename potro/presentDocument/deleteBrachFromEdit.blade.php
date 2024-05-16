
<?php

$adminIdList = DB::table('nothi_permissions')
   ->where('nothId',$nothiId)->select('adminId')->get();


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
<table class="table table-bordered">



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
            <button id="branchDelete{{ $getAllbranchNames->id }}" data-branchId="{{ $getAllbranchNames->id }}" data-nothiId = "{{ $nothiId }}" class="btn btn-outline-success"><i
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
            <button id="memberDelete{{ $getAlldesignationNames->id }}" data-madminId="{{ $mainAdmin->id }}" data-nothiId = "{{ $nothiId }}" class="btn btn-outline-success" data-bs-original-title="" title=""><i class="fa fa-trash"></i></button>
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

</table>
