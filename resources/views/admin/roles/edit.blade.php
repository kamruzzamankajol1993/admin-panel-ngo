
@extends('admin.master.master')

@section('title')
রোল আপডেট করুন
@endsection


@section('body')

<div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-sm-6">
          <h3>রোল</h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">হোম</a></li>
            <li class="breadcrumb-item">রোল আপডেট করুন </li>

          </ol>
        </div>
        <div class="col-sm-6">

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

                                  <form action="{{ route('role.update',$role->id) }}" method="POST" id="form">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">রোল এর নাম </label>
        <input type="text" class="form-control form-control-sm" id="name" value="{{ $role->name }}" name="name" placeholder="রোল এর নাম">

                        </div>

                        <div class="form-group mt-3">
<input type="checkbox" id="checkPermissionAll" value="1" class="filled-in" {{  App\Models\Admin::roleHasPermissions($role, $all_permissions) ? 'checked' : '' }} />
                            <label for="checkPermissionAll">All</label>
                      </div>
                      <hr>
                       @php $i = 1; @endphp
                            @foreach ($permission_groups as $group)
                            @php
                                        $permissions =  App\Models\Admin::getpermissionsByGroupName($group->name);
                                        $j = 1;
                                    @endphp
                      <div class="row">
                          <div class="col-md-3">
                              <div class="form-group">
<input type="checkbox" id="{{ $i }}Management" value="{{ $group->name }}"  onclick="checkPermissionByGroup('role-{{ $i }}-management-checkbox', this)" {{  App\Models\Admin::roleHasPermissions($role, $permissions) ? 'checked' : '' }} class="filled-in"  />
                            <label for="checkPermission">{{ $group->name }}</label>
                              </div>
                          </div>
                          <div class="col-md-9 role-{{ $i }}-management-checkbox">

                                          @foreach ($permissions as $permission)
                              <div class="form-group">


<input type="checkbox" onclick="checkSinglePermission('role-{{ $i }}-management-checkbox', '{{ $i }}Management', {{ count($permissions) }})" name="permissions[]" {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }} id="checkPermission{{ $permission->id }}" value="{{ $permission->name }}" class="filled-in" />
                            <label for="checkPermission{{ $permission->id }}">{{ $permission->name }}</label>


                          </div>

                               @php  $j++; @endphp
                              @endforeach
                          </div>
                      </div>
                          @php  $i++; @endphp
                          <hr style="height: 2px;
    background: cornflowerblue;">
                            @endforeach


                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">আপডেট করুন </button>
                    </form>

                                    </div>

                                </div>
                            </div>







                        </div> <!-- end col -->



                    </div>
</div>

@endsection
@section('script')

     <script>
    /**
         * Check all the permissions
         */
         $("#checkPermissionAll").click(function(){
             if($(this).is(':checked')){
                 // check all the checkbox
                 $('input[type=checkbox]').prop('checked', true);
             }else{
                 // un check all the checkbox
                 $('input[type=checkbox]').prop('checked', false);
             }
         });
         function checkPermissionByGroup(className, checkThis){
            const groupIdName = $("#"+checkThis.id);
            const classCheckBox = $('.'+className+' input');
            if(groupIdName.is(':checked')){
                 classCheckBox.prop('checked', true);
             }else{
                 classCheckBox.prop('checked', false);
             }
            implementAllChecked();
         }
         function checkSinglePermission(groupClassName, groupID, countTotalPermission) {
            const classCheckbox = $('.'+groupClassName+ ' input');
            const groupIDCheckBox = $("#"+groupID);
            // if there is any occurance where something is not selected then make selected = false
            if($('.'+groupClassName+ ' input:checked').length == countTotalPermission){
                groupIDCheckBox.prop('checked', true);
            }else{
                groupIDCheckBox.prop('checked', false);
            }
            implementAllChecked();
         }
         function implementAllChecked() {
             const countPermissions = {{ count($all_permissions) }};
             const countPermissionGroups = {{ count($permission_groups) }};
            //  console.log((countPermissions + countPermissionGroups));
            //  console.log($('input[type="checkbox"]:checked').length);
             if($('input[type="checkbox"]:checked').length >= (countPermissions + countPermissionGroups)){
                $("#checkPermissionAll").prop('checked', true);
            }else{
                $("#checkPermissionAll").prop('checked', false);
            }
         }
</script>

@endsection









