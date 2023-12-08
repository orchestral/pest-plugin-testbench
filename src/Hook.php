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
     * The cached hooks.
     *
     * @var array<string, \Closure|null>
     *
     * @phpstan-var array<string, TCallback|null>
     */
    protected static $cachedHooks = [
        '@setUp' => [],
        '@tearDown' => [],
        '@defineEnvironment' => [],
        '@defineRoutes' => [],
        '@defineWebRoutes' => [],
        '@defineDatabaseMigrations' => [],
    ];

    /**
     * Define a hook for Pest test file.
     *
     * @param  (\Closure(\Closure):(void))|null  $callback
     *
     * @phpstan-param  TCallback|null  $callback
     */
    public static function create(string $type, string $fileOrMethod, Closure $callback = null): void
    {
        static::$cachedHooks[$type][$fileOrMethod] = $callback;
    }

    /**
     * Resolve the "setUp" hook.
     *
     * @return \Closure(\Closure):(void)
     */
    public static function unpack(string $type, string $fileOrMethod): Closure
    {
        return static::$cachedHooks[$type][$fileOrMethod] ?? function ($callback) {
            call_user_func($callback);
        };
    }

    /**
     * Flush the cached hooks.
     */
    public static function flush(): void
    {
        static::$cachedHooks = [
            '@setUp' => [],
            '@tearDown' => [],
            '@defineEnvironment' => [],
            '@defineRoutes' => [],
            '@defineWebRoutes' => [],
            '@defineDatabaseMigrations' => [],
        ];
    }
}
