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
        if (\is_null($callback = Hook::unpack('@setUp', TestSuite::getInstance()->getFilename()))) {
            return;
        }

        $this->setUpTheEnvironmentUsing(Closure::bind($callback, $this));
    }

    /**
     * Teardown the environment using Pest.
     */
    protected function tearDownTheEnvironmentUsingPest(): void
    {
        if (\is_null($callback = Hook::unpack('@tearDown', TestSuite::getInstance()->getFilename()))) {
            return;
        }

        $this->tearDownTheEnvironmentUsing(Closure::bind($callback, $this));
    }

    /**
     * Define environment setup using Pest.
     *
     * @param  \Illuminate\Foundation\Application  $app
     */
    protected function defineEnvironmentUsingPest($app): void
    {
        if (\is_null($callback = Hook::unpack('@defineEnvironment', TestSuite::getInstance()->getFilename()))) {
            return;
        }

        \call_user_func(Closure::bind($callback, $this), $app);
    }

    /**
     * Define database migrations using Pest.
     */
    protected function defineDatabaseMigrationsUsingPest(): void
    {
        if (\is_null($callback = Hook::unpack('@defineDatabaseMigrations', TestSuite::getInstance()->getFilename()))) {
            return;
        }

        \call_user_func(Closure::bind($callback, $this));
    }

    /**
     * Destroy database migrations using Pest.
     */
    protected function destroyDatabaseMigrationsUsingPest(): void
    {
        if (\is_null($callback = Hook::unpack('@destroyDatabaseMigrations', TestSuite::getInstance()->getFilename()))) {
            return;
        }

        \call_user_func(Closure::bind($callback, $this));
    }

    /**
     * Define database seeders using Pest.
     */
    protected function defineDatabaseSeedersUsingPest(): void
    {
        if (\is_null($callback = Hook::unpack('@defineDatabaseSeeders', TestSuite::getInstance()->getFilename()))) {
            return;
        }

        \call_user_func(Closure::bind($callback, $this));
    }

    protected function defineRoutesUsingPest($router): void
    {
        if (\is_null($callback = Hook::unpack('@defineRoutes', TestSuite::getInstance()->getFilename()))) {
            return;
        }

        \call_user_func(Closure::bind($callback, $this), $router);
    }

    protected function defineWebRoutesUsingPest($router): void
    {
        if (\is_null($callback = Hook::unpack('@defineWebRoutes', TestSuite::getInstance()->getFilename()))) {
            return;
        }

        \call_user_func(Closure::bind($callback, $this), $router);
    }

    /**
     * Reset refresh database state.
     *
     * @return $this
     */
    public function resetRefreshDatabaseState()
    {
        RefreshDatabaseState::$migrated = false;
        RefreshDatabaseState::$lazilyRefreshed = false;

        return $this;
    }
}
