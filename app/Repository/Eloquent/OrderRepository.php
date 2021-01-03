<?php

namespace App\Repository\Eloquent;

use App\Models\Order;
use App\Repository\Contract\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{
    /**
     * @var Order
     */
    private $entity;

    public function __construct(Order $order)
    {
        $this->entity = $order;
    }


    public function createNewOrder(string $identify, float $total, string $status, int $tenantId, $comment, $clientId, $tableId)
    {
        $data = [
            'tenant_id' => $tenantId,
            'identify' => $identify,
            'total' => $total,
            'status' => $status,
            'comment' => $comment,
        ];

        if ($clientId) $data['client_id'] = $clientId;
        if ($tableId) $data['table_id'] = $tableId;

        return $this->entity->create($data);
    }


    public function registerProductsOrder(int $orderId, array $products)
    {
      $order = $this->entity->find($orderId);

      $order->products()->attach(collect($products));
    }

    public function getOrderByIdentify(string $identify)
    {
        return $this->entity->where('identify', $identify)->first();
    }

    public function getOrdersByClientId(int $clientID)
    {
        return $this->entity
                    ->where('client_id', $clientID)
                    ->paginate();
    }
}
