<div class="modal right fade bd-example-modal-lg"
id="potroZariModal" role="dialog"
aria-labelledby="myModalLabel22">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
    <h4 class="modal-title" id="myModalLabel2">
        পত্র প্রদর্শন </h4>
</div>

<div class="modal-body">
    @foreach($officeDetail as $officeDetails)


 <!-- new button code start -->

 <div class="d-flex flex-wrap mb-4">
    <button class="btn  btn-outline-secondary me-2" onclick="location.href = '{{ route('printPotrangso', ['status' => $status,'parentId'=>$parentId,'nothiId'=>$nothiId,'id' =>$id,'sarokCode'=>$officeDetails->id]) }}';"><i class="fa fa-print"></i> প্রিন্ট করুন</button>
    <div class="dropdown me-2">
        <button class="btn btn-outline-primary dropdown-toggle"
                type="button"
                id="dropdownMenuButton12"
                data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="fa fa-send"></i>পত্র জারি করুন
        </button>
        <div class="dropdown-menu"
             aria-labelledby="dropdownMenuButton12">
            <div>
                <h3 class="popover-header">পত্র জারি </h3>
                <div class="popover-body">আপনি কি পত্র জারি করতে চান</div>
                <div class="d-flex justify-content-center p-2">
                    <button  onclick="location.href = '{{ route('givePermissionForPotroZari', ['status' => $status,'parentId'=>$parentId,'nothiId'=>$nothiId,'id' =>$id,'childnote'=>$childNoteNewListValue]) }}';" class="btn btn-primary me-2">হ্যাঁ</button>
                    <button class="btn btn-danger">না</button>
                </div>
            </div>
        </div>
    </div>
    <button class="btn btn-outline-warning me-2" onclick="location.href = '{{ route('createPotro', ['status' => $status,'parentId'=>$parentId,'nothiId'=>$nothiId,'id' =>$id,'activeCode' =>$activeCode]) }}';"><i class="fa fa-pencil"></i> সংশোধন করুন</button>



