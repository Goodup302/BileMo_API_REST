<?php

namespace App\DataFixtures;

use App\Entity\Client;
use App\Entity\Product;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class DataFixtures extends Fixture
{
    use InitFixtures;

    public function load(ObjectManager $manager)
    {
        //Phone
        for ($i=0; $i < 100; $i++) {
            $product = new Product();
            $product->setModel(Phone::model())
                ->setPrice($this->faker->numberBetween("200", "2000"))
                ->setAvailable(rand(0, 1))
                ->setBuilder(Phone::builder())
                ->setDescription($this->faker->realText(500))
                ->setColor(Phone::color())
                ->setMemory(Phone::memory());
            ;
            $manager->persist($product);
        }

        for ($i=0; $i < 4; $i++) {
            $client = new Client();
            $client->setUserName(Phone::telecom());
            $client->setEmail($this->faker->email);
            $client->setPassword($this->encoder->encodePassword($client, "admin"));
            $manager->persist($client);
            for ($ii=0; $ii < 30; $ii++) {
                $user = new User();
                $user->setUserName($this->faker->firstName);
                $user->setEmail($this->faker->email);
                $user->setClient($client);
                $manager->persist($user);
            }
        }
        $manager->flush();
    }
}
