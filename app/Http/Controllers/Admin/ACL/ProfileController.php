<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateProfilesRequest;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProfileController extends Controller
{
    protected $repository;

    public function __construct(Profile $profile)
    {
        $this->repository = $profile;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $profiles = $this->repository->paginate();

        return view('admin.pages.profiles.index', compact('profiles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.pages.profiles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUpdateProfilesRequest $request
     * @return Response
     */
    public function store(StoreUpdateProfilesRequest $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('profiles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show(int $id)
    {
        if (!$profile = $this->repository->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.profiles.show', compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(int $id)
    {
        if (!$profile = $this->repository->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.profiles.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(StoreUpdateProfilesRequest $request, int $id)
    {
        if (!$profile = $this->repository->find($id)) {
            return redirect()->back();
        }

        $profile->update($request->all());

        return redirect()->route('profiles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(int $id)
    {
        if (!$profile = $this->repository->find($id)) {
            return redirect()->back();
        }

        $profile->delete();

        return redirect()->route('profiles.index');
    }

    /**
     * @param Request $request
     */
    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $profiles = $this->repository->search($request->filter);

        return view('admin.pages.profiles.index', compact('profiles', 'filters'));
    }
}
