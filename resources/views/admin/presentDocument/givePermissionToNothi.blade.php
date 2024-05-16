@extends('admin.master.master')

@section('title')
নথি অনুমতি দিন | {{ $ins_name }}
@endsection


@section('css')
<style>
    * { margin: 0; padding: 0; }

#page-wrap {
  margin: auto 0;
}

.treeview {
  margin: 10px 0 0 20px;
}

ul {
  list-style: none;
}

.treeview li {
  background: url(http://jquery.bassistance.de/treeview/images/treeview-default-line.gif) 0 0 no-repeat;
  padding: 2px 0 2px 16px;
}

.treeview > li:first-child > label {
  /* style for the root element - IE8 supports :first-child
  but not :last-child ..... */

}

.treeview li.last {
  background-position: 0 -1766px;
}

.treeview li > input {
  height: 16px;
  width: 16px;
  /* hide the inputs but keep them in the layout with events (use opacity) */
  opacity: 0;
  filter: alpha(opacity=0); /* internet explorer */
  -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(opacity=0)"; /*IE8*/
}

.treeview li > label {
  background: url(http://www.thecssninja.com/demo/css_custom-forms/gr_custom-inputs.png) 0 -1px no-repeat;
  /* move left to cover the original checkbox area */
  margin-left: -20px;
  /* pad the text to make room for image */
  padding-left: 20px;
}

/* Unchecked styles */

.treeview .custom-unchecked {
  background-position: 0 -1px;
}
.treeview .custom-unchecked:hover {
  background-position: 0 -21px;
}

/* Checked styles */

.treeview .custom-checked {
  background-position: 0 -81px;
}
.treeview .custom-checked:hover {
  background-position: 0 -101px;
}

/* Indeterminate styles */

.treeview .custom-indeterminate {
  background-position: 0 -141px;
}
.treeview .custom-indeterminate:hover {
  background-position: 0 -121px;
}
</style>
@endsection

@section('body')
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <h3>নথি অনুমতি দিন</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">হোম</a></li>
                    <li class="breadcrumb-item">নথি</li>
                    <li class="breadcrumb-item">নথি অনুমতি দিন</li>
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
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>পদবি নির্বাচন করুন</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="nav nav-dark" id="pills-darktab" role="tablist">
                                        <li class="nav-item"><a class="nav-link active"
                                                                id="pills-darkhome-tab"
                                                                data-bs-toggle="pill" href="#pills-darkhome"
                                                                role="tab" aria-controls="pills-darkhome"
                                                                aria-selected="true"><i
                                                        class="icofont icofont-ui-home"></i>নিজ অফিসের
                                                পদসমূহ</a></li>
                                    </ul>
                                    <div class="tab-content" id="pills-darktabContent">
                                        <div class="tab-pane fade show active" id="pills-darkhome"
                                             role="tabpanel" aria-labelledby="pills-darkhome-tab">
                                            <div class="podobi_tab mt-4">


                                                <h6>এনজিও বিষয়ক ব্যুরো শাখা {{ App\Http\Controllers\Admin\CommonController::englishToBangla($totalBranch) }} টি, পদ {{ App\Http\Controllers\Admin\CommonController::englishToBangla($totalDesignation) }} টি, শূন্যপদ {{ App\Http\Controllers\Admin\CommonController::englishToBangla($totalEmptyDesignation) }}টি,
                                                    কর্মরত {{ App\Http\Controllers\Admin\CommonController::englishToBangla($totalDesignationWorking) }} জন</h6>
                                                <ul class="treeview">
                                                    <input type="hidden" value="{{ $id }}" id="main_id" name="main_id"/>


                                                    @foreach($totalBranchList as $key=>$allTotalBranchList)

                                                    <?php
                                                    $desiList = DB::table('designation_lists')
                                                    ->where('id','!=',1)
                                                          ->where('branch_id',$allTotalBranchList->id)
                                                          ->orderBy('designation_serial','asc')
                                                          ->get();
                                                           ?>


                                                    <li>
                                                        <input disabled type="checkbox" class="passBranch1" value="{{ $allTotalBranchList->id }}" data-status="branch" name="branch_name[]" id="branch_name{{ $allTotalBranchList->id }}">
                                                        <label for="branch_name{{ $allTotalBranchList->id }}" class="custom-unchecked">   {{ $allTotalBranchList->branch_name }}</label>

                                                        <ul>
                                                            @foreach($desiList as $key=>$allDesiList)
                                                            <?php

                                                            $checkDesiId = DB::table('admin_designation_histories')->where('designation_list_id',$allDesiList->id)->first();

?>
                                                           @if(!$checkDesiId)
                                                             <li>
                                                                 <input disabled type="checkbox" value="{{ $allDesiList->id }}" name="designation[]" id="designation{{ $allDesiList->id }}">
                                                                 <label for="designation{{ $allDesiList->id }}" class="custom-unchecked"> শূন্য পদ ({{ $allDesiList->designation_name }})</label>
                                                             </li>

                                                             @else
                                                             <li>

                                                                <input type="hidden" value="{{ $allTotalBranchList->id }}"  name="branchId[]" id="branchId{{ $allDesiList->id }}">


                                                                <?php
                                                                $adminName = DB::table('admins')->where('id',$checkDesiId->admin_id)->value('admin_name_ban');
?>
@if(Auth::guard('admin')->user()->id == $checkDesiId->admin_id)
                                                                <input type="checkbox"  class="passBranch1" data-bId="{{ $allTotalBranchList->id }}" data-status="desi" value="{{ $allDesiList->id }}" name="designation[]" id="designation{{ $allDesiList->id }}">
                                                                @else

                                                                <input type="checkbox" class="passBranch1" data-bId="{{ $allTotalBranchList->id }}" data-status="desi" value="{{ $allDesiList->id }}" name="designation[]" id="designation{{ $allDesiList->id }}">
                                                                @endif
                                                                <label for="designation{{ $allDesiList->id }}" class="custom-unchecked">

                                                                 {{ $adminName }} ({{ $allDesiList->designation_name }})</label>
                                                            </li>
                                                             @endif
                                                             @endforeach

                                                             {{-- <li class="last">
                                                                 <input type="checkbox" name="tall-3" id="tall-3">
                                                                 <label for="tall-3" class="custom-unchecked">Two sandwiches</label>
                                                             </li> --}}
                                                        </ul>
                                                    </li>
                                                    @endforeach
                                                    {{-- <li class="last">
                                                        <input type="checkbox" class="passBranch1" value="2" name="short" id="short">
                                                        <label for="short" class="custom-unchecked">Short Things</label>

                                                        <ul>
                                                             <li>
                                                                 <input type="checkbox" name="short-1" id="short-1">
                                                                 <label for="short-1" class="custom-unchecked">Smurfs</label>
                                                             </li>
                                                             <li>
                                                                 <input type="checkbox" name="short-2" id="short-2">
                                                                 <label for="short-2" class="custom-unchecked">Mushrooms</label>
                                                             </li>
                                                             <li class="last">
                                                                 <input type="checkbox" name="short-3" id="short-3">
                                                                 <label for="short-3" class="custom-unchecked">One Sandwich</label>
                                                             </li>
                                                        </ul>
                                                    </li> --}}
                                                </ul>



                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>নির্বাচিত পদসমূহ</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="nav nav-dark" id="pills-darktab" role="tablist">
                                        <li class="nav-item"><a class="nav-link active"
                                                                id="pills-darkhome-tab"
                                                                data-bs-toggle="pill" href="#pills-darkhome"
                                                                role="tab" aria-controls="pills-darkhome"
                                                                aria-selected="true"><i
                                                        class="icofont icofont-ui-home"></i>নিজ অফিসের
                                                পদসমূহ</a></li>
                                    </ul>
                                    <div class="tab-content" id="pills-darktabContent">
                                        <div class="tab-pane fade show active" id="pills-darkhome"
                                             role="tabpanel" aria-labelledby="pills-darkhome-tab">
                                            <div class="podobi_tab mt-4" id="final_result">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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

<script>

$(function() {

$('input[type="checkbox"]').change(checkboxChanged);

function checkboxChanged() {
  var $this = $(this),
      checked = $this.prop("checked"),
      container = $this.parent(),
      siblings = container.siblings();

  container.find('input[type="checkbox"]')
  .prop({
      indeterminate: false,
      checked: checked
  })
  .siblings('label')
  .removeClass('custom-checked custom-unchecked custom-indeterminate')
  .addClass(checked ? 'custom-checked' : 'custom-unchecked');

  checkSiblings(container, checked);
}

function checkSiblings($el, checked) {
  var parent = $el.parent().parent(),
      all = true,
      indeterminate = false;

  $el.siblings().each(function() {
    return all = ($(this).children('input[type="checkbox"]').prop("checked") === checked);
  });

  if (all && checked) {
    parent.children('input[type="checkbox"]')
    .prop({
        indeterminate: false,
        checked: checked
    })
    .siblings('label')
    .removeClass('custom-checked custom-unchecked custom-indeterminate')
    .addClass(checked ? 'custom-checked' : 'custom-unchecked');

    checkSiblings(parent, checked);
  }
  else if (all && !checked) {
    indeterminate = parent.find('input[type="checkbox"]:checked').length > 0;

    parent.children('input[type="checkbox"]')
    .prop("checked", checked)
    .prop("indeterminate", indeterminate)
    .siblings('label')
    .removeClass('custom-checked custom-unchecked custom-indeterminate')
    .addClass(indeterminate ? 'custom-indeterminate' : (checked ? 'custom-checked' : 'custom-unchecked'));

    checkSiblings(parent, checked);
  }
  else {
    $el.parents("li").children('input[type="checkbox"]')
    .prop({
        indeterminate: true,
        checked: false
    })
    .siblings('label')
    .removeClass('custom-checked custom-unchecked custom-indeterminate')
    .addClass('custom-indeterminate');
  }
}
});


//new code
$(document).on('click', '.passBranch1', function(){

   // alert(21);


    var mainId = $('#main_id').val();
    var mainstatus = $(this).data('status');


    var mainStatusNew = $('#mainstatus').val();




    var totalBranch = $('input[name="branch_name[]"]:checked').map(function (idx, ele) {
   return $(ele).val();
}).get();


var totalDesi = $('input[name="designation[]"]:checked').map(function (idx, ele) {
return $(ele).val();
}).get();




console.log(mainstatus);
console.log(totalBranch);
console.log(totalDesi);




$.ajax({
        url: "{{ route('showDataDesignationWiseOne') }}",
        method: 'GET',
        data: {mainStatusNew:mainStatusNew,mainId:mainId,mainstatus:mainstatus,totalBranch:totalBranch,totalDesi:totalDesi},
        success: function(data) {



            // $("#serial_part_one"+id_for_pass).val(data);
             $("#final_result").html(data);




        }
        });

});

//new branch all






</script>



@endsection
