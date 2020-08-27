<?php

namespace App\Repository;

use App\Entity\GroupInvitation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GroupInvitation|null find($id, $lockMode = null, $lockVersion = null)
 * @method GroupInvitation|null findOneBy(array $criteria, array $orderBy = null)
 * @method GroupInvitation[]    findAll()
 * @method GroupInvitation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroupInvitationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GroupInvitation::class);
    }

    // /**
    //  * @return GroupInvitation[] Returns an array of GroupInvitation objects
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
    public function findOneBySomeField($value): ?GroupInvitation
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
