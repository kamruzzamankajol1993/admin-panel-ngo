
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
    <title>পাসওয়ার্ড যোগ করুন | {{ $ins_name }}</title>
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


    <script src="{{ asset('/') }}public/admin/assets/js/jquery-3.5.1.min.js"></script>

    <link rel="stylesheet" href="https://parsleyjs.org/src/parsley.css">
    <link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css'rel='stylesheet'>
<script src="{{ asset('/')}}public/parsely1.js"></script>
<style>

.parsley-required{

    margin-top:10px;
}

.box

{

 width:100%;

 max-width:600px;

 background-color:#f9f9f9;

 border:1px solid #ccc;

 border-radius:5px;

 padding:16px;

 margin:0 auto;

}

input.parsley-success,

select.parsley-success,

textarea.parsley-success {

  color: #468847;

  background-color: #DFF0D8;

  border: 1px solid #D6E9C6;

}

input.parsley-error,

select.parsley-error,

textarea.parsley-error {

  color: #B94A48;

  background-color: #F2DEDE;

  border: 1px solid #EED3D7;

}


.parsley-errors-list {

  margin: 2px 0 3px;

  padding: 0;

  list-style-type: none;

  font-size: 0.9em;

  line-height: 0.9em;

  opacity: 0;


  transition: all .3s ease-in;

  -o-transition: all .3s ease-in;

  -moz-transition: all .3s ease-in;

  -webkit-transition: all .3s ease-in;

}


.parsley-errors-list.filled {

  opacity: 1;

}



.error,.parsley-type, .parsley-required, .parsley-equalto, .parsley-pattern, .parsley-length{

 color:#ff0000;

}



</style>
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
              <form class="theme-form login-form" action="{{route('postPasswordChange')}}" method="post" enctype="multipart/form-data" id="form" data-parsley-validate="">
                @csrf
                <input type="hidden" value="{{ $email }}" name="mainEmail" />
                {{-- <h4>Login</h4> --}}
                <h6>স্বাগত ! আপনার অ্যাকাউন্টে লগ ইন করতে পাসওয়ার্ড যোগ করুন.</h6>

                  <div class="row">
                              <div class="form-group col-md-12 col-sm-12">
                                  <label for="password">পাসওয়ার্ড</label>
                                  <input type="password" class="form-control form-control-sm" id="password"  data-parsley-minlength="8"
                                  data-parsley-required="true" name="password" placeholder="পাসওয়ার্ড" required>

                                  @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif

                            <input type="checkbox" class="mt-2" onclick="myFunction()"> পাসওয়ার্ড দেখুন
                              </div>
                              <div class="form-group col-md-12 col-sm-12">
                                  <label for="password_confirmation">পাসওয়ার্ড নিশ্চিত করুন</label>
                                  <input type="password" class="form-control form-control-sm" data-parsley-equalto="#password"
                                  parsley-required="true" id="password_confirmation" name="password_confirmation" placeholder="পাসওয়ার্ড" required>

                                  <input type="checkbox" class="mt-2" onclick="myFunctionc()"> পাসওয়ার্ড দেখুন
                              </div>
                          </div>



                <div class="form-group">
                  <button class="btn btn-primary btn-block" type="submit">জমা দিন </button>
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
    {{-- <script src="{{ asset('/') }}public/admin/assets/js/jquery-3.5.1.min.js"></script> --}}
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
    function myFunctionc() {
      var x = document.getElementById("password_confirmation");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
    </script>

  </body>
</html>

























