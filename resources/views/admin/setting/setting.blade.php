@extends('admin.master.master')

@section('title')
সেটিং
@endsection


@section('body')
<div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-sm-6">
          <h3>সেটিং </h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">হোম</a></li>
            <li class="breadcrumb-item">সেটিং</li>

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
                    <h4 class="card-title mb-0">আমার প্রোফাইল</h4>
                    <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                  </div>
                  <div class="card-body">
                    @include('flash_message')
                                            <form action="{{ route('setting.store') }}" method="post" enctype="multipart/form-data" id="form">
                                                @csrf
                      <div class="row mb-2">
                        <div class="profile-title">
                          <div class="media">
                            <?php
                            $designationName = DB::table('designation_lists')
                            ->where('id',Auth::guard('admin')->user()->designation_list_id)
                            ->value('designation_name');

                            $branchName = DB::table('branches')
                            ->where('id',Auth::guard('admin')->user()->branch_id)
                            ->value('branch_name');

                       ?>

@if(empty(Auth::guard('admin')->user()->admin_image))
{{-- <img src="{{asset('/')}}public/admin/user.png" alt="user-img" class="img-70 rounded-circle" style="height: 100px;"/> --}}
@else
{{-- <img src="{{asset('/')}}{{ Auth::guard('admin')->user()->admin_image }}" alt="img-70 rounded-circle" class="img-fluid" /> --}}
@endif



                            {{-- <div class="media-body">
                              <h3 class="mb-1 f-20 txt-primary">{{ Auth::guard('admin')->user()->admin_name }}</h3>
                              <p class="f-12">{{ $designationName }}</p>
                            </div> --}}
                          </div>
                        </div>
                      </div>

                      <div class="mb-3">
                        <label class="form-label">ইংরেজি নাম:</label>
                        <input type="text" class="form-control" value="{{ Auth::guard('admin')->user()->admin_name }}" name="admin_name"/>
                        <input type="hidden" class="form-control" value="{{ Auth::guard('admin')->user()->id }}" name="id"/>
                      </div>


                      <div class="mb-3">
                        <label class="form-label">বাংলা নাম:</label>
                        <input type="text" class="form-control" value="{{ Auth::guard('admin')->user()->admin_name_ban }}" name="admin_name_ban"/>

                      </div>


                      <div class="mb-3">
                        <label class="form-label">মোবাইল নম্বর:</label>
                        <input type="text" class="form-control" value="{{ Auth::guard('admin')->user()->admin_mobile }}" name="admin_mobile"/>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">ই-মেইল:</label>
                        <input type="text" class="form-control" value="{{ Auth::guard('admin')->user()->email }}" name="email"/>
                      </div>


                      {{-- <div class="mb-3">
                        <label class="form-label">ছবি:</label>
                        <input type="file" class="form-control"  name="admin_image"/>
                        <div class="avatar-lg">
                        @if(empty(Auth::guard('admin')->user()->admin_image))
<img src="{{asset('/')}}public/admin/user.png" alt="user-img" class="" style="height:50px;"/>
@else
<img src="{{asset('/')}}{{ Auth::guard('admin')->user()->admin_image }}" alt="user-img" class="" style="height:50px;" />
@endif
                        </div>
                      </div> --}}


                      {{-- <div class="mb-3">
                        <label class="form-label">স্বাক্ষর:</label>
                        <input type="file" class="form-control"  name="admin_sign"/>
                        <div class="avatar-lg">
                        @if(empty(Auth::guard('admin')->user()->admin_sign))
<img src="{{asset('/')}}public/admin/user.png" alt="user-img" class="" style="height:50px;"/>
@else
<img src="{{asset('/')}}{{ Auth::guard('admin')->user()->admin_sign }}" alt="user-img" class="" style="height:50px;" />
@endif
                        </div>
                      </div> --}}


                      <div class="form-footer">
                        <button class="btn btn-primary btn-block">আপডেট করুন</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

            </div>
          </div>






    </div><!-- container-fluid -->
</div><!-- End Page-content -->
@endsection

@section('script')
@endsection

