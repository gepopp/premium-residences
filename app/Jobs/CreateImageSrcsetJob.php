<?php

namespace App\Jobs;

use App\Models\Image;
use App\Models\Srcset;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Storage;
use Aws\StorageGateway\StorageGatewayClient;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateImageSrcsetJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;



    public Image $image;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( Image $image )
    {
        $this->image = $image;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $srcset = [];

        $image_contents = Storage::get( $this->image->path );
        $filename = pathinfo( $this->image->path );
        $image = \Intervention\Image\Facades\Image::make( $image_contents );
        $width = $image->width();

        $sizes = [$width];
        $width = $width - ( $width % 200 );
        while( $width > 0 ){
            $sizes[] = $width;
            $width -= 200;
        }

        $sizes = array_unique($sizes);

        foreach ( $sizes as $size ) {

            $image = \Intervention\Image\Facades\Image::make( $image_contents );
            $image->resize($size, null, function ($constraint) {
                $constraint->aspectRatio();
            })->encode('webp');

            $path = 'images/' . $this->image->folder . '/' . $filename['filename'] . '_' . $size . '.' . $filename['extension'] . '.webp';

            Storage::put( $path, $image->getEncoded() );
            $srcset[] = [
                'path'   => $path,
                'url'    => Storage::url( $path ),
                'width'  => $size,
                'height' => $image->height(),
            ];
        }


        Srcset::create( [
            'image_id'   => $this->image->id,
            'srcset'          => $srcset,
        ] );



    }
}
