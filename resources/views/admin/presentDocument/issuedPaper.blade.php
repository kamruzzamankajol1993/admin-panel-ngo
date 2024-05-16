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
            margin: 25px 0;
        }

        .bt{
  /* font-family: 'banglabold', sans-serif; */
  font-weight: bold;
}
    </style>
</head>
<body>

    <?php
$potroZariListValue =  DB::table('nothi_details')
                ->where('noteId',$id)
                ->where('nothId',$nothiId)
                ->where('dakId',$parentId)
                ->where('dakType',$status)
                ->value('permission_status');



    ?>

<div class="upper_section">
    <img src="{{ asset('/') }}public/pdfLogo.png" alt="" style="height: 80px;width:80px;">
    <div class="text_section">
        <p>গণপ্রজাতন্ত্রী বাংলাদেশ সরকার <br>
            মন্ত্রণালয়ের নাম লিখুন <br>
            এনজিও বিষয়ক ব্যুরো <br>
            সহকারী পরিচালক-১ (নিবন্ধন ও নবায়ন শাখা) <br>
            আগারগাঁও, শেরেবাংলানগর <br>
            ঢাকা-১২০৭</p>
    </div>
</div>

<?php
$nothiApproverList = DB::table('nothi_approvers')->where('nothiId',$nothiId)
       ->where('status',$status)
       ->where('noteId',$id)->first();


if(!$nothiApproverList){
    $appSignature ='';
        $appName = '';
        $desiName = '';
        $dateApp = '';
        $dateAppBan='';
        $aphone = '';
        $aemail = '';

}else{





       $nothiApproverLista = DB::table('admins')->where('id',$nothiApproverList->adminId)
       ->first();

       if(!$nothiApproverLista){

        $appSignature ='';
        $appName = '';
        $desiName = '';
        $aphone = '';
        $aemail = '';

       }else{

        $designationName = DB::table('designation_lists')
                ->where('id',$nothiApproverLista->designation_list_id)
                ->value('designation_name');

                $appSignature =$nothiApproverLista->admin_sign;
        $appName = $nothiApproverLista->admin_name_ban;
        $desiName = $designationName;
        $aphone = $nothiApproverLista->admin_mobile;
        $aemail = $nothiApproverLista->email;

       }


       $dateApp =  App\Http\Controllers\Admin\CommonController::englishToBangla(date('d F Y', strtotime($nothiApproverList->created_at)));
       $dateAppBan =  $nothiApproverList->bangla_date;
    }



?>
@foreach($officeDetail as $officeDetails)
<?php
$potrangshoDraft =  DB::table('potrangsho_drafts')
                  ->where('sarokId',$officeDetails->id)
                  ->where('status',$status)
                  ->orderBy('id','desc')
                  ->first();

  ?>
<table class="pdf_table">
    <tr>
        <td style="font-weight:bold;">
        <span style="">স্মারক নম্বর:</span> @if(!$potrangshoDraft)
{{ App\Http\Controllers\Admin\CommonController::englishToBangla($nothiNumber) }}
@else
<div style="display: flex;">
@if(($potrangshoDraft->SentStatus == 0)&&($potrangshoDraft->adminId == Auth::guard('admin')->user()->id))
{!! $potrangshoDraft->sarok_number !!}
@else
{!! $officeDetails->sarok_number !!}
@endif
</div>

@endif
        </td>
        <td style="text-align: right">
            <table class="pdf_table">
                <tr>
                    <td style="width: 58%;font-weight:bold;"><span class="bt">তারিখ:</span></td>
                    <td style="text-align: left; padding-left: 10px;">
                        @if($potroZariListValue == 1)
                        {{ $dateAppBan }} বঙ্গাব্দ  <br> {{ $dateApp }} খ্রিস্টাব্দ
                        @else

                        @endif
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>





@if(!$potrangshoDraft)

@else

@if(($potrangshoDraft->SentStatus == 0)&&($potrangshoDraft->adminId == Auth::guard('admin')->user()->id))

<table class="pdf_table">
    <tr style="font-weight:bold;">
        <td style="width: 7%;font-weight:bold;"> বিষয়: </td>
        <td>{!! $potrangshoDraft->office_subject !!} </td>
    </tr>
</table>

@if($potrangshoDraft->office_sutro == '<p>(যদি থাকে):...............................................</p>')

