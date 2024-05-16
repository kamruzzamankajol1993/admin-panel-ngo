<div class="row">

    <div class="col-sm-8 col-xs-8">

        <p style="font-size: 14px;"><b>{{$checkParentFirst->subject }}<span style="padding-left: 5px;color:#660080">{{ App\Http\Controllers\Admin\CommonController::englishToBangla(date('d/m/y h:i:s', strtotime($checkParentFirst->created_at))) }}</span></b></p>

    </div>
    <div class="col-sm-4 col-xs-4">
        <div class="d-flex flex-row-reverse">
            {{-- <a  href ="" class="btn btn-primary btn-sm"aria-expanded="false"><i class="fa fa-print"></i></a> --}}
        </div>
    </div>
</div>
<hr>
<form id="form" class="custom-validation" action="{{ route('childNote.store') }}" method="post" enctype="multipart/form-data"  data-parsley-validate="">
    @csrf


    <input type="hidden" value="{{ $id }}" name="noteId"/>
    <input type="hidden" value="{{ $activeCode }}" name="activeCode"/>
    <input type="hidden" value="{{ $nothiId }}" name="nothiId"/>
    <input type="hidden" value="{{ $parentId }}" name="dakId"/>
    <input type="hidden" value="{{ $id }}" name="parentNoteId"/>
    <input type="hidden" value="{{ $status }}" name="status"/>
<div id="container">
    <textarea id="peditor"  name="mainPartNote">
        <p>লিখুন</p>
    </textarea>
</div>
<hr>

<?php

$unsentAtt = DB::table('note_attachments')
->where('noteId',$id)
->where('nothiId',$nothiId)
->where('status',$status)
->where('admin_id',Auth::guard('admin')->user()->id)
->whereNull('child_id')
->get();

?>



 <p class="mt-4">সংযুক্তি({{ count($unsentAtt) }})</p>
 <ul>
    @foreach($unsentAtt as $unsentAtts )
    <li><a target="_blank" href="{{ $unsentAtts->title }}"><i class="fa fa-paperclip"></i></a> {{ $unsentAtts->title }}</li>
    @endforeach
 </ul>

<div class="d-flex flex-row-reverse mt-3">

    <div class="dropdown">
        <button class="btn btn-success" value="সংরক্ষন ও খসড়া" name="final_button" type="submit"

        aria-expanded="false">
        সংরক্ষন ও খসড়া
</button>


        <button class="btn btn-primary" value="সংরক্ষন করুন" type="submit" name="final_button"

                aria-expanded="false">
            সংরক্ষন করুন
        </button>

    </div>
</div>
 </form>
