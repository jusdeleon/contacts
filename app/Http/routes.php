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

// $app->get('/', function() use ($app) {
//     return $app->welcome();
// });

use App\Contact;

$rules = [
    'first_name' => 'required',
    'last_name' => 'required',
    'mobile_number' => 'required',
    'telephone_number' => 'required',
    'email' => 'required|email',
];

$app->group(['prefix' => 'api'], function() use ($app, $rules) {
	$app->get('contacts', function() {
		return response(Contact::all());
	});

    $app->post('contacts', function() use ($rules) {
        $input = Request::all();

        $validation = Validator::make($input, $rules);

        if ($validation->fails()) {
            return response(['error' => $validation->errors()]);
        }

        Contact::create($input);

        return response('Contact created');
    });

    $app->put('contacts/{id}', function($id) use ($rules) {
        $contact = Contact::find($id);

        if ( ! $contact) {
            return(['error' => 'Model not found']);
        }

        $input = Request::all();

        $validation = Validator::make($input, $rules);

        if ($validation->fails()) {
            return response(['error' => $validation->errors()]);
        }

        $contact->update($input);

        return response('Contact updated');
    });

    $app->delete('contacts/{id}', function($id) {
        $contact = Contact::find($id);

        if ( ! $contact) {
            return(['error' => 'Model not found']);
        }

        $contact->delete();

        return response('Contact deleted');
    });
});
