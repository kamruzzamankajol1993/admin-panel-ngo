


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


        <a target="_blank"  href="{{ route('fd5FormPdf',['id'=>$getformOneId->id]) }}" >
            বিদেশ থেকে প্রাপ্ত জিনিসপত্র /দ্রব্যসামগ্র্রীর সংরক্ষণ সংক্রান্ত ফরম এর পিডিএফ
       </a>
    </td>
    @if(Route::is('addChildNote') || Route::is('viewChildNote'))
<td>
<button  href="{{ route('fd5FormPdf',['id'=>$getformOneId->id]) }}" class="btn btn-secondary" id="attLink1"  data-name="বিদেশ থেকে প্রাপ্ত জিনিসপত্র /দ্রব্যসামগ্র্রীর সংরক্ষণ সংক্রান্ত ফরম এর পিডিএফ"><i class="fa fa-paperclip"></i></button>
<button  href="{{ route('fd5FormPdf',['id'=>$getformOneId->id]) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
</td>

@else

@endif

</tr>

    </table>
</div>
