<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class Image extends Model {





    use HasFactory;



    protected $guarded = [];





    protected $with = [ 'srcset' ];





    public function imageable() {

        return $this->morphTo( 'imageable' );
    }





    public function srcset() {

        return $this->hasOne( Srcset::class );
    }

}
