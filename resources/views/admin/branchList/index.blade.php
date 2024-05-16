@extends('admin.master.master')

@section('title')
শাখার  তালিকা | {{ $ins_name }}
@endsection


@section('css')

@endsection

@section('body')
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <h3>শাখা</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">হোম</a></li>
                    <li class="breadcrumb-item">শাখার  তালিকা</li>
                </ol>
            </div>
            <div class="col-sm-6">
                <div class="text-end">
                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg">শাখা যোগ করুন</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">শাখা তথ্য</h4>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="custom-validation"  action="{{ route('branchList.store') }}" method="post" enctype="multipart/form-data" id="form" data-parsley-validate="">
                    @csrf
                <div class="mb-3">
                    <label class="form-label" for="">শাখার নাম <span style="color:red;">*</span></label>
                    <input class="form-control" id="" name="branch_name" type="text" placeholder="" required>

                    <input type="hidden" class="form-control form-control-sm" value="{{ $stepValue+1 }}" name="branch_step" placeholder=""  readonly>


                </div>
                <div class="mb-3">
                    <label class="form-label" for="">শাখা কোড <span style="color:red;">*</span></label>
                    <input class="form-control" id="" name="branch_code" type="text" placeholder="" required>

                </div>

                <div class="form-group col-md-12 col-sm-12">
                    <label for="branch_step">শাখা ধাপ <span style="color:red;">*</span></label>
                    <input type="text" class="form-control form-control-sm" value="{{ $stepValue+1 }}" name="branch_step1" placeholder=""  readonly>
                </div>
                <small class="text-danger" id="result0"></small>
                <div class="card-footer text-end">
                    <button class="btn btn-primary" id="finalButton0" type="submit">জমা দিন </button>
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

                <div class="card-body">
                    <div class="table-responsive product-table">
                        <table class="display" id="basic-1">
                            <thead>
                            <tr>
                                <th>ক্র: নং:</th>
                                <th>শাখার নাম</th>
                                <th>শাখা কোড</th>
                                <th>শাখা ধাপ</th>
                                <th>কার্যকলাপ</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($branchLists as $key=>$AllBranchLists)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $AllBranchLists->branch_name }}</td>
                                <td>{{  App\Http\Controllers\Admin\CommonController::englishToBangla($AllBranchLists->branch_code) }}</td>
                                <td>{{  App\Http\Controllers\Admin\CommonController::englishToBangla($AllBranchLists->branch_step) }}</td>
                                <td>
                                    @if (Auth::guard('admin')->user()->can('branchUpdate'))
                                    <button type="button" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg{{ $AllBranchLists->id }}"
                                    class="btn btn-primary waves-light waves-effect  btn-sm" >
                                    <i class="fa fa-pencil"></i></button>

                                      <!--  Large modal example -->
                                      <div class="modal fade bs-example-modal-lg{{ $AllBranchLists->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                          <div class="modal-dialog modal-lg">
                                              <div class="modal-content">
                                                  <div class="modal-header">
                                                      <h5 class="modal-title" id="myLargeModalLabel">শাখার তথ্য আপডেট করুন </h5>
                                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                      </button>
                                                  </div>
                                                  <div class="modal-body">
                                                      <form  action="{{ route('branchList.update',$AllBranchLists->id ) }}" method="post" enctype="multipart/form-data" id="form" data-parsley-validate="">
                                                          @method('PUT')
                                                          @csrf
                                                          <div class="row">
                                                              <div class="form-group col-md-12 col-sm-12">
                                                                  <label for="name">শাখার নাম <span style="color:red;">*</span></label>
                                                  <input type="text" class="form-control form-control-sm" id="name" name="branch_name" placeholder="শাখার নাম" value="{{ $AllBranchLists->branch_name}}">


                                                              </div>
                                                              <div class="form-group col-md-12 col-sm-12">
                                                                  <label for="email">শাখা কোড <span style="color:red;">*</span></label>
                                                                  <input type="text" class="form-control form-control-sm" id="email" name="branch_code" placeholder="শাখা কোড" value="{{ $AllBranchLists->branch_code }}">
                                                              </div>


                                                              <div class="form-group col-md-12 col-sm-12">
                                                                <label for="branch_step">শাখা ধাপ <span style="color:red;">*</span></label>
                                                                <input type="text" class="form-control form-control-sm" id="branch_step{{ $AllBranchLists->id }}" name="branch_step" placeholder="শাখা ধাপ" value="{{ $AllBranchLists->branch_step }}">
                                                            </div>
                                                            <small class="text-danger" id="result{{ $AllBranchLists->id  }}"></small>


                                                          </div>



                                                          <button type="submit" id="finalButton{{ $AllBranchLists->id  }}" class="btn btn-primary mt-4 pr-4 pl-4">আপডেট করুন</button>
                                                      </form>
                                                  </div>
                                              </div><!-- /.modal-content -->
                                          </div><!-- /.modal-dialog -->
                                      </div><!-- /.modal -->


@endif

{{-- <button type="button" class="btn btn-primary waves-light waves-effect  btn-sm" onclick="window.location.href='{{ route('admin.users.view',$AllBranchLists->id) }}'"><i class="fa fa-eye"></i></button> --}}
@if($AllBranchLists->id == 2)

@else
                            @if (Auth::guard('admin')->user()->can('branchDelete'))

<button   type="button" class="btn btn-danger waves-light waves-effect  btn-sm" onclick="deleteTag({{ $AllBranchLists->id}})" data-toggle="tooltip" title="Delete"><i class="fa fa-trash-o"></i></button>
              <form id="delete-form-{{ $AllBranchLists->id }}" action="{{ route('branchList.destroy',$AllBranchLists->id) }}" method="POST" style="display: none;">
                @method('DELETE')
                                              @csrf

                                          </form>
                                          @endif
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
<!-- branch-->
<script>
    $("[id^=branch_step]").keyup(function(){
        var main_id = $(this).attr('id');
        var id_for_pass = main_id.slice(11);


        //alert(2);


        var branchStep = $('#branch_step'+id_for_pass).val();

        //alert(branchStep);


        $.ajax({
        url: "{{ route('checkBranch') }}",
        method: 'GET',
        data: {branchStep:branchStep},
        success: function(data) {

            if(data >= 1){

                $("#result"+id_for_pass).html('You Have Already Add This Step');
                $("#finalButton"+id_for_pass).hide();

            }else{

                $("#result"+id_for_pass).html('');
                $("#finalButton"+id_for_pass).show();
            }


        }
        });



        //alert(id_for_pass);
    });
    </script>
<!-- end branch -->
@endsection
