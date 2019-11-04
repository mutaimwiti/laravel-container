<?php

namespace Acme\Test\Testers;

use Acme\Test\TesterContract;
use Illuminate\Container\Container;

class ArbitraryTester implements TesterContract
{
    protected $errorMessage = 'Arbitrary value resolution failure';

    public function test(Container $container)
    {
        $container->bind('foo', function () {
            return 'bar';
        });

        $resolved = $container->make('foo');

        assert($resolved === 'bar', $this->errorMessage);
    }
}
