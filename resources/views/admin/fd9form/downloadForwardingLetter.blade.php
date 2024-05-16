<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ asset('/') }}public/front/assets/css/style.css" rel="stylesheet">
    <style>
         body,h5,h4,h3 {
            font-family: 'bangla', sans-serif;
            font-size: 14px;

        }

        .forwarding_letter p
{
    text-align: center;
    font-size: 16px;
    line-height: .8;
}

.forwarding_number
{
    width: 100%;
    font-size: 14px;
    margin-top: 30px;
    margin-bottom: 20px;
}

.forwarding_number .first_number
{
    width: 70%;
}

.forwarding_number .second_number
{
    text-align: right;
}

.forwarding_subject
{
    width: 100%;
    font-size: 14px;
    margin-top: 10px;
    margin-bottom: 10px;
}

.forwarding_subject tr td
{
    padding-bottom: 20px;
}

.forwarding_subject .first_subject
{
    width: 8%;
}

.forwarding_mainBody
{
    width: 100%;
    font-size: 14px;
    margin-bottom: 30px;
}

.forwarding_mainBody tr td
{
    text-indent: 40px;
}

.forwarding_table
{
    width: 100%;
    font-size: 14px;
    margin-top: 10px;
    margin-bottom: 20px;
    border-collapse: collapse;
}

.forwarding_table td, th {
    border: 1px solid;
    text-align: center;
    padding: 10px;
}

.forwarding_sincere
{
    width: 100%;
    font-size: 14px;
    margin-top: 60px;
    margin-bottom: 20px;
}

.forwarding_sincere tr td
{
    text-align: center;
}

.forwarding_sincere .first_sincere
{
    width: 60%;
}

.forwarding_secretary
{
    width: 100%;
    font-size: 14px;
    margin-top: 60px;
    margin-bottom: 20px;
}

.forwarding_secretary tr td
{
    text-align: left;
}

.forwarding_copy
{
    width: 100%;
    font-size: 14px;
    margin-top: 60px;
    margin-bottom: 20px;
}

.first_copy
{
    width: 6%;
}
    </style>
</head>
<body>
    <?php
 $engDATE = array('1','2','3','4','5','6','7','8','9','0','January','February','March','April',
      'May','June','July','August','September','October','November','December','Saturday','Sunday',
      'Monday','Tuesday','Wednesday','Thursday','Friday');
      $bangDATE = array('১','২','৩','৪','৫','৬','৭','৮','৯','০','জানুয়ারী','ফেব্রুয়ারী','মার্চ','এপ্রিল','মে',
      'জুন','জুলাই','আগস্ট','সেপ্টেম্বর','অক্টোবর','নভেম্বর','ডিসেম্বর','শনিবার','রবিবার','সোমবার','মঙ্গলবার','
      বুধবার','বৃহস্পতিবার','শুক্রবার'
      );



?>
 <?php


 $forwardingLetterData =DB::table('forwarding_letters')
->where('fd9_form_id',$dataFromNVisaFd9Fd1->id)->first();



 ?>


