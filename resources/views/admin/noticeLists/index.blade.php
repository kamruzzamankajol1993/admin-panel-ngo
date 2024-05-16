@extends('admin.master.master')

@section('title')
নোটিশ বোর্ড
@endsection


@section('body')

<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <h3>নোটিশ বোর্ড</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">হোম</a></li>
                    <li class="breadcrumb-item">নোটিশ বোর্ড</li>
                </ol>
            </div>
            <div class="col-sm-6">
                <div class=" text-end">
                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg">নোটিশ যোগ করুন</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">নোটিশ বোর্ড</h4>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="custom-validation"  action="{{ route('noticeList.store') }}" id="form" data-parsley-validate="" method="post" enctype="multipart/form-data">
                    @csrf
                <div class="mb-3">
                    <label class="form-label" for="">নোটিশ হেডলাইন</label>
                    <input class="form-control" name="headline" id="" type="text" placeholder="" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="">নোটিশ পিডিএফ</label>
                    <input class="form-control" name="pdf" id="" type="file" placeholder="">

                </div>
                <div class="card-footer text-end">
                    <button class="btn btn-primary" type="submit"> জমা দিন</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid starts-->
<div class="container-fluid list-products">
    <div class="row">
        <!-- Individual column searching (text inputs) Starts-->
        <div class="col-sm-12">
            <div class="card">
                @include('flash_message')
                <div class="card-body">
                    <div class="table-responsive product-table">
                        <table class="display" id="basic-1">
                            <thead>
                            <tr>
                                <th>ক্র : নং :</th>
                                <th>নোটিশ হেডলাইন</th>
                                <th>নোটিশ পিডিএফ</th>
                                <th>কার্যকলাপ</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($noticeLists as $key=>$allNoticeLists)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $allNoticeLists->headline }}</td>
                                <td>
                                    <object
                                    data='{{asset('/') }}{{ 'public/'.$allNoticeLists->pdf }}'
                                    type="application/pdf"
                                    width="200"
                                    height="200"
                                  >

                                    <iframe
                                      src='{{asset('/') }}{{ 'public/'.$allNoticeLists->pdf }}'
                                      width="200"
                                      height="200"
                                    >
                                    <p>This browser does not support PDF!</p>
                                    </iframe>
                                  </object>
                                </td>
                                <td>
                                    @if (Auth::guard('admin')->user()->can('countryUpdate'))
                                    <button type="button" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg{{ $allNoticeLists->id }}"
                                    class="btn btn-primary waves-light waves-effect  btn-sm" >
                                    <i class="fa fa-pencil"></i></button>

                                      <!--  Large modal example -->
                                      <div class="modal fade bs-example-modal-lg{{ $allNoticeLists->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                          <div class="modal-dialog modal-lg">
                                              <div class="modal-content">
                                                  <div class="modal-header">
                                                      <h5 class="modal-title" id="myLargeModalLabel"> আপডেট করুন</h5>
                                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                      </button>
                                                  </div>
                                                  <div class="modal-body">
                                                      <form id="form" action="{{ route('noticeList.update',$allNoticeLists->id ) }}" method="POST" enctype="multipart/form-data">
                                                          @method('PUT')
                                                          @csrf



                                                          <div class="mb-3">
                                                            <label class="form-label" for="">নোটিশ হেডলাইন</label>
                                                            <input class="form-control" name="headline" value="{{ $allNoticeLists->headline }}" id="" type="text" placeholder="" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label" for="">নোটিশ পিডিএফ</label>
                                                            <input class="form-control" name="pdf" id="" type="file" placeholder="">

                                                        </div>


                                                          <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">আপডেট করুন </button>
                                                      </form>
                                                  </div>
                                              </div><!-- /.modal-content -->
                                          </div><!-- /.modal-dialog -->
                                      </div><!-- /.modal -->


@endif
                                    @if (Auth::guard('admin')->user()->can('noticeDelete'))

            <button   type="button" class="btn btn-danger waves-light waves-effect  btn-sm" onclick="deleteTag({{ $allNoticeLists->id}})" data-toggle="tooltip" title="Delete"><i class="fa fa-trash-o"></i></button>
                                <form id="delete-form-{{ $allNoticeLists->id }}" action="{{ route('noticeList.destroy',$allNoticeLists->id) }}" method="POST" style="display: none;">
                                  @method('DELETE')
                                                                @csrf

                                                            </form>
                                                            @endif
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Individual column searching (text inputs) Ends-->
    </div>
</div>
<!-- Container-fluid Ends-->
@endsection



@section('script')

@endsection
