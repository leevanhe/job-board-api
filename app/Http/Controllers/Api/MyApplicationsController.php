<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MyApplicationsResource;
use App\Http\Resources\WorkResource;
use App\Models\Work;
use Illuminate\Http\Request;

class MyApplicationsController extends Controller
{
    public function index()
    {
        $applications = auth()->user()->workApplications()
            ->with([
                'work' => fn($query) => $query->withCount('workApplications')->withAvg('workApplications', 'expected_salary'),
                'work.employer'
            ])->latest()->get();

        return MyApplicationsResource::collection($applications);
    }
}
