<!DOCTYPE html>
<html>
<head>
    <title>{{ trans('fd_one_step_one.f_form')}}</title>

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
    @if($getNgoTypeForPdf == 'দেশিও')
    <div class="pdf_header">
        <h5>{{ trans('fd_one_step_one.f_form')}}</h5>
        <p>{{ trans('fd_one_step_one.n_r')}}</p>
    </div>
    @else
    <div class="pdf_header">
        <h5>{{ trans('fd_one_step_one.f_form')}}</h5>
        <p>
            [Under act 4(1) of the Foreign Donations (Voluntary Activities) Regulation Act, 2016]
             <br>
    <b>{{ trans('fd_one_step_one.n_r')}}</b>
</p>
    </div>
    @endif
<table>
    <tbody>
        <tr>
            <td>{{ trans('fd_one_step_one.one')}}.</td>
            <td colspan="4">{{ trans('fd_one_step_one.Particulars_of_Organisation')}} :</td>
        </tr>

        <tr>
            <td></td>
            <td class="number_section">(i)</td>
            <td>{{ trans('fd_one_step_one.Organization_Name_Organization_address')}}</td>
            <td style="width:4px">:</td>


            @if($getNgoTypeForPdf == 'দেশিও')
            <td>{{ $allformOneData->organization_name_ban }} <br> {{ trans('fd_one_step_one.Organization_address')}}: {{ $allformOneData->organization_address }}</td>
            @else
            <td>{{ $allformOneData->organization_name }} <br> {{ trans('fd_one_step_one.Organization_address')}}: {{ $allformOneData->organization_address}}</td>
            @endif
        </tr>
        <!-- <tr>
            <td></td>
            <td class="number_section">(ii)</td>
            <td>{{ trans('fd_one_step_one.Organization_address')}}</td>
            <td style="width:4px">:</td>
            <td>{{ $allformOneData->organization_address }}</td>
        </tr>-->
        <tr>
            <td></td>
            <td class="number_section">(iii)</td>
            <td>{{ trans('fd_one_step_one.reg_num')}}</td>
            <td style="width:4px">:</td>
            <td>

                @if($allformOneData->registration_number == 0)

                @else

                @if(session()->get('locale') == 'en' || empty(session()->get('locale')))

                {{ App\Http\Controllers\Admin\CommonController::englishToBangla($allformOneData->registration_number) }}
                @else

                {{ $allformOneData->registration_number }}
                @endif
                @endif


            </td>
        </tr>
        <tr>
            <td></td>
            <td class="number_section">(iv)</td>
            <td>{{ trans('fd_one_step_one.Country_of_Origin')}}</td>
            <td style="width:4px">:</td>
            <td>{{ $allformOneData->country_of_origin }}</td>
        </tr>
        <tr>
            <td></td>
            <td class="number_section">(v)</td>
            <td>{{ trans('fd_one_step_one.Address_of_the_Head_Office')}}</td>
            <td style="width:4px">:</td>
            <td>
                @if($getNgoTypeForPdf == 'দেশিও')

                {{ $allformOneData->address_of_head_office }}

                @else
                {{ $allformOneData->address_of_head_office_eng  }}

                @endif

            </td>
        </tr>
        <tr>
            <td></td>
            <td >(vi)</td>
            <td>{{ trans('fd_one_step_one.Particulars_of_Head_of_the_Organization_in_Bangladesh')}}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>{{ trans('form 8_bn.a')}}) {{ trans('fd_one_step_one.name')}}</td>
            <td style="width:4px">:</td>
            <td>{{ $allformOneData->name_of_head_in_bd }}</td>
        </tr>

       <?php

                                   $getJobType =$allformOneData->job_type;


                                  ?>

        <tr>
            <td></td>
            <td></td>
            <td>{{ trans('form 8_bn.b')}}) {{ trans('fd_one_step_one.Whether_part_time_or_full_time')}}</td>
            <td style="width:4px">:</td>
            <td>{{ $allformOneData->job_type }}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>{{ trans('form 8_bn.c')}}) {{ trans('fd_one_step_one.Address_Mobile_Number_Email')}}</td>
            <td style="width:4px">:</td>
            <td>{{ $allformOneData->address }}, @if(session()->get('locale') == 'en' || empty(session()->get('locale')))
                {{ App\Http\Controllers\Admin\CommonController::englishToBangla($allformOneData->tele_phone_number.', '.$allformOneData->phone) }},
                @else
                {{ $allformOneData->tele_phone_number.', '.$allformOneData->phone }},
                @endif {{ $allformOneData->email }}</td>
        </tr>

       <?php

                                    $getCityzendata = $allformOneData->citizenship;


                                  ?>
        <tr>
            <td></td>
            <td></td>
            <td>{{ trans('form 8_bn.d')}}) {{ trans('fd_one_step_one.Citizenship')}}</td>
            <td style="width:4px">:</td>
            <td>{{ $getCityzendata }}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>{{ trans('form 8_bn.e')}}) {{ trans('fd_one_step_one.Profession')}}</td>
            <td style="width:4px">:</td>
            <td>{{ $allformOneData->profession }}</td>
        </tr>
        <tr>
            <td>{{ trans('fd_one_step_one.two')}}.</td>
            <td colspan="4">{{ trans('fd_one_step_two.Field_of_proposed_activities')}} ({{ trans('fd_one_step_two.des')}})
            </td>
        </tr>
        <tr>
            <td></td>
            <td>{{ trans('form 8_bn.a')}}</td>
            <td>(i) {{ trans('fd_one_step_two.Plan_of_Operation')}} </td>
            <td style="width:4px">:</td>
            <td>@if(empty($allformOneData->plan_of_operation))

                @else


                @if(session()->get('locale') == 'en' || empty(session()->get('locale')))

                সংযুক্ত
                @else
                attached

                @endif
                @endif</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>(ii) {{ trans('fd_one_step_two.pp')}}</td>
            <td style="width:4px">:</td>
            <td>{{ $allformOneData->district }}</td>
        </tr>
        <tr>
            <td></td>
            <td>{{ trans('form 8_bn.b')}}</td>
            <td>{{ trans('fd_one_step_two.Source_of_Fund')}}</td>
            <td></td>
        </tr>
        @foreach($get_all_source_of_fund_data as $all_get_all_source_of_fund_data)
        <tr>
            <td></td>
            <td></td>
            <td>(i) {{ trans('fd_one_step_two.dd')}}</td>
            <td style="width:4px">:</td>
            <td>{{ $all_get_all_source_of_fund_data->name }}, {{ $all_get_all_source_of_fund_data->address }}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>(ii) {{ trans('fd_one_step_two.copy')}}</td>
            <td style="width:4px">:</td>
            <td> @if(empty($all_get_all_source_of_fund_data->letter_file))

                @else

                @if(session()->get('locale') == 'en' || empty(session()->get('locale')))

                সংযুক্ত
                @else
                attached

                @endif
                @endif</td>
        </tr>
        @endforeach
        <tr>
            <td>{{ trans('fd_one_step_one.three')}}.</td>
            <td colspan="2">{{ trans('fd_one_step_two.money')}}</td>
            <td style="width:4px">:</td>
            <td> @if(session()->get('locale') == 'en' || empty(session()->get('locale')))


                {{ App\Http\Controllers\Admin\CommonController::englishToBangla($allformOneData->annual_budget) }}


                @else

                {{ $allformOneData->annual_budget }}

                @endif</td>
        </tr>
        <tr>
            <td>{{ trans('fd_one_step_one.four')}}.</td>
            <td colspan="4">{{ trans('fd_one_step_three.staff_position')}}
            </td>
        </tr>
        @foreach($formOneMemberList as $key=>$allFormOneMemberList)
        <tr>

            @if(session()->get('locale') == 'en' || empty(session()->get('locale')))
            <td></td>

            <td colspan="4">{{ App\Http\Controllers\Admin\CommonController::englishToBangla($key+1 )}}. কর্মকর্তা {{ App\Http\Controllers\Admin\CommonController::englishToBangla($key+1 )}}</td>

            @else
            <td></td>

            <td colspan="4">{{ $key+1}}. Staff {{$key+1 }}</td>

            @endif
        </tr>
        <tr>
            <td></td>
            <td colspan="2" class="padding-left">({{ trans('form 8_bn.a')}}) {{ trans('fd_one_step_three.name')}}</td>
            <td style="width:4px">:</td>
            <td>{{ $allFormOneMemberList->name }}</td>
        </tr>
        <tr>
            <td></td>

            <td colspan="2" class="padding-left">({{ trans('form 8_bn.b')}}) {{ trans('fd_one_step_three.desi')}}</td>
            <td style="width:4px">:</td>
            <td>{{ $allFormOneMemberList->position }}</td>
        </tr>
        <tr>
            <td></td>

            <td colspan="2" class="padding-left">({{ trans('form 8_bn.c')}}) {{ trans('fd_one_step_three.address')}}</td>
            <td style="width:4px">:</td>
            <td>{{ $allFormOneMemberList->address }}</td>
        </tr>

      <?php

                                  $convetArray = explode(",",$allFormOneMemberList->citizenship);



                                    $getCityzendata = DB::table('countries')->whereIn('country_people_bangla',$convetArray)->get();

                                  //dd($getCityzendata);
                                  ?>
        <tr>
            <td></td>

            <td colspan="2" class="padding-left">({{ trans('form 8_bn.d')}}) {{ trans('fd_one_step_three.citizenship')}}</td>
            <td style="width:4px">:</td>
            <td>
                                      @foreach($getCityzendata as $all_getCityzendata)

                                      @if(count($getCityzendata) == 1)
                                      {{$all_getCityzendata->country_people_bangla}}
                                      @else
                                      {{$all_getCityzendata->country_people_bangla}},
                                      @endif
                                      @endforeach
                                      </td>
        </tr>
        <tr>
            <td></td>

            <td colspan="2" class="padding-left">({{ trans('form 8_bn.e')}}) {{ trans('fd_one_step_three.date_of_joining')}}</td>
            <td style="width:4px">:</td>
            <td>   @if(session()->get('locale') == 'en' || empty(session()->get('locale')))

                {{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-m-Y', strtotime($allFormOneMemberList->date_of_join))) }}


                @else
                {{ date('d-m-Y', strtotime($allFormOneMemberList->date_of_join)) }}

                @endif</td>
        </tr>
        <tr>
            <td></td>

            <td colspan="2" class="padding-left">({{ trans('form 8_bn.f')}}) {{ trans('fd_one_step_three.s_statement')}}</td>
            <td style="width:4px">:</td>
            <td>{{ $allFormOneMemberList->salary_statement }}</td>
        </tr>
        <tr>
            <td></td>

            <td colspan="2" class="padding-left">({{ trans('form 8_bn.g')}}) {{ trans('fd_one_step_three.detail')}}</td>
            <td style="width:4px">:</td>
            <td> {{ $allFormOneMemberList->other_occupation }}</td>
        </tr>
        @endforeach

        <tr>
            <td>{{ trans('fd_one_step_one.five')}}.</td>
            <td colspan="2">{{ trans('fd_one_step_four.tt1')}}
            </td>
            <td style="width:4px">:</td>
            <td>
                @if(empty($allformOneData->attach_the__supporting_paper))

                @else

                @if(session()->get('locale') == 'en' || empty(session()->get('locale')))

                সংযুক্ত
                @else
                attached

                @endif
                @endif</td>
        </tr>
        <tr>
            <td>{{ trans('fd_one_step_one.six')}}.</td>
            <td colspan="4">{{ trans('fd_one_step_four.tt')}} :
            </td>
        </tr>
        @foreach($get_all_data_adviser as $key=>$all_get_all_data_adviser)
        <tr>
            @if(session()->get('locale') == 'en' || empty(session()->get('locale')))
            <td></td>

            <td colspan="3">{{ App\Http\Controllers\Admin\CommonController::englishToBangla($key+1 )}}. পরামর্শক {{ App\Http\Controllers\Admin\CommonController::englishToBangla($key+1 )}}</td>
            <td></td>
            @else
            <td></td>

            <td colspan="3">{{ $key+1 }}. Adviser {{ $key+1 }}</td>
            <td></td>

            @endif
        </tr>
        <tr>
            <td></td>

            <td class="padding-left" colspan="2">({{ trans('form 8_bn.a')}}) {{ trans('fd_one_step_four.advisor_name')}}</td>
            <td style="width:4px">:</td>
            <td>{{ $all_get_all_data_adviser->name }}</td>
        </tr>
        <tr>
            <td></td>

            <td class="padding-left" colspan="2">({{ trans('form 8_bn.b')}}) {{ trans('fd_one_step_four.tt2')}}</td>
            <td style="width:4px">:</td>
            <td> {{ $all_get_all_data_adviser->information	 }}</td>
        </tr>
        @endforeach
        <tr>
            <td>{{ trans('fd_one_step_one.seven')}}.</td>
            <td colspan="4">{{ trans('fd_one_step_four.main_account_details')}}({{ trans('fd_one_step_four.tt3')}})
            </td>
        </tr>
        @if(!$get_all_data_adviser_bank)

        @else
        <tr>
            <td></td>
            <td>({{ trans('form 8_bn.a')}})</td>
            <td>{{ trans('fd_one_step_four.account_number')}}</td>
            <td style="width:4px">:</td>
            <td>@if(session()->get('locale') == 'en' || empty(session()->get('locale')))
                {{App\Http\Controllers\Admin\CommonController::englishToBangla($get_all_data_adviser_bank->account_number)}}
                @else
                {{ $get_all_data_adviser_bank->account_number }}
                @endif</td>
        </tr>
        <tr>
            <td></td>
            <td>({{ trans('form 8_bn.b')}})</td>
            <td>{{ trans('fd_one_step_four.account_type')}}</td>
            <td style="width:4px">:</td>
            <td>{{ $get_all_data_adviser_bank->account_type }}</td>
        </tr>
        <tr>
            <td></td>
            <td>({{ trans('form 8_bn.c')}})</td>
            <td>{{ trans('fd_one_step_four.name_of_bank')}}</td>
            <td style="width:4px">:</td>
            <td>{{ $get_all_data_adviser_bank->name_of_bank }}</td>
        </tr>
        <tr>
            <td></td>
            <td>({{ trans('form 8_bn.d')}})</td>
            <td>{{ trans('fd_one_step_four.branch_name_of_bank')}}</td>
            <td style="width:4px">:</td>
            <td>{{ $get_all_data_adviser_bank->branch_name_of_bank }}</td>
        </tr>
        <tr>
            <td></td>
            <td>({{ trans('form 8_bn.e')}})</td>
            <td>{{ trans('fd_one_step_four.bank_address')}}</td>
            <td style="width:4px">:</td>
            <td>{{ $get_all_data_adviser_bank->bank_address }}</td>
        </tr>
        @endif
        <tr>
            <td>{{ trans('fd_one_step_one.eight')}}.</td>
            <td colspan="2">{{ trans('fd_one_step_four.tt4')}}
            </td>
            <td style="width:4px">:</td>
            <td>
@foreach($get_all_data_other as $all_get_all_data_other)

@if(empty($all_get_all_data_other->information_title))

@else

@if(session()->get('locale') == 'en' || empty(session()->get('locale')))

সংযুক্ত
@else
attached

@endif
@endif

                @endforeach


            </td>
        </tr>

        </tbody>
    </table>
<h4 style="text-align:center; font-weight:bold; font-size:20px;margin-top: 30px">{{ trans('fd_one_step_one.tt_1')}}</h4>
<p>{{ trans('fd_one_step_one.tt_2')}},{{ trans('fd_one_step_one.tt_3')}}</p>

<table style=" margin-top: 15px;width:100%">

    <tr>
        <td style="text-align: right;padding-right: 14%" colspan="3"><img width="150" height="60" src="{{ $ins_url }}{{ $allformOneData->digital_signature}}"/></td>
    </tr>
    <tr>
        <td style="text-align: right;padding-right: 14%" colspan="3"><img width="150" height="60" src="{{ $ins_url }}{{ $allformOneData->digital_seal}}"/></td>
    </tr>
</table>

<table style=" margin-top: 15px">
    {{-- <tr>
        <td style="text-align: right; padding-right: 14%" colspan="3">{{ trans('fd_one_step_one.tt_4')}}</td>
    </tr> --}}
    <tr>
        <td style="width: 65%"></td>
        <td style="text-align: left; width:5%;">{{ trans('fd_one_step_one.tt_5')}}</td>
        <td style="width:30%; text-align: left;">: {{ $allformOneData->chief_name }}</td>
    </tr>
    <tr>
        <td style="width: 65%"></td>
        <td style="text-align: left; width: 5%;">{{ trans('fd_one_step_one.tt_6')}}</td>
        <td style="width:30%; text-align: left;">: {{ $allformOneData->chief_desi }}</td>
    </tr>

    <tr>
        <td style="width: 65%"></td>
        <td style="text-align: left; width: 5%;">{{ trans('fd_one_step_one.tt_7')}}</td>

        <td style="width:30%; text-align: left;">:


            {{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('d/m/y', strtotime($allformOneData->created_at))) }}

        </td>

    </tr>
</table>

<ul style="margin-top:25px">
    <li>{{ trans('fd_one_step_one.tt_8')}}, {{ trans('fd_one_step_one.tt_9')}}, {{ trans('fd_one_step_one.tt_10')}} </li>
    <li>{{ trans('fd_one_step_one.tt_11')}}</li>
    <li>{{ trans('fd_one_step_one.tt_12')}}</li>
</ul>
</body>
</html>
