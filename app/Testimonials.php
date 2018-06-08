<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testimonials extends Model
{

    use SoftDeletes;
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    /**
     * Links the testimonials to the Client
     */
    public function client()
    {
        return $this->belongsTo('App\Client','client_id','id');
    }
}
