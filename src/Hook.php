<?php

namespace Orchestra\Testbench\Pest;

use Closure;

/**
 * @phpstan-type TSetUpTearDownCallback \Closure():void
 * @phpstan-type TCallback \Closure(TSetUpTearDownCallback):void
 */
class Hook
{
    /**
     * The cached "setUp" hooks.
     *
     * @var array<string, \Closure|null>
     *
     * @phpstan-var array<string, TCallback|null>
     */
    public static $cachedSetUps = [];

    /**
     * The cached "tearDown" hooks.
     *
     * @var array<string, \Closure|null>
     *
     * @phpstan-var array<string, TCallback|null>
     */
    public static $cachedTearDowns = [];

    /**
     * Define "setUp" hook for Pest test file.
     *
     * @param  (\Closure(\Closure):(void))|null  $callback
     *
     * @phpstan-param  TCallback|null  $callback
     */
    public static function setUp(string $file, Closure $callback = null): void
    {
        static::$cachedSetUps[$file] = $callback;
    }

    /**
     * Define "tearDown" hook for Pest test file.
     *
     * @param  (\Closure(\Closure):(void))|null  $callback
     *
     * @phpstan-param  TCallback|null  $callback
     */
    public static function tearDown(string $file, Closure $callback = null): void
    {
        static::$cachedTearDowns[$file] = $callback;
    }

    /**
     * Flush the cached hooks.
     */
    public static function flush(): void
    {
        static::$cachedSetUps = [];
        static::$cachedTearDowns = [];
    }
}
