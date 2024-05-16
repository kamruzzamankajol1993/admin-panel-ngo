<?php

                       $getNgoType = DB::table('ngo_type_and_languages')->where('user_id',$form_one_data->user_id)->value('ngo_type');

                       $ngoTypeData = DB::table('ngo_type_and_languages')->where('user_id',$form_one_data->user_id)->first();
                        ?>

<div class="mb-0 m-t-30">
    <table class="table table-bordered">




        <tr>
            <th>নথির নাম</th>
            <th>নথি দেখুন</th>
        </tr>
        {{-- <tr>
            <td>প্রধান নির্বাহীর স্বাক্ষরকৃত এফডি - ৮ ফরম </td>
            <td><a target="_blank"  href="{{ route('verifiedFdEightDownload',base64_encode($renewInfoData->id)) }}" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a></td>
        </tr> --}}

 <tr>
           <td>পূরণকৃত এফডি - ৮ ফরম</td>
           <td>


            <a target="_blank" class="btn btn-sm btn-success" href="{{ route('viewFormEightPdf', ['id' =>$renewInfoData->id]) }}" >
               <i class="fa fa-eye"></i>
           </a>


           @if(Route::is('addChildNote') || Route::is('viewChildNote'))

                <button  href="{{ route('viewFormEightPdf', ['id' =>$renewInfoData->id]) }}" class="btn btn-secondary" id="attLink1"  data-name="পূরণকৃত এফডি - ৮ ফরম"><i class="fa fa-paperclip"></i></button>
                <button  href="{{ route('viewFormEightPdf', ['id' =>$renewInfoData->id]) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
                @else

                @endif



        </td>
       </tr>
        <?php


$renewalFileList = DB::table('renewal_files')->where('fd_one_form_id',$form_one_data->id)->latest()->get();




