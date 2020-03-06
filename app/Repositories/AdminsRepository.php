<?php

namespace App\Repositories;

use App\Admin;
use App\User;
use Departments;

class AdminsRepository implements AdminsRepositoryInterface
{
    public function allUsers()
    {
        return User::all();
    }

    public function getUser($userId)
    {
        return User::where('id', $userId)->get();
    }

    public function store($admin_details)
    {
        Admin::create($admin_details);
    }

    public function destroy($userId)
    {
        User::findOrFail($userId)->delete($userId);
    }

    public function updateUser($userId, $userAttr)
    {
        User::findOrFail($userId)->update($userAttr);
    }
}
