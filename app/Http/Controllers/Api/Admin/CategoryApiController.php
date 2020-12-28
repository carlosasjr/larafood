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

    public function categories($uuid)
    {
        if (!$categories = $this->categoryService->getCategoriesByTenantUuid($uuid)) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        return CategoryResource::collection($categories);
    }

    public function show(TenantRequest $request, $url)
    {
        if (!$category = $this->categoryService->getCategoryByUrl($url)) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        return new CategoryResource($category);
    }
}
