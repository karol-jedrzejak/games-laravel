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

Route::get('/', function () {
    dump('tesst');
    return view('welcome');
});

Route::get('/hello/{name}','HelloController@hello');


$uri = "/example";
Route::get($uri, fn () => "jestem get");
Route::post($uri, fn () => "jestem post");
Route::put($uri, fn () => "jestem put");
Route::patch($uri, fn () => "jestem patch");
Route::delete($uri, fn () => "jestem del");
Route::options($uri, fn () => "jestem options");


Route::match(['get', 'post'], '/match', function () {
    return "trest";

});

Route::view('/test/view', 'route.view');

Route::view('/test/view/var1', 'route.viewParam',['param' => 'var1 - to nasze dane','name' => 'tomek']);
Route::view('/test/view/var2', 'route.viewParam',['param' => 'var2 - to nasze dane','name' => 'marek']);

/* Route::get('users/{id}', function (int $id) {
    var_dump($id);
    dd($id);

}); */



// warunki jaki musi spełniack {nick} podane w formie wyrażenia reguralnego - małe liotery
Route::get('users/{nick}', function (string $nick) {
    var_dump($nick);
    dd($nick);

})->where(['nick' => '[a-z]+']);


// null gdy nie podamy
Route::get('nicks/{nick?}', function (string $nick = null) {
    var_dump($nick);
    dd($nick);

});
/* Route::get('/arrowFunction', fn () => "arrow function");
 */

Route::get('items/{id}', function (int $id) {
    return "items".$id;
})->name('shop.items.id');

Route::get('example', function () {
    $url = route('shop.items.id',['id' => 444],false); //jak false to adres bez głównej śćieżki
    dump($url);
});
