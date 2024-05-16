<?php


$renewalFileList = DB::table('renewal_files')->where('fd_one_form_id',$form_one_data->id)->latest()->get();




?>
<table class="table table-bordered">
    <tr>
        <th>নথির নাম</th>
        <th>নথি দেখুন</th>
    </tr>
    {{-- <tr>
        <td>কর্মকর্তার স্বাক্ষর ও তারিখ সহ এফডি-৮ ফরম এর ফাইনাল কপি </td>
        <td><a target="_blank" class="btn btn-sm btn-success" href="{{ route('formOnePdf',['main_id'=>$form_one_data->id,'id'=>'final_pdf_eight']) }}">
            <i class="fa fa-eye"></i>
        </a></td>
    </tr> --}}
@foreach($renewalFileList as $ngoOtherDocListsFirst)


 <!--new start -->
 @if(empty($ngoOtherDocListsFirst->list_of_board_of_directors_or_board_of_trustees))

 @else
 <?php

   $file_path = url($ngoOtherDocListsFirst->list_of_board_of_directors_or_board_of_trustees);
   $filename  = pathinfo($file_path, PATHINFO_FILENAME);


   ?>



<tr>
    <td>বোর্ড অব ডিরেক্টরস /বোর্ড অব ট্রাস্টিজ তালিকা (সংশ্লিষ্ট দেশের পিস অব জাস্টিস কতৃক নোটারীকৃত /সত্যায়িত )</td>
    <td><a target="_blank" class="btn btn-sm btn-success" href="{{ route('renewalFileDownload', ['title' =>'trustees', 'id' =>$ngoOtherDocListsFirst->id]) }}" >
        <i class="fa fa-eye"></i>
    </a></td>
</tr>


       @endif

       <!--end if -->





<!--new start -->
@if(empty($ngoOtherDocListsFirst->organization_by_laws_or_constitution))

@else
<?php

$file_path = url($ngoOtherDocListsFirst->organization_by_laws_or_constitution);
$filename  = pathinfo($file_path, PATHINFO_FILENAME);


?>


<tr>
    <td> সংস্থার বাই লজ (By laws)/গঠনতন্ত্র  (সংশ্লিষ্ট দেশের পিস অব জাস্টিস কতৃক নোটারীকৃত /সত্যায়িত )</td>
    <td><a target="_blank" class="btn btn-sm btn-success" href="{{ route('renewalFileDownload', ['title' =>'laws_or_constitution', 'id' =>$ngoOtherDocListsFirst->id]) }}" >
        <i class="fa fa-eye"></i>
    </a></td>
</tr>


@endif

<!--end if -->




<!--new start -->
@if(empty($ngoOtherDocListsFirst->work_procedure_of_organization))

@else
<?php

$file_path = url($ngoOtherDocListsFirst->work_procedure_of_organization);
$filename  = pathinfo($file_path, PATHINFO_FILENAME);


?>

<tr>
    <td> সংস্থার বোর্ড অব ডিরেক্টরস /বোর্ড অব ট্রাস্টিজ সভার কার্যবিবরণী (কার্যবিবরনীতে বোর্ড গঠন সংক্রান্ত ,নিবন্ধন নবায়ন করার প্রস্তাব,গঠনতন্ত্র পরিবর্তন সংক্রান্ত বিষয়াদি উল্লেখপূর্বক ) (সংশ্লিষ্ট দেশের পিস অব জাস্টিস কতৃক নোটারীকৃত /সত্যায়িত )</td>
    <td><a target="_blank" class="btn btn-sm btn-success" href="{{ route('renewalFileDownload', ['title' =>'work_procedure', 'id' =>$ngoOtherDocListsFirst->id]) }}" >
        <i class="fa fa-eye"></i>
    </a></td>
</tr>



@endif

<!--end if -->




<!--new start -->
@if(empty($ngoOtherDocListsFirst->last_ten_years_audit_report_and_annual_report_of_the_company))

@else
<?php

$file_path = url($ngoOtherDocListsFirst->last_ten_years_audit_report_and_annual_report_of_the_company);
$filename  = pathinfo($file_path, PATHINFO_FILENAME);


?>

<tr>
    <td>সংস্থার বিগত ১০(দশ ) বছরের অডিট রিপোর্ট  এবং বার্ষিক প্রতিবেদনের সত্যায়িত অনুলিপি </td>
    <td><a target="_blank" class="btn btn-sm btn-success" href="{{ route('renewalFileDownload', ['title' =>'last_ten_years', 'id' =>$ngoOtherDocListsFirst->id]) }}" >
        <i class="fa fa-eye"></i>
    </a></td>
