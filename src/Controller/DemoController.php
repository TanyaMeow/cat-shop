<?php

namespace App\Controller;

use App\Api\Response\Product;
use App\Entity\Product as ProductEntity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Attribute\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use WS\Utils\Collections\CollectionFactory;

class DemoController extends AbstractController
{
    #[Route('/demo')]
    #[Template('demo/index.html.twig')]
    public function index(EntityManagerInterface $entityManager): array
    {
        return [
            'products' => CollectionFactory::fromIterable(
                $entityManager->getRepository(ProductEntity::class)->findAll()
            )
                ->stream()
                ->map(function (ProductEntity $product) {
                    return new Product(
                        id: $product->getId(),
                        name: $product->getName(),
                        price: $product->getPrice(),
                        image_path: '/images/' . $product->getImage()
                    );
                })
                ->toArray()
        ];
    }
}
