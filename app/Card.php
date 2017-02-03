<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $table = 'shopping_card';

    protected $fillable = ['user_id', 'item_id', 'quantity', 'user_ip', 'status', 'order', 'size'];

    public function items()
    {
        return $this->belongsTo('App\Item', 'item_id');
    }
}
