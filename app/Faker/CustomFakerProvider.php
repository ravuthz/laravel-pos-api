<?php

namespace App\Faker;

use Faker\Provider\Base;

class CustomFakerProvider extends Base
{
    public function myImageUrl(): string
    {
//        return static::imageUrl(640, 480, 'human', true, 'Faker');
        return '';
    }

    public function myPhoneNumber(): string
    {
        return static::regexify('0[1,6-9]{1}[0-9]{1}-[0-9]{3}-[0-9]{3,4}');
    }

    public function myAccountNumber(): string
    {
        return static::numerify('###-###-###-###');
    }
}