?>



        @if($getNgoType == 'Foreign')

        @foreach($renewalFileList as $ngoOtherDocListsFirst)



        <!--new start -->
        @if(empty($ngoOtherDocListsFirst->final_fd_eight_form))



        @else
        <?php

          $file_path = url($ngoOtherDocListsFirst->final_fd_eight_form);
          $filename  = pathinfo($file_path, PATHINFO_FILENAME);


          ?>



       <tr>
           <td>পূরণকৃত এফডি - ৮ ফরম</td>
           <td>


            <a target="_blank" class="btn btn-sm btn-success" href="{{ route('renewalFileDownload', ['title' =>'final_fd_eight_form', 'id' =>$ngoOtherDocListsFirst->id]) }}" >
               <i class="fa fa-eye"></i>
           </a>


           @if(Route::is('addChildNote') || Route::is('viewChildNote'))

                <button  href="{{ route('renewalFileDownload', ['title' =>'final_fd_eight_form', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-secondary" id="attLink1"  data-name="পূরণকৃত এফডি - ৮ ফরম"><i class="fa fa-paperclip"></i></button>
                <button  href="{{ route('renewalFileDownload', ['title' =>'final_fd_eight_form', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
                @else

                @endif



        </td>
       </tr>


              @endif

              <!--end if -->


        <!--new start -->
        @if(empty($ngoOtherDocListsFirst->list_of_board_of_directors_or_board_of_trustees))

        @else
        <?php

          $file_path = url($ngoOtherDocListsFirst->list_of_board_of_directors_or_board_of_trustees);
          $filename  = pathinfo($file_path, PATHINFO_FILENAME);


          ?>



       <tr>
           <td>বোর্ড অব ডিরেক্টরস /বোর্ড অব ট্রাস্টিজ তালিকা (সংশ্লিষ্ট দেশের পিস অব জাস্টিস কতৃক নোটারীকৃত /সত্যায়িত )</td>
           <td>

            <a target="_blank" class="btn btn-sm btn-success" href="{{ route('renewalFileDownload', ['title' =>'trustees', 'id' =>$ngoOtherDocListsFirst->id]) }}" >
               <i class="fa fa-eye"></i>
           </a>

           @if(Route::is('addChildNote') || Route::is('viewChildNote'))

           <button  href="{{ route('renewalFileDownload', ['title' =>'trustees', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-secondary" id="attLink1"  data-name="বোর্ড অব ডিরেক্টরস /বোর্ড অব ট্রাস্টিজ তালিকা (সংশ্লিষ্ট দেশের পিস অব জাস্টিস কতৃক নোটারীকৃত /সত্যায়িত )"><i class="fa fa-paperclip"></i></button>
           <button  href="{{ route('renewalFileDownload', ['title' =>'trustees', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
           @else

           @endif


        </td>
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
           <td>

            <a target="_blank" class="btn btn-sm btn-success" href="{{ route('renewalFileDownload', ['title' =>'laws_or_constitution', 'id' =>$ngoOtherDocListsFirst->id]) }}" >
               <i class="fa fa-eye"></i>
           </a>


           @if(Route::is('addChildNote') || Route::is('viewChildNote'))

           <button  href="{{ route('renewalFileDownload', ['title' =>'laws_or_constitution', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-secondary" id="attLink1"  data-name="সংস্থার বাই লজ (By laws)/গঠনতন্ত্র  (সংশ্লিষ্ট দেশের পিস অব জাস্টিস কতৃক নোটারীকৃত /সত্যায়িত )"><i class="fa fa-paperclip"></i></button>
           <button  href="{{ route('renewalFileDownload', ['title' =>'laws_or_constitution', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
           @else

           @endif


        </td>
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
           <td>

            <a target="_blank" class="btn btn-sm btn-success" href="{{ route('renewalFileDownload', ['title' =>'work_procedure', 'id' =>$ngoOtherDocListsFirst->id]) }}" >
               <i class="fa fa-eye"></i>
           </a>
           @if(Route::is('addChildNote') || Route::is('viewChildNote'))

           <button  href="{{ route('renewalFileDownload', ['title' =>'work_procedure', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-secondary" id="attLink1"  data-name="সংস্থার বোর্ড অব ডিরেক্টরস /বোর্ড অব ট্রাস্টিজ সভার কার্যবিবরণী"><i class="fa fa-paperclip"></i></button>
           <button  href="{{ route('renewalFileDownload', ['title' =>'work_procedure', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
           @else

           @endif

        </td>
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
           <td>সংস্থার বিগত ১০(দশ ) বছরের অডিট রিপোর্টের সত্যায়িত অনুলিপি </td>
           <td>

            <a target="_blank" class="btn btn-sm btn-success" href="{{ route('renewalFileDownload', ['title' =>'last_ten_years', 'id' =>$ngoOtherDocListsFirst->id]) }}" >
               <i class="fa fa-eye"></i>
           </a>


           @if(Route::is('addChildNote') || Route::is('viewChildNote'))

           <button  href="{{ route('renewalFileDownload', ['title' =>'last_ten_years', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-secondary" id="attLink1"  data-name="সংস্থার বিগত ১০(দশ ) বছরের অডিট রিপোর্টের সত্যায়িত অনুলিপি"><i class="fa fa-paperclip"></i></button>
           <button  href="{{ route('renewalFileDownload', ['title' =>'last_ten_years', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
           @else

           @endif


        </td>
       </tr>


       @endif

       <!--end if -->

       <!--new start -->
       @if(empty($ngoOtherDocListsFirst->last_ten_year_annual_report))

       @else
       <?php

       $file_path = url($ngoOtherDocListsFirst->last_ten_year_annual_report);
       $filename  = pathinfo($file_path, PATHINFO_FILENAME);


       ?>

       <tr>
           <td>সংস্থার বিগত ১০(দশ ) বছরের বার্ষিক প্রতিবেদনের সত্যায়িত অনুলিপি </td>
           <td>

            <a target="_blank" class="btn btn-sm btn-success" href="{{ route('renewalFileDownload', ['title' =>'last_ten_year_annual_report', 'id' =>$ngoOtherDocListsFirst->id]) }}" >
               <i class="fa fa-eye"></i>
           </a>


           @if(Route::is('addChildNote') || Route::is('viewChildNote'))

           <button  href="{{ route('renewalFileDownload', ['title' =>'last_ten_year_annual_report', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-secondary" id="attLink1"  data-name="সংস্থার বিগত ১০(দশ ) বছরের বার্ষিক প্রতিবেদনের সত্যায়িত অনুলিপি"><i class="fa fa-paperclip"></i></button>
           <button  href="{{ route('renewalFileDownload', ['title' =>'last_ten_year_annual_report', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
           @else

           @endif


        </td>
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
           <td>
            <a target="_blank" class="btn btn-sm btn-success" href="{{ route('renewalFileDownload', ['title' =>'registration_certificate', 'id' =>$ngoOtherDocListsFirst->id]) }}" >
               <i class="fa fa-eye"></i>
           </a>


           @if(Route::is('addChildNote') || Route::is('viewChildNote'))

           <button  href="{{ route('renewalFileDownload', ['title' =>'registration_certificate', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-secondary" id="attLink1"  data-name="সংস্থার মূল কার্যালয়ের নিবন্ধনপত্রের (সংশ্লিষ্ট দেশের নোটারীকৃত /সত্যায়িত ) অনুলিপি"><i class="fa fa-paperclip"></i></button>
           <button  href="{{ route('renewalFileDownload', ['title' =>'registration_certificate', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
           @else

           @endif


        </td>
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
    <td>সর্বশেষ নিবন্ধন /নবায়ন  সনদপত্রের  সত্যায়িত অনুলিপি</td>
    <td>

     <a target="_blank" class="btn btn-sm btn-success" href="{{ route('renewalFileDownload', ['title' =>'attested_copy_of_latest_registration_or_renewal_certificate', 'id' =>$ngoOtherDocListsFirst->id]) }}" >
        <i class="fa fa-eye"></i>
    </a>


    @if(Route::is('addChildNote') || Route::is('viewChildNote'))

    <button  href="{{ route('renewalFileDownload', ['title' =>'attested_copy_of_latest_registration_or_renewal_certificate', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-secondary" id="attLink1"  data-name="সর্বশেষ নিবন্ধন /নবায়ন  সনদপত্রের  সত্যায়িত অনুলিপি"><i class="fa fa-paperclip"></i></button>
    <button  href="{{ route('renewalFileDownload', ['title' =>'attested_copy_of_latest_registration_or_renewal_certificate', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
    @else

    @endif


 </td>
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
    <td>Right to Information Act-২০০৯-এর আওতায় Focal Point নিয়োগ করত : ব্যুরোকে অবহিতকরণ পত্রের অনুলিপি</td>
    <td>

     <a target="_blank" class="btn btn-sm btn-success" href="{{ route('renewalFileDownload', ['title' =>'right_to_information_act', 'id' =>$ngoOtherDocListsFirst->id]) }}" >
        <i class="fa fa-eye"></i>
    </a>


    @if(Route::is('addChildNote') || Route::is('viewChildNote'))

    <button  href="{{ route('renewalFileDownload', ['title' =>'right_to_information_act', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-secondary" id="attLink1"  data-name="সর্বশেষ নিবন্ধন /নবায়ন  সনদপত্রের  সত্যায়িত অনুলিপি"><i class="fa fa-paperclip"></i></button>
    <button  href="{{ route('renewalFileDownload', ['title' =>'right_to_information_act', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
    @else

    @endif


 </td>
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
           <td>

            <a target="_blank" class="btn btn-sm btn-success" href="{{ route('renewalFileDownload', ['title' =>'fee_if_changed', 'id' =>$ngoOtherDocListsFirst->id]) }}" >
               <i class="fa fa-eye"></i>
           </a>
           @if(Route::is('addChildNote') || Route::is('viewChildNote'))

           <button  href="{{ route('renewalFileDownload', ['title' =>'fee_if_changed', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-secondary" id="attLink1"  data-name="সংস্থার গঠনতন্ত্র পরিবর্তন হয়ে থাকলে নির্ধারিত ফি সহ তার সত্যায়িত অনুলিপি"><i class="fa fa-paperclip"></i></button>
           <button  href="{{ route('renewalFileDownload', ['title' =>'fee_if_changed', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
           @else

           @endif

        </td>
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
           <td>

            <a target="_blank" class="btn btn-sm btn-success" href="{{ route('renewalFileDownload', ['title' =>'primary_registering_authority', 'id' =>$ngoOtherDocListsFirst->id]) }}" >
               <i class="fa fa-eye"></i>
           </a>


           @if(Route::is('addChildNote') || Route::is('viewChildNote'))

           <button  href="{{ route('renewalFileDownload', ['title' =>'primary_registering_authority', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-secondary" id="attLink1"  data-name="প্রাথমিক নিবন্ধনকারী কতৃপক্ষের অনুমোদিতো গঠনতন্ত্রের সত্যায়িত কপি"><i class="fa fa-paperclip"></i></button>
           <button  href="{{ route('renewalFileDownload', ['title' =>'primary_registering_authority', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
           @else

           @endif



        </td>
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
           <td>

            <a target="_blank" class="btn btn-sm btn-success" href="{{ route('renewalFileDownload', ['title' =>'clean_copy_of_the_constitution', 'id' =>$ngoOtherDocListsFirst->id]) }}" >
               <i class="fa fa-eye"></i>
           </a>


           @if(Route::is('addChildNote') || Route::is('viewChildNote'))

           <button  href="{{ route('renewalFileDownload', ['title' =>'clean_copy_of_the_constitution', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-secondary" id="attLink1"  data-name="সংস্থার চেয়ারম্যান ও সেক্রেটারি কর্তৃক যৌথ স্বাক্ষরিত গঠনতন্ত্র পরিচ্ছন্ন কপি"><i class="fa fa-paperclip"></i></button>
           <button  href="{{ route('renewalFileDownload', ['title' =>'clean_copy_of_the_constitution', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
           @else

           @endif


        </td>
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
           <td>

            <a target="_blank" class="btn btn-sm btn-success" href="{{ route('renewalFileDownload', ['title' =>'payment_of_change_fee', 'id' =>$ngoOtherDocListsFirst->id]) }}" >
               <i class="fa fa-eye"></i>
           </a>
           @if(Route::is('addChildNote') || Route::is('viewChildNote'))

           <button  href="{{ route('renewalFileDownload', ['title' =>'payment_of_change_fee', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-secondary" id="attLink1"  data-name="গঠনতন্ত্রের কোন ধারা, উপধারা পরিবর্তন ফি জমা প্রদানের চালানের মূলকপি"><i class="fa fa-paperclip"></i></button>
           <button  href="{{ route('renewalFileDownload', ['title' =>'payment_of_change_fee', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
           @else

           @endif

        </td>
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
           <td>

            <a target="_blank" class="btn btn-sm btn-success" href="{{ route('renewalFileDownload', ['title' =>'section_sub_section_of_the_constitution', 'id' =>$ngoOtherDocListsFirst->id]) }}" >
               <i class="fa fa-eye"></i>
           </a>
           @if(Route::is('addChildNote') || Route::is('viewChildNote'))

           <button  href="{{ route('renewalFileDownload', ['title' =>'section_sub_section_of_the_constitution', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-secondary" id="attLink1"  data-name="গঠনতন্ত্রের কোন ধারা, উপধারা পরিবর্তন ও সংযোজনের বিষয়ে সাধারণ সভার কার্যবিবরণীর সত্যায়িত কপি"><i class="fa fa-paperclip"></i></button>
           <button  href="{{ route('renewalFileDownload', ['title' =>'section_sub_section_of_the_constitution', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
           @else

           @endif

        </td>
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
           <td>

            <a target="_blank" class="btn btn-sm btn-success" href="{{ route('renewalFileDownload', ['title' =>'previous_constitution', 'id' =>$ngoOtherDocListsFirst->id]) }}" >
               <i class="fa fa-eye"></i>
           </a>


           @if(Route::is('addChildNote') || Route::is('viewChildNote'))

           <button  href="{{ route('renewalFileDownload', ['title' =>'previous_constitution', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-secondary" id="attLink1"  data-name="পূর্ব গঠনতন্ত্র ও বর্তমান গঠনতন্ত্রের তুলনামূলক বিবরণী (প্রতি পাতায় সভাপতি ও সম্পাদকের যৌথ স্বাক্ষরসহ)"><i class="fa fa-paperclip"></i></button>
           <button  href="{{ route('renewalFileDownload', ['title' =>'previous_constitution', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
           @else

           @endif

        </td>
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
           <td>সংস্থার গঠনতন্ত্র পরিবর্তন হয়নি মর্মে সভাপতি  এবং সাধারণ সম্পাদকের যৌথ স্বাক্ষরে প্রত্যয়নপত্র </td>
           <td>

            <a target="_blank" class="btn btn-sm btn-success" href="{{ route('renewalFileDownload', ['title' =>'organization_if_unchanged', 'id' =>$ngoOtherDocListsFirst->id]) }}" >
               <i class="fa fa-eye"></i>
           </a>
           @if(Route::is('addChildNote') || Route::is('viewChildNote'))

           <button  href="{{ route('renewalFileDownload', ['title' =>'organization_if_unchanged', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-secondary" id="attLink1"  data-name="সংস্থার গঠনতন্ত্র পরিবর্তন হয়নি মর্মে সভাপতি  এবং সাধারণ সম্পাদকের যৌথ স্বাক্ষরে প্রত্যয়নপত্র "><i class="fa fa-paperclip"></i></button>
           <button  href="{{ route('renewalFileDownload', ['title' =>'organization_if_unchanged', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
           @else

           @endif

        </td>
       </tr>




       @endif

       <!--end if -->
        @endif


       @endforeach

        @else



        @foreach($renewalFileList as $ngoOtherDocListsFirst)
		<!--new start -->
