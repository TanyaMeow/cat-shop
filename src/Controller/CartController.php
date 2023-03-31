<?php

namespace App\Controller;

use App\Api\Request\Cart\AddProduct;
use App\Entity\CartProduct;
use App\Repository\CartProductRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CartController extends AbstractController
{
    #[Route(path: '/api/cart', methods: [Request::METHOD_PUT])]
    public function addProduct(
        Request $request,
        EntityManagerInterface $entityManager,
        ProductRepository $productRepository,
        CartProductRepository $cartProductRepository,
        ValidatorInterface $validator
    ): Response {
        $request = AddProduct::fromRequest($request);

        if (count($validator->validate($request)) > 0) {
            return new Response(status: Response::HTTP_BAD_REQUEST);
        }

        /** @var CartProduct $cartProduct */
        $cartProduct = $cartProductRepository->findOneBy(['productId' => $request->product_id]);

        if ($cartProduct) {
            $cartProduct->setCount($request->count);
        } else {
            $entityManager->persist(
                new CartProduct(
                    count: $request->count,
                    product: $productRepository->find($request->product_id)
                )
            );
        }

        $entityManager->flush();

        return new Response();
    }
}
