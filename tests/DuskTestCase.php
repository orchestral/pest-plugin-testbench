<?php

namespace Orchestra\Testbench\Pest\Tests;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Orchestra\Testbench\Concerns\WithWorkbench;
use Orchestra\Testbench\Dusk\Options;
use PHPUnit\Framework\Attributes\BeforeClass;

class DuskTestCase extends \Orchestra\Testbench\Dusk\TestCase
{
    use DatabaseMigrations, WithWorkbench;

    /**
     * Prepare the testing environment web driver options.
     *
     * @return void
     */
    #[BeforeClass]
    public static function defineWebDriverOptions()
    {
        Options::$providesApplicationServer = false;
    }
}
