<div class="mb-0 m-t-30">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">

                    <p>এফডি-০৯ পিডিএফ ডাউনলোড করুন</p>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="text-center">
                        <p>পিডিএফ ডাউনলোড</p>
                        <a class="btn btn-sm btn-success" target="_blank"
                               href = '{{ route('verified_fd_nine_download',$dataFromNVisaFd9Fd1->id) }}'>
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
                    @if($ngoTypeData->ngo_type_new_old == 'Old')
                    এ সংস্থায় (নিবন্ধন নম্বরঃ{{App\Http\Controllers\Admin\CommonController::englishToBangla($ngoTypeData->registration)}}
                    @else
                    এ সংস্থায় (নিবন্ধন নম্বরঃ{{App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromNVisaFd9Fd1->registration_number)}}
                    @endif
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
                    <td>: </td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td>@foreach($familyData as $key=>$allFamilyData)
                        ({{ App\Http\Controllers\Admin\CommonController::englishToBangla($key+1) }}) {{ $allFamilyData->family_member_name }},{{ $allFamilyData->family_member_age }}<br>
                        @endforeach</td>
                </tr>
                <tr>
                    <td>১৪.</td>
                    <td>একাডেমিক যোগ্যতা (একাডেমিক যোগ্যতার সমর্থনে সনদপত্রের কপি সংযুক্ত করতে হবে</td>
                    <td>: {{ $dataFromNVisaFd9Fd1->fd9_academic_qualification_des }},  @if(!$dataFromNVisaFd9Fd1->fd9_academic_qualification)

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
                    <td>: {{ $dataFromNVisaFd9Fd1->fd9_technical_and_other_qualifications_if_any_des }}, @if(!$dataFromNVisaFd9Fd1->fd9_technical_and_other_qualifications_if_any)

                        @else


                        <a target="_blank" href="{{ route('nVisaDocumentDownload',['cat'=>'techQualification','id'=>$dataFromNVisaFd9Fd1->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন  </a>
                         @endif</td>
                </tr>
                <tr>
                    <td>১৬.</td>
                    <td>অতীত অভিজ্ঞতা এবং যে কাজে তাঁকে নিয়োগ দেয়া হচ্ছে তাতে তার দক্ষতা (প্রমাণকসহ)
                    </td>
                    <td>: {{ $dataFromNVisaFd9Fd1->fd9_past_experience_des }}, @if(!$dataFromNVisaFd9Fd1->fd9_past_experience)

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
                    <td>: {{ $dataFromNVisaFd9Fd1->fd9_offered_post_name }}, @if(!$dataFromNVisaFd9Fd1->fd9_offered_post)

                        @else

                        <a target="_blank" href="{{ route('nVisaDocumentDownload',['cat'=>'offeredPostNiyog','id'=>$dataFromNVisaFd9Fd1->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> নিয়োগপত্র কপি  </a>
                        <a target="_blank" href="{{ route('nVisaDocumentDownload',['cat'=>'offeredPost','id'=>$dataFromNVisaFd9Fd1->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> চুক্তিপত্র কপি </a>
                         @endif</td>
                </tr>
                <tr>
                    <td>১৯.</td>
                    <td>যে প্রকল্পে তাকে নিয়োগের প্রস্থাব করা হয়েছে তার নাম ও মেয়াদ ব্যুরোর অনুমোদন
                        পত্র সংযুক্ত করতে হবে)
                    </td>
                    <td>: {{ $dataFromNVisaFd9Fd1->fd9_name_of_proposed_project_name }}, {{ $dataFromNVisaFd9Fd1->fd9_name_of_proposed_project_duration }}, @if(!$dataFromNVisaFd9Fd1->fd9_name_of_proposed_project)

                        @else


                        <a target="_blank" href="{{ route('nVisaDocumentDownload',['cat'=>'proposedProject','id'=>$dataFromNVisaFd9Fd1->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন  </a>
                         @endif</td>
                </tr>
                <tr>
                    <td>২০.</td>
                    <td>নিয়োগের যে তারিখ নির্ধারণ করা হয়েছে</td>
                    <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-m-Y', strtotime($dataFromNVisaFd9Fd1->fd9_extension_date_new))) }}, {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromNVisaFd9Fd1->fd9_date_of_appointment) }}</td>
                </tr>
                <tr>
                    <td>২১.</td>
                    <td>এক্সটেনশন হয়ে থাকলে তার সময়কাল</td>
                    <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-m-Y', strtotime($dataFromNVisaFd9Fd1->fd9_extension_date))) }}</td>
                </tr>
                <tr>
                    <td>২২.</td>
                    <td>এ প্রকল্পে কতজন বিদেশির পদের সংস্থান রয়েছে এবং কর্মরত কতজন</td>
                    <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromNVisaFd9Fd1->fd9_post_available_for_foreigner.', '.$dataFromNVisaFd9Fd1->fd9_post_available_for_foreigner_and_working )}}</td>
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

                @foreach($fdNineOtherFileList as $key=>$fdNineOtherFileLists)
                                            <tr>
                                                <td></td>
                                                <td>(২৫.{{ App\Http\Controllers\Admin\CommonController::englishToBangla($key+1) }}). {{ $fdNineOtherFileLists->file_name }}</td>
                                                <td>: <a target="_blank" href="{{ route('singlePdfDownload',$fdNineOtherFileLists->id) }}" class="btn btn-outline-success btn-sm" >
                                                    <i class="fa fa-file-pdf-o"></i> দেখুন
                                                </a></td>
                                            </tr>
                                            @endforeach
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
                            <td>তারিখঃ {{  App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-m-Y', strtotime(\Carbon\Carbon::parse($dataFromNVisaFd9Fd1->created_at)->toDateString() )))}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
