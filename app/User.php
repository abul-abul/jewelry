<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    protected $table = 'users'; 
    /**
      * The attributes that are mass assignable.
      *
      * @var array
      */
    protected $fillable = [
        'first_name','last_name', 'image', 'email', 'password', 'activation_token', 'is_active', 'registered_with', 'facebook_id','twitter_id','google_id', 'postal_code', 'phone_number', 'country', 'city', 'address', 'items_count', 'state'
    ];

    /**
      * The attributes that should be hidden for arrays.
      *
      * @var array
      */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function items()
    {
        return $this->belongsToMany('App\Item', 'shopping_card', 'user_id', 'item_id')->with('images')->withPivot(['quantity', 'order', 'status', 'size']);
    }

    public function favorites()
    {
      return $this->belongsToMany('App\Item', 'favorites', 'user_id', 'item_id')->with('images');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Item', 'orders', 'user_id', 'item_id')->with('images')->withPivot(['quantity', 'status']);
    }

    public function shipping()
    {
      return $this->hasOne('App\ShippingAddress');
    }

    public function reviews()
    {
        return $this->hasMany('App\Review');
    }

    public function newsletter()
    {
        return $this->hasOne('App\NewsLetter');
    }

}
