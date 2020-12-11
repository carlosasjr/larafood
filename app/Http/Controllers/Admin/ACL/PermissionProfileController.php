<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Profile;
use Illuminate\Http\Request;

class PermissionProfileController extends Controller
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
     * PermissionProfileController constructor.
     * @param Profile $profile
     * @param Permission $permission
     */
    public function __construct(Profile $profile, Permission $permission)
    {

        $this->profile = $profile;
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
        if (!$profile = $this->profile->find($id)) {
            return redirect()->back();
        }

        $permissions = $profile->permissions()->paginate();


        return view('admin.pages.profiles.permissions.index', compact('profile', 'permissions'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @param int $id
     * @return void
     */
    public function create(int $id)
    {
        if (!$profile = $this->profile->find($id)) {
            return redirect()->back();
        }

        $permissions = $profile->permissionsAvailable();

        return view('admin.pages.profiles.permissions.create', compact('profile', 'permissions'));
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
        if (!$profile = $this->profile->find($id)) {
            return redirect()->back();
        }


        if (!$request->permissions || count($request->permissions) == 0) {
            return redirect()->back()
                             ->with('info', 'Selecione ao menos uma permissão');
        }


        $profile->permissions()->attach($request->permissions);

        return redirect()->route('profiles.permissions.index', $profile->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function createSearch(Request $request, int $id)
    {
        if (!$profile = $this->profile->find($id)) {
            return redirect()->back();
        }

        $filters = $request->except('_token');

        $permissions = $profile->permissionsAvailable($request->filter);

        return view('admin.pages.profiles.permissions.create', compact('profile', 'permissions', 'filters'));
    }
}