<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */



    public function __construct(User $user)
    {
        echo ($user->type['type'] == "admin");
    }

    public function viewAny(User $user)
    {
        return $user->type['type'] == "admin";
    }
}
