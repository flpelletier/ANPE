<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Offre extends JsonResource
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
            'id' => $this->id,
            'titre' => $this->titre,
            'description' => $this->description,
            'niveau' => $this->niveau,
            'created_at' => now(),
            'updated_at' => now()
        ];    }
}
