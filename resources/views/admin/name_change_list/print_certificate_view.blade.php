<!DOCTYPE html>
<html>
<head>
    <title>PDF</title>
    <style>

        body {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-size: 16px;
           /* font-family: bangla, serif; */
            font-weight: bold;
        }

        .pdf_back {
            height: 8.5in;
            width: 11in;
           /* background-image: url('public/namechange.jpg'); */
            background-position: center;
            background-repeat: no-repeat;
            background-size: 100% 100%;
        }

        .content {
            padding: .6in;
        }

        table
        {
            width: 100%;
        }

        .first_table {
            margin-top: 2.7in;
        }

        .second_table
        {
            margin-top: .35in;
        }

        .para_first
        {
            padding-top: 2px;
            height: 55px;
            line-height: 1.6;
            vertical-align:top;
        }

        .third_table
        {
            margin-top:-22px;
        }

        .para_first1
        {
            padding-top: 1px;
            height: 50px;
            line-height: 1.6;
            vertical-align:top;
        }

        .para_first1 p
        {
            text-indent: 50px;
        }

        .forth_table
        {
            margin-top: -10px;
        }
        .fifth_table
        {
            margin-top: 27px;
        }
    </style>
</head>
<body>

<div class="pdf_back">
    <div class="content">
        <table class="first_table">
            <tr>
                <td style="padding-left:24%;font-size:20px;">{{ App\Http\Controllers\Admin\CommonController::englishToBangla($form_one_data->registration_number) }}</td>
                <td style="padding-left: 20%;font-size:20px;">


                    @if($ngoTypeData->ngo_type_new_old == 'Old')

                    {{App\Http\Controllers\Admin\CommonController::englishToBangla(date('d/m/Y', strtotime($ngoTypeData->ngo_registration_date )))}}

                    @else

                    {{App\Http\Controllers\Admin\CommonController::englishToBangla(date('d/m/Y', strtotime($duration_list_all->ngo_duration_start_date )))}}

                    @endif


                </td>
            </tr>
        </table>
        <table class="second_table">
            <tr>
                <td class="para_first">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-weight:bolder;font-size:20px;">{{ $nameChangeDetail->previous_name_ban }}.</span>
                </td>
            </tr>
        </table>
        <table class="third_table">
            <tr>
                <td class="para_first1">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-weight:bolder;font-size:20px;">{{ $nameChangeDetail->present_name_ban }}.</span>
                </td>
            </tr>
        </table>
        <table class="forth_table">


            <tr>
                <td style="padding-left: 50%;font-size:20px;">
                    @if($ngoTypeData->ngo_type_new_old == 'Old')

                    {{App\Http\Controllers\Admin\CommonController::englishToBangla(date('d/m/Y', strtotime($ngoTypeData->ngo_registration_date )))}}

                    @else

                    {{App\Http\Controllers\Admin\CommonController::englishToBangla(date('d/m/Y', strtotime($duration_list_all->ngo_duration_start_date )))}}

                    @endif

                </td>

            </tr>

        </table>

        <?php

           $signDate = date('Y-m-d');

        ?>
        <table class="fifth_table">
            <tr>
                <td style="padding-left: 29%;font-size:20px;">
                    <p>{{App\Http\Controllers\Admin\CommonController::englishToBangla(date('d/m/Y', strtotime($signDate )))}}</p>
                </td>

            </tr>

        </table>
    </div>
</div>

</body>
</html>
