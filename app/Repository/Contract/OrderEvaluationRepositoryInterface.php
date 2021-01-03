<?php

namespace App\Repository\Contract;

interface OrderEvaluationRepositoryInterface
{
    public function newEvaluationOrder(int $orderId, int $clientId, array $evaluation);
    public function getEvaluationsByOrderId(int $orderId);
    public function getEvaluationsByClientId(int $clientId);
    public function getEvaluationById(int $evaluationId);
    public function getEvaluationsByClientIdByOrderId(int $idOrder, int $idClient);
}

