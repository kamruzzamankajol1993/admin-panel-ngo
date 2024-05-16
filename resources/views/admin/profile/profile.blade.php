@extends('admin.master.master')

@section('title')
প্রোফাইল
@endsection


@section('body')

<div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-sm-6">
          <h3>প্রোফাইল </h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">হোম</a></li>
            <li class="breadcrumb-item">প্রোফাইল</li>

          </ol>
        </div>
        <div class="col-sm-6">

        </div>

        </div>
      </div>
    </div>
    <?php
    $designationName = DB::table('designation_lists')
    ->where('id',Auth::guard('admin')->user()->designation_list_id)
    ->value('designation_name');

    $branchName = DB::table('branches')
    ->where('id',Auth::guard('admin')->user()->branch_id)
    ->value('branch_name');

?>

    <div class="user-profile">
        <div class="row">
          <!-- user profile header start-->
       
          <!-- user profile header end-->
          <div class="col-xl-12 col-lg-12 col-md-12 xl-35">
            <div class="default-according style-1 faq-accordion job-accordion">
              <div class="row">
                <div class="col-xl-12">
                  <div class="card">
                    <div class="card-header">

                      <h5 class="p-0">
                        <button class="btn btn-link ps-0" data-bs-toggle="collapse" data-bs-target="#collapseicon2" aria-expanded="true" aria-controls="collapseicon2">আমার সম্পর্কে</button>
                      </h5>
                    </div>
                    <div class="collapse show" id="collapseicon2" aria-labelledby="collapseicon2" data-parent="#accordion">
                      <div class="card-body post-about">
                        <ul>
                          <li>
                            <div class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-briefcase"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg></div>
                            <div>
                              <h5>ইংরেজি নাম:</h5>
                              <p>{{ Auth::guard('admin')->user()->admin_name }}</p>
                            </div>
                          </li>
                          <li>
                            <div class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg></div>
                            <div>
                              <h5>বাংলা নাম:</h5>
                              <p>{{ Auth::guard('admin')->user()->admin_name_ban }}</p>
                            </div>
                          </li>
                          <li>
                            <div class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg></div>
                            <div>
                              <h5>পদবী:</h5>
                              <p>{{ $designationName}}</p>
                            </div>
                          </li>
                          <li>
                            <div class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg></div>
                            <div>
                              <h5>বিভাগ :</h5>
                              <p>{{ $branchName}}</p>
                            </div>
                          </li>
                          <li>
                            <div class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-droplet"><path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"></path></svg></div>
                            <div>
                              <h5>মোবাইল নম্বর :</h5>
                              <p>{{ App\Http\Controllers\Admin\CommonController::englishToBangla(Auth::guard('admin')->user()->admin_mobile) }}</p>
                            </div>
                          </li>

                          <li>
                            <div class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg></div>
                            <div>
                              <h5>ই-মেইল:</h5>
                              <p>{{ Auth::guard('admin')->user()->email }}</p>
                            </div>
                          </li>
                        </ul>

                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>

        </div>
      </div>
@endsection

@section('script')
@endsection

