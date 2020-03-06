@extends('layouts.app')
@section('content')
@if(auth()->user()->type['type'] == 'Department Head')
    @include('partials.departmentHeadSidenav')
@endif
<section class="container col col-md-9 mt-5 px-5 py-3">
    @include('partials.flash-messages')
    <div class="row justify-content-center">
            <div class="card w-100">
                <div class="card-header">
                    <h4>Dashboard</h4>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="d-inline-block p-2 float-right" style="text-align: right">
                        <a href="/" class="btn btn-light mt-6"><i class="fa fa-home"></i> Home</a>
                        <a href="/projects/create" class="btn btn-light justify-content-end"><i class="fa fa-plus"></i> Create Project</a>
                    </div>

                    <div>
                        <table class="table table-bordered shadow">
                            <thead>
                              <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th colspan="2">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($userProjects->sortByDesc('id') as $project)
                                    <tr>
                                      <td>{{$project->title}}</td>
                                      <td>{{$project->description}}</td>
                                      <td><a href="/projects/{{$project->id}}" class="badge badge-primary badge-pill text-light p-2"><i class="fa fa-eye"></i> View Project Tasks</a></td>
                                      <td>
                                          <form method="post" action="/projects/{{$project->id}}">
                                              @method('DELETE')
                                              @csrf
                                              <div>
                                                  <button type="submit" class="btn btn-dark">Delete Project</button>
                                              </div>
                                          </form>
                                      </td>
                                </tr>
                               @endforeach

                            </tbody>
                          </table>
                    </div>
                </div>

            </div>

    </div>

</section>

@endsection
