<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * @var Category
     */
    private $repository;

    public function __construct(Category $category)
    {
        $this->middleware('can:categories');

        $this->repository = $category;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->repository->latest()->paginate();

        return view('admin.pages.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUpdateCategoryRequest $request
     * @return void
     */
    public function store(StoreUpdateCategoryRequest $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        if (!$category = $this->repository->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        if (!$category = $this->repository->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateCategoryRequest $request, $id)
    {
        if (!$category = $this->repository->find($id)) {
            return redirect()->back();
        }

        $category->update($request->all());

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        if (!$category = $this->repository->find($id)) {
            return redirect()->back();
        }

        $category->delete();

        return redirect()->route('categories.index');
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $categories = $this->repository->search($request->filter);

        return view('admin.pages.categories.index', compact('categories', 'filters'));
    }
}
