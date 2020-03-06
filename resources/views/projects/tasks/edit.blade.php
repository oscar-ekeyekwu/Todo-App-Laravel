@extends('layouts.app')

@section('content')

@if(auth()->user()->type['type'] == 'Department Head')
    @include('partials.departmentHeadSidenav')
@endif

<section class="container col col-md-9 mt-5 px-5 py-3">
    <div id="cont" class="container">
        @include('partials.flash-messages')
        @include('partials.errors')

    <h1 class="header">Edit Task</h1>

    <form method="post" action="/tasks/{{$task->id}}" style="margin-botton: 10px;">
    @method('PATCH')
    @csrf
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" id="description" name="description" value="{{$task->description}}" required>
        </div>


        <div class="form-group">
            <label for="user"><strong>Assigned To</strong></label>
            <select class="form-control" id="user" name="user_id">
                    <option value="{{$task->users['id']}}">{{$task->users['name']}}</option>
                @if(count($usersInProject) > 0)
                    @foreach($usersInProject as $user)
                        <option value="{{$user['id']}}">{{ucwords($user['name'])}}</option>
                    @endforeach
                @endif
            </select>
        </div>


        <div class="form-group">
            <label for="select_status"><strong>Status</strong></label>
            <select class="form-control" id="select_status" name="status_id">
                <option value="{{$task->status['id']}}">
                    {{$task->status['name']}}
                </option>

                @if($statuses->count() > 0)
                @foreach ($statuses as $status)
                    <option value="{{($status->id)}}">
                        {{ ($status->name)}}
                    </option>
                @endforeach
                @endif
            </select>
        </div>

        <div>
            <button type="submit" class="btn btn-dark mb-2">Update</button>
        </div>
    </form></div></section>
@endsection
