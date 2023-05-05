<?php

namespace App\Controller;

use App\Api\Request\Cart\AddProduct;
use App\Api\Response\Cart\ProductsCount;
use App\Api\Response\Cart\CartProduct;
use App\Api\Response\Cart\TotalPrice;
use App\Entity\CartProduct as CartProductEntity;
use App\Repository\CartProductRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Attribute\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use WS\Utils\Collections\CollectionFactory;

class CartController extends AbstractController
{
    private SessionInterface $session;

    public function __construct(RequestStack $requestStack)
    {
        $this->session = $requestStack->getSession();
    }

    #[Route('/cart')]
    #[Template('cart/index.html.twig')]
    public function index(CartProductRepository $cartProductRepository): array
    {
        return [
            'products' => CollectionFactory::fromIterable(
                $cartProductRepository->findBy(['guestId' => $this->session->get('guest-id')])
            )
                ->stream()
                ->map(function (CartProductEntity $product) {
                    return new CartProduct(
                        id: $product->getProduct()->getId(),
                        name: $product->getProduct()->getName(),
                        price: $product->getProduct()->getPrice(),
                        image_path: '/images/' . $product->getProduct()->getImage(),
                        count: $product->getCount()
                    );
                })
                ->toArray()
        ];
    }

    #[Route(path: '/api/cart', methods: [Request::METHOD_GET])]
    public function getProducts(CartProductRepository $cartProductRepository): Response
    {
        return new JsonResponse([
            'products' => CollectionFactory::fromIterable(
                $cartProductRepository->findBy(['guestId' => $this->session->get('guest-id')])
            )
                ->stream()
                ->map(function (CartProductEntity $product) {
                    return new CartProduct(
                        id: $product->getProduct()->getId(),
                        name: $product->getProduct()->getName(),
                        price: $product->getProduct()->getPrice(),
                        image_path: '/images/' . $product->getProduct()->getImage(),
                        count: $product->getCount()
                    );
                })
                ->toArray()
        ]);
    }

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

        /** @var CartProductEntity $cartProduct */
        $cartProduct = $cartProductRepository->findOneBy([
            'productId' => $request->product_id,
            'guestId' => $this->session->get('guest-id')
        ]);

        if ($cartProduct) {
            $cartProduct->setCount($request->count);
        } else {
            $entityManager->persist(
                new CartProductEntity(
                    count: $request->count,
                    product: $productRepository->find($request->product_id),
                    guestId: $this->session->get('guest-id'),
                )
            );
        }

        $entityManager->flush();

        return new Response();
    }

    #[Route(path: '/api/cart/count', methods: [Request::METHOD_GET])]
    public function getProductsCount(CartProductRepository $cartProductRepository): Response
    {
        $productsCount = $cartProductRepository->getProductsCount($this->session->get('guest-id'));

        return new JsonResponse(
            new ProductsCount($productsCount)
        );
    }

    #[Route(path: '/api/cart/{productId}', requirements: ['productId' => '\d+'], methods: [Request::METHOD_DELETE])]
    public function removeProduct(
        int $productId,
        CartProductRepository $cartProductRepository,
        EntityManagerInterface $entityManager
    ): Response {
        $cartProduct = $cartProductRepository->findOneBy([
            'productId' => $productId,
            'guestId' => $this->session->get('guest-id')
        ]);

        if (null !== $cartProduct) {
            $entityManager->remove($cartProduct);
            $entityManager->flush();
        }

        return new Response();
    }

    #[Route(path: '/api/cart/total', methods: [Request::METHOD_GET])]
    public function getTotalPrice(CartProductRepository $cartProductRepository): Response
    {
        return new JsonResponse(
            new TotalPrice($cartProductRepository->getTotalPrice($this->session->get('guest-id')))
        );
    }
}
