<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateProductRequest;
use App\Models\Product;
use App\Tenant\ManagerTenant;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $repository;

    public function __construct(Product $product)
    {
        $this->repository = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->repository->latest()->paginate();

        return view('admin.pages.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUpdateProductRequest $request
     * @return void
     */
    public function store(StoreUpdateProductRequest $request)
    {
        $data = $request->all();

        if ($request->hasFile('image') && $request->image->isValid()) {
          $tenant = app(ManagerTenant::class)->getTenant();

          $data['image'] =  $request->image->store("tenants/{$tenant->uuid}/products");
        }

        $this->repository->create($data);

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        if (!$product = $this->repository->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        if (!$product = $this->repository->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreUpdateProductRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateProductRequest $request, $id)
    {
        $data = $request->all();

        if (!$product = $this->repository->find($id)) {
            return redirect()->back();
        }

        if ($request->hasFile('image') && $request->image->isValid()) {
            $tenant = app(ManagerTenant::class)->getTenant();

            $data['image'] =  $request->image->store("tenants/{$tenant->uuid}/products");
        }

        $product->update($data);

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        if (!$product = $this->repository->find($id)) {
            return redirect()->back();
        }

        $product->delete();

        return redirect()->route('products.index');
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $products = $this->repository->search($request->filter);

        return view('admin.pages.products.index', compact('products', 'filters'));
    }
}
