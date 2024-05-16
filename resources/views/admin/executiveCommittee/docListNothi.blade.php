
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


        <a target="_blank"  href="{{ route('executiveCommitteeInfoPdf',['id'=>$dataFromCommittee->id,'title'=>'file_one']) }}" >
            ফরম নং-৮ মোতাবেক নির্বাহী কমিটির তালিকা (সভাপতি ও সম্পাদকের যৌথ স্বাক্ষরিত)
       </a>
    </td>
    @if(Route::is('addChildNote') || Route::is('viewChildNote'))
<td>
<button  href="{{ route('executiveCommitteeInfoPdf',['id'=>$dataFromCommittee->id,'title'=>'file_one']) }}" class="btn btn-secondary" id="attLink1"  data-name="ফরম নং-৮ মোতাবেক নির্বাহী কমিটির তালিকা (সভাপতি ও সম্পাদকের যৌথ স্বাক্ষরিত)"><i class="fa fa-paperclip"></i></button>
<button  href="{{ route('executiveCommitteeInfoPdf',['id'=>$dataFromCommittee->id,'title'=>'file_one']) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
</td>

@else

@endif

</tr>




<tr>
    <td>


<a target="_blank"  href="{{ route('executiveCommitteeInfoPdf',['id'=>$dataFromCommittee->id,'title'=>'file_two']) }}" >
    নির্বাহী কমিটির সদস্যদের জাতীয় পরিচয়পত্রের সত্যায়িত কপি ও পাসপোর্ট সাইজের সত্যায়িত ছবি
</a>
</td>

@if(Route::is('addChildNote') || Route::is('viewChildNote'))
<td>
<button  href="{{ route('executiveCommitteeInfoPdf',['id'=>$dataFromCommittee->id,'title'=>'file_two']) }}" class="btn btn-secondary" id="attLink1"  data-name="নির্বাহী কমিটির সদস্যদের জাতীয় পরিচয়পত্রের সত্যায়িত কপি ও পাসপোর্ট সাইজের সত্যায়িত ছবি"><i class="fa fa-paperclip"></i></button>
<button  href="{{ route('executiveCommitteeInfoPdf',['id'=>$dataFromCommittee->id,'title'=>'file_two']) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
</td>

@else

@endif

</tr>




<tr>
    <td>


<a target="_blank"  href="{{ route('executiveCommitteeInfoPdf',['id'=>$dataFromCommittee->id,'title'=>'file_three']) }}" >
    প্রাথমিক নিবন্ধনকারী কর্তৃপক্ষের অনুমোদিত নির্বাহী কমিটির সত্যায়িত তালিকা
</a>
</td>

@if(Route::is('addChildNote') || Route::is('viewChildNote'))
<td>
<button  href="{{ route('executiveCommitteeInfoPdf',['id'=>$dataFromCommittee->id,'title'=>'file_three']) }}" class="btn btn-secondary" id="attLink1"  data-name="প্রাথমিক নিবন্ধনকারী কর্তৃপক্ষের অনুমোদিত নির্বাহী কমিটির সত্যায়িত তালিকা"><i class="fa fa-paperclip"></i></button>
<button  href="{{ route('executiveCommitteeInfoPdf',['id'=>$dataFromCommittee->id,'title'=>'file_three']) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
</td>

@else

@endif

</tr>


<tr>
    <td>


<a target="_blank"  href="{{ route('executiveCommitteeInfoPdf',['id'=>$dataFromCommittee->id,'title'=>'file_four']) }}" >
    নির্বাহ কমিটি গঠন সংক্রান্ত সাধারণ সভার কার্যবিবরণী (হাজিরাসহ) সত্যায়িত কপি
</a>
</td>

@if(Route::is('addChildNote') || Route::is('viewChildNote'))
<td>
<button  href="{{ route('executiveCommitteeInfoPdf',['id'=>$dataFromCommittee->id,'title'=>'file_four']) }}" class="btn btn-secondary" id="attLink1"  data-name="নির্বাহ কমিটি গঠন সংক্রান্ত সাধারণ সভার কার্যবিবরণী (হাজিরাসহ) সত্যায়িত কপি"><i class="fa fa-paperclip"></i></button>
<button  href="{{ route('executiveCommitteeInfoPdf',['id'=>$dataFromCommittee->id,'title'=>'file_four']) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
</td>

@else

@endif

</tr>


<tr>
    <td>


<a target="_blank"  href="{{ route('executiveCommitteeInfoPdf',['id'=>$dataFromCommittee->id,'title'=>'file_five']) }}" >
    সর্বশেষ সাধারণ সদস্যদের স্বাক্ষরসহ নামের তালিকা (সদস্যের নাম, পিত/মাতার নাম, স্বামী/স্ত্রীর নাম, বর্তমান ও স্থায়ী ঠিকানা, জাতীয় পরিচয় পত্র নম্বর, মোবাইল নম্বর ও ইমেইল এড্রেসসহ)
</a>
</td>

@if(Route::is('addChildNote') || Route::is('viewChildNote'))
<td>
<button  href="{{ route('executiveCommitteeInfoPdf',['id'=>$dataFromCommittee->id,'title'=>'file_five']) }}" class="btn btn-secondary" id="attLink1"  data-name="সর্বশেষ সাধারণ সদস্যদের স্বাক্ষরসহ নামের তালিকা (সদস্যের নাম, পিত/মাতার নাম, স্বামী/স্ত্রীর নাম, বর্তমান ও স্থায়ী ঠিকানা, জাতীয় পরিচয় পত্র নম্বর, মোবাইল নম্বর ও ইমেইল এড্রেসসহ"><i class="fa fa-paperclip"></i></button>
<button  href="{{ route('executiveCommitteeInfoPdf',['id'=>$dataFromCommittee->id,'title'=>'file_five']) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
</td>

@else

@endif

</tr>






    </table>
</div>
