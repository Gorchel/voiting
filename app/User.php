<?php

namespace App;

use Cartalyst\Sentinel\Users\EloquentUser as CartalystUser;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends CartalystUser
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'sex','first_name', 'last_name', 'file_path', 'voite_count', 'description',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function сontestants()
    {
        return $this->belongsToMany('App\User', 'voites', 'voting', 'сontestant');
    }

    public function voting()
    {
        return $this->belongsToMany('App\User', 'voites', 'сontestant', 'voting');
    }
}
