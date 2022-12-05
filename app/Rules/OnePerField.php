<?php

namespace App\Rules;


use App\Models\Image;
use Illuminate\Contracts\Validation\Rule;




class OnePerField implements Rule
{


    public Image $image;




    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Image $image)
    {

        $this->image = $image;
    }




    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value )
    {


    }

}
