<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['middleware' => ['auth']],function () {

    Route::get('/', 'Home\MainPage')->name('home.mainPage');

    Route::get('users', 'UserController@list')->name('get.users');

    Route::get('users/{userId}','UserController@show')->name('get.user.show');

    Route::get('users/{id}/adress','User\ShowAdress')
        ->where(['id' => '[0-9]'])
        ->name('get.user.adress')
        ->middleware(['profiling']);

    //Route::resource('games', 'GameController');

    Route::group([
    'prefix' => 'b/games',
    'namespace' => 'Game',
    'as' => 'games.b.',
    //'middleware' => ['profiling']
    ],function () {
        Route::get('dashboard', 'BuilderController@dashboard')->name('dashboard');
        Route::get('', 'BuilderController@index')->name('list');
        Route::get('{game}', 'BuilderController@show')->name('show');
    });


    Route::group(['prefix' => 'e/games','namespace' => 'Game', 'as' => 'games.e.'],function () {
        Route::get('dashboard', 'EloquentController@dashboard')->name('dashboard');
        Route::get('', 'EloquentController@index')->name('list');
        Route::get('{game}', 'EloquentController@show')->name('show');

    });

    Route::group(['prefix' => 'games','namespace' => 'Game', 'as' => 'games.'],function () {
        Route::get('dashboard', 'GameController@dashboard')->name('dashboard');
        Route::get('', 'GameController@index')->name('list');
        Route::get('{game}', 'GameController@show')->name('show');

    });

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

});

Auth::routes();

/* Route::group(['prefix' => 'e/games','namespace' => 'Game', 'as' => 'games.e.'],function () {
    Route::middleware(['profiling'])->group(function () {
    Route::get('dashboard', 'EloquentController@dashboard')->name('dashboard');
    Route::get('', 'EloquentController@index')->name('list');
    Route::get('{game}', 'EloquentController@show')->name('show');
    });

}); */
/* Route::resource('games', 'GameController')->only(['index','show']);
 */






/* Route::resource('admin/games', 'GameController')->only(['store']);

 */


/*
Route::get('users/test/{id}', 'UserController@testShow')->name('get.users.test.show');
Route::post('users/test/{id}', 'UserController@testStore')->name('get.users.test.store');
 */

