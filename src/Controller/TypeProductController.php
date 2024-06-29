<?php

namespace App\Controller;

use App\Entity\TypeProduct;
use FOS\RestBundle\Context\Context;
use FOS\RestBundle\Serializer\Serializer;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

#[Route('/api', name: 'api_')]
class TypeProductController extends AbstractController
{
    public const ERROR_TYPE_PRODUCT_NOT_FOUND = 'Type Product not found!';

    private $em;
    private $serialier;

    public function __construct(EntityManagerInterface $em, Serializer $serialier)
    {
        $this->em = $em;
        $this->serialier = $serialier;
    }

    #GET ALL TYPE OF PRODUCTS
    #[Route('/type_products', name: 'type_products')]
    public function all(): JsonResponse
    {
        $type_products = $this->em->getRepository(TypeProduct::class)->findAll();

        $context = new Context();
        $context->setGroups(['type_product:read']);
        $data = $this->serialier->serialize($type_products, 'json', $context);

        return new JsonResponse(['errors' => false, 'data' => json_decode($data)], Response::HTTP_OK, [], false);
    }

    #GET A TYPE OF PRODUCT BY ID
    #[Route('/type_product/{id}', name: 'get_type_product')]
    public function get(int $id): JsonResponse
    {
        $type_product = $this->em->getRepository(TypeProduct::class)->findOneBy(['id' =>$id]);

        if (!$type_product) {
            return new JsonResponse(['errors' => true, 'message' => self::ERROR_TYPE_PRODUCT_NOT_FOUND], Response::HTTP_NOT_FOUND, [], false);
        }
        $context = new Context();
        $context->setGroups(['type_product:read']);
        $data = $this->serialier->serialize($type_product, 'json', $context);

        return new JsonResponse(['errors' => false, 'data' => json_decode($data)], Response::HTTP_OK, [], false);
    }
}
