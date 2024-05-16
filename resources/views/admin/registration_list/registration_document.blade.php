<table class="table table-bordered">
    <tr>
        <th>নথির নাম</th>
        <th></th>
        <th>নথি দেখুন</th>
    </tr>


    <tr>
        <td>পরিচালন পরিকল্পনা</td>
        <td></td>
        <td>

            <a target="_blank" class="btn btn-sm btn-success" href="{{ route('formOnePdf',['main_id'=>$form_one_data->id,'id'=>'plan']) }}" >
            <i class="fa fa-eye"></i>
        </a>


        @if(Route::is('addChildNote') || Route::is('viewChildNote'))

        <button  href="{{ route('formOnePdf',['main_id'=>$form_one_data->id,'id'=>'plan']) }}" class="btn btn-secondary" id="attLink1"  data-name="পরিচালন পরিকল্পনা"><i class="fa fa-paperclip"></i></button>
        <button  href="{{ route('formOnePdf',['main_id'=>$form_one_data->id,'id'=>'plan']) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
        @else

        @endif


    </td>
    </tr>


    {{-- <tr>
        <td>কর্মকর্তার স্বাক্ষর ও তারিখ সহ ফরম - ০১ এর ফাইনাল কপি </td>
        <td><a target="_blank" class="btn btn-sm btn-success" href="{{ route('formOnePdf',['main_id'=>$form_one_data->id,'id'=>'final_pdf']) }}">
            <i class="fa fa-eye"></i>
        </a></td>
    </tr> --}}


    {{-- <tr>
        <td>কর্মকর্তার স্বাক্ষর ও তারিখ সহ ফরম - ০৮ এর ফাইনাল কপি</td>
        <td><a target="_blank" class="btn btn-sm btn-success" href="{{ route('formEightPdf',['main_id'=>$form_one_data->id]) }}">
            <i class="fa fa-eye"></i>
        </a></td>
    </tr> --}}


    @foreach($all_source_of_fund as $all_get_all_source_of_fund_data)
    <tr>
        <td>
        সম্ভাব্য দাতার কাছ থেকে প্রতিশ্রুতির চিঠি(দাতা সংস্থার নাম)
        </td>
        <td>{{ $all_get_all_source_of_fund_data->name }}</td>
        <td>

            <a target="_blank" class="btn btn-sm btn-success" href="{{ route('sourceOfFund',$all_get_all_source_of_fund_data->id ) }}">
            <i class="fa fa-eye"></i>
        </a>

        @if(Route::is('addChildNote') || Route::is('viewChildNote'))

        <button  href="{{ route('sourceOfFund',$all_get_all_source_of_fund_data->id ) }}" class="btn btn-secondary" id="attLink1"  data-name="সম্ভাব্য দাতার কাছ থেকে প্রতিশ্রুতির চিঠি"><i class="fa fa-paperclip"></i></button>
        <button  href="{{ route('sourceOfFund',$all_get_all_source_of_fund_data->id ) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
        @else

        @endif


    </td>
    </tr>

    @endforeach

    @foreach($get_all_data_other as $key=>$all_get_all_data_other)

    <tr>
    <td>{{ $all_get_all_data_other->information_title }} {{ App\Http\Controllers\Admin\CommonController::englishToBangla($key+1) }}</td>
    <td></td>
    <td>

        <a  target="_blank" class="btn btn-sm btn-success" href="{{ route('otherPdfView',$all_get_all_data_other->id ) }}">
        <i class="fa fa-eye"></i>
    </a>
    @if(Route::is('addChildNote') || Route::is('viewChildNote'))

    <button  href="{{ route('otherPdfView',$all_get_all_data_other->id ) }}" class="btn btn-secondary" id="attLink1"  data-name="{{ $all_get_all_data_other->information_title }}"><i class="fa fa-paperclip"></i></button>
    <button  href="{{ route('otherPdfView',$all_get_all_data_other->id ) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
    @else

    @endif


</td>
</tr>
@endforeach

@foreach($form_member_data_doc as $key=>$all_form_member_data_doc)

