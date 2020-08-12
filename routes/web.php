<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/','EventController@eventList')->middleware('guest');

Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => ['auth','role:admin']], function(){
    Route::resource('events','EventController');
    
});

Route::group(['middleware' => ['auth','role:user']], function(){
    Route::post('/events/book/{id}','EventController@bookEvent');
    Route::get('/events/booked','EventController@bookedEvent');
    Route::delete('/events/booked/{id}','EventController@cancelBookedEvent');
});

//route for user and guest
Route::group(['middleware' => ['userGuest']],function(){
    Route::get('/events','EventController@eventList');
    Route::get('/events/show/{id}','EventController@show');
});