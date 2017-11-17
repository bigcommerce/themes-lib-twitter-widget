<?php

namespace App\Libraries\BigCommerce;

class BigCommerceApiHelpers
{
    public static function uidFromContext($context)
    {
        return explode('/', $context, 2)[1];
    }
}
