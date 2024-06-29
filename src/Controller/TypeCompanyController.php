<?php

namespace App\Controller;

use App\Entity\TypeCompany;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Context\Context;
use FOS\RestBundle\Serializer\Serializer;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/api', name: 'api_')]
class TypeCompanyController extends AbstractController
{
    public const ERROR_COMPANY_NOT_FOUND = 'Company not found!';

    private $em;
    private $serialier;

    public function __construct(EntityManagerInterface $em, Serializer $serialier)
    {
        $this->em = $em;
        $this->serialier = $serialier;
    }

    #GET ALL TYPE OF COMPANIES
    #[Route('/type_companies', name: 'type_companies')]
    public function all(): JsonResponse
    {
        $type_companies = $this->em->getRepository(TypeCompany::class)->findAll();

        $context = new Context();
        $context->setGroups(['type_company:read']);
        $data = $this->serialier->serialize($type_companies, 'json', $context);

        return new JsonResponse(['errors' => false, 'data' => json_decode($data)], Response::HTTP_OK, [], false);
    }

    #GET A TYPE OF COMPANY BY ID
    #[Route('/type_company/{id}', name: 'get_type_company')]
    public function get(int $id): JsonResponse
    {
        $type_company = $this->em->getRepository(TypeCompany::class)->findOneBy(['id' =>$id]);

        if (!$type_company) {
            return new JsonResponse(['errors' => true, 'message' => self::ERROR_COMPANY_NOT_FOUND], Response::HTTP_NOT_FOUND, [], false);
        }
        $context = new Context();
        $context->setGroups(['type_company:read']);
        $data = $this->serialier->serialize($type_company, 'json', $context);

        return new JsonResponse(['errors' => false, 'data' => json_decode($data)], Response::HTTP_OK, [], false);
    }
}
