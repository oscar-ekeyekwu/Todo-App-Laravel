@extends('layouts.app')

@section('content')
@include('partials.admin-sidenav')

<section class="container col col-md-9 mt-5 px-5 py-3">
    <div id="cont" class="container mt-4 ">
        <div>
            <h2 class="d-inline-block">Departments</h2>
            <div class="d-inline-block p-2 float-right" style="text-align: right">
                <a href="/admin" class="btn btn-light mt-6"><i class="fa fa-dashboard"></i> Dashboard</a>
                <a href="/departments/create" class="btn btn-light justify-content-end"><i class="fa fa-plus"></i> New Department</a>
            </div>
        </div>

        <table class="table table-bordered shadow">
          <thead>
            <tr>
              <th>Department Name</th>
              <th>Department Code</th>
              <th colspan="2">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($departments->sortByDesc('id') as $department)
                  <tr>
                    <td>{{$department->dept_name}}</td>
                    <td>{{$department->dept_code}}</td>
                    <td>
                        <a href="/departments/{{$department->id}}/edit" style="font-size: 12px;" class="badge badge-pill badge-primary">
                            <i class="fa fa-pencil"></i> Edit
                        </a>
                    </td>
                    <td>
                        <a href="#" id="delbtn" class="badge badge-pill badge-danger" onclick="deleteDepartment({{$department->id}})" style="font-size: 12px;">
                            <i class="fa fa-trash-o"></i> Delete
                        </a>
                    </td>
              </tr>
             @endforeach

          </tbody>
        </table>
      </div>
</section>
@endsection
