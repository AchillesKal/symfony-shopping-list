<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\ShoppingList;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 5; $i++) {
            $fakeFacebookId = 12345678912345 . $i;
            $fakeEmail = "fake" . $i . '@mail.com';
            $user = new User($fakeEmail,$fakeFacebookId);

            // Create 2 shopping lists per user.
            for($x = 0; $x < 2; $x++) {
                $product = new Product();
                $product->setName("Product1");
                $shoppingList = new ShoppingList();
                $shoppingList->setName("ShoppingList" . $x);
                $shoppingList->setOwner($user);
                $shoppingList->addProduct($product);
                $manager->persist($shoppingList);
            }


            $manager->persist($user);
        }

        $manager->flush();
    }
}