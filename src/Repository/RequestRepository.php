<?php

namespace App\Repository;

use App\Entity\ContactRequest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ContactRequest|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContactRequest|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContactRequest[]    findAll()
 * @method ContactRequest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RequestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContactRequest::class);
    }

    /**
     * @param $adopter
     * @return ContactRequest[] Returns an array of ContactRequest objects
     */
    public function findByAdopterFilterByDate($adopter)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.adopter = :val')
            ->setParameter('val', $adopter)
            ->join('r.messages', 'm')
            ->orderBy('m.dateOfSending', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }


    /**
     * @param $announcer
     * @return ContactRequest[] Returns an array of ContactRequest objects
     */
    public function findByAnnouncerFilterByDate($announcer)
    {
        return $this->createQueryBuilder('r')
            ->join('r.advertisement', 'a')
            ->andWhere('a.announcer = :val')
            ->setParameter('val', $announcer)
            ->join('r.messages', 'm')
            ->orderBy('m.dateOfSending', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }

}
