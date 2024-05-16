@extends('admin.master.master')

@section('title')
এফডি - ৬ ফরম | {{ $ins_name }}
@endsection



@section('css')

@endsection

@section('body')
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <h3>প্রকল্প প্রস্তাব ফরম </h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">হোম</a></li>
                    <li class="breadcrumb-item">এফডি - ৬ ফরম</li>
                    <li class="breadcrumb-item">এফডি - ৬ ফরম এর বিবরণ</li>
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
        <div class="card height-equal">
            <div class="card-body">


                <div class="row mb-4">
                    <div class="col-lg-12">

                        <div class="text-end">



                            @if($dataFromFd6Form->status == 'Ongoing')
                            <button onclick="location.href = '{{ route('showDataAll',['status'=>'fdSix','id'=>$dataFromFd6Form->mainId]) }}';" type="button" class="btn btn-primary add-btn">ডাক দেখুন</button>

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
                                    class="icofont icofont-ui-home"></i>এফডি - ৬ ফরম</a></li>


                    <li class="nav-item"><a class="nav-link" id="pills-darkprofile-tab"
                                            data-bs-toggle="pill" href="#pills-darkprofile"
                                            role="tab" aria-controls="pills-darkprofile"
                                            aria-selected="false" style=""><i
                                    class="icofont icofont-man-in-glasses"></i>এফডি -২ ফরম</a>
                    </li>


                    <li class="nav-item"><a class="nav-link" id="pills-darkprofile-tab1"
                        data-bs-toggle="pill" href="#pills-darkprofile1"
                        role="tab" aria-controls="pills-darkprofile1"
                        aria-selected="false" style=""><i
                class="icofont icofont-man-in-glasses"></i>আবেদনের স্টেটাস</a>
</li>



                </ul>
                <div class="tab-content" id="pills-darktabContent">
                    <div class="tab-pane fade active show" id="pills-darkhome"
                         role="tabpanel" aria-labelledby="pills-darkhome-tab">
                      @include('admin.fd6form.fd6Form')

                    </div>
                    <div class="tab-pane fade" id="pills-darkprofile" role="tabpanel"
                         aria-labelledby="pills-darkprofile-tab">
                         @include('admin.fd6form.fd2Form')
                    </div>

                    <!--new tab start-->

                    <div class="tab-pane fade" id="pills-darkprofile1" role="tabpanel"
                         aria-labelledby="pills-darkprofile-tab1">
                        <div class="mb-0 m-t-30">


                            <div class="card">
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <form id="form" action="{{ route('statusUpdateForFd6') }}" method="post">
                                                @csrf


                                                <input type="hidden" value="{{ $dataFromFd6Form->mainId }}" name="id" />


                                                <input type="hidden" value="{{ $get_email_from_user }}" name="email" />

                                                <label>স্টেটাস:</label>
                                                <select class="form-control form-control-sm mt-4" name="status" id="regStatus">

                                                    <option value="Ongoing" {{ $dataFromFd6Form->status == 'Ongoing' ? 'selected':''  }}>চলমান</option>

                                                    <option value="Accepted" {{ $dataFromFd6Form->status == 'Accepted' ? 'selected':''  }}>গৃহীত</option>
                                                    <option value="Correct" {{ $dataFromFd6Form->status == 'Correct' ? 'selected':''  }}>সংশোধন করুন</option>
                                                    <option value="Rejected" {{ $dataFromFd6Form->status == 'Rejected' ? 'selected':''  }}>প্রত্যাখ্যান করুন</option>

                                                </select>


                                                @if($dataFromFd6Form->status == 'Correct' || $dataFromFd6Form->status == 'Rejected')

                                                <div id="rValueStatus" >
                                                    <label>বিস্তারিত লিখুন:</label>
                                                    <textarea class="form-control form-control-sm" name="comment">{{ $dataFromFd6Form->comment }}</textarea>
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
                    <!--end new tab-->
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
