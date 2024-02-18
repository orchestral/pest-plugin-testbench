<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Foundation\Testing\RefreshDatabaseState;
use Illuminate\Support\Facades\Schema;
use Orchestra\Testbench\Attributes\ResetRefreshDatabaseState;
use Orchestra\Testbench\Attributes\WithMigration;

use function Orchestra\Testbench\laravel_version_compare;
use function Orchestra\Testbench\Pest\setUp;

uses(LazilyRefreshDatabase::class);

setUp(function ($parent) {
    $this->afterApplicationCreated(function () {
        config(['testbench.setUp' => true]);
    });

    $this->beforeApplicationDestroyed(function () {
        config(['testbench.tearDown' => true]);

        ResetRefreshDatabaseState::run();
    });

    $this->usesTestingFeature(new WithMigration('laravel', 'queue'));

    $parent();
});

it('can execute default setUpTheEnvironment via `setUp` helper', function () {
    expect($this->setUpHasRun)->toBe(true);
    expect($this->app)->toBeInstanceOf(Application::class);
    expect(config('database.default'))->toBe('testing');
});

it('can resolve `afterApplicationCreated` via `setUp` helper', function () {
    expect(config('testbench.setUp'))->toBe(true);
    expect(config('testbench.tearDown'))->toBe(null);
});

it('can resolve `usesTestingFeature` via `setUp` helper', function () {
    expect(Schema::hasTable('users'))->toBe(true);
    expect(Schema::hasTable('notifications'))->toBe(false);
    expect(Schema::hasTable('jobs'))->toBe(true);

    expect(RefreshDatabaseState::$migrated)->toBe(laravel_version_compare('11.0.0', '>=') ? true : false);
    expect(RefreshDatabaseState::$lazilyRefreshed)->toBe(true);
});

it('does not leak between tests', function () {
    expect($this->app->resolved('testbench.defined'))->toBe(false);
});
