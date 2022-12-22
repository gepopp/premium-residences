<?php

namespace App\Models;


use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;




class Article extends Model
{
    use HasFactory;
    use HasTranslations;
    use HasSlug;
    use SoftDeletes;




    protected $guarded = [];




    public $translatable = [ 'title', 'content' ];




    public function images()
    {

        return $this->morphMany(Image::class, 'imageable');
    }




    public function author()
    {

        return $this->belongsTo(User::class, 'user_id');
    }




    public function categories()
    {

        return $this->belongsToMany(Category::class);
    }




    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {

        return SlugOptions::create()
                          ->generateSlugsFrom('title')
                          ->saveSlugsTo('slug');
    }




    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {

        return 'slug';
    }


}
