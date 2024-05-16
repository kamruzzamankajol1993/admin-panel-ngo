 @php
     $usr = Auth::guard('admin')->user();
 @endphp

 <header class="main-nav">
    <div class="sidebar-user text-center">
        @if ($usr->can('profile.view'))
        <a class="setting-primary" href="{{ route('profile.index') }}"><i data-feather="settings"></i>
        </a>
        @else
        <a class="setting-primary" href="#"><i data-feather="settings"></i>
        </a>
        @endif

        @if(empty(Auth::guard('admin')->user()->admin_image))

        <img class="img-90 rounded-circle" src="{{asset('/')}}public/admin/user.png" alt="">
        @else

        <img class="img-90 rounded-circle" src="{{asset('/')}}{{ Auth::guard('admin')->user()->admin_image }}" alt="">

        @endif





        <div class="badge-bottom"></div>
        @if ($usr->can('profile.view'))
        <a href="{{ route('profile.index') }}">
            <h6 class="mt-3 f-14 f-w-600">{{ Auth::guard('admin')->user()->admin_name_ban }}</h6>
        </a>
        @else
        <a href="#">
            <h6 class="mt-3 f-14 f-w-600">{{ Auth::guard('admin')->user()->admin_name_ban }}</h6>
        </a>
        @endif


            <?php
                 $designationName = DB::table('designation_lists')
                 ->where('id',Auth::guard('admin')->user()->designation_list_id)
                 ->value('designation_name');

                 $branchName = DB::table('branches')
                 ->where('id',Auth::guard('admin')->user()->branch_id)
                 ->value('branch_name');

            ?>
        <p class="mb-0 font-roboto">{{ $designationName  }}</p>
        <p class="mb-0 font-roboto">{{ $branchName  }}</p>
    </div>




    @if(Route::is('profilePictureEdit') || Route::is('passwordEdit') || Route::is('digitalSignatureEdit') || Route::is('basicInformationEdit') || Route::is('profile.index'))
    <nav>
        <div class="main-navbar">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="mainnav">
                <ul class="nav-menu custom-scrollbar">
                    <li class="back-btn">
                        <div class="mobile-back text-end"><span>পেছনে</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <p>ই -মেইল : {{ Auth::guard('admin')->user()->email }}<br>
                                ফোন : {{ App\Http\Controllers\Admin\CommonController::englishToBangla(Auth::guard('admin')->user()->admin_mobile) }}</p>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav {{ Route::is('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                            <i data-feather="home"></i>
                            <span>ড্যাশবোর্ড</span>
                        </a>
                    </li>

                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav {{ Route::is('basicInformationEdit') ? 'active' : '' }}" href="{{ route('basicInformationEdit') }}">
                            <i data-feather="list"></i>
                            <span>তথ্যাবলী</span>
                        </a>
                    </li>

                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav {{ Route::is('digitalSignatureEdit') ? 'active' : '' }}" href="{{ route('digitalSignatureEdit') }}">
                            <i data-feather="crop"></i>
                            <span>ডিজিটাল স্বাক্ষর </span>
                        </a>
                    </li>

                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav {{ Route::is('passwordEdit') ? 'active' : '' }}" href="{{ route('passwordEdit') }}">
                            <i class="icon-key"></i>
                            <span>পাসওয়ার্ড </span>
                        </a>
                    </li>


                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav {{ Route::is('profilePictureEdit') ? 'active' : '' }}" href="{{ route('profilePictureEdit') }}">
                            <i class="icon-image"></i>
                            <span>প্রোফাইল ছবি </span>
                        </a>
                    </li>
                </ul>
                </div>
                </div>
                </nav>
    @else
    <nav>
        <div class="main-navbar">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="mainnav">
                <ul class="nav-menu custom-scrollbar">
                    <li class="back-btn">
                        <div class="mobile-back text-end"><span>পেছনে</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>সাধারণ</h6>
                        </div>
                    </li>



                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav {{ Route::is('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                            <i data-feather="home"></i>
                            <span>ড্যাশবোর্ড</span>
                        </a>
                    </li>


                    @if ($usr->can('postAdd') || $usr->can('postView') || $usr->can('postDelete') || $usr->can('postUpdate'))
<li class="sidebar-main-title">
    <div>
      <h6>ডাক </h6>
    </div>
  </li>

  <li class="dropdown">
    <a class="nav-link menu-title link-nav {{ Route::is('addParentNote')  ||  Route::is('addChildNote') ||  Route::is('sheetAndNotes') || Route::is('presentDocument') || Route::is('dakBranchList.index') || Route::is('dakBranchList.show') || Route::is('createSeal') ? 'active' : '' }}" href="{{ route('dakBranchList.index') }}">
        <i data-feather="mail"></i>
        <span>আগত ডাক</span>
        <sup>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($mainCodeCountHeader) }}</sup>
    </a>

</li>

 <li class="dropdown">
    <a class="nav-link menu-title link-nav {{  Route::is('receiver_dak')  ? 'active' : '' }}" href="{{ route('receiver_dak') }}">
        <i data-feather="mail"></i>
        <span>প্রেরিত ডাক</span>
    </a>
</li>


<li class="dropdown">
    <a class="nav-link menu-title link-nav {{ Route::is('all_dak_list') ? 'active' : '' }}" href="{{ route('all_dak_list') }}">
        <i data-feather="mail"></i>
        <span>সকল ডাক</span>
    </a>
</li>

<li class="dropdown">
    <a class="nav-link menu-title link-nav {{ Route::is('nothiJatDakList') ? 'active' : '' }}" href="{{ route('nothiJatDakList') }}">
        <i data-feather="mail"></i>
        <span>নথি জাত ডাক</span>
    </a>
</li>



@endif



                    @if ($usr->can('receiveNothiAdd') || $usr->can('receiveNothiView') || $usr->can('receiveNothiDelete') || $usr->can('receiveNothiUpdate'))
<li class="sidebar-main-title">
    <div>
      <h6>নথি</h6>
    </div>
  </li>


@if ($usr->can('receiveNothiAdd') || $usr->can('receiveNothiView') || $usr->can('receiveNothiDelete') || $usr->can('receiveNothiUpdate'))
<li class="dropdown">
    <a class="nav-link menu-title link-nav {{  Route::is('receiveNothi.index')  ? 'active' : '' }}" href="{{ route('receiveNothi.index') }}">
        <i data-feather="mail"></i>
        <span>আগত নথি</span>
        <sup>{{ App\Http\Controllers\Admin\CommonController::englishToBangla($totalReceiveNothi) }}</sup>
    </a>
</li>
@endif
@if ($usr->can('sendNothiAdd') || $usr->can('sendNothiView') || $usr->can('sendNothiDelete') || $usr->can('sendNothiUpdate'))
<li class="dropdown">
    <a class="nav-link menu-title link-nav {{  Route::is('sendNothi.index')  ? 'active' : '' }}" href="{{ route('sendNothi.index') }}">
        <i data-feather="file-minus"></i>
        <span>প্রেরিত নথি</span>
    </a>
</li>
@endif
<li class="dropdown">
    <a class="nav-link menu-title link-nav {{  Route::is('givePermissionToNothi') || Route::is('documentPresent.index')  ? 'active' : '' }}" href="{{ route('documentPresent.index') }}">
        <i data-feather="file-text"></i>
        <span>সকল নথি</span>
    </a>
</li>

<li class="dropdown">
    <a class="nav-link menu-title link-nav {{ Route::is('documentPresent.create')  ? 'active' : '' }}" href="{{ route('documentPresent.create') }}">
        <i data-feather="file-text"></i>
        <span>নতুন নথি তৈরী করুন </span>
    </a>
</li>
<li class="dropdown">
    <a class="nav-link menu-title link-nav" href="{{ route('dakBranchList.index') }}">
        <i data-feather="file-plus"></i>
        <span>নথি সিদ্ধান্ত সমূহ</span>
    </a>
</li>





@endif





<li class="sidebar-main-title">
    <div>
      <h6>এনজিও</h6>
    </div>
  </li>

                    @if ($usr->can('register_list_add') || $usr->can('register_list_view') || $usr->can('register_list_delete') || $usr->can('register_list_update'))
                    @if (Route::is('newRegistrationList') ||  Route::is('revisionRegistrationList') || Route::is('alreadyRegistrationList') || Route::is('registrationView'))

                    <li class="dropdown"><a class="nav-link menu-title active" href="javascript:void(0)"><i data-feather="airplay"></i><span>এনজিও নিবন্ধন </span></a>
                        <ul class="nav-submenu menu-content" style="display: block;">
                            <li><a href="{{ route('newRegistrationList') }}"  class="{{ Route::is('newRegistrationList')  ? 'active' : '' }}">নিবন্ধন আবেদন </a></li>
                            <li><a href="{{ route('revisionRegistrationList') }}" class="{{ Route::is('revisionRegistrationList')  ? 'active' : '' }}">নিবন্ধন পুনর্বিবেচনা </a></li>
                            <li><a href="{{ route('alreadyRegistrationList') }}" class="{{ Route::is('alreadyRegistrationList')  ? 'active' : '' }}">নিবন্ধন </a></li>
                        </ul>
                    </li>
@else
<li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="airplay"></i><span>এনজিও নিবন্ধন </span></a>
    <ul class="nav-submenu menu-content">
        <li><a href="{{ route('newRegistrationList') }}"  class="{{ Route::is('newRegistrationList')  ? 'active' : '' }}">নিবন্ধন আবেদন  </a></li>
        <li><a href="{{ route('revisionRegistrationList') }}" class="{{ Route::is('revisionRegistrationList')  ? 'active' : '' }}">নিবন্ধন পুনর্বিবেচনা </a></li>
        <li><a href="{{ route('alreadyRegistrationList') }}" class="{{ Route::is('alreadyRegistrationList')  ? 'active' : '' }}">নিবন্ধন </a></li>
    </ul>
</li>

@endif
@endif



@if ($usr->can('name_change_add') || $usr->can('name_change_view') || $usr->can('name_change_delete') || $usr->can('name_change_update'))
@if (Route::is('newNameChangeList') ||  Route::is('revisionNameChangeList') || Route::is('alreadNameChangeList') || Route::is('nameChangeView'))

<li class="dropdown"><a class="nav-link menu-title active" href="javascript:void(0)"><i data-feather="airplay"></i><span>এনজিও'র নাম পরিবর্তন </span></a>
    <ul class="nav-submenu menu-content" style="display: block;">
        <li><a href="{{ route('newNameChangeList') }}"  class="{{ Route::is('newNameChangeList')  ? 'active' : '' }}"> নাম পরিবর্তনের আবেদন</a></li>
        <li><a href="{{ route('revisionNameChangeList') }}" class="{{ Route::is('revisionNameChangeList')  ? 'active' : '' }}"> নাম পরিবর্তন পুনর্বিবেচনা </a></li>
        <li><a href="{{ route('alreadNameChangeList') }}" class="{{ Route::is('alreadNameChangeList')  ? 'active' : '' }}">নাম পরিবর্তন  </a></li>
    </ul>
</li>
@else
<li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="airplay"></i><span>এনজিও'র নাম পরিবর্তন </span></a>
<ul class="nav-submenu menu-content">
<li><a href="{{ route('newNameChangeList') }}"  class="{{ Route::is('newNameChangeList')  ? 'active' : '' }}"> নাম পরিবর্তনের আবেদন</a></li>
<li><a href="{{ route('revisionNameChangeList') }}" class="{{ Route::is('revisionNameChangeList')  ? 'active' : '' }}">  নাম পরিবর্তন পুনর্বিবেচনা  </a></li>
<li><a href="{{ route('alreadNameChangeList') }}" class="{{ Route::is('alreadNameChangeList')  ? 'active' : '' }}">নাম পরিবর্তন </a></li>
</ul>
</li>

@endif
@endif
@if ($usr->can('renew_add') || $usr->can('renew_view') || $usr->can('renew_delete') || $usr->can('renew_update'))
@if (Route::is('newRenewList') ||  Route::is('revisionRenewList') || Route::is('alreadyRenewList') || Route::is('renewView'))

<li class="dropdown"><a class="nav-link menu-title active" href="javascript:void(0)"><i data-feather="airplay"></i><span>এনজিও নিবন্ধন নবায়ন</span></a>
    <ul class="nav-submenu menu-content" style="display: block;">
        <li><a href="{{ route('newRenewList') }}"  class="{{ Route::is('newRenewList')  ? 'active' : '' }}">নিবন্ধন নবায়ন আবেদন </a></li>
        <li><a href="{{ route('revisionRenewList') }}" class="{{ Route::is('revisionRenewList')  ? 'active' : '' }}">নিবন্ধন নবায়ন পুনর্বিবেচনা</a></li>
        <li><a href="{{ route('alreadyRenewList') }}" class="{{ Route::is('alreadyRenewList')  ? 'active' : '' }}">নিবন্ধন নবায়ন</a></li>
    </ul>
</li>
@else
<li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="airplay"></i><span>এনজিও নিবন্ধন নবায়ন</span></a>
<ul class="nav-submenu menu-content">
<li><a href="{{ route('newRenewList') }}"  class="{{ Route::is('newRenewList')  ? 'active' : '' }}">নিবন্ধন নবায়ন আবেদন </a></li>
<li><a href="{{ route('revisionRenewList') }}" class="{{ Route::is('revisionRenewList')  ? 'active' : '' }}">নিবন্ধন নবায়ন পুনর্বিবেচনা</a></li>
<li><a href="{{ route('alreadyRenewList') }}" class="{{ Route::is('alreadyRenewList')  ? 'active' : '' }}">নিবন্ধন নবায়ন</a></li>
</ul>
</li>

@endif
@endif

@if ($usr->can('fd9FormAdd') || $usr->can('fd9FormView') || $usr->can('fd9FormDelete') || $usr->can('fd9FormUpdate'))
<li class="dropdown">
    <a class="nav-link menu-title link-nav {{ Route::is('fd9Form.index') || Route::is('fd9Form.show') ? 'active' : '' }}" href="{{ route('fd9Form.index') }}">
        <i data-feather="airplay"></i>
        <span>এফডি - ৯ ফরম </span>
    </a>
</li>
@endif
@if ($usr->can('fd9OneFormAdd') || $usr->can('fd9OneFormView') || $usr->can('fd9OneFormDelete') || $usr->can('fd9OneFormUpdate'))
<li class="dropdown">
    <a class="nav-link menu-title link-nav {{ Route::is('fd9OneForm.index') || Route::is('fd9OneForm.show') ? 'active' : '' }}" href="{{ route('fd9OneForm.index') }}">
        <i data-feather="airplay"></i>
        <span>এফডি- ৯.১(ওয়ার্ক পারমিট)</span>
    </a>
</li>
@endif


@if ($usr->can('fd6_formsAdd') || $usr->can('fd6_formsView') || $usr->can('fd6_formsDelete') || $usr->can('fd6_formsUpdate'))
<li class="dropdown">
    <a class="nav-link menu-title link-nav {{ Route::is('fd6Form.index') || Route::is('fd6Form.show') ? 'active' : '' }}" href="{{ route('fd6Form.index') }}">
        <i data-feather="airplay"></i>
        <span>এফডি - ৬ (প্রকল্প প্রস্তাব) </span>
    </a>
</li>
@endif

@if ($usr->can('fd7_formsAdd') || $usr->can('fd7_formsView') || $usr->can('fd7_formsDelete') || $usr->can('fd7_formsUpdate'))
<li class="dropdown">
    <a class="nav-link menu-title link-nav {{ Route::is('fd7Form.index') || Route::is('fd7Form.show') ? 'active' : '' }}" href="{{ route('fd7Form.index') }}">
        <i data-feather="airplay"></i>
        <span>এফডি - ৭ (প্রকল্প প্রস্তাব)</span>
    </a>
</li>
@endif

@if ($usr->can('fc1_formsAdd') || $usr->can('fc1_formsView') || $usr->can('fc1_formsDelete') || $usr->can('fc1_formsUpdate'))
<li class="dropdown">
    <a class="nav-link menu-title link-nav {{ Route::is('fc1PdfDownload') || Route::is('fc1Form.index') || Route::is('fc1Form.show') ? 'active' : '' }}" href="{{ route('fc1Form.index') }}">
        <i data-feather="airplay"></i>
        <span>এফসি - ১</span>
    </a>
</li>
@endif


@if ($usr->can('fc2_formsAdd') || $usr->can('fc2_formsView') || $usr->can('fc2_formsDelete') || $usr->can('fc2_formsUpdate'))
<li class="dropdown">
    <a class="nav-link menu-title link-nav {{ Route::is('fc2Form.index') || Route::is('fc2Form.show') ? 'active' : '' }}" href="{{ route('fc2Form.index') }}">
        <i data-feather="airplay"></i>
        <span>এফসি-২</span>
    </a>
</li>
@endif


@if ($usr->can('fd3_formsAdd') || $usr->can('fd3_formsView') || $usr->can('fd3_formsDelete') || $usr->can('fd3_formsUpdate'))
<li class="dropdown">
    <a class="nav-link menu-title link-nav {{ Route::is('fd3Form.index') || Route::is('fd3Form.show') ? 'active' : '' }}" href="{{ route('fd3Form.index') }}">
        <i data-feather="airplay"></i>
        <span>এফডি - ৩ </span>
    </a>
</li>
@endif


@if ($usr->can('fd5_formsAdd') || $usr->can('fd5_formsView') || $usr->can('fd5_formsDelete') || $usr->can('fd5_formsUpdate'))
<li class="dropdown">
    <a class="nav-link menu-title link-nav {{ Route::is('fd5Form.index') || Route::is('fd5Form.show') ? 'active' : '' }}" href="{{ route('fd5Form.index') }}">
        <i data-feather="airplay"></i>
        <span>এফডি - ৫ </span>
    </a>
</li>
@endif



@if ($usr->can('duplicateCertificateAdd') || $usr->can('duplicateCertificateView') || $usr->can('duplicateCertificateDelete') || $usr->can('duplicateCertificateUpdate'))
{{-- <li class="dropdown">
    <a class="nav-link menu-title link-nav {{ Route::is('duplicateCertificate.index') || Route::is('duplicateCertificate.show') ? 'active' : '' }}" href="{{ route('duplicateCertificate.index') }}">
        <i data-feather="airplay"></i>
        <span>ডুপ্লিকেট সনদপত্রের আবেদন</span>
    </a>
</li> --}}
@endif


@if ($usr->can('constitutionAdd') || $usr->can('constitutionView') || $usr->can('constitutionDelete') || $usr->can('constitutionUpdate'))
{{-- <li class="dropdown">
    <a class="nav-link menu-title link-nav {{ Route::is('constitutionInfo.index') || Route::is('constitutionInfo.show') ? 'active' : '' }}" href="{{ route('constitutionInfo.index') }}">
        <i data-feather="airplay"></i>
        <span>গঠনতন্ত্র পরিবর্তন/অনুমোদনের আবেদন </span>
    </a>
</li> --}}
@endif


@if ($usr->can('executiveCommitteeAdd') || $usr->can('executiveCommitteeView') || $usr->can('executiveCommitteeDelete') || $usr->can('executiveCommitteeUpdate'))
{{-- <li class="dropdown">
    <a class="nav-link menu-title link-nav {{ Route::is('executiveCommitteeInfo.index') || Route::is('executiveCommitteeInfo.show') ? 'active' : '' }}" href="{{ route('executiveCommitteeInfo.index') }}">
        <i data-feather="airplay"></i>
        <span> নির্বাহী কমিটি অনুমোদনের আবেদন</span>
    </a>
</li> --}}
@endif
@if ($usr->can('complainView') || $usr->can('complainDelete') || $usr->can('complainUpdate'))
<li class="sidebar-main-title">
    <div>
      <h6>অভিযোগ বিভাগ</h6>
    </div>
</li>

                      @if (Route::is('allComplain') || Route::is('ongoingComplain') || Route::is('completeComplain') || Route::is('rejectedComplain'))

                      <li class="dropdown">
                        <a class="nav-link menu-title active" href="javascript:void(0)"><i data-feather="list"></i><span>অভিযোগ</span></a>
                        <ul class="nav-submenu menu-content" style="display: block;">





                            <li class="">
                                <a href="{{ route('allComplain') }}" class="{{ Route::is('allComplain')  ? 'active' : '' }}" data-key="t-nft-landing">সকল অভিযোগের তালিকা</a>
                            </li>

                            <li class="">
                                <a href="{{ route('ongoingComplain') }}" class="{{ Route::is('ongoingComplain')  ? 'active' : '' }}" data-key="t-nft-landing">চলমান অভিযোগের তালিকা</a>
                            </li>


                            <li class="">
                                <a href="{{ route('completeComplain') }}" class="{{ Route::is('completeComplain')  ? 'active' : '' }}" data-key="t-nft-landing">সম্পন্ন করা অভিযোগের তালিকা</a>
                            </li>


                            <li class="">
                                <a href="{{ route('rejectedComplain') }}" class="{{ Route::is('rejectedComplain')  ? 'active' : '' }}" data-key="t-nft-landing">বাতিল অভিযোগের তালিকা</a>
                            </li>




                        </ul>
                    </li>
@else
<li class="dropdown">
    <a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="list"></i><span>অভিযোগ</span></a>
    <ul class="nav-submenu menu-content">



        <li class="">
            <a href="{{ route('allComplain') }}" class="{{ Route::is('allComplain')  ? 'active' : '' }}" data-key="t-nft-landing">সকল অভিযোগের তালিকা</a>
        </li>

        <li class="">
            <a href="{{ route('ongoingComplain') }}" class="{{ Route::is('ongoingComplain')  ? 'active' : '' }}" data-key="t-nft-landing">চলমান অভিযোগের তালিকা</a>
        </li>


        <li class="">
            <a href="{{ route('completeComplain') }}" class="{{ Route::is('completeComplain')  ? 'active' : '' }}" data-key="t-nft-landing">সম্পন্ন করা অভিযোগের তালিকা</a>
        </li>


        <li class="">
            <a href="{{ route('rejectedComplain') }}" class="{{ Route::is('rejectedComplain')  ? 'active' : '' }}" data-key="t-nft-landing">বাতিল অভিযোগের তালিকা</a>
        </li>


    </ul>
</li>
@endif
<!-- report end-->

  @endif

@if ($usr->can('humanResoruceView'))
<li class="sidebar-main-title">
    <div>
      <h6>হিউমান রিসোর্স</h6>
    </div>
  </li>


  @if ($usr->can('taskManagerAdd') || $usr->can('taskManagerView') || $usr->can('taskManagerDelete') || $usr->can('taskManagerUpdate'))
<li class="dropdown">
    <a class="nav-link menu-title link-nav {{Route::is('taskManager.edit') || Route::is('taskManager.create') || Route::is('taskManager.index') || Route::is('taskManager.show') ? 'active' : '' }}" href="{{ route('taskManager.index') }}">
        <i data-feather="airplay"></i>
        <span>কার্য ব্যাবস্থাপনা</span>
    </a>
</li>
@endif


@if ($usr->can('eventAdd') || $usr->can('eventView') || $usr->can('eventDelete') || $usr->can('eventUpdate'))
<li class="dropdown">
    <a class="nav-link menu-title link-nav {{Route::is('eventManager.edit') || Route::is('eventManager.create') || Route::is('eventManager.index') || Route::is('eventManager.show') ? 'active' : '' }}" href="{{ route('eventManager.index') }}">
        <i data-feather="airplay"></i>
        <span>ইভেন্ট ম্যানেজমেন্ট</span>
    </a>
</li>
@endif





@endif



@if ($usr->can('employeeEndDate.view') || $usr->can('employeeEndDate.edit') || $usr->can('assignedEmployee.view') || $usr->can('assignedEmployee.edit') || $usr->can('userAdd') || $usr->can('userView') || $usr->can('userDelete') || $usr->can('userUpdate')|| $usr->can('designationAdd') || $usr->can('designationView') ||  $usr->can('designationDelete') ||  $usr->can('designationUpdate') || $usr->can('branchAdd') || $usr->can('branchView') ||  $usr->can('branchDelete') ||  $usr->can('branchUpdate'))
{{-- <li class="sidebar-main-title">
    <div>
      <h6>কর্মকর্তারদের তথ্য</h6>
    </div>
  </li> --}}
<!--empoyee info --->
@if ( Route::is('checkWorkingDay') || Route::is('employeeEndDate') || Route::is('branchList.index') || Route::is('designationList.index') ||  Route::is('user.index') || Route::is('user.create') || Route::is('user.edit')   || Route::is('assignedEmployee.index'))

<li class="dropdown">
  <a class="nav-link menu-title active" href="javascript:void(0)"><i data-feather="users"></i><span>কর্মকর্তাদের তালিকা</span></a>
  <ul class="nav-submenu menu-content" style="display: block;">


    @if ($usr->can('branchAdd') || $usr->can('branchView') ||  $usr->can('branchDelete') ||  $usr->can('branchUpdate'))
<li >
<a href="{{ route('branchList.index') }}" class="{{ Route::is('branchList.index')  ? 'active' : '' }}"><span>শাখার তালিকা</span> </a>
</li>
@endif

@if ($usr->can('designationAdd') || $usr->can('designationView') ||  $usr->can('designationDelete') ||  $usr->can('designationUpdate'))
<li >
<a href="{{ route('designationList.index') }}" class="{{ Route::is('designationList.index')  ? 'active' : '' }}"><span>পদবীর তালিকা</span> </a>
</li>
@endif




      @if ($usr->can('userAdd') || $usr->can('userView') || $usr->can('userDelete') || $usr->can('userUpdate'))
      <li class="">
          <a href="{{ route('user.index') }}" class="{{ Route::is('user.index') || Route::is('user.create') || Route::is('user.edit') ? 'active' : '' }}" data-key="t-one-page">কর্মকর্তাদের তথ্য</a>
      </li>
      @endif

@if ($usr->can('assignedEmployee.view') || $usr->can('assignedEmployee.edit'))
<li >
<a href="{{ route('assignedEmployee.index') }}" class="{{ Route::is('assignedEmployee.index')  ? 'active' : '' }}"><span>কর্মকর্তাদের নিয়োগ তথ্য </span> </a>
</li>
@endif

 @if ($usr->can('employeeEndDate.view') || $usr->can('employeeEndDate.edit'))
          <li class="">
              <a href="{{ route('employeeEndDate') }}" class="{{ Route::is('employeeEndDate') ? 'active' : '' }}" data-key="t-one-page">কর্মকর্তাদের শেষ কর্মদিবস </a>
          </li>
          @endif


          @if ($usr->can('officialWorkingDayView'))
          <li class="">
              <a href="{{ route('checkWorkingDay') }}" class="{{ Route::is('checkWorkingDay') ? 'active' : '' }}" data-key="t-one-page">কর্মকর্তাদের কর্ম দিবস</a>
          </li>
          @endif





  </ul>
</li>
@else
<li class="dropdown">
<a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="users"></i><span>কর্মকর্তাদের তালিকা</span></a>
<ul class="nav-submenu menu-content">


    @if ($usr->can('branchAdd') || $usr->can('branchView') ||  $usr->can('branchDelete') ||  $usr->can('branchUpdate'))
    <li >
    <a href="{{ route('branchList.index') }}" class="{{ Route::is('branchList.index')  ? 'active' : '' }}"><span>শাখার তালিকা</span> </a>
    </li>
    @endif

    @if ($usr->can('designationAdd') || $usr->can('designationView') ||  $usr->can('designationDelete') ||  $usr->can('designationUpdate'))
    <li >
    <a href="{{ route('designationList.index') }}" class="{{ Route::is('designationList.index')  ? 'active' : '' }}"><span>পদবীর তালিকা</span> </a>
    </li>
    @endif




          @if ($usr->can('userAdd') || $usr->can('userView') || $usr->can('userDelete') || $usr->can('userUpdate'))
          <li class="">
              <a href="{{ route('user.index') }}" class="{{ Route::is('user.index') || Route::is('user.create') || Route::is('user.edit') ? 'active' : '' }}" data-key="t-one-page">কর্মকর্তাদের তথ্য </a>
          </li>
          @endif

          @if ($usr->can('assignedEmployee.view') || $usr->can('assignedEmployee.edit'))
          <li >
          <a href="{{ route('assignedEmployee.index') }}" class="{{ Route::is('assignedEmployee.index')  ? 'active' : '' }}"><span>কর্মকর্তাদের নিয়োগ  তথ্য </span> </a>
          </li>
          @endif

   @if ($usr->can('employeeEndDate.view') || $usr->can('employeeEndDate.edit'))
          <li class="">
              <a href="{{ route('employeeEndDate') }}" class="{{ Route::is('employeeEndDate') ? 'active' : '' }}" data-key="t-one-page">কর্মকর্তাদের শেষ কর্মদিবস </a>
          </li>
          @endif



          @if ($usr->can('officialWorkingDayView'))
          <li class="">
              <a href="{{ route('checkWorkingDay') }}" class="{{ Route::is('checkWorkingDay') ? 'active' : '' }}" data-key="t-one-page">কর্মকর্তাদের কর্ম দিবস</a>
          </li>
          @endif








</ul>
</li>

@endif
@endif
<!-- employee info --->


<!--leave management start --->

@if ($usr->can('leaveAdd') || $usr->can('leaveView') || $usr->can('leaveDelete') || $usr->can('leaveUpdate') || $usr->can('sentApplication') || $usr->can('receivedApplication'))
@if (Route::is('leaveManagement.create') || Route::is('leaveManagement.show') || Route::is('leaveManagement.index') || Route::is('leaveManagement.edit') ||  Route::is('sentApplication') || Route::is('receivedApplication'))


<li class="dropdown">
    <a class="nav-link menu-title active" href="javascript:void(0)"><i data-feather="file-text"></i><span>আবেদন পত্র ব্যবস্থাপনা</span></a>
    <ul class="nav-submenu menu-content" style="display: block;">


        @if ($usr->can('leaveView') || $usr->can('leaveDelete') || $usr->can('leaveUpdate'))
        <li >
        <a href="{{ route('leaveManagement.index') }}" class="{{ Route::is('leaveManagement.index') || Route::is('leaveManagement.create') || Route::is('leaveManagement.edit')    ? 'active' : '' }}"><span> সকল আবেদন পত্র</span> </a>
        </li>
        @endif

        @if ($usr->can('sentApplication') || $usr->can('leaveAdd'))
        <li >
        <a href="{{ route('sentApplication') }}" class="{{ Route::is('sentApplication')  ? 'active' : '' }}"><span>প্রেরিত আবেদন পত্র</span> </a>
        </li>
        @endif

        @if ($usr->can('receivedApplication') || $usr->can('leaveAdd'))
        <li class="">
            <a href="{{ route('receivedApplication') }}" class="{{ Route::is('receivedApplication') ? 'active' : '' }}" data-key="t-one-page">প্রাপ্ত আবেদন পত্র</a>
        </li>
        @endif
    </ul>
  </li>

@else

<li class="dropdown">
    <a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="file-text"></i><span>আবেদন পত্র ব্যবস্থাপনা</span></a>
    <ul class="nav-submenu menu-content">

        @if ($usr->can('leaveView') || $usr->can('leaveDelete') || $usr->can('leaveUpdate'))
        <li >
        <a href="{{ route('leaveManagement.index') }}" class="{{ Route::is('leaveManagement.index') || Route::is('leaveManagement.create') || Route::is('leaveManagement.edit')    ? 'active' : '' }}"><span> সকল আবেদন পত্র</span> </a>
        </li>
        @endif

        @if ($usr->can('sentApplication') || $usr->can('leaveAdd'))
        <li >
        <a href="{{ route('sentApplication') }}" class="{{ Route::is('sentApplication')  ? 'active' : '' }}"><span>প্রেরিত আবেদন পত্র</span> </a>
        </li>
        @endif

        @if ($usr->can('receivedApplication') || $usr->can('leaveAdd'))
        <li class="">
            <a href="{{ route('receivedApplication') }}" class="{{ Route::is('receivedApplication') ? 'active' : '' }}" data-key="t-one-page">প্রাপ্ত আবেদন পত্র</a>
        </li>
        @endif

    </ul>
    </li>

@endif
@endif
<!-- leave management end --->

<!-- report start  -->
@if ($usr->can('reportAdd') || $usr->can('reportView') ||  $usr->can('reportDelete') ||  $usr->can('reportUpdate'))

                    <li class="sidebar-main-title">
                        <div>
                          <h6>রিপোর্ট</h6>
                        </div>
                      </li>

                      @if (Route::is('foreignNgoListReport') || Route::is('localNgoListReport') || Route::is('districtWiseListSearch') || Route::is('districtWiseList') || Route::is('districtWiseListResult')  || Route::is('monthlyReportOfNgo') || Route::is('monthlyReportOfNgoSearch') || Route::is('yearlyReportOfNgo') || Route::is('yearlyReportOfNgoSearch') || Route::is('monthlyReportOfNgoRenew') || Route::is('monthlyReportOfNgoRenewSearch') || Route::is('yearlyReportOfNgoRenew') || Route::is('yearlyReportOfNgoRenewSearch')  )

                      <li class="dropdown">
                        <a class="nav-link menu-title active" href="javascript:void(0)"><i data-feather="settings"></i><span>রিপোর্ট </span></a>
                        <ul class="nav-submenu menu-content" style="display: block;">





                            <li class="">
                                <a href="{{ route('districtWiseList') }}" class="{{ Route::is('districtWiseList')  ? 'active' : '' }}" data-key="t-nft-landing">সকল এনজিও'র তালিকা</a>
                            </li>

                            <li class="">
                                <a href="{{ route('localNgoListReport') }}" class="{{ Route::is('localNgoListReport')  ? 'active' : '' }}" data-key="t-nft-landing">দেশি এনজিও'র তালিকা</a>
                            </li>


                            <li class="">
                                <a href="{{ route('foreignNgoListReport') }}" class="{{ Route::is('foreignNgoListReport')  ? 'active' : '' }}" data-key="t-nft-landing">বিদেশি এনজিও'র তালিকা </a>
                            </li>


                            <li class="">
                                <a href="{{ route('monthlyReportOfNgo') }}" class="{{ Route::is('monthlyReportOfNgo') || Route::is('monthlyReportOfNgoSearch')  ? 'active' : '' }}" data-key="t-nft-landing">এনজিও'র  নিবন্ধনের মাসিক রিপোর্ট</a>
                            </li>


                            <li class="">
                                <a href="{{ route('yearlyReportOfNgo') }}" class="{{ Route::is('yearlyReportOfNgo') || Route::is('yearlyReportOfNgoSearch')  ? 'active' : '' }}" data-key="t-nft-landing">এনজিও'র  নিবন্ধনের বার্ষিক রিপোর্ট</a>
                            </li>


                            <li class="">
                                <a href="{{ route('monthlyReportOfNgoRenew') }}" class="{{ Route::is('monthlyReportOfNgoRenew')  || Route::is('monthlyReportOfNgoRenew') ? 'active' : '' }}" data-key="t-nft-landing">এনজিও'র  নিবন্ধন নবায়নের মাসিক রিপোর্ট</a>
                            </li>


                            <li class="">
                                <a href="{{ route('yearlyReportOfNgoRenew') }}" class="{{ Route::is('yearlyReportOfNgoRenew')  ? 'active' : '' }}" data-key="t-nft-landing">এনজিও'র  নিবন্ধন নবায়নের বার্ষিক রিপোর্ট</a>
                            </li>


                        </ul>
                    </li>
@else
<li class="dropdown">
    <a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="settings"></i><span>রিপোর্ট </span></a>
    <ul class="nav-submenu menu-content">



        <li class="">
            <a href="{{ route('districtWiseList') }}" class="{{ Route::is('districtWiseList')  ? 'active' : '' }}" data-key="t-nft-landing">সকল এনজিও'র তালিকা</a>
        </li>

        <li class="">
            <a href="{{ route('localNgoListReport') }}" class="{{ Route::is('localNgoListReport')  ? 'active' : '' }}" data-key="t-nft-landing">দেশি এনজিও'র তালিকা</a>
        </li>


        <li class="">
            <a href="{{ route('foreignNgoListReport') }}" class="{{ Route::is('foreignNgoListReport')  ? 'active' : '' }}" data-key="t-nft-landing">বিদেশি এনজিও'র তালিকা </a>
        </li>
        <li class="">
            <a href="{{ route('monthlyReportOfNgo') }}" class="{{ Route::is('monthlyReportOfNgo')  ? 'active' : '' }}" data-key="t-nft-landing">এনজিও'র  নিবন্ধনের মাসিক রিপোর্ট</a>
        </li>


        <li class="">
            <a href="{{ route('yearlyReportOfNgo') }}" class="{{ Route::is('yearlyReportOfNgo')  ? 'active' : '' }}" data-key="t-nft-landing">এনজিও'র  নিবন্ধনের বার্ষিক রিপোর্ট</a>
        </li>

        <li class="">
            <a href="{{ route('monthlyReportOfNgoRenew') }}" class="{{ Route::is('monthlyReportOfNgoRenew') || Route::is('monthlyReportOfNgoRenewSearch')  ? 'active' : '' }}" data-key="t-nft-landing">এনজিও'র  নিবন্ধন নবায়নের মাসিক রিপোর্ট</a>
        </li>


        <li class="">
            <a href="{{ route('yearlyReportOfNgoRenew') }}" class="{{ Route::is('yearlyReportOfNgoRenew') || Route::is('yearlyReportOfNgoRenewSearch')  ? 'active' : '' }}" data-key="t-nft-landing">এনজিও'র  নিবন্ধন নবায়নের বার্ষিক রিপোর্ট</a>
        </li>

    </ul>
</li>

@endif


@endif
<!-- report end-->

@if ($usr->can('noticeAdd') || $usr->can('noticeView') ||  $usr->can('noticeDelete') ||  $usr->can('noticeUpdate') || $usr->can('countryAdd') || $usr->can('countryView') ||  $usr->can('countryDelete') ||  $usr->can('countryUpdate') || $usr->can('permissionAdd') || $usr->can('permissionView') || $usr->can('permissionDelete') || $usr->can('permissionUpdate') || $usr->can('roleAdd') || $usr->can('roleView') || $usr->can('roleDelete') || $usr->can('roleUpdate') || $usr->can('systemInformationAdd') || $usr->can('systemInformationView') || $usr->can('systemInformationDelete') || $usr->can('systemInformationUpdate'))

                    <li class="sidebar-main-title">
                        <div>
                          <h6>অন্যান্য তথ্য</h6>
                        </div>
                      </li>

                      @if (Route::is('noticeList.index') || Route::is('admin.civil_info') || Route::is('country.index') || Route::is('systemInformation.index') ||  Route::is('user.index') || Route::is('role.index') || Route::is('role.create') || Route::is('role.edit') || Route::is('permission.index'))

                      <li class="dropdown">
                        <a class="nav-link menu-title active" href="javascript:void(0)"><i data-feather="settings"></i><span>সেটিং </span></a>
                        <ul class="nav-submenu menu-content" style="display: block;">

                            @if ($usr->can('systemInformationAdd') || $usr->can('systemInformationView') || $usr->can('systemInformationDelete') || $usr->can('systemInformationUpdate'))
                            <li class="">
                                <a href="{{ route('systemInformation.index') }}" class="{{ Route::is('systemInformation.index') ? 'active' : '' }}" data-key="t-calendar">জেনারেল সেটিং</a>
                            </li>
                            @endif

                            @if ($usr->can('roleAdd') || $usr->can('roleView') || $usr->can('roleDelete') || $usr->can('roleUpdate'))
                            <li class="">
                                <a href="{{ route('role.index') }}" class="{{ Route::is('role.index') || Route::is('role.edit') || Route::is('role.create') ? 'active' : '' }}" data-key="t-nft-landing">রোল</a>
                            </li>
                            @endif
                            @if ($usr->can('permissionAdd') || $usr->can('permissionView') || $usr->can('permissionDelete') || $usr->can('permissionUpdate'))
                            <li class="">
                                <a href="{{ route('permission.index') }}" class="{{ Route::is('permission.index') ? 'active' : '' }}"><span data-key="t-job">পারমিশন</span>
                            </a>
                            </li>
                            @endif




@if ($usr->can('countryAdd') || $usr->can('countryView') ||  $usr->can('countryDelete') ||  $usr->can('countryUpdate'))
<li >
       <a href="{{ route('country.index') }}" class="{{ Route::is('country.index')  ? 'active' : '' }}"><span>দেশের তালিকা</span> </a>
   </li>
@endif

@if ($usr->can('subjectAdd') || $usr->can('subjectView') ||  $usr->can('subjectDelete') ||  $usr->can('subjectUpdate'))
<li >
       <a href="{{ route('projectSubject.index') }}" class="{{ Route::is('projectSubject.index')  ? 'active' : '' }}"><span>প্রজেক্টের বিষয়</span> </a>
   </li>
@endif



@if ($usr->can('noticeAdd') || $usr->can('noticeView') ||  $usr->can('noticeDelete') ||  $usr->can('noticeUpdate'))
<li >
       <a href="{{ route('noticeList.index') }}" class="{{ Route::is('noticeList.index')  ? 'active' : '' }}"><span>নোটিশ বোর্ড</span> </a>
   </li>
@endif


                        </ul>
                    </li>
@else
<li class="dropdown">
    <a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="settings"></i><span>সেটিং </span></a>
    <ul class="nav-submenu menu-content">


        @if ($usr->can('systemInformationAdd') || $usr->can('systemInformationView') || $usr->can('systemInformationDelete') || $usr->can('systemInformationUpdate'))
        <li class="">
            <a href="{{ route('systemInformation.index') }}" class="{{ Route::is('systemInformation.index') ? 'active' : '' }}" data-key="t-calendar">জেনারেল সেটিং</a>
        </li>
        @endif

        @if ($usr->can('roleAdd') || $usr->can('roleView') || $usr->can('roleDelete') || $usr->can('roleUpdate'))
        <li class="">
            <a href="{{ route('role.index') }}" class="{{ Route::is('role.index') || Route::is('role.edit') || Route::is('role.create') ? 'active' : '' }}" data-key="t-nft-landing">রোল</a>
        </li>
        @endif
        @if ($usr->can('permissionAdd') || $usr->can('permissionView') || $usr->can('permissionDelete') || $usr->can('permissionUpdate'))
        <li class="">
            <a href="{{ route('permission.index') }}" class="{{ Route::is('permission.index') ? 'active' : '' }}"><span data-key="t-job">পারমিশন</span>
        </a>
        </li>
        @endif
        @if ($usr->can('countryAdd') || $usr->can('countryView') ||  $usr->can('countryDelete') ||  $usr->can('countryUpdate'))
<li >
       <a href="{{ route('country.index') }}" class="{{ Route::is('country.index')  ? 'active' : '' }}"><span>দেশের তালিকা</span> </a>
   </li>
@endif

@if ($usr->can('subjectAdd') || $usr->can('subjectView') ||  $usr->can('subjectDelete') ||  $usr->can('subjectUpdate'))
<li >
       <a href="{{ route('projectSubject.index') }}" class="{{ Route::is('projectSubject.index')  ? 'active' : '' }}"><span>প্রজেক্টের বিষয়</span> </a>
   </li>
@endif

@if ($usr->can('noticeAdd') || $usr->can('noticeView') ||  $usr->can('noticeDelete') ||  $usr->can('noticeUpdate'))
<li >
       <a href="{{ route('noticeList.index') }}" class="{{ Route::is('noticeList.index')  ? 'active' : '' }}"><span>নোটিশ বোর্ড</span> </a>
   </li>
@endif


    </ul>
</li>

@endif
@endif

                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
    @endif
</header>


