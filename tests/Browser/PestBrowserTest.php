<?php

use Orchestra\Testbench\Pest\Tests\TestCase;

use function Orchestra\Testbench\laravel_version_compare;
use function Orchestra\Testbench\Pest\usesWebServer;

uses(TestCase::class)->group('playwright');

it('can browse default laravel page', function () {
    usesWebServer()
        ->visit('/')
        ->wait(1)
        ->assertSee(
            match (true) {
                laravel_version_compare('13.0', '>=') => 'Let\'s get started',
                laravel_version_compare('12.0', '>=') => 'Laravel has an incredibly rich ecosystem.',
                default => 'Documentation',
            }
        );
});
