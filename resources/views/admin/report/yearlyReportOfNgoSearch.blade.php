@extends('admin.master.master')

@section('title')
এনজিও'র  নিবন্ধনের বার্ষিক রিপোর্ট | {{ $ins_name }}
@endsection


@section('css')

@endsection

@section('body')
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <h3>এনজিও'র  নিবন্ধনের বার্ষিক রিপোর্ট</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">হোম</a></li>
                    <li class="breadcrumb-item">রিপোর্ট</li>
                    <li class="breadcrumb-item">এনজিও'র  নিবন্ধনের বার্ষিক রিপোর্ট</li>
                </ol>
            </div>
            <div class="col-sm-6">
            </div>
        </div>
    </div>
</div>

<div class="row">

    <div class="col-sm-12">
        <div class="card">

            <div class="card-body">

                <form method="get" action="{{ route('yearlyReportOfNgoSearch') }}">
                    <div class="row">
                        <div class="col-sm-4">
                            <label>হইতে</label>
                            <select class="form-control" name="from_year_name" required>
                                <option value="">-- বছর নির্বাচন করুন --</option>
                                <option value="2020" {{ $from_year_name == '2020' ? 'selected':''}}>২০২০</option>
                                <option value="2021" {{ $from_year_name == '2021' ? 'selected':''}}>২০২১</option>
                                <option value="2022" {{ $from_year_name == '2022' ? 'selected':''}}>২০২২</option>
                                <option value="2023" {{ $from_year_name == '2023' ? 'selected':''}}>২০২৩</option>
                                <option value="2024" {{ $from_year_name == '2024' ? 'selected':''}}>২০২৪</option>
                                <option value="2025" {{ $from_year_name == '2025' ? 'selected':''}}>২০২৫</option>
                                <option value="2026" {{ $from_year_name == '2026' ? 'selected':''}}>২০২৬</option>
                                <option value="2027" {{ $from_year_name == '2027' ? 'selected':''}}>২০২৭</option>
                                <option value="2028" {{ $from_year_name == '2028' ? 'selected':''}}>২০২৮</option>
                                <option value="2029" {{ $from_year_name == '2029' ? 'selected':''}}>২০২৯</option>
                                <option value="2030" {{ $from_year_name == '2030' ? 'selected':''}}>২০৩০</option>
                            </select>
                        </div>

                        <div class="col-sm-4">
                            <label>পর্যন্ত</label>
                            <select class="form-control" name="to_year_name">
                                <option value="">-- বছর নির্বাচন করুন --</option>
                                <option value="2020" {{ $to_year_name == '2020' ? 'selected':''}}>২০২০</option>
                                <option value="2021" {{ $to_year_name == '2021' ? 'selected':''}}>২০২১</option>
                                <option value="2022" {{ $to_year_name == '2022' ? 'selected':''}}>২০২২</option>
                                <option value="2023" {{ $to_year_name == '2023' ? 'selected':''}}>২০২৩</option>
                                <option value="2024" {{ $to_year_name == '2024' ? 'selected':''}}>২০২৪</option>
                                <option value="2025" {{ $to_year_name == '2025' ? 'selected':''}}>২০২৫</option>
                                <option value="2026" {{ $to_year_name == '2026' ? 'selected':''}}>২০২৬</option>
                                <option value="2027" {{ $to_year_name == '2027' ? 'selected':''}}>২০২৭</option>
                                <option value="2028" {{ $to_year_name == '2028' ? 'selected':''}}>২০২৮</option>
                                <option value="2029" {{ $to_year_name == '2029' ? 'selected':''}}>২০২৯</option>
                                <option value="2030" {{ $to_year_name == '2030' ? 'selected':''}}>২০৩০</option>
                            </select>
                        </div>


                        <div class="col-sm-4">
                            <label>এনজিও'র  ধরন</label>
                            <select class="form-control" name="ngo_type" required>
                                <option value="">-- নির্বাচন করুন --</option>
                                <option value="সকল" {{ $ngoType == 'সকল' ? 'selected':''}}>সকল</option>
                                <option value="দেশি" {{ $ngoType == 'দেশি' ? 'selected':''}}>দেশি</option>
                                <option value="বিদেশী" {{ $ngoType == 'বিদেশী' ? 'selected':''}}>বিদেশী</option>
                            </select>
                        </div>


                        <div class="col-sm-12 mt-3">
                            <div class="text-end">
                            <button type="submit" class="btn btn-primary">অনুসন্ধান করুন</button>
                        </div>
                        </div>

                    </div>
    </form>

            </div>

        </div>

    </div>

