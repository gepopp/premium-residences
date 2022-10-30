<?php

namespace App\Observers;

use App\Models\Image;
use App\Jobs\CreateImageSrcsetJob;
use Illuminate\Support\Facades\Storage;



class ImageObserver {





    /**
     * Handle the Image "created" event.
     *
     * @param \App\Models\Image $image
     *
     * @return void
     */
    public function created( Image $image ) {

        CreateImageSrcsetJob::dispatch( $image );
    }





    /**
     * Handle the Image "updated" event.
     *
     * @param \App\Models\Image $image
     *
     * @return void
     */
    public function updated( Image $image ) {

        if ( $image->isDirty( 'path' ) ) {

            if ( Storage::exists( $image->getOriginal( 'path' ) ) ) {
                Storage::delete( $image->getOriginal( 'path' ) );
            }

            $image->srcset?->delete();

            CreateImageSrcsetJob::dispatch( $image );

        }


    }





    /**
     * Handle the Image "deleted" event.
     *
     * @param \App\Models\Image $image
     *
     * @return void
     */
    public function deleted( Image $image ) {

        if ( Storage::exists( $image->path ) ) {
            Storage::delete( $image->path );
        }

        $image->srcset?->delete();

        Storage::deleteDirectory($image->folder);

    }

}
