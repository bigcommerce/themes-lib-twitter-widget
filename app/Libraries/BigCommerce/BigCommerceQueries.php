<?php
namespace App\Libraries\BigCommerce;

use Illuminate\Support\Facades\DB;

class BigCommerceQueries
{
    public function createUser($userInfo)
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

        return $this->getUser($userInfo->context);
    }

    public function updateUser($userInfo)
    {
        $userUpdated = DB::table('users')
            ->where('context', $userInfo['context'])
            ->update([
                'twitter_handle' => $userInfo['twitterHandle'],
                'number_posts' => $userInfo['numberPosts'],
            ]);

        return $this->getUser($userInfo['context']);
    }

    public function getUser($context)
    {
        return DB::table('users')
            ->where('context', $context)
            ->first();
    }
}
