@extends('admin.master.master')

@section('title')
এনজিও প্রোফাইল | {{ $ins_name }}
@endsection


@section('css')

@endsection

@section('body')
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <h3>এনজিও প্রোফাইল</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">হোম</a></li>
                    <li class="breadcrumb-item">এনজিও প্রোফাইল</li>
                </ol>
            </div>
            <div class="col-sm-6">
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="user-profile">
        <div class="row">
            <!-- user profile header end-->
            <div class="col-xl-4 col-lg-12 col-md-5 xl-35">
                <div class="default-according style-1 faq-accordion job-accordion">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="p-0">
                                        <button class="btn btn-link ps-0" data-bs-toggle="collapse"
                                                data-bs-target="#collapseicon2" aria-expanded="true"
                                                aria-controls="collapseicon2">এনজিও'র বিস্তারিত তথ্য
                                        </button>
                                    </h5>
                                </div>
                                <div class="collapse show" id="collapseicon2"
                                     aria-labelledby="collapseicon2" data-parent="#accordion">
                                    <div class="card-body post-about">
                                        <ul>
                                            <li>
                                                <div>
                                                    <p>এনজিও'র নাম : </p>
                                                    <h5 class="fontbold-900">{{ $registrationList->organization_name_ban }}</h5>
                                                </div>
                                            </li>
                                            <li>
                                                <div>
                                                    <p>এনজিও'র ঠিকানা : </p>
                                                    <h5 class="fontbold-700">{{ $registrationList->organization_address }}</h5>
                                                </div>
                                            </li>
                                            <li>
                                                <div>
                                                    <p>ইমেইল : </p>
                                                    <h5 class="fontbold-700">{{ $registrationList->email }}</h5>
                                                </div>
                                            </li>
                                            <li>
                                                <div>
                                                    <p>মোবাইল নম্বর : </p>
                                                    <h5 class="fontbold-700">{{ App\Http\Controllers\Admin\CommonController::englishToBangla($registrationList->phone) }}</h5>
                                                </div>
                                            </li>

                                            <?php

$ngoOldNew = DB::table('ngo_type_and_languages')
->where('user_id',$registrationList->user_id)
->value('ngo_type_new_old');

if($ngoOldNew == 'Old'){

    $renewDateCheck =DB::table('ngo_durations')->where('fd_one_form_id',$registrationList->id)
    ->latest()->value('ngo_duration_start_date');

    if(empty($renewDateCheck)){

        $lastrenewDate = DB::table('ngo_type_and_languages')
->where('user_id',$registrationList->user_id)
->value('last_renew_date');


$oldNgoRegDate = DB::table('ngo_type_and_languages')
->where('user_id',$registrationList->user_id)
->value('ngo_registration_date');


    }else{

        $lastrenewDate = $renewDateCheck;
        $oldNgoRegDate = $renewDateCheck;


    }

}else{

    $oldNgoRegDate =DB::table('ngo_durations')
    ->where('fd_one_form_id',$registrationList->id)
    ->orderBy('id','asc')->value('ngo_duration_start_date');


    $lastrenewDate =DB::table('ngo_durations')
    ->where('fd_one_form_id',$registrationList->id)
    ->orderBy('id','desc')->value('ngo_duration_start_date');


}


?>
                                            <li>
                                                <div>
                                                    <p>নিবন্ধনের তারিখ : </p>
                                                    <h5 class="fontbold-700">{{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('d/m/Y', strtotime($oldNgoRegDate)))  }}</h5>
                                                </div>
                                            </li>
                                            <li>
                                                <div>
                                                    <p>সর্বশেষ নবায়নের তারিখ</p>
                                                    <h5 class="fontbold-700">{{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('d/m/Y', strtotime($lastrenewDate)))  }}</h5>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-6 col-md-12 col-sm-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="p-0">
                                        <button class="btn btn-link ps-0" data-bs-toggle="collapse"
                                                data-bs-target="#collapseicon8" aria-expanded="true"
                                                aria-controls="collapseicon8">নবায়নের তালিকা
                                        </button>
                                    </h5>
                                </div>

                                <?php


$allRenewList =DB::table('ngo_renews')->where('fd_one_form_id',$registrationList->id)
   ->where('status','Accepted')->latest()->get();



                                ?>
                                <div class="collapse show" id="collapseicon8"
                                     aria-labelledby="collapseicon8" data-parent="#accordion">
                                    <div class="card-body social-list filter-cards-view">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th style="width:15%">ক্র :নং :</th>
                                                <th>তারিখ</th>
                                            </tr>
                                            @foreach($allRenewList as $key=>$allRenewLists)
                                            <tr>
                                                <td>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($key+1) }}</td>
                                                <td>

                                                    <?php

