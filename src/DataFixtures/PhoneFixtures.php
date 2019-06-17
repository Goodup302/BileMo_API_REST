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
        'Galaxy S5',
        'Galaxy S6',
        'Galaxy S7',
        'Galaxy S8',
        'Galaxy Note 1',
        'Galaxy Note 2',
        'Galaxy Note 3',
        //Apple
        "iPhone",
        "iPhone 3G",
        "iPhone 3GS",
        "iPhone 4",
        "iPhone 4S",
        "iPhone 5",
        "iPhone 5c",
        "iPhone 5s",
        "iPhone 6",
        "iPhone 6 Plus",
        "iPhone 6s",
        "iPhone 6s Plus",
        "iPhone SE",
        "iPhone 7",
        "iPhone 7 Plus",
        "iPhone 8",
        "iPhone 8 Plus",
        "iPhone X",
        "iPhone XS",
        "iPhone XS Max",
        "iPhone XR",
        //Huawei
        'P8',
        'P8 lite',
        'P9',
        'P10',
        'P20',
        'P20 mate',
        //Xperia
        'M4',
        'M5',
        'MX',
        //Nokia
        'Lumia 650',
        'Lumia 750',
        'Lumia 850',
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

    public static function builder()
    {
        return self::randomElement(self::BUILDER);
    }

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