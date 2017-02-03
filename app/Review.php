<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = "reviews";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'review','item_id','user_id','status'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function item()
    {
        return $this->belongsTo('App\Item', 'item_id');
    }
}
