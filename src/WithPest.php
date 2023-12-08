<?php

namespace Orchestra\Testbench\Pest;

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

    protected function defineEnvironmentUsingPest($app): void
    {
        $callback = Hook::unpack('@defineEnvironment', TestSuite::getInstance()->getFilename(), function (): void {
            //
        });

        call_user_func(Closure::bind($callback, $this), $app);
    }

    protected function defineDatabaseMigrationsUsingPest(): void
    {
        $callback = Hook::unpack('@defineDatabase', TestSuite::getInstance()->getFilename(), function (): void {
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
}
