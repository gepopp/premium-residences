<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\MorphTo;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;



class TextBlock extends Resource {





    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\TextBlock::class;





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
        'id',
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
            ID::make()->sortable(),


            MorphTo::make( 'Zu Objekt', 'textable' )
                   ->nullable(),

            Text::make( 'field' )
                ->fillUsing( function ( $request, $model, $attribute, $requestAttribute ) {

                    $field               = explode( '.', $requestAttribute );
                    $model->{$attribute} = $field[0];
                } )->readonly(),

            Text::make( 'Titel', 'title' )
                ->required()
                ->rules( [ 'string', 'required', 'max:255' ] ),

            Text::make( 'Subtitel', 'subtitle' )
                ->nullable()
                ->rules( [ 'string', 'nullable', 'max:255' ] ),

            Textarea::make( 'Auszug', 'excerpt' )
                    ->nullable()
                    ->rules( [ 'string', 'nullable', 'max:255' ] )
                    ->alwaysShow(),

            Trix::make( 'Inhalt', 'contents' )
                ->required()
                ->rules( 'string', 'required' )
                ->alwaysShow(),

            BelongsTo::make( 'Autor', 'user', 'App\Nova\User' )
                     ->required()
                     ->searchable(),
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
