@extends('layouts.app')

@section('back-button')
<span class="justify-content-end"><a href="/projects/{{$project->id}}" class="btn btn-light">Back</a></span>
@endsection
@section('content')
    <h1 class="header">Edit Project</h1>


    <form method="post" action="/projects/{{$project->id}}" style="margin-botton: 10px;">
    @method('PATCH')
    @csrf
        <div class="form-group">
            <label for="title">Title </label>
            <input type="text" class="form-control" id="title" name="title" value="{{$project->title}}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" rows="5" id="description" name="description" required>{{$project->description}}</textarea>
        </div>
        <div>
            <button type="submit" class="btn btn-dark mb-2">Edit Project</button>
        </div>
    </form>
    <form method="post" action="/projects/{{$project->id}}">
        @method('DELETE')
        @csrf
        <div>
            <button type="submit" class="btn btn-dark">Delete Project</button>
        </div>
    </form>
@endsection