</div>

 <!-- new button code end -->

                                                                        <div class="text-center mb-3 mt-2">
                                                                            <img src="{{ asset('/') }}public/pdfLogo.png" alt="" style="height: 80px;width:80px;">
                                                                            <h3>গণপ্রজাতন্ত্রী বাংলাদেশ
                                                                                সরকার</h3>
                                                                            <h5>এনজিও বিষয়ক ব্যুরো <br>
                                                                                প্রধানমন্ত্রীর কার্যালয় <br>
                                                                                প্লট-ই, ১৩/বি, আগারগাঁও <br>
                                                                                শেরেবাংলা নগর, ঢাকা-১২০৭
                                                                            </h5>
                                                                        </div>
                                                                        <div class="row" class="mt-4">
                                                                            <div class="col-md-6">
                                                                                <p ><span style="font-weight:900;">স্মারক নং:</span> {{ App\Http\Controllers\Admin\CommonController::englishToBangla('১১.২২.৩৩৩৩.৪৪৪.৫৫.'.$nothiNumber.$nothiYear) }}</p>
                                                                            </div>
                                                                            <div class="col-md-6" style="text-align: right;">
                                                                                <table class="table table-borderless">
                                                                                    <tr>
                                                                                        <td style="width: 60%;">তারিখ:</td>
                                                                                        <td style="text-align: left; padding-left: 10px;">                                                                     @if($potroZariListValue == 1)
                                                                                            {{ $dateAppBan }} বঙ্গাব্দ  <br> {{ $dateApp }} খ্রিস্টাব্দ
                                                                                            @else

                                                                                            @endif</td>
                                                                                    </tr>
                                                                                </table>
                                                                            </div>
                                                                        </div>





                                                                      <input type="hidden" name="updateOrSubmit" id="updateOrSubmit" value="1"/>
                                                                      <input type="hidden" name="sorkariUpdateId" id="sorkariUpdateId" value="{{ $officeDetails->id }}"/>
                                                                      <div class="row mt-3">
                                                                        <div class="col-xl-3 ">বিষয় :
                                                                        </div>
                                                                        <div class="col-xl-9">



                                                                                {!! $officeDetails->office_subject !!}

                                                                    </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        @if($officeDetails->office_sutro == '<p>...............................................</p>')

                                                                        @else
                                                                        <div class="col-xl-3">সুত্রঃ
                                                                            (যদি থাকে):
                                                                        </div>

                                                                        <div class="col-xl-9">{!! $officeDetails->office_sutro !!}</div>
                                                                        @endif
                                                                        <input type="hidden" name="parentIdForPotrangso" id="parentIdForPotrangso" value="{{ $id }}"/>
                                                                                             <input type="hidden" name="statusForPotrangso" id="statusForPotrangso" value="{{ $status }}"/>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-xl-12 mt-3">


                                                                                        {!! $officeDetails->description !!}



                                                                        </div>
                                                                    </div>











                                                                        <!-- approver start --->



                                                                        <div class="mt-4" style="text-align: right;">
                                                                        <span>{{ $appName }}</span><br>
                                                                        <span>{{ $desiName }}</span>
                                                                        </div>

                                                                        <!-- approver end -->

                                                                   <!--prapok-->
                                                                    <div class="mt-4">
                                                                        @foreach($nothiPropokListUpdate as $nothiPropokLists)
                                                                        <span>{{ $nothiPropokLists->otherOfficerDesignation }},{{ $nothiPropokLists->otherOfficerBranch }}</span> ।<br>
                                                                        @endforeach
                                                                    </div>
                                                                    <!--end prapok  --->

                                                                    <!-- attraction -->

                                                                    @if(count($nothiAttractListUpdate) == 0)

                                                                    @else
                                                                    <h6 class="mt-4">দৃষ্টি আকর্ষণ</h6>
                                                                    @foreach($nothiAttractListUpdate as $nothiPropokLists)
                                                                    <span>{{ $nothiPropokLists->otherOfficerDesignation }},{{ $nothiPropokLists->otherOfficerBranch }}</span> ।<br>
                                                                    @endforeach
                                                                    @endif

                                                                    <!-- attracttion -->

                                                                    <!-- sarok number --->

                                                                    <div class="row" class="mt-4">
                                                                        <div class="col-md-6">
                                                                            <p ><span style="font-weight:900;">স্মারক নং:</span> {{ App\Http\Controllers\Admin\CommonController::englishToBangla('১১.২২.৩৩৩৩.৪৪৪.৫৫.'.$nothiNumber.$nothiYear) }}</p>
                                                                        </div>
                                                                        <div class="col-md-6" style="text-align: right;">
                                                                            <table class="table table-borderless">
                                                                                <tr>
                                                                                    <td style="width: 60%;">তারিখ:</td>
                                                                                    <td style="text-align: left; padding-left: 10px;">                                                                     @if($potroZariListValue == 1)
                                                                                        {{ $dateAppBan }} বঙ্গাব্দ  <br> {{ $dateApp }} খ্রিস্টাব্দ
                                                                                        @else

                                                                                        @endif</td>
                                                                                </tr>
                                                                            </table>
                                                                        </div>
                                                                    </div>





                                                                    <!-- end sarok number -->

                                                                    <!--copy-->

                                                                    @if(count($nothiCopyListUpdate) == 0)

                                                                    @else
                                                                    <h6 class="mt-4">সদয় জ্ঞাতার্থে/জ্ঞাতার্থে (জ্যেষ্ঠতার ক্রমানুসারে নয় ):</h6>
                                                                    @foreach($nothiCopyListUpdate as $key=>$nothiPropokLists)
                                                                    <span>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($key+1) }} | {{ $nothiPropokLists->otherOfficerDesignation }},{{ $nothiPropokLists->otherOfficerBranch }}</span>;<br>
                                                                    @endforeach
                                                                    @endif

                                                                    <!--end copy list -->
<!--prapok-->
<div class="mt-4" style="text-align: right;">

    <span>{{ $appName }}</span><br>
    <span>{{ $desiName }}</span>
    </div>
@endforeach
</div><!-- modal-content -->
</div><!-- modal-dialog -->
</div><!-- modal -->
</div>
