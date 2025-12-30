<?php

use Orchestra\Testbench\Concerns\WithFixtures;
use Orchestra\Testbench\Pest\Tests\Feature\WithFixturesTest as Fixtures;

uses(WithFixtures::class);

it('can autoload `fixtures.php` files', function () {
    $user = new Fixtures\User;

    expect($user)->toBeInstanceOf(Fixtures\User::class);
});
