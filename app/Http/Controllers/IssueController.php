<?php

namespace App\Http\Controllers;

use App\Issue;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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

    public function update(Request $request, Issue $issue)
    {
        $attributes = $this->validate($request, [
            'text' => 'sometimes|max:255|string',
            'description' => 'nullable|max:255|string',
            'assignee_id' => 'sometimes|integer|exists:users,id'
        ]);

        $issue->update($attributes);

        return redirect()->route('project', [$issue->project])->with(['selectedIssue' => $issue]);
    }

    public function destroy(Issue $issue)
    {
        $project = $issue->project;

        $issue->delete();

        return redirect()->route('project', [$project]);
    }
}
