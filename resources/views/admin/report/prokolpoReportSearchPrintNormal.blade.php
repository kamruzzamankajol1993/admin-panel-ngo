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

<span>সকল প্রকল্পের তালিকা</span><br>



                <span>সাল: <b>{{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('Y')) }}</b></span>



            </td>
        </tr>
    </table>




    <!-- end new code -->


<table class="pdf_table" style="margin-top:20px;">
    <thead>
        <tr>

            <th>ক্র: নং:</th>
            <th>এনজিওর নাম</th>
            <th>বিভাগ</th>
            <th>জেলা</th>
            <th>উপজেলা /সিটি কর্পোরেশন /থানা </th>
            <th>ধরণ</th>



        </tr>
        </thead>
        <tbody id="searchTable">

            @foreach($prokolpoReportFd6Main as $key=>$prokolpoReports)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>
                                        {{ DB::table('fd_one_forms')->where('id',$prokolpoReports->fd_one_form_id)->value('organization_name_ban') }}
                                       <p style="font-weight: 900;">প্রকল্পের নাম: {{ DB::table('fd2_forms')->where('fd_six_form_id',$prokolpoReports->formId)->value('ngo_prokolpo_name') }}</p>
                                    </td>
                                    <td>{{ $prokolpoReports->division_name }}</td>
                                    <td>{{ $prokolpoReports->district_name }}</td>
                                    <td>

                                        @if(empty($prokolpoReports->upozila_name))

                                        @else
{{ $prokolpoReports->upozila_name }}/
                                        @endif

                                        @if(empty($prokolpoReports->city_corparation_name))

                                        @else
{{ $prokolpoReports->city_corparation_name }}/
                                        @endif


                                        @if(empty($prokolpoReports->thana_name))

                                        @else
{{ $prokolpoReports->thana_name }}
                                        @endif

                                    </td>
                                    <td>{{ DB::table('project_subjects')->where('id',$prokolpoReports->prokolpo_type)->value('name') }} ( বহুবার্ষিক)</td>

                                </tr>
                                @endforeach

                                <?php
                                $countFd6Data = count($prokolpoReportFd6Main);
                                ?>

                                @foreach($prokolpoReportFd7Main as $key=>$prokolpoReports)
                                <tr>
                                    <td>{{ $countFd6Data+($key+1) }}</td>
                                    <td>

                                        {{ DB::table('fd_one_forms')->where('id',$prokolpoReports->fd_one_form_id)->value('organization_name_ban') }}
                                        <p style="font-weight: 900;">প্রকল্পের নাম: {{ DB::table('fd2_form_for_fd7_forms')->where('fd7_form_id',$prokolpoReports->formId)->value('ngo_prokolpo_name') }}</p>
                                    </td>
                                    <td>{{ $prokolpoReports->division_name }}</td>
                                    <td>{{ $prokolpoReports->district_name }}</td>
                                    <td>

                                        @if(empty($prokolpoReports->upozila_name))

                                        @else
{{ $prokolpoReports->upozila_name }}/
                                        @endif

                                        @if(empty($prokolpoReports->city_corparation_name))

                                        @else
{{ $prokolpoReports->city_corparation_name }}/
                                        @endif


                                        @if(empty($prokolpoReports->thana_name))

                                        @else
{{ $prokolpoReports->thana_name }}
                                        @endif

                                    </td>
                                    <td>{{ DB::table('project_subjects')->where('id',$prokolpoReports->prokolpo_type)->value('name') }} ( জরুরি ত্রাণ সহায়তা)</td>

                                </tr>
                                @endforeach

                                <?php
                                $countFd7Data = count($prokolpoReportFd7Main);
                                $countFd6Data = count($prokolpoReportFd6Main);
                                $total = $countFd7Data + $countFd6Data;
                                ?>

                                @foreach($prokolpoReportFc2Main as $key=>$prokolpoReports)
                                <tr>
                                    <td>{{ $total+($key+1) }}</td>
                                    <td>

                                        {{ DB::table('fd_one_forms')->where('id',$prokolpoReports->fd_one_form_id)->value('organization_name_ban') }}
                                        <p style="font-weight: 900;">প্রকল্পের নাম: {{ DB::table('fd2_form_for_fc2_forms')->where('fc2_form_id',$prokolpoReports->formId)->value('ngo_prokolpo_name') }}</p>
                                    </td>
                                    <td>{{ $prokolpoReports->division_name }}</td>
                                    <td>{{ $prokolpoReports->district_name }}</td>
                                    <td>

                                        @if(empty($prokolpoReports->upozila_name))

                                        @else
                                {{ $prokolpoReports->upozila_name }}/
                                        @endif

                                        @if(empty($prokolpoReports->city_corparation_name))

                                        @else
                                {{ $prokolpoReports->city_corparation_name }}/
                                        @endif


                                        @if(empty($prokolpoReports->thana_name))

                                        @else
                                {{ $prokolpoReports->thana_name }}
                                        @endif

                                    </td>
                                    <td>{{ DB::table('project_subjects')->where('id',$prokolpoReports->prokolpo_type)->value('name') }} (বৈদেশিক অনুদানে গৃহীত)</td>

                                </tr>
                                @endforeach

                                <?php
                                $countFd7Data = count($prokolpoReportFd7Main);
                                $countFd6Data = count($prokolpoReportFd6Main);
                                $countFc1Data = count($prokolpoReportFc1Main);
                                $totalOne = $countFd7Data + $countFd6Data + $countFc1Data;
                                ?>

@foreach($prokolpoReportFc1Main as $key=>$prokolpoReports)
<tr>
    <td>{{ $totalOne+($key+1) }}</td>
    <td>

        {{ DB::table('fd_one_forms')->where('id',$prokolpoReports->fd_one_form_id)->value('organization_name_ban') }}
        <p style="font-weight: 900;">প্রকল্পের নাম: {{ DB::table('fd2_form_for_fc1_forms')->where('fc1_form_id',$prokolpoReports->formId)->value('ngo_prokolpo_name') }}</p>
    </td>
    <td>{{ $prokolpoReports->division_name }}</td>
    <td>{{ $prokolpoReports->district_name }}</td>
    <td>

        @if(empty($prokolpoReports->upozila_name))

        @else
{{ $prokolpoReports->upozila_name }}/
        @endif

        @if(empty($prokolpoReports->city_corparation_name))

        @else
{{ $prokolpoReports->city_corparation_name }}/
        @endif


        @if(empty($prokolpoReports->thana_name))

        @else
{{ $prokolpoReports->thana_name }}
        @endif

    </td>
    <td>{{ DB::table('project_subjects')->where('id',$prokolpoReports->prokolpo_type)->value('name') }} (এককালীন অনুদান)</td>

</tr>
@endforeach

</table>



</body>
</html>
