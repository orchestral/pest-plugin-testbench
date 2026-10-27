<?php

use Laravel\Dusk\Browser;
use Orchestra\Testbench\Pest\Tests\DuskTestCase;

use function Orchestra\Testbench\laravel_version_compare;

uses(DuskTestCase::class)->group('dusk');

it('can browse default laravel page', function () {
    $this->browse(function (Browser $browser) {
        $browser->visit('/')
            ->pause(1000)
            ->screenshot('default_laravel_page')
            ->assertSee(
                match (true) {
                    laravel_version_compare('13.0', '>=') => 'Let\'s get started',
                    laravel_version_compare('12.0', '>=') => 'Laravel has an incredibly rich ecosystem.',
                    default => 'Documentation',
                }
            );
    });
});
