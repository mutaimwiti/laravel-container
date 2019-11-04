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
        $this->testAutoResolve($container);
        $this->testInstanceBound($container);
    }

    protected function testAutoResolve(Container $container)
    {
        $classA = $container->make(ClassA::class);
        assert($classA instanceof ClassA, $this->errorMessage);

        $classB = $container->make(ClassB::class);
        assert($classB instanceof ClassB, $this->errorMessage);
    }

    protected function testInstanceBound(Container $container)
    {
        $classA = new ClassA();
        $container->instance(ClassA::class, $classA);

        $resolved = $container->make(ClassA::class);

        assert($resolved == $classA, $this->errorMessage);
        assert($resolved instanceof ClassA, $this->errorMessage);

        $classB = new ClassB();
        $container->instance(ClassB::class, $classB);

        $resolved = $container->make(ClassB::class);

        assert($resolved == $classB, $this->errorMessage);
        assert($resolved instanceof ClassB, $this->errorMessage);
    }
}
