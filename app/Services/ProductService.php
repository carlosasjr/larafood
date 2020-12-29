<?php

namespace App\Services;

use App\Repository\Contract\ProductRepositoryInterface;
use App\Repository\Contract\TenantRepositoryInterface;

class ProductService
{
    /**
     * @var TenantRepositoryInterface
     */
    private $tenantRepository;
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    public function __construct(TenantRepositoryInterface $tenantRepository,
 ProductRepositoryInterface $productRepository)
    {

        $this->tenantRepository = $tenantRepository;
        $this->productRepository = $productRepository;
    }

    public function getProductByTenantUuid(string $uuid, array $filterCategories)
    {
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);

        return $this->productRepository->getProductsByTenantId($tenant->id, $filterCategories);
    }

    public function getProductByUrl(string $url)
    {
        return $this->productRepository->getProductByUrl($url);
    }
}
