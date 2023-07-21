<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Exports\PermissionExport;
use App\Imports\PermissionImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;
use DB;

class RoleController extends Controller
{
    public function AllPermission() {
        $permissions = Permission::all();
        return view('backend.pages.permission.all_permission', compact('permissions'));
    }

    public function AddPermission() {
        return view('backend.pages.permission.add_permission');
    }


    public function StorePermission(Request $request) {
        $permission = Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name
        ]);

        $notification = array(
            'message' => 'Permission has been created successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('all.permission')->with($notification);
    }

    public function EditPermission($id) {
        $permissions = Permission::findOrFail($id);
        return view('backend.pages.permission.edit_permission', compact('permissions'));
    }


    public function UpdatePermission(Request $request, $id)
    {
        
        $permission = Permission::findOrFail($id);
            $permission->name = $request->name;
            $permission->group_name = $request->group_name;
            $permission->save();

        $notification = array(
            'message' => 'Permission has been updated successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('all.permission')->with($notification);
    }

    public function DeletePermission($id) {
        Permission::findOrFail($id)->delete();
        
        $notification = array(
            'message' => 'Permission has been deleted successfully!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function importPermission() {
        return view('backend.pages.permission.import_permission');
    }

    public function Export() {
        return Excel::download(new PermissionExport, 'permission.xlsx');
    }

    public function Import(Request $request) {
        Excel::import(new PermissionImport, $request->file('import_file'));

        $notification = array(
            'message' => 'Permission Imported Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }


    ///// Role Method //////

    public function AllRole() {
        $roles = Role::all();
        return view('backend/pages/roles/all_role', compact('roles'));
    }


    public function AddRole() {
        return view('backend/pages/roles/add_role');
    }


    public function StoreRole(Request $request) {
        Role::create([
            'name' => $request->name,
        ]);

        $notification = array(
            'message' => 'Role has been created successfully!',
            'alert-type' => 'success',
        );

        return redirect()->route('all.role')->with($notification);
    }


    public function EditRole($id) {
        $roles = Role::findOrFail($id);
        return view('backend/pages/roles/edit_role', compact('roles'));
    }


    public function UpdateRole(Request $request, $id)
    {
        $role = Role::findOrFail($id);
    
        $role->name = $request->name;
        $role->save();
    
        $notification = [
            'message' => 'Role has been updated successfully!',
            'alert-type' => 'success',
        ];
    
        return redirect()->route('all.role')->with($notification);
    }


    public function DeleteRole($id) {
        $roles = Role::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Role has been deleted successfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }


    ///// Function For Roles in Permission //////

    public function AddRolePermission() {
        $roles = Role::all();
        $permissions = Permission::all();
        $permission_groups = User::getPermissionGroups();
        return view('backend/pages/rolesetup/add_role_permission', compact('roles','permissions','permission_groups'));
    }

    public function RolePermissionStore(Request $request) {
        
        $data = array();
        $permissions = $request->permission;

        foreach($permissions as $key => $item)
        {
            $data['role_id'] = $request->role_id;
            $data['permission_id'] = $item;

            DB::table('role_has_permissions')->insert($data);
        }

        $notification = array(
            'message' => 'Role Permission Added Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('all.role.permission')->with($notification);
    }

    public function AllRolePermission() {
        $roles = Role::all();
        return view('backend/pages/rolesetup/all_role_permission',compact('roles'));
    }

    public function AdminEditRolePermission($id) {
        $roles = Role::findOrFail($id);
        $permissions = Permission::all();
        $permission_groups = User::getPermissionGroups();
        return view('backend/pages/rolesetup/edit_role_permission',compact('roles','permissions','permission_groups'));
    }

    public function AdminRoleUpdate(Request $request, $id) {
        $roles = Role::findOrFail($id);
        $permissions = $request->permission;

        if(!empty($permissions))
        {
            $roles->syncPermissions($permissions);
        }

        
        $notification = array(
            'message' => 'Role Permission Updated Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('all.role.permission')->with($notification);

    }


    public function AdminDeleteRole($id) {
        $roles = Role::findOrFail($id);

        if(!is_null($roles))
        {
            $roles->delete();
        }
        
        $notification = array(
            'message' => 'Role Permission Deleted Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
