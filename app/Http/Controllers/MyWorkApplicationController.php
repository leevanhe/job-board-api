<?php

namespace App\Http\Controllers;

use App\Models\WorkApplication;
use Illuminate\Http\Request;

class MyWorkApplicationController extends Controller
{
    public function index()
    {
        return view('my_work_application.index', ['applications' => auth()->user()->workApplications()
            ->with([
                'work' => fn($query) => $query->withCount('workApplications')->withAvg('workApplications', 'expected_salary')->withTrashed(),
                'work.employer'
            ])->latest()->get()]);
    }

    public function destroy(WorkApplication $myWorkApplication)
    {
        $myWorkApplication->delete();

        return redirect()->back()->with('success', 'Job application deleted successfully.');
    }
}
