<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateUsersRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $repository;

    public function __construct(User $user)
    {
        $this->middleware('can:users');

        $this->repository = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = $this->repository->latest()->tenantUser()->paginate();

        return view('admin.pages.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUpdateUsersRequest $request
     * @return RedirectResponse
     */
    public function store(StoreUpdateUsersRequest $request)
    {
        $data = $request->all();
        $data['tenant_id'] = auth()->user()->tenant_id;;
        $data['password'] = bcrypt($data['password']);

        $this->repository->create($data);

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show(int $id)
    {
        if (!$user = $this->repository->tenantUser()->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(int $id)
    {
        if (!$user = $this->repository->tenantUser()->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(StoreUpdateUsersRequest $request, int $id)
    {
        if (!$user = $this->repository->tenantUser()->find($id)) {
            return redirect()->back();
        }

        $data = $request->only(['name', 'email']);

        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(int $id)
    {
        if (!$user = $this->repository->tenantUser()->find($id)) {
            return redirect()->back();
        }

        $user->delete();

        return redirect()->route('users.index');
    }

    /**
     * @param Request $request
     */
    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $users = $this->repository->search($request->filter);

        return view('admin.pages.users.index', compact('users', 'filters'));
    }
}
