<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\BigCommerce\BigCommerceOAuthorizer;
use App\Libraries\BigCommerce\BigCommerceQueries;
use App\Libraries\BigCommerce\BigCommerceTemplates;
use App\Libraries\BigCommerce\BigCommerceStore;
use App\Libraries\BigCommerce\BigCommerceWidgets;

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

        $userCreated = $queries->createUser($userInfo);

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

    public function uninstall(Request $request)
    {
        // There's no point returning anything here because BC will ignore it.
        $store = new BigCommerceStore();
        $data = $store->checkPayload($request);
        $queries = new BigCommerceQueries();
        $user = $queries->getUser($data['context']);
        $widgetHelper = new BigCommerceWidgets($user->context, $user->access_token);

        // Delete widget from user's store
        $widgetHelper->deleteWidgets();
        // Delete from db
        $store->deleteStore($user->context);
    }
}
