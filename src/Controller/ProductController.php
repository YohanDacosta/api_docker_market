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
}
