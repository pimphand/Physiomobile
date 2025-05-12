<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'medium_acquisition' => $this->medium_acquisition,
            'created_at' => $this->created_at,
            'user' => [
                'name' => $this->user->name,
                'id_type' => $this->user->id_type,
                'id_no' => $this->user->id_no,
                'gender' => $this->user->gender,
                'dob' => $this->user->dob,
                'address' => $this->user->address,
            ],
        ];
    }
}
