<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TagFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();

        for ($i=0; $i < 10; $i++){
            $article = (new Tag)
                ->setName($faker->firstName);
            $manager->persist($article);
        }

        $manager->flush();
    }
}
