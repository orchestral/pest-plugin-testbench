<?php

namespace Orchestra\Testbench\Pest;

use Closure;
use Pest\TestSuite;

trait WithPest
{
    protected function setUpTheEnvironmentUsingPest()
    {
        $this->setUpTheEnvironmentUsing(
            Hook::resolveSetUpCallback(TestSuite::getInstance()->getFilename())
        );
    }

    protected function tearDownTheEnvironmentUsingPest()
    {
        $this->tearDownTheEnvironmentUsing(
            Hook::resolveTearDownCallback(TestSuite::getInstance()->getFilename())
        );
    }
}
