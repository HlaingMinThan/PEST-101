<?php

use App\Models\Contact;

it('can store contact', function ($email) {
    login()
        ->post('/contacts', [
            'first_name' => 'Hlaing Min',
            'last_name' => 'Than',
            'email' => $email,
            'phone' => '+09942377834',
            'address' => fake()->address,
            'city' => 'Yangon',
            'region' => "Myanmar",
            'country' => fake()->randomElement(["us", "ca"]),
        ])
        ->assertSessionHas('success', 'Contact created.');

    $contact = Contact::latest()->first();
    expect($contact)
        ->first_name
        ->not->toBe("Hlaing Mins")
        ->phone
        ->toBePhoneNumber();
})->with('emails');
