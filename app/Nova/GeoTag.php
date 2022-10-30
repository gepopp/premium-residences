<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\MorphTo;
use Laravel\Nova\Fields\Country;
use Laravel\Nova\Fields\KeyValue;
use Laravel\Nova\Http\Requests\NovaRequest;



class GeoTag extends Resource {





    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\GeoTag::class;





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

            MorphTo::make( 'geotagable' )
                   ->types( [
                       RealEstate::class,
                       Company::class,
                       User::class,
                   ] )->nullable(),

            Text::make( 'Adresse', 'address' )
                ->required()
                ->rules( [ 'string', 'required', 'max:200' ] ),

            Text::make( 'Adresszusatz', 'address_addition' )
                ->nullable()
                ->rules( [ 'string', 'nullable', 'max:200' ] ),

            Text::make( 'Postleitzahl', 'zip' )
                ->required()
                ->rules( [ 'string', 'required', 'max:200' ] ),

            Text::make( 'Bundesland', 'state' )
                ->required()
                ->rules( [ 'string', 'required', 'max:200' ] ),

            Country::make( 'Land', 'county' )
                   ->required(),


            KeyValue::make( 'Koordinaten', 'geotag' )
                    ->disableEditingKeys()
                    ->disableDeletingRows()
                    ->disableAddingRows()
                    ->rules( 'json' )
                    ->default( [ 'lat' => '', 'lng' => '' ] ),


            Number::make( 'Raduis in Meter', 'radius' )
                  ->default( 0 )
                  ->rules( [ 'required', 'numeric', 'integer' ] ),

            Number::make( 'Zoomstufe auf der Karte', 'zoom' )
                  ->default( 14 )
                  ->rules( [ 'required', 'numeric', 'integer' ] ),
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
