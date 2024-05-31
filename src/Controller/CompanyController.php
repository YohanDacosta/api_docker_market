<?php

namespace App\Controller;

use App\Entity\Companies;
use Doctrine\Persistence\ManagerRegistry;
use FOS\RestBundle\Context\Context;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Serializer\Serializer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api', name:'api_')]
class CompanyController extends AbstractFOSRestController
{
    private $entityManager;
    private $serializer;

    public function __construct(ManagerRegistry $doctrine, Serializer $serializer)
    {
        $this->entityManager = $doctrine;
        $this->serializer = $serializer;
    }   

    #[Route('/companies', name: 'app_companies')]
    public function getCompanies()
    {
        $companies = $this->entityManager->getRepository(Companies::class)->findAll();
        $context = new Context();
        $context->setGroups(['groups' => 'company:read']);
        $data = $this->serializer->serialize($companies, 'json', $context);
        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }
}
