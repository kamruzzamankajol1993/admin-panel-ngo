@extends('admin.master.master')

@section('title')
এফডি - ৪.১ ফরম | {{ $ins_name }}
@endsection


@section('css')

@endsection

@section('body')
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <h3>সিএ ফার্ম কতৃক প্রদেয় প্রতিবেদন</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">হোম</a></li>
                    <li class="breadcrumb-item">এফডি - ৪.১ ফরম</li>
                    <li class="breadcrumb-item">এফডি - ৪.১ ফরম তালিকা</li>
                </ol>
            </div>
            <div class="col-sm-6">
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
                <div class="card-header pb-0">

                </div>
                <div class="card-body">
                    <div class="table-responsive product-table">
                        <table class="display" id="basic-1">
                            <thead>
                            <tr>
                                <th>এনজিও ডাইরি নম্বর </th>
                                <th>এনজিওর নাম & ঠিকানা</th>
                                <th>প্রকল্পের নাম</th>
                                <th>প্রকল্পের বর্ষ</th>
                                <th>স্টেটাস</th>
                                <th>জমাদানের তারিখ</th>
                                <th>কার্যকলাপ</th>
                            </tr>
                            </thead>
                            <tbody>
                           @foreach($dataFromNoFdFourOneForm as $dataFromNoFdFourOneFormAll)

                           <?php

                           $form_one_data = DB::table('fd_one_forms')
                           ->where('id',$dataFromNoFdFourOneFormAll->fd_one_form_id)->first();


                           $ngoTypeData = DB::table('ngo_type_and_languages')
                           ->where('user_id',$form_one_data->user_id)->first();

                                                           ?>
                            <!-- red background start --->

@if(empty($dataFromNoFdFourOneFormAll->check_status) && ($dataFromNoFdFourOneFormAll->file_last_check_date < date('Y-m-d')))
<tr style="">
@else
<tr>
@endif
<!-- red background end -->
                                <td>  @if($ngoTypeData->ngo_type_new_old == 'Old')

                                    #{{ App\Http\Controllers\Admin\CommonController::englishToBangla($ngoTypeData->registration) }}
                                    @else

                                     #{{ App\Http\Controllers\Admin\CommonController::englishToBangla($form_one_data->registration_number) }}
                                     @endif</td>
                                <td><h6> {{ $dataFromNoFdFourOneFormAll->organization_name_ban }} </h6><span>Address: {{ $dataFromNoFdFourOneFormAll->organization_address }}</span></td>
                                <td>{{ $dataFromNoFdFourOneFormAll->prokolpo_name }}</td>
                                <td>{{ $dataFromNoFdFourOneFormAll->prokolpo_year }}</td>
                                <td>@if($dataFromNoFdFourOneFormAll->status == 'Ongoing')
                                    <button class="btn btn-secondary btn-xs" type="button">
                                    চলমান
                                    </button>
                                                                       @elseif($dataFromNoFdFourOneFormAll->status == 'Accepted')

                                                                        <button class="btn btn-secondary btn-xs" type="button">
                                                                            গৃহীত

                                                                        </button>

                                                                        @elseif($dataFromNoFdFourOneFormAll->status == 'Correct')
                                                                        <button class="btn btn-secondary btn-xs" type="button">
                                                                            সংশোধন করুন

                                                                        </button>
                                                                        @else
                                                                        <button class="btn btn-secondary btn-xs" type="button">
                                                                            প্রত্যাখ্যান

                                                                        </button>
                                                                        @endif</td>
                                <td>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromNoFdFourOneFormAll->created_at) }}</td>
                                <td>
                                    <button class="btn btn-primary btn-xs" type="button" data-original-title="btn btn-danger btn-xs" title="" onclick="location.href = '{{ route('fd4OneForm.show',$dataFromNoFdFourOneFormAll->id) }}';">বিস্তারিত দেখুন</button>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection
