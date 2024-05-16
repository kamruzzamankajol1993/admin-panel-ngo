<div class="mb-0 m-t-30">
    <div class="card">
        <div class="card-header pb-0">
            <h5>নথিপত্র</h5>
            <span>নথি দেখুন করুন</span>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>নথির নাম</th>
                    <th>নথি দেখুন</th>
                </tr>
                @if(!$nVisaDocs)

                        {{-- <tr>
                            <td>১</td>
                            <td>ক্রেতার প্রতিনিধি নিয়োগের ক্ষেত্রে ক্রেতার মনোনয়ন পত্রের অনুলিপি</td>
                            <td>







                            </td>
                        </tr>
                        <tr>
                            <td>২</td>
                            <td>বিনিয়োগ বোর্ডের নিবন্ধন পত্রের অনুলিপি, যদি আগে জমা না দেওয়া হয়</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>৩</td>
                            <td>কর্মচারীর ক্ষেত্রে পরিষেবা চুক্তি/চুক্তি/নিয়োগ পত্রের অনুলিপি</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>৪</td>
                            <td>বিদেশী নাগরিকদের নিয়োগ সংক্রান্ত কোম্পানির পরিচালক পর্ষদের সিদ্ধান্ত (সীমিত কোম্পানির ক্ষেত্রে) বেতন এবং অন্যান্য সুবিধা দেখায় শুধুমাত্র সভায় উপস্থিত পরিচালকদের দ্বারা স্বাক্ষরিত কোম্পানির</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>৫</td>
                            <td>মেমোরেন্ডাম এবং আর্টিকেল অফ অ্যাসোসিয়েশন শেয়ারহোল্ডারদের দ্বারা যথাযথভাবে স্বাক্ষরিত এবং অন্তর্ভুক্তির শংসাপত্র সহ (লিমিটেড কোম্পানির ক্ষেত্রে), যদি আগে জমা না দেওয়া হয়</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>৬</td>
                            <td>কর্মচারীদের জন্য ই-টাইপ ভিসা সহ পাসপোর্টের ফটোকপি/বিনিয়োগকারীদের জন্য পিআই-টাইপ ভিসা</td>
                            <td></td>
                        </tr> --}}

                        @else

                        @if(empty($nVisaDocs->nomination_letter_of_buyer))


                        @else
                        <tr>

                            <td>ক্রেতার প্রতিনিধি নিয়োগের ক্ষেত্রে ক্রেতার মনোনয়ন পত্রের অনুলিপি</td>
                            <td>

