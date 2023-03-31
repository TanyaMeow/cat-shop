<?php

namespace App\Validator\Product;

use App\Repository\ProductRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ProductExistValidator extends ConstraintValidator
{
    public function __construct(private readonly ProductRepository $productRepository) {}

    /**
     * @param int $value
     * @param ProductExist $constraint
     * @return void
     */
    public function validate(mixed $value, Constraint $constraint): void
    {
        if (null === $value) {
            return;
        }

        if ($this->productRepository->productExist($value)) {
            return;
        }

        $this->context
            ->buildViolation($constraint->message)
            ->addViolation();
    }
}
