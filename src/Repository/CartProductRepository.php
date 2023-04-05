<?php

namespace App\Repository;

use App\Entity\CartProduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use WS\Utils\Collections\CollectionFactory;

class CartProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CartProduct::class);
    }

    public function getProductsCount(): int
    {
        $result = $this->findAll();

        return CollectionFactory::from($result)
            ->stream()
            ->reduce(fn(CartProduct $el, ?int $carry = 0) => $carry + $el->getCount());
    }

    public function getTotalPrice(): int
    {
        $qb = $this->createQueryBuilder('cp');

        $qb
            ->addSelect('p')
            ->innerJoin('cp.product', 'p');

        $result = $qb
            ->getQuery()
            ->getResult();

        return CollectionFactory::from($result)
            ->stream()
            ->reduce(
                fn(CartProduct $el, ?int $carry = 0) => $carry + ($el->getCount() * $el->getProduct()->getPrice())
            );
    }
}
