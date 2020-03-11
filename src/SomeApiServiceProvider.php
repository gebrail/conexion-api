<?php

namespace Gebrail\ConexionApi;

use Illuminate\Support\ServiceProvider;


class SomeApiServiceProvider extends ServiceProvider
{
    public function boot()
    {

        $this->publishes([
            $this->basePath('config/some-api.php') => base_path('config/some-api.php')
        ], 'some-api-config');

    }

    public function register()
    {
        $this->mergeConfigFrom(
         $this->basePath('config/some-api.php'),
         'some-api'
     );

    }


    protected function basePath($path='')
    {
        return __DIR__.'/../'.$path;
    }

}

