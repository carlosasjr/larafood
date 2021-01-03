<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreEvaluationOrder;
use App\Http\Resources\EvaluationOrderResource;
use App\Services\OrderEvaluationService;
use Illuminate\Http\Request;

class EvaluationApiController extends Controller
{
    /**
     * @var OrderEvaluationService
     */
    private $evaluationService;

    public function __construct(OrderEvaluationService $evaluationService)
    {

        $this->evaluationService = $evaluationService;
    }

    public function store(StoreEvaluationOrder $request, $orderIdentify)
    {
        $data = $request->only(['stars', 'comment']);

        $evaluation = $this->evaluationService->createEvaluationOrder($orderIdentify, $data);

        return new EvaluationOrderResource($evaluation);
    }
}
