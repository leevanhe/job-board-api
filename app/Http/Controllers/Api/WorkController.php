<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\WorkResource;
use App\Models\Work;
use Illuminate\Support\Facades\Gate;

class WorkController extends Controller
{
    public function index()
    {
        Gate::authorize('viewAny', Work::class);

        $works = Work::with('employer')->withCount('workApplications')->latest()->paginate();

        return WorkResource::collection($works);
    }

    public function show(Work $work): WorkResource
    {
        Gate::authorize('view', $work);

        return new WorkResource($work->load('employer', 'workApplications.user'));
    }
}
