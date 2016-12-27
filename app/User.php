<?php

namespace VSocial;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Hootlex\Friendships\Traits\Friendable;

class User extends Authenticatable
{
    use Notifiable;
    use Friendable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'birth_date', 'first_name', 'last_name', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts()
    {
        return $this->hasMany('VSocial\Post');
    }

    public function comments()
    {
        return $this->hasMany('VSocial\Comment');
    }

    public function likes()
    {
        return $this->hasMany('VSocial\Like');
    }
}
