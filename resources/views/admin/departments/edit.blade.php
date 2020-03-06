@extends('layouts.app')

@section('content')
@include('partials.admin-sidenav')

<section class="container col col-md-9 mt-5 px-5 py-3">
    <div class="card w-100 mx-auto shadow">
        <div class="card-header">
            <h4 class="float-left">Edit Department</h4>
        </div>

        <div class="card-body d-block">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <div>
                @foreach($department as $department)
                <form method="post" action="/departments/{{$department->id}}">
                    @method('PATCH')
                    @csrf
                    <div class="form-group">
                    <input type="text" class="form-control" placeholder="Enter Department Name" name="dept_name" value="{{$department->dept_name}}">
                    </div>

                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Enter Department Code" name="dept_code" value="{{$department->dept_code}}">
                    </div>

                    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Update</button>
                  </form>
            </div>
            @endforeach
        </div>
    </div>
</section>


@endsection
