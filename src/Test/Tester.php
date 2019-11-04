<?php

namespace Acme\Test;

use Acme\Test\Testers\ContractTester;
use Illuminate\Container\Container;

use Acme\Test\Testers\BasicTester;
use Acme\Test\Testers\NestedDepsTester;
use Acme\Test\Testers\MultipleDepsTester;

class Tester implements TesterContract
{
    /** @var array TesterContract */
    protected $testers = [
        BasicTester::class,
        MultipleDepsTester::class,
        NestedDepsTester::class,
        ContractTester::class,
    ];

    public function test(Container $container)
    {
        foreach ($this->testers as $tester) {
            print_r("\nRunning $tester");

            /** @var TesterContract $tester */
            $tester = new $tester();
            $tester->test($container);

            print_r("\nSuccess :)");
        }
    }
}
