<?php

namespace App\Controller;

use App\Api\Response\Shop\Product;
use App\Entity\Product as ProductEntity;
use App\Repository\ProductRepository;
use Symfony\Bridge\Twig\Attribute\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use WS\Utils\Collections\CollectionFactory;

class ShopController extends AbstractController
{
    #[Route('/')]
    #[Template('shop/index.html.twig')]
    public function index(ProductRepository $productRepository): array
    {
        return [
            'products' => CollectionFactory::fromIterable(
                $productRepository->findAll()
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
