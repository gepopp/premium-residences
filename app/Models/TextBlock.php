<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class TextBlock extends Model {





    use HasFactory;
    use HasTranslations;


    public $translatable = ['title', 'subtitle', 'contents'];



    protected $guarded = [];





    public function user() {

        return $this->belongsTo( User::class );
    }





    public function textable() {

        return $this->morphTo( 'textable' );
    }
}
