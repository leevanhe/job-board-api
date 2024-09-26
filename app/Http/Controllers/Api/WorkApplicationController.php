<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\WorkApplicationResource;
use App\Models\Work;
use App\Models\WorkApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class WorkApplicationController extends Controller
{
    public function store(Work $work, Request $request)
    {
        Gate::authorize('apply', $work);

        $validatedData = $request->validate([
            'expected_salary' => 'required|min:1|max:1000000',
            'cv' => 'required|file|mimes:pdf|max:2048',
        ]);

        $file = $request->file('cv');
        $path = $file->store('cvs', 'private');

        $application = $work->workApplications()->create([
            'user_id' => $request->user()->id,
            'expected_salary' => $validatedData['expected_salary'],
            'cv_path' => $path,
        ]);

        return WorkApplicationResource::make($application->load('user'));
    }
}
