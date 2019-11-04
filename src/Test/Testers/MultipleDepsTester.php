<?php

namespace Acme\Test\Testers;

use Acme\MultipleDeps\ClassA;
use Acme\MultipleDeps\ClassB;
use Acme\Test\TesterContract;
use Illuminate\Container\Container;

class MultipleDepsTester implements TesterContract
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
