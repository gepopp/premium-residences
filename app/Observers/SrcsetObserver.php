<?php

namespace App\Observers;

use App\Models\Srcset;
use Illuminate\Support\Facades\Storage;



class SrcsetObserver
{

    /**
     * Handle the Srcset "deleted" event.
     *
     * @param  \App\Models\Srcset  $srcset
     * @return void
     */
    public function deleted(Srcset $srcset)
    {
        foreach ($srcset->srcset as $size){
            if(Storage::disk('s3')->exists($size['path'])){
                Storage::delete($size['path']);
            }
        }
    }
}
