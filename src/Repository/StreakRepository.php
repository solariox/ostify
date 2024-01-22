<?php

namespace App\Repository;

use App\Entity\Streak;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Streak>
 *
 * @method Streak|null find($id, $lockMode = null, $lockVersion = null)
 * @method Streak|null findOneBy(array $criteria, array $orderBy = null)
 * @method Streak[]    findAll()
 * @method Streak[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StreakRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Streak::class);
    }

//    /**
//     * @return Streak[] Returns an array of Streak objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Streak
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
