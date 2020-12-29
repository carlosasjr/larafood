<?php

namespace App\Repository\Eloquent;

use App\Models\Client;
use App\Repository\Contract\ClientRepositoryInterface;

class ClientRepository implements ClientRepositoryInterface
{
    /**
     * @var Client
     */
    private $entity;

    public function __construct(Client $client)
    {
        $this->entity = $client;
    }


    public function store(array $data)
    {
        return $this->entity->create($data);
    }

    public function getClientById(int $id)
    {
        // TODO: Implement getClientById() method.
    }
}