<!-- new -->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="forwarding_letter">
                        <p>গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</p>
                        <p>এনজিও বিষয়ক ব্যুরো </p>
                        <p>প্রধানমন্ত্রী কার্যালয় </p>
                        <p>প্লট-ই, ১৩/বি, আগারগাঁও </p>
                        <p>শেরেবাংলা নগর, ঢাকা-১২০৭</p>
                    </div>

                    <table class="forwarding_number">
                        <tr>
                            <td class="first_number">স্মারক নং: {{ str_replace($engDATE,$bangDATE,$forwardingLetterData->sarok_number) }}</td>

                            @if(empty($forwardingLettreDate))

                            @else
                             <td class="second_number">তারিখ: {{ str_replace($engDATE,$bangDATE,$forwardingLettreDate->format('d/m/Y')) }}</td>
                             @endif
                        </tr>
                    </table>

                    <table class="forwarding_subject">
                        <tr>
                            <td class="first_subject">বিষয়:</td>
                            <td>"{{ $dataFromNVisaFd9Fd1->organization_name_ban }}" নামীয় সংস্থার বিদেশী নাগরিক নিয়োগে
                                ছাড়পত্র প্রদানে মতামত।
                            </td>
                        </tr>
                        <tr>
                            <td>সূত্র:</td>
                            <td>সংস্থার {{ str_replace($engDATE,$bangDATE,$forwardingLetterData->apply_date) }} {{ str_replace($engDATE,$bangDATE,$forwardingLetterData->apply_month_name ) }} {{ str_replace($engDATE,$bangDATE,$forwardingLetterData->apply_year_name) }} তারিখের আবেদন।</td>
                        </tr>
                    </table>

                    <table class="forwarding_mainBody">
                        <tr>
                            <td>

                                @if(empty($editCheck))
                                উপযুক্ত বিষয় ও সূত্রস্থ পত্রের পরিপ্রেক্ষিতে বর্ণিত সংস্থার নিয়োগের নিমিত্তে
                                নিম্নবর্ণিত বিদেশী নাগরিকের নিয়োগ/নিরাপত্তা ছাড়পত্রের বিষয়ে প্রধানমন্ত্রীর
                                কার্যালয়ের ২৫ নভেম্বর, ২০২১ তারিখের পরিপত্রের নির্দেশ মোতাবেক সুরক্ষা সেবা
                                বিভাগের মতামত এনজিও বিষয়ক ব্যুরোতে প্রেরণের জন্য নির্দেশক্রমে অনুরোধ করা
                                হলো।
                                @else

                                {!!$editCheck!!}
                                @endif
                            </td>
                        </tr>
                    </table>

                    <table class="forwarding_table">
                        <tr>
                            <th>বিদেশী নাম ও পদবি</th>
                            <th>জাতীয়তা </th>
                            <th>পাসপোর্ট নম্বর</th>
                        </tr>
                        <tr>
                            <td>{{ $nVisaForeignerInfo->name_of_the_foreign_national }} , <br>{{ $nVisaEmploye->employed_designation }}</td>
                            <td>{{ $nVisaForeignerInfo->nationality }}</td>
                            <td>{{ $nVisaForeignerInfo->passport_no }}</td>
                        </tr>
                    </table>
                    <?php
                    $designationName = DB::table('designation_lists')
                    ->where('id',Auth::guard('admin')->user()->designation_list_id)
                    ->value('designation_name');

                    $branchName = DB::table('branches')
                    ->where('id',Auth::guard('admin')->user()->branch_id)
                    ->value('branch_name');

                    $onuLipiList = DB::table('forwarding_letter_onulipis')
                    ->where('forwarding_letter_id',$forwardingLetterData->id)->get();



                    ?>
                    <table class="forwarding_sincere">
                        <tr>
                            <td class="first_sincere"></td>
                            <td>
                                @if(empty(Auth::guard('admin')->user()->admin_sign))

                                @else
                           <img src="{{ Auth::guard('admin')->user()->admin_sign }}" style="height: 50px" /><br>
                                @endif
                                {{ Auth::guard('admin')->user()->admin_name_ban }}<br>
                                {{ $designationName }}<br>
                                {{ $branchName }}<br>
                                ফোন: ৫৫০০৭৩৯৪ <br>
                                Email: {{ Auth::guard('admin')->user()->email }}
                            </td>
                        </tr>
                    </table>

                    <table class="forwarding_secretary">
                        <tr>
                            <td>

                                @if(empty($editCheck))

                                সচিব <br>
                                সুরক্ষা সেবা বিভাগ <br>
                                স্বরাষ্ট্র মন্ত্রণালয় <br>
                                বাংলাদেশ সচিবালয়, ঢাকা
                                @else

                                {!!$editCheck1!!}
                                @endif
                            </td>
                        </tr>
                    </table>

                    <table class="forwarding_copy">
                        <tr>
                            <td colspan="2">অনুলিপি</td>
                        </tr>
                        @foreach($onuLipiList as  $key=>$allOnuLipiList)
                        <tr>
                            <td class="first_copy">{{ str_replace($engDATE,$bangDATE,$key+1)}})</td>
                            <td>{{$allOnuLipiList->onulipi_name}}</td>
                        </tr>
                        @endforeach

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end new code -->









</div>
</body>
</html>
