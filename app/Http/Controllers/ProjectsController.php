<?php

namespace App\Http\Controllers;

use App\Departments;
use App\Mail\ProjectCreated;
use App\Projects;
use App\ProjectUsers;
use App\User;
use Illuminate\Http\Request;
use App\Repositories\ProjectsRepositoryInterface;
use App\Repositories\DepartmentsRepositoryInterface;
use Illuminate\Support\Facades\Gate;

class ProjectsController extends Controller
{
    protected $projects;
    protected $departments;

    public function __construct(ProjectsRepositoryInterface $project, DepartmentsRepositoryInterface $department)
    {
        $this->middleware('auth');
        $this->projects = $project;
        $this->departments = $department;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $projects = $this->projects->allProjects();
        $projects = $this->projects->allProjects();

        return view('/projects.show', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //getting the department of the user

        if (
            auth()->user()->department['id'] != 1
            && auth()->user()->type['type'] == "Department Head"
        ) {

            $userDeptId  = auth()->user()->department['id'];
            $departments = $this->departments->get_department($userDeptId);

            return view('projects.create', compact('departments'));
        } else {
            return back()->with('error', 'You cannot create a project. Please contact admin');
        }

        // if (auth()->user()->department['id'] == 1 | auth()->user()->type['type'] != "admin") {
        //     return back()->with('success', 'Sorry you cannot create a Project. Contact Admin or Department Head to assign you to a department first');
        // } else {

        // }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $attributes = request()->validate([
            'title' => ['required', 'min:3'],
            'description' => ['required', 'min:3'],
            'dept_id' => ['required'],
            'dept_name' => ['required']
        ]);
        $attributes['user_id'] = auth()->id();

        $this->projects->store($attributes);


        $user_email = User::where('id', auth()->id())->pluck('email');

        \Mail::to($user_email)->send(
            new ProjectCreated($attributes)
        );

        return redirect('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Projects  $projects
     * @return \Illuminate\Http\Response
     */
    public function show(Projects $project)
    {
        $this->authorize('update', $project);
        $project = $this->projects->getProject($project->id);

        $statuses = \App\Status::all()->where('active', true);

        $usersInProjectIds = \App\ProjectUsers::all()->where('projects_id', $project->id)->pluck('user_id');

        $usersInProject = [];
        for ($i = 0; $i < $usersInProjectIds->count(); $i++) {

            $users = \App\User::find($usersInProjectIds[$i]);
            array_push($usersInProject, $users);
        }

        return view('/projects.show-project-tasks', compact(['project', 'usersInProject', 'statuses']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Projects  $projects
     * @return \Illuminate\Http\Response
     */
    public function edit(Projects $project)
    {
        $project = $this->projects->getProject($project->id);
        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Projects  $projects
     * @return \Illuminate\Http\Response
     */
    public function update($projectId)
    {
        $attributes = request(['title', 'description']);
        $this->projects->updateProject($projectId, $attributes);
        return response()->json(['info' => 'Project Editted Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Projects  $projects
     * @return \Illuminate\Http\Response
     */
    public function destroy(Projects $project)
    {
        $this->projects->destroy($project->id);
        return redirect('projects');
    }
    public function deptHeadView()
    {
        // if (Gate::allows('manage-projects')) {

        // } else {
        //     return back()->with('error', 'Sorry you cannot access this Page');
        // }

        $deptHeadId = auth()->user()->department['id'];

        $allDepartmentProjects = $this->projects->allDepartmentProjects($deptHeadId);
        $usersInDept = \App\User::all()->where('dept_id', $deptHeadId);


        return view('projects.department-head-view', compact(['allDepartmentProjects', 'usersInDept']));
    }
}
