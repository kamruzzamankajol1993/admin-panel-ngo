@extends('admin.master.master')

@section('title')
সকল উপকারভোগীর তালিকা | {{ $ins_name }}
@endsection


@section('css')

@endsection

@section('body')
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <h3>সকল উপকারভোগীর তালিকা</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">হোম</a></li>
                    <li class="breadcrumb-item">রিপোর্ট</li>
                    <li class="breadcrumb-item">সকল উপকারভোগীর তালিকা</li>
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


            <div class="row">


                <div class="col-xl-3 col-md-3 col-sm-3 box-col-3 des-xl-25 rate-sec">
                    <div class="card income-card card-primary bg-primary">
                        <div class="card-body text-center">

                            <h5>{{ App\Http\Controllers\Admin\CommonController::englishToBangla(count($prokolpoReportFd6Main)) }}</h5>
                            <p>মোট বহুবার্ষিক প্রকল্প এলাকা</p>


                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-3 col-sm-3 box-col-3 des-xl-25 rate-sec">
                    <div class="card income-card card-primary bg-primary">
                        <div class="card-body text-center">

                            <h5>{{ App\Http\Controllers\Admin\CommonController::englishToBangla(count($prokolpoReportFd7Main)) }}</h5>
                            <p>মোট জরুরি ত্রাণ সহায়তা প্রকল্প এলাকা</p>


                        </div>
                    </div>
                </div>



                <div class="col-xl-3 col-md-3 col-sm-3 box-col-3 des-xl-25 rate-sec">
                    <div class="card income-card card-primary bg-primary">
                        <div class="card-body text-center">

                            <h5>{{ App\Http\Controllers\Admin\CommonController::englishToBangla(count($prokolpoReportFc2Main)) }}</h5>
                            <p>মোট বৈদেশিক অনুদানে গৃহীত প্রকল্প এলাকা</p>


                        </div>
                    </div>
                </div>


                <div class="col-xl-3 col-md-3 col-sm-3 box-col-3 des-xl-25 rate-sec">
                    <div class="card income-card card-primary bg-primary">
                        <div class="card-body text-center">

                            <h5>{{ App\Http\Controllers\Admin\CommonController::englishToBangla(count($prokolpoReportFc1Main)) }}</h5>
                            <p>মোট এককালীন অনুদান গ্রহণের  প্রকল্প এলাকা</p>


                        </div>
                    </div>
                </div>


            </div>
        </div>

        </div>

        <div class="row">

            <div class="col-sm-12">
                <div class="card">

                    <div class="card-body">




                        <form method="get" action="{{ route('prokolpoBeneficiariesReportSearch') }}" id="form">
                            <div class="row">

                                <div class="col-sm-4">
                                <label>বিভাগ</label>
                                    <select multiple class="form-control js-example-basic-multiple divisionId" name="division_name[]" id="divisionId" required>
                                        <option value="">-- বিভাগ নির্বাচন করুন --</option>
                                        @foreach($divisionList as $divisionLists)
                                        <option value="{{ $divisionLists->division_bn }}" {{ in_array($divisionLists->division_bn,$divisionName) ? 'selected':''}}>{{ $divisionLists->division_bn }}</option>
                                        @endforeach
                                    </select>

                                </div>

<?php
//dd($distrcitName)

