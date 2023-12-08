<?php

namespace Orchestra\Testbench\Pest;

use Closure;

/**
 * @phpstan-type TSetUpTearDownCallback \Closure():void
 * @phpstan-type TCallback \Closure(TSetUpTearDownCallback):void
 *
 * @internal
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
    protected static $cachedSetUps = [];

    /**
     * The cached "tearDown" hooks.
     *
     * @var array<string, \Closure|null>
     *
     * @phpstan-var array<string, TCallback|null>
     */
    protected static $cachedTearDowns = [];

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
     * Resolve the "setUp" hook.
     *
     * @phpstan-return TCallback
     */
    public static function resolveSetUpCallback(string $file): Closure
    {
        return static::$cachedSetUps[$file] ?? function ($setUp) {
            call_user_func($setUp);
        };
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
     * Resolve the "tearDown" hook.
     *
     * @phpstan-return TCallback
     */
    public static function resolveTearDownCallback(string $file): Closure
    {
        return static::$cachedTearDowns[$file] ?? function ($tearDown) {
            call_user_func($tearDown);
        };
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
