@extends('admin.master.master')

@section('title')
ওয়ার্ক পারমিট | {{ $ins_name }}
@endsection


@section('css')

@endsection

@section('body')

<?php
 $engDATE = array('1','2','3','4','5','6','7','8','9','0','January','February','March','April',
      'May','June','July','August','September','October','November','December','Saturday','Sunday',
      'Monday','Tuesday','Wednesday','Thursday','Friday');
      $bangDATE = array('১','২','৩','৪','৫','৬','৭','৮','৯','০','জানুয়ারী','ফেব্রুয়ারী','মার্চ','এপ্রিল','মে',
      'জুন','জুলাই','আগস্ট','সেপ্টেম্বর','অক্টোবর','নভেম্বর','ডিসেম্বর','শনিবার','রবিবার','সোমবার','মঙ্গলবার','
      বুধবার','বৃহস্পতিবার','শুক্রবার'
      );



?>

<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <h3>ওয়ার্ক পারমিট</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">হোম</a></li>
                    <li class="breadcrumb-item">এফডি৯.১ (ওয়ার্ক পারমিট)</li>
                    <li class="breadcrumb-item">ওয়ার্কিং পারমিটের বিবরণ </li>
                </ol>
            </div>
            <div class="col-sm-6">
            </div>
        </div>
    </div>
