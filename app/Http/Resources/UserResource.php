<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'name' => $this->getFullName(),
            'role' => $this->role->name,
            'email' => $this->email,
            'nickname' => $this->username,
            'birthdate' => $this->birthdate,
            'personal_phone' => $this->personal_phone,
            'home_phone' => $this->home_phone,
            'address' => $this->address,
        ];
    }
}
