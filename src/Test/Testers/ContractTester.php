<?php

namespace Acme\Test\Testers;

use Exception;
use Acme\Contracts\ClassY;
use Acme\Contracts\ClassZ;
use Acme\Contracts\ContractY;
use Acme\Contracts\ContractX;
use Acme\Contracts\ContractZ;
use Acme\Test\TesterContract;
use Illuminate\Container\Container;
use Illuminate\Contracts\Container\BindingResolutionException;

class ContractTester implements TesterContract
{
    public function test(Container $container)
    {
        $this->unboundTest($container);
        $this->boundTest($container);
        $this->instanceBoundTest($container);
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

    protected function instanceBoundTest(Container $container)
    {
        $errorMessage = "Interface-class resolution failure";

        $classZ = new ClassZ();

        $container->instance(ContractZ::class, $classZ);

        $resolved = $container->make(ContractZ::class);

        assert(spl_object_hash($classZ) == spl_object_hash($resolved));
        assert($classZ instanceof ClassZ, $errorMessage);
    }

    protected function nestedBindingsTest(Container $container)
    {
        $errorMessage = "Nested bindings resolution failure";

        $container->bind(ContractY::class, ClassY::class);
        $container->bind(ContractZ::class, ContractY::class);

        $resolved = $container->make(ContractZ::class);

        assert($resolved instanceof ClassY, $errorMessage);
    }
}