</tr>


@endif

<!--end if -->



<!--new start -->
@if(empty($ngoOtherDocListsFirst->registration_certificate))

@else
<?php

$file_path = url($ngoOtherDocListsFirst->registration_certificate);
$filename  = pathinfo($file_path, PATHINFO_FILENAME);


?>


<tr>
    <td> সংস্থার মূল কার্যালয়ের নিবন্ধনপত্রের (সংশ্লিষ্ট দেশের নোটারীকৃত /সত্যায়িত ) অনুলিপি</td>
    <td><a target="_blank" class="btn btn-sm btn-success" href="{{ route('renewalFileDownload', ['title' =>'registration_certificate', 'id' =>$ngoOtherDocListsFirst->id]) }}" >
        <i class="fa fa-eye"></i>
    </a></td>
</tr>



@endif

<!--end if -->



     <!--new start -->
@if(empty($ngoOtherDocListsFirst->attested_copy_of_latest_registration_or_renewal_certificate))

@else
<?php

$file_path = url($ngoOtherDocListsFirst->attested_copy_of_latest_registration_or_renewal_certificate);
$filename  = pathinfo($file_path, PATHINFO_FILENAME);


?>


<tr>
    <td> সর্বশেষ নিবন্ধন /নবায়ন সনদপত্রের সত্যায়িত অনুলিপি</td>
    <td><a target="_blank" class="btn btn-sm btn-success" href="{{ route('renewalFileDownload', ['title' =>'registration_or_renewal_certificate', 'id' =>$ngoOtherDocListsFirst->id]) }}" >
        <i class="fa fa-eye"></i>
    </a></td>
</tr>



@endif

<!--end if -->



               <!--new start -->
@if(empty($ngoOtherDocListsFirst->right_to_information_act))

@else
<?php

$file_path = url($ngoOtherDocListsFirst->right_to_information_act);
$filename  = pathinfo($file_path, PATHINFO_FILENAME);


?>

<tr>
    <td>  Right To Information Act- ২০০৯ - এর আওতায় - Focal Point নিয়োগ করত:ব্যুরোকে অবহিতকরণ পত্রের অনুলিপি</td>
    <td><a target="_blank" class="btn btn-sm btn-success" href="{{ route('renewalFileDownload', ['title' =>'right_to_information_act', 'id' =>$ngoOtherDocListsFirst->id]) }}" >
        <i class="fa fa-eye"></i>
    </a></td>
</tr>



@endif

<!--end if -->


 @if($ngoOtherDocListsFirst->constitution_of_the_organization_has_changed == 'Yes')



 <!--new start -->
 @if(empty($ngoOtherDocListsFirst->the_constitution_of_the_company_along_with_fee_if_changed))

 @else
 <?php

   $file_path = url($ngoOtherDocListsFirst->the_constitution_of_the_company_along_with_fee_if_changed);
   $filename  = pathinfo($file_path, PATHINFO_FILENAME);


   ?>


<tr>
    <td>সংস্থার গঠনতন্ত্র পরিবর্তন হয়ে থাকলে নির্ধারিত ফি সহ তার সত্যায়িত অনুলিপি</td>
    <td><a target="_blank" class="btn btn-sm btn-success" href="{{ route('renewalFileDownload', ['title' =>'fee_if_changed', 'id' =>$ngoOtherDocListsFirst->id]) }}" >
        <i class="fa fa-eye"></i>
    </a></td>
</tr>




       @endif

       <!--end if -->



<!--new start -->
@if(empty($ngoOtherDocListsFirst->constitution_approved_by_primary_registering_authority))

@else
<?php

$file_path = url($ngoOtherDocListsFirst->constitution_approved_by_primary_registering_authority);
$filename  = pathinfo($file_path, PATHINFO_FILENAME);


?>


<tr>
    <td>প্রাথমিক নিবন্ধনকারী কতৃপক্ষের অনুমোদিতো গঠনতন্ত্রের সত্যায়িত কপি</td>
    <td><a target="_blank" class="btn btn-sm btn-success" href="{{ route('renewalFileDownload', ['title' =>'primary_registering_authority', 'id' =>$ngoOtherDocListsFirst->id]) }}" >
        <i class="fa fa-eye"></i>
    </a></td>
</tr>



@endif

