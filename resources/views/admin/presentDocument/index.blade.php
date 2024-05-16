@extends('admin.master.master')

@section('title')
সকল নথি
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
                <h3>সকল নথি</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">হোম</a></li>
                    <li class="breadcrumb-item">সকল নথি</li>
                </ol>
            </div>
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                @if (Auth::guard('admin')->user()->can('countryAdd'))
                <a class="btn btn-primary dropdown-toggle waves-effect  btn-sm waves-light mt-5" type="button" href="{{ route('documentPresent.create') }}">
                                                        <i class="far fa-calendar-plus  mr-2"></i> নতুন নথি তৈরী করুন
                </a>
                                                    @endif
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
                    <div class="card-body">

<!-- new code start -->

<div class="table-responsive">
    <div class="accordion accordion-flush" id="accordionFlushExample">
        <table class="table table-striped">
            <tbody>

                @foreach ($nothiList as $nothiLists)
            <tr>
                <td>
                    <p>
                        <span style="padding:5px; background-color:#879dd9; border-radius: 10px;">নথিঃ</span>
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
                        <button class="btn btn-dark ms-3" type="button">
                            <i class="fa fa-list-alt"></i>
                            নথি অনুমতির ইতিহাস
                        </button>
                        <button class="btn btn-dark ms-3" type="button"
                                data-bs-toggle="modal"
                                data-original-title=""
                                data-bs-target="#myModal{{ $nothiLists->id }}">
                            <i class="fa fa-sitemap"></i>
                            অনুমতি সংশোধন
                        </button>

                        @include('admin.presentDocument.nothiEdit')
                        <button class="btn btn-primary ms-3" onclick="location.href = '{{ route('documentPresent.edit',$nothiLists->id) }}';" type="button">
                            <i class="fa fa-send"></i>
                            নথি সম্পাদনা
                        </button>
                    </div>
                </td>
            </tr>
            @endforeach

            </tbody>
        </table>
    </div>
</div>

<!-- new code end -->

                    </div>

                </div>
            </div>
        </div>
        <!-- Individual column searching (text inputs) Ends-->
    </div>
</div>
<!-- Container-fluid Ends-->
<div class="modal fade bd-example-modal-lg11" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
    <h4 class="modal-title" id="myLargeModalLabel">নোটের বিষয়</h4>
    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form action="">
        <div class="mb-3">
            <label class="form-label" for="">বিষয়</label>
            <input class="form-control" type="text">
        </div>
        <button class="btn btn-primary" type="button" onclick="location.href = '';">
            জমা দিন
        </button>
    </form>
</div>
</div>
</div>
</div>







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


        var mainId = $(this).data('nid');


        //alert(mainId);
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

 $("#pills-darktabContent").hide();

                $("#pills-darktab").hide();

                // $("#serial_part_one"+id_for_pass).val(data);
                 $("#final_result"+mainId).html(data);




            },
			     beforeSend: function(){
        $('#pageloader').show()
    },
    complete: function(){
        $('#pageloader').hide()
    }
            });

    });

    //new branch all






    </script>
<script>


$("#document_type_id").change(function(){

    var docId = $(this).val();


    $.ajax({
            url: "{{ route('docTypeCode') }}",
            method: 'GET',
            data: {docId:docId},
            success: function(data) {

                 $("#document_number").val(data+'.');
            }
            });


});


//brnach delete from previous list


$("[id^=branchDelete]").click(function(){

    var branchId = $(this).attr('data-branchId');
    var nothiId = $(this).attr('data-nothiId');


    //alert(branchId + ' ' +nothiId );


    $.ajax({
            url: "{{ route('deleteBrachFromEdit') }}",
            method: 'GET',
            data: {branchId:branchId,nothiId:nothiId},
            success: function(data) {

                 $("#newCodeFromEditList").html(data);
            }
            });

});


//end



//admin delete from previous list
$("[id^=memberDelete]").click(function(){


    var madminId = $(this).attr('data-madminId');
    var nothiId = $(this).attr('data-nothiId');


    //alert(madminId + ' ' +nothiId );

    $.ajax({
            url: "{{ route('deleteAdminFromEdit') }}",
            method: 'GET',
            data: {madminId:madminId,nothiId:nothiId},
            success: function(data) {

                 $("#newCodeFromEditList").html(data);
            }
            });

});


//






</script>

@endsection
