<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', function () {
    $albums = fileSaver\Entity\Album::all();
    return view('album/index', [
        'albums' => $albums,
    ]);

});

Route::get('album/show/{id}', 'AlbumController@albumIndex')->name('albumIndex');
Route::match(['get', 'post'], 'album/edit/{id}', 'AlbumController@albumEdit')->name('albumEdit');
Route::match(['get', 'post'], 'album/new', 'AlbumController@albumNew')->name('albumNew');
Route::get('album/delete/{id}', 'AlbumController@albumDelete')->name('albumDelete');

Route::group(['as' => 'photo'], function () {
    Route::get('index', 'PhotoController@photoIndex');
    Route::match(['get', 'post'], 'edit/{id}', 'PhotoController@photoEdit');
    Route::match(['get', 'post'], 'new', 'PhotoController@photoNew');
    Route::get('delete/{id}', 'PhotoController@photoDelete');
});