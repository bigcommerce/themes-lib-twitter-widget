<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Libraries\BigCommerceOAuthorizer;

class AuthController extends Controller
{
    protected $oauth;

    public function __construct()
    {
        $this->oauth = new BigCommerceOAuthorizer();
    }

    public function getOauth(Request $request)
    {
        return $this->oauth->authorize($request->code, $request->scope, $request->context);
    }
}
