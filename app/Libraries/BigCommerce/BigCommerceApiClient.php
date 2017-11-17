<?php

namespace App\Libraries\BigCommerce;

use guzzlehttp\guzzle;

class BigCommerceApiClient
{
    public $api;

    public function __construct ($storeHash, $token)
    {
        $this->api = new \GuzzleHttp\Client([
            'base_uri' =>
                'https://api.bigcommerce.com/stores/'
                . BigCommerceApiHelpers::uidFromContext($storeHash)
                . '/v3/',
            'headers' => [
                'Accept' => 'application/json',
                'X-Auth-Client' => env('BC_CLIENT_ID'),
                'X-Auth-Token' => $token
            ]
        ]);
    }

    public function get($path = '')
    {
        $request = $this->api->get($path);
        if ($request->getStatusCode() !== 200) return null;
        $response = json_decode($request->getBody());

        return $response->data;
    }

    public function post($path, $data = [])
    {
        $response = $this->api->post($path, $data);
        if($response->getStatusCode() !== 200) return null;

        return json_decode($response->getBody())->data;
    }

    public function put($path, $data = [])
    {
        $response = $this->api->put($path, $data);
        if ($response->getStatusCode() !== 200) return null;

        return json_decode($response->getBody())->data;
    }
}
