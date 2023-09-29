<?php

namespace App\Repository;

use App\Entity\Orders;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Orders>
 *
 * @method Orders|null find($id, $lockMode = null, $lockVersion = null)
 * @method Orders|null findOneBy(array $criteria, array $orderBy = null)
 * @method Orders[]    findAll()
 * @method Orders[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrdersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Orders::class);
    }

    // les nouvelles commandes non payées
    public function findNonPayedOrders($user)
    {
        return $this->createQueryBuilder('o')
            ->where('o.user = :user')
            ->andWhere('o.payed = false')
            ->setParameter('user', $user)
            ->orderBy('o.created_at', 'DESC')
            ->getQuery()
            ->getResult();
    }

    // les commandes payées
    public function findPayedOrders($user)
    {
        return $this->createQueryBuilder('o')
            ->where('o.user = :user')
            ->andWhere('o.payed = true')
            ->setParameter('user', $user)
            ->getQuery()
            ->getResult();
    }
}
