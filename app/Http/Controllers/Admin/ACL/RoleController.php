<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateRoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RoleController extends Controller
{
    protected $repository;

    public function __construct(Role $role)
    {
        $this->middleware('can:roles');

        $this->repository = $role;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $roles = $this->repository->paginate();

        return view('admin.pages.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.pages.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUpdateRoleRequest $request
     * @return Response
     */
    public function store(StoreUpdateRoleRequest $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show(int $id)
    {
        if (!$role = $this->repository->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(int $id)
    {
        if (!$role = $this->repository->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreUpdateRoleRequest $request
     * @param int $id
     * @return Response
     */
    public function update(StoreUpdateRoleRequest $request, int $id)
    {
        if (!$role = $this->repository->find($id)) {
            return redirect()->back();
        }

        $role->update($request->all());

        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(int $id)
    {
        if (!$role = $this->repository->find($id)) {
            return redirect()->back();
        }

        $role->delete();

        return redirect()->route('roles.index');
    }

    /**
     * @param Request $request
     */
    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $roles = $this->repository->search($request->filter);

        return view('admin.pages.roles.index', compact('roles', 'filters'));
    }
}
