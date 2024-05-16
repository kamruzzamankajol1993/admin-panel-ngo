<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>এফডি-৯(১) ফরম</title>
    {{-- <link href="{{ asset('/') }}public/front/assets/css/style.css" rel="stylesheet"> --}}
    <style>
         body {
            /* font-family: 'bangla', sans-serif; */
            font-size: 14px;

        }

        .pdf_header
        {
            width: 100%;
            text-align: center;
            margin-bottom: 20px;
        }

        .pdf_header h5
        {
            font-size: 20px;
            font-weight: bold;
            padding: 0;
            margin: 0;
        }

        .pdf_header p
        {
            font-size: 14px;
            line-height: 1.3;
            padding: 0;
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="card-body">


        <div class="pdf_header">
            <h5>এফডি-৯(১) ফরম</h5>
            <p>
                বিদেশি বিশেষজ্ঞ, উপদেষ্টা, কর্মকর্তা বা স্বেচ্ছাসেবী এর ওয়ার্ক পারমিটের (কার্যানুমতি)
                আবেদন ফরম<br>
                [অবশ্যকভাবে বাংলা নিকস ফন্টে পুরণ করে দাখিল করতে হবে]
            </p>
        </div>

        <div class="form9_upper_box">
            {{-- <h3 style="font-family: 'bangla', sans-serif;">এফডি-৯(১) ফরম</h3>
            <h4 style="font-family: 'bangla', sans-serif;">বিদেশি বিশেষজ্ঞ, উপদেষ্টা, কর্মকর্তা বা স্বেচ্ছাসেবী এর ওয়ার্ক পারমিটের (কার্যানুমতি)
                আবেদন ফরম</h4>
            <h5 style="font-family: 'bangla', sans-serif;">(আবশ্যকাবে বাংলা নিকস ফন্টে পুরণ করে দাখিল করতে হবে)</h5> --}}

            <div>
                <p>বরাবর <br>
                    মহাপরিচালক <br>
                    এনজিও বিষয় ব্যুরো, ঢাকা <br>
                    জনাব,</p>

            </div>
        </div>
    </div>
    <div class="card-body fd0901_text_style">
        <table class="table table-borderless">
            <tr>
                <td>বিষয়:</td>
                <td>{{ $ngo_list_all->organization_name }} সংস্থার বিদেশি বিশেষজ্ঞউপদেষ্টা/কর্মকর্ত/সেচ্ছাসেবী {{ $fd9OneList->foreigner_name_for_subject }}  এর
                    ওয়ার্ক পারমিট প্রসঙ্গে।
                </td>
            </tr>
            <tr>
                <td></td>
                <td>সূত্র: এনজিও বিষয়ক ব্যুরোর স্মারক নম্বর {{ $fd9OneList->sarok_number }} তারিখ {{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-m-Y', strtotime($fd9OneList->application_date))) }}
                </td>
            </tr>
        </table>

        <p class="mt-3 mb-2">
            উপর্যুক্ত বিষয় ও সূত্রের বরাতে {{ $fd9OneList->institute_name }} সংস্থার {{ $fd9OneList->prokolpo_name }} প্রকল্পের আওতায় {{ $fd9OneList->designation_name }} হিসেবে বিদেশী বিশেষজ্ঞ/
            উপদেষ্টা/কর্মকর্তা/স্বেচ্ছাসেবী {{ $fd9OneList->foreigner_name_for_body }} কে {{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-m-Y', strtotime($fd9OneList->expire_from_date))) }} খ্রি: হতে {{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-m-Y', strtotime($fd9OneList->expire_to_date))) }} পর্যন্ত সময়ের জন্য নিয়োগ করা হয়েছে। সংস্থার অনুকূলে
            উক্ত ব্যাক্তির অনুমোদিত সময়ের জন্য ওয়ার্ক পারমিট ইস্যু করার জন্য ওয়ার্ক পারমিট ইস্যু করার
            জন্য একসাথে নিম্ন বর্ণিত কাগজপত্র সংযুক্ত করা হল:
        </p>

        <table class="table table-borderless">
            <tr>
                <td>০১</td>
                <td>নিয়োগপত্র সত্যায়ন প্রমাণক</td>
                <td>: @if(!$fd9OneList->attestation_of_appointment_letter)

                    @else

<?php

                     $file_path = url($fd9OneList->attestation_of_appointment_letter);
                     $filename  = pathinfo($file_path, PATHINFO_FILENAME);

                     $extension = pathinfo($file_path, PATHINFO_EXTENSION);
                     ?>
সংযুক্ত
                     @endif

</td>
            </tr>
            <tr>
                <td>০২</td>
                <td>ফর্ম ৯ এর কপি</td>
                <td>:  @if(!$fd9OneList->copy_of_form_nine)

                    @else

<?php

                     $file_path = url($fd9OneList->copy_of_form_nine);
                     $filename  = pathinfo($file_path, PATHINFO_FILENAME);

                     $extension = pathinfo($file_path, PATHINFO_EXTENSION);
                     ?>
সংযুক্ত
                     @endif

</td>
            </tr>
            <tr>
                <td>০৩</td>
                <td>ছবি</td>
                <td>: সংযুক্ত
                    {{-- <img src="{{ asset('/') }}{{ $fd9OneList->foreigner_image }}" style="height:40px;"/> --}}
                </td>
            </tr>
            <tr>
                <td>০৪</td>
                <td>এন ভিসা নিয়ে আগমনের তারিখ (প্রমানসহ)</td>
                <td>:

                    @if(!$fd9OneList->copy_of_nvisa)

               @else

<?php

                $file_path = url($fd9OneList->copy_of_nvisa);
                $filename  = pathinfo($file_path, PATHINFO_FILENAME);

                $extension = pathinfo($file_path, PATHINFO_EXTENSION);
                ?>
সংযুক্ত ,
                @endif

                {{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-m-Y', strtotime($fd9OneList->arrival_date_in_nvisa))) }}</td>
            </tr>
        </table>

        <p class="mb-3">এমতবস্থায়, অত্র সংস্থার উল্লেখিত পদে {{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-m-Y', strtotime($fd9OneList->proposed_from_date))) }} হতে {{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-m-Y', strtotime($fd9OneList->proposed_from_date))) }} মেয়াদে উক্ত বিদেশি কর্মকর্তাকে ওয়ার্ক পারমিট ইস্যু করার জন্য বিনীত অনুরধ করেছি।</p>




                <table style=" margin-top: 15px;width:100%">

                    <tr>
                        <td style="text-align: right; padding-right: 14%" colspan="3"><img width="150" height="60" src="{{ $ins_url }}{{ $fd9OneList->digital_signature}}"/></td>
                    </tr>
                    <tr>
                        <td style="text-align: right; padding-right: 14%" colspan="3"><img width="150" height="60" src="{{ $ins_url }}{{ $fd9OneList->digital_seal}}"/></td>
                    </tr>
                </table>

                <table style=" margin-top: 10px;width:100%">
                    <tr>
                        <td style="text-align: right; padding-right: 14%" colspan="3">{{ trans('fd_one_step_one.tt_4')}}</td>
                    </tr>
                    <tr>
                        <td style="width: 65%"></td>
                        <td style="text-align: left; width:5%;">{{ trans('fd_one_step_one.tt_5')}}</td>
                        <td style="width:30%; text-align: left;">: {{ $fd9OneList->chief_name }}</td>
                    </tr>
                    <tr>
                        <td style="width: 65%"></td>
                        <td style="text-align: left; width: 5%;">{{ trans('fd_one_step_one.tt_6')}}</td>
                        <td style="width:30%; text-align: left;">: {{ $fd9OneList->chief_desi }}</td>
                    </tr>

                    <tr>
                        <td style="width: 65%"></td>
                        <td style="text-align: left; width: 5%;">{{ trans('fd_one_step_one.tt_7')}}</td>


                        <td style="width:30%; text-align: left;">:{{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-m-Y', strtotime($fd9OneList->created_at))) }}</td>

                    </tr>
                </table>

    </div>
</body>
</html>
