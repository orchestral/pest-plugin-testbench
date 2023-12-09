<?php

use Illuminate\Foundation\Testing\RefreshDatabaseState;

it('can be resolved', function () {
    expect($this->isRunningTestCase())->toBe(true);
    expect($this->isRunningTestCaseUsingPest())->toBe(true);
});

it('does not leak between tests', function () {
    expect($this->app->resolved('testbench.defined'))->toBe(false);

    expect(RefreshDatabaseState::$migrated)->toBe(false);
    expect(RefreshDatabaseState::$lazilyRefreshed)->toBe(false);
});
