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
        //Phones
        for ($i=0; $i < 100; $i++) {
            $product = new Product();
            $product->setModel(PhoneFixtures::model())
                ->setPrice($this->faker->numberBetween("200", "2000"))
                ->setAvailable(rand(0, 1))
                ->setDescription($this->faker->realText(500))
                ->setColor(PhoneFixtures::color())
                ->setMemory(PhoneFixtures::memory());
            ;
            $manager->persist($product);
        }

        //Clients
        for ($i=0; $i < 4; $i++) {
            $client = new Client();
            $client->setUserName(PhoneFixtures::telecom())
                ->setEmail($this->faker->email)
                ->setPassword($this->encoder->encodePassword($client, "admin"))
            ;
            $manager->persist($client);
            //Users
            for ($ii=0; $ii < 10; $ii++) {
                $user = new User();
                $user->setUserName($this->faker->firstName)
                    ->setEmail($this->faker->email)
                    ->setClient($client)
                ;
                $manager->persist($user);
            }
        }

        $manager->flush();
    }
}
