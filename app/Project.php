<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    /**
     * Links the Projects to their Clients
     */

    public function client()
    {
        return $this->belongsTo('App\Client','client_id','id');
    }
    public function testimonials()
    {
        return $this->belongsToMany('App\Testimonial', 'project_testimonial', 'project_id', 'testimonial_id');
    }
    public function technologies()
    {
        return $this->belongsToMany('App\Technology', 'project_technologies', 'project_id', 'technology_id');
    }
}
