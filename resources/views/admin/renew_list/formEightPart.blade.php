
<?php

                       $getNgoType = DB::table('ngo_type_and_languages')->where('user_id',$form_one_data->user_id)->value('ngo_type');

                       $ngoTypeData = DB::table('ngo_type_and_languages')->where('user_id',$form_one_data->user_id)->first();
                        ?>
<div class="mb-0 m-t-30">
    <table class="table table-bordered">
        <tbody>
        <tr>
            <td>১.</td>
            <td colspan="3">সংস্থার বিবরণ:</td>
        </tr>
          <?php
$getngoForLanguage = DB::table('ngo_type_and_languages')->where('user_id',$form_one_data->user_id)->value('ngo_type');
// dd($getngoForLanguage);


$reg_name = DB::table('fd_one_forms')->where('user_id',$form_one_data->user_id)->value('organization_name_ban');


          ?>
        <tr>
            <td></td>
            <td>(i)</td>
            <td>সংস্থার নাম</td>
            <td>: {{ $reg_name }}</td>
        </tr>
        <tr>
            <td></td>
            <td>(ii)</td>
            <td>সংস্থার ঠিকানা</td>
            <td>: {{ $form_one_data->organization_address}}</td>
        </tr>
        <tr>
            <td></td>
            <td>(iii)</td>
            <td>নিবন্ধন নম্বর </td>
            <td>:

                @if($ngoTypeData->ngo_type_new_old == 'Old')

                {{ App\Http\Controllers\Admin\CommonController::englishToBangla($ngoTypeData->registration)}}
                @else

              @if($form_one_data->registration_number == 0)


              @else

              {{ App\Http\Controllers\Admin\CommonController::englishToBangla($form_one_data->registration_number)}}

              @endif

              @endif


          </td>
        </tr>
        <tr>
            <td></td>
            <td>(iv)</td>
            <td>কোন দেশীয় সংস্থা</td>
            <td>: {{ $form_one_data->country_of_origin }}</td>
        </tr>
        <tr>
            <td></td>
            <td>(v)</td>
            <td>প্রধান কার্যালয়ের ঠিকানা</td>
            <td>: {{ $form_one_data->address_of_head_office }}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>টেলিফোন নম্বর ,মোবাইল নম্বর ,ইমেইল  ও ওয়েব এড্রেস</td>
            <td>:
                @if(!$renewInfoData)

                @else
                {{ App\Http\Controllers\Admin\CommonController::englishToBangla($renewInfoData->phone_new) }},{{ App\Http\Controllers\Admin\CommonController::englishToBangla($renewInfoData->mobile_new) }},{{ $renewInfoData->email_new }},{{ $renewInfoData->web_site_name }}
                @endif
            </td>
        </tr>
        <tr>
            <td></td>
            <td>(vi)</td>
            <td>বাংলাদেশস্থ সংস্থা প্রধানের তথ্যাদি</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>ক) নাম</td>
            <td>: {{ $form_one_data->name_of_head_in_bd }}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>খ) পূর্ণকালীন/ খণ্ডকালীন</td>
            <td>: {{ $form_one_data->job_type }}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>গ) ঠিকানা,টেলিফোন নম্বর ,মোবাইল নম্বর, ইমেইল</td>
            <td>:{{ $form_one_data->address }},{{ App\Http\Controllers\Admin\CommonController::englishToBangla($renewInfoData->mobile) }} {{ App\Http\Controllers\Admin\CommonController::englishToBangla($form_one_data->phone) }}, {{ $form_one_data->email }}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>ঘ) নাগরিকত্ব (পূর্বতন নাগরিকত্ব যদি থাকে তাও উল্লেখ
                করতে হবে)
            </td>
            <td>: {{ $form_one_data->citizenship }}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>ঙ) পেশা (বর্তমান পেশা উল্লেখ করতে হবে)</td>
            <td>: {{ $form_one_data->profession }}</td>
        </tr>

        <tr>
            <td>২.</td>
            <td colspan="2">বিগত ১০(দশ) বছরে বৈদেশিক অনুদানে পরিচালত কার্যক্রমের বিবরণ (প্রকল্প ওয়ারী তথাদির সংক্ষিপ্তসার সংযুক্ত করতে হবে)
            </td>
            <td>:

                @if(!$renewInfoData)


                @else
                @if(empty($renewInfoData->foregin_pdf))

                @else
                <a target="_blank"  href="{{ route('foreginPdfDownload',base64_encode($renewInfoData->id)) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন </a>

                @if(Route::is('addChildNote') || Route::is('viewChildNote'))

                <button  href="{{ route('foreginPdfDownload',base64_encode($renewInfoData->id)) }}" class="btn btn-outline-secondary" id="attLink1" data-name="বিগত ১০(দশ) বছরে বৈদেশিক অনুদানে পরিচালত কার্যক্রমের বিবরণ"><i class="fa fa-paperclip"></i> সংযুক্তি </button>
                <button href="{{ route('foreginPdfDownload',base64_encode($renewInfoData->id)) }}" class="btn btn-outline-danger" id="copyLink1"><i class="fa fa-copy"></i> কপি করুন </button>
                @else

                @endif




                @endif
@endif

            </td>
        </tr>

        <tr>
            <td>৩.</td>
            <td colspan="2">সংস্থার সম্ভাব্য/প্রত্যাশিত বার্ষিক বাজেট (উৎসসহ)
            </td>
            <td>:          @if(!$renewInfoData)


                @else
                @if(empty($renewInfoData->yearly_budget))

                @else
                <a target="_blank"  href="{{ route('yearlyBudgetPdfDownload',base64_encode($renewInfoData->id)) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন </a>


                @if(Route::is('addChildNote') || Route::is('viewChildNote'))

                <button  href="{{ route('yearlyBudgetPdfDownload',base64_encode($renewInfoData->id)) }}" class="btn btn-outline-secondary" id="attLink1"><i class="fa fa-paperclip" data-name="সংস্থার সম্ভাব্য/প্রত্যাশিত বার্ষিক বাজেট"></i> সংযুক্তি </button>
                <button  href="{{ route('yearlyBudgetPdfDownload',base64_encode($renewInfoData->id)) }}" class="btn btn-outline-danger" id="copyLink1"><i class="fa fa-copy"></i> কপি করুন </button>
                @else

                @endif


                @endif
