<div class="mb-0 m-t-30">
<div class="table-responsive">
    <table class="table table-borderless">
        <tbody>
            <tr>
                <td>০১</td>
                <td>নিয়োগপত্র সত্যায়ন প্রমাণক</td>
                <td>: @if(!$dataFromNVisaFd9Fd1->attestation_of_appointment_letter)

                    @else

<?php

                     $file_path = url($dataFromNVisaFd9Fd1->attestation_of_appointment_letter);
                     $filename  = pathinfo($file_path, PATHINFO_FILENAME);

                     $extension = pathinfo($file_path, PATHINFO_EXTENSION);
                     ?>
                <a target="_blank"  href="{{ route('fd9OneDownload',['cat'=>'appoinmentLetter','id'=>$dataFromNVisaFd9Fd1->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন </a>

                <button  href="{{ route('fd9OneDownload',['cat'=>'appoinmentLetter','id'=>$dataFromNVisaFd9Fd1->id]) }}" class="btn btn-secondary" id="attLink1"  data-name="নিয়োগপত্র সত্যায়ন প্রমাণক"><i class="fa fa-paperclip"></i></button>
                <button  href="{{ route('fd9OneDownload',['cat'=>'appoinmentLetter','id'=>$dataFromNVisaFd9Fd1->id]) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>


                     @endif
                     {{-- <a href="{{ route('niyogPotroDownload',$dataFromNVisaFd9Fd1->id) }}" target="_blank">{{ $filename.'.'.$extension  }}</a> --}}
</td>
            </tr>
            <tr>
                <td>০২</td>
                <td>ফর্ম ৯ এর কপি</td>
                <td>:  @if(!$dataFromNVisaFd9Fd1->copy_of_form_nine)

                    @else

<?php

                     $file_path = url($dataFromNVisaFd9Fd1->copy_of_form_nine);
                     $filename  = pathinfo($file_path, PATHINFO_FILENAME);

                     $extension = pathinfo($file_path, PATHINFO_EXTENSION);
                     ?>
                <a target="_blank"  href="{{ route('fd9OneDownload',['cat'=>'fd9Copy','id'=>$dataFromNVisaFd9Fd1->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন </a>

                <button  href="{{ route('fd9OneDownload',['cat'=>'fd9Copy','id'=>$dataFromNVisaFd9Fd1->id]) }}" class="btn btn-secondary" id="attLink1"  data-name="ফর্ম ৯ এর কপি"><i class="fa fa-paperclip"></i></button>
                <button  href="{{ route('fd9OneDownload',['cat'=>'fd9Copy','id'=>$dataFromNVisaFd9Fd1->id]) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
                     @endif
                     {{-- <a href="{{ route('formNinePdfDownload',$dataFromNVisaFd9Fd1->id) }}" target="_blank">{{ $filename.'.'.$extension  }}</a> --}}
</td>
            </tr>
            <tr>
                <td>০৩</td>
                <td>ছবি</td>
                <td>:<img src="{{ $ins_url }}{{ $dataFromNVisaFd9Fd1->foreigner_image }}" style="height:40px;"/></td>
            </tr>
            <tr>
                <td>০৪</td>
                <td>এন ভিসা নিয়ে আগমনের তারিখ (প্রমানসহ)</td>
                <td>:

                    @if(!$dataFromNVisaFd9Fd1->copy_of_nvisa)

               @else

<?php

                $file_path = url($dataFromNVisaFd9Fd1->copy_of_nvisa);
                $filename  = pathinfo($file_path, PATHINFO_FILENAME);

                $extension = pathinfo($file_path, PATHINFO_EXTENSION);
                ?>
                <a target="_blank"  href="{{ route('fd9OneDownload',['cat'=>'visacopy','id'=>$dataFromNVisaFd9Fd1->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন </a>

                @if(Route::is('addChildNote') || Route::is('viewChildNote'))

                <button  href="{{ route('fd9OneDownload',['cat'=>'visacopy','id'=>$dataFromNVisaFd9Fd1->id]) }}" class="btn btn-secondary" id="attLink1"  data-name="এন ভিসা নিয়ে আগমনের তারিখ (প্রমানসহ)"><i class="fa fa-paperclip"></i></button>
                <button  href="{{ route('fd9OneDownload',['cat'=>'visacopy','id'=>$dataFromNVisaFd9Fd1->id]) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>

                @endif
                @endif
{{-- <a href="{{ route('nVisaCopyDownload',$dataFromNVisaFd9Fd1->id) }}" target="_blank">{{ $filename.'.'.$extension  }}</a>, --}}
                {{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-m-Y', strtotime($dataFromNVisaFd9Fd1->arrival_date_in_nvisa))) }}




            </td>
            </tr>
            @if(Route::is('addChildNote') || Route::is('viewChildNote'))

            <tr>
                <td>০৫</td>
                <td>এফডি ৯.১ (ওয়ার্ক পারমিট)</td>
                <td>:
                    <a target="_blank"  href="{{ route('verified_fd_nine_one_download',$dataFromNVisaFd9Fd1->id) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন </a>
                    <button  href="{{ route('verified_fd_nine_one_download',$dataFromNVisaFd9Fd1->id) }}" class="btn btn-secondary" id="attLink1"  data-name="এফডি ৯.১ (ওয়ার্ক পারমিট)"><i class="fa fa-paperclip"></i></button>
                    <button  href="{{ route('verified_fd_nine_one_download',$dataFromNVisaFd9Fd1->id) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
                </td>
            </tr>


            @endif

            @if(Route::is('addChildNote') || Route::is('viewChildNote'))
            @if (empty($nVisabasicInfo->forwarding_letter))

            @else
            <tr>
                <td>০৬</td>
                <td>ফরওয়ার্ডিং লেটার</td>
                <td>:
                    <a target="_blank"  href="{{ route('forwardingLetterForNothi',$nVisabasicInfo->id) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন </a>
                    <button  href="{{ route('forwardingLetterForNothi',$nVisabasicInfo->id) }}" class="btn btn-secondary" id="attLink1"  data-name="ফরওয়ার্ডিং লেটার"><i class="fa fa-paperclip"></i></button>
                    <button  href="{{ route('forwardingLetterForNothi',$nVisabasicInfo->id) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
                </td>
            </tr>
            @endif


            @endif
        </tbody>
    </table>




  </div>
</div>
