<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'tenant_id'     => $this->tenant_id,
            'name'          => $this->name,
            'description'   => $this->description,
            'price'         => $this->price,
            'image'         => $this->image ? url("storage/{$this->image}") : null,
            'url'           => $this->url
        ];
    }
}
