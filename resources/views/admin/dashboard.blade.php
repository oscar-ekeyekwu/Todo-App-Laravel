@extends('layouts.app')

@section('content')
@include('partials.admin-sidenav')
<section class="container-fluid col-md-9 mt-5 px-5 py-3">
    <div class="row justify-content-center">
        @include('partials.errors')
        @include('partials.flash-messages')
            <h1>this is the dasboard</h1>

    </div>
</section>



@endsection
