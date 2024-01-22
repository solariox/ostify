<?php

namespace App\DataFixtures;

use App\Factory\StreakFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        UserFactory::createMany(5);
        StreakFactory::createMany(5, function () {
            return [
                'streaker' => UserFactory::random(),
            ];
        });

//        $manager->flush();
    }
}
