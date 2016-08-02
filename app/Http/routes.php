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

// Route::get('/',['as' => 'home', function () {
//     return view('pages.index');
// }]);

// Route::get('/test',['as' => 'page.test', function () {
//     return view('pages.test');
// }]);

Route::get('/',['as' => 'home', function () {
    return view('pages.index',['mainTitle' => '']);
}]);

Route::get('vote',['as' => 'vote', 'uses' => 'TurnoutsController@index']);
Route::post('vote/store',['as' => 'vote.store','uses' => 'TurnoutsController@store']);
Route::patch('vote/{id?}',['as' => 'vote.update','uses' => 'TurnoutsController@update']);
Route::delete('vote/delete/{id?}',['as' => 'vote.delete','uses' => 'TurnoutsController@destroy']);

Route::get('apply',['as' => 'apply',  'uses' => 'EventRegistsController@index']);
Route::post('apply/store',['as' => 'apply.store','uses' => 'EventRegistsController@store']);
Route::patch('apply/{id?}',['as' => 'apply.update','uses' => 'EventRegistsController@update']);
Route::delete('apply/delete/{id?}',['as' => 'apply.delete','uses' => 'EventRegistsController@destroy']);

Route::get('manager',['as' => 'manager', 'uses' => 'MembersController@index']);
Route::post('manager/store',['as' => 'manager.store','uses' => 'MembersController@store']);
Route::patch('manager/{id?}',['as' => 'manager.update','uses' => 'MembersController@update']);
Route::delete('manager/delete/{id?}',['as' => 'manager.delete','uses' => 'MembersController@destroy']);

Route::get('log',['as' => 'log', 'uses' => 'LogsController@index']);