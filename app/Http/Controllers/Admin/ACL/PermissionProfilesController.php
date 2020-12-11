<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Profile;
use Illuminate\Http\Request;

class PermissionProfilesController extends Controller
{
    /**
     * @var Profile
     */
    private $profile;
    /**
     * @var Permission
     */
    private $permission;

    /**
     * ProfilePermissionsController constructor.
     * @param Permission $permission
     * @param Profile $profile
     */

    public function __construct(Permission $permission, Profile $profile)
    {
        $this->permission = $permission;
        $this->profile = $profile;
    }

    public function index(int $id)
    {
        if (!$permission = $this->permission->find($id)) {
            return redirect()->back();
        }

        $profiles = $permission->profiles()->paginate();

        return view('admin.pages.permissions.profiles.index', compact('profiles', 'permission'));
    }
}
