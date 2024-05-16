

@foreach($nothiPrapokList as $nothiPrapokLists)
<tr>
    <td><span class="text-bold"><b>{{ $nothiPrapokLists->otherOfficerName }}</b></span> {{ $nothiPrapokLists->otherOfficerDesignation }}</td>
    <td>



        <a
        href="javascript:void(0)"
        id="delete-user"
        data-url="{{ route('selfOfficerAjaxDelete', $nothiPrapokLists->id) }}"
        class="btn btn-danger"
        ><i class="fa fa-trash"></i></a>


    </td>
</tr>
@endforeach

<script type="text/javascript">

    $(document).ready(function () {




        $('body').on('click', '#delete-user', function () {

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
