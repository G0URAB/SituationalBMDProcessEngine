<?php

namespace App\Repository;

use App\Entity\BusinessModelDefinition;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BusinessModelDefinition|null find($id, $lockMode = null, $lockVersion = null)
 * @method BusinessModelDefinition|null findOneBy(array $criteria, array $orderBy = null)
 * @method BusinessModelDefinition[]    findAll()
 * @method BusinessModelDefinition[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BusinessModelDefinitionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BusinessModelDefinition::class);
    }

    // /**
    //  * @return BusinessModelDefinition[] Returns an array of BusinessModelDefinition objects
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
    public function findOneBySomeField($value): ?BusinessModelDefinition
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
