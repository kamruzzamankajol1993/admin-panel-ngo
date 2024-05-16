@extends('admin.master.master')

@section('title')
এফডি - ৯ (এন-ভিসা) | {{ $ins_name }}
@endsection



@section('css')

@endsection

@section('body')
<?php
 $engDATE = array('1','2','3','4','5','6','7','8','9','0','January','February','March','April',
      'May','June','July','August','September','October','November','December','Saturday','Sunday',
      'Monday','Tuesday','Wednesday','Thursday','Friday');
      $bangDATE = array('১','২','৩','৪','৫','৬','৭','৮','৯','০','জানুয়ারী','ফেব্রুয়ারী','মার্চ','এপ্রিল','মে',
      'জুন','জুলাই','আগস্ট','সেপ্টেম্বর','অক্টোবর','নভেম্বর','ডিসেম্বর','শনিবার','রবিবার','সোমবার','মঙ্গলবার','
      বুধবার','বৃহস্পতিবার','শুক্রবার'
      );



?>
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <h3>বিদেশী কর্মকর্তার নিয়োগ পত্রের সত্যায়ন পত্র </h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">হোম</a></li>
                    <li class="breadcrumb-item">এফডি - ৯ (এন-ভিসা)</li>
                    <li class="breadcrumb-item">এফডি - ৯ (এন-ভিসা) এর বিবরণ </li>
                </ol>
            </div>
            <div class="col-sm-6">
            </div>
        </div>
    </div>
</div>
   <!-- Container-fluid starts-->
   <div class="container-fluid">
    <div class="user-profile">
        <div class="card height-equal">
            <div class="card-body">
                <ul class="nav nav-dark" id="pills-darktab" role="tablist">
                    <li class="nav-item"><a class="nav-link active" id="pills-darkhome-tab"
                                            data-bs-toggle="pill" href="#pills-darkhome"
                                            role="tab" aria-controls="pills-darkhome"
                                            aria-selected="true" style=""><i
                                    class="icofont icofont-ui-home"></i>এফডি - ৯ </a></li>

                                    <li class="nav-item"><a class="nav-link" id="pills-darkprofile-tab"
                                            data-bs-toggle="pill" href="#pills-darkprofile"
                                            role="tab" aria-controls="pills-darkprofile"
                                            aria-selected="false" style=""><i
                                    class="icofont icofont-man-in-glasses"></i>নিরাপত্তা ছাড়পত্র</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" id="pills-darkcontact-tab"
                                            data-bs-toggle="pill" href="#pills-darkcontact"
                                            role="tab" aria-controls="pills-darkcontact"
                                            aria-selected="false" style=""><i
                                    class="icofont icofont-contacts"></i>ফরওয়ার্ডিং লেটার</a>
                    </li>


                    <li class="nav-item"><a class="nav-link" id="pills-darkdoc-tab"
                                            data-bs-toggle="pill" href="#pills-darkdoc"
                                            role="tab" aria-controls="pills-darkdoc"
                                            aria-selected="false" style=""><i
                                    class="icofont icofont-animal-lemur"></i>নথি সুরক্ষা বিভাগ ,স্বরাষ্ট্র মন্ত্রণালয়ে পাঠান</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" id="pills-darkdoc1-tab"
                        data-bs-toggle="pill" href="#pills-darkdoc1"
                        role="tab" aria-controls="pills-darkdoc1"
                        aria-selected="false" style=""><i
                class="icofont icofont-animal-lemur"></i>আবেদনের স্টেটাস পরীক্ষা করুন</a>
</li>
                </ul>
                <div class="tab-content" id="pills-darktabContent">
                    <div class="tab-pane fade active show" id="pills-darkhome"
                         role="tabpanel" aria-labelledby="pills-darkhome-tab">
                        <div class="mb-0 m-t-30">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12">

                                            <p>এফডি - ৯ পিডিএফ ডাউনলোড করুন</p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="text-center">
                                                <p>পিডিএফ ডাউনলোড</p>
                                                <a class="btn btn-sm btn-success" target="_blank"
                                                       href = '{{ route('fdNinePdfDownload',$dataFromNVisaFd9Fd1->id) }}'>
                                                       ডাউনলোড করুন
                                            </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="text-center">
                                        <h4>এফডি-৯ ফরম</h4>
                                        <h5>বিদেশি নাগরিক নিয়োগপত্র সত্যায়ন ফরম</h5>
                                    </div>
<?php
$mainValue =Carbon\Carbon::parse($ngoStatus->updated_at)->toDateString();
$formatDate = date('d-m-Y', strtotime($mainValue));
$banglaValue =App\Http\Controllers\Admin\CommonController::englishToBangla($formatDate);


