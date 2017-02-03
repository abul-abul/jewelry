<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gemstone extends Model
{
    protected $table = "gemstones";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        	'name', 'number'
    ];

    public function items()
    {
    	return $this->belongsToMany('App\Item', 'items_gemstone', 'gemstone_id', 'item_id');
    }
}
