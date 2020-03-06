<?php

namespace App\Repositories;

interface TasksRepositoryInterface
{
    public function removeTask($id);
    public function updateTasks($taskId, $attr);
    public function getTask($taskId);
}
