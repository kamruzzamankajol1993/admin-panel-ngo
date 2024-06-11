{{-- <h4>{{ $districtName }} জেলার প্রকল্পের রিপোর্ট </h4> --}}
<p>সর্বমোট প্রকল্প: {{  App\Http\Controllers\Admin\CommonController::englishToBangla(count($prokolpoAreaListFd6) + count($prokolpoAreaListFd7) + count($prokolpoAreaListFc1) + count($prokolpoAreaListFc2))  }}</p>
<p>প্রকল্পের ধরণ:</p>
<div class="table-responsive product-table">
    <table id="example" class="display" style="width:100%">
        <table class="table table-bordered">
            <tr>
                <th>ক্র :নং :</th>
                <th>এনজিও'র  নাম</th>
                <th>প্রকল্পের ধরণ</th>
                <th>বছর</th>
            </tr>
            @foreach($prokolpoAreaListFd6 as $key=>$prokolpoAreaListFd6s)
            <tr>
                <td>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($key+1) }}</td>
                <td>{{DB::table('fd_one_forms')->where('id',$prokolpoAreaListFd6s->fd_one_form_id)->value('organization_name_ban')}}</td>
                <td>{{ DB::table('project_subjects')->where('id',$prokolpoAreaListFd6s->prokolpo_type)->value('name')}}(এফডি -৬)</td>
                <td>{{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('Y', strtotime($prokolpoAreaListFd6s->created_at))) }}</td>
            </tr>
            @endforeach

            <?php

            $prokolpoAreaListFd6Count = count($prokolpoAreaListFd6);


             ?>

            @foreach($prokolpoAreaListFd7 as $key=>$prokolpoAreaListFd7s)
            <tr>
                <td>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($prokolpoAreaListFd6Count+ ($key+1)) }}</td>
                <td>{{DB::table('fd_one_forms')->where('id',$prokolpoAreaListFd7s->fd_one_form_id)->value('organization_name_ban')}}</td>
                <td>{{ DB::table('project_subjects')->where('id',$prokolpoAreaListFd7s->prokolpo_type)->value('name')}}(এফডি -৭)</td>
                <td>{{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('Y', strtotime($prokolpoAreaListFd7s->created_at))) }}</td>
            </tr>
            @endforeach


            <?php

            $prokolpoAreaListFd7Count = count($prokolpoAreaListFd7) + $prokolpoAreaListFd6Count;


             ?>

            @foreach($prokolpoAreaListFc1 as $key=>$prokolpoAreaListFc1s)
            <tr>
                <td>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($prokolpoAreaListFd7Count+ ($key+1)) }}</td>
                <td>{{DB::table('fd_one_forms')->where('id',$prokolpoAreaListFc1s->fd_one_form_id)->value('organization_name_ban')}}</td>
                <td>{{ DB::table('project_subjects')->where('id',$prokolpoAreaListFc1s->prokolpo_type)->value('name')}}(এফসি -১)</td>
                <td>{{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('Y', strtotime($prokolpoAreaListFc1s->created_at))) }}</td>

            </tr>
            @endforeach

            <?php

            $prokolpoAreaListFc1Count = count($prokolpoAreaListFc1) + count($prokolpoAreaListFd7) + $prokolpoAreaListFd6Count;


             ?>

            @foreach($prokolpoAreaListFc2 as $key=>$prokolpoAreaListFc2s)
            <tr>
                <td>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($prokolpoAreaListFc1Count+ ($key+1)) }}</td>
                <td>{{DB::table('fd_one_forms')->where('id',$prokolpoAreaListFc2s->fd_one_form_id)->value('organization_name_ban')}}</td>
                <td>{{ DB::table('project_subjects')->where('id',$prokolpoAreaListFc2s->prokolpo_type)->value('name')}}(এফসি -২)</td>
                <td>{{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('Y', strtotime($prokolpoAreaListFc2s->created_at))) }}</td>
            </tr>
            @endforeach
    </table>
</div>

