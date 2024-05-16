
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $ins_name }}" />
	<meta property="og:title" content="{{ $ins_name }}" />
	<meta property="og:description" content="{{ $ins_name }}" />
	<meta property="og:image" content="{{ asset('/') }}{{ $logo }}" />
    <link rel="icon" href="{{ asset('/') }}{{ $icon }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('/') }}{{ $icon }}" type="image/x-icon">
    <title>পাসওয়ার্ড পরিবর্তন করুন | {{ $ins_name }}</title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}public/admin/assets/css/fontawesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}public/admin/assets/css/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}public/admin/assets/css/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}public/admin/assets/css/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}public/admin/assets/css/feather-icon.css">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}public/admin/assets/css/sweetalert2.css">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}public/admin/assets/css/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}public/admin/assets/css/style.css">
    <link id="color" rel="stylesheet" href="{{ asset('/') }}public/admin/assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}public/admin/assets/css/responsive.css">
  </head>
  <body>
    <!-- Loader starts-->
    <div class="loader-wrapper">
      <div class="theme-loader">
        <div class="loader-p"></div>
      </div>
    </div>
    <!-- Loader ends-->
    <!-- page-wrapper Start-->
    <section>
      <div class="container-fluid p-0">
        <div class="row">
          <div class="col-12">
            <div class="login-card">

              <form id="form" class="theme-form login-form" action="{{route('checkMailPost')}}" method="post">
                @csrf
                @include('flash_message')
                <h4>পাসওয়ার্ড পরিবর্তন করুন </h4>
                {{-- <h6>ফিরে আসার জন্য স্বাগতম! আপনার অ্যাকাউন্টে লগ ইন করুন।</h6> --}}
                <div class="form-group">
                  <label>ইমেইল এড্রেস</label>
                  <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                    <input class="form-control" name="email" id="mainEmail" type="email" required="" placeholder="Test@gmail.com">
                  </div>
                </div>
                {{-- <div class="form-group">
                  <label>পাসওয়ার্ড</label>
                  <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                    <input class="form-control" type="password" id="password" name="password" required="" placeholder="*********">
                    {{-- <div class="show-hide"><span class="show">                         </span></div> --}}
                  {{-- </div>
                </div> --}}
                {{-- <div class="form-group">
                  <div class="checkbox">
                    <input id="checkbox1" type="checkbox">
                    <label class="text-muted" for="checkbox1" onclick="myFunction()">পাসওয়ার্ড দেখুন </label>
              </div><a class="link" href="{{ route('forgetPassword') }}">Forgot password?</a>
                </div> --}}
                <div class="form-group">
                  <button class="btn btn-primary btn-block" id="finalValue" type="submit">জমা দিন</button>
                </div>

                {{-- <p>Don't have account?<a class="ms-2" href="sign-up.html">Create Account</a></p> --}}
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- page-wrapper end-->
    <!-- latest jquery-->
    <script src="{{ asset('/') }}public/admin/assets/js/jquery-3.5.1.min.js"></script>
    <!-- feather icon js-->
    <script src="{{ asset('/') }}public/admin/assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="{{ asset('/') }}public/admin/assets/js/icons/feather-icon/feather-icon.js"></script>
    <!-- Sidebar jquery-->
    <script src="{{ asset('/') }}public/admin/assets/js/sidebar-menu.js"></script>
    <script src="{{ asset('/') }}public/admin/assets/js/config.js"></script>
    <!-- Bootstrap js-->
    <script src="{{ asset('/') }}public/admin/assets/js/bootstrap/popper.min.js"></script>
    <script src="{{ asset('/') }}public/admin/assets/js/bootstrap/bootstrap.min.js"></script>
    <!-- Plugins JS start-->
    <script src="{{ asset('/') }}public/admin/assets/js/sweet-alert/sweetalert.min.js"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{ asset('/') }}public/admin/assets/js/script.js"></script>
    <!-- login js-->
    <!-- Plugin used-->

    <script>
        function myFunction() {
          var x = document.getElementById("password");
          if (x.type === "password") {
            x.type = "text";
          } else {
            x.type = "password";
          }
        }
        </script>


<script>
    $(document).ready(function () {
        $("#mainEmail").keyup(function () {
            var mainId = $(this).val();
            //alert(mainId);

            $.ajax({
        url: "{{ route('checkMailForPassword') }}",
        method: 'GET',
        data: {mainId:mainId},
        success: function(data) {

            //alert(data);

         if(data == 0){

            $('#finalValue').attr('disabled','disabled');

         }else{
            $('#finalValue').removeAttr('disabled');

         }
        }
    });
        });
    });
</script>
  </body>
</html>

























