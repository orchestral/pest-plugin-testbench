<?php

declare(strict_types=1);

namespace Orchestra\Testbench\Pest;

use Closure;
use Pest\Plugin;
use Pest\Support\Backtrace;

Plugin::uses(WithPest::class);

/**
 * Define "setUp" hook for the test case.
 *
 * @param  \Closure(\Closure):void  $setUp
 */
function setUp(Closure $setUp): void
{
    Hook::setUp(Backtrace::testFile(), $setUp);
}

/**
 * Define "tearDown" hook for the test case.
 *
 * @param  \Closure(\Closure):void  $tearDown
 */
function tearDown(Closure $tearDown): void
{
    Hook::tearDown(Backtrace::testFile(), $tearDown);
}

/**
 * Define "afterApplicationCreated" hook for the test case.
 */
function afterApplicationCreated(callable $callback): void
{
    test()->afterApplicationCreated($callback);
}

/**
 * Define "beforeApplicationDestroyed" hook for the test case.
 */
function beforeApplicationDestroyed(callable $callback): void
{
    test()->beforeApplicationDestroyed($callback);
}

/**
 * Use testing feature for the test case.
 *
 * @param  object  $attribute
 */
function usesTestingFeature($attribute): void
{
    test()->usesTestingFeature($attribute);
}