<tr>
    <td>এনজিও  কর্মকর্তাদের  নথি {{ App\Http\Controllers\Admin\CommonController::englishToBangla($key+1) }}</td>
    <td></td>
    <td>

        <a  target="_blank" class="btn btn-sm btn-success" href="{{ route('ngoMemberDocPdfView',$all_form_member_data_doc->id ) }}">
        <i class="fa fa-eye"></i>
    </a>
    @if(Route::is('addChildNote') || Route::is('viewChildNote'))

    <button  href="{{ route('ngoMemberDocPdfView',$all_form_member_data_doc->id ) }}" class="btn btn-secondary" id="attLink1"  data-name="এনজিও  কর্মকর্তাদের  নথি {{ App\Http\Controllers\Admin\CommonController::englishToBangla($key+1) }}"><i class="fa fa-paperclip"></i></button>
    <button  href="{{ route('ngoMemberDocPdfView',$all_form_member_data_doc->id ) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
    @else

    @endif

</td>
</tr>

@endforeach

<tr>
    <td>এফডি -১ ফরম</td>
    <td></td>
    <td>

        <a target="_blank" class="btn btn-sm btn-success" href="{{ route('formOnePdfMain',['id'=>$form_one_data->id]) }}" >
        <i class="fa fa-eye"></i>
    </a>


    @if(Route::is('addChildNote') || Route::is('viewChildNote'))

    <button  href="{{ route('formOnePdfMain',['id'=>$form_one_data->id]) }}" class="btn btn-secondary" id="attLink1"  data-name="এফডি -১ ফরম"><i class="fa fa-paperclip"></i></button>
    <button  href="{{ route('formOnePdfMain',['id'=>$form_one_data->id]) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
    @else

    @endif


</td>
</tr>

@foreach($form_ngo_data_doc as $key=>$all_form_member_data_doc)
<?php

$ngoTypeInfo = DB::table('ngo_type_and_languages')->where('user_id',$form_one_data->user_id)->value('ngo_type');

?>

@if($ngoTypeInfo == 'দেশিও')
<tr>
    <td>

        @if($key+1 == 1)
    ফরম - ৮ অনুযায়ী সংস্থার কার্যনির্বাহী কমিটির সদস্যদের তালিকা

    @elseif($key+1 == 2)


 নির্বাহী কমিটির সদস্যদের পাসপোর্ট সাইজের ছবিসহ জাতীয় পরিচয়পত্রে সত্যায়িত অনুলিপি


@elseif($key+1 == 3)


প্রাথমিক নিবন্ধনকারী কতৃপক্ষের অনুমোদিত নির্বাহী কমিটির তালিকা ও নিবন্ধন সনদপত্রের সত্যায়িত অনুলিপি


@elseif($key+1 == 4)


গঠনতন্ত্রের (প্রাথমিক নিবন্ধন কতৃপক্ষ কতৃক অনুমোদিত ) সত্যায়িত অনুলিপি


@elseif($key+1 == 5)



সংস্থার কার্যক্রম প্রতিবেদন




@elseif($key+1 == 6)


দাতা সংস্থার প্রতিশ্রুতিপত্র (সংস্থার প্রধান কতৃক সত্যায়িত )



@elseif($key+1 == 7)


সংস্থার নির্বাহী কমিটি গঠন সংক্রান্ত সাধারণ সভার কার্যবিবরণীর সত্যায়িত অনুলিপি (উপস্থিত সাধারণ সদস্যদের উপস্থিতির স্বাক্ষরিত তালিকাসহ )

@elseif($key+1 == 8)


