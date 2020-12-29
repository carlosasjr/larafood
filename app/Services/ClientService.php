<?php

namespace App\Services;

use App\Repository\Contract\ClientRepositoryInterface;

class ClientService
{
    /**
     * @var ClientRepositoryInterface
     */
    private $clientRepository;

    public function __construct(ClientRepositoryInterface $clientRepository)
    {

        $this->clientRepository = $clientRepository;
    }

    public function store(array $data)
    {
        return $this->clientRepository->store($data);
    }
}
