<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 *
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

   /**
    * @return Product[] Returns an array of Product objects
    */
   public function findByCategoryId($value): array
   {
       return $this->createQueryBuilder('p')
           ->andWhere('p.category = :val')
           ->setParameter('val', $value)
           ->orderBy('p.id', 'ASC')
           ->getQuery()
           ->getResult();
   }

   public function findPopularProducts($limit = 10)
   {
    return $this->createQueryBuilder('p')
        ->select('p.id, p.image, p.name, p.description, p.price, COUNT(od.id) as ordersCount, p.stock')
        ->join('p.ordersDetails', 'od')
        ->groupBy('p.id')
        ->orderBy('ordersCount', 'DESC')
        ->setMaxResults($limit)
        ->getQuery()
        ->getResult();
   }

//    public function findOneBySomeField($value): ?Product
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
