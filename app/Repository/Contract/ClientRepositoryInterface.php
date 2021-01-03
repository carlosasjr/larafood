<?php

namespace App\Repository\Contract;

interface ClientRepositoryInterface
{
    public function store(array $data);
    public function getClientById(int $id);
}

