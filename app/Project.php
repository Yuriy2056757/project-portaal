<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{


    public function users()
    {
        $this->belongsTo('App\User', 'project_user', 'project_id', 'user_id');
    }
	public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }
}
