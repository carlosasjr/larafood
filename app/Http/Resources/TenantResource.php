<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TenantResource extends JsonResource
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
            'name'          => $this->name,
            'uuid'          => $this->uuid,
            'url'           => $this->url,
            'email'         => $this->email,
            'image'         => $this->image ? url("storage/{$this->image}") : null,
            'created_at'    => $this->created_at,
        ];
    }
}
