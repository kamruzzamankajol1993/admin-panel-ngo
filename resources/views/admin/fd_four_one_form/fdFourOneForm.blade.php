<div class="mb-0 m-t-30">

    <div class="card mt-3 card-custom-color">

        <div class="card-body">
            <div class="text-center">
                <h3>এফডি - ৪(১)  ফরম</h3>
                <h4 style="font-weight: 900;">সিএ ফার্ম কতৃক প্রদেয় প্রতিবেদন</h4>

            </div>
        </div>

        <div class="card-body">


            <div class="form9_upper_box">

            </div>

            @include('flash_message')

            <table class="table table-bordered">
                <tr>
                    <td>প্রকল্পের নাম</td>
                    <td>: {{ $dataFdFourOneForm->prokolpo_name }}</td>
                </tr>
                <tr>
                    <td>প্রকল্প অনুমোদনের স্বারক নং ও তারিখ</td>
                    <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFdFourOneForm->prokolpo_permission_sarok_no.' ও '.$dataFdFourOneForm->prokolpo_permission_sarok_date) }}</td>
                </tr>
                <tr>
                    <td>প্রকল্প বর্ষ</td>
                    <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFdFourOneForm->prokolpo_year) }}</td>
                </tr>
                <tr>
                    <td>ছাড়কৃত অর্থের পরিমাণ ও তারিখ (বাংলাদেশী মুদ্রায় খরচ ) </td>
                    <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFdFourOneForm->prokolpo_amount_sarkrito_bangla_amount. ' ও '.$dataFdFourOneForm->prokolpo_amount_sarkrito_date	) }}</td>
                </tr>
                <tr>
                    <td>গৃহীত অর্থের পরিমাণ ও তারিখ</td>
                    <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFdFourOneForm->prokolpo_amount_grihito. ' ও '.$dataFdFourOneForm->prokolpo_amount_grihito_date	) }}</td>
                </tr>

            </table>
            <div class="form9_upper_box mt-3 text-center">
                <h6>খরচের খাতসমূহের বিস্তারিত বিবরণ</h6>
            </div>
            <table class="table table-bordered">
                <tr>

                    <th >খরচের খাতসমূহের বিস্তারিত(প্রকল্প বিবরণ এ প্রদত্ত এফডি -৬ অনুযায়ী )</th>
                    <th >অনুমোদিত বাজেট অনুযায়ী অর্থের পরিমাণ</th>
                    <th >প্রকৃত ব্যয়</th>
                    <th >পার্থক্য </th>
                    <th >শতকরা হার (%)</th>
                    <th >পার্থক্য এর  কারণ</th>
                </tr>
                @foreach($fdFourOneFormExpenditorSector as $prokolpoAreaListAll)

                <tr>

                    <td>{{ $prokolpoAreaListAll->expenditure_sectors }}</td>
                    <td>{{ $prokolpoAreaListAll->approved_budget_money }}</td>
                    <td>{{ $prokolpoAreaListAll->actual_cost }}</td>
                    <td>{{ $prokolpoAreaListAll->difference }} </td>
                    <td>{{ $prokolpoAreaListAll->percentage }} </td>
                    <td>{{ $prokolpoAreaListAll->reason_for_the_difference	 }} </td>
                </tr>

                @endforeach
            </table>


    <div class="card mt-5">
        <div class="card-body">
            <div class="form9_upper_box  text-center">
                <h3>এফডি - ৪ ফরম </h3>
                <h4>সিএ ফার্ম কতৃক প্রদেয় প্রত্যয়নপত্র</h4>
            </div>
            <table class="table table-borderless">
                <tr>
                    <td>এনজিও'র নাম</td>
                    <td>: {{ $fdFourFormList->ngo_name }}</td>
                </tr>
                <tr>
                    <td>নিবন্ধন নম্বর</td>
                    <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($fdFourFormList->registration_number) }}</td>
                </tr>

                <tr>
                    <td>টেলিফোন </td>
                    <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($fdFourFormList->ngo_telephone) }}</td>
                </tr>

                <tr>
                    <td>ইমেইল ঠিকানা</td>
                    <td>: {{ $fdFourFormList->ngo_email }}</td>
                </tr>
                <tr>
                    <td>ওয়েবসাইট</td>
                    <td>: {{ $fdFourFormList->ngo_website }}</td>
                </tr>
                <tr>
                    <td>প্রকল্প নাম ও প্রকল্পের মেয়াদকাল</td>
                    <td>: {{ $fdFourFormList->prokolpo_name.' ও '.$fdFourFormList->prokolpo_duration_one }}</td>
                </tr>

                <tr>
                    <td>নিরীক্ষায় বিবেচ্য সময়কাল</td>
                    <td>: {{ $fdFourFormList->exam_time}}</td>
                </tr>

                <tr>
                    <td>বর্ষের প্রারম্ভিক জের</td>
                    <td>: {{ $fdFourFormList->start_balance}}</td>
                </tr>

                <tr>
                    <td>নিরীক্ষা বর্ষে গৃহীত বৈদেশিক অনুদান</td>
                    <td>: {{ $fdFourFormList->foreign_grant_taken_exam_year}}</td>
                </tr>

                <tr>
                    <td>নিরীক্ষা বর্ষে ব্যয়িত বৈদেশিক অনুদান</td>
                    <td>: {{ $fdFourFormList->foreign_grant_cost_exam_year}}</td>
                </tr>

                <tr>
                    <td>নিরীক্ষা বর্ষ শেষে অবশিষ্ট বৈদেশিক অনুদান</td>
                    <td>: {{ $fdFourFormList->foreign_grant_remaining_exam_year}}</td>
                </tr>


            </table>

        </div>
    </div>
    </div>

</div>
</div>
