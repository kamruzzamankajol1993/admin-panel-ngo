<div class="mb-0 m-t-30">
    <div class="card">
        <div class="card-body">
            <div class="card-body">
                <div class="text-center">
                    <h4>এফডি -২ ফরম</h4>
                    <h5>অর্থছাড়ের আবেদন ফরম</h5>
                </div>
            </div>
            <table class="table table-bordered mb-4">
                <tr>
                    <td>সংস্থার নাম</td>
                    <td>: {{ $fd2FormList->ngo_name }}</td>
                </tr>
                <tr>
                    <td>সংস্থার ঠিকানা</td>
                    <td>: {{ $fd2FormList->ngo_address }}</td>
                </tr>
                <tr>
                    <td>প্রকল্প নাম</td>
                    <td>: {{ $fd2FormList->ngo_prokolpo_name }}</td>
                </tr>
                <tr>
                    <td>কোন দেশীয় সংস্থা</td>
                    <td>: {{ $dataFromFd6Form->country_of_origin }}</td>
                </tr>
                <tr>
                    <td>প্রকল্প মেয়াদ </td>
                    <td>: {{ $fd2FormList->ngo_prokolpo_duration }}</td>
                </tr>
                <tr>
                    <td>আরম্ভের তারিখ </td>
                    <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($fd2FormList->ngo_prokolpo_start_date) }}</td>
                </tr>
                <tr>
                    <td>সমাপ্তির তারিখ </td>
                    <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($fd2FormList->ngo_prokolpo_end_date) }}</td>
                </tr>
                <tr>
                    <td>প্রস্তাবিত অর্থছাড়ের পরিমান (বাংলাদেশী টাকা )</td>
                    <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($fd2FormList->proposed_rebate_amount_bangladeshi_taka) }}</td>
                </tr>
                <tr>
                    <td>প্রস্তাবিত অর্থছাড়ের পরিমান (বৈদেশিক মুদ্রায় )</td>
                    <td>: {{ App\Http\Controllers\Admin\CommonController::englishToBangla($fd2FormList->proposed_rebate_amount_in_foreign_currency) }}</td>
                </tr>
                <tr>
                    <td>এফডি ২ ফর্ম আপলোড </td>
                    <td>

                        <a href="{{ route('fd2PdfDownload',$fd2FormList->id) }}" target="_blank" class="btn btn-success">দেখুন</a>

                        @if(Route::is('addChildNote') || Route::is('viewChildNote'))

                        <button  href="{{ route('fd2PdfDownload',$fd2FormList->id) }}" class="btn btn-secondary" id="attLink1"  data-name="এফডি ২ ফর্ম আপলোড"><i class="fa fa-paperclip"></i></button>
                        <button  href="{{ route('fd2PdfDownload',$fd2FormList->id) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>

                        @endif

                    </td>
                </tr>
            </table>
            <table class="table table-bordered mb-4">
                <tr>
                    <th>ফাইলের নাম</th>
                    <th>ফাইল</th>
                </tr>
                @foreach($fd2OtherInfo as $fd2OtherInfoAll)
                <tr>
                    <td>{{ $fd2OtherInfoAll->file_name }}</td>
                    <td>

                        <a href="{{ route('fd2OtherPdfDownload',$fd2OtherInfoAll->id) }}" target="_blank" class="btn btn-success">দেখুন</a>

                        @if(Route::is('addChildNote') || Route::is('viewChildNote'))

                        <button  href="{{ route('fd2OtherPdfDownload',$fd2OtherInfoAll->id) }}" class="btn btn-secondary" id="attLink1"  data-name="{{ $fd2OtherInfoAll->file_name }}"><i class="fa fa-paperclip"></i></button>
                        <button  href="{{ route('fd2OtherPdfDownload',$fd2OtherInfoAll->id) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>

                        @endif

                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
