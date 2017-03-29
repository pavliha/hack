<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function tasks() {
        return $this->belongsToMany(Task::class);
    }

    public function roles() {
        return $this->belongsToMany(Role::class);
    }

    public function has($roleName) {
        foreach ($this->roles()->get() as $role)
            if ($role->name == $roleName) return true;

        return false;
    }

}
