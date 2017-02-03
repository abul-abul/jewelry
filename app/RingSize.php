<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RingSize extends Model
{
     protected $table = 'ring_size';
    /**
      * The attributes that are mass assignable.
      *
      * @var array
      */
    protected $fillable = [
                            'size',
                            'item_id'
                             ];
    
}
