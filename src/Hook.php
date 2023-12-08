<?php

namespace Orchestra\Testbench\Pest;

use Closure;

/**
 * @phpstan-template TSetUpTearDownCallback \Closure():void
 * @phpstan-template TCallback \Closure(TSetUpTearDownCallback):void
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
    public static $cachedSetUpHooks = [];

     /**
     * The cached "tearDown" hooks.
     *
     * @var array<string, \Closure|null>
     *
     * @phpstan-var array<string, TCallback|null>
     */
    public static $cachedTearDownHooks = [];

    /**
     * Define "setUp" hook for Pest test file.
     *
     * @param  string  $file
     * @param  (\Closure(\Closure):(void))|null  $callback
     *
     * @phpstan-param  TCallback|null  $callback
     */
    public static function setUp(string $file, ?Closure $callback = null)
    {
        static::$cachedSetUpHooks[$file] = $callback;
    }

    /**
     * Define "tearDown" hook for Pest test file.
     *
     * @param  string  $file
     * @param  (\Closure(\Closure):(void))|null  $callback
     *
     * @phpstan-param  TCallback|null  $callback
     */
    public static function tearDown(string $file, ?Closure $callback = null)
    {
        static::$cachedTearDownHooks[$file] = $callback;
    }
}
