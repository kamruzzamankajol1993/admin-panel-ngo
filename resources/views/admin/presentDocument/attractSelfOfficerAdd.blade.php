

@foreach($nothiAttractList as $nothiPrapokLists)
<tr>
    <td><span class="text-bold"><b>{{ $nothiPrapokLists->otherOfficerName }}</b></span> {{ $nothiPrapokLists->otherOfficerDesignation }}</td>
    <td>



        <a
        href="javascript:void(0)"
        id="delete-usera"
        data-url="{{ route('attractSelfOfficerAjaxDelete', $nothiPrapokLists->id) }}"
        class="btn btn-danger"
        ><i class="fa fa-trash"></i></a>


    </td>
</tr>
@endforeach

<script type="text/javascript">

    $(document).ready(function () {




        $('body').on('click', '#delete-usera', function () {

          var userURL = $(this).data('url');
          var trObj = $(this);

          if(confirm("Are you sure you want to remove this user?") == true){
                $.ajax({
                    url: userURL,
                    type: 'get',
                    dataType: 'json',
                    success: function(data) {
                        alert(data.success);
                        trObj.parents("tr").remove();
                    }
                });
          }

       });

    });

</script>