@else
<table class="pdf_table">
    <tr>
        <td style="width: 5%;font-weight:bold;"> সূত্র:</td>
        <td> {!! $potrangshoDraft->office_sutro !!}</td>
    </tr>
</table>
@endif
<table class="pdf_table">
    <tr>
        <td>{!! $potrangshoDraft->description !!}</td>
    </tr>
</table>

@else
<table class="pdf_table">
    <tr style="font-weight:bold;">
        <td style="width: 7%;font-weight:bold;"> বিষয়: </td>
        <td>{!! $officeDetails->office_subject !!} </td>
    </tr>
</table>

@if($officeDetails->office_sutro == '<p>(যদি থাকে):...............................................</p>')

@else
<table class="pdf_table">
    <tr>
        <td style="width: 5%;font-weight:bold;"> সূত্র:</td>
        <td> {!! $officeDetails->office_sutro !!}</td>
    </tr>
</table>
@endif
<table class="pdf_table">
    <tr>
        <td>{!! $officeDetails->description !!}</td>
    </tr>
</table>

@endif


@endif


<?php
    $potroZariListValue =  DB::table('nothi_details')
                    ->where('noteId',$id)
                    ->where('nothId',$nothiId)
                    ->where('dakId',$parentId)
                    ->where('dakType',$status)
                    ->value('permission_status');



        ?>
<table class="pdf_table">
    <tr>
        <td style="width:80%"></td>
        <td style="text-align:center; line-height:1">
            @if($potroZariListValue == 1)

            @if(!$nothiApproverList)

            @else
            <img src="{{ asset('/') }}{{ $appSignature }}" style="height:30px;"/>
            @endif

            @else
            @endif
            <p>{{ $appName }}</p>
           <p>{{ $desiName }}</p>

           @if(!$potrangshoDraft)

           @else

           @if(($potrangshoDraft->SentStatus == 0)&&($potrangshoDraft->adminId == Auth::guard('admin')->user()->id))

           @if(empty($potrangshoDraft->extra_text ) || $potrangshoDraft->extra_text == '<p>..........</p>')

           @else
           {!! $potrangshoDraft->extra_text !!}
           @endif
           @else
           @if(empty($officeDetails->extra_text ) || $officeDetails->extra_text == '<p>..........</p>')

           @else
           {!! $officeDetails->extra_text !!}
           @endif
           @endif


           @endif
<p>ফোন :{{ $aphone }}</p>
<p>ইমেইল : {{ $aemail }}</p>


        </td>
    </tr>
    @foreach($nothiPropokListUpdate as $nothiPropokLists)
    <tr>


        @if(empty($nothiPropokLists->organization_name))
        <td colspan="2">{{ $nothiPropokLists->otherOfficerDesignation }}, এনজিও বিষয়ক ব্যুরো, প্লট-ই-১৩/বি, আগারগাঁও। শেরেবাংলা নগর, ঢাকা-১২০৭। </td>
         @else
         <td colspan="2">{{ $nothiPropokLists->otherOfficerDesignation }}, {{ $nothiPropokLists->organization_name }}, {{ $nothiPropokLists->otherOfficerAddress }}। </td>
        @endif
    </tr>
    @endforeach
</table>
<table class="pdf_table">
    <tr>
        <td style="font-weight:bold;">দৃষ্টি আকর্ষণ:</td>
    </tr>
    @foreach($nothiAttractListUpdate as $nothiPropokLists)
    <tr>


        @if(empty($nothiPropokLists->organization_name))
        <td style="padding-left:20px; padding-top: 10px;"> {{ $nothiPropokLists->otherOfficerDesignation }}, এনজিও বিষয়ক ব্যুরো, প্লট-ই-১৩/বি, আগারগাঁও। শেরেবাংলা নগর, ঢাকা-১২০৭। </td>
                                                                         @else
                                                                         <td style="padding-left:20px; padding-top: 10px;">  {{ $nothiPropokLists->otherOfficerDesignation }}, {{ $nothiPropokLists->organization_name }}, {{ $nothiPropokLists->otherOfficerAddress }}। </td>
                                                                        @endif
    </tr>
    @endforeach
</table>

@if(count($nothiCopyListUpdate) == 0)

