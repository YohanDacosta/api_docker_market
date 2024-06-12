<?php

namespace App\Tests;

use App\Entity\Countries;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CountriesTest extends KernelTestCase 
{
    private $em;

    protected function setUp(): void {
        self::bootKernel();
        $this->em = static::$kernel->getContainer()->get('doctrine')->getManager();
    }

    # GET COUNTRY BY ID
    public function testGetCountry()
    {
        $country = $this->em->getRepository(Countries::class)->findBy(['id' => 2]);
        $this->assertIsArray($country, );
        $this->assertNotEmpty($country);
        $this->assertIsArray($country);
        $this->assertInstanceOf(Countries::class, $country[0]);
        $this->assertEquals($country[0]->getId(), 2);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->em->close();
        $this->em = null;
    }
}