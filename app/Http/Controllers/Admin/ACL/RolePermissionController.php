<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RolePermissionController extends Controller
{

    /**
     * @var Role
     */
    private $role;
    /**
     * @var Permission
     */
    private $permission;

    /**
     * rolerolesController constructor.
     * @param Role $role
     * @param Permission $permission
     */
    public function __construct(Role $role, Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
    }

    /**
     * Display a listing of the resource.
     *
     * @param int $id
     * @return void
     */
    public function index(int $id)
    {
        if (!$role = $this->role->find($id)) {
            return redirect()->back();
        }

        $permissions = $role->permissions()->paginate();


        return view('admin.pages.roles.permissions.index', compact('role', 'permissions'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @param int $id
     * @return void
     */
    public function create(int $id)
    {
        if (!$role = $this->role->find($id)) {
            return redirect()->back();
        }

        $permissions = $role->permissionsAvailable();

        return view('admin.pages.roles.permissions.create', compact('role', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return void
     */
    public function store(Request $request, int $id)
    {
        if (!$role = $this->role->find($id)) {
            return redirect()->back();
        }


        if (!$request->permissions || count($request->permissions) == 0) {
            return redirect()->back()
                ->with('info', 'Selecione ao menos uma permissão');
        }


        $role->permissions()->attach($request->permissions);

        return redirect()->route('roles.permissions.index', $role->id);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @param int $idPermission
     * @return void
     */
    public function destroy(int $id, int $idPermission)
    {
        $role = $this->role->find($id);
        $permission = $this->permission->find($idPermission);

        if (!$role || !$permission) {
            return redirect()->back();
        }

        $role->permissions()->detach($permission);

        return redirect()->back();
    }

    public function createSearch(Request $request, int $id)
    {
        if (!$role = $this->role->find($id)) {
            return redirect()->back();
        }

        $filters = $request->except('_token');

        $permissions = $role->permissionsAvailable($request->filter);

        return view('admin.pages.roles.permissions.create', compact('role', 'permissions', 'filters'));
    }
}
