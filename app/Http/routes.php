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

$app->group(['prefix' => 'api'], function() use ($app) {
	$app->get('contacts', ['uses' => '\App\Http\Controllers\ContactsController@index']);
    $app->post('contacts', ['uses' => '\App\Http\Controllers\ContactsController@store']);
    $app->put('contacts/{id}', ['uses' => '\App\Http\Controllers\ContactsController@update']);
    $app->delete('contacts/{id}', ['uses' => '\App\Http\Controllers\ContactsController@destroy']);
});
