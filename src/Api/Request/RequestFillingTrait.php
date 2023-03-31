<?php

namespace App\Api\Request;

use Symfony\Component\HttpFoundation\Request;

trait RequestFillingTrait
{
    public static function fromRequest(Request $request): static
    {
        $self = new static();

        foreach ($request->toArray() as $key => $value) {
            $self->$key = $value;
        }

        return $self;
    }
}
