<?php

namespace VSocial;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user()
    {
    	return $this->belongsTo('VSocial\User');
    }
    public function likes()
    {
    	return $this->hasMany('VSocial\Like');
    }
    public function comments()
    {
    	return $this->hasMany('VSocial\Comment');
    }
}
