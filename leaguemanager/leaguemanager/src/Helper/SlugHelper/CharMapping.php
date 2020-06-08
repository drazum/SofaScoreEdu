<?php


namespace App\Helper\SlugHelper;


class CharMapping
{
    private static array $charMap = [
        'č' => 'c',
        'ć' => 'c',
        'đ' => 'd',
        'š' => 's',
        'ž' => 'z',
        'Č' => 'C',
        'Ć' => 'C',
        'Đ' => 'D',
        'Š' => 'S',
        'Ž' => 'Z'
    ];

    public static function replaceChar(string $char){

        // TODO: array_key_exist
        if(!isset(self::$charMap[$char]))
        {
            // TODO: Exception
            echo "This character is not available.";
        }
        return self::$charMap[$char];
    }
}