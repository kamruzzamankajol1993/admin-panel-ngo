<div class="mb-0 m-t-30">
    <div class="card">
        <div class="card-body">
            <div class="text-center">
                <h4>এফসি-২ ফরম</h4>
                <h5>ব্যক্তি কর্তৃক বৈদেশিক অনুদানে গৃহীত প্রকল্প প্রস্তাব ফরম</h5>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered mb-4">
                <tr>
                    <td>পূর্ণ নাম</td>
                    <td>: {{ $dataFromFc2Form->person_full_name }}</td>
                </tr>
                <tr>
                    <td>পিতার নাম</td>
                    <td>: {{ $dataFromFc2Form->person_father_name }}</td>
                </tr>

                <tr>
                    <td>মাতার নাম</td>
                    <td>: {{ $dataFromFc2Form->person_mother_name }}</td>
                </tr>
                <tr>
                    <td>পেশা</td>
                    <td>: {{ $dataFromFc2Form->person_occupation }}</td>
                </tr>
                <tr>
                    <td>জাতীয় পরিচয়পত্র নম্বর</td>
                    <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromFc2Form->person_nid) }}</td>
                </tr>

                <tr>
                    <td>পাসপোর্ট নম্বর (যদি থাকে)</td>
                    <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromFc2Form->person_passport) }}</td>
                </tr>

                <tr>
                    <td>টি আই এন নম্বর</td>
                    <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromFc2Form->person_tin) }}</td>
                </tr>


                <tr>
                    <td>জাতীয়তা/ নাগরিকত্ব</td>
                    <td>: {{ $dataFromFc2Form->person_nationality }}</td>
                </tr>

                <tr>
                    <td>পূর্ণ ঠিকানা</td>
                    <td>: {{ $dataFromFc2Form->person_full_address }}</td>
                </tr>


                <tr>
                    <td>টেলিফোন</td>
                    <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromFc2Form->person_tele_phone_number) }}</td>
                </tr>


                <tr>
                    <td>মোবাইল</td>
                    <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromFc2Form->person_mobile) }}</td>
                </tr>

                <tr>
                    <td>ইমেইল</td>
                    <td>: {{ $dataFromFc2Form->person_email }}</td>
                </tr>
            </table>


                <h5 class="mb-4">প্রকল্পের মেয়াদ</h5>

                    <table class="table table-bordered mb-4">
                        <tr>
                            <td>প্রকল্পের বিষয়</td>
                            <td>: {{ \App\Models\ProjectSubject::where('id',$dataFromFc2Form->subject_id)->value('name')}}</td>
                        </tr>
                        <tr>
                            <td>আরম্ভের তারিখ</td>
                            <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromFc2Form->ngo_prokolpo_start_date) }}</td>
                        </tr>
                        <tr>
                            <td>সমাপ্তির তারিখ</td>
                            <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromFc2Form->ngo_prokolpo_end_date) }}</td>
                        </tr>
                    </table>

                        <h5 class="mb-4">কর্ম এলাকা ও বাজেট</h5>


                    <table class="table table-bordered">
                        <tr>
                            <td>কর্ম এলাকা জেলা</td>
                            <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromFc2Form->ngo_district) }}</td>
                        </tr>
                        <tr>
                            <td>কর্ম এলাকা উপজেলা</td>
                            <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromFc2Form->ngo_sub_district) }}</td>
                        </tr>

                        <tr>
                            <td>মোট উপকারভোগীর সংখ্যা</td>
                            <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromFc2Form->total_number_of_beneficiaries) }}</td>
                        </tr>



                    </table>


            <h5 class="mb-4">যে বৈদেশিক উৎস থেকে অনুদান গ্রহণ করা হবে তার বিবরণ<br>
                ব্যক্তির ক্ষেত্রে</h5>
            <table class="table table-bordered mb-4">
                <tr>
                    <td>পূর্ণ নাম</td>
                    <td>: {{ $dataFromFc2Form->foreigner_donor_full_name }}</td>
                </tr>
                <tr>
                    <td>পেশা</td>
                    <td>: {{ $dataFromFc2Form->foreigner_donor_occupation }}</td>
                </tr>

                <tr>
                    <td>যোগাযোগের ঠিকানা</td>
                    <td>: {{ $dataFromFc2Form->foreigner_donor_address }}</td>
                </tr>
                <tr>
                    <td>টেলিফোন</td>
                    <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromFc2Form->foreigner_donor_telephone_number) }}</td>
                </tr>
                <tr>
                    <td>ফ্যাক্স</td>
                    <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromFc2Form->foreigner_donor_fax) }}</td>
                </tr>

                <tr>
                    <td>ইমেইল নম্বর</td>
                    <td>: {{ $dataFromFc2Form->foreigner_donor_email }}</td>
                </tr>


                <tr>
                    <td>জাতীয়তা/নাগরিকত্ব</td>
                    <td>: {{ $dataFromFc2Form->foreigner_donor_nationality }}</td>
                </tr>

                <tr>
                    <td>মানিলন্ডারিং এবং সন্ত্রাসে অর্থায়ন প্রতিরোধে নিমিত্ত United Nations Security Council’s Resolution (UNSCR) কর্তৃক প্রকাশিত তালিকার সংগে দাতার তথ্য যাচাই করা হয়েছে কিনা</td>
                    <td>: {{ $dataFromFc2Form->foreigner_donor_is_verified }}</td>
                </tr>


                <tr>
                    <td>উক্ত তালিকাভুক্ত ব্যক্তি/ ব্যক্তিবর্গ/ সংস্থার সাথে দাতার সংশ্লিষ্টতা আছে কিনা</td>
                    <td>: {{ $dataFromFc2Form->foreigner_donor_is_affiliatedrict }}</td>
                </tr>
            </table>
            <div class="mb-4">

                <h5>যে বৈদেশিক উৎস থেকে অনুদান গ্রহণ করা হবে তার বিবরণ<br>
                    সংস্থা ক্ষেত্রে</h5>
            </div>

            <table class="table table-bordered mb-4">
                <tr>
                    <td>সংস্থার নাম</td>
                    <td>: {{ $dataFromFc2Form->organization_name }}</td>
                </tr>
                <tr>
                    <td>অফিস/ সংস্থার ঠিকানা</td>
                    <td>: {{ $dataFromFc2Form->organization_address }}</td>
                </tr>

                <tr>
                    <td>টেলিফোন</td>
                    <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromFc2Form->organization_telephone_number) }}</td>
                </tr>
                <tr>
                    <td>ফ্যাক্স নম্বর</td>
                    <td>: {{ $dataFromFc2Form->organization_fax }}</td>
                </tr>
                <tr>
                    <td>ইমেইল</td>
                    <td>: {{ $dataFromFc2Form->organization_email }}</td>
                </tr>

                <tr>
                    <td>ওয়েবসাইট</td>
                    <td>: {{ $dataFromFc2Form->organization_website }}</td>
                </tr>




                <tr>
                    <td>মানিলন্ডারিং এবং সন্ত্রাসে অর্থায়ন প্রতিরোধে নিমিত্ত United Nations Security Council’s Resolution (UNSCR) কর্তৃক প্রকাশিত তালিকার সংগে দাতার তথ্য যাচাই করা হয়েছে কিনা</td>
                    <td>: {{ $dataFromFc2Form->organization_is_verified }}</td>
                </tr>


                <tr>
                    <td>উক্ত তালিকাভুক্ত ব্যক্তি/ ব্যক্তিবর্গ/ সংস্থার সাথে দাতার সংশ্লিষ্টতা আছে কিনা</td>
                    <td>: {{ $dataFromFc2Form->relation_with_donor }}</td>
                </tr>

                <tr>
                    <td>প্রধান নির্বাহী কর্মকর্তার নাম</td>
                    <td>: {{ $dataFromFc2Form->organization_ceo_name }}</td>
                </tr>

                <tr>
                    <td>প্রধান নির্বাহী কর্মকর্তার পদবি</td>
                    <td>: {{ $dataFromFc2Form->organization_ceo_designation }}</td>
                </tr>

                <tr>
                    <td>বাংলাদেশের জন্য দায়িত্ব প্রাপ্ত নির্বাহীর নাম</td>
                    <td>: {{ $dataFromFc2Form->organization_name_of_executive_responsible_for_bd }}</td>
                </tr>

                <tr>
                    <td>বাংলাদেশের জন্য দায়িত্ব প্রাপ্ত নির্বাহীর পদবি</td>
                    <td>: {{ $dataFromFc2Form->organization_name_of_executive_responsible_for_bd_designation }}</td>
                </tr>


                <tr>
                    <td>সংস্থার উদ্দেশ্যসমূহ</td>
                    <td>: {{ $dataFromFc2Form->objectives_of_the_organization }}</td>
                </tr>

                <tr>
                    <td>প্রতিশ্রুতিপত্র আছে কিনা</td>
                    <td>: {{ $dataFromFc2Form->organization_letter_of_commitment }}</td>
                </tr>

                <tr>
                    <td>কাজের নাম, অর্থের পরিমান ও মেয়াদকাল সুস্পষ্টভাবে উল্লেখপূর্বক কপি সংযুক্ত করতে হবে</td>
                    <td>:
                        <a href="{{ route('fc2PdfDownload',$dataFromFc2Form->id) }}" target="_blank" class="btn btn-success">দেখুন</a>

                        @if(Route::is('addChildNote') || Route::is('viewChildNote'))

                        <button  href="{{ route('fc2PdfDownload',$dataFromFc2Form->id) }}" class="btn btn-secondary" id="attLink1"  data-name="কাজের নাম, অর্থের পরিমান ও মেয়াদকাল সুস্পষ্টভাবে উল্লেখপূর্বক কপি সংযুক্ত করতে হবে"><i class="fa fa-paperclip"></i></button>
                        <button  href="{{ route('fc2PdfDownload',$dataFromFc2Form->id) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>

                        @endif
                    </td>
                </tr>

            </table>

            <div class="mb-4">

                <h5>অনুদানের বিস্তারিত বিবরণ</h5>
            </div>

            <table class="table table-bordered">
                <tr>
                    <td>বৈদেশিক মুদ্রার পরিমান</td>
                    <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromFc2Form->organization_amount_of_foreign_currency) }}</td>
                </tr>
                <tr>
                    <td>সমপরিমাণ বাংলাদেশী টাকা</td>
                    <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromFc2Form->equivalent_amount_of_bd_taka) }}</td>
                </tr>

                <tr>
                    <td>পণ্যসামগ্রী (বাংলাদেশী মুদ্রায় আনুমানিক মূল্য)</td>
                    <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromFc2Form->commodities_value_in_bangladeshi_currency) }}</td>
                </tr>




            </table>

            <div class="mb-4">

                <h5>ব্যাংক সংক্রান্ত তথ্যাবলী</h5>
            </div>

            <table class="table table-bordered">
                <tr>
                    <td>যে ব্যাংকের মাধ্যমে বৈদেশিক অনুদান গ্রহণ করতে ইচ্ছুক তার নাম</td>
                    <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromFc2Form->bank_name) }}</td>
                </tr>
                <tr>
                    <td>ঠিকানা</td>
                    <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromFc2Form->bank_address) }}</td>
                </tr>

                <tr>
                    <td>ব্যাংক হিসাবের নাম</td>
                    <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromFc2Form->bank_account_name) }}</td>
                </tr>

                <tr>
                    <td>ব্যাংক হিসাব নম্বর</td>
                    <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromFc2Form->bank_account_number) }}</td>
                </tr>


            </table>


            <table class="table table-bordered">
                <tr>
                    <td>ব্যক্তি কর্তৃক বৈদেশিক অনুদানে গৃহীত প্রকল্প প্রস্তাব ফরম / এফসি-২ ফরম</td>
                    <td>:

                        <a href="{{ route('verified_fc_two_form',$dataFromFc2Form->id) }}" target="_blank" class="btn btn-success">দেখুন</a>

                        @if(Route::is('addChildNote') || Route::is('viewChildNote'))

                        <button  href="{{ route('verified_fc_two_form',$dataFromFc2Form->id) }}" class="btn btn-secondary" id="attLink1"  data-name="ব্যক্তি কর্তৃক বৈদেশিক অনুদানে গৃহীত প্রকল্প প্রস্তাব ফরম / এফসি-২ ফরম"><i class="fa fa-paperclip"></i></button>
                        <button  href="{{ route('verified_fc_two_form',$dataFromFc2Form->id) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>

                        @endif
                    </td>
                </tr>
            </table>

        </div>
    </div>
</div>
