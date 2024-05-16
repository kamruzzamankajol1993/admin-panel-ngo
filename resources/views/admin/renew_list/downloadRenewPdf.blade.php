<!DOCTYPE html>
<html>
<head>
    <title>এফডি-৮ ফরম</title>

    <style>




        body {
            /* font-family: 'bangla', sans-serif; */
            font-size: 14px;
            height: 11in;
            width: 8.5in;
        }
        table
        {
            width: 100%;
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
      table td
      {
        vertical-align: top;
      }
        .first_table
        {
            text-align: center;
            margin-bottom: 30px;
        }
        /* .bt
      	{
			font-family: 'banglabold', sans-serif;
		} */

        .number_section
        {
            width: 15px !important;
        }

      .padding-left
      {
        padding-left: 18px;
      }
    </style>
</head>
<body>
    <div class="pdf_header">
        <h5>এফডি -৮ ফরম </h5>
        <p>নিবন্ধন নবায়নের আবেদন ফরম <br>
            [অবশ্যকভাবে বাংলা নিকস ফন্টে পুরণ করে দাখিল করতে হবে]
        </p>
    </div>
<table class="table table-bordered">
    <tbody>
    <tr>
        <td>১.</td>
        <td colspan="3">সংস্থার বিবরণ:</td>
    </tr>
      <?php
$getngoForLanguage = DB::table('ngo_type_and_languages')->where('user_id',$all_partiw1->user_id)->value('ngo_type');
// dd($getngoForLanguage);


$reg_name = DB::table('fd_one_forms')->where('user_id',$all_partiw1->user_id)->value('organization_name_ban');


      ?>
    <tr>
        <td></td>
        <td>অ)</td>
        <td>সংস্থার নাম ও সংস্থার ঠিকানা</td>
        <td>: {{ $reg_name }}, {{ $all_partiw1->organization_address}}</td>
    </tr>

    <tr>
        <td></td>
        <td>আ)</td>
        <td>নিবন্ধন নম্বর</td>
        <td>:
            <?php
$getNgoTypeForPdf =DB::table('ngo_type_and_languages')->where('user_id',$all_partiw1->user_id)->value('ngo_type');
            $mainNgoTypeRenew = DB::table('ngo_type_and_languages')->where('user_id',$all_partiw1->user_id)->value('ngo_type_new_old');

            $registrationNumberForOld = DB::table('ngo_type_and_languages')->where('user_id',$all_partiw1->user_id)->value('registration');

?>

@if($mainNgoTypeRenew == 'Old')
{{ App\Http\Controllers\Admin\CommonController::englishToBangla($registrationNumberForOld)}}

@else


          @if($all_partiw1->registration_number == 0)


          @else

          @if(session()->get('locale') == 'en' || empty(session()->get('locale')))

          {{ App\Http\Controllers\Admin\CommonController::englishToBangla($all_partiw1->registration_number)}}
          @else

          {{ $all_partiw1->registration_number}}
@endif
          @endif

@endif


      </td>
    </tr>

    <tr>
        <td></td>
        <td>ই)</td>
        <td>প্রধান কার্যালয়ের ঠিকানা</td>
        <td>: {{ $all_partiw1->address_of_head_office }}</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>(টেলিফোন নম্বর ,মোবাইল নম্বর ,ইমেইল  ও ওয়েব এড্রেস)</td>
        <td>:
            @if(!$get_all_data_new )

            @else
            {{ App\Http\Controllers\Admin\CommonController::englishToBangla($get_all_data_new ->phone_new) }},{{ App\Http\Controllers\Admin\CommonController::englishToBangla($get_all_data_new ->mobile_new) }},{{ $get_all_data_new ->email_new }},{{ $get_all_data_new ->web_site_name }}
            @endif
        </td>
    </tr>
    <tr>
        <td></td>
        <td>ঈ)</td>
        <td>বাংলাদেশস্থ সংস্থা প্রধানের তথ্যাদি</td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>ক) নাম</td>
        <td>: {{ $all_partiw1->name_of_head_in_bd }}</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>খ) জাতীয়তা</td>
        <td>:          @if(!$get_all_data_new )

            @else
            {{ App\Http\Controllers\Admin\CommonController::englishToBangla($get_all_data_new ->nationality) }}
            @endif
        </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>গ) পূর্ণকালীন/ খণ্ডকালীন</td>
        <td>: {{ $all_partiw1->job_type }}</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>ঘ) ঠিকানা,টেলিফোন নম্বর ,মোবাইল নম্বর, ইমেইল</td>
        <td>:{{ $all_partiw1->address }},{{ App\Http\Controllers\Admin\CommonController::englishToBangla($get_all_data_new ->mobile) }} {{ App\Http\Controllers\Admin\CommonController::englishToBangla($all_partiw1->phone) }}, {{ $all_partiw1->email }}</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>ঙ) নাগরিকত্ব (পূর্বতন নাগরিকত্ব যদি থাকে তাও উল্লেখ
            করতে হবে)
        </td>
        <td>: {{ $all_partiw1->citizenship }}</td>
    </tr>


    <tr>
        <td>২.</td>
        <td colspan="2">বিগত ১০(দশ) বছরে বৈদেশিক অনুদানে পরিচালত কার্যক্রমের বিবরণ (প্রকল্প ওয়ারী তথাদির সংক্ষিপ্তসার সংযুক্ত করতে হবে)
        </td>
        <td>:

            @if(!$get_all_data_new )


            @else
            @if(empty($get_all_data_new ->foregin_pdf))

            @else
            সংযুক্ত
            @endif
