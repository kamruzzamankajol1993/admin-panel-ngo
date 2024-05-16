<tbody>

    @foreach ($searchResult as $key=>$nothiLists)
<tr>
    <td>
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingTwo">
                <div class="accordion-button collapsed"
                     data-bs-toggle="collapse"
                     data-bs-target="#flush-collapse{{ $key+1 }}">
                                        <span>
                                                                                                                        <span style="line-height:3">
                            <span style="padding:5px; background-color:#879dd9; border-radius: 10px;">নথিঃ</span>  {{ $nothiLists->document_subject }}</span>
                                        <br>
                                        <span style="text-align:left;"> <span
                                                    style="padding:5px; background-color:#879dd9; border-radius: 10px;">নথি নম্বরঃ</span> {{ App\Http\Controllers\Admin\CommonController::englishToBangla('১১.২২.৩৩৩৩.৪৪৪.৫৫.'.$nothiLists->document_number) }}
                                        <span style="padding:5px; background-color:#879dd9; border-radius: 10px;">শাখাঃ</span> {{ $nothiLists->document_branch }}</span>
                                        </span>
                </div>
            </h2>
            <div id="flush-collapse{{ $key+1 }}"
                 class="accordion-collapse collapse">
                <div class="accordion-body">
                    <div class="d-flex mt-3">
                        <button onclick="location.href = '{{ route('addParentNote',['status'=>$status,'dakId'=>$dakId,'nothiId'=>$nothiLists->id]) }}';" class="btn btn-transparent ms-3" type="button">
                            <i class="fa fa-plus"></i>
                            নতুন নোট
                        </button>
                        <button class="btn btn-transparent ms-3" type="button">
                            <i class="fa fa-envelope"></i>
                            সকল নোট
                        </button>
                    </div>
                    <div class="card-body">



                        <?php





  if($status == 'registration'){


    $allNoteListNew = DB::table('parent_note_for_registrations')
  ->where('nothi_detail_id',$dakId)->get();



}elseif($status == 'renew'){




    $allNoteListNew = DB::table('parent_note_for_renews')
  ->where('nothi_detail_id',$dakId)->get();



}elseif($status == 'nameChange'){






    $allNoteListNew = DB::table('parent_note_for_name_changes')
  ->where('nothi_detail_id',$dakId)->get();


}elseif($status == 'fdNine'){






    $allNoteListNew = DB::table('parent_note_for_fd_nines')
  ->where('nothi_detail_id',$dakId)->get();

//dd($checkParent);


}elseif($status == 'fdNineOne'){





    $allNoteListNew = DB::table('parent_note_for_fd_nine_ones')
  ->where('nothi_detail_id',$dakId)->get();




}elseif($status == 'fdSix'){




    $allNoteListNew = DB::table('parent_note_for_fdsixes')
  ->where('nothi_detail_id',$dakId)->get();



}elseif($status == 'fdSeven'){




    $allNoteListNew = DB::table('parent_note_for_fd_sevens')
  ->where('nothi_detail_id',$dakId)->get();

}elseif($status == 'fcOne'){



    $allNoteListNew = DB::table('parent_note_for_fc_ones')
  ->where('nothi_detail_id',$dakId)->get();




}elseif($status == 'fcTwo'){




  $allNoteListNew = DB::table('parent_note_for_fc_twos')
  ->where('nothi_detail_id',$dakId)->get();





}elseif($status == 'duplicate'){






    $allNoteListNew = DB::table('parent_note_for_duplicate_certificates')
  ->where('nothi_detail_id',$dakId)->get();

}elseif($status == 'constitution'){






$allNoteListNew = DB::table('parent_note_for_constitutions')
->where('nothi_detail_id',$dakId)->get();

}elseif($status == 'committee'){






$allNoteListNew = DB::table('parent_not_for_executive_committees')
->where('nothi_detail_id',$dakId)->get();

}elseif($status == 'fdThree'){






$allNoteListNew = DB::table('parent_note_for_fd_threes')
->where('nothi_detail_id',$dakId)->get();

}




    ?>
    @if(count($allNoteListNew) > 0)
    @foreach($allNoteListNew as $key=>$allNoteListNews)
                                                        {{ App\Http\Controllers\Admin\CommonController::englishToBangla(($key+1)) }} .   <a href="{{ route('addChildNote', ['status' =>$status,'parentId'=>$dakId,'nothiId'=>$nothiLists->id,'id' =>$allNoteListNews->id,'activeCode' => ($key+1)]) }}">{{ $allNoteListNews->subject }}</a>
                                                            @endforeach

                                                            @else


                                                            <p>কোন নোট পাওয়া যায়নি</p>
                                                            @endif



                    </div>
                </div>
            </div>
        </div>
    </td>
</tr>
@endforeach
</tbody>
