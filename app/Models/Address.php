<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;




class Address extends Model
{
    use HasFactory;




    protected $guarded = [];




    public function addressable()
    {

        return $this->morphTo('addressable');
    }




    public function getGeocoordinatesAttribute()
    {

        $dec = $this->lat;
        $vars = explode(".", $dec);
        $deg = $vars[0];
        $tempma = "0." . $vars[1];

        $tempma = $tempma * 3600;
        $min = floor($tempma / 60);
        $sec = round($tempma - ($min * 60), 2);

        $string = $deg;
        $string .= ' ° ';
        $string .= $min;
        $string .= '\' ';
        $string .= $sec;
        $string .= '\'\' ';
        $string .= '&nbsp;&nbsp;';

        $dec = $this->long;
        $vars = explode(".",$dec);
        $deg = $vars[0];
        $tempma = "0.".$vars[1];

        $tempma = $tempma * 3600;
        $min = floor($tempma / 60);
        $sec = round( $tempma - ($min*60), 2 );

        $string .= $deg;
        $string .= ' ° ';
        $string .= $min;
        $string .= '\' ';
        $string .= $sec;
        $string .= '\'\' ';

        return $string;

    }

}
