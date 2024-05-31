<?php

namespace App\Controller;

use App\Entity\Companies;
use App\Form\Type\CompanyType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use FOS\RestBundle\Context\Context;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Serializer\Serializer;
use phpDocumentor\Reflection\PseudoTypes\True_;
use PHPUnit\TextUI\XmlConfiguration\Group;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api', name:'api_')]
class CompanyController extends AbstractFOSRestController
{
    private $em;
    private $serializer;

    public function __construct(EntityManagerInterface $em, Serializer $serializer)
    {
        $this->em = $em;
        $this->serializer = $serializer;
    }   

    #[Route('/companies', name: 'get_companies', methods: 'GET')]
    public function getCompanies()
    {
        $companies = $this->em->getRepository(Companies::class)->findAll();
        $context = new Context();
        $context->setGroups(['groups' => 'company:read']);
        $data = $this->serializer->serialize($companies, 'json', $context);
        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }

    #[Route('/company/{id}', name: 'get_company')]
    public function getCompany(int $id)
    {
        $company = $this->em->getRepository(Companies::class)->findBy(['id' => $id]);

        if (!$company) {
            return new JsonResponse(['data' => [], 'message' => 'Company not found'], Response::HTTP_NOT_FOUND, [], false);
        }
        
        $context = new Context();
        $context->setGroups(['groups' => 'company:read']);
        $data = $this->serializer->serialize($company, 'json', $context);
        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }

    #[Route('/company/create', name: 'create_company', methods: 'POST')]
    public function createCompany(Request $request)
    {
        $company = new Companies();
        $form = $this->createForm(CompanyType::class, $company);
        $data = json_decode($request->getContent(), true);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($company);
            $this->em->flush();

            $context = new Context();
            $context->getGroups(['groups' => 'company:read']);
            $data = $this->serializer->serialize($company, 'json', $context);
            return new JsonResponse($data, Response::HTTP_CREATED, [], True);
        }

        $error = [];
        foreach ($form->getErrors(true) as $error){
            $error[] = $error->getMessage();
        }

        return new JsonResponse(['errors' => $error], Response::HTTP_BAD_REQUEST);
    }
}
