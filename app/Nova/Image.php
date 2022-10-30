<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\MorphTo;
use Laravel\Nova\Fields\Textarea;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Http\Requests\NovaRequest;



class Image extends Resource {





    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Image::class;





    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';





    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];





    protected $morphField = null;





    /**
     * Get the fields displayed by the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     *
     * @return array
     */
    public function fields( NovaRequest $request ) {

        return [

            ID::make()->sortable(),

            MorphTo::make('imageable')->types([
                RealEstate::class,
                Company::class,
                TextBlock::class
            ])->nullable(),

            \Laravel\Nova\Fields\Image::make( 'Bild', 'path' )
                                      ->store( function ( Request $request, $model, $attribute, $requestAttribute ) {

                                          $field = explode('.', $requestAttribute);

                                          $uploaded_image = $request->path ?? $request->{$field[0]}['path'];

                                          $image  = \Intervention\Image\Facades\Image::make( $uploaded_image->get() );
                                          $folder = time();

                                          return [
                                              'path'   => $uploaded_image->storeAs( 'images/' . $folder, $uploaded_image->getClientOriginalName(), 's3' ),
                                              'size'   => $uploaded_image->getSize(),
                                              'width'  => $image->width(),
                                              'height' => $image->height(),
                                              'url'    => Storage::disk( 's3' )->url( 'images/' . $uploaded_image->getClientOriginalName() ),
                                              'folder' => $folder,
                                              'field'  => $request->viaRelationship ? $request->viaRelationship : $field[0]
                                          ];
                                      } )->required()->rules('image', 'max:5000'),

            Text::make( 'Bildtitel', 'alt' )->required()->rules( [ 'string', 'required', 'max:250' ] ),
            Textarea::make( 'Bildbeschreibung', 'description' ),
            Text::make('Feld', 'field')->readonly()

        ];
    }




    /**
     * Get the cards available for the request.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     *
     * @return array
     */
    public function cards( NovaRequest $request ) {

        return [];
    }





    /**
     * Get the filters available for the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     *
     * @return array
     */
    public function filters( NovaRequest $request ) {

        return [];
    }





    /**
     * Get the lenses available for the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     *
     * @return array
     */
    public function lenses( NovaRequest $request ) {

        return [];
    }





    /**
     * Get the actions available for the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     *
     * @return array
     */
    public function actions( NovaRequest $request ) {

        return [];
    }
}
