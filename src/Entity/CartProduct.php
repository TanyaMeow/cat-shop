<?php

namespace App\Entity;

use App\Repository\CartProductRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CartProductRepository::class)]
class CartProduct
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column]
    private int $count;

    #[ORM\Column(name: 'product_id')]
    private int $productId;

    #[ORM\OneToOne(targetEntity: Product::class)]
    #[ORM\JoinColumn(name: 'product_id', referencedColumnName: 'id')]
    private Product $product;

    public function __construct(int $count, Product $product)
    {
        $this->count = $count;
        $this->product = $product;
    }

    public function setCount(int $count): void
    {
        $this->count = $count;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }
}
