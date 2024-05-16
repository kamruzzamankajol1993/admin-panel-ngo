@extends('admin.master.master')

@section('title')
পাসওয়ার্ড
@endsection


@section('body')


<style>
.wrapper {
  width: 450px;
  overflow: hidden;
  padding: 28px;
  border-radius: 8px;
  background: #fff;
  box-shadow: 0 10px 25px rgba(0,0,0,0.06);
}
.pass-field {
  height: 35px;
  width: 100%;
  position: relative;
}
.pass-field input {
  width: 100%;
  height: 100%;
  outline: none;
  padding: 0 17px;
  font-size: 1rem;
  border-radius: 5px;
  border: 1px solid #999;
}
.pass-field input:focus {
  padding: 0 16px;
  border: 2px solid #4285F4;
}
.pass-field i {
  right: 18px;
  top: 50%;
  font-size: 1.2rem;
  color: #999;
  cursor: pointer;
  position: absolute;
  transform: translateY(-50%);
}



.pass-field1 {
  height: 35px;
  width: 100%;
  position: relative;
}
.pass-field1 input {
  width: 100%;
  height: 100%;
  outline: none;
  padding: 0 17px;
  font-size: 1rem;
  border-radius: 5px;
  border: 1px solid #999;
}
.pass-field1 input:focus {
  padding: 0 16px;
  border: 2px solid #4285F4;
}
.pass-field1 i {
  right: 18px;
  top: 50%;
  font-size: 1.2rem;
  color: #999;
  cursor: pointer;
  position: absolute;
  transform: translateY(-50%);
}



.wrapper .content {
  margin: 20px 0 10px;
}
.content p {
  color: #333;
  font-size: 1.3rem;
}
.content .requirement-list {
  margin-top: 20px;
}
.requirement-list li {
  font-size: 1.3rem;
  list-style: none;
  display: flex;
  align-items: center;
  margin-bottom: 15px;
}
.requirement-list li i {
  width: 20px;
  color: #e41414;
  font-size: 0.6rem;
}
.requirement-list li.valid i {
  font-size: 1.2rem;
  color: #328036;
}
.requirement-list li span {
  margin-left: 12px;
  color: #dd1919;
}
.requirement-list li.valid span {
  color: #328036;
}
</style>

<div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-sm-6">
          <h3>পাসওয়ার্ড</h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">হোম</a></li>
            <li class="breadcrumb-item">পাসওয়ার্ড</li>

          </ol>
        </div>
        <div class="col-sm-6">

        </div>

        </div>
      </div>
    </div>


    <div class="container-fluid">


        <div class="row">
            <div class="col-sm-8">
                <form action="{{ route('passwordUpdate') }}" method="post" enctype="multipart/form-data" id="form">
                    @csrf


                    <input type="hidden" value="{{ Auth::guard('admin')->user()->id }}" name="id" />
                <div class="card">
                    <div class="card-header pb-0">
                      <h4 class="card-title mb-0">পাসওয়ার্ড পরিবর্তন করুন </h4>
                      @include('flash_message')
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col">

                              <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">বর্তমান পাসওয়ার্ড :</label>
                                <div class="col-sm-9">
                                  <input class="form-control" type="password" name="old_password" placeholder="বর্তমান পাসওয়ার্ড">
                                </div>
                              </div>



                              <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">নতুন পাসওয়ার্ড :</label>



                                <div class="col-sm-9">

                                    <div class="pass-field">
                                        <input type="password" name="password" class="form-control" placeholder="নতুন পাসওয়ার্ড">
                                        <i class="fa fa-eye"></i>
                                      </div>



                                </div>
                              </div>



                              <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">পুনরায় পাসওয়ার্ড:</label>
                                <div class="col-sm-9">
                                 <div class="pass-field1">
                                  <input class="form-control" type="password" name="password_confirmation" placeholder="পুনরায়  পাসওয়ার্ড">
                                   <i class="fa fa-eye"></i>
                                  </div>
                                </div>
                              </div>





                            </div>
                          </div>


                    </div>

                    <div class="card-footer text-end"  id="buttonRemove">
                        <div class="col-sm-9 offset-sm-3">
                          <button class="btn btn-primary" type="submit">সংরক্ষণ করুন </button>

                        </div>
                      </div>



                </div>
                </form>
            </div>

            <div class="col-sm-4">
                <div class="card">

                    <div class="card-body">
                        <div class="content">

                            <ul class="requirement-list">
                              <li>
                                <i class="fa fa-circle"></i>
                                <span>কমপক্ষে ৮টি অক্ষর</span>
                              </li>
                              <li>
                                <i class="fa fa-circle"></i>
                                <span>কমপক্ষে ১টি  সংখ্যা (০...৯)</span>
                              </li>
                              <li>
                                <i class="fa fa-circle"></i>
                                <span>কমপক্ষে ১টি ছোট হাতের অক্ষর (a...z)</span>
                              </li>
                              <li>
                                <i class="fa fa-circle"></i>
                                <span>কমপক্ষে ১টি বিশেষ অক্ষর  (!...$)</span>
                              </li>
                              <li>
                                <i class="fa fa-circle"></i>
                                <span>কমপক্ষে ১টি বড় হাতের অক্ষর (A...Z)</span>
                              </li>
                            </ul>
                          </div>
                    </div>

                </div>
            </div>


        </div>
    </div>


@endsection


@section('script')
<script>
    const passwordInput = document.querySelector(".pass-field input");
    const passwordInputOne = document.querySelector(".pass-field1 input");
const eyeIcon = document.querySelector(".pass-field i");
const eyeIconOne = document.querySelector(".pass-field1 i");
const requirementList = document.querySelectorAll(".requirement-list li");

// An array of password requirements with corresponding
// regular expressions and index of the requirement list item
const requirements = [
    { regex: /.{8,}/, index: 0 }, // Minimum of 8 characters
    { regex: /[0-9]/, index: 1 }, // At least one number
    { regex: /[a-z]/, index: 2 }, // At least one lowercase letter
    { regex: /[^A-Za-z0-9]/, index: 3 }, // At least one special character
    { regex: /[A-Z]/, index: 4 }, // At least one uppercase letter
]

passwordInput.addEventListener("keyup", (e) => {
    requirements.forEach(item => {
        // Check if the password matches the requirement regex
        const isValid = item.regex.test(e.target.value);
        const requirementItem = requirementList[item.index];

        // Updating class and icon of requirement item if requirement matched or not
        if (isValid) {
            requirementItem.classList.add("valid");
            requirementItem.firstElementChild.className = "fa fa-check";

            document.getElementById('buttonRemove').style.display = 'block';





        } else {
            requirementItem.classList.remove("valid");
            requirementItem.firstElementChild.className = "fa fa-circle";
            document.getElementById('buttonRemove').style.display = 'none';

        }
    });
});

eyeIcon.addEventListener("click", () => {
    // Toggle the password input type between "password" and "text"
    passwordInput.type = passwordInput.type === "password" ? "text" : "password";

    // Update the eye icon class based on the password input type
    eyeIcon.className = `fa fa-eye${passwordInput.type === "password" ? "" : "-slash"}`;
});



eyeIconOne.addEventListener("click", () => {
    // Toggle the password input type between "password" and "text"
    passwordInputOne.type = passwordInputOne.type === "password" ? "text" : "password";

    // Update the eye icon class based on the password input type
    eyeIconOne.className = `fa fa-eye${passwordInputOne.type === "password" ? "" : "-slash"}`;
});


</script>
@endsection
