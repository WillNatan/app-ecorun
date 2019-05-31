<?php

namespace App\Repository;

use App\Entity\Blo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Blo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Blo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Blo[]    findAll()
 * @method Blo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BloRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Blo::class);
    }

    // /**
    //  * @return Blo[] Returns an array of Blo objects
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
    public function findOneBySomeField($value): ?Blo
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