@else
<table class="pdf_table">
    <tr>
        <td style="font-weight:bold;">স্মারক নম্বর:  @if(!$potrangshoDraft)
            {{ App\Http\Controllers\Admin\CommonController::englishToBangla($nothiNumber) }}
            @else
            <div style="display: flex;">
            @if(($potrangshoDraft->SentStatus == 0)&&($potrangshoDraft->adminId == Auth::guard('admin')->user()->id))
            {!! $potrangshoDraft->sarok_number !!}
            @else
            {!! $officeDetails->sarok_number !!}
            @endif
            </div>

            @endif</td>
        <td style="text-align: right">
            <table class="pdf_table">
                <tr>
                    <td style="width: 58%;font-weight:bold;">তারিখ:</td>
                    <td style="text-align: left; padding-left: 10px;">
                        @if($potroZariListValue == 1)
                        {{ $dateAppBan }} বঙ্গাব্দ  <br> {{ $dateApp }} খ্রিস্টাব্দ
                        @else

                        @endif
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
@endif

@if(count($nothiCopyListUpdate) == 0)

@else
<table class="pdf_table">
    <tr>
        <td style="font-weight:bold;">সদয় জ্ঞাতার্থে/জ্ঞাতার্থে (জ্যেষ্ঠতার ক্রমানুসারে নয়):</td>
    </tr>
    @foreach($nothiCopyListUpdate as $key=>$nothiPropokLists)
    <tr>


        @if(empty($nothiPropokLists->organization_name))
        @if(count($nothiCopyListUpdate) == ($key+1))
        <td style="padding-left:20px; padding-top: 10px;">{{ App\Http\Controllers\Admin\CommonController::englishToBangla($key+1) }} | {{ $nothiPropokLists->otherOfficerDesignation }}, এনজিও বিষয়ক ব্যুরো</span>, প্লট-ই-১৩/বি, আগারগাঁও। শেরেবাংলা নগর, ঢাকা-১২০৭।</td>
        @else
        <td style="padding-left:20px; padding-top: 10px;">{{ App\Http\Controllers\Admin\CommonController::englishToBangla($key+1) }} | {{ $nothiPropokLists->otherOfficerDesignation }}, এনজিও বিষয়ক ব্যুরো</span>, প্লট-ই-১৩/বি, আগারগাঁও। শেরেবাংলা নগর, ঢাকা-১২০৭;</td>

        @endif
        @else


        @if(count($nothiCopyListUpdate) == ($key+1))
        <td style="padding-left:20px; padding-top: 10px;">{{ App\Http\Controllers\Admin\CommonController::englishToBangla($key+1) }} | {{ $nothiPropokLists->otherOfficerDesignation }}, {{ $nothiPropokLists->organization_name }}</span>,{{ $nothiPropokLists->otherOfficerAddress }}।</td>
        @else
        <td style="padding-left:20px; padding-top: 10px;">{{ App\Http\Controllers\Admin\CommonController::englishToBangla($key+1) }} | {{ $nothiPropokLists->otherOfficerDesignation }}, {{ $nothiPropokLists->organization_name }}</span>,{{ $nothiPropokLists->otherOfficerAddress }};</td>

        @endif



        @endif


    </tr>
    @endforeach

</table>

<table class="pdf_table">
    <tr>
        <td style="width:80%"></td>
        <td style="text-align:center; line-height:1">
            @if($potroZariListValue == 1)

            @if(!$nothiApproverList)

            @else
            <img src="{{ asset('/') }}{{ $appSignature }}" style="height:30px;"/>
            @endif

            @else
            @endif
            <p>{{ $appName }}</p>
           <p>{{ $desiName }}</p>
           @if(!$potrangshoDraft)

           @else

           @if(($potrangshoDraft->SentStatus == 0)&&($potrangshoDraft->adminId == Auth::guard('admin')->user()->id))

           @if(empty($potrangshoDraft->extra_text ) || $potrangshoDraft->extra_text == '<p>..........</p>')

           @else
           {!! $potrangshoDraft->extra_text !!}
           @endif
           @else
           @if(empty($officeDetails->extra_text ) || $officeDetails->extra_text == '<p>..........</p>')

           @else
           {!! $officeDetails->extra_text !!}
           @endif
           @endif


           @endif
<p>ফোন :{{ $aphone }}</p>
<p>ইমেইল : {{ $aemail }}</p>

        </td>
    </tr>

</table>
@endif
@endforeach
</body>
</html>