</div>
  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="user-profile">
        @include('flash_message')
        <div class="card">
        <div class="card-body">


            <div class="row mb-4">
                <div class="col-lg-12">

                    <div class="text-end">



                       @if(empty($dataFromNVisaFd9Fd1->status))
                        <button onclick="location.href = '{{ route('showDataAll',['status'=>'fdNineOne','id'=>$mainIdFdNineOne]) }}';" type="button" class="btn btn-primary add-btn">ডাক দেখুন</button>

                        @else

                        @endif
                    </div>
                </div>
            </div>



            <ul class="nav nav-dark" id="pills-darktab" role="tablist">
                <li class="nav-item"><a class="nav-link active" id="pills-darkhome-tab"
                                        data-bs-toggle="pill" href="#pills-darkhome"
                                        role="tab" aria-controls="pills-darkhome"
                                        aria-selected="true" style=""><i
                                class="icofont icofont-ui-home"></i>এফডি-৯(১) ফরম</a></li>



                                <li class="nav-item"><a class="nav-link" id="pills-darkprofile-tab1"
                                    data-bs-toggle="pill" href="#pills-darkprofile1"
                                    role="tab" aria-controls="pills-darkprofil1e"
                                    aria-selected="false" style=""><i
                            class="icofont icofont-man-in-glasses"></i>নিরাপত্তা ছাড়পত্র</a>
            </li>
            <li class="nav-item"><a class="nav-link" id="pills-darkcontact-tab22"
                                    data-bs-toggle="pill" href="#pills-darkcontact22"
                                    role="tab" aria-controls="pills-darkcontact22"
                                    aria-selected="false" style=""><i
                            class="icofont icofont-contacts"></i>ফরওয়ার্ডিং লেটার</a>
            </li>




                                <li class="nav-item"><a class="nav-link" id="pills-darkprofile-tab"
                                        data-bs-toggle="pill" href="#pills-darkprofile"
                                        role="tab" aria-controls="pills-darkprofile"
                                        aria-selected="false" style=""><i
                                class="icofont icofont-man-in-glasses"></i>নথিপত্র</a>
                </li>



                <li class="nav-item"><a class="nav-link" id="pills-darkdoc2-tab"
                    data-bs-toggle="pill" href="#pills-darkdoc2"
                    role="tab" aria-controls="pills-darkdoc2"
                    aria-selected="false" style=""><i
            class="icofont icofont-animal-lemur"></i>আবেদনের স্টেটাস</a>
             </li>




                <li class="nav-item"><a class="nav-link" id="pills-darkdoc1-tab"
                    data-bs-toggle="pill" href="#pills-darkdoc1"
                    role="tab" aria-controls="pills-darkdoc1"
                    aria-selected="false" style=""><i
            class="icofont icofont-animal-lemur"></i>সুরক্ষা বিভাগে আবেদন পাঠান</a>
             </li>



            </ul>
            <div class="tab-content" id="pills-darktabContent">
                <div class="tab-pane fade active show" id="pills-darkhome"
                     role="tabpanel" aria-labelledby="pills-darkhome-tab">
                    <div class="mb-0 m-t-30">

                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">

                                        <p>এফডি-৯(১) পিডিএফ ডাউনলোড করুন</p>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="text-center">
                                            <p>পিডিএফ ডাউনলোড</p>
                                            <a class="btn btn-sm btn-success" target="_blank"
                                                   href = '{{ route('verified_fd_nine_one_download',$dataFromNVisaFd9Fd1->id) }}'>
                                                   ডাউনলোড করুন
                                        </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="text-center">
                                <h4>এফডি-৯(১) ফরম</h4>
                                <h5>বিদেশি বিশেষজ্ঞ, উপদেষ্টা, কর্মকর্তা বা স্বেচ্ছাসেবী এর ওয়ার্ক পারমিটের (কার্যানুমতি)
                                    আবেদন ফরম</h5>

                            </div>

                            <div>
                                <p>বরাবর <br>
                                    মহাপরিচালক <br>
                                    এনজিও বিষয় ব্যুরো, ঢাকা <br>
                                    জনাব,</p>

                            </div>
                        </div>

                        <div class="card-body fd0901_text_style">
                            <table class="table table-borderless">
                                <tr>
                                    <td>বিষয়:</td>
                                    <td>"{{ $dataFromNVisaFd9Fd1->institute_name }}" সংস্থার বিদেশি বিশেষজ্ঞউপদেষ্টা/কর্মকর্ত/সেচ্ছাসেবী "{{ $dataFromNVisaFd9Fd1->foreigner_name_for_subject }}" এর
                                        ওয়ার্ক পারমিট প্রসঙ্গে।
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>সূত্র: এনজিও বিষয়ক ব্যুরোর স্মারক নম্বর {{ $dataFromNVisaFd9Fd1->sarok_number }} তারিখ {{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-m-Y', strtotime($dataFromNVisaFd9Fd1->application_date))) }}
                                    </td>
                                </tr>
                            </table>
                            <p class="mt-3 mb-2">
                                উপর্যুক্ত বিষয় ও সূত্রের বরাতে "{{ $dataFromNVisaFd9Fd1->institute_name }}" সংস্থার "{{ $dataFromNVisaFd9Fd1->prokolpo_name }}" প্রকল্পের আওতায় "{{ $dataFromNVisaFd9Fd1->designation_name }}" হিসেবে বিদেশী বিশেষজ্ঞ/
                                উপদেষ্টা/কর্মকর্তা/স্বেচ্ছাসেবী {{ $dataFromNVisaFd9Fd1->foreigner_name_for_body }} কে {{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-m-Y', strtotime($dataFromNVisaFd9Fd1->expire_from_date))) }} খ্রি: হতে {{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-m-Y', strtotime($dataFromNVisaFd9Fd1->expire_to_date))) }} পর্যন্ত সময়ের জন্য নিয়োগ করা হয়েছে। সংস্থার অনুকূলে
                                উক্ত ব্যাক্তির অনুমোদিত সময়ের জন্য ওয়ার্ক পারমিট ইস্যু করার
                                জন্য একসাথে নিম্ন বর্ণিত কাগজপত্র সংযুক্ত করা হলো:
                            </p>

                            <table class="table table-borderless">
                                <tr>
                                    <td>০১</td>
                                    <td>নিয়োগপত্র সত্যায়ন প্রমাণক</td>
                                     <td> :@if(!$dataFromNVisaFd9Fd1->attestation_of_appointment_letter)

                                        @else

                                    <a target="_blank"  href="{{ route('fd9OneDownload',['cat'=>'appoinmentLetter','id'=>$dataFromNVisaFd9Fd1->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন </a>
                                         @endif</td>
                                </tr>

                                <tr>
                                    <td>০২</td>
                            <td>ফর্ম ৯ এর কপি</td>
                                     <td>:@if(!$dataFromNVisaFd9Fd1->copy_of_form_nine)

                                        @else

                                    <a target="_blank"  href="{{ route('fd9OneDownload',['cat'=>'fd9Copy','id'=>$dataFromNVisaFd9Fd1->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন </a>
                                         @endif</td>
                                </tr>

                                <tr>
                                    <td>০৩</td>
                            <td>ছবি</td>
                                     <td>:<img src="{{ $ins_url }}{{ $dataFromNVisaFd9Fd1->foreigner_image }}" style="height:40px;"/></td>
                                </tr>

                                <tr>
                                    <td>০৪</td>
                                    <td>এন ভিসা নিয়ে আগমনের তারিখ (প্রমানসহ)</td>
                                     <td> @if(!$dataFromNVisaFd9Fd1->copy_of_nvisa)

                                        @else

                                         <a target="_blank"  href="{{ route('fd9OneDownload',['cat'=>'visacopy','id'=>$dataFromNVisaFd9Fd1->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন </a>,
                                         @endif

                                         {{ str_replace($engDATE,$bangDATE,date('d-m-Y', strtotime($dataFromNVisaFd9Fd1->arrival_date_in_nvisa))) }}</td>
                                </tr>

                            </table>

                            <p class="mb-3">এমতবস্থায়, অত্র সংস্থার উল্লেখিত পদে {{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-m-Y', strtotime($dataFromNVisaFd9Fd1->proposed_from_date))) }} হতে {{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-m-Y', strtotime($dataFromNVisaFd9Fd1->proposed_from_date))) }} মেয়াদে উক্ত বিদেশি কর্মকর্তাকে ওয়ার্ক পারমিট ইস্যু করার জন্য বিনীত অনুরোধ করেছি।</p>

                            <div class="row">
                                <div class="col-lg-6 col-sm-12"></div>
                                <div class="col-lg-6 col-sm-12">
                                    <table class="table table-borderless">

                                        <tr>
                                            <td><img width="150" height="60" src="{{ $ins_url }}{{ $dataFromNVisaFd9Fd1->digital_signature}}"/></td>
                                        </tr>


                                        <tr>
                                            <td><img width="150" height="60" src="{{ $ins_url }}{{ $dataFromNVisaFd9Fd1->digital_seal}}"/></td>
                                        </tr>

                                        <tr>
                                            <td>প্রধান নির্বাহীর স্বাক্ষর ও সিল</td>
                                        </tr>


                                        <tr>
                                            <td>প্রধান নির্বাহীর স্বাক্ষর ও সিল</td>
                                        </tr>
                                        <tr>
                                            <td>নামঃ {{  $dataFromNVisaFd9Fd1->chief_name }}</td>
                                        </tr>
                                        <tr>
                                            <td>পদবীঃ {{  $dataFromNVisaFd9Fd1->chief_desi }}</td>
                                        </tr>
                                        <tr>
                                            <td>তারিখঃ {{  App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-m-Y', strtotime(\Carbon\Carbon::parse($dataFromNVisaFd9Fd1->created_at)->toDateString() )))}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>



                        </div>




                    </div>

                </div>
                <div class="tab-pane fade" id="pills-darkprofile" role="tabpanel"
                     aria-labelledby="pills-darkprofile-tab">

                     @include('admin.fd9Oneform.fd9OneDoc')
                </div>


                <div class="tab-pane fade" id="pills-darkprofile1" role="tabpanel"
                aria-labelledby="pills-darkprofile-tab1">
              @include('admin.fd9Oneform.clearanceLetter')
                </div>


                <div class="tab-pane fade" id="pills-darkcontact22" role="tabpanel"
                         aria-labelledby="pills-darkcontact-tab22">
                         <div class="mb-0 m-t-30">

                            <?php


                            $forwardingLetterData =DB::table('forwarding_letters')
            ->where('fd9_form_id',$dataFromNVisaFd9Fd1->id)->first();

//dd($forwardingLetterData);

                            ?>
                            @if (empty($nVisabasicInfo->forwarding_letter))
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <form id="form" class="custom-validation" action="{{ route('postForwardingLetter') }}"  method="post" enctype="multipart/form-data">
                                                @csrf
                                                   <input type="hidden" value="{{ $nVisabasicInfo->id }}" name="id" required>
                                                <div class="form-group col-md-12 col-sm-12">
                                                    <label for="email">ফরওয়ার্ডিং লেটার</label>
                                                    <input type="file" accept=".pdf" name="forwardingLetter" class="form-control form-control-sm" required>
                                                </div>







                                        </div>
                                        <div class="card-footer text-end">
                                            <button class="btn btn-primary" type="submit">জমা দিন </button>
                                        </div>
                                    </form>
                                    </div>
                                </div>

                            </div>
                            @else
                            <div class="row">

                                <div class="col-lg-12 col-md-12 col-sm-12">


                                    <div class="text-end">



                                    <div class="card">

                                        <div class="card-header">
                                            <button class="btn btn-sm btn-success"  data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                ফরওয়ার্ডিং লেটার আপডেট  করুন
                                            </button>

                                            <!--model-->
                                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <h1 class="modal-title fs-5" id="exampleModalLabel">পিডিএফ আপলোড</h1>
                                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="form" class="custom-validation" action="{{ route('postForwardingLetter') }}"  method="post" enctype="multipart/form-data">
                                                            @csrf
                                                               <input type="hidden" value="{{ $nVisabasicInfo->id }}" name="id" required>
                                                            <div class="form-group col-md-12 col-sm-12">
                                                                <label for="email">ফরওয়ার্ডিং লেটার</label>
                                                                <input type="file" accept=".pdf" name="forwardingLetter" class="form-control form-control-sm" required>
                                                            </div>



                                                            <button type="submit" class="btn btn-primary btn-lg  waves-effect  btn-sm waves-light mr-1">
                                                                জমা দিন
                                                             </button>
                                                        </form>

                                                    </div>

                                                  </div>
                                                </div>
                                              </div>
                                            <!--model -->
                                        </div>
                                        </div>
                                        <div class="card-body">



                                            <iframe src=
                                            "{{ url('public/'.$nVisabasicInfo->forwarding_letter) }}"
                                                            width="100%"
                                                            height="800">
                                                    </iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>

                </div>

               <!--new code start-->

                <div class="tab-pane fade" id="pills-darkdoc2" role="tabpanel"
                aria-labelledby="pills-darkdoc2-tab">
               <div class="mb-0 m-t-30">

                <div class="card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-12">
                                <form id="form" action="{{ route('statusUpdateForFd9') }}" method="post">
                                    @csrf


                                    <input type="hidden" value="{{ $dataFromNVisaFd9Fd1->id }}" name="id" />

                                    <input type="hidden" value="{{ $get_email_from_user }}" name="email" />

                                    <label>স্টেটাস:</label>
                                    <select class="form-control form-control-sm mt-4" name="status" id="regStatus">

                                        <option value="Ongoing" {{ $dataFromNVisaFd9Fd1->status == 'Ongoing' ? 'selected':''  }}>চলমান</option>

<option value="Submitted" {{ $dataFromNVisaFd9Fd1->status == 'Submitted' ? 'selected':''  }}>জমা দেওয়া হয়েছে </option>

                                        <option value="Accepted" {{ $dataFromNVisaFd9Fd1->status == 'Accepted' ? 'selected':''  }}>গৃহীত</option>
                                        <option value="Correct" {{ $dataFromNVisaFd9Fd1->status == 'Correct' ? 'selected':''  }}>সংশোধন করুন</option>
                                        <option value="Rejected" {{ $dataFromNVisaFd9Fd1->status == 'Rejected' ? 'selected':''  }}>প্রত্যাখ্যান করুন</option>

                                    </select>


                                    @if($dataFromNVisaFd9Fd1->status == 'Correct' || $dataFromNVisaFd9Fd1->status == 'Rejected')

                                    <div id="rValueStatus" >
                                        <label>বিস্তারিত লিখুন:</label>
                                        <textarea class="form-control form-control-sm" name="comment">{{ $dataFromNVisaFd9Fd1->comment }}</textarea>
                                    </div>
                                    @else
                                    <div id="rValueStatus" style="display:none;">
                                        <label>বিস্তারিত লিখুন:</label>
                                        <textarea class="form-control form-control-sm" name="comment"></textarea>
                                    </div>
                                    @endif
                                    <button type="submit" class="btn btn-primary mt-5">আপডেট করুন</button>

                                  </form>
                            </div>
                            <div class="col-md-12" id="finalResult">

                            </div>

                        </div>
                    </div>
                </div>
               </div>
                </div>



                <!--new code -->



                <div class="tab-pane fade" id="pills-darkdoc1" role="tabpanel"
                aria-labelledby="pills-darkdoc1-tab">
               <div class="mb-0 m-t-30">


                <div class="card">
                    <div class="card-body">
                        @if (empty($nVisabasicInfo->forwarding_letter))

                        <div class="row">

<h5>ফরওয়ার্ডিং লেটার আপলোড করুন</h5>
                        </div>


                        @else
                        <div class="row">
                            <?php

                            $checkTracking =DB::table('secruity_checks')
                            ->where('n_visa_id',$nVisabasicInfo->id)->get();;

                            ?>
                            <div class="col-md-12">
                                @if(count($checkTracking) == 0)

                                <form id="form" class="custom-validation" action="{{ route('submitForCheck') }}"  method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $dataFromNVisaFd9Fd1->id }}" />
                                   <button class="btn btn-primary" type="submit">আবেদনপত্র জমাদিন</button>
                               </form>

                                @else
                                <h1>আবেদনপত্রের স্টেটাস</h1>

                                <table class="table table-bordered">
                                    <thead>
                                      <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">ট্র্যাকিং নম্বর</th>
                                        <th scope="col">স্ট্যাটাসের নাম</th>
                                        <th scope="col">কার্যকলাপ</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($checkTracking as $key=>$AllCheckTracking)
                                      <tr>
                                        <th scope="row">{{ $key+1 }}</th>
                                        <td>{{ $AllCheckTracking->tracking_no }}</td>
                                        <td>{{ $AllCheckTracking->statusName }}</td>
