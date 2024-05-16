@extends('admin.master.master')

@section('title')
নিবন্ধন আবেদন তালিকা | {{ $ins_name }}
@endsection


@section('css')

@endsection

@section('body')
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <h3>নিবন্ধন আবেদন তালিকা</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">হোম</a></li>
                    <li class="breadcrumb-item">এনজিও নিবন্ধন</li>
                    <li class="breadcrumb-item">নিবন্ধন আবেদন তালিকা</li>
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
                                <th>এনজিও'র ধরন</th>
                                <th>পেমেন্ট</th>
                                <th>স্ট্যাটাস</th>
                                <th>জমাদানের তারিখ</th>
                                <th>কার্যকলাপ</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($all_data_for_new_list as $all_data_for_new_list_all)

                                <?php

                                $fdOneFormId = DB::table('fd_one_forms')->where('id',$all_data_for_new_list_all->fd_one_form_id)->value('user_id');
                                  $getngoForLanguage = DB::table('ngo_type_and_languages')->where('user_id',$fdOneFormId)->value('ngo_type');

                                  $getngoForLanguageNewO = DB::table('ngo_type_and_languages')->where('user_id',$fdOneFormId)->value('registration');


                             // dd($getngoForLanguage);

                             $ngoOldNew = DB::table('ngo_type_and_languages')
                             ->where('user_id',$fdOneFormId)
                             ->value('ngo_type_new_old');


                                  if($getngoForLanguage =='দেশিও'){

                                    $reg_name = DB::table('fd_one_forms')->where('id',$all_data_for_new_list_all->fd_one_form_id)->value('organization_name_ban');

                                  }else{
                                    $reg_name = DB::table('fd_one_forms')->where('id',$all_data_for_new_list_all->fd_one_form_id)->value('organization_name');
                                  }

                                  ?>

                                <?php

                                $reg_number = DB::table('fd_one_forms')->where('id',$all_data_for_new_list_all->fd_one_form_id)->value('registration_number_given_by_admin');

                                $reg_address = DB::table('fd_one_forms')->where('id',$all_data_for_new_list_all->fd_one_form_id)->value('organization_address');

                                ?>
                            <tr>

                                <td>
                                    @if($ngoOldNew == 'Old')
                                    #{{ App\Http\Controllers\Admin\CommonController::englishToBangla($getngoForLanguageNewO) }}
                                    @else

                                    #{{ App\Http\Controllers\Admin\CommonController::englishToBangla($reg_number) }}
@endif

   </td>
       
                                <td><h6>
                                     {{ $reg_name  }}<br>

                                </h6><span>ঠিকানা: {{ $reg_address }}</td>

                                    <td> @if($ngoOldNew == 'Old')
                                        পুরাতন
                                        @else

                                        নতুন
@endif
</td>
                                <td>হ্যাঁ</td>
                                <td class="font-success">

                                    @if($all_data_for_new_list_all->status == 'Accepted')

                                    <button class="btn btn-secondary btn-xs" type="button">
                                        গৃহীত

                                    </button>
                                    @elseif($all_data_for_new_list_all->status == 'Ongoing')

                                    <button class="btn btn-secondary btn-xs" type="button">
                                        চলমান

                                    </button>
                                    @elseif($all_data_for_new_list_all->status == 'Rejected')
                                    <button class="btn btn-secondary btn-xs" type="button">
                                        প্রত্যাখ্যান

                                    </button>

                                    @else
                                    <button class="btn btn-secondary btn-xs" type="button">
                                        চলমান

                                    </button>

                                    @endif
                                </td>
                                <td>


                                    {{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('d-F-y', strtotime($all_data_for_new_list_all->created_at))) }}

                                </td>
                                <td>

                                    @if (Auth::guard('admin')->user()->can('register_list_view'))
                                    <button class="btn btn-primary btn-xs" type="button" data-original-title="btn btn-danger btn-xs" title="" onclick="location.href = '{{ route('registrationView',$all_data_for_new_list_all->fd_one_form_id) }}';">বিস্তারিত দেখুন</button>
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
