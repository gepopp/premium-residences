<?php


use Illuminate\Support\Facades\Route;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group([ 'middleware' => 'language' ], function () {

    Route::get('/', function () {

        return view('welcome');
    })->name('home');


    Route::middleware([
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified',
    ])->group(function () {

        Route::get('/dashboard', function () {

            return view('dashboard');
        })->name('dashboard');
    });


    Route::get('register', function () {

        return view('auth.register');
    })->middleware('guest')->name('register');


    Route::get('immobilien/{realestate}', [ \App\Http\Controllers\RealEstateController::class, 'show' ])->name('real-estate.show');
    Route::get('realestate-sliderimages/{realEstate}', [ \App\Http\Controllers\RealEstateController::class, 'sliderImages' ])->name('realestate-sliderimages');

});




