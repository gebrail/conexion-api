<?php

namespace Gebrail\ConexionApi\Facades;


use Illuminate\Support\Facades\Facade;

class SomeApi extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'some-api';
    }
}

