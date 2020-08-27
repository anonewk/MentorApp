<?php

namespace App\Repository;

use App\Entity\ContactMethod;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ContactMethod|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContactMethod|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContactMethod[]    findAll()
 * @method ContactMethod[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactMethodRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContactMethod::class);
    }

    // /**
    //  * @return ContactMethod[] Returns an array of ContactMethod objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ContactMethod
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
