<?php
use App\Models\Album;
use App\Models\Photo;
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
Route::get('/albums', function(){
    return Album::all();
    
});

Route::get('/photos', function(){
    return Photo::all();
    
});

Route::get('/users', function(){
    return \App\User::all();
    
});


/*
        ->where('name', '[a-zA-Z]+')
        ->where('lastname', '[a-zA-Z]+');
 */