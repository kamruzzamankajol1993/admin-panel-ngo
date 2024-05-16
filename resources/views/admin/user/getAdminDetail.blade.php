<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<ul>
    <li>নাম: {{ $user->admin_name }}</li>
    <li>ইমেইল: {{ $user->email }}</li>
    <li>মোবাইল নম্বর: {{ $user->admin_mobile }}</li>
    <li>উপাধি এবং শাখা: <?php



$designationIdList = DB::table('admin_designation_histories')->where('admin_id',$user->id)
->get();

        $desiName = DB::table('designation_lists')
        ->where('id',$user->designation_list_id)
        ->value('designation_name');


            ?>

            @foreach($designationIdList as $allDesignationIdList)

            <?php
 $desiName = DB::table('designation_lists')
        ->where('id',$allDesignationIdList->designation_list_id)
        ->value('designation_name');


        $branchId = DB::table('designation_lists')
        ->where('id',$allDesignationIdList->designation_list_id)
        ->value('branch_id');



        $brnachName = DB::table('branches')
        ->where('id',$branchId)
        ->value('branch_name');




            ?>
            {{ $desiName }} <b>({{ $brnachName }})</b>,<br>
             @endforeach

        </li>
    {{-- <li>শাখা: <?php

        $branchName = DB::table('branches')->where('id',$user->branch_id)->value('branch_name');


            ?>
            {{ $branchName }}</li> --}}

    <li>চাকরি শুরুর তারিখ: {{ $user->admin_job_start_date }}</li>
    <li>চাকরির শেষ তারিখ: {{ $user->admin_job_end_date }}</li>
    <li>ছবি:  <img src="{{ asset('/') }}{{ $user->admin_image}}" style="height:50px;"/></li>
    <li>স্বাক্ষর:  <img src="{{ asset('/') }}{{ $user->admin_sign }}" style="height:50px;"/></li>
</ul>
<input type="hidden" value="{{ $user->id }}" class="form-control"   name="id" placeholder="Enter Date" required>
           <div class="mb-3">

            <label class="form-label" for="">যে পদ থেকে অব্যাহতি দিবেন তার নাম </label>
                                        <select class="form-control "  name="desi_id" placeholder="চাকরির শেষ তারিখ" required>
                                         <option value="">-- একটা নির্বাচন করুন --</option>
                                         @foreach($designationIdList as $allDesignationIdList)

                                         <?php
                                         $desiName = DB::table('designation_lists')
                                                ->where('id',$allDesignationIdList->designation_list_id)
                                                ->value('designation_name');


                                                $branchId = DB::table('designation_lists')
                                                ->where('id',$allDesignationIdList->designation_list_id)
                                                ->value('branch_id');



                                                $brnachName = DB::table('branches')
                                                ->where('id',$branchId)
                                                ->value('branch_name');




                                                    ?>

                                         <option value="{{ $allDesignationIdList->id }}">{{ $desiName }} <b>({{ $brnachName }})</b></option>

                                         @endforeach
                                        </select>



                                        <label class="form-label" for="">চাকরির শেষ তারিখ</label>
                                        <input type="text" class="form-control datepicker233" id="datepicker1"  name="admin_job_end_date" placeholder="চাকরির শেষ তারিখ" required>

                                        @if ($errors->has('admin_job_end_date'))
                                        <span class="text-danger">{{ $errors->first('admin_job_end_date') }}</span>
                                    @endif
                                    </div>


                                    <button type="submit" class="btn btn-primary btn-lg  waves-effect  btn-sm waves-light mr-1">
                                        জমা দিন
                                     </button>
                                     <script>
                                        $(function(){
                                           $(".datepicker233").datepicker({
                                               dateFormat: "dd-mm-yy",
                                               changeMonth: true,
                                               changeYear: true
                                           });
                                       });
                                         </script>
