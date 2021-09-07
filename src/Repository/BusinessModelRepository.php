<?php

namespace App\Repository;

use App\Entity\BusinessModel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BusinessModel|null find($id, $lockMode = null, $lockVersion = null)
 * @method BusinessModel|null findOneBy(array $criteria, array $orderBy = null)
 * @method BusinessModel[]    findAll()
 * @method BusinessModel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BusinessModelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BusinessModel::class);
    }

    // /**
    //  * @return Artifact[] Returns an array of Artifact objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Artifact
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

}
