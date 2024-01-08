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
     * The base serve host URL to use while testing the application.
     *
     * @var string
     */
    protected static $baseServeHost = '127.0.0.1';

    /**
     * The base serve port to use while testing the application.
     *
     * @var int
     */
    protected static $baseServePort = 8000;

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
