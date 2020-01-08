<?php

namespace App\Http\Controllers;

use App\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Request $request, Project $project)
    {
        $filter = $request->input('filter');

        if($filter == 'only-me') {
            $project->load(['issues' => function ($query) {
                return $query->where('assignee_id', auth()->id());
            }]);

            $project->issues->load('assignee', 'reporter');
        } else {
            $project->load('issues.assignee', 'issues.reporter');
        }

        $selectedIssue = Session::get('selectedIssue');

        return view('project', compact('project', 'selectedIssue', 'filter'));
    }

    public function create(Request $request)
    {
        $attributes = $this->validate($request, [
            'name' => 'required|string|min:4|max:20',
            'description' => 'required|string|max:255'
        ]);

        $project = auth()->user()->projects()->create($attributes);
        $project->sprints()->create([
            'starts_at' => Carbon::now(),
            'ends_at' => Carbon::now()->addWeeks(2)
        ]);

        return redirect()->route('project', [$project]);
    }

    public function sprint(Project $project)
    {
        $selectedIssue = Session::get('selectedIssue');

        $sprint = get_current_sprint($project->id);

        return view('sprint', compact('sprint', 'project', 'selectedIssue'));
    }
}
