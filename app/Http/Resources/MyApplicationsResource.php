<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MyApplicationsResource extends JsonResource
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
            'expected_salary' => $this->expected_salary,
            'created_at' => $this->created_at->format('c'),
            'updated_at' => $this->updated_at->format('c'),
            'job' => $this->whenLoaded('work'),
        ];
    }
}