</div>

<!-- Container-fluid starts-->
<div class="container-fluid list-products">
    <div class="row">
        <!-- Individual column searching (text inputs) Starts-->

        <div class="col-sm-12">

        </div>

        <div class="col-sm-12"  >
            <div class="card">

                <div class="card-body">


                       <!-- new print button-->


                       @if(empty($to_year_name))

                       <a href="{{ route('yearlyReportOfNgoSearchPrint',['fromYear'=>$from_year_name,'toYear'=>0,'type'=>$ngoType]) }}" class="btn btn-primary waves-effect  btn-sm waves-light" type="button" >
                         <i class="far fa-calendar-plus  mr-2"></i> প্রিন্ট করুন
                     </a>
                       @else
                 <a href="{{ route('yearlyReportOfNgoSearchPrint',['fromYear'=>$from_year_name,'toYear'=>$to_year_name,'type'=>$ngoType]) }}" class="btn btn-primary waves-effect  btn-sm waves-light" type="button" >
                     <i class="far fa-calendar-plus  mr-2"></i> প্রিন্ট করুন
                 </a>

                 @endif
                <!-- end new print button -->

                    <div class="table-responsive product-table mt-3" >

                        <table class="display" id="basic-1">
                            <thead>
                            <tr>
                                <th>ক্র: নং:</th>
                                <th>নিবন্ধন নম্বর</th>
                                <th>এনজিওর নাম ও ঠিকানা</th>
                                <th>দেশ</th>
                                <th>নিবন্ধনের তারিখ</th>
                                <th>নিবন্ধন/নবায়নের মেয়াদ</th>
                                <th>এনজিওর অবস্থা</th>
                            </tr>
                            </thead>
                            <tbody id="searchTable">

                                <?php  $i = 1; ?>

                                @foreach($monthlyReportOfNgo as $allFdOneDatas)

                                <?php

                                $ngoAllDataFirst = DB::table('ngo_type_and_languages')
                                                             ->where('user_id',$allFdOneDatas->user_id)
                                                             ->first();



                                $ngoOldNew = DB::table('ngo_type_and_languages')
                                                             ->where('user_id',$allFdOneDatas->user_id)
                                                             ->value('ngo_type_new_old');

                                                             $getngoForLanguageNewO = DB::table('ngo_type_and_languages')
                                                             ->where('user_id',$allFdOneDatas->user_id)->value('registration');

                                ?>
                                @if($ngoOldNew == 'Old')


                                    <?php
                                $mainCheckAll = DB::table('ngo_renews')
                                                             ->where('fd_one_form_id',$allFdOneDatas->id)
                                                             ->value('status');


                                ?>


                                @else
                                <?php
                                $mainCheckAll = DB::table('ngo_statuses')
                                                             ->where('fd_one_form_id',$allFdOneDatas->id)
                                                             ->value('status');

                                ?>

                                @endif



                                <tr>
                                    <td>{{ $i++}}</td>
                                    <td>
                                        @if($ngoOldNew == 'Old')
                                        #{{ App\Http\Controllers\Admin\CommonController::englishToBangla($getngoForLanguageNewO) }}
                                        @else

                                    @if($allFdOneDatas->registration_number == 0)

                                        #{{ App\Http\Controllers\Admin\CommonController::englishToBangla($allFdOneDatas->registration_number_given_by_admin) }}
                                        @else
                                        #{{ App\Http\Controllers\Admin\CommonController::englishToBangla($allFdOneDatas->registration_number) }}
                                        @endif
                                @endif

                                    </td>




                                    <td><h6>
                                         {{ $allFdOneDatas->organization_name_ban  }}<br>

                                    </h6><span>ঠিকানা: {{ $allFdOneDatas->organization_address }}</td>


                                          <td>
                                            <?php


                                            $districtName = DB::table('countries')
                                            ->where('id',$allFdOneDatas->district_id)
                                            ->value('country_name_bangla');
                                ?>






                            <span class="badge badge-primary text-light" style="font-size:12px;" > {{ $allFdOneDatas->country_of_origin }}</span>
                                        </td>
                                        @if($ngoOldNew == 'Old')

                                        <td>

                                            @if(!$ngoAllDataFirst)

                                            @else

                                               {{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-m-Y', strtotime($ngoAllDataFirst->ngo_registration_date))); }}

                                             @endif

                                        </td>
                                        <td>
                                            @if(!$ngoAllDataFirst)

                                            @else

                                            {{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-m-Y', strtotime($ngoAllDataFirst->last_renew_date))); }}

                                             @endif

                                        </td>
                                        @else
                            <td>

                                <?php


                                $durationSituation = DB::table('ngo_durations')
                                ->where('fd_one_form_id',$allFdOneDatas->id)
                                ->first();
                    ?>

                             @if(!$durationSituation)
                             <span class="badge badge-warning text-dark" style="font-size:12px;" >  অনুরোধ প্রক্রিয়াধীন </span>
                             @else

                                {{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-m-Y', strtotime($durationSituation->ngo_duration_start_date))); }}

                            @endif


                            </td>
                            <td>

                                @if(!$durationSituation)
                             <span class="badge badge-warning text-dark" style="font-size:12px;" >  অনুরোধ প্রক্রিয়াধীন </span>
                             @else

                                {{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-m-Y', strtotime($durationSituation->ngo_duration_end_date))); }}

                            @endif


                            </td>
                            @endif

                            @if($ngoOldNew == 'Old')

                            <td>
                                @if(\Carbon\Carbon::parse($ngoAllDataFirst->last_renew_date) <= \Carbon\Carbon::now())

                                <span class="badge badge-danger text-light" style="font-size:12px;" > নিষ্ক্রিয় </span>
                                                                @else

                                                                <span class="badge badge-success text-light" style="font-size:12px;" >  সক্রিয়</span>
                                                                @endif


                            </td>

                            @else

                             <td>


                                @if(!$durationSituation)
                                <span class="badge badge-warning text-dark" style="font-size:12px;" >  অনুরোধ প্রক্রিয়াধীন </span>
                                @else




                                @if(\Carbon\Carbon::parse($durationSituation->ngo_duration_end_date) <= \Carbon\Carbon::now())

                                <span class="badge badge-danger text-light" style="font-size:12px;" > নিষ্ক্রিয় </span>
                                                                @else

                                                                <span class="badge badge-success text-light" style="font-size:12px;" >  সক্রিয়</span>
                                                                @endif



                               @endif


                              </td>

                            @endif

                                </tr>

                                @endforeach

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        <!-- Individual column searching (text inputs) Ends-->
    </div>
</div>
<!-- Container-fluid Ends-->
@endsection


@section('script')
<script>
    $("#district_id").change(function(){


var district_id = $(this).val();


//alert(dakId+nothiId+status);


$.ajax({
    url: "{{ route('localNgoListSearch') }}",
    method: 'GET',
    data: {district_id:district_id},
    success: function(data) {

         $("#searchTable").html(data);
    }
    });


});
</script>
@endsection
