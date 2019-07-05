<?php

namespace App\DataFixtures;

use Faker\Provider\Base;

class PhoneFixtures extends Base
{
    const TELECOM = [
        'Free',
        'Orange',
        'SFR',
        'Bouygues Telecom',
    ];

    const BUILDER = [
        'Samsung',
        'Apple',
        'Huawei',
        'Xiaomi',
        'Mi',
        'Xperia',
        'Nokia',
    ];

    const MODEL = [
        //Samsung
        'Samsung Galaxy S5',
        'Samsung Galaxy S6',
        'Samsung Galaxy S7',
        'Samsung Galaxy S8',
        'Samsung Galaxy Note 1',
        'Samsung Galaxy Note 2',
        'Samsung Galaxy Note 3',
        //Apple
        "Apple iPhone",
        "Apple iPhone 3G",
        "Apple iPhone 3GS",
        "Apple iPhone 4",
        "Apple iPhone 4S",
        "Apple iPhone 5",
        "Apple iPhone 5c",
        "Apple iPhone 5s",
        "Apple iPhone 6",
        "Apple iPhone 6 Plus",
        "Apple iPhone 6s",
        "Apple iPhone 6s Plus",
        "Apple iPhone SE",
        "Apple iPhone 7",
        "Apple iPhone 7 Plus",
        "Apple iPhone 8",
        "Apple iPhone 8 Plus",
        "Apple iPhone X",
        "Apple iPhone XS",
        "Apple iPhone XS Max",
        "Apple iPhone XR",
        //Huawei
        'Huawei P8',
        'Huawei P8 lite',
        'Huawei P9',
        'Huawei P10',
        'Huawei P20',
        'Huawei P20 mate',
        //Xperia
        'Xperia M4',
        'Xperia M5',
        'Xperia MX',
        //Nokia
        'Nokia Lumia 650',
        'Nokia Lumia 750',
        'Nokia Lumia 850',
    ];

    const COLOR = [
        'noir',
        'blanc',
        'vert',
        'rouge',
        'bleu',
        'or',
        'argent',
    ];

    public static function model()
    {
        return self::randomElement(self::MODEL);
    }

    public static function memory()
    {
        return rand(1, 12);
    }

    public static function color(): string
    {
        return self::randomElement(self::COLOR);
    }

    public static function telecom(): string
    {
        return self::randomElement(self::TELECOM);
    }
}