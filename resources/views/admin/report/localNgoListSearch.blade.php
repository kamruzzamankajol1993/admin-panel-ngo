@foreach($localNgoListReport as $allFdOneDatas)

@if($allFdOneDatas->ngo_type_new_old== 'Old')


    <?php
$mainCheckAll = DB::table('ngo_renews')
                             ->where('fd_one_form_id',$allFdOneDatas->id)
                             ->value('status');


?>


@else
<?php
$mainCheckAll = DB::table('ngo_statuses')
                             ->where('fd_one_form_id',$allFdOneDatas->id)
                             ->value('status');

?>

@endif

@if(empty($mainCheckAll))

@else
<tr>

    <td>
        @if($allFdOneDatas->ngo_type_new_old== 'Old')
        #{{ App\Http\Controllers\Admin\CommonController::englishToBangla($allFdOneDatas->registration) }}
        @else

    @if($allFdOneDatas->registration_number == 0)

        #{{ App\Http\Controllers\Admin\CommonController::englishToBangla($allFdOneDatas->registration_number_given_by_admin) }}
        @else
        #{{ App\Http\Controllers\Admin\CommonController::englishToBangla($allFdOneDatas->registration_number) }}
        @endif
@endif

    </td>




    <td><h6>
         {{ $allFdOneDatas->organization_name_ban  }}<br>

    </h6><span>ঠিকানা: {{ $allFdOneDatas->organization_address }}</td>


        <td>
            <?php


            $districtName = DB::table('districts')
            ->where('id',$allFdOneDatas->district_id)
            ->value('bn_name');
?>
            {{-- @if($allFdOneDatas->ngo_type_new_old== 'Old')
            পুরাতন
            @else

            নতুন
            @endif --}}

{{ $districtName }}
        </td>




            <td>{{ $allFdOneDatas->phone }}</td>
            <td>{{ $allFdOneDatas->email }}</td>
<td>
    {{ $allFdOneDatas->web_site_name }}
    {{-- @if($allFdOneDatas->ngo_type_new_old== 'Old')


    <?php
$ngoOldNewRenew = DB::table('ngo_renews')
                             ->where('fd_one_form_id',$allFdOneDatas->id)
                             ->value('status');


?>


@if($ngoOldNewRenew == 'Accepted')

<button class="btn btn-secondary btn-xs" type="button">
    গৃহীত

</button>
@elseif($ngoOldNewRenew == 'Ongoing')

<button class="btn btn-secondary btn-xs" type="button">
    চলমান

</button>
@else
<button class="btn btn-secondary btn-xs" type="button">
    প্রত্যাখ্যান

</button>
@endif

    @else

    <?php
$ngoOldNewStatus = DB::table('ngo_statuses')
                             ->where('fd_one_form_id',$allFdOneDatas->id)
                             ->value('status');

?>

@if($ngoOldNewStatus == 'Accepted')

<button class="btn btn-secondary btn-xs" type="button">
    গৃহীত

</button>
@elseif($ngoOldNewStatus == 'Ongoing' || empty($ngoOldNewStatus))

<button class="btn btn-secondary btn-xs" type="button">
    চলমান

</button>
@elseif($ngoOldNewStatus == 'Rejected')
<button class="btn btn-secondary btn-xs" type="button">
    প্রত্যাখ্যান

</button>
@endif
    @endif --}}

</td>
</tr>
@endif
@endforeach
