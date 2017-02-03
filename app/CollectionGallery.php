<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CollectionGallery extends Model
{
    protected $table = 'collection_gallery'; 
    /**
      * The attributes that are mass assignable.
      *
      * @var array
      */
    protected $fillable = [
    					'name',
    					'gallery_id'
    					];


}