$searchDistrictList = DB::table('civilinfos')
->whereIn('division_bn',$divisionName)
->groupBy('district_bn')
->select('district_bn')
->get();
?>
                                <div class="col-sm-4">
                                    <label>জেলা</label>
                                    <select multiple class="form-control js-example-basic-multiple" name="distric_name[]" id="districId">
                                        <option value="">-- জেলা নির্বাচন করুন --</option>

                                        @if(empty($distrcitName))

                                        @foreach($searchDistrictList as $distrcitNames)

                                        <option value="{{ $distrcitNames->district_bn }}">{{ $distrcitNames->district_bn }}</option>

                                        @endforeach

                                        @else

                                        @foreach($searchDistrictList as $distrcitNames)

                                        <option value="{{ $distrcitNames->district_bn }}" {{ in_array($distrcitNames->district_bn,$distrcitName) ? 'selected':''}}>{{ $distrcitNames->district_bn }}</option>

                                        @endforeach


                                        @endif

                                    </select>

                                </div>


                                {{-- <div class="col-sm-3">
                                    <label>উপজেলা /সিটি কর্পোরেশন /থানা</label>
                                    <input type="text" class="form-control" name="third_name" id="thirdId" >
                                </div> --}}

                                <div class="col-sm-4">
                                    <label>প্রকল্পের ধরণ</label>
                                    <select multiple class="form-control js-example-basic-multiple" name="prokolpo_type[]" >
                                        <option value="">-- নির্বাচন করুন --</option>
                                        @if(empty($prokolpoType))

                                        @else
                                        <option value="সকল" selected>সকল</option>
                                        @endif
                                        <option value="বহুবার্ষিক" >বহুবার্ষিক</option>
                                        <option value="জরুরি ত্রাণ সহায়তা" >জরুরি ত্রাণ সহায়তা</option>
                                        <option value="বৈদেশিক অনুদানে গৃহীত" >বৈদেশিক অনুদানে গৃহীত</option>
                                        <option value="এককালীন অনুদান" >এককালীন অনুদান</option>
                                    </select>
                                </div>



                                <div class="col-sm-12 mt-3">
                                    <div class="text-end">
                                    <button type="submit" class="btn btn-primary">অনুসন্ধান করুন</button>
                                </div>
                                </div>

                            </div>
            </form>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-sm-12"  >
            <div class="card">

                <div class="card-body">
 <!-- new print button-->

 <form method="get" action="{{ route('prokolpoBeneficiariesReportPrintSearch') }}">

    @if(empty($divisionName))


    @else

    @foreach($divisionName as $divisionNames)

    <input type="hidden" name="division_name[]"  value="{{ $divisionNames }}" />

    @endforeach

    @endif

    @if(empty($distrcitName))


    @else

    @foreach($distrcitName as $distrcitNames)
    <input type="hidden" name="distric_name[]" value="{{ $distrcitNames }}" />
    @endforeach
    @endif

    @if(empty($prokolpoType))


    @else
    @foreach($prokolpoType as $prokolpoTypes)
    <input type="hidden" name="prokolpo_type[]" value="{{ $prokolpoTypes }}" />
    @endforeach
    @endif

    <button class="btn btn-primary waves-effect  btn-sm waves-light" type="submit" >
     <i class="far fa-calendar-plus  mr-2"></i> প্রিন্ট করুন
    </button>
                         </form>
 <!-- end new print button -->

                    <div class="table-responsive product-table mt-3" >

                        <table id="example" class="display" style="width:100%">
                            <thead>
                            <tr>

                                <th>ক্র: নং:</th>
                                <th>এনজিওর নাম</th>
                                <th>বিভাগ</th>
                                <th>জেলা</th>
                                <th>উপজেলা /সিটি কর্পোরেশন /থানা </th>
                                <th>ধরণ</th>
                                <th>মোট উপকারভোগী সংখ্যা</th>


                            </tr>
                            </thead>
                            <tbody id="searchTable">

                                @foreach($prokolpoReportFd6Main as $key=>$prokolpoReports)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>
                                        {{ DB::table('fd_one_forms')->where('id',$prokolpoReports->fd_one_form_id)->value('organization_name_ban') }}
                                       <p style="font-weight: 900;">প্রকল্পের নাম: {{ DB::table('fd2_forms')->where('fd_six_form_id',$prokolpoReports->formId)->value('ngo_prokolpo_name') }}</p>
                                    </td>
                                    <td>{{ $prokolpoReports->division_name }}</td>
                                    <td>{{ $prokolpoReports->district_name }}</td>
                                    <td>

                                        @if(empty($prokolpoReports->upozila_name))

                                        @else
{{ $prokolpoReports->upozila_name }}/
                                        @endif

                                        @if(empty($prokolpoReports->city_corparation_name))

                                        @else
{{ $prokolpoReports->city_corparation_name }}/
                                        @endif


                                        @if(empty($prokolpoReports->thana_name))

                                        @else
{{ $prokolpoReports->thana_name }}
                                        @endif

                                    </td>
                                    <td> ( বহুবার্ষিক)</td>
                                    <td>{{ $prokolpoReports->number_of_beneficiaries }}</td>
                                </tr>
                                @endforeach

                                <?php
                                $countFd6Data = count($prokolpoReportFd6Main);
                                ?>

                                @foreach($prokolpoReportFd7Main as $key=>$prokolpoReports)
                                <tr>
                                    <td>{{ $countFd6Data+($key+1) }}</td>
                                    <td>

                                        {{ DB::table('fd_one_forms')->where('id',$prokolpoReports->fd_one_form_id)->value('organization_name_ban') }}
                                        <p style="font-weight: 900;">প্রকল্পের নাম: {{ DB::table('fd2_form_for_fd7_forms')->where('fd7_form_id',$prokolpoReports->formId)->value('ngo_prokolpo_name') }}</p>
                                    </td>
                                    <td>{{ $prokolpoReports->division_name }}</td>
                                    <td>{{ $prokolpoReports->district_name }}</td>
                                    <td>

                                        @if(empty($prokolpoReports->upozila_name))

                                        @else
{{ $prokolpoReports->upozila_name }}/
                                        @endif

                                        @if(empty($prokolpoReports->city_corparation_name))

                                        @else
{{ $prokolpoReports->city_corparation_name }}/
                                        @endif


                                        @if(empty($prokolpoReports->thana_name))

                                        @else
{{ $prokolpoReports->thana_name }}
                                        @endif

                                    </td>
                                    <td> ( জরুরি ত্রাণ সহায়তা)</td>
                                    <td>{{ $prokolpoReports->number_of_beneficiaries }}</td>
                                </tr>
                                @endforeach

                                <?php
                                $countFd7Data = count($prokolpoReportFd7Main);
                                $countFd6Data = count($prokolpoReportFd6Main);
                                $total = $countFd7Data + $countFd6Data;
                                ?>

                                @foreach($prokolpoReportFc2Main as $key=>$prokolpoReports)
                                <tr>
                                    <td>{{ $total+($key+1) }}</td>
                                    <td>

                                        {{ DB::table('fd_one_forms')->where('id',$prokolpoReports->fd_one_form_id)->value('organization_name_ban') }}
                                        <p style="font-weight: 900;">প্রকল্পের নাম: {{ DB::table('fd2_form_for_fc2_forms')->where('fc2_form_id',$prokolpoReports->formId)->value('ngo_prokolpo_name') }}</p>
                                    </td>
                                    <td>{{ $prokolpoReports->division_name }}</td>
                                    <td>{{ $prokolpoReports->district_name }}</td>
                                    <td>

                                        @if(empty($prokolpoReports->upozila_name))

                                        @else
                                {{ $prokolpoReports->upozila_name }}/
                                        @endif

                                        @if(empty($prokolpoReports->city_corparation_name))

                                        @else
                                {{ $prokolpoReports->city_corparation_name }}/
                                        @endif


                                        @if(empty($prokolpoReports->thana_name))

                                        @else
                                {{ $prokolpoReports->thana_name }}
                                        @endif

                                    </td>
                                    <td> (বৈদেশিক অনুদানে গৃহীত)</td>
                                    <td>{{ $prokolpoReports->number_of_beneficiaries }}</td>
                                </tr>
                                @endforeach

                                <?php
                                $countFd7Data = count($prokolpoReportFd7Main);
                                $countFd6Data = count($prokolpoReportFd6Main);
                                $countFc1Data = count($prokolpoReportFc1Main);
                                $totalOne = $countFd7Data + $countFd6Data + $countFc1Data;
                                ?>

