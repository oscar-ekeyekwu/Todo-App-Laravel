<?php

namespace App\Http\Controllers;

use App\Tasks;
use App\Projects;
use App\Repositories\TasksRepositoryInterface;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    protected $tasks;

    public function __construct(TasksRepositoryInterface $tasks)
    {
        $this->tasks = $tasks;
    }

    public function store(Projects $project)
    {
        $attribute =  request()->validate([
            'description' => 'required', 'min:3',
            'projects_id' => 'required',
            'user_id' => 'required',
            'status_id' => 'required'
        ]);
        $project->addTask($attribute);

        return response()->json(['info' => 'Task Added Successfully']);
    }


    public function update($taskId)
    {
        $attr = request()->all();
        $this->tasks->updateTasks($taskId, $attr);
        return redirect('/home')->with('success', 'Task(s) Updated Successfully');
    }


    public function destroy(Tasks $task)
    {
        $this->tasks->removeTask($task->id);
        return response()->json(['info' => 'Task Removed Successfully']);
    }

    public function edit($taskId)
    {
        $statuses = \App\Status::all()->where('active', true);

        $task = $this->tasks->getTask($taskId);
        $project = $task->project;

        $usersInProjectIds = \App\ProjectUsers::all()->where('projects_id', $project->id)->pluck('user_id');

        $usersInProject = [];
        for ($i = 0; $i < $usersInProjectIds->count(); $i++) {

            $users = \App\User::find($usersInProjectIds[$i]);
            array_push($usersInProject, $users);
        }

        return view('projects.tasks.edit', compact(['task', 'statuses', 'usersInProject']));
    }
}
