@extends('layouts.app')

@section('content')
@include('partials.admin-sidenav')

<section class="container col col-md-9 mt-5 px-5 py-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> {{ __('Edit User') }}</div>

                <div class="card-body">
                @foreach($user as $user)
                <form method="POST" action='/admins/{{$user->id}}' aria-label="{{ __('Update') }}">
                        @method('PATCH')
                        @csrf


                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$user->name}}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email}}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" for="select_dept">Department</label>
                            <div class="col-md-6">
                                <select class="form-control" id="select_dept" name="dept_id">
                                <option value="{{$user->department['id']}}">{{$user->department['dept_name']}}</option>

                                  @if($departments->count() > 0)
                                    @foreach ($departments as $dept)
                                    <option value="{{($dept->id)}}">
                                        {{ ($dept->dept_name . ' - ' . $dept->dept_code)}}
                                    </option>
                                    @endforeach
                                  @endif
                                </select>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" for="userType">User Role</label>
                            <div class="col-md-6">
                                <select class="form-control" id="userType" name="user_type_id">

                                <option value="{{$user->type['id']}}">
                                    {{ucwords($user->type['type'])}}
                                </option>

                                @if($userType->count() > 0)
                                    @foreach ($userType as $userType)
                                        <option value="{{($userType->id)}}">{{ucwords($userType->type)}}</option>
                                    @endforeach
                                @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
