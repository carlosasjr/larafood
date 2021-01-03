<?php

namespace App\Repository\Eloquent;

use App\Models\OrderEvaluation;
use App\Repository\Contract\OrderEvaluationRepositoryInterface;

class OrderEvaluationRepositoryRepository implements OrderEvaluationRepositoryInterface
{

    private $entity;

    public function __construct(OrderEvaluation $orderEvaluation)
    {
        $this->entity = $orderEvaluation;
    }

    public function newEvaluationOrder(int $orderId, int $clientId, array $evaluation)
    {
        $data = [
            'order_id'  => $orderId,
            'client_id' => $clientId,
            'stars'     => $evaluation['stars'],
            'comment'   => isset($evaluation['comment']) ? $evaluation['comment'] : ''
        ];

        return $this->entity->create($data);
    }

    public function getEvaluationsByOrderId(int $orderId)
    {
        return $this->entity->where('order_id', $orderId)->get();
    }

    public function getEvaluationsByClientId(int $clientId)
    {
        return $this->entity->where('client_id', $clientId)->get();
    }

    public function getEvaluationById(int $evaluationId)
    {
        return $this->entity->first($evaluationId);
    }

    public function getEvaluationsByClientIdByOrderId(int $idOrder, int $idClient)
    {
        return $this->entity
            ->where('client_id', $idClient)
            ->where('order_id', $idOrder)
            ->first();
    }
}

