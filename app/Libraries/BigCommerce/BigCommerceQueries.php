<?php
namespace App\Libraries\BigCommerce;

use Illuminate\Support\Facades\DB;
use App\Libraries\BigCommerce\BigCommerceApi;
use App\Libraries\BigCommerce\BigCommerceApiHelpers;

class BigCommerceQueries {
    private $tableData;

    public function __construct ()
    {

    }

    public function createUser ($userInfo)
    {
        $tableData = [
            [
                'user_id' => $userInfo->user->id,
                'access_token' => $userInfo->access_token,
                'context' => $userInfo->context
            ]
        ];

        $user_created = DB::table('users')->insert($tableData);
        return $user_created;
    }
}