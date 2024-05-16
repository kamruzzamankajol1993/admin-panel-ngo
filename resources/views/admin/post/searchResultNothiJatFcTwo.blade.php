@foreach ($searchResult as $nothiLists)
<tr>
    <td>
        <p>
            <div class="form-check form-check-inline checkbox checkbox-primary">
                <input class="form-check-input" data-dakid="{{ $dakId }}" data-dakstatus="fcTwo"  data-nothiid="{{ $nothiLists->id }}" id="nothijatFcTwoFinal{{ $nothiLists->id }}" type="checkbox">
                <label class="form-check-label" for="nothijatFcTwoFinal{{ $nothiLists->id }}"></label>
              </div>
            <span style="padding:5px; background-color:#879dd9; border-radius: 10px;"> নথিঃ</span>
            {{ $nothiLists->document_subject }}
        </p>
        <p>
            <span >
                <span style="text-align:left;">
                    <span style="padding:5px; background-color:#879dd9; border-radius: 10px;">নথি নম্বরঃ</span> {{ $nothiLists->main_sarok_number }}
                    <span style="padding:5px; background-color:#879dd9; border-radius: 10px;">শাখাঃ</span> {{ $nothiLists->document_branch }}</span>
                    {{-- <span style="padding:5px; background-color:#879dd9; border-radius: 10px;">শ্রেণী: </span> {{ $nothiLists->document_class }}</span> --}}
        </p>
    </td>
    <td>
        <div class="d-flex flex-row-reverse mt-3">

            <button class="btn  btn-dark ms-3" type="button">
                <i class="fa fa-list-alt"></i>
                নথি অনুমতির ইতিহাস
            </button>
            <a class="btn  btn-dark ms-3" type="button"
                   target="_blank"
                   href="{{ route('givePermissionToNothi',$nothiLists->id) }}"
                    >
                <i class="fa fa-sitemap"></i>
                অনুমতি সংশোধন
        </a>


            <button class="btn   btn-primary ms-3" onclick="location.href = '{{ route('documentPresent.edit',$nothiLists->id) }}';" type="button">
                <i class="fa fa-send"></i>
                নথি সম্পাদনা
            </button>
            শ্রেণীর নথি
            <span style="padding:5px; background-color:#879dd9; border-radius: 10px;">{{ $nothiLists->document_class }}</span>

        </div>
    </td>
</tr>
@endforeach
@include('admin.post.script')
