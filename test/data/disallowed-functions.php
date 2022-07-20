<?php

class Foo
{
    public function doFoo()
    {
        return is_dir(__DIR__);
    }

    public function doBar()
    {
        return gettype('test');
    }
}
