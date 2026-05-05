<?php

use Illuminate\Http\Testing\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

if (!function_exists('fakeFile')) {
    function fakeFile($name, $upload = false, $width = 300, $height = 300): string|File
    {
        if ($upload) {
            return UploadedFile::fake()->image($name, $width, $height);

        }

//        return fake()->imageUrl($width, $height, null, true, $name);
//        Not working anymore
//        https://via.placeholder.com/300x300.png/00aa33?text=thumbnail.jpg+ipsum
//        Use one instead
//        https://placehold.co/300x300/00aa33/ffffff.png?text=thumbnail.jpg+ipsum

//        return 'https://api.dicebear.com/8.x/micah/svg?seed=' . Str::uuid();
//        return 'https://api.multiavatar.com/' . Str::uuid() . '.svg';

        $text = Str::of(fake()->name())->snake() . '+' . strtolower($name);
        $color = str_replace('#', '', fake()->hexColor());
        $background = 'transparent'; // ffffff
        return "https://placehold.co/{$width}x{$height}/{$background}/{$color}.png?font=lora&text={$text}";
    }
}

if (!function_exists('fakePhoneNumber')) {
    function fakePhoneNumber()
    {
        return fake()->regexify('0[1,6-9]{1}[0-9]{1}-[0-9]{3}-[0-9]{3,4}');
    }
}

if (!function_exists('fakeSkuCode')) {
    function fakeSkuCode()
    {
        return fake()->unique()->bothify('SKU-###??');
    }
}

if (!function_exists('fakeBarCode')) {
    function fakeBarCode()
    {
        return fake()->unique()->ean13();
    }
}