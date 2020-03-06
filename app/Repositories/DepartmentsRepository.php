<?php

namespace App\Repositories;

use App\Departments;

class DepartmentsRepository implements DepartmentsRepositoryInterface
{
    // public function all_departments()
    // {
    //     return Projects::where('user_id', auth()->id())->get();
    // }

    public function store($dept_details)
    {
        Departments::create($dept_details);
    }

    public function all_departments()
    {
        return Departments::all();
    }

    public function get_department($dept_id)
    {
        return Departments::where('id', $dept_id)->get();
    }

    public function destroy($dept_id)
    {
        Departments::findOrFail($dept_id)->delete($dept_id);;
    }

    public function updateDepartment($dept_id, $dept_attr)
    {
        Departments::findOrFail($dept_id)->update($dept_attr);
    }
}
