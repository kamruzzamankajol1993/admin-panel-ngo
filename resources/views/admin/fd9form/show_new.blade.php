@extends('admin.master.master')

@section('title')
এফডি - ৯ ফরম | {{ $ins_name }}
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
                <h3>বিদেশী কর্মকর্তার নিয়োগ পত্রের সত্যায়ন পত্র </h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">হোম</a></li>
                    <li class="breadcrumb-item">এফডি - ৯ ফরম</li>
                    <li class="breadcrumb-item">এফডি - ৯ ফরম এর বিবরণ </li>
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

                           @if($dataFromNVisaFd9Fd1->status == 'Ongoing')
                            <button onclick="location.href = '{{ route('showDataAll',['status'=>'fdNine','id'=>$mainIdFdNine]) }}';" type="button" class="btn btn-primary float-right">ডাক দেখুন</button>

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
                                    class="icofont icofont-ui-home"></i>এফডি - ৯ ফরম </a></li>


                    <li class="nav-item"><a class="nav-link" id="pills-darkdoc-tab"
                                            data-bs-toggle="pill" href="#pills-darkdoc"
                                            role="tab" aria-controls="pills-darkdoc"
                                            aria-selected="false" style=""><i
                                    class="icofont icofont-animal-lemur"></i>নথিপত্র</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" id="pills-darkdoc1-tab"
                        data-bs-toggle="pill" href="#pills-darkdoc1"
                        role="tab" aria-controls="pills-darkdoc1"
                        aria-selected="false" style=""><i
                class="icofont icofont-animal-lemur"></i>আবেদনের স্টেটাস</a>
</li>
                </ul>
                <div class="tab-content" id="pills-darktabContent">
                    <div class="tab-pane fade active show" id="pills-darkhome"
                         role="tabpanel" aria-labelledby="pills-darkhome-tab">
                        @include('admin.fd9form.fd9form')

                    </div>


                    <div class="tab-pane fade" id="pills-darkdoc" role="tabpanel"
                         aria-labelledby="pills-darkdoc-tab">
                         @include('admin.fd9form.fd9formDoc')
                    </div>



                    <div class="tab-pane fade" id="pills-darkdoc1" role="tabpanel"
                    aria-labelledby="pills-darkdoc1-tab">
                   <div class="mb-0 m-t-30">

                    <div class="card">
                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-12">
                                    <form  id="form" action="{{ route('statusUpdateForFd9') }}" method="post">
                                        @csrf


                                        <input type="hidden" value="{{ $dataFromNVisaFd9Fd1->id }}" name="id" />

                                        <input type="hidden" value="{{ $get_email_from_user }}" name="email" />

                                        <label>স্টেটাস:</label>
                                        <select class="form-control form-control-sm mt-4" name="status" id="regStatus">

                                            <option value="Ongoing" {{ $dataFromNVisaFd9Fd1->status == 'Ongoing' ? 'selected':''  }}>চলমান</option>

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
