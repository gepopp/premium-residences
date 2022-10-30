<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class GeoTag extends Model {





    use HasFactory;



    protected $guarded = [];





    protected $casts = [ 'geotag' => 'json' ];





    public function geotagable() {

        return $this->morphTo( 'geotagable' );
    }


}
