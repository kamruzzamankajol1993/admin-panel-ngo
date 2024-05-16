@extends('admin.master.master')

@section('title')
আগত ডাক তালিকা | {{ $ins_name }}
@endsection


@section('css')

@endsection

@section('body')
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <h3>আগত ডাক তালিকা</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">হোম</a></li>
                    <li class="breadcrumb-item">ডাক </li>
                    <li class="breadcrumb-item">আগত ডাক তালিকা</li>
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


                                      @include('admin.post.registrationDakFirstStep')

                                      @include('admin.post.renewDakFirstStep')


                                      @include('admin.post.nameChangeDakFirstStep')


                                      @include('admin.post.fdNineDakFirstStep')


                                      @include('admin.post.fdNineOneDakFirstStep')


                                      @include('admin.post.fdSixDakFirstStep')


                                      @include('admin.post.fdSevenDakFirstStep')

                                      @include('admin.post.fcOneDakFirstStep')


                                      @include('admin.post.fcTwoDakFirstStep')


                                      @include('admin.post.fdThreeDakFirstStep')

                                      @include('admin.post.fdFiveDakFirstStep')

                                      @include('admin.post.duplicateCertificateDakFirstStep')

                                      @include('admin.post.contitutionDakFirstStep')

                                      @include('admin.post.executiveCommitteeDakFirstStep')

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

@endsection
