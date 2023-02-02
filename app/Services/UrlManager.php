<?php

namespace App\Services;

class UrlManager
{
    public static function create()
    {
        $letters = 'qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890';
        $count = strlen($letters);
        $intval = time();
        $result = '';
        for ($i = 0; $i < 5; $i++) {
            $last = $intval % $count;
            $intval = ($intval - $last) / $count;
            $result .= $letters[$last];
        }
        return $result;
    }
}