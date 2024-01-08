<?php

use Laravel\Dusk\Browser;

it('can_browse_default_laravel_page')
    ->browse(function (Browser $browser) {
        $browser->visit('/')
            ->assertSee('Documentation');
    });
