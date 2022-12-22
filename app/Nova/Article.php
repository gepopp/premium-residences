<?php

namespace App\Nova;


use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\MorphMany;
use Laravel\Nova\Fields\BelongsToMany;
use Spatie\NovaTranslatable\Translatable;
use Laravel\Nova\Http\Requests\NovaRequest;




class Article extends Resource
{

    public static function label()
    {

        return 'Artikel';

    }




    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Article>
     */
    public static $model = \App\Models\Article::class;




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
     * @return array
     */
    public function fields(NovaRequest $request)
    {

        return [
            Translatable::make([
                Text::make('Titel', 'title')
                    ->rules([ 'string', 'required', 'max:250' ])
                    ->required(),

                Trix::make('Inhalt', 'content')
                    ->rules([ 'required', 'string' ])
                    ->required(),
            ]),

            BelongsTo::make('Autor', 'author', 'App\Nova\User')
                     ->required()
                     ->searchable(),

            BelongsToMany::make('Kategorien', 'categories', 'App\Nova\Category')
                         ->required(),

            MorphMany::make('Bilder', 'images', 'App\Nova\Image')
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
