@extends('layouts.app')

@section('content')
<div class="container-fluid h-100 w-100">
    <div class="row h-100">
        <div class="col-md-2 bg-light border-right px-0">
            <div class="py-3 border-bottom text-center"><a href="{{ url("/projects/$project->id") }}">Backlog</a></div>
            <div class="py-3 border-bottom text-center"><a href="{{ url("/projects/$project->id/sprint") }}">Sprint</a></div>
            <div class="py-3 border-bottom text-center"><a href="#">Progress Reports</a></div>
        </div>
        <div class="col-md-6 bg-white pt-3 pr-0">
            <sprint :issues="{{ json_encode($sprint->issues) }}"></sprint>
        </div>

        <div class="col-md-4 bg-white">
            <issue-detail :users="{{ json_encode($project->assignedUsers) }}" :initial-issue="{{ json_encode($selectedIssue) }}"></issue-detail>
        </div>
    </div>
</div>
@endsection
