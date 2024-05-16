
<div class="mb-0 m-t-30">
    <table class="table table-bordered">
        <tr>

            <th>নথি দেখুন</th>
            @if(Route::is('addChildNote') || Route::is('viewChildNote'))
            <th></th>
            @endif
        </tr>




        <tr>
            <td>


        <a target="_blank"  href="{{ route('constitutionInfoPdf',['id'=>$dataFromConstitution->id,'title'=>'file_one']) }}" >
            প্রাথমিক নিবন্ধনকারী কর্তৃপক্ষের অনুমোদিত গঠনতন্ত্রের সত্যায়িত কপি
       </a>
    </td>
    @if(Route::is('addChildNote') || Route::is('viewChildNote'))
<td>
<button  href="{{ route('constitutionInfoPdf',['id'=>$dataFromConstitution->id,'title'=>'file_one']) }}" class="btn btn-secondary" id="attLink1"  data-name="প্রাথমিক নিবন্ধনকারী কর্তৃপক্ষের অনুমোদিত গঠনতন্ত্রের সত্যায়িত কপি"><i class="fa fa-paperclip"></i></button>
<button  href="{{ route('constitutionInfoPdf',['id'=>$dataFromConstitution->id,'title'=>'file_one']) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
</td>

@else

@endif

</tr>




<tr>
    <td>


<a target="_blank"  href="{{ route('constitutionInfoPdf',['id'=>$dataFromConstitution->id,'title'=>'file_two']) }}" >
    সংস্থার চেয়ারম্যান ও সেক্রেটারী কর্তৃক যৌথ স্বাক্ষরিত গঠনতন্ত্রের পরিচ্ছন্ন কপি
</a>
</td>

@if(Route::is('addChildNote') || Route::is('viewChildNote'))
<td>
<button  href="{{ route('constitutionInfoPdf',['id'=>$dataFromConstitution->id,'title'=>'file_two']) }}" class="btn btn-secondary" id="attLink1"  data-name="সংস্থার চেয়ারম্যান ও সেক্রেটারী কর্তৃক যৌথ স্বাক্ষরিত গঠনতন্ত্রের পরিচ্ছন্ন কপি"><i class="fa fa-paperclip"></i></button>
<button  href="{{ route('constitutionInfoPdf',['id'=>$dataFromConstitution->id,'title'=>'file_two']) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
</td>

@else

@endif

</tr>




<tr>
    <td>


<a target="_blank"  href="{{ route('constitutionInfoPdf',['id'=>$dataFromConstitution->id,'title'=>'file_three']) }}" >
    গঠনতন্ত্রের কোন ধারা, উপধারা পরিবর্তন ফি জমা প্রদানের চালানের মূলকপিসহ
</a>
</td>

@if(Route::is('addChildNote') || Route::is('viewChildNote'))
<td>
<button  href="{{ route('constitutionInfoPdf',['id'=>$dataFromConstitution->id,'title'=>'file_three']) }}" class="btn btn-secondary" id="attLink1"  data-name="গঠনতন্ত্রের কোন ধারা, উপধারা পরিবর্তন ফি জমা প্রদানের চালানের মূলকপিসহ"><i class="fa fa-paperclip"></i></button>
<button  href="{{ route('constitutionInfoPdf',['id'=>$dataFromConstitution->id,'title'=>'file_three']) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
</td>

@else

@endif

</tr>


<tr>
    <td>


<a target="_blank"  href="{{ route('constitutionInfoPdf',['id'=>$dataFromConstitution->id,'title'=>'file_four']) }}" >
    গঠনতন্ত্রের কোন ধারা, উপধারা পরিবর্তন ও সংযোজনের বিষয়ে সাধারণ কপি।
</a>
</td>

@if(Route::is('addChildNote') || Route::is('viewChildNote'))
<td>
<button  href="{{ route('constitutionInfoPdf',['id'=>$dataFromConstitution->id,'title'=>'file_four']) }}" class="btn btn-secondary" id="attLink1"  data-name="গঠনতন্ত্রের কোন ধারা, উপধারা পরিবর্তন ও সংযোজনের বিষয়ে সাধারণ কপি।"><i class="fa fa-paperclip"></i></button>
<button  href="{{ route('constitutionInfoPdf',['id'=>$dataFromConstitution->id,'title'=>'file_four']) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
</td>

@else

@endif

</tr>


<tr>
    <td>


<a target="_blank"  href="{{ route('constitutionInfoPdf',['id'=>$dataFromConstitution->id,'title'=>'file_five']) }}" >
    পূর্ববর্তী গঠনতন্ত্র ও বর্তমান গঠনতন্ত্রের তুলনামূলক বিবরণী (প্রতি পাতায় সভাপতি ও সম্পাদকের যৌথ স্বাক্ষরসহ)
</a>
</td>

@if(Route::is('addChildNote') || Route::is('viewChildNote'))
<td>
<button  href="{{ route('constitutionInfoPdf',['id'=>$dataFromConstitution->id,'title'=>'file_five']) }}" class="btn btn-secondary" id="attLink1"  data-name="পূর্ববর্তী গঠনতন্ত্র ও বর্তমান গঠনতন্ত্রের তুলনামূলক বিবরণী (প্রতি পাতায় সভাপতি ও সম্পাদকের যৌথ স্বাক্ষরসহ)"><i class="fa fa-paperclip"></i></button>
<button  href="{{ route('constitutionInfoPdf',['id'=>$dataFromConstitution->id,'title'=>'file_five']) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
</td>

@else

@endif

</tr>






    </table>
</div>
