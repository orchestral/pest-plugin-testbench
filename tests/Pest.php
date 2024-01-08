<?php

use Orchestra\Testbench\Pest\Tests\DuskTestCase;
use Orchestra\Testbench\Pest\Tests\TestCase;

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

uses(DuskTestCase::class)->in('Browser');
uses(TestCase::class)->in('Unit', 'Feature');
