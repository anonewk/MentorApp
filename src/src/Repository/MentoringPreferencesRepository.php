<?php

namespace App\Repository;

use App\Entity\MentoringPreferences;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MentoringPreferences|null find($id, $lockMode = null, $lockVersion = null)
 * @method MentoringPreferences|null findOneBy(array $criteria, array $orderBy = null)
 * @method MentoringPreferences[]    findAll()
 * @method MentoringPreferences[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MentoringPreferencesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MentoringPreferences::class);
    }

    // /**
    //  * @return MentoringPreferences[] Returns an array of MentoringPreferences objects
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
    public function findOneBySomeField($value): ?MentoringPreferences
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
