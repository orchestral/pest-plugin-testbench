<?php

namespace Orchestra\Testbench\Pest;

use Illuminate\Foundation\Testing\RefreshDatabaseState;
use Pest\Support\Closure;
use Pest\TestSuite;

trait WithPest
{
    /**
     * Setup the environment using Pest.
     */
    protected function setUpTheEnvironmentUsingPest(): void
    {
        $this->setUpTheEnvironmentUsing(
            Closure::bind(Hook::unpack('@setUp', TestSuite::getInstance()->getFilename(), function ($callback): void {
                call_user_func($callback);
            }), $this)
        );
    }

    /**
     * Teardown the environment using Pest.
     */
    protected function tearDownTheEnvironmentUsingPest(): void
    {
        $this->tearDownTheEnvironmentUsing(
            Closure::bind(Hook::unpack('@tearDown', TestSuite::getInstance()->getFilename(), function ($callback): void {
                call_user_func($callback);
            }), $this)
        );
    }

    /**
     * Define environment setup using Pest.
     *
     * @param  \Illuminate\Foundation\Application  $app
     */
    protected function defineEnvironmentUsingPest($app): void
    {
        $callback = Hook::unpack('@defineEnvironment', TestSuite::getInstance()->getFilename(), function (): void {
            //
        });

        call_user_func(Closure::bind($callback, $this), $app);
    }

    /**
     * Define database migrations using Pest.
     */
    protected function defineDatabaseMigrationsUsingPest(): void
    {
        $callback = Hook::unpack('@defineDatabaseMigrations', TestSuite::getInstance()->getFilename(), function (): void {
            //
        });

        call_user_func(Closure::bind($callback, $this));
    }

    /**
     * Destroy database migrations using Pest.
     */
    protected function destroyDatabaseMigrationsUsingPest(): void
    {
        $callback = Hook::unpack('@destroyDatabaseMigrations', TestSuite::getInstance()->getFilename(), function (): void {
            //
        });

        call_user_func(Closure::bind($callback, $this));
    }

    /**
     * Define database seeders using Pest.
     */
    protected function defineDatabaseSeedersUsingPest(): void
    {
        $callback = Hook::unpack('@defineDatabaseSeeders', TestSuite::getInstance()->getFilename(), function (): void {
            //
        });

        call_user_func(Closure::bind($callback, $this));
    }

    protected function defineRoutesUsingPest($router): void
    {
        $callback = Hook::unpack('@defineRoutes', TestSuite::getInstance()->getFilename(), function (): void {
            //
        });

        call_user_func(Closure::bind($callback, $this), $router);
    }

    protected function defineWebRoutesUsingPest($router): void
    {
        $callback = Hook::unpack('@defineWebRoutes', TestSuite::getInstance()->getFilename(), function (): void {
            //
        });

        call_user_func(Closure::bind($callback, $this), $router);
    }

    public function resetRefreshDatabaseState()
    {
        RefreshDatabaseState::$migrated = false;
        RefreshDatabaseState::$lazilyRefreshed = false;
    }
}
