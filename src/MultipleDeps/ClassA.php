<?php

namespace Acme\MultipleDeps;

class ClassA
{
    protected $classB;
    protected $classC;

    public function __construct(ClassB $classB, ClassC $classC)
    {
        $this->classB = $classB;
        $this->classC = $classC;
    }
}
