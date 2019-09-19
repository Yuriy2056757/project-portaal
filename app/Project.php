<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name', 'slug', 'description',
    ];

    public function users()
    {
        return $this->belongsToMany('App\User', 'project_user', 'project_id', 'user_id');
    }
	public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }
}
