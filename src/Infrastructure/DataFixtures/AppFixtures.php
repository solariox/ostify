<?php

namespace App\Infrastructure\DataFixtures;

use App\Factory\StreakFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        UserFactory::createMany(5);
        UserFactory::createOne([
            'email' => 'test@test.fr',
            'password' => 'test',
            ]);
        StreakFactory::createMany(5, function () {
            return [
                'streaker' => UserFactory::random(),
            ];
        });

//        $manager->flush();
    }
}
