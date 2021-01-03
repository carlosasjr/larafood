<?php

namespace App\Repository\Contract;

interface OrderRepositoryInterface
{
    public function createNewOrder(
        string $identify,
        float $total,
        string $status,
        int $tenantId,
        $comment,
        $clientId,
        $tableId
    );

    public function registerProductsOrder(int $orderId, array $products);

    public function getOrderByIdentify(string $identify);
    public function getOrdersByClientId(int $clientID);
}

