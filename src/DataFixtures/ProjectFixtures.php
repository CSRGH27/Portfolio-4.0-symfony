<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Project;

class ProjectFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');

        for ($i=0; $i <= 9; $i++) { 
            $project = new Project();
            $project ->setTitle($faker->city())
                     ->setContent($faker->text(400))
                     ->setImage($faker->imageUrl(700, 450, 'transport'));
            $manager->persist($project);

        }

        $manager->flush();
    }
}
