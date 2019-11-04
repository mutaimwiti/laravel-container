<?php

namespace Acme\Test\Testers;

use Acme\Contracts\ClassY;
use Acme\Contracts\ContractY;
use Exception;
use Acme\Contracts\ContractX;
use Acme\Test\TesterContract;
use Illuminate\Container\Container;
use Illuminate\Contracts\Container\BindingResolutionException;

class ContractTester implements TesterContract
{
    public function test(Container $container)
    {
        $this->unboundTest($container);
    }

    protected function unboundTest($container)
    {
        $errorMessage = 'Expected BindingResolutionException but it was not thrown';

        $exception = null;

        try {
            $container->make(ContractX::class);
        } catch (Exception $e) {
            $exception = $e;
        }

        assert($exception instanceof BindingResolutionException, $errorMessage);
    }

    protected function boundTest(Container $container)
    {
        $errorMessage = "Interface-class resolution failure";

        $container->bind(ContractY::class, ClassY::class);

        $classY = $container->make(ContractY::class);

        assert($classY instanceof ClassY, $errorMessage);
        assert($classY instanceof ContractY, $errorMessage);
    }
}