@if(empty($ngoOtherDocListsFirst->form_eight_executive_committee_member))

@else
<?php

$file_path = url($ngoOtherDocListsFirst->form_eight_executive_committee_member);
$filename  = pathinfo($file_path, PATHINFO_FILENAME);


?>



<tr>
<td>ফরম-৮ মোতাবেক কার্যনির্বাহী কমিটির সদস্যদের তালিকা</td>
<td>

    <a target="_blank" class="btn btn-sm btn-success" href="{{ route('renewalFileDownload', ['title' =>'form_eight_executive_committee_member', 'id' =>$ngoOtherDocListsFirst->id]) }}" >
<i class="fa fa-eye"></i>
</a>

@if(Route::is('addChildNote') || Route::is('viewChildNote'))

<button  href="{{ route('renewalFileDownload', ['title' =>'form_eight_executive_committee_member', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-secondary" id="attLink1"  data-name="ফরম-৮ মোতাবেক কার্যনির্বাহী কমিটির সদস্যদের তালিকা"><i class="fa fa-paperclip"></i></button>
<button  href="{{ route('renewalFileDownload', ['title' =>'form_eight_executive_committee_member', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
@else

@endif


</td>
</tr>


@endif

<!--end if -->


<!--new start -->
@if(empty($ngoOtherDocListsFirst->nid_and_image_of_executive_committee_members))

