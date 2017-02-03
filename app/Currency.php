<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
     protected $table = 'currencies';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
            'active',
            'code'
        ];
}
