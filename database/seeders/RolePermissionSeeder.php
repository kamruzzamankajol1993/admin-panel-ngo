<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // Create Roles
        $roleSuperAdmin = Role::create(['name' => 'superadmin']);
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleEditor = Role::create(['name' => 'editor']);
        $roleUser = Role::create(['name' => 'user']);


        // Permission List as array
        $permissions = [

            [
                'group_name' => 'dashboard',
                'permissions' => [
                    'dashboard.view',
                    'dashboard.edit',
                ]
            ],
            [
                'group_name' => 'employeeEndDate',
                'permissions' => [
                    'employeeEndDate.view',
                    'employeeEndDate.edit',
                ]
            ],
            [
                'group_name' => 'assignedEmployee',
                'permissions' => [
                    'assignedEmployee.view',
                    'assignedEmployee.edit',
                ]
            ],
            [
                'group_name' => 'systemInformation',
                'permissions' => [
                    'systemInformationAdd',
                    'systemInformationView',
                    'systemInformationDelete',
                    'systemInformationUpdate',
                ]
            ],
            [
                'group_name' => 'country',
                'permissions' => [
                    'countryAdd',
                    'countryView',
                    'countryDelete',
                    'countryUpdate',
                ]
            ],
            [
                'group_name' => 'notice',
                'permissions' => [
                    'noticeAdd',
                    'noticeView',
                    'noticeDelete',
                    'noticeUpdate',
                ]
            ],
            [
                'group_name' => 'post',
                'permissions' => [
                    'postAdd',
                    'postView',
                    'postDelete',
                    'postUpdate',
                ]
            ],
            [
                'group_name' => 'fd9Form',
                'permissions' => [
                    'fd9FormAdd',
                    'fd9FormView',
                    'fd9FormDelete',
                    'fd9FormUpdate',
                ]
            ],
            [
                'group_name' => 'branch',
                'permissions' => [
                    'branchAdd',
                    'branchView',
                    'branchDelete',
                    'branchUpdate',
                ]
            ],
            [
                'group_name' => 'designation',
                'permissions' => [
                    'designationAdd',
                    'designationView',
                    'designationDelete',
                    'designationUpdate',
                ]
            ],
            [
                'group_name' => 'designationStep',
                'permissions' => [
                    'designationStepAdd',
                    'designationStepView',
                    'designationStepDelete',
                    'designationStepUpdate',
                ]
            ],
            [
                'group_name' => 'fd9OneForm',
                'permissions' => [
                    'fd9OneFormAdd',
                    'fd9OneFormView',
                    'fd9OneFormDelete',
                    'fd9OneFormUpdate',
                ]
            ],
            [
                'group_name' => 'nameChange',
                'permissions' => [
                    'name_change_add',
                    'name_change_view',
                    'name_change_delete',
                    'name_change_update',
                ]
            ],
            [
                'group_name' => 'registrationList',
                'permissions' => [
                    'register_list_add',
                    'register_list_view',
                    'register_list_delete',
                    'register_list_update',
                ]
            ],
            [
                'group_name' => 'renew',
                'permissions' => [
                    'renew_add',
                    'renew_view',
                    'renew_delete',
                    'renew_update',
                ]
            ],
            [
                'group_name' => 'user',
                'permissions' => [
                    'userAdd',
                    'userView',
                    'userDelete',
                    'userUpdate',
                ]
            ],
            [
                'group_name' => 'role',
                'permissions' => [
                    'roleAdd',
                    'roleView',
                    'roleDelete',
                    'roleUpdate',
                ]
            ],
            [
                'group_name' => 'permission',
                'permissions' => [
                    'permissionAdd',
                    'permissionView',
                    'permissionDelete',
                    'permissionUpdate',
                ]
            ],
            [
                'group_name' => 'profile',
                'permissions' => [
                    // profile Permissions
                    'profile.view',
                    'profile.edit',
                ]
            ],
        ];


        // Create and Assign Permissions
        for ($i = 0; $i < count($permissions); $i++) {
            $permissionGroup = $permissions[$i]['group_name'];
            for ($j = 0; $j < count($permissions[$i]['permissions']); $j++) {
                // Create Permission
                $permission = Permission::create(['name' => $permissions[$i]['permissions'][$j], 'group_name' => $permissionGroup]);
                $roleSuperAdmin->givePermissionTo($permission);
                $permission->assignRole($roleSuperAdmin);
            }
        }
    }
}
