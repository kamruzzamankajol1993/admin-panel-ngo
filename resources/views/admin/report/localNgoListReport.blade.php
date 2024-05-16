@extends('admin.master.master')

@section('title')
দেশি এনজিও'র তালিকা | {{ $ins_name }}
@endsection


@section('css')

@endsection

@section('body')
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <h3>দেশি এনজিও'র তালিকা</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">হোম</a></li>
                    <li class="breadcrumb-item">রিপোর্ট</li>
                    <li class="breadcrumb-item">দেশি এনজিও'র তালিকা</li>
                </ol>
            </div>
            <div class="col-sm-6">
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid starts-->
<div class="container-fluid list-products">
    <div class="row">
        <!-- Individual column searching (text inputs) Starts-->
        <div class="row">
            <!-- Individual column searching (text inputs) Starts-->
            <div class="col-sm-12">
    <?php

    $totalNgoRegistration = DB::table('fd_one_forms')
    ->join('ngo_statuses','ngo_statuses.fd_one_form_id','=','fd_one_forms.id')
    ->where('ngo_statuses.status','Accepted')
    ->count();


    $totalNgoLocaldata = DB::table('fd_one_forms')
    //->join('ngo_statuses','ngo_statuses.fd_one_form_id','=','fd_one_forms.id')
    ->join('ngo_type_and_languages','ngo_type_and_languages.user_id','=','fd_one_forms.user_id')
    ->where('ngo_type_and_languages.ngo_type','দেশিও')
    //->where('ngo_statuses.status','Accepted')
    ->select('fd_one_forms.id as fdOneIdMain')
    ->get();


    $totalNgoLocaldataString = $totalNgoLocaldata->implode("fdOneIdMain", " ");
    $totalNgoLocaldataArray = explode(" ", $totalNgoLocaldataString);



     $localCountInRegistration = DB::table('ngo_statuses')
     ->whereIn('fd_one_form_id',$totalNgoLocaldataArray)
     ->where('status','Accepted')
     ->count();


     $localCountInRenew = DB::table('ngo_renews')
     ->whereIn('fd_one_form_id',$totalNgoLocaldataArray)
     ->where('status','Accepted')
     ->groupBy('fd_one_form_id')
     ->select('fd_one_form_id')
     ->count();

    // dd($localCountInRegistration + $localCountInRenew);

    $totalNgoForeigndata = DB::table('fd_one_forms')
    //->join('ngo_statuses','ngo_statuses.fd_one_form_id','=','fd_one_forms.id')
    ->join('ngo_type_and_languages','ngo_type_and_languages.user_id','=','fd_one_forms.user_id')
    ->where('ngo_type_and_languages.ngo_type','Foreign')
    //->where('ngo_statuses.status','Accepted')
    ->select('fd_one_forms.id as fdOneIdMain')
    ->get();


    $totalNgoForeigndataString = $totalNgoForeigndata->implode("fdOneIdMain", " ");
    $totalNgoForeigndataArray = explode(" ", $totalNgoForeigndataString);



     $foreignCountInRegistration = DB::table('ngo_statuses')
     ->whereIn('fd_one_form_id',$totalNgoForeigndataArray)
     ->where('status','Accepted')
     ->count();


     $foreignCountInRenew = DB::table('ngo_renews')
     ->whereIn('fd_one_form_id',$totalNgoForeigndataArray)
     ->where('status','Accepted')
     ->groupBy('fd_one_form_id')
     ->select('fd_one_form_id')
     ->count();



    $renewId = DB::table('ngo_renews')
    ->groupBy('fd_one_form_id')
    ->where('status','Accepted')
    ->select('fd_one_form_id')
    ->get();


    $convert_name_title = $renewId->implode("fd_one_form_id", " ");
    $separated_data_title = explode(" ", $convert_name_title);

    $totalNgoRenew = DB::table('fd_one_forms')
    ->whereIn('id',$separated_data_title)->count();


    /// for active and inactive ngo


    $totalActiveNgoRegistrationNewLocal = DB::table('fd_one_forms')
    //->join('ngo_statuses','ngo_statuses.fd_one_form_id','=','fd_one_forms.id')
    ->join('ngo_type_and_languages','ngo_type_and_languages.user_id','=','fd_one_forms.user_id')
    ->whereIn('ngo_type_and_languages.ngo_type',['Foreign'])
    //->where('ngo_statuses.status','Accepted')
    ->select('fd_one_forms.id as fdOneIdMain')
    ->get();


    $totalActiveNgoRegistrationString = $totalActiveNgoRegistrationNewLocal->implode("fdOneIdMain", " ");
    $totalActiveNgoRegistrationArray = explode(" ", $totalActiveNgoRegistrationString);


    $totalActiveNgoRegistrationStatus = DB::table('ngo_statuses')
    ->whereIn('fd_one_form_id',$totalActiveNgoRegistrationArray)
    ->where('status','Accepted')
    ->select('fd_one_form_id')
    ->get();


    $totalActiveNgoRegistrationStatusRenew = DB::table('ngo_renews')
    ->whereIn('fd_one_form_id',$totalActiveNgoRegistrationArray)
    ->where('status','Accepted')
    ->groupBy('fd_one_form_id')
    ->select('fd_one_form_id')
    ->get();


    $newLocalForeignStringRenew = $totalActiveNgoRegistrationStatusRenew->implode("fd_one_form_id", " ");
    $newLocalForeignArrayRenew = explode(" ", $newLocalForeignStringRenew);



    $newLocalForeignString = $totalActiveNgoRegistrationStatus->implode("fd_one_form_id", " ");
    $newLocalForeignArray = explode(" ", $newLocalForeignString);


    $totalActiveNgoRegistrationdurationNewRenew = DB::table('ngo_durations')
    ->whereIn('fd_one_form_id',$newLocalForeignArrayRenew)
    ->get();


    $totalActiveNgoRegistrationdurationNew = DB::table('ngo_durations')
    ->whereIn('fd_one_form_id',$newLocalForeignArray)
    ->get();



    $activeCountFirstRenew = 0;
    $InactiveCountFirstRenew = 0;


    foreach($totalActiveNgoRegistrationdurationNewRenew as $totalActiveNgoRegistrationdurationNewRenews){


    if(\Carbon\Carbon::parse($totalActiveNgoRegistrationdurationNewRenews->ngo_duration_end_date) <= \Carbon\Carbon::now()){

        $loopResultInactiveRenew = 1;
        $InactiveCountFirstRenew = $InactiveCountFirstRenew + $loopResultInactiveRenew;

    }else{

        $loopResultActiveRenew = 1;
        $activeCountFirstRenew = $activeCountFirstRenew + $loopResultActiveRenew;
    }

    }


    $activeCountFirst = 0;
    $InactiveCountFirst = 0;

    foreach($totalActiveNgoRegistrationdurationNew as $totalActiveNgoRegistrationdurationNews){


        if(\Carbon\Carbon::parse($totalActiveNgoRegistrationdurationNews->ngo_duration_end_date) <= \Carbon\Carbon::now()){

            $loopResultInactive = 1;
            $InactiveCountFirst = $InactiveCountFirst + $loopResultInactive;

        }else{

            $loopResultActive = 1;
            $activeCountFirst = $activeCountFirst + $loopResultActive;
        }

    }


    //dd($activeCountFirstRenew);

    // old ngo active and inactive



    $totalActiveNgoRegistrationNewLocal1 = DB::table('fd_one_forms')
    //->join('ngo_statuses','ngo_statuses.fd_one_form_id','=','fd_one_forms.id')
    ->join('ngo_type_and_languages','ngo_type_and_languages.user_id','=','fd_one_forms.user_id')
    ->whereIn('ngo_type_and_languages.ngo_type',['দেশিও'])
    //->where('ngo_statuses.status','Accepted')
    ->select('fd_one_forms.id as fdOneIdMain')
    ->get();


    $totalActiveNgoRegistrationString1 = $totalActiveNgoRegistrationNewLocal1->implode("fdOneIdMain", " ");
    $totalActiveNgoRegistrationArray1 = explode(" ", $totalActiveNgoRegistrationString1);


    $totalActiveNgoRegistrationStatus1 = DB::table('ngo_statuses')
    ->whereIn('fd_one_form_id',$totalActiveNgoRegistrationArray1)
    ->where('status','Accepted')
    ->select('fd_one_form_id')
    ->get();


    $totalActiveNgoRegistrationStatusRenew1 = DB::table('ngo_renews')
    ->whereIn('fd_one_form_id',$totalActiveNgoRegistrationArray1)
    ->where('status','Accepted')
    ->groupBy('fd_one_form_id')
    ->select('fd_one_form_id')
    ->get();


    $newLocalForeignStringRenew1 = $totalActiveNgoRegistrationStatusRenew1->implode("fd_one_form_id", " ");
    $newLocalForeignArrayRenew1 = explode(" ", $newLocalForeignStringRenew1);



    $newLocalForeignString1 = $totalActiveNgoRegistrationStatus1->implode("fd_one_form_id", " ");
    $newLocalForeignArray1 = explode(" ", $newLocalForeignString1);


    $totalActiveNgoRegistrationdurationNewRenew1 = DB::table('ngo_durations')
    ->whereIn('fd_one_form_id',$newLocalForeignArrayRenew1)
    ->get();


    $totalActiveNgoRegistrationdurationNew1 = DB::table('ngo_durations')
    ->whereIn('fd_one_form_id',$newLocalForeignArray1)
    ->get();



    $activeCountFirstRenew1 = 0;
    $InactiveCountFirstRenew1 = 0;


    foreach($totalActiveNgoRegistrationdurationNewRenew1 as $totalActiveNgoRegistrationdurationNewRenews1){


    if(\Carbon\Carbon::parse($totalActiveNgoRegistrationdurationNewRenews1->ngo_duration_end_date) <= \Carbon\Carbon::now()){

        $loopResultInactiveRenew1 = 1;
        $InactiveCountFirstRenew1 = $InactiveCountFirstRenew1 + $loopResultInactiveRenew1;

    }else{

        $loopResultActiveRenew1 = 1;
        $activeCountFirstRenew1 = $activeCountFirstRenew1 + $loopResultActiveRenew1;
    }

    }


    $activeCountFirst1 = 0;
    $InactiveCountFirst1 = 0;

    foreach($totalActiveNgoRegistrationdurationNew1 as $totalActiveNgoRegistrationdurationNews1){


        if(\Carbon\Carbon::parse($totalActiveNgoRegistrationdurationNews1->ngo_duration_end_date) <= \Carbon\Carbon::now()){

            $loopResultInactive1 = 1;
            $InactiveCountFirst1 = $InactiveCountFirst1 + $loopResultInactive1;

        }else{

            $loopResultActive1 = 1;
            $activeCountFirst1 = $activeCountFirst1 + $loopResultActive1;
        }

    }





    // end old ngo active and inactive

    /// for active and inactive ngo



    ?>

                <div class="row">




                    <div class="col-xl-4 col-md-4 col-sm-4 box-col-4 des-xl-25 rate-sec">
                        <div class="card income-card card-primary bg-primary">
                            <div class="card-body text-center">

                                <h5>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($localCountInRegistration + $localCountInRenew) }}</h5>
                                <p>মোট দেশি এনজিও</p>


                            </div>
                        </div>
                    </div>






                    <div class="col-xl-4 col-md-4 col-sm-4 box-col-4 des-xl-25 rate-sec">
                        <div class="card income-card card-primary bg-primary">
                            <div class="card-body text-center">

                                <h5>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($activeCountFirstRenew1 + $activeCountFirst1) }}</h5>
                                <p>মোট সক্রিয় দেশি এনজিও</p>


                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4 col-sm-4 box-col-4 des-xl-25 rate-sec ">
                        <div class="card income-card card-primary bg-primary">
                            <div class="card-body text-center">

                                <h5>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($InactiveCountFirstRenew1 + $InactiveCountFirst1)  }}</h5>
                                <p>মোট নিষ্ক্রিয়  দেশি এনজিও</p>


                            </div>
                        </div>
                    </div>
                    <div class="col-xl-1 col-md-1 col-sm-1 box-col-1 des-xl-25 rate-sec">
                    </div>
                </div>
            </div>
                {{-- <div class="card">

                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="">জেলার নাম</label>
                            <select class="form-control" required name="district_id" id="district_id" type="text" placeholder="">
                                <option value="">--অনুগ্রহ করে নির্বাচন করুন--</option>
                                <option value="all">সকল জেলা</option>
                                @foreach($allDistrictList as $AllBranchLists)
                                <option value="{{ $AllBranchLists->id }}" >{{ $AllBranchLists->bn_name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('branch_id'))
                            <span class="text-danger">{{ $errors->first('branch_id') }}</span>
                        @endif
                        </div>

                    </div>
                </div> --}}
            </div>

        <div class="col-sm-12"  >
            <div class="card">

                <div class="card-body">


                    <div class="table-responsive product-table" >

                        <table class="display" id="basic-1">
                            <thead>
                                <tr>

                                    <th>ক্র: নং:</th>
                                    <th>নিবন্ধন নম্বর</th>
                                    <th>এনজিওর নাম ও ঠিকানা</th>
                                    <th>জেলা</th>
                                    <th>নিবন্ধনের তারিখ</th>
                                    <th>নিবন্ধন/নবায়নের মেয়াদ</th>
                                    <th>এনজিওর অবস্থা</th>



                                </tr>
                            </thead>
                            <tbody id="searchTable">
                                <?php  $i = 1; ?>
                                @foreach($localNgoListReport as $key=>$allFdOneDatas)

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

                                @if($mainCheckAll != 'Accepted')

                                @else

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


                                            $districtName = DB::table('districts')
                                            ->where('id',$allFdOneDatas->district_id)
                                            ->value('bn_name');
                                ?>






                            <span class="badge badge-primary text-light" style="font-size:12px;" > {{ $districtName }}</span>


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
                                @endif
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
