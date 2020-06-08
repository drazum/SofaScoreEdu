<?php


namespace App\Helper\SlugHelper;


class SlugHelper
{
    public static function slugify(string $name): string
    {
        $replace = function ($match): string{
            return CharMapping::replaceChar($match[0]);
        };

        $name = mb_ereg_replace_callback("[^a-zA-Z\s\-.]", $replace, $name);

        $concatenate = function ($match): string{
            return $match[0] === '.' ? '' : '-';
        };

        $name = preg_replace_callback("@[\s.]+@", $concatenate, $name);

        return strtolower($name);
    }
}