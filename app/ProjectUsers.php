<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class ProjectUsers extends Model
{
    protected $guarded = [];

    public function projects()
    {
        return $this->belongsTo(Projects::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public static function toggleUsers(array $userIds, $projectId)
    {
        self::all()->where('projects_id', $projectId)->dropAll();
    }
}
