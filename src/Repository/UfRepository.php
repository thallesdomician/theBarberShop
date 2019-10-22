<?php

namespace App\Repository;

use App\Entity\Uf;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Uf|null find($id, $lockMode = null, $lockVersion = null)
 * @method Uf|null findOneBy(array $criteria, array $orderBy = null)
 * @method Uf[]    findAll()
 * @method Uf[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UfRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Uf::class);
    }

    // /**
    //  * @return Uf[] Returns an array of Uf objects
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
    public function findOneBySomeField($value): ?Uf
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
