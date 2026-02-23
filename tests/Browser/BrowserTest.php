<?php

use Laravel\Dusk\Browser;

use function Orchestra\Testbench\laravel_version_compare;

it('can_browse_default_laravel_page')
    ->browse(function (Browser $browser) {
        $browser->visit('/')
            ->pause(500)
            ->assertSee(
                laravel_version_compare('12.0', '>=')
                    ? 'Laravel has an incredibly rich ecosystem.'
                    : 'Documentation'
            );
    });
