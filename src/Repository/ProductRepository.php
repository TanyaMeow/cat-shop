<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function productExist(int $productId): bool
    {
        $qb = $this->_em->createQueryBuilder();

        $qb
            ->select($qb->expr()->count('product.id'))
            ->from(Product::class, 'product')
            ->where($qb->expr()->eq('product.id', ':id'))
            ->setParameter('id', $productId);

        /** @noinspection PhpUnhandledExceptionInspection */
        return $qb
            ->getQuery()
            ->setMaxResults(1)
            ->getSingleScalarResult() > 0;
    }
}
