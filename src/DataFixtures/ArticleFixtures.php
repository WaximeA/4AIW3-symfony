<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();

        for ($i=0; $i < 10; $i++){
            $article = (new Article())
                ->setName($faker->lastName)
                ->setContent($faker->text);
            $manager->persist($article);
        }

        $manager->flush();
    }
}
