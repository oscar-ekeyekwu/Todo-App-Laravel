<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersType extends Model
{
    public function user()
    {
        return $this->hasMany(User::class, 'user_type_id');
    }
}
