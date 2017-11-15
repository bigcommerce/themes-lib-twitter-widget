<?php
namespace App\Libraries\BigCommerce;

use Illuminate\Support\Facades\DB;

class BigCommerceQueries {
    public function createUser ($userInfo)
    {
        $tableData = [
            [
                'user_id' => $userInfo->user->id,
                'access_token' => $userInfo->access_token,
                'context' => $userInfo->context
            ]
        ];

        $currentUser = DB::table('users')
            ->where('context', $userInfo->context)
            ->first();
        if ($currentUser) {
            $userCreated = DB::table('users')
                ->where('context', $userInfo->context)
                ->update(['access_token'=> $userInfo->access_token]);
        } else {
            $userCreated = DB::table('users')->insert($tableData);
        }

        return $userCreated;
    }
}
