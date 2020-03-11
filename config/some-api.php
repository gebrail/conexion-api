<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Servicios
    |--------------------------------------------------------------------------    
    |Este archivo proporciona una ubicación predeterminada correcta para este 
    |tipo de información, permitiendo que los paquetes tengan un lugar convencional
    |para encontrar sus diversas credenciales.
    */


    /**
     * 
     * ¿Por que yebrail?
     * 
     * Solo es un indentificador para acceder a las variables de entorno mas facil.
     * pero si gustas puedes modificarlo, pero tendras que modificar el resto de archivos
     * que dependan de ello, ejemplo se trae la url del archivo .env 
     * utilizando someapi.yebrail.base_uri, teniendo encuenta la variable de entorno que tengas.
     * si quieres camnbiar el nombre yebrail a conexion u otro nombre sientase libre de hacerlo.
     * 
     */


    'yebrail' => [
        'base_uri' => env('YEBRAIL_URL'),
        'client_id' => env('YEBRAIL_CLIENT_ID'),
        'client_secret' => env('YEBRAIL_CLIENT_SECRET'),
        'mi_sistema' => env('YEBRAIL_SISTEMA'),
    ],

];
