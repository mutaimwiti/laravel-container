<?php

use Illuminate\Container\Container;

require 'vendor/autoload.php';

$tester = new \Acme\Testers\Tester();

$tester->test(Container::getInstance());