@else
<?php

$file_path = url($ngoOtherDocListsFirst->nid_and_image_of_executive_committee_members);
$filename  = pathinfo($file_path, PATHINFO_FILENAME);


?>



<tr>
<td> নির্বাহী কমিটির সদস্যদের পাসপোর্ট সাইজের ছবিসহ জাতীয় পরিচয়পত্রে সত্যায়িত অনুলিপি</td>
<td>

    <a target="_blank" class="btn btn-sm btn-success" href="{{ route('renewalFileDownload', ['title' =>'nid_and_image_of_executive_committee_members', 'id' =>$ngoOtherDocListsFirst->id]) }}" >
<i class="fa fa-eye"></i>
</a>

@if(Route::is('addChildNote') || Route::is('viewChildNote'))

<button  href="{{ route('renewalFileDownload', ['title' =>'nid_and_image_of_executive_committee_members', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-secondary" id="attLink1"  data-name="নির্বাহী কমিটির সদস্যদের পাসপোর্ট সাইজের ছবিসহ জাতীয় পরিচয়পত্রে সত্যায়িত অনুলিপি"><i class="fa fa-paperclip"></i></button>
<button  href="{{ route('renewalFileDownload', ['title' =>'nid_and_image_of_executive_committee_members', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
@else

@endif


</td>
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
<td>প্রাথমিক নিবন্ধনকারী কতৃপক্ষের অনুমোদিত গঠনতন্ত্রের সত্যায়িত অনুলিপি</td>
<td>

    <a target="_blank" class="btn btn-sm btn-success" href="{{ route('renewalFileDownload', ['title' =>'work_procedure', 'id' =>$ngoOtherDocListsFirst->id]) }}" >
<i class="fa fa-eye"></i>
</a>


@if(Route::is('addChildNote') || Route::is('viewChildNote'))

<button  href="{{ route('renewalFileDownload', ['title' =>'work_procedure', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-secondary" id="attLink1"  data-name="প্রাথমিক নিবন্ধনকারী কতৃপক্ষের অনুমোদিত গঠনতন্ত্রের সত্যায়িত অনুলিপি"><i class="fa fa-paperclip"></i></button>
<button  href="{{ route('renewalFileDownload', ['title' =>'work_procedure', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
@else

@endif


</td>
</tr>



@endif

<!--end if -->
<!--new start -->
@if(empty($ngoOtherDocListsFirst->registration_renewal_fee))

@else
<?php

$file_path = url($ngoOtherDocListsFirst->registration_renewal_fee);
$filename  = pathinfo($file_path, PATHINFO_FILENAME);


?>



