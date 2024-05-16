<textarea class="maineditortttt  ppy{{ $eid }}" id="lmmm{{ $nothiCopyListId }}" name="mainPartNote"> {!! $childNoteNewList->description !!}</textarea>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script>


<script>


    $('.maineditortttt').each(function () {

    var ii = $(this).prop('id');
        CKEDITOR.replace(ii);
    });

    </script>
