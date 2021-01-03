<?php

namespace App\Services;

use App\Repository\Contract\OrderEvaluationRepositoryInterface;
use App\Repository\Contract\OrderRepositoryInterface;

class OrderEvaluationService
{
    /**
     * @var OrderEvaluationRepositoryInterface
     */
    private $orderEvaluation;
    /**
     * @var OrderRepositoryInterface
     */
    private $orderRepository;

    public function __construct(OrderEvaluationRepositoryInterface $orderEvaluation,
OrderRepositoryInterface $orderRepository)
    {

        $this->orderEvaluation = $orderEvaluation;
        $this->orderRepository = $orderRepository;
    }

    public function createEvaluationOrder(string $orderIdentify, array $evaluation)
    {
        $clientId = auth()->user()->id;

        $order = $this->orderRepository->getOrderByIdentify($orderIdentify);

        return $this->orderEvaluation->newEvaluationOrder($order->id, $clientId, $evaluation);
    }
}
