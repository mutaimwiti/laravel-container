<?php

use Acme\Test\Tester;
use Illuminate\Container\Container;

require 'vendor/autoload.php';

$tester = new Tester();

$tester->test(Container::getInstance());
