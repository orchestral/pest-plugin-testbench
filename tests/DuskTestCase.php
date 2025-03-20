<?php

namespace Orchestra\Testbench\Pest\Tests;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Orchestra\Testbench\Concerns\WithWorkbench;
use Orchestra\Testbench\Dusk\Options;

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
        Browser::$waitSeconds = 60;

        Options::$w3cCompliant = true;
        Options::$providesApplicationServer = false;

        Options::noSandbox()
            ->addArgument('--incognito')
            ->addArgument('--disable-popup-blocking')
            ->addArgument('--disable-remote-fonts')
            ->addArgument('--force-prefers-reduced-motion');
    }
}