@foreach($prokolpoReportFc1Main as $key=>$prokolpoReports)
<tr>
    <td>{{ $totalOne+($key+1) }}</td>
    <td>

        {{ DB::table('fd_one_forms')->where('id',$prokolpoReports->fd_one_form_id)->value('organization_name_ban') }}
        <p style="font-weight: 900;">প্রকল্পের নাম: {{ DB::table('fd2_form_for_fc1_forms')->where('fc1_form_id',$prokolpoReports->formId)->value('ngo_prokolpo_name') }}</p>
    </td>
    <td>{{ $prokolpoReports->division_name }}</td>
    <td>{{ $prokolpoReports->district_name }}</td>
    <td>

        @if(empty($prokolpoReports->upozila_name))

        @else
{{ $prokolpoReports->upozila_name }}/
        @endif

        @if(empty($prokolpoReports->city_corparation_name))

        @else
{{ $prokolpoReports->city_corparation_name }}/
        @endif


        @if(empty($prokolpoReports->thana_name))

        @else
{{ $prokolpoReports->thana_name }}
        @endif

    </td>
    <td> (এককালীন অনুদান)</td>
    <td>{{ $prokolpoReports->number_of_beneficiaries }}</td>
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
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.j"></script>

<script>
    new DataTable('#example', {
    layout: {

        topStart: {
            buttons: ['copy', 'csv', 'excel', 'print']
        }
    }
});
</script>
<script>
    $("#divisionId").change(function(){


        var divisionId = $('#divisionId').map(function (idx, ele) {
   return $(ele).val();
}).get();


//alert(divisionId);
//prokolpoReportDistrict

$.ajax({
    url: "{{ route('prokolpoReportDistrict') }}",
    method: 'GET',
    data: {divisionId:divisionId},
    success: function(data) {

         $("#districId").html(data);
    },
beforeSend: function(){
       $('#pageloader').show()
   },
  complete: function(){
       $('#pageloader').hide();
  }
    });


});
</script>
@endsection
