<?php

namespace App\Api\Response\Shop;

class Product
{
    public readonly int $id;

    public readonly string $name;

    public readonly int $price;

    public readonly string $image_path;

    public function __construct(int $id, string $name, int $price, string $image_path)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->image_path = $image_path;
    }
}
