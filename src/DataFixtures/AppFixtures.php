<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Factory\UserEntityFactory; 
 
class AppFixtures extends Fixture 
{
    public function load(ObjectManager $manager  ): void
    {
        // $product = new Product();
        // $manager->persist($product);

        UserEntityFactory::createOne([
            'email' => 'admin@test.com',
            'roles' => ['ROLE_ADMIN']
        ]);

        UserEntityFactory::createOne([
            'email' => 'user@test.com',
    
        ]);

        UserEntityFactory::createMany(10);

        $manager->flush();
    }
}
