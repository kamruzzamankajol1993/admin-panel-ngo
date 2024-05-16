@extends('admin.master.master')

@section('title')
রোল তালিকা
@endsection


@section('body')

<div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-sm-6">
          <h3>রোল</h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">হোম</a></li>
            <li class="breadcrumb-item">রোল তালিকা </li>

          </ol>
        </div>
        <div class="col-sm-6">

        </div>
        <div class="col-sm-6">
            @if (Auth::guard('admin')->user()->can('roleAdd'))
            <a href="{{ route('role.create') }}" type="button"  class="btn btn-raised btn-primary waves-effect  btn-sm  mt-5" >রোল যোগ করুন </a>
             @endif
         </div>
        </div>
      </div>
    </div>
        <!-- end page title -->
        <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                  <div class="card-body">
                        @include('flash_message')
                        <table id="basic-1" class="display table table-bordered" style="width:100%">
                            <thead>
                                <tr>

                                        <th>ক্র: নং:</th>
                                        <th>রোল এর নাম </th>
                                        <th >পারমিশন তালিকা </th>
                                        <th>কার্যকলাপ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)

                                <tr>
                                   <td>

                                    {{ $loop->index+1 }}

                                    <td>{{ $role->name }}</td>
                                    <td >



                                        @foreach ($role->permissions as $key=>$perm)


                                        @if(($key+1) == 6)
                                            {{ $perm->name }},<br>

                                            @elseif(($key+1) == 12)
                                            {{ $perm->name }},<br>
                                            @elseif(($key+1) == 18)
                                            {{ $perm->name }},<br>
                                            @elseif(($key+1) == 24)

                                            {{ $perm->name }},<br>
                                            @elseif(($key+1) == 30)
                                            {{ $perm->name }},<br>

                                            @elseif(($key+1) == 36)
                                            {{ $perm->name }},<br>

                                            @elseif(($key+1) == 42)
                                            {{ $perm->name }},<br>

                                            @elseif(($key+1) == 48)
                                            {{ $perm->name }},<br>

                                            @elseif(($key+1) == 54)
                                            {{ $perm->name }},<br>

                                            @elseif(($key+1) == 60)
                                            {{ $perm->name }},<br>

                                            @else
                                            {{ $perm->name }},
                                            @endif


                                        @endforeach

                                    </td>

                                                <td>


                                                    <button type="button"  onclick="location.href = '{{ route('role.edit',$role->id) }}';"
                                                        class="btn btn-primary waves-light waves-effect  btn-sm mt-2" >
                                                        <i class="fa fa-pencil"></i></button>





                                                        <button type="button" class="btn-sm btn btn-danger waves-light waves-effect mt-2" onclick="deleteTag({{ $role->id }})"><i class="fa fa-trash-o"></i></button>

 <form id="delete-form-{{ $role->id }}" action="{{ route('role.destroy',$role->id) }}" method="POST" style="display: none;">
  @method('DELETE')
                                                    @csrf

                                                </form>


                                                </td>
                                            </tr>
                                          @endforeach

                        </table>
                    </div>
                </div>
            </div>
        </div><!--end row-->
    </div>
</div>
@endsection

@section('script')
@endsection
