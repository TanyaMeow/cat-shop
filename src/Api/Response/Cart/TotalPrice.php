<?php

namespace App\Api\Response\Cart;

class TotalPrice
{
    public readonly int $total;

    public function __construct(int $total)
    {
        $this->total = $total;
    }
}
