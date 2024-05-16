@extends('admin.master.master')

@section('title')
এনজিও গঠনতন্ত্র পরিবর্তন/অনুমোদনের  এর  বিস্তারিত  | {{ $ins_name }}
@endsection


@section('css')

@endsection

@section('body')

<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <h3>এনজিও গঠনতন্ত্র পরিবর্তন/অনুমোদনের  তথ্য</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">হোম</a></li>
                    <li class="breadcrumb-item">এনজিও গঠনতন্ত্র পরিবর্তন/অনুমোদনের  তথ্য</li>
                    <li class="breadcrumb-item active">এনজিও প্রোফাইল</li>
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
        <div class="row">
            <!-- user profile header start-->
            <div class="col-sm-12">
              <div class="d-flex justify-content-start">
                  <div class="card profile-header me-4">
                    <div class="userpro-box">
                        <div class="img-wrraper">
                            @if(empty($users_info->image))
                            <div class="avatar"><img class="img-fluid" alt="" src="{{ asset('/') }}public/admin/user.png"></div>
                            @else
                            <div class="avatar"><img class="img-fluid" alt="" src="{{ $ins_url }}{{ $users_info->image }}"></div>
                            @endif
                        </div>

                        <?php

                       $getNgoType = DB::table('ngo_type_and_languages')->where('user_id',$form_one_data->user_id)->value('ngo_type');
                       $ngoTypeData = DB::table('ngo_type_and_languages')->where('user_id',$form_one_data->user_id)->first();

                        ?>
                        <div class="user-designation">
                            <div class="title">
                                @if($getNgoType == 'Foreign')
                                <h4>{{ $form_one_data->organization_name }}</h4>
                              <h6>{{ $form_one_data->address_of_head_office_eng }}</h6>
                                @else
                                <h4>{{ $form_one_data->organization_name_ban }}</h4>
                              <h6>{{ $form_one_data->address_of_head_office }}</h6>
                                @endif
                                <!--<h6>{{ $form_one_data->email }}</h6>-->
                               <!-- <p>{{ $form_one_data->phone }}</p> -->


                               @if($getNgoType == 'Foreign')
                               <h6>বিদেশী এনজিও </h6>
                               @else
                               <h6>দেশি এনজিও </h6>

                               @endif
                               @if($ngoTypeData->ngo_type_new_old == 'Old')
                               <h6>এনজিও'র ধরন : পুরাতন</h6>
                               @else

                               <h6>এনজিও'র ধরন : নতুন</h6>
                               @endif


                            </div>
                            <div class="follow">
                                <ul class="follow-list">
                                    <li>
                                        <div class="follow-num">


                                            {{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-F-y', strtotime($getformOneId->created_at))) }}



                                        </div>
                                        <span>জমাদানের তারিখ</span>
                                    </li>
                                    <li>
                                        <div class="follow-num"> @if($getformOneId->status == 'Accepted')

                                            <button class="btn btn-secondary " type="button">
                                                গৃহীত

                                            </button>
                                            @elseif($getformOneId->status == 'Ongoing')

                                            <button class="btn btn-secondary " type="button">
                                                চলমান

                                            </button>
                                            @else
                                            <button class="btn btn-secondary " type="button">
                                                প্রত্যাখ্যান

                                            </button>
                                            @endif</div>
                                        <span>স্ট্যাটাস</span>
                                    </li>
                                </ul>
                            </div>
                        </div>


                    </div>
                </div>

                <div class="card profile-header">
                  <div class="card-body text-center">
                    <div class="userpro-box">
                        <div class="user-designation">
                            <h4>{{ $form_one_data->name_of_head_in_bd }}</h4>
                            <h5>ঠিকানা:  @if($getNgoType == 'Foreign')
                                    {{ $form_one_data->address_of_head_office_eng }}
                                    @else

                             {{ $form_one_data->address_of_head_office }}
                                    @endif</h5>
                            <h5>মোবাইল নম্বর:    {{ App\Http\Controllers\Admin\CommonController::englishToBangla($form_one_data->phone) }}</h5>
                            <h5>ইমেইল:    {{ $form_one_data->email }}</h5>
                          </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>

            <?php



             ?>
            <!-- user profile header end-->
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="row">
                    <!-- profile post start-->
                    <div class="col-sm-12">
                        <div class="card height-equal">
                            <div class="card-header pb-0">
                                <h5>এনজিও গঠনতন্ত্র পরিবর্তন/অনুমোদনের সমস্ত তথ্য</h5>
                            </div>
                            <div class="card-body">


                                <div class="row mb-4">
                                    <div class="col-lg-12">

                                        <div class="text-end">

                                           @if($getformOneId->status == 'Ongoing')
                                            <button onclick="location.href = '{{ route('showDataAll',['status'=>'constitution','id'=>$getformOneId->id]) }}';" type="button" class="btn btn-primary float-right">ডাক দেখুন</button>

                                            @else

                                            @endif

                                        </div>
                                    </div>
                                </div>


                                <ul class="nav nav-dark" id="pills-darktab" role="tablist">




                                    <li class="nav-item"><a class="nav-link active" id="pills-darkdoc-tab"
                                        data-bs-toggle="pill" href="#pills-darkdoc"
                                        role="tab" aria-controls="pills-darkdoc"
                                        aria-selected="false" style=""><i
                                class="icofont icofont-animal-lemur"></i>নথিপত্র</a>
                </li>


                <li class="nav-item"><a class="nav-link" id="pills-darkdoc1-tab"
                    data-bs-toggle="pill" href="#pills-darkdoc1"
                    role="tab" aria-controls="pills-darkdoc1"
                    aria-selected="false" style=""><i
            class="icofont icofont-animal-lemur"></i>স্টেটাস আপডেট করুন </a>
             </li>








                                </ul>
                                <div class="tab-content" id="pills-darktabContent">



                                    @if($getNgoType == 'Foreign' || $getNgoType == 'দেশিও')
                                    <div class="tab-pane fade " id="pills-darkprofile" role="tabpanel"
                                    aria-labelledby="pills-darkprofile-tab">
                                    @else

                                    <div class="tab-pane fade active show" id="pills-darkprofile" role="tabpanel"
                                         aria-labelledby="pills-darkprofile-tab">

@endif


                                        <div class="mb-0 m-t-30">
                                          <div class="table-responsive">
                                            <table class="table table-bordered overflow-scroll">
                                                <tr>
                                                    <th rowspan="2">ক্রঃ নং</th>
                                                    <th rowspan="2">নাম ও পদবী</th>
                                                    <th rowspan="2">জন্ম তারিখ</th>
                                                    <th rowspan="2">এনএইডি এবং মোবাইল নং</th>
                                                    <th rowspan="2">বাবার নাম</th>
                                                    <th colspan="2">ঠিকানা</th>
                                                    <th rowspan="2">স্বামী/স্ত্রীর নাম</th>
                                                    <th rowspan="2">শিক্ষাগত যোগ্যতা</th>
                                                    <th colspan="3">পেশা</th>
                                                    <th rowspan="2">তিনি কি অন্য কোন এনজিওর সদস্য বা
                                                        পরিষেবাধারী ছিলেন (যদি তা হয় তবে অনুগ্রহ করে
                                                        চিহ্নিত করুন)
                                                    </th>
                                                    <th rowspan="2">মন্তব্য</th>
                                                    <th rowspan="2">স্বাক্ষর এবং তারিখ</th>
                                                </tr>
                                                <tr>
                                                    <th>বর্তমান ঠিকানা</th>
                                                    <th>স্থায়ী ঠিকানা</th>
                                                    <th>সরকারী/আধা সরকারী/সরকারি স্বায়ত্তশাসিত</th>
                                                    <th>ব্যক্তিগত সেবা</th>
                                                    <th>স্ব সেবা</th>
                                                </tr>

                                            </table>
                                          </div>
                                        </div>
                                    </div>


                                    @if($getNgoType == 'Foreign' || $getNgoType == 'দেশিও')

                                    <div class="tab-pane fade active show" id="pills-darkdoc" role="tabpanel"
                                    aria-labelledby="pills-darkdoc-tab">


                                    @else

                                    <div class="tab-pane fade" id="pills-darkdoc" role="tabpanel"
                                         aria-labelledby="pills-darkdoc-tab">

                                         @endif




                                      @include('admin.constitution.documentList')
                                    </div>

                                    <div class="tab-pane fade" id="pills-darkdoc1" role="tabpanel"
                                    aria-labelledby="pills-darkdoc1-tab">
                                   <div class="mb-0 m-t-30">


                                    <?php
                                    $fdOneFormId = DB::table('fd_one_forms')->where('id',$form_one_data->id)->value('user_id');
                                    $get_email_from_user = DB::table('users')->where('id',$fdOneFormId)->value('email');

                                            ?>
                                       <form id="form" action="{{ route('updateStatusconstitutionInfoPdf') }}" method="post">
                                           @csrf
                                           <input type="hidden" value="{{ $getformOneId->id }}" name="id" />
                                           <input type="hidden" value="{{ $get_email_from_user }}" name="email" />
                                           <select class="form-control form-control-sm" name="status" id="regStatus">

                                               <option value="Ongoing" {{ $getformOneId->status == 'Ongoing' ? 'selected':''  }}>চলমান</option>
                                               <option value="Accepted" {{ $getformOneId->status == 'Accepted' ? 'selected':''  }}>গৃহীত</option>
                                               <option value="Correct" {{ $getformOneId->status == 'Correct' ? 'selected':''  }}>সংশোধন করুন</option>
                                               <option value="Rejected" {{ $getformOneId->status == 'Rejected' ? 'selected':''  }}>প্রত্যাখ্যান করুন</option>

                                           </select>

                                           <div id="rValueStatus" style="display:none;">
                                               <label>বিস্তারিত লিখুন:</label>
                                               <textarea class="form-control form-control-sm" name="comment"></textarea>
                                           </div>

                                           <button type="submit" class="btn btn-primary mt-5">আপডেট করুন</button>

                                         </form>


                                   </div>
                               </div>

                               <!--add new -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- profile post end-->
                </div>
            </div>
        </div>
    </div>
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
@endsection
