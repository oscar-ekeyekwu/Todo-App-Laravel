@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <div>
        <h2 class="d-inline-block">Projects</h2>
        <div class="d-inline-block p-2 float-right" style="text-align: right">
            <a href="/home" class="btn btn-light mt-6"><i class="fa fa-home"></i> Home</a>
            <a href="/projects/create" class="btn btn-light justify-content-end"><i class="fa fa-plus"></i> Create Project</a>
        </div>
    </div>

    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Title</th>
          <th>Description</th>
          <th colspan="2">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($projects->sortByDesc('id') as $project)
		      <tr>
                <td>{{$project->title}}</td>
                <td>{{$project->description}}</td>
                <td><a href="/projects/{{$project->id}}" class="btn btn-dark"><i class="fa fa-eye"></i></a></td>
                <td>
                    <form method="post" action="/projects/{{$project->id}}">
                        @method('DELETE')
                        @csrf
                        <div>
                            <button type="submit" class="btn btn-dark"><i class="fa fa-trash-o"></i></button>
                        </div>
                    </form>
                </td>
          </tr>
	     @endforeach

      </tbody>
    </table>
  </div>


@endsection
