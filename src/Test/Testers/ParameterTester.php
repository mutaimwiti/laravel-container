<?php

namespace Acme\Test\Testers;

use Acme\Parameters\ClassA;
use Acme\Parameters\ClassB;
use Acme\Test\TesterContract;
use Illuminate\Container\Container;

class ParameterTester implements TesterContract
{
    protected $errorMessage = 'Arbitrary value resolution failure';

    public function test(Container $container)
    {
        $container->bind(ClassA::class, function (Container $container, $parameters) {
            new ClassA($container->make(ClassB::class), ...$parameters);
        });

        $container->make(ClassA::class, [7, 'hello world']);
    }
}
