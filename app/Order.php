<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = ['user_id', 'item_id', 'quantity', 'status', 'country', 'city', 'state', 'address', 'postal_code', 'size', 'seen', 'code'];

    public function item()
    {
    	return $this->belongsTo('App\Item', 'item_id');
    }

    public function user()
    {
    	return $this->belongsTo('App\User', 'user_id');
    }
}
