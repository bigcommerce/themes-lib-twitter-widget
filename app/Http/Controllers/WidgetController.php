<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\BigCommerce\BigCommerceTemplates;
use App\Libraries\BigCommerce\BigCommerceStore;

class WidgetController extends Controller
{
    // This will be run on load every time a user opens the app
    // in the BigCommerce backend
    public function load(Request $request)
    {
        $store = new BigCommerceStore();
        $user = $store->currentStore($request);
        $templates = new BigCommerceTemplates($user->context, $user->access_token);
        $template = $templates->updateClientTemplate();
        $data = [
            'user'=>get_object_vars($user),
            'template'=>get_object_vars($template)
        ];

        return view('widget', $data);
    }
}
