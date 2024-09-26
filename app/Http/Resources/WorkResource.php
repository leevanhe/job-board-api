<?php

namespace App\Http\Resources;

use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkResource extends JsonResource
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
            'category' => $this->category,
            'created_at' => $this->created_at->format('c'),
            'updated_at' => $this->updated_at->format('c'),
            // 'deleted_at' => $this->deleted_at,
            'description' => $this->description,
            'employer' => EmployerResource::make($this->whenLoaded('employer')),
            'experience' => $this->experience,
            'location' => $this->location,
            'salary' => $this->salary,
            'title' => $this->title,
            'applications' => WorkApplicationResource::collection($this->whenLoaded('workApplications')),
            'applications_count' => $this->whenHas('work_applications_count'),
            'applications_avg_expected_salary' => $this->whenHas('work_applications_avg_expected_salary'),
        ];
    }
}
