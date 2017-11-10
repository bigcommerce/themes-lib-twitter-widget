<?php
namespace App\Libraries\BigCommerce;

use Bigcommerce\Api\Client;
use Bigcommerce\Api\Error;
use Illuminate\Support\Facades\Log;

class BigCommerceApi
{
    protected $api;

    protected function __construct($storeHash, $accessToken)
    {
        $this->api = new Client();
        $this->api->configure(array(
            'client_id' => env('BC_CLIENT_ID'),
            'store_hash' => BigCommerceApiHelpers::uidFromContext($storeHash),
            'auth_token' => $accessToken
        ));
        $this->api->failOnError();
    }

    public static function i($storeHash, $accessToken) {
        return new BigCommerceApi($storeHash, $accessToken);
    }

    public function getStoreInformation()
    {
        try {
            $response = $this->api->getStore();
            return $response;
        } catch(\Exception $ex) {
            if ($ex instanceof Error) {
                Log::error('BC API error: ' . $ex . $ex->getLine());
            } else {
                Log::error($ex);
            }
        }

        return null;
    }
}