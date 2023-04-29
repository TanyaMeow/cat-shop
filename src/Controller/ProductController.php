<?php

namespace App\Controller;

use App\Api\Request\Product\NewProduct;
use App\Entity\Product;
use App\Entity\Product as ProductEntity;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use WS\Utils\Collections\CollectionFactory;

class ProductController extends AbstractController
{
    #[Route(path: '/api/products', methods: [Request::METHOD_GET])]
    public function getProducts(ProductRepository $productRepository): Response
    {
        return new JsonResponse([
            'products' => CollectionFactory::fromIterable(
                $productRepository->findAll()
            )
                ->stream()
                ->map(function (ProductEntity $product) {
                    return new \App\Api\Response\Shop\Product(
                        id: $product->getId(),
                        name: $product->getName(),
                        price: $product->getPrice(),
                        image_path: '/images/' . $product->getImage()
                    );
                })
                ->toArray()
        ]);
    }

    #[Route(path: '/api/products', methods: [Request::METHOD_POST])]
    public function newProduct(
        Request $request,
        EntityManagerInterface $entityManager,
        ValidatorInterface $validator
    ): Response {
        $newProduct = new NewProduct();
        $newProduct->name = $request->request->get('name');
        $newProduct->price = (int) $request->request->get('price');
        $newProduct->image = $request->files->get('image');

        if (count($validator->validate($newProduct)) > 0) {
            return new JsonResponse([
                'error' => $newProduct
            ], Response::HTTP_BAD_REQUEST);
        }

        /** @var $image UploadedFile $image */
        $image = $newProduct->image;
        $newFilename = uniqid() . '.' . $image->guessExtension();

        try {
            $image->move(
                $this->getParameter('kernel.project_dir') . '/public/images',
                $newFilename
            );
        } catch (FileException $e) {
            return new JsonResponse([
                'error' => 'Error uploading image'
            ], Response::HTTP_BAD_REQUEST);
        }

        $entityManager->persist(
            new Product(
                name: $newProduct->name,
                price: $newProduct->price,
                image: $newFilename
            )
        );
        $entityManager->flush();

        return new Response();
    }

    #[Route(path: '/api/products/{productId}', requirements: ['productId' => '\d+'], methods: [Request::METHOD_DELETE])]
    public function removeProduct(
        int $productId,
        ProductRepository $productRepository,
        EntityManagerInterface $entityManager
    ): Response {
        $product = $productRepository->find($productId);

        if (null !== $product) {
            $entityManager->remove($product);
            $entityManager->flush();
        }

        return new Response();
    }
}
