@extends('admin.master.master')

@section('title')
এনজিও প্রোফাইলের তালিকা  | {{ $ins_name }}
@endsection


@section('css')

@endsection

@section('body')
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <h3>এনজিও প্রোফাইলের তালিকা </h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">হোম</a></li>
                    <li class="breadcrumb-item">এনজিও প্রোফাইল</li>
                    <li class="breadcrumb-item">এনজিও প্রোফাইলের তালিকা </li>
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

                <div class="card-body">
                    <div class="table-responsive product-table">
                        <table class="display" id="basic-1">
                            <thead>
                            <tr>
                                <th>নিবন্ধন নম্বর</th>
                                <th>এনজিওর নাম ও ঠিকানা</th>
                                <th>স্ট্যাটাস</th>
                                <th>কার্যকলাপ</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($registrationList->unique('fd_one_form_id') as $registrationLists)


<tr>


                                <td>#{{ App\Http\Controllers\Admin\CommonController::englishToBangla($registrationLists->registration_number) }}


                                </td>
                                <td><h6> এনজিওর নাম: {{ $registrationLists->organization_name_ban  }}</h6><span>ঠিকানা: {{ $registrationLists->organization_address}}</td>

                                <td class="font-success">

                                    @if($registrationLists ->status == 'Accepted')

                                    <button class="btn btn-secondary btn-xs" type="button">
                                        গৃহীত

                                    </button>
                                    @elseif($registrationLists ->status == 'Ongoing')

                                    <button class="btn btn-secondary btn-xs" type="button">
                                        চলমান

                                    </button>
                                    @else
                                    <button class="btn btn-secondary btn-xs" type="button">
                                        প্রত্যাখ্যান

                                    </button>
                                    @endif
                                </td>

                                <td>

                                    @if (Auth::guard('admin')->user()->can('register_list_view'))
                                    <button class="btn btn-primary btn-xs" type="button" data-original-title="btn btn-danger btn-xs" title="" onclick="location.href = '{{ route('ngoProfile.show',base64_encode($registrationLists ->fdOneFormId)) }}';">বিস্তারিত দেখুন</button>
                                      @endif


                                </td>
                            </tr>
                            @endforeach

                            @foreach($renewList->unique('fd_one_form_id')  as $registrationLists)


                            <tr>


                                                            <td>#{{ App\Http\Controllers\Admin\CommonController::englishToBangla($registrationLists->registration_number) }}


                                                            </td>
                                                            <td><h6> এনজিওর নাম: {{ $registrationLists->organization_name_ban  }}</h6><span>ঠিকানা: {{ $registrationLists->organization_address}}</td>

                                                            <td class="font-success">

                                                                @if($registrationLists ->status == 'Accepted')

                                                                <button class="btn btn-secondary btn-xs" type="button">
                                                                    গৃহীত

                                                                </button>
                                                                @elseif($registrationLists ->status == 'Ongoing')

                                                                <button class="btn btn-secondary btn-xs" type="button">
                                                                    চলমান

                                                                </button>
                                                                @else
                                                                <button class="btn btn-secondary btn-xs" type="button">
                                                                    প্রত্যাখ্যান

                                                                </button>
                                                                @endif
                                                            </td>

                                                            <td>

                                                                @if (Auth::guard('admin')->user()->can('register_list_view'))
                                                                <button class="btn btn-primary btn-xs" type="button" data-original-title="btn btn-danger btn-xs" title="" onclick="location.href = '{{ route('ngoProfile.show',base64_encode($registrationLists ->fdOneFormId)) }}';">বিস্তারিত দেখুন</button>
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
