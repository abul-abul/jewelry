<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    
    protected $table = 'categories';
    /**
      * The attributes that are mass assignable.
      *
      * @var array
      */
    protected $fillable = [
        'category',
        'image',
        'style',
        'alt'
        ];

        public function item()
        {
        	return $this->hasMany('App\Item');
        }
}
