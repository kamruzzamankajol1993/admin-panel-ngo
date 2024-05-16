@foreach($allFdOneData as $allFdOneDatas)
<?php
$ngoOldNew = DB::table('ngo_type_and_languages')
                             ->where('user_id',$allFdOneDatas->user_id)
                             ->value('ngo_type_new_old');

                             $getngoForLanguageNewO = DB::table('ngo_type_and_languages')
                             ->where('user_id',$allFdOneDatas->user_id)->value('registration');

?>
@if($ngoOldNew == 'Old')


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
        @if($ngoOldNew == 'Old')
        #{{ App\Http\Controllers\Admin\CommonController::englishToBangla($getngoForLanguageNewO) }}
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


{{ $districtName }}
        </td>


     
            <td>{{ $allFdOneDatas->phone }}</td>
            <td>{{ $allFdOneDatas->email }}</td>
            <td>
                {{ $allFdOneDatas->web_site_name }}

</td>
</tr>
@endif
@endforeach
