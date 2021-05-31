<?php

namespace App\Repository;

use App\Entity\SituationalFactor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SituationalFactor|null find($id, $lockMode = null, $lockVersion = null)
 * @method SituationalFactor|null findOneBy(array $criteria, array $orderBy = null)
 * @method SituationalFactor[]    findAll()
 * @method SituationalFactor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SituationalFactorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SituationalFactor::class);
    }

    // /**
    //  * @return SituationalFactor[] Returns an array of SituationalFactor objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SituationalFactor
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
