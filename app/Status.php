<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = ['name', 'color', 'active'];

    public function task()
    {
        return $this->hasMany(Tasks::class, 'status_id');
    }
}
