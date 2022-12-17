<?php

namespace App\Nova;


use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\MorphTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Http\Requests\NovaRequest;
use BrandonJBegle\GoogleAutocomplete\AddressMetadata;
use BrandonJBegle\GoogleAutocomplete\GoogleAutocomplete;




class Address extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Address>
     */
    public static $model = \App\Models\Address::class;




    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'line_1';




    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'line_1',
    ];




    /**
     * Get the fields displayed by the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {

        return [
            MorphTo::make('Addressable')->types([
                RealEstate::class,
                Company::class,
            ]),
            GoogleAutocomplete::make('Adresse Suchen', 'search_string')
                              ->withValues([ 'address_components', 'formatted_address', 'latitude', 'longitude', 'street_number', 'route', 'locality', 'administrative_area_level_1', 'country', 'postal_code' ]),

            AddressMetadata::make('Adresse', 'line_1')
                           ->fromValue('{{route}} {{street_number}}')
                           ->required()
                           ->rules([ 'string', 'required', 'max:250' ]),
            Text::make('Zusatz', 'line_2')->rules([ 'string', 'nullable', 'max:250' ]),
            AddressMetadata::make('Postleitzahl', 'zip')
                           ->fromValue('postal_code')
                           ->required()
                           ->rules([ 'string', 'required', 'max:250' ]),
            AddressMetadata::make('Stadt', 'city')
                           ->fromValue('locality')
                           ->required()
                           ->rules([ 'string', 'required', 'max:250' ]),
            AddressMetadata::make('Bundesland', 'state')
                           ->fromValue('administrative_area_level_1')
                           ->required()
                           ->rules([ 'string', 'required', 'max:250' ]),
            AddressMetadata::make('Land', 'country')
                           ->fromValue('country')
                           ->required()
                           ->rules([ 'string', 'required', 'max:250' ]),
            AddressMetadata::make('Adresse formatiert', 'formatted_address')
                           ->fromValue('formatted_address')
                           ->readonly(),
            AddressMetadata::make('Breitengrad', 'lat')
                           ->fromValue('latitude')
                           ->required()
                           ->rules([ 'string', 'required', 'max:250' ]),
            AddressMetadata::make('Längengrad', 'long')
                           ->fromValue('longitude')
                           ->required()
                           ->rules([ 'string', 'required', 'max:250' ]),
            Number::make('Karten Zoomfaktor', 'zoom')
                  ->default(14)
                  ->required()
                  ->rules([ 'numeric', 'integer', 'required', 'max:22', 'min:1' ]),
            Boolean::make('Pin auf Karte Anzeigen', 'show_pin')
                   ->default(true),


        ];
    }




    /**
     * Get the cards available for the request.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {

        return [];
    }




    /**
     * Get the filters available for the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {

        return [];
    }




    /**
     * Get the lenses available for the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {

        return [];
    }




    /**
     * Get the actions available for the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {

        return [];
    }
}
