<div class="mb-0 m-t-30">
    <div class="card">
        <div class="card-body">
            <div class="text-center">
                <h4>এফডি - ৩ ফরম</h4>
                <h5>পূর্বপর্তি বছরের অর্থগ্রহনের বিবরণী ফরম</h5>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered mb-4">
                <tr>
                    <td>এনজিও'র নাম</td>
                    <td>: {{ $dataFromFd3Form->ngo_name }}</td>
                </tr>
                <tr>
                    <td>ঠিকানা</td>
                    <td>: {{ $dataFromFd3Form->ngo_address }}</td>
                </tr>

                <tr>
                    <td>নিবন্ধন নম্বর</td>
                    <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromFd3Form->ngo_registration_number) }}</td>
                </tr>
                <tr>
                    <td>ব্যুরোর নিবন্ধন তারিখ </td>
                    <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromFd3Form->ngo_registration_date) }}</td>
                </tr>
                <tr>
                    <td>প্রস্তাবিত প্রকল্পের নাম</td>
                    <td>: {{ $dataFromFd3Form->ngo_prokolpo_name }}</td>
                </tr>

                <tr>
                    <td>প্রকল্পের মেয়াদ</td>
                    <td>: {{ $dataFromFd3Form->ngo_prokolpo_duration }}</td>
                </tr>

                <tr>
                    <td>প্রকল্প অনুমোদনপত্র ও অর্থছাড়পত্রের স্মারক নম্বর</td>
                    <td>: {{ $dataFromFd3Form->project_approval_exemption_letter_memo_number }}</td>
                </tr>

                <tr>
                    <td>প্রকল্প অনুমোদনপত্র ও অর্থছাড়পত্রের স্মারক তারিখ</td>
                    <td>: {{ $dataFromFd3Form->project_approval_exemption_letter_date }}</td>
                </tr>

                <tr>
                    <td>পূর্বপর্তি বছরে অর্থছাড়ের পরিমান</td>
                    <td>: {{ $dataFromFd3Form->exemption_amount_in_previous_year }}</td>
                </tr>

                <tr>
                    <td>পূর্ববর্তী বছরে দাতা সংস্থা হতে গৃহীত অর্থের পরিমান</td>
                    <td>: {{ $dataFromFd3Form->money_received_in_the_previous_year }}</td>
                </tr>

            </table>


                <h5 class="mb-4">অর্থগ্রহনের বিস্তারিত বিবরণ</h5>

                    <table class="table table-bordered mb-4">
                        <tr>
                            <td>অর্থগ্রহনের তারিখ</td>
                            <td>: {{ $dataFromFd3Form->date_of_payment }}</td>
                        </tr>
                        <tr>
                            <td>বৈদেশিক অনুদানের ধরণ (এককালীন/বহুবর্ষী)</td>
                            <td>: {{ $dataFromFd3Form->type_of_foreign_grant }}</td>
                        </tr>

                        <tr>
                            <td>বৈদেশিক অনুদানের পরিমান (বৈদেশিক মুদ্রা)</td>
                            <td>: {{ $dataFromFd3Form->foreign_grant_amount }}</td>
                        </tr>
                        <tr>
                            <td>বৈদেশিক অনুদানের পরিমান (দেশীয় মুদ্রা)</td>
                            <td>: {{ $dataFromFd3Form->local_grant_amount }}</td>
                        </tr>
                        <tr>
                            <td>যদি সামগ্রী হয় তবে সামগ্রীর বিবরণ ও মূল্য (দেশীয় মুদ্রায়)</td>
                            <td>: {{ $dataFromFd3Form->description_and_price_of_goods }}</td>
                        </tr>
                    </table>

                        <h5 class="mb-4">যে বৈদেশিক উৎস থেকে অনুদান গ্রহণ করা হবে তার বিবরণ<br>
                            ব্যক্তির ক্ষেত্রে</h5>


                    <table class="table table-bordered">
                        <tr>
                            <td>পূর্ণ নাম</td>
                            <td>: {{ $dataFromFd3Form->foreigner_donor_full_name }}</td>
                        </tr>
                        <tr>
                            <td>পেশা</td>
                            <td>: {{ $dataFromFd3Form->foreigner_donor_occupation }}</td>
                        </tr>

                        <tr>
                            <td>যোগাযোগের ঠিকানা</td>
                            <td>: {{ $dataFromFd3Form->foreigner_donor_address }}</td>
                        </tr>
                        <tr>
                            <td>টেলিফোন</td>
                            <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromFd3Form->foreigner_donor_telephone_number) }}</td>
                        </tr>
                        <tr>
                            <td>ফ্যাক্স</td>
                            <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromFd3Form->foreigner_donor_fax) }}</td>
                        </tr>

                        <tr>
                            <td>ইমেইল নম্বর</td>
                            <td>: {{ $dataFromFd3Form->foreigner_donor_email }}</td>
                        </tr>


                        <tr>
                            <td>জাতীয়তা/নাগরিকত্ব</td>
                            <td>: {{ $dataFromFd3Form->foreigner_donor_nationality }}</td>
                        </tr>

                        <tr>
                            <td>মানিলন্ডারিং এবং সন্ত্রাসে অর্থায়ন প্রতিরোধে নিমিত্ত United Nations Security Council’s Resolution (UNSCR) কর্তৃক প্রকাশিত তালিকার সংগে দাতার তথ্য যাচাই করা হয়েছে কিনা</td>
                            <td>: {{ $dataFromFd3Form->foreigner_donor_is_verified }}</td>
                        </tr>


                        <tr>
                            <td>উক্ত তালিকাভুক্ত ব্যক্তি/ ব্যক্তিবর্গ/ সংস্থার সাথে দাতার সংশ্লিষ্টতা আছে কিনা</td>
                            <td>: {{ $dataFromFd3Form->foreigner_donor_is_affiliatedrict }}</td>
                        </tr>



                    </table>


            <h5 class="mb-4">যে বৈদেশিক উৎস থেকে অনুদান গ্রহণ করা হবে তার বিবরণ<br>
                সংস্থা ক্ষেত্রে</h5>
            <table class="table table-bordered mb-4">
                <tr>
                    <td>সংস্থার নাম</td>
                    <td>: {{ $dataFromFd3Form->organization_name }}</td>
                </tr>
                <tr>
                    <td>অফিস/ সংস্থার ঠিকানা</td>
                    <td>: {{ $dataFromFd3Form->organization_address }}</td>
                </tr>

                <tr>
                    <td>টেলিফোন</td>
                    <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromFd3Form->organization_telephone_number) }}</td>
                </tr>
                <tr>
                    <td>ফ্যাক্স নম্বর</td>
                    <td>: {{ $dataFromFd3Form->organization_fax }}</td>
                </tr>
                <tr>
                    <td>ইমেইল</td>
                    <td>: {{ $dataFromFd3Form->organization_email }}</td>
                </tr>

                <tr>
                    <td>ওয়েবসাইট</td>
                    <td>: {{ $dataFromFd3Form->organization_website }}</td>
                </tr>




                <tr>
                    <td>মানিলন্ডারিং এবং সন্ত্রাসে অর্থায়ন প্রতিরোধে নিমিত্ত United Nations Security Council’s Resolution (UNSCR) কর্তৃক প্রকাশিত তালিকার সংগে দাতার তথ্য যাচাই করা হয়েছে কিনা</td>
                    <td>: {{ $dataFromFd3Form->organization_is_verified }}</td>
                </tr>


                <tr>
                    <td>উক্ত তালিকাভুক্ত ব্যক্তি/ ব্যক্তিবর্গ/ সংস্থার সাথে দাতার সংশ্লিষ্টতা আছে কিনা</td>
                    <td>: {{ $dataFromFd3Form->relation_with_donor }}</td>
                </tr>

                <tr>
                    <td>প্রধান নির্বাহী কর্মকর্তার নাম</td>
                    <td>: {{ $dataFromFd3Form->organization_ceo_name }}</td>
                </tr>

                <tr>
                    <td>প্রধান নির্বাহী কর্মকর্তার পদবি</td>
                    <td>: {{ $dataFromFd3Form->organization_ceo_designation }}</td>
                </tr>

                <tr>
                    <td>উর্দ্ধতন কর্মকর্তার (০১) নাম</td>
                    <td>: {{ $dataFromFd3Form->organization_senior_officer_name_one }}</td>
                </tr>

                <tr>
                    <td>উর্দ্ধতন কর্মকর্তার (০১) পদবি</td>
                    <td>: {{ $dataFromFd3Form->organization_senior_officer_designation_one }}</td>
                </tr>


                <tr>
                    <td>উর্দ্ধতন কর্মকর্তার (০২) নাম</td>
                    <td>: {{ $dataFromFd3Form->organization_senior_officer_name_two }}</td>
                </tr>

                <tr>
                    <td>উর্দ্ধতন কর্মকর্তার (০২) পদবি</td>
                    <td>: {{ $dataFromFd3Form->organization_senior_officer_designation_two }}</td>
                </tr>



                <tr>
                    <td>বাংলাদেশের জন্য দায়িত্ব প্রাপ্ত নির্বাহীর নাম</td>
                    <td>: {{ $dataFromFd3Form->organization_name_of_executive_responsible_for_bd }}</td>
                </tr>

                <tr>
                    <td>বাংলাদেশের জন্য দায়িত্ব প্রাপ্ত নির্বাহীর পদবি</td>
                    <td>: {{ $dataFromFd3Form->organization_name_of_executive_responsible_for_bd_designation }}</td>
                </tr>


                <tr>
                    <td>সংস্থার উদ্দেশ্যসমূহ</td>
                    <td>: {{ $dataFromFd3Form->objectives_of_the_organization }}</td>
                </tr>

                <tr>
                    <td>আবেদনকারী এনজিও ও দাতা সংস্থার মধ্যে যোগাযোগ মাধ্যম</td>
                    <td>: {{ $dataFromFd3Form->communication_between_NGO_and_donor }}</td>
                </tr>
            </table>
            <div class="mb-4">

                <h5>সংস্থার মাদার একাউন্ট সংক্রান্ত তথ্যাবলী</h5>
            </div>

            <table class="table table-bordered mb-4">
                <tr>
                    <td>যে ব্যাংকের মাধ্যমে বৈদেশিক অনুদান গ্রহণ করতে ইচ্ছুক তার নাম</td>
                    <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromFd3Form->bank_name) }}</td>
                </tr>
                <tr>
                    <td>ঠিকানা</td>
                    <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromFd3Form->bank_address) }}</td>
                </tr>

                <tr>
                    <td>ব্যাংক হিসাবের নাম</td>
                    <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromFd3Form->bank_account_name) }}</td>
                </tr>

                <tr>
                    <td>ব্যাংক হিসাব নম্বর</td>
                    <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromFd3Form->bank_account_number) }}</td>
                </tr>

            </table>


            <table class="table table-bordered">
                <tr>
                    <td>পূর্বপর্তি বছরের অর্থগ্রহনের বিবরণী ফরম / এফডি - ৩ ফরম</td>
                    <td>:

                        <a href="{{ route('verified_fd_three_form',$dataFromFd3Form->id) }}" target="_blank" class="btn btn-success">দেখুন</a>

                        @if(Route::is('addChildNote') || Route::is('viewChildNote'))

                        <button  href="{{ route('verified_fd_three_form',$dataFromFd3Form->id) }}" class="btn btn-secondary" id="attLink1"  data-name="পূর্বপর্তি বছরের অর্থগ্রহনের বিবরণী ফরম / এফডি - ৩ ফরম"><i class="fa fa-paperclip"></i></button>
                        <button  href="{{ route('verified_fd_three_form',$dataFromFd3Form->id) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>

                        @endif
                    </td>
                </tr>
            </table>



        </div>
    </div>
</div>