?>
                                    <div>
                                        <p>বরাবর <br>
                                            মহাপরিচালক <br>
                                            এনজিও বিষয় ব্যুরো, ঢাকা <br>
                                            জনাব,</p>
                                        <p>নিম্নলখিত নিয়োগপ্রাপ্ত বিদেশি নাগরিক/নাগরিকগণকে
                                            এ সংস্থায় (নিবন্ধন নম্বরঃ{{App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromNVisaFd9Fd1->registration_number)}}
                                            তারিখঃ {{$banglaValue}}) বৈদেশিক
                                            অনুদান (স্বেচ্ছাসেবামূলক কর্মকান্ড) রেগুলেশন আইন
                                            ২০১৬ অনুযায়ী নিয়োগপত্র সত্যায়ন ও
                                            এনডিসা প্রাপ্তির সুপারিশপত্র
                                            পাওয়ার জন্য আবেদন করছিঃ</p>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td>১.</td>
                                                <td>বিদেশি নাগরিকের নাম (ইংরেজীতে Capital Letter এ)</td>
                                                <td>: {{ $dataFromNVisaFd9Fd1->fd9_foreigner_name }}</td>
                                            </tr>
                                            <tr>
                                                <td>২.</td>
                                                <td>(ক) পিতার নাম</td>
                                                <td>: {{ $dataFromNVisaFd9Fd1->fd9_father_name }}</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>(খ) স্বামী/স্ত্রীর নাম</td>
                                                <td>: {{ $dataFromNVisaFd9Fd1->fd9_husband_or_wife_name }}</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>(গ) মাতার নাম</td>
                                                <td>: {{ $dataFromNVisaFd9Fd1->fd9_mother_name }}</td>
                                            </tr>
                                            <tr>
                                                <td>৩.</td>
                                                <td>জন্ম স্থান ও তারিখ</td>
                                                <td>: {{ $dataFromNVisaFd9Fd1->fd9_birth_place }} ও {{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-m-Y', strtotime($dataFromNVisaFd9Fd1->fd9_dob))) }}</td>
                                            </tr>
                                            <tr>
                                                <td>৪.</td>
                                                <td>পাসপোর্ট নম্বর, ইস্যু ও মেয়াদোর্ত্তীণ তারিখ</td>
                                                <td>: {{ $dataFromNVisaFd9Fd1->fd9_passport_number }},{{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-m-Y', strtotime($dataFromNVisaFd9Fd1->fd9_passport_issue_date))) }},{{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-m-Y', strtotime($dataFromNVisaFd9Fd1->fd9_passport_expiration_date))) }}</td>
                                            </tr>
                                            <tr>
                                                <td>৫.</td>
                                                <td>পাসপোর্টে প্রদত্ত সনাক্তকারী চিহ্ন</td>
                                                <td>: {{ $dataFromNVisaFd9Fd1->fd9_identification_mark_given_in_passport }}</td>
                                            </tr>
                                            <tr>
                                                <td>৬.</td>
                                                <td>পুরুষ/মহিলা</td>
                                                <td>: {{ $dataFromNVisaFd9Fd1->fd9_male_or_female }}</td>
                                            </tr>
                                            <tr>
                                                <td>৭.</td>
                                                <td>বৈবাহিক অবস্থা</td>
                                                <td>: {{ $dataFromNVisaFd9Fd1->fd9_marital_status }}</td>
                                            </tr>
                                            <tr>
                                                <td>৮.</td>
                                                <td>জাতীয়তা / নাগরিকত্ব</td>
                                                <td>: {{ $dataFromNVisaFd9Fd1->fd9_nationality_or_citizenship }}</td>
                                            </tr>
                                            <tr>
                                                <td>৯.</td>
                                                <td>একাধিক নাগরিকত্ব থাকলে বিবরণ</td>
                                                <td>: {{ $dataFromNVisaFd9Fd1->fd9_details_if_multiple_citizenships }}</td>
                                            </tr>
                                            <tr>
                                                <td>১০.</td>
                                                <td>পূর্বের নাগরিকত্ব থাকলে তা বহাল না থাকার কারণ</td>
                                                <td>: {{ $dataFromNVisaFd9Fd1->fd9_previous_citizenship_is_grounds_for_non_retention }}</td>
                                            </tr>
                                            <tr>
                                                <td>১১.</td>
                                                <td>বর্তমান ঠিকানা</td>
                                                <td>: {{ $dataFromNVisaFd9Fd1->fd9_current_address }}</td>
                                            </tr>
                                            <tr>
                                                <td>১২.</td>
                                                <td>পরিবারের সদস্য সংখ্যা</td>
                                                <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromNVisaFd9Fd1->fd9_number_of_family_members) }}</td>
                                            </tr>

                                            <?php
                                            $familyData = DB::table('fd9_foreigner_employee_family_member_lists')
                   ->where('fd9_form_id',$dataFromNVisaFd9Fd1->id)->get();

                                            //dd($familyData);
                                             ?>


                                        <tr>
                                            <td>১৩.</td>
                                            <td>পরিবারের সদসাদের নাম ও বয়স (যাহারা তার সাথে
                                                থাকবেন)
                                            </td>
                                            <td>: @foreach($familyData as $key=>$allFamilyData)
                                                {{ $allFamilyData->family_member_name }},{{ App\Http\Controllers\Admin\CommonController::englishToBangla($allFamilyData->family_member_age) }}<br>
                                                @endforeach</td>
                                        </tr>
                                        <tr>
                                            <td>১৪.</td>
                                            <td>একাডেমিক যোগ্যতা (একাডেমিক যোগ্যতার সমর্থনে সনদপত্রের কপি সংযুক্ত করতে হবে</td>
                                            <td>:  @if(!$dataFromNVisaFd9Fd1->fd9_academic_qualification)

                                                @else


                                                <a target="_blank" href="{{ route('nVisaDocumentDownload',['cat'=>'academicQualification','id'=>$dataFromNVisaFd9Fd1->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন  </a>
                                                 @endif
                                                </td>
                                        </tr>
                                        <tr>
                                            <td>১৫.</td>
                                            <td>কারিগরি ও অন্যান্য যোগ্যতা যদি থাকে (প্রাসঙ্গিক সনদপত্রের কপি সংযুক্ত করতে
                                                হবে)
                                            </td>
                                            <td>: @if(!$dataFromNVisaFd9Fd1->fd9_technical_and_other_qualifications_if_any)

                                                @else


                                                <a target="_blank" href="{{ route('nVisaDocumentDownload',['cat'=>'techQualification','id'=>$dataFromNVisaFd9Fd1->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন  </a>
                                                 @endif</td>
                                        </tr>
                                        <tr>
                                            <td>১৬.</td>
                                            <td>অতীত অভিজ্ঞতা এবং যে কাজে তাঁকে নিয়োগ দেয়া হচ্ছে তাতে তার দক্ষতা (প্রমাণকসহ)
                                            </td>
                                            <td>: @if(!$dataFromNVisaFd9Fd1->fd9_past_experience)

                                                @else


                                                <a target="_blank" href="{{ route('nVisaDocumentDownload',['cat'=>'pastExperience','id'=>$dataFromNVisaFd9Fd1->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন  </a>
                                                 @endif</td>
                                        </tr>
                                        <tr>
                                            <td>১৭.</td>
                                            <td>যে সব দেশ ভ্রমণ করেছেন (কর্মসংস্থানের জন্য)</td>
                                            <td>: {{ $dataFromNVisaFd9Fd1->fd9_countries_that_have_traveled }}</td>
                                        </tr>
                                        <tr>
                                            <td>১৮.</td>
                                            <td>যে পদের জন্য নিয়োগ প্রস্তাব দেয়া হয়েছে : (নিয়োগপত্র কপি ও চুক্তিপত্র সংযুক্ত
                                                করতে হবে)
                                            </td>
                                            <td>:  @if(!$dataFromNVisaFd9Fd1->fd9_offered_post)

                                                @else


                                                <a target="_blank" href="{{ route('nVisaDocumentDownload',['cat'=>'offeredPost','id'=>$dataFromNVisaFd9Fd1->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন  </a>
                                                 @endif</td>
                                        </tr>
                                        <tr>
                                            <td>১৯.</td>
                                            <td>যে প্রকল্পে তাকে নিয়োগের প্রস্থাব করা হয়েছে তার নাম ও মেয়াদ ব্যুরোর অনুমোদন
                                                পত্র সংযুক্ত করতে হবে)
                                            </td>
                                            <td>: @if(!$dataFromNVisaFd9Fd1->fd9_name_of_proposed_project)

                                                @else


                                                <a target="_blank" href="{{ route('nVisaDocumentDownload',['cat'=>'proposedProject','id'=>$dataFromNVisaFd9Fd1->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন  </a>
                                                 @endif</td>
                                        </tr>
                                        <tr>
                                            <td>২০.</td>
                                            <td>নিয়োগের যে তারিখ নির্ধারণ করা হয়েছে</td>
                                            <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromNVisaFd9Fd1->fd9_date_of_appointment) }}</td>
                                        </tr>
                                        <tr>
                                            <td>২১.</td>
                                            <td>এক্সটেনশন হয়ে থাকলে তার সময়কাল</td>
                                            <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-m-Y', strtotime($dataFromNVisaFd9Fd1->fd9_extension_date))) }}</td>
                                        </tr>
                                        <tr>
                                            <td>২২.</td>
                                            <td>এ প্রকল্পে কতজন বিদেশির পদের সংস্থান রয়েছে এবং কর্মরত কতজন</td>
                                            <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromNVisaFd9Fd1->fd9_post_available_for_foreigner_and_working) }}</td>
                                        </tr>
                                        <tr>
                                            <td>২৩.</td>
                                            <td>বাংলাদেশের ইতঃপূর্বে অন্যকোন সংস্থায় কাজ করেছিলেন কিনা তার বিবরণ</td>
                                            <td>: {{ $dataFromNVisaFd9Fd1->fd9_previous_work_experience_in_bangladesh }}</td>
                                        </tr>
                                        <tr>
                                            <td>২৪.</td>
                                            <td>সংস্থায় বর্তমানে কতজন বিদেশি নাগরিক কর্মরত আছেন</td>
                                            <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromNVisaFd9Fd1->fd9_total_foreigner_working) }}</td>
                                        </tr>
                                        <tr>
                                            <td>২৫.</td>
                                            <td>অন্য কোন তথ্য (যদি থাকে)</td>
                                            <td>: {{ $dataFromNVisaFd9Fd1->fd9_other_information }}</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>বিদেশি নাগরিকের পাসপোর্ট সাইজের ছবি</td>
                                            <td>: @if(!$dataFromNVisaFd9Fd1->fd9_foreigner_passport_size_photo)

                                                @else

                                                <img src="{{ $ins_url }}{{ $dataFromNVisaFd9Fd1->fd9_foreigner_passport_size_photo }}" alt="" style="height:40px;" id="output">

@endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>পাসপোর্টের কপি সংযুক্ত</td>
                                            <td>:  @if(!$dataFromNVisaFd9Fd1->fd9_copy_of_passport)

                                                @else


                                                <a target="_blank" href="{{ route('nVisaDocumentDownload',['cat'=>'copyOfPassport','id'=>$dataFromNVisaFd9Fd1->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন  </a>
                                                 @endif</td>
                                        </tr>
                                        </tbody>
                                    </table>


                                    <div class="row">
                                        <div class="col-lg-6 col-sm-12"></div>
                                        <div class="col-lg-6 col-sm-12">
                                            <table class="table table-borderless">

                                                <tr>
                                                    <td><img width="150" height="60" src="{{ $ins_url }}{{ $dataFromNVisaFd9Fd1->digital_signature}}"/></td>
                                                </tr>


                                                <tr>
                                                    <td><img width="150" height="60" src="{{ $ins_url }}{{ $dataFromNVisaFd9Fd1->digital_seal}}"/></td>
                                                </tr>

                                                <tr>
                                                    <td>প্রধান নির্বাহীর স্বাক্ষর ও সিল</td>
                                                </tr>


                                                <tr>
                                                    <td>প্রধান নির্বাহীর স্বাক্ষর ও সিল</td>
                                                </tr>
                                                <tr>
                                                    <td>নামঃ {{  $dataFromNVisaFd9Fd1->chief_name }}</td>
                                                </tr>
                                                <tr>
                                                    <td>পদবীঃ {{  $dataFromNVisaFd9Fd1->chief_desi }}</td>
                                                </tr>
                                                <tr>
                                                    <td>তারিখঃ {{  App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-m-Y', strtotime(\Carbon\Carbon::parse($dataFromNVisaFd9Fd1->chiefDate)->toDateString() )))}}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="pills-darkprofile" role="tabpanel"
                         aria-labelledby="pills-darkprofile-tab">
                        <div class="mb-0 m-t-30">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="others_inner_section">
                                                <h5>Application for Security Clearance</h5>
                                                <div class="notice_underline"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mt-3 ">
                                        <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                                            Basic Information
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-9 col-sm-12">
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <td>Approved permission period</td>
                                                            <td>:{{ $dataFromNVisaFd9Fd1->period_validity }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Effective Date</td>
                                                            <td>:{{ date('d-m-Y', strtotime($dataFromNVisaFd9Fd1->permit_efct_date)) }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Ref no. of issued work permit</td>
                                                            <td>:{{ $dataFromNVisaFd9Fd1->visa_ref_no }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Received Visa Recommendation Lette</td>
                                                            <td>:{{ $dataFromNVisaFd9Fd1->visa_recomendation_letter_received_way	 }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Ref no. of Visa Recommendation Letter</td>
                                                            <td>:{{ $dataFromNVisaFd9Fd1->visa_recomendation_letter_ref_no	 }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Department in</td>
                                                            <td>:{{ $dataFromNVisaFd9Fd1->department_in	 }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Work Permit type</td>
                                                            <td>:{{ $dataFromNVisaFd9Fd1->visa_category	 }}</td>
                                                        </tr>

                                                    </table>
                                                </div>
                                                <div class="col-lg-3 col-sm-12">
                                                    <div class="nvisa-avatar">
                                                        @if(!$dataFromNVisaFd9Fd1->applicant_photo)
                                                        <img src="https://bootdey.com/img/Content/avatar/avatar1.png" style="height: 80px;" alt="">
                                                        @else
                                                        <img src="{{ $ins_url }}{{ $dataFromNVisaFd9Fd1->applicant_photo }}" style="height: 80px;" alt="">
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mt-3 ">
                                        <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                                            A. PARTICULAR OF SPONSOR/EMPLOYER
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <td colspan="2">Name of the enterprise (organization/company): {{ $nVisaSponSor->org_name }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="background-color: #d4d4d4">Address of the enterprise (Bangladesh Only)</td>
                                                </tr>
                                                <tr>
                                                    <td>House/Plot/Holding/Village:: {{ $nVisaSponSor->org_house_no }}  </td>
                                                    <td>Flat/Apartment/Floor: {{ $nVisaSponSor->org_flat_no }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Road Number: {{ $nVisaSponSor->org_road_no }}</td>
                                                    <td>Post/Zip Code: {{ $nVisaSponSor->org_post_code }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Post Office: {{ $nVisaSponSor->org_post_office }}</td>
                                                    <td>Telephone Number: {{ $nVisaSponSor->org_phone }}</td>
                                                </tr>
                                                <tr>
                                                    <td>City/District: {{ $nVisaSponSor->org_district }}</td>
                                                    <td>Thana/Upazilla: {{ $nVisaSponSor->org_thana }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Fax Number: {{ $nVisaSponSor->org_fax_no }}</td>
                                                    <td>Email: {{ $nVisaSponSor->org_email }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">Type of the Organization: NGO</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">Nature of buisness: {{ $nVisaSponSor->nature_of_business }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">Authorized Capital: {{ $nVisaSponSor->authorized_capital }}</td>
                                                </tr>

                                                <tr>
                                                    <td colspan="2">Paid up capital: {{ $nVisaSponSor->paid_up_capital }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Remittance received during last 12 months: {{ $nVisaSponSor->remittance_received }}</td>
                                                    <td>Type of Industry:NGO </td>
                                                </tr>
                                                <tr>
                                                    <td>Recommendation of Company Boards: {{ $nVisaSponSor->recommendation_of_company_board }}</td>
                                                    <td>Whether local, foreign or joint venture company (if joint venture, percentage of local and foreign investment is to be shown): {{ $nVisaSponSor->company_share }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="card mt-3 ">
                                        <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                                            B. PARTICULARS OF FOREIGN INCUMBENT
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <td colspan="2">Name of the foreign national: {{ $nVisaForeignerInfo->name_of_the_foreign_national }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Nationality: {{ $nVisaForeignerInfo->nationality  }}</td>
                                                    <td>Passport Number: {{ $nVisaForeignerInfo->passport_no }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Date of Issue: {{ $nVisaForeignerInfo->passport_issue_date }}</td>
                                                    <td>Place of Issue: {{ $nVisaForeignerInfo->passport_issue_place }} </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">Expiry Date: {{ $nVisaForeignerInfo->passport_expiry_date }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="background-color: #d4d4d4">Permanent Address</td>
                                                </tr>
                                                <tr>
                                                    <td>Country: {{ $nVisaForeignerInfo->home_country }}</td>
                                                    <td>House/Plot/Holding Number: {{ $nVisaForeignerInfo->house_no }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Flat/Apartment/Floor Number: {{ $nVisaForeignerInfo->flat_no }}</td>
                                                    <td>Road Name/Road Number: {{ $nVisaForeignerInfo->road_no }} </td>
                                                </tr>
                                                <tr>
                                                    <td><b></b> </td>
                                                    <td><b></b> </td>
                                                </tr>
                                                <tr>
                                                    <td>Post/Zip Code: {{ $nVisaForeignerInfo->post_code }}</td>
                                                    <td>State/Province: {{ $nVisaForeignerInfo->state }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Telephone Number: {{ $nVisaForeignerInfo->phone }}</td>
                                                    <td>City: {{ $nVisaForeignerInfo->city }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Fax Number:  {{ $nVisaForeignerInfo->fax_no }}</td>
                                                    <td>Email: {{ $nVisaForeignerInfo->email }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Date of Birth: {{ $nVisaForeignerInfo->date_of_birth }}</td>
                                                    <td>Marital Status: {{ $nVisaForeignerInfo->martial_status }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="card mt-3 ">
                                        <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                                            C. EMPLOYMENT INFORMATION
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <td>Name of the post employed for (Designation):: {{ $nVisaEmploye->employed_designation }}</td>
                                                    <td>Date of arrival in Bangladesh:  {{ $nVisaEmploye->date_of_arrival_in_bangladesh }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Type of visa: N-Visa </td>
                                                    <td>Date of first assignment: {{ $nVisaEmploye->first_appoinment_date }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Desired Effective Date: {{ $nVisaEmploye->desired_effective_date }}</td>
                                                    <td>Desired End Date: {{ $nVisaEmploye->desired_end_date }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Desired Duration: {{ $nVisaEmploye->visa_validity }}</td>
                                                    <td>Brief job description: {{ $nVisaEmploye->brief_job_description }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">Employee Justification: {{ $nVisaEmploye->employee_justification }} </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="card mt-3 ">
                                        <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                                            D. WORKPLACE ADDRESS
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <td>House/Plot/Holding/Village::  {{ $nVisaWorkPlace->work_house_no }}</td>
                                                    <td>Flat/Apartment/Floor: {{ $nVisaWorkPlace->work_flat_no }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Road Number: {{ $nVisaWorkPlace->work_road_no }} </td>
                                                    <td>City/District: {{ $nVisaWorkPlace->work_district }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Thana/Upazilla: {{ $nVisaWorkPlace->work_thana }} </td>
                                                    <td>Email: {{ $nVisaWorkPlace->work_email }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Type of Organization: এনজিও</td>
                                                    <td>Contact Person Mobile Number: {{ $nVisaWorkPlace->contact_person_mobile_number }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>


                                    <?php

$annual =DB::table('n_visa_compensation_and_benifits')
->where('n_visa_id',$dataFromNVisaFd9Fd1->nVisaId)->where('salary_category','Annual Bonus')->first();

$medical =DB::table('n_visa_compensation_and_benifits')
->where('n_visa_id',$dataFromNVisaFd9Fd1->nVisaId)->where('salary_category','Medical Allowance')->first();

$entertainment =DB::table('n_visa_compensation_and_benifits')
->where('n_visa_id',$dataFromNVisaFd9Fd1->nVisaId)->where('salary_category','Entertainment Allowance')->first();


$convoy =DB::table('n_visa_compensation_and_benifits')
->where('n_visa_id',$dataFromNVisaFd9Fd1->nVisaId)->where('salary_category','Conveyance')->first();

$house =DB::table('n_visa_compensation_and_benifits')
->where('n_visa_id',$dataFromNVisaFd9Fd1->nVisaId)->where('salary_category','House Rent')->first();

$overseas =DB::table('n_visa_compensation_and_benifits')
->where('n_visa_id',$dataFromNVisaFd9Fd1->nVisaId)->where('salary_category','Overseas Allowance')->first();


$basic =DB::table('n_visa_compensation_and_benifits')
->where('n_visa_id',$dataFromNVisaFd9Fd1->nVisaId)->where('salary_category','Basic Salary')->first();


$mainDatac =DB::table('n_visa_compensation_and_benifits')
->where('n_visa_id',$dataFromNVisaFd9Fd1->nVisaId)->first();



?>

<!--compansation --->

@if(!$mainDatac)
<div class="card mt-3 ">
    <div class="card-header bg-primary d-flex justify-content-between align-items-center">
        E.COMPENSATION AND BENIFITS
    </div>
    <div class="card-body">
        No Information Available
    </div>
</div>
@else
<div class="card mt-3 ">
    <div class="card-header bg-primary d-flex justify-content-between align-items-center">
        E.COMPENSATION AND BENIFITS
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <td><b>Salary Structure</b></td>
                <td colspan="3"><b>Payble Locally</b></td>
            </tr>
            <tr>
                <td></td>
                <td>Payment</td>
                <td>Amount</td>
                <td>Currency</td>
            </tr>
            @if(!$basic)

            @else
            <tr>
                <td>a. Basic Salary</td>
                <td>{{ $basic->payment_type }}</td>
                <td>{{ $basic->amount }}</td>
                <td>{{ $basic->currency }}</td>
            </tr>
            @endif
            @if(!$overseas)

            @else
            <tr>
                <td>b. Overseas allowance</td>
                <td>{{ $overseas->payment_type }}</td>
                <td>{{ $overseas->amount }}</td>
                <td>{{ $overseas->currency }}</td>
            </tr>
            @endif
            @if(!$house)

            @else
            <tr>
                <td>c. House rent/Accommodation</td>
                <td>{{ $house->payment_type }}</td>
                <td>{{ $house->amount }}</td>
                <td>{{ $house->currency }}</td>
            </tr>
            @endif
            @if(!$convoy)

            @else
            <tr>
                <td>d. Conveyance</td>
                <td>{{ $convoy->payment_type }}</td>
                <td>{{ $convoy->amount }}</td>
                <td>{{ $convoy->currency }}</td>
            </tr>
            @endif
            @if(!$entertainment)

            @else
            <tr>
                <td>e. Entertainmemt allowance</td>
                <td>{{ $entertainment->payment_type }}</td>
                <td>{{ $entertainment->amount }}</td>
                <td>{{ $entertainment->currency }}</td>
            </tr>
            @endif
            @if(!$medical)

            @else
            <tr>
                <td>f. Medical allowance<</td>
                <td>{{ $medical->payment_type }}</td>
                <td>{{ $medical->amount }}</td>
                <td>{{ $medical->currency }}</td>
            </tr>
            @endif
            @if(!$annual)

            @else
            <tr>
                <td>g. Annual Bonus</td>
                <td>{{ $annual->payment_type }}</td>
                <td>{{ $annual->amount }}</td>
                <td>{{ $annual->currency }}</td>
            </tr>
            @endif
            <tr>
                <td>h. Other fringe benefits, if any/td>
                <td colspan="3">{{ $dataFromNVisaFd9Fd1->other_benefit }}</td>
            </tr>
            <tr>
                <td>i. Any Particular Comments of remarks</td>
                <td colspan="3">{{ $dataFromNVisaFd9Fd1->salary_remarks }}</td>
            </tr>
        </table>
    </div>
</div>

@endif


<!--end compansation -->



                                    <div class="card mt-3 ">
                                        <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                                            F. Manpower of the office
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <td colspan="3"><b>Local (a)</b></td>
                                                    <td colspan="3"><b>Foreign  (b)</b></td>
                                                    <td rowspan="2"><b>Grand Total
                                                        (a+b)</b></td>
                                                    <td colspan="2"><b>Ratio</b></td>
                                                </tr>
                                                <tr>
                                                    <td>Executive</td>
                                                    <td>Supporting Staff </td>
                                                    <td>Total</td>
                                                    <td>Executive</td>
                                                    <td>Supporting Staff</td>
                                                    <td>Total</td>
                                                    <td>Local </td>
                                                    <td>Foreign</td>
                                                </tr>
                                                @if(!$nVisaManPower)
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                @else
                                                <tr>
                                                    <td>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($nVisaManPower->local_executive) }}</td>
                                                    <td>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($nVisaManPower->local_supporting_staff) }}</td>
                                                    <td>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($nVisaManPower->local_total) }}</td>
                                                    <td>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($nVisaManPower->foreign_executive) }}</td>
                                                    <td>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($nVisaManPower->foreign_supporting_staff) }}</td>
                                                    <td>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($nVisaManPower->foreign_total) }}</td>
                                                    <td>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($nVisaManPower->gand_total) }}</td>
                                                    <td>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($nVisaManPower->local_ratio) }}</td>
                                                    <td>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($nVisaManPower->foreign_ratio) }}</td>
                                                </tr>
                                                @endif
                                            </table>
                                        </div>
                                    </div>
                                    <div class="card mt-3 ">
                                        <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                                            G. Necessary Document for Work Permit (PDF)
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <th>#</th>
                <th>Required Attachment</th>
                <th>Action</th>
                                                    </tr>
                                                @if(!$nVisaDocs)

                                                <tr>
                                                    <td>1</td>
                                                    <td>Copy of buyer's nomination letter in case of employment of buyer;s representative</td>
                                                    <td>







                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Copy of registration letter of board of investment, if not submitted earlier</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Copy of service contract/agreement/ appointment letter in case of employee</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
            <td>Decision of the board of the directors of the company regarding employment of foreign nationals (In case of limited company) showing salary & other facility only signed by directors present in the meeting</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>5</td>
            <td>	Memorandum & Articles of Association of the company duly signed by shareholders along with certificate of incorporation (In case of limited company), if not sumitted earlier</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>6</td>
            <td>Photocopy of passport with E-type visa for employees/PI-type visa for Investors</td>
                                                    <td></td>
                                                </tr>

                                                @else


                                                <tr>
                                                    <td>1</td>
                                                    <td>Copy of buyer's nomination letter in case of employment of buyer;s representative</td>
                                                    <td>


                                                       @if(empty($nVisaDocs->nomination_letter_of_buyer))


                                                       @else

                                                        <a target="_blank"  href="{{ route('nVisaDocumentDownload',['cat'=>'nomination','id'=>$nVisaDocs->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> Open </a>

                                                        @endif


                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Copy of registration letter of board of investment, if not submitted earlier</td>
                                                    <td>

                                                        @if(empty($nVisaDocs->registration_letter_of_board_of_investment))


                                                        @else

                                                         <a target="_blank"  href="{{ route('nVisaDocumentDownload',['cat'=>'investment','id'=>$nVisaDocs->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> Open </a>

                                                         @endif

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Copy of service contract/agreement/ appointment letter in case of employee</td>
                                                    <td>

                                                        @if(empty($nVisaDocs->employee_contract_copy))


                                                        @else

                                                         <a target="_blank"  href="{{ route('nVisaDocumentDownload',['cat'=>'contract','id'=>$nVisaDocs->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> Open </a>

                                                         @endif

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td>Decision of the board of the directors of the company regarding employment of foreign nationals (In case of limited company) showing salary & other facility only signed by directors present in the meeting</td>
                                                    <td>

                                                        @if(empty($nVisaDocs->board_of_the_directors_sign_lette))


                                                        @else

                                                         <a target="_blank"  href="{{ route('nVisaDocumentDownload',['cat'=>'directors','id'=>$nVisaDocs->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> Open </a>

                                                         @endif

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>5</td>
                                                    <td>	Memorandum & Articles of Association of the company duly signed by shareholders along with certificate of incorporation (In case of limited company), if not sumitted earlier</td>
                                                    <td>
                                                        @if(empty($nVisaDocs->share_holder_copy))


                                                        @else

                                                         <a target="_blank"  href="{{ route('nVisaDocumentDownload',['cat'=>'shareHolder','id'=>$nVisaDocs->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> Open </a>

                                                         @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>6</td>
                                                    <td>Photocopy of passport with E-type visa for employees/PI-type visa for Investors</td>
                                                    <td>
                                                        @if(empty($nVisaDocs->passport_photocopy))


                                                        @else

                                                         <a target="_blank" href="{{ route('nVisaDocumentDownload',['cat'=>'passportCopy','id'=>$nVisaDocs->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> Open </a>

                                                         @endif
                                                    </td>
                                                </tr>


                                                @endif
                                                </tbody></table>
                                        </div>
                                    </div>
                                    <div class="card mt-3 ">
                                        <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                                            H. Authorized Personal of the organization
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <td>Organization Name: {{ $nVisaAuthPerson->auth_person_org_name }}</td>
                                                    <td>Organization House No: {{ $nVisaAuthPerson->auth_person_org_house_no }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Organization Flat No: {{ $nVisaAuthPerson->auth_person_org_flat_no }}</td>
                                                    <td>Organization Road No: {{ $nVisaAuthPerson->auth_person_org_road_no }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Organization Thana: {{ $nVisaAuthPerson->auth_person_org_thana }}</td>
                                                    <td>Organization Post Office: {{ $nVisaAuthPerson->auth_person_org_post_office }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Organization District: {{ $nVisaAuthPerson->auth_person_org_district }}</td>
                                                    <td>Organization Mobile: {{ $nVisaAuthPerson->auth_person_org_mobile }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Submission Date:  {{ $nVisaAuthPerson->submission_date }}</td>
                                                    <td>Expatriate Name: {{ $nVisaAuthPerson->expatriate_name }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Expatriate Emai: {{ $nVisaAuthPerson->expatriate_email }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-darkcontact" role="tabpanel"
                         aria-labelledby="pills-darkcontact-tab">
                        <div class="mb-0 m-t-30">

                            <?php


                            $forwardingLetterData =DB::table('forwarding_letters')
            ->where('fd9_form_id',$dataFromNVisaFd9Fd1->id)->first();



                            ?>
                            @if (is_null($forwardingLetterData))
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <form id="form" class="custom-validation" action="{{ route('forwardingLetterPost') }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="mb-3">
                                                    <label class="form-label"
                                                           for="exampleFormControlInput1">স্মারক নম্বর</label>
                                                    <input class="form-control" name="sarok_number" required id="" type="text"
                                                           placeholder="13456798">

                                                           <input class="form-control" value="{{ $dataFromNVisaFd9Fd1->id }}" name="fd9_id" required id="" type="hidden"
                                                           placeholder="13456798">


                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label"
                                                           for="exampleFormControlInput1">দায়িত্বপ্রাপ্ত কর্মকর্তা</label>
                                                        <input class="form-control" value="{{ Auth::guard('admin')->user()->admin_name }}"  id="" type="text"
                                                        placeholder="দায়িত্বপ্রাপ্ত কর্মকর্তা" readonly>
                                                        <input class="form-control" value="{{ Auth::guard('admin')->user()->id }}"  name="admin_id" type="hidden"
                                                        placeholder="দায়িত্বপ্রাপ্ত কর্মকর্তা" readonly>
                                                </div>
                                                <div class="mb-3">

                                                        <div class="col-md-12">

                                                            <table class="table table-bordered" id="dynamicAddRemove">
                                                                <tr>
                                                                    <th>অনুলিপি</th>
                                                                    <th>কার্যকলাপ</th>
                                                                </tr>
                                                                <tr>
                                                                    <td><input required type="text" name="name[]" placeholder="Enter Ename" id="name0" class="form-control" />
                                                                    </td>
                                                                    <td><button type="button" name="add" id="dynamic-ar" class="btn btn-sm btn-outline-primary">নতুন যুক্ত করুন</button></td>
                                                                </tr>
                                                            </table>

                                                        </div>
                                                </div>


                                        </div>
                                        <div class="card-footer text-end">
                                            <button class="btn btn-primary" type="submit">জমা দিন </button>
                                        </div>
                                    </form>
                                    </div>
                                </div>

                            </div>
                            @else
                            <div class="row">

                                <div class="col-lg-12 col-md-12 col-sm-12">

                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 col-sm-12">

                                                    <p>ফরওয়ার্ডিং লেটার পিডিএফ এডিট করুন</p>


                                                    <button class="btn btn-sm btn-success"  data-bs-toggle="modal" data-bs-target="#exampleModal1">
                                                        এডিট করুন
                                                    </button>

                                                    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                          <div class="modal-content">
                                                            <div class="modal-header">
                                                              <h1 class="modal-title fs-5" id="exampleModalLabel">ফরওয়ার্ডিং লেটার </h1>
                                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                <form  class="custom-validation" action="{{ route('postForwardingLetterForEdit') }}" id="form" method="post" enctype="multipart/form-data">
                                                                    @csrf

                                                                    <div class="mb-3">
                                                                        <label class="form-label"
                                                                               for="exampleFormControlInput1">পিডিএফ বডি পার্ট এক </label>

                                                                               @if(empty($editCheck))
                                                                        <textarea class="form-control summernote" name="pdf_body_one" required id="" type="text"
                                                                               >
                                                                               উপযুক্ত বিষয় ও সূত্রস্থ পত্রের পরিপ্রেক্ষিতে বর্ণিত সংস্থার নিয়োগের নিমিত্তে
                                                                               নিম্নবর্ণিত বিদেশী নাগরিকের নিয়োগ/নিরাপত্তা ছাড়পত্রের বিষয়ে প্রধানমন্ত্রীর
                                                                               কার্যালয়ের ২৫ নভেম্বর, ২০২১ তারিখের পরিপত্রের নির্দেশ মোতাবেক সুরক্ষা সেবা
                                                                               বিভাগের মতামত এনজিও বিষয়ক ব্যুরোতে প্রেরণের জন্য নির্দেশক্রমে অনুরোধ করা
                                                                               হলো।

                                                                            </textarea>
                                                                            @else

                                                                            <textarea class="form-control summernote" name="pdf_body_one" required id="" type="text"
                                                                            >
                                                                            {!! $editCheck !!}

                                                                         </textarea>
                                                                            @endif

                                                                               <input class="form-control" value="{{ $dataFromNVisaFd9Fd1->id }}" name="fd9_id" required id="" type="hidden"
                                                                               placeholder="13456798">


                                                                    </div>


                                                                    <div class="mb-3">
                                                                        <label class="form-label"
                                                                               for="exampleFormControlInput1">পিডিএফ বডি পার্ট দুই  </label>

                                                                               @if(empty($editCheck1))
                                                                               <textarea class="form-control summernote" name="pdf_body_two" required id="" type="text"
                                                                              >

                                                                              সচিব <br>
                                                                              সুরক্ষা সেবা বিভাগ <br>
                                                                              স্বরাষ্ট্র মন্ত্রণালয় <br>
                                                                              বাংলাদেশ সচিবালয়, ঢাকা
                                                                            </textarea>

                                                                            @else


                                                                            <textarea class="form-control summernote" name="pdf_body_two" required id="" type="text"
                                                                            >

                                                                           {!! $editCheck1 !!}
                                                                          </textarea>

                                                                            @endif




                                                                    </div>

                                                                    <div class="mb-3">

                                                                        <div class="col-md-12">

                                                                            <table class="table table-bordered" id="dynamicAddRemove">
                                                                                <tr>
                                                                                    <th>অনুলিপি</th>
                                                                                    <th>কার্যকলাপ</th>
                                                                                </tr>
                                                                                @foreach($forwardingLetterOnulipi as $key=>$allForwardingLetterOnulipi)
                                                                             @if($key == 0)
                                                                                <tr>
                                                                                    <td><input required type="text" value="{{ $allForwardingLetterOnulipi->onulipi_name }}" name="name[]" placeholder="অনুলিপি" id="name{{ $key+4000 }}" class="form-control" />
                                                                                    </td>
                                                                                    <td><button type="button" name="add" id="dynamic-ar" class="btn btn-sm btn-outline-primary">নতুন যুক্ত করুন </button></td>
                                                                                </tr>
                                                                                @else
                                                                                <tr>
                                                                                    <td><input required type="text" value="{{ $allForwardingLetterOnulipi->onulipi_name }}" name="name[]" placeholder="অনুলিপি" id="name{{ $key+4000 }}" class="form-control" />
                                                                                    </td>
                                                                                    <td><button type="button" class="btn btn-sm btn-outline-danger remove-input-field">মুছে ফেলুন</button></td>
                                                                                </tr>
                                                                                @endif
                                                                                @endforeach
                                                                            </table>

                                                                        </div>
                                                                </div>

                                                                    <div class="card-footer text-end">
                                                                        <button class="btn btn-primary" type="submit">জমা দিন </button>
                                                                    </div>
                                                                </form>

                                                                    </div>
                                                                </div>

                                                            </div>

                                                          </div>
                                                        </div>
                                                      </div>


                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-12">
                                                    {{-- <div class="text-center">
                                                        <p>PDF Download (পিডিএফ ডাউনলোড )</p>
                                                        <a class="btn btn-sm btn-success" target="_blank"
                                                               href = '{{ route('downloadForwardingLetter',$dataFromNVisaFd9Fd1->id) }}'>
                                                            Download Forwarding Letter
                                                    </a>
                                                    </div> --}}
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-12">
                                                    <div class="text-center">
                                                        <p>পিডিএফ আপলোড</p>
                                                        <button class="btn btn-sm btn-success"  data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                            ফরওয়ার্ডিং লেটার আপলোড করুন
                                                        </button>

                                                        <!--model-->
                                                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                              <div class="modal-content">
                                                                <div class="modal-header">
                                                                  <h1 class="modal-title fs-5" id="exampleModalLabel">পিডিএফ আপলোড</h1>
                                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form  class="custom-validation" action="{{ route('postForwardingLetter') }}" id="form" method="post" enctype="multipart/form-data">
                                                                        @csrf
                                                                           <input type="hidden" value="{{ $dataFromNVisaFd9Fd1->nVisaId }}" name="id" required>
                                                                        <div class="form-group col-md-12 col-sm-12">
                                                                            <label for="email">ফরওয়ার্ডিং লেটার</label>
                                                                            <input type="file" accept=".pdf" name="forwardingLetter" class="form-control form-control-sm" required>
                                                                        </div>



                                                                        <button type="submit" class="btn btn-primary btn-lg  waves-effect  btn-sm waves-light mr-1">
                                                                            জমা দিন
                                                                         </button>
                                                                    </form>

                                                                </div>

                                                              </div>
                                                            </div>
                                                          </div>
                                                        <!--model -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="card">
                                        <div class="card-body">
                                            <iframe src=
                                            "{{ url('public/'.$dataFromNVisaFd9Fd1->forwarding_letter) }}"
                                                            width="100%"
                                                            height="800">
                                                    </iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-darkdoc" role="tabpanel"
                         aria-labelledby="pills-darkdoc-tab">
                        <div class="mb-0 m-t-30">
                            <div class="card">
                                <div class="card-header pb-0">
                                    <h5>নথিপত্র সুরক্ষা বিভাগ ,স্বরাষ্ট্র মন্ত্রণালয়ে পাঠান</h5>
                                    <span>সুরক্ষা বিভাগ ,স্বরাষ্ট্র মন্ত্রণালয়ে পাঠানোর আগে অনুগ্রহ করে সমস্ত নথি দেখুন করুন</span>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>নথির নাম</th>
                                            <th>নথি দেখুন</th>
                                        </tr>
                                        @if(!$nVisaDocs)

                                                {{-- <tr>
                                                    <td>১</td>
                                                    <td>ক্রেতার প্রতিনিধি নিয়োগের ক্ষেত্রে ক্রেতার মনোনয়ন পত্রের অনুলিপি</td>
                                                    <td>







                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>২</td>
                                                    <td>বিনিয়োগ বোর্ডের নিবন্ধন পত্রের অনুলিপি, যদি আগে জমা না দেওয়া হয়</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>৩</td>
                                                    <td>কর্মচারীর ক্ষেত্রে পরিষেবা চুক্তি/চুক্তি/নিয়োগ পত্রের অনুলিপি</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>৪</td>
                                                    <td>বিদেশী নাগরিকদের নিয়োগ সংক্রান্ত কোম্পানির পরিচালক পর্ষদের সিদ্ধান্ত (সীমিত কোম্পানির ক্ষেত্রে) বেতন এবং অন্যান্য সুবিধা দেখায় শুধুমাত্র সভায় উপস্থিত পরিচালকদের দ্বারা স্বাক্ষরিত কোম্পানির</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>৫</td>
                                                    <td>মেমোরেন্ডাম এবং আর্টিকেল অফ অ্যাসোসিয়েশন শেয়ারহোল্ডারদের দ্বারা যথাযথভাবে স্বাক্ষরিত এবং অন্তর্ভুক্তির শংসাপত্র সহ (লিমিটেড কোম্পানির ক্ষেত্রে), যদি আগে জমা না দেওয়া হয়</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>৬</td>
                                                    <td>কর্মচারীদের জন্য ই-টাইপ ভিসা সহ পাসপোর্টের ফটোকপি/বিনিয়োগকারীদের জন্য পিআই-টাইপ ভিসা</td>
                                                    <td></td>
                                                </tr> --}}

                                                @else

                                                @if(empty($nVisaDocs->nomination_letter_of_buyer))


                                                @else
                                                <tr>

                                                    <td>ক্রেতার প্রতিনিধি নিয়োগের ক্ষেত্রে ক্রেতার মনোনয়ন পত্রের অনুলিপি</td>
                                                    <td>

ff


                                                        <a target="_blank"  href="{{ route('nVisaDocumentDownload',['cat'=>'nomination','id'=>$nVisaDocs->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন  </a>




                                                    </td>
                                                </tr>
                                                @endif
                                                @if(empty($nVisaDocs->registration_letter_of_board_of_investment))


                                                        @else
                                                <tr>

                                                    <td>বিনিয়োগ বোর্ডের নিবন্ধন পত্রের অনুলিপি, যদি আগে জমা না দেওয়া হয়</td>
                                                    <td>



                                                         <a target="_blank"  href="{{ route('nVisaDocumentDownload',['cat'=>'investment','id'=>$nVisaDocs->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন  </a>



                                                    </td>
                                                </tr>
                                                @endif
                                                @if(empty($nVisaDocs->employee_contract_copy))


                                                @else
                                                <tr>

                                                    <td>কর্মচারীর ক্ষেত্রে পরিষেবা চুক্তি/চুক্তি/নিয়োগ পত্রের অনুলিপি</td>
                                                    <td>



                                                         <a target="_blank"  href="{{ route('nVisaDocumentDownload',['cat'=>'contract','id'=>$nVisaDocs->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন  </a>



                                                    </td>
                                                </tr>
                                                @endif
                                                @if(empty($nVisaDocs->board_of_the_directors_sign_lette))


                                                        @else
                                                <tr>

                                                    <td>বিদেশী নাগরিকদের নিয়োগ সংক্রান্ত কোম্পানির পরিচালক পর্ষদের সিদ্ধান্ত (সীমিত কোম্পানির ক্ষেত্রে) বেতন এবং অন্যান্য সুবিধা দেখায় শুধুমাত্র সভায় উপস্থিত পরিচালকদের দ্বারা স্বাক্ষরিত কোম্পানির</td>
                                                    <td>



                                                         <a target="_blank"  href="{{ route('nVisaDocumentDownload',['cat'=>'directors','id'=>$nVisaDocs->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন  </a>



                                                    </td>
                                                </tr>
                                                @endif
                                                @if(empty($nVisaDocs->share_holder_copy))


                                                @else
                                                <tr>

                                                    <td>মেমোরেন্ডাম এবং আর্টিকেল অফ অ্যাসোসিয়েশন শেয়ারহোল্ডারদের দ্বারা যথাযথভাবে স্বাক্ষরিত এবং অন্তর্ভুক্তির শংসাপত্র সহ (লিমিটেড কোম্পানির ক্ষেত্রে), যদি আগে জমা না দেওয়া হয়</td>
                                                    <td>


                                                         <a target="_blank"  href="{{ route('nVisaDocumentDownload',['cat'=>'shareHolder','id'=>$nVisaDocs->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন </a>


                                                    </td>
                                                </tr>
                                                @endif
                                                @if(empty($nVisaDocs->passport_photocopy))


                                                @else
                                                <tr>

                                                    <td>কর্মচারীদের জন্য ই-টাইপ ভিসা সহ পাসপোর্টের ফটোকপি/বিনিয়োগকারীদের জন্য পিআই-টাইপ ভিসা</td>
                                                    <td>


                                                         <a target="_blank" href="{{ route('nVisaDocumentDownload',['cat'=>'passportCopy','id'=>$nVisaDocs->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন  </a>


                                                    </td>
                                                </tr>
                                                @endif

                                                @endif
                                                @if(!$dataFromNVisaFd9Fd1->fd9_academic_qualification)

                                                @else
                                                <tr>

                                                    <td>একাডেমিক যোগ্যতা (একাডেমিক যোগ্যতার সমর্থনে সনদপত্রের কপি সংযুক্ত করতে হবে</td>
                                                    <td>:


                                                        <a target="_blank" href="{{ route('nVisaDocumentDownload',['cat'=>'academicQualification','id'=>$dataFromNVisaFd9Fd1->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন  </a>

                                                        </td>
                                                </tr>
                                                @endif
                                                @if(!$dataFromNVisaFd9Fd1->fd9_technical_and_other_qualifications_if_any)

                                                        @else
                                                <tr>

                                                    <td>কারিগরি ও অন্যান্য যোগ্যতা যদি থাকে (প্রাসঙ্গিক সনদপত্রের কপি সংযুক্ত করতে
                                                        হবে)
                                                    </td>
                                                    <td>:


                                                        <a target="_blank" href="{{ route('nVisaDocumentDownload',['cat'=>'techQualification','id'=>$dataFromNVisaFd9Fd1->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন  </a>

                                                    </td>
                                                </tr>
                                                @endif
                                                @if(!$dataFromNVisaFd9Fd1->fd9_past_experience)

                                                        @else
                                                <tr>

                                                    <td>অতীত অভিজ্ঞতা এবং যে কাজে তাঁকে নিয়োগ দেয়া হচ্ছে তাতে তার দক্ষতা (প্রমাণকসহ)
                                                    </td>
                                                    <td>:


                                                        <a target="_blank" href="{{ route('nVisaDocumentDownload',['cat'=>'pastExperience','id'=>$dataFromNVisaFd9Fd1->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন  </a>

                                                        </td>
                                                </tr>
                                                @endif
                                                @if(!$dataFromNVisaFd9Fd1->fd9_offered_post)

                                                @else
                                                <tr>

                                                    <td>যে পদের জন্য নিয়োগ প্রস্তাব দেয়া হয়েছে : (নিয়োগপত্র কপি ও চুক্তিপত্র সংযুক্ত
                                                        করতে হবে)
                                                    </td>
                                                    <td>:


                                                        <a target="_blank" href="{{ route('nVisaDocumentDownload',['cat'=>'offeredPost','id'=>$dataFromNVisaFd9Fd1->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন  </a>
                                                         </td>
                                                </tr>
                                                @endif
                                                @if(!$dataFromNVisaFd9Fd1->fd9_name_of_proposed_project)

                                                        @else
                                                <tr>

                                                    <td>যে প্রকল্পে তাকে নিয়োগের প্রস্থাব করা হয়েছে তার নাম ও মেয়াদ ব্যুরোর অনুমোদন
                                                        পত্র সংযুক্ত করতে হবে)
                                                    </td>
                                                    <td>:


                                                        <a target="_blank" href="{{ route('nVisaDocumentDownload',['cat'=>'proposedProject','id'=>$dataFromNVisaFd9Fd1->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন  </a>
                                                         </td>
                                                </tr>
                                                @endif

                                                @if(!$dataFromNVisaFd9Fd1->fd9_foreigner_passport_size_photo)

                                                @else
                                                <tr>

                                                    <td>বিদেশি নাগরিকের পাসপোর্ট সাইজের ছবি</td>
                                                    <td>:

                                                        <img src="{{ $ins_url }}{{ $dataFromNVisaFd9Fd1->fd9_foreigner_passport_size_photo }}" alt="" style="height:40px;" id="output">


                                                    </td>
                                                </tr>
                                                @endif
                                                @if(!$dataFromNVisaFd9Fd1->fd9_copy_of_passport)

                                                        @else
                                                <tr>

                                                    <td>পাসপোর্টের কপি সংযুক্ত</td>
                                                    <td>:


                                                        <a target="_blank" href="{{ route('nVisaDocumentDownload',['cat'=>'copyOfPassport','id'=>$dataFromNVisaFd9Fd1->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন  </a>

                                                        </td>
                                                </tr>
                                                @endif
                                                @if(!$dataFromNVisaFd9Fd1->forwarding_letter)

                                                @else
                                                <tr>

                                                    <td>ফরওয়ার্ডিং লেটার</td>
                                                    <td>:


                                                        <a target="_blank" href="{{ route('nVisaDocumentDownload',['cat'=>'forwarding_letter','id'=>$dataFromNVisaFd9Fd1->nVisaId]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> Open </a>
                                                         </td>
                                                </tr>
                                                @endif
                                    </table>



                                </div>
                                <div class="card-footer text-end">

                                    <?php

                                    $checkTracking =DB::table('secruity_checks')
                                    ->where('n_visa_id',$dataFromNVisaFd9Fd1->nVisaId)->get();;

                                    ?>

                                    @if(count($checkTracking) == 0)



                                    @else




                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="pills-darkdoc1" role="tabpanel"
                    aria-labelledby="pills-darkdoc1-tab">
                   <div class="mb-0 m-t-30">

                    <div class="card">
                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-12">
                                    @if(count($checkTracking) == 0)

                                    <form id="form" class="custom-validation" action="{{ route('submitForCheck') }}"  method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $dataFromNVisaFd9Fd1->id }}" />
                                       <button class="btn btn-primary" type="submit">আবেদনপত্র জমাদিন</button>
                                   </form>

                                    @else
                                    <h1>আবেদনপত্রের স্টেটাস</h1>

                                    <table class="table table-bordered">
                                        <thead>
                                          <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">ট্র্যাকিং নম্বর</th>
                                            <th scope="col">স্ট্যাটাসের নাম</th>
                                            <th scope="col">কার্যকলাপ</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($checkTracking as $key=>$AllCheckTracking)
                                          <tr>
                                            <th scope="row">{{ $key+1 }}</th>
                                            <td>{{ $AllCheckTracking->tracking_no }}</td>
                                            <td>{{ $AllCheckTracking->statusName }}</td>
<td>
    <button  data-id = "{{ $AllCheckTracking->n_visa_id }}" class="btn btn-primary statusCheck" type="button">
        <i class="ri-add-line align-bottom me-1"></i> স্টেটাস দেখুন
    </button >
</td>
                                          </tr>
                                          @endforeach

                                        </tbody>
                                      </table>

                                    @endif
                                </div>
                                <div class="col-md-12" id="finalResult">

                                </div>

                            </div>
                        </div>
                    </div>
                   </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- Container-fluid Ends-->
@endsection

@section('script')
<script type="text/javascript">
    $(".statusCheck").click(function () {

        var mainId = $(this).attr("data-id");
        //alert(mainId);

        $.ajax({
            url: "{{ route('statusCheck') }}",
            method: 'GET',
            data: {mainId:mainId},
            success: function(data) {

              $("#finalResult").html('');
              $("#finalResult").html(data);
            }
        });



    });
</script>
<script type="text/javascript">
    var i = 0;
    $("#dynamic-ar").click(function () {
        ++i;
        $("#dynamicAddRemove").append('<tr><td><input type="text" required name="name[]" id="name'+i+'" placeholder="অনুলিপি" class="form-control" /></td><td><button type="button" class="btn btn-sm btn-outline-danger remove-input-field">মুছে ফেলুন</button></td></tr>'
            );
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });
</script>
@endsection
