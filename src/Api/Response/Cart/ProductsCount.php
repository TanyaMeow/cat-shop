<?php

namespace App\Api\Response\Cart;

class ProductsCount
{
    public readonly int $count;

    public function __construct(int $count)
    {
        $this->count = $count;
    }
}
