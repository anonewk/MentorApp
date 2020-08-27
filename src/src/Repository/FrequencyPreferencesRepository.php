<?php

namespace App\Repository;

use App\Entity\FrequencyPreferences;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FrequencyPreferences|null find($id, $lockMode = null, $lockVersion = null)
 * @method FrequencyPreferences|null findOneBy(array $criteria, array $orderBy = null)
 * @method FrequencyPreferences[]    findAll()
 * @method FrequencyPreferences[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FrequencyPreferencesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FrequencyPreferences::class);
    }

    // /**
    //  * @return FrequencyPreferences[] Returns an array of FrequencyPreferences objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FrequencyPreferences
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