ff


                                <a target="_blank"  href="{{ route('nVisaDocumentDownload',['cat'=>'nomination','id'=>$nVisaDocs->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন  </a>




                            </td>
                        </tr>
                        @endif
                        @if(empty($nVisaDocs->registration_letter_of_board_of_investment))


                                @else
                        <tr>

                            <td>বিনিয়োগ বোর্ডের নিবন্ধন পত্রের অনুলিপি, যদি আগে জমা না দেওয়া হয়</td>
                            <td>



                                 <a target="_blank"  href="{{ route('nVisaDocumentDownload',['cat'=>'investment','id'=>$nVisaDocs->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন  </a>



                            </td>
                        </tr>
                        @endif
                        @if(empty($nVisaDocs->employee_contract_copy))


                        @else
                        <tr>

                            <td>কর্মচারীর ক্ষেত্রে পরিষেবা চুক্তি/চুক্তি/নিয়োগ পত্রের অনুলিপি</td>
                            <td>



                                 <a target="_blank"  href="{{ route('nVisaDocumentDownload',['cat'=>'contract','id'=>$nVisaDocs->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন  </a>



                            </td>
                        </tr>
                        @endif
                        @if(empty($nVisaDocs->board_of_the_directors_sign_lette))


                                @else
                        <tr>

                            <td>বিদেশী নাগরিকদের নিয়োগ সংক্রান্ত কোম্পানির পরিচালক পর্ষদের সিদ্ধান্ত (সীমিত কোম্পানির ক্ষেত্রে) বেতন এবং অন্যান্য সুবিধা দেখায় শুধুমাত্র সভায় উপস্থিত পরিচালকদের দ্বারা স্বাক্ষরিত কোম্পানির</td>
                            <td>



                                 <a target="_blank"  href="{{ route('nVisaDocumentDownload',['cat'=>'directors','id'=>$nVisaDocs->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন  </a>



                            </td>
                        </tr>
                        @endif
                        @if(empty($nVisaDocs->share_holder_copy))


                        @else
                        <tr>

                            <td>মেমোরেন্ডাম এবং আর্টিকেল অফ অ্যাসোসিয়েশন শেয়ারহোল্ডারদের দ্বারা যথাযথভাবে স্বাক্ষরিত এবং অন্তর্ভুক্তির শংসাপত্র সহ (লিমিটেড কোম্পানির ক্ষেত্রে), যদি আগে জমা না দেওয়া হয়</td>
                            <td>


                                 <a target="_blank"  href="{{ route('nVisaDocumentDownload',['cat'=>'shareHolder','id'=>$nVisaDocs->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন </a>


                            </td>
                        </tr>
                        @endif
                        @if(empty($nVisaDocs->passport_photocopy))


                        @else
                        <tr>

                            <td>কর্মচারীদের জন্য ই-টাইপ ভিসা সহ পাসপোর্টের ফটোকপি/বিনিয়োগকারীদের জন্য পিআই-টাইপ ভিসা</td>
                            <td>


                                 <a target="_blank" href="{{ route('nVisaDocumentDownload',['cat'=>'passportCopy','id'=>$nVisaDocs->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন  </a>


                            </td>
                        </tr>
                        @endif

                        @endif
                        @if(Route::is('addChildNote') || Route::is('viewChildNote'))
                        <tr>
                            <td>এফডি - ৯ ফরম</td>
                            <td>:


                                <a target="_blank" href="{{ route('verified_fd_nine_download',$dataFromNVisaFd9Fd1->id) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন  </a>
                                <button  href="{{ route('verified_fd_nine_download',$dataFromNVisaFd9Fd1->id) }}" class="btn btn-secondary" id="attLink1"  data-name="এফডি - ৯ ফরম"><i class="fa fa-paperclip"></i></button>
                                <button  href="{{ route('verified_fd_nine_download',$dataFromNVisaFd9Fd1->id) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>
                                </td>
                        </tr>

                        @else


                        @endif
                        @if(!$dataFromNVisaFd9Fd1->fd9_academic_qualification)

                        @else
                        <tr>

                            <td>একাডেমিক যোগ্যতা (একাডেমিক যোগ্যতার সমর্থনে সনদপত্রের কপি সংযুক্ত করতে হবে</td>
                            <td>:


                                <a target="_blank" href="{{ route('nVisaDocumentDownload',['cat'=>'academicQualification','id'=>$dataFromNVisaFd9Fd1->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন  </a>
                                @if(Route::is('addChildNote') || Route::is('viewChildNote'))

                                <button  href="{{ route('nVisaDocumentDownload',['cat'=>'academicQualification','id'=>$dataFromNVisaFd9Fd1->id]) }}" class="btn btn-secondary" id="attLink1"  data-name="একাডেমিক যোগ্যতা (একাডেমিক যোগ্যতার সমর্থনে সনদপত্রের কপি সংযুক্ত করতে হবে"><i class="fa fa-paperclip"></i></button>
                                <button  href="{{ route('nVisaDocumentDownload',['cat'=>'academicQualification','id'=>$dataFromNVisaFd9Fd1->id]) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>

                                @endif
                                </td>
                        </tr>
                        @endif
                        @if(!$dataFromNVisaFd9Fd1->fd9_technical_and_other_qualifications_if_any)

                                @else
                        <tr>

                            <td>কারিগরি ও অন্যান্য যোগ্যতা যদি থাকে (প্রাসঙ্গিক সনদপত্রের কপি সংযুক্ত করতে
                                হবে)
                            </td>
                            <td>:


                                <a target="_blank" href="{{ route('nVisaDocumentDownload',['cat'=>'techQualification','id'=>$dataFromNVisaFd9Fd1->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন  </a>
                                @if(Route::is('addChildNote') || Route::is('viewChildNote'))

                                <button  href="{{ route('nVisaDocumentDownload',['cat'=>'techQualification','id'=>$dataFromNVisaFd9Fd1->id]) }}" class="btn btn-secondary" id="attLink1"  data-name="কারিগরি ও অন্যান্য যোগ্যতা যদি থাকে (প্রাসঙ্গিক সনদপত্রের কপি সংযুক্ত করতে হবে)"><i class="fa fa-paperclip"></i></button>
                                <button  href="{{ route('nVisaDocumentDownload',['cat'=>'techQualification','id'=>$dataFromNVisaFd9Fd1->id]) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>

                                @endif
                            </td>
                        </tr>
                        @endif
                        @if(!$dataFromNVisaFd9Fd1->fd9_past_experience)

                                @else
                        <tr>

                            <td>অতীত অভিজ্ঞতা এবং যে কাজে তাঁকে নিয়োগ দেয়া হচ্ছে তাতে তার দক্ষতা (প্রমাণকসহ)
                            </td>
                            <td>:


                                <a target="_blank" href="{{ route('nVisaDocumentDownload',['cat'=>'pastExperience','id'=>$dataFromNVisaFd9Fd1->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন  </a>

                                @if(Route::is('addChildNote') || Route::is('viewChildNote'))

                                <button  href="{{ route('nVisaDocumentDownload',['cat'=>'pastExperience','id'=>$dataFromNVisaFd9Fd1->id]) }}" class="btn btn-secondary" id="attLink1"  data-name="অতীত অভিজ্ঞতা এবং যে কাজে তাঁকে নিয়োগ দেয়া হচ্ছে তাতে তার দক্ষতা (প্রমাণকসহ)"><i class="fa fa-paperclip"></i></button>
                                <button  href="{{ route('nVisaDocumentDownload',['cat'=>'pastExperience','id'=>$dataFromNVisaFd9Fd1->id]) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>

                                @endif

                                </td>
                        </tr>
                        @endif
                        @if(!$dataFromNVisaFd9Fd1->fd9_offered_post)

                        @else
                        <tr>

                            <td>যে পদের জন্য নিয়োগ প্রস্তাব দেয়া হয়েছে : (চুক্তিপত্র কপি সংযুক্ত করতে হবে)
                            </td>
                            <td>:


                                <a target="_blank" href="{{ route('nVisaDocumentDownload',['cat'=>'offeredPost','id'=>$dataFromNVisaFd9Fd1->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন  </a>


                                @if(Route::is('addChildNote') || Route::is('viewChildNote'))

                                <button  href="{{ route('nVisaDocumentDownload',['cat'=>'offeredPost','id'=>$dataFromNVisaFd9Fd1->id]) }}" class="btn btn-secondary" id="attLink1"  data-name="যে পদের জন্য নিয়োগ প্রস্তাব দেয়া হয়েছে : (চুক্তিপত্র কপি সংযুক্ত করতে হবে)"><i class="fa fa-paperclip"></i></button>
                                <button  href="{{ route('nVisaDocumentDownload',['cat'=>'offeredPost','id'=>$dataFromNVisaFd9Fd1->id]) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>

                                @endif
                                 </td>
                        </tr>
                        @endif

                        @if(!$dataFromNVisaFd9Fd1->fd9_offered_post_niyog)

                        @else
                        <tr>

                            <td>যে পদের জন্য নিয়োগ প্রস্তাব দেয়া হয়েছে : (নিয়োগপত্র কপি সংযুক্ত করতে হবে)
                            </td>
                            <td>:


                                <a target="_blank" href="{{ route('nVisaDocumentDownload',['cat'=>'offeredPostNiyog','id'=>$dataFromNVisaFd9Fd1->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন  </a>


                                @if(Route::is('addChildNote') || Route::is('viewChildNote'))

                                <button  href="{{ route('nVisaDocumentDownload',['cat'=>'offeredPostNiyog','id'=>$dataFromNVisaFd9Fd1->id]) }}" class="btn btn-secondary" id="attLink1"  data-name="যে পদের জন্য নিয়োগ প্রস্তাব দেয়া হয়েছে : (নিয়োগপত্র কপি সংযুক্ত করতে হবে)"><i class="fa fa-paperclip"></i></button>
                                <button  href="{{ route('nVisaDocumentDownload',['cat'=>'offeredPostNiyog','id'=>$dataFromNVisaFd9Fd1->id]) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>

                                @endif
                                 </td>
                        </tr>
                        @endif


                        @if(!$dataFromNVisaFd9Fd1->fd9_name_of_proposed_project)

                                @else
                        <tr>

                            <td>যে প্রকল্পে তাকে নিয়োগের প্রস্থাব করা হয়েছে তার নাম ও মেয়াদ ব্যুরোর অনুমোদন পত্র সংযুক্ত করতে হবে)
                            </td>
                            <td>:


                                <a target="_blank" href="{{ route('nVisaDocumentDownload',['cat'=>'proposedProject','id'=>$dataFromNVisaFd9Fd1->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন  </a>


                                @if(Route::is('addChildNote') || Route::is('viewChildNote'))

                                <button  href="{{ route('nVisaDocumentDownload',['cat'=>'proposedProject','id'=>$dataFromNVisaFd9Fd1->id]) }}" class="btn btn-secondary" id="attLink1"  data-name="যে প্রকল্পে তাকে নিয়োগের প্রস্থাব করা হয়েছে তার নাম ও মেয়াদ ব্যুরোর অনুমোদন পত্র সংযুক্ত করতে হবে)"><i class="fa fa-paperclip"></i></button>
                                <button  href="{{ route('nVisaDocumentDownload',['cat'=>'proposedProject','id'=>$dataFromNVisaFd9Fd1->id]) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>

                                @endif
                                 </td>
                        </tr>
                        @endif

                        @if(!$dataFromNVisaFd9Fd1->fd9_foreigner_passport_size_photo)

                        @else
                        <tr>

                            <td>বিদেশি নাগরিকের পাসপোর্ট সাইজের ছবি</td>
                            <td>:

                                <img src="{{ $ins_url }}{{ $dataFromNVisaFd9Fd1->fd9_foreigner_passport_size_photo }}" alt="" style="height:40px;" id="output">


                            </td>
                        </tr>
                        @endif
                        @if(!$dataFromNVisaFd9Fd1->fd9_copy_of_passport)

                                @else
                        <tr>

                            <td>পাসপোর্টের কপি সংযুক্ত</td>
                            <td>:


                                <a target="_blank" href="{{ route('nVisaDocumentDownload',['cat'=>'copyOfPassport','id'=>$dataFromNVisaFd9Fd1->id]) }}" class="btn btn-outline-success"><i class="fa fa-file-pdf-o"></i> দেখুন  </a>


                                @if(Route::is('addChildNote') || Route::is('viewChildNote'))

                                <button  href="{{ route('nVisaDocumentDownload',['cat'=>'copyOfPassport','id'=>$dataFromNVisaFd9Fd1->id]) }}" class="btn btn-secondary" id="attLink1"  data-name="যে প্রকল্পে তাকে নিয়োগের প্রস্থাব করা হয়েছে তার নাম ও মেয়াদ ব্যুরোর অনুমোদন পত্র সংযুক্ত করতে হবে)"><i class="fa fa-paperclip"></i></button>
                                <button  href="{{ route('nVisaDocumentDownload',['cat'=>'copyOfPassport','id'=>$dataFromNVisaFd9Fd1->id]) }}" class="btn btn-danger" id="copyLink1"><i class="fa fa-copy"></i></button>

                                @endif



                                </td>
                        </tr>
                        @endif

            </table>
        </div>

    </div>


</div>
