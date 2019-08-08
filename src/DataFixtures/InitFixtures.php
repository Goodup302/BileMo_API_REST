<?php

namespace App\DataFixtures;

use Faker\Factory;
use Faker\Generator;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

trait InitFixtures
{
    /**
     * @var Generator
     */
    private $faker;

    /**
     * UserPasswordEncoderInterface
     */
    private $encoder;

    private $phoneNumber = 1000;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->faker = Factory::create('fr_FR');
        $this->encoder = $encoder;
    }
}