<div class="modal right fade bd-example-modal-lg"
id="potroZariModal" role="dialog"
aria-labelledby="myModalLabel22">
<div class="modal-dialog modal-xl" role="document">
<div class="modal-content">
<div class="modal-header">
<button id="pp" class="btn btn-outline-danger btn-sm"><i class="fa fa-times" aria-hidden="true"></i></button>
    <h4 class="modal-title" id="myModalLabel2">
        পত্র প্রদর্শন </h4>
</div>

<div class="modal-body">
    @foreach($officeDetail as $officeDetails)


 <!-- new button code start -->

 <div class="d-flex flex-wrap mb-4">
    <button class="btn  btn-outline-secondary me-2" onclick="location.href = '{{ route('printPotrangso', ['status' => $status,'parentId'=>$parentId,'nothiId'=>$nothiId,'id' =>$id,'sarokCode'=>$officeDetails->id]) }}';"><i class="fa fa-print"></i> প্রিন্ট করুন</button>
    <div class="dropdown me-2">
        <button class="btn btn-outline-primary  btnPotroZari"
                type="button"
               {{-- // id="dropdownMenuButton12" --}}
                {{-- data-bs-toggle="dropdown" --}}
                aria-expanded="false">
                <i class="fa fa-send"></i>পত্র জারি করুন
        </button>


        <div id="dropdown-menu" class="dropdown-menu"
             aria-labelledby="dropdownMenuButton12">
            <div>
                <h3 class="popover-header">পত্র জারি </h3>
                <div class="popover-body">আপনি কি পত্র জারি করতে চান</div>
                <div class="d-flex justify-content-center p-2">
                    <button  onclick="location.href = '{{ route('givePermissionForPotroZari', ['status' => $status,'parentId'=>$parentId,'nothiId'=>$nothiId,'id' =>$id,'childnote'=>$childNoteNewListValue]) }}';" class="btn btn-primary me-2">হ্যাঁ</button>
                    <button id="btnPotroZari"  class="btn btn-danger btnPotroZari">না</button>
                </div>
            </div>
        </div>



    </div>


    <button class="btn btn-outline-warning me-2" onclick="location.href = '{{ route('createPotro', ['status' => $status,'parentId'=>$parentId,'nothiId'=>$nothiId,'id' =>$id,'activeCode' =>$activeCode]) }}';"><i class="fa fa-pencil"></i> সংশোধন করুন</button>



</div>

 <!-- new button code end -->
 <?php
 $potroZariListValue =  DB::table('nothi_details')
                 ->where('noteId',$id)
                 ->where('nothId',$nothiId)
                 ->where('dakId',$parentId)
                 ->where('dakType',$status)
                 ->value('permission_status');



     ?>

<div class="card">
    <div class="card-body">

        <table class="table table-borderless">
            <tbody style="border-width:0 !important">
                    <tr style="border-width:0 !important">
                    <td style="width: 25%; vertical-align: top; border-width:0 !important">
                        {{-- <img src="{{ asset('/') }}public/bangladesh50.png" alt="" style="height: 60px;width:120px;"> --}}
                    </td>
                    <td style="width: 50%; text-align:center; border-width:0 !important">
                        <p>
                            গণপ্রজাতন্ত্রী বাংলাদেশ সরকার <br>
                            এনজিও বিষয়ক ব্যুরো  <br>
                            প্রধানমন্ত্রীর কার্যালয় <br>
                            প্লট-ই-১৩/বি, আগারগাঁও, শেরেবাংলা নগর, ঢাকা-১২০৭। <br>
                            www:ngoab.gov.bd
                        </p>
                    </td>
                    <td style="width: 25%; text-align: right; vertical-align: top; border-width:0 !important;">
                        {{-- <img src="{{ asset('/') }}public/mujib100.png" alt="" style="height: 80px;width:120px;"> --}}
                    </td>
                </tr>
            </tbody>
        </table>


        <div class="row" class="mt-4">
            <div class="col-md-6">
                <div class="d-flex justify-content-start">
                    <span > স্মারক নং:</span>
                    <p >
                        @if(empty($officeDetails->sarok_number))


                        {!! $potrangshoDraft->sarok_number !!}

                        @else
                        {!! $officeDetails->sarok_number !!}

                        @endif
                    </p>
                </div>
            </div>

            <div class="col-md-6" style="text-align: right;">
                <div class="d-flex justify-content-end">
                    <span >তারিখ:</span>
                    <p>	@if($potroZariListValue == 1)
                        {{ $dateAppBan }} বঙ্গাব্দ  <br> {{ $dateApp }} খ্রিস্টাব্দ
                        @else

                        @endif</p>
            </div>
        </div>

        <?php
        $potroZariListValue =  DB::table('nothi_details')
                        ->where('noteId',$id)
                        ->where('nothId',$nothiId)
                        ->where('dakId',$parentId)
                        ->where('dakType',$status)
                        ->value('permission_status');



            ?>



      <input type="hidden" name="updateOrSubmit" id="updateOrSubmit" value="1"/>
      <input type="hidden" name="sorkariUpdateId" id="sorkariUpdateId" value="{{ $officeDetails->id }}"/>


      <div class="d-flex justify-content-start mt-3">
        <p style="font-weight:bold">বিষয় : </p>

        @if(empty($officeDetails->sarok_number))
        {!! $potrangshoDraft->office_subject !!}
        @else

              {!! $officeDetails->office_subject !!}

        @endif

      </div>
    <div class="row">
        @if($officeDetails->office_sutro == '<p>(যদি থাকে):...............................................</p>')

        @else
        <div class="d-flex justify-content-start">
            <p style="font-weight:bold">সুত্রঃ </p>


                     @if(empty($officeDetails->sarok_number))
                     {!! $potrangshoDraft->office_sutro !!}
                     @else

                           {!! $officeDetails->office_sutro !!}

                     @endif

        </div>
        @endif

    <div class="row">
        <div class="col-xl-12 mt-3">

            @if(empty($officeDetails->sarok_number))
            {!! $potrangshoDraft->description !!}
            @else

                  {!! $officeDetails->description !!}

            @endif






        </div>
    </div>

                                                                            <!-- approver start --->



                                                                            <div class="mt-4" style="text-align: right;">
                                                                                @if($potroZariListValue == 1)

                                                                                @if(!$nothiApproverLista)

                                                                                @else
                                                                                <img src="{{ asset('/') }}{{ $appSignature }}" style="height:30px;"/><br>
                                                                                @endif

                                                                                @else
                                                                                @endif
                                                                            <span>{{ $appName }}</span><br>
                                                                            <span>{{ $desiName }}</span>


                                                                            @if(empty($officeDetails->extra_text ) || $officeDetails->extra_text == '<p>..........</p>')

                                                                            @else



                                                                            @if(empty($officeDetails->sarok_number))
                                                                            {!! $potrangshoDraft->extra_text !!}
                                                                            @else

                                                                                {!! $officeDetails->extra_text !!}

                                                                            @endif


                                                                            @endif


                                                                            <span>ফোন :{{ $aphone }}</span><br>
                                                                            <span>ইমেইল : {{ $aemail }}</span>
                                                                            </div>

                                                                            <!-- approver end -->

                                                                       <!--prapok-->
                                                                        <div class="mt-4">
                                                                            @foreach($nothiPropokListUpdate as $nothiPropokLists)
                                                                            @if(empty($nothiPropokLists->organization_name))
                                                                            @if(count($nothiPropokListUpdate) == ($key+1))
                                                                            {{ $nothiPropokLists->otherOfficerDesignation }}, এনজিও বিষয়ক ব্যুরো</span>।<br>
                                                                            @else
                                                                            {{ $nothiPropokLists->otherOfficerDesignation }}, এনজিও বিষয়ক ব্যুরো</span>;<br>
                                                                            @endif
                                                                             @else
                                                                             @if(count($nothiPropokListUpdate) == ($key+1))
                                                                            {{ $nothiPropokLists->otherOfficerDesignation }}, {{ $nothiPropokLists->organization_name }}, {{ $nothiPropokLists->otherOfficerAddress }}</span> ।<br>
                                                                            @else
                                                                            {{ $nothiPropokLists->otherOfficerDesignation }}, {{ $nothiPropokLists->organization_name }}, {{ $nothiPropokLists->otherOfficerAddress }}</span> ;<br>
                                                                            @endif
                                                                            @endif
                                                                            @endforeach
                                                                        </div>
                                                                        <!--end prapok  --->

                                                                        <!-- attraction -->

                                                                        @if(count($nothiAttractListUpdate) == 0)

                                                                        @else
                                                                        <h6 class="mt-4">দৃষ্টি আকর্ষণ</h6>
                                                                        <p>
                                                                            @foreach($nothiAttractListUpdate as $nothiPropokLists)
                                                                            @if(empty($nothiPropokLists->organization_name))
                                                                            @if(count($nothiAttractListUpdate) == ($key+1))
                                                                                {{ $nothiPropokLists->otherOfficerDesignation }}, এনজিও বিষয়ক ব্যুরো</span>।<br>
                                                                                @else

                                                                                {{ $nothiPropokLists->otherOfficerDesignation }}, এনজিও বিষয়ক ব্যুরো</span>;<br>
                                                                                @endif
                                                                                 @else
                                                                                 @if(count($nothiAttractListUpdate) == ($key+1))
                                                                                {{ $nothiPropokLists->otherOfficerDesignation }}, {{ $nothiPropokLists->organization_name }}, {{ $nothiPropokLists->otherOfficerAddress }}</span> ।<br>
                                                                                @else

                                                                                {{ $nothiPropokLists->otherOfficerDesignation }}, {{ $nothiPropokLists->organization_name }}, {{ $nothiPropokLists->otherOfficerAddress }}</span> ;<br>
                                                                                @endif
                                                                                @endif
                                                                        @endforeach
                                                                        @endif
                                                                        </p>


                                                                        <!-- attracttion -->

                                                                        <!-- sarok number --->


                                                                        @if(count($nothiCopyListUpdate) == 0)

                                                                        @else

                                                                        <div class="row" class="mt-4" style="margin-top: 30px;">
                                                                            <div class="col-md-6">

                                                                                <div class="d-flex justify-content-start">
                                                                                    <span > স্মারক নং:</span>
                                                                                    <p >
                                                                                        @if(empty($officeDetails->sarok_number))


                                                                                        {!! $potrangshoDraft->sarok_number !!}

                                                                                        @else
                                                                                        {!! $officeDetails->sarok_number !!}

                                                                                        @endif
                                                                                    </p>
                                                                                </div>

                                                                            </div>

                                                                            @endif


                                                                            <?php
        $potroZariListValue =  DB::table('nothi_details')
                        ->where('noteId',$id)
                        ->where('nothId',$nothiId)
                        ->where('dakId',$parentId)
                        ->where('dakType',$status)
                        ->value('permission_status');



            ?>
                                                                            <div class="col-md-6" style="text-align: right;">
                                                                                <div class="d-flex justify-content-end">
                                                                                    <span >তারিখ:</span>
                                                                                    <p>	@if($potroZariListValue == 1)
                                                                                        {{ $dateAppBan }} বঙ্গাব্দ  <br> {{ $dateApp }} খ্রিস্টাব্দ
                                                                                        @else

                                                                                        @endif</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>





                                                                        <!-- end sarok number -->

                                                                        <!--copy-->

                                                                        @if(count($nothiCopyListUpdate) == 0)

                                                                        @else
                                                                        <h6 class="mt-4">সদয় জ্ঞাতার্থে/জ্ঞাতার্থে (জ্যেষ্ঠতার ক্রমানুসারে নয় ):</h6>
                                                                        @foreach($nothiCopyListUpdate as $key=>$nothiPropokLists)
                                                                        @if(empty($nothiPropokLists->organization_name))
                                                                        @if(count($nothiCopyListUpdate) == ($key+1))
                                                                        <span>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($key+1) }} | {{ $nothiPropokLists->otherOfficerDesignation }}, এনজিও বিষয়ক ব্যুরো</span>।
                                                                        @else
                                                                        <span>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($key+1) }} | {{ $nothiPropokLists->otherOfficerDesignation }}, এনজিও বিষয়ক ব্যুরো</span>;<br>

                                                                        @endif
                                                                        @else


                                                                        @if(count($nothiCopyListUpdate) == ($key+1))
                                                                        <span>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($key+1) }} | {{ $nothiPropokLists->otherOfficerDesignation }}, {{ $nothiPropokLists->organization_name }}</span>,{{ $nothiPropokLists->otherOfficerAddress }}।
                                                                        @else
                                                                        <span>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($key+1) }} | {{ $nothiPropokLists->otherOfficerDesignation }}, {{ $nothiPropokLists->organization_name }}</span>,{{ $nothiPropokLists->otherOfficerAddress }};<br>

                                                                        @endif



                                                                        @endif
                                                                        @endforeach
                                                                        @endif

                                                                        <!--end copy list -->
    <!--prapok-->
    <div class="mt-4" style="text-align: right;">

        @if($potroZariListValue == 1)

        @if(!$nothiApproverLista)

        @else
        <img src="{{ asset('/') }}{{ $appSignature }}" style="height:30px;"/><br>
        @endif

        @else
        @endif
    <span>{{ $appName }}</span><br>
    <span>{{ $desiName }}</span>


    @if(empty($officeDetails->extra_text ) || $officeDetails->extra_text == '<p>..........</p>')

    @else
    {!! $officeDetails->extra_text !!}
    @endif


    <span>ফোন :{{ $aphone }}</span><br>
    <span>ইমেইল : {{ $aemail }}</span>
    </div>
    @endforeach


    </div>
</div>















</div><!-- modal-content -->
</div><!-- modal-dialog -->
</div><!-- modal -->

