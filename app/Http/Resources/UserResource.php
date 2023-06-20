<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {


        return [
            'id'                 => $this->id,
            'name'               => $this->name,
            'phone'              => $this->phone,
            'email'              => $this->email,
            'status'             => $this->status,
            'image'              => $this->image ? url($this->image) : null,
            'address'            => $this->address ?? null,
            'access_token'       => 'Bearer ' . $this->access_token
        ];
    }
}
