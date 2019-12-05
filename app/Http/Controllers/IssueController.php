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

        return redirect()->route('project', [$issue->project]);
    }
}
