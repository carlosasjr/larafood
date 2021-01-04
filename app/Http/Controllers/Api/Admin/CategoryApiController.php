<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TenantRequest;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    /**
     * @var CategoryService
     */
    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {

        $this->categoryService = $categoryService;
    }

    public function categories(TenantRequest $request)
    {
        if (!$categories = $this->categoryService->getCategoriesByTenantUuid($request->token_company)) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        return CategoryResource::collection($categories);
    }

    public function show(TenantRequest $request, $uuid)
    {
        if (!$category = $this->categoryService->getCategoryByUuid($uuid)) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        return new CategoryResource($category);
    }
}
