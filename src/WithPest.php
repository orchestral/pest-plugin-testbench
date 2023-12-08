<?php

namespace Orchestra\Testbench\Pest;

use Pest\TestSuite;

trait WithPest
{
    /**
     * Setup the environment using Pest.
     */
    protected function setUpTheEnvironmentUsingPest(): void
    {
        $this->setUpTheEnvironmentUsing(
            Hook::unpack('@setUp', TestSuite::getInstance()->getFilename(), function ($callback) {
                call_user_func($callback);
            })
        );
    }

    /**
     * Teardown the environment using Pest.
     */
    protected function tearDownTheEnvironmentUsingPest(): void
    {
        $this->tearDownTheEnvironmentUsing(
            Hook::unpack('@tearDown', TestSuite::getInstance()->getFilename(), function ($callback) {
                call_user_func($callback);
            })
        );
    }

    protected function defineEnvironmentUsingPest($app): void
    {
        $callback = Hook::unpack('@defineEnvironment', TestSuite::getInstance()->getFilename(), function () {
            //
        });

        call_user_func($callback, $app);
    }
}
