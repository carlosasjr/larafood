<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\TenantResource;
use App\Services\TenantService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TenantApiController extends Controller
{
    /**
     * @var TenantService
     */
    private $tenantService;

    public function __construct(TenantService $tenantService)
    {

        $this->tenantService = $tenantService;
    }


    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $per_page = (int) $request->get('per_page', 15);

        $tenants = $this->tenantService->getAll($per_page);

        return TenantResource::collection($tenants);
    }


    /**
     * Display the specified resource.
     *
     * @param $uuid
     * @return TenantResource
     */
    public function show($uuid)
    {
       if (!$tenant = $this->tenantService->getTenantByUuid($uuid)) {
           return response()->json(['message' => 'Not Found'], 404);
       }

         return new TenantResource($tenant);
    }

}
