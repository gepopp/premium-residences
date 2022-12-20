<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;




class Company extends Model
{




    use HasFactory;




    protected $guarded = [];




    public function logo()
    {

        return $this->morphOne(Image::class, 'imageable')->where('imageable_field', 'logo')->latestOfMany();
    }




    public function address()
    {

        return $this->morphOne(Address::class, 'addressable');
    }




    public function users()
    {

        return $this->hasMany(User::class);
    }
}
