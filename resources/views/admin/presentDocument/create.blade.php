@extends('admin.master.master')

@section('title')
নথি তৈরি করুন
@endsection


@section('body')
  <div class="container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3>নথি তৈরি করুন</h3>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">হোম</a></li>
                                <li class="breadcrumb-item">নথি তৈরি করুন </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>


            <?php


                 $branchName = DB::table('branches')
                 ->where('id',Auth::guard('admin')->user()->branch_id)
                 ->value('branch_name');

            ?>



              <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header pb-0">
                                <h5>নথি তৈরি করুন</h5>
                            </div>
                            <form  class="form theme-form" action="{{ route('documentPresent.store') }}" method="post" enctype="multipart/form-data" id="form" data-parsley-validate="">
                                 @csrf





                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-3 col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="">নথি শাখা</label>
                                                <input class="form-control" name="document_branch" id="document_branch" value="{{ $branchName}}"
                                                       type="text" readonly>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="">নথি ধরণ</label>
                                                <select class="js-example-basic-single form-control" name="document_type_id" id="document_type_id" required>
                                                    {{-- <option value="">অডিট আপত্তি/অর্থ আত্মসাৎ/আর্থিক ক্ষতি</option>
                                                    <option value="">অর্থ/অগ্রিম </option>
                                                    <option value="">অনিষ্পন্ন বিষয়ের তালিকা প্রণয়ন </option>
                                                    <option value="">আইনগত/ মামলা পরিচালনা কার্যক্রম গ্রহণ</option>
                                                    <option value="">বিবিধ </option> --}}
                                                    <option value=""> -- বছর বাছাই করুন -- </option>
                                                    @foreach($documentTypeList as $documentTypeLists)
                                                    <option value="{{ $documentTypeLists->id }}">{{ $documentTypeLists->document_type }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <?php

$branchCode = DB::table('branches')
                 ->where('id',Auth::guard('admin')->user()->branch_id)
                 ->value('branch_code');


$lastNothiSerialNumber = DB::table('nothi_lists')
                         ->orderBy('id','desc')->value('document_serial_number');
$convertNumber = intval($lastNothiSerialNumber)+1;
$finalSerialNumber = App\Http\Controllers\Admin\CommonController::englishToBangla(str_pad($convertNumber, 3, '0', STR_PAD_LEFT));
//dd($finalSerialNumber);


                                        ?>



                                        <div class="col-xl-3 col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label">নথি নম্বর</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">০৩.০৭.২৬৬৬.{{ $branchCode }}.</span>
                                                    <input class="form-control" name="document_number" readonly id="document_number" type="text" placeholder="" required>

                                                    <input class="form-control" name="document_serial_number"  id="document_serial_number" value="{{ $convertNumber }}" type="text" placeholder="" required>

                                                    <select class="form-control" name="document_year" id="" required>
                                                        <option value="">বছর বাছাই করুন</option>
                                                        <option value="২৩">২৩</option>
                                                        <option value="২৪">২৪</option>
                                                        <option value="২৫">২৫</option>
                                                        <option value="২৬">২৬</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="">নথি শ্রেণিঃ</label>
                                                <select class="form-control" name="document_class" id="" required>
                                                    <option value="">বাছাই করুন</option>
                                                    <option value="ক">ক</option>
                                                    <option value="খ">খ</option>
                                                    <option value="গ">গ</option>
                                                    <option value="ঘ">ঘ</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xl-12 col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="">নথির বিষয়</label>
                                                <input class="form-control" required name="document_subject" type="text" placeholder="নথির বিষয়">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row-reverse">
                                        <button class="btn btn-danger ms-3" name="buttonValue" value="সংরক্ষণ করুন" type="submit">
                                            <i class="fa fa-send"></i>
                                            সংরক্ষণ করুন এবং তালিকা দেখুন
                                        </button>
                                        <button class="btn btn-primary" name="buttonValue" value="নথি অনুমতি" type="submit">
                                            <i class="fa fa-angle-right"></i>
                                            সংরক্ষণ করুন এবং অনুমতি দিন
                                        </button>



                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header pb-0">
                                <h5>নথি ধরনের তালিকা</h5>
                                @include('flash_message')
                            </div>
                            <div class="card-body">
                                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg">নতুন ধরন তৈরি করুন</button>
                                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myLargeModalLabel">নতুন ধরণ</h4>
                                                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="custom-validation" action="{{ route('documentType.store') }}" method="post" enctype="multipart/form-data" id="form" data-parsley-validate="">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label class="form-label" for="">নথির বিষয়ের ধরণ</label>
                                                        <input class="form-control" name="document_type" type="text" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="">ধরণ কোড</label>
                                                        <input class="form-control" name="code_type" type="text" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="">নথির সংখ্যা</label>
                                                        <input class="form-control" name="total_document" type="text" required>
                                                    </div>

                                                    <div>
                                                        <button type="submit" class="btn btn-primary w-md mt-3">সংরক্ষণ করুন</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <table class="table table-responsive table-striped">
                                        <tr>
                                            <th>ক্রমিক সংখ্যা</th>
                                            <th>নথির বিষয়ের ধরণ</th>
                                            <th>ধরন কোড</th>
                                            <th>নথির সংখ্যা</th>
                                            <th>কার্যক্রম</th>
                                        </tr>
                                        @foreach($documentTypeList as $key=>$documentTypeLists)
                                        <tr>
                                            <td>
                                               @if(($key+1) < 10)
                                                ০{{ App\Http\Controllers\Admin\CommonController::englishToBangla($key + 1) }}
                                                @else

                                               {{ App\Http\Controllers\Admin\CommonController::englishToBangla($key + 1) }}

                                                @endif




                                            </td>
                                            <td>{{ $documentTypeLists->document_type }}</td>
                                            <td>{{ $documentTypeLists->code_type }}</td>
                                            <td>{{ $documentTypeLists->total_document }}</td>
                                            <td>
                                                <button class="btn btn-primary btn-xs" type="button" data-original-title="btn btn-danger btn-xs" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg{{ $key+1 }}" title="";">সংশোধন করুন</button>


                                                <!--start new code-->


                                                <div class="modal fade bd-example-modal-lg{{ $key+1 }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="myLargeModalLabel">নতুন ধরণ</h4>
                                                                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form class="custom-validation" action="{{ route('documentType.update',$documentTypeLists->id ) }}" method="post" enctype="multipart/form-data" id="form" data-parsley-validate="">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="mb-3">
                                                                        <label class="form-label" for="">নথির বিষয়ের ধরণ</label>
                                                                        <input class="form-control" name="document_type" value="{{ $documentTypeLists->document_type }}" type="text" required>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label" for="">ধরণ কোড</label>
                                                                        <input class="form-control" name="code_type" value="{{ $documentTypeLists->code_type }}" type="text" required>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label" for="">নথির সংখ্যা</label>
                                                                        <input class="form-control" name="total_document" value="{{ $documentTypeLists->total_document }}" type="text" required>
                                                                    </div>

                                                                    <div>
                                                                        <button type="submit" class="btn btn-primary w-md mt-3">সংশোধন করুন</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!--end new code -->
                                            </td>
                                        </tr>
                                        @endforeach

                                    </table>
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


$("#document_type_id").change(function(){

    var docId = $(this).val();


    $.ajax({
            url: "{{ route('docTypeCode') }}",
            method: 'GET',
            data: {docId:docId},
            success: function(data) {

                 $("#document_number").val(data+'.');
            }
            });


});
</script>

@endsection
