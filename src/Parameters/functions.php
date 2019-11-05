<?php

use Acme\Parameters\ClassB;

function do_foo(ClassB $classB, $bar, $baz)
{
    return "$bar $baz";
}
