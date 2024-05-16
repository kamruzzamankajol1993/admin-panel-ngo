


<div class="modal right fade bd-example-modal-lg"
     id="myModal22stu"  role="dialog"
     aria-labelledby="myModalLabel2">
    <div class="modal-dialog modal-lg-custom" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    ফেরত পাঠান
                    <br>
                    <small> <span style="background: gray; border-radius: 5px; padding: 2px 5px;">

                        @foreach($checkParent as $key=>$checkParents)

                        @if($checkParents->id == $id)
                        নোট {{ App\Http\Controllers\Admin\CommonController::englishToBangla($key+1) }}:
                        @else

                        @endif
                        @endforeach


                    </span> {{$checkParentFirst->subject }}</small>
                </h4>
            </div>

            <div class="modal-body">
                <div class="card">
                    <div class="card-body">

                        <?php

                         $senderId = DB::table('nothi_details')
                            ->where('noteId',$id)
                            ->where('nothId',$nothiId)
                            ->where('dakId',$parentId)
                            ->where('dakType',$status)
                            ->where('receiver',Auth::guard('admin')->user()->id)
                            ->value('sender');

                            //dd($senderId );

                            ?>
                        <form action="{{ route('saveNothiPermissionReturn') }}" method="post">

                            @csrf

                            <input type="hidden" value="{{ $childNoteNewListValue }}" placeholder="নোট এর বিষয়" class="form-control" name="child_note_id" id=""/>


                            <input type="hidden" value="{{ $status }}" placeholder="নোট এর বিষয়" class="form-control" name="status" id=""/>
                            <input type="hidden" value="{{ $parentId }}" placeholder="নোট এর বিষয়" class="form-control" name="dakId" id=""/>
                            <input type="hidden" value="{{ $nothiId }}" placeholder="নোট এর বিষয়" class="form-control" name="nothiId" id=""/>

                            <input type="hidden" value="{{ $id }}" placeholder="নোট এর বিষয়" class="form-control" name="noteId" id=""/>

                            {{-- <div class="mb-3">
                                <label class="form-label" for="">অগ্রাধিকার বাছাই করুন </label>
                                <select class="js-example-basic-single col-sm-12">
                                    <option value="AL">অগ্রাধিকার বাছাই করুন</option>
                                    <option value="WY">X</option>
                                </select>
                            </div> --}}
                            <div class="row mt-3">
                                <div class="col-1">

                                        <i class="fa fa-area-chart" style="padding: 15px; border-radius: 50%; border:1px solid black; font-size:20px;"></i>

                                </div>
                                <div class="col-11">
                                    <div class="card">
                                        <div class="card-body">
                                            <table class="table table-borderless">
                                                <tbody>
                                                <tr>
                                                    <td></td>
                                                    <td>নাম</td>
                                                    <td></td>
                                                </tr>

                                                @foreach($branchListForSerial as $branchListForSerials)

                                               <?php
                                            $adminList = DB::table('nothi_permissions')
                                                             ->where('branchId',$branchListForSerials->id)->get();

                                                             $convert_name_title1 = $adminList->implode("adminId", " ");
                                                             $separated_data_title1 = explode(" ", $convert_name_title1);



                                                $finalAdminList = DB::table('admins')->whereIn('id',$separated_data_title1)
                                                                        ->get();

                                                                       // dd($finalAdminList);

                                                ?>
                                                @foreach($finalAdminList as $finalAdminLists)

                                                <?php

$getAlldesignationName = DB::table('designation_lists')
->where('id',$finalAdminLists->designation_list_id)->value('designation_name');

                                                ?>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex justify-content-center">
                                                            <div class="custom_checkbox">
                                                                <input id="ccheck{{ $finalAdminLists->id }}" value="{{ $finalAdminLists->id }}"  {{ $senderId == $finalAdminLists->id ? 'checked':'' }} name="nothiPermissionId" class="custom_check chb" type="checkbox">
                                                                <label for="ccheck{{ $finalAdminLists->id }}" style="--d: 30px">
                                                                    <svg viewBox="0,0,50,50">
                                                                        <path d="M5 30 L 20 45 L 45 5"></path>
                                                                    </svg>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td style="width:80%">
                                                        {{ $finalAdminLists->admin_name_ban }},
                                                        {{ $getAlldesignationName }},{{ $branchListForSerials->branch_name }}, এঞ্জিও
                                                        বিশয়ক ব্যুরো
                                                    </td>
                                                    <td>
                                                        <span style="color: #7e8ba8"><i class="fa fa-check-square-o"></i> স্বাক্ষরকারী ব্যাক্তি</span>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @endforeach


                                           
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div style="text-align:right;">
                                    {{-- <a class="btn btn-primary" type="button" href="{{ route('documentPresent.index') }}">
                                        অনুমতি সংশোধন
                                    </a> --}}
                                    <button  class="btn btn-primary" type="submit">
                                        প্রেরণ
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div><!-- modal -->
</div>
