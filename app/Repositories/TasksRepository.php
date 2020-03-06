<?php

namespace App\Repositories;

use App\Tasks;
use App\Projects;
use PhpParser\Node\Expr\FuncCall;

class TasksRepository implements TasksRepositoryInterface
{
    public function removeTask($id)
    {
        Tasks::findOrFail($id)->delete();
    }

    public function updateTasks($taskId, $attr)
    {
        Tasks::findOrFail($taskId)->update($attr);
    }

    public function getTask($taskId)
    {
        return Tasks::findOrFail($taskId);
    }
}
