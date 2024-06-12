<?php

namespace App\Controller;

use App\Entity\Countries;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Context\Context;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Serializer\Serializer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api', name:'api_')]
class CountryController extends AbstractFOSRestController
{
    public const ERROR_COMPANY_NOT_FOUND = 'Company not found!';

    private $em;
    private $serializer;

    public function __construct(EntityManagerInterface $em, Serializer $serializer)
    {
        $this->em = $em;
        $this->serializer = $serializer;
    }

    #[Route('/country/{id}', name: 'get_country', methods: 'GET')]
    public function index(int $id): JsonResponse
    {
       $country = $this->em->getRepository(Countries::class)->findBy(['id' => $id]);

       if (!$country) {
        return new JsonResponse(['errors' => true, 'message' => self::ERROR_COMPANY_NOT_FOUND], Response::HTTP_NOT_FOUND, [], false);
       }

       $context = new Context();
       $context->setGroups(['groups' => 'country:read']);
       $data = $this->serializer->serialize($country, 'json', $context);

       return new JsonResponse(['errors' => false, 'data' => json_decode($data)], Response::HTTP_OK, [], false);
    }
}
