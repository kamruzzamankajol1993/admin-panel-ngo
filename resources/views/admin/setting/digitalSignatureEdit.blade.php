@extends('admin.master.master')

@section('title')
ডিজিটাল স্বাক্ষর
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.js"></script>
@endsection
@section('body')

<style>
.image-preview-container {
    width: 50%;
    margin: 0 auto;
    border: 1px solid rgba(0, 0, 0, 0.1);
    padding: 3rem;
    border-radius: 20px;
}

.image-preview-container img {
    width: 100%;
    display: none;
    margin-bottom: 30px;
}


.image-preview-container input {
    display: none;
}

.login_upload_button{
    display: block;
    width: 45%;
    height: 45px;
    margin-left: 25%;
    text-align: center;
    background: #24695c;
    color: #fff;
    font-size: 15px;
    text-transform: Uppercase;
    font-weight: 400;
    border-radius: 5px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
}





<style>
.image-preview-container1 {
    width: 50%;
    margin: 0 auto;
    border: 1px solid rgba(0, 0, 0, 0.1);
    padding: 3rem;
    border-radius: 20px;
}

.image-preview-container1 img {
    /* width: 100%; */

    margin-bottom: 30px;
}


.image-preview-container1 input {
    display: none;
}

.image-preview-container1 label {
    display: block;
    width: 45%;
    height: 45px;
    margin-left: 25%;
    text-align: center;
    background: #24695c;
    color: #fff;
    font-size: 15px;
    text-transform: Uppercase;
    font-weight: 400;
    border-radius: 5px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
}

</style>
<div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-sm-6">
          <h3>ডিজিটাল স্বাক্ষর  </h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">হোম</a></li>
            <li class="breadcrumb-item">ডিজিটাল স্বাক্ষর </li>

          </ol>
        </div>
        <div class="col-sm-6">

        </div>

        </div>
      </div>
    </div>
    <div class="container-fluid">






        <div class="edit-profile">
            <div class="row">
              <div class="col-xl-12">
                <div class="card">
                  <div class="card-header pb-0">
                    <h4 class="card-title mb-0">ডিজিটাল স্বাক্ষর পরিবর্তন করুন </h4>
                    <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                  </div>
                  <div class="card-body">
                    @include('flash_message')
                                            {{-- <form action="{{ route('digitalSignatureUpdate') }}" method="post" enctype="multipart/form-data" id="form">
                                                @csrf


                                                <input type="hidden" value="{{ Auth::guard('admin')->user()->id }}" name="id" />


    <div class="nvisa-avatar">
        @if(empty(Auth::guard('admin')->user()->admin_sign))
                      <center>  <img src="{{ asset('/') }}public/sign/demo.jpg" alt="" id="output"> </center>
                      @else
                      <center>  <img src="{{ asset('/') }}{{ Auth::guard('admin')->user()->admin_sign }}" alt="" id="output"> </center>
                      @endif
                    </div>
                    <input type="file" accept="image/*"
                    onchange="loadFile(event)" name="admin_sign" required id="upload" hidden/>
             <label class="login_upload_button btn btn-registration"  for="upload">ছবি নির্বাচন করুন</label>



                                                <div class="alert alert-warning d-flex align-items-center mt-3" role="alert">
                                                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                                    <div style="color:black !important">
                                                        প্রোফাইল স্বাক্ষর অবশ্যই ৩০০ X ৮০ পিক্সেল (প্রস্থ X উচ্চতা ) এবং ফাইল এর আকার অবশ্যই ৫০ কিলো বাইটের কম এবং JPG বা JPEG ফরমেটে হতে হবে
                                                    </div>
                                                  </div>


                                                <div class="form-footer">
                                                    <button type="submit" class="btn btn-primary btn-block">আপডেট করুন</button>
                                                  </div>


                    </form> --}}


                    <div class="row">
                        <div class="col-md-4 text-center">
                            <div id="upload-demo"></div>
                        </div>
                        <div class="col-md-4" style="padding:5%;">
                            <strong>Select image for crop:</strong>
                            <input type="file" id="images" name="image">
                            <button class="btn btn-primary btn-block image-upload" style="margin-top:2%">Upload Image</button>
                        </div>
                        <div class="col-md-4">





                            @if(empty(Auth::guard('admin')->user()->admin_sign))
                            <div id="show-crop-image" style="background:#e2e2e2;width:400px;padding:60px 60px;height:200px;"></div>
                            @else
                            <div id="show-crop-image" style="background:#e2e2e2;width:400px;padding:60px 60px;height:200px;"><img src="{{ asset('/') }}{{ Auth::guard('admin')->user()->admin_sign }}" alt="" id="output"></div>
                            @endif
                        </div>
                    </div>
                    <div class="alert alert-warning d-flex align-items-center mt-3" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                        <div style="color:black !important">
                            প্রোফাইল স্বাক্ষর অবশ্যই ৩০০ X ৮০ পিক্সেল (প্রস্থ X উচ্চতা ) এবং ফাইল এর আকার অবশ্যই ৫০ কিলো বাইটের কম এবং JPG বা JPEG ফরমেটে হতে হবে
                        </div>
                      </div>

                    <input type="hidden" value="{{ Auth::guard('admin')->user()->id }}" id="mainid" name="id" />
                  </div>
                </div>
              </div>

            </div>
          </div>






    </div><!-- container-fluid -->
</div><!-- End Page-content -->
@endsection

@section('script')
<script type="text/javascript">
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    var resize = $('#upload-demo').croppie({
        enableExif: true,
        enableOrientation: true,
        viewport: {
            width: 300,
            height: 80,
            type: 'square'
        },

        boundary: {
            width: 400,
            height: 200
        }
    });

    $('#images').on('change', function () {
      var reader = new FileReader();
        reader.onload = function (e) {
          resize.croppie('bind',{
            url: e.target.result
          }).then(function(){
            console.log('success bind image');
          });

        }
        reader.readAsDataURL(this.files[0]);
    });

    $('.image-upload').on('click', function (ev) {


        var mainId = $('#mainid').val();
       // alert(mainId);

      resize.croppie('result', {
        type: 'canvas',
        size: 'viewport'

      }).then(function (img) {
        $.ajax({
          url: '{{ route('digitalSignatureUpdate') }}',
          type: "post",
          data: {"image":img,"mainId":mainId},
          success: function (data) {
            html = '<img src="' + img + '" />';
            $("#show-crop-image").html('');
            $("#show-crop-image").html(html);
          }
        });
      });
    });
 </script>
@endsection

