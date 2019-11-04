<?php

namespace Acme\Testers;

use Illuminate\Container\Container;

class Tester implements TesterContract
{
    /** @var array TesterContract */
    protected $testers = [
        BasicTester::class,
        MultipleDepsTester::class,
    ];

    public function test(Container $container)
    {
        foreach ($this->testers as $tester) {
            print_r("\nRunning $tester");

            /** @var Tester $tester */
            $tester = new $tester();
            $tester->test($container);

            print_r("\nSuccess :)");
        }
    }
}
