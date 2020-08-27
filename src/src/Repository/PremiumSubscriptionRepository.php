<?php

namespace App\Repository;

use App\Entity\PremiumSubscription;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PremiumSubscription|null find($id, $lockMode = null, $lockVersion = null)
 * @method PremiumSubscription|null findOneBy(array $criteria, array $orderBy = null)
 * @method PremiumSubscription[]    findAll()
 * @method PremiumSubscription[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PremiumSubscriptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PremiumSubscription::class);
    }

    // /**
    //  * @return PremiumSubscription[] Returns an array of PremiumSubscription objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PremiumSubscription
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
