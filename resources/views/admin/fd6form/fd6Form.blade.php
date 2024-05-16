<div class="mb-0 m-t-30">
    <div class="card">
        <div class="card-body">
            <div class="text-center">
                <h4>এফডি - ৬ ফরম </h4>
                <h5>প্রকল্প প্রস্তাব ফরম</h5>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered mb-4">
                <tr>
                    <td>এনজিও'র নাম</td>
                    <td>: {{ $dataFromFd6Form->ngo_name }}</td>
                </tr>
                <tr>
                    <td>ব্যুরোর নিবন্ধন তারিখ </td>
                    <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromFd6Form->ngo_registration_date) }}</td>
                </tr>
                <tr>
                    <td>সর্বশেষ নবায়ন</td>
                    <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromFd6Form->ngo_last_renew_date) }}</td>
                </tr>
                <tr>
                    <td>মেয়াদ উত্তীর্ণের তারিখ</td>
                    <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromFd6Form->ngo_expiration_date) }}</td>
                </tr>
                <tr>
                    <td>ঠিকানা</td>
                    <td>: {{ $dataFromFd6Form->ngo_address }}</td>
                </tr>
                <tr>
                    <td>টেলিফোন </td>
                    <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromFd6Form->ngo_telephone_number) }}</td>
                </tr>
                <tr>
                    <td>মোবাইল নম্বর</td>
                    <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromFd6Form->ngo_mobile_number) }}</td>
                </tr>
                <tr>
                    <td>ইমেইল ঠিকানা</td>
                    <td>: {{ $dataFromFd6Form->ngo_email_address }}</td>
                </tr>
                <tr>
                    <td>ওয়েবসাইট</td>
                    <td>: {{ $dataFromFd6Form->ngo_website }}</td>
                </tr>
                <tr>
                    <td>প্রকল্প নাম</td>
                    <td>: {{ $dataFromFd6Form->ngo_prokolpo_name }}</td>
                </tr>
                <tr>
                    <td>প্রকল্পের বিষয়</td>
                    <td>: {{ \App\Models\ProjectSubject::where('id',$dataFromFd6Form->subject_id)->value('name')}}</td>
                </tr>
                <tr>
                    <td>প্রকল্প মেয়াদ </td>
                    <td>: {{ $dataFromFd6Form->ngo_prokolpo_duration }}</td>
                </tr>
                <tr>
                    <td>আরম্ভের তারিখ </td>
                    <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromFd6Form->ngo_prokolpo_start_date) }}</td>
                </tr>
                <tr>
                    <td>সমাপ্তির তারিখ </td>
                    <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromFd6Form->ngo_prokolpo_end_date) }}</td>
                </tr>
            </table>
            <h5 class="mb-4">প্রকল্প এলাকা</h5>
            <table class="table table-bordered mb-4">
                <tr>
                    <th>বিভাগ</th>
                    <th>জেলা/সিটি কর্পোরেশন</th>
                    <th>উপজেলা/থানা/পৌরসভা/ওয়ার্ড</th>
                </tr>
                @foreach($prokolpoAreaList as $prokolpoAreaListAll)
                <tr>
                    <td>বিভাগ: {{ $prokolpoAreaListAll->division_name }}</td>
                    <td>
                        জেলা: {{ $prokolpoAreaListAll->district_name }} <br>
                        সিটি কর্পোরেশন: {{ $prokolpoAreaListAll->city_corparation_name }}
                    </td>
                    <td>
                        উপজেলা: {{ $prokolpoAreaListAll->upozila_name }} <br>
                        থানা: {{ $prokolpoAreaListAll->thana_name }} <br>
                        পৌরসভা: {{ $prokolpoAreaListAll->municipality_name }} <br>
                        ওয়ার্ড: {{ $prokolpoAreaListAll->ward_name }}
                    </td>
                </tr>
                @endforeach
            </table>
            <div class="mb-4">
                <h4>প্রাক্কলিক ব্যয় ও দাতা সংস্থার নাম : </h4>
                <h5>প্রাক্কলিক ব্যয় (টাকায়) </h5>
            </div>
            <table class="table table-bordered mb-4">
                <tr>
                    <th>অর্থের উৎসের বিবরণ:</th>
                    <th>১ম বছর</th>
                    <th>২য় বছর</th>
                    <th>৩য় বছর</th>
                    <th>৪র্থ বছর</th>
                    <th>৫ম বছর</th>
                    <th>মোট</th>
                    <th>মন্তব্য</th>
                </tr>
                <tr>
                    <td>১.বিদেশ থেকে প্রাপ্ত অনুদান (বাংলাদেশি তাকে পরিবর্তিত)</td>
                    <td>{{ $dataFromFd6Form->grants_received_from_abroad_first_year }}</td>
                    <td>{{ $dataFromFd6Form->grants_received_from_abroad_second_year }}</td>
                    <td>{{ $dataFromFd6Form->grants_received_from_abroad_third_year }}</td>
                    <td>{{ $dataFromFd6Form->grants_received_from_abroad_fourth_year }}</td>
                    <td>{{ $dataFromFd6Form->grants_received_from_abroad_fifth_year }}</td>
                    <td>{{ $dataFromFd6Form->grants_received_from_abroad_total }}</td>
                    <td>{{ $dataFromFd6Form->grants_received_from_abroad_comment }}</td>
                </tr>
                <tr>
                    <td>২.দেশে অবস্থানরত বিদেশি দাতার প্রদত্ত অনুদান </td>
                    <td>{{ $dataFromFd6Form->donations_made_by_foreign_donors_first_year }}</td>
                    <td>{{ $dataFromFd6Form->donations_made_by_foreign_donors_second_year }}</td>
                    <td>{{ $dataFromFd6Form->donations_made_by_foreign_donors_third_year }}</td>
                    <td>{{ $dataFromFd6Form->donations_made_by_foreign_donors_fourth_year }}</td>
                    <td>{{ $dataFromFd6Form->donations_made_by_foreign_donors_fifth_year }}</td>
                    <td>{{ $dataFromFd6Form->donations_made_by_foreign_donors_total }}</td>
                    <td>{{ $dataFromFd6Form->donations_made_by_foreign_donors_comment }}</td>
                </tr>
                <tr>
                    <td>৩.স্থানীয় অনুদান  (উৎসের বিস্তারিত বিবরণ ও প্রমাণকসহ)</td>
                    <td>{{ $dataFromFd6Form->local_grants_first_year }}</td>
                    <td>{{ $dataFromFd6Form->local_grants_second_year }}</td>
                    <td>{{ $dataFromFd6Form->local_grants_third_year }}</td>
                    <td>{{ $dataFromFd6Form->local_grants_fourth_year }}</td>
                    <td>{{ $dataFromFd6Form->local_grants_fifth_year }}</td>
                    <td>{{ $dataFromFd6Form->local_grants_donors_total }}</td>
                    <td>{{ $dataFromFd6Form->local_grants_donors_comment }}</td>
                </tr>
                <tr>
                    <td>মোট </td>
                    <td>{{ $dataFromFd6Form->total_first_year }}</td>
                    <td>{{ $dataFromFd6Form->total_second_year }}</td>
                    <td>{{ $dataFromFd6Form->total_third_year }}</td>
                    <td>{{ $dataFromFd6Form->total_fourth_year }}</td>
                    <td>{{ $dataFromFd6Form->total_fifth_year }}</td>
                    <td>{{ $dataFromFd6Form->total_donors_total }}</td>
                    <td>{{ $dataFromFd6Form->total_donors_comment }}</td>
                </tr>
            </table>
            <table class="table table-bordered mb-4">
                <tr>
                    <td>দাতা সংস্থার নাম</td>
                    <td>: {{ $dataFromFd6Form->donor_organization_name }}</td>
                </tr>
                <tr>
                    <td>দাতা সংস্থার ঠিকানা </td>
                    <td>: {{ $dataFromFd6Form->donor_organization_address }}</td>
                </tr>
                <tr>
                    <td>ফোন/মোবাইল/ইমেইল নম্বর </td>
                    <td>: {{ $dataFromFd6Form->donor_organization_phone_mobile_email }}</td>
                </tr>
                <tr>
                    <td>ওয়েবসাইট</td>
                    <td>: {{ $dataFromFd6Form->donor_organization_website }}</td>
                </tr>
                <tr>
                    <td>মানিলন্ডারিং এবং সন্ত্রাসে অর্থায়ন প্রতিরোধের নিমিত্ত</td>
                    <td>: {{ $dataFromFd6Form->money_laundering_and_terrorist_financing }}</td>
                </tr>
            </table>
            <h5 class="mb-3">প্রশাসনিক ব্যয় ও প্রকল্প ব্যায়ের অনুপাত:</h5>
            <table class="table table-bordered mb-3">
                <tr>
                    <td>প্রকল্প ব্যয়</td>
                    <td>{{ $dataFromFd6Form->project_cost }}</td>
                    <td>{{ $dataFromFd6Form->project_cost_ratio }}</td>
                </tr>
                <tr>
                    <td>প্রশাসনিক ব্যয়</td>
                    <td>{{ $dataFromFd6Form->administrative_cost }}</td>
                    <td>{{ $dataFromFd6Form->administrative_ratio }}</td>
                </tr>
                <tr>
                    <td>মোট</td>
                    <td>{{ $dataFromFd6Form->project_and_administrative_cost }}</td>
                    <td>{{ $dataFromFd6Form->project_and_administrative_cost_ratio }}</td>
                </tr>
            </table>
            <h5 class="mb-4">প্রকল্প এলাকাসমূহে প্রকল্পের বিস্তারিত সাইনবোর্ড প্রদর্শন বিষয়ক
                    তথ্যাদি :</h5>
            <table class="table table-bordered mb-4">
                <tr>
                    <td>প্রকল্পের নাম  </td>
                    <td>: {{ $dataFromFd6Form->project_name }}</td>
                </tr>
                <tr>
                    <td>প্রকল্পের মেয়াদকাল </td>
                    <td>: {{ $dataFromFd6Form->duration_of_project }}</td>
                </tr>
                <tr>
                    <td>প্রকল্পের মোট বরাদ্দ </td>
                    <td>: {{ $dataFromFd6Form->total_allocation_of_project }}</td>
                </tr>
                <tr>
                    <td>প্রকল্প এলাকায় মোট বরাদ্দ </td>
                    <td>: {{ $dataFromFd6Form->total_allocation_in_project_area }}</td>
                </tr>
                <tr>
                    <td> মোট উপকারভোগীর সংখ্যা </td>
                    <td>: {{ $dataFromFd6Form->total_beneficiaries }}</td>
                </tr>
                <tr>
                    <td>প্রকল্প এলাকায় মোট জনসংখ্যা </td>
                    <td>: {{ $dataFromFd6Form->total_population_in_project_area }}</td>
                </tr>
                <tr>
                    <td>দাতা সংস্থার নাম</td>
                    <td>: {{ $dataFromFd6Form->donor_organization_name_two }}</td>
                </tr>
            </table>
            <table class="table table-bordered mb-4">
                <tr>
                    <td>প্রকল্প প্রস্তাব ফরম / এফডি - ৬  পিডিএফ </td>
                    <td>:
                        <a href="{{ route('fd6PdfDownload',$dataFromFd6Form->mainId) }}" target="_blank" class="btn btn-success">দেখুন</a>

                        @if(Route::is('addChildNote') || Route::is('viewChildNote'))

                        <button  href="{{ route('fd6PdfDownload',$dataFromFd6Form->mainId) }}" class="btn btn-secondary" id="attLink1"  data-name="প্রকল্প প্রস্তাব ফরম / এফডি - ৬  পিডিএফ"><i class="fa fa-paperclip"></i></button>
                        <button  href="{{ route('fd6PdfDownload',$dataFromFd6Form->mainId) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>

                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
