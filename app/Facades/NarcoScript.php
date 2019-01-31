<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class NarcoScript extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'NarcoScript';
    }
}