<?php

namespace App\Repository;

use App\Entity\Advertisement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Advertisement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Advertisement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Advertisement[]    findAll()
 * @method Advertisement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdvertisementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Advertisement::class);
    }

    /**
    * @return Advertisement[] Returns an array of Advertisement objects
    */

    public function findByActiveAds()
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.isActive = :val')
            ->setParameter('val', true)
            ->orderBy('a.updateDate', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }


    /**
     * @return Advertisement[] Returns an array of Last fives Advertisement objects
     */
    public function findLastFiveAds()
    {
        return $this->createQueryBuilder('a')
            ->setMaxResults(5)
            ->orderBy('a.updateDate', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }
}
