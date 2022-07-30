<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\AlnPlannedMeal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AlnPlannedMeal>
 *
 * @method AlnPlannedMeal|null find($id, $lockMode = null, $lockVersion = null)
 * @method AlnPlannedMeal|null findOneBy(array $criteria, array $orderBy = null)
 * @method AlnPlannedMeal[]    findAll()
 * @method AlnPlannedMeal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
final class AlnPlannedMealRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AlnPlannedMeal::class);
    }

    public function add(AlnPlannedMeal $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(AlnPlannedMeal $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
