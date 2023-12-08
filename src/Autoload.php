<?php

declare(strict_types=1);

namespace Orchestra\Testbench\Pest;

use Closure;
use PHPUnit\Framework\TestCase;
use Pest\Plugin;
use Pest\Support\Backtrace;
use Pest\TestSuite;

Plugin::uses(WithPest::class);

function setUp(Closure $setUp): void
{
    Hook::setUp(Backtrace::testFile(), $setUp);
}

function tearDown(Closure $tearDown): void
{
    Hook::tearDown(Backtrace::testFile(), $tearDown);
}

function afterApplicationCreated(callable $callback): void
{
    test()->afterApplicationCreated($callback);
}

function beforeApplicationDestroyed(callable $callback): void
{
    test()->beforeApplicationDestroyed($callback);
}

function usesTestingFeature($attribute): void
{
    test()->usesTestingFeature($attribute);
}
