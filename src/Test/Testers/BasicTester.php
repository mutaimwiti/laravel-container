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

        assert(spl_object_hash($resolved) == spl_object_hash($classA), $this->errorMessage);
        assert($resolved instanceof ClassA, $this->errorMessage);
    }
}
