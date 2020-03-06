<?php

namespace App\Repositories;

interface DepartmentsRepositoryInterface
{
    public function store($dept_details);
    public function all_departments();
    public function get_department($dept_id);
    public function destroy($dept_id);
    public function updateDepartment($dept_id, $dept_attr);
}
