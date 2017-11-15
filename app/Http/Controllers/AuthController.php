<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\BigCommerce\BigCommerceOAuthorizer;
use App\Libraries\BigCommerce\BigCommerceQueries;

class AuthController extends Controller
{
    public function install(Request $request)
    {
        $oauth = new BigCommerceOAuthorizer();
        $queries = new BigCommerceQueries();

        $userInfo = $oauth->authorize($request->code, $request->scope, $request->context);
        $queries->createUser($userInfo);

        return view('widget', get_object_vars($userInfo));
    }
}
