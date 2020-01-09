<?php

namespace App\Http\Controllers;

use App\Issue;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('updateStatus');
    }

    public function create(Request $request)
    {
        $attributes =  $this->validate($request, [
            'text' => 'required|max:255|string',
            'project_id' => 'required|exists:projects,id'
        ]);

        $issue = auth()->user()->reportedIssues()->create($attributes);

        return redirect()->route('project', [$issue->project])->with(['selectedIssue' => $issue]);
    }

    public function addToSprint(Issue $issue)
    {
        $project = $issue->project;

        $sprint = get_current_sprint($project->id);

        $issue->sprint()->associate($sprint);
        $issue->save();

        return redirect()->route('project', [$project])->with(['selectedIssue' => $issue]);
    }

    public function updateStatus(Issue $issue, Request $request)
    {
        $attributes = $this->validate($request, [
            'status' => 'required|in:todo,in-progress,feedback,done'
        ]);

        $issue->update($attributes);

        return response('', 204);
    }

    public function update(Request $request, Issue $issue)
    {
        $attributes = $this->validate($request, [
            'text' => 'sometimes|max:255|string',
            'description' => 'nullable|max:255|string',
            'assignee_id' => 'nullable|integer|exists:users,id',
            'points' => 'nullable|integer',
            'type' => 'sometimes|in:task,bug,story'
        ]);

        $issue->update($attributes);

        return redirect()->route('project', [$issue->project])->with(['selectedIssue' => $issue->load('reporter')]);
    }

    public function destroy(Issue $issue)
    {
        $project = $issue->project;

        $issue->delete();

        return redirect()->route('project', [$project]);
    }
}
