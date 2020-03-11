<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\Permission;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $deptHead_permission = Permission::where('slug', 'create-tasks')->first();
        $admin_permission = Permission::where('slug', 'edit-users')->first();

        //RoleTableSeeder.php
        $deptHead_role = new Role();
        $deptHead_role->slug = 'deptHead';
        $deptHead_role->name = 'Department Head';
        $deptHead_role->save();
        $deptHead_role->permissions()->attach($deptHead_permission);

        $admin_role = new Role();
        $admin_role->slug = 'admin';
        $admin_role->name = 'System admin';
        $admin_role->save();
        $admin_role->permissions()->attach($admin_permission);
    }
}
