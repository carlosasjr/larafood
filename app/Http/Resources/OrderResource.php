<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'identify'  => $this->identify,
            'total'     => $this->total,
            'status'    => $this->status,
            'date'      => $this->created_at,
            'company'   => new TenantResource($this->tenant),
            'client'    => ($this->client_id) ? new ClientResource($this->client) : '',
            'table'     => ($this->table) ? new TableResource($this->table) : '',
            'products'  => ProductResource::collection($this->products),
            'evaluations' => EvaluationOrderResource::collection($this->evaluations),

        ];
    }
}
