<?php

namespace App\Tests\Helper;


use App\Helper\SlugHelper\SlugHelper;
use PHPUnit\Framework\TestCase;

class SlugHelperTest extends TestCase
{
    public function slugify(){
        self::assertEquals('marin-cilic-juric', SlugHelper::slugify('Marin Čilić Jurić'));
    }
}