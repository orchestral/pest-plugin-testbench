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
 * @param  \Closure(\Closure):void  $callback
 */
function setUp(Closure $callback): void
{
    Hook::create('@setUp', Backtrace::testFile(), $callback);
}

/**
 * Define "tearDown" hook for the test case.
 *
 * @param  \Closure(\Closure):void  $callback
 */
function tearDown(Closure $callback): void
{
    Hook::create('@tearDown', Backtrace::testFile(), $callback);
}

/**
 * Define environment for the test case.
 *
 * @param  \Closure(\Illuminate\Foundation\Application):void  $callback
 */
function defineEnvironment(Closure $callback): void
{
    Hook::create('@defineEnvironment', Backtrace::testFile(), $callback);
}

/**
 * Define database migrations for the test case.
 *
 * @param  \Closure():void  $callback
 */
function defineDatabaseMigrations(Closure $callback): void
{
    Hook::create('@defineDatabaseMigrations', Backtrace::testFile(), $callback);
}

/**
 * Define routes for the test case.
 *
 * @param  \Closure(\Illuminate\Http\Router):void  $callback
 */
function defineRoute(Closure $callback): void
{
    Hook::create('@defineRoute', Backtrace::testFile(), $callback);
}

/**
 * Define web routes for the test case.
 *
 * @param  \Closure(\Illuminate\Http\Router):void  $callback
 */
function defineWebRoute(Closure $callback): void
{
    Hook::create('@defineWebRoute', Backtrace::testFile(), $callback);
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
