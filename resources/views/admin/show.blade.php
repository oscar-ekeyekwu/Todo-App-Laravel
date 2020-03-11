@extends('layouts.app')

@section('content')
@include('partials.admin-sidenav')

<section class="container col-md-9 mt-5 px-5 py-3">
    @include('partials.errors')
    @include('partials.flash-messages')

<div id="cont" class="container mt-4 ">
    <div>
        <h2 class="d-inline-block">All Users</h2>
        <div class="d-inline-block p-2 float-right" style="text-align: right">
            <a href="/admin" class="btn btn-light mt-6"><i class="fa fa-dashboard"></i> Dashboard</a>
            <a href="/admins/create" class="btn btn-light justify-content-end"><i class="fa fa-plus"></i> New User</a>
        </div>
    </div>

    <table class="table table-bordered shadow">
      <thead>
        <tr>
          <th>Name</th>
          <th>Email Address</th>
          <th>Department</th>
          <th>Role</th>
          <th colspan="2">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($users->sortByDesc('id') as $user)
		      <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>
                   {{$user->department['dept_name'].' - '.$user->department['dept_code']}}
                </td>
                <td>
                    {{ucwords($user->type['type'])}}
                </td>
                <td>
                    <div class="d-block">
                        <a href="/admins/{{$user->id}}/edit" style="font-size: 12px;" class="badge badge-pill badge-primary">
                            <i class="fa fa-pencil"></i> Edit
                        </a>
                        <a href="#" id="delbtn" class="badge badge-pill badge-danger" onclick="deleteUser({{$user->id}})" style="font-size: 12px;">
                            <i class="fa fa-trash-o"></i> Delete
                        </a>
                    </div>
                </td>
          </tr>
	     @endforeach

      </tbody>
    </table>
  </div>

</section>
@endsection
