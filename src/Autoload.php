<?php

declare(strict_types=1);

namespace Orchestra\Testbench\Pest;

use Closure;
use PHPUnit\Framework\TestCase;
use Pest\Plugin;
use Pest\Support\Backtrace;
use Pest\TestSuite;

Plugin::uses(WithPest::class);

/**
 * Define "setUp" hook for the test case.
 *
 * @param  \Closure(\Closure):void  $setUp
 * @return void
 */
function setUp(Closure $setUp): void
{
    Hook::setUp(Backtrace::testFile(), $setUp);
}

/**
 * Define "tearDown" hook for the test case.
 *
 * @param  \Closure(\Closure):void  $tearDown
 * @return void
 */
function tearDown(Closure $tearDown): void
{
    Hook::tearDown(Backtrace::testFile(), $tearDown);
}

/**
 * Define "afterApplicationCreated" hook for the test case.
 *
 * @param  callable  $callback
 * @return void
 */
function afterApplicationCreated(callable $callback): void
{
    test()->afterApplicationCreated($callback);
}

/**
 * Define "beforeApplicationDestroyed" hook for the test case.
 *
 * @param  callable  $callback
 * @return void
 */
function beforeApplicationDestroyed(callable $callback): void
{
    test()->beforeApplicationDestroyed($callback);
}

/**
 * Use testing feature for the test case.
 *
 * @param  object  $attribute
 * @return void
 */
function usesTestingFeature($attribute): void
{
    test()->usesTestingFeature($attribute);
}
