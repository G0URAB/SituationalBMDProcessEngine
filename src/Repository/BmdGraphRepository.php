<?php

namespace App\Repository;

use App\Entity\BmdGraph;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BmdGraph|null find($id, $lockMode = null, $lockVersion = null)
 * @method BmdGraph|null findOneBy(array $criteria, array $orderBy = null)
 * @method BmdGraph[]    findAll()
 * @method BmdGraph[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BmdGraphRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BmdGraph::class);
    }

    // /**
    //  * @return BmdGraph[] Returns an array of BmdGraph objects
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
    public function findOneBySomeField($value): ?BmdGraph
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