<!--end if -->



<!--new start -->
@if(empty($ngoOtherDocListsFirst->clean_copy_of_the_constitution))

@else
<?php

$file_path = url($ngoOtherDocListsFirst->clean_copy_of_the_constitution);
$filename  = pathinfo($file_path, PATHINFO_FILENAME);


?>


<tr>
    <td>সংস্থার চেয়ারম্যান ও সেক্রেটারি কর্তৃক যৌথ স্বাক্ষরিত গঠনতন্ত্র পরিচ্ছন্ন কপি</td>
    <td><a target="_blank" class="btn btn-sm btn-success" href="{{ route('renewalFileDownload', ['title' =>'clean_copy_of_the_constitution', 'id' =>$ngoOtherDocListsFirst->id]) }}" >
        <i class="fa fa-eye"></i>
    </a></td>
</tr>




@endif

<!--end if -->



<!--new start -->
@if(empty($ngoOtherDocListsFirst->payment_of_change_fee))

@else
<?php

$file_path = url($ngoOtherDocListsFirst->payment_of_change_fee);
$filename  = pathinfo($file_path, PATHINFO_FILENAME);


?>


<tr>
    <td>  গঠনতন্ত্রের কোন ধারা, উপধারা পরিবর্তন ফি জমা প্রদানের চালানের মূলকপি </td>
    <td><a target="_blank" class="btn btn-sm btn-success" href="{{ route('renewalFileDownload', ['title' =>'payment_of_change_fee', 'id' =>$ngoOtherDocListsFirst->id]) }}" >
        <i class="fa fa-eye"></i>
    </a></td>
</tr>



@endif

<!--end if -->


<!--new start -->
@if(empty($ngoOtherDocListsFirst->section_sub_section_of_the_constitution))

@else
<?php

$file_path = url($ngoOtherDocListsFirst->section_sub_section_of_the_constitution);
$filename  = pathinfo($file_path, PATHINFO_FILENAME);


?>


<tr>
    <td>গঠনতন্ত্রের কোন ধারা, উপধারা পরিবর্তন ও সংযোজনের বিষয়ে সাধারণ সভার কার্যবিবরণীর সত্যায়িত কপি</td>
    <td><a target="_blank" class="btn btn-sm btn-success" href="{{ route('renewalFileDownload', ['title' =>'section_sub_section_of_the_constitution', 'id' =>$ngoOtherDocListsFirst->id]) }}" >
        <i class="fa fa-eye"></i>
    </a></td>
</tr>



@endif

<!--end if -->

<!--new start -->
@if(empty($ngoOtherDocListsFirst->previous_constitution_and_current_constitution_compare))

@else
<?php

$file_path = url($ngoOtherDocListsFirst->previous_constitution_and_current_constitution_compare);
$filename  = pathinfo($file_path, PATHINFO_FILENAME);


?>


<tr>
    <td>পূর্ব গঠনতন্ত্র ও বর্তমান গঠনতন্ত্রের তুলনামূলক বিবরণী (প্রতি পাতায় সভাপতি ও সম্পাদকের যৌথ স্বাক্ষরসহ)</td>
    <td><a target="_blank" class="btn btn-sm btn-success" href="{{ route('renewalFileDownload', ['title' =>'previous_constitution', 'id' =>$ngoOtherDocListsFirst->id]) }}" >
        <i class="fa fa-eye"></i>
    </a></td>
</tr>



@endif

<!--end if -->


 @else

<!--new start -->
@if(empty($ngoOtherDocListsFirst->constitution_of_the_organization_if_unchanged))

@else
<?php

$file_path = url($ngoOtherDocListsFirst->constitution_of_the_organization_if_unchanged);
$filename  = pathinfo($file_path, PATHINFO_FILENAME);


?>


<tr>
    <td>সংস্থার গঠনতন্ত্র পরিবর্তন না হয়ে থাকলে 'পরিবর্তন হয়নি' মর্মে  প্রত্যয়ন কপি (সংশ্লিষ্ট দেশের পিস অব জাস্টিস কতৃক নোটারীকৃত /সত্যায়িত )</td>
    <td><a target="_blank" class="btn btn-sm btn-success" href="{{ route('renewalFileDownload', ['title' =>'organization_if_unchanged', 'id' =>$ngoOtherDocListsFirst->id]) }}" >
        <i class="fa fa-eye"></i>
    </a></td>
</tr>




@endif

<!--end if -->
 @endif


@endforeach
</table>
