<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'role'       => $this->when($this->whenLoaded('role'), $this->role->name),
            'email'      => $this->email,
            'first_name' => $this->first_name,
            'last_name'  => $this->last_name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
