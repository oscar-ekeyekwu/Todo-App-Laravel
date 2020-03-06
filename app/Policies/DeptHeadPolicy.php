<?php

namespace App\Policies;

use App\User;
use Departments;
use Illuminate\Auth\Access\HandlesAuthorization;

class DeptHeadPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function view(User $user)
    {
        return $user->type['type'] == 'Department Head';
    }
}
