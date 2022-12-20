<?php

namespace App\Nova;


use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\MorphOne;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\MorphMany;
use Laravel\Nova\Fields\BelongsToMany;
use Illuminate\Support\Facades\Storage;
use Spatie\NovaTranslatable\Translatable;
use Laravel\Nova\Http\Requests\NovaRequest;




class RealEstate extends Resource
{




    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\RealEstate::class;




    public static function label()
    {

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
    public function fields(NovaRequest $request)
    {

        return [


            \Laravel\Nova\Fields\Image::make('Titelbild')
                                      ->hideWhenCreating()
                                      ->hideWhenUpdating()
                                      ->thumbnail(function () {

                                          if ($this->titleimage) {
                                              return Storage::disk('s3')->url($this->titleimage->path);
                                          } else {
                                              return false;
                                          }
                                      }),

            Translatable::make([

                Text::make('Bezeichnung', 'title')
                    ->required()
                    ->rules([ 'string', 'required', 'max:255' ]),

                Textarea::make('Kurzbeschreibung', 'intro')
                        ->required()
                        ->rules([ 'string', 'required', 'min:100', 'max:160' ])
                        ->alwaysShow(),
            ]),

            Text::make('Website', 'url')
                ->rules([ 'nullable', 'string', 'url' ]),

            Text::make('Video', 'video_url')
                ->rules([ 'nullable', 'string', 'url' ]),

            Number::make('Preis', 'price')->required()->rules([ 'integer', 'numeric', 'required', 'min:1' ]),

            Boolean::make('Preis zeigen', 'show_price')->default(true),

            BelongsTo::make('Betreut durch', 'user', 'App\Nova\User')
                     ->required(),

            BelongsTo::make('Unternehmen', 'company', 'App\Nova\Company')
                     ->required(),

            BelongsTo::make('Kategorie', 'category', 'App\Nova\RealEstateCategory')
                     ->required(),

            BelongsTo::make('Gebiet', 'area', 'App\Nova\RealEstateArea')
                     ->required(),

            Select::make('Objekt Status', 'status')
                  ->options([
                      'new' => 'Erstbezug',
                      'old' => 'Kein Erstebezug',
                  ])
                  ->required()
                  ->default('new')
                  ->displayUsingLabels(),


            MorphOne::make('Adresse', 'address', 'App\Nova\Address')
                    ->required(),

            MorphMany::make('Bilder', 'images', 'App\Nova\Image'),

            MorphMany::make('Texte', 'texts', 'App\Nova\InlineTextBlock'),

            HasMany::make('Ausstattungsmerkmale', 'features', 'App\Nova\Feature'),

            HasMany::make('Metas', 'metas', 'App\Nova\RealEstateMetaData'),


            BelongsToMany::make('Kontaktpersonen', 'contactpersons', 'App\Nova\User')
                         ->nullable(),

        ];
    }




    /**
     * Get the cards available for the request.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     *
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
     *
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
     *
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
     *
     * @return array
     */
    public function actions(NovaRequest $request)
    {

        return [];
    }
}
