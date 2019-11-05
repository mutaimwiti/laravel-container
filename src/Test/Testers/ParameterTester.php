<?php

namespace Acme\Test\Testers;

use Acme\Parameters\ClassA;
use Acme\Parameters\ClassB;
use Acme\Test\TesterContract;
use Illuminate\Container\Container;

class ParameterTester implements TesterContract
{
    public function test(Container $container)
    {
        $this->testConstructorParams($container);
        $this->testFunctionParams($container);
    }

    protected function testConstructorParams(Container $container)
    {
         $errorMessage = 'Constructor parameter resolution failure';

        $container->bind(ClassA::class, function (Container $container, $parameters) {
            return new ClassA($container->make(ClassB::class), ...$parameters);
        });

        $parameters = [7, 'hello world'];

        $resolved = $container->make(ClassA::class, $parameters);

        $classA = new ClassA(new ClassB(), ...$parameters);

        assert($classA == $resolved, $errorMessage);
    }

    protected function testFunctionParams(Container $container)
    {
        $errorMessage = 'Function parameter resolution failure';

        $parameters = ['hello', 'world'];

        $result = $container->call('do_foo', $parameters);

        assert($result == 'hello world', $errorMessage);
    }
}
