<?php

namespace Acme\Test;

use Illuminate\Container\Container;

interface TesterContract {
    public function test(Container $container);
}
