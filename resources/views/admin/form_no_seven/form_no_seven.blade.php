<div class="mb-0 m-t-30">

    <div class="card mt-3 card-custom-color">

        <div class="card-body">
        <div class="form9_upper_box" style="text-align: center;">
            <h3>ফরম নং - ৭<br>
                <span style="font-size:12px;">[আবশ্যিকভাবে বাংলা নিকোস ফন্টে পূরণ করে দাখিল করতে হবে]</span><br>
                <span style="font-size: 14px;font-weight:normal;">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</span>
            </h3>
                <h4 style="font-size: 14px;">
                    জেলা প্রশাসকের কার্যালয়, <span style="font-weight:bold;">{{ $dataFromNoSevenForm->district_address }}</span>/উপজেলা নির্বাহী অফিসারের কার্যালয়, <span style="font-weight:bold;">{{ $dataFromNoSevenForm->upazila_address }}<span></h4>
                <h4 style="font-size: 14px;">প্রকল্প বাস্তবায়ন সম্পর্কিত প্রত্যয়নপত্রের </h4>
        </div>

        <div class="row">
            <div class="col-lg-4 col-sm-4">

                <table class="table table-borderless">

                    <tr>
                        <td>স্মারক নং: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromNoSevenForm->sarok_number) }}</td>

                    </tr>

                </table>
            </div>
            <div class="col-lg-4 col-sm-4">

                <table class="table table-borderless text-center" style="">

                    <tr>
                        <td style="font-weight:900;font-size:15px;">'ছক'</td>

                    </tr>

                </table>
            </div>
            <div class="col-lg-4 col-sm-4">

                <table class="table table-borderless" style="text-align: right;">

                    <tr>
                        <td>তারিখ: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromNoSevenForm->submit_date) }}</td>

                    </tr>

                </table>
            </div>
        </div>

        <!-- step one start -->

        <div class="row">
            <div class="col-lg-12 col-sm-12">


                <table class="table table-bordered " style="width:100%">

                    <tr>
                        <th style="text-align: center;" colspan="2">ক্র: নং:</th>
                        <th style="text-align: center; width: 25%">বিবরণ</th>
                        <th style="text-align: center;">তথ্যাদি</th>
                        <th style="text-align: center;"> মন্তব্য (যদি থাকে)</th>
                    </tr>

                    <tr>
                        <th style="text-align: center;" colspan="2">(০১)</th>
                        <th>এনজিও সংক্রান্ত তথ্য <span style="text-align: center;">(০২)</span></th>
                        <th style="text-align: center;">(০৩)</th>
                        <th style="text-align: center;">(০৪)</th>
                    </tr>
                  <!-- step one start  -->
                    <tr>
                        <td style="text-align: center;" rowspan="4">০১.</td>
                        <td style="text-align: center;">ক)</td>
                        <td> এনজিও'র নাম ও ঠিকানা  </td>
                        <td>{{ $dataFromNoSevenForm->ngo_name }}, {{ $dataFromNoSevenForm->ngo_address }}</td>
                        <td>{{ $dataFromNoSevenForm->ngo_name_address_comment }}</td>
                    </tr>
                    <tr>

                        <td style="text-align: center;">খ)</td>
                        <td> এনজিও প্রধানের নাম, পদবি, দাপ্তরিক মোবাইল নম্বর ও ইমেইল এড্রেস </td>
                        <td>{{ $dataFromNoSevenForm->ngo_head_name }}, {{ $dataFromNoSevenForm->ngo_head_organization }}, {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromNoSevenForm->ngo_head_office_mobile) }}, {{ $dataFromNoSevenForm->ngo_head_office_email }}</td>
                        <td>{{ $dataFromNoSevenForm->ngo_head_comment }}</td>
                    </tr>

                    <tr>

                        <td style="text-align: center;">গ)</td>
                        <td>

                            <span>১. এনজিও'র নিবন্ধন নম্বর ও তারিখ <br>

                                ২. সর্বশেষ নবায়নের তারিখ ও মেয়াদকাল
                        </span>

                    </td>
                        <td>


                            <span>১. {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromNoSevenForm->ngo_registration) }}, {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromNoSevenForm->ngo_registration_date) }}<br>

                            ২.  {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromNoSevenForm->ngo_last_renewal_date) }}, {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromNoSevenForm->ngo_duration) }}
                    </span>


                        </td>
                        <td>{{ $dataFromNoSevenForm->ngo_reg_comment }}</td>
                    </tr>

                    <tr>

                        <td style="text-align: center;">ঘ)</td>
                        <td>জেলা/আঞ্চলিক  অফিসের দায়িত্বপ্রাপ্ত এনজিও কর্মকর্তার নাম, পদবি, দাপ্তরিক মোবাইল নম্বর ও ইমেইল এড্রেস </td>
                        <td>{{ $dataFromNoSevenForm->ngo_local_officer_name }}, {{ $dataFromNoSevenForm->ngo_local_officer_designation }}, {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromNoSevenForm->ngo_local_officer_mobile) }},{{ $dataFromNoSevenForm->ngo_local_officer_email }}</td>
                        <td>{{ $dataFromNoSevenForm->ngo_local_officer_comment }}</td>
                    </tr>
                    <!-- step one end -->

                    <!-- step two strat --->

                    <tr>
                        <td style="text-align: center;" rowspan="7">০২.</td>
                        <td></td>
                        <td style="font-weight:bold;">প্রকল্প সংক্রান্ত তথ্য</td>
                        <td></td>
                        <td></td>
                    </tr>

                    <tr>

                        <td style="text-align: center;">ক)</td>
                        <td><span>১. প্রকল্পের নাম <br>

                            ২.  মেয়াদকাল <br>
                            ৩.  টাকার পরিমাণ
                    </span></td>
                        <td>


                            <span>১. {{ $dataFromNoSevenForm->prokolpo_name }}<br>

                            ২. {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromNoSevenForm->prokolpo_duration) }} <br>
                            ৩. {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromNoSevenForm->prokolpo_fund) }}
                    </span>



                        </td>
                        <td>{{ $dataFromNoSevenForm->prokolpo_comment }}</td>
                    </tr>
                    <tr>

                        <td style="text-align: center;">খ)</td>
                        <td>প্রকল্প অনুমোদনের তারিখ ও স্মারক নম্বর, প্রত্যয়নপত্র প্রদানের বছর / সময়  </td>
                        <td>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromNoSevenForm->prokolpo_approval_date) }}, {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromNoSevenForm->prokolpo_sarok_number) }}, {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromNoSevenForm->prokolpo_certificate_year_and_time) }}</td>
                        <td>{{ $dataFromNoSevenForm->prokolpo_approval_comment }}</td>
                    </tr>

                    <tr>

                        <td style="text-align: center;">গ)</td>
                        <td>প্রকল্পের উদ্দেশ্য </td>
                        <td>{{ $dataFromNoSevenForm->prokolpo_objecttive }}</td>
                        <td>{{ $dataFromNoSevenForm->prokolpo_objecttive_comment }}</td>
                    </tr>

                    <tr>

                        <td style="text-align: center;">ঘ)</td>
                        <td>জেলা/উপজেলায় ব্যুরো কতৃক অনুমোদিত প্রকল্পের কপি স্থানীয় প্রশাসন কতৃক গ্রহণের তারিখ </td>
                        <td>{{ $dataFromNoSevenForm->project_copy_approved_by_burea }}</td>
                        <td>{{ $dataFromNoSevenForm->project_copy_approved_by_burea_comment }}</td>
                    </tr>

                    <tr>

                        <td style="text-align: center;">ঙ)</td>
                        <td style="font-weight:bold;">তার এখতিয়ারাধীন এলাকার সংশ্লিষ্ট তথ্য </td>
                        <td></td>
                        <td></td>
                    </tr>

                    <tr>

                        <td></td>
                        <td><span>১. তাঁর জেলা/উপজেলায় প্রকল্পের জন্য বরাদ্দ <br>

                            ২.  বহুবর্ষী প্রকল্পের ক্ষেত্রে আলোচ্য বর্ষে বরাদ্দ <br>
                            ৩.  বহুবর্ষী প্রকল্পের ক্ষেত্রে আলোচ্য বর্ষে প্রকৃত ব্যয় <br>
                            ৪. প্রকল্পে উপকারভোগীর সংখ্যা <br>
                            <span style="padding-left: 10px;">ক. প্রত্যক্ষ উপকারভোগীর সংখ্যা <br>
                                <span style="padding-left: 10px;">খ. পরোক্ষ উপকারভোগীর সংখ্যা(প্রযোজ্য ক্ষেত্রে)</span>
                            </span>

                    </span></td>
                        <td>


                            <span>১.  {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromNoSevenForm->allocation_for_projects_in_district_or_upazila) }}<br>

                            ২.   {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromNoSevenForm->this_year_under_discussion_multi_year_projects) }}<br>
                            ৩.   {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromNoSevenForm->actual_expenditure_multi_year_projects) }}<br>
                            ৪. প্রকল্পে উপকারভোগীর সংখ্যা <br>
                            <span style="padding-left: 10px;">ক.  {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromNoSevenForm->direct_beneficiaries_quantity) }}<br>
                                <span style="padding-left: 10px;">খ.  {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromNoSevenForm->indirect_beneficiaries_quantity) }}</span>
                            </span>

                    </span>

                        </td>
                        <td>{{ $dataFromNoSevenForm->jurisdiction_comment }}</td>
                    </tr>



                    <!-- step two end --->

                    <!-- step three start -->

                    <tr>
                        <td style="text-align: center;" rowspan="5">০৩.</td>
                        <td></td>
                        <td style="font-weight:bold;">জেলা প্রশাসন/উপজেলা প্রশাসন সংক্রান্ত</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>

                        <td style="text-align: center;">ক)</td>
                        <td><span>১. স্থানীয় প্রশাসন কতৃক কত বার প্রকল্পটি পরিদর্শন করা হয়েছে  <br>

                            ২.  পরিদর্শনকারী কর্মকর্তার নাম, পদবি, মোবাইল নম্বর ও ইমেইল এড্রেস
                    </span></td>
                        <td>

                            <span>১. {{ $dataFromNoSevenForm->project_inspected_time }} <br>

                            ২. {{ $dataFromNoSevenForm->inspector_name }}, {{ $dataFromNoSevenForm->inspector_designation }}, {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromNoSevenForm->inspector_mobile) }}, {{ $dataFromNoSevenForm->inspector_email }}
                    </span>

                        </td>
                        <td>{{ $dataFromNoSevenForm->inspector_comment }}</td>
                    </tr>
                    <tr>

                        <td style="text-align: center;">খ)</td>
                        <td>উপকারভোগী নির্বাচনে স্থানীয় প্রশাসনকে সম্পৃক্ত করা হয়েছে কিনা, হয়ে থাকলে তার সংক্ষিপ্ত বিবরণী </td>
                        <td>{{ $dataFromNoSevenForm->beneficiaries_involved_with_local_administration }}</td>
                        <td>{{ $dataFromNoSevenForm->beneficiaries_involved_comment }}</td>
                    </tr>

                    <tr>

                        <td style="text-align: center;">গ)</td>
                        <td>এনজিও প্রতিনিধি জেলা/উপজেলায় এনজিও বিষয়ক সমন্বয় সভায় নিয়মিত অংশগ্রহণ করেন কিনা </td>
                        <td>{{ $dataFromNoSevenForm->regular_participation_in_meeting }}</td>
                        <td>{{ $dataFromNoSevenForm->regular_participation_comment }}</td>
                    </tr>

                    <tr>

                        <td style="text-align: center;">ঘ)</td>
                        <td>এনজিও বিষয়ক ব্যুরোর অনুমোদন পত্রের শর্তাদি যথাযথভাবে প্রতিপালিত হয়েছে কিনা </td>
                        <td>{{ $dataFromNoSevenForm->conditions_properly_met }}</td>
                        <td>{{ $dataFromNoSevenForm->conditions_properly_comment }}</td>
                    </tr>

                    <!-- step three end -->

                    <!-- step four start --->

                    <tr>
                        <td style="text-align: center;" rowspan="2">০৪.</td>
                        <td></td>
                        <td>পার্টনার এনজিও হলে মূল এনজিও বিষয়ক তথ্যাদি (প্রযোজ্য ক্ষেত্রে)</td>
                        <td>{{ $dataFromNoSevenForm->mian_ngo_detail }}</td>
                        <td>{{ $dataFromNoSevenForm->main_ngo_detail_comment }}</td>
                    </tr>

                    <tr>

                        <td></td>
                        <td>মূল এনজিও'র নাম ও ঠিকানা</td>
                        <td>{{ $dataFromNoSevenForm->main_ngo_name }}, {{ $dataFromNoSevenForm->main_ngo_address }}</td>
                        <td>{{ $dataFromNoSevenForm->main_ngo_comment }}</td>
                    </tr>


                    <!-- steap four end -->

                    <!-- step five start -->

                    <tr>
                        <td style="text-align: center;" rowspan="2">০৫.</td>
                        <td></td>
                        <td style="font-weight:bold;">প্রকল্পের অর্জিত লক্ষ্যমাত্রা বিষয়ক</td>
                        <td></td>
                        <td></td>
                    </tr>

                    <tr>

                        <td style="text-align: center;">ক)</td>
                        <td>প্রকল্প সমাপনী প্রতিবেদন /বার্ষিক প্রতিবেদনে জেলা প্রশাসক/উপজেলা নির্বাহী অফিসারের প্রতিস্বাক্ষর গ্রহণ করা হয়েছে কিনা </td>
                        <td>{{ $dataFromNoSevenForm->sign_in_closing_report }}</td>
                        <td>{{ $dataFromNoSevenForm->sign_in_closing_report_comment }}</td>
                    </tr>

                    <!-- step five end --->

                    <!-- step six start -->

                    <tr>
                        <td style="text-align: center;" rowspan="2">০৬.</td>
                        <td></td>
                        <td>
                            <span>১. বাস্তবায়িত প্রকল্প সম্পর্কে মতামত <br>

                                ২.  বাস্তবায়িত প্রকল্প সম্পর্কে সুপারিশ (প্রত্যয়নকারী কর্মকর্তার স্বহস্তে লিখা কাম্য)
                        </span>
                        </td>
                        <td>

                            <span>১. {{ $dataFromNoSevenForm->feedback_on_projects_implementedt }}<br>

                                ২.  {{ $dataFromNoSevenForm->recommendation_on_projects_implementedt }}
                        </span>

                        </td>
                        <td>{{ $dataFromNoSevenForm->last_comment }}</td>
                    </tr>

                    <!-- step six end -->

                </table>



                <table class="table table-borderless mt-3">

                    <tr>
                        <td style="text-align: center;width: 25%">

                            <span style="text-align: center;"><span style="font-weight:900;">মহাপরিচালক (গ্রেড -১)</span><br>
                                এনজিও বিষয়ক ব্যুরো<br>
                                প্রধানমন্ত্রীর কার্যালয়<br>
                                প্লট -ই, ১৩-বি, আগারগাঁও<br>
                                শেরে বংলা নগর,ঢাকা -১২০৭</span>
