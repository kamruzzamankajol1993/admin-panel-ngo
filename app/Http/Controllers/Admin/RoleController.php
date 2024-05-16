<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
class RoleController extends Controller
{


    public $user;


    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }


    public function index()
    {

        if (is_null($this->user) || !$this->user->can('roleView')) {
            //abort(403, 'Sorry !! You are Unauthorized to View !');
            return redirect()->route('error_404');
               }

               \LogActivity::addToLog('Role List.');

        $permissions = Permission::all();
        $roles = Role::all();
        $permission_groups = Admin::getpermissionGroups();
        return view('admin.roles.index', compact('roles','permissions','permission_groups'));
    }


    public function create()
    {

        if (is_null($this->user) || !$this->user->can('roleAdd')) {
            ///abort(403, 'Sorry !! You are Unauthorized to View !');
            return redirect()->route('error_404');
               }

               \LogActivity::addToLog('Create Role.');

        $all_permissions  = Permission::all();
        $permission_groups = Admin::getpermissionGroups();
        return view('admin.roles.create', compact('all_permissions', 'permission_groups'));
    }



    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('roleAdd')) {
            //abort(403, 'Sorry !! You are Unauthorized to View !');
            return redirect()->route('error_404');
               }

               \LogActivity::addToLog('Store Role.');

        // Validation Data
        $request->validate([
            'name' => 'required|string|max:100|unique:roles'
        ], [
            'name.requried' => 'Please give a role name'
        ]);

        // Process Data
        $role = Role::create(['name' => $request->name,'guard_name'=>'admin']);
        $permissions = $request->input('permissions');

        if (!empty($permissions)) {
            $role->syncPermissions($permissions);
        }

        return redirect()->route('role.index')->with('success','Created successfully!');
    }


    public function edit($id)
    {

        if (is_null($this->user) || !$this->user->can('roleUpdate')) {
            //abort(403, 'Sorry !! You are Unauthorized to View !');
            return redirect()->route('error_404');
               }

               \LogActivity::addToLog('View Role Edit Page.');
        $role = Role::findById($id,'admin');
        $all_permissions = Permission::all();
        $permission_groups = Admin::getpermissionGroups();
        return view('admin.roles.edit', compact('role', 'all_permissions', 'permission_groups'));
    }


    public function update(Request $request,$id)
    {

        if (is_null($this->user) || !$this->user->can('roleUpdate')) {
            //abort(403, 'Sorry !! You are Unauthorized to View !');
            return redirect()->route('error_404');
               }

               \LogActivity::addToLog('Update Role.');

        $role = Role::find($id);
        $permissions = $request->input('permissions');

        if (!empty($permissions)) {
            $role->name = $request->name;
            $role->save();
            $role->syncPermissions($permissions);
        }


        return redirect()->route('role.index')->with('success','Updated successfully!');
    }

    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->can('roleDelete')) {
            //abort(403, 'Sorry !! You are Unauthorized to View !');
            return redirect()->route('error_404');
               }

               \LogActivity::addToLog('Delete Role.');

        $role = Role::findById($id,'admin');
        if (!is_null($role)) {
            $role->delete();
        }


        return redirect()->route('role.index')->with('error','Deleted successfully!');
    }
}
