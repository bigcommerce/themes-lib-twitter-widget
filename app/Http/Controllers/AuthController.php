<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\BigCommerce\BigCommerceOAuthorizer;
use App\Libraries\BigCommerce\BigCommerceQueries;
use App\Libraries\BigCommerce\BigCommerceTemplates;

class AuthController extends Controller
{
    public function install(Request $request)
    {
        $oauth = new BigCommerceOAuthorizer();
        $queries = new BigCommerceQueries();

        $userInfo = $oauth->authorize(
            $request->code,
            $request->scope,
            $request->context
        );
        $queries->createUser($userInfo);

        $userCreated = $queries->getUser($userInfo->context);

        $templates = new BigCommerceTemplates(
            $userCreated->context,
            $userCreated->access_token
        );
        $template = $templates->updateClientTemplate();
        $data = [
            'user'=>get_object_vars($userCreated),
            'template'=>get_object_vars($template)
        ];

        return view('editor', $data);
    }
}
