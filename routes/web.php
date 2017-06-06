<?php
use App\Models\Photo;
use App\User;
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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', 'HomeController@index');
Route::get('/welcome/{name?}/{lastname?}/{age?}', 'WelcomeController@welcome')->where([
    'name' => '[a-zA-Z]+',
    'lastname' => '[a-zA-Z]+',
    'age' => '[0-9]{1,3}'
]);
Route::get('/albums', 'AlbumsController@index')->name('albums');
Route::get('/albums/create', 'AlbumsController@create')->name('album.create');
Route::post('/albums', 'AlbumsController@save')->name('album.save');
Route::get('/albums/{id}/edit', 'AlbumsController@edit');
Route::delete('/albums/{id}', 'AlbumsController@delete');

Route::patch('/albums/{id}', 'AlbumsController@store');

Route::get('/albums/{id}', 'AlbumsController@show')->where('id', '[0-9]+');

Route::get('/photos', function(){
    return Photo::all();
    
});

Route::get('/usernoalbum', function(){
    return DB::table('users as u')->leftJoin('albums as a', 'a.user_id', 'u.id')
            ->select('name', 'email', 'u.id')->whereNull('a.album_name')->get();
    
});

Route::get('/users', function(){
    return \App\User::all();
    
});


/*
        ->where('name', '[a-zA-Z]+')
        ->where('lastname', '[a-zA-Z]+');
 */