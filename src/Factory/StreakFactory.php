<?php

namespace App\Factory;

use App\Entity\Streak;
use App\Repository\StreakRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Streak>
 *
 * @method        Streak|Proxy                     create(array|callable $attributes = [])
 * @method static Streak|Proxy                     createOne(array $attributes = [])
 * @method static Streak|Proxy                     find(object|array|mixed $criteria)
 * @method static Streak|Proxy                     findOrCreate(array $attributes)
 * @method static Streak|Proxy                     first(string $sortedField = 'id')
 * @method static Streak|Proxy                     last(string $sortedField = 'id')
 * @method static Streak|Proxy                     random(array $attributes = [])
 * @method static Streak|Proxy                     randomOrCreate(array $attributes = [])
 * @method static StreakRepository|RepositoryProxy repository()
 * @method static Streak[]|Proxy[]                 all()
 * @method static Streak[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Streak[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Streak[]|Proxy[]                 findBy(array $attributes)
 * @method static Streak[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Streak[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class StreakFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'character' => self::faker()->text(255),
            'score' => self::faker()->randomNumber(2,true),
            'streaker' => UserFactory::new(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Streak $streak): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Streak::class;
    }
}
