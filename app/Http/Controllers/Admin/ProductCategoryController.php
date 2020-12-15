<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\product;
use Illuminate\Http\Request;

class productCategoryController extends Controller
{

    /**
     * @var Product
     */
    private $product;
    /**
     * @var Category
     */
    private $category;

    public function __construct(Product $product, Category $category)
    {

        $this->product = $product;
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @param int $id
     * @return void
     */
    public function index(int $id)
    {
        if (!$product = $this->product->find($id)) {
            return redirect()->back();
        }

        $categories = $product->categories()->paginate();

        return view('admin.pages.products.categories.index', compact('product', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function create(int $id)
    {
        if (!$product = $this->product->find($id)) {
            return redirect()->back();
        }


        $categories = $product->categoriesAvailable();


        return view('admin.pages.products.categories.create', compact('product', 'categories'));
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
        if (!$product = $this->product->find($id)) {
            return redirect()->back();
        }


        if (!$request->categories || count($request->categories) == 0) {
            return redirect()->back()
                ->with('info', 'Selecione ao menos uma categoria');
        }

        $product->categories()->attach($request->categories);

        return redirect()->route('products.categories.index', $id);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @param int $categoryId
     * @return void
     */
    public function destroy(int $id, int $categoryId)
    {
        $product = $this->product->find($id);
        $category = $this->category->find($categoryId);


        if (!$product || !$category) {
            return redirect()->back();
        }

        $product->categories()->detach($category);


        return redirect()->back();
    }

    public function createSearch(Request $request, int $id)
    {
        if (!$product = $this->product->find($id)) {
            return redirect()->back();
        }

        $filters = $request->except('_token');

        $categories = $product->categoriesAvailable($request->filter);

        return view('admin.pages.products.categories.create', compact('product', 'categories', 'filters'));
    }
}
