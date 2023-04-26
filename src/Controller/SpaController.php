<?php

namespace App\Controller;

use Symfony\Bridge\Twig\Attribute\Template;
use Symfony\Component\Routing\Annotation\Route;

class SpaController
{
    #[Route('/')]
    #[Template('spa.html.twig')]
    public function index(): array
    {
        return [];
    }
}