<tr>
<td>নিবন্ধন নবায়ন ফি জমাদানের চালানের মূলকপিসহ সত্যায়িত অনুলিপি</td>
<td>

    <a target="_blank" class="btn btn-sm btn-success" href="{{ route('renewalFileDownload', ['title' =>'registration_renewal_fee', 'id' =>$ngoOtherDocListsFirst->id]) }}" >
<i class="fa fa-eye"></i>
</a>

@if(Route::is('addChildNote') || Route::is('viewChildNote'))

<button  href="{{ route('renewalFileDownload', ['title' =>'registration_renewal_fee', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-secondary" id="attLink1"  data-name="নিবন্ধন নবায়ন ফি জমাদানের চালানের মূলকপিসহ সত্যায়িত অনুলিপি"><i class="fa fa-paperclip"></i></button>
<button  href="{{ route('renewalFileDownload', ['title' =>'registration_renewal_fee', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
@else

@endif

</td>
</tr>


@endif

<!--end if -->
<!--new start -->
@if(empty($ngoOtherDocListsFirst->approval_of_executive_committee))

@else
<?php

$file_path = url($ngoOtherDocListsFirst->approval_of_executive_committee);
$filename  = pathinfo($file_path, PATHINFO_FILENAME);


?>



<tr>
<td>  উপস্থিত সাধারণ সদস্যদের উপস্থিতির স্বাক্ষরিত তালিকাসহ নির্বাহী কমিটি অনুমোদন সংক্রান্ত সাধারণ সভার কার্যবিবরণীর সত্যায়িত অনুলিপি</td>
<td>

    <a target="_blank" class="btn btn-sm btn-success" href="{{ route('renewalFileDownload', ['title' =>'approval_of_executive_committee', 'id' =>$ngoOtherDocListsFirst->id]) }}" >
<i class="fa fa-eye"></i>
</a>

@if(Route::is('addChildNote') || Route::is('viewChildNote'))

<button  href="{{ route('renewalFileDownload', ['title' =>'approval_of_executive_committee', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-secondary" id="attLink1"  data-name="উপস্থিত সাধারণ সদস্যদের উপস্থিতির স্বাক্ষরিত তালিকাসহ নির্বাহী কমিটি অনুমোদন সংক্রান্ত সাধারণ সভার কার্যবিবরণীর সত্যায়িত অনুলিপি"><i class="fa fa-paperclip"></i></button>
<button  href="{{ route('renewalFileDownload', ['title' =>'approval_of_executive_committee', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
@else

@endif


</td>
</tr>


@endif

<!--end if -->
<!--new start -->
@if(empty($ngoOtherDocListsFirst->constitution_of_the_organization_if_unchanged))

@else
<?php

$file_path = url($ngoOtherDocListsFirst->constitution_of_the_organization_if_unchanged);
$filename  = pathinfo($file_path, PATHINFO_FILENAME);


?>


<tr>
<td>সংস্থার গঠনতন্ত্র পরিবর্তন হয়নি মর্মে সভাপতি  এবং সাধারণ সম্পাদকের যৌথ স্বাক্ষরে প্রত্যয়নপত্র </td>
<td>

    <a target="_blank" class="btn btn-sm btn-success" href="{{ route('renewalFileDownload', ['title' =>'organization_if_unchanged', 'id' =>$ngoOtherDocListsFirst->id]) }}" >
<i class="fa fa-eye"></i>
</a>

@if(Route::is('addChildNote') || Route::is('viewChildNote'))

<button  href="{{ route('renewalFileDownload', ['title' =>'organization_if_unchanged', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-secondary" id="attLink1"  data-name="সংস্থার গঠনতন্ত্র পরিবর্তন হয়নি মর্মে সভাপতি  এবং সাধারণ সম্পাদকের যৌথ স্বাক্ষরে প্রত্যয়নপত্র "><i class="fa fa-paperclip"></i></button>
<button  href="{{ route('renewalFileDownload', ['title' =>'organization_if_unchanged', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
@else

@endif

</td>
</tr>




@endif

<!--end if -->
<!--new start -->
@if(empty($ngoOtherDocListsFirst->constitution_extra))

@else
<?php

$file_path = url($ngoOtherDocListsFirst->constitution_extra);
$filename  = pathinfo($file_path, PATHINFO_FILENAME);


?>


<tr>
<td>সংস্থার গঠনতন্ত্র পরিবর্তন হয়ে থাকলে নির্ধারিত ফি সহ  ভ্যাট বাবদ অর্থ জমাদানের মূলকপিসহ তার সত্যায়িত অনুলিপি অথবা সংস্থার গঠনতন্ত্র পরিবর্তন না হয়ে থাকলে 'পরিবর্তন হয়নি' মর্মে প্রত্যয়নের অনুলিপি</td>
<td>

    <a target="_blank" class="btn btn-sm btn-success" href="{{ route('renewalFileDownload', ['title' =>'constitution_extra', 'id' =>$ngoOtherDocListsFirst->id]) }}" >
<i class="fa fa-eye"></i>
</a>

@if(Route::is('addChildNote') || Route::is('viewChildNote'))

<button  href="{{ route('renewalFileDownload', ['title' =>'constitution_extra', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-secondary" id="attLink1"  data-name="সংস্থার গঠনতন্ত্র পরিবর্তন হয়ে থাকলে নির্ধারিত ফি সহ  ভ্যাট বাবদ অর্থ জমাদানের মূলকপিসহ তার সত্যায়িত অনুলিপি অথবা সংস্থার গঠনতন্ত্র পরিবর্তন না হয়ে থাকলে 'পরিবর্তন হয়নি' মর্মে প্রত্যয়নের অনুলিপি"><i class="fa fa-paperclip"></i></button>
<button  href="{{ route('renewalFileDownload', ['title' =>'constitution_extra', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
@else

