<?php

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

use App\Models\Account;
use App\Models\User;
use PHPUnit\Framework\ExpectationFailedException;

uses(
    Tests\TestCase::class,
    // Illuminate\Foundation\Testing\RefreshDatabase::class,
)->in('Feature');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

// custom expectation method
expect()->extend('toBePhoneNumber', function () {
    expect($this->value)->toStartWith("+");
    //throw custom error in custom expectation method
    if (strlen($this->value) < 6) {
        throw new ExpectationFailedException('phone number should at least 6 chars');
    }
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

function login($user = null)
{
    $account = Account::create(['name' => 'Acme Corporation']);
    $user = $user ?? User::factory()->create([
        'account_id' => $account->id,
    ]);
    return test()->actingAs($user);
}
