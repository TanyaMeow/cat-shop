<?php

namespace App\Validator\Product;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class ProductExist extends Constraint
{
    public string $message = 'Product with specified id does not exist.';
}
