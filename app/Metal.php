<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Metal extends Model
{
    protected $table = "metals";

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
        return $this->belongsToMany('App\Item', 'items_metal','metal_id', 'item_id');
    }
}
