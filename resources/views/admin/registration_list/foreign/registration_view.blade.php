@extends('admin.master.master')

@section('title')
@if($ngoTypeData->ngo_type_new_old == 'Old')
                          এনজিও নবায়নের সকল তথ্য
                                @else
                      এনজিও নিবন্ধন সকল তথ্য
                                @endif | {{ $ins_name }}
@endsection


@section('css')

@endsection

@section('body')

<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">

                @if($ngoTypeData->ngo_type_new_old == 'Old')

                <h3>এনজিও নবায়ন তথ্য</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">হোম</a></li>
                    <li class="breadcrumb-item">এনজিও নবায়ন তথ্য</li>
                    <li class="breadcrumb-item active">এনজিও প্রোফাইল</li>
                </ol>

                @else
                <h3>এনজিও নিবন্ধন তথ্য</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">হোম</a></li>
                    <li class="breadcrumb-item">এনজিও নিবন্ধন তথ্য</li>
                    <li class="breadcrumb-item active">এনজিও প্রোফাইল</li>
                </ol>
                @endif
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


                                            {{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-F-y', strtotime($all_data_for_new_list_all->created_at))) }}



                                        </div>
                                        <span>জমাদানের তারিখ</span>
                                    </li>
                                    <li>
                                        <div class="follow-num"> @if($all_data_for_new_list_all->status == 'Accepted')

                                            <button class="btn btn-secondary " type="button">
                                                গৃহীত

                                            </button>
                                            @elseif($all_data_for_new_list_all->status == 'Ongoing')

                                            <button class="btn btn-secondary " type="button">
                                                চলমান

                                            </button>
                                            @elseif($all_data_for_new_list_all->status == 'Rejected')
                                            <button class="btn btn-secondary btn-xs" type="button">
                                                প্রত্যাখ্যান

                                            </button>

                                            @else
                                            <button class="btn btn-secondary btn-xs" type="button">
                                                চলমান

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
                                @if($ngoTypeData->ngo_type_new_old == 'Old')
                                <h5>এনজিও নবায়নের সকল তথ্য </h5>
                                @else
                                <h5>এনজিও নিবন্ধন সকল তথ্য</h5>
                                @endif
                            </div>
                            <div class="card-body">

                                <div class="row mb-4">
                                    <div class="col-lg-12">
                                        <div class="text-end">
                                           @if($r_status == 'Ongoing')
                                            <button onclick="location.href = '{{ route('showDataAll',['status'=>'registration','id'=>$form_one_data->id]) }}';" type="button" class="btn btn-primary float-right">ডাক দেখুন</button>

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
                                                    class="icofont icofont-ui-home"></i>
                                                    @if($ngoTypeData->ngo_type_new_old == 'Old')
                                                    এফডি -৮ ফরম
                                                    @else
                                                    এফডি -১ ফরম

                                                    @endif


                                                </a></li>




                                    <li class="nav-item"><a class="nav-link" id="pills-darkdoc-tab"
                                                            data-bs-toggle="pill" href="#pills-darkdoc"
                                                            role="tab" aria-controls="pills-darkdoc"
                                                            aria-selected="false" style=""><i
                                                    class="icofont icofont-animal-lemur"></i>নথিপত্র</a>
                                    </li>



                                    @if($r_status == "Accepted")

                                    <li class="nav-item"><a class="nav-link" id="pills-darkdoc1-tab"
                                        data-bs-toggle="pill" href="#pills-darkdoc1"
                                        role="tab" aria-controls="pills-darkdoc1"
                                        aria-selected="false" style=""><i
                                class="icofont icofont-animal-lemur"></i>সার্টিফিকেট প্রিন্ট করুন </a>
                </li>

                @else

                <li class="nav-item"><a class="nav-link" id="pills-darkdoc1-tab"
                    data-bs-toggle="pill" href="#pills-darkdoc1"
                    role="tab" aria-controls="pills-darkdoc1"
                    aria-selected="false" style=""><i
            class="icofont icofont-animal-lemur"></i>স্টেটাস আপডেট করুন </a>
             </li>



                @endif

                                </ul>
                                <div class="tab-content" id="pills-darktabContent">
                                    <div class="tab-pane fade active show" id="pills-darkhome"
                                         role="tabpanel" aria-labelledby="pills-darkhome-tab">
                                        <div class="mb-0 m-t-30">

                                            @if($ngoTypeData->ngo_type_new_old == 'Old')

                                            @include('admin.registration_list.foreign.fd_eight_form')
                                            @else

                                            @include('admin.registration_list.foreign.fd_one_form')
                                            @endif

                                          </div>
                                        </div>

                                        @if($ngoTypeData->ngo_type_new_old == 'Old')

                                        @else
                                </div>
                                @endif

                                    <div class="tab-pane fade" id="pills-darkdoc" role="tabpanel"
                                         aria-labelledby="pills-darkdoc-tab">
                                        <div class="mb-0 m-t-30">

                                            @if($ngoTypeData->ngo_type_new_old == 'Old')

                                            @include('admin.registration_list.foreign.renew_document')
                                            @else

@include('admin.registration_list.foreign.registration_document')
                                            @endif

                                        </div>
                                    </div>



                                    @if($r_status == "Accepted" )






                                    <div class="tab-pane fade" id="pills-darkdoc1" role="tabpanel"
                                         aria-labelledby="pills-darkdoc1-tab">
                                        <div class="mb-0 m-t-30">
<!--cc-->
<table class="table table-bordered">
    <tbody>
    <tr>
        <td>১.</td>
        <td colspan="3">সংস্থার বিবরণ:</td>
    </tr>

    @if($ngoTypeData->ngo_type_new_old == 'Old')
    <tr>
        <td></td>
        <td>(i)</td>
        <td>নিবন্ধন নম্বর</td>
        <td>:







          {{ App\Http\Controllers\Admin\CommonController::englishToBangla($ngoTypeData->registration)}}





      </td>
    </tr>
    <tr>
        <td></td>
        <td>(ii)</td>
        <td>সংস্থার নাম</td>
        <td>: {{ $form_one_data->organization_name_ban }}</td>
    </tr>


    <tr>
        <td></td>
        <td>(iii)</td>
        <td>মেয়াদ শুরু </td>
        <td>:
<?php

$lastDate = date('Y-m-d', strtotime($ngoTypeData->last_renew_date));
$newdate = date("Y-m-d",strtotime ( '-10 year' , strtotime ( $lastDate ) )) ;

?>


          {{App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-m-Y', strtotime($newdate)))}}


      </td>
    </tr>


    <tr>
        <td></td>
        <td>(iv)</td>
        <td>শেষ নবায়ন তারিখ</td>
        <td>:



          {{App\Http\Controllers\Admin\CommonController::englishToBangla($ngoTypeData->last_renew_date)}}


      </td>
    </tr>


    @else
    <tr>
        <td></td>
        <td>(i)</td>
        <td>নিবন্ধন নম্বর</td>
        <td>:





          @if($form_one_data->registration_number == 0)


          @else

          {{ App\Http\Controllers\Admin\CommonController::englishToBangla($form_one_data->registration_number)}}

          @endif



      </td>
    </tr>
    <tr>
        <td></td>
        <td>(i)</td>
        <td>সংস্থার নাম</td>
        <td>: {{ $form_one_data->organization_name_ban }}</td>
    </tr>
    <tr>
        <td></td>
        <td>(iii)</td>
        <td>সংস্থার ঠিকানা</td>
        <td>: {{ $form_one_data->address_of_head_office }}</td>
    </tr>

    <tr>
        <td></td>
        <td>(iv)</td>
        <td>মেয়াদ শুরু </td>
        <td>:

          @if(empty($duration_list_all))


          @else

          {{App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-m-Y', strtotime($duration_list_all )))}}
          @endif

      </td>
    </tr>


    <tr>
        <td></td>
        <td>(v)</td>
        <td>মেয়াদ শেষ </td>
        <td>:
            @if(empty($duration_list_all))


          @else
          {{App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-m-Y', strtotime($duration_list_all1 )))}}
      @endif
      </td>
    </tr>
    @endif
    <tr>
        <td></td>
        <td colspan="3"><!-- Button trigger modal -->




           @if($form_one_data->registration_number_given_by_admin == 0)
           <button type="button" disabled class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            প্রিন্ট করুন
            </button>
          @else
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                প্রিন্ট করুন
            </button>
          @endif


          <form action="{{ route('printCertificateViewDemo') }}" method="get" id="form">

            <input type="hidden" name="user_id" value="{{ $form_one_data->user_id  }}"/>

            <input type="hidden" name="main_date" value="<?php   echo  date('Y-m-d'); ?>" class="form-control"/>

            <button type="submit" class="btn btn-primary mt-4" type="submit">
                ডেমো
              </button>
        </form>


            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">সার্টিফিকেট প্রিন্ট করুন </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">

                    <form action="{{ route('printCertificateView') }}" method="get" id="form">

                        <input type="hidden" name="user_id" value="{{ $form_one_data->user_id  }}"/>

                        <input type="date" name="main_date" value="<?php   echo  date('Y-m-d'); ?>" class="form-control"/>

                        <button type="submit" class="btn btn-primary mt-4" type="submit">
                            প্রিন্ট করুন
                          </button>
                    </form>
                  </div>

                </div>
              </div>
            </div></td>
    </tr>
    </tbody>
</table>

<!---vvvvvvvvv-->
                                        </div>
                                    </div>
                                    @else
                                    <?php
                                    $fdOneFormId = DB::table('fd_one_forms')->where('id',$form_one_data->id)->value('user_id');
                                    $get_email_from_user = DB::table('users')->where('id',$fdOneFormId)->value('email');

                                            ?>
                                    <!--new-->

                                    <div class="tab-pane fade" id="pills-darkdoc1" role="tabpanel"
                                         aria-labelledby="pills-darkdoc1-tab">
                                        <div class="mb-0 m-t-30">


                                            <form action="{{ route('updateStatusRegForm') }}" method="post" id="form">
                                                @csrf


                                                <input type="hidden" value="{{ $all_data_for_new_list_all->id }}" name="id" />

                                                <input type="hidden" value="{{ $get_email_from_user }}" name="email" />


                                                @if($ngoTypeData->ngo_type_new_old == 'Old')

                                                <input type="hidden" value="old" name="ngotype" />

                                                <label>স্টেটাস:</label>
                                                <select class="form-control form-control-sm mt-4" name="status" id="regStatus">

                                                    <option value="Ongoing" {{ $all_data_for_new_list_all->status == 'Ongoing' ? 'selected':''  }}>চলমান</option>
                                                    <option value="Accepted" {{ $all_data_for_new_list_all->status == 'Accepted' ? 'selected':''  }}>গৃহীত</option>
                                                    <option value="Correct" {{ $all_data_for_new_list_all->status == 'Correct' ? 'selected':''  }}>সংশোধন করুন</option>
                                                    <option value="Rejected" {{ $all_data_for_new_list_all->status == 'Rejected' ? 'selected':''  }}>প্রত্যাখ্যান করুন</option>

                                                </select>
                                                @else

                                                <input type="hidden" value="new" name="ngotype" />

                                                <label>স্টেটাস:</label>
                                                <select class="form-control form-control-sm mt-4" name="status" id="regStatus">

                                                    <option value="Ongoing" {{ $all_data_for_new_list_all->status == 'Ongoing' ? 'selected':''  }}>চলমান</option>
                                                    <option value="Accepted" {{ $all_data_for_new_list_all->status == 'Accepted' ? 'selected':''  }}>গৃহীত</option>
                                                    <option value="Correct" {{ $all_data_for_new_list_all->status == 'Correct' ? 'selected':''  }}>সংশোধন করুন</option>
                                                    <option value="Rejected" {{ $all_data_for_new_list_all->status == 'Rejected' ? 'selected':''  }}>প্রত্যাখ্যান করুন</option>

                                                </select>
                                                @endif

                                                <div id="rValueStatus" style="display:none;">
                                                    <label>বিস্তারিত লিখুন:</label>
                                                    <textarea class="form-control form-control-sm" name="comment"></textarea>
                                                </div>

<div id="rValue" style="display:none;">
                                                <label>রেজিস্ট্রেশন নম্বর :</label>
                                                @if($form_one_data->registration_number == 0)
                                                <input type="text" value=""  name="reg_no_get_from_admin" class="form-control form-control-sm" />

@else
<input type="text" value="{{ $form_one_data->registration_number }}"  name="reg_no_get_from_admin" class="form-control form-control-sm" />
@endif
</div>

                                                <button type="submit" class="btn btn-primary mt-5">আপডেট করুন</button>

                                              </form>

                                        </div>
                                    </div>

                                    <!--add new -->

                                    @endif
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
