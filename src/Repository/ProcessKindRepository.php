<?php

namespace App\Repository;

use App\Entity\ProcessKind;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProcessKind|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProcessKind|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProcessKind[]    findAll()
 * @method ProcessKind[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProcessKindRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProcessKind::class);
    }

    // /**
    //  * @return ProcessKind[] Returns an array of ProcessKind objects
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
    public function findOneBySomeField($value): ?ProcessKind
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
