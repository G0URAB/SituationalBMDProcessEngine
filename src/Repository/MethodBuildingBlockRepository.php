<?php

namespace App\Repository;

use App\Entity\MethodBuildingBlock;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MethodBuildingBlock|null find($id, $lockMode = null, $lockVersion = null)
 * @method MethodBuildingBlock|null findOneBy(array $criteria, array $orderBy = null)
 * @method MethodBuildingBlock[]    findAll()
 * @method MethodBuildingBlock[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MethodBuildingBlockRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MethodBuildingBlock::class);
    }

    // /**
    //  * @return MethodBuildingBlock[] Returns an array of MethodBuildingBlock objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MethodBuildingBlock
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
