<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class RealEstate extends Model {





    use HasFactory, HasSlug;



    protected $guarded = [];





    protected $casts = [ 'meta' => 'array', 'location_meta' => 'array' ];





    public function metadescription() {

        return $this->morphOne( TextBlock::class, 'textable' )->where( 'field', '=', 'metadescription' );
    }





    public function locationdescription() {

        return $this->morphOne( TextBlock::class, 'textable' )->where( 'field', '=', 'locationdescription' );
    }





    public function objectdescription() {

        return $this->morphOne( TextBlock::class, 'textable' )->where( 'field', '=', 'objectdescription' );
    }





    public function titleimage() {

        return $this->morphOne( Image::class, 'imageable' )->where( 'field', '=', 'titleimage' );
    }





    public function featuresimage() {

        return $this->morphOne( Image::class, 'imageable' )->where( 'field', '=', 'featuresimage' );
    }





    public function sliderimages() {

        return $this->morphMany( Image::class, 'imageable' )->where( 'field', '=', 'sliderimages' );
    }





    public function category() {

        return $this->belongsTo( RealEstateCategory::class );
    }





    public function area() {

        return $this->belongsTo( RealEstateArea::class );
    }





    public function company() {

        return $this->belongsTo( Company::class );
    }





    public function user() {

        return $this->belongsTo( User::class );
    }





    public function geotag() {

        return $this->morphOne( GeoTag::class, 'geotagable' );
    }





    public function contactpersons() {

        return $this->belongsToMany( User::class, 'contactpersons', 'user_id', 'real_estate_id' );
    }





    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions {

        return SlugOptions::create()
                          ->generateSlugsFrom( 'title' )
                          ->saveSlugsTo( 'slug' )
                          ->doNotGenerateSlugsOnUpdate();
    }





    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName() {

        return 'slug';
    }
}
