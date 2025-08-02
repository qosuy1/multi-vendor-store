<?php

class Autoload
{
    public static function register($classname)
    {
        include __DIR__ . "/{$classname}.php";
    }
}

spl_autoload_register([Autoload::class, 'register']);