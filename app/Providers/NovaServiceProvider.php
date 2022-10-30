<?php

namespace App\Providers;

use App\Nova\User;
use App\Nova\Company;
use App\Nova\RealEstate;
use Illuminate\Http\Request;
use App\Nova\RealEstateArea;
use App\Nova\Dashboards\Main;
use App\Nova\RealEstateCategory;
use Laravel\Nova\Menu\Menu;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Nova;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\NovaApplicationServiceProvider;


class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();


        Nova::mainMenu(function (Request $request) {
            return [

                MenuItem::externalLink('Startseite', env('APP_URL')),


                MenuSection::make('Immobilien', [
                    MenuItem::resource(RealEstate::class ),
                    MenuItem::resource(RealEstateCategory::class),
                    MenuItem::resource(RealEstateArea::class),
                ])->icon('home-modern')->collapsable(),

                MenuSection::make('Nutzer', [
                    MenuItem::resource(User::class),
                    MenuItem::resource(Company::class),
                ])->icon('user')->collapsable(),
            ];
        });

    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
                ->withAuthenticationRoutes()
                ->withPasswordResetRoutes()
                ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                //
            ]);
        });
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [
            new Main()
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
