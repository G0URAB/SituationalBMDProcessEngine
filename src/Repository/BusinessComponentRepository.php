<?php

namespace App\Repository;

use App\Entity\BusinessComponent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BusinessComponent|null find($id, $lockMode = null, $lockVersion = null)
 * @method BusinessComponent|null findOneBy(array $criteria, array $orderBy = null)
 * @method BusinessComponent[]    findAll()
 * @method BusinessComponent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BusinessComponentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BusinessComponent::class);
    }

    // /**
    //  * @return BusinessSegment[] Returns an array of BusinessSegment objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BusinessSegment
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
