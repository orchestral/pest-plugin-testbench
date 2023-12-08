<?php

use Illuminate\Support\Facades\Schema;
use Orchestra\Testbench\Attributes\WithMigration;
use function Orchestra\Testbench\Pest\setUp;

setUp(function ($setUp) {
    $this->afterApplicationCreated(function () {
        config(['testbench.setUp' => true]);
    });

    $this->usesTestingFeature(new WithMigration('laravel', 'queue'));

    $setUp();
});

it('can resolve `afterApplicationCreated` via `setUp` helper', function () {
    expect($this->setUpHasRun)->toBe(true);
    expect(config('testbench.setUp'))->toBe(true);
});

it('can resolve `usesTestingFeature` via `setUp` helper', function () {
    expect(Schema::hasTable('users'))->toBe(true);
    expect(Schema::hasTable('notifications'))->toBe(false);
    expect(Schema::hasTable('jobs'))->toBe(true);
});