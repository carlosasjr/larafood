<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePermissionRequest;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PermissionController extends Controller
{
    protected $repository;

    public function __construct(Permission  $permission)
    {
        $this->repository = $permission;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $permissions = $this->repository->paginate();

        return view('admin.pages.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.pages.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUpdatePermissionRequest $request
     * @return Response
     */
    public function store(StoreUpdatePermissionRequest $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('permissions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show(int $id)
    {
        if (!$permission = $this->repository->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.permissions.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(int $id)
    {
        if (!$permission = $this->repository->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreUpdatePermissionRequest $request
     * @param int $id
     * @return Response
     */
    public function update(StoreUpdatePermissionRequest $request, int $id)
    {
        if (!$permission = $this->repository->find($id)) {
            return redirect()->back();
        }

        $permission->update($request->all());

        return redirect()->route('permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(int $id)
    {
        if (!$permission = $this->repository->find($id)) {
            return redirect()->back();
        }

        $permission->delete();

        return redirect()->route('permissions.index');
    }

    /**
     * @param Request $request
     */
    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $permissions = $this->repository->search($request->filter);

        return view('admin.pages.permissions.index', compact('permissions', 'filters'));
    }
}
