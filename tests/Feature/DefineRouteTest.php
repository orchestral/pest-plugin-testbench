<?php

use Illuminate\Routing\Router;

use function Orchestra\Testbench\Pest\defineRoutes;

defineRoutes(function (Router $router) {
    $router->get('hello', fn () => 'hello world');
});

it('can use `defineRoutes`', function () {
    $this->get('hello')
        ->assertOk()
        ->assertSee('hello world');
});
