<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogImage extends Model
{
      protected $table = 'article_images';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
            'article_id',
            'name',
        ];

    public function article()
    {
        return $this->belongsTo('App\Blog');
       
    }
}
