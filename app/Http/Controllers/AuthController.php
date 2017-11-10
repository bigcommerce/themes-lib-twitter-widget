<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\BigCommerce\BigCommerceOAuthorizer;
use App\Libraries\BigCommerce\BigCommerceQueries;

class AuthController extends Controller
{
    protected $oauth;
    private $userInfo;
    private $queries;

    public function __construct()
    {
        $this->oauth = new BigCommerceOAuthorizer();
        $this->queries = new BigCommerceQueries();
    }

    public function install(Request $request) {
        $this->userInfo = $this->oauth->authorize($request->code, $request->scope, $request->context);
        $this->queries->createUser($this->userInfo);
        return view('welcome');
    }
}
