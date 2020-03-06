<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'dept_id', 'password', 'user_type_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function department()
    {
        return $this->belongsTo(Departments::class, 'dept_id');
    }

    public function type()
    {
        return $this->belongsTo(UsersType::class, 'user_type_id');
    }

    public function projects()
    {
        return $this->hasMany(Projects::class, 'user_id');
    }
    public function tasks()
    {
        return $this->hasMany(Tasks::class, 'user_id');
    }

    public function project()
    {
        return $this->belongsToMany(Projects::class, 'project_users');
    }
}
