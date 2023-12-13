<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Testing\RefreshDatabaseState;
use Illuminate\Support\Facades\Schema;
use Orchestra\Testbench\Attributes\WithConfig;
use Orchestra\Testbench\Attributes\WithMigration;
use function Orchestra\Testbench\Pest\usesTestingFeature;

usesTestingFeature(
    new WithConfig('testbench.usesTestingFeature', true),
    new WithMigration('laravel'),
    new WithMigration('queue')
);

it('can resolve use `usesTestingFeature` helper', function () {
    expect($this->setUpHasRun)->toBe(true);
    expect($this->app)->toBeInstanceOf(Application::class);

    expect(config('testbench.usesTestingFeature'))->toBe(true);

    expect(Schema::hasTable('users'))->toBe(true);
    expect(Schema::hasTable('notifications'))->toBe(false);
    expect(Schema::hasTable('jobs'))->toBe(true);

    expect(RefreshDatabaseState::$migrated)->toBe(false);
    expect(RefreshDatabaseState::$lazilyRefreshed)->toBe(true);
});
