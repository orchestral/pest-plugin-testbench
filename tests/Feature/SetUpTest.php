<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Schema;
use Orchestra\Testbench\Attributes\ResetRefreshDatabaseState;
use Orchestra\Testbench\Attributes\WithMigration;
use function Orchestra\Testbench\Pest\afterApplicationCreated;
use function Orchestra\Testbench\Pest\beforeApplicationDestroyed;
use function Orchestra\Testbench\Pest\setUp;
use function Orchestra\Testbench\Pest\usesTestingFeature;

setUp(function ($setUp) {
    afterApplicationCreated(function () {
        config(['testbench.setUp' => true]);
    });

    beforeApplicationDestroyed(function () {
        config(['testbench.tearDown' => true]);
    });

    usesTestingFeature(new ResetRefreshDatabaseState());
    usesTestingFeature(new WithMigration('laravel', 'queue'));

    $setUp();
});

it('can execute default setUpTheEnvironment via `setUp` helper', function () {
    expect($this->setUpHasRun)->toBe(true);
    expect($this->app)->toBeInstanceOf(Application::class);
});

it('can resolve `afterApplicationCreated` via `setUp` helper', function () {
    expect(config('testbench.setUp'))->toBe(true);
    expect(config('testbench.tearDown'))->toBe(null);
});

it('can resolve `usesTestingFeature` via `setUp` helper', function () {
    expect(Schema::hasTable('users'))->toBe(true);
    expect(Schema::hasTable('notifications'))->toBe(false);
    expect(Schema::hasTable('jobs'))->toBe(true);
});

it('does not leak between tests', function () {
    expect($this->app->resolved('testbench.defined'))->toBe(false);
});
