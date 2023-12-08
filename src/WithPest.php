<?php

namespace Orchestra\Testbench\Pest;

use Closure;
use Pest\TestSuite;

trait WithPest
{
    protected function setUpTheEnvironmentUsingPest()
    {
        $this->setUpTheEnvironmentUsing(
            Hook::$cachedSetUps[TestSuite::getInstance()->getFilename()] ?? function ($setUp) {
                call_user_func($setUp);
            }
        );
    }

    protected function tearDownTheEnvironmentUsingPest()
    {
        $this->tearDownTheEnvironmentUsing(
            Closure::bind(
                Hook::$cachedTearDowns[TestSuite::getInstance()->getFilename()] ?? function ($tearDown) {
                    call_user_func($tearDown);
                },
                $this
            )
        );
    }
}
