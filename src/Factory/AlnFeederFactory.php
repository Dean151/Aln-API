<?php

namespace App\Factory;

use App\Entity\AlnFeeder;
use App\Repository\AlnFeederRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<AlnFeeder>
 *
 * @method static AlnFeeder|Proxy createOne(array $attributes = [])
 * @method static AlnFeeder[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static AlnFeeder|Proxy find(object|array|mixed $criteria)
 * @method static AlnFeeder|Proxy findOrCreate(array $attributes)
 * @method static AlnFeeder|Proxy first(string $sortedField = 'id')
 * @method static AlnFeeder|Proxy last(string $sortedField = 'id')
 * @method static AlnFeeder|Proxy random(array $attributes = [])
 * @method static AlnFeeder|Proxy randomOrCreate(array $attributes = [])
 * @method static AlnFeeder[]|Proxy[] all()
 * @method static AlnFeeder[]|Proxy[] findBy(array $attributes)
 * @method static AlnFeeder[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static AlnFeeder[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static AlnFeederRepository|RepositoryProxy repository()
 * @method AlnFeeder|Proxy create(array|callable $attributes = [])
 */
final class AlnFeederFactory extends ModelFactory
{
    protected function getDefaults(): array
    {
        return [
            'identifier' => self::faker()->bothify('???#########'),
            'name' => self::faker()->firstName(),
            'ip' => self::faker()->ipv4(),
            'lastSeen' => \DateTimeImmutable::createFromMutable(self::faker()->datetime()),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(AlnFeeder $alnFeeder): void {})
        ;
    }

    protected static function getClass(): string
    {
        return AlnFeeder::class;
    }
}
