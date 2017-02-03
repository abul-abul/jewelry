<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
     protected $table = 'articles';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
            'title',
            'content',
            'video',
            'main_image',
            'alt'
        ];

    public function blogImages()
    {
        return $this->hasMany('App\BlogImage','article_id');
       
    }


}
