@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row pt-3">
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-header text-light bg-success">Your Issues</div>

                <div class="card-body">
                    Your issues
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-header text-light bg-primary">Your Projects</div>

                <div class="card-body">
                    <ul class="list-group">
                        @foreach($projects as $project)
                            <li class="list-group-item"><a href="{{ url("/projects/{$project->id}") }}">{{ $project->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-light bg-secondary">Recent activity</div>

                <div class="card-body">
                    Recent activity
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-4">
            <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModal">
                <span class="fa fa-plus-square"></span> Create Project
            </button>
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

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ url('/projects')}}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New Project</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input id="name" name="name" type="text" class="form-control" placeholder="Enter name"/>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="description" name="description" rows="3" class="form-control" placeholder="Enter description"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Finish</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    {{--<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!

                </div>
            </div>
        </div>
    </div>--}}
</div>
@endsection
