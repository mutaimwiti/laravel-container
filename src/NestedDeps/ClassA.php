<?php

namespace Acme\NestedDeps;

class ClassA
{
    protected $classB;

    public function __construct(ClassB $classB)
    {
        $this->classB = $classB;
    }
}
