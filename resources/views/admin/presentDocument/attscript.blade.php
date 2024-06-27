<script>
    //jQuery('#copyLink1').on("click", function(event){

        $(document).on('click', 'a#attModal1', function () {
//alert(12);
$("#myModalatt").modal('show');

var id =   $(this).data("cmid");

$('#newlastv').val(id);

    });
    
     $(document).on('click', '.btn-close', function () {
//alert(12);
$("#myModalatt").modal('hide');

    });

    </script>
