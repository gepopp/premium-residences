<?php

namespace App\Models;


use Illuminate\Support\Str;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;




class RealEstate extends Model
{




    use HasFactory, HasSlug, HasTranslations;




    public $translatable = [ 'title', 'intro' ];




    protected $guarded = [];




    protected $casts = [ 'meta' => 'array', 'location_meta' => 'array' ];



    protected function scopeTitleimage($query)
    {
            $query->whereHas('titleimage');
    }




    public function texts()
    {

        return $this->morphMany(TextBlock::class, 'textable');
    }




    public function metadescription()
    {

        return $this->morphOne(TextBlock::class, 'textable')->where('field', '=', 'metadescription');
    }




    public function locationdescription()
    {

        return $this->morphOne(TextBlock::class, 'textable')->where('field', '=', 'locationdescription');
    }




    public function objectdescription()
    {

        return $this->morphOne(TextBlock::class, 'textable')->where('field', '=', 'objectdescription');
    }




    public function images()
    {

        return $this->morphMany(Image::class, 'imageable');
    }




    public function titleimage()
    {

        return $this->morphOne(Image::class, 'imageable')->where('imageable_field', '=', 'titleimage');
    }




    public function featuresimage()
    {

        return $this->morphOne(Image::class, 'imageable')->where('imageable_field', '=', 'featuresimage')->latestOfMany();
    }




    public function sliderimages()
    {

        return $this->morphMany(Image::class, 'imageable')->where('imageable_field', '=', 'sliderimages');
    }




    public function category()
    {

        return $this->belongsTo(RealEstateCategory::class);
    }




    public function area()
    {

        return $this->belongsTo(RealEstateArea::class);
    }




    public function company()
    {

        return $this->belongsTo(Company::class);
    }




    public function user()
    {
        return $this->belongsTo(User::class);
    }




    public function address()
    {

        return $this->morphOne(Address::class, 'addressable');
    }




    public function contactpersons()
    {

        return $this->belongsToMany(User::class, 'contactpersons', 'user_id', 'real_estate_id');
    }




    public function features()
    {

        return $this->hasMany(Feature::class);
    }




    public function metas()
    {

        return $this->hasMany(RealEstateMetaData::class);
    }




    public function videoData(): Attribute
    {

        return Attribute::make(
            get: function ($value) {

                $value = $this->video_url;

                if ($value == null) {
                    return null;
                }

                if (Str::contains($value, 'vimeo')) {
                    $type = 'vimeo';
                } elseif (Str::contains($value, 'yt') || Str::contains($value, 'you')) {
                    $type = 'youtube';
                } else {
                    $type = 'video';
                }

                $components = parse_url($value);
                $params = [];

                if (array_key_exists('query', $components)) {
                    parse_str($components['query'], $params);
                }

                if (array_key_exists('v', $params)) {
                    $id = $params['v'];
                } else {
                    $path = parse_url($value, PHP_URL_PATH);
                    $fragments = explode('/', $path);
                    $id = array_pop($fragments);
                }

                if ($type == 'vimeo') {
                    $data = Http::get('https://vimeo.com/api/oembed.json?url=' . $value . '&width=1472&height=828');
                    $data = $data->collect()->toArray();
                }

                return [
                    'type' => $type,
                    'id'   => $id,
                    'url'  => $value,
                    'data' => $data ?? [],
                ];
            }
        );

    }




    /**
     * Get the options for generating the slug.
     */

    public function getSlugOptions(): SlugOptions
    {

        return SlugOptions::create()
                          ->generateSlugsFrom('title')
                          ->saveSlugsTo('slug')
                          ->usingLanguage('de');
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
