@extends('layouts.app')

@section('content')
<div class="container-fluid h-100 w-100">
    <div class="row h-100">
        <div class="col-md-2 bg-light border-right px-0">
            <div class="py-3 border-bottom text-center"><a href="#">Backlog</a></div>
            <div class="py-3 border-bottom text-center"><a href="#">Sprint</a></div>
            <div class="py-3 border-bottom text-center"><a href="#">Progress Reports</a></div>
        </div>
        <div class="col-md-6 bg-white pt-3 pr-0">
            <div class="row no-gutters">
                <div class="col-md-6">
                    <h3>{{ $project->name }}</h3>
                </div>
                <div class="col-md-6">
                    <filters filter="{{ $filter }}" project-id="{{ $project->id }}"></filters>
                </div>
            </div>


            <div class="card w-100 mt-3 mb-3">
                <div class="card-header text-light bg-dark">Issues</div>

                <div class="card-body">

                    <issue-list :issues="{{ json_encode($project->issues) }}"></issue-list>

                    <form class="mt-3" method="POST" action="{{ url('/issues') }}">
                        @csrf

                        <input name="project_id" type="hidden" value="{{ $project->id }}" />

                        <label for="newTask"><span class="fa fa-plus"></span> New Issue</label>
                        <input id="newTask" name="text" type="text" class="form-control" placeholder="Type in new task..."/>
                    </form>

                    @if ($errors->any())
                        <div class="alert alert-danger mt-3">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4 bg-white">
            <issue-detail :users="{{ json_encode($project->assignedUsers) }}" :initial-issue="{{ json_encode($selectedIssue) }}"></issue-detail>
        </div>
    </div>
</div>
@endsection
