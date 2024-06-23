<?php

namespace App\Controller;

use App\Entity\Products;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Context\Context;
use FOS\RestBundle\Controller\Annotations\Route;
use FOS\RestBundle\Serializer\Serializer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

#[Route('/api', name:'api_')]
class ProductController extends AbstractController
{
    public const ERROR_COMPANY_NOT_FOUND = 'Company not found!';

    private $em;
    private $serializer;

    public function __construct(EntityManagerInterface $entityManager, Serializer $serializer)
    {
        $this->em = $entityManager;
        $this->serializer = $serializer;
    }

    #[Route('/products', name: 'get_products', methods: 'GET')]
    public function getCompanies(): JsonResponse
    {
        $companies = $this->em->getRepository(Products::class)->findAll();

        $context = new Context();
        $context->setGroups(['groups' => 'product:read']);
        $data = $this->serializer->serialize($companies, 'json', $context);

        return new JsonResponse(['errors' => false, 'data' => json_decode($data)], Response::HTTP_OK, [], false);
    }

    #[Route('/product/{id}', name: 'get_product', methods: 'GET')]
    public function getCompany(int $id): JsonResponse
    {
        $company = $this->em->getRepository(Products::class)->findBy(['id' => $id]);

        if (!$company) {
            return new JsonResponse(['errors' => true, 'message' => self::ERROR_COMPANY_NOT_FOUND], Response::HTTP_NOT_FOUND, [], false);
        }

        $context = new Context();
        $context->setGroups(['product:read']);
        $data = $this->serializer->serialize($company, 'json', $context);

        return new JsonResponse(['errors' => false, 'data' => json_decode($data)], Response::HTTP_OK, [], false);
    }
}
