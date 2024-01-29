<?php
namespace App\Helpers;

use NumberFormatter;

class Currency{
    public static function format($price)
    {
        $format = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
        return $format->formatCurrency($price, "USD");
    }
}
