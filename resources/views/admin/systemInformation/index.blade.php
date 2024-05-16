@extends('admin.master.master')

@section('title')
সিস্টেম এর তথ্য
@endsection


@section('body')
<div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-sm-6">
          <h3>সিস্টেম এর তথ্য </h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">হোম</a></li>
            <li class="breadcrumb-item">সিস্টেম এর তথ্য </li>

          </ol>
        </div>
        <div class="col-sm-6">

        </div>
        <div class="col-sm-6">
            @if(count($systemInformation) >= 1)


            @else

                 <button class="btn btn-primary add-btn" type="button"  data-bs-toggle="modal" data-bs-target="#exampleModal">
                     <i class="ri-add-line align-bottom me-1"></i> তথ্য যোগ করুন
                                                     </button>


                                                     <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                         <div class="modal-dialog">
                                                           <div class="modal-content">
                                                             <div class="modal-header">
                                                               <h1 class="modal-title fs-5" id="exampleModalLabel">তথ্য যোগ করুন</h1>
                                                               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                             </div>
                                                             <div class="modal-body">
                                                                 <form method="post" action="{{ route('systemInformation.store') }}" enctype="multipart/form-data" id="form">

                                                                    @csrf

                                                                     <div class="row">
                                                                         <div class="col-md-6">
                                                                             <div class="mb-4">
                                                                                 <label for="formrow-email-input" class="form-label"> নাম</label>
                                                                                 <input type="text" name="name"  class="form-control" placeholder="নাম" required>
                                                                                 <small></small>
                                                                             </div>
                                                                         </div>
                                                                         <div class="col-md-6">
                                                                             <div class="mb-4">
                                                                                 <label for="formFile" class="form-label">লোগো</label>
                                                                                 <input name="logo" value="" class="form-control" type="file" id="formFile" required>

                                                                             </div>
                                                                         </div>


                                                                         <div class="col-md-6">
                                                                             <div class="mb-4">
                                                                                 <label for="formFile" class="form-label"> আইকন</label>
                                                                                 <input name="icon" value="" class="form-control" type="file" id="formFile" required>

                                                                             </div>
                                                                         </div>







                                                                         <div class="col-md-6">
                                                                             <div class="mb-4">
                                                                                 <label for="formrow-inputZip" class="form-label">ফোন নম্বর</label>
                                                                                 <input name="phone"  type="text" class="form-control" id="formrow-inputZip" placeholder="ফোন নম্বর" required>
                                                                                 <small></small>
                                                                             </div>
                                                                         </div>
                                                                         <div class="col-md-6">
                                                                             <div class="mb-4">
                                                                                 <label for="formrow-inputZip" class="form-label">ইমেইল</label>
                                                                                 <input name="email"  type="email" class="form-control" id="formrow-inputZip" placeholder="ইমেইল" required>
                                                                                 <small></small>
                                                                             </div>
                                                                         </div>


                                                                         <div class="col-md-6">
                                                                             <div class="mb-4">
                                                                                 <label for="formrow-inputZip" class="form-label">ইউআরএল</label>
                                                                                 <input name="url"  type="text" class="form-control" id="formrow-inputZip" placeholder="ইউআরএল" required>
                                                                                 <small></small>
                                                                             </div>
                                                                         </div>

                                                                         <div class="col-md-6">
                                                                            <div class="mb-4">
                                                                                <label for="formrow-inputZip" class="form-label">অ্যাডমিন ইউআরএল</label>
                                                                                <input name="admin_url"  type="text" class="form-control" id="formrow-inputZip" placeholder="ইউআরএল" required>
                                                                                <small></small>
                                                                            </div>
                                                                        </div>


                                                                         <div class="col-md-6">
                                                                             <div class="mb-4">
                                                                                 <label for="formrow-email-input" class="form-label">ঠিকানা</label>
                                                                                 <input name="address"  type="text" class="form-control" id="formrow-email-input" placeholder="ঠিকানা" required>
                                                                             </div>
                                                                         </div>


                                                                     </div>






                                                                     <div>
                                                                         <button type="submit" class="btn btn-primary w-md">জমা দিন </button>
                                                                     </div>


                                                                 </form>
                                                             </div>

                                                           </div>
                                                         </div>
                                                       </div>

