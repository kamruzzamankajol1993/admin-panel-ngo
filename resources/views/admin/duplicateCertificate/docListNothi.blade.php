
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


        <a target="_blank"  href="{{ route('duplicateCertificatePdf',['id'=>$dataFromDuplicateCertificate->id,'title'=>'file_one']) }}" >
            'নিবদ্ধন/নবায়নের 'ডুপ্লিকেট' সনদ প্রাপ্তির জন্য আবেদন ফি বাবদ-১৩,০০০/-(তের হাজার) টাকার (কোড নং-১-০৩২৩-০০০০-১৮৩৬) চালানের কপি এবং ১৫% ভ্যাট (কোড নং-১-১১৩৩-০০৩৫-০৩১১)-প্রদানপূর্বক চালানের মুলকপিসহ
       </a>
    </td>
    @if(Route::is('addChildNote') || Route::is('viewChildNote'))
<td>
<button  href="{{ route('duplicateCertificatePdf',['id'=>$dataFromDuplicateCertificate->id,'title'=>'file_one']) }}" class="btn btn-secondary" id="attLink1"  data-name=" 'নিবদ্ধন/নবায়নের 'ডুপ্লিকেট' সনদ প্রাপ্তির জন্য আবেদন ফি বাবদ-১৩,০০০/-(তের হাজার) টাকার (কোড নং-১-০৩২৩-০০০০-১৮৩৬) চালানের কপি এবং ১৫% ভ্যাট (কোড নং-১-১১৩৩-০০৩৫-০৩১১)-প্রদানপূর্বক চালানের মুলকপিসহ"><i class="fa fa-paperclip"></i></button>
<button  href="{{ route('duplicateCertificatePdf',['id'=>$dataFromDuplicateCertificate->id,'title'=>'file_one']) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
</td>

@else

@endif

</tr>




<tr>
    <td>


<a target="_blank"  href="{{ route('duplicateCertificatePdf',['id'=>$dataFromDuplicateCertificate->id,'title'=>'file_two']) }}" >
    ০২টি জাতীয় পত্রিকায় (হারানো বা চুরি হওয়ার ক্ষেত্রে) বিজ্ঞাপনের (মূলকপিসহ) কপি
</a>
</td>

@if(Route::is('addChildNote') || Route::is('viewChildNote'))
<td>
<button  href="{{ route('duplicateCertificatePdf',['id'=>$dataFromDuplicateCertificate->id,'title'=>'file_two']) }}" class="btn btn-secondary" id="attLink1"  data-name="০২টি জাতীয় পত্রিকায় (হারানো বা চুরি হওয়ার ক্ষেত্রে) বিজ্ঞাপনের (মূলকপিসহ) কপি"><i class="fa fa-paperclip"></i></button>
<button  href="{{ route('duplicateCertificatePdf',['id'=>$dataFromDuplicateCertificate->id,'title'=>'file_two']) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
</td>

@else

@endif

</tr>




<tr>
    <td>


<a target="_blank"  href="{{ route('duplicateCertificatePdf',['id'=>$dataFromDuplicateCertificate->id,'title'=>'file_three']) }}" >
    হারানো বা চুরি হওয়ার ক্ষেত্রে সংশ্লিষ্ট জেলা/উপজেলার থানায় দাখিলকৃত ডায়েরির (জিডি'র) কপি
</a>
</td>

@if(Route::is('addChildNote') || Route::is('viewChildNote'))
<td>
<button  href="{{ route('duplicateCertificatePdf',['id'=>$dataFromDuplicateCertificate->id,'title'=>'file_three']) }}" class="btn btn-secondary" id="attLink1"  data-name="হারানো বা চুরি হওয়ার ক্ষেত্রে সংশ্লিষ্ট জেলা/উপজেলার থানায় দাখিলকৃত ডায়েরির (জিডি'র) কপি"><i class="fa fa-paperclip"></i></button>
<button  href="{{ route('duplicateCertificatePdf',['id'=>$dataFromDuplicateCertificate->id,'title'=>'file_three']) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
</td>

@else

@endif

</tr>


<tr>
    <td>


<a target="_blank"  href="{{ route('duplicateCertificatePdf',['id'=>$dataFromDuplicateCertificate->id,'title'=>'file_four']) }}" >
    সনদপত্রের 'ডুপ্লিকেট' কপির জন্য নির্বাহী কমিটির সভার সত্যায়িত কার্যবিবরণীর (উপস্থিত সদস্যদের হাজিরাসহ) কপি।
</a>
</td>

@if(Route::is('addChildNote') || Route::is('viewChildNote'))
<td>
<button  href="{{ route('duplicateCertificatePdf',['id'=>$dataFromDuplicateCertificate->id,'title'=>'file_four']) }}" class="btn btn-secondary" id="attLink1"  data-name="সনদপত্রের 'ডুপ্লিকেট' কপির জন্য নির্বাহী কমিটির সভার সত্যায়িত কার্যবিবরণীর (উপস্থিত সদস্যদের হাজিরাসহ) কপি।"><i class="fa fa-paperclip"></i></button>
<button  href="{{ route('duplicateCertificatePdf',['id'=>$dataFromDuplicateCertificate->id,'title'=>'file_four']) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
</td>

@else

@endif

</tr>








    </table>
</div>
