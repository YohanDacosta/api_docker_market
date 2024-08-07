<?php

namespace App\Tests;

use App\Entity\Companies;
use App\Form\Type\CompanyType;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Form\Test\TypeTestCase;

class CompaniesTest extends KernelTestCase
{
    private $em;

    protected function setUp(): void {
        self::bootKernel();
        $this->em = static::$kernel->getContainer()->get('doctrine')->getManager();
    }

    # GET ALL COMPANIES
    public function testGetCompanies(): void
    {
        $companies = $this->em->getRepository(Companies::class)->findAll();
        $this->assertNotEmpty($companies);
        $this->assertIsArray($companies);

        foreach ($companies as $company) {
            $this->assertInstanceOf(Companies::class, $company);
        }
    }

    # GET COMPANY BY ID
    public function testGetCompany(): void {
        $company = $this->em->getRepository(Companies::class)->findBy(['id' => 4]);
        
        $this->assertNotEmpty($company);
        $this->assertIsArray($company);
        $this->assertInstanceOf(Companies::class, $company[0]);
        $this->assertEquals($company[0]->getId(), 4);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->em->close();
        $this->em = null;
    }
}

class Companies1Test extends TypeTestCase
{
    public function testCreateCompany(): void {
        $formData = [
            'type' => 1,
            'cif' => 'V49245699',
            'name' => 'MANOR',
        ];

        $model = new Companies();

        $expected = (new Companies())
            ->setType(1)
            ->setCif('V49245699')
            ->setName('MANOR')
            ->setCreatedAt($model->getCreatedAt());

        $form = $this->factory->create(CompanyType::class, $model);
        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($expected, $model);

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}
