<?php

namespace Orchestra\Testbench\Pest\Process;

use Orchestra\Testbench\Foundation\Process\ProcessDecorator as Process;
use Orchestra\Testbench\Pest\Exceptions\UnableToStartWebServer;
use Pest\Browser\Api\ArrayablePendingAwaitablePage;
use Pest\Browser\Api\PendingAwaitablePage;
use RuntimeException;

use function Orchestra\Testbench\remote;

class WebServer
{
    private const int STARTUP_TIMEOUT = 10;

    protected ?Process $process = null;

    /**
     * Construct a new server.
     */
    public function __construct(
        public readonly string $host = '127.0.0.1',
        public readonly int $port = 8000,
        public readonly int $timeout = 6000,
    ) {}

    /**
     * Start a php server in a separate process.
     *
     *
     * @throws \Orchestra\Testbench\Pest\Exceptions\UnableToStartWebServer
     */
    public function start(): void
    {
        $this->stop();
        $this->startServer();

        register_shutdown_function(function (): void {
            $this->stop();
        });
    }

    /**
     * Stop the php server.
     */
    public function stop(): void
    {
        if (! $this->process instanceof \Orchestra\Testbench\Foundation\Process\ProcessDecorator) {
            return;
        }

        $this->process->stop();
    }

    /**
     * Stop the php server.
     */
    public function restart(): void
    {
        $this->stop();
        $this->clearOutput();
        $this->startServer();
    }

    public function visit(string $path): ArrayablePendingAwaitablePage|PendingAwaitablePage
    {
        if (! $this->process instanceof \Orchestra\Testbench\Foundation\Process\ProcessDecorator) {
            $this->start();
        }

        return visit(\sprintf('http://%s:%d/%s', $this->host, $this->port, ltrim($path, '/')));
    }

    /**
     * Clear the php server output.
     *
     * No-op when output was disabled at start (the default), since
     * Symfony Process redirects those streams to /dev/null.
     */
    public function clearOutput(): void
    {
        if (! $this->process instanceof \Orchestra\Testbench\Foundation\Process\ProcessDecorator || $this->process->isOutputDisabled()) {
            return;
        }

        $this->process->clearOutput();
        $this->process->clearErrorOutput();
    }

    protected function startServer(): void
    {
        $this->guardServerStarting();

        $this->process = remote("serve --host={$this->host} --port={$this->port}");
        $this->process->setTimeout($this->timeout);

        $this->process->start();

        $this->waitForServerStart();
    }

    protected function waitForServerStart(): void
    {
        $deadline = hrtime(true) + self::STARTUP_TIMEOUT * 1_000_000_000;

        do {
            $socket = @fsockopen($this->host, $this->port, $errorNumber, $errorString, 0.1);

            if ($socket !== false) {
                fclose($socket);

                return;
            }

            if (! $this->process?->isRunning()) {
                $output = trim($this->process?->getErrorOutput().$this->process?->getOutput());

                throw new RuntimeException(\sprintf(
                    'Unable to start web server on %s:%d.%s',
                    $this->host,
                    $this->port,
                    $output === '' ? '' : "\n{$output}",
                ));
            }

            usleep(50_000);
        } while (hrtime(true) < $deadline);

        throw new RuntimeException(\sprintf(
            'Timed out waiting for web server on %s:%d after %d seconds.',
            $this->host,
            $this->port,
            self::STARTUP_TIMEOUT,
        ));
    }

    /**
     * Verify that there isn't an existing server on the host and port
     * that we want to use.  Sometimes a server can be left oped when
     * PHP drops out, or the user may have another service running.
     *
     *
     * @throws \Orchestra\Testbench\Pest\Exceptions\UnableToStartWebServer
     */
    protected function guardServerStarting(): void
    {
        /** @var resource|null $socket */
        $socket = rescue(function () {
            $errorNumber = 0;
            $errorString = '';
            $timeout = 1;

            return @fsockopen($this->host, $this->port, $errorNumber, $errorString, $timeout);
        }, null, false);

        if ($socket) {
            fclose($socket);
            throw new UnableToStartWebServer(\sprintf('%s:%d', $this->host, $this->port));
        }
    }
}
