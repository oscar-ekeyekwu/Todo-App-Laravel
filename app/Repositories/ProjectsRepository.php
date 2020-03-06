<?php

namespace App\Repositories;

use App\Projects;

class ProjectsRepository implements ProjectsRepositoryInterface
{
    public function allProjects()
    {
        return Projects::where('user_id', auth()->id())->get();
    }

    public function store($attributes)
    {
        Projects::create($attributes);
    }

    public function updateProject($id, array $attributes)
    {
        Projects::findOrFail($id)->update($attributes);
    }

    public function destroy($id)
    {
        Projects::findOrFail($id)->delete($id);
    }

    public function getProject($id)
    {
        // abort_if($id != auth()->id(),403);
        return Projects::findOrFail($id);
    }

    public function allDepartmentProjects($deptHeadId)
    {

        return Projects::all()->where('dept_id', $deptHeadId);
    }

    public function allDepartmentProjectIds($deptHeadId)
    {
        return Projects::all()->where('dept_id', $deptHeadId)->pluck('id');
    }
}
