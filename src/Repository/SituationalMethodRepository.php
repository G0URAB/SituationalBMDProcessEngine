<?php

namespace App\Repository;

use App\Entity\SituationalMethod;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SituationalMethod|null find($id, $lockMode = null, $lockVersion = null)
 * @method SituationalMethod|null findOneBy(array $criteria, array $orderBy = null)
 * @method SituationalMethod[]    findAll()
 * @method SituationalMethod[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SituationalMethodRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SituationalMethod::class);
    }

    // /**
    //  * @return SituationalMethod[] Returns an array of SituationalMethod objects
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
    public function findOneBySomeField($value): ?SituationalMethod
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
