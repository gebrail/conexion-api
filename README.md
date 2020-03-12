# Some Api

El paquete te permite realizar peticiones a casi cualquier api, de una forma mas organizada y rapida. 

La misión de este paquete es la comunicación de diferentes proyectos de laravel a uno principal.

## Installation

1. Use the composer to install the package.

```bash
composer require gebrail/conexion-api
```

2. Vamos a publicar el archivo de configuracion llamado *some-api*, realice el siguiente comando

```bash
php artisan vendor:publish
```
3. Veras un mensaje preguntando ¿ Which provider or tag's files would you like to publish?, tienes que elegir la llamada 
   some-api-config que se encuentra con el número 17, escribe el numero al cual le corresponda y presional la tecla enter.

```bash
Which provider or tag's files would you like to publish?:
[17] Tag: some-api-config
```
**Listo ya tenemos el paquete instalado** 😀 

## Usage

**Example**

Vamos a crear un Servicio para consultar las facturas generadas por un sistema.


1. Pida las credenciales de su proyecto previamente registrado en el sistema mayor, despues registre las variables de entorno en su proyecto de laravel.

```bash

YEBRAIL_URL=URL DE LA API
YEBRAIL_SISTEMA=ID DEL SISTEMA
YEBRAIL_CLIENT_ID=ID DEL CLIENTE
YEBRAIL_CLIENT_SECRET=EL CLIENT SECRET

```
2. Cree un archivo llamado FacturaService.php dentro de la carpeta Services (crear la carpeta dentro de la carpeta App)

```bash
<?php

namespace App\Services;

use Gebrail\ConexionApi\Traits\AuthorizesSomeApiRequests;
use Gebrail\ConexionApi\Traits\ConsumesExternalServices;
use Gebrail\ConexionApi\Traits\InteractsWithSomeApiResponses;

class FacturaService
{
  /**
    Importamos las clases del paquete recien instalado
  /**
    use ConsumesExternalServices, AuthorizesSomeApiRequests, InteractsWithSomeApiResponses;

    protected $baseUri;
    protected $mi_sistema;

    public function __construct()
    {
      /**
      Configuramos la url y el endpoint base, al cual vamos ha realizar las solicitudes.
      como vemos obtenemos los archivos de configuración llamando al archivo some-api.yebrail.
      /**
        $this->baseUri = config('some-api.yebrail.base_uri')."/mysystem/sistema/";
        $this->mi_sistema = config('some-api.yebrail.mi_sistema')."";
    }

	public function getFacturas()
	{
		return $this->makeRequest('GET', "facturas/{$this->mi_sistema}");
	}

  }

```

3. Probemos nuestro Servicio, como es para fines de aprendizaje, vamos imprimir las facturas generadas del sistema X.

Dirigase al archivo de rutas web.php y agregue el siguiente

```bash

Route::get('/', function () {
		$servicio=new FacturaService;
		$facturas = $servicio->getFacturas();
    return $facturas;
});
```

**Ojo no olvide importar el archivo**

```bash
use App\Services\FacturaService;
```


LISTO VERA UN RESULTADO EN FORMATO JSON :


```json
{
"identificador": 1,
"sistema": 1,
"factura": "0e7a899cbf508ffb09bee37148b0a9b7",
"situacion": "pagado",
"subTotal": 10000,
"impuestos": 1370,
"total": 11370,
"facturacion": "factura_general",
"fechaCreacion": "2020-03-04 16:40:47",
"fechaActualizacion": "2020-03-04 16:40:47",
"fechaEliminacion": null,
"links": [
        {
        "rel": "self",
        "href": "https://URLDELAAPI/api/mysystem/sistema/factura/0e7a899cbf508ffb09bee37148b0a9b7"
        },
        {
        "rel": "factura.servicios",
        "href": "https://URLDELA/api/mysystem/sistema/factura/0e7a899cbf508ffb09bee37148b0a9b7/servicios"
        }
        ]
}
```

### Espero que este ejemplo te facilite realizar tus respectivas consultas a la api, como en este ejemplo las facturas de tus sistemas de información a tus clientes, para mas información consulte la documentación del dashboard de yebrail.


## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

## License
[MIT](./LICENSE.md)
