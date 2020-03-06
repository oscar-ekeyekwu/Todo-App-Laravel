<?php

namespace App\Repositories;

interface AdminsRepositoryInterface
{
    public function store($admin_details);
    public function allUsers();
    public function getUser($userId);
    public function destroy($userId);
    public function updateUser($userId, $userAttr);
}