<p style="font-weight:900;margin-top:15px;">অনুলিপি :{{ $dataFromNoSevenForm->onulipi }}</p>

                        </td>
                        <td style="text-align: center;width: 52%">
                        </td>
                        <td style="text-align: center;width: 23%">

                            <table style=" margin-top: 15px;width:100%">
                                <tr>
                                    <td style="text-align: center;" >{{ $dataFromNoSevenForm->name_certifying_officer }}</td>
                                </tr>
                                <tr>
                                    <td style="text-align: center;" >{{ $dataFromNoSevenForm->designation_certifying_officer }}</td>
                                </tr>

                                <tr>
                                    <td style="text-align: center;" ><img  src="{{ $ins_url }}{{ $dataFromNoSevenForm->signature_certifying_officer }}"/></td>
                                </tr>
                                <tr>
                                    <td style="text-align: center;" >{{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromNoSevenForm->submit_date) }}</td>
                                </tr>
                                <tr>
                                    <td style="text-align: center;" ><img  src="{{ $ins_url }}{{ $dataFromNoSevenForm->seal_certifying_officer }}"/></td>
                                </tr>
                                <tr>
                                    <td style="text-align: center;padding-top:15px;" >প্রত্যয়নকারি কর্মকর্তার নাম ও পদবি (সিলযুক্ত)</td>
                                </tr>
                            </table>

                        </td>
                        <td></td>

                    </tr>

                </table>







            </div>
        </div>
        <!-- step one end --->
    </div>

    </div>

</div>
