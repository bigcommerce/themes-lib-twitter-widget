<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\BigCommerce\BigCommerceStore;

class WidgetController extends Controller
{
    public function load(Request $request)
    {
        $store = new BigCommerceStore();

        $user = $store->setStore($request);

        return view('widget', get_object_vars($user));
    }
}
