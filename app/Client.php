<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
	use SoftDeletes;
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
	protected $dates = ['deleted_at'];

	/**
	 * Links the Clients to their projects
	 */
    public  function projects()
	{
		return  $this->hasMany('App\Project','client_id','id');
	}
	/**
	 * Links the Clients to their testimonials
	 */
    public  function testimonials()
	{
		return  $this->hasMany('App\Testimonials','client_id','id');
	}      
}
