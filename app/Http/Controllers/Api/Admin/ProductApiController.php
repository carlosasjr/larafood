<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TenantRequest;
use App\Http\Resources\ProductResource;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    /**
     * @var ProductService
     */
    private $productService;

    public function __construct(ProductService $productService)
    {

        $this->productService = $productService;
    }

    public function index(TenantRequest $request)
    {
        $filterCategories = $request->get('categories', []);

        if (!$products = $this->productService->getProductByTenantUuid($request->token_company, $filterCategories)) {
            return response()->json('Not Found', 404);
        }


        return ProductResource::collection($products);
    }

    public function product(TenantRequest $request, string $uuid)
    {
        if (!$product = $this->productService->getProductByUuid($uuid)) {
            return response()->json('Not Found', 404);
        }

        return new ProductResource($product);
    }
}