সংস্থার সাধারণ সদস্যদের নামের তালিকা (প্রত্যেক সদস্যদের স্বাক্ষরসহ নাম, পিতা /মাতা, স্বামী/স্ত্রী'র নাম ও ঠিকানা ,জাতীয় পরিচয়পত্র নম্বর )

@endif
    </td>
    <td></td>
    <td>

        <a  target="_blank" class="btn btn-sm btn-success" href="{{ route('ngoDocPdfView',$all_form_member_data_doc->id ) }}">
        <i class="fa fa-eye"></i>
    </a>


    @if(Route::is('addChildNote') || Route::is('viewChildNote'))


    @if($key+1 == 1)

    <button  href="{{ route('ngoDocPdfView',$all_form_member_data_doc->id ) }}" class="btn btn-secondary" id="attLink1"  data-name="ফরম - ৮ অনুযায়ী সংস্থার কার্যনির্বাহী কমিটির সদস্যদের তালিকা"><i class="fa fa-paperclip"></i></button>
@elseif($key+1 == 2)




<button  href="{{ route('ngoDocPdfView',$all_form_member_data_doc->id ) }}" class="btn btn-secondary" id="attLink1"  data-name="নির্বাহী কমিটির সদস্যদের পাসপোর্ট সাইজের ছবিসহ জাতীয় পরিচয়পত্রে সত্যায়িত অনুলিপি"><i class="fa fa-paperclip"></i></button>
@elseif($key+1 == 3)




<button  href="{{ route('ngoDocPdfView',$all_form_member_data_doc->id ) }}" class="btn btn-secondary" id="attLink1"  data-name="প্রাথমিক নিবন্ধনকারী কতৃপক্ষের অনুমোদিত নির্বাহী কমিটির তালিকা ও নিবন্ধন সনদপত্রের সত্যায়িত অনুলিপি"><i class="fa fa-paperclip"></i></button>
@elseif($key+1 == 4)




<button  href="{{ route('ngoDocPdfView',$all_form_member_data_doc->id ) }}" class="btn btn-secondary" id="attLink1"  data-name="গঠনতন্ত্রের (প্রাথমিক নিবন্ধন কতৃপক্ষ কতৃক অনুমোদিত ) সত্যায়িত অনুলিপি"><i class="fa fa-paperclip"></i></button>
@elseif($key+1 == 5)






<button  href="{{ route('ngoDocPdfView',$all_form_member_data_doc->id ) }}" class="btn btn-secondary" id="attLink1"  data-name="সংস্থার কার্যক্রম প্রতিবেদন"><i class="fa fa-paperclip"></i></button>

@elseif($key+1 == 6)



<button  href="{{ route('ngoDocPdfView',$all_form_member_data_doc->id ) }}" class="btn btn-secondary" id="attLink1"  data-name="দাতা সংস্থার প্রতিশ্রুতিপত্র (সংস্থার প্রধান কতৃক সত্যায়িত )"><i class="fa fa-paperclip"></i></button>
@elseif($key+1 == 7)



<button  href="{{ route('ngoDocPdfView',$all_form_member_data_doc->id ) }}" class="btn btn-secondary" id="attLink1"  data-name="কোড নং -১-০৩২৩-০০০০-১৮৩৬-এ তফসিল-১ নির্ধারিত ফি জমা প্রদান করে ট্রেজারি চালানের মূল কপিসহ"><i class="fa fa-paperclip"></i></button>
@elseif($key+1 == 8)



<button  href="{{ route('ngoDocPdfView',$all_form_member_data_doc->id ) }}" class="btn btn-secondary" id="attLink1"  data-name="সংস্থার নির্বাহী কমিটি গঠন সংক্রান্ত সাধারণ সভার কার্যবিবরণীর সত্যায়িত অনুলিপি (উপস্থিত সাধারণ সদস্যদের উপস্থিতির স্বাক্ষরিত তালিকাসহ )"><i class="fa fa-paperclip"></i></button>
@elseif($key+1 == 9)

<button  href="{{ route('ngoDocPdfView',$all_form_member_data_doc->id ) }}" class="btn btn-secondary" id="attLink1"  data-name="সংস্থার সাধারণ সদস্যদের নামের তালিকা (প্রত্যেক সদস্যদের স্বাক্ষরসহ নাম, পিতা /মাতা, স্বামী/স্ত্রী'র নাম ও ঠিকানা ,জাতীয় পরিচয়পত্র নম্বর )"><i class="fa fa-paperclip"></i></button>
@endif







    <button  href="{{ route('ngoMemberDocPdfView',$all_form_member_data_doc->id ) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
    @else

    @endif

</td>
</tr>
@else
<tr>
    @if($key+1 == 1)
    FD - 1 Form
    @elseif($key+1 == 2)
    Form No - 8

@elseif($key+1 == 3)
    <td>Certificate Of Incorporation in the Country Of Origin</td>
    @elseif($key+1 == 4)
    <td>Constitution</td>
    @elseif($key+1 == 5)
    <td>Activities Report</td>
    @elseif($key+1 == 6)
    <td>Decision Of the Committee/Board To Open Office In Bangladesh</td>
    @elseif($key+1 == 7)
 <td>Deed Of Agreement Stamp Of TK.300/-with the landlord in Support Of Opening the Office In Bangladesh</td>
    @elseif($key+1 == 8)
    <td>Letter Of Intent</td>

    @endif
    <td></td>
    <td>

        <a  target="_blank" class="btn btn-sm btn-success" href="{{ route('ngoDocPdfView',$all_form_member_data_doc->id ) }}">
        <i class="fa fa-eye"></i>
    </a>




</td>
</tr>

@endif

@endforeach
<tr>
    <td>কোড নং -১-০৩২৩-০০০০-১৮৩৬-এ তফসিল-১ নির্ধারিত ফি জমা প্রদান করে ট্রেজারি চালানের মূল কপিসহ</td>
    <td></td>
    <td>

        <a target="_blank" class="btn btn-sm btn-success" href="{{ route('formOnePdf',['main_id'=>$form_one_data->id,'id'=>'invoice']) }}">
        <i class="fa fa-eye"></i>
    </a>
    @if(Route::is('addChildNote') || Route::is('viewChildNote'))

    <button  href="{{ route('formOnePdf',['main_id'=>$form_one_data->id,'id'=>'invoice']) }}" class="btn btn-secondary" id="attLink1"  data-name="চালানের কপি"><i class="fa fa-paperclip"></i></button>
    <button  href="{{ route('formOnePdf',['main_id'=>$form_one_data->id,'id'=>'invoice']) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
    @else

    @endif

</td>
</tr>
<tr>
    <td>প্রদেয় ফি এর উপর জাতীয় রাজস্ব বোর্ডের নির্ধারিত কোড নং- ১-১১৩৩- ০০৩৫-০৩১১ এ ১৫% ভ্যাট বাবদ অর্থ জমা প্রদান করে ট্রেজারি চালানের মূলকপিসহ</td>
    <td></td>
    <td>

        <a target="_blank" class="btn btn-sm btn-success" href="{{ route('formOnePdf',['main_id'=>$form_one_data->id,'id'=>'treasury_bill']) }}">
        <i class="fa fa-eye"></i>
    </a>
    @if(Route::is('addChildNote') || Route::is('viewChildNote'))

    <button  href="{{ route('formOnePdf',['main_id'=>$form_one_data->id,'id'=>'treasury_bill']) }}" class="btn btn-secondary" id="attLink1"  data-name="ট্রেজারি চালানের মূলকপি"><i class="fa fa-paperclip"></i></button>
    <button  href="{{ route('formOnePdf',['main_id'=>$form_one_data->id,'id'=>'treasury_bill']) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
    @else

    @endif

</td>
</tr>
<?php



?>

@if(count($form_member_data_doc_renew) == 0)


@else
@foreach($form_member_data_doc_renew as $all)
<tr>
    <td>বিগত ১০(দশ) বছরে বৈদেশিক অনুদানে পরিচালত কার্যক্রমের বিবরণ (প্রকল্প ওয়ারী তথাদির সংক্ষিপ্তসার সংযুক্ত করতে হবে)</td>
    <td></td>
    <td><a target="_blank" class="btn btn-sm btn-success" href="{{ route('renewPdfList',['main_id'=>$form_one_data->user_id,'id'=>'f']) }}">
        <i class="fa fa-eye"></i>
    </a></td>
</tr>


<tr>
    <td>সংস্থার সম্ভাব্য/প্রত্যাশিত বার্ষিক বাজেট (উৎসসহ)</td>
    <td></td>
    <td><a target="_blank" class="btn btn-sm btn-success" href="{{ route('renewPdfList',['main_id'=>$form_one_data->user_id,'id'=>'y']) }}">
        <i class="fa fa-eye"></i>
    </a></td>
</tr>


<tr>
    <td>নিবন্ধন ফি ও ভ্যাট পরিশোধ করা হয়েছে কিনা (চালানের কপি সংযুক্ত করতে হবে)</td>
    <td></td>
    <td><a target="_blank" class="btn btn-sm btn-success" href="{{ route('renewPdfList',['main_id'=>$form_one_data->user_id,'id'=>'c']) }}">
        <i class="fa fa-eye"></i>
    </a></td>
</tr>


<tr>
    <td>তফসিল-১ এ বর্ণিত যেকোন ফি এর ভ্যাট বকেয়া থাকলে পরিশোধ করা হয়েছে কিনা (চালানের কপি সংযুক্ত করতে হবে)</td>
    <td></td>
    <td><a target="_blank" class="btn btn-sm btn-success" href="{{ route('renewPdfList',['main_id'=>$form_one_data->user_id,'id'=>'d']) }}">
        <i class="fa fa-eye"></i>
    </a></td>
</tr>


<tr>
    <td>ব্যাংক হিসাব নম্বর পরিবর্তন হয়ে থাকলে ব্যুরোর অনুমদনপত্রের কপি সংযুক্ত করতে হবে</td>
    <td></td>
    <td><a target="_blank" class="btn btn-sm btn-success" href="{{ route('renewPdfList',['main_id'=>$form_one_data->user_id,'id'=>'ch']) }}">
        <i class="fa fa-eye"></i>
    </a></td>
</tr>
@endforeach
@endif

</table>
