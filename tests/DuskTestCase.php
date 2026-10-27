<?php

namespace Orchestra\Testbench\Pest\Tests;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Orchestra\Testbench\Concerns\WithWorkbench;
use Orchestra\Testbench\Dusk\Options;

use function Orchestra\Testbench\Pest\usesWebServer;

class DuskTestCase extends \Orchestra\Testbench\Pest\Dusk\TestCase
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

        Options::noSandbox()
            ->addArgument('--incognito')
            ->addArgument('--disable-popup-blocking')
            ->addArgument('--disable-remote-fonts')
            ->addArgument('--force-prefers-reduced-motion');
    }
}
