@extends('admin.master.master')

@section('title')
সেটিং
@endsection
@section('css')

@endsection

@section('body')
<div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-sm-6">
          <h3>সেটিং </h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">হোম</a></li>
            <li class="breadcrumb-item">সেটিং</li>

          </ol>
        </div>
        <div class="col-sm-6">

        </div>

        </div>
      </div>
    </div>
    <div class="container-fluid">






        <div class="edit-profile">
            <div class="row">
              <div class="col-xl-12">
                <div class="card">
                  <div class="card-header pb-0">
                    <h4 class="card-title mb-0">আমার প্রোফাইল</h4>
                    <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                  </div>
                  <div class="card-body">
                    @include('flash_message')
                                            <form action="{{ route('setting.store') }}" method="post" enctype="multipart/form-data">
                                                @csrf
                      <div class="row mb-2" id="editableDiv">
                        <div class="card-title mb-0" >আমার প্রোফাইল</div>
                      </div>

                      <div class="card-title mb-0" id="editableDiv11" style="display: none;">আমার প্রোফাইল</div>


                      <div id="fullname">Amazing Spider man</div>




                    </form>


                    <div id="dialog">
                        <p>IT WORKS!!!</p>
                         <input type="text" />
                      </div>

                      <button id="opener">Open Dialog</button>



                  </div>
                </div>
              </div>

            </div>
          </div>






    </div><!-- container-fluid -->
</div><!-- End Page-content -->
@endsection

@section('script')
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
<script>
    $(function() {
    $( "#dialog" ).dialog({
      autoOpen: false,
      width: 600,
      show: {
        effect: "blind",
        duration: 1000
      },
      hide: {
        effect: "explode",
        duration: 1000
      }
    });

    $( "#opener" ).click(function() {
      $( "#dialog" ).dialog( "open" );
    });
  });
</script>
<script>

  //new code test

  $('#fullname').click(function(){
    var name = $(this).text();
    $(this).html('');
    $('<input></input>')
        .attr({
            'class': 'form-control',
            'name': 'fname',
            'id': 'txt_fullname',
            'value': name,

        })
        .appendTo('#fullname');
    $('#txt_fullname').focus();
})


  //end new code for test
$("#editableDiv").click(function(){
    //alert("The paragraph was clicked.");

var branchStep = 1;

// $("#editableDiv").html('22');

    $.ajax({
        url: "{{ route('testTwo') }}",
        method: 'GET',
        data: {branchStep:branchStep},
        success: function(data) {
            $("#editableDiv").hide(data);
            $("#editableDiv11").show();
                $("#editableDiv11").html(data);



        }
        });


  });


  </script>
@endsection

