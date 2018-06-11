<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    public function projects()
    {
        return $this->belongsToMany('App\Project', 'project_technologies', 'technology_id', 'project_id');
    }
}
