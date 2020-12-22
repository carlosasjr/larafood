<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{

    /**
     * @var User
     */
    private $user;
    /**
     * @var Role
     */
    private $role;

    public function __construct(User $user, Role $role)
    {
        $this->user = $user;
        $this->role = $role;
    }

    public function index(int $id)
    {
        if (!$user = $this->user->find($id)) {
            return redirect()->back();
        }

        $roles = $user->roles()->paginate();

        return view('admin.pages.users.roles.index', compact('user', 'roles'));
    }

    public function create(int $id)
    {
        if (!$user = $this->user->find($id)) {
            return redirect()->back();
        }

        $roles = $user->rolesAvailable();

        return view('admin.pages.users.roles.create', compact('user', 'roles'));
    }

    public function store(Request $request, int $id)
    {
        if (!$user = $this->user->find($id)) {
            return redirect()->back();
        }


        if (!$request->roles || count($request->roles) == 0) {
            return redirect()->back()
                ->with('info', 'Selecione ao menos um cargo');
        }


        $user->roles()->attach($request->roles);

        return redirect()->route('users.roles.index', $user->id);
    }

    public function destroy(int $id, int $idRole)
    {
        $user = $this->user->find($id);
        $role = $this->role->find($idRole);

        if (!$user || !$role) {
            return redirect()->back();
        }

        $user->roles()->detach($role);

        return redirect()->back();
    }

    public function createSearch(Request $request, int $id)
    {
        if (!$user = $this->user->find($id)) {
            return redirect()->back();
        }

        $filters = $request->except('_token');

        $roles = $user->rolesAvailable($request->filter);

        return view('admin.pages.users.roles.create', compact('user', 'roles', 'filters'));
    }
}
