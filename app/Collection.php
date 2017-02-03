<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
     protected $table = 'collections';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
            'name',
            'image',
            'description',
            'alt'
        ];

    public function item()
    {
        return $this->hasMany('App\Item');
    }
    
}