@endif

</td>
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
<td>সংস্থার বিগত ১০(দশ) বছরের অডিট রিপোর্টের সত্যায়িত অনুলিপি </td>
<td>
    <a target="_blank" class="btn btn-sm btn-success" href="{{ route('renewalFileDownload', ['title' =>'last_ten_years', 'id' =>$ngoOtherDocListsFirst->id]) }}" >
<i class="fa fa-eye"></i>
</a>
@if(Route::is('addChildNote') || Route::is('viewChildNote'))

<button  href="{{ route('renewalFileDownload', ['title' =>'last_ten_years', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-secondary" id="attLink1"  data-name="সংস্থার বিগত ১০(দশ ) বছরের অডিট রিপোর্ট  এবং বার্ষিক প্রতিবেদনের সত্যায়িত অনুলিপি"><i class="fa fa-paperclip"></i></button>
<button  href="{{ route('renewalFileDownload', ['title' =>'last_ten_years', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
@else

@endif

</td>
</tr>


@endif

<!--new start -->
@if(empty($ngoOtherDocListsFirst->last_ten_year_annual_report))

@else
<?php

$file_path = url($ngoOtherDocListsFirst->last_ten_year_annual_report);
$filename  = pathinfo($file_path, PATHINFO_FILENAME);


?>

<tr>
<td>সংস্থার বিগত ১০(দশ) বছরের বার্ষিক প্রতিবেদনের সত্যায়িত অনুলিপি</td>
<td>
    <a target="_blank" class="btn btn-sm btn-success" href="{{ route('renewalFileDownload', ['title' =>'last_ten_year_annual_report', 'id' =>$ngoOtherDocListsFirst->id]) }}" >
<i class="fa fa-eye"></i>
</a>
@if(Route::is('addChildNote') || Route::is('viewChildNote'))

<button  href="{{ route('renewalFileDownload', ['title' =>'last_ten_year_annual_report', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-secondary" id="attLink1"  data-name="সংস্থার বিগত ১০(দশ ) বছরের অডিট রিপোর্ট  এবং বার্ষিক প্রতিবেদনের সত্যায়িত অনুলিপি"><i class="fa fa-paperclip"></i></button>
<button  href="{{ route('renewalFileDownload', ['title' =>'last_ten_year_annual_report', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
@else

@endif

</td>
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
<td> অন্য কোনো আইনে নিবন্ধিত হলে সংশিষ্ট কতৃপক্ষের অনুমোদিত নির্বাহী কমিটির তালিকার সত্যায়িত অনুলিপি</td>
<td>
    <a target="_blank" class="btn btn-sm btn-success" href="{{ route('renewalFileDownload', ['title' =>'laws_or_constitution', 'id' =>$ngoOtherDocListsFirst->id]) }}" >
<i class="fa fa-eye"></i>
</a>
@if(Route::is('addChildNote') || Route::is('viewChildNote'))

<button  href="{{ route('renewalFileDownload', ['title' =>'laws_or_constitution', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-secondary" id="attLink1"  data-name="অন্য কোনো আইনে নিবন্ধিত হলে সংশিষ্ট কতৃপক্ষের অনুমোদিত নির্বাহী কমিটির তালিকার সত্যায়িত অনুলিপি"><i class="fa fa-paperclip"></i></button>
<button  href="{{ route('renewalFileDownload', ['title' =>'laws_or_constitution', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
@else

@endif


</td>
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
        <td>

         <a target="_blank" class="btn btn-sm btn-success" href="{{ route('renewalFileDownload', ['title' =>'registration_or_renewal_certificate', 'id' =>$ngoOtherDocListsFirst->id]) }}" >
            <i class="fa fa-eye"></i>
        </a>
        @if(Route::is('addChildNote') || Route::is('viewChildNote'))

        <button  href="{{ route('renewalFileDownload', ['title' =>'registration_or_renewal_certificate', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-secondary" id="attLink1"  data-name="সর্বশেষ নিবন্ধন /নবায়ন সনদপত্রের সত্যায়িত অনুলিপি"><i class="fa fa-paperclip"></i></button>
        <button  href="{{ route('renewalFileDownload', ['title' =>'registration_or_renewal_certificate', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
        @else

        @endif

     </td>
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
        <td>
         <a target="_blank" class="btn btn-sm btn-success" href="{{ route('renewalFileDownload', ['title' =>'right_to_information_act', 'id' =>$ngoOtherDocListsFirst->id]) }}" >
            <i class="fa fa-eye"></i>
        </a>
        @if(Route::is('addChildNote') || Route::is('viewChildNote'))

        <button  href="{{ route('renewalFileDownload', ['title' =>'right_to_information_act', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-secondary" id="attLink1"  data-name="Right To Information Act- ২০০৯ - এর আওতায় - Focal Point নিয়োগ করত:ব্যুরোকে অবহিতকরণ পত্রের অনুলিপি"><i class="fa fa-paperclip"></i></button>
        <button  href="{{ route('renewalFileDownload', ['title' =>'right_to_information_act', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
        @else

        @endif


     </td>
    </tr>



    @endif

    <!--end if -->
	<tr>

            <td>তফসিল -১ এ বর্ণিত যেকোন ফি এর ভ্যাট বকেয়া থাকলে পরিশোধ হয়েছে কিনা (চালানের কপি সংযুক্ত করতে হবে)
            </td>
            <td>@if(!$renewInfoData)


                @else
                @if(empty($renewInfoData->due_vat_pdf))

                @else
                <a target="_blank"  href="{{ route('dueVatPdfDownload',base64_encode($renewInfoData->id)) }}" class="btn btn-sm btn-success"><i class="fa fa-eye"></i> </a>




                @if(Route::is('addChildNote') || Route::is('viewChildNote'))

                <button  href="{{ route('dueVatPdfDownload',base64_encode($renewInfoData->id)) }}" class="btn btn-secondary" id="attLink1" data-name="তফসিল -১ এ বর্ণিত যেকোন ফি এর ভ্যাট বকেয়া থাকলে পরিশোধ চালানের কপি"><i class="fa fa-paperclip"></i></button>
                <button  href="{{ route('dueVatPdfDownload',base64_encode($renewInfoData->id)) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i> </button>
                @else

                @endif


                @endif
