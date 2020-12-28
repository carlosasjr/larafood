<?php

namespace App\Services;


use App\Repository\Contract\CategoryRepositoryInterface;
use App\Repository\Contract\TenantRepositoryInterface;

class CategoryService
{
    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepository;
    /**
     * @var TenantRepositoryInterface
     */
    private $tenantRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository, TenantRepositoryInterface $tenantRepository)
    {

        $this->categoryRepository = $categoryRepository;
        $this->tenantRepository = $tenantRepository;
    }

    public function getCategoriesByTenantUuid(string $uuid)
    {
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);

        return $this->categoryRepository->getCategoriesByTenantId($tenant->id);
    }

    public function getCategoryByUrl($url)
    {
        return $this->categoryRepository->getCategoryByUrl($url);
    }
}
