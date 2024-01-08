<?php

namespace Orchestra\Testbench\Pest\Tests;

use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Orchestra\Testbench\Concerns\WithWorkbench;

class TestCase extends \Orchestra\Testbench\TestCase
{
    use LazilyRefreshDatabase, WithWorkbench;
}