@endif</td>
        </tr>


        <tr>
            <td>৪.</td>
            <td colspan="3">কর্মকর্তাদের তথ্যাদি পৃথক কাগজে
                [ঊর্ধ্বতন ৫(পাঁচ) জন কর্মকর্তার]
                উপস্থাপন করতে হবে
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
            <td>নাগরিকত্ব (দ্বৈত নাগরিকত্ব থাকলে উল্লেখ করতে হবে)
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
            <td>: @if(!$renewInfoData)


                @else
                @if(empty($renewInfoData->copy_of_chalan))

                @else
                <a target="_blank"  href="{{ route('copyOfChalanPdfDownload',base64_encode($renewInfoData->id)) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন </a>




                @if(Route::is('addChildNote') || Route::is('viewChildNote'))

                <button  href="{{ route('copyOfChalanPdfDownload',base64_encode($renewInfoData->id)) }}" class="btn btn-outline-secondary" id="attLink1" data-name="নিবন্ধন ফি ও ভ্যাট পরিশোধ চালানের কপি"><i class="fa fa-paperclip"></i> সংযুক্তি </button>
                <button  href="{{ route('copyOfChalanPdfDownload',base64_encode($renewInfoData->id)) }}" class="btn btn-outline-danger" id="copyLink1"><i class="fa fa-copy"></i> কপি করুন </button>
                @else

                @endif



                @endif
@endif</td>
        </tr>

        <tr>
            <td>৬.</td>
            <td colspan="2">তফসিল -১ এ বর্ণিত যেকোন ফি এর ভ্যাট বকেয়া থাকলে পরিশোধ হয়েছে কিনা (চালানের কপি সংযুক্ত করতে হবে)
            </td>
            <td>: @if(!$renewInfoData)


                @else
                @if(empty($renewInfoData->due_vat_pdf))

                @else
                <a target="_blank"  href="{{ route('dueVatPdfDownload',base64_encode($renewInfoData->id)) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন </a>




                @if(Route::is('addChildNote') || Route::is('viewChildNote'))

                <button  href="{{ route('dueVatPdfDownload',base64_encode($renewInfoData->id)) }}" class="btn btn-outline-secondary" id="attLink1" data-name="তফসিল -১ এ বর্ণিত যেকোন ফি এর ভ্যাট বকেয়া থাকলে পরিশোধ চালানের কপি"><i class="fa fa-paperclip"></i> সংযুক্তি </button>
                <button  href="{{ route('dueVatPdfDownload',base64_encode($renewInfoData->id)) }}" class="btn btn-outline-danger" id="copyLink1"><i class="fa fa-copy"></i> কপি করুন </button>
                @else

                @endif


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
            <td>: @if(!$renewInfoData)


                @else
                @if(empty($renewInfoData->change_ac_number))

                @else
                <a target="_blank"  href="{{ route('changeAcNumberDownload',base64_encode($renewInfoData->id)) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন </a>


                @if(Route::is('addChildNote') || Route::is('viewChildNote'))

                <button  href="{{ route('changeAcNumberDownload',base64_encode($renewInfoData->id)) }}" class="btn btn-outline-secondary" id="attLink1"  data-name="ব্যাংক হিসাব নম্বর পরিবর্তন হয়ে থাকলে ব্যুরোর অনুমোদনপত্রের কপি"><i class="fa fa-paperclip"></i> সংযুক্তি </button>
                <button  href="{{ route('changeAcNumberDownload',base64_encode($renewInfoData->id)) }}" class="btn btn-outline-danger" id="copyLink1"><i class="fa fa-copy"></i> কপি করুন </button>
                @else

                @endif


                @endif
@endif</td>
        </tr>


	<tr>
                            <td>৯.</td>
                            <td colspan="3">অন্য কোন গুরুত্বপূর্ণ তথ্য যা আবেদনকারী
            উল্লেখ করতে ইচ্ছুক (পৃথক
            কাগজে সংযুক্ত করতে হবে)
                            </td>

                        </tr>

                        @foreach($get_all_data_other as $key=>$all_get_all_data_other)


                         <tr>
                             <td></td>
                             <td>(৯.{{ App\Http\Controllers\Admin\CommonController::englishToBangla($key+1) }})</td>
                             <td>{{ $all_get_all_data_other->information_title }}</td>
                             <td>:             @if(empty($all_get_all_data_other->information_pdf))

            @else



            <a target="_blank" class="btn btn-sm btn-success" href="{{ route('otherPdfView',$all_get_all_data_other->id ) }}" >
                <i class="fa fa-file-pdf-o"></i> দেখুন
            </a>


            <button  href="{{ route('otherPdfView',$all_get_all_data_other->id ) }}" class="btn btn-outline-secondary" id="attLink1"  data-name="অন্য কোন গুরুত্বপূর্ণ তথ্য"><i class="fa fa-paperclip"></i> সংযুক্তি </button>
            <button  href="{{ route('otherPdfView',$all_get_all_data_other->id ) }}" class="btn btn-outline-danger" id="copyLink1"><i class="fa fa-copy"></i> কপি করুন </button>
            @endif</td>
                         </tr>

                         @endforeach

        </tbody>
    </table>




</div>
