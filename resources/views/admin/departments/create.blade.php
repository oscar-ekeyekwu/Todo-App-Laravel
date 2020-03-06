@extends('layouts.app')

@section('content')
@include('partials.admin-sidenav')

<section class="container col col-md-9 mt-5 px-5 py-3">
    <div class="card w-100 mx-auto shadow">
        <div class="card-header">
            <h4 class="float-left">Create New Department</h4>
        </div>

        <div class="card-body d-block">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <div>
                <form method="post" action="/departments">
                    @csrf
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Enter Department Name" name="dept_name">
                    </div>

                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Enter Department Code" name="dept_code">
                    </div>

                    <button type="submit" class="btn btn-primary">Create</button>
                  </form>
            </div>
        </div>
    </div>
</section>


{{-- <script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#dept_reg_form").submit(function(e){
        e.preventDefault();
        let _data = [$("#dept_name").val(), $("#dept_code").val()];

        console.log('i was submitted');
        $.post('/create-department',{ _data },function(data){
            console.log(data);
            let alertDivStart = "<div class='alert alert-success alert-block mt-2'>";
            let alertBtn = "<button type='button' class='close' data-dismiss='alert'>×</button>";
            let alertMsg = "<strong>"+data.success+"</strong>";
            let alertDivEnd = "</div>";

            let divElement = alertDivStart+alertBtn+alertMsg+alertDivEnd;
            $("#cont").prepend(divElement);
        });
    });
</script> --}}

@endsection
