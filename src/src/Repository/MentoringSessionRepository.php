<?php

namespace App\Repository;

use App\Entity\MentoringSession;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MentoringSession|null find($id, $lockMode = null, $lockVersion = null)
 * @method MentoringSession|null findOneBy(array $criteria, array $orderBy = null)
 * @method MentoringSession[]    findAll()
 * @method MentoringSession[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MentoringSessionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MentoringSession::class);
    }

    // /**
    //  * @return MentoringSession[] Returns an array of MentoringSession objects
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
    public function findOneBySomeField($value): ?MentoringSession
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
