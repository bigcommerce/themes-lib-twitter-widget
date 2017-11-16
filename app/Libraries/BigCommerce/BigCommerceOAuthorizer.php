<?php
namespace App\Libraries\BigCommerce;

use Bigcommerce\Api\Connection;
use Bigcommerce\Api\Error;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;

class BigCommerceOAuthorizer
{
    const BIG_COMMERCE_TOKEN_AUTH_URL = "https://login.bigcommerce.com/oauth2/token";
    const BIG_COMMERCE_TOKEN_GRANT_TYPE = "authorization_code";
    const AUTH_API_ROUTE = '/api/auth/bigcommerce';

    private $clientSecret;
    private $clientId;
    private $authUrl;

    public function __construct()
    {
        $this->clientSecret = env('BC_CLIENT_SECRET');
        $this->clientId = env('BC_CLIENT_ID');
        $this->authUrl = $this->getAuthUrl();
        $this->redirectUrl = env('BC_REDIRECT_URL', 'test');
    }

    public function authorize($tempCode, $scope, $context)
    {
        $response = null;

        $requestData = [
            "client_id" => $this->clientId,
            "client_secret" => $this->clientSecret,
            "redirect_uri" => $this->redirectUrl,
            "grant_type" => $this::BIG_COMMERCE_TOKEN_GRANT_TYPE,
            "code" => $tempCode,
            "scope" => $scope,
            "context" => $context,
        ];

        try {
            $client = new Connection();
            $client->failOnError();
            $response = $client->post($this::BIG_COMMERCE_TOKEN_AUTH_URL, $requestData);
        } catch (\Exception $ex) {
            if ($ex instanceof Error) {
                Log::error('BC API error: ' . $ex);
            } else {
                Log::error($ex);
            }
        }

        return $response;
    }

    private function getAuthUrl()
    {
        return URL::to('/') . $this::AUTH_API_ROUTE;
    }
}