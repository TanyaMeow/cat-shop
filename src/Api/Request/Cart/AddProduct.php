<?php

namespace App\Api\Request\Cart;

use App\Api\Request\RequestFillingTrait;
use App\Validator\Product\ProductExist;
use Symfony\Component\Validator\Constraints as Assert;

class AddProduct
{
    use RequestFillingTrait;

    #[ProductExist]
    #[Assert\NotNull]
    public int $product_id;

    #[Assert\LessThanOrEqual(10)]
    #[Assert\NotNull]
    public int $count;
}
