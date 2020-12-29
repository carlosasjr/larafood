<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClientRequest;
use App\Http\Resources\ClientResource;
use App\Services\ClientService;

class RegisterController extends Controller
{
    /**
     * @var ClientService
     */
    private $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }


    public function store(StoreClientRequest $request)
    {
        $client = $this->clientService->store($request->all());

        return new ClientResource($client);
    }
}
