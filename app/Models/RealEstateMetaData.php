<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;




class RealEstateMetaData extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['text'];


    protected $guarded = [];


    protected static function booted()
    {

        static::addGlobalScope('order', function (Builder $query){
            $query->orderBy('order');
        });


    }




    public function real_estate(){
        return $this->belongsTo(RealEstate::class);
    }
}
