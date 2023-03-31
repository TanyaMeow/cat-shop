<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
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
}
