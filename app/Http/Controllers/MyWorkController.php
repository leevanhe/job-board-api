<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkRequest;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class MyWorkController extends Controller
{
    public function index()
    {
        Gate::authorize('viewAnyEmployer', Work::class);

        return view('my_work.index', ['works' => auth()->user()->employer->works()
            ->with('employer', 'workApplications', 'workApplications.user')->withTrashed()->get()]);
    }

    public function create()
    {
        Gate::authorize('create', Work::class);

        return view('my_work.create');
    }

    public function store(WorkRequest $request)
    {
        Gate::authorize('create', Work::class);

        auth()->user()->employer->works()->create($request->validated());

        return redirect()->route('my-works.index')->with('success', 'Work created successfully.');
    }

    public function edit(Work $myWork)
    {
        Gate::authorize('update', $myWork);

        return view('my_work.edit', ['work' => $myWork]);
    }

    public function update(WorkRequest $request, Work $myWork)
    {
        Gate::authorize('update', $myWork);

        $myWork->update($request->validated());

        return redirect()->route('my-works.index')->with('success', 'Work updated successfully.');
    }

    public function destroy(Work $myWork)
    {
        Gate::authorize('delete', $myWork);

        $myWork->delete();

        return redirect()->route('my-works.index')->with('success', 'Work deleted successfully.');
    }
}
