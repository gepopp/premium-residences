<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;




class Srcset extends Model
{




    use HasFactory;




    protected $guarded = [];




    protected $casts = [ 'srcset' => 'array' ];




    protected $appends = [ 'srcsetString' ];




    public function image()
    {

        return $this->belongsTo(Image::class);
    }




    public function getSrcsetStringAttribute()
    {

        $srcset = '';

        foreach ($this->srcset as $image) {
            $srcset .= $image['url'];
            $srcset .= ' ';
            $srcset .= $image['width'];
            $srcset .= 'w, ';
        }

        return rtrim($srcset, ', ');

    }

}
