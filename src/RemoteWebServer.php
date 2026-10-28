<?php

namespace Orchestra\Testbench\Pest;

use Orchestra\Testbench\Foundation\Process\ProcessDecorator as Process;
use Pest\Browser\Api\ArrayablePendingAwaitablePage;
use Pest\Browser\Api\PendingAwaitablePage;

class RemoteWebServer extends \Orchestra\Testbench\Foundation\Process\RemoteWebServer
{
    /**
     * Visit the given path on the remote web server.
     */
    public function visit(string $path): ArrayablePendingAwaitablePage|PendingAwaitablePage
    {
        if (is_null($this->process)) {
            $this->start();
        }

        return visit(\sprintf('http://%s:%d/%s', $this->host, $this->port, ltrim($path, '/')));
    }
}
