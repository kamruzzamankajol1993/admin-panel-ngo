<!DOCTYPE html>
<html>
<head>
    <title>FORM FD-1</title>

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
        <h5>FORM FD-1</h5>
        <p>
            [Under act 4(1) of the Foreign Donations (Voluntary Activities) Regulation Act, 2016]
             <br>
             <b>APPLICATION FOR REGISTRATION</b>
</p>
    </div>

<table>
    <tbody>
        <tr>
            <td>1.</td>
            <td colspan="4">Particulars of Organisation :</td>
        </tr>

        <tr>
            <td></td>
            <td class="number_section">(i)</td>
            <td>Name of Organization with Address</td>
            <td style="width:4px">:</td>

            <td>{{ $allformOneData->organization_name }} <br> Address: {{ $allformOneData->organization_address}}</td>

        </tr>

        <tr>
            <td></td>
            <td class="number_section">(iii)</td>
            <td>Registration Number</td>
            <td style="width:4px">:</td>
            <td>

                @if($allformOneData->registration_number == 0)

                @else



                {{ $allformOneData->registration_number }}

                @endif


            </td>
        </tr>
        <tr>
            <td></td>
            <td class="number_section">(iv)</td>
            <td>Country of Origin</td>
            <td style="width:4px">:</td>
            <td>{{ $allformOneData->country_of_origin }}</td>
        </tr>
        <tr>
            <td></td>
            <td class="number_section">(v)</td>
            <td>Address of the Principal/Head Office</td>
            <td style="width:4px">:</td>
            <td>

                {{ $allformOneData->address_of_head_office_eng  }}



            </td>
        </tr>
        <tr>
            <td></td>
            <td >(vi)</td>
            <td>Particulars of Head of the Organization in Bangladesh</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>a) Name</td>
            <td style="width:4px">:</td>
            <td>{{ $allformOneData->name_of_head_in_bd }}</td>
        </tr>

       <?php


                                   $getJobType =$allformOneData->job_type;


                                  ?>

        <tr>
            <td></td>
            <td></td>
            <td>b) Whether full-time or part-time</td>
            <td style="width:4px">:</td>
            <td>{{ $allformOneData->job_type }}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>c) Address with Telephone, Mobile & Email</td>
            <td style="width:4px">:</td>
            <td>{{ $allformOneData->organization_address }}, {{ $allformOneData->tele_phone_number }}, {{ $allformOneData->phone }}, {{ $allformOneData->email }}</td>
        </tr>

       <?php


                                    $getCityzendata = $allformOneData->citizenship;


                                  ?>
        <tr>
            <td></td>
            <td></td>
            <td>d) Citizenship (previous citizenship, if any to be mentioned also)</td>
            <td style="width:4px">:</td>
            <td>{{ $getCityzendata }}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>e) Profession (also describe present occupation)</td>
            <td style="width:4px">:</td>
            <td>{{ $allformOneData->profession }}</td>
        </tr>
        <tr>
            <td>2.</td>
            <td colspan="4">Field of proposed activities (details may please be enclosed)
            </td>
        </tr>
        <tr>
            <td></td>
            <td>a</td>
            <td>(i) Plan of Operation </td>
            <td style="width:4px">:</td>
            <td>@if(empty($allformOneData->plan_of_operation))

                @else



                attached


                @endif</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>(ii) Project Area (District and Upazila)</td>
            <td style="width:4px">:</td>
            <td>{{ $allformOneData->district }}</td>
        </tr>
        <tr>
            <td></td>
            <td>b</td>
            <td>Source (s) of Fund</td>
            <td></td>
        </tr>
        @foreach($get_all_source_of_fund_data as $all_get_all_source_of_fund_data)
        <tr>
            <td></td>
            <td></td>
            <td>(i) Please give names of organization (s) with address</td>
            <td style="width:4px">:</td>
            <td>{{ $all_get_all_source_of_fund_data->name }}, {{ $all_get_all_source_of_fund_data->address }}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>(ii) If there is/are letter(s) of commitment from prospective donor(s) (copies) thereof</td>
            <td style="width:4px">:</td>
            <td> @if(empty($all_get_all_source_of_fund_data->letter_file))

                @else


                attached


                @endif</td>
        </tr>
        @endforeach
        <tr>
            <td>3.</td>
            <td colspan="2">What is your expected Annual Budget (Foreign Currency Or Bangladeshi taka</td>
            <td style="width:4px">:</td>
            <td>

                {{ $allformOneData->annual_budget }}

                </td>
        </tr>
        <tr>
            <td>4.</td>
            <td colspan="4">Staff position (Particulars to be submitted in respect of 5 top executives in the following proforma in separate sheets)
            </td>
        </tr>
        @foreach($formOneMemberList as $key=>$allFormOneMemberList)
        <tr>


            <td></td>

            <td colspan="4">{{ $key+1}}. Staff {{$key+1 }}</td>


        </tr>
        <tr>
            <td></td>
            <td colspan="2" class="padding-left">(a) Name</td>
            <td style="width:4px">:</td>
            <td>{{ $allFormOneMemberList->name }}</td>
        </tr>
        <tr>
            <td></td>

            <td colspan="2" class="padding-left">(b) Designation</td>
            <td style="width:4px">:</td>
            <td>{{ $allFormOneMemberList->position }}</td>
        </tr>
        <tr>
            <td></td>

            <td colspan="2" class="padding-left">(c) Address</td>
            <td style="width:4px">:</td>
            <td>{{ $allFormOneMemberList->address }}</td>
        </tr>

      <?php

                                  $convetArray = explode(",",$allFormOneMemberList->citizenship);




                                    $getCityzendata = $allFormOneMemberList->citizenship;

                                  ?>
        <tr>
            <td></td>

            <td colspan="2" class="padding-left">(d) Citizenship (Must clearify, I duel citizenship)</td>
            <td style="width:4px">:</td>
            <td>
                                      {{ $allFormOneMemberList->citizenship }}
                                    </td>
        </tr>
        <tr>
            <td></td>

            <td colspan="2" class="padding-left">(e) Date of appoinment</td>
            <td style="width:4px">:</td>
            <td>
                {{ date('d-m-Y', strtotime($allFormOneMemberList->date_of_join)) }}

               </td>
        </tr>
        <tr>
            <td></td>

            <td colspan="2" class="padding-left">(f) Present emoluments</td>
            <td style="width:4px">:</td>
            <td>{{ $allFormOneMemberList->salary_statement }}</td>
        </tr>
        <tr>
            <td></td>

            <td colspan="2" class="padding-left">(g) Provide details if associated (in the past or at present) with any other Voluntry Organization (s)</td>
            <td style="width:4px">:</td>
            <td> {{ $allFormOneMemberList->other_occupation }}</td>
        </tr>
        @endforeach

        <tr>
            <td>5.</td>
            <td colspan="2">If registration fee has been paid (please enclouse supporting papers)
            </td>
            <td style="width:4px">:</td>
            <td>
                @if(empty($allformOneData->attach_the__supporting_paper))

                @else


                attached


                @endif</td>
        </tr>
        <tr>
            <td>6.</td>
            <td colspan="4">Name & Details of Consultant (s) If Proposed to be employed
            </td>
        </tr>
        @foreach($get_all_data_adviser as $key=>$all_get_all_data_adviser)
        <tr>

            <td></td>

            <td colspan="3">{{ $key+1 }}. Adviser {{ $key+1 }}</td>
            <td></td>


        </tr>
        <tr>
            <td></td>

            <td class="padding-left" colspan="2">(a) Advisor Name</td>
            <td style="width:4px">:</td>
            <td>{{ $all_get_all_data_adviser->name }}</td>
        </tr>
        <tr>
            <td></td>

            <td class="padding-left" colspan="2">(b) Detailed description</td>
            <td style="width:4px">:</td>
            <td> {{ $all_get_all_data_adviser->information	 }}</td>
        </tr>
        @endforeach
        <tr>
            <td>7.</td>
            <td colspan="4">Name, address and account No. of Bank in Bangladesh through: which the Foreign Donations would be received
            </td>
        </tr>
        @if(!$get_all_data_adviser_bank)

        @else
        <tr>
            <td></td>
            <td>(a)</td>
            <td>Account Number</td>
            <td style="width:4px">:</td>
            <td>
                {{ $get_all_data_adviser_bank->account_number }}
                </td>
        </tr>
        <tr>
            <td></td>
            <td>(b)</td>
            <td>Account Type</td>
            <td style="width:4px">:</td>
            <td>{{ $get_all_data_adviser_bank->account_type }}</td>
        </tr>
        <tr>
            <td></td>
            <td>(c)</td>
            <td>Name of Bank</td>
            <td style="width:4px">:</td>
            <td>{{ $get_all_data_adviser_bank->name_of_bank }}</td>
        </tr>
        <tr>
            <td></td>
            <td>(d)</td>
            <td>Branch Name of Bank</td>
            <td style="width:4px">:</td>
            <td>{{ $get_all_data_adviser_bank->branch_name_of_bank }}</td>
        </tr>
        <tr>
            <td></td>
            <td>(e)</td>
            <td>Bank Address</td>
            <td style="width:4px">:</td>
            <td>{{ $get_all_data_adviser_bank->bank_address }}</td>
        </tr>
        @endif
        <tr>
            <td>8.</td>
            <td colspan="2">Any other information of significance which the applicant may like to furnish (Enclousure may be given)
            </td>
            <td style="width:4px">:</td>
            <td>
@foreach($get_all_data_other as $all_get_all_data_other)

@if(empty($all_get_all_data_other->information_title))

@else


attached


@endif

                @endforeach


            </td>
        </tr>

        </tbody>
    </table>
<h4 style="text-align:center; font-weight:bold; font-size:15px;margin-top: 100px">DECLARATION</h4>
<p>I hereby declare that, I have read the relevant Rules and Regulations and that the above particulars furnished by me are true and correct.</p>
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
        <td style="text-align: left; width:5%;">Name</td>
        <td style="width:30%; text-align: left;">: {{ $allformOneData->chief_name }}</td>
    </tr>
    <tr>
        <td style="width: 65%"></td>
        <td style="text-align: left; width: 5%;">Designation</td>
        <td style="width:30%; text-align: left;">: {{ $allformOneData->chief_desi }}</td>
    </tr>


    <tr>
        <td style="width: 65%"></td>
        <td style="text-align: left; width: 5%;">Place</td>
        <td style="width:30%; text-align: left;">: {{ $allformOneData->place }}</td>
    </tr>

    <tr>
        <td style="width: 65%"></td>
        <td style="text-align: left; width: 5%;">Date</td>

        <td style="width:30%; text-align: left;">:  {{ date('d/m/y', strtotime($allformOneData->created_at)) }}</td>

    </tr>
</table>

<ul style="margin-top:25px">
    <li>If the applicant is a foreigner, name, designation and signature of the top Bangladeshi Associate should be provided also. </li>
    <li>Separate Sheets as annexure may be attached.</li>
    <li>Application must be submitted by Chief Executive of organizations.</li>
</ul>
</body>
</html>
