<?php

namespace Orchestra\Testbench\Pest;

use Closure;

/**
 * @internal
 */
final class Hook
{
    /**
     * The cached hooks.
     *
     * @var array<string, array<string, \Closure|null>>
     */
    private static array $cachedHooks = [
        '@setUp' => [],
        '@tearDown' => [],
        '@defineEnvironment' => [],
        '@defineRoutes' => [],
        '@defineWebRoutes' => [],
        '@defineDatabaseMigrations' => [],
        '@destroyDatabaseMigrations' => [],
        '@defineDatabaseSeeders' => [],
    ];

    /**
     * Define a hook for Pest test file.
     */
    public static function create(string $type, string $fileOrMethod, Closure $callback = null): void
    {
        self::$cachedHooks[$type][$fileOrMethod] = $callback;
    }

    /**
     * Unpack the hook.
     */
    public static function unpack(string $type, string $fileOrMethod, Closure $callback = null): ?Closure
    {
        return self::$cachedHooks[$type][$fileOrMethod] ?? $callback;
    }
}
