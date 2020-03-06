<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    protected $guarded = [];

    public function project()
    {
        return $this->belongsTo(Projects::class, 'projects_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public static function toggleComplete(array $taskIds)
    {
        static::query()->whereNotNull('id')->update(['completed' => false]);

        static::query()->whereIn('id', $taskIds)->update(['completed' => true]);
    }
}
