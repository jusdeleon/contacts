<?php namespace App\Http\Controllers;

use App\Contact;
use Request;
use Validator;

class ContactsController extends Controller
{
    private $rules = [
        'first_name' => 'required',
        'last_name' => 'required',
        'mobile_number' => 'required',
        'telephone_number' => 'required',
        'email' => 'required|email',
    ];

    public function index()
    {
        return response(Contact::all());
    }

    public function store()
    {
        $input = Request::all();

        $validation = Validator::make($input, $this->rules);

        if ($validation->fails()) {
            return response(['error' => $validation->errors()]);
        }

        Contact::create($input);

        return response('Contact created');
    }

    public function update($id)
    {
        $contact = Contact::find($id);

        if ( ! $contact) {
            return(['error' => 'Model not found']);
        }

        $input = Request::all();

        $validation = Validator::make($input, $this->rules);

        if ($validation->fails()) {
            return response(['error' => $validation->errors()]);
        }

        $contact->update($input);

        return response('Contact updated');
    }

    public function destroy($id)
    {
        $contact = Contact::find($id);

        if ( ! $contact) {
            return(['error' => 'Model not found']);
        }

        $contact->delete();

        return response('Contact deleted');
    }

}