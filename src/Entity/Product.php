<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column]
    private string $name;

    #[ORM\Column]
    private int $price;

    #[ORM\Column(name: 'image')]
    private string $image;

    public function __construct(string $name, int $price, string $image)
    {
        $this->name = $name;
        $this->price = $price;
        $this->image = $image;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getImage(): string
    {
        return $this->image;
    }
}
