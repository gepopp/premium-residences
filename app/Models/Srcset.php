<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class Srcset extends Model {





    use HasFactory;



    protected $guarded = [];





    protected $casts = [ 'srcset' => 'array' ];





    public function image() {

        return $this->belongsTo( Image::class );
    }

}
