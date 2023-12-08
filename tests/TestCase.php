<?php

namespace Orchestra\Testbench\Pest\Tests;

use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Orchestra\Testbench\Concerns\WithWorkbench;

class TestCase extends \Orchestra\Testbench\TestCase
{
    use LazilyRefreshDatabase, WithWorkbench;

    protected function defineEnvironment($app)
    {
        $app['config']->set(['database.default' => 'testing']);
    }
}
