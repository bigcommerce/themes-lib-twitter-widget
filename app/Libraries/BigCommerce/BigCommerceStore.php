<?php
namespace App\Libraries\BigCommerce;

use Illuminate\Support\Facades\DB;

class BigCommerceStore
{
    public function checkPayload($request)
    {
        $payload = $request->signed_payload;
        list($encodedData, $encodedSignature) = explode('.', $payload, 2);

        // decode the data
        $signature = base64_decode($encodedSignature);
        $jsonStr = base64_decode($encodedData);
        $data = json_decode($jsonStr, true);

        // confirm the signature
        $expectedSignature = hash_hmac('sha256', $jsonStr, env('BC_CLIENT_SECRET'), $raw = false);

        if (!hash_equals($expectedSignature, $signature)) {
            error_log('Bad signed request from BigCommerce!');
            return null;
        }

        return $data;
    }

    public function currentStore($request)
    {
        $data = $this->checkPayload($request);

        return DB::table('users')->where('context', $data['context'])->first();
    }

    public function deleteStore($context)
    {
        return DB::table('users')->where('context', $context)->delete();
    }
}