@endif

        </td>
    </tr>

    <tr>
        <td>৩.</td>
        <td colspan="2">সংস্থার সম্ভাব্য/প্রত্যাশিত বার্ষিক বাজেট (উৎসসহ)
        </td>
        <td>:          @if(!$get_all_data_new )


            @else
            @if(empty($get_all_data_new ->yearly_budget))

            @else
            সংযুক্ত
            @endif
@endif</td>
    </tr>


    <tr>
        <td>৪.</td>
        <td colspan="3">৫(পাঁচ) জন ঊর্ধ্বতন কর্মকর্তার তথ্যাদি :
        </td>
    </tr>
    @foreach($all_partiw as $key=>$all_all_parti)
    <tr>
        <td></td>
        <td>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($key+1 )}}.</td>
        <td>কর্মকর্তা {{ App\Http\Controllers\Admin\CommonController::englishToBangla($key+1 )}}</td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td>(ক)</td>
        <td>নাম</td>
        <td>: {{ $all_all_parti->name }}</td>
    </tr>
    <tr>
        <td></td>
        <td>(খ)</td>
        <td>পদবি</td>
        <td>: {{ $all_all_parti->position }}</td>
    </tr>
    <tr>
        <td></td>
        <td>(গ)</td>
        <td>ঠিকানা</td>
        <td>: {{ $all_all_parti->address }}</td>
    </tr>
    <tr>
        <td></td>
        <td>(ঘ)</td>
        <td>নাগরিকত্ব (পূর্বতন নাগরিকত্ব যদি থাকে উল্লেখ করতে হবে)
        </td>
        <td>: {{ $all_all_parti->citizenship }}</td>
    </tr>
    <tr>
        <td></td>
        <td>(ঙ)</td>
        <td>যোগদানের তারিখ</td>
        <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-m-Y', strtotime($all_all_parti->date_of_join))) }}</td>
    </tr>
    <tr>
        <td></td>
        <td>(চ)</td>
        <td>বেতন ভাতাদি</td>
        <td>: {{ $all_all_parti->salary_statement }}</td>
    </tr>
    <tr>
        <td></td>
        <td>(ছ)</td>
        <td>মোবাইল নম্বর </td>
        <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($all_all_parti->mobile) }}</td>
    </tr>

    <tr>
        <td></td>
        <td>(জ)</td>
        <td>ইমেইল এড্রেস</td>
        <td>: {{ $all_all_parti->email }}</td>
    </tr>


    <tr>
        <td></td>
        <td>(ঝ)</td>
        <td>সম্পৃক্ত অন্য পেশার বিবরণ</td>
        <td>: {{ $all_all_parti->other_occupation }}</td>
    </tr>
    @endforeach

    <tr>
        <td>৫.</td>
        <td colspan="2">নিবন্ধন নবায়ন ফি ও ভ্যাট পরিশোধ করা হয়েছে
            কিনা (চালানের কপি সংযুক্ত করতে
            হবে)
        </td>
        <td>: @if(!$get_all_data_new )


            @else
            @if(empty($get_all_data_new ->copy_of_chalan))

            @else
            সংযুক্ত
            @endif
