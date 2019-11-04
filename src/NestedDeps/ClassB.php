<?php

namespace Acme\NestedDeps;

use Acme\MultipleDeps\ClassC;

class ClassB
{
    protected $classC;

    public function __construct(ClassC $classC)
    {
        $this->classC = $classC;
    }
}
