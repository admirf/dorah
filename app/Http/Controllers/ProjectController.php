<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Project $project)
    {
        $project->load('issues');

        return view('project', compact('project'));
    }

    public function create(Request $request)
    {
        $attributes = $this->validate($request, [
            'name' => 'required|string|min:4|max:20',
            'description' => 'required|string|max:255'
        ]);

        $project = auth()->user()->projects()->create($attributes);

        return redirect()->route('project', [$project]);
    }
}