@endif
        </div>
      </div>
    </div>
  </div>




  <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">

                    <div class="card-body">
                        @include('flash_message')
                        <table id="basic-1" class="display table table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>লোগো</th>
                                    <th>আইকন</th>
                                    <th>নাম</th>
                                    <th>ফোন নম্বর</th>
                                    <th>ইমেইল</th>
                                    <th>ইউআরএল</th>
                                    <th>অ্যাডমিন ইউআরএল</th>
                                    <th>ঠিকানা</th>
                                    <th>কার্যকলাপ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($systemInformation as $key=>$allSystemInformation)
                                <tr>
                                    <td><img src="{{ asset('/') }}{{ $allSystemInformation->system_logo }}" style="height:20px;"/></td>
                                    <td><img src="{{ asset('/') }}{{ $allSystemInformation->system_icon }}" style="height:20px;"/></td>
                                    <td>{{ $allSystemInformation->system_name }}</td>
                                    <td>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($allSystemInformation->system_phone) }}</td>
                                    <td>{{ $allSystemInformation->system_email }}</td>
                                    <td>{{ $allSystemInformation->system_url }}</td>
                                    <td>{{ $allSystemInformation->system_admin_url }}</td>
                                    <td>{{ $allSystemInformation->system_address }}</td>
                                    <td>
                                        <a data-bs-toggle="modal" data-bs-target="#exampleModal{{ $key+1 }}" class="btn btn-primary waves-light waves-effect  btn-sm"><i class="fa fa-pencil"></i></a>


                                        <div class="modal fade" id="exampleModal{{ $key+1 }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h1 class="modal-title fs-5" id="exampleModalLabel">আপডেট করুন </h1>
                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" action="{{ route('systemInformation.update',$allSystemInformation->id)}}" enctype="multipart/form-data" id="form">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="mb-4">
                                                                    <label for="formrow-email-input" class="form-label"> নাম</label>
                                                                    <input type="text" name="name" value="{{ $allSystemInformation->system_name }}"  class="form-control" placeholder="নাম" required>
                                                                    <small></small>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-4">
                                                                    <label for="formFile" class="form-label"> লোগো</label>
                                                                    <input name="logo" value="" class="form-control" type="file" id="formFile" >
                                                                    <img src="{{ asset('/') }}{{ $allSystemInformation->system_logo }}" style="height:20px;"/>

                                                                </div>
                                                            </div>


                                                            <div class="col-md-6">
                                                                <div class="mb-4">
                                                                    <label for="formFile" class="form-label"> আইকন</label>
                                                                    <input name="icon" value="" class="form-control" type="file" id="formFile" >
                                                                    <img src="{{ asset('/') }}{{ $allSystemInformation->system_icon }}" style="height:20px;"/>
                                                                </div>
                                                            </div>







                                                            <div class="col-md-6">
                                                                <div class="mb-4">
                                                                    <label for="formrow-inputZip" class="form-label">ফোন নম্বর</label>
                                                                    <input name="phone" value="{{ $allSystemInformation->system_phone }}"   type="text" class="form-control" id="formrow-inputZip" placeholder="ফোন নম্বর" required>
                                                                    <small></small>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-4">
                                                                    <label for="formrow-inputZip" class="form-label">ইমেইল</label>
                                                                    <input name="email" value="{{ $allSystemInformation->system_email }}"   type="email" class="form-control" id="formrow-inputZip" placeholder="ইমেইল" required>
                                                                    <small></small>
                                                                </div>
                                                            </div>


                                                            <div class="col-md-6">
                                                                <div class="mb-4">
                                                                    <label for="formrow-inputZip" class="form-label">ইউআরএল</label>
                                                                    <input name="url" value="{{ $allSystemInformation->system_url }}"  type="text" class="form-control" id="formrow-inputZip" placeholder="ইউআরএল" required>
                                                                    <small></small>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="mb-4">
                                                                    <label for="formrow-inputZip" class="form-label">অ্যাডমিন ইউআরএল</label>
                                                                    <input name="admin_url"  type="text" value="{{ $allSystemInformation->system_admin_url }}" class="form-control" id="formrow-inputZip" placeholder="ইউআরএল" required>
                                                                    <small></small>
                                                                </div>
                                                            </div>


                                                            <div class="col-md-6">
                                                                <div class="mb-4">
                                                                    <label for="formrow-email-input" class="form-label">ঠিকানা</label>
                                                                    <input name="address" value="{{ $allSystemInformation->system_address }}"   type="text" class="form-control" id="formrow-email-input" placeholder="ঠিকানা" required>
                                                                </div>
                                                            </div>


                                                        </div>






                                                        <div>
                                                            <button type="submit" class="btn btn-primary w-md">আপডেট করুন</button>
                                                        </div>


                                                    </form>
                                                </div>

                                              </div>
                                            </div>
                                          </div>

                                    </td>
                                </tr>
                                @endforeach

                        </table>
                    </div>
                </div>
            </div>
        </div><!--end row-->




    </div>
    <!-- container-fluid -->
</div>
@endsection


@section('script')
@endsection
