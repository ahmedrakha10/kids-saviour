<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class   ChildrenResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'             => $this->id,
            'name'           => $this->name,
            'phone'          => $this->phone,
            'image'          => $this->image ? url($this->image) : null,
            'birth_certificate'          => $this->birth_certificate ? url($this->birth_certificate) : null,
            'address'          => $this->address,
            'age'              => $this->age,
            'is_lost'          => $this->is_lost,
        ];
    }
}
