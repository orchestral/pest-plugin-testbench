<?php

declare(strict_types=1);

namespace Orchestra\Testbench\Pest\Dusk;

use Orchestra\Testbench\Dusk\Options;
use Orchestra\Testbench\Pest\Process\WebServer;

use function Orchestra\Testbench\Pest\usesWebServer;

abstract class TestCase extends \Orchestra\Testbench\Dusk\TestCase
{
    /**
     * The server implementation.
     */
    protected static ?WebServer $webServer = null;

    /**
     * Teardown the test environment.
     */
    #[\Override]
    protected function tearDown(): void
    {
        parent::tearDown();

        if (static::$webServer) {
            static::$webServer->clearOutput();
        }
    }

    /**
     * Setup the test environment.
     *
     * @internal
     *
     * @codeCoverageIgnore
     */
    #[\Override]
    public static function setUpBeforeClass(): void
    {
        Options::$providesApplicationServer = false;

        parent::setUpBeforeClass();
    }

    /**
     * Begin serving on a given host and port.
     *
     * @internal
     *
     * @throws \Orchestra\Testbench\Dusk\Exceptions\UnableToStartServer
     */
    #[\Override]
    public static function serve(string $host = '127.0.0.1', int $port = 8001): void
    {
        static::stopServing();

        $webServer = usesWebServer($host, $port);
        $webServer->start();

        static::$webServer = $webServer;
    }

    /**
     * Stop serving on a given host and port. As a safety net, we will
     * shut down all servers if we.
     *
     * @api
     */
    #[\Override]
    public static function stopServing(): void
    {
        if (isset(static::$webServer)) {
            static::$webServer->stop();
        }
    }
}
