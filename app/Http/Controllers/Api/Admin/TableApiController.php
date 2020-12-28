<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\Api\TenantRequest;
use App\Services\TableService;
use App\Http\Controllers\Controller;
use App\Http\Resources\TableResource;
use Illuminate\Http\Request;

class TableApiController extends Controller
{
    /**
     * @var TableService
     */
    private $tableService;

    public function __construct(TableService $tableService)
    {

        $this->tableService = $tableService;
    }


    public function index($uuid)
    {
        if (!$tables = $this->tableService->getTablesByTenantUuid($uuid)) {
            return response()->json('Not Found', 404);
        }

        return TableResource::collection($tables);
    }

    public function show(TenantRequest $request, $uuid)
    {
        if (!$table = $this->tableService->getTableByUuid($uuid)) {
            return response()->json('Not Found', 404);
        }

        return new TableResource($table);
    }

}
