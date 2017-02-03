<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
     protected $table = 'sliders';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image',
        'description',
        'alt'
    ];

    // public function collection()
    // {
    //     return $this->belongsTo('App\Collection', 'collection_id');
    // }

}
