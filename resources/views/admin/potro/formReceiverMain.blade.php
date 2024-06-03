<form id="form" class="custom-validation" action="{{ route('officeSarok.store') }}" method="post" enctype="multipart/form-data"  data-parsley-validate="">
    @csrf
    <div class="row" class="mt-4">
        <div class="col-md-6">

            <div class="d-flex justify-content-start">
                <span > স্মারক নং: </span>



                <textarea id="ineditor3" name="sarok_number" contenteditable="true">
                    {!! $officeDetails->sarok_number !!}
                    </textarea>
                </div>
        </div>
        <div class="col-md-6" style="text-align: right;">
            <table class="table table-borderless">
                <tbody style="border: none !important;">
                <tr style="border: none !important;">
                    <td style="width: 50%; text-align: right; vertical-align: middle; border: none !important;">
                        তারিখ:
                    </td>
                    <td style="text-align: left; vertical-align: middle; border: none !important;">
                        @if($potroZariListValue == 1)
                        {{ $dateAppBan }} বঙ্গাব্দ  <br> {{ $dateApp }} খ্রিস্টাব্দ
                        @else

                        @endif
                    </td>
                </tr>
            </tbody>
            </table>
        </div>
    </div>
                                                                            <input type="hidden" value="{{ $id }}" name="noteId"/>
                                                                            <input type="hidden" value="{{ $activeCode }}" name="activeCode"/>
                                                                            <input type="hidden" value="{{ $nothiId }}" name="nothiId"/>
                                                                            <input type="hidden" value="{{ $parentId }}" name="dakId"/>
                                                                            <input type="hidden" value="{{ $id }}" name="parentNoteId"/>
                                                                            <input type="hidden" value="{{ $status }}" name="status"/>

                                                                            <input type="hidden" name="receiveEnd" value="1"/>


                                                                          <input type="hidden" name="updateOrSubmit" id="updateOrSubmit" value="1"/>
                                                                          <input type="hidden" name="sorkariUpdateId" id="sorkariUpdateId" value="{{ $officeDetails->id }}"/>
                                                                          <div class="d-flex justify-content-start mt-3">
                                                                              <p style="font-weight:bold;">বিষয় :</p>
                                                                              <p>
                                                                                  <textarea id="ineditor1" name="subject" contenteditable="true">
                                                                                    {!! $officeDetails->office_subject !!}
                                                                                    </textarea></p>
                                                                        </div>
                                                                        <div class="d-flex justify-content-start">
                                                                            <p style="font-weight:bold;">সুত্রঃ</p>
                                                                            <p><textarea id="ineditor2" name="sutro" contenteditable="true">
                                                                                    {!! $officeDetails->office_sutro !!}
                                                                                    </textarea>
                                                                                    </p>
                                                                            <input type="hidden" name="parentIdForPotrangso" id="parentIdForPotrangso" value="{{ $id }}"/>
                                                                            <input type="hidden" name="statusForPotrangso" id="statusForPotrangso" value="{{ $status }}"/>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-xl-12">

                                                                                <label class="btn btn-primary" id="sompadonButton">সম্পাদন করুন</label>


                                                                                <button class="btn btn-primary" type="submit" style="display: none;" id="sompadonButtonOne">সম্পাদনা শেষ করুন </button>
    <br>
                                                                                {{-- <p>পত্রের বিষয়বস্তু.........................</p> --}}

                                                                                <div id="firstBisoyBostu"> {!! $officeDetails->description !!}</div>

                                                                                {{-- <textarea id="editor1222"   class="mainEdit mt-2 secondBisoyBostu"  name="maindes" >
                                                                                        {!! $officeDetails->description !!}
                                                                                    </textarea> --}}

                                                                                    <textarea   style="display: none;" class="mainEdit mt-2 secondBisoyBostu"  name="maindes" >
                                                                                        {!! $officeDetails->description !!}
                                                                                    </textarea>


                                                                            </div>
                                                                        </div>


                                                                          <!--new update code start -->
                                                                          <?php
                                                                          $potroZariListValue =  DB::table('nothi_details')
                                                                                          ->where('noteId',$id)
                                                                                          ->where('nothId',$nothiId)
                                                                                          ->where('dakId',$parentId)
                                                                                          ->where('dakType',$status)
                                                                                          ->value('permission_status');



                                                                              ?>
                                                                          <div class="row">
                                                                              <div class="col-lg-8">

                                                                              </div>
                                                                              <div class="col-lg-4">
                                                                                  <div class="mt-4" style="text-align: center;">
                                                                                      @if($potroZariListValue == 1)

                                                                                      @if(!$nothiApproverList)

                                                                                    @else
<?php

                                                                                    $nothiApproverLista = DB::table('admins')->where('id',$nothiApproverList->adminId)
                                                                               ->first();

                                                                                    ?>

                                                                                      @if(!$nothiApproverLista)

                                                                                      @else
                                                                                      <img src="{{ asset('/') }}{{ $nothiApproverLista->admin_sign }}" style="height:30px;"/><br>
                                                                                      @endif

                                                                                      @endif

                                                                                      @else
                                                                                      @endif
                                                                                  <span>{{ $appName }}</span><br>
                                                                                  <span>{{ $desiName }}</span><br>

                                                                                  {{-- @if(empty($potrangshoDraft->extra_text ) || $potrangshoDraft->extra_text == '<p>..........</p>')
                                                                                  <textarea id="ineditor4" name="extra_text" contenteditable="true">..........</textarea>
                                                                                  @else
                                                                                    <textarea id="ineditor4" name="extra_text" contenteditable="true">{!! $potrangshoDraft->extra_text !!}</textarea>
                                                                                   @endif --}}
                              <span>ফোন :{{ $aphone }}</span><br>
                              <span>ইমেইল : {{ $aemail }}</span>
                                                                                  </div>
                                                                              </div>

                                                                          </div>

                                                                          <!-- new update code end -->

                                                                        <!-- approver end -->

                                                                </form>
