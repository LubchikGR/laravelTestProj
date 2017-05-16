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

Route::get('album/show/{id}', 'AlbumController@albumShow')->name('albumShow');
Route::match(['get', 'post'], 'album/edit/{id}', 'AlbumController@albumEdit')->name('albumEdit');
Route::match(['get', 'post'], 'album/new', 'AlbumController@albumNew')->name('albumNew');
Route::get('album/delete/{id}', 'AlbumController@albumDelete')->name('albumDelete');

Route::get('photo/show/{id}', 'PhotoController@photoShow')->name('photoShow');
Route::match(['get', 'post'], 'photo/edit/{id}', 'PhotoController@photoEdit')->name('photoEdit');
Route::match(['get', 'post'], 'photo/new', 'PhotoController@photoNew')->name('photoNew');
Route::get('photo/delete/{id}', 'PhotoController@photoDelete')->name('photoDelete');
