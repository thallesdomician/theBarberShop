<?php

namespace App\Repository;

use App\Entity\BarberShop;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method BarberShop|null find($id, $lockMode = null, $lockVersion = null)
 * @method BarberShop|null findOneBy(array $criteria, array $orderBy = null)
 * @method BarberShop[]    findAll()
 * @method BarberShop[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BarberShopRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BarberShop::class);
    }

    // /**
    //  * @return BarberShop[] Returns an array of BarberShop objects
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
    public function findOneBySomeField($value): ?BarberShop
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
