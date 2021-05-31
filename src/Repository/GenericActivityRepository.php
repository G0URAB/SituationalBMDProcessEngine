<?php

namespace App\Repository;

use App\Entity\GenericActivity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GenericActivity|null find($id, $lockMode = null, $lockVersion = null)
 * @method GenericActivity|null findOneBy(array $criteria, array $orderBy = null)
 * @method GenericActivity[]    findAll()
 * @method GenericActivity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GenericActivityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GenericActivity::class);
    }

    // /**
    //  * @return GenericActivity[] Returns an array of GenericActivity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GenericActivity
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
