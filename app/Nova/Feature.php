<?php

namespace App\Nova;


use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\BelongsTo;
use Spatie\NovaTranslatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Nova\Http\Requests\NovaRequest;
use Outl1ne\NovaInlineTextField\InlineText;




class Feature extends Resource
{

    const DEFAULT_INDEX_ORDER = 'order';




    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Feature::class;




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
     * @return array
     */
    public function fields(NovaRequest $request)
    {

        return [

            InlineText::make('Reihung', 'order')->rules([ 'required', 'numeric' ])->onlyOnIndex(),

            Number::make('Reihung', 'order')->default(function ($request) {

                $highest = \App\Models\RealEstateMetaData::orderBy('order', 'DESC')->where('real_estate_id', $request->viaResourceId)->first();
                $order = $highest->order ?? 0;

                return $order + 100;
            })->required()->hideFromIndex(),
            BelongsTo::make('Immobilie', 'realestate', 'App\Nova\RealEstate'),

            Translatable::make([
                Text::make('Merkmal', 'feature')
                    ->required(),
            ]),
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




    public static function indexQuery(NovaRequest $request, $query)
    {

        $query->when(empty($request->get('orderBy')), function (Builder $q) {

            $q->getQuery()->orders = [];

            return $q->orderBy(static::DEFAULT_INDEX_ORDER, 'DESC');
        });
    }
}
