<?php

namespace App\Repository;

use App\Entity\Announcer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Announcer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Announcer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Announcer[]    findAll()
 * @method Announcer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnnouncerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Announcer::class);
    }

    // /**
    //  * @return Announcer[] Returns an array of Announcer objects
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
    public function findOneBySomeField($value): ?Announcer
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
