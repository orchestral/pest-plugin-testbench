<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Schema;
use Orchestra\Testbench\Attributes\WithMigration;

use function Orchestra\Testbench\Pest\setUp;

setUp(function ($setUp) {
    $setUp();
});

it('can execute default setUpTheEnvironment via `setUp` helper', function () {
    expect($this->setUpHasRun)->toBe(true);
    expect($this->app)->toBeInstanceOf(Application::class);

    expect(config('testbench.setUp'))->toBe(null);
    expect(config('testbench.tearDown'))->toBe(null);

    expect(Schema::hasTable('users'))->toBe(false);
    expect(Schema::hasTable('notifications'))->toBe(false);
    expect(Schema::hasTable('jobs'))->toBe(false);
});
