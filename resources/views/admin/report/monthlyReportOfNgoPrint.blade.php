<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>pdf</title>
    <style>
        body
        {
            font-size:16px;
            width: 8.3in;
            height: 11.7in;
        }

        body
        {
           /* // font-family: 'banglaNikos', sans-serif; */
        /* font-size: 14px; */

        }
		table
		{
			width: 100%;
			border-collapse: collapse;
		}
        .upper_section
        {
            text-align:center;
        }
        .upper_section img
        {
            height: 10px;
            width: 10px;
        }
        .text_section
        {
            font-size: 18px;
            line-height: 1.4;
        }
        .pdf_table
        {
            border-collapse: collapse;
            width: 100%;
            margin: 10px 0;
            border: 1px solid;
            text-align: center;
        }

        .pdf_table td, th {
  border: 1px solid;
}


        .bt{
  /* font-family: 'banglabold', sans-serif; */
  font-weight: bold;
}
    </style>
</head>
<body>

    <!-- new code strat --->

    <table>
        <tr>
            <td style="text-align: center;">

                <span style="font-weight: 900;font-size:25px;">এনজিও বিষয়ক ব্যুরো</span><br>
                <span>প্রধানমন্ত্রীর কার্যালয়</span><br>
<span>প্লট-ই-১৩/বি, আগারগাঁও। শেরেবাংলা নগর, ঢাকা-১২০৭</span><br>

<span>সকল এনজিও'র তালিকা</span><br>
<span>মাস: <b>{{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('F')) }}</b>, সাল: <b>{{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('Y')) }}</b></span>
            </td>
        </tr>
    </table>

    <table>
        <tr>
            <td>সর্বমোট: {{ App\Http\Controllers\Admin\CommonController::englishToBangla(count($monthlyReportOfNgo)) }}</td>
        </tr>
    </table>


    <!-- end new code -->


<table class="pdf_table" style="margin-top:20px;">
    <tr>
        <th>ক্র: নং:</th>
        <th>নিবন্ধন নম্বর</th>
        <th>এনজিওর নাম ও ঠিকানা</th>
        <th>দেশ</th>
        <th>নিবন্ধনের তারিখ</th>
        <th>নিবন্ধন/নবায়নের মেয়াদ</th>
        <th>এনজিওর অবস্থা</th>
    </tr>
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
                                    <td>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($i++)}}</td>
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

</table>



</body>
</html>
