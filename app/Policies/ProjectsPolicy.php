<?php

namespace App\Policies;

use App\Projects;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectsPolicy
{
    use HandlesAuthorization;


    public function update(User $user, Projects $projects)
    {
        return $projects->user_id == $user->id;
    }
}
