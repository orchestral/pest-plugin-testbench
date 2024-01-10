<?php

namespace Orchestra\Testbench\Pest\Tests;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Orchestra\Testbench\Concerns\WithWorkbench;
use Orchestra\Testbench\Dusk\Options;
use PHPUnit\Framework\Attributes\BeforeClass;

class DuskTestCase extends \Orchestra\Testbench\Dusk\TestCase
{
    use DatabaseMigrations;
    use WithWorkbench;

    /**
     * Prepare the testing environment web driver options.
     *
     * @return void
     */
    public static function defineWebDriverOptions()
    {
        Options::$providesApplicationServer = false;
    }
}
