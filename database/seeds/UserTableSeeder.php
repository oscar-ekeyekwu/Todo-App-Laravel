<?php

use Illuminate\Database\Seeder;
use App\Permission;
use App\Role;
use App\User;
use App\UsersType;
use App\Departments;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $deptHead_role = Role::where('slug', 'deptHead')->first();
        $admin_role = Role::where('slug', 'admin')->first();
        $deptHead_perm = Permission::where('slug', 'create-tasks')->first();
        $admin_perm = Permission::where('slug', 'edit-users')->first();

        $department = new Departments();
        $department->dept_name = 'No Department';
        $department->dept_code = 'NOD';
        $department->save();

        $userType = new UsersType();
        $userType->type = 'user';
        $userType->save();

        $userType = new UsersType();
        $userType->type = 'admin';
        $userType->save();

        $userType = new UsersType();
        $userType->type = 'Department Head';
        $userType->save();

        $deptHead = new User();
        $deptHead->name = 'Department Admin';
        $deptHead->email = 'deptadmin@todos.test';
        $deptHead->password = bcrypt('secret');
        $deptHead->save();
        $deptHead->roles()->attach($deptHead_role);
        $deptHead->permissions()->attach($deptHead_perm);


        $admin = new User();
        $admin->name = 'System Admin';
        $admin->email = 'system@todos.test';
        $admin->password = bcrypt('secret');
        $admin->save();
        $admin->roles()->attach($admin_role);
        $admin->permissions()->attach($admin_perm);
    }
}
