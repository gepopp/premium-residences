<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;




class Feature extends Model
{
    use HasFactory;
    use HasTranslations;




    public $translatable = [ 'feature' ];




    protected $guarded = [];



    protected static function booted()
    {

        static::addGlobalScope('order', function (Builder $query){
           $query->orderBy('order', 'DESC');
        });


    }




    public function realestate()
    {

        return $this->belongsTo(RealEstate::class, 'real_estate_id');
    }
}
