<?php
function displayError(string $field, array $erros = null)
{
    if (empty($erros)) {
        return;
    }

    if (array_key_exists($field, $erros)) {
        return "<div class='mt-2 px-1 bg-danger rounded'>
                    <span class='text-white px-1'><i class='fa-solid fa-triangle-exclamation me-2'></i>$erros[$field]</span>
                </div>";
    }
}

function calculatePromotion($value, $discount)
{
    if ($discount == 0) {
        return $value;
    }

    return round($value - ($value * $discount) / 100, 2);
}

function formatPrice($price)
{
    return number_format($price, 2, ',', '.');
}

function printData($data, $die = true)
{
    echo "<pre>";
    echo str_repeat('-', 40) . '<br> /';
    echo print_r($data, true);
    echo "<br/>";
    echo str_repeat('-', 40) . '<br />';

    if ($die) die(1);
}
