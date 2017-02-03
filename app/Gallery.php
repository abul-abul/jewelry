<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'home_view';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
            'image',
            'status',
            'alt'
        ];

    public function images()
    {
        return $this->hasMany('App\CollectionGallery', 'gallery_id');
    }
}

