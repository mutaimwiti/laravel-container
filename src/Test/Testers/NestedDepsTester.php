<?php

namespace Acme\Test\Testers;

use Acme\MultipleDeps\ClassA;
use Acme\Test\TesterContract;
use Illuminate\Container\Container;

class NestedDepsTester implements TesterContract
{
    protected $errorMessage = 'Class resolution failure';

    public function test(Container $container)
    {
        $classA = $container->make(ClassA::class);
        assert($classA instanceof ClassA, $this->errorMessage);
    }
}
