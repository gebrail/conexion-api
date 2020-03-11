<?php

namespace Gebrail\ConexionApi\Services;

use Gebrail\ConexionApi\Traits\AuthorizesSomeApiRequests;
use Gebrail\ConexionApi\Traits\ConsumesExternalServices;
use Gebrail\ConexionApi\Traits\InteractsWithSomeApiResponses;

class SomeApiAuthenticationService
{
    /**
     * The url from which send the requests
     * @var string
     */
    protected $baseUri;

    /**
     * The client_id to identify the client in the API
     * @var string
     */
    protected $clientId;

    /**
     * The client_secret to identify the client in the API
     * @var string
     */
    protected $clientSecret;


    use ConsumesExternalServices, InteractsWithSomeApiResponses;

    public function __construct()
    {
        $this->baseUri = config('some-api.yebrail.base_uri');
        $this->clientId = config('some-api.yebrail.client_id');
        $this->clientSecret = config('some-api.yebrail.client_secret');
    }

    public function getClientCredentialsToken()
    {
        if ($token = $this->existingValidClientCredentialsToken()) {
            return $token;
        }

        $formParams = [
            'grant_type' => 'client_credentials',
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
        ];

        $tokenData = $this->makeRequest('POST', 'api/oauth/token', [], $formParams);

        $this->storeValidToken($tokenData, 'client_credentials');

        return $tokenData->access_token;
    }

    /**
     * Stores a valid token
     * @param  stdClass $tokenData
     * @param  string $grantType
     * @return void
     */
    public function storeValidToken($tokenData, $grantType)
    {
        $tokenData->token_expires_at = now()->addSeconds($tokenData->expires_in - 5);
        $tokenData->access_token = "{$tokenData->token_type} {$tokenData->access_token}";
        $tokenData->grant_type = $grantType;

        session()->put(['current_token' => $tokenData]);
    }


    /**
     * Verifies if any token exsiting
     * @return string|boolean
     */
    public function existingValidClientCredentialsToken()
    {
        if (session()->has('current_token')) {
            $tokenData = session()->get('current_token');

            if (now()->lt($tokenData->token_expires_at)) {
                return $tokenData->access_token;
            }
        }

        return false;
    }


}