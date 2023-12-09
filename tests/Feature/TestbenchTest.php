<?php

it('can be resolved', function () {
    expect($this->isRunningTestCase())->toBe(true);
    expect($this->isRunningTestCaseUsingPest())->toBe(true);
});
