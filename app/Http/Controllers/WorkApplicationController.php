<?php

namespace App\Http\Controllers;

use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class WorkApplicationController extends Controller
{
    public function create(Work $work)
    {
        Gate::authorize('apply', $work);
        return view('work_application.create', ['work' => $work]);
    }

    public function store(Work $work, Request $request)
    {
        Gate::authorize('apply', $work);

        $validatedData = $request->validate([
            'expected_salary' => 'required|min:1|max:1000000',
            'cv' => 'required|file|mimes:pdf|max:2048',
        ]);

        $file = $request->file('cv');
        $path = $file->store('cvs', 'private');

        $work->workApplications()->create([
            'user_id' => $request->user()->id,
            'expected_salary' => $validatedData['expected_salary'],
            'cv_path' => $path,
        ]);

        return redirect()->route('works.show', $work)->with('success', 'Work application created.');
    }
}