$renewDateCheckAll =DB::table('ngo_durations')->where('fd_one_form_id',$allRenewLists->fd_one_form_id)
->latest()->value('ngo_duration_start_date');

                                                    ?>


{{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('d/m/Y', strtotime($renewDateCheckAll)))  }}

                                                </td>
                                            </tr>
                                            @endforeach

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-6 col-md-12 col-sm-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="p-0">
                                        <button class="btn btn-link ps-0" data-bs-toggle="collapse"
                                                data-bs-target="#collapseicon11" aria-expanded="true"
                                                aria-controls="collapseicon11">প্রকল্প এলাকা
                                        </button>
                                    </h5>
                                </div>
                                <div class="collapse show" id="collapseicon11"
                                     aria-labelledby="collapseicon11" data-parent="#accordion">
                                    <div class="card-body social-list filter-cards-view">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>ক্র :নং :</th>
                                                <th>জেলা</th>
                                                <th>টাকার পরিমাণ </th>
                                            </tr>
                                            @foreach($prokolpoAreaListFd6 as $key=>$prokolpoAreaListFd6s)
                                            <tr>
                                                <td>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($key+1) }}</td>
                                                <td>{{ $prokolpoAreaListFd6s->district_name }}</td>
                                                <td>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($prokolpoAreaListFd6s->allocated_budget) }}</td>
                                            </tr>
                                            @endforeach

                                            <?php

                                            $prokolpoAreaListFd6Count = count($prokolpoAreaListFd6);


                                             ?>

                                            @foreach($prokolpoAreaListFd7 as $key=>$prokolpoAreaListFd7s)
                                            <tr>
                                                <td>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($prokolpoAreaListFd6Count+ ($key+1)) }}</td>
                                                <td>{{ $prokolpoAreaListFd7s->district_name }}</td>
                                                <td>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($prokolpoAreaListFd7s->allocated_budget) }}</td>
                                            </tr>
                                            @endforeach


                                            <?php

                                            $prokolpoAreaListFd7Count = count($prokolpoAreaListFd7) + $prokolpoAreaListFd6Count;


                                             ?>

                                            @foreach($prokolpoAreaListFc1 as $key=>$prokolpoAreaListFc1s)
                                            <tr>
                                                <td>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($prokolpoAreaListFd7Count+ ($key+1)) }}</td>
                                                <td>{{ $prokolpoAreaListFc1s->district_name }}</td>
                                                <td>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($prokolpoAreaListFc1s->allocated_budget) }}</td>
                                            </tr>
                                            @endforeach

                                            <?php

                                            $prokolpoAreaListFc1Count = count($prokolpoAreaListFc1) + count($prokolpoAreaListFd7) + $prokolpoAreaListFd6Count;


                                             ?>

                                            @foreach($prokolpoAreaListFc2 as $key=>$prokolpoAreaListFc2s)
                                            <tr>
                                                <td>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($prokolpoAreaListFc1Count+ ($key+1)) }}</td>
                                                <td>{{ $prokolpoAreaListFc2s->district_name }}</td>
                                                <td>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($prokolpoAreaListFc2s->allocated_budget) }}</td>
                                            </tr>
                                            @endforeach


                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-6 col-md-12 col-sm-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="p-0">
                                        <button class="btn btn-link ps-0" data-bs-toggle="collapse"
                                                data-bs-target="#collapseicon4" aria-expanded="true"
                                                aria-controls="collapseicon4">প্রকল্পের ধরণ
                                        </button>
                                    </h5>
                                </div>
                                <div class="collapse show" id="collapseicon4" data-parent="#accordion"
                                     aria-labelledby="collapseicon4">
                                    <div class="card-body">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>ক্র :নং :</th>
                                                <th>প্রকল্পের ধরণ</th>
                                            </tr>
                                            @foreach($prokolpoAreaListFd6 as $key=>$prokolpoAreaListFd6s)
                                            <tr>
                                                <td>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($key+1) }}</td>
                                                <td>{{ DB::table('project_subjects')->where('id',$prokolpoAreaListFd6s->prokolpo_type)->value('name')}}(এফডি -৬)</td>

                                            </tr>
                                            @endforeach

                                            <?php

                                            $prokolpoAreaListFd6Count = count($prokolpoAreaListFd6);


                                             ?>

                                            @foreach($prokolpoAreaListFd7 as $key=>$prokolpoAreaListFd7s)
                                            <tr>
                                                <td>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($prokolpoAreaListFd6Count+ ($key+1)) }}</td>
                                                <td>{{ DB::table('project_subjects')->where('id',$prokolpoAreaListFd7s->prokolpo_type)->value('name')}}(এফডি -৭)</td>

                                            </tr>
                                            @endforeach


                                            <?php

                                            $prokolpoAreaListFd7Count = count($prokolpoAreaListFd7) + $prokolpoAreaListFd6Count;


                                             ?>

                                            @foreach($prokolpoAreaListFc1 as $key=>$prokolpoAreaListFc1s)
                                            <tr>
                                                <td>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($prokolpoAreaListFd7Count+ ($key+1)) }}</td>
                                                <td>{{ DB::table('project_subjects')->where('id',$prokolpoAreaListFc1s->prokolpo_type)->value('name')}}(এফসি -১)</td>

                                            </tr>
                                            @endforeach

                                            <?php

                                            $prokolpoAreaListFc1Count = count($prokolpoAreaListFc1) + count($prokolpoAreaListFd7) + $prokolpoAreaListFd6Count;


                                             ?>

                                            @foreach($prokolpoAreaListFc2 as $key=>$prokolpoAreaListFc2s)
                                            <tr>
                                                <td>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($prokolpoAreaListFc1Count+ ($key+1)) }}</td>
                                                <td>{{ DB::table('project_subjects')->where('id',$prokolpoAreaListFc1s->prokolpo_type)->value('name')}}(এফসি -২)</td>

                                            </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-lg-12 col-md-7 xl-65">
                <div class="card">
                    <div class="card-header">
                        <h5>প্রকল্পের তালিকা</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>ক্র :নং :</th>
                                <th>এনজিও'র  নাম </th>
                                <th>প্রকল্পের নাম</th>
                                <th>কার্যবিধি</th>
                            </tr>

                            @foreach($dataFromFd6FormId as $key=>$prokolpoAreaListFd6s)
                            <tr>
                                <td>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($key+1) }}</td>
                                <td>{{ $prokolpoAreaListFd6s->ngo_name }}</td>
                                <td>{{ $prokolpoAreaListFd6s->ngo_prokolpo_name }}</td>
                                <td><a href="{{ route('fd6Form.show',$prokolpoAreaListFd6s->id) }}" class="btn btn-primary">দেখুন </a></td>
                            </tr>
                            @endforeach

                            <?php

                            $dataFromFd6FormIdCount = count($dataFromFd6FormId);


                             ?>

                            @foreach($dataFromFd7FormId as $key=>$prokolpoAreaListFd7s)
                            <tr>
                                <td>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($dataFromFd6FormIdCount+ ($key+1)) }}</td>
                                <td>{{ $prokolpoAreaListFd7s->ngo_name }}</td>
                                <td>{{ $prokolpoAreaListFd7s->ngo_prokolpo_name }}</td>
                                <td><a href="{{ route('fd7Form.show',$prokolpoAreaListFd7s->id) }}" class="btn btn-primary">দেখুন </a></td>

                            </tr>
                            @endforeach


                            <?php

                            $prokolpoAreaListFd7Count = count($dataFromFd7FormId) + $dataFromFd6FormIdCount;


                             ?>

                            @foreach($dataFromFc1FormId as $key=>$prokolpoAreaListFc1s)
                            <tr>
                                <td>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($prokolpoAreaListFd7Count+ ($key+1)) }}</td>
                                <td>{{ $prokolpoAreaListFc1s->ngo_name }}</td>
                                <td>{{ DB::table('fd2_form_for_fc1_forms')->where('fc1_form_id',$prokolpoAreaListFc1s->id)->value('ngo_prokolpo_name')}}</td>
                                <td><a href="{{ route('fc1Form.show',$prokolpoAreaListFc1s->id) }}" class="btn btn-primary">দেখুন </a></td>

                            </tr>
                            @endforeach

                            <?php

                            $prokolpoAreaListFc1Count = count($dataFromFc1FormId) + count($dataFromFd7FormId) + $dataFromFd6FormIdCount;


                             ?>

                            @foreach($dataFromFc2FormId as $key=>$prokolpoAreaListFc2s)
                            <tr>
                                <td>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($prokolpoAreaListFc1Count+ ($key+1)) }}</td>
                                <td>{{ $prokolpoAreaListFc1s->ngo_name }}</td>
                                <td>{{ DB::table('fd2_form_for_fc2_forms')->where('fc2_form_id',$prokolpoAreaListFc2s->id)->value('ngo_prokolpo_name')}}</td>
<td><a href="{{ route('fc2Form.show',$prokolpoAreaListFc2s->id) }}" class="btn btn-primary">দেখুন </a></td>
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

@endsection
