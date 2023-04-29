<?php

namespace App\Api\Request\Product;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

class NewProduct
{
    #[Assert\Type('string')]
    #[Assert\NotBlank]
    public mixed $name;

    #[Assert\Type('integer')]
    #[Assert\GreaterThan(0)]
    public mixed $price;

    #[Assert\Type(UploadedFile::class)]
    public mixed $image;
}
