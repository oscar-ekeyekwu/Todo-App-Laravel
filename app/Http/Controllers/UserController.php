<?php

namespace App\Http\Controllers;

use App\Projects;
use App\ProjectUsers;
use App\Repositories\ProjectsRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $projects;
    public function __construct(ProjectsRepositoryInterface $projects)
    {
        $this->middleware('auth');
        $this->projects = $projects;
    }
    public function index()
    {
        $pids = \App\ProjectUsers::all()->where('user_id', auth()->id())->pluck('projects_id');
        $userProjects = [];
        for ($i = 0; $i < $pids->count(); $i++) {

            $users = \App\Projects::find($pids[$i]);
            array_push($userProjects, $users);
        }
        return view('user.home', compact('userProjects'));
    }

    public function show($projectId)
    {
        $project = $this->projects->getProject($projectId);
        $tasks = \App\Tasks::all()->where('projects_id', $projectId)->where('user_id', auth()->id());

        $statuses = \App\Status::all()->where('active', true);

        return view('user.tasks', compact(['project', 'statuses', 'tasks']));
    }
}
