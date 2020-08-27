<?php

namespace App\Repository;

use App\Entity\MentoringContractSubscription;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MentoringContractSubscription|null find($id, $lockMode = null, $lockVersion = null)
 * @method MentoringContractSubscription|null findOneBy(array $criteria, array $orderBy = null)
 * @method MentoringContractSubscription[]    findAll()
 * @method MentoringContractSubscription[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MentoringContractSubscriptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MentoringContractSubscription::class);
    }

    // /**
    //  * @return MentoringContractSubscription[] Returns an array of MentoringContractSubscription objects
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
    public function findOneBySomeField($value): ?MentoringContractSubscription
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
