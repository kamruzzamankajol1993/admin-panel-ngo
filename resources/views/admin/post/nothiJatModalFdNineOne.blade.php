



<!-- Modal -->
<div class="modal right fade bd-example-modal-lg"
     id="nothiJatModalFdNineOne{{ $allStatusData->id }}" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel2">
    <div class="modal-dialog modal-lg-custom"
         role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel2">
                    নথিসমূহ</h4>
            </div>

            <div class="modal-body">
                <h5>একশনঃ নথিতে উপস্থাপনঃ এনজিও'র নাম পরিবর্তন  </h5>
                <div class="row">
                    <div class="col-lg-6">
                        <h5>সকল নথি</h5>
                    </div>
                    <div class="col-lg-6" style="text-align: right;">
                        <button onclick="location.href = '{{ route('documentPresent.create') }}';" type="button"
                                class="btn btn-primary">
                            <i class="fa fa-plus"></i> নতুন
                            নথি তৈরি করুন
                        </button>
                    </div>
                    <div class="col-lg-12 mt-3">
                        <div class="input-group">
                            <input class="form-control"  id="nothiJatSearchFdNineOne{{ $allStatusData->id }}" type="text" placeholder="নথি খুজুন"><span
                                    class="input-group-text" ><i class="fa fa-search"> </i></span>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-3">
                        <div class="table-responsive">
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <table class="table table-striped" id="nothijatSearchResultFdNineOne{{ $allStatusData->id }}">
                                    <tbody>
                                        @foreach ($nothiList as $nothiLists)
                                        <tr>
                                            <td>
                                                <p>
                                                    <div class="form-check form-check-inline checkbox checkbox-primary">
                                                        <input class="form-check-input" data-dakid="{{ $allStatusData->id }}" data-dakstatus="fdNineOne"  data-nothiid="{{ $nothiLists->id }}" id="nothijatFdNineOneFinal{{ $nothiLists->id }}" type="checkbox">
                                                        <label class="form-check-label" for="nothijatFdNineOneFinal{{ $nothiLists->id }}"></label>
                                                      </div>
                                                    <span style="padding:5px; background-color:#879dd9; border-radius: 10px;"> নথিঃ</span>
                                                    {{ $nothiLists->document_subject }}
                                                </p>
                                                <p>
                                                    <span >
                                                        <span style="text-align:left;">
                                                            <span style="padding:5px; background-color:#879dd9; border-radius: 10px;">নথি নম্বরঃ</span> {{ $nothiLists->main_sarok_number }}
                                                            <span style="padding:5px; background-color:#879dd9; border-radius: 10px;">শাখাঃ</span> {{ $nothiLists->document_branch }}</span>
                                                            {{-- <span style="padding:5px; background-color:#879dd9; border-radius: 10px;">শ্রেণী: </span> {{ $nothiLists->document_class }}</span> --}}
                                                </p>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-row-reverse mt-3">

                                                    <button class="btn  btn-dark ms-3" type="button">
                                                        <i class="fa fa-list-alt"></i>
                                                        নথি অনুমতির ইতিহাস
                                                    </button>
                                                    <a class="btn  btn-dark ms-3" type="button"
                                                           target="_blank"
                                                           href="{{ route('givePermissionToNothi',$nothiLists->id) }}"
                                                            >
                                                        <i class="fa fa-sitemap"></i>
                                                        অনুমতি সংশোধন
                                                </a>


                                                    <button class="btn   btn-primary ms-3" onclick="location.href = '{{ route('documentPresent.edit',$nothiLists->id) }}';" type="button">
                                                        <i class="fa fa-send"></i>
                                                        নথি সম্পাদনা
                                                    </button>
                                                    শ্রেণীর নথি
                                                    <span style="padding:5px; background-color:#879dd9; border-radius: 10px;">{{ $nothiLists->document_class }}</span>

                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div><!-- modal -->
</div>
