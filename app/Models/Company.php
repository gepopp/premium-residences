<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class Company extends Model {





    use HasFactory;



    protected $guarded = [];





    public function logo() {

        return $this->morphOne( Image::class, 'imageable' )->where('field', 'logo')->latestOfMany();
    }

}
