<?php

declare(strict_types=1);

namespace Orchestra\Testbench\Pest;

use Closure;
use PHPUnit\Framework\TestCase;
use Pest\Plugin;
use Pest\Support\Backtrace;
use Pest\Support\HigherOrderTapProxy;

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
 * Destroy database migrations for the test case.
 *
 * @param  \Closure():void  $callback
 */
function destroyDatabaseMigrations(Closure $callback): void
{
    Hook::create('@destroyDatabaseMigrations', Backtrace::testFile(), $callback);
}

/**
 * Define database seeders for the test case.
 *
 * @param  \Closure():void  $callback
 */
function defineDatabaseSeeders(Closure $callback): void
{
    Hook::create('@defineDatabaseSeeders', Backtrace::testFile(), $callback);
}

/**
 * Define routes for the test case.
 *
 * @param  \Closure(\Illuminate\Routing\Router):void  $callback
 */
function defineRoutes(Closure $callback): void
{
    Hook::create('@defineRoutes', Backtrace::testFile(), $callback);
}

/**
 * Define web routes for the test case.
 *
 * @param  \Closure(\Illuminate\Routing\Router):void  $callback
 */
function defineWebRoutes(Closure $callback): void
{
    Hook::create('@defineWebRoutes', Backtrace::testFile(), $callback);
}

/**
 * Define "afterApplicationCreated" hook for the test case.
 */
function afterApplicationCreated(callable $callback): HigherOrderTapProxy
{
    return tap(test(), static function ($test) use ($callback) {
        $test->afterApplicationCreated($callback);
    });
}

/**
 * Define "beforeApplicationDestroyed" hook for the test case.
 */
function beforeApplicationDestroyed(callable $callback): HigherOrderTapProxy
{
    return tap(test(), static function ($test) use ($callback) {
        return $test->beforeApplicationDestroyed($callback);
    });
}

/**
 * Use testing feature for the test case.
 *
 * @param  object  $attribute
 */
function usesTestingFeature($attribute): HigherOrderTapProxy
{
    return tap(test(), static function ($test) use ($attribute) {
        $test->usesTestingFeature($attribute);
    });
}
