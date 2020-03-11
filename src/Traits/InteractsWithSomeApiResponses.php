<?php

namespace Gebrail\ConexionApi\Traits;

trait InteractsWithSomeApiResponses
{
    /**
     * Decode correspondingly the response
     * @param  array $response
     * @return stdClass
     */
    public function decodeResponse($response)
    {
        $decodedResponse = json_decode($response);

        return $decodedResponse->data ?? $decodedResponse;
    }

    /**
     * Resolve if the request to the service failed
     * @param  array $response
     * @return void
     */
    public function checkIfErrorResponse($response)
    {
        if (isset($response->error)) {
            throw new \Exception("Algo falló: {$response->error}");
        }
    }
}
