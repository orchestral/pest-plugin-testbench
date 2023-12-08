<?php

use Illuminate\Support\Facades\Schema;
use Orchestra\Testbench\Attributes\WithMigration;
use function Orchestra\Testbench\Pest\setUp;

setUp(function ($setUp) {
    $this->afterApplicationCreated(function () {
        config(['testbench.setUp' => true]);
    });

    // $this->usesTestingFeature(new WithMigration());

    $setUp();
});

it('can resolve setUp', function () {
    expect($this->setUpHasRun)->toBe(true);
    expect(Schema::hasTable('users'))->toBe(true);
    expect(config('testbench.setUp'))->toBe(true);
});
