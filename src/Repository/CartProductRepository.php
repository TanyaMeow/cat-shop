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

    public function getProductsCount(string $guestId): int
    {
        $result = $this->findBy(['guestId' => $guestId]);

        return CollectionFactory::from($result)
            ->stream()
            ->reduce(fn(CartProduct $el, ?int $carry = 0) => $carry + $el->getCount()) ?? 0;
    }

    public function getTotalPrice(string $guestId): int
    {
        $qb = $this->createQueryBuilder('cp');

        $qb
            ->addSelect('p')
            ->innerJoin('cp.product', 'p')
            ->where('cp.guestId = :guestId')
            ->setParameter('guestId', $guestId);

        $result = $qb
            ->getQuery()
            ->getResult();

        return CollectionFactory::from($result)
            ->stream()
            ->reduce(
                fn(CartProduct $el, ?int $carry = 0) => $carry + ($el->getCount() * $el->getProduct()->getPrice())
            ) ?? 0;
    }
}
