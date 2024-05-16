<div class="mb-0 m-t-30">
    <div class="card">
        <div class="card-body">
            <div class="text-center">
                <h4>এফডি - ৭ ফরম</h4>
                <h5>দুর্যোগকালীন ও দুর্যোগ পরবর্তী জরুরি ত্রাণ সহায়তা কার্যক্রম/ প্রকল্প প্রস্তাব ফরম</h5>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered mb-4">
                <tr>
                    <td>এনজিও'র নাম</td>
                    <td>: {{ $dataFromFd7Form->ngo_name }}</td>
                </tr>
                <tr>
                    <td>ঠিকানা</td>
                    <td>: {{ $dataFromFd7Form->ngo_address }}</td>
                </tr>
                <tr>
                    <td>প্রকল্পের বিষয়</td>
                    <td>: {{ \App\Models\ProjectSubject::where('id',$dataFromFd7Form->subject_id)->value('name')}}</td>
                </tr>
                <tr>
                    <td>নিবন্ধন নম্বর</td>
                    <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromFd7Form->ngo_registration_number) }}</td>
                </tr>
                <tr>
                    <td>ব্যুরোর নিবন্ধন তারিখ </td>
                    <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromFd7Form->ngo_registration_date) }}</td>
                </tr>
                <tr>
                    <td>প্রস্তাবিত প্রকল্পের নাম</td>
                    <td>: {{ $dataFromFd7Form->ngo_prokolpo_name }}</td>
                </tr>
            </table>


                <h5 class="mb-4">অর্থ বা ত্রাণ-সামগ্রীর উৎস <br>
                    দাতা সংস্থার প্রতিশ্রুতিপত্র</h5>

                    <table class="table table-bordered mb-4">
                        <tr>
                            <td>দাতা সংস্থার বিবরণ</td>
                            <td>: {{ $dataFromFd7Form->donor_organization_description }}</td>
                        </tr>
                        <tr>
                            <td>প্রধান নির্বাহী কর্মকর্তা/ দাতা</td>
                            <td>: {{ $dataFromFd7Form->donor_organization_chief_type }}</td>
                        </tr>

                        <tr>
                            <td>নাম</td>
                            <td>: {{ $dataFromFd7Form->donor_organization_chief_name }}</td>
                        </tr>
                        <tr>
                            <td>দাতা সংস্থার নাম</td>
                            <td>: {{ $dataFromFd7Form->donor_organization_name }}</td>
                        </tr>
                        <tr>
                            <td>যোগাযোগগের ঠিকানা</td>
                            <td>: {{ $dataFromFd7Form->donor_organization_address }}</td>
                        </tr>

                        <tr>
                            <td>টেলিফোন</td>
                            <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromFd7Form->donor_organization_phone) }}</td>
                        </tr>


                        <tr>
                            <td>ইমেইল</td>
                            <td>: {{ $dataFromFd7Form->donor_organization_email }}</td>
                        </tr>

                        <tr>
                            <td>ওয়েবসাইট</td>
                            <td>: {{ $dataFromFd7Form->donor_organization_website }}</td>
                        </tr>
                    </table>

                        <h5 class="mb-4">দাতা সংস্থার প্রতিশ্রুতিপত্র</h5>


                    <table class="table table-bordered">
                        <tr>
                            <td>চলমান প্রকল্পের নাম</td>
                            <td>: {{ $dataFromFd7Form->ongoing_prokolpo_name }}</td>
                        </tr>
                        <tr>
                            <td>মোট ব্যায়</td>
                            <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromFd7Form->total_prokolpo_cost) }}</td>
                        </tr>

                        <tr>
                            <td>ব্যুরোর অনুমোদনের তারিখ</td>
                            <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromFd7Form->date_of_bureau_approval) }}</td>
                        </tr>
                        <tr>
                            <td>অনুমোদনপত্র সংযুক্ত করতে হবে</td>
                            <td>:
                                <a href="{{ route('authorizationLetter',$dataFromFd7Form->id) }}" target="_blank" class="btn btn-success">দেখুন</a>

                                @if(Route::is('addChildNote') || Route::is('viewChildNote'))

                                <button  href="{{ route('authorizationLetter',$dataFromFd7Form->id) }}" class="btn btn-secondary" id="attLink1"  data-name="অনুমোদনপত্র সংযুক্ত করতে হবে"><i class="fa fa-paperclip"></i></button>
                                <button  href="{{ route('authorizationLetter',$dataFromFd7Form->id) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>

                                @endif


                            </td>
                        </tr>
                        <tr>
                            <td>মূল প্রকল্পের শতকরা কতভাগ এই প্রকল্পের ব্যায় করা হয়</td>
                            <td>: {{ $dataFromFd7Form->percentage_of_the_original_project }}</td>
                        </tr>

                        <tr>
                            <td>চলমান প্রকল্পের উপর কোন বিরূপ প্রভাব ফেলবে কি না</td>
                            <td>: {{ $dataFromFd7Form->adverse_impact_on_the_ongoing_project }}</td>
                        </tr>


                        <tr>
                            <td>দাতা সংস্থার প্রতিশ্রুতিপত্র (কপি সংযুক্ত করতে হবে)</td>
                            <td>:

                                <a href="{{ route('letterFromDonorAgency',$dataFromFd7Form->id) }}" target="_blank" class="btn btn-success">দেখুন</a>

                                @if(Route::is('addChildNote') || Route::is('viewChildNote'))

                                <button  href="{{ route('letterFromDonorAgency',$dataFromFd7Form->id) }}" class="btn btn-secondary" id="attLink1"  data-name="দাতা সংস্থার প্রতিশ্রুতিপত্র (কপি সংযুক্ত করতে হবে)"><i class="fa fa-paperclip"></i></button>
                                <button  href="{{ route('letterFromDonorAgency',$dataFromFd7Form->id) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>

                                @endif

                            </td>
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
                        ওয়ার্ড: {{ $prokolpoAreaListAll->ward_name }} <br>
                        বরাদ্দকৃত বাজেট: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($prokolpoAreaListAll->allocated_budget) }} <br>
            উপকারভোগীর সংখ্যা: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($prokolpoAreaListAll->number_of_beneficiaries) }}
                    </td>
                </tr>
                @endforeach
            </table>
            <div class="mb-4">

                <h5>কার্যক্রমের মেয়াদকাল</h5>
            </div>

            <table class="table table-bordered mb-4">
                <tr>
                    <td>আরম্ভের তারিখ</td>
                    <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromFd7Form->ngo_prokolpo_start_date) }}</td>
                </tr>
                <tr>
                    <td>সমাপ্তির তারিখ</td>
                    <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromFd7Form->ngo_prokolpo_end_date) }}</td>
                </tr>

            </table>


            <table class="table table-bordered mb-4">
                <tr>
                    <td>দুর্যোগকালীন ও দুর্যোগ পরবর্তী জরুরি ত্রাণ সহায়তা কার্যক্রম/ প্রকল্প প্রস্তাব ফরম পিডিএফ  / এফডি -৭ ফরম</td>
                    <td>:

                        <a href="{{ route('reliefAssistanceProjectProposalPdf',$dataFromFd7Form->id) }}" target="_blank" class="btn btn-success">দেখুন</a>

                        @if(Route::is('addChildNote') || Route::is('viewChildNote'))

                        <button  href="{{ route('reliefAssistanceProjectProposalPdf',$dataFromFd7Form->id) }}" class="btn btn-secondary" id="attLink1"  data-name="দুর্যোগকালীন ও দুর্যোগ পরবর্তী জরুরি ত্রাণ সহায়তা কার্যক্রম/ প্রকল্প প্রস্তাব ফরম পিডিএফ  / এফডি -৭ ফরম"><i class="fa fa-paperclip"></i></button>
                        <button  href="{{ route('reliefAssistanceProjectProposalPdf',$dataFromFd7Form->id) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>

                        @endif

                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
