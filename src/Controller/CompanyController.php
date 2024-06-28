<?php

namespace App\Controller;

use App\Helper\Helper;
use App\Entity\Companies;
use App\Form\Type\CompanyType;
use FOS\RestBundle\Context\Context;
use FOS\RestBundle\Serializer\Serializer;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;

#[Route('/api', name:'api_')]
class CompanyController extends AbstractFOSRestController
{
    public const ERROR_COMPANY_NOT_FOUND = 'Company not found!';
    public const ERROR_EMPTY_FIELDS = 'There are empty fields!';
    public const COMPANY_CREATED = 'Company created successfully!';
    public const COMPANY_DELETED = 'Company deleted successfully!';
    public const COMPANY_EDITED = 'Company edited successfully!';

    private $serializer;
    private $em;

    public function __construct(EntityManagerInterface $em, Serializer $serializer)
    {
        $this->em = $em;
        $this->serializer = $serializer;
    }   

    #[Route('/companies', name: 'get_companies', methods: 'GET')]
    public function all(): JsonResponse
    {
        $companies = $this->em->getRepository(Companies::class)->findAll();
        $context = new Context();
        $context->setGroups(['groups' => 'company:read']);
        $data = $this->serializer->serialize($companies, 'json', $context);

        return new JsonResponse(['errors' => false, 'data' => json_decode($data)], Response::HTTP_OK, [], false);
    }

    #[Route('/company/{id}', name: 'get_company', methods: 'GET')]
    public function get(int $id): JsonResponse
    {
        $company = $this->em->getRepository(Companies::class)->findBy(['id' => $id]);

        if (!$company) {
            return new JsonResponse(['errors' => true, 'message' => self::ERROR_COMPANY_NOT_FOUND], Response::HTTP_NOT_FOUND, [], false);
        }
        
        $context = new Context();
        $context->setGroups(['groups' => 'company:read']);
        $data = $this->serializer->serialize($company, 'json', $context);
        return new JsonResponse(['errors' => false, 'data' => json_decode($data)], Response::HTTP_OK, [], false);
    }

    #[Route('/company/add', name: 'add_company', methods: 'POST')]
    public function add(Request $request): JsonResponse
    {
        $company = new Companies();
        $form = $this->createForm(CompanyType::class, $company, ['required' => false]);
        $data = json_decode($request->getContent(), true);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($company);
            $this->em->flush();  

            $context = new Context();
            $context->setGroups(['groups' => 'company:read']);
            $data = $this->serializer->serialize($company, 'json', $context);
            
            return new JsonResponse(['errors' => false, 'message' => self::COMPANY_CREATED], Response::HTTP_CREATED, [], false);
        }

        $helper = new Helper();
        $errors = $helper->getFormErrors($form);

        return new JsonResponse(['errors' => true, 'message' => $errors], Response::HTTP_BAD_REQUEST, [], false);
    }

    #[Route('/company/edit', name: 'edit_company', methods: 'PUT')]
    public function editCompany(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $data['id'] ??= null;
        $data['type'] ??= null;
        $data['cif'] ??= null;
        $data['name'] ??= null;

        if (!$data['id'] || !$data['type'] || !$data['cif'] || !$data['name']) {
            return new JsonResponse(['errors' => true, 'message' => self::ERROR_EMPTY_FIELDS], Response::HTTP_BAD_REQUEST, [], false);
        }

        $company = $this->em->getRepository(Companies::class)->find($data['id']);

        if (!$company) {
            return new JsonResponse(['errors' => true, 'message' => self::ERROR_COMPANY_NOT_FOUND], Response::HTTP_NOT_FOUND, [], false);
        }
        $form = $this->createForm(CompanyType::class, $company);
        $data = json_decode($request->getContent(), true);
        
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            $company->setUpdatedAT(new \DateTime());
            $this->em->flush();  
            return new JsonResponse(['errors' => false, 'message' => self::COMPANY_EDITED], Response::HTTP_CREATED, [], false);
        }

        $helper = new Helper();
        $errors = $helper->getFormErrors($form);

        return new JsonResponse(['errors' => true, 'message' => $errors], Response::HTTP_BAD_REQUEST, [], false);
    }

    #[Route('/company/delete', name: 'delete_company', methods: 'POST')]
    public function deleteCompany(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $id = $data['id'] ?? null;

        if (!$id) {
            return new JsonResponse(['errors' => true, 'message' => self::ERROR_EMPTY_FIELDS], Response::HTTP_BAD_REQUEST, [], false);
        }
        $company = $this->em->getRepository(Companies::class)->find($id);

        if (!$company) {
            return new JsonResponse(['errors' => true, 'message' => self::ERROR_COMPANY_NOT_FOUND], Response::HTTP_NOT_FOUND, [], false);
        }
        $this->em->remove($company);
        $this->em->flush();

        return new JsonResponse(['errors' => false, 'message' => self::COMPANY_DELETED], Response::HTTP_OK, [], false);
    }
}
