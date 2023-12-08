<?php

namespace Orchestra\Testbench\Pest;

use Closure;
use Pest\TestSuite;

trait WithPest
{
    /**
     * Setup the environment using Pest.
     */
    protected function setUpTheEnvironmentUsingPest(): void
    {
        $this->setUpTheEnvironmentUsing(
            Hook::resolveSetUpCallback(TestSuite::getInstance()->getFilename())
        );
    }

    /**
     * Teardown the environment using Pest.
     */
    protected function tearDownTheEnvironmentUsingPest(): void
    {
        $this->tearDownTheEnvironmentUsing(
            Hook::resolveTearDownCallback(TestSuite::getInstance()->getFilename())
        );
    }
}
