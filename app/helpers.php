<?php

if (!function_exists('formatPrice')) {
    function formatPrice(int|float $price): string
    {
        return number_format($price, 2, '.', ' ');
    }
}
