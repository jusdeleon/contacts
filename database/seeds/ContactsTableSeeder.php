<?php

use App\Contact;
use Illuminate\Database\Seeder;

class ContactsTableSeeder extends Seeder {

    public function run()
    {
        foreach(range(1, 20) as $index) {
            Contact::create([
                'first_name' => str_random(5),
                'last_name' => str_random(5),
                'mobile_number' => rand(),
                'telephone_number' => rand(),
                'email' => str_random(5),
            ]);
        }
    }
}