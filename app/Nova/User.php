<?php

namespace App\Nova;


use Carbon\Carbon;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Illuminate\Validation\Rules;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\MorphOne;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Http\Requests\NovaRequest;




class User extends Resource
{




    public static function label()
    {

        return 'Nuzter';

    }




    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\User::class;




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
        'id',
        'name',
        'email',
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

        Carbon::setlocale(config('UTC'));

        return [
            ID::make()->sortable(),

            Gravatar::make()->maxWidth(50),

            MorphOne::make('Kontaktphoto', 'contactphoto', 'App\Nova\Image')
                    ->required()
                    ->hideFromIndex()
                    ->hideFromDetail(),

            Text::make('Anrede', 'salutation')
                ->rules('required', 'max:255'),

            Text::make('Titel', 'academic_degree')
                ->rules('nullable', 'max:255'),

            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),


            DateTime::make('Verified At', 'email_verified_at')
                    ->default(now()),

            Text::make('Telefonnummer', 'phone')
                ->rules('required', 'max:255'),

            Password::make('Password')
                    ->onlyOnForms()
                    ->creationRules('required', Rules\Password::defaults())
                    ->updateRules('nullable', Rules\Password::defaults()),


            BelongsTo::make('Untenrehmen', 'company', 'App\Nova\Company')
                     ->nullable()
                     ->searchable(),


            BelongsToMany::make('Immobilien', 'realestate', 'App\Nova\RealEstate')
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
