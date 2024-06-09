<div class="mb-0 m-t-30">

    <div class="card mt-3 card-custom-color">

        <div class="card-body">
            <div class="text-center">
                <h3>ফরম নং-৪</h3>
                <h4 style="font-weight: 900;">মাসিক অগ্রগতি প্রতিবেদন</h4>

            </div>
        </div>

        <div class="card-body">


            <div class="form9_upper_box">

            </div>

            @include('flash_message')

            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <td>সংস্থার নাম : </td>
                        <td>{{ $dataFromNoFourForm->ngo_name }}</td>
                    </tr>

                    <tr>
                        <td>প্রকল্পের নাম ও মেয়াদকাল: </td>
                        <td>{{ $dataFromNoFourForm->prokolpo_name }} ও {{ $dataFromNoFourForm->prokolpo_duration }}</td>
                    </tr>

                    <tr>
                        <td>প্রকল্প অনুমোদন পত্র নং ও তারিখ</td>
                        <td>{{ $dataFromNoFourForm->prokolpo_permission_no }} ও {{ $dataFromNoFourForm->prokolpo_date }}</td>
                    </tr>

                    <tr>
                        <td>প্রতিবেদনকালীন সময়: </td>
                        <td>{{ $dataFromNoFourForm->prokolpo_report_time }}</td>
                    </tr>

                    <tr>
                        <td>মোট প্রকল্প ব্যয় : </td>
                        <td>{{ $dataFromNoFourForm->prokolpo_total_cost }}</td>
                    </tr>

                    <tr>
                        <td>এ এলাকার জন্য বরাদ্দের পরিমাণ : </td>
                        <td>{{ $dataFromNoFourForm->allocation_amount }}</td>
                    </tr>

                    <tr>
                        <td>জেলা/উপজেলা  ভিত্তিক মোট ব্যয়: </td>
                        <td>{{ $dataFromNoFourForm->district_upazila_wise_total_expenditure }}</td>
                    </tr>

                    <tr>
                        <td>জেলা /উপজেলা ভিত্তিক বার্ষিক বরাদ্দ : </td>
                        <td>{{ $dataFromNoFourForm->district_upazila_wise_annual_allocation }}</td>
                    </tr>

                    <tr>
                        <td>প্রকল্প এলাকায় প্রকল্পের সাইনবোর্ড প্রদর্শিত হয়েছে কিনা : </td>
                        <td>{{ $dataFromNoFourForm->sign_board_avaiable_or_not }}</td>
                    </tr>



                </table>
                </div>

                <div class="table-responsive">


                    <table class="table table-bordered text-center mt-5" id="dynamicAddRemove">
                        <tr>

                            <th rowspan="2">কর্ম এলাকা</th>
                            <th rowspan="2">খাতের বিবরণ</th>
                            <th colspan="2">লক্ষ্যমাত্রা</th>
                            <th colspan="2">অর্জন</th>
                            <th rowspan="2">পুঞ্জীভূত অর্জন</th>
                            <th rowspan="2">মন্তব্য</th>

                        </tr>
                        <tr>
                            <th>বাস্তব </th>
                            <th>আর্থিক</th>
                            <th>বাস্তব </th>
                            <th>আর্থিক</th>
                        </tr>
@foreach($formFourAreaList as $key=>$formFourAreaLists)
                        <tr>
                            <td>{{$formFourAreaLists->work_area }}</td>
                            <td>{{ $formFourAreaLists->sector_detail }}</td>
                            <td>{{ $formFourAreaLists->target_real }}</td>
                            <td>{{ $formFourAreaLists->target_financial }}</td>
                            <td>{{ $formFourAreaLists->achievement_real }}</td>
                            <td>{{$formFourAreaLists->achievement_financial }}</td>
                            <td>{{ $formFourAreaLists->comulative_achievement }}</td>
                            <td>{{ $formFourAreaLists->comment }}</td>



                        </tr>
                        @endforeach

                    </table>


        </div>
    </div>

</div>
</div>
