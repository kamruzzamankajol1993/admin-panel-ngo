<div class="mb-0 m-t-30">

    <div class="card mt-3 card-custom-color">

        <div class="card-body">
            <div class="text-center">
                <h3>ফরম নং-৫</h3>
                <h4 style="font-weight: 900;">বার্ষিক প্রতিবেদন</h4>
               <center>
                <span>(প্রকল্প বর্ষ সমাপ্তির ০২ (দুই) মাসের মধ্যে বার্ষিক প্রতিবেদন প্রণয়ন করে এনজিও বিষয়ক ব্যুরোতে প্রদান করতে হবে)</span><br>
                <span>বার্ষিক প্রতিবেদন সংক্রান্ত প্রয়োজনীয় তথ্যাদি :</span>
            </center>
            </div>
        </div>

        <div class="card-body">


            <div class="form9_upper_box">

            </div>

            @include('flash_message')

            <table class="table table-borderless">
                <tr>
                    <td>ক. প্রকল্পের নাম</td>
                    <td>: {{ $dataFromNoFiveForm->prokolpo_name }}</td>
                </tr>
                <tr>
                    <td>খ. প্রকল্পের মোট মেয়াদকাল</td>
                    <td>: {{ $dataFromNoFiveForm->prokolpo_duration }} </td>
                </tr>

                <tr>
                    <td>গ. ব্যুরোর অনুমোদনের নম্বর ও তারিখ</td>
                    <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromNoFiveForm->ngo_registration_number.' ও '.$dataFromNoFiveForm->ngo_registration_date) }} </td>
                </tr>


                <tr>
                    <td>ঘ. অনুমোদিত প্রাক্কলিত ব্যয় (বছর ভিত্তিক)</td>
                    <td>: {{ $dataFromNoFiveForm->approved_estimated_expenditure_year_wise }}</td>
                </tr>

                <tr>
                    <td>ঙ. প্রতিবেদনকালে ছাড়কৃত অর্থের পরিমাণ</td>
                    <td>: {{ $dataFromNoFiveForm->received_money_during_report }}</td>
                </tr>

                <tr>
                    <td>চ. প্রতিবেদনকাল (প্রকল্প বর্ষ)</td>
                    <td>: {{ $dataFromNoFiveForm->report_year }}</td>
                </tr>

                <tr>
                    <td>ছ. প্রকল্পের বিবেচ্য সময়ে অর্জনের শতকরা হার</td>
                    <td>: {{ $dataFromNoFiveForm->percentage_of_achievement_during_project }}</td>
                </tr>

                <tr>
                    <td>জ. প্রতিবেদনকালে বাস্তবায়িত এলাকা</td>
                    <td>: {{ $dataFromNoFiveForm->prokolpo_araea }}</td>
                </tr>

            </table>

            <table class="table table-bordered mt-3" style="text-align: center;">
                <tr>
                    <th>জেলা</th>
                    <th>সিটি কর্পোরেশন/উপজেলা/থানা/পৌরসভা</th>
                    <th>ইউনিয়ন/ওয়ার্ড</th>
                </tr>
                @foreach($formNoFiveStepFiveArea as $key=>$prokolpoAreaListAll)
                <tr>
                    <td>{{ $prokolpoAreaListAll->district_name }}</td>
                    <td>

                        @if( $prokolpoAreaListAll->city_corparation_name == 'অনুগ্রহ করে নির্বাচন করুন')

                        @else

                        {{ $prokolpoAreaListAll->city_corparation_name  }}

                        @endif

                        /{{ $prokolpoAreaListAll->upozila_name }}/{{ $prokolpoAreaListAll->thana_name }}/{{ $prokolpoAreaListAll->municipality_name }}


                    </td>
                    <td>{{ $prokolpoAreaListAll->ward_name }}</td>
                </tr>
                @endforeach
            </table>


            <div class="card-header text-center">প্রকল্পের খাতভিত্তিক বিবরণী</div>


            <div class="table-responsive">


                <table class="table table-bordered mt-3" style="text-align: center;">
                    <tr>
                        <th rowspan="2">ক্র : নং :</th>
                        <th rowspan="2">এনেক্সার - সি এর খাত</th>
                        <th rowspan="2">খাত ওয়ারী বাজেট</th>
                        <th rowspan="2">কার্যক্রম ও লক্ষ্যমাত্রা</th>
                        <th rowspan="2">কার্যক্রম ওয়ারী বিভাজিত বাজেট</th>
                        <th rowspan="2">কার্যক্রম ভিত্তিক অর্জিত লক্ষ্যমাত্রা</th>
                        <th rowspan="2">কার্যক্রম ভিত্তিক প্রকৃত ব্যয়</th>
                        <th rowspan="2">খাতওয়ারী মোট  প্রকৃত ব্যয়</th>
                        <th colspan="2">প্রতিবেদনকাল পর্যন্ত পুঞ্জীভূত অগ্রগতি বাস্তব</th>
                        {{-- <th>প্রতিবেদনকাল পর্যন্ত পুঞ্জীভূত অগ্রগতি আর্থিক</th> --}}
                        <th rowspan="2">মন্তব্য</th>

                    </tr>
                    <tr>
                        <th>বাস্তব</th>
                        <th>আর্থিক</th>
                    </tr>
                    @foreach($formNoFiveStepTwoData as $key=>$formNoFiveStepTwoDatas)
                    <tr>
                        <td>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($key+1) }}</td>
                        <td>{{ $formNoFiveStepTwoDatas->sector_of_annexure_C }}</td>
                        <td>{{ $formNoFiveStepTwoDatas->sector_wise_budget}}</td>
                        <td>{{ $formNoFiveStepTwoDatas->activities_and_objectives}}</td>
                        <td>{{ $formNoFiveStepTwoDatas->activity_wise_segmented_budget }}</td>
                        <td>{{ $formNoFiveStepTwoDatas->activity_based_achievement_targets }}</td>
                        <td>{{ $formNoFiveStepTwoDatas->activity_based_actual_costing }}</td>
                        <td>{{ $formNoFiveStepTwoDatas->accounts_payable_total_actual_expenditure }}</td>
                        <td>{{ $formNoFiveStepTwoDatas->cumulative_progress_during_reporting_in_real }}</td>
                        <td>{{ $formNoFiveStepTwoDatas->cumulative_progress_during_reporting_in_financial }}</td>
                        <td>{{ $formNoFiveStepTwoDatas->comment }}</td>

                    </tr>
                    @endforeach
                </table>

            </div>

            <div class="card-header text-center">উপজেলা ওয়ারী প্রকল্পের আর্থিক বিবরণী (ছক-২)</div>


            <table class="table table-borderless">
                <tr>
                    <td>প্রকল্পের নাম</td>
                    <td>: {{ $dataFromNoFiveForm->prokolpo_name_one }}</td>
                </tr>
                <tr>
                    <td>প্রতিবেদনাধীন সময়</td>
                    <td>: {{ $dataFromNoFiveForm->reporting_period }} </td>
                </tr>

            </table>

            <div class="table-responsive">


                <table class="table table-bordered mt-3" style="text-align: center;">
                    <tr>
                        <th >ক্র : নং :</th>
                        <th >জেলার নাম</th>
                        <th >উপজেলার নাম</th>
                        <th >উপজেলার জন্য মোট বরাদ্দ</th>
                        <th >মোট প্রকৃত ব্যয়</th>
                        <th >মন্তব্য</th>

                    </tr>

                    @foreach($formNoFiveStepThreeData as $key=>$formNoFiveStepThreeDatass)
                    <tr>
                        <td>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($key+1) }}</td>
                        <td>{{ $formNoFiveStepThreeDatass->district_name }}</td>
                        <td>{{ $formNoFiveStepThreeDatass->upazila_name}}</td>
                        <td>{{ $formNoFiveStepThreeDatass->total_allocation_for_upazila}}</td>
                        <td>{{ $formNoFiveStepThreeDatass->total_actual_cost }}</td>
                        <td>{{ $formNoFiveStepThreeDatass->comment }}</td>

                    </tr>
                    @endforeach
                </table>

            </div>

            <div class="card-header text-center">যানবাহনসহ সংস্থার সকল স্থাবর/অস্থাবর সম্পদের পূর্ণাঙ্গ তালিকা</div>
            <div class="table-responsive">


                <table class="table table-bordered mt-3" style="text-align: center;">
                    <tr>
                        <th rowspan="2">ক্র : নং :</th>
                        <th rowspan="2">সম্পদ / সম্পত্তির বিবরণ</th>
                        <th rowspan="2">পরিমাণ /সংখ্যা</th>
                        <th rowspan="2">প্রাপ্তি/সংগ্রহের তারিখ</th>
                        <th rowspan="2">প্রকৃত ক্রয় মূল্য</th>
                        <th rowspan="2">অর্থের উৎস</th>
                        <th rowspan="2">কি কাজে ব্যবহৃত হতেছে</th>
                        <th rowspan="2">অবস্থান(স্থান)</th>
                        <th rowspan="2">বিক্রিত স্থান্তরিত সম্পদ (সংখ্যা /পরিমাণ )</th>
                        <th colspan="2">সংস্থার শুরু হতে প্রতিবেদনকাল পর্যন্ত ক্রম পুঞ্জীভূত</th>
                        <th colspan="2">বর্তমান অবস্থা</th>

                    </tr>
                    <tr>
                        <th>(সংখ্যা /পরিমাণ )</th>
                        <th>সর্বমোট ক্রয়মূল্য </th>
                        <th>সচল</th>
                        <th>অচল</th>
                    </tr>
                    @foreach($formNoFiveStepFourData as $key=>$formNoFiveStepFourDatas)
                    <tr>
                        <td>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($key+1) }}</td>
                        <td>{{ $formNoFiveStepFourDatas->description_of_property }}({{ $formNoFiveStepFourDatas->sub_property }})</td>
                        <td>{{ $formNoFiveStepFourDatas->quantity}}</td>
                        <td>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($formNoFiveStepFourDatas->collect_date)}}</td>
                        <td>{{ $formNoFiveStepFourDatas->real_buying_price }}</td>
                        <td>{{ $formNoFiveStepFourDatas->fund_source }}</td>
                        <td>{{ $formNoFiveStepFourDatas->what_is_it_used_for }}</td>
                        <td>{{ $formNoFiveStepFourDatas->place}}</td>
                        <td>{{ $formNoFiveStepFourDatas->assets_sold_transferred_number_or_quantity}}</td>
                        <td>{{ $formNoFiveStepFourDatas->quantity_during_start_of_organization }}</td>
                        <td>{{ $formNoFiveStepFourDatas->total_during_start_of_organization }}</td>
                        <td>

                            @if($formNoFiveStepFourDatas->current_status == 'সচল')
                            সচল
                            @else

                            @endif

                        </td>
                        <td>

                            @if($formNoFiveStepFourDatas->current_status == 'অচল')
                            অচল
                            @else

                            @endif

                        </td>

                    </tr>
                    @endforeach
                </table>

            </div>

            <table class="table table-borderless mt-3">
                <tr>
                    <td>* জমি/যানবাহন  যার নামে রেজিস্ট্রিকৃত তার বিস্তারিত তথ্য উল্লেখ করতে হবে</td>
                    <td>: {{ $dataFromNoFiveForm->land_and_transport_detail }}</td>
                </tr>
                <tr>
                    <td>* ব্যুরোর অনুমোদনের প্রমাণক সংযুক্ত করতে হবে</td>
                    <td>:

                        <a target="_blank"  href="{{ route('formNoFiveRetaltedPdf',['title'=>'approval_file_of_Bureau','id'=>base64_encode($dataFromNoFiveForm->mainId)]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন</a>


                        @if(Route::is('addChildNote') || Route::is('viewChildNote'))

                        <button  href="{{ route('formNoFiveRetaltedPdf',['title'=>'approval_file_of_Bureau','id'=>base64_encode($dataFromNoFiveForm->mainId)]) }}" class="btn btn-secondary" id="attLink1"  data-name="ব্যুরোর অনুমোদনের প্রমাণক"><i class="fa fa-paperclip"></i></button>
                        <button  href="{{ route('formNoFiveRetaltedPdf',['title'=>'approval_file_of_Bureau','id'=>base64_encode($dataFromNoFiveForm->mainId)]) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>

                        @endif



                    </td>
                </tr>

            </table>

            <div class="card-header text-center">সংস্থার কর্মকর্তা ও কর্মচারীদের বিদেশ ভ্রমণের বিবরণ</div>

            <div class="table-responsive">

                <table class="table table-bordered mt-3" style="text-align: center;">
                    <tr>
                        <th rowspan="2">ক্র : নং :</th>
                        <th rowspan="2">কর্মকর্তা কর্মচারীর নাম ও পদবি</th>
                        <th rowspan="2">যোগদানের তারিখ</th>
                        <th rowspan="2">যে দেশ ভ্রমণ করেছে তার নাম</th>
                        <th rowspan="2">সভা, প্রশিক্ষণ সেমিনার আয়োজনকারী প্রতিষ্ঠানের নাম ও ঠিকানা</th>
                        <th rowspan="2">প্রশিক্ষণ কোর্সের নাম</th>
                        <th rowspan="2">কোর্সের মেয়াদ</th>

                        <th rowspan="2">মোট ব্যয়</th>
                        <th colspan="2">ব্যয়ের উৎস</th>
                        {{-- <th >ব্যয়ের উৎস (দাতা সংস্থার দেশ)</th> --}}

                    </tr>
                    <tr>
                        <th colspan="2">দাতা সংস্থার নাম,দেশ</th>
                    </tr>
                    @foreach($formNoFiveStepFiveData as $key=>$formNoFiveStepFiveDatas)
                    <tr>
                        <td>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($key+1) }}</td>
                        <td>{{ $formNoFiveStepFiveDatas->name_of_the_officer }}({{ $formNoFiveStepFiveDatas->designation_of_the_officer }})</td>
                        <td>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($formNoFiveStepFiveDatas->joining_date)}}</td>
                        <td>{{ $formNoFiveStepFiveDatas->travel_country}}</td>
                        <td>{{ $formNoFiveStepFiveDatas->organizing_organization_name }}({{ $formNoFiveStepFiveDatas->organizing_organization_address }})</td>
                        <td>{{ $formNoFiveStepFiveDatas->name_of_training_course }}</td>
                        <td>{{ $formNoFiveStepFiveDatas->course_duration }}</td>
                        <td>{{ $formNoFiveStepFiveDatas->total_expense}}</td>
                        <td>{{ $formNoFiveStepFiveDatas->name_of_donor_organization}}</td>
                        <td>{{ $formNoFiveStepFiveDatas->country_name_of_donor_organization }}</td>


                    </tr>
                    @endforeach
                </table>

            </div>

            <table class="table table-borderless mt-3">
                <tr>
                    <td>* সভা, সেমিনার, কর্মশালা,সম্মেলন ইত্যাদিও প্রশিক্ষণ হিসাবে গণ্য হবে</td>
                    <td>: {{ $dataFromNoFiveForm->foreign_tour_detail }}</td>
                </tr>
                <tr>
                    <td>* দাপ্তরিক কাজে বিদেশ ভ্রমণ শেষে ভ্রমণের অর্জন উল্লেখপূর্বক প্রতিবেদন দাখিলের প্রমাণক সংযুক্ত করতে হবে</td>
                    <td>:

                        <a target="_blank"  href="{{ route('formNoFiveRetaltedPdf',['title'=>'foreign_tour_file','id'=>base64_encode($dataFromNoFiveForm->id)]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন </a>


                        @if(Route::is('addChildNote') || Route::is('viewChildNote'))

                        <button  href="{{ route('formNoFiveRetaltedPdf',['title'=>'foreign_tour_file','id'=>base64_encode($dataFromNoFiveForm->mainId)]) }}" class="btn btn-secondary" id="attLink1"  data-name="দাপ্তরিক কাজে বিদেশ ভ্রমণ শেষে ভ্রমণের অর্জন উল্লেখপূর্বক প্রতিবেদন"><i class="fa fa-paperclip"></i></button>
                        <button  href="{{ route('formNoFiveRetaltedPdf',['title'=>'foreign_tour_file','id'=>base64_encode($dataFromNoFiveForm->mainId)]) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>

                        @endif
                    </td>
                </tr>

            </table>

            <p style="font-weight:900;margin-top:15px;">২৫০০০/- (পঁচিশ হাজার ) টাকার উর্ধ্বে (পরবর্তীতে ন্যূনতম করমুক্ত আয়সীমার সাথে সমন্বয় সাপেক্ষে ) মাসিক বেতন গ্রহণকারী কর্মকর্তা - কর্মচারীদের বিবরণ :</p>

            <div class="table-responsive">

                <table class="table table-bordered mt-3" style="text-align: center;">
                    <tr>
                        <th>ক্র : নং :</th>
                        <th >কর্মকর্তা/কর্মচারীর নাম ও জাতীয়তা(দেশি /বিদেশি)</th>
                        <th >পদবি ও দায়িত্ব </th>
                        <th >শিক্ষাগত যোগ্যতা ও অভিজ্ঞতা</th>
                        <th >বয়স</th>
                        <th >বেতন</th>
                        <th >অন্যান্য ভাতা/সুবিধাদি</th>

                        <th >সংস্থায় চাকুরীর মেয়াদ</th>
                        <th >অন্য কোনো প্রকল্প থেকে/গৃহীত আর্থিক বা অন্যান্য সুবিধার বর্ণনা</th>
                        <th >মন্তব্য</th>

                    </tr>

                    @foreach($formNoFiveStepFiveOther as $key=>$formNoFiveStepFiveDatas)
                    <tr>
                        <td>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($key+1) }}</td>
                        <td>{{ $formNoFiveStepFiveDatas->name_of_the_officer_depend_on_salary }} ও {{ $formNoFiveStepFiveDatas->nationality_of_the_officer_depend_on_salary }}</td>
                        <td>{{ $formNoFiveStepFiveDatas->designation_of_the_officer_depend_on_salary}} ও {{ $formNoFiveStepFiveDatas->responsbility_of_the_officer_depend_on_salary}}</td>
                        <td>{{ $formNoFiveStepFiveDatas->education_of_the_officer_depend_on_salary}} ও {{ $formNoFiveStepFiveDatas->experience_of_the_officer_depend_on_salary}}</td>
                        <td>{{ $formNoFiveStepFiveDatas->age_of_the_officer_depend_on_salary }}</td>
                        <td>{{ $formNoFiveStepFiveDatas->salary_of_the_officer_depend_on_salary }}</td>
                        <td>{{ $formNoFiveStepFiveDatas->other_allowances_or_benefits_of_the_officer_depend_on_salary }}</td>
                        <td>{{ $formNoFiveStepFiveDatas->job_duration_of_the_officer_depend_on_salary}}</td>
                        <td>{{ $formNoFiveStepFiveDatas->financial_benefit_received_from_any_other_scheme}}</td>
                        <td>{{ $formNoFiveStepFiveDatas->comment }}</td>


                    </tr>
                    @endforeach
                </table>


            </div>

            <table class="table table-borderless mt-3">

                <tr>
                    <td style="text-align: left;">

                        <table style=" margin-top: 15px;width:100%">

                            <tr>
                                <td style="text-align: left;" ><img  src="{{ $ins_url }}{{ $dataFromNoFiveForm->report_preparar_sign }}"/></td>
                            </tr>
                            <tr>
                                <td style="text-align: left;" >{{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromNoFiveForm->report_preparar_date) }}</td>
                            </tr>
                            <tr>
                                <td style="text-align: left;" ><img  src="{{ $ins_url }}{{ $dataFromNoFiveForm->report_preparar_seal }}"/></td>
                            </tr>
                            <tr>
                                <td style="text-align: left;padding-top:15px;" >রিপোর্ট প্রুস্তুতকারীর স্বাক্ষর ও সিল :</td>
                            </tr>
                        </table>

                    </td>
                    <td></td>
                    <td style="text-align: right;">


                        <table style=" margin-top: 15px;width:100%">

                            <tr>
                                <td style="text-align: right;" ><img  src="{{ $ins_url }}{{ $dataFromNoFiveForm->digital_signature }}"/></td>
                            </tr>
                            <tr>
                                <td style="text-align: right;" >{{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromNoFiveForm->report_preparar_date) }}</td>
                            </tr>
                            <tr>
                                <td style="text-align: right;" ><img  src="{{ $ins_url }}{{ $dataFromNoFiveForm->digital_seal }}"/></td>
                            </tr>
                            <tr>
                                <td style="text-align: right;padding-top:15px;" >   এনজিও প্রধানের স্বাক্ষর ও সিল : :</td>
                            </tr>
                        </table>

                    </td>
                </tr>

            </table>

        </div>
    </div>

</div>
