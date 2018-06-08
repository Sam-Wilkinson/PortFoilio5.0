<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
