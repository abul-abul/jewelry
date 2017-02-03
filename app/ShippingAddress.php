<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    protected $table = 'shipping_address';

    /**
      * The attributes that are mass assignable.
      *
      * @var array
      */
    protected $fillable = [
                            'country',
                            'city',
                            'address',
                            'postal_code',
                            'user_id',
                            'state'
                             ];

}
