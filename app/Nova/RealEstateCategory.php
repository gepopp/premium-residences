<?php

namespace App\Nova;

use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\MorphOne;
use Laravel\Nova\Http\Requests\NovaRequest;



class RealEstateCategory extends Resource {



    public static function label() {

        return 'Immobilien Kategorien';

    }

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\RealEstateCategory::class;





    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';





    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name',
    ];





    /**
     * Get the fields displayed by the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     *
     * @return array
     */
    public function fields( NovaRequest $request ) {

        return [
            MorphOne::make( 'Bild', 'image', 'App\Nova\Image' ),

            Text::make( 'Name' )
                ->required()
                ->rules( [ 'string', 'required', 'max:255' ] ),

            Trix::make( 'Beschreibung', 'description' )
                ->nullable()
                ->rules( [ 'string', 'nullable' ] ),
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
