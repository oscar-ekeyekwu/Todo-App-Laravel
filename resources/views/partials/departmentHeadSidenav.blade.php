<section class="col col-md-3 col-sm-3">
    <div class="sidenav">
        <div style="display:block;" class="">
            <div class="p-3 flex d-flex justify-content-center">
                <i class="fa fa-user-circle-o" style="font-size:80px;color:lightgrey;text-shadow:2px 2px 4px #000000;"></i>
            </div>
            <p class="text-light justify-content-center"><i class="fa fa-circle text-success"></i> Online</p>
            <div style="align-content: center;" class="p-3">
                <div class="btn-group w-100">
                    <a class="btn btn-light text-dark collapsed" data-toggle="collapse" data-target="#profile">View Profile</a>
                    <a class="btn btn-light text-dark collapsed" data-toggle="collapse" data-target="#profile"><i class="fa fa-caret-down"></i></a>
                </div>

                <div id="profile" class="collapse m-1 p-2 bg-light text-dark">
                    <h6>Name: {{auth()->user()->name}}</h6>
                    <h6>Email: {{auth()->user()->email}}</h6>
                    <h6>Department: {{auth()->user()->department['dept_name'].' - '.auth()->user()->department['dept_code']}}</h6>
                    <h6>Role: {{ucwords(auth()->user()->type['type'])}}</h6>
                </div>
            </div>
        </div>
        <div class="mt-3">
            <ul class="nav navbar-nav">
                <li>
                    <a href="/home">
                       <i class="fa fa-dashboard"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="/projects/create">
                       <i class="fa fa-plus"></i> Create New Project
                    </a>
                </li>
                <li>
                    <a href="/projects/manage-projects">
                       <i class="fa fa-cog"></i> Manage Projects
                    </a>
                </li>
            </ul>
        </div>
    </div>
</section>
