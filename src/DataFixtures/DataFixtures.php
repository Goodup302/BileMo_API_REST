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
        for ($i=0; $i < 5; $i++) {
            $product = new Product();
            $product->setTitle("Mobile $i")
                ->setPrice(10.05)
                ->setAvailable(true)
                ->setBuilder('Apple')
            ;
            $manager->persist($product);
        }

        for ($i=0; $i < 5; $i++) {
            $client = new Client();
            $client->setUserName("Client $i");
            $client->setEmail("test@test.fr");
            $client->setPassword($this->encoder->encodePassword($client, "admin"));
            $manager->persist($client);
            for ($ii=0; $ii < 5; $ii++) {
                $user = new User();
                $user->setUserName("User $ii of client $i");
                $user->setEmail("test@test.fr");
                $user->setClient($client);
                $manager->persist($user);
            }
        }
        $manager->flush();
    }
}
