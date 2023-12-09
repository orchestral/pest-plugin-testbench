<?php

use function Orchestra\Testbench\Pest\defineRoutes;

defineRoutes(function ($router) {
    $router->get('hello', fn () => 'hello world');
});

it('can use `defineRoutes`', function () {
    $this->get('hello')
        ->assertOk()
        ->assertSee('hello world');
});
