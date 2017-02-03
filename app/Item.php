<?php

namespace App;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Item extends Model implements SluggableInterface
{
    use SluggableTrait;

    protected $sluggable = [
        'build_from' => 'title',
        'save_to'    => 'slug',
    ];

    protected $table = 'items';
    /**
      * The attributes that are mass assignable.
      *
      * @var array
      */
    protected $fillable = [
                            'title',
                            'subtitle',
                            'description',
                            'price',
                            'new_price',
                            'discount',
                            'quantity', 
                            'status',
                            'collection_id',
                            'category_id',
                            'main_image_id',
                            'rating',
                            'occasion',
                            'meta_description',
                            'meta_title',
                            'meta_keywords',
                            'alt'
                             ];
    
    /**
     * Items that 
     */
    public function images()
    {
    	return $this->hasMany('App\Image');
       
    }

    public function collection()
    {
        return $this->belongsTo('App\Collection');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function gemstones()
    {
      return $this->belongsToMany('App\Gemstone', 'items_gemstone', 'item_id', 'gemstone_id');
    }

    public function videos()
    {
      return $this->hasOne('App\Video');
    }

    public function mainImages()
    {
        return $this->belongsTo('App\Image','main_image_id');
    }

    public function metals()
    {
        return $this->belongsToMany('App\Metal', 'items_metal', 'item_id', 'metal_id');
    }

    public function size()
    {
        return $this->hasMany('App\RingSize');
    }

    public function tags()
    {
        return $this->hasMany('App\Tag');
    }

    public function reviews()
    {
        return $this->hasMany('App\Review');
    }
}
