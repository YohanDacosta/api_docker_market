<?php

namespace App\Controller;

use App\Helper\Helper;
use App\Entity\Products;
use App\Form\Type\ProductType;
use FOS\RestBundle\Context\Context;
use FOS\RestBundle\Serializer\Serializer;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

#[Route('/api', name:'api_')]
class ProductController extends AbstractController
{
    public const ERROR_PRODUCT_NOT_FOUND = 'Product not found!';
    public const PRODUCT_CREATED = 'Product created successfully!';

    private $em;
    private $serializer;

    public function __construct(EntityManagerInterface $entityManager, Serializer $serializer)
    {
        $this->em = $entityManager;
        $this->serializer = $serializer;
    }

    #[Route('/products', name: 'get_products', methods: 'GET')]
    public function all(): JsonResponse
    {
        $products = $this->em->getRepository(Products::class)->findAll();

        $context = new Context();
        $context->setGroups(['groups' => 'product:read']);
        $data = $this->serializer->serialize($products, 'json', $context);

        return new JsonResponse(['errors' => false, 'data' => json_decode($data)], Response::HTTP_OK, [], false);
    }

    #[Route('/product/{id}', name: 'get_product', methods: 'GET')]
    public function get(int $id): JsonResponse
    {
        $product = $this->em->getRepository(Products::class)->findBy(['id' => $id]);

        if (!$product) {
            return new JsonResponse(['errors' => true, 'message' => self::ERROR_PRODUCT_NOT_FOUND], Response::HTTP_NOT_FOUND, [], false);
        }

        $context = new Context();
        $context->setGroups(['product:read']);
        $data = $this->serializer->serialize($product, 'json', $context);

        return new JsonResponse(['errors' => false, 'data' => json_decode($data)], Response::HTTP_OK, [], false);
    }

    #[Route('/product/add', name: 'add_product', methods: 'POST')]
    public function add(Request $request): JsonResponse
    {
        $product = new Products();
        $form = $this->createForm(ProductType::class, $product);
        $data = json_decode($request->getContent(), true);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($product);
            $this->em->flush();

            return new JsonResponse(['errors' => false, 'message' => self::PRODUCT_CREATED], Response::HTTP_CREATED);
        }

        $helper = new Helper();

        $errors = $helper->getFormErrors($form);

        return new JsonResponse(['errors' => true, 'message' => $errors], Response::HTTP_BAD_REQUEST, [], false);
    }
}
