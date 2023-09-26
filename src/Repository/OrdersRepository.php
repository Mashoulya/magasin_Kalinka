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

    // Ajoutez cette méthode pour récupérer les nouvelles commandes non payées
    public function findNonPayedOrders()
    {
        return $this->createQueryBuilder('o')
            ->where('o.payed = false')
            ->getQuery()
            ->getResult();
    }

    // Ajoutez cette méthode pour récupérer les commandes payées
    public function findPayedOrders()
    {
        return $this->createQueryBuilder('o')
            ->where('o.payed = true')
            ->getQuery()
            ->getResult();
    }
}