<td>
<button  data-id = "{{ $AllCheckTracking->n_visa_id }}" class="btn btn-primary statusCheck" type="button">
    <i class="ri-add-line align-bottom me-1"></i> স্টেটাস দেখুন
</button >
</td>
                                      </tr>
                                      @endforeach

                                    </tbody>
                                  </table>

                                @endif
                            </div>
                            <div class="col-md-12" id="finalResult">

                            </div>

                        </div>
                        @endif
                    </div>
                </div>

               </div>
           </div>


            </div>
        </div>
        </div>
    </div>
    <!-- profile post end-->

</div>
<!-- Container-fluid Ends-->
@endsection

@section('script')

<script>
    $(document).ready(function(){
      $("#regStatus").change(function(){
        var valmain = $(this).val();

        if(valmain == 'Accepted'){
           $('#rValue').show();
           $('#rValueStatus').hide();

        }
        else{
            $('#rValue').hide();
            $('#rValueStatus').show();
        }
      });
    });
    </script>


<script type="text/javascript">
    $(".statusCheck").click(function () {

        var mainId = $(this).attr("data-id");
        //alert(mainId);

        $.ajax({
            url: "{{ route('statusCheck') }}",
            method: 'GET',
            data: {mainId:mainId},
            success: function(data) {

              $("#finalResult").html('');
              $("#finalResult").html(data);
            }
        });



    });
</script>
<script type="text/javascript">
    var i = 0;
    $("#dynamic-ar").click(function () {
        ++i;
        $("#dynamicAddRemove").append('<tr><td><input type="text" required name="name[]" id="name'+i+'" placeholder="অনুলিপি" class="form-control" /></td><td><button type="button" class="btn btn-sm btn-outline-danger remove-input-field">মুছে ফেলুন</button></td></tr>'
            );
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });
</script>
@endsection
