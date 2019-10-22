<?php

namespace App\Repository;

use App\Entity\UF;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method UF|null find($id, $lockMode = null, $lockVersion = null)
 * @method UF|null findOneBy(array $criteria, array $orderBy = null)
 * @method UF[]    findAll()
 * @method UF[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UFRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UF::class);
    }

    // /**
    //  * @return UF[] Returns an array of UF objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UF
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
