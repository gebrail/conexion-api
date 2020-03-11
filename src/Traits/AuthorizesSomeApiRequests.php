<?php

namespace Gebrail\ConexionApi\Traits;

use Gebrail\ConexionApi\Services\SomeApiAuthenticationService;

trait AuthorizesSomeApiRequests
{
    /**
     * Resolves the elements to send when authorazing the request
     * @param  array &$queryParams
     * @param  array &$formParams
     * @param  array &$headers
     * @return void
     */
    public function resolveAuthorization(&$queryParams, &$formParams, &$headers)
    {
        $accessToken = $this->resolveAccessToken();

        $headers['Authorization'] = $accessToken;
    }

    /** 
     * Esta funcion es para obtener un token valido para realizar la consulta
     * 
    */


    public function resolveAccessToken()
    {
       $authenticationService = resolve(SomeApiAuthenticationService::class);

        return $authenticationService->getClientCredentialsToken();
    }
}
