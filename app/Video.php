<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
     protected $table = 'videos';
    /**
      * The attributes that are mass assignable.
      *
      * @var array
      */
    protected $fillable = [
        'name' , 
        'item_id'
    ];

    public function items()
    {
    	return $this->belongsTo('App\Item','item_id');
       
    }
}
