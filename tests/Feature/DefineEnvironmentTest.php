<?php

use function Orchestra\Testbench\Pest\defineEnvironment;

defineEnvironment(function ($app) {
    $app->instance('testbench.defined', true);
});

it('can resolve `defineEnvironment` via helper', function () {
    expect($this->app->resolved('testbench.defined'))->toBe(true);
});

it('does not leak between tests', function () {
    expect(config('testbench.setUp'))->toBe(null);
    expect(config('testbench.tearDown'))->toBe(null);

    expect(Schema::hasTable('users'))->toBe(false);
    expect(Schema::hasTable('notifications'))->toBe(false);
    expect(Schema::hasTable('jobs'))->toBe(false);
});
