<?php

namespace App\Http\Controllers;

use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class WorkController extends Controller
{
    public function index()
    {
        Gate::authorize('viewAny', Work::class);

        $filters = request()->only('search', 'min_salary', 'max_salary', 'experience', 'category');

        return view('works.index', ['works' => Work::with('employer')->latest()->filter($filters)->get()]);
    }


    public function show(Work $work)
    {
        Gate::authorize('view', $work);

        return view('works.show', ['work' => $work->load('employer.works')]);
    }
}
