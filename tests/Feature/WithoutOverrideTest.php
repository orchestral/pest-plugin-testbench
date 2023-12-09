<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Testing\RefreshDatabaseState;
use Illuminate\Support\Facades\Schema;

use function Orchestra\Testbench\Pest\setUp;

setUp(function ($parent) {
    $parent();
});

it('can execute default setUpTheEnvironment via `setUp` helper', function () {
    expect($this->setUpHasRun)->toBe(true);
    expect($this->app)->toBeInstanceOf(Application::class);
});

it('does not leak between tests', function () {
    expect($this->app->resolved('testbench.defined'))->toBe(false);
    expect(config('testbench.setUp'))->toBe(null);
    expect(config('testbench.tearDown'))->toBe(null);

    expect(RefreshDatabaseState::$migrated)->toBe(false);
    expect(RefreshDatabaseState::$lazilyRefreshed)->toBe(false);

    expect(Schema::hasTable('users'))->toBe(false);
    expect(Schema::hasTable('notifications'))->toBe(false);
    expect(Schema::hasTable('jobs'))->toBe(false);
});
