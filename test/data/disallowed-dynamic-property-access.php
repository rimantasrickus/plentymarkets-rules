<?php

class Foo
{
    /** @var string */
    public $name;

    public function doStuff(): void
    {
        $a = 'name';
        $this->name = 'test';

        echo $this->{$a};
        echo $this->name;
    }
}

$name = 'name';

$foo = new Foo();
echo $foo->{$name};
