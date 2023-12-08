<?php

namespace Orchestra\Testbench\Pest;

use Closure;
use Pest\TestSuite;

trait WithPest
{
    protected function setUpTheEnvironmentUsingPest()
    {
        $this->setUpTheEnvironmentUsing(
            Hook::$cachedSetUpHooks[TestSuite::getInstance()->getFilename()] ?? function ($setUp) {
                call_user_func($setUp);
            }
        );
    }

    protected function tearDownTheEnvironmentUsingPest()
    {
        $this->tearDownTheEnvironmentUsing(
            Closure::bind(
                Hook::$cachedTearDownHooks[TestSuite::getInstance()->getFilename()] ?? function ($tearDown) {
                    call_user_func($tearDown);
                },
                $this
            )
        );
    }
}
