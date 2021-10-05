<?php

namespace App\Repository;

use App\Entity\BusinessText;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BusinessText|null find($id, $lockMode = null, $lockVersion = null)
 * @method BusinessText|null findOneBy(array $criteria, array $orderBy = null)
 * @method BusinessText[]    findAll()
 * @method BusinessText[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BusinessTextRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BusinessText::class);
    }

    // /**
    //  * @return BusinessText[] Returns an array of BusinessText objects
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
    public function findOneBySomeField($value): ?BusinessText
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
