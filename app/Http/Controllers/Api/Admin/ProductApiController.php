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

    public function index(Request $request, $uuid)
    {
        $filterCategories = $request->get('categories', []);

        if (!$products = $this->productService->getProductByTenantUuid($uuid, $filterCategories)) {
            return response()->json('Not Found', 404);
        }


        return ProductResource::collection($products);
    }

    public function product(TenantRequest $request, string $url)
    {
        if (!$product = $this->productService->getProductByUrl($url)) {
            return response()->json('Not Found', 404);
        }

        return new ProductResource($product);
    }
}
