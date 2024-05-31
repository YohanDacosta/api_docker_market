<?php

namespace App\Tests;

use App\Entity\Companies;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CompaniesTest extends KernelTestCase
{
    private $em;

    protected function setUp(): void {
        self::bootKernel();
        $this->em = static::$kernel->getContainer()->get('doctrine')->getManager();;
    }

    public function testGetCompanies()
    {
        $companies = $this->em->getRepository(Companies::class)->findAll();

        $this->assertNotEmpty($companies);
        $this->assertIsArray($companies);

        foreach ($companies as $company) {
            $this->assertInstanceOf(Companies::class, $company);
        }
    }

    // public function testGetCompany(): void {
    //     $company = $this->em->getRepository(Companies::class)->findBy(['id' => 3]);
        
    //     $this->assertNotEmpty($company);
    //     $this->assertIsArray($company);
    // }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->em->close();
        $this->em = null;
    }
}
