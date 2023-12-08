<?php

use function Orchestra\Testbench\Pest\defineEnvironment;

defineEnvironment(function ($app) {
    $app->instance('testbench.defined', true);
});

it('can resolve `defineEnvironment` via helper', function () {
    expect($this->app->resolved('testbench.defined'))->toBe(true);
});
