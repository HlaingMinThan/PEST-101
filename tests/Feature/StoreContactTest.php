<?php

use App\Models\Contact;

it('can store contact', function () {
    login()
        ->post('/contacts', [
            'first_name' => 'Hlaing Min',
            'last_name' => 'Than',
            'email' => 'hlaingminthan92@gmail.com',
            'phone' => '+09942377834',
            'address' => fake()->address,
            'city' => 'Yangon',
            'region' => "Myanmar",
            'country' => fake()->randomElement(["us", "ca"]),
        ]);


    $contact = Contact::latest()->first();

    expect($contact)
        ->first_name
        ->not->toBe("Hlaing Mins")
        ->phone
        ->toBePhoneNumber();
});