@endif</td>
        </tr>
<!--new start -->
@if(empty($ngoOtherDocListsFirst->committee_members_list))

@else
<?php

$file_path = url($ngoOtherDocListsFirst->committee_members_list);
$filename  = pathinfo($file_path, PATHINFO_FILENAME);


?>



<tr>
<td>নিবন্ধনকালীন দাখিলকৃত সাধারণ ও নির্বাহী কমিটির তালিকা এবং বর্তমান সাধারণ সদস্য ও নির্বাহী কমিটির তালিকা</td>
<td>

    <a target="_blank" class="btn btn-sm btn-success" href="{{ route('renewalFileDownload', ['title' =>'committee_members_list', 'id' =>$ngoOtherDocListsFirst->id]) }}" >
<i class="fa fa-eye"></i>
</a>
@if(Route::is('addChildNote') || Route::is('viewChildNote'))

<button  href="{{ route('renewalFileDownload', ['title' =>'committee_members_list', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-secondary" id="attLink1"  data-name="নিবন্ধনকালীন দাখিলকৃত সাধারণ ও নির্বাহী কমিটির তালিকা এবং বর্তমান সাধারণ সদস্য ও নির্বাহী কমিটির তালিকা"><i class="fa fa-paperclip"></i></button>
<button  href="{{ route('renewalFileDownload', ['title' =>'committee_members_list', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
@else

@endif

</td>
</tr>
 <tr>

            <td>বিগত ১০(দশ) বছরে বৈদেশিক অনুদানে পরিচালত কার্যক্রমের সংক্ষিপ্ত  বিবরণ (সংযুক্ত ছক অনুযায়ী )
            </td>
            <td>

                @if(!$renewInfoData)


                @else
                @if(empty($renewInfoData->foregin_pdf))

                @else
                <a target="_blank"  href="{{ route('foreginPdfDownload',base64_encode($renewInfoData->id)) }}" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>

                @if(Route::is('addChildNote') || Route::is('viewChildNote'))

                <button  href="{{ route('foreginPdfDownload',base64_encode($renewInfoData->id)) }}" class="btn btn-secondary" id="attLink1" data-name="বিগত ১০(দশ) বছরে বৈদেশিক অনুদানে পরিচালত কার্যক্রমের সংক্ষিপ্ত  বিবরণ (সংযুক্ত ছক অনুযায়ী )"><i class="fa fa-paperclip"></i> </button>
                <button href="{{ route('foreginPdfDownload',base64_encode($renewInfoData->id)) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
                @else

                @endif




                @endif
@endif

            </td>
        </tr>

@endif

<!--end if -->












<!--new start -->
@if(empty($ngoOtherDocListsFirst->list_of_board_of_directors_or_board_of_trustees))

@else
<?php

$file_path = url($ngoOtherDocListsFirst->list_of_board_of_directors_or_board_of_trustees);
$filename  = pathinfo($file_path, PATHINFO_FILENAME);


?>



<tr>
<td>বোর্ড অব ডিরেক্টরস /বোর্ড অব ট্রাস্টিজ তালিকা (সংশ্লিষ্ট দেশের পিস অব জাস্টিস কতৃক নোটারীকৃত /সত্যায়িত )</td>
<td>

    <a target="_blank" class="btn btn-sm btn-success" href="{{ route('renewalFileDownload', ['title' =>'trustees', 'id' =>$ngoOtherDocListsFirst->id]) }}" >
<i class="fa fa-eye"></i>
</a>


@if(Route::is('addChildNote') || Route::is('viewChildNote'))

<button  href="{{ route('renewalFileDownload', ['title' =>'trustees', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-secondary" id="attLink1"  data-name="বোর্ড অব ডিরেক্টরস /বোর্ড অব ট্রাস্টিজ তালিকা"><i class="fa fa-paperclip"></i></button>
<button  href="{{ route('renewalFileDownload', ['title' =>'trustees', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
@else

@endif

</td>
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
<td>

    <a target="_blank" class="btn btn-sm btn-success" href="{{ route('renewalFileDownload', ['title' =>'registration_certificate', 'id' =>$ngoOtherDocListsFirst->id]) }}" >
<i class="fa fa-eye"></i>
</a>

@if(Route::is('addChildNote') || Route::is('viewChildNote'))

<button  href="{{ route('renewalFileDownload', ['title' =>'registration_certificate', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-secondary" id="attLink1"  data-name=" সংস্থার মূল কার্যালয়ের নিবন্ধনপত্রের (সংশ্লিষ্ট দেশের নোটারীকৃত /সত্যায়িত ) অনুলিপি"><i class="fa fa-paperclip"></i></button>
<button  href="{{ route('renewalFileDownload', ['title' =>'registration_certificate', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
@else

