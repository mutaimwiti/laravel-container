<?php

namespace Acme\Test\Testers;

use Exception;
use Acme\Contracts\ContactX;
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
            $container->make(ContactX::class);
        } catch (Exception $e) {
            $exception = $e;
        }

        assert($exception instanceof BindingResolutionException, $errorMessage);
    }
}
