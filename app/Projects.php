<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Tasks;

class Projects extends Model
{
    protected $guarded = [];

    public function tasks()
    {
        return $this->hasMany(Tasks::class);
    }

    public function addTask($task)
    {
        $this->tasks()->create($task);
    }

    public function department()
    {
        return $this->belongsTo(Departments::class, 'dept_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'project_users');
    }
}
