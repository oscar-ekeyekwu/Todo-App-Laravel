@extends('layouts.app')

@section('content')

@if(auth()->user()->type['type'] == 'Department Head')
    @include('partials.departmentHeadSidenav')
@endif

<section class="container col col-md-9 mt-5 px-5 py-3">
    @include('partials.flash-messages')
    <div id="cont">
        <h2 class="d-inline-block">Projects</h2>
        <div class="d-inline-block p-2 float-right" style="text-align: right">
            <a href="/projects/create" class="p-2 badge badge-success"><i class="fa fa-plus"></i> Create Project</a>
            <a href="/home" class="p-2 badge badge-primary justify-content-end"><i class="fa fa-home"></i> Home</a>
        </div>
    </div>

    {{-- Div for Table--}}
    <div>
        <table class="table table-bordered shadow">
            <thead>
                <tr>
                <th>Title</th>
                <th>Description</th>
                <th>User(s) in Project</th>
                <th colspan="2">Action</th>
                </tr>
            </thead>

            <tbody>
            @foreach($allDepartmentProjects->sortByDesc('updated_at') as $project)
                <tr>
                    <td>{{$project->title}}</td>
                    <td>{{$project->description}}</td>
                    <td>
                        {{str_replace(
                            ',',
                            ', ',
                            implode(',',$project->users->pluck('name')->toArray())
                        )}}
                    </td>
                    <td>
                        <div class="d-inline-block">
                            <a href="/projects/{{$project->id}}" id="{{$project->id}}" class="badge badge-pill badge-primary"><i class="fa fa-eye"></i> View Tasks</a>

                            <a href="javascript:void(0)" id="{{$project->id}}"
                                data-username="{{implode(',',$project->users->pluck('name')->toArray())}}" data-ids="{{implode(',',$project->users->pluck('id')->toArray())}}" class="editUsersInProjectBtn badge badge-pill badge-danger"><i class="fa fa-cog"> Edit Users</i></a>

                            <form method="post" action="/projects/{{$project->id}}">
                                @method('DELETE')
                                @csrf
                                <div>
                                    <button type="submit" style="border: 0px; font-size: 100%;" class="badge badge-pill badge-danger"><i class="fa fa-trash-o"></i> Delete Project</button>
                                </div>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    {{-- Edit Users in Project --}}
    <div id="editUsersInProject" class="modal fade">
        <div class="modal-dialog modal-dialog-lg modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                <h5 class="modal-title">Edit Users in Project</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form id="editUsersInProjectForm">
                        @if($usersInDept->count() <= 0)
                        No User In your Department
                    @endif

                    @if($usersInDept->count() > 0)
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" for="select2">Users</label>
                            <div class="col col-md-6">
                                <select class="form-control js-states select2" id="select2" style="width: 100%;" name="user_id[]" placeholder ="Select User(s)" multiple>
                                    {{-- Options are dynamically appended--}}
                                </select>
                            </div>
                            <label class="col-form-label text-danger mx-auto">
                                <strong>NB: Only Selected are or will be in Project</strong>
                            </label>
                        </div>
                    @endif

                        <div class="form-group row mb-0" id="submitBtnDiv">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
