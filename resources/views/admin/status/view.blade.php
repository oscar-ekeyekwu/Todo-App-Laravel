@extends('layouts.app')

@section('content')
@include('partials.admin-sidenav')
<section class="container col col-md-9 mt-5 px-5 py-3">
    <div id="cont" class="container mt-4 ">
        <div>
            <h2 class="d-inline-block">Status Manager</h2>
            <div class="d-inline-block p-2 float-right" style="text-align: right">
                <a href="#" data-toggle="modal" data-target="#newStatus" class="badge badge-success text-light p-2"><i class="fa fa-plus"></i> New Status
                </a>
            </div>
        </div>

        <div>
            <table class="table table-bordered shadow">
                <thead>
                  <tr>
                    <th>Status Name</th>
                    <th>Background Color</th>
                    <th>Text Color</th>
                    <th>Active</th>
                    <th colspan="2">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @if($statuses->count() > 0)
                    @foreach($statuses as $status)
                    <tr>
                        <td>
                            <label class="badge badge-pill" style="background-color: {{$status->bgColor}}; color:{{$status->textColor}}; ">
                                {{ucwords($status->name)}}
                            </label>
                        </td>
                        <td>{{$status->bgColor}}</td>
                        <td>{{$status->textColor}}</td>
                        <td>
                            @if($status->active)
                                {{'Yes'}}
                            @else
                                {{'No'}}
                            @endif
                        </td>
                        <td>
                            <div class="d-inline-block">
                                <a href="#" id="{{$status->id}}" class="editStatusBtn badge badge-pill badge-primary"><i class="fa fa-pencil"></i> Edit</a>

                                <a href="#" id="{{$status->id}}" class="remStatusBtn badge badge-pill badge-danger"><i class="fa fa-trash"> Delete</i></a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                  @else
                      <tr>
                          <td colspan="4">No Status to display! </td>
                      </tr>
                  @endif
                </tbody>
            </table>
        </div>


        <!--New Status Modal -->
        <div id="newStatus" class="modal fade">
            <div class="modal-dialog modal-dialog-lg modal-dialog-centered">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title">New Status</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form class="form" id="newStatusForm">
                            <div class="form-group">
                                <label for="name"><strong>Name:</strong></label>
                                <input type="text" class="form-control" id=description name="name" placeholder="Status Name" required>
                            </div>

                            <div class="form-group">
                                <label for="color"><strong>Background Color:</strong></label>
                                <input type="color" class="form-control" name="bgColor" required>
                            </div>

                            <div class="form-group">
                                <label for="color"><strong>Text Color:</strong></label>
                                <input type="color" class="form-control"name="textColor" required>
                            </div>

                            <div class="form-group">
                                <label for="active"><strong>Active: </strong></label>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="active" value="yes">Yes
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="active" value="no">No
                                    </label>
                                </div>
                            </div>

                            <div>
                                <button type="submit" class="btn btn-dark"><i class="fa fa-plus"></i> Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- New Status Modal End -->

        <!--Edit Status Modal -->
        <div id="editStatus" class="modal fade">
            <div class="modal-dialog modal-dialog-lg modal-dialog-centered">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Status</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form class="form editStatusForm" id="editStatusForm">
                            <div class="form-group">
                                <label for="name"><strong>Name:</strong></label>
                                <input type="text" class="form-control" name="name" placeholder="Status Name" id="statusName" required>
                            </div>

                            <div class="form-group">
                                <label for="color"><strong>Background Color:</strong></label>
                                <input type="color" class="form-control" name="bgColor" id="bgColor" required>
                            </div>

                            <div class="form-group">
                                <label for="color"><strong>Text Color:</strong></label>
                                <input type="color" class="form-control" name="textColor" id="textColor" required>
                            </div>

                            <div class="form-group">
                                <label for="active"><strong>Active: </strong></label>
                                <div class="form-check-inline">
                                    <label for="y" class="form-check-label">
                                        <input type="radio" class="form-check-input" name="active" value="yes" id="y">Yes
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <label for="n" class="form-check-label">
                                        <input type="radio" class="form-check-input" name="active" value="no" id="n">No
                                    </label>
                                </div>
                            </div>

                            <div id="submitBtnDiv" class="mb-2">
                                <button type="submit" class="btn btn-dark"><i class="fa fa-pencil"></i> Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Edit Status Modal End -->
      </div>

</section>
@endsection
