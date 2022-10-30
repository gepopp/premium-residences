<?php

namespace App\Nova;

use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\MorphOne;
use Laravel\Nova\Fields\KeyValue;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\MorphMany;
use Laravel\Nova\Fields\BelongsToMany;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Http\Requests\NovaRequest;



class RealEstate extends Resource {





    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\RealEstate::class;





    public static function label() {

        return 'Immobilien';

    }





    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';





    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'title',
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


            \Laravel\Nova\Fields\Image::make( 'Titelbild' )
                                      ->hideWhenCreating()
                                      ->hideWhenUpdating()
                                      ->thumbnail( function () {

                                          return Storage::disk( 's3' )->url( $this->titleimage->path );
                                      } ),


            Text::make( 'Bezeichnung', 'title' )
                ->required()
                ->rules( [ 'string', 'required', 'max:255' ] ),

            Textarea::make( 'Kurzbeschreibung', 'intro' )
                    ->required()
                    ->rules( [ 'string', 'required', 'min:160', 'max:600' ] )
                    ->alwaysShow(),

            Number::make( 'Preis', 'price' )->required()->rules( [ 'integer', 'numeric', 'required', 'min:1' ] ),

            Boolean::make( 'Preis zeigen', 'show_price' )->default( true ),

            BelongsTo::make( 'Betreut durch', 'user', 'App\Nova\User' )
                     ->required(),

            BelongsTo::make( 'Unternehmen', 'company', 'App\Nova\Company' )
                     ->required(),


            BelongsTo::make( 'Kategorie', 'category', 'App\Nova\RealEstateCategory' )
                     ->required(),

            BelongsTo::make( 'Gebiet', 'area', 'App\Nova\RealEstateArea' )
                     ->required(),

            KeyValue::make( 'Meta' )->disableEditingKeys(),

            KeyValue::make( 'Ausstattungsmerkmale', 'location_meta' )->disableEditingKeys(),


            \Laravel\Nova\Fields\Image::make( 'Ausstattungsbild' )
                                      ->hideWhenCreating()
                                      ->hideWhenUpdating()
                                      ->thumbnail( function () {

                                          return $this->featuresimage ? Storage::disk( 's3' )->url( $this->featuresimage->path ) : null;
                                      } ),


            Trix::make( 'Ausstattungsbeschreibung', function () {

                return '<div><h3>' . $this->metadescription->title . '</h3><div>' . $this->metadescription->contents . '</div></div>';
            } )->alwaysShow()->showOnDetail()->hideWhenUpdating()->hideWhenCreating()->hideFromIndex(),


            Trix::make( 'Lagebeschreibung', function () {

                return '<div><h3>' . $this->locationdescription?->title . '</h3><div>' . $this->locationdescription?->contents . '</div></div>';
            } )->alwaysShow()->showOnDetail()->hideWhenUpdating()->hideWhenCreating()->hideFromIndex(),

            Trix::make( 'Objektbeschreibung', function () {

                return '<div><h3>' . $this->objectdescription?->title . '</h3><div>' . $this->objectdescription?->contents . '</div></div>';
            } )->alwaysShow()->showOnDetail()->hideWhenUpdating()->hideWhenCreating()->hideFromIndex(),


            MorphOne::make( 'Titelbild', 'titleimage', 'App\Nova\Image' )
                    ->required()
                    ->hideFromDetail(),

            MorphOne::make( 'Ausstattungsbild', 'featuresimage', 'App\Nova\Image' )
                    ->required()
                    ->hideFromDetail(),

            MorphOne::make( 'Ausstattungsbeschreibung', 'metadescription', 'App\Nova\InlineTextBlock' )->required()->hideFromDetail(),

            MorphOne::make( 'Lagebeschreibung', 'locationdescription', 'App\Nova\InlineTextBlock' )->required()->hideFromDetail(),

            MorphOne::make( 'Objektbeschreibung', 'objectdescription', 'App\Nova\InlineTextBlock' )->required()->hideFromDetail(),

            MorphMany::make( 'Slider Bilder', 'sliderimages', 'App\Nova\Image' ),


            BelongsToMany::make( 'Kontaktpersonen', 'contactpersons', 'App\Nova\User' )
                         ->nullable(),

            MorphOne::make( 'Geotag', 'geotag', 'App\Nova\Geotag' )
                    ->required()
                    ->hideFromDetail(),
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
