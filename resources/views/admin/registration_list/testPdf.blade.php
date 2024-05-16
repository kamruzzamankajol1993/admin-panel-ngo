<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>

        @font-face {
            font-family: myFirstFont;
            src: url('assets/font/MTCORSVA.TTF');
        }
    

        body
      	{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-size: 21px;
            font-family: myFirstFont, serif;
            font-weight: bold;
        }

        .pdf_back {
            height: 8.5in;
            width: 11in;
        }

        .content {
            padding: .6in;
        }

        table
        {
            width: 100%;
        }

        .first_table {
            margin-top: 2.81in;
        }

        .second_table
        {
            margin-top: .45in;
        }

        .forth_table
        {
            margin-top: 11px;
        }
        .fifth_table
        {
            margin-top: 56px;
        }

    </style>
</head>
<body>

  <div class="pdf_back">
    <div class="content">
        <table class="first_table">
            <tr>
                <td style="padding-left:32%;">{{ $form_one_data->registration_number}}</td>
                <td style="padding-left: 32%;">15/10/30</td>
            </tr>
        </table>
        <table class="second_table">
            <tr>
                <td style="padding-left: 28%;">Action For Rural Poor (ARP)</td>
            </tr>
            <tr>
                <td style="padding-top: 8px">asdsadasdsa</td>
            </tr>
        </table>
        <table class="third_table">
            <tr>
                <td style="padding-left: 8%; padding-top: 6px;">{{ $form_one_data->address_of_head_office_eng }}</td>
            </tr>
        </table>
        <table class="forth_table">
            <tr>
                <td style="padding-left: 7%">{{date('d-m-Y', strtotime($duration_list_all->start_date ))}}</td>
                <td style="padding-left: 5%">{{date('d-m-Y', strtotime($duration_list_all->end_date ))}}</td>
            </tr>
        </table>
        <table class="fifth_table">
            <tr>
                <td style="padding-left: 50%;">{{ $word1 }} <span style="padding-left: 45%">{{ $word }}</span> </td>
            </tr>
            <tr>
                <td style="padding-left: 50px">{{ $newmonth }}</td>
            </tr>
        </table>
    </div>
</div>


    <!-- <div class="certificate_box">
        <div class="certificate_background">

            Registration Number: {{ $form_one_data->registration_number }}<br>
            Name: {{ $form_one_data->organization_name }}<br>
            Address: {{ $form_one_data->address_of_head_office_eng }}<br>
            From: {{date('d-m-Y', strtotime($duration_list_all->start_date ))}}<br>
            To: {{date('d-m-Y', strtotime($duration_list_all->end_date ))}}<br>
            date: {{ $word1 }}<br>
            year: {{ $word }}<br>
            month: {{ $newmonth }}<br>

    </div>

    </div>-->
</body>
</html>
