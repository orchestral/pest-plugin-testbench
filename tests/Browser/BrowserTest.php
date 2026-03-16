<?php

use Laravel\Dusk\Browser;

use function Orchestra\Testbench\laravel_version_compare;

it('can_browse_default_laravel_page')
    ->browse(function (Browser $browser) {
        $browser->visit('/')
            ->pause(500)
            ->assertSee(
                match (true) {
                    laravel_version_compare('13.0', '>=') => 'Let\'s get started',
                    laravel_version_compare('12.0', '>=') => 'Laravel has an incredibly rich ecosystem.',
                    default => 'Documentation',
                }
            );
    });
