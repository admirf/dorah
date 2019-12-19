<?php

namespace App\Http\Controllers;

use App\Issue;
use App\Project;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $projects = Project::orderBy('created_at', 'desc')->paginate(8);

        $issues = Issue::where('assignee_id', auth()->id())->with('project')->orderBy('updated_at', 'desc')->paginate(8);

        return view('home', compact('projects', 'issues'));
    }
}
