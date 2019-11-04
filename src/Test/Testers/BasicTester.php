<?php

namespace Acme\Test\Testers;

use Acme\Basic\ClassA;
use Acme\Basic\ClassB;
use Acme\Test\TesterContract;
use Illuminate\Container\Container;

class BasicTester implements TesterContract
{
    protected $errorMessage = 'Class resolution failure';

    public function test(Container $container)
    {
        $classA = $container->make(ClassA::class);
        assert($classA instanceof ClassA, $this->errorMessage);

        $classB = $container->make(ClassB::class);
        assert($classB instanceof ClassB, $this->errorMessage);
    }
}
