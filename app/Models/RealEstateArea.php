<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;




class RealEstateArea extends Model
{




    use HasFactory, HasTranslations;




    public $translatable = [ 'name', 'description' ];




    protected $guarded = [];




    public function image()
    {

        return $this->morphOne(Image::class, 'imageable');
    }
}