@endif

</td>
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
<td>

    <a target="_blank" class="btn btn-sm btn-success" href="{{ route('renewalFileDownload', ['title' =>'fee_if_changed', 'id' =>$ngoOtherDocListsFirst->id]) }}" >
<i class="fa fa-eye"></i>
</a>

@if(Route::is('addChildNote') || Route::is('viewChildNote'))

<button  href="{{ route('renewalFileDownload', ['title' =>'fee_if_changed', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-secondary" id="attLink1"  data-name="সংস্থার গঠনতন্ত্র পরিবর্তন হয়ে থাকলে নির্ধারিত ফি সহ তার সত্যায়িত অনুলিপি"><i class="fa fa-paperclip"></i></button>
<button  href="{{ route('renewalFileDownload', ['title' =>'fee_if_changed', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
@else

@endif

</td>
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
<td>

    <a target="_blank" class="btn btn-sm btn-success" href="{{ route('renewalFileDownload', ['title' =>'primary_registering_authority', 'id' =>$ngoOtherDocListsFirst->id]) }}" >
<i class="fa fa-eye"></i>
</a>

@if(Route::is('addChildNote') || Route::is('viewChildNote'))

<button  href="{{ route('renewalFileDownload', ['title' =>'primary_registering_authority', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-secondary" id="attLink1"  data-name="প্রাথমিক নিবন্ধনকারী কতৃপক্ষের অনুমোদিতো গঠনতন্ত্রের সত্যায়িত কপি"><i class="fa fa-paperclip"></i></button>
<button  href="{{ route('renewalFileDownload', ['title' =>'primary_registering_authority', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
@else

@endif

</td>
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
<td>

    <a target="_blank" class="btn btn-sm btn-success" href="{{ route('renewalFileDownload', ['title' =>'clean_copy_of_the_constitution', 'id' =>$ngoOtherDocListsFirst->id]) }}" >
<i class="fa fa-eye"></i>
</a>

@if(Route::is('addChildNote') || Route::is('viewChildNote'))

<button  href="{{ route('renewalFileDownload', ['title' =>'clean_copy_of_the_constitution', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-secondary" id="attLink1"  data-name="সংস্থার চেয়ারম্যান ও সেক্রেটারি কর্তৃক যৌথ স্বাক্ষরিত গঠনতন্ত্র পরিচ্ছন্ন কপি"><i class="fa fa-paperclip"></i></button>
<button  href="{{ route('renewalFileDownload', ['title' =>'clean_copy_of_the_constitution', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
@else

@endif

</td>
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
<td>

    <a target="_blank" class="btn btn-sm btn-success" href="{{ route('renewalFileDownload', ['title' =>'payment_of_change_fee', 'id' =>$ngoOtherDocListsFirst->id]) }}" >
<i class="fa fa-eye"></i>
</a>

@if(Route::is('addChildNote') || Route::is('viewChildNote'))

<button  href="{{ route('renewalFileDownload', ['title' =>'payment_of_change_fee', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-secondary" id="attLink1"  data-name="গঠনতন্ত্রের কোন ধারা, উপধারা পরিবর্তন ফি জমা প্রদানের চালানের মূলকপি"><i class="fa fa-paperclip"></i></button>
<button  href="{{ route('renewalFileDownload', ['title' =>'payment_of_change_fee', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
@else

@endif


</td>
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
<td>
    <a target="_blank" class="btn btn-sm btn-success" href="{{ route('renewalFileDownload', ['title' =>'section_sub_section_of_the_constitution', 'id' =>$ngoOtherDocListsFirst->id]) }}" >
<i class="fa fa-eye"></i>
</a>

@if(Route::is('addChildNote') || Route::is('viewChildNote'))

<button  href="{{ route('renewalFileDownload', ['title' =>'section_sub_section_of_the_constitution', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-secondary" id="attLink1"  data-name="গঠনতন্ত্রের কোন ধারা, উপধারা পরিবর্তন ও সংযোজনের বিষয়ে সাধারণ সভার কার্যবিবরণীর সত্যায়িত কপি"><i class="fa fa-paperclip"></i></button>
<button  href="{{ route('renewalFileDownload', ['title' =>'section_sub_section_of_the_constitution', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
@else

@endif
</td>
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
<td>

    <a target="_blank" class="btn btn-sm btn-success" href="{{ route('renewalFileDownload', ['title' =>'previous_constitution', 'id' =>$ngoOtherDocListsFirst->id]) }}" >
<i class="fa fa-eye"></i>
</a>

@if(Route::is('addChildNote') || Route::is('viewChildNote'))

<button  href="{{ route('renewalFileDownload', ['title' =>'previous_constitution', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-secondary" id="attLink1"  data-name="পূর্ব গঠনতন্ত্র ও বর্তমান গঠনতন্ত্রের তুলনামূলক বিবরণী (প্রতি পাতায় সভাপতি ও সম্পাদকের যৌথ স্বাক্ষরসহ)"><i class="fa fa-paperclip"></i></button>
<button  href="{{ route('renewalFileDownload', ['title' =>'previous_constitution', 'id' =>$ngoOtherDocListsFirst->id]) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
@else

@endif


</td>
</tr>



@endif

<!--end if -->


@else


@endif


@endforeach


        @endif








    </table>
</div>
