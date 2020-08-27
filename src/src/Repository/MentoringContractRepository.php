<?php

namespace App\Repository;

use App\Entity\MentoringContract;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MentoringContract|null find($id, $lockMode = null, $lockVersion = null)
 * @method MentoringContract|null findOneBy(array $criteria, array $orderBy = null)
 * @method MentoringContract[]    findAll()
 * @method MentoringContract[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MentoringContractRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MentoringContract::class);
    }

    // /**
    //  * @return MentoringContract[] Returns an array of MentoringContract objects
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
    public function findOneBySomeField($value): ?MentoringContract
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
