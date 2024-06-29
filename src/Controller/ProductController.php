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
    public const ERROR_EMPTY_FIELDS = 'There are empty fields!';
    public const PRODUCT_DELETED = 'Product deleted successfully!';
    public const PRODUCT_EDITED = 'Product edited successfully!';

    private $em;
    private $serializer;

    public function __construct(EntityManagerInterface $entityManager, Serializer $serializer)
    {
        $this->em = $entityManager;
        $this->serializer = $serializer;
    }

    #GET ALL PRODUCTS
    #[Route('/products', name: 'get_products', methods: 'GET')]
    public function all(): JsonResponse
    {
        $products = $this->em->getRepository(Products::class)->findAll();

        $context = new Context();
        $context->setGroups(['groups' => 'product:read']);
        $data = $this->serializer->serialize($products, 'json', $context);

        return new JsonResponse(['errors' => false, 'data' => json_decode($data)], Response::HTTP_OK, [], false);
    }

    #GET A PRODUCT BY ID
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

    #ADD A NEW PRODUCT
    #[Route('/product/add', name: 'add_product', methods: 'POST')]
    public function add(Request $request): JsonResponse
    {
        if ($request->isMethod('POST')) {
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

    #EDIT A PRODUCT BY ID
    #[Route('/product/edit', name: 'edit_product', methods: 'PUT')]
    public function edit(Request $request): JsonResponse
    {
        if ($request->isMethod('PUT')) {
            $data = json_decode($request->getContent(), true);
            $id = $data['id'] ?? null;
    
            if (!$id) {
                return new JsonResponse(['errors' => true, 'message' => self::ERROR_EMPTY_FIELDS], Response::HTTP_BAD_REQUEST, [], false);
            }
            $product = $this->em->getRepository(Products::class)->findOneBy(['id' => $id]);
    
            if (!$product) {
                return new JsonResponse(['errors' => true, 'message' => self::ERROR_PRODUCT_NOT_FOUND], Response::HTTP_NOT_FOUND, [], false);
            }
            $form = $this->createForm(ProductType::class, $product, ['is_edit' => true]);
            $form->submit($data);

            if ($form->isSubmitted() && $form->isValid()) {
                $this->em->persist($product);
                $this->em->flush();

                return new JsonResponse(['errors' => false, 'message' => self::PRODUCT_EDITED], Response::HTTP_OK, [], false);
            }
            $helper = new Helper();
            $errors = $helper->getFormErrors($form);
            
            return new JsonResponse(['errors' => true, 'message' => $errors], Response::HTTP_BAD_REQUEST, [], false);
        }
    }

    #DELETE A PRODUCT BY ID
    #[Route('/product/delete', name: 'delete_product', methods: 'POST')]
    public function delete(Request $request): JsonResponse
    {
        if ($request->isMethod('POST')) {
            $data = json_decode($request->getContent(), true);
            $id = $data['id'] ?? null;
    
            if (!$id) {
                return new JsonResponse(['errors' => true, 'message' => self::ERROR_EMPTY_FIELDS], Response::HTTP_BAD_REQUEST, [], false);
            }
            $product = $this->em->getRepository(Products::class)->findOneBy(['id' => $id]);
    
            if (!$product) {
                return new JsonResponse(['errors' => true, 'message' => self::ERROR_PRODUCT_NOT_FOUND], Response::HTTP_NOT_FOUND, [], false);
            }
            $this->em->remove($product);
            $this->em->flush();
    
            return new JsonResponse(['errors' => false, 'message' => self::PRODUCT_DELETED], Response::HTTP_OK, [], false);
        }
    }
}
