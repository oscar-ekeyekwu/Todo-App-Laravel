<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{
    protected $guarded = [];

    public function users()
    {
        return $this->hasMany(User::class, 'dept_id');
    }

    public function projects_dept()
    {
        return $this->hasMany(Projects::class);
    }
}
