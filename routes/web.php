<?php

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
use Gunharth\Lightspeed\Lightspeed;

Route::get('/', function () {
    $api = new Lightspeed();
    dump($brands = $api->variants()->count());
    dump($brands = $api->variants()->get(93903053));

//    $aType = \App\LightspeedType::find(41865);
//    dump($aType->title);
//    dump($aType->attributes()->first()->title);

});

Route::get('/test', function () {

    $api = new Lightspeed();
    $products = $api->products()->get();


    foreach ($products as $product){
        var_dump($product["id"]);
        var_dump($api->productsImages()->get($product["id"]));
    }

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/lightspeedproducts', 'LightspeedProductsController');
Route::resource('/lightspeedproducts.packages', 'PackagesController', ['parameters' => 'singular']);

Route::get('/sync', 'SyncController@index')->name('sync');
Route::get('/sync/reindex/{resource}', ['uses'=>'SyncController@reindex']);
