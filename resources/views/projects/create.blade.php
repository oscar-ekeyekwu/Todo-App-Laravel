@extends('layouts.app')

@section('content')
<section class="container col col-md-9 mt-5 px-5 py-3">
    @include('partials.flash-messages')
    <div class="card mt-3">
        <div class="card-body">
            <h4 class="card-title">Create Project</h4>
            <h6 class="card-title">
                <strong>
                    @foreach($departments as $dept)
                        {{'Department: '.$dept->dept_name. ' ( '. $dept->dept_code. ' ) '}}
                    @endforeach
                </strong>
            </h6>
            <form method="post" action="/projects">
                @csrf
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input placeholder="Project Title" type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea placeholder="Make it Short and Simple" class="form-control" rows="5" id="description" name="description" required></textarea>
                </div>
                @foreach($departments as $dept)
                    <input type="hidden" name="dept_name" value="{{$dept->dept_name.'('. $dept->dept_code.')'}}">
                    <input type="hidden" name="dept_id" value="{{$dept->id}}">
                @endforeach
                <button type="submit" class="btn btn-dark"><i class="fa fa-plus"></i> Create</button>
                <a href="/home" class="btn btn-dark"><i class="fa fa-chevron-left"></i> Back</a>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection
