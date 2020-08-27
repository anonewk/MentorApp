<?php

namespace App\Repository;

use App\Entity\GroupAssignment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GroupAssignment|null find($id, $lockMode = null, $lockVersion = null)
 * @method GroupAssignment|null findOneBy(array $criteria, array $orderBy = null)
 * @method GroupAssignment[]    findAll()
 * @method GroupAssignment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroupAssignmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GroupAssignment::class);
    }

    // /**
    //  * @return GroupAssignment[] Returns an array of GroupAssignment objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GroupAssignment
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
