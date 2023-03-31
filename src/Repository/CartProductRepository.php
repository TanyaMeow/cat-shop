<?php

namespace App\Repository;

use App\Entity\CartProduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CartProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CartProduct::class);
    }

    public function getProductsCount(): int
    {
        $qb = $this->_em->createQueryBuilder();

        $qb
            ->select($qb->expr()->count('cartProduct.id'))
            ->from(CartProduct::class, 'cartProduct');

        /** @noinspection PhpUnhandledExceptionInspection */
        return $qb
                ->getQuery()
                ->setMaxResults(1)
                ->getSingleScalarResult();
    }
}
