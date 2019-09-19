<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title', 'description'
    ];

    public function users()
    {
        $this->belongsTo('App\User', ' project_user', 'project_id', 'user_id');
    }
}