@endif</td>
    </tr>

    <tr>
        <td>৬.</td>
        <td colspan="2">তফসিল -১ এ বর্ণিত যেকোন ফি এর ভ্যাট বকেয়া থাকলে পরিশোধ হয়েছে কিনা (চালানের কপি সংযুক্ত করতে হবে)
        </td>
        <td>: @if(!$get_all_data_new )


            @else
            @if(empty($get_all_data_new ->due_vat_pdf))

            @else
            সংযুক্ত
            @endif
@endif</td>
    </tr>

    <tr>
        <td>৭.</td>
        <td colspan="3">মাদার একাউন্ট এর বিস্তারিত বিবরণ (হিসাব
            নম্বর, ধরণ, ব্যাংকের
            নাম,শাখা ও বিস্তারিত ঠিকানা)
        </td>
    </tr>
    @if(!$get_all_data_adviser_bank)

    @else
    <tr>
        <td></td>
        <td>(ক)</td>
        <td>হিসাব নম্বর</td>
        <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($get_all_data_adviser_bank->account_number) }}</td>
    </tr>
    <tr>
        <td></td>
        <td>(খ)</td>
        <td>ধরণ</td>
        <td>: {{ $get_all_data_adviser_bank->account_type }}</td>
    </tr>
    <tr>
        <td></td>
        <td>(গ)</td>
        <td>ব্যাংকের নাম</td>
        <td>: {{ $get_all_data_adviser_bank->name_of_bank }}</td>
    </tr>
    <tr>
        <td></td>
        <td>(ঘ)</td>
        <td>শাখা</td>
        <td>: {{ $get_all_data_adviser_bank->branch_name_of_bank }}</td>
    </tr>
    <tr>
        <td></td>
        <td>(ঙ)</td>
        <td>বিস্তারিত ঠিকানা</td>
        <td>: {{ $get_all_data_adviser_bank->bank_address }}</td>
    </tr>
    @endif
    <tr>
        <td>৮.</td>
        <td colspan="2">ব্যাংক হিসাব নম্বর পরিবর্তন হয়ে থাকলে ব্যুরোর অনুমোদনপত্রের কপি সংযুক্ত করতে হবে
        </td>
        <td>: @if(!$get_all_data_new )


            @else
            @if(empty($get_all_data_new->change_ac_number))

            @else
            সংযুক্ত
            @endif
@endif</td>
    </tr>

    </tbody>
</table>


<h4 style="text-align:center; font-weight:bold; font-size:20px;">ঘোষণা </h4>
<p>আমি এই মর্মে ঘোষণা করছি যে, আমি সংশ্লিষ্ট সকল আইন-কানুন পড়িয়াছি এবং উল্লিখিত সকল তথ্য সত্য ও সঠিক।</p>


<table style=" margin-top: 15px;width:100%">

    <tr>
        <td style="text-align: right; padding-right: 14%" colspan="3"><img width="150" height="60" src="{{ $ins_url }}{{ $get_all_data_new->digital_signature}}"/></td>
    </tr>
    <tr>
        <td style="text-align: right; padding-right: 14%" colspan="3"><img width="150" height="60" src="{{ $ins_url }}{{ $get_all_data_new->digital_seal}}"/></td>
    </tr>
</table>

        <table style=" margin-top: 10px;width:100%">
            {{-- <tr>
                <td style="text-align: right; padding-right: 14%" colspan="3">প্রধান নির্বাহীর স্বাক্ষর ও সিল</td>
            </tr> --}}
            <tr>
                <td style="width: 65%"></td>
                <td style="text-align: left; width:5%;">নাম</td>
                <td style="width:30%; text-align: left;">: {{ $get_all_data_new->chief_name }}</td>
            </tr>
            <tr>
                <td style="width: 65%"></td>
                <td style="text-align: left; width: 5%;">পদবি</td>
                <td style="width:30%; text-align: left;">: {{ $get_all_data_new->chief_desi }}</td>
            </tr>

            <tr>
                <td style="width: 65%"></td>
                <td style="text-align: left; width: 5%;">তারিখ</td>

                <td style="width:30%; text-align: left;">:


                    {{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('d/m/y', strtotime($get_all_data_new->created_at))) }}
                </td>

            </tr>
        </table>


<ul style="margin-top:25px">

    <li>সংযোজনী হিসেবে পৃথক কাগজপত্রাদি সংযুক্ত করা যাবে।</li>

</ul>






</body>
</html>
