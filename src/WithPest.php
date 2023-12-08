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
            Hook::unpack('@setUp', TestSuite::getInstance()->getFilename())
        );
    }

    /**
     * Teardown the environment using Pest.
     */
    protected function tearDownTheEnvironmentUsingPest(): void
    {
        $this->tearDownTheEnvironmentUsing(
            Hook::unpack('@tearDown', TestSuite::getInstance()->getFilename())
        );
    }
}
