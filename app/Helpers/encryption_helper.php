<?php

use Config\Services;

function encrypt($value)
{
    if (empty($value)) {
        return null;
    }

    try {
        $encryption = Services::encrypter();
        return bin2hex($encryption->encrypt($value));
    } catch (\Exception $e) {
        return null;
    }
}

function decrypt($value)
{
    if (empty($value)) {
        return null;
    }

    try {
        $encryption = Services::encrypter();
        return $encryption->decrypt(hex2bin($value));
    } catch (\Exception $e) {
        return null;
    }
}
