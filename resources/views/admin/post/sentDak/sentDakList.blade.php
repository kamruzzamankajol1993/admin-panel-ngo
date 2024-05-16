@extends('admin.master.master')

@section('title')
প্রেরিত ডাক তালিকা | {{ $ins_name }}
@endsection


@section('css')

@endsection

@section('body')
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <h3>প্রেরিত ডাক তালিকা</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">হোম</a></li>
                    <li class="breadcrumb-item">ডাক </li>
                    <li class="breadcrumb-item">প্রেরিত ডাক তালিকা</li>
                </ol>
            </div>
            <div class="col-sm-6">
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
                    <ul class="nav nav-dark" id="pills-darktab" role="tablist">
                        <li class="nav-item"><a class="nav-link active" id="pills-darkhome-tab" data-bs-toggle="pill" href="#pills-darkhome" role="tab" aria-controls="pills-darkhome" aria-selected="true"><i class="icofont icofont-ui-home"></i>ডাক</a></li>
                    </ul>
                    <div class="tab-content" id="pills-darktabContent">
                        <div class="tab-pane fade show active" id="pills-darkhome" role="tabpanel" aria-labelledby="pills-darkhome-tab">
                            <div class="table-responsive product-table mb-0 m-t-30">
                                <table class="display" id="basic-1">
                                    <tbody>

                                 @include('admin.post.sentDak.sentRegistrationDakList')

                                 @include('admin.post.sentDak.sentRenewDakList')

                                 @include('admin.post.sentDak.sentNameChangeDakList')

                                 @include('admin.post.sentDak.sentFdNineDakList')
                                 @include('admin.post.sentDak.sentFdNineOneDakList')


                                 @include('admin.post.sentDak.sentFdSixDakList')
                                 @include('admin.post.sentDak.sentFdSevenDakList')

                                 @include('admin.post.sentDak.sentFcOneDakList')

                                 @include('admin.post.sentDak.sentFcTwoDakList')

                                 @include('admin.post.sentDak.sentFdThreeDakList')


                                 @include('admin.post.sentDak.sentDuplicateCertificateList')


                                 @include('admin.post.sentDak.sentConstitutionList')

                                 @include('admin.post.sentDak.sentExecutiveCommitteeList')

                                 @include('admin.post.sentDak.sentFdFiveDakList')

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Individual column searching (text inputs) Ends-->
    </div>
</div>
<!-- Container-fluid Ends-->
@endsection


@section('script')

@include('admin.post.script')


<script>
    .modal:nth-of-type(even) {
        z-index: 1062 !important;
    }
    .modal-backdrop.show:nth-of-type(even) {
        z-index: 1061 !important;
    }
</script>
@endsection
