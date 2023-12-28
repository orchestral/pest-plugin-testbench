<?php

namespace Orchestra\Testbench\Pest;

use Orchestra\Testbench\Attributes\ResetRefreshDatabaseState;
use Pest\Support\Closure;
use Pest\TestSuite;

trait WithPest
{
    /**
     * Prepare the testing environment before the running the test case.
     *
     *
     * @codeCoverageIgnore
     */
    protected static function setUpBeforeClassUsingPest(): void
    {
        $attributes = Hook::unpack('@usesTestingFeature', self::$__filename) ?? [];

        foreach ($attributes as $attribute) {
            static::usesTestingFeature($attribute);
        }
    }

    /**
     * Clean up the testing environment before the next test case.
     *
     *
     * @codeCoverageIgnore
     */
    protected static function tearDownAfterClassUsingPest(): void
    {
        //
    }

    /**
     * Setup the environment using Pest.
     */
    protected function setUpTheEnvironmentUsingPest(): void
    {
        $setUp = Hook::unpack('@setUp', self::$__filename) ?? function ($parent): void {
            value($parent);
        };

        $afterApplicationCreated = Hook::unpack('@afterApplicationCreated', self::$__filename) ?? function (): void {
            //
        };
        $beforeApplicationDestroyed = Hook::unpack('@beforeApplicationDestroyed', self::$__filename) ?? function (): void {
            //
        };

        $this->setUpTheEnvironmentUsing(function ($parent) use ($setUp, $afterApplicationCreated, $beforeApplicationDestroyed): void {
            value(Closure::bind($afterApplicationCreated, $this));
            value(Closure::bind($beforeApplicationDestroyed, $this));
            value(Closure::bind($setUp, $this), $parent);
        });
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
        ResetRefreshDatabaseState::run();

        return $this;
    }
}
