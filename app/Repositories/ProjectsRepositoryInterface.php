<?php

namespace App\Repositories;

interface ProjectsRepositoryInterface
{
    public function allProjects();
    public function store($attributes);
    public function updateProject($id, array $attributes);
    public function destroy($id);
    public function getProject($id);
    public function allDepartmentProjects($deptHeadId);
    public function allDepartmentProjectIds($deptHeadId);
}
