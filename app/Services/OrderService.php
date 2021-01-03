<?php

namespace App\Services;

use App\Repository\Contract\OrderRepositoryInterface;
use App\Repository\Contract\ProductRepositoryInterface;
use App\Repository\Contract\TableRepositoryInterface;
use App\Repository\Contract\TenantRepositoryInterface;
use Illuminate\Support\Str;

class OrderService
{
    /**
     * @var OrderRepositoryInterface
     */
    private $orderRepository;
    /**
     * @var TenantRepositoryInterface
     */
    private $tenantRepository;
    /**
     * @var TableRepositoryInterface
     */
    private $tableRepository;
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        TenantRepositoryInterface $tenantRepository,
        TableRepositoryInterface $tableRepository,
        ProductRepositoryInterface $productRepository
    ) {
        $this->orderRepository = $orderRepository;
        $this->tenantRepository = $tenantRepository;
        $this->tableRepository = $tableRepository;
        $this->productRepository = $productRepository;
    }

    public function createNewOrder(array $data)
    {
        $identify = $this->getIdentifyOrder(8);
        $status = 'open';
        $tenantId = $this->getTenantIdByOrder($data['uuid']);
        $clientID = $this->getClientIdByOrder();
        $tableId = $this->getTableIdByOrder($data['table'] ?? '');
        $comment = isset($data['comment']) ? $data['comment'] : '';

        $products = $this->getProductsOrder($data['products']);
        $total = $this->getTotalOrder($products);

        $order = $this->orderRepository->createNewOrder(
            $identify,
            $total,
            $status,
            $tenantId,
            $comment,
            $clientID,
            $tableId
        );

        $this->orderRepository->registerProductsOrder($order->id, $products);


        return $order;
    }

    public function getOrderByIdentify(string $identify)
    {
        return $this->orderRepository->getOrderByIdentify($identify);
    }

    public function getOrdersByClient()
    {
        $clientID = $this->getClientIdByOrder();

        return $this->orderRepository->getOrdersByClientId($clientID);
    }


    private function getIdentifyOrder(int $qtyCaraceters = 8)
    {
        $smallLetters = str_shuffle('abcdefghijklmnopqrstuvwxyz');

        $numbers = (((date('Ymd') / 12) * 24) + mt_rand(800, 9999));
        $numbers .= 1234567890;

        // $specialCharacters = str_shuffle('!@#$%*-');

        // $characters = $smallLetters.$numbers.$specialCharacters;
        $characters = $smallLetters . $numbers;

        $identify = substr(str_shuffle($characters), 0, $qtyCaraceters);

        if ($this->orderRepository->getOrderByIdentify($identify)) {
            $this->getIdentifyOrder($qtyCaraceters + 1);
        }

        return $identify;
    }

    private function getTotalOrder(array $products)
    {
        $total = 0;

        foreach ($products as $product) {
            $total += ($product['qty'] * $product['price']);
        }

        return (float) $total;
    }

    private function getTenantIdByOrder(string $uuid)
    {
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);

        return $tenant->id;
    }

    private function getClientIdByOrder()
    {
        return (auth()->check()) ? auth()->user()->id : '';
    }

    private function getTableIdByOrder(string $uuid)
    {
        if ($uuid) {
            $table = $this->tableRepository->getTableByUuid($uuid);

            return $table->id;
        }

        return '';
    }

    private function getProductsOrder(array $productsOrder) : array
    {
        $products = [];

        foreach ($productsOrder as $productOrder) {
            $product = $this->productRepository->getProductByUuid($productOrder['identify']);

            array_push($products, [
                'product_id'  => $product->id,
                'qty'         => $productOrder['qty'],
                'price'       => $product->price
            ]);
        }

        return $products;
    }
}
