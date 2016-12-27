<?php

namespace VSocial;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public function user()
    {
    	return $this->belongsTo('VSocial\User');
    }
    public function post()
    {
    	return $this->belongsTo('VSocial\Post');
    }
}
