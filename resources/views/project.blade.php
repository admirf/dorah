@extends('layouts.app')

@section('content')
<div class="container-fluid h-100 w-100">
    <div class="row h-100">
        <div class="col-md-2 bg-secondary">
        </div>
        <div class="col-md-8 bg-white pt-3">
            <h4>{{ $project->name }}</h4>

            <div class="card w-100 mt-3">
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

        <div class="col-md-2 bg-white">
        </div>
    </div>
</div>
@endsection
