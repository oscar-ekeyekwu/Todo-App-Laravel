@extends('layouts.app')

{{-- @section('back-button')
    <span class="justify-content-end">
        <a href="/view-projects" class="btn btn-light">
        <i class="fa fa-arrow-left"></i> Back To Projects
        </a>
    </span>
@endsection --}}

@section('content')

<section class="container col col-md-9 mt-5 px-5 py-3">
    <div id="cont" class="container">
        @include('partials.flash-messages')
        @include('partials.errors')

        <div class="card w-100">
            <div class="card bg-light text-dark">
                <div class="card-body">
                    <h3>Title: {{$project->title}}</h3>
                    <h5><strong>Description: </strong>{{$project->description}}</h5>
                </div>
            </div>
        </div>

        <hr class="hr mb-2 mt-2">

        <div class="pt-2 ml-3">
            <div class="d-inline-block p-2 float-right" style="text-align: right">
                <a href="#" data-toggle="modal" data-target="#newProjectTask" class="newTaskBtn btn btn-light mt-6">
                    <i class="fa fa-plus"></i> New Task
                </a>
            </div>
            <table class="table table-bordered shadow">
                <thead>
                    <tr>
                    <th>Task</th>
                    <th>Assigned To</th>
                    <th>Status</th>
                    <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                @if($tasks->count() > 0)
                    @foreach($tasks->sortByDesc('id') as $task)
                    <tr>
                        <td>
                            {{ucwords($task->description)}}
                        </td>
                        <td class="w-50">
                            {{ucwords($task->users['name'])}}
                        </td>
                        <td>
                            <label class="badge badge-pill" style="background-color: {{$task->status['color']}} ">
                                {{ucwords($task->status['name'])}}
                            </label>
                        </td>
                        <td>
                            <div class="d-inline-block">
                                <a href="/tasks/{{$task->id}}/edit" class="badge badge-primary text-light">
                                    <i class="fa fa-pencil"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4" class="text-danger">
                            <strong>You don't have any task in this Project! Create One</strong>
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>


    <!--New Task Modal -->
    <div id="newProjectTask" class="modal fade">
        <div class="modal-dialog modal-dialog-lg modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title">New Task</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form class="form" id="newTaskForm" method="post" action="/projects/{{$project->id}}/tasks">
                        <div class="form-group">
                            <label for="description"><strong>Add Task</strong></label>
                            <input type="text" class="form-control" id=description name="description" placeholder="Add New Task" required>
                        </div>
                        <div class="form-group">
                            <label for="user"><strong>Assigned To</strong></label>
                            <select class="form-control" id="user" name="user_id">
                            <option value="{{auth()->id()}}">{{auth()->user()->name}}</option>
                            </select>
                        </div>


                        @if($statuses->count() <= 0)
                            <div class="form-group">
                                <label for="status"><strong>Status</strong></label>
                                <select class="form-control" id="status" name="status_id" disabled>
                                    <option>{{('No Active Status')}}</option>
                                </select>
                            </div>
                        @endif
                        @if($statuses->count() > 0)
                            <div class="form-group">
                                <label for="status"><strong>Status</strong></label>
                                <select class="form-control" id="status" name="status_id">
                                    @foreach($statuses as $status)
                                    <option value="{{($status->id)}}">{{ucwords($status->name)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        <input type="hidden" name="projects_id" value="{{$project->id}}">

                        <div>
                            <button type="submit" class="btn btn-dark"><i class="fa fa-plus"></i> Create</button>
                        </div>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
        </div>
        <!-- New Task Modal End -->
    </div>
    <!--New Task Modal End -->
</section>
@endsection
