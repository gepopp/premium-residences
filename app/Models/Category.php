<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;




class Category extends Model
{
    use HasFactory;
    use HasTranslations;




    protected $guarded = [];




    public $translatable = [ 'name', 'description' ];




    public function articles()
    {

        return $this->belongsToMany(Article::class);
    }
}
