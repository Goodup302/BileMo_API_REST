<?php

namespace App\DataFixtures;

use App\Entity\Client;
use App\Entity\Product;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i=0; $i < 5; $i++) {
            $product = new Product();
            $product->setTitle("Mobile $i");
            $manager->persist($product);
        }

        for ($i=0; $i < 5; $i++) {
            $client = new Client();
            $client->setName("Client $i");
            $manager->persist($client);
            for ($ii=0; $ii < 5; $ii++) {
                $user = new User();
                $user->setName("User $ii of client $i");
                $user->setClient($client);
                $manager->persist($user);
            }
        }


        $manager->flush();
    }
}
