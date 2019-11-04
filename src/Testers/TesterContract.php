<?php

namespace Acme\Testers;

use Illuminate\Container\Container;

interface TesterContract {
    public function test(Container $container);
}
