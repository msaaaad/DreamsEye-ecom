<?php

namespace App\Helpers;

class Validator
{
    public static function image($mimes,$extension){
        if (in_array($extension, $mimes)){
            return true;
        }
        return false;
    }
}
