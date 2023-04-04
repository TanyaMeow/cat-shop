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

    public function getTotalPrice(): int
    {
        $qb = $this->createQueryBuilder('cardProduct');

        /** @var CartProduct[] $result */
        $result = $qb
            ->addSelect('product')
            ->innerJoin('cardProduct.product', 'product')
            ->getQuery()
            ->getResult();

        $total = 0;

        foreach ($result as $cartProduct) {
            $total += ($cartProduct->getCount() * $cartProduct->getProduct()->getPrice());
        }

        return $total;
    }
}
