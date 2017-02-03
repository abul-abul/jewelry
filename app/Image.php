<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
     protected $table = 'images';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'path', 'item_id'
    ];

    public function items()
    {
    	return $this->belongsTo('App\Item', 'item_id');
       
    }
}
