<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;




class Feature extends Model
{
    use HasFactory;
    use HasTranslations;




    public $translatable = [ 'feature' ];




    protected $guarded = [];




    public function realestate()
    {

        return $this->belongsTo(RealEstate::class, 'real_estate_id');
    }
}
